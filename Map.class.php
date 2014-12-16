<?php
require_once("Tile.class.php");
class Map
{
    const DEBUG       = true;
    const STRICT      = true;
    const TILES       = "img/tiles.png";
    const GROUP_TILES = array("POKECENTER", "OAKLAB", "PLAYER_HOUSE", "RIVAL_HOUSE");

    private $src;
    private $raw_data;
    private $lines;
    private $map;
    private $id;
    private $vars;
    private $map_data;
    private $map_lines = 0;
    private $status = null;
    private $boundaries = array();
    private $walkables = array();
    private $group_tiles = array();
    private $unused = array();
    private $sections = array();
    private $warps = array();
    private $headers = array();

    public function Map($src) {
        $this->src = $src;
        $this->loadContent();
        $this->parseContent();
        $this->extractHeaders();
        $this->extractVars();
        $this->extractTiles();
        $this->extractWarps();
        $this->checkUnused();
        if (count($this->unused) != 0 && Map::STRICT) {
            echo $this->getStatus();
            echo "<pre>";
            print_r($this->unused);
            echo "</pre>";
            die;
        }
    }

    private function loadContent() {
        $this->raw_data = file_get_contents($this->src);
    }

    // Determine where the sections begin and end
    private function parseContent() {
        // Seperate src into lines
        $ex = explode("\n", $this->raw_data);
        foreach ($ex as &$line) {
            $line = trim($line);
            if (strlen($line) == 0 || substr($line, 0, 2) == "//") {
                $line = null;
            }
        }
        $ex = array_filter($ex);
        $ex = array_values($ex);
        $this->lines = $ex;

        $this->sections["headers"] = array(array_search("@headers", $ex), array_search("!headers", $ex));
        $this->sections["vars"] = array(array_search("@vars", $ex), array_search("!vars", $ex));
        if ($this->sections["vars"][0] === false || $this->sections["vars"][1] === false) {
            $this->setStatus("Failed to detect variable definitions.");
        }
        $this->sections["map"] = array(array_search("@map", $ex), array_search("!map", $ex));
        if ($this->sections["map"][0] === false || $this->sections["map"][1] === false) {
            $this->setStatus("Failed to detect map data.");
        }
        $this->sections["warps"] = array(array_search("@warps", $ex), array_search("!warps", $ex));
        $this->sections["events"] = array(array_search("@events", $ex), array_search("!events", $ex));
    }

    private function extractHeaders() {
        // Go through each line of warps section
        $ex = array_slice($this->lines, $this->sections["headers"][0]+1, $this->sections["headers"][1]-($this->sections["headers"][0]+1));
        foreach ($ex as $line) {
            // Seperate between the =
            $deli = explode("=", $line);
            foreach ($deli as &$value) {
                $value = trim($value);
            }

            $this->headers[$deli[0]] = $deli[1];
        }
    }

    private function extractVars() {
        // Go through each line of vars section
        $ex = array_slice($this->lines, $this->sections["vars"][0]+1, $this->sections["vars"][1]-($this->sections["vars"][0]+1));

        foreach ($ex as $line) {
            // Seperate line into 2 parts delimited by =
            $sep = explode("=", $line);

            // Remove whitespace
            foreach ($sep as &$val) {
                $val = trim($val);
            }

            // Store variable value
            // This is a foreground/background combo variable (for use with tiles that have transparent backgrounds)
            if (strpos($sep[1], "^") !== false) {
                $fgbg = explode("^", $sep[1]);
                foreach ($fgbg as $v) {
                    $constant = @constant("Tile::" . trim($v));
                    // Check if invalid and not in group tile list
                    if ($constant === null && !in_array($v, Map::GROUP_TILES)) {
                        $this->setStatus("Invalid tile name <b>" . $v . "</b>.");
                    }
                    if (in_array($v, Map::GROUP_TILES)) {
                        $this->group_tiles[$v] = 1;
                    }
                }
                $this->vars[$sep[0]] = $sep[1];
                continue;
            }
            $constant = @constant("Tile::" . $sep[1]);
            if ($constant === null) {
                if (in_array($sep[1], Map::GROUP_TILES)) {
                    $this->setStatus("<b>" . $sep[1] . "</b> must have a background tile.");
                }
                $this->setStatus("Invalid tile name <b>" . $sep[1] . "</b>.");
            } else {
                $this->vars[$sep[0]] = $sep[1];
            }
        }
    }

    private function extractTiles() {
        // Go through each line of map section
        $ex = array_slice($this->lines, $this->sections["map"][0]+1, $this->sections["map"][1]-($this->sections["map"][0]+1));
        foreach ($ex as $line) {
            if (strlen($line) != 0) {
                $this->map_data .= $line . "\n";
            }
        }
    }

    private function extractWarps() {
        // Go through each line of warps section
        $ex = array_slice($this->lines, $this->sections["warps"][0]+1, $this->sections["warps"][1]-($this->sections["warps"][0]+1));
        foreach ($ex as $line) {
            // Seperate between the =
            $deli = explode("=", $line);
            foreach ($deli as &$value) {
                $value = trim($value);
            }
            // Get coordinates of src
            preg_match("/\d*x\d*/", $deli[0], $src_coords);
            $src_coords = array("x" => substr($src_coords[0], 0, strpos($src_coords[0], "x")), "y" => substr($src_coords[0], strpos($src_coords[0], "x")+1));

            // Get direction of src (if any);
            preg_match("/\[\d\]/", $deli[0], $src_direction);
            $src_direction = substr($src_direction[0], 1, 1);

            // Get the new map to load in
            preg_match("/.+?(?=->)/", $deli[1], $dst_map);
            $dst_map = $dst_map[0];

            // Get the coordinates of where to place player when they warp
            preg_match("/\d*x\d*/", $deli[1], $dst_coords);
            $dst_coords = array("x" => substr($dst_coords[0], 0, strpos($dst_coords[0], "x")), "y" => substr($dst_coords[0], strpos($dst_coords[0], "x")+1));

            // Get direction of dst (if any);
            preg_match("/\[\d\]/", $deli[1], $dst_direction);
            $dst_direction = substr($dst_direction[0], 1, 1);

            // Get sound effect (if any) for when player warps
            preg_match("/\s(.*)/", $deli[1], $sound);
            $sound = substr($sound[0], 1);

            $this->warps[] = array("src_coords" => $src_coords, "src_direction" => $src_direction, "map" => $dst_map, "dst_coords" => $dst_coords, "dst_direction" => $dst_direction, "sound" => $sound);
        }
    }

    public function genImage($save = false, $name = null) {
        $tiles  = imagecreatefrompng(Map::TILES);
        $lines  = explode("\n", $this->map_data);
        $width  = max(array_map('strlen', $lines));
        $height = count($lines);

        if ($lines[$height-1] == null) {
            $height--;
        }

        $this->map = imagecreatetruecolor($width*16, $height*16);
        imagealphablending($this->map, true);
        imagesavealpha($this->map, true);
        for ($a = 0; $a < $height; $a++) {
            for ($b = 0; $b < strlen($lines[$a]); $b++) {
                if ($this->vars[$lines[$a][$b]] === null) {
                    $this->setStatus("Map tile <b>" . $lines[$a][$b] . "</b> was not found in the vars definition section.", false);
                }

                // If fgbg tile (transparencies) else normal tile
                if (strpos($this->vars[$lines[$a][$b]], "^") !== false) {
                    $fgbg = explode("^", $this->vars[$lines[$a][$b]]);
                    $bg = new Tile($fgbg[0]);

                    // If pokecenter, choose appropriate tile
                    if ($fgbg[1] == "POKECENTER") {
                        $fg = new Tile("POKECENTER_" . ($this->group_tiles["POKECENTER"]));
                        $this->group_tiles["POKECENTER"]++;
                    } else if ($fgbg[1] == "OAKLAB") {
                        $fg = new Tile("OAKLAB_" . ($this->group_tiles["OAKLAB"]));
                        $this->group_tiles["OAKLAB"]++;
                    } else if ($fgbg[1] == "PLAYER_HOUSE") {
                        $fg = new Tile("PLAYER_HOUSE_" . ($this->group_tiles["PLAYER_HOUSE"]));
                        $this->group_tiles["PLAYER_HOUSE"]++;
                    } else if ($fgbg[1] == "RIVAL_HOUSE") {
                        $fg = new Tile("RIVAL_HOUSE_" . ($this->group_tiles["RIVAL_HOUSE"]));
                        $this->group_tiles["RIVAL_HOUSE"]++;
                    } else {
                        $fg = new Tile($fgbg[1]);
                    }

                    // Apply background first
                    imagecopyresampled($this->map, $tiles, $b*16, $a*16, $bg->getCoords()[0]*16, $bg->getCoords()[1]*16, 16, 16, 16, 16);

                    // And then foreground
                    // if it needs to be flipped
                    if (array_key_exists(FLP, constant("Tile::" . $fg->getType())) && $fg->hasFlip()) {
                        $res = $this->goodImageCrop($tiles, array("x" => $fg->getCoords()[0]*16, "y" => $fg->getCoords()[1]*16, "width" => 16, "height" => 16));
                        $this->flipHorizontal($res);
                        imagecopyresampled($this->map, $res, $b*16, $a*16, 0, 0, 16, 16, 16, 16);
                    } else {
                        imagecopyresampled($this->map, $tiles, $b*16, $a*16, $fg->getCoords()[0]*16, $fg->getCoords()[1]*16, 16, 16, 16, 16);
                    }

                    // If foreground OR background has boundary, add to boundary list
                    if ($fg->hasBoundary() || $bg->hasBoundary()) {
                        $this->boundaries[] = array("x" => $b*16, "y" => $a*16);
                    }

                    // Check if foreground is is walkable
                    if ($fg->hasWalk()) {
                        $this->walkables[] = array("x" => $b*16, "y" => $a*16, "data" => base64_encode(Tile::getTileImage(constant("Tile::" . $fg->getType()))));
                    }

                } else {
                    // Apply tile
                    $tile = new Tile($this->vars[$lines[$a][$b]]);
                    imagecopyresampled($this->map, $tiles, $b*16, $a*16, $tile->getCoords()[0]*16, $tile->getCoords()[1]*16, 16, 16, 16, 16);

                    // If tile has boundary, add to boundary list
                    if ($tile->hasBoundary()) {
                        $this->boundaries[] = array("x" => $b*16, "y" => $a*16);
                    }

                    // Check if foreground is is walkable
                    if ($tile->hasWalk()) {
                        $this->walkables[] = array("x" => $b*16, "y" => $a*16, "data" => base64_encode(Tile::getTileImage(constant("Tile::" . $tile->getType()))));
                    }

                }
            }
        }
        if ($save) {
            // Save map
            // if null, use original name
            if ($name === null) {
                preg_match("/\/(.*)/", $this->src, $name);
                $this->id = substr($name[0], 1, -4);
            } else {
                $this->id = substr(md5(mt_rand(1,1000000)), 0, 16);
            }
            imagepng($this->map, "img/maps/" . $this->id . ".png");

            // Save boundaries
            file_put_contents("boundaries/" . $this->id . ".json", json_encode($this->getBoundaries()));

            foreach ($this->walkables as $index => $walk) {
                $css  .= "#WLK_" . $index . "{position:absolute; top: " . ($walk["y"]+8) . "px; left: " . ($walk["x"]+8) . "px; z-index: 3;}\n";
                $html .= "<img id=\"WLK_" . $index . "\" src=\"data:image/png;base64," . $walk["data"] . "\">\n";
            }

            // Add music location
            if ($this->headers["music"] !== null) {
                $html .= "<music hidden>" . $this->headers["music"] . "</music>";
            }

            // Save walkable tiles css
            file_put_contents("walkables/" . $this->id . ".css", $css);

            // Save walkable tiles html
            file_put_contents("walkables/" . $this->id . ".html", $html);

            // Save Warps
            file_put_contents("warps/" . $this->id . ".json", json_encode($this->warps));

        } else {
            header('Content-Type: image/png');
            imagepng($this->map);
        }
    }

    private function setStatus($status, $echo = true) {
        $this->status = $status;
        if (Map::DEBUG && $echo) {
            echo "<pre><b style='color: red'>Fatal Error:</b> " . $status . "</pre>";
            die;
        }
    }

    private function checkUnused() {
        foreach ($this->vars as $key => $val) {
            if (strpos($this->map_data, $key) === false) {
                $this->unused[] = $key;
            }
        }
        if (count($this->unused) != 0) {
            $this->setStatus("Unused variables were detected.", false);
        }
    }

    public function getStatus() {
        return $this->status;
    }

    public function getID() {
        return $this->id;
    }

    public function getBoundaries() {
        return $this->boundaries;
    }

    public function getWalkables() {
        return $this->walkables;
    }

    private function flipHorizontal(&$img) {
        $size_x = imagesx($img); $size_y = imagesy($img);
        $temp = imagecreatetruecolor($size_x, $size_y);
        imagealphablending($temp, false);
        imagesavealpha($temp, true);
        $x = imagecopyresampled($temp, $img, 0, 0, ($size_x-1), 0, $size_x, $size_y, 0-$size_x, $size_y);
        if ($x) {
            $img = $temp;
        } else {
            die("Unable to flip image");
        }
    }

    private function goodImageCrop($src, array $rect) {
        $dest = imagecreatetruecolor($rect['width'], $rect['height']);
        imagealphablending($dest, false);
        imagesavealpha($dest, true);
        imagecopyresampled(
            $dest,
            $src,
            0,
            0,
            $rect['x'],
            $rect['y'],
            $rect['width'],
            $rect['height'],
            $rect['width'],
            $rect['height']
        );
    return $dest;
    }
}
?>

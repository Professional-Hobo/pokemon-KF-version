<?php
require_once("Tile.class.php");
class Map
{
    const DEBUG = true;
    const TILES = "img/tiles.png";

    private $src;
    private $raw_data;
    private $map;
    private $id;
    private $vars;
    private $var_lines = 0;
    private $map_data;
    private $map_lines = 0;
    private $status = null;
    private $boundaries = array();

    public function Map($src) {
        $this->src = $src;
        $this->loadContent();
        $this->extractVars();
        $this->extractTiles();
    }

    private function loadContent() {
        $this->raw_data = file_get_contents($this->src);
    }

    private function extractVars() {
        // Seperate src into lines
        $ex = explode("\n", $this->raw_data);
        $hasVars = false;

        // Go through each line
        foreach ($ex as $line) {
            $this->var_lines++;
            // Remove whitespace
            $line = trim($line);
            if (strlen($line) == 0) {
                continue;
            }

            // Check if vars section is detected on the current line or else skip
            if (!$hasVars && $line != "@vars") {
                continue;
            } else {
                if (!$hasVars) {
                    $hasVars = true;
                    continue;
                } else {
                    if ($line == "!vars") {
                        break;
                    }
                }
            }
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
                    if ($constant === null) {
                        $this->setStatus("Invalid tile name <b>" . $v . "</b>.");
                    }
                }
                $this->vars[$sep[0]] = $sep[1];
                continue;
            }
            $constant = @constant("Tile::" . $sep[1]);
            if ($constant === null) {
                $this->setStatus("Invalid tile name <b>" . $sep[1] . "</b>.");
            } else {
                $this->vars[$sep[0]] = $sep[1];
            }
        }
        if (!$hasVars) {
            $this->setStatus("Failed to detect variable definitions.");
        }
    }

    private function extractTiles() {
        $this->map_lines++;
        // Seperate src into lines
        $ex = explode("\n", $this->raw_data);
        $hasMap = false;
        $endVars = false;

        // Go through each line
        foreach ($ex as $line) {
            // Remove whitespace
            $line = trim($line);

            if (!$endVars && $line != "!vars") {
                continue;
            } else {
                if (!$endVars) {
                    $endVars = true;
                    continue;
                }
            }
            $hasMap = true;
            if (strlen($line) != 0) {
                $this->map_data .= $line . "\n";
            }
        }
        if (!$hasMap) {
            $this->setStatus("Failed to detect map data.");
        }
    }

    public function genImage($save = false) {
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
                    $this->setStatus("Map tile <b>" . $lines[$a][$b] . "</b> was not found in the vars definition section.");
                }

                // If fgbg tile (transparencies) else normal tile
                if (strpos($this->vars[$lines[$a][$b]], "^") !== false) {
                    $fgbg = explode("^", $this->vars[$lines[$a][$b]]);
                    $bg = new Tile($fgbg[0]);
                    $fg = new Tile($fgbg[1]);

                    // Apply background first
                    imagecopyresampled($this->map, $tiles, $b*16, $a*16, $bg->getCoords()[0]*16, $bg->getCoords()[1]*16, 16, 16, 16, 16);

                    // And then foreground
                    imagecopyresampled($this->map, $tiles, $b*16, $a*16, $fg->getCoords()[0]*16, $fg->getCoords()[1]*16, 16, 16, 16, 16);

                    // If foreground has boundary, add to boundary list
                    if ($fg->hasBoundary()) {
                        $this->boundaries[] = array("x" => $b*16, "y" => $a*16);
                    }

                } else {
                    // Apply tile
                    $tile = new Tile($this->vars[$lines[$a][$b]]);
                    imagecopyresampled($this->map, $tiles, $b*16, $a*16, $tile->getCoords()[0]*16, $tile->getCoords()[1]*16, 16, 16, 16, 16);

                    // If tile has boundary, add to boundary list
                    if ($tile->hasBoundary()) {
                        $this->boundaries[] = array("x" => $b*16, "y" => $a*16);
                    }

                }
            }
        }
        if ($save) {
            // Save map
            $this->id = substr(md5(mt_rand(1,1000000)), 0, 16);
            imagepng($this->map, "img/maps/" . $this->id . ".png");

            // Save boundaries
            file_put_contents("boundaries/" . $this->id . ".json", json_encode($this->getBoundaries()));

            // Save warps
        } else {
            header('Content-Type: image/png');
            imagepng($this->map);
        }
    }

    private function setStatus($status) {
        $this->status = $status;
        if (Map::DEBUG) {
            echo "<pre><b style='color: red'>Fatal Error:</b> " . $status . "</pre>";
            die;
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
}
?>

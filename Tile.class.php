<?php
const ID = "id";
const BND = "boundary";

class Tile
{
    const
    // Grass
    GRASS_1           = array(ID => 0x0000, BND => 0x0),
    GRASS_2           = array(ID => 0x0001, BND => 0x0),
    GRASS_3           = array(ID => 0x0002, BND => 0x0),
    GRASS_4           = array(ID => 0x0003, BND => 0x0),

    // Trees
    TREE_TOP_L_BG     = array(ID => 0x0004, BND => 0x1),
    TREE_TOP_R_BG     = array(ID => 0x0005, BND => 0x1),
    TREE_MID_L_BG     = array(ID => 0x000C, BND => 0x1),
    TREE_MID_R_BG     = array(ID => 0x000D, BND => 0x1),
    TREE_BOT_L_BG     = array(ID => 0x0014, BND => 0x1),
    TREE_BOT_R_BG     = array(ID => 0x0015, BND => 0x1),
    TREE_TOP_L_NBG    = array(ID => 0x0006, BND => 0x1),
    TREE_TOP_R_NBG    = array(ID => 0x0007, BND => 0x1),
    TREE_MID_L_NBG    = array(ID => 0x000E, BND => 0x1),
    TREE_MID_R_NBG    = array(ID => 0x000F, BND => 0x1),
    TREE_BOT_L_NBG    = array(ID => 0x0016, BND => 0x1),
    TREE_BOT_R_NBG    = array(ID => 0x0017, BND => 0x1),
    CUT_TREE          = array(ID => 0x0009, BND => 0x1),

    // Wild Pokemon Grass
    WILD_GRASS        = array(ID => 0x0008, BND => 0x0),

    // Bush and rock
    BUSH              = array(ID => 0x000A, BND => 0x1),
    ROCK              = array(ID => 0x000B, BND => 0x1),

    // Path
    SAND_PATH_TOP_L   = array(ID => 0x0010, BND => 0x0),
    SAND_PATH_TOP_M   = array(ID => 0x0011, BND => 0x0),
    SAND_PATH_TOP_R   = array(ID => 0x0012, BND => 0x0),
    SAND_PATH_MID_L   = array(ID => 0x0018, BND => 0x0),
    SAND_PATH_MID_M   = array(ID => 0x0019, BND => 0x0),
    SAND_PATH_MID_R   = array(ID => 0x001A, BND => 0x0),
    SAND_PATH_BOT_L   = array(ID => 0x0020, BND => 0x0),
    SAND_PATH_BOT_M   = array(ID => 0x0021, BND => 0x0),
    SAND_PATH_BOT_R   = array(ID => 0x0022, BND => 0x0),
    SAND_PATH_TL_CRNR = array(ID => 0x0023, BND => 0x0),
    SAND_PATH_TR_CRNR = array(ID => 0x0024, BND => 0x0),
    SAND_PATH_BL_CRNR = array(ID => 0x002B, BND => 0x0),
    SAND_PATH_BR_CRNR = array(ID => 0x002C, BND => 0x0),

    STON_PATH_TOP_L   = array(ID => 0x0028, BND => 0x0),
    STON_PATH_TOP_M   = array(ID => 0x0029, BND => 0x0),
    STON_PATH_TOP_R   = array(ID => 0x002A, BND => 0x0),
    STON_PATH_MID_L   = array(ID => 0x0030, BND => 0x0),
    STON_PATH_MID_M   = array(ID => 0x0031, BND => 0x0),
    STON_PATH_MID_R   = array(ID => 0x0032, BND => 0x0),
    STON_PATH_BOT_L   = array(ID => 0x0038, BND => 0x0),
    STON_PATH_BOT_M   = array(ID => 0x0039, BND => 0x0),
    STON_PATH_BOT_R   = array(ID => 0x003A, BND => 0x0),
    STON_PATH_TL_CRNR = array(ID => 0x0033, BND => 0x0),
    STON_PATH_TR_CRNR = array(ID => 0x0034, BND => 0x0),
    STON_PATH_BL_CRNR = array(ID => 0x003B, BND => 0x0),
    STON_PATH_BR_CRNR = array(ID => 0x003C, BND => 0x0),

    // Boulder
    STR_BOULDER       = array(ID => 0x0013, BND => 0x1),

    // Rock Smash
    SMASH_ROCK        = array(ID => 0x001B, BND => 0x1),

    // Sign
    WOODEN_SIGN       = array(ID => 0x001C, BND => 0x1),
    METAL_SIGN        = array(ID => 0x001F, BND => 0x1),

    // Pokeball
    POKEBALL          = array(ID => 0x001D, BND => 0x1),

    // Buildings
    // Pokecenter
    POKECENTER_1      = array(ID => 0x0168, BND => 0x1),
    POKECENTER_2      = array(ID => 0x0169, BND => 0x1),
    POKECENTER_3      = array(ID => 0x016A, BND => 0x1),
    POKECENTER_4      = array(ID => 0x016B, BND => 0x1),
    POKECENTER_5      = array(ID => 0x016C, BND => 0x1),
    POKECENTER_6      = array(ID => 0x0170, BND => 0x1),
    POKECENTER_7      = array(ID => 0x0171, BND => 0x1),
    POKECENTER_8      = array(ID => 0x0172, BND => 0x1),
    POKECENTER_9      = array(ID => 0x0173, BND => 0x1),
    POKECENTER_10     = array(ID => 0x0174, BND => 0x1),
    POKECENTER_11     = array(ID => 0x0178, BND => 0x1),
    POKECENTER_12     = array(ID => 0x0179, BND => 0x1),
    POKECENTER_13     = array(ID => 0x017A, BND => 0x1),
    POKECENTER_14     = array(ID => 0x017B, BND => 0x1),
    POKECENTER_15     = array(ID => 0x017C, BND => 0x1),
    POKECENTER_16     = array(ID => 0x0180, BND => 0x1),
    POKECENTER_17     = array(ID => 0x0181, BND => 0x1),
    POKECENTER_18     = array(ID => 0x0182, BND => 0x1),
    POKECENTER_19     = array(ID => 0x0183, BND => 0x1),
    POKECENTER_20     = array(ID => 0x0184, BND => 0x1),
    POKECENTER_21     = array(ID => 0x0188, BND => 0x1),
    POKECENTER_22     = array(ID => 0x0189, BND => 0x1),
    POKECENTER_23     = array(ID => 0x018A, BND => 0x1),
    POKECENTER_24     = array(ID => 0x018B, BND => 0x1),
    POKECENTER_25     = array(ID => 0x018C, BND => 0x1);

    private $type;
    private $coords;
    private $boundary;

    public function Tile($type) {
        $this->type = $type;
        $this->getTile();
    }

    private function getTile() {
        $tile = constant("Tile::" . $this->type);
        $pos = $tile[ID];
        $bnd = $tile[BND];
        $x = $pos%8;
        $y = floor($pos/8);
        $this->coords = array($x, $y);

        // Check if tile has boundary
        if ($bnd) {
            $this->boundary = true;
        } else {
            $this->boundary = false;
        }
    }

    public function getCoords() {
        return $this->coords;
    }

    public static function getTileImage($tile, $bg = null, $return = true) {
        $tileset = imagecreatefrompng("img/tiles.png");

        $x = $tile%8;
        $y = floor($tile/8);

        $bg_x = $bg%8;
        $bg_y = floor($bg/8);

        $img = imagecreatetruecolor(16, 16);
        imagealphablending($img, true);
        imagesavealpha($img, true);

        // Background
        if ($bg !== null) {
            imagecopyresampled($img, $tileset, 0, 0, $bg_x*16, $bg_y*16, 16, 16, 16, 16);
        }
        imagecopyresampled($img, $tileset, 0, 0, $x*16, $y*16, 16, 16, 16, 16);
        if ($return) {
            ob_start();
        } else {
            header('Content-Type: image/png');
        }
        imagepng($img);
        if ($return) {
            return ob_get_clean();
        }
    }

    public function hasBoundary() {
        if ($this->boundary) {
            return true;
        }
        return false;
    }
}

?>
<?php
class Tile
{
    const
    // Grass
    GRASS_1           = 0x0000,
    GRASS_2           = 0x0001,
    GRASS_3           = 0x0002,
    GRASS_4           = 0x0003,

    // Trees
    TREE_TOP_L_BG     = 0x0004,
    TREE_TOP_R_BG     = 0x0005,
    TREE_MID_L_BG     = 0x000C,
    TREE_MID_R_BG     = 0x000D,
    TREE_BOT_L_BG     = 0x0014,
    TREE_BOT_R_BG     = 0x0015,
    TREE_TOP_L_NBG    = 0x0006,
    TREE_TOP_R_NBG    = 0x0007,
    TREE_MID_L_NBG    = 0x000E,
    TREE_MID_R_NBG    = 0x000F,
    TREE_BOT_L_NBG    = 0x0016,
    TREE_BOT_R_NBG    = 0x0017,
    CUT_TREE          = 0x0009,

    // Wild Pokemon Grass
    WILD_GRASS        = 0x0008,

    // Bush and rock
    BUSH              = 0x000A,
    ROCK              = 0x000B,

    // Path
    SAND_PATH_TOP_L   = 0x0010,
    SAND_PATH_TOP_M   = 0x0011,
    SAND_PATH_TOP_R   = 0x0012,
    SAND_PATH_MID_L   = 0x0018,
    SAND_PATH_MID_M   = 0x0019,
    SAND_PATH_MID_R   = 0x001A,
    SAND_PATH_BOT_L   = 0x0020,
    SAND_PATH_BOT_M   = 0x0021,
    SAND_PATH_BOT_R   = 0x0022,
    SAND_PATH_TL_CRNR = 0x0023,
    SAND_PATH_TR_CRNR = 0x0024,
    SAND_PATH_BL_CRNR = 0x002B,
    SAND_PATH_BR_CRNR = 0x002C,

    STON_PATH_TOP_L   = 0x0028,
    STON_PATH_TOP_M   = 0x0029,
    STON_PATH_TOP_R   = 0x002A,
    STON_PATH_MID_L   = 0x0030,
    STON_PATH_MID_M   = 0x0031,
    STON_PATH_MID_R   = 0x0032,
    STON_PATH_BOT_L   = 0x0038,
    STON_PATH_BOT_M   = 0x0039,
    STON_PATH_BOT_R   = 0x003A,
    STON_PATH_TL_CRNR = 0x0033,
    STON_PATH_TR_CRNR = 0x0034,
    STON_PATH_BL_CRNR = 0x003B,
    STON_PATH_BR_CRNR = 0x003C,

    // Boulder
    STR_BOULDER       = 0x0013,

    // Rock Smash
    SMASH_ROCK        = 0x001B,

    // Sign
    WOODEN_SIGN       = 0x001C,
    METAL_SIGN        = 0x001F,

    // Pokeball
    POKEBALL          = 0x001D;

    private $type;
    private $x = 0;
    private $y = 0;
    private $coords;

    public function Tile($type) {
        $this->type = $type;
        $this->getTile();
    }

    private function getTile() {
        $pos = constant("Tile::" . $this->type);
        $x = $pos%8;
        $y = floor($pos/8);
        $this->coords = array($x, $y);
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
}

?>
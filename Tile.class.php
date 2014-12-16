<?php
const ID = "id";
const BND = "boundary";
const FLP = "flip";
const WLK = "walkable";

class Tile
{
    const
    ERROR             = array(ID => 0x0000, BND => 0x0),

    // Grass
    GRASS_1           = array(ID => 0x0000, BND => 0x0),
    GRASS_2           = array(ID => 0x0001, BND => 0x0),
    GRASS_3           = array(ID => 0x0002, BND => 0x0),
    GRASS_4           = array(ID => 0x0003, BND => 0x0),
    GRASS_5           = array(ID => 0x0BD9, BND => 0x0),

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

    TREE_2_TOP_L_NBG  = array(ID => 0x1006, BND => 0x1),
    TREE_2_TOP_R_NBG  = array(ID => 0x1007, BND => 0x1),

    TREE_2_TOP_L_BG   = array(ID => 0x1044, BND => 0x0, WLK => 0x1),
    TREE_2_TOP_R_BG   = array(ID => 0x1045, BND => 0x0, WLK => 0x1),

    TREE_2_MID_L_NBG  = array(ID => 0x100E, BND => 0x1),
    TREE_2_MID_R_NBG  = array(ID => 0x100F, BND => 0x1),

    TREE_2_BOT_L_NBG  = array(ID => 0x1016, BND => 0x1),
    TREE_2_BOT_R_NBG  = array(ID => 0x1017, BND => 0x1),

    CUT_TREE          = array(ID => 0x0009, BND => 0x1),

    // Wild Pokemon Grass
    WILD_GRASS        = array(ID => 0x0008, BND => 0x0),

    // Bush, rock, flower
    BUSH              = array(ID => 0x000A, BND => 0x1),
    ROCK              = array(ID => 0x000B, BND => 0x1),
    FLOWER            = array(ID => 0x0CD7, BND => 0x0),
    SAND_PATCH        = array(ID => 0x0CD6, BND => 0x0),

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
    POKECENTER_1      = array(ID => 0x0168, BND => 0x0, WLK => 0x1),
    POKECENTER_2      = array(ID => 0x0169, BND => 0x0, WLK => 0x1),
    POKECENTER_3      = array(ID => 0x016A, BND => 0x0, WLK => 0x1),
    POKECENTER_4      = array(ID => 0x016B, BND => 0x0, WLK => 0x1),
    POKECENTER_5      = array(ID => 0x016C, BND => 0x0, WLK => 0x1),

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
    POKECENTER_23     = array(ID => 0x018A, BND => 0x0),
    POKECENTER_24     = array(ID => 0x018B, BND => 0x1),
    POKECENTER_25     = array(ID => 0x018C, BND => 0x1),

    // OAK LAB
    OAKLAB_1          = array(ID => 0x1288, BND => 0x0, WLK => 0x1),
    OAKLAB_2          = array(ID => 0x1289, BND => 0x0, WLK => 0x1),
    OAKLAB_3          = array(ID => 0x128A, BND => 0x0, WLK => 0x1),
    OAKLAB_4          = array(ID => 0x128B, BND => 0x0, WLK => 0x1),
    OAKLAB_5          = array(ID => 0x128C, BND => 0x0, WLK => 0x1),
    OAKLAB_6          = array(ID => 0x128D, BND => 0x0, WLK => 0x1),
    OAKLAB_7          = array(ID => 0x128E, BND => 0x0, WLK => 0x1),

    OAKLAB_8          = array(ID => 0x1290, BND => 0x1),
    OAKLAB_9          = array(ID => 0x1291, BND => 0x1),
    OAKLAB_10         = array(ID => 0x1292, BND => 0x1),
    OAKLAB_11         = array(ID => 0x1293, BND => 0x1),
    OAKLAB_12         = array(ID => 0x1294, BND => 0x1),
    OAKLAB_13         = array(ID => 0x1295, BND => 0x1),
    OAKLAB_14         = array(ID => 0x1296, BND => 0x1),

    OAKLAB_15         = array(ID => 0x1298, BND => 0x1),
    OAKLAB_16         = array(ID => 0x1299, BND => 0x1),
    OAKLAB_17         = array(ID => 0x129A, BND => 0x1),
    OAKLAB_18         = array(ID => 0x129B, BND => 0x1),
    OAKLAB_19         = array(ID => 0x129C, BND => 0x1),
    OAKLAB_20         = array(ID => 0x129D, BND => 0x1),
    OAKLAB_21         = array(ID => 0x129E, BND => 0x1),

    OAKLAB_22         = array(ID => 0x12A0, BND => 0x1),
    OAKLAB_23         = array(ID => 0x12A1, BND => 0x1),
    OAKLAB_24         = array(ID => 0x12A2, BND => 0x1),
    OAKLAB_25         = array(ID => 0x12A3, BND => 0x1),
    OAKLAB_26         = array(ID => 0x12A4, BND => 0x1),
    OAKLAB_27         = array(ID => 0x12A5, BND => 0x1),
    OAKLAB_28         = array(ID => 0x12A6, BND => 0x1),

    OAKLAB_29         = array(ID => 0x12A8, BND => 0x1),
    OAKLAB_30         = array(ID => 0x12A9, BND => 0x1),
    OAKLAB_31         = array(ID => 0x12AA, BND => 0x1),
    OAKLAB_32         = array(ID => 0x12AB, BND => 0x1),
    OAKLAB_33         = array(ID => 0x12AC, BND => 0x0),
    OAKLAB_34         = array(ID => 0x12AD, BND => 0x1),
    OAKLAB_35         = array(ID => 0x12AE, BND => 0x1),

    // Player House
    PLAYER_HOUSE_1    = array(ID => 0x1260, BND => 0x0, WLK => 0x1),
    PLAYER_HOUSE_2    = array(ID => 0x1261, BND => 0x0, WLK => 0x1),
    PLAYER_HOUSE_3    = array(ID => 0x1262, BND => 0x0, WLK => 0x1),
    PLAYER_HOUSE_4    = array(ID => 0x1263, BND => 0x0, WLK => 0x1),
    PLAYER_HOUSE_5    = array(ID => 0x1264, BND => 0x0, WLK => 0x1),

    PLAYER_HOUSE_6    = array(ID => 0x1268, BND => 0x1),
    PLAYER_HOUSE_7    = array(ID => 0x1269, BND => 0x1),
    PLAYER_HOUSE_8    = array(ID => 0x126A, BND => 0x1),
    PLAYER_HOUSE_9    = array(ID => 0x126B, BND => 0x1),
    PLAYER_HOUSE_10   = array(ID => 0x126C, BND => 0x1),

    PLAYER_HOUSE_11   = array(ID => 0x1270, BND => 0x1),
    PLAYER_HOUSE_12   = array(ID => 0x1271, BND => 0x1),
    PLAYER_HOUSE_13   = array(ID => 0x1272, BND => 0x1),
    PLAYER_HOUSE_14   = array(ID => 0x1273, BND => 0x1),
    PLAYER_HOUSE_15   = array(ID => 0x1274, BND => 0x1),

    PLAYER_HOUSE_16   = array(ID => 0x1278, BND => 0x1),
    PLAYER_HOUSE_17   = array(ID => 0x1279, BND => 0x1),
    PLAYER_HOUSE_18   = array(ID => 0x127A, BND => 0x1),
    PLAYER_HOUSE_19   = array(ID => 0x127B, BND => 0x1),
    PLAYER_HOUSE_20   = array(ID => 0x127C, BND => 0x1),

    PLAYER_HOUSE_21   = array(ID => 0x1280, BND => 0x1),
    PLAYER_HOUSE_22   = array(ID => 0x1281, BND => 0x1),
    PLAYER_HOUSE_23   = array(ID => 0x1282, BND => 0x1),
    PLAYER_HOUSE_24   = array(ID => 0x1283, BND => 0x0),
    PLAYER_HOUSE_25   = array(ID => 0x1284, BND => 0x1),

    // Rival House
    RIVAL_HOUSE_1    = array(ID => 0x1260, BND => 0x0, WLK => 0x1),
    RIVAL_HOUSE_2    = array(ID => 0x1261, BND => 0x0, WLK => 0x1),
    RIVAL_HOUSE_3    = array(ID => 0x1262, BND => 0x0, WLK => 0x1),
    RIVAL_HOUSE_4    = array(ID => 0x1263, BND => 0x0, WLK => 0x1),
    RIVAL_HOUSE_5    = array(ID => 0x1264, BND => 0x0, WLK => 0x1),

    RIVAL_HOUSE_6    = array(ID => 0x1268, BND => 0x1),
    RIVAL_HOUSE_7    = array(ID => 0x1269, BND => 0x1),
    RIVAL_HOUSE_8    = array(ID => 0x126A, BND => 0x1),
    RIVAL_HOUSE_9    = array(ID => 0x126B, BND => 0x1),
    RIVAL_HOUSE_10   = array(ID => 0x126C, BND => 0x1),

    RIVAL_HOUSE_11   = array(ID => 0x1270, BND => 0x1),
    RIVAL_HOUSE_12   = array(ID => 0x1271, BND => 0x1),
    RIVAL_HOUSE_13   = array(ID => 0x1272, BND => 0x1),
    RIVAL_HOUSE_14   = array(ID => 0x1273, BND => 0x1),
    RIVAL_HOUSE_15   = array(ID => 0x1274, BND => 0x1),

    RIVAL_HOUSE_16   = array(ID => 0x127C, BND => 0x1, FLP => 0x1),
    RIVAL_HOUSE_17   = array(ID => 0x127B, BND => 0x1, FLP => 0x1),
    RIVAL_HOUSE_18   = array(ID => 0x127A, BND => 0x1, FLP => 0x1),
    RIVAL_HOUSE_19   = array(ID => 0x1279, BND => 0x1, FLP => 0x1),
    RIVAL_HOUSE_20   = array(ID => 0x1278, BND => 0x1, FLP => 0x1),

    RIVAL_HOUSE_21   = array(ID => 0x1284, BND => 0x1, FLP => 0x1),
    RIVAL_HOUSE_22   = array(ID => 0x1283, BND => 0x0, FLP => 0x0),
    RIVAL_HOUSE_23   = array(ID => 0x1282, BND => 0x1, FLP => 0x1),
    RIVAL_HOUSE_24   = array(ID => 0x1281, BND => 0x1, FLP => 0x1),
    RIVAL_HOUSE_25   = array(ID => 0x1280, BND => 0x1, FLP => 0x1);

    private $type;
    private $coords;
    private $boundary;
    private $flip;
    private $walk;

    public function Tile($type) {
        $this->type = $type;
        $this->getTile();
    }

    private function getTile() {
        if ($this->type == null) {
            $this->type = ERROR;
        }
        $tile = constant("Tile::" . $this->type);
        $pos = $tile[ID];
        $bnd = $tile[BND];
        $flp = $tile[FLP];
        $wlk = $tile[WLK];
        $x = $pos%8;
        $y = floor($pos/8);
        $this->coords = array($x, $y);

        // Check if tile has boundary
        if ($bnd) {
            $this->boundary = true;
        } else {
            $this->boundary = false;
        }

        if ($flp) {
            $this->flip = true;
        } else {
            $this->flip = false;
        }

        if ($wlk) {
            $this->walk = true;
        } else {
            $this->walk = false;
        }
    }

    public function getCoords() {
        return $this->coords;
    }

    public static function getTileImage($tile, $bg = null, $return = true) {
        $tileset = imagecreatefrompng("img/tiles.png");
        $pos = $tile[ID];
        $x = $pos%8;
        $y = floor($pos/8);

        $bg_x = $bg%8;
        $bg_y = floor($bg/8);

        $img = imagecreatetruecolor(16, 16);
        if ($bg == null && $tile[WLK] == 0x1) {
            imagealphablending($img, false);
        } else {
            imagealphablending($img, true);
        }
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

    public function hasFlip() {
        if ($this->flip) {
            return true;
        }
        return false;
    }

    public function hasWalk() {
        if ($this->walk) {
            return true;
        }
        return false;
    }

    public function getType() {
        return $this->type;
    }
}

?>
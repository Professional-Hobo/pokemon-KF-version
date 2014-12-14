<?php
require_once("Map.class.php");

// Using map src code to generate the map
$map = new Map("maps/path.map");
$map->genImage();
die;
function img($tile, $bg = null) {
    return "<img src=\"data:image/png;base64," . base64_encode(Tile::getTileImage($tile, $bg)) . "\">";
}
?>
<!-- This is the old awful way without the map src code -->
<?=img(Tile::SAND_PATH_TOP_L)?><?=img(Tile::SAND_PATH_TOP_M)?><?=img(Tile::SAND_PATH_TOP_R)?><?=str_repeat(img(Tile::WILD_GRASS), 10)?><br>
<?=img(Tile::SAND_PATH_MID_L)?><?=img(Tile::SAND_PATH_MID_M)?><?=img(Tile::SAND_PATH_MID_R)?><?=str_repeat(img(Tile::WILD_GRASS), 10)?><br>
<?=img(Tile::SAND_PATH_MID_L)?><?=img(Tile::SAND_PATH_MID_M)?><?=img(Tile::SAND_PATH_MID_R)?><?=str_repeat(img(Tile::WILD_GRASS), 2)?><?=img(Tile::ROCK, Tile::GRASS_1)?><?=str_repeat(img(Tile::WILD_GRASS), 7)?><br>
<?=img(Tile::SAND_PATH_MID_L)?><?=img(Tile::SAND_PATH_MID_M)?><?=img(Tile::SAND_PATH_MID_R)?><?=str_repeat(img(Tile::WILD_GRASS), 10)?><br>
<?=img(Tile::SAND_PATH_MID_L)?><?=img(Tile::SAND_PATH_MID_M)?><?=img(Tile::SAND_PATH_MID_R)?><?=str_repeat(img(Tile::WILD_GRASS), 6)?><?=img(Tile::ROCK, Tile::GRASS_1)?><?=str_repeat(img(Tile::WILD_GRASS), 3)?><br>
<?=img(Tile::SAND_PATH_MID_L)?><?=img(Tile::SAND_PATH_MID_M)?><?=img(Tile::SAND_PATH_MID_R)?><?=str_repeat(img(Tile::WILD_GRASS), 10)?><br>
<?=img(Tile::SAND_PATH_MID_L)?><?=img(Tile::SAND_PATH_MID_M)?><?=img(Tile::SAND_PATH_MID_R)?><?=str_repeat(img(Tile::WILD_GRASS), 10)?><br>
<?=img(Tile::SAND_PATH_MID_L)?><?=img(Tile::SAND_PATH_MID_M)?><?=img(Tile::SAND_PATH_MID_R)?><?=str_repeat(img(Tile::WILD_GRASS), 10)?><br>
<?=img(Tile::SAND_PATH_MID_L)?><?=img(Tile::SAND_PATH_MID_M)?><?=img(Tile::SAND_PATH_TR_CRNR)?><?=str_repeat(img(Tile::SAND_PATH_TOP_M), 9)?><?=img(Tile::SAND_PATH_TOP_R)?><br>
<?=img(Tile::SAND_PATH_MID_L)?><?=img(Tile::SAND_PATH_MID_M)?><?=img(Tile::SAND_PATH_MID_M)?><?=str_repeat(img(Tile::SAND_PATH_MID_M), 9)?><?=img(Tile::SAND_PATH_MID_R)?><br>
<?=img(Tile::SAND_PATH_BOT_L)?><?=img(Tile::SAND_PATH_BOT_M)?><?=img(Tile::SAND_PATH_BOT_M)?><?=str_repeat(img(Tile::SAND_PATH_BOT_M), 7)?><?=img(Tile::SAND_PATH_BL_CRNR)?><?=img(Tile::SAND_PATH_MID_M)?><?=img(Tile::SAND_PATH_MID_R)?><br>
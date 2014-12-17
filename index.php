<?php
require_once("Map.class.php");
// Using map src code to generate the map
$map = new Map("map_source/littleroot.map");
//$map->genImage(true);
$id = "littleroot";
$direction = "down";
$loc = array(6, 10);
$x = ($loc[0]-1)*16;
$y = ($loc[1]-1)*16-6;
$image = getimagesize("data/img/" . $id . ".png");

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pokemon KF Version</title>
        <link id="walkables_css" rel="stylesheet" type="text/css" href="data/walkables/<?=$id?>.css">
        <link id="walkables_css" rel="stylesheet" type="text/css" href="css/msg.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="js/preload.js"></script>
        <script src="js/text.js"></script>
    </head>
    <body>
        <id hidden><?=$id?></id>
        <div style="position: relative; left: 0; top: 0; width: <?=$image[0]?>px; height: <?=$image[1]?>px;">
            <img id="map" src="data/img/<?=$id?>.png" style="position: relative; top: 0; left: 0; z-index:1">
            <img id="trainer" src="img/sprites/trainer_<?=$direction?>_1.png" style="position: absolute; left:<?=$x?>px; top: <?=$y?>px; z-index:2">
            <div id="msg_top">
                <span id="msg_top_text"></span>
            </div>
            <div id="msg_bottom">
                <span id="msg_bottom_text"></span>
            </div>
        </div>
        <div id="walkables">
            <?=file_get_contents("data/walkables/" . $id . ".html")?>
        </div>
        <script src="js/buzz.min.js"></script>
        <script src="js/music.js"></script>
        <script src="js/navigation.js"></script>
        <script src="js/save.js"></script>
        <script src="js/events.js"></script>
    </body>
</html>
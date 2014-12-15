<?php
require_once("Map.class.php");
// Using map src code to generate the map
$map = new Map("maps/littleroot.map");
$map->genImage(true);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pokemon KF Version</title>
        <link rel="stylesheet" type="text/css" href="walkables/<?=$map->getID()?>.css">
    </head>
    <body>
        <id hidden><?=$map->getID()?></id>
        <div style="position: relative; left: 0; top: 0;">
            <img id="map" src="img/maps/<?=$map->getID()?>.png" style="position: relative; top: 0; left: 0; z-index:1">
            <img id="trainer" src="img/sprites/trainer_front_1.png" style="position: absolute; top: 58px; left:160px; z-index:2">
        </div>
        <?=file_get_contents("walkables/" . $map->getID() . ".html")?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="js/navigation.js"></script>
        <script src="js/music.js"></script>
    </body>
</html>
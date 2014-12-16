<?php
require_once("Map.class.php");
// Using map src code to generate the map
$map = new Map("maps/littleroot.map");
//$map->genImage(true);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pokemon KF Version</title>
        <link id="walkables_css" rel="stylesheet" type="text/css" href="walkables/littleroot.css">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
    </head>
    <body>
        <id hidden>littleroot</id>
        <div style="position: relative; left: 0; top: 0;">
            <img id="map" src="img/maps/littleroot.png" style="position: relative; top: 0; left: 0; z-index:1">
            <img id="trainer" src="img/sprites/trainer_front_1.png" style="position: absolute; left:80px; top: 138px; z-index:2">
        </div>
        <div id="walkables">
            <?=file_get_contents("walkables/littleroot.html")?>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="js/buzz.min.js"></script>
        <script src="js/music.js"></script>
        <script src="js/navigation.js"></script>
    </body>
</html>
<?php
require_once("Map.class.php");
// Using map src code to generate the map
$map = new Map("map_source/" . $_GET['map'] . ".map");
$map->genImage(true);
if ($map->getStatus() == null) {
    echo "done";
} else {
    echo $map->getStatus();
}
?>
<?php
require_once("Database.class.php");
require_once("global.php");

header("HTTP/1.1 200 OK");
header("access-control-allow-origin: *");
header('content-type: application/json; charset=UTF-8');

$directions = array("up", "right", "down", "left");

$guid = $_GET['guid'];

// Check if user exists
if (Database::doesExist("users", "guid", $guid)) {
    $user = fetchUser($guid);
    $data["exists"] = true;
} else {
    makeUser($guid);
    $user = fetchUser($guid);
    $data["exists"] = false;
}

$data["id"] = $user->id;
$data["guid"] = $user->guid;

$data["map"] = $user->map;
$data["direction"] = $directions[$user->direction];

$data["x"] = ($user->x-1)*16;
$data["y"] = (($user->y-1)*16)-6;

$data["steps"] = $user->steps;

echo json_encode($data);
?>

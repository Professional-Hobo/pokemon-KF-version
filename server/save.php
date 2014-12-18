<?php
require_once("Database.class.php");
require_once("global.php");

$directions = array("up", "right", "down", "left");
$guid = $_GET['guid'];

// Check if user exists
if (Database::doesExist("users", "guid", $guid)) {
    saveUser($_POST, $guid);
} else {
    //makeUser($guid);
    //saveUser($_POST, $guid);
}
?>

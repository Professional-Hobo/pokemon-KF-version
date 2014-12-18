<?php
require_once("Database.class.php");
require_once("global.php");

function fetchUser($guid) {
    $user = Database::doesExist("users", "guid", $guid, true);
    return $user;
}

function makeUser($guid) {
    $db = new Database;
    $statement = $db->con()->prepare("INSERT INTO `users` (`guid`, `ip`) VALUES (?, ?)");
    $statement->execute(array($guid, $_SERVER['REMOTE_ADDR']));
}

function saveUser($post, $guid) {
    $db = new Database;
    $str = "UPDATE `users` SET `map` = ?, `direction` = ?, `x` = ?, `y` = ?, `steps` = ? WHERE `guid` = ?";
    $statement = $db->con()->prepare($str);
    $statement->execute(array($post['map'], (int)$post['direction'], (int)$post['x'], (int)$post['y'], (int)$post['steps'], $guid));
}
?>

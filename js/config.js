var name = "Pokemon KF";
var version = "1.0.0"
var debug = false;
var godmode = false;
var showpos = false;

var GAME = "[Game] ";

logger(" " + name + " version " + version);
logger(" https://github.com/solewolf/pokemon-KF-edition");

function godMode() {
    godmode = !godmode;
}

function showPos() {
    showpos = !showpos;
}

function debugMode() {
    debug = !debug;
    logger(GAME + "debug: " + debug);
}

function logger(text) {
    date = new Date();
    console.log("[" + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds() + "]" + text);
}
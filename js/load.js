// Get IP Address of player and see if they are in the DB
var player_ip;
var data;
$.get("http://ipinfo.io", function(response) {
    player_ip = response.ip
    queryServer();
}, "jsonp");

function queryServer() {
    // Query game server for save data if it exists
    $.getJSON("http://keitharm.me/projects/pokemon/server/loadSave.php?ip=" + player_ip, function(response) {
        data = response;
        loadPlayerData();
    });
}

function loadPlayerData() {
    // Check if new player or not
    if (data.exists == false) {
        logger(" New player from "+ player_ip + ".");
    } else {
        logger(" Loaded saved player data for " + player_ip + ".")
    }

    // Load in map data
    $('head').append(
        $('<link rel="stylesheet" type="text/css" />').attr({
            href: 'data/walkables/' + data.map + '.css',
            id: 'walkables_css'
        })
    );

    // Map ID
    $("id").html(data.map);

    // Load game screen
    imgURL = 'data/img/' + data.map + '.png';
    $('<img src="'+imgURL+'"/>').load(function(){
        $('body').prepend('<div id="game" style="position: relative; left: 0; top: 0; width: ' + this.width + 'px; height: ' + this.height + 'px;">')

        // Load map and player sprite
        $('#game').prepend('<img id="map" src="data/img/' + data.map + '.png" style="position: relative; top: 0; left: 0; z-index:1">')
        $('#game').prepend('<img id="trainer" src="img/sprites/trainer_' + data.direction + '_1.png" style="position: absolute; left: ' + data.x + 'px; top: ' + data.y + 'px; z-index:2">')
        $("#walkables").load("data/walkables/" + data.map + ".html");
    });
}
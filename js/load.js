// Get IP Address of player and see if they are in the DB
var player_ip;
var data;
var guid;
$.get("http://ipinfo.io", function(response) {
    player_ip = response.ip
    queryServer();
}, "jsonp");

function queryServer() {
    // Query game server for save data or create new user if guid not found
    var cookie = $.cookie("guid");

    // If no cookie data, generate guid for user
    if (cookie === undefined) {
        guid = newguid()();
    } else {
        guid = cookie;
    }

    $.getJSON("http://keitharm.me/projects/pokemon/server/loadSave.php?guid=" + guid, function(response) {
        data = response;
        loadPlayerData();
    });
}

function loadPlayerData() {
    // Check if new player or not
    if (data.exists == false) {
        logger(" New player from "+ player_ip + ".");

        // Set GUID cookie
        $.cookie("guid", data.guid, {
            expires : 1337,
        });
    } else {
        logger(" Loaded saved player data for " + player_ip + ".");
    }
    logger(" Your GUID is " + data.guid + ".");

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
        $("#walkables").load("data/walkables/" + data.map + ".html", function() {
            playMusic($("music").html());
        });
        pos = [+$("#trainer").css("left").replace(/[^-\d\.]/g, ''),+$("#trainer").css("top").replace(/[^-\d\.]/g, '')+6];
        tilepos = [(+$("#trainer").css("left").replace(/[^-\d\.]/g, '')+16)/16,(+$("#trainer").css("top").replace(/[^-\d\.]/g, '')+22)/16];
        // Load boundaries and warps initially
        loadBoundaries();
        loadWarps();
        loadEvents();

        $(document).keydown(function(e) {
            // Only move if proper key is used
            if (inArray(e.which, arrows) && !walking && !msgOpen) {
                e.preventDefault();
                // Increase step counter
                steps++;

                // Move in direciton
                move(dirs[e.which]);
            }
        });
        map = document.getElementById('map');
    });
}

function newguid() {
    function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }
    return function() {
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
               s4() + '-' + s4() + s4() + s4();
    };
}
var steps = 0;
var map = document.getElementById('map');
var bump = new buzz.sound('sounds/bump.m4a');
var boundaries;
var warps;
var events;
var pos = [+$("#trainer").css("left").replace(/[^-\d\.]/g, ''),+$("#trainer").css("top").replace(/[^-\d\.]/g, '')+6];
var tilepos = [(+$("#trainer").css("left").replace(/[^-\d\.]/g, '')+16)/16,(+$("#trainer").css("top").replace(/[^-\d\.]/g, '')+22)/16];
var godmode = false;
var showpos = false;
var delay = 125;
var walking = false;
var facing = 2;
var UP = 0
var RIGHT = 1
var DOWN = 2
var LEFT = 3
var directions = ["up", "right", "down", "left"];
var arrows = [38, 39, 40, 37];
var amt = {
    0: {left: 0, top: -16, xtile: 0, ytile: -1},
    1: {left: 16, top: 0, xtile: 1, ytile: 0},
    2: {left: 0, top: 16, xtile: 0, ytile: 1},
    3: {left: -16, top: 0, xtile: -1, ytile: 0}
};
var looking = tilepos;

var dirs = {
    38: 0,
    39: 1,
    40: 2,
    37: 3
};

// Load boundaries and warps initially
loadBoundaries();
loadWarps();
loadEvents();

// Start playing music
playMusic($("music").html());

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

function validMove(direction) {
    var invalidMove = false;
    if (godmode) {
        return true;
    }

    // Check if player is going to hit any of the boundaries
    $.each(boundaries, function(index, value) {
        if (Math.abs(pos[0]+amt[direction].left-value["x"]) < 16 && Math.abs(pos[1]+amt[direction].top-value["y"]) < 16) {
            invalidMove = true;
            return false;
        }
    });

    if (invalidMove) {
        return false;
    } else {
        return true;
    }
}

function updatePos() {
    pos = [+$('#trainer').css("left").replace(/[^-\d\.]/g, ''), +$('#trainer').css("top").replace(/[^-\d\.]/g, '')+6];
    tilepos = [(+$("#trainer").css("left").replace(/[^-\d\.]/g, '')+16)/16,(+$("#trainer").css("top").replace(/[^-\d\.]/g, '')+22)/16];
    looking = [tilepos[0] + amt[facing].xtile, (tilepos[1] + amt[facing].ytile)];
    if (showpos) {
        console.log("X: " + pos[0] + " [" + tilepos[0] + "]\n Y: " + pos[1] + " [" + tilepos[1] + "]\n Direction: " + facing + " [" + directions[facing] + "]\n Facing: [" + looking[0] + ", " + looking[1] + "]");
    }
}

// If player moves into warp spot, load in new data else normal move action
function isWarp(direction) {
    var src_x;
    var src_y;
    var dst_x;
    var dst_y;
    var dst_direction;
    var valid = false;
    $.each(warps, function(index, warp) {
        src_x = +warp.src_coords["x"];
        src_y = +warp.src_coords["y"];

        dst_x = +warp.dst_coords["x"];
        dst_y = +warp.dst_coords["y"];

        dst_direction = warp.dst_direction;

        // Valid warp
        if ((tilepos[0]+amt[direction].xtile == src_x && tilepos[1]+amt[direction].ytile == src_y && (warp.src_direction === false || warp.walkin === true)) || tilepos[0] == src_x && tilepos[1] == src_y && +warp.src_direction === direction && warp.src_direction !== false) {
            walking = true;

            // Update map id
            $('id').html(warp.map);

            // Play warp sound if any
            if (warp.sound !== false) {
                var sound = new buzz.sound('sounds/' + warp.sound + '.m4a');
                sound.play();
            }

            // Show walk animation first and then update
            if (warp.walkin === true && warp.src_direction == direction) {
                $("#trainer").attr('src', 'img/sprites/trainer_' + directions[direction] + '_1.png').promise().done(function() {
                    $( "#trainer" ).animate({
                        left: "+=" + amt[direction].left,
                        top: "+=" + amt[direction].top,
                    }, 300, function() {
                        dostuff(+warp.dst_coords["x"], +warp.dst_coords["y"], function() {
                            // Update tilepos and pos
                            updatePos();

                            // Reload boundaries and warp data
                            loadBoundaries();
                            loadWarps();
                            loadEvents();
                        });
                    });
                });
            } else {
                dostuff(+warp.dst_coords["x"], +warp.dst_coords["y"], function() {
                    // Update tilepos and pos
                    updatePos();

                    // Reload boundaries and warp data
                    loadBoundaries();
                    loadWarps();
                    loadEvents();
                });
            }

            function dostuff(dst_x, dst_y, callback) {
                // Get old music
                var oldMusic = $("music").html();

                // Clear old walkables
                $("#walkables").empty();

                // Update walkables css
                $("#walkables_css").attr('href', 'data/walkables/' + warp.map + '.css');

                // Load in new map
                $("#map").attr('src', 'data/img/' + warp.map + '.png').promise().done(function() {

                    // Make user face proper direction (if any)
                    if (dst_direction !== false) {
                        $("#trainer").attr('src', 'img/sprites/trainer_' + directions[dst_direction] + '_1.png');
                    }

                    // Move player to new location
                    $("#trainer").css("left", (dst_x-1)*16);
                    $("#trainer").css("top", (((dst_y-1)*16)-6));


                    // Load in new walkables
                    $.get("data/walkables/" + warp.map + ".html", function(data) {
                        $("#walkables").html(data).promise().done(function(){

                            // Get new music
                            var newMusic = $("music").html();

                            if (oldMusic != newMusic) {
                                // Fadeout previous song and play new song
                                music.fadeTo(0, 1000, function() {music.stop(); playMusic()});

                            }
                        });
                    });
                });

                // Update player's direction
                facing = direction;

                // Don't move player in direction they were headed since this was a valid warp
                valid = true;

                walking = false;

                // Show walk out animation if set
                if (warp.walkout === true) {
                    $("#trainer").attr('src', 'img/sprites/trainer_' + directions[dst_direction] + '_1.png').promise().done(function() {
                        $( "#trainer" ).animate({
                            left: "+=" + amt[dst_direction].left,
                            top: "+=" + amt[dst_direction].top,
                        }, 300, function() {
                            // Update tilepos and pos
                            updatePos();

                            // Reload boundaries and warp data
                            loadBoundaries();
                            loadWarps();
                            loadEvents();
                        });
                    });
                }
                typeof callback == "function" && callback();
            }
        }
    });
    return valid;
}

// Fetch boundary data
function loadBoundaries() {
    var id = $('id').html();
    $.getJSON("data/boundaries/" + id + ".json", function( data ) {
        boundaries = data;
    });
}

function loadWarps() {
    var id = $('id').html();
    $.getJSON("data/warps/" + id + ".json", function( data ) {
        warps = data;
    });
}

function loadEvents() {
    var id = $('id').html();
    $.getJSON("data/events/" + id + ".json", function( data ) {
        events = data;
    });
}

function inArray(value, array) {
  return array.indexOf(value) > -1;
}

function move(direction) {
    // Check if player is moving towards warp
    if (!isWarp(direction)) {
        // If play isn't currently walking, update sprite animation
        if (!walking) {
            $('#trainer').attr("src", "img/sprites/trainer_" + directions[direction] + "_" + ((steps%3)+1) + ".png");
        }
        // Update direction character is facing
        facing = direction;

        // Check if player is allowed to move in direction
        if (withinBounds(direction) && validMove(direction) && !walking || godmode) {
            walking = true;

            // Animate player walking with delay like ingame
            $( "#trainer" ).animate({
                left: "+=" + amt[direction].left,
                top: "+=" + amt[direction].top,
            }, delay, function() {
                walking = false;
                updatePos();
            });
        } else {
            if (!walking) {
                walking = true;
                $( "#trainer" ).animate({
                    left: "=",
                }, delay, function() {
                    walking = false;
                });
                bump.play();
                updatePos();
            }
        }
    }
}

function withinBounds(direction) {
    if (direction == UP) {
        return +pos[1]-6 > 0;
    } else if (direction == RIGHT) {
        return +pos[0]+16 < map.naturalWidth;
    } else if (direction == DOWN) {
        return +pos[1]+26 < map.naturalHeight;
    } else if (direction == LEFT) {
        return +pos[0]-16 >= 0;
    }
    return false;
}
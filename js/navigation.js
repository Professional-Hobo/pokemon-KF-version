var steps = 0;
var map = document.getElementById('map');
var bump = new Audio('sounds/bump.m4a');
var boundaries;
var warps;
var x, y, xamt, yamt;
var pos = [+$("#trainer").css("left").replace(/[^-\d\.]/g, ''),+$("#trainer").css("top").replace(/[^-\d\.]/g, '')+6];
var tilepos = [(+$("#trainer").css("left").replace(/[^-\d\.]/g, '')+16)/16,(+$("#trainer").css("top").replace(/[^-\d\.]/g, '')+22)/16];
var godmode = false;

// Load boundaries and warps
loadBoundaries();
loadWarps();

// Fetch boundary data
function loadBoundaries() {
    var id = $('id').html();
    $.getJSON("boundaries/" + id + ".json", function( data ) {
        boundaries = data;
    });
}

function loadWarps() {
    var id = $('id').html();
    $.getJSON("warps/" + id + ".json", function( data ) {
        warps = data;
    });
}

$(document).keydown(function(e) {
    if (e.which == 39 || e.which == 37 || e.which == 38 || e.which == 40) {
        e.preventDefault();
    }
    steps++;
    // Right
    if (e.which == 39) {
        $('#trainer').attr("src", "img/sprites/trainer_right_" + ((steps%3)+1) + ".png");
        if (!checkWarps(1)) {
            if (+pos[0]+16 < map.naturalWidth && validMove(1) || godmode) {
                $("#trainer").css("left", "+=16");
                updatePos();
            } else {
                bump.play();
            }
        }
    // Left
    } else if (e.which == 37) {
        $('#trainer').attr("src", "img/sprites/trainer_left_" + ((steps%3)+1) + ".png");
        if (!checkWarps(3)) {
            if (+pos[0]-16 >= 0 && validMove(3) || godmode) {
                $("#trainer").css("left", "-=16");
                updatePos();
            } else {
                bump.play();
            }
        }
    // Down
    } else if (e.which == 40) {
        $('#trainer').attr("src", "img/sprites/trainer_front_" + ((steps%3)+1) + ".png");
        if (!checkWarps(2)) {
            if (+pos[1]+26 < map.naturalHeight && validMove(2) || godmode) {
                $("#trainer").css("top", "+=16");
                updatePos();
            } else {
                bump.play();
            }
        }
    // Up
    } else if (e.which == 38) {
        $('#trainer').attr("src", "img/sprites/trainer_back_" + ((steps%3)+1) + ".png");
        if (!checkWarps(0)) {
            if (+pos[1]-6 > 0 && validMove(0) || godmode) {
                $("#trainer").css("top", "-=16");
                updatePos();
            } else {
                bump.play();
            }
        }
    }
});

function validMove(direction) {
    if (godmode) {
        return true;
    }
    var invalidMove = false;
    // Get the correct x and y coords of player
    x = +pos[0];
    y = +pos[1];

    switch (direction) {
        case 0:
            xamt = 0;
            yamt = -16;
            break;
        case 1:
            xamt = 16;
            yamt = 0;
            break;
        case 2:
            xamt = 0;
            yamt = 16;
            break;
        case 3:
            xamt = -16;
            yamt = 0;
            break;
    }


    // Check if player is going to hit any of the boundaries
    $.each(boundaries, function(index, value) {
        if (Math.abs(pos[0]+xamt-value["x"]) < 16 && Math.abs(pos[1]+yamt-value["y"]) < 16) {
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
}

// If player moves into warp spot, load in new data else normal move action
function checkWarps(direction) {
    switch (direction) {
        case 0:
            xamt = 0;
            yamt = -16;
            xtile = 0;
            ytile = -1;
            break;
        case 1:
            xamt = 16;
            yamt = 0;
            xtile = 1;
            ytile = 0;
            break;
        case 2:
            xamt = 0;
            yamt = 16;
            xtile = 0;
            ytile = 1;
            break;
        case 3:
            xamt = -16;
            yamt = 0;
            xtile = -1;
            ytile = 0;
            break;
    }
    var src_x;
    var src_y;
    var dst_x;
    var dst_y;
    var dst_direction;
    var directions = ["back", "right", "front", "left"];
    var valid = false;
    $.each(warps, function(index, warp) {
        src_x = +warp.src_coords["x"];
        src_y = +warp.src_coords["y"];

        dst_x = +warp.dst_coords["x"];
        dst_y = +warp.dst_coords["y"];

        dst_direction = warp.dst_direction;

        // Move to tile but not require move after in certain direction
        if ((tilepos[0]+xtile == src_x && tilepos[1]+ytile == src_y && warp.src_direction === false) || tilepos[0] == src_x && tilepos[1] == src_y && +warp.src_direction === direction && warp.src_direction !== false) {
            console.log(warp);
            //console.log("Moved to proper tile - warp valid");
            // Update map id
            $('id').html(warp.map);

            // Play warp sound if any
            if (warp.sound !== false) {
                var sound = new Audio('sounds/' + warp.sound + '.m4a');
                sound.play();
            }

            // Reload boundaries and warp data
            loadBoundaries();
            loadWarps();

            // Move player to new location
            $("#trainer").css("left", (dst_x-1)*16);
            $("#trainer").css("top", (((dst_y-1)*16)-6));
            console.log(dst_y);

            // Update tilepos and pos
            updatePos();

            // Clear old walkables
            $("#walkables").empty();

            // Update walkables css
            $("#walkables_css").attr('href', 'walkables/' + warp.map + '.css');

            // Load in new map
            $("#map").attr('src', 'img/maps/' + warp.map + '.png');

            // Load in new walkables
            $.get("walkables/" + warp.map + ".html", function(data) {
                $("#walkables").html(data);
                //console.log("Loaded in new walkables data");
            });

            // Make user face proper direction (if any)
            if (dst_direction !== false) {
                $("#trainer").attr('src', 'img/sprites/trainer_' + directions[dst_direction] + '_1.png');
            }

            // Don't move player in direction they were headed since this was a valid warp
            valid = true;
        }
    });

    return valid;
}
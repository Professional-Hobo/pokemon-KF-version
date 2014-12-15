var steps = 0;
var map = document.getElementById('map');
var bump = new Audio('sounds/bump.m4a');
var id = $('id').html();
var boundaries;
var x, y, xamt, yamt;
var pos = [+$("#trainer").css("left").replace(/[^-\d\.]/g, ''),+$("#trainer").css("top").replace(/[^-\d\.]/g, '')+6];

// Pre load sprite data
var sprite

// Fetch boundary data
$.getJSON("boundaries/" + id + ".json", function( data ) {
    boundaries = data;
});

$(document).keydown(function(e) {
    steps++;
    // Right
    if (e.which == 39) {
        $('#trainer').attr("src", "img/sprites/trainer_right_" + ((steps%3)+1) + ".png");
        if (pos[0]+16 < map.naturalWidth && validMove(1)) {
            $("#trainer").css("left", "+=16");
            e.preventDefault();
            updatePos();
        } else {
            bump.play();
        }
        return false;
    // Left
    } else if (e.which == 37) {
        $('#trainer').attr("src", "img/sprites/trainer_left_" + ((steps%3)+1) + ".png");
        if (+$('#trainer').css("left").replace(/[^-\d\.]/g, '')-16 >= 0 && validMove(3)) {
            $("#trainer").css("left", "-=16");
            e.preventDefault();
            updatePos();
        } else {
            bump.play();
        }
        return false;
    // Down
    } else if (e.which == 40) {
        $('#trainer').attr("src", "img/sprites/trainer_front_" + ((steps%3)+1) + ".png");
        if (+$('#trainer').css("top").replace(/[^-\d\.]/g, '')+32 < map.naturalHeight && validMove(2)) {
            $("#trainer").css("top", "+=16");
            e.preventDefault();
            updatePos();
        } else {
            bump.play();
        }
        return false;
    // Up
    } else if (e.which == 38) {
        $('#trainer').attr("src", "img/sprites/trainer_back_" + ((steps%3)+1) + ".png");
        if (+$('#trainer').css("top").replace(/[^-\d\.]/g, '') > 0 && validMove(0)) {
            $("#trainer").css("top", "-=16");
            e.preventDefault();
            updatePos();
        } else {
            bump.play();
        }
        return false;
    }
});

function validMove(direction) {
    var invalidMove = false;
    // Get the correct x and y coords of player
    x = +$('#trainer').css("left").replace(/[^-\d\.]/g, '');
    y = +$('#trainer').css("top").replace(/[^-\d\.]/g, '')+6;
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
}
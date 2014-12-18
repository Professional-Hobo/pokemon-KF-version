var inEvent = false;
var msgOpen = false;
var msgLocation;
$("body").bind ("keydown", function(event) {
    if (event.keyCode == 13 && !inEvent) {
        checkEvents();
    }
});

function checkEvents() {
    // Check if player is activating an event
    if (msgOpen) {
        $("#msg_"+msgLocation).css("visibility", "hidden");
        msgOpen = false;
    } else {
        $.each(events, function(index, value) {
            if (looking[0] == +value.coords.x && looking[1] == +value.coords.y) {
                if (tilepos[1] > 12) {
                    msgLocation = "top";
                } else {
                    msgLocation = "bottom";
                }
                inEvent = true;
                msgOpen = true;
                if (value.sound != "" && value.sound !== undefined) {
                    music.pause();
                    var sound = new buzz.sound('sounds/' + value.sound + '.m4a');
                    sound.bind('ended', function(e) { // when current file ends
                        music.play(); // trigger the next file to play
                    });
                    if (debug) {
                        logger(GAME + "[" + tilepos + "]" + " playing event sound \"" + value.sound + "\".");
                    }
                    sound.play();
                } else {
                    var beep = new buzz.sound('sounds/beep.m4a');
                    if (debug) {
                        logger(GAME + "[" + tilepos + "]" + " playing default event sound.");
                    }
                    beep.play();
                }
                $("#msg_"+msgLocation).css("visibility", "visible");
                text(value.value, "msg_" + msgLocation + "_text", function() {
                    inEvent = false;
                });
            }
        });
    }
}
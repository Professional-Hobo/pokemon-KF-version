var music;
var song;

function playMusic() {
    song = $("music").html();
    music = new buzz.sound('sounds/music/' + song + '.m4a', {loop: true, volume: 0});
    music.fadeTo(50, 1000);
}
var music = new Audio('sounds/music/littleroot.m4a');
music.addEventListener('ended', function() {
    this.currentTime = 0;
    this.play();
}, false);
music.play();
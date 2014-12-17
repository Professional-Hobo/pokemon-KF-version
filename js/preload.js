function preload(arrayOfImages) {
    $(arrayOfImages).each(function(){
        $('<img/>')[0].src = this;
        // Alternatively you could use:
        // (new Image()).src = this;
    });
}

preload([
    "img/maps/birch_lab.png",
    "img/maps/littleroot.png",
    "img/maps/path.png",
    "img/maps/rival_house_downstairs.png",
    "img/maps/trainer_house_downstairs.png",
    "img/maps/trainer_house_upstairs.png",
    "img/sprites/trainer_up_1.png",
    "img/sprites/trainer_up_2.png",
    "img/sprites/trainer_up_3.png",
    "img/sprites/trainer_right_1.png",
    "img/sprites/trainer_right_2.png",
    "img/sprites/trainer_right_3.png",
    "img/sprites/trainer_down_1.png",
    "img/sprites/trainer_down_2.png",
    "img/sprites/trainer_down_3.png",
    "img/sprites/trainer_left_1.png",
    "img/sprites/trainer_left_2.png",
    "img/sprites/trainer_left_3.png"
]);
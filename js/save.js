$(window).bind('beforeunload', function(){
    $.ajax({
        type: 'POST',
        async: false,
        url: 'http://keitharm.me/projects/pokemon/server/save.php?guid=' + guid,
        data: {
            map: $('id').html(),
            direction: facing,
            x: tilepos[0],
            y: tilepos[1],
            steps: steps
        }
    });
});

function text(text, id, callback) {
    $("#"+id).html("");
    var characters = text.split('');
    i = 0;

    var disloop = setInterval(function() {
        
        var textDone = $('#'+id).html();
        
        
        $('#'+id).html(textDone+characters[i]);
        i++;

        
        if (i == characters.length) {
            clearInterval(disloop);
            callback();
        }
    }, 25);
}
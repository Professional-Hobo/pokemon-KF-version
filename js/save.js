$(window).bind('beforeunload', function(){
    $.post("save.php", { name: "John", time: "2pm" } );
});

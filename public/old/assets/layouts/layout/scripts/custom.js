$('.panel .courses .btn-group-vertical .btn').click(function(){
    $("." + $(this).data('class')).fadeIn().siblings().hide();
});

$('.panel .panel-heading span').click(function(){
        $(this).toggleClass('selected').parent().next().fadeToggle(100);
        if ($(this).hasClass('selected')){
            $(this).html('<i class="fa fa-plus"></i>');
        } else {
            $(this).html('<i class="fa fa-minus"></i>');
        }
    });


$(document).ready(function(){
    var id = [];
    var x = 0;
    $('.inputs').on('click', '.add_button', function(){
        x++;
        console.log(1);
        var content = $('.input-section').html();
        var variable = 38 * x;
        console.log(variable);
        $('#images-contents').append('<div class="input-section'+x+'" id="addinputs">'+content+'</div>');
        $('.input-section'+x+' .inputs').draggable();
        // $('#line_drag').resizable();
        $('.input-section'+x+' .inputs').css('margin-top', ''+variable+'px');
        $('.input-section'+x+' .add_button').replaceWith('<a href="javascript:void(0);" class="remove_button" id="'+x+'"><i class="fa fa-minus-circle"></i></a>');
    });
    // Once remove button is clicked
    $(document).on('click', '.remove_button', function(){
        var id = $(this).attr("id");
        $('.input-section'+id+'').remove();
    });
});
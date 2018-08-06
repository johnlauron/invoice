$(document).ready(function() {
    $('select[name="assign_form"]').on('change', function() {
        var formId = $(this).val();
        console.log(formId);
        if(formId) {
            $.ajax({
                url: '/invoices/ajax/'+formId,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#body-content').empty();
                    $.each(data, function(index, formObject) {
                        $('#body-content').append('<input type="text" style="width:'+ formObject.width +'px; height:'+ formObject.height +'px; left:'+ formObject.xloc +'px; top:'+ formObject.yloc +'px; position:absolute;" disabled>').hide().fadeIn(100);
                        // $('#body-content').append('<input value="'+ key +'">');
                        $('input#form_name').val(formObject.form_name_id);
                    });
                }
            });
        }
        else{
            $('#body-content').empty();
        }
    });
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result).hide().fadeIn(200);
                // .width(150)
                // .height(200);
        };
        reader.readAsDataURL(input.files[0]);
    }
}


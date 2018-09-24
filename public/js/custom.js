$(document).ready(function() {
    //invoice create
    $('.form').append('<select class="form-control" id="assign_form" name="assign_form"><option value="">--- Choose Form ---</option></select>');
    $('select[name="company_id"]').on('change', function() {
        var company_id = $(this).val();
        console.log(company_id);
        if(company_id){
            console.log('nice');
             $.ajax({
                url: '/invoices/company_ajax/'+company_id,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log(data);
                    $('select[name="assign_form"]').empty();
                    $('select[name="assign_form"]').append('<option value="">--- Choose Form ---</option>');
                    $.each(data, function(index, nameObject) {
                        $('select[name="assign_form"]').append('<option value="'+ nameObject.id +'">'+ nameObject.form_name +'</option>');
                    });
                }
            });
        }
        else{
            $('select[name="assign_form"]').empty();
        }
    });
    $('select[name="assign_form"]').on('change', function() {
        var form_id = $(this).val();
        console.log(form_id);
        if(form_id){
            console.log('nice');
             $.ajax({
                url: '/invoices/ajax/'+form_id,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log(data);
                    $('#images-contents').empty();
                    $.each(data, function(index, formObject) {
                        $('#images-contents').append('<input type="text" style="width:'+ formObject.width +'px; height:'+ formObject.height +'px; left:'+ formObject.xloc +'px; top:'+ formObject.yloc +'px; position:absolute;" disabled>').hide().fadeIn(100);
                        // $('#body-content').append('<input value="'+ key +'">');
                        $('input#form_name').val(formObject.form_name_id);
                    });
                }
            });
        }
         else{
            console.log('error');
        }
    });
    //end invoice create
    $('.select-section').append('<select class="form-control" id="search_form" name="search_form" required><option value="">--- Choose Form ---</option></select>');
    $('select[name="search_company"]').on('change', function() {
        var comp_id = $(this).val();
        console.log(comp_id);
        if(comp_id){
            console.log('nice');
             $.ajax({
                url: '/parse/ajax_dropdown/'+comp_id,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log(data);
                    $('select[name="search_form"]').empty();
                    $('select[name="search_form"]').append('<option value="">--- Choose Form ---</option>');
                    $.each(data, function(index, formObject) {
                        $('select[name="search_form"]').append('<option value="'+ formObject.id +'">'+ formObject.form_name +'</option>');
                    });
                }
            });
        }
    });
    $('.remove-record').click(function() {
        console.log('nice');
    });
});

function readURL(input) {
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result).hide().fadeIn(200);
        }

        reader.readAsDataURL(input.files[0]);
    }else{
        console.log(flagsUrl);
         $('#blah').attr('src', flagsUrl);
    }
}

(function() {
      $('#createJson').on('click', function() {
        var all_says = [];
        $('.form-control').each(function(key, value) {
          var text = $(this).find('<input type="value[]">').val();
          // $('select[name="assign_form"]').append('<option value="'+ nameObject.id +'">'+ nameObject.form_name +'</option>');
          // var active = $(this).find('input[type=checkbox]').is(':checked');
          var obj = {
            text: text,
            // active: active
          };
          all_says.push(obj);
        })
        $('#gen').val(JSON.stringify(all_says));
      });
    })();
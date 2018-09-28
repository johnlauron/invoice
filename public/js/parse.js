$(document).ready(function() {
  $( "#submit_parse" ).click(function() {
    $('#parsing').val('');
    var parse =[];
    $('.header-location input, .header-location textarea').each(
      function(index){  
          var input = $(this);
          // parse.push(input.attr('name'));
          // console.log(parse.length);
          var par = '"'+input.attr('name') + '": "' + input.val()+'"';
          // // $('.parsing').append('<textarea name="parsing">'+par+'</textarea>');
          parse.push('\t'+par+'\n');
          
      }
    );
    var parsing =[];
    var parser = [];
    $('.inputs input, .inputs textarea').each(
      function(index){  
          var inputs = $(this);
          // parse.push(input.attr('name'));
          // console.log(parse.length);
          var pars = '"'+inputs.attr('name') + '": "' + inputs.val()+'"';
          parsing.push('\t'+pars+'\n');          
      }
      
    );
    $.fn.appendVal = function( TextToAppend ) {
      return $(this).val(
        $(this).val() + TextToAppend
      );
    };
    $('#parsing').appendVal('Header : \n{\n'+parse+'}\n\n');
    $('#parsing').appendVal('Line-Details : \n{\n'+parsing+'}\n');
  });
});



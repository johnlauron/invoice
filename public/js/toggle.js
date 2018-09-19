
$(document).ready(function(){
    var hasbeenclick = false;
    var beenclick = false;
    $(".toggle").click(function(){
        hasbeenclick = true;
        $("#button-content").slideToggle(300); //slidedown
        $("#second-button-content").slideUp(300);
        if(hasbeenclick){
          $('#second-button-content').find('input:text').val(''); //empty the field the this button click
        }
    });
    $(".second-toggle").click(function(){
        beenclick = true
        $("#second-button-content").slideToggle(300);
        $("#button-content").slideUp(300);
        if(beenclick){
          $('#button-content').find('input:text').val(''); 
        }
    });
    $('#btnLaunch').click(function() {
      $('#custom-width-modal').modal('show');
    });
    var arrayvar = [];
    var x =0;
    $('#btnSave').click(function() {//generating box
      $("#btnLaunch").prop("disabled", true);
        x++;
        var id = x;
        if(!$('.field_name').val()){
          alert("Input the Field Name");
        }else{
          var name = $('.field_name').val();
          if (jQuery.inArray(name, arrayvar)!='-1') {
              alert(name + ' is Existed in field name');
              $("#btnLaunch").removeAttr('disabled');
          } else {
              arrayvar.push(name);
              var field = $('.field_name').val();
              var height = $('.height').val();
              var width = $('.width').val();
              var section = 'header-section';
              var $el = $('<div id="draggable '+x+'" class="draggable" style="cursor: move;position:absolute;top:0;left=0;z-index:2;"><span class="form-control" style="width:'+ width +'px;height:'+ height +'px" name="start">'+field+'</span><a href="#" class="clickedon"><i class="fa fa-check-circle" id="change" style="position: absolute;left: 155px;top:0;color: #1ff3ce;font-size: 15px;"></i></a>');
              window.$el = $el;
              var varwidth;
              var varheight;
              $('.image-contents').append($el);
                //version1
                // $('span').resizable({
                //   resize: function(e, ui) {
                //     // console.log( ui.size.width + 'x' + ui.size.height);
                //     var varwidth = ui.size.width;
                //     var varheight = ui.size.height;
                //     var varhtml   = '<input type="hidden" name="width[]" class="form-control" value="'+varwidth +'"><input type="hidden" name="height[]" class="form-control" value="'+varheight +'">';
                //     window.varhtmls = varhtml;
                //     // return new variable(varhtml);
                //     // window.varheight = varheight;
                //   }
                // });
              $el.draggable({
                stop: function(){
                    // var finalOffset = $(this).offset();
                    // var finalxPos = finalOffset.left;
                    var finalxPos = $(this).position().left;
                    var finalyPos = $(this).position().top;
                    var htmls = '<div class="hidden-inputs '+id+'"><input type="hidden" name="left[]" class="form-control" value="'+finalxPos+'"><input type="hidden" name="top[]" class="form-control" value="'+finalyPos+'"><input type="hidden" name="section[]" class="form-control" value="'+section+'"><input type="hidden" name="width[]" class="form-control" value="'+width +'"><input type="hidden" name="height[]" class="form-control" value="'+height +'"><input type="hidden" name="field[]" class="form-control" value="'+field +'"></div>';
                    // $(".header-section").html(htmls);
                    window.myvar = htmls;
                } 
              });
              
              // var retval = variable();
              // console.log(retval.varhtml);
          }
            //end version1
        $('#custom-width-modal').modal('toggle');
        $('#button-content').find('input:text').val('');
        $('#second-button-content').find('input:text').val('');
      }
    });
    var array = [];
    $(document).on("click",".clickedon", function(){
      $(".fa-check-circle").hide();
      array.push(myvar);
      $("#btnLaunch").removeAttr('disabled');
      $(".hidden-inputs").remove();
      for(var i =0; i < array.length; i++){
        $(".header-section").append(array[i]);
      }  
      // $("#change").addClass("far fa-times-circle").removeClass("fa fa-check-circle")
      // $(".clickedon").prop('id', 'delete');
      $el.draggable({disabled: true});
    });
    // $(document).on("click","#delete", function(){
    //   console.log(1);
    // });
    var line_array =[];
    var a = 0;
    $('#secondbtnSave').click(function() {
      $("#btnLaunch").prop("disabled", true);
      a++;
        var i = a;
        if(!$('.line-field').val()){
          alert("Input the Field Name");
        }else{
          var name = $('.line-field').val();
          if (jQuery.inArray(name, arrayvar)!='-1') {
              alert(name + ' is Existed in field name');
              $("#btnLaunch").removeAttr('disabled');
          } else {
            arrayvar.push(name);
            var field = $('.line-field').val();
            // var box = $('.line-box').val();
            var height = $('.line-height').val();
            var width = $('.line-width').val();
            // var margin = $('.line-margin').val();
            var section = 'linedetails-section';
            var $element = $('<div id="draggable'+i+'" class="draggable" style="cursor: move;position:absolute;top:0;left=0;z-index:2;"><span id="'+i+'" style="width:'+ width +'px;height:'+ height +'px" name="start" class="form-control">'+field+'</span><a href="#" class="clickedons"><i class="fa fa-check-circle" id="changes" style="position: absolute;left: 155px;top:0;color: #1ff3ce;font-size: 15px;"></i></a>');
            window.$element = $element;
            $('.image-contents').append($element);
            $element.draggable({
              stop: function(){
                  var left = $(this).position().left;
                  var top = $(this).position().top;
                  var htmlss = '<div class="hidden-input '+i+'"><input type="hidden" name="left[]" class="form-control" value="'+left+'"><input type="hidden" name="top[]" class="form-control" value="'+top+'"><input type="hidden" name="section[]" value="'+section+'"><input type="hidden" name="width[]" value="'+ width +'"><input type="hidden" name="height[]" value="'+height +'"><input type="hidden" name="field[]" value="'+field +'"></div>';
                  // $(".linedetails-section").html(htmlss);
                  window.myvars = htmlss;
              } 
            });
          }
        $('#custom-width-modal').modal('toggle');
        $('#button-content').find('input:text').val('');
        $('#second-button-content').find('input:text').val('');
        
      }
    });
    var arrays = [];
    $(document).on("click",".clickedons", function(){
      arrays.push(myvars);
      $(".fa-check-circle").hide();
      $("#btnLaunch").removeAttr('disabled');
      $(".hidden-input").remove();
      for(var f =0; f < arrays.length; f++){
        $(".linedetails-section").append('<div>' + arrays[f] + '</div>');
      }
      $("#changes").removeClass("fa fa-check-circle")
      $element.draggable({disabled: true});
    });
});      

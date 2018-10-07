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
		if(!$('.field_name').val()){
			alert("Input the Field Name");
			$("#btnLaunch").removeAttr('disabled').end();
		}else if(!$('#character').val()){
			alert('Character is required');
			$("#btnLaunch").removeAttr('disabled').end();
		}else if(!$('#alignment').val()){
			alert('Alignment is required');
			$("#btnLaunch").removeAttr('disabled').end();
		}else{
			var name = $('.field_name').val();
			var validate;
			arrayvar.forEach(function(value,index){
				if(value.datas==name){
					 validate = 'exist';
				}
			});
			if (validate == 'exist') {
				alert(name + ' is Existed in field name');
				$("#btnLaunch").removeAttr('disabled').end();
			} else {
				x++;
				var id = x;
				arrayvar.push({
				'ar_id': id,
				'datas': name
				});
				var character = $('#character').val();
				var pre_define = $('.pre-define').val();
				var align = $('#alignment').val();
				var field = $('.field_name').val();
				var height = $('.height').val();
				var width = $('.width').val();
				var section = 'header-section';
				var $el = $('<div id="draggable'+x+'" class="draggable" style="cursor: move;position:absolute;top:0;left=0;z-index:2;"><span class="form-control" style="width:'+ width +'px;height:'+ height +'px;text-align:'+align+';" name="start">'+field+'</span><a href="#" class="clickedon" id="header_change'+x+'" attr="'+x+'"><i class="fa fa-check-circle" id="change'+x+'" style="position: absolute;left: 155px;top:0;color: #1ff3ce;font-size: 15px;"></i></a>');
				window.$el = $el;
				var varwidth;
				var varheight;
				$('.image-contents').append($el);
				$el.draggable({
				stop: function(){
					var finalxPos = $(this).position().left;
					var finalyPos = $(this).position().top;
					var htmls = '<div class="hidden-input'+id+'" id="hidden_inputs"><input type="hidden" name="pre_define[]" class="form-control" value="'+pre_define+'"><input type="hidden" name="left[]" class="form-control" value="'+finalxPos+'"><input type="hidden" name="top[]" class="form-control" value="'+finalyPos+'"><input type="hidden" name="section[]" class="form-control" value="'+section+'"><input type="hidden" name="width[]" class="form-control" value="'+width +'"><input type="hidden" name="height[]" class="form-control" value="'+height +'"><input type="hidden" name="field[]" class="form-control" value="'+field +'"><input type="hidden" name="alignment[]" class="form-control" value="'+align+'"><input type="hidden" name="character[]" class="form-control" value="'+character+'"></div>';
					// $(".header-section").html(htmls);
					window.myvar = htmls;
				} 
				});
			}
			//end version1
		$('#custom-width-modal').modal('toggle');
		$('#button-content').find('input:text').val('');
		$('#second-button-content').find('input:text').val('');
		}
	});
	var array = [];
	var ar =0;
	$(document).on("click",".clickedon", function(){
		ar++;
		array.push({
		'id': ar,
		'data': myvar
		});
		$("#btnLaunch").removeAttr('disabled');
		$(".datas").remove();
		for(var i =0; i < array.length; i++){
			$(".header-section").append('<div class="datas">'+array[i].data+'</div>');
		}
		$("#header_change"+ar+"").addClass("delete").removeClass("clickedon")
		$("#change"+ar+"").addClass("far fa-times-circle").removeClass("fa fa-check-circle")
		// $(".clickedon").prop('id', 'delete');
		$el.draggable({disabled: true});
		console.log(arrayvar);
	});
	$(document).on("click",".delete", function(){
		var id = $(this).attr('attr');
		$( "#draggable"+id+"" ).remove();
		$( ".hidden-input"+id+"" ).remove();
		for(var j = 0; j < array.length; j++){
			if(array[j]['id']==id){
				array.splice(j,1);
				j--;
			}
		}
		for(var g = 0; g < arrayvar.length; g++){
			if(arrayvar[g]['ar_id']==id){
				arrayvar.splice(g,1);
				g--;
			}
		}
		console.log(arrayvar);
	});
	var line_array =[];
	var a = 0;
	$('#secondbtnSave').click(function() {
		$("#btnLaunch").prop("disabled", true);
		if(!$('.line-field').val()){
			alert("Input the Field Name");
			$("#btnLaunch").removeAttr('disabled').end();
		}else if(!$('#line_character').val()){
			alert('Character is required');
			$("#btnLaunch").removeAttr('disabled').end();
		}else if(!$('#line_alignment').val()){
			alert('Alignment is required');
			$("#btnLaunch").removeAttr('disabled').end();
		}else{
			var name = $('.line-field').val();
			var validates;
			line_array.forEach(function(values,index){
				if(values.data==name){
					 validates = 'exist';
				}
			});
			if (validates == 'exist') {
				alert(name + ' is Existed in field name');
				$("#btnLaunch").removeAttr('disabled').end();
			} else {
				a++;
				var i = a;
				line_array.push({
					'array_id': a,
					'data': name
				});
				var validation = [,'TOTAL', 'VAT', 'TAX', 'DISCOUNT', 'SUBTOTAL'];
				var char_var = $('.line-field').val();
				console.log(char_var.toUpperCase());
				if( validation.indexOf(char_var.toUpperCase()) > 0){
					var section = 'header-section';
				}else{
					var section = 'linedetails-section';
				}
				var line_char = $('#line_character').val();
				var line_align = $('#line_alignment').val();
				var field = $('.line-field').val();
				var height = $('.line-height').val();
				var width = $('.line-width').val();
				var pre_define = "";
				if(section == 'header-section'){
					var $element = $('<div id="draggables'+i+'" class="draggable" style="cursor: move;position:absolute;top:0;left=0;z-index:2;"><span id="'+i+'" style="width:'+ width +'px;height:'+ height +'px;text-align:'+line_align+';" name="start" class="form-control">'+field+'</span><a href="#" class="clickedons" id="line_change'+i+'" attrs="'+i+'"><i class="fa fa-check-circle" id="changes'+i+'" style="position: absolute;left: 155px;top:0;color: #1ff3ce;font-size: 15px;"></i></a>');
					window.$element = $element;
				}
				else{
					var $element = $('<div id="draggables'+i+'" class="draggable" style="cursor: move;position:absolute;top:0;left=0;z-index:2;"><span id="'+i+'" style="width:'+ width +'px;height:'+ height +'px;text-align:'+line_align+';" name="start" class="form-control span">'+field+'</span><a href="#" class="clickedons" id="line_change'+i+'" attrs="'+i+'"><i class="fa fa-check-circle" id="changes'+i+'" style="position: absolute;left: 155px;top:0;color: #1ff3ce;font-size: 15px;"></i></a>');
					window.$element = $element;
				}
				
				$('.image-contents').append($element);
				$element.draggable({
					stop: function(){
						var left = $(this).position().left;
						var top = $(this).position().top;
						var htmlss = '<div class="hidden-inputs'+i+'" id="line_hidden"><input type="hidden" name="pre_define[]" class="form-control" value="'+pre_define+'"><input type="hidden" name="left[]" class="form-control" value="'+left+'"><input type="hidden" name="top[]" class="form-control" value="'+top+'"><input type="hidden" name="section[]" value="'+section+'"><input type="hidden" name="width[]" value="'+ width +'"><input type="hidden" name="height[]" value="'+height +'"><input type="hidden" name="field[]" value="'+field +'"><input type="hidden" name="alignment[]" value="'+line_align+'"><input type="hidden" name="character[]" value="'+line_char+'"></div>';
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
	var ars =0;
	$(document).on("click",".clickedons", function(){
		ars++;
		arrays.push({
			'id':ars,
			'line_datas':myvars});
		$("#btnLaunch").removeAttr('disabled');
		$(".line_datas").remove();
		for(var f =0; f < arrays.length; f++){
			$(".linedetails-section").append('<div class="line_datas">'+arrays[f].line_datas+'</div>');
		}
			$("#line_change"+ars+"").addClass("deletes").removeClass("clickedons")
			$("#changes"+ars+"").addClass("far fa-times-circle").removeClass("fa fa-check-circle")
		$element.draggable({disabled: true});
		console.log(arrays);
		console.log(line_array);
	});
	$(document).on("click",".deletes", function(){
		var id = $(this).attr('attrs');
		$( "#draggables"+id+"" ).remove();
		$( ".hidden-inputs"+id+"" ).remove();
		for(var j = 0; j < arrays.length; j++){
			if(arrays[j]['id']==id){
				arrays.splice(j,1);
				j--;
			}
		}
		for(var g = 0; g < line_array.length; g++){
			if(line_array[g]['array_id']==id){
				line_array.splice(g,1);
				g--;
			}
		}
		console.log(arrays);
		console.log(line_array);
	});
});      
$(document).ready(function() {
    $('.remove-record').click(function() {
    	console.log('nice');
		var id = $(this).attr('data-id');
		console.log(id);
		var url = $(this).attr('data-url');
		var urls = id,url;
		$(".remove-record-model").attr("action",url);
		$('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
	});

	$('.remove-data-from-delete-form').click(function() {
		$('body').find('.remove-record-model').find( "input" ).remove();
	});
	$('.modal').click(function() {
		// $('body').find('.remove-record-model').find( "input" ).remove();
	});
});
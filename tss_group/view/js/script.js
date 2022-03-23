(function($){

	$('#customers-table .save').click(function(){
		var customer_data = {
			'customer_id': $(this).closest('tr').find('input[name="customer_id"]').val(),
			'number': $(this).closest('tr').find('input[name="number"]').val(),
			'name': $(this).closest('tr').find('input[name="name"]').val(),
			'last_name': $(this).closest('tr').find('input[name="last_name"]').val(),
			'category_id': $(this).closest('tr').find('input[name="category_id"]:checked').val()
		};
		
		$.post('customers/edit', customer_data).done(function(json){
			if (json['error']) {
				alert(json['error']);
			} else if (json['success']) {
				alert(json['success']);
				location.reload();
			}
		});
	});
	
	$('#customers-table .delete').click(function(){
		
	});
	
})(jQuery);
$(document).ready(function() {
	
	$('.delete-entry').click(function() {
		var well = $(this).parents('.well');
		var parent = $(this).parents('.modal');
		var id = parent.find('#id').val();
		var entry_id = $(this).attr('id');
		var csrf = $('#csrf');
		var csrf_val = csrf.val();
		$.ajax({
			method: "POST",
			dataType: "json",
			url: "http://localhost/timesheet/member/delete_entry",
			data: {"csrf_test_name" : csrf_val, "entry_id" : entry_id},
			success: function(obj){
				csrf.val(obj.csrf);
				if (obj.error == true){
					parent.find('.error').html("<div class='alert alert-danger' role='alert'>" + obj.errorText + "</div>");
					return false;
				} else {
					well.remove();
					$('#day-entry-' + entry_id).remove();
					var day = $('#day' + id);
					var check_entry = day.find('.day-entry-container').length;
					if (check_entry === 0){
						day.addClass('alert-required-cell');
					}
					return true;
				}
			}
		});
	});
	
});
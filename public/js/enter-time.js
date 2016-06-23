$(document).ready(function() {

	$('.modal').on('show.bs.modal', function (e) {
		var id = $(this).data('day-id');
		var dayCell = $('#' + id);
		$(this).find('input[name=regularHours]').val(dayCell.find('input[name=regularHoursReadOnly]').val());
		$(this).find('input[name=overtimeHours]').val(dayCell.find('input[name=overtimeHoursReadOnly]').val());
	});
	
	$('.save-time').click(function() {
		var parent = $(this).parents('.modal');
		var regularHours = parent.find('input[name=regularHours]').val();
		var overtimeHours = parent.find('input[name=overtimeHours]').val();
		var csrf = $('input[name=_token]').val();
		var error = parent.find('.enterTimeError');
		if (regularHours.length < 1){
			error.html("<div class='alert alert-danger' role='alert'>Regular hours is required.</div>");
			return false;
		}
		if (overtimeHours.length < 1){
			error.html("<div class='alert alert-danger' role='alert'>Overtime hours is required.</div>");
			return false;
		}
		if (!$.isNumeric(regularHours)){
			error.html("<div class='alert alert-danger' role='alert'>Regular hours is not numeric.</div>");
			return false;
		}
		if (!$.isNumeric(overtimeHours)){
			error.html("<div class='alert alert-danger' role='alert'>On-call hours is not numeric.</div>");
			return false;
		}
		var id = parent.data('day-id');
		var month = parent.find('input[name=month]').val();
		var day = parent.find('input[name=day]').val();
		var year = parent.find('input[name=year]').val();
		$.ajax({
			method: "POST",
			dataType: "json",
			url: "/dashboard/enterTime",
			data: {
				_token: csrf,
				id: id,
				regularHours: regularHours,
				overtimeHours: overtimeHours,
				month: month,
				day: day,
				year: year
			}
		}).done( function (data) {
			if (data.errors) {
				$.each(data.errors, function (index, value) {
					error.html("<div class='alert alert-danger'>" + value + "</div>");
				});
				return;
			}
			var dayCell = $('#' + data.id);
			dayCell.find('input[name=regularHoursReadOnly]').val(data.regularHours);
			dayCell.find('input[name=overtimeHoursReadOnly]').val(data.overtimeHours);
			dayCell.find('.hours-container').removeClass('hide').addClass('show');
			dayCell.find('.regularHours').html(data.regularHours);
			dayCell.find('.overtimeHours').html(data.overtimeHours);
			$(parent).modal('hide');
		}).fail( function (error) {
			console.log(error);
		});
	});
	
});
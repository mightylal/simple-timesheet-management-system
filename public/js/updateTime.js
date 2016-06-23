$(document).ready(function () {
    $('#workDate').on('change', function () {
        var workDate = $(this).val();
        var employee = $('#employee').val();
        var token = $('input[name=_token').val();
        $.ajax({
            data: {
                _token: token,
                user_id: employee,
                workDate: workDate
            },
            method: 'POST',
            url: 'admin/getEmployeeTime',
            dataType: 'json'
        }).done(function (data) {
            if (data.errors) {
                $.each(data.errors, function (index, value) {
                    switch(index) {
                        case 'user_id':
                            $('#employeeError').text(value);
                            break;
                        case 'workDate':
                            $('#workDateError').text(value);
                    }
                });
                return;
            }
            $('#employeeError').text('');
            $('input[name=regularHours]').val(data.regularHours);
            $('input[name=overtimeHours]').val(data.overtimeHours);
        }).fail(function (error) {
            console.log(error);
        });

    });
});
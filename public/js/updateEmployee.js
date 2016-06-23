$(document).ready(function () {
    $('#employeeRateId').on('change', function () {
        var parent = $(this).parents('#employeeUpdate');
        var id = $(this).val();
        var token = $('input[name=_token').val();
        $.ajax({
           data: {
               _token: token,
               id: id
           },
           dataType: 'json',
           method: 'POST',
           url: 'admin/employeeRates'
        }).done(function (data) {
            parent.find('input[name=regularRate]').val(data[0].regularRate);
            parent.find('input[name=overtimeRate]').val(data[0].overtimeRate);
        }).fail( function (error) {
            console.log(error);
        });
    });
});
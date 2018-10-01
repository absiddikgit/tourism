<script type="text/javascript" >
function dateCheck() {
    
    var departs = date($('#departs').val());
    var returns = date($('#return').val());
    var deadline = date($('#deadline').val());

    if (departs != '' && returns != '') {
        if(Date.parse(returns) < Date.parse(departs)){
            $('#ret_date_error').text('Return date must be greater than or equal departs date')
            $('#return').val('')
        }else {
            $('#ret_date_error').text('')
        }
    }

    if (departs != '' && deadline != '' ) {
        if(Date.parse(departs) < Date.parse(deadline)){
            $('#deadline_date_error').text('Booking Deadline must be less than or equal departs date')
            $('#deadline').val('')
        }else {
            $('#deadline_date_error').text('')
        }
    }
}

function date(date) {
    var d = date.split('-');
    return d[2]+'-'+d[1]+'-'+d[0];
}
</script>

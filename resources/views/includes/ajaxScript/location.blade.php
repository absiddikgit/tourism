<script type="text/javascript" >
function get_district(val) {
    $.ajax({
        type: "POST",
        url: "{{ route('getDistrict') }}",
        data:{_token:'{{ csrf_token() }}',id:val},
        success: function(data){
            $('#district').html("<option value=\"\">Choose</option>");
            $.each(data, function(key, value) {
                $('#district')
                .append($("<option></option>")
                .attr("value",value.id)
                .text(value.name));
            });
        }
    });
}

function get_district_in_front(val) {
    $.ajax({
        type: "POST",
        url: "{{ route('frontend.getDistrict') }}",
        data:{_token:'{{ csrf_token() }}',slug:val},
        success: function(data){
            $('#district').html("<option value=\"\">Choose</option>");
            $.each(data, function(key, value) {
                $('#district')
                .append($("<option></option>")
                .attr("value",value.slug)
                .text(value.name));
            });
        }
    });
}
</script>

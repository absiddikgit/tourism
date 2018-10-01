<script type="text/javascript" >
function get_hotels(val) {
    var division_id = $('#division').val();
    $.ajax({
        type: "POST",
        url: "{{ route('getHotel') }}",
        data:{_token:'{{ csrf_token() }}',division_id:division_id,district_id:val},
        success: function(data){
            $('#hotel').html("");
            $.each(data, function(key, value) {

                $('#hotel').append($(
                    '<div class="col-md-3">'
                        +'<div class="img-thumbnail">'
                            +'<img width="100%" class="" src="'+ value.hotel_images[0].image +'" alt="">'
                            +''
                            +'<div style="padding-top:5px" class="demo-checkbox">'
                                +'<input id="'+ value.slug +'" value="'+ value.id +'" type="checkbox" required name="hotels[]">'
                                +'<label style="font-size:15px" for="'+ value.slug +'">'+ value.name +'</label>'
                            +'</div>'
                        +'</div>'
                    +'</div>'
                ));

            });
        },
        error: function () {
            alert('not done')
        }
    });
}
</script>

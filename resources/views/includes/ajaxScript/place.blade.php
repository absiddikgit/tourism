<script type="text/javascript" >
function get_places(val) {
    var division_id = $('#division').val();
    $.ajax({
        type: "POST",
        url: "{{ route('getPlace') }}",
        data:{_token:'{{ csrf_token() }}',division_id:division_id,district_id:val},
        success: function(data){
            $('#place').html("");
            $.each(data, function(key, value) {

                $('#place').append($(
                    '<div class="col-md-3">'
                        +'<div class="img-thumbnail">'
                            +'<img width="100%" class="" src="'+ value.place_images[0].image +'" alt="">'
                            +''
                            +'<div style="padding-top:5px" class="demo-checkbox">'
                                +'<input id="'+ value.slug +'" value="'+ value.id +'" type="checkbox" required name="places[]">'
                                +'<label style="font-size:15px" for="'+ value.slug +'">'+ value.title +'</label>'
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

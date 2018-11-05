new Vue({
    el: '#app',
    data: {
        key: "",
        districts: []
    },
    methods: {
        get_district_in_front: function () {
            this.districts = []
            var path = 'get-districts?slug='+this.key;
            axios.get(path)
            .then((response) => {
                this.districts = response.data
            }).catch(function(error){
                // Error handling
            });

        }
    }

});

new Vue({
    el: '#booking_form',
    data: {
        picked: "",
        show_more_input: false,
    },
    methods: {
        total_amount: function () {
            this.show_more_input = true;
        }
    }
});

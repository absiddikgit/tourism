new Vue({
    el: '#app',
    data: {
        key: "",
        districts: []
    },
    methods: {
        get_district_in_front: function () {
            this.districts = []
            var path = 'http://localhost/tourism/get-districts?slug='+this.key;
            axios.get(path)
            .then((response) => {
                this.districts = response.data
                // console.log(response.data)
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
        total_travelers: "",
        num_of_child: "",
        cost: document.getElementById('cost').value,
        show_more_input: false,
    },
    methods: {
        total_amount: function () {

            return (this.cost * this.total_travelers)+(this.cost/2 * this.num_of_child);
        }
    }
});

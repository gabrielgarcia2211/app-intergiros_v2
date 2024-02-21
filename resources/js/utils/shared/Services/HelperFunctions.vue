<script>
export default {
    methods: {
        $getEnumsRelations(type) {
            const vm = this;
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/enums/types/${type.join(",")}`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch(function (error) {
                        vm.$readStatusHttp(error);
                        reject(error);
                    });
            });
        }
    },
};
</script>

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
        },
        $listCorteNombresAndIds(params) {
            const vm = this;
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/corte/nombres-ids`, params)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch(function (error) {
                        vm.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        $listEspecificacionNombresAndIds() {
            const vm = this;
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/especificaciones/nombres-ids`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch(function (error) {
                        vm.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        $listModistasNombresAndIds() {
            const vm = this;
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/modista/nombres-ids`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch(function (error) {
                        vm.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
    },
};
</script>

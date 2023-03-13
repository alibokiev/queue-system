<template>
    <!--<div class="container">-->
        <!--<div class="row justify-content-center">-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Цитата дня</div>

                    <div class="card-body">
                        <!--{{inspiration}}-->
                        sdcscscsd
                    </div>
                </div>
            </div>
        <!--</div>-->
    <!--</div>-->
</template>

<script>
    export default {
        data() {
            return {
                inspiration: '',
            }
        },
        methods:{
            load() {
                const self = this;
                axios.get('test').then(function (response) {
                    console.log(response.data.inspiration);
                    self.inspiration = response.data.inspiration;
                }).catch(function (error) {
                    console.log(error)
                });
            }
        },
        mounted() {
            //this.load();
            //console.log('Component mounted.')
        }
    }
</script>

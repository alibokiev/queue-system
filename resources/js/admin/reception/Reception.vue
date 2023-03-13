<template>
    <div>
        <div class="card">
            <div class="card-header">
                <i class="icon-share"></i>
                Очередь
                <button class="btn btn-danger btn-sm pull-right m-b-0" role="button"
                        @click="deleteItem('/admin/reception/skip-all')">
                    <i class="fa fa-trash"></i>
                    Очистить всё
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 text-center" v-for="category in categories" @click="addToQueue(category)">
                        <button :class="'btn btn-lg btn-' + category.color">
                            <div class="sk-circle1 sk-child"></div>
                            {{category.name}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div hidden>
            <div id="printMe" style="max-width: 58mm; max-height: 300mm;">

                <div style="font-size: 140px;" v-if="ticket">

                    <h5 align="center">{{text}}</h5>
                    <h1></h1>
                    <h1></h1>
                    <h1></h1>
                    <h1></h1>
                    <h1 align="center">{{number}}</h1>
                    <h1></h1>
                    <h1></h1>
                    <h1></h1>
                    <h1></h1>
                    <h1></h1>
                    <h4>{{dtime(ticket.created_at)}}</h4>
                    <h1></h1>
                    <h4>{{ddate(ticket.created_at)}}</h4>
                    <h1>_______________</h1>
                    <h1></h1>
                </div>

            </div>


        </div>
    </div>


</template>

<script>
export default {
    props: ['categories', 'text'],

    data() {
        return {
            inspiration: '',
            number: '',
            ticket: null,
        }
    },

    methods: {

        ddate(date) {
            return moment(date).format('DD.MM.YYYY')

        },

        dtime(date) {
            return moment(date).format('h:mm:ss')

        },

        print() {
            // Pass the element id here
            this.$htmlToPaper('printMe');
        },

        addToQueue(category) {
            const self = this;
            axios.post('/admin/reception', {
                category_id: category.id
            }).then(function (response) {
                self.$notify({type: 'success', title: category.name, text: 'Успешно добавлено'});
                self.number = response.data.ticket.number;
                self.ticket = response.data.ticket;

                setTimeout(() => {
                    self.print();
                }, 500);

                Event.fire('ticket-added');
            }).catch(function (error) {
                console.log(error)
            });
        },

        deleteItem(url) {
            var self = this;

            this.$modal.show('dialog', {
                title: 'Внимание!',
                text: 'Вы действительно хотите очисить очередь?',
                buttons: [
                    {title: 'Нет, отмена.'},
                    {
                        title: '<span class="btn-dialog btn-danger">Да, удалить.<span>',
                        handler: function handler() {
                            self.$modal.hide('dialog');
                            axios.post(url).then(function (response) {
                                Event.fire('ticket-added');
                                self.$notify({
                                    type: 'success',
                                    title: 'Успешно!',
                                    text: 'Item successfully deleted.'
                                });
                            }, function (error) {
                                self.$notify({type: 'error', title: 'Error!', text: 'An error has occured.'});
                            });
                        }
                    }]
            });
        },
    },


}
</script>

<style>
@media print {
    h1 {
        overflow: auto;
        height: 58mm;
    }

    .scroll-y {
        height: auto;
        overflow: visible;
    }
}

</style>

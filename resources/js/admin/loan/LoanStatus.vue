<template>
    <div>
        <div class="form-group ">
            <select class="form-control form-control-sm" v-model="status">
                <option v-for="status in statuses" :value="status.id">{{status.display_name}}</option>
            </select>
        </div>

        <button class="btn btn-sm btn-primary" type="submit" :disabled="loading" @click="submit()">
            <i class="fa fa-dot-circle-o"></i>
            Изменить статус
        </button>

    </div>
</template>


<script>
    export default {
        props:['statuses', 'currentStatus', 'loan'],

        data() {
            return {
                status: null,
                loading:false,
            }
        },

        methods: {
            submit() {
                const self = this;
                self.loading = true;
                axios.post('/admin/loans/'+self.loan+'/status', {
                    loan_status_id: self.status
                }).then(function (response) {
                    self.loading = false;
                    self.$notify({ type: 'success', title: 'Статус заема', text: 'Успешно обновлен'});
                    Event.fire('loan-status-changed', self.status)
                }).catch(function (error) {
                    self.loading = false;
                    console.log(error)
                });
            }
        },

        mounted() {
            this.status = this.currentStatus;
        }
    }

</script>

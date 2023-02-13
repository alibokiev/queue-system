<template>
    <badge :data="status" :icon="false"></badge>
</template>


<script>
    export default {
        props: ['statuses', 'currentStatus'],

        data() {
            return {
                status: null,
                loading: false,
            }
        },

        created() {
            this.status = this.currentStatus;
        },

        mounted() {
            Event.listen('loan-status-changed', (status) => {
                for (let i = 0; i < this.statuses.length; ++i) {
                    if (this.statuses[i].id === status) {
                        this.status = this.statuses[i];
                        return;
                    }
                }
            })
        }
    }

</script>

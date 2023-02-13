<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table ">
                    <thead class="thead-light">
                    <tr>
                        <th><h2>Навбат</h2></th>
                        <th></th>
                        <th class="text-center"><h2>Қабул</h2></th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="user in currentUsers">
                        <td class="no-borders" style="width: 30%">
                            <p class="h4">
                                <span v-for="(ticket,index) in user.tickets">
                                    <span v-if="ticket.status_id === 1">
                                        <span v-if="index<8">
                                            {{ ticket.number }}
                                            <span v-if="user.tickets.length > 1 && index < 7">
                                                <span v-if="index < (user.tickets.length-1)">,</span>
                                            </span>
                                        </span>
                                        <span v-if="index===8">...</span>
                                    </span>
                                </span>
                            </p>
                        </td>

                        <td :class="'no-borders table-'+user.category.color">
                            <h5>{{ user.category.name }}</h5>
                            <h4>{{ user.full_name }} </h4>
                        </td>

                        <td class="no-borders text-center" style="width: 15%">
                            <h1 class="pulse">
                                <span v-for="(ticket,index) in user.tickets">
                                    <span v-if="ticket.status_id === 2">
                                        {{ ticket.number }}
                                    </span>
                                </span>
                            </h1>
                        </td>

                    </tr>

                    </tbody>
                </table>
            </div>

        </div>

    </div>

</template>

<script>
export default {
    props: ['categories', 'monitor', 'users'],
    data() {
        return {
            old: false,
            loading: false,
            currentCategories: [],
            currentUsers: []
        }
    },
    methods: {
        load() {
            const self = this;
            axios.get('/monitor').then(function (response) {
                self.currentCategories = response.data.categories
                self.currentUsers = response.data.users
                self.loading = false;
            }).catch(function (error) {
                console.log(error)
            });
        }
    },

    created() {
        if (this.monitor === false) {
            this.loading = true;
            this.load()
        } else {
            this.currentCategories = this.categories;
            this.currentUsers = this.users;
        }

        this.timer = setInterval(this.load, 10000)
    },

    mounted() {
        Event.listen('ticket-added', () => {
            this.load()
        })
    }
}
</script>

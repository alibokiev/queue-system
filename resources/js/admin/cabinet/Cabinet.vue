<template>
    <div class="row">
        <div class="col-9">
            <div v-if="loading">
                <div class="sk-wave">
                    <div class="sk-rect sk-rect1"></div>
                    <div class="sk-rect sk-rect2"></div>
                    <div class="sk-rect sk-rect3"></div>
                    <div class="sk-rect sk-rect4"></div>
                    <div class="sk-rect sk-rect5"></div>
                </div>
            </div>
            <div v-else>
                <table class="table table-hover  table-stripped ">
                    <thead :class="'text-white bg-'+currentCategory.color">
                    <tr>
                        <th>Очередь</th>
                        <th>Статус</th>
                        <th>Кто обслуживает</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="ticket in currentTickets">

                        <td class="no-borders">
                            <h6 :class="ticket.status_id ==2?'pulse':''">
                                {{ ticket.number }}
                            </h6>
                            <span>
                                {{ ticket.client.common_name }}
                            </span>
                        </td>
                        <td>
                            <h6 :title="ticket.status.display_name" :class="ticket.status_id ==2?'pulse':''">
                                <i :class="'fa fa-circle text-' + ticket.status.color"></i>
                                {{ ticket.status.display_name }}
                            </h6>
                            <span v-if="ticket.status_id !=2">
                                <strong>
                                    Время:
                                </strong>
                                <span>
                                    c {{ __ordinaryTime(ticket.created_at) }}
                                </span>
                            </span>

                        </td>

                        <td class="no-borders">
                            <h6 v-if="ticket.user" :class="ticket.status_id ==2?'pulse':''">
                                {{ ticket.user.full_name }}
                            </h6>
                            <span v-if="ticket.status_id ==2">
                                <strong>
                                    Время:
                                </strong>
                                <span>
                                    c {{ __ordinaryTime(ticket.created_at) }}
                                </span>
                            </span>
                        </td>
                    </tr>

                    </tbody>

                </table>

                <div v-if="currentTicket" class="m-t-md">

                    <hr class="">

                    <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit">

                        <table class="table table-hover table-stripped ">
                            <thead>
                            <tr>
                                <th>Клиент:</th>
                            </tr>
                            </thead>
                        </table>
                        <div class="row">

                            <div class="col-6">

                                <div class="form-group row align-items-center">
                                    <label class="col-form-label text-md-right col-md-2">Фамилия</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.surname"
                                               class="form-control"
                                               id="surname" name="surname" placeholder="Фамилия">
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label class="col-form-label text-md-right col-md-2">Имя</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.name"
                                               class="form-control"
                                               name="name" placeholder="Имя">
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label class="col-form-label text-md-right col-md-2">Отчество</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.second_name"
                                               class="form-control"
                                               name="second_name" placeholder="Отчество">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-form-label text-md-right col-md-2">Телефон</label>
                                    <div class="col-md-8">
                                        <input type="number" v-model="form.phone"
                                               class="form-control"
                                               name="phone">
                                    </div>
                                </div>

                            </div>

                            <div class="col-6">

                                <div class="form-group row align-items-center">
                                    <label class="col-form-label text-md-right col-md-4">Паспорт</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.passport"
                                               class="form-control"
                                               name="passport">
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label class="col-form-label text-md-right col-md-4">ИНН</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.tin"
                                               class="form-control"
                                               name="tin">
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label class="col-form-label text-md-right col-md-4">Прописка</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.address"
                                               class="form-control"
                                               name="address">
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label class="col-form-label text-md-right col-md-4">Год рожд.</label>
                                    <div class="col-md-8">
                                        <input type="text" v-model="form.date_of_birth"
                                               class="form-control"
                                               name="date_of_birth">
                                    </div>
                                </div>

                            </div>

                        </div>

                        <hr>

                        <table class="table table-hover  table-stripped ">
                            <thead>
                            <tr>
                                <th>Прием:</th>
                            </tr>
                            </thead>
                        </table>

                        <div class="row">

                            <div class="col-6">

                                <div class="form-group row align-items-center">
                                    <label class="col-form-label text-md-right col-md-2">Коммент</label>
                                    <div class="col-md-8">
                                        <textarea name="comment" v-model="form.comment" class="form-control"
                                                  rows="4"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="col-6">

                                <div class="form-group row align-items-center">
                                    <label class="col-form-label text-md-right col-md-4">Услуга</label>
                                    <div class="col-md-8">

                                        <select name="service_id" v-model="selectedService" class="form-control">
                                            <option :value="service" v-for="service in services">
                                                {{ service.name }}
                                            </option>
                                        </select>
                                        <br>
                                        <div v-if="selectedService">
                                            <strong>Boj: </strong><span>{{ selectedService.boj }}</span><br>
                                            <strong>Hizmat: </strong><span>{{ selectedService.hizmat }}</span><br>
                                            <strong>Kogaz: </strong><span>{{ selectedService.kogaz }}</span><br>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"
                                :disabled="form.name==''||form.phone==''||!selectedService">
                            <i class="fa" :class="false ? 'fa-spinner' : 'fa-download'"></i>
                            Сохранить и отпустить клиента
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-success w-100" @click="accept()" :disabled="currentTicket">
                        Принять
                    </button>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <button type="button" class="btn btn-danger w-100" @click="done()" :disabled="!currentTicket">
                        Отпустить
                    </button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col ">

                    <div v-if="currentTicket">
                        <div class="no-items-found">
                            <h2>{{ currentTicket.number }}</h2>
                            <h6 align="left">Приглашен:</h6>
                            <h3 :title="currentTicket.invited_at">{{ __relativeTime(currentTicket.invited_at) }}</h3>
                        </div>

                    </div>

                    <div v-else>
                        <div class="no-items-found">
                            <i class="icon-ban"></i>
                            <h3>Вы никого не пригласили</h3>
                        </div>
                    </div>

                </div>

                <table class="table table-stripped">
                    <thead>
                    <tr>
                        <th colspan="2">Завершенные:</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="ticket in completedTickets">
                        <td nowrap>
                            <strong>
                                {{ ticket.client.common_name }}
                            </strong>
                            <br>
                            <small>
                                {{ ticket.number }}
                            </small>
                        </td>
                        <td>
                            {{ __relativeTime(ticket.completed_at) }}
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

    data() {
        return {
            currentCategory: null,
            completedTickets: [],
            currentTickets: [],
            currentTicket: null,
            loading: false,
            services: [],
            selectedService: null,
            form: {
                id: "",
                name: "",
                surname: "",
                phone: "",
                second_name: "",
                passport: "",
                address: "",
                tin: "",
                date_of_birth: "",
                service_id: "",
                comment: "",
            },

        }
    },

    watch: {

        currentTicket() {
            if (this.currentTicket != null) {
                this.form = {
                    id: this.currentTicket.client.id,
                    name: this.currentTicket.client.name,
                    surname: this.currentTicket.client.surname,
                    phone: this.currentTicket.client.phone,
                    second_name: this.currentTicket.client.second_name,
                    passport: this.currentTicket.client.passport,
                    address: this.currentTicket.client.address,
                    tin: this.currentTicket.client.tin,
                    date_of_birth: this.currentTicket.client.date_of_birth,
                    service_id: this.currentTicket.service_id,
                    comment: this.currentTicket.comment,
                }
            } else {
                this.selectedService = null
                this.form = {
                    name: "",
                    surname: "",
                    phone: "",
                    second_name: "",
                    passport: "",
                    address: "",
                    tin: "",
                    date_of_birth: "",
                    service_id: "",
                    comment: "",
                };
            }
        }

    },

    methods: {
        load() {
            const self = this;

            axios.get('/admin/cabinet').then(function (response) {
                self.currentCategory = response.data.category;
                self.currentTicket = response.data.ticket;
                self.completedTickets = response.data.completedTickets;
                self.currentTickets = response.data.tickets;

                self.loading = false;
            }).catch(function (error) {
                console.log(error)
            });
        },

        loadServices() {
            const self = this;
            axios.get('/admin/cabinet/services').then(function (response) {
                self.services = response.data;
            }).catch(function (error) {
                console.log(error)
            });
        },

        accept() {
            const self = this;
            axios.post('/admin/cabinet/accept').then(function (response) {
                if (response.data.success === true) {
                    self.currentTicket = response.data.currentTicket
                    self.load();
                }
            }).catch(function (error) {
                console.log(error)
            });
        },
        done() {
            const self = this;
            axios.post('/admin/cabinet/done', {
                ticketId: self.currentTicket.id
            }).then(function (response) {
                self.currentTicket = null;
                self.$notify({type: 'success', title: 'Очередь', text: 'Успешно завершено'});
                self.load();
            }).catch(function (error) {
                console.log(error)
            });
        },
        onSubmit() {
            console.log("sdcsdcsdcds")
            const self = this;
            self.form.service_id = self.selectedService.id;
            axios.post('/admin/cabinet/save', {
                ticketId: self.currentTicket.id,
                data: self.form,
            }).then(function () {
                self.currentTicket = null;
                self.$notify({type: 'success', title: 'Очередь', text: 'Успешно завершено'});
                self.load();
            }).catch(function (error) {
                console.log(error)
            });
        }
    },

    created() {
        this.loading = true;
        this.load();
        this.loadServices();
        this.timer = setInterval(this.load, 30000)
    },
}
</script>


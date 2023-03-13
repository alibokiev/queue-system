<div class="form-group row align-items-center" :class="{'has-danger': errors.has('surname'), 'has-success': this.fields.surname && this.fields.surname.valid }">
    <label for="surname" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Фамилия</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.surname" v-validate="'required'" @input="validate($event)" class="form-control"
               :class="{'form-control-danger': errors.has('surname'), 'form-control-success': this.fields.surname && this.fields.name.valid}"
               id="surname" name="surname" placeholder="Фамилия">
        <div v-if="errors.has('surname')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('surname') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Имя</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}"
               id="name" name="name" placeholder="Имя">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>


<div class="form-group row align-items-center" :class="{'has-danger': errors.has('second_name'), 'has-success': this.fields.second_name && this.fields.second_name.valid }">
    <label for="second_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Отчество</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.second_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('second_name'), 'form-control-success': this.fields.second_name && this.fields.second_name.valid}"
               id="second_name" name="second_name" placeholder="Отчество">
        <div v-if="errors.has('second_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('second_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('phone'), 'has-success': this.fields.phone && this.fields.phone.valid }">
    <label for="phone" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Телефон</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="number" v-model="form.phone" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('phone'), 'form-control-success': this.fields.phone && this.fields.phone.valid}"
               id="phone" name="phone" placeholder="987654">
        <div v-if="errors.has('phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('phone') }}</div>
    </div>
</div>


<div class="form-group row align-items-center" :class="{'has-danger': errors.has('tin'), 'has-success': this.fields.tin && this.fields.tin.valid }">
    <label for="tin" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">ИНН</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="number" v-model="form.tin" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('tin'), 'form-control-success': this.fields.tin && this.fields.tin.valid}"
               id="tin" name="tin" placeholder="987654">
        <div v-if="errors.has('tin')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('tin') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('passport'), 'has-success': this.fields.passport && this.fields.passport.valid }">
    <label for="passport" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Паспорт</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.passport" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('passport'), 'form-control-success': this.fields.passport && this.fields.passport.valid}"
               id="passport" name="passport" placeholder="987654">
        <div v-if="errors.has('passport')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('passport') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('address'), 'has-success': this.fields.address && this.fields.address.valid }">
    <label for="address" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Прописка</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address" v-validate="'required'" @input="validate($event)"
               class="form-control" :class="{'form-control-danger': errors.has('address'), 'form-control-success': this.fields.address && this.fields.address.valid}"
               id="address" name="address" placeholder="9876543425">
        <div v-if="errors.has('address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('address') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('date_of_birth'), 'has-success': this.fields.date_of_birth && this.fields.date_of_birth.valid }">
    <label for="date_of_birth" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Год рождения</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.date_of_birth"
               class="form-control" :class="{'form-control-danger': errors.has('date_of_birth'), 'form-control-success': this.fields.date_of_birth && this.fields.date_of_birth.valid}"
               id="date_of_birth" name="date_of_birth" placeholder="1993">
        <div v-if="errors.has('date_of_birth')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('date_of_birth') }}</div>
    </div>
</div>





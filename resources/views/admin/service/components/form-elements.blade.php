<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.service.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.name" v-validate="'required'" id="name" name="name" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('boj'), 'has-success': this.fields.boj && this.fields.boj.valid }">
    <label for="boj" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.service.columns.boj') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.boj" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('boj'), 'form-control-success': this.fields.boj && this.fields.boj.valid}" id="boj" name="boj" placeholder="{{ trans('admin.service.columns.boj') }}">
        <div v-if="errors.has('boj')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('boj') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('hizmat'), 'has-success': this.fields.hizmat && this.fields.hizmat.valid }">
    <label for="hizmat" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.service.columns.hizmat') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.hizmat" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('hizmat'), 'form-control-success': this.fields.hizmat && this.fields.hizmat.valid}" id="hizmat" name="hizmat" placeholder="{{ trans('admin.service.columns.hizmat') }}">
        <div v-if="errors.has('hizmat')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('hizmat') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('kogaz'), 'has-success': this.fields.kogaz && this.fields.kogaz.valid }">
    <label for="kogaz" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.service.columns.kogaz') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.kogaz" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('kogaz'), 'form-control-success': this.fields.kogaz && this.fields.kogaz.valid}" id="kogaz" name="kogaz" placeholder="{{ trans('admin.service.columns.kogaz') }}">
        <div v-if="errors.has('kogaz')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('kogaz') }}</div>
    </div>
</div>



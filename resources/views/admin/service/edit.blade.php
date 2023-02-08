@extends('admin.layout.default')

@section('title', 'Редактировать услугу')

@section('body')

    <div class="container-xl">
        <div class="card">

            <service-form
                :action="'{{ $service->resource_url }}'"
                :data="{{ $service->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action"
                      novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> Редактировать
                    </div>

                    <div class="card-body">
                        @include('admin.service.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            Сохранить
                        </button>
                    </div>

                </form>

            </service-form>

        </div>

    </div>

@endsection

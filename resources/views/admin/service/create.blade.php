@extends('admin.layout.default')

@section('title', 'Добавить услугу')

@section('body')

    <div class="container-xl">

        <div class="card">

            <service-form
                :action="'{{ url('admin/services') }}'"
                v-cloak
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action"
                      novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> Добавить
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

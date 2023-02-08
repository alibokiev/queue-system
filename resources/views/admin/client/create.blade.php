@extends('admin.layout.default')

@section('title', 'Создать')

@section('body')

    <div class="container-xl">

                <div class="card">

        <client-form
            :action="'{{ url('admin/clients') }}'"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                <div class="card-header">
                    <i class="fa fa-plus"></i> Новый клиент
                </div>

                <div class="card-body">
                    @include('admin.client.components.form-elements')
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        Добавить
                    </button>
                </div>

            </form>

        </client-form>

        </div>

        </div>


@endsection

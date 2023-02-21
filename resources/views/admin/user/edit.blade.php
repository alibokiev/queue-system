@extends('admin.layout.default')

@section('title', 'Редактировать '. $adminUser->first_name)

@section('body')

    <div class="container-xl">

        <div class="card">

            <admin-user-form
                    :action="'{{ $adminUser->resource_url }}'"
                    :data="{{ $adminUser->toJson() }}"
                    :activation="!!'{{ $activation }}'"
                    inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action">

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ 'Редактировать '. $adminUser->first_name }}
                    </div>

                    <div class="card-body">

                        @include('admin.user.components.form-elements')

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            Сохранить
                        </button>
                    </div>

                </form>

            </admin-user-form>

        </div>

    </div>

@endsection

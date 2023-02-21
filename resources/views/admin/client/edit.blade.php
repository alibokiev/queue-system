@extends('adminlte::page')

@section('title', 'Редактировать')

@section('body')

    <div class="container-xl">
        <div class="card">

            <client-form
                :action="'{{ $client->resource_url }}'"
                :data="{{ $client->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action"
                      novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> Редактировать {{  $client->full_name}}
                    </div>

                    <div class="card-body">
                        @include('admin.client.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            Сохранить
                        </button>
                    </div>

                </form>

            </client-form>

        </div>

    </div>

@endsection

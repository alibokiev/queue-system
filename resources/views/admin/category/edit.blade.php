@extends('admin.layout.default')

@section('title', trans('admin.category.actions.edit', ['name' => $category->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <category-form
                :action="'{{ $category->resource_url }}'"
                :data="{{ $category->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.category.actions.edit', ['name' => $category->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.category.components.form-elements')

                        <div class="row ">

                            <div class="col-8 offset-2">

                                <table class="table table-sm  m-t-md">
                                    <tbody>
                                    <tr>
                                        <td class="no-borders">danger</td>
                                        <td><i class="fa fa-circle text-danger"></i></td>
                                    </tr>
                                    <tr>
                                        <td class="no-borders">success</td>
                                        <td><i class="fa fa-circle text-success"></i></td>
                                    </tr>
                                    <tr>
                                        <td class="no-borders">waring</td>
                                        <td><i class="fa fa-circle text-warning"></i></td>
                                    </tr>
                                    <tr>
                                        <td class="no-borders">info</td>
                                        <td><i class="fa fa-circle text-info"></i></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </category-form>

        </div>
    
</div>

@endsection
@extends('admin.layout.default')

@section('title',"Новая категория")

@section('body')

    <div class="container-xl">

                <div class="card">
        
        <category-form
            :action="'{{ url('admin/categories') }}'"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>
                
                <div class="card-header">
                    <i class="fa fa-plus"></i> Новая категория
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
                        Добавить
                    </button>
                </div>
                
            </form>

        </category-form>

        </div>

        </div>

    
@endsection
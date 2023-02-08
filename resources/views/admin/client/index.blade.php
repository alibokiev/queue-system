@extends('admin.layout.default')

@section('title', 'Все клиенты')

@section('body')

    <client-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/clients') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ "Все клиенты" }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0"
                           href="{{ url('admin/clients/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp;
                            Добавить</a>
                    </div>
                    <div class="card-body" v-cloak>
                        <form @submit.prevent="">
                            <div class="row justify-content-md-between">
                                <div class="col col-lg-7 col-xl-5 form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Поиск" v-model="search"
                                               @keyup.enter="filter('search', $event.target.value)"/>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary"
                                                    @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; Искать</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-auto form-group ">
                                    <select class="form-control" v-model="pagination.state.per_page">

                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <table class="table table-hover table-listing">
                            <thead>
                            <tr>

                                <th is='sortable' :column="'id'">#</th>
                                <th is='sortable' :column="'surname'">Клиент</th>
                                <th is='sortable' :column="'phone'">Телефон</th>
                                <th is='sortable' :column="'created_at'">Создан</th>
                                <th></th>
                            </tr>
                            <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                <td class="bg-bulk-info d-table-cell text-center" colspan="2">
                                        <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a
                                                href="#" class="text-primary"
                                                @click="onBulkItemsClickedAll('/admin/clients')"
                                                v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa"
                                                                                                            :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span
                                                class="text-primary">|</span> <a
                                                href="#" class="text-primary"
                                                @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                    <span class="pull-right pr-2">
                                            <button class="btn btn-sm btn-danger pr-3 pl-3"
                                                    @click="bulkDelete('/admin/clients/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                        </span>

                                </td>
                            </tr>
                            </thead>


                            <tbody>
                            <tr v-for="(item, index) in collection" :key="item.id"
                                :class="bulkItems[item.id] ? 'bg-bulk' : ''">


                                <td>@{{ item.id }}</td>
                                <td nowrap>
                                    <span v-text="item.full_name"></span>
                                </td>

                                <td>@{{ item.phone }}</td>

                                <td>@{{ item.created_at }}</td>

                                <td>
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <a class="btn btn-sm btn-success" :href="item.resource_url">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>

                                        <div class="col-auto">
                                            <a class="btn btn-sm btn-spinner btn-info"
                                               :href="item.resource_url + '/edit'"
                                               title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i
                                                    class="fa fa-edit"></i></a>
                                        </div>
                                        {{--                                            <form class="col" @submit.prevent="deleteItem(item.resource_url)">--}}
                                        {{--                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>--}}
                                        {{--                                            </form>--}}
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="row" v-if="pagination.state.total > 0">
                            <div class="col-sm">
                                <span
                                    class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                            </div>
                            <div class="col-sm-auto">
                                <pagination></pagination>
                            </div>
                        </div>

                        <div class="no-items-found" v-if="!collection.length > 0">
                            <i class="icon-magnifier"></i>
                            <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                            <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                            <a class="btn btn-primary btn-spinner" href="{{ url('admin/clients/create') }}"
                               role="button"><i class="fa fa-plus"></i>&nbsp; Добавить</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </client-listing>

@endsection

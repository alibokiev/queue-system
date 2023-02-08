<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('admin.index', function ($breadcrumbs) {
    $breadcrumbs->push('Главная', route('admin.index'));
});


Breadcrumbs::register('admin/cabinet', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Личный кабинет', route('admin/cabinet'));
});


Breadcrumbs::register('admin/reception', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Очередь', route('admin/reception'));
});

Breadcrumbs::register('admin/services', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Услуги', route('admin/services'));
});

Breadcrumbs::register('admin/services/create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin/services');
    $breadcrumbs->push("Новый", route('admin/services/create'));
});

Breadcrumbs::register('admin/services/edit', function ($breadcrumbs, $service) {
    $breadcrumbs->parent('admin/services');
    $breadcrumbs->push('Редактировать', route('admin/services/edit', $service));
});

Breadcrumbs::register('admin/clients', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Все клиенты', route('admin/clients'));
});

Breadcrumbs::register('admin/clients/show', function ($breadcrumbs, $client) {
    $breadcrumbs->parent('admin/clients');
    $breadcrumbs->push($client->full_name, route('admin/clients/show', $client));
});

Breadcrumbs::register('admin/clients/create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin/clients');
    $breadcrumbs->push("Новый", route('admin/clients/create'));
});

Breadcrumbs::register('admin/clients/edit', function ($breadcrumbs, $client) {
    $breadcrumbs->parent('admin/clients/show', $client);
    $breadcrumbs->push('Редактировать', route('admin/clients/edit', $client));
});

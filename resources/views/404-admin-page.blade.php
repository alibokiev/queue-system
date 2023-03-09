@extends('adminlte::page')

@section('title', '404')

@section('content')
    <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
            <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="{{ route('admin.index') }}">return to main</a>.
            </p>
            <span class="text-danger fs-4">{{ $message }}</span>
        </div>

    </div>
@stop

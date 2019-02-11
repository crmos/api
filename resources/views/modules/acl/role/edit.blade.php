@extends('admin.layout.app')

@section('content')
    <div class="my-3 my-md-5">
        <div class="container">
            @php
                $active_page = 'Edit';
                $bread_crums = ['Roles' => route('dashboard.roles.index')];
            @endphp
            @include('admin.partials.common.breadcrum', [$bread_crums, $active_page])

            @include('admin.authentication.role.form', ['model' => $role])
        </div>
    </div>
@endsection
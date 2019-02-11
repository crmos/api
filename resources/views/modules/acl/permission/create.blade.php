@extends('modules.layout.app')

@section('content')
    @php
        $active_page = 'Create';
        $bread_crums = ['Permissions' => route('dashboard.permissions.index')];
    @endphp
    @include('modules.partials.common.breadcrum', [$bread_crums, $active_page])

    @include('modules.acl.permission.form')

@endsection

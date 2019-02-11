@extends('modules.layout.app')

@section('content')

    @php
        $active_page = 'Create';
        $bread_crums = ['Roles' => route('dashboard.roles.index'), 'Create' => '#'];
    @endphp
    @include('modules.partials.common.breadcrum', [$bread_crums])

    @include('modules.acl.role.form')

@endsection
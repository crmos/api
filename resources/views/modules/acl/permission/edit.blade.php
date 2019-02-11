@extends('modules.layout.app')

@section('content')
        @php
            $active_page = 'Edit';
            $bread_crums = ['Permissions' => route('dashboard.permissions.index')];
        @endphp
        @include('modules.partials.common.breadcrum', [$bread_crums, $active_page])

        @include('modules.acl.permission.form', ['model' => $permission])

@endsection
@extends('admin.layout.app')

@section('content')
    <div class="my-3 my-md-5">
        <div class="container">
            @php
                $active_page = 'Dashboard';
                $bread_crums = ['Users' => route('dashboard.users.index'), 'Create' => '#'];
            @endphp
            @include('admin.partials.common.breadcrum', [$bread_crums])

            @include('admin.authentication.user.form')
        </div>
    </div>
@endsection

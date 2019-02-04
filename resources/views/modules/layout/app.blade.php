<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{env('APP_NAME', 'Laravel')}}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('modules.layout.style')
    @stack('styles')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body id="page-top">

@include('modules.layout.header')

<div id="wrapper">
    @include('modules.sidebar.general')
    <div id="content-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
        @include('modules.layout.footer')
    </div>
</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
@include('modules.layout.logout-modal')

@include('modules.layout.script')
@include('modules.layout.notification')
@stack('scripts')

</body>
</html>
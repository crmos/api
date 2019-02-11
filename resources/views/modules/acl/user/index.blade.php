@extends('modules.layout.app')

@section('content')

            @php
                $active_page = 'User';
            @endphp
            @include('modules.partials.common.breadcrum', ['active_page' => $active_page])

            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-table"></i>
                            User List
                            <span class="float-right">
                        <a href="{{route('dashboard.users.create')}}">
                            <i class="fa fa-plus"></i>
                            Add New
                        </a>
                    </span>
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed table-striped table-bordered"
                                       id="data-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Company name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th class="disabled-sorting">Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- table-wrapper -->
                    </div>
                    <!-- section-wrapper -->
                </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#data-table').DataTable({
            dom : '<"row"<"col-md-2"l><"col-md-4"i><"col-md-6"f>>rt<"bottom"p>',
            processing: true,
            serverSide: true,
            ajax: '{{ route('dashboard.users.index') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'company_name', name: 'company_name'},
                {data: 'roles[0].display_name', name: 'roles.display_name', orderable: false},
                {data: 'email', name: 'email'},
                {className: 'td-actions', data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@endpush
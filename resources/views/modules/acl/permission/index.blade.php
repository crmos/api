@extends('modules.layout.app')

@section('content')
    @php
        $active_page = 'Dashboard';
        $button_name = 'Add Permission';
        $button_link = route('dashboard.permissions.create');
    @endphp
    @include('modules.partials.common.breadcrum', ['active_page' => $active_page])

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Permission List
                    <span class="float-right">
                        <a href="{{route('dashboard.permissions.create')}}">
                            <i class="fa fa-plus"></i>
                            Add New
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed table-striped table-bordered"
                               id="data-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th class="disabled-sorting">Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->

@endsection

@push('scripts')
    <script type="text/javascript">
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('dashboard.permissions.index') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'display_name', name: 'display_name'},
                {className: 'td-actions', data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@endpush
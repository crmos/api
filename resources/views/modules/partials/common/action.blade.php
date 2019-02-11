@if(isset($view) && $view)
    <a href="{{route($name.'.show', $data->id) }}" class="btn btn-primary btn-sm" title="View">
        <i class="fa fa-eye"></i>
    </a>
@endif


@if(!isset($no_edit))
    <a href="{{ route($name.'.edit', $data->id) }}" class="btn btn-info btn-sm" title="Edit">
        <i class="fa fa-pencil-alt"></i>
    </a>
@endif

<a data-toggle="modal" href="#modal-delete-{{ $data->id }}" class="btn btn-danger btn-sm" title="Delete">
    <i class="fa fa-trash"></i>
</a>

<div class="modal fade modal-mini modal-primary" id="modal-delete-{{ $data->id }}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{ Form::open(['method' => 'DELETE', 'route' => ["$name.destroy", $data->id]]) }}
            @if(isset($hard_delete))
                <input type="hidden" value="1" name="hard_delete">
            @endif
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-trash"></i> Delete!!!
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>
                    Are you sure want to delete this data?
                </p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-check"></i> Yes
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-times"></i> No
                </button>
            </div>
            {{ Form::close() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

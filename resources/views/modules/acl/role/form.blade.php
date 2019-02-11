@push('styles')
    <style>
        label {
            display: inline;
        }
    </style>
@endpush
@if(isset($model))
    @php $permission_array = $model->permissions;
    if(isset($permission_array))
    {
        $permission_array = $permission_array->pluck('id')->toArray();
    }
    @endphp

    {{ Form::model($model, ['url' => route('dashboard.roles.update', $model->id), 'method' => 'PUT','files' => true]) }}
@else
    {{ Form::open(['url' => route('dashboard.roles.store'), 'method' => 'post', 'files' => true]) }}
@endif

<div class="row">
    <div class="col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                Basic Info
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            {!! Form::label('name', 'Name:', ['class' => 'form-label']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('display_name', 'Display Name:', ['class' => 'form-label']) !!}
                            {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('display_name', '<div class="text-danger">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description:', ['class' => 'form-label']) !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control text-editor', 'id' => 'description']) !!}
                            {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
                        </div>
                    </div>

                </div>
                 </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                <a href="{{URL::previous()}}" class="btn btn-danger btn-sm">Cancel</a>
            </div>

        </div>
    </div>

    <div class="col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                Permissions
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        @foreach(getPermissionList() as $key => $permission)
                            <div class="form-group">
                                @if(is_array($permission))
                                    <div class="custom-controls-stacked" id="div-{{$key}}">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="checkbox-{{ $key }}"
                                                   onclick="setPermissions('{{ $key }}',this)">
                                            <span class="custom-control-label">{{ucfirst($key) .': '}}</span>
                                        </label>

                                        <div style="padding-left: 25px;">
                                            @foreach($permission as $key_one => $value)
                                                <label class="custom-control custom-checkbox">
                                                    {!! Form::checkbox('permissions['.$key_one.']', $key_one , isset($model) && in_array($key_one, $permission_array) ? true : false, ['class' => 'custom-control-input'] ) !!}
                                                    <span class="custom-control-label">{{ucfirst( str_replace('.', ' ', $value)) .':'}}</span>
                                                    {!! $errors->first('permissions['.$value.']', '<div class="text-danger">:message</div>') !!}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="custom-controls-stacked">
                                        <span class="custom-control-label">{{ucfirst( str_replace('.', ' ', $permission)) .':'}}</span>
                                        {!! Form::checkbox('permissions['.$permission.']', true, isset($model) && isset($model->permissions[$value]) && $model->permissions[$value] ? true : false, ['class' => 'custom-control-input'] ) !!}
                                        {!! $errors->first('permissions['.$permission.']', '<div class="text-danger">:message</div>') !!}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                </div>
             </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                <a href="{{URL::previous()}}" class="btn btn-danger btn-sm">Cancel</a>
            </div>

        </div>
    </div>

</div>

{{ Form::close() }}

@push('scripts')
    <script type="text/javascript">
        function setPermissions(key, main) {
            value = $(main).prop('checked');
            $("#div-" + key + " input").each(function (e, item) {
                // console.log(item);
                $(item).prop('checked', value);
            });
        }
    </script>
@endpush

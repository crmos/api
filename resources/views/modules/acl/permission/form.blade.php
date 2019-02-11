@if(isset($model))
    {{ Form::model($model, ['url' => route('dashboard.permissions.update', $model->id), 'method' => 'PUT','files' => true]) }}
@else
    {{ Form::open(['url' => route('dashboard.permissions.store'), 'method' => 'post', 'files' => true]) }}
@endif

<div class="row">
    <div class="col-md-12 col-lg-12">
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
</div>

{{ Form::close() }}

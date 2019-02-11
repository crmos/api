@if(isset($model))
    {{ Form::model($model, ['url' => route('dashboard.users.update', $model->id), 'method' => 'PUT','files' => true]) }}
@else
    {{ Form::open(['url' => route('dashboard.users.store'), 'method' => 'post', 'files' => true]) }}
@endif

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Credential</h3>
            </div>
            <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12 col-lg-12">
                            <img src="{{isset($model)?$model->getImage():imageNotFound('user')}}" height = "150" id="user_img">
                        </div>

                        <div class="form-group col-md-12 col-lg-12">
                            {!! Form::label('user', 'Image:') !!}
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="user" name="user_image" onclick="uploader('user')">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                            <small id="user_help_text" class="help-block"></small>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                <div id="user_progress" class="progress-bar progress-bar-success" style="width: 0%">
                                </div>
                            </div>
                            <input  type="hidden" id="user_path" name="image" class="form-control" value="{{isset($model)?$model->image:''}}"/>
                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email:', ['class' => 'form-label']) !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
                    </div>

                @if(isset($model))
                <div class="form-group" id="js-authentication-section-off">
                    <button type="button" id="js-edit-user-authentication" class="btn btn-primary btn-sm btn-small">
                        Edit Credentials
                    </button>
                </div>
                @endif

                <div class="{{isset($model)?' u-hide ': ' '}}" id="js-authentication-section">
                        <div class="form-group">
                            {!! Form::label('password', 'Password:', ['class' => 'form-label']) !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                            {!! $errors->first('password', '<div class="text-danger">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Confirm Password:', ['class' => 'form-label']) !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                            {!! $errors->first('password_confirmation', '<div class="text-danger">:message</div>') !!}
                        </div>

                    @if(isset($model))
                        <div class="form-group">
                            {!! Form::label('old_password', 'Old Password:', ['class' => 'form-label']) !!}
                            {!! Form::password('old_password', ['class' => 'form-control']) !!}
                            {!! $errors->first('old_password', '<div class="text-danger">:message</div>') !!}
                        </div>
                    @endif


                    <div class="form-group">
                        {!! Form::label('status', 'Status:', ['class' => 'form-label']) !!}
                        {!! Form::select('status', getActiveInactiveStatus(), null, ['class' => 'form-control']) !!}
                        {!! $errors->first('status', '<div class="text-danger">:message</div>') !!}
                    </div>

                        <div class="form-group">
                            {!! Form::label('role', 'Role:', ['class' => 'form-label']) !!}
                            {!! Form::select('role', pluckRoleList(), isset($model)?($user->mainRole()?$user->mainRole()->id:null):null, ['class' => 'form-control']) !!}
                            {!! $errors->first('role', '<div class="text-danger">:message</div>') !!}
                        </div>

                </div>

            </div>
        </div>

    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Basic Info</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Name:', ['class' => 'form-label']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('user_name', 'User Name:', ['class' => 'form-label']) !!}
                            {!! Form::text('user_name', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('user_name', '<div class="text-danger">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('address', 'Address:', ['class' => 'form-label']) !!}
                            {!! Form::text('address', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('address', '<div class="text-danger">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('phone_number', 'Phone Number:', ['class' => 'form-label']) !!}
                            {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('phone_number', '<div class="text-danger">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('mobile_number', 'Mobile Number:', ['class' => 'form-label']) !!}
                            {!! Form::text('mobile_number', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('mobile_number', '<div class="text-danger">:message</div>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{URL::previous()}}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
      </div>
</div>


{{ Form::close() }}

@push('scripts')
    @include('admin.partials.common.file-upload')

    <script>
        $('#js-edit-user-authentication').on('click', function () {
            $('#js-authentication-section-off').hide("slow", function () {
            });
            $('#js-authentication-section').show("slow", function () {
            });
        });
    </script>
@endpush

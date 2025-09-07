<div class="col-md-3" style="float: left;">
    <div class="ibox ">
        <div class="ibox-title ibox-title-border">
            <h5>ME</h5>
        </div>
        <div>
            <div class="ibox-content no-padding text-center">
                <img style="margin: 16px 0; width: 200px;" alt="image" class="img-responsive" src="{{ asset('images/admin/default.jpg') }}">
            </div>
            <div class="ibox-content profile-content text-center">
                <h4><strong>{{ $data['profile']->first_name }}</strong></h4>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="feed-element">
                            <div class="media-body ">
                                <strong>Email</strong>: {{ $data['profile']->email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


<div class="col-md-9" style="float: right;">
    <div class="ibox ">

        <div class="">
            {!! Form::hidden('id', auth()->id()) !!}

            <div class="tabs-container">
                <ul class="nav nav-tabs" role="tablist">
                    <li><a class="nav-link active show " data-toggle="tab" href="#tab-1"> Personal Info</a></li>
                    <li><a class="nav-link " data-toggle="tab" href="#tab-2">Change Password</a></li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" id="tab-1" class="tab-pane active show">
                        <div class="panel-body">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label is_required">First Name <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('first_name'))
                                        <label class="has-error" for="first_name">{{ $errors->first('first_name') }}</label>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Middle Name </label>
                                <div class="col-sm-9">
                                    {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-3 col-form-label is_required">Last Name <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('last_name'))
                                        <label class="has-error" for="last_name">{{ $errors->first('last_name') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-3 col-form-label is_required">Email <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('email'))
                                        <label class="has-error" for="email">{{ $errors->first('email') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label is_required"><b>Status</b></label>
                                <div class="col-sm-9">
                                    @includeIf('admin.common.status_radio')
                                </div>
                            </div>


                        </div>
                    </div>
                    <div role="tabpanel" id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <div class="form-group  row">
                                <label class="col-sm-3 col-form-label">New Password</label>
                                <div class="col-sm-9">
                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                    @if($errors->has('password'))
                                        <label class="has-error" for="email">{{ $errors->first('password') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control">
                                    @if($errors->has('password_confirmation'))
                                        <label class="error" for="password_confirmation">{{ $errors->first('password_confirmation') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div style="display: none;">
                                {!! Form::select('roles[]',$data['roles'], $data['profile']->roles, [ 'class' => 'form-control select2_role', 'multiple' =>'multiple', 'id'=>'customSelect2']) !!}
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    @includeIf('admin.common.action')

</div>
<div style="clear: both;"></div>

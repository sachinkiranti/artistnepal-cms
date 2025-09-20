<div class="hr-line-dashed"></div>
<div class="form-group row">
    <div class="col-sm-4">
        <label class=" col-form-label is_required"><b>First Name <span class="required">*</span></b> </label>
        <div class=" {{ $errors->has('first_name')?'has-error':'' }}">
            {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
            @if($errors->has('first_name'))
                <label class="has-error" for="first_name">{{ $errors->first('first_name') }}</label>
            @endif
        </div>
    </div>


    <div class="col-sm-4">
        <label class=" col-form-label is_required"><b>Middle Name</b></label>
        <div class=" {{ $errors->has('middle_name')?'has-error':'' }}">
            {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
            @if($errors->has('middle_name'))
                <label class="has-error" for="middle_name">{{ $errors->first('middle_name') }}</label>
            @endif
        </div>
    </div>

    <div class="col-4">
        <label class=" col-form-label is_required"><b>Last Name <span class="required">*</span></b> </label>
        <div class=" {{ $errors->has('last_name')?'has-error':'' }}">
            {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
            @if($errors->has('last_name'))
                <label class="has-error" for="last_name">{{ $errors->first('last_name') }}</label>
            @endif
        </div>
    </div>
</div><!-- /.col-sm-12 -->

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label is_required"><b>Email</b> <span class="required">*</span></label>
    <div class="col-sm-12 {{ $errors->has('last_name')?'has-error':'' }}">
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
        @if($errors->has('email'))
            <label class="has-error" for="email">{{ $errors->first('email') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <div class="col-6">
        <div class="row">
            <label class="col-sm-12 col-form-label is_required"><b>Password @if (!isset($data['user']))<span class="required">*</span>@endif</b> </label>
            <div class="col-sm-12 {{ $errors->has('password')?'has-error':'' }}">
                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                @if($errors->has('password'))
                    <label class="has-error" for="password">{{ $errors->first('password') }}</label>
                @endif
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="row">
            <label class="col-sm-12 col-form-label is_required"><b>Confirm Password</b></label>
            <div class="col-sm-12 {{ $errors->has('password_confirmation')?'has-error':'' }}">
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-12">
        <small class="password-info">Password Must contain at least one lowercase, uppercase, digit and special character</small>
    </div>
</div>


<div class="hr-line-dashed"></div>

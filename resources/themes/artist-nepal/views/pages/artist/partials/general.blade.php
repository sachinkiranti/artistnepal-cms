<div class="modern-tabs mb-2">

    <ul class="nav nav-tabs" id="filledTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="artist-edit-profile-page-tab" data-bs-toggle="tab" data-bs-target="#artist-edit-profile-page" type="button" role="tab">
                <i class="fa fa-user-edit"></i> General
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="artist-password-tab" data-bs-toggle="tab" data-bs-target="#artist-password" type="button" role="tab">
                <i class="fa fa-user-secret"></i> Password
            </button>
        </li>
        <li class="nav-item float-end" role="presentation">
            <a class="nav-link" id="artist-view-profile" href="{{ route('artist.single', auth()->user()->unique_identifier) }}">
                <i class="fa fa-eye"></i> View Profile
            </a>
        </li>
    </ul>


    <div class="tab-content" id="filledTabsContent">
        <div class="tab-pane fade show active" id="artist-edit-profile-page" role="tabpanel">

            <div class="row">
                <div class="col-sm-12">
                    <div class=" {{ $errors->has('profession_id')?'has-error':'' }}">
                        <label class=" col-form-label is_required"><b>Profession <span class="required">*</span></b> </label>
                        {!! Form::select('profession_id', $data['categories'], null, [ 'class' => 'form-control select2', 'placeholder' => 'Select Profession' ]) !!}
                        @if($errors->has('profession_id'))
                            <label class="has-error" for="profession_id">
                                {{ $errors->first('profession_id') }}
                            </label>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-sm-4">
                    <div class=" {{ $errors->has('first_name')?'has-error':'' }}">
                        <label class=" col-form-label is_required"><b>Firstname <span class="required">*</span></b> </label>
                        {!! Form::text('first_name', null, [ 'class' => 'form-control', 'placeholder' => 'Enter your first name' ]) !!}
                        @if($errors->has('first_name'))
                            <label class="has-error" for="first_name">
                                {{ $errors->first('first_name') }}
                            </label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class=" {{ $errors->has('middle_name')?'has-error':'' }}">
                        <label class=" col-form-label is_required"><b>Middlename <span class="required">*</span></b> </label>
                        {!! Form::text('middle_name', null, [ 'class' => 'form-control', 'placeholder' => 'Enter your middle name' ]) !!}
                        @if($errors->has('middle_name'))
                            <label class="has-error" for="middle_name">
                                {{ $errors->first('middle_name') }}
                            </label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class=" {{ $errors->has('last_name')?'has-error':'' }}">
                        <label class=" col-form-label is_required"><b>Lastname <span class="required">*</span></b> </label>
                        {!! Form::text('last_name', null, [ 'class' => 'form-control', 'placeholder' => 'Enter your last name' ]) !!}
                        @if($errors->has('last_name'))
                            <label class="has-error" for="last_name">
                                {{ $errors->first('last_name') }}
                            </label>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-sm-4">
                    <div class=" {{ $errors->has('image_holder')?'has-error':'' }}">
                        <label class=" col-form-label is_required"><b>Profile picture <span class="required">*</span></b> </label>

                        @php
                            $file = [
                                'id' => 'image_path',
                                'class' => 'form-control dropify img-responsive',
                                'data-plugin' => 'dropify',
                                'data-height' => '200',
                                'data-show-remove'=>'false',
                                'data-allowed-file-extensions'=>'pdf png psd jpeg jpg gif',
                                'data-disable-remove'=> 'true',
                                'data-max-file-size' => '2M',
                            ];
                        @endphp

                        {!! Form::file('image_holder', auth()->user()->getImage() ? array_merge($file,
                           ['data-default-file' => auth()->user()->getImage()]):$file)
                           !!}

                        @if($errors->has('image_holder'))
                            <label class="has-error" for="image_holder">
                                {{ $errors->first('image_holder') }}
                            </label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class=" {{ $errors->has('banner_holder')?'has-error':'' }}">
                        <label class=" col-form-label is_required"><b>Banner <span class="required">*</span></b> </label>

                        @php
                            $file2 = [
                                'id' => 'image_path',
                                'class' => 'form-control dropify img-responsive',
                                'data-plugin' => 'dropify',
                                'data-height' => '200',
                                'data-show-remove'=>'false',
                                'data-allowed-file-extensions'=>'pdf png psd jpeg jpg gif',
                                'data-disable-remove'=> 'true',
                                'data-max-file-size' => '2M',
                            ];
                        @endphp

                        {!! Form::file('banner_holder', $data['profile']->getBannerImage() ? array_merge($file2,
                           ['data-default-file' => $data['profile']->getBannerImage()]):$file2)
                           !!}

                        @if($errors->has('banner_holder'))
                            <label class="has-error" for="banner_holder">
                                {{ $errors->first('banner_holder') }}
                            </label>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-sm-12">
                    <div class=" {{ $errors->has('bio')?'has-error':'' }}">
                        {!! Form::textarea('bio', null, [ 'class' => 'form-control tinymce', 'placeholder' => '' ]) !!}
                        @if($errors->has('bio'))
                            <label class="has-error" for="bio">
                                {{ $errors->first('bio') }}
                            </label>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="artist-password" role="tabpanel">
            <div class="row">
                <div class="col-sm-12">
                    <div class="{{ $errors->has('old_password')?'has-error':'' }}">
                        <label class="col-form-label is_required"><b>Old Password <span class="required">*</span></b></label>
                        <div class="input-group">
                            {!! Form::password('old_password', [ 'class' => 'form-control', 'id' => 'old_password', 'placeholder' => 'Enter Old Password' ]) !!}
                            <span class="input-group-text toggle-password" data-target="#old_password">
                    <i class="fa fa-eye"></i>
                </span>
                        </div>
                        @if($errors->has('old_password'))
                            <label class="has-error" for="old_password">
                                {{ $errors->first('old_password') }}
                            </label>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="{{ $errors->has('new_password')?'has-error':'' }}">
                        <label class="col-form-label is_required"><b>New Password <span class="required">*</span></b></label>
                        <div class="input-group">
                            {!! Form::password('new_password', [ 'class' => 'form-control', 'id' => 'new_password', 'placeholder' => 'Enter New Password' ]) !!}
                            <span class="input-group-text toggle-password" data-target="#new_password">
                    <i class="fa fa-eye"></i>
                </span>
                        </div>
                        @if($errors->has('new_password'))
                            <label class="has-error" for="new_password">
                                {{ $errors->first('new_password') }}
                            </label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="{{ $errors->has('password_confirmation')?'has-error':'' }}">
                        <label class="col-form-label is_required"><b>Password Confirmation <span class="required">*</span></b></label>
                        <div class="input-group">
                            {!! Form::password('password_confirmation', [ 'class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Confirm Password' ]) !!}
                            <span class="input-group-text toggle-password" data-target="#password_confirmation">
                    <i class="fa fa-eye"></i>
                </span>
                        </div>
                        @if($errors->has('password_confirmation'))
                            <label class="has-error" for="password_confirmation">
                                {{ $errors->first('password_confirmation') }}
                            </label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('js')
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    <script>
        $(function () {
            $('.toggle-password').click(function(){
                var input = $($(this).data('target'));
                var icon = $(this).find('i');
                if(input.attr('type') === 'password'){
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            $('.dropify').dropify();
        })
    </script>
@endpush

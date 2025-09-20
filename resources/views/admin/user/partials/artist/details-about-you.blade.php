<div role="tabpanel" id="tab-details-about-you" class="tab-pane active show">
    <div class="panel-body">
        <div class="form-group row">
            <label class="col-sm-12 col-form-label is_required"><b>Gender</b></label>
            <div class="col-sm-12">
                <div class="i-checks mt-2">
                    <label for="male" style="cursor:pointer;">
                        {!! Form::radio('gender', 0, true, ['id' => 'male']) !!} <i></i> Male
                    </label>
                    &nbsp;
                    <label for="female" style="cursor:pointer;">
                        {!! Form::radio('gender', 1, false, ['id' => 'female']) !!} <i></i> Female
                    </label>
                    &nbsp;
                    <label for="others" style="cursor:pointer;">
                        {!! Form::radio('gender', 2, false, ['id' => 'Others']) !!} <i></i> Others
                    </label>
                    <div>
                        @if($errors->has('gender'))
                            <label class="has-error" for="gender">{{ $errors->first('gender') }}</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class=" col-form-label is_required"><b>Date of birth <span class="required">*</span></b> </label>
                <div class=" {{ $errors->has('dob')?'has-error':'' }}">
                    {!! Form::date('dob', null, ['class' => 'form-control']) !!}
                    @if($errors->has('dob'))
                        <label class="has-error" for="dob">{{ $errors->first('dob') }}</label>
                    @endif
                </div>
            </div>

            <div class="col-sm-4">
                <label class=" col-form-label is_required">
                    <b>Artist Start Year <span class="required">*</span></b>
                </label>
                <div class=" {{ $errors->has('start_year')?'has-error':'' }}">
                    {!! Form::text('start_year', null, [ 'class' => 'form-control', ]) !!}
                    @if($errors->has('start_year'))
                        <label class="has-error" for="start_year">{{ $errors->first('start_year') }}</label>
                    @endif
                </div>
            </div>

            <div class="col-sm-4">
                <label class=" col-form-label is_required">
                    <b>Place of birth <span class="required">*</span></b>
                </label>
                <div class=" {{ $errors->has('country_id')?'has-error':'' }}">

                    {!! Form::select('country_id', \Foundation\Lib\Country::COUNTRY_LIST ?? [], null, [ 'class' => 'form-control', ]) !!}

                    @if($errors->has('country_id'))
                        <label class="has-error" for="country_id">{{ $errors->first('country_id') }}</label>
                    @endif
                </div>

            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="row">
            <div class="col-sm-6">
                <label class=" col-form-label is_required">
                    <b>Father Name <span class="required">*</span></b>
                </label>
                <div class=" {{ $errors->has('father_name')?'has-error':'' }}">
                    {!! Form::text('father_name', null, [ 'class' => 'form-control', ]) !!}
                    @if($errors->has('father_name'))
                        <label class="has-error" for="father_name">{{ $errors->first('father_name') }}</label>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <label class=" col-form-label is_required">
                    <b>Mother Name <span class="required">*</span></b>
                </label>
                <div class=" {{ $errors->has('mother_name')?'has-error':'' }}">
                    {!! Form::text('mother_name', null, [ 'class' => 'form-control', ]) !!}
                    @if($errors->has('mother_name'))
                        <label class="has-error" for="mother_name">{{ $errors->first('mother_name') }}</label>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script>
        $(function () {
            $('select[name="country_id"]').select2()
        })
    </script>
@endpush

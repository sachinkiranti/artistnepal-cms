<div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>General Info</h5>
        </div>
        <div class="ibox-content">
            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Name <span class="required">*</span></label>
                <div class="col-sm-12 {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::text('name', null, [ 'class' => 'form-control post-title' ]) !!}
                    @if($errors->has('name'))
                        <label class="has-error" for="name">{{ $errors->first('name') }}</label>
                    @endif
                </div>
            </div>

{{--            <div class="hr-line-dashed"></div>--}}
{{--            <div class="form-group row">--}}
{{--                <label class="col-sm-12 col-form-label is_required">Slug <span class="required">*</span></label>--}}
{{--                <div class="col-sm-12 {{ $errors->has('slug') ? 'has-error' : '' }}">--}}
{{--                    {!! Form::text('slug', null, [ 'class' => 'form-control post-title' ]) !!}--}}
{{--                    @if($errors->has('slug'))--}}
{{--                        <label class="has-error" for="slug">{{ $errors->first('slug') }}</label>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="hr-line-dashed"></div>
            <div class="form-group row col-sm-12">
                @php
                    $file = [
                        'id' => 'image-path',
                        'class' => 'form-control dropify img-responsive',
                        'data-plugin' => 'dropify',
                        'data-height' => 200,
                        'data-show-remove' => false,
                        'data-allowed-file-extensions' => 'png jpeg jpg gif',
                        'data-disable-remove' => true,
                        'data-max-file-size' => '2M',
                    ];

                    if (isset($data['gallery']->thumbnail) && file_exists(public_path('storage/images/gallery/'.$data['gallery']->thumbnail))) {
                        $file['data-default-file'] = asset('storage/images/gallery/'.$data['gallery']->thumbnail);
                    }
                @endphp

                {!! Form::file('image_holder', $file, [ 'class' => 'form-control', ]) !!}
                @if($errors->has('image_holder'))
                    <label class="has-error" for="image_holder">{{ $errors->first('image_holder') }}</label>
                @endif
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group row">
                <label class="col-sm-12 col-form-label is_required">Content</label>
                <div class="col-sm-12 {{ $errors->has('content') ? 'has-error' : '' }}">
                    {!! Form::textarea('content', null, [ 'class' => 'form-control', 'id' => 'content', 'rows' => 3, ]) !!}
                    @if($errors->has('content'))
                        <label class="has-error" for="content">{{ $errors->first('content') }}</label>
                    @endif
                </div>
            </div>
            <div class="hr-line-dashed"></div>

        </div>
    </div>
</div>

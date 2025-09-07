<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label is_required">Display picture</label>
    <div class="col-sm-12 {{ $errors->has('image_holder') ? 'has-error' : '' }}">

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

            if (isset($data['user']->image) && file_exists(public_path('storage/images/users/'.$data['user']->image))) {
                $file['data-default-file'] = asset('storage/images/users/'.$data['user']->image);
            }
        @endphp

        {!! Form::file('image_holder', $file, [ 'class' => 'form-control', ]) !!}
        @if($errors->has('image_holder'))
            <label class="has-error" for="image_holder">{{ $errors->first('image_holder') }}</label>
        @endif
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <label for="roles">Biography</label>

    {!! Form::textarea('information', null, [ 'class' => 'form-control', 'rows' => '5', 'placeholder' => 'Write about yourself ...' ]) !!}
    @if($errors->has('information'))
        <label class="has-error" for="roles">{{ $errors->first('information') }}</label>
    @endif
</div>

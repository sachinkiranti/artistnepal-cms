@php
    $randomNo = \Foundation\Lib\Utility::randomNumber();
    $counter  = \Foundation\Lib\Utility::randomNumber();
@endphp

<tr class="gallery-row">
    <td colspan="3">
        <p class="pull-right">
            <a href="#" class="btn btn-danger btn-xs delete-gallery" title="Remove the image"><i class="fa fa-trash-o"></i></a>
        </p>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label is_required">Title <span class="required">*</span></label>
            <div class="col-sm-12 {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::text('title[]', $picture->title ?? null, [ 'class' => 'form-control', 'placeholder' => 'Enter the title', ]) !!}
                @if($errors->has('title'))
                    <label class="has-error" for="title">{{ $errors->first('title') }}</label>
                @endif
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group gallery-media-wrapper">
            <div class="col-sm-12">
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail{{ $randomNo }}" data-preview="holder{{ $randomNo }}" class="btn btn-dark" style="color: #FFF;">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail{{ $randomNo }}" value="{{ $image ?? '' }}" class="form-control" type="text" name="image[]">
                </div>
                <div id="holder{{ $randomNo }}" style="margin-top:15px;max-height:100px;margin-bottom:15px;" class="gallery-media-holder">
                    @isset($image)
                        <img src="{{ $image ?? '' }}" style="height: 5rem;" class="img-responsive">
                    @endisset
                </div>
            </div>
        </div>

        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-12 col-form-label is_required">Caption</label>
            <div class="col-sm-12 {{ $errors->has('caption') ? 'has-error' : '' }}">
                {!! Form::textarea('caption[]', $picture->caption ?? null, [ 'class' => 'form-control', 'rows' => '2', ]) !!}
                @if($errors->has('caption'))
                    <label class="has-error" for="caption">{{ $errors->first('caption') }}</label>
                @endif
            </div>
        </div>
    </td>
</tr>

@php
    $randomNo = \Foundation\Lib\Utility::randomNumber();
    $counter  = $postId ?? \Foundation\Lib\Utility::randomNumber();
@endphp
<tr class="advertisement-row">
    <td>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail{{ $randomNo }}" data-preview="holder{{ $randomNo }}" class="btn btn-dark" style="color: #FFF;">
                    <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
            <input id="thumbnail{{ $randomNo }}" value="{{ $image ?? '' }}" class="form-control" type="text" name="advertisement[{{ $widgetId }}][{{ $counter }}][{{ $position }}][image][]">
        </div>
        <div id="holder{{ $randomNo }}" class="wrapper-advertisement" style="margin-top:15px;max-height:100px;margin-bottom:15px;">
            @isset($image)
                <img src="{{ $image ?? '' }}" style="height: 5rem; width: 45%;" class="img-responsive">
            @endisset
        </div>
    </td>
    <td>
        <input value="{{ $caption ?? '' }}" name="advertisement[{{ $widgetId }}][{{ $counter }}][{{ $position }}][caption][]" type="url" class="form-control" placeholder="Enter the url">
    </td>
    <td><a href="#" class="btn btn-xs btn-danger delete-advertisement" data-widget-counter-position="{{ $widgetId .'.'. $counter .'.'. $position }}"><i class="fa fa-trash"></i></a></td>
</tr>

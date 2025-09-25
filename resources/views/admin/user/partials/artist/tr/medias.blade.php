<tr class="media-row default-media-template">

    @php
        $errorKey = "medias.{$index}";
    @endphp

    <input type="hidden" name="medias[{{ $index ?? null }}][id]" class="form-control" value="{{ $media['id'] ?? '' }}">
    <td>
        <select name="medias[{{ $index ?? null }}][media_type]" class="form-control media-type">
            @foreach(Foundation\Enums\MediaType::dropdown() as $mediaTypeIndex => $mediaType)
                <option value="{{ $mediaTypeIndex }}" {{ (isset($media['media_type']) && $media['media_type'] == $mediaTypeIndex) ? 'selected' : '' }}>{{ $mediaType }}</option>
            @endforeach
        </select>

        @if($errors->has($errorKey.".media_type"))
            <label class="has-error" for="medias[{{ $index }}][media_type]">{{ $errors->first($errorKey.".media_type") }}</label>
        @endif
    </td>
    <td>
        <input type="{{ (isset($media['media_type']) && $media['media_type'] == \Foundation\Enums\MediaType::VIDEO->value) ? 'url' : 'file' }}"
               name="medias[{{ $index ?? null }}][media]"
               value="{{ $media['url'] ?? null }}"
               class="form-control media-input">
        <div class="preview mt-1">
            @if(isset($media['media_type']) && $media['media_type'] == \Foundation\Enums\MediaType::IMAGE->value && isset($media['url']))
                <img src="{{ $media->getImage() }}" style="max-width: 100px;">
            @endif
        </div>

        @if($errors->has($errorKey.".media"))
            <label class="has-error" for="medias[{{ $index }}][media]">{{ $errors->first($errorKey.".media") }}</label>
        @endif
    </td>
    <td>
        <textarea name="medias[{{ $index ?? null }}][title]" class="form-control" rows="2">{{ $media['title'] ?? '' }}</textarea>

        @if($errors->has($errorKey.".title"))
            <label class="has-error" for="medias[{{ $index }}][title]">{{ $errors->first($errorKey.".title") }}</label>
        @endif
    </td>
    <td>
        <textarea name="medias[{{ $index ?? null }}][description]" class="form-control" rows="2">{{ $media['description'] ?? '' }}</textarea>
        @if($errors->has($errorKey.".description"))
            <label class="has-error" for="medias[{{ $index }}][description]">{{ $errors->first($errorKey.".description") }}</label>
        @endif
    </td>
    <td>
        <button type="button" class="btn btn-danger btn-xs remove-row">
            <i class="fa fa-trash"></i>
        </button>
    </td>
</tr>

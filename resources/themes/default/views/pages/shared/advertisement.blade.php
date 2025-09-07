@isset($advertisements)
    @foreach($advertisements as $image => $caption)

        @if(isset($image) && !is_null($image) && !empty($image))
        <div
            class="{{ $class ?? 'adv adv-full' }} ad-wrapper"
            style="margin-top: 15px;"
            data-index="{{ $index }}"
            data-type="{{ $type }}"
            data-widget="{{ $template ?? '' }}"
        >
            <a href="{{ $caption }}" title="{{ $caption }}" target="_blank">
                <img src="{{ $image }}" alt="adv-{{ $caption ?? '' }}">
            </a>
        </div>
        @endif

    @endforeach
@endisset

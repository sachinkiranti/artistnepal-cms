@extends('layouts.master')

@section('title', 'Gallery')

@push('styles')
    <link rel="stylesheet" href="{{ theme_asset('css/gallery.min.css') }}">
@endpush

@section('content')

    @if ($uniqueIdentifier)
        <section class="hk-gallery">
            <div class="container">
                <h2><span>{{ $data['gallery']->name }}</span></h2>
                <ul id="lightgallery" class="list-unstyled row">
                    @forelse($data['pictures'] as $picture)
                        <li class="col-xs-6 col-sm-4 col-md-3" data-src="{{ $picture->image }}" data-sub-html="{{$picture->caption}}">
                            <figure>
                                <a href="javascript:void(0);">
                                    <img class="img-responsive" src="{{ $picture->image }}"  alt="{{ $picture->title }}">
                                </a>
                            </figure>
                        </li>
                    @empty
                        <p class="text-center">No Images !</p>
                    @endforelse
                </ul>
            </div>
        </section>
    @else

        <section class="hk-gallery">
            <div class="container">
                <h2><span>{{ active_lang() === 'en' ? 'Photo Gallery' :  'फोटो ग्यालरी' }}</span></h2>
                <div class="row">
                    @forelse($data['gallery'] as $gallery)
                        <div class="col-4">
                            <figure>
                                <a href="{{ route('gallery', $gallery->unique_identifier) }}">
                                    <img src="{{ resolve_image($gallery->thumbnail, null, '/images/gallery/') }}">
                                    <figcaption>
                                        <h4>{{ $gallery->name }} </h4>
                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                        @empty
                        <p class="text-center">{{ 'No Gallery Added!' }}</p>
                    @endforelse
            </div>
        </section>
    @endif

@endsection

@push('scripts')
    <script src="{{ theme_asset('js/gallery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#lightgallery').lightGallery();
        });
    </script>
@endpush

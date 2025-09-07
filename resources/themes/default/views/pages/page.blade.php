@extends('layouts.master')

@section('title', $data['page']->title)

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">

    @include('pages.shared.metas', [
        'title'         => $data['page']->title,
        'description'   => \Foundation\Builders\Cache\Meta::get('seo_desc'),
        'image_url'     => asset( 'storage/images/setting/'.\Foundation\Builders\Cache\Meta::get('social_homepage_image')),
    ])
@endpush

@section('content')

    <div class="container">

        <div class="single-detail">

            <div class="row">
                <div class="col-9">
                    <div class="detail-head">

                        <h1>{{ $data['page']->title }}</h1>
                        <div class="short-content">
                            <p>
                                {!! \Illuminate\Support\Str::limit($data['page']->content, 20) !!}
                            </p>
                        </div>
                        <div class="single-meta">
                            <div class="writer-info">
                                <a href="#" title=""><img loading="lazy" src="images/pic.gif" alt="pic"></a>
                                <a href="#" title=""><span>शिव मुखिया ,</span></a>
                            </div>
                            <span class="publish-date">प्रकाशित
									<time datetime="२७ भदौ २०७५, बुधबार">२७ भदौ २०७५, बुधबार</time> |  <time datetime="2018-09-12 19:45:58">2018-09-12 19:45:58</time>
								</span>
                        </div>

                    </div>
                    <!-- /detail head -->

                    <div class="wrap-main-content">
                        <div class="main-news-content">
                            @if($image = $data['page']->image)
                                <div class="features-image">
                                    <img loading="lazy" src="{{ asset('storage/images/post/'.$image) }}" alt="">
                                </div>
                            @endif
                            <div class="content-news">
                                {!! $data['page']->content !!}
                            </div>
                            <!-- /content news -->

                        </div>
                    </div>
                    <!-- /wrap main content -->

                </div>
                <div class="col-3">

                    {!! $components['page-sidebar-component'] ?? '' !!}

                </div>

            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        $(function () {
            $('.tablinks.active').click();
        });
    </script>
@endpush

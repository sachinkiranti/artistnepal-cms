@extends('layouts.master')

@section('title', '')

@section('promo-banner', 'https://artistnepal.com/wp-content/uploads/2025/09/HARD-ROCK.jpg')

@section('promo-container')
    <hr class="line pr__hr__secondary">
    <h2 class="page-title  uk-heading-primary" style="color: white;">{{ $data['user']->getFullName() }}</h2>
@endsection

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
@endpush

@section('content')
    <hr class="pr__vr__section">

    <section class="pr__clients pr__section uk-section uk-section-large" id="pr__clients">
        <div class="uk-container">
            <div class="section-outer">
                <div class="uk-flex uk-flex-middle uk-grid uk-grid-large" data-uk-grid="">
                    <div class="right uk-width-expand">
                        <div class="section-heading">
                            <div class="inner">
                                <div class="left">
                                    <hr class="line pr__hr__secondary">
                                    <div>
                                        <h2 class="title uk-h1 "
                                            style="display: inline-block">{{ $data['user']->getFullName() }}</h2>
                                    </div>

                                    <span class="subtitle pr__heading__secondary">Singer/ Performer</span></div>

                                <div class="right">
                                    <a href="https://artistnepal.com/wp-login.php"
                                       class="button uk-button uk-button-large uk-button-default uk-margin-top login-required">Login
                                        to Follow</a></div>
                            </div>
                        </div>
                        <div class="pr__entry__sidebar uk-width-1-5@l uk-flex-first@l uk-hidden@m">
                            <div class="pr__entry__meta pr__vr">
                                <ul class="content uk-list uk-list-divider">
                                    <li class="author">
                                        <strong>Artist Name:</strong>
                                        <span>{{ $data['user']->getFullName() }}</span>
                                    </li>
                                    <li class="date">
                                        <strong>Profession</strong>
                                        <span>Singer/ Performer</span>
                                    </li>
                                    <li>
                                    </li>
                                </ul>
                            </div>
                            <div class="pr__entry__share pr__small">
                            </div>
                            <br/>
                        </div>
                        <div class="section-inner">
                            <div class="item client-box style-one">
                                <div class="outer">
                                    <div class="inner">
                                        <div class="description"><p><!--StartFragment --><strong>Wangden Sherpa</strong>
                                                is a <strong>singer-songwriter</strong> from Kathmandu, Nepal, known for
                                                his rich bass vocals and genre-blending compositions. He began his
                                                musical journey at age 13, posting acoustic covers online before
                                                launching his debut studio album, <em>Tangled in You</em>—a heartfelt
                                                fusion of Nepali and English lyrics that traces emotional landscapes
                                                from Nepal to Texas.</p>
                                            <p>Wangden’s music combines folk-pop sensibilities with global influences,
                                                collaborating with artists like <strong>Chuck Leah</strong>, <strong>Kiran
                                                    Nepali</strong>, and <strong>Evan Bakke</strong>. His viral
                                                tracks—<em>“Ali Ali,”</em> <em>“Timi Nacha Na,”</em> and <em>“Kathmandu
                                                    Cowboy”</em>—have garnered millions of views across YouTube and
                                                TikTok. He’s also known for his witty social media presence, making him
                                                a relatable figure among Nepali youth.</p>
                                            <p><!--EndFragment --></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left uk-width-2-5@m uk-flex-first">
                        <div class="item client-box style-one client-image">
                            <div class="image pr__image__cover pr__ratio__portrait"
                                 data-src="{{ $data['user']->getImage() }}"
                                 data-uk-img=""></div>
                        </div>
                    </div>
                </div><!-- Grid End -->
            </div><!-- Outer End -->
        </div><!-- Container End -->
    </section>

    <hr class="pr__vr__section">

    <div class="pr__primary uk-section uk-section-medium" id="site-primary">
        <div class="outer">
            <div class="uk-container uk-position-relative">
                <div class="inner uk-grid uk-grid-large uk-grid-match" data-uk-grid="">
                    <div class="uk-width-expand">
                        <main class="pr__main" id="site-main">
                            <article class="uk-article post type-post single-post">

                                <div class="outer uk-grid uk-grid-large uk-flex" data-uk-grid="">
                                    <div class="inner uk-width-expand">

                                        <main class="pr__main" id="site-main">
                                            <article class="uk-article page type-page">
                                                <div class="outer">
                                                    <div class="inner">
                                                        <h5 class="uk-h4">My Experiences</h5>
                                                    </div>
                                                </div>

                                            </article>
                                        </main>
                                        <section class="pr__services pr__section uk-section">
                                            <div class="section-outer">
                                                <div class="section-heading">
                                                    <div class="uk-container">
                                                        <div class="inner">
                                                            <div class="left">
                                                                <hr class="line pr__hr__secondary">
                                                                <h2 class="title uk-h1">Galleries</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="section-inner">
                                                    <div class="uk-container">
                                                        <div class="gallery-wrap">
                                                            <div class="gallery-grid">
                                                                <div class="grid-item">
                                                                    <a href="https://artistnepal.com/wp-content/uploads/2025/07/Wangden-Sherpa-is-a-singer-songwriter-1024x852.jpg"
                                                                       data-fancybox="gallery">
                                                                        <img
                                                                            src="https://artistnepal.com/wp-content/uploads/2025/07/Wangden-Sherpa-is-a-singer-songwriter-1024x852.jpg"
                                                                            style="width: 100%">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="pr__entry__sidebar uk-width-1-5@l uk-flex-first@l">
                                        <div class="pr__entry__meta pr__vr">
                                            <ul class="content uk-list uk-list-divider">
                                                <li class="author">
                                                    <strong>Artist Name:</strong>
                                                    <span>{{ $data['user']->getFullName() }}</span>
                                                </li>
                                                <li class="date">
                                                    <strong>Profession</strong>
                                                    <span>Singer/ Performer</span>
                                                </li>
                                                <li>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="pr__entry__share pr__small">
                                        </div>
                                    </div>
                                </div>

                            </article>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pr__blog pr__section section-slider uk-section uk-section-xsmall uk-section-default" id="pr__blog">
        <div class="section-outer">
            <div class="section-heading">
                <div class="uk-container">
                    <div class="inner">
                        <div>
                            <hr class="line pr__hr__secondary">
                            <h2 class="title uk-h3 pr__heading__secondary">Similar Artists.</h2>
                        </div>
                    </div>
                </div><!-- Container End -->
            </div><!-- Heading End -->
            <div class="section-inner">
                <div class="uk-container">
                    <div class="blog-listing style-two blog-slider uk-grid uk-grid-collapse uk-child-width-1-3@m"
                         data-uk-grid="">
                        <div class="item">
                            <article class="post type-post ">
                                <div class="outer">
                                    <div class="featured-image">
                                        <div class="image pr__image__cover"
                                             data-src="https://artistnepal.com/wp-content/uploads/2025/08/Brijesh-Shrestha-is-a-celebrated-Nepali-R-B-artist-known-for-his-soulful-voice-and-genre-blending-compositions-3--1024x1024.jpg"
                                             data-uk-img=""></div>
                                    </div>
                                    <div class="inner">
                                        <div class="top">
                                            <a class="category" href="#"></a>
                                            <h3 class="title uk-h4"><a href="#">Brijesh Shrestha</a></h3>
                                            <p class="description">Brijesh Shrestha is a celebrated Nepali R&amp;B
                                                artist known for his soulful voice and genre-blending compositions. He
                                                began his music...</p>
                                            <a href="https://artistnepal.com/artist/brijeshshrestha/" class="link"></a>
                                        </div>
                                        <div class="bottom">
                                            <ul class="meta">
                                                <li class="meta-date">Music artists / Singer/ Performer</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="item">
                            <article class="post type-post ">
                                <div class="outer">
                                    <div class="featured-image">
                                        <div class="image pr__image__cover"
                                             data-src="https://artistnepal.com/wp-content/uploads/2025/08/Pooja-Pariyar-is-a-versatile-Nepali-singer-and-performer-known-for-her-emotive-vocals-and-musical-depth-4--1024x1024.jpg"
                                             data-uk-img=""></div>
                                    </div>
                                    <div class="inner">
                                        <div class="top">
                                            <a class="category" href="#"></a>
                                            <h3 class="title uk-h4"><a href="#">Pooja Pariyar</a></h3>
                                            <p class="description">Pooja Pariyar is a versatile Nepali singer and
                                                performer known for her emotive vocals and musical depth. She gained
                                                national...</p>
                                            <a href="https://artistnepal.com/artist/poojapariyar/" class="link"></a>
                                        </div>
                                        <div class="bottom">
                                            <ul class="meta">
                                                <li class="meta-date">Music artists / Singer/ Performer</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="item">
                            <article class="post type-post ">
                                <div class="outer">
                                    <div class="featured-image">
                                        <div class="image pr__image__cover"
                                             data-src="https://artistnepal.com/wp-content/uploads/2025/08/Hari-Karmacharya-is-a-dynamic-Nepali-singer-lyricist-and-composer-known-for-his-vibrant-contributions-to-modern-and-folk-inspired-Nepali-music-2-.jpg"
                                             data-uk-img=""></div>
                                    </div>
                                    <div class="inner">
                                        <div class="top">
                                            <a class="category" href="#"></a>
                                            <h3 class="title uk-h4"><a href="#">Hari Karmacharya (Gloomy Guys)</a></h3>
                                            <p class="description">Hari Karmacharya is a dynamic Nepali singer,
                                                lyricist, and composer known for his vibrant contributions to modern and
                                                folk-inspired Nepali...</p>
                                            <a href="https://artistnepal.com/artist/harikarmacharya/" class="link"></a>
                                        </div>
                                        <div class="bottom">
                                            <ul class="meta">
                                                <li class="meta-date">Music artists / Music Band / pop artist / Singer/
                                                    Performer
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div><!-- Container End -->
            </div><!-- Inner End -->
        </div><!-- Outer End -->
    </section>

    @include('shared.login-popup')
@endsection

@push('css')
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <style>
        @media only screen and (min-width: 1200px) {
            .gallery-wrap {
                width: calc(100vw - 25%);
                margin-left: calc(-50vw + 50%);
            }
        }

        .grid-item {
            width: calc(33.33% - 20px);
            padding: 10px;
        }

        @media only screen and (max-width: 769px) {
            .grid-item {
                width: calc(50% - 10px);
                padding: 5px;
            }
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('dist/themes/artist-nepal/js/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('dist/themes/artist-nepal/js/masonry.pkgd.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <script>
        $(function () {
            var grids = document.querySelectorAll('.gallery-grid');
            grids.forEach(function (grid) {
                var msnry;
                imagesLoaded(grid, function () {
                    // init Isotope after all images have loaded
                    msnry = new Masonry(grid, {
                        itemSelector: '.grid-item',
                        //columnWidth: '.grid-sizer',
                        percentPosition: true,
                        //gutter: 10
                    });
                });
            });
        })
    </script>
@endpush

@extends('layouts.master')

@section('title', '')

@section('header-style', 'promo--vsmall')

@section('promo-banner', asset('/dist/themes/artist-nepal/img/banner-n.png'))

@section('promo-container')
    <hr class="line pr__hr__secondary">
    <h2 class="title uk-heading-hero">For Artist</h2>
@endsection

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
@endpush

@section('content')

    <div class="pr__wrapper" id="site-wrapper">
        <div class="pr__content" id="site-content">

            <div class="pr__primary uk-section uk-section-medium" id="site-primary">
                <div class="outer">
                    <div class="uk-container uk-position-relative">
                        <div class="inner uk-grid uk-grid-large uk-grid-match uk-grid-stack" data-uk-grid="">
                            <div class="uk-width-expand uk-first-column">
                                <main class="pr__main" id="site-main">
                                    <article class="uk-article post type-post single-post">
                                        <div class="outer uk-grid uk-grid-large uk-flex uk-grid-stack" data-uk-grid="">
                                            <div class="inner uk-width-expand uk-first-column">
                                                <div class="entry-body">
                                                    <figure class="wp-caption aligncenter" data-uk-lightbox="">
                                                        <img width="1" height="1"
                                                             src="https://artistnepal.com/wp-content/uploads/2020/03/1.jpg"
                                                             class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                                             alt="dot" decoding="async"></figure>
                                                    <div
                                                        style="background: linear-gradient(135deg, #6C63FF, #FF6584); color: white; padding: 80px 20px; text-align: center; position: relative; overflow: hidden; margin: 0; width: 100%; max-width: 100%; font-family: 'Poppins', sans-serif;">
                                                        <!-- Decorative elements --><p></p>
                                                        <div
                                                            style="position: absolute; top: -100px; right: -100px; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                                                        <div
                                                            style="position: absolute; bottom: -50px; left: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                                                        <div
                                                            style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px; position: relative; z-index: 2;">
                                                            Where Your Artistry Shines
                                                        </div>
                                                        <h1 style="font-size: 2.8rem; margin-bottom: 25px; position: relative; z-index: 2; max-width: 800px; margin-left: auto; margin-right: auto; line-height: 1.3;">
                                                            Nepal’s Leading Artist Discovery Platform<br>
                                                        </h1>
                                                        <p style="font-size: 1.3rem; max-width: 800px; margin: 0 auto 40px; position: relative; z-index: 2; font-style: italic;">
                                                            Build your genuine fanbase on ArtistNepal.<br>
                                                            Share your true story, update accurate information about
                                                            yourself,<br>
                                                            and create a community that supports you every step of the
                                                            way.
                                                        </p>
                                                        <p>
                                                            <a href="https://artistnepal.com/artist/register/"
                                                               class="sign-up-now-for-free">
                                                                Sign Up Now for FREE!<br>
                                                            </a>
                                                        </p></div>
                                                    <div
                                                        style="max-width: 1000px; margin: 0 auto; padding: 40px 20px 60px; font-family: 'Poppins', sans-serif;">
                                                        <div style="text-align: center; margin-bottom: 60px;">
                                                            <h2 style="font-size: 2.2rem; color: #e10d6e; margin-bottom: 30px;">
                                                                Your Creative Journey Starts Here<br>
                                                            </h2>
                                                            <p style="font-size: 1.1rem; color: #2D3748; margin-bottom: 30px; line-height: 1.7; max-width: 800px; margin-left: auto; margin-right: auto;">
                                                                ArtistNepal is Nepal’s leading artist discovery and
                                                                promotion platform — a digital space where your talent,
                                                                identity, and dreams come to life; whether you’re a
                                                                <strong style="color: #e10d6e;">singer</strong>, <strong
                                                                    style="color: #e10d6e;">model</strong>, <strong
                                                                    style="color: #e10d6e;">dancer</strong>, <strong
                                                                    style="color: #e10d6e;">photographer</strong>, or
                                                                any kind of artist.
                                                            </p>
                                                            <div
                                                                style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; margin: 50px 0;">
                                                                <div
                                                                    style="background: white; border-radius: 10px; padding: 30px; flex: 1; min-width: 250px; max-width: 300px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; text-align: center;">
                                                                    <div
                                                                        style="font-size: 2.5rem; color: #e10d6e; margin-bottom: 20px;">
                                                                        <i class="fas fa-star"></i>
                                                                    </div>
                                                                    <h3 style="font-size: 1.3rem; color: #2D3748; margin-bottom: 15px;">
                                                                        Showcase Your Talent</h3>
                                                                    <p style="font-size: 1rem; color: #4A5568; line-height: 1.6; text-align: left;">
                                                                        This is the official platform to share your
                                                                        achievements and build your portfolio with
                                                                        Nepal’s creative community.
                                                                    </p>
                                                                    <p></p></div>
                                                                <div
                                                                    style="background: white; border-radius: 10px; padding: 30px; flex: 1; min-width: 250px; max-width: 300px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; text-align: center;">
                                                                    <div
                                                                        style="font-size: 2.5rem; color: #e10d6e; margin-bottom: 20px;">
                                                                        <i class="fas fa-users"></i>
                                                                    </div>
                                                                    <h3 style="font-size: 1.3rem; color: #2D3748; margin-bottom: 15px;">
                                                                        Grow Your Fanbase</h3>
                                                                    <p style="font-size: 1rem; color: #4A5568; line-height: 1.6; text-align: left;">
                                                                        Connect with fans and other artists to expand
                                                                        your reach and build meaningful relationships in
                                                                        the industry.
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    style="background: white; border-radius: 10px; padding: 30px; flex: 1; min-width: 250px; max-width: 300px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; text-align: center;">
                                                                    <div
                                                                        style="font-size: 2.5rem; color: #e10d6e; margin-bottom: 20px;">
                                                                        <i class="fas fa-calendar-alt"></i>
                                                                    </div>
                                                                    <h3 style="font-size: 1.3rem; color: #2D3748; margin-bottom: 15px;">
                                                                        Promote Events</h3>
                                                                    <p style="font-size: 1rem; color: #4A5568; line-height: 1.6; text-align: left;">
                                                                        Get the word out about your shows, exhibitions,
                                                                        and other creative events to the right audience.
                                                                    </p>
                                                                </div></div>
                                                            <p style="font-size: 1.1rem; color: #2D3748; margin: 50px 0 40px; line-height: 1.7; max-width: 800px; margin-left: auto; margin-right: auto;">
                                                                Create your account or claim your profile today at
                                                                <strong
                                                                    style="color: #e10d6e;">www.artistnepal.com</strong>
                                                                and let your creative journey begin!
                                                            </p>
                                                                <a href="https://artistnepal.com/artist/register/"
                                                                   style="display: inline-block; padding: 15px 40px; background: linear-gradient(135deg, #6C63FF, #e10d6e); color: white; font-size: 1.2rem; font-weight: 600; text-decoration: none; border-radius: 50px; box-shadow: 0 10px 30px rgba(108, 99, 255, 0.3); transition: all 0.3s ease;">
                                                                    Join Our Creative Community<br>
                                                                </a></div>
                                                    </div>

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

            @include('pages.partials.for-artist.artist-type')

            <hr class="pr__vr__section">
            <section class="uk-section uk-section-large">
                <div class="section-outer">
                    <div class="section-heading">
                        <div class="outer">
                            <div class="uk-container">
                                <div class="uk-column-1-1">
                                    <div>
                                        @include('pages.partials.for-artist.faq')

                                        <div style="text-align: center; margin-top: 20px;">
                                            <a href="https://artistnepal.com/register/"
                                               style="display: inline-block; padding: 10px 25px; background: linear-gradient(135deg, #6C63FF, #e10d6e); color: white; font-weight: 600; text-decoration: none; border-radius: 50px; box-shadow: 0 4px 15px rgba(108, 99, 255, 0.3); font-size: 0.95rem;">
                                                Create Your Artist Page<br>
                                            </a>
                                            <p></p>
                                            <p style="font-size: 0.85rem; color: #718096; margin-top: 12px;">It’s the
                                                perfect gift for your fans &amp; lovers ❤️</p>
                                            <p></p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <hr class="pr__vr__section">


            @endsection

            @push('css')
                <style>
                    /* FAQ Styles */
                    .artistnepal-faq {
                        background: white;
                        border-radius: 12px;
                        box-shadow: 0 5px 15px rgba(108, 99, 255, 0.1);
                        overflow: hidden;
                    }

                    .faq-item {
                        border-bottom: 1px solid #f0f0f0;
                    }

                    .faq-question {
                        padding: 20px 15px;
                        display: flex;
                        align-items: center;
                        cursor: pointer;
                        transition: background 0.2s ease;
                    }

                    .faq-question:hover {
                        background: rgba(113, 128, 150, 0.05);
                    }

                    .faq-icon {
                        width: 30px;
                        height: 30px;
                        background: #718096;
                        color: white;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin-right: 12px;
                        font-size: 1.2rem;
                        flex-shrink: 0;
                    }

                    .faq-title {
                        font-size: 1.1rem;
                        color: #2D3748;
                        margin: 0;
                        flex-grow: 1;
                    }

                    .faq-toggle {
                        font-size: 1.3rem;
                        color: #718096;
                        margin-left: 10px;
                        transition: transform 0.3s ease;
                    }

                    .faq-answer {
                        max-height: 0;
                        overflow: hidden;
                        transition: max-height 0.3s ease;
                        padding: 0 15px 0 57px;
                    }

                    .faq-content {
                        padding-bottom: 20px;
                        color: #4A5568;
                        line-height: 1.6;
                        font-size: 0.95rem;
                    }

                    .nepali-text {
                        font-style: italic;
                        color: #718096;
                        border-left: 3px solid #e10d6e;
                        padding-left: 12px;
                        margin-top: 12px;
                        font-size: 0.9rem;
                        line-height: 1.6;
                        display: block;
                    }

                    .faq-active .faq-toggle {
                        transform: rotate(45deg);
                    }

                    .faq-active .faq-answer {
                        max-height: 500px;
                    }

                    .sign-up-now-for-free {
                        display: inline-block;
                        padding: 8px 25px;
                        background: white;
                        color: #6C63FF;
                        font-size: 1.2rem;
                        font-weight: 600;
                        text-decoration: none;
                        border-radius: 50px;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                        transition: all 0.3s ease;
                        position: relative;
                        z-index: 2;
                    }

                    .gallery-wrap-inset {
                        margin-left: -10px;
                        margin-right: -10px;
                    }

                    @media only screen and (min-width: 1281px) {
                        .gallery-wrap-inset {
                            max-width: 90%;
                            margin: 0 auto;
                        }
                    }

                    .grid-item {
                        display: block;
                        width: calc(33.33% - 20px);
                        padding: 10px;
                    }

                    .grid-item--small {
                        width: calc(25% - 20px);
                        padding: 10px;
                    }

                    @media only screen and (max-width: 769px) {
                        .grid-item {
                            width: calc(50% - 10px);
                            padding: 5px;
                        }
                    }

                    .search-box h3 {
                        display: none;
                    }
                </style>
            @endpush

            @push('js')
                <script
                    src="{{ asset('dist/themes/artist-nepal/js/imagesloaded.pkgd.js') }}"></script>
                <script
                    src="{{ asset('dist/themes/artist-nepal/js/masonry.pkgd.min.js') }}"></script>
                <script>
                    var grid = document.querySelector('.gallery-grid');
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
                </script>
    @endpush

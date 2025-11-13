@extends('layouts.master')

@section('title', '')

@section('header-style', 'promo--vsmall')

@section('promo-banner', asset('/dist/themes/artist-nepal/img/banner-n.png'))

@section('promo-container')
    <hr class="line pr__hr__secondary">
    <h2 class="title uk-heading-hero">Contact Us</h2>
@endsection

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
@endpush

@section('content')

    <div class="pr__primary uk-section uk-section-medium" id="site-primary">
        <div class="outer">
            <div class="uk-container uk-position-relative">
                <div class="inner uk-grid uk-grid-large uk-grid-match uk-grid-stack" data-uk-grid="">
                    <div class="uk-width-expand uk-first-column">
                        <main class="pr__main" id="site-main">
                            <article class="uk-article post type-post single-post">
                                <div class="outer uk-grid uk-grid-large uk-flex uk-grid-stack" data-uk-grid="">
                                    <div class="inner uk-width-expand uk-first-column">
                                        <div class="entry-body mt-4">
                                            <h2 style="text-align: center;"><strong>Contact ArtistNepal To reach with your best&nbsp;
                                                    <a href="{{ route('listing') }}">artists</a>.</strong></h2>
                                            <p style="text-align: center;">please fill out the form below and describe your question &amp; inquiry with as much detail as possible. You’ll receive a reply via email, so please make sure to enter your email address correctly. Many common questions are also addressed in our comprehensive&nbsp;<a href="https://artistnepal.com/help/">ArtistNepal Help Center</a>.</p>
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
    <section class="uk-section uk-section-large">
        <div class="uk-container">
            <div class="section-outer">
                <div class="uk-flex  uk-grid uk-grid-large" data-uk-grid="">
                    <div class="right uk-width-2-5@m uk-first-column"></div>
                    <div class="left uk-width-3-5@m ">

                        <div class="wpcf7 js" id="wpcf7-f920-p360-o1" lang="en-US" dir="ltr" data-wpcf7-id="920">
                            <div class="screen-reader-response">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <p role="status" class="text-danger" aria-live="polite" aria-atomic="true">
                                        Validation errors:
                                    </p>
                                    <ul class="text-danger mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <form action="{{ route('contact') }}" method="POST" class="mt-4">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Your Name <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                        placeholder="Enter your full name"
                                        value="{{ old('name') }}"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Your Email <span class="text-danger">*</span></label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control"
                                        placeholder="Enter your email address"
                                        required
                                        value="{{ old('email') }}"
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label">Your Message <span class="text-danger">*</span></label>
                                    <textarea
                                        name="message"
                                        id="message"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Write your message here..."
                                        required
                                    >{{ old('message') }}</textarea>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 uk-button uk-button-large uk-button-primary">
                                        Send Message
                                    </button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div><!-- Grid End -->
            </div><!-- Outer End -->
        </div><!-- Container End -->
    </section>

    <section class="pr__about pr__section uk-section uk-section-large">
        <div class="section-outer">
            <div class="section-heading">
                <div class="outer">
                    <div class="uk-container">
                        <h2 style="text-align: center;">We look forward to hearing from you!</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endpush

@push('js')

@endpush

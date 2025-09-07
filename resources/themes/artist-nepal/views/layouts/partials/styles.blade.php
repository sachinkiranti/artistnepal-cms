<style>
    img:is([sizes="auto" i], [sizes^="auto," i]) {
        contain-intrinsic-size: 3000px 1500px
    }
</style>
<style id='classic-theme-styles-inline-css' type='text/css'>
    .wp-block-button__link {
        color: #fff;
        background-color: #32373c;
        border-radius: 9999px;
        box-shadow: none;
        text-decoration: none;
        padding: calc(.667em + 2px) calc(1.333em + 2px);
        font-size: 1.125em
    }

    .wp-block-file__button {
        background: #32373c;
        color: #fff;
        text-decoration: none
    }
</style>
<link rel='stylesheet' id='css/normalize.min.css-css' href='{{ asset('dist/themes/artist-nepal/css/normalize.min.css') }}' type='text/css' media='all' />
{{--<link rel='stylesheet' id='css/pr.animation.css-css' href='{{ asset('dist/themes/artist-nepal/css/pr.animation.css') }}' type='text/css' media='all' />--}}
<link rel='stylesheet' id='css/owl.carousel.min.css-css' href='{{ asset('dist/themes/artist-nepal/css/owl.carousel.min.css') }}' type='text/css'
      media='all' />
<link rel='stylesheet' id='css/uikit.min.css-css' href='{{ asset('dist/themes/artist-nepal/css/uikit.min.css') }}' type='text/css' media='all' />
<link rel='stylesheet' id='css/fonts.css-css' href='{{ asset('dist/themes/artist-nepal/css/fonts.css') }}' type='text/css' media='all' />
<link rel='stylesheet' id='css/pixeicons.css-css' href='{{ asset('dist/themes/artist-nepal/css/pixeicons.css') }}' type='text/css' media='all' />
<link rel='stylesheet' id='style-css' href='{{ asset('dist/themes/artist-nepal/css/style.css?ver=1.2') }}' type='text/css' media='all' />
<link rel='stylesheet' id='custom-css' href='{{ asset('dist/themes/artist-nepal/css/custom.css?ver=1757052819') }}' type='text/css' media='all' />
<link rel='stylesheet' id='icomoon-css' href='{{ asset('dist/themes/artist-nepal/fonts/icomoon/style.css?ver=6.8.2') }}' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css'
      href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css?ver=6.8.2' type='text/css'
      media='all' />
@stack('css')

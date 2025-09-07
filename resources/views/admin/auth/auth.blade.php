<!DOCTYPE html>
<html>
    @include('admin.layouts.partials.head')
    <body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        @yield('content')
    </div>
    <!-- Mainly scripts -->
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="{{ asset('dist/js/backend.js') }}"></script>
    </body>
</html>

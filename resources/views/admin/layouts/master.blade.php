<!DOCTYPE html>
<html>
    @include('admin.layouts.partials.head')
<body>

<div id="wrapper">
    @include('admin.layouts.partials.sidebar')

    <div id="page-wrapper" class="gray-bg">
        @include('admin.layouts.partials.header')

        @yield('content')

        @include('admin.layouts.partials.footer')
    </div>
    @include('admin.layouts.partials.right-sidebar')
</div>
@include('admin.layouts.partials.scripts')

</body>
</html>

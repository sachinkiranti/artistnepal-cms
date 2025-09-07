<!-- Mainly scripts -->
<script src="{{ asset('dist/js/app.js') }}"></script>
<script src="{{ asset('dist/js/backend.js') }}"></script>

@if (session()->has('notify'))
<script>
    $(document).ready(function () {
        {!! toaster() !!}
    });
</script>
@endif
@stack('js')

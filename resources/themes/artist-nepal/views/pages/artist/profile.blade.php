@extends('layouts.master')

@section('title', 'Profile')

@section('header-style', 'promo--vsmall')

@section('promo-container')
    <hr class="line pr__hr__secondary">
    <h2 class="title uk-heading-hero">Edit your profile!</h2>
@endsection

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
@endpush

@section('content')
    <div class="container p-md-0 p-0">
        <div class="row m-2 m-md-5">
            <div class="col-12">

                @if(app()->isLocal())
                    @if ($errors->any())
                        <div class="bg-red-100 text-danger p-3 rounded mb-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif

                {!! Form::model($data['profile'], ['route' => ['artist.profile'], 'enctype' => 'multipart/form-data', 'method' => 'put', 'id' => 'profileForm']) !!}
                {!! Form::hidden('id', $data['profile']->id ?? null) !!}

                @include('pages.artist.partials.general')

                <div class="modern-tabs mb-2">

                    @include('pages.artist.partials.tab-headers')
                    @include('pages.artist.partials.tab-content')

                </div>

                <div class="row">
                    <div class="col-12">
                        <button class="uk-button uk-button-primary" type="submit"><i class="fa fa-save"></i> &nbsp;Save Changes</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @include('admin.user.partials.artist.tr.default-tr')
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <style>
        .artist-card {
            /*border-color: #E9204F!important;*/
        }
        .pr__footer .pr__footer__bottom .section-inner .pr__links * + a {
            margin-left: .5rem;
            text-decoration: none;
        }

        /*.profile-body {*/
        /*    margin-top: 1rem;*/
        /*    padding: 1rem;*/
        /*    background: white;*/
        /*    border-radius: 1rem;*/
        /*    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);*/
        /*}*/

        .modern-tabs {
            margin-top: 5px;
            background: white;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        }

        .modern-tabs .nav-tabs {
            border: none;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .modern-tabs .nav-link {
            border: none;
            padding: 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .modern-tabs .nav-link:hover {
            background: #f8f9fa;
            color: #E9204F;
        }

        .modern-tabs .nav-link.active {
            background: #E9204F;
            color: white;
        }

        .tab-pane.fade {
            transition: all 0.2s ease-out;
        }

        .tab-pane.fade.show {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .has-error {
            color: darkred;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('dist/plugins/easytable.min.js') }}"></script>
    <script src="{{ asset('dist/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        const tableInstances = {};

        $(function () {

            tinymce.init({
                selector: 'textarea[name="bio"]',
                menubar: false,
                plugins: 'lists link image',
                toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image',
                height: 500
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href");
                $(target).find('textarea.tinymce').each(function () {
                    if (!$(this).hasClass('tox-tinymce')) {
                        tinymce.init({
                            selector: 'textarea[name="' + $(this).attr('name') + '"]',
                            menubar: false,
                            plugins: 'lists link image',
                            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image'
                        });
                    }
                });
            });

            const tables = ['#mediasTable', '#awardsTable', '#testimonialTable'];

            tables.forEach(selector => {
                const $table = $(selector);
                const methods = $table.easyTableA11y({
                    label: 'data-easy-table',
                    view: '786px',
                    ignoreSelector: '.no-label',
                    css: {
                        trBottomBorder: '1px solid #000',
                        tdMarginRight: '10px !important',
                        tdFontWeight: 'bold'
                    }
                });

                tableInstances[selector] = methods;
                $table.data('easyTableA11y', methods);
            });
        })
    </script>
@endpush

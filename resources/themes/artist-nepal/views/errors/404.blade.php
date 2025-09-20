@extends('layouts.master')

@section('title', '')

@section('promo-container')

@endsection

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
@endpush

@section('content')
    <div class="error-page">
        <div class="error-content">
            <h1 class="error-code">404</h1>
            <h2 class="error-title">Oops! Page Not Found</h2>
            <p class="error-message">The page you are looking for might have been removed or is temporarily unavailable.</p>
            <a href="{{ url('/') }}" class="btn btn-primary btn-home">Go to Home</a>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .pr__header.pr__dark .inner a, .pr__header.pr__dark .inner .lang {
            color: #E9204F !important;
        }
        .promo--white {
            color: black;
        }
        .menu-item--primary a {
            padding: 6px 10px;
            background-color: #fffafc;
            background-color: #fffafc;
            border: 1px solid #E9204F;
        }
        .promo__bck { padding: 0!important; display: none; }
        .error-page {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            /*background: linear-gradient(135deg, #ffe6ec, #ffd6e0);*/
            background: #fff;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .error-content {
            max-width: 500px;
            animation: fadeIn 1s ease-in-out;
        }

        .error-code {
            font-size: 10rem;
            font-weight: bold;
            color: #E9204F;
            margin: 0;
            animation: bounce 2s infinite;
        }

        .error-title {
            font-size: 2rem;
            margin: 10px 0;
            color: #E9204F;
        }

        .error-message {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 20px;
        }

        .btn-home {
            background: #E9204F;
            color: #fff;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-home:hover {
            background: #c2183f;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(233, 32, 79, 0.4);
            color: #FFFFFF!important;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-20px); }
            60% { transform: translateY(-10px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endpush

@push('js')
@endpush

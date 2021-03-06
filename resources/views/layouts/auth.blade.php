<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta name="author" content="{!! config('app.author') !!}">
        <meta name="keywords" content="{!! config('app.keywords') !!}">
        <meta name="description" content="{{ $HTMLDescription }}"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include ('partials.favicons')

        <title>{{ $HTMLTitle }}</title>

        @if(config('app.debug') != 'local')
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        @endif

        <link rel="stylesheet" href="/css/admin.css?v=1">
        @yield('styles')
    </head>

    <body class="hold-transition auth-page">

        @yield('content')

        <script type="text/javascript" charset="utf-8" src="/js/admin.js?v=1"></script>
        <script type="text/javascript" charset="utf-8">
//            $(document).ready(function ()
//            {
//                initAdmin();
//            });
        </script>
        @yield('scripts')
   
        <script type="text/javascript" charset="utf-8" src="/js/admin-scripts.js"></script>{{-- MODIF pour pouvoir modifier des trucs --}}
		
 </body>
</html>

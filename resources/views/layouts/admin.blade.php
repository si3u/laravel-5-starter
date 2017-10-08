<!DOCTYPE html>
<html lang="fr" hreflang="fr">
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

        @if(config('app.debug') != 'dev')
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        @endif

        <link rel="stylesheet" href="/css/admin.css">
        @yield('styles')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">
            @include('admin.partials.header')

            @include('admin.partials.navigation')

            <div class="content-wrapper">
                <section class="content-header">
                    {!! $pagecrumb !!}

                    {!! $breadcrumb !!}
                </section>

                <section class="content">
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <div class="pull-right text-right">
                    &copy; {{ date('Y') }} <a href="{{ infos('site-url') }}" target="_blank"><strong>{!! config('app.name') !!}</strong></a>
                </div>
                <div class="text-left">
                    Crée par <a href="{{ infos('webmaster_url') }}" target="_blank"><strong>{{ infos('webmaster_name') }}</strong></a> - Propulsé par <a href="https://laravel.com" target="_blank">Laravel</a> v{{ app()->version() }}
                </div>
            </footer>
        </div>

        @include('notify::notify')
        @include('admin.partials.modals')

        <script type="text/javascript" charset="utf-8" src="/js/admin.js"></script>
		
        @yield('scripts')

        <script type="text/javascript" charset="utf-8" src="/js/admin-scripts.js"></script>{{-- MODIF pour pouvoir modifier des trucs --}}
		
        @if(config('app.env') != 'local')
            @include('partials.analytics')
        @endif
    </body>
</html>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="{{ infos('webmaster_name') }}">
        <meta name="keywords" content="{{ infos('keywords') }}">
        <meta name="description" content="{{ isset($HTMLDescription) ? $HTMLDescription : infos('description') }}"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if( ! empty(infos('facebook_app_id')) ||  ! empty(infos('twitter_page')) )
			@if( ! empty(infos('facebook_app_id')) )
		<meta property="fb:app_id" name="fb:app_id" content="{{ infos('facebook_app_id') }}"/>
			@endif
			@if( ! empty(infos('twitter_page')) )
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="{{ infos('twitter_page') }}" />
			@endif
        <meta property="og:type" name="og:type" content="website"/>
        <meta property="og:site_name" content="{{ infos('societe') }}"/>
        <meta property="og:url" name="og:url" content="{{ Request::url() }}"/>
        <meta property="og:caption" name="og:caption" content="{{ infos('site-url') }}"/>
        <meta property="og:title" name="og:title" content="{{ isset($HTMLTitle) ? $HTMLTitle : infos('title') }}">
        <meta property="og:description" name="og:description" content="{{ isset($HTMLDescription) ? $HTMLDescription : infos('description') }}">
        <meta property="og:image" name="og:image" content="{{ isset($HTMLImage) ? asset($HTMLImage) : asset(infos('logo')) }}">
		@endif

        @include ('partials.favicons')

        <title>{{ isset($HTMLTitle) ? $HTMLTitle : infos('societe') }}</title>

        <link rel="stylesheet" href="/css/website.css">
		
        @yield('styles')
		
		<!-- microdata -->
		<script type="application/ld+json">
		    {
		      "@context": "http://schema.org",
		      "@type": "Organization",
		      "address": {
			"@type": "PostalAddress",
			"addressLocality": "{{ infos('ville') }}, {{ infos('region') }}, {{ infos('pays') }}",
			"postalCode": "{{ infos('cp') }}",
			"streetAddress": "{{ infos('rue') }}" },
		      "email": "{{ infos('email') }}",
		      "member": [ { "@type": "Organization" } ],
		      "alumni": [ { "@type": "Person", "name": "{{ infos('nom', 'prenom') }}" } ],
		      "makesOffer": "{{ infos('description') }}",
		      "name": "{{ infos('societe') }}",
			  "logo" : "{{asset(infos('logo'))}}",
			  "contactPoint" : [
			<?php if( !empty(infos('tel-mobile'))){ ?>
				{"@type" : "ContactPoint",
				"telephone": "{{ infos('tel-mobile') }}",
				"areaServed" : "FR",
				"contactType": "technical support" }
			<?php } if( !empty(infos('tel-fixe'))){ ?>
				,{"@type": "ContactPoint",
				"telephone": "{{ infos('tel-fixe') }}",
				"areaServed" : "FR",
				"contactType": "technical support" }
			<?php } ?>
			      ]
		    }
		</script>
    </head>

    <body>
        <h1 class="hidden">{{ isset($HTMLTitle) ? $HTMLTitle : infos('societe') }}</h1>

        @if( ! empty(infos('facebook_app_id')) )
            @include('partials.facebook')
        @endif

        @include('website.partials.header')

        @if(isset($showPageBanner) && $showPageBanner == true || !isset($showPageBanner))
            @include('website.partials.slider')
        @endif

        <div class="container">
            @include('website.partials.breadcrumb')

            @yield('content')
        </div>

        @include('website.partials.footer')

        @include('website.partials.popup')

        <script type="text/javascript" charset="utf-8" src="/js/website.js"></script>
        <script type="text/javascript">
            $(document).ready(function ()
            {
                initWebsite();
            });
        </script>

        @yield('scripts')

        @if(config('app.env') != 'local')
            @include('partials.analytics')
        @endif
    </body>
</html>

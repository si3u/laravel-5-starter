<!doctype html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8">

        <style type='text/css'>
            body, html {
                color: #565656;
                font-family: Arial;
                font-size: 14px;
                padding: 0px;
                margin: 0px;
            }

            p {
                margin: 0;
                padding: 5px 0
            }

            a {
                color: #2c699d
            }

            h2 {
                font-size: 20px;
            }

            .dear {
                font-size: 18px;
            }

            .dear strong {
                color: #2c699d
            }
        </style>
    </head>
    <body>
        @yield('content')

        <p>&nbsp;</p>
        {{--<p>Have a great day ahead!</p>--}}
        <p><strong>{{ infos('societe') }}</strong></p>
        <p><a href="{{ infos('site-url') }}">{{ infos('site-url') }}</a></p>

        <p>
            <a href="{{ infos('site-url') }}">
                <img src="{{ asset(infos('logo-mini')) }}" style="margin-top:10px" alt="{{ infos('societe') }}"/>
            </a>
        </p>
    </body>
</html>

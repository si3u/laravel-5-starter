@extends('layouts.email')

@section('content')
    <p class="dear">Bonjour, <strong>{!! $name !!}</strong></p>

    <p>Vous avez été créé en tant qu'utilisateur/administrateur sur {{ config('app.name') }}</p>
    <p>
        Cliquez s'il vous plaît :
        <a href="{{ url('/auth/register/confirm/'.$token) }}">ICI</a>
        pour activer votre compte.
    </p>
@stop
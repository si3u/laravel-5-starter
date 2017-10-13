@extends('layouts.email')

@section('content')
	<p class="dear">Bonjour, <strong>{{ $userInvite->email }}</strong></p>

	<p>Vous avez été invité à être utilisateur/administrateur sur {{ config('app.name') }}</p>
	<p>
        S'il vous plaît, cliquez 
        <a href="{{ url('/auth/register/'.$userInvite->token) }}">ICI</a>
        pour créer votre compte.
    </p>
@stop
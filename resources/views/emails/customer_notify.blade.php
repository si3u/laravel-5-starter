@extends('layouts.email')

@section('content')
    <p class="dear">Bonjour, <strong>{!! $obj->firstname . ' ' . $obj->lastname  !!}</strong></p>

    <p>&nbsp;</p>
    <p>Merci de nous avoir contacté !</p>

    <p>Nous vous remercions de nous avoir contacté par le formulaire <strong>{{ $obj->type }}</strong>. Nous avons reçu votre message et répondrons dès que possible.</p>
    <p>Cordialement.</p>
@stop
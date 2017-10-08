@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Modifier ' . $item->title : 'Entrer une nouvelle région' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <input name="zoom_level" type="hidden" value="{{ isset($item)? $item->zoom_level : old('zoom_level') }}" readonly/>
                        <input name="latitude" type="hidden" value="{{ isset($item)? $item->latitude : old('latitude') }}" readonly/>
                        <input name="longitude" type="hidden" value="{{ isset($item)? $item->longitude : old('longitude') }}" readonly/>

                        <fieldset>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('title', $errors) }}">
                                        <label for="title">Titre</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Insérer un titre" value="{{ ($errors && $errors->any()? old('title') : (isset($item)? $item->title : '')) }}">
                                        {!! form_error_message('title', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('country_id', $errors) }}">
                                    	<label for="country">Pays</label>
                                    	{!! form_select('country_id', ([0 => 'Sélectionner un Pays'] + $countries), ($errors && $errors->any()? old('country_id') : (isset($item)? $item->country_id : '')), ['class' => 'select2 form-control']) !!}
                                    	{!! form_error_message('country_id', $errors) !!}
                                    </div>
                                </div>
                            </div>


                        </fieldset>

                        @include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>

	@include('admin.locations.map', ['marker' => true])

@endsection

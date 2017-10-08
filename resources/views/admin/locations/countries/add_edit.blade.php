@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Modifier ' . $item->title : 'Entrer un nouveau pays' }}</span>
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

                            <section class="form-group {{ form_error_class('title', $errors) }}">
                                <label for="title">Titre</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Insérer un titre" value="{{ ($errors && $errors->any()? old('title') : (isset($item)? $item->title : '')) }}">
                                {!! form_error_message('title', $errors) !!}
                            </section>
                        </fieldset>

						@include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>

	@include('admin.locations.map', ['marker' => true])
	
@endsection

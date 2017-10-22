@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Modifier ' . $item->title : 'Ajouter une nouvelle étiquette' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

					<form method="POST" action='{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}' accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

						<fieldset>
                            <div class="row">
								
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="name">Tag</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Insérer un nom" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                        {!! form_error_message('name', $errors) !!}
                                    </div>
                                </div>
								
								@if(isset($item))
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('slug', $errors) }}">
                                        <label for="slug">slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{ ($errors && $errors->any()? old('slug') : (isset($item)? $item->slug : '')) }}" readonly>
                                        {!! form_error_message('slug', $errors) !!}
                                    </div>
                                </div>
								@endif
                            </div>
							
                            <div class="row">
								
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('description', $errors) }}">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" id="description" name="description" value="{{ ($errors && $errors->any()? old('description') : (isset($item)? $item->description : '')) }}">
                                        {!! form_error_message('description', $errors) !!}
                                    </div>
                                </div>
								
								@if(isset($item))
                                <div class="col-md-2">
                                    <div class="form-group {{ form_error_class('count', $errors) }}">
                                        <label for="count">Nombre</label>
                                        <input type="text" class="form-control" id="count" name="count" value="{{ ($errors && $errors->any()? old('count') : (isset($item)? $item->count : '')) }}" readonly>
                                        {!! form_error_message('count', $errors) !!}
                                    </div>
                                </div>
								@endif
								
							</div>
							
							
						</fieldset>

						@include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
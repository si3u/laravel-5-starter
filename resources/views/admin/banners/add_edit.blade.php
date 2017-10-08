@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Modifier ' . $item->title : 'Ajouter une Bannière' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

					<form method="POST" action='{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}' accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <section class="col col-6">
                                    <section class="form-group {{ form_error_class('title', $errors) }}">
                                        <label for="id-title">Titre</label>
                                        <input type="text" class="form-control input-generate-slug" id="id-title" name="title" placeholder="Insérer un titre" value="{{ ($errors && $errors->any()? old('title') : (isset($item)? $item->title : '')) }}" required
                                        {!! form_error_message('title', $errors) !!}
                                    </section>
                                </section>

                                <section class="col col-6">
                                    <section class="form-group {{ form_error_class('subtitle', $errors) }}">
                                        <label for="id-subtitle">Sous titre</label>
                                        <input type="text" class="form-control" id="id-subtitle" name="subtitle" placeholder="Insérer un sous titre" value="{{ ($errors && $errors->any()? old('subtitle') : (isset($item)? $item->subtitle : '')) }}">
                                        {!! form_error_message('subtitle', $errors) !!}
                                    </section>
                                </section>
                            </div>

                            <div class="row">
                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('action_title', $errors) }}">
                                        <label for="id-action_title">Texte bouton</label>
                                        <input type="text" class="form-control" id="id-action_title" name="action_title" placeholder="Insérer un Titre d'Action" value="{{ ($errors && $errors->any()? old('action_title') : (isset($item)? $item->action_title : '')) }}">
                                        {!! form_error_message('action_title', $errors) !!}
                                    </section>
                                </div>

                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('action_link', $errors) }}">
                                        <label for="id-action_link">Lien bouton</label>
										<select name="action_link" id="id-action_link" class="select2 select2tags">
											<option>Sélectionner un lien</option>
										@foreach($selectNavigation as $v)
										<?php $action_link = preg_replace("/^(.*)\ \(\ (\/.*)?\ \)$/", "$2", $v); ?>
											<option value='{{ $action_link }}' @if(isset($item) && $item->action_link == $action_link) selected="selected" @endif>{{ $v }}</option>
										@endforeach
										</select>
										
										{!! form_error_message('action_link', $errors) !!}
                                    </section>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('active_from', $errors) }}">
                                        <label for="active_from">Actif depuis le</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_from" name="active_from" data-date-format="YYYY-MM-DD HH:mm:ss" value="{{ ($errors && $errors->any()? old('active_from') : (isset($item)? $item->active_from : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('active_from', $errors) !!}
                                    </section>
                                </div>

                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('active_to', $errors) }}">
                                        <label for="active_to">Jusqu'au</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_to" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_to" value="{{ ($errors && $errors->any()? old('active_to') : (isset($item)? $item->active_to : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('active_to', $errors) !!}
                                    </section>
                                </div>
                            </div>

                            <section class="form-group {{ form_error_class('photo', $errors) }}">
                                <label>Chercher un image (1900 x 500)</label>
                                <div class="input-group input-group-sm">
                                    <input id="photo-label" type="text" class="form-control" onclick="document.getElementById('photo').click();" readonly placeholder="Chercher une image">
                                    <span class="input-group-btn">
                                  <button type="button" class="btn btn-default" onclick="document.getElementById('photo').click();">Chercher</button>
                                </span>
                                    <input id="photo" style="display: none" accept="{{ get_file_extensions('image') }}" type="file" name="photo" onchange="document.getElementById('photo-label').value = this.value">
                                </div>
                                {!! form_error_message('photo', $errors) !!}
                            </section>

                            @if(isset($item) && $item && $item->image)
                                <section>
                                    <img src="{{ uploaded_images_url($item->image) }}" style="max-height: 300px;">
                                    <input type="hidden" name="image" value="{{ $item->image }}">
                                </section>
                            @endif
                        </fieldset>

						@include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            setDateTimePickerRange('#active_from', '#active_to');
        })
    </script>
@endsection
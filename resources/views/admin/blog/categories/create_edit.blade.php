@extends('layouts.admin')

@section('scripts')
    @parent
	
	<!-- CK Editor -->
	<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>

    <script type="text/javascript" charset="utf-8">
		
		/* Options Select2 */
		var options_select2 = {
			tags: true
			,tokenSeparators: [',']
			,closeOnSelect: false
			,insertTag: function (data, tag) {/* Insert the tag at the end of the results */
				data.push(tag);
			}
		};
	</script>
@endsection

@section('content')

	<div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Modifier ' . $item->title : 'Créer un nouvelle catégorie' }}</span>
                    </h3>
                </div>
                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="name">Catégorie</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Insérer une catégorie" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}" required>
                                        {!! form_error_message('name', $errors) !!}
                                    </div>
                                </div>
                            </div>
							
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('description', $errors) }}">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" id="description" name="description" placeholder="Insérer une description" maxlength="200" value="{{ ($errors && $errors->any()? old('description') : (isset($item)? $item->description : '')) }}" required>
                                        {!! form_error_message('description', $errors) !!}
                                    </div>
                                </div>
                            </div>
							
<?php
	$infosKeywords = infos('keywords'); // les mots clé si $item est vide
	$keywords = getKeywords(isset($item)? $item->keywords : $infosKeywords);// with Helpers/keywords_helpers.php	
?>
								
        <div class="col col-md-12">
            <label for="keywords">Mots Clé</label>
			<div class="input-group{{ form_error_class('keywords', $errors) }}">
				<span class="input-group-addon" title="nombres de mots (au chargement de la page)"><b>{{ countKeywords( isset($item) ? $item->keywords : $infosKeywords) }}</b></span>
				{!! form_select('keywords[]', $keywords, (old('keywords') ? old('keywords') : $keywords), ['class' => 'select2 select2tags input-group', 'multiple', 'required']) !!}
				{!! form_error_message('keywords', $errors) !!}
			</div>
			<br/>
			<br/>
		</div>
					
							
							
							
							
                        </fieldset>

                        @include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
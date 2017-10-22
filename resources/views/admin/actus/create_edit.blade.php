@extends('layouts.admin')

@section('scripts')
    @parent
	<!-- CK Editor -->
	<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>
	<script src="/js/ckeditor/ckeditor-adapters-jquery.4.5.11.js"></script>
	
    <script type="text/javascript" charset="utf-8">
		/* Config Laravel File Manager pour CkEditor */
		var uri = "/admin/laravel-filemanager";
		var options_content = {
			filebrowserImageBrowseUrl: uri+'?type=Images&tab=Actualités',
			filebrowserImageUploadUrl: uri+'/upload?type=Images&_token={{csrf_token()}}',
			filebrowserBrowseUrl: uri+'?type=Files',
			filebrowserUploadUrl: uri+'/upload?type=Files&_token={{csrf_token()}}',
			height: 600
		};
		
        $(function ()
        {
			/* remplace textarea editor-content */
			var textareaContent = CKEDITOR.replace('content', options_content);
	
            setDateTimePickerRange('#active_from', '#active_to');
			
        });
	</script>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Modifier : ' . $item->title : 'Créer une nouvelle actualité' }}</span>
                    </h3>
                </div>
				
                <div class="box-body no-padding">

                    @include('admin.partials.info')
					
					
                    @include('admin.partials.button_create_dir', ['type' => 'actus'])
					

					<form method="POST" 
						  action='{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}' 
						  accept-charset="UTF-8">
						
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

						@include('admin.partials.form_footer')
						
                        <fieldset>
							
                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="form-group {{ form_error_class('title', $errors) }}">
                                        <label for="id-title">Titre</label>
                                        <input type="text" class="form-control {{-- input-generate-slug --}}" id="id-title" name="title" placeholder="inserer un Titre" value="{{ ($errors && $errors->any()? old('title') : (isset($item)? $item->title : '')) }}"/>
                                        {!! form_error_message('title', $errors) !!}
                                    </div>
                                </div>


                                <div class="col col-md-4">
                                    <div class="form-group {{ form_error_class('slug', $errors) }}">
										<label for="slug">ID / Slug</label>
										<div class="input-group">
											<span class="input-group-addon">id: <b>{{ isset($item) ? $item->id : $id }}</b></span>
											<input disabled type="text" class="form-control" id="slug" name="slug" value="{{ ($errors && $errors->any()? old('slug') : (isset($item)? $item->slug : '')) }}"/>
										</div>
									</div>
                                </div>
                            </div>

                            <div class="row">
				
                                <div class="col col-md-3">
                                    <div class="form-group {{ form_error_class('active_from', $errors) }}">
                                        <label for="active_from">En ligne à partir du</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_from" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_from" placeholder="insérer une date de mise en ligne" value="{{ ($errors && $errors->any()? old('active_from') : (isset($item)? $item->active_from : date('Y-m-d H:i:s'))) }}"/>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('active_from', $errors) !!}
                                    </div>
                                </div>
                                <div class="col col-md-3">
                                    <div class="form-group {{ form_error_class('active_to', $errors) }}">
                                        <label for="active_to">Jusqu'au <sup><em>facultatif</em></sup></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_to" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_to" placeholder="insérer une date de fin de mise en ligne" value="{{ ($errors && $errors->any()? old('active_to') : (isset($item)? $item->active_to : '')) }}"/>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('active_to', $errors) !!}
                                    </div>
                                </div> 
								
								
								@include('admin.partials.buttons_tags_toggle', ['model' => 'Actus'])
					

                            </div>


                            <div class="form-group {{ form_error_class('summary', $errors) }}">
                                <label for="summary">Description <sup><em>référencement</em></sup></label><small> <em> De 150 à 200 caractères (rempli automatiquement, si vide, avec le début du contenu)</em></small>
                                <input type="text" class="form-control" id="summary" name="summary" maxlength="200" value="{{ ($errors && $errors->any()? old('summary') : (isset($item)? $item->summary : '')) }}"/>
								{!! form_error_message('summary', $errors) !!}
                            </div>
						
                            <div class="form-group {{ form_error_class('content', $errors) }}">
                                <label for="actu-content">Contenu</label>
                                <textarea class="form-control" id="actu-content" name="content" rows="18">{{ ($errors && $errors->any()? old('content') : (isset($item)? $item->content : '')) }}</textarea>
								<p><small><em><b>Astuces :</b> Ajoutez une image Miniature, puis entourez-la d'un lien de l'image grand format pour activer automatiquement la gallerie d'images.</em></small></p>
                                {!! form_error_message('content', $errors) !!}
                            </div>
                        </fieldset>

						@include('admin.partials.form_footer')
						
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
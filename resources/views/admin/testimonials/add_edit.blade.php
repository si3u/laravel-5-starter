@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Modifier ' . $item->title : 'Entrer un nouveau commentaire' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

					<form method="POST" 
						  action='{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}' 
						  accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('customer', $errors) }}">
                                        <label for="customer">Posté par</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" id="customer" name="customer" value="{{ ($errors && $errors->any()? old('customer') : (isset($item)? $item->customer : '')) }}">
                                        </div>
                                        {!! form_error_message('customer', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('link', $errors) }}">
                                        <label for="link">Lien (optionel)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-external-link"></i></span>
                                            <input type="text" class="form-control" id="link" name="link" placeholder="https://wwww.domaine.com" value="{{ ($errors && $errors->any()? old('link') : (isset($item)? $item->link : '')) }}">
                                        </div>
                                        {!! form_error_message('link', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <section class="form-group {{ form_error_class('description', $errors) }}">
                                <label for="description-content">Commentaire</label>
                                <textarea class="form-control " id="description-content" name="description" rows="18" placeholder="Insérer un commentaire">{{ ($errors && $errors->any()? old('description') : (isset($item)? $item->description : '')) }}</textarea>
                                {!! form_error_message('description', $errors) !!}
                            </section>
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
	<!-- CK Editor -->
	<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>

    <script type="text/javascript" charset="utf-8">
		/* Config Laravel File Manager pour CkEditor */
		var uri = "/admin/laravel-filemanager";
		var options_content = {
			filebrowserImageBrowseUrl: uri+'?type=Images',
			filebrowserImageUploadUrl: uri+'/upload?type=Images&_token=',
			filebrowserBrowseUrl: uri+'?type=Files',
			filebrowserUploadUrl: uri+'/upload?type=Files&_token=',
			height: 500
		};
		
        $(function ()
        {
			/* remplace textarea editor-content */
			var textareaContent = CKEDITOR.replace('description-content', options_content);
        });
    </script>
@endsection
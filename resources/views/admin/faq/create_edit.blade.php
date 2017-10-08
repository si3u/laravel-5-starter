@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Modifier ' . $item->question : 'Ajouter un nouvelle FAQ' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form id="form-edit" method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col col-md-8">
                                    <div class="form-group {{ form_error_class('question', $errors) }}">
                                        <label for="question">Question</label>
                                        <input type="text" class="form-control" id="question" name="question" placeholder="Insérer une Question" value="{{ ($errors && $errors->any()? old('question') : (isset($item)? $item->question : '')) }}">
                                        {!! form_error_message('question', $errors) !!}
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <div class="form-group {{ form_error_class('category_id', $errors) }}">
                                        <label for="category">Catégorie</label>
                                        {!! form_select('category_id', ([0 => 'Selectionner une Catégorie'] + $categories), ($errors && $errors->any()? old('category_id') : (isset($item)? $item->category_id : '')), ['class' => 'select2 form-control']) !!}
                                        {!! form_error_message('category_id', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ form_error_class('answer', $errors) }}">
                                <label for="answer-content">Réponse</label>
                                <textarea class="form-control" id="answer-content" name="answer" rows="18" placeholder="Insérer une Réponse">{{ ($errors && $errors->any()? old('answer') : (isset($item)? $item->answer : '')) }}</textarea>
                                {!! form_error_message('answer', $errors) !!}
                            </div>
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
			height: 600
		};
		
        $(function ()
        {
			/* remplace textarea editor-content */
			var textareaContent = CKEDITOR.replace('answer-content', options_content);
        });
	</script>
@endsection

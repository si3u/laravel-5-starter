
@section('scripts')
	@parent
	<script type="text/javascript">
		
		$('#countDescription').text($('input#description').val().length);
		
		/* Compte en temps réel le nombre de caractère de la description */
		$(document).on('keyup mouseover', 'input#description', function(event){
			var lenghtDesc = event.currentTarget.textLength;
			if(lenghtDesc >= 120) { $('#description').removeClass('has-error').addClass('has-success');
			} else { $('#description').removeClass('has-success').addClass('has-error'); }
			$('#countDescription').text(lenghtDesc);
		});
	</script>
@endsection

<div role="tabpanel" class="tab-pane fade" id="description">

	<form method="POST" action="{{$selectedNavigation->url}}/update/description" accept-charset="UTF-8" class="form-horizontal">

		<input name="_token" type="hidden" value="{{ csrf_token() }}">
		<input name="_method" type="hidden" value="POST">
		<input name="id" type="hidden" value="2">

		<div class="box-header">
			<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i>&nbsp; Enregistrer la description</button>
			<h3>Description</h3>
			@if($description->updated_at != $description->created_at)
			<p class="small text-muted">Dernière mise à jour : {{ format_date($description->updated_at) }}</p>
			@endif
		</div>
		<div class="box-content">

			<div class="input-group {{ form_error_class('description', $errors) }}" id="description">
				<span class="input-group-addon" title="nombres de caractères"><b id="countDescription"></b></span>
				<input type="text" name="description" class="form-control input-md" id="description" minlength="40" maxlength="200" value="{{ old('description') ? old('description') : $description->value }}" spellcheck="true" required>
				{!! form_error_message('description', $errors) !!}
			</div>

			<br/>
			<br/>
		</div>
		<div class="box-footer">
			<small class="text-muted">Entre 120 et 200 caractères.<br>Cette description servira à l'Accueil et en cas de non remplissages des champs "description" prévus pour les pages.</small>
		</div>
	</form>

</div>
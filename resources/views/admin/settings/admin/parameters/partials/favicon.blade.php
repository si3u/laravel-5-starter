
<div class="col-md-6">
	<form id="form-favicon" method="POST" action="{{$selectedNavigation->url}}/update/favicon" 
		  accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">

		<input name="_token" type="hidden" value="{{ csrf_token() }}">
		<input name="_method" type="hidden" value="POST">

		<div class="box-header">
			<!--<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i>&nbsp; Enregistrer les favicons</button>-->
			<h3>Favicon&nbsp; &nbsp;<img src="{{ asset('uploads/images/favicons/favicon-16.png')."?".time() }}"></h3>
		</div>

		<div class="box-content">

			<div class="{{ form_error_class('favicon', $errors) }}">
				<div class="input-group input-group-sm">
					<input id="favicon-label" type="text" class="form-control" onclick="document.getElementById('favicon').click();" readonly placeholder="Rechercher votre favicon">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" onclick="document.getElementById('favicon').click();">Chercher</button>
					</span>
					<input id="favicon" style="display: none" type="file" name="favicon" onchange="$('#form-favicon').submit()" required>
				</div>
				{!! form_error_message('favicon', $errors) !!}
			</div>

			<br/>
			<br/>
		</div>

		<div class="box-footer">
			<small class="text-muted">
				Le favicon s'affiche dans l'onglet du navigateur... Pratique pour le visiteur.
				<br/><b>Minimum {{ $sizes[2] }} x {{ $sizes[2] }} pixels</b> de type <b>png</b>. L'image sera créé en plusieurs dimensions.
			</small>
		</div>
	</form>
</div>

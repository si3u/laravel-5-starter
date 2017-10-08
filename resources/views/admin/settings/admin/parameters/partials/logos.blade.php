
<div class="col-md-6">
	<form id="form-logo" method="POST" action="{{$selectedNavigation->url}}/update/logo" 
		  accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">

		<input name="_token" type="hidden" value="{{ csrf_token() }}">
		<input name="_method" type="hidden" value="POST">
		<!--<input name="id" type="hidden" value="4">-->

		<div class="box-header">
			<!--<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i>&nbsp; Enregistrer le logo</button>-->
			<h3>Logos&nbsp;&nbsp;
				<a href="" class="btn btn-sm btn-default" title="rafraîchir la page"><i class="fa fa-refresh"></i></a>
			</h3>
		</div>

		<div class="box-content">

			<div class="{{ form_error_class('logo', $errors) }}">
				<div class="input-group input-group-sm">
					<input id="logo-label" type="text" class="form-control" onclick="document.getElementById('logo').click();" readonly placeholder="Rechercher votre logo">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" onclick="document.getElementById('logo').click();">Chercher</button>
					</span>
					<input id="logo" style="display: none" type="file" name="logo" onchange="$('#form-logo').submit()/*document.getElementById('logo-label').value = this.value*/" required>
				</div>
				{!! form_error_message('logo', $errors) !!}
			</div>

		@if( file_exists( upload_path_images()."logo_". str_slug(infos('societe')) .".png" ) )
			<div class="col-md-8 text-center">
				<br/>
				<p class="lead">Logo Principal</p>
				<img src="{{ infos('logo')."?".time() }}" class="img-responsive">
				<input type="hidden" name="logo_save" value="logo_{{ infos('societe') }}.png">
			</div>
			<div class="col-md-4 text-center">
				<br/>
				<p class="lead">Logo Mini</p>
				<img src="{{ infos('logo-mini')."?".time() }}">
			</div>
			<div class="clearfix"></div>
		@endif

			<br/>
			<br/>
		</div>

		<div class="box-footer">
			<small class="text-muted"><b>Maximum 0.8Mo</b> (800Ko) de type <b>png</b>. L'image sera redimensionnée à {{ $sizes[0] }} pixels de largeur ou en hauteur en préservant le ratio (et {{ $sizes[1] }} pixels pour le logo dans sa version mini).</small>
		</div>
	</form>
</div>

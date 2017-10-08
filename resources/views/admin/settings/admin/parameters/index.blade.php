@extends('layouts.admin')

@section('content')

<div class="row">
<div class="col-xs-12">
<div class="box box-primary box-solid">

	<div class="box-header with-border">
		<h3 class="box-title">
			<span><i class="fa fa-table"></i></span>
			<span>{{ ucfirst(str_plural($resource)) }}</span>
		</h3>
	</div>

	<div class="box-body">

		@include('admin.partials.info')
		
		@if( $errors->any() )
		{{ notify()->error('Ooops', 'Une erreur est survenue à la validation des champs.') }}
		@endif

		<br/>
		<br/>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#keywords" aria-controls="keywords" role="tab" data-toggle="tab"><b>Mots Clé</b></a></li>
			<li role="presentation"><a href="#description" aria-controls="description" role="tab" data-toggle="tab"><b>Description</b></a></li>
			<li role="presentation"><a href="#horaires" aria-controls="horaires" role="tab" data-toggle="tab"><b>Horaires</b></a></li>
			<li role="presentation"><a href="#logo-favicon" aria-controls="logo-favicon" role="tab" data-toggle="tab"><b>Logo et Favicon</b></a></li>
			<li role="presentation"><a href="#infos" aria-controls="infos" role="tab" data-toggle="tab"><b>Informations</b></a></li>
			<li role="presentation"><a href="#socials" aria-controls="socials" role="tab" data-toggle="tab"><b>Réseaux Sociaux</b></a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
		
			<br/>
			<br/>
		
	<!-- KEYWORDS -->
	
	@include('admin.settings.admin.parameters.partials.keywords')

	<!-- DESCRIPTION -->
	
	@include('admin.settings.admin.parameters.partials.description')
			


	<!-- HORAIRES -->
	
	@include('admin.settings.admin.parameters.partials.horaires')
	

			<div role="tabpanel" class="tab-pane fade" id="logo-favicon">
				
	<!-- LOGO / LOGO-MINI -->
	
	@include('admin.settings.admin.parameters.partials.logos')
	
	
	<!-- FAVICON -->
	
	@include('admin.settings.admin.parameters.partials.favicon')
	

			</div>
	
	<!-- INFOS -->
	
	@include('admin.settings.admin.parameters.partials.infos')
	

	<!-- SOCIALS -->
	
	@include('admin.settings.admin.parameters.partials.socials')



		</div>
		<!-- /.tab-content -->
					
	</div>
</div>
</div>
</div>
@endsection


<div role="tabpanel" class="tab-pane active fade in" id="keywords">

	<form method="POST" action="{{$selectedNavigation->url}}/update/keywords" accept-charset="UTF-8" class="form-horizontal">

		<input name="_token" type="hidden" value="{{ csrf_token() }}">
		<input name="_method" type="hidden" value="POST">
		<input name="id" type="hidden" value="1">

		<div class="box-header">
			<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i>&nbsp; Enregistrer les mots clé</button>
			<h3>Mots Clé disponibles</h3>
			@if($keywords->updated_at != $keywords->created_at)
			<p class="small text-muted">Dernière mise à jour : {{ format_date($keywords->updated_at) }}</p>
			@endif
		</div>
		<div class="box-content">

<?php // tout ça ici pour avoir la date d'update...
				$keywords = $keywords->value;
				foreach ($keywords as $k => $v) { // ça pour que le select2 dans la vue les marque comme selected (form_helpers.php)
					$keywords[$v] = $v; // il faut que la clé soit identique à la valeur...
					unset($keywords[$k]);
				}
?>
			<div class="input-group{{ form_error_class('keywords', $errors) }}">
				<span class="input-group-addon" title="nombres de mots (au chargement de la page)"><b>{{ countKeywords($keywords) }}</b></span>
				{!! form_select('keywords[]', $keywords, (old('keywords') ? old('keywords') : $keywords), ['class' => 'select2 select2tags input-group', 'multiple', 'required']) !!}
				{!! form_error_message('keywords', $errors) !!}
			</div>
			<br/>
			<br/>
		</div>

		<div class="box-footer">
			<small class="text-muted">
				Jusqu'a 100 mots ou 1000 caractères.
				<br>Ces mots clé alimenteront les listes déroulantes. Elles seront aussi utilisés pour l'accueil et pour pré-remplir ceux d'une nouvelle réalisation.
				<br>Pour en ajouter un, il suffit de l'écrire dans le champ et taper <em>Entrée</em> ou <em>Virgule</em> (<b>,</b>).
			</small>
		</div>
	</form>

</div>

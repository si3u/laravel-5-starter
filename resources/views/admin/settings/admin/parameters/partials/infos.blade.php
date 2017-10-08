
<div role="tabpanel" class="tab-pane fade" id="infos">

	<form method="POST" action="{{$selectedNavigation->url}}/update/infos" accept-charset="UTF-8" class="form-horizontal">

		<input name="_token" type="hidden" value="{{ csrf_token() }}">
		<input name="_method" type="hidden" value="POST">
		<input name="id" type="hidden" value="4">


<!-- DIRIGEANT -->
		<div class="box-header">
			<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i>&nbsp; Enregistrer les informations</button>
			<h3>Informations Dirigeant</h3>
			@if($infos->updated_at != $infos->created_at)
			<p class="small text-muted">Dernière mise à jour : {{ format_date($infos->updated_at) }}</p>
			@endif
		</div>

		<?php //$info = json_decode($infos->value)->infos; ?>
		<?php $info = $infos->value;//->infos; //dd($info); ?>


		<div class="box-content">

			<div class="col-md-2">
				<div class="{{ form_error_class('nom', $errors) }}">
					<label for="nom">Nom du dirigeant</label>
					<input type="text" name="nom" class="form-control input-md" id="nom" value="{{ old('nom') ? old('nom') : $info->nom }}" required>
					{!! form_error_message('nom', $errors) !!}
				</div>
			</div>

			<div class="col-md-2">
				<div class="{{ form_error_class('prenom', $errors) }}">
					<label for="prenom">Prénom du dirigeant</label>
					<input type="text" name="prenom" class="form-control input-md" id="prenom" value="{{ old('prenom') ? old('prenom') : $info->prenom }}" required>
					{!! form_error_message('prenom', $errors) !!}
				</div>
			</div>

		</div>

		<div class="clearfix"></div>
		<br/>
		<br/>

<!-- INFOS ENTREPRISES -->

		<div class="box-header">
			<h3>Informations Entreprise</h3>
		</div>

		<div class="box-content">

			<div class="col-md-2">
				<div class="{{ form_error_class('societe', $errors) }}">
					<label for="societe">Nom Entreprise</label>
					<input type="text" name="societe" class="form-control input-md" id="societe" maxlength="22" value="{{ old('societe') ? old('societe') : $info->societe }}" required>
					{!! form_error_message('societe', $errors) !!}
				</div>
			</div>

			<div class="col-md-3">
				<div class="{{ form_error_class('slogan', $errors) }}">
					<label for="slogan">Slogan</label> <small>(facultatif)</small>
					<input type="text" name="slogan" class="form-control input-md" id="slogan" maxlength="55" value="{{ old('slogan') ? old('slogan') : $info->slogan }}">
					{!! form_error_message('slogan', $errors) !!}
				</div>
			</div>

			<div class="col-md-2">
				<div class="{{ form_error_class('siret', $errors) }}">
					<label for="siret">Siret</label>
					<input type="text" name="siret" class="form-control input-md" id="siret" maxlength="15" value="{{ old('siret') ? old('siret') : $info->siret }}" required>
					{!! form_error_message('siret', $errors) !!}
				</div>
			</div>

			<div class="col-md-2">
				<div class="{{ form_error_class('statut', $errors) }}">
					<label for="statut">Statut</label>
					<input type="text" name="statut" class="form-control input-md" id="statut" value="{{ old('statut') ? old('statut') : $info->statut }}" required>
					{!! form_error_message('statut', $errors) !!}
				</div>
			</div>

			<div class="col-md-2">
				<div class="{{ form_error_class('capital', $errors) }}">
					<label for="capital">Capital</label> <small>(facultatif)</small>
					<div class="input-group">
						<input type="number" name="capital" class="form-control input-md" id="capital" value="{{ old('capital') ? old('capital') : $info->capital }}">
						<span class="input-group-addon"> <b>€</b></span>
					</div>
					{!! form_error_message('capital', $errors) !!}
				</div>
			</div>

		</div>

		<div class="clearfix"></div>
		<br/>
		<br/>

<!-- CONTACTS ENTREPRISES -->

		<div class="box-header">
			<h3>Contacts Entreprise</h3>
		</div>

		<div class="box-content">

<!-- TELEPHONES -->			

			<div class="col-md-2">
				<div class="{{ form_error_class('telfixe', $errors) }}">
					<label for="telfixe">Téléphone Fixe</label> <small>(facultatif)</small>
					<input type="tel" name="telfixe" class="form-control input-md" id="telfixe" max="14" value="{{ old('telfixe') ? old('telfixe') : $info->telfixe }}">
					{!! form_error_message('telfixe', $errors) !!}
				</div>
			</div>


			<div class="col-md-2">
				<div class="{{ form_error_class('telmobile', $errors) }}">
					<label for="telmobile">Téléphone Mobile</label> <small>(facultatif)</small>
					<input type="tel" name="telmobile" class="form-control input-md" id="telmobile" max="14" value="{{ old('telmobile') ? old('telmobile') : $info->telmobile }}">
					{!! form_error_message('telmobile', $errors) !!}
				</div>
			</div>

<!-- ADRESSE -->

			<div class="col-md-2">
				<div class="{{ form_error_class('rue', $errors) }}">
					<label for="rue">Rue</label>
					<input type="text" name="rue" class="form-control input-md" id="rue" value="{{ old('rue') ? old('rue') : $info->rue }}" required>
					{!! form_error_message('rue', $errors) !!}
				</div>
			</div>

			<div class="col-md-2">
				<div class="{{ form_error_class('cp', $errors) }}">
					<label for="cp">Code Postal</label>
					<input type="text" name="cp" class="form-control input-md" id="cp" value="{{ old('cp') ? old('cp') : $info->cp }}" required>
					{!! form_error_message('cp', $errors) !!}
				</div>
			</div>

			<div class="col-md-2">
				<div class="{{ form_error_class('ville', $errors) }}">
					<label for="ville">Commune</label>
					<input type="text" name="ville" class="form-control input-md" id="ville" value="{{ old('ville') ? old('ville') : $info->ville }}" required>
					{!! form_error_message('ville', $errors) !!}
				</div>
			</div>

			<div class="col-md-2">
				<div class="{{ form_error_class('region', $errors) }}">
					<label for="region">Région</label>
					<input type="text" name="region" class="form-control input-md" id="region" value="{{ old('region') ? old('region') : $info->region }}" required>
					{!! form_error_message('region', $errors) !!}
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<br/>
		<br/>
		<div class="box-footer">
			<small class="text-muted"></small>
		</div>
		
		

<!-- LONGITUDE /  LATITUDE -->
		<div class="box-header">
			<h3>Longitude / Latitude</h3>
			<p class="small text-muted">
				<a href="http://www.gpsfrance.net/adresse-vers-coordonnees-gps" target="_blank">
					Trouver ma position
				</a>
			</p>
		</div>

		<div class="box-content">

			<div class="col-md-2">
				<div class="{{ form_error_class('longitude', $errors) }}">
					<label for="longitude">Longitude</label>
					<input type="text" name="longitude" class="form-control input-md" id="longitude" value="{{ old('longitude') ? old('longitude') : $info->longitude }}" required>
					{!! form_error_message('longitude', $errors) !!}
				</div>
			</div>

			<div class="col-md-2">
				<div class="{{ form_error_class('latitude', $errors) }}">
					<label for="prenom">Latitude</label>
					<input type="text" name="latitude" class="form-control input-md" id="latitude" value="{{ old('latitude') ? old('latitude') : $info->latitude }}" required>
					{!! form_error_message('latitude', $errors) !!}
				</div>
			</div>


		</div>

		<div class="clearfix"></div>
		<br/>
		<br/>

		
		
		
	</form>

</div>

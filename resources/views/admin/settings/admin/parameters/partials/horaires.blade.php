
<div role="tabpanel" class="tab-pane fade" id="horaires">

	<form method="POST" action="{{$selectedNavigation->url}}/update/horaires" accept-charset="UTF-8" class="form-horizontal">

		<input name="_token" type="hidden" value="{{ csrf_token() }}">
		<input name="_method" type="hidden" value="POST">
		<input name="id" type="hidden" value="3">

		<div class="box-header">
			<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i>&nbsp; Enregistrer les horaires</button>
			<h3>Horaires</h3>
			@if($horaires->updated_at != $horaires->created_at)
			<p class="small text-muted">Dernière mise à jour : {{ format_date($horaires->updated_at) }}</p>
			@endif
		</div>
		<div class="box-content" id="content_horaires">

			<?php //$horaires = json_decode($horaires->value) ?>
			<?php $horaires = $horaires->value; ?>

			<table class="table table-responsive table-striped {{ form_error_class('horaires', $errors) }}">

				<thead class="text-center">
					<tr>
						<td>Jours</td>
						<td>Matins</td>
						<td>Après-midis</td>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td>LUNDI</td>
						<td>
							<input type="text" name="open1_lundi" value="{{ $horaires->open1_lundi }}" 
								   class="form-control" placeholder="ouverture matin">

							<input type="text" name="close1_lundi" value="{{ $horaires->close1_lundi }}" 
								   class="form-control" placeholder="fermeture midi">	
						</td>
						<td>
							<input type="text" name="open2_lundi" value="{{ $horaires->open2_lundi }}" 
								   class="form-control" placeholder="ouverture après-midi">

							<input type="text" name="close2_lundi" value="{{ $horaires->close2_lundi }}" 
								   class="form-control" placeholder="fermeture soir">
						</td>
					</tr>
					<tr>
						<td>MARDI</td>
						<td>
							<input type="text" name="open1_mardi" value="{{ $horaires->open1_mardi }}" 
								   class="form-control" placeholder="ouverture matin">

							<input type="text" name="close1_mardi" value="{{ $horaires->close1_mardi }}" 
								   class="form-control" placeholder="fermeture midi">	
						</td>
						<td>
							<input type="text" name="open2_mardi" value="{{ $horaires->open2_mardi }}" 
								   class="form-control" placeholder="ouverture après-midi">

							<input type="text" name="close2_mardi" value="{{ $horaires->close2_mardi }}" 
								   class="form-control" placeholder="fermeture soir">
						</td>
					</tr>
					<tr>
						<td>MERCREDI</td>
						<td>
							<input type="text" name="open1_mercredi" value="{{ $horaires->open1_mercredi }}" 
								   class="form-control" placeholder="ouverture matin">

							<input type="text" name="close1_mercredi" value="{{ $horaires->close1_mercredi }}" 
								   class="form-control" placeholder="fermeture midi">	
						</td>
						<td>
							<input type="text" name="open2_mercredi" value="{{ $horaires->open2_mercredi }}" 
								   class="form-control" placeholder="ouverture après-midi">

							<input type="text" name="close2_mercredi" value="{{ $horaires->close2_mercredi }}" 
								   class="form-control" placeholder="fermeture soir">
						</td>
					</tr>
					<tr>
						<td>JEUDI</td>
						<td>
							<input type="text" name="open1_jeudi" value="{{ $horaires->open1_jeudi }}" 
								   class="form-control" placeholder="ouverture matin">

							<input type="text" name="close1_jeudi" value="{{ $horaires->close1_jeudi }}" 
								   class="form-control" placeholder="fermeture midi">	
						</td>
						<td>
							<input type="text" name="open2_jeudi" value="{{ $horaires->open2_jeudi }}" 
								   class="form-control" placeholder="ouverture après-midi">

							<input type="text" name="close2_jeudi" value="{{ $horaires->close2_jeudi }}" 
								   class="form-control" placeholder="fermeture soir">
						</td>
					</tr>
					<tr>
						<td>VENDREDI</td>
						<td>
							<input type="text" name="open1_vendredi" value="{{ $horaires->open1_vendredi }}" 
								   class="form-control" placeholder="ouverture matin">

							<input type="text" name="close1_vendredi" value="{{ $horaires->close1_vendredi }}" 
								   class="form-control" placeholder="fermeture midi">	
						</td>
						<td>
							<input type="text" name="open2_vendredi" value="{{ $horaires->open2_vendredi }}" 
								   class="form-control" placeholder="ouverture après-midi">

							<input type="text" name="close2_vendredi" value="{{ $horaires->close2_vendredi }}" 
								   class="form-control" placeholder="fermeture soir">
						</td>
					</tr>
					<tr>
						<td>SAMEDI</td>
						<td>
							<input type="text" name="open1_samedi" value="{{ $horaires->open1_samedi }}" 
								   class="form-control" placeholder="ouverture matin">

							<input type="text" name="close1_samedi" value="{{ $horaires->close1_samedi }}" 
								   class="form-control" placeholder="fermeture midi">	
						</td>
						<td>
							<input type="text" name="open2_samedi" value="{{ $horaires->open2_samedi }}" 
								   class="form-control" placeholder="ouverture après-midi">

							<input type="text" name="close2_samedi" value="{{ $horaires->close2_samedi }}" 
								   class="form-control" placeholder="fermeture soir">
						</td>
					</tr>
				</tbody>

			</table>
			{!! form_error_message('horaires', $errors) !!}

			<br/>
			<br/>
		</div>
		<div class="box-footer">
			<small class="text-muted">Pour une demi-journée fermée : Le second vide et le premier avec "Fermé".</small>
		</div>
	</form>

</div>

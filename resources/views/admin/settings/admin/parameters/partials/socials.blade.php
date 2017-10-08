
<div role="tabpanel" class="tab-pane fade" id="socials">

	<form method="POST" action="{{$selectedNavigation->url}}/update/socials" accept-charset="UTF-8" class="form-horizontal">

		<input name="_token" type="hidden" value="{{ csrf_token() }}">
		<input name="_method" type="hidden" value="POST">
		<input name="id" type="hidden" value="5">

		<div class="box-header">
			<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i>&nbsp; Enregistrer les réseaux sociaux</button>
			<h3>Réseaux Sociaux</h3>
			@if($socials->updated_at != $socials->created_at)
			<p class="small text-muted">Dernière mise à jour : {{ format_date($socials->updated_at) }}</p>
			@endif
		</div>
		<div class="box-content">

			<div class="col-md-3">
				<div class="{{ form_error_class('facebookappid', $errors) }}">
					<div class="input-group">
						<label>Facebook APP ID</label>
						<input type="text" name="facebookappid" class="form-control input-md" id="facebookappid" value="{{ old('facebookappid') ? old('facebookappid') : $socials->value->facebookappid }}">
					</div>
					{!! form_error_message('facebookappid', $errors) !!}
				</div>
			</div>

			<div class="col-md-3">
				<div class="{{ form_error_class('twitterpage', $errors) }}">
					<div class="input-group">
						<label>Page Twitter <em>@</em></label>
						<input type="text" name="twitterpage" class="form-control input-md" id="twitterpage" value="{{ old('twitterpage') ? old('twitterpage') : $socials->value->twitterpage }}" placeholder="@">
					</div>
					{!! form_error_message('twitterpage', $errors) !!}
				</div>
			</div>

			<div class="clearfix"></div>
			<br/>
			<br/>

		</div>
		<div class="box-footer">
			<small class="text-muted"></small>
		</div>
	</form>

</div>


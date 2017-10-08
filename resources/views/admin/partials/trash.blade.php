
@if(count($trash) >= 1)

<div role="tabpanel" class="tab-pane fade" id="corbeille">
	<br>
	<br>
	<table id="tbl-list-2" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th>Titre</th>
			<th class="desktop">Description</th>
			<th>Supprimée le</th>
			<th>Actions</th>
		</tr>
		</thead>
		<tbody>
		@foreach ($trash as $k => $item)
			<tr>
				<td>{{ $item->title }}</td>
				<td>{!! $item->summary !!}</td>
				<td>{{ format_date_short($item->deleted_at) }}</td>
				<td>
					{!! action_row($selectedNavigation->url, $item->id, $item->title, ['forceDelete', 'restore']) !!}
				@if($k == 0)
					<div class="pull-right">
						<form id="form-delete-row0" method="POST" action="{{ $selectedNavigation->url }}/0/force-delete">
							<input name="_token" type="hidden" value="{{ csrf_token() }}">
							<input name="_id" type="hidden" value="0">
							<a data-form="form-delete-row0" class="btn btn-warning btn-sm btn-delete-row margin" data-toggle="tooltip" 
							   title="Supprimer définitivement les {{ $type }} présentes dans la corbeille et les médias associés">
								<i class="fa fa-trash"></i>&nbsp; Vider la Corbeille
							</a>
						</form>
					</div>
				@endif
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>

@endif

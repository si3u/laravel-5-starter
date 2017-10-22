@extends('layouts.admin')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">
						<span><i class="fa fa-table"></i></span>
						<span>Liste des étiquettes</span>
					</h3>
				</div>

				<div class="box-body">

					@include('admin.partials.info')

					@include('admin.partials.toolbar')

					<table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>Nom</th>
							<th class="desktop">Description</th>
							<th>Nombre</th>
							<th>Slug</th>
							<th>Créé le</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($items as $item)
							<tr>
								<td>{{ $item->name }}</td>
								<td>{{ $item->description }}</td>
								<td>{{ $item->count }}</td>
								<td>{{ $item->slug }}</td>
								<td>{{ format_date($item->created_at) }}</td>
								<td>{!! action_row($selectedNavigation->url, $item->id, $item->name, ['edit', 'delete']) !!}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
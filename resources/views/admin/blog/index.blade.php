@extends('layouts.admin')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">
						<span><i class="fa fa-table"></i></span>
						<span>Liste des Réalisations</span>
					</h3>
				</div>

				<div class="box-body">

					@include('admin.partials.info')

					@include('admin.partials.toolbar')

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#liste" aria-controls="liste" role="tab" data-toggle="tab"><b>Liste</b> ({{ count($items) }})</a></li>
					@if(count($trash) >= 1)
						<li role="presentation"><a href="#corbeille" aria-controls="corbeille" role="tab" data-toggle="tab"><b>Corbeille</b> ({{ count($trash) }})</a></li>
					@endif
					</ul>
					
					<!-- Tab panes -->
					<div class="tab-content">

						<div role="tabpanel" class="tab-pane active fade in" id="liste">
							<br>
							<br>
							<table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
								<tr>
									<th>Titre</th>
									<th class="desktop">Description</th>
									<th>Catégorie</th>
									<th>Mise en ligne</th>
									<th>Jusqu'au</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								@foreach ($items as $item)
									<tr>
										<td title="Modifier cette réalisation">
											<a href="/admin/blog/articles/{{ $item->id }}/edit">{{ $item->title }}</a>
										</td>
										<td>{!! $item->summary !!}</td>
										@if($item->category)
										<td title="Modifier la catégorie : {{ $item->category->name }}">
											<a href="/admin/blog/categories/{{$item->id}}/edit">{{ $item->category->name }}</a>
										</td>
										@else
										<td>{{ ($item->category)? $item->category->name:'-' }}</td>
										@endif
										<td>{{ format_date_short($item->active_from) }}</td>
										<td>{{ isset($item->active_to)? format_date($item->active_to):'-' }}</td>
										<td>{!! action_row($selectedNavigation->url, $item->id, $item->title, [/*['image' => 'admin/images/articles/'.$item->id], */'show', 'edit', 'copy', 'delete']) !!}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					
		{{-- ARTICLES SUPPRIMEES --}}
		
						@include('admin.partials.trash', ['type' => 'Réalisations'])
					
					</div>
					
				</div>
			</div>
		</div>
	</div>

@endsection
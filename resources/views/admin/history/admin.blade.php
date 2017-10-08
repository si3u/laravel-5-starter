@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>Liste Actions Administration</span>
						
						<span>&nbsp; &nbsp;
							<a href="/admin/latest-activity/delete/admin" class="btn btn-md btn-warning" title="supprimer toutes les activités Administration">
								<i class="fa fa-trash-o"></i>
							</a>
						</span>
						
                    </h3>

                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-default btn-sm" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
					
                    <table id="tbl-list-activities" data-order-by="0|desc" data-server="false" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Utilisateur</th>
                            <th>Actions</th>
                            <th>Avant</th>
                            <th>Après</th>
                            <th>Création</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                <td>{{ isset($activity->user)? $activity->user->fullname:'Système' }}</td>
                                <td>{!! $activity->name !!}</td>
                                <td>{!! activity_before($activity) !!}</td>
                                <td>{!! activity_after($activity) !!}</td>
                                {{--<td>{{ isset($activity->subject)? isset($activity->subject->title)? $activity->subject->title:'':'' }}</td>--}}
                                <td>{{ $activity->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            initDataTables('#tbl-list-activities', {
                'pageLength': 25,
                'columnDefs': [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },
                ]
            });
        })
    </script>
@endsection
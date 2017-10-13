@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-users"></i></span>
                        <span>Liste des {{ $selectedNavigation->title }}{{--  ucfirst(str_plural($resource)) --}}</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    <div class="well well-sm well-toolbar">
                        <a class="btn btn-labeled btn-primary" href="{{ Request::url().'/invites' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-user-secret"></i></span>Inviter un Utilisateur/Administrateur
                        </a>
                        <a class="btn btn-labeled btn-primary" href="{{ Request::url().'/create' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-user-plus"></i></span>Ajouter un Utilisateur/Administrateur
                        </a>
                    </div>

                    <table id="tbl-list" data-server="false" class="dt-table table nowrap table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><i class="fa fa-fw fa-user text-muted"></i> Prénom Nom</th>
                            <th><i class="fa fa-fw fa-envelope text-muted"></i> Email</th>
                            <th><i class="fa fa-fw fa-mobile-phone text-muted"></i> Mobile</th>
                            <th>Rôles</th>
                            <th><i class="fa fa-fw fa-calendar text-muted"></i> Dernière connexion</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->gender }} {{ $item->fullname }}</td>
                                <td>
									<a href="mailto:{{ $item->email }}" title="Envoyer un mail à {{ $item->gender }} {{ $item->lastname }}">
										{{ $item->email }}
									</a>
								</td>
                                <td>{{ $item->cellphone }}</td>
                                <td>{{ $item->roles_string }}</td>
                                <td>{{ ($item->logged_in_at)? $item->logged_in_at->diffForHumans():'-' }}</td>
                                <td>
                                    <div class="btn-toolbar">
										
									@if(user()->isAdmin())
                                        <div class="btn-group">
                                            <form id="impersonate-login-form-{{ $item->id }}" action="{{ route('impersonate.login', $item->id) }}" method="post">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                <a data-form="impersonate-login-form-{{ $item->id }}" class="btn btn-warning btn-sm btn-confirm-modal-row" data-toggle="tooltip" title="Impersonate {{ $item->fullname }}">
                                                    <i class="fa fa-user-secret"></i>
                                                </a>
                                            </form>
                                        </div>
                                        {!! action_row($selectedNavigation->url, $item->id, $item->fullname, ['edit', 'delete'], false) !!}
									@else
                                        {!! action_row($selectedNavigation->url, $item->id, $item->fullname, ['edit'], false) !!}
									@endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
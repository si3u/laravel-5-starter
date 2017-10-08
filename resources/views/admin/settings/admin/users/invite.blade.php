@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span class="widget-icon"><i class="fa fa-user-plus"></i></span>
                        <span>Inviter un Administrateur</span>
                    </h3>
                </div>

                <div class="box-body no-padding">
                    <form id="form-settings-administrators" method="POST" action="{{ Request::url() }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="invited_by" value="">

                        <fieldset>
                            <section class="form-group {{ form_error_class('email', $errors) }}">
                                <label for="id-email">Email de l'administrateur à inviter</label>
                                <input type="text" class="form-control" id="id-email" name="email" placeholder="Entrer son courriel" value="{{ old('email') }}">
                                {!! form_error_message('email', $errors) !!}
                            </section>
                        </fieldset>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-submit">
								<i class="fa fa-paper-plane-o"></i>&nbsp; Envoyer à l'invité
							</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		<div class="clearfix"></div>
    </div>

@if( count($invited) >= 1)

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span class="widget-icon"><i class="fa fa-users"></i></span>
                        <span>Liste des Administrateurs invités</span>
                    </h3>
                </div>

                <div class="box-body">
                    <table id="tbl-list" data-server="false" class="dt-table table nowrap table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><i class="fa fa-fw fa-envelope text-muted"></i> Email</th>
                            <th><i class="fa fa-fw fa-user text-muted"></i> Invité par</th>
                            <th><i class="fa fa-fw fa-calendar"></i> Créé le</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($invited as $user)
                            <tr>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->invitedBy->fullname }}</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
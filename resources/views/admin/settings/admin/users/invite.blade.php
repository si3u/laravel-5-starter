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
                                <label for="id-email">E-mail de l'invité</label>
                                <input type="text" class="form-control" id="id-email" name="email" placeholder="Entrer son courriel" value="{{ old('email') }}">
                                {!! form_error_message('email', $errors) !!}
                            </section>
							
							
							<section class="form-group {{ form_error_class('roles', $errors) }}">
								<label for="roles">Futur(s) rôle(s) de l'invité</label>
								{!! form_select('roles[]', $roles, ($errors && $errors->any()? old('roles') : '' ), ['class' => 'select2 select2notags form-control', 'multiple']) !!}
								{!! form_error_message('roles', $errors) !!}
							</section>
							
							
                        </fieldset>

                        <div class="form-footer">
						@if( ($errors && $errors->any()) )
							@foreach($errors->all() as $error)
								@if(preg_match("/déjà\ utilisé|been\ taken/", $error))
							<p>
								<a id="btn-delete-invited-user-for-resend" href="#" onclick='deleteAndResend("{{ encrypt(old('email')) }}")' class="btn btn-danger btn-labeled">
									<span class="btn-label"><i class="fa fa-trash"></i></span>
									Supprimer ce compte définitivement et renvoyer l'invitation
								</a>
								<a class="return-to-list-users btn btn-primary btn-labeled" href="/admin/settings/admin/users" style="display:none">
									<span class="btn-label"><i class="fa fa-chevron-left"></i></span>
									Retour à la liste
								</a>
							</p>
								@section('scripts')
									@parent
									<script type="text/javascript">
	
									function deleteAndResend(mail)
									{
										if(mail) {
											var xhr = $.ajax( { 
												url: '/api/invited/resend/'+mail+'/delete',
												method: 'post',
												success: function(res){
													notify('Succès', res);
													$('#btn-delete-invited-user-for-resend').fadeOut();
													$('.return-to-list-users').fadeIn();
												},
												error: function(){
													notifyError('Erreur', "Une erreur est survenue.");
												}
											});
										}
									}
									</script>
								@endsection
								@endif
							@endforeach
						@else
                            <button type="submit" class="btn btn-primary btn-submit">
								<i class="fa fa-paper-plane-o"></i>&nbsp; Envoyer à l'invité
							</button>
						@endif
				
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
							<th><i class="fa fa-fw fa-send-o"></i> Renvoyer</th>
                        </tr>
                        </thead>
                        <tbody>
			
                        @foreach ($invited as $user)
                            <tr>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->invitedBy->fullname }}</td>
                                <td>{{ $user->created_at }}</td>
								<td>
									<form id="form-settings-administrators" method="POST" action="{{ Request::url() }}/reSend">
										{!! csrf_field() !!}
										<input type="hidden" name="invited_by" value="{{ $user->invited_by }}">
										<input type="hidden" name="email" value="{{ $user->email }}">
										<button type="submit" class="btn btn-primary btn-xs btn-submit">Renvoyer l'invitation</button>
									</form>
								</td>
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
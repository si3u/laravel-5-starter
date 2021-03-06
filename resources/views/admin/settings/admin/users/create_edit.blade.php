@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Modifier ' . $item->fullname . '': 'Créer un nouvel utilisateur/administrateur' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')
					
					
					@if(user()->image)
					<section>
						@if(isset($item))
						<img src="/uploads/images/{{ $item->image }}" style="max-height: 80px;">
						@endif
					</section>
					@endif


                    <form id="form-edit" method="POST" action='{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : "/store")}}' accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Genre</label>
                                        <div class="inline-group">
                                            <label class="radio" style="margin-top: 0px;">
                                                <input type="radio" name="gender" value="Mr" {{ ($errors->any() && old('gender') == 'Mr'? 'checked="checked"' : ((isset($item) && $item->gender == 'Mr') ? 'checked="checked"':'') ) }}>
                                                <i></i>Mr
                                            </label>
                                            <label class="radio" style="margin-top: 0px;">
                                                <input type="radio" name="gender" value="Mme" {{ ($errors->any() && old('gender') == 'Mme' ? 'checked="checked"' : ((isset($item) && $item->gender == 'Mme') ? 'checked="checked"':'') ) }}>
                                                <i></i>Mme
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-5">
                                    <div class="form-group {{ form_error_class('firstname', $errors) }}">
                                        <label for="firstname">Prénom</label>
                                        <div class="input-group">
                                            <input type="text" name="firstname" class="form-control" placeholder="Prénom" value="{{ ($errors->any()? old('firstname') : isset($item)? $item->firstname : '') }}"/>
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                        {!! form_error_message('firstname', $errors) !!}
                                    </div>
                                </div>

                                <div class="col col-5">
                                    <div class="form-group {{ form_error_class('lastname', $errors) }}">
                                        <label for="lastname">Nom</label>
                                        <div class="input-group">
                                            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Nom" value="{{ ($errors->any()? old('lastname') : isset($item)? $item->lastname : '') }}"/>
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                        {!! form_error_message('lastname', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
									<div class="form-group {{ form_error_class('roles', $errors) }}">
										<label for="roles">Rôles</label>
										{!! form_select('roles[]', $roles, ($errors && $errors->any()? old('roles') : (isset($item)? $item->roles->pluck('id')->all() : '')), ['class' => 'select2 select2notags form-control', 'multiple']) !!}
										{!! form_error_message('roles', $errors) !!}
									</div>
								</div>
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('cellphone', $errors) }}">
                                        <label for="cellphone">Téléphone Mobile</label>
                                        <div class="input-group">
											<input type="text" class="form-control" id="cellphone" name="cellphone" placeholder="Téléphone Mobile" value="{{ ($errors && $errors->any()? old('cellphone') : isset($item)? $item->cellphone : '') }}"/>
											<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                        </div>
                                        {!! form_error_message('cellphone', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group {{ form_error_class('telephone', $errors) }}">
                                        <label for="telephone">Téléphone Fixe</label>
                                        <div class="input-group">
											<input type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone Fixe" value="{{ ($errors && $errors->any()? old('telephone') : isset($item)? $item->telephone : '' ) }}"/>
											<span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        </div>
                                        {!! form_error_message('telephone', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-5">
                                    <section class="form-group {{ form_error_class('email', $errors) }}">
                                        <label for="email">E-mail @if(isset($item)) (readonly) @endif</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ ($errors->any()? old('email') : isset($item)? $item->email : '') }}" @if(isset($item)) readonly @endif/>
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        {!! form_error_message('email', $errors) !!}
                                    </section>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group {{ form_error_class('born_at', $errors) }}">
                                        <label for="password">Date d'Anniversaire</label>
                                        <div class="input-group">
                                            <input id="born_at" type="text" class="form-control" name="born_at" placeholder="Selectionnez la date d'anniversaire" value="{{ ($errors->any()? old('born_at') : isset($item)? $item->born_at : '') }}"/>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('born_at', $errors) !!}
                                    </div>
                                </div>
                            </div>
			
						@if( ! isset($item))
							<div class="row">
                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('password', $errors) }}">
                                        <label for="password">Mot de passe</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" value=""/>
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        {!! form_error_message('password', $errors) !!}
                                    </section>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('password_confirmation', $errors) }}">
                                        <label for="password_confirmation">Confirmer mot de passe</label>
                                        <div class="input-group">
                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Répéter mot de passe" value=""/>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('password_confirmation', $errors) !!}
                                    </div>
                                </div>
                            </div>
						@endif
					
                        </fieldset>

                        @include('admin.partials.form_footer')
                    </form>
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
            $("#born_at").datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD'
            });
        })
    </script>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <img src="{{ profile_image() }}" class="img-circle" alt="User Image" style="width: 25px;">
                        <span>Mettre à jour le Profil</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form method="POST" id="form-profil" action="{{ $selectedNavigation->url . "/" . user()->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="PUT">

                        <fieldset>
                            <div class="row">
                                <div class="col col-6">
                                    <div class="form-group {{ form_error_class('firstname', $errors) }}">
                                        <label for="firstname">Prénom</label>
                                        <div class="input-group">
                                            <input type="text" name="firstname" class="form-control" placeholder="Prénom" value="{{ ($errors->any()? old('firstname') : user()->firstname) }}">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                        {!! form_error_message('firstname', $errors) !!}
                                    </div>
                                </div>

                                <div class="col col-6">
                                    <div class="form-group {{ form_error_class('lastname', $errors) }}">
                                        <label for="email">Nom</label>
                                        <div class="input-group">
                                            <input type="text" name="lastname" class="form-control" placeholder="Nom" value="{{ ($errors->any()? old('lastname') : user()->lastname) }}">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                        {!! form_error_message('lastname', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('cellphone', $errors) }}">
                                        <label for="cellphone">Téléphone Fixe</label>
                                        <div class="input-group">
											<input type="text" class="form-control" id="cellphone" name="cellphone" placeholder="Ex: 01 23 45 67 89" value="{{ ($errors && $errors->any()? old('cellphone') : user()->cellphone ) }}">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        </div>
                                        {!! form_error_message('cellphone', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('telephone', $errors) }}">
                                        <label for="telephone">Téléphone Mobile</label>
                                        <div class="input-group">
											<input type="text" class="form-control" id="telephone" name="telephone" placeholder="Ex: 06 12 34 56 78" value="{{ ($errors && $errors->any()? old('telephone') : user()->telephone ) }}">
                                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                        </div>
                                        {!! form_error_message('telephone', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('email', $errors) }}">
                                        <label for="email">Courriel</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Adresse électronique" value="{{ ($errors->any()? old('email') : user()->email) }}">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        {!! form_error_message('email', $errors) !!}
                                    </section>
                                </div>

                                <div class="col col-6">
                                    <div class="form-group {{ form_error_class('password', $errors) }}">
                                        <label for="password">Mot de passe (vide pour ne pas changer)</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" value="">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        </div>
                                        {!! form_error_message('password', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Genre</label>
                                        <div class="inline-group">
                                            <label class="radio" style="margin-top: 0px;">
                                                <input type="radio" name="gender" value="Mr" {{ ($errors->any() && old('gender') == 'Mr'? 'checked="checked"' : user()->gender == 'Mr' ? 'checked="checked"':'') }}>
                                                <i></i>Mr
                                            </label>
                                            <label class="radio" style="margin-top: 0px;">
                                                <input type="radio" name="gender" value="Mme" {{ ($errors->any() && old('gender') == 'Mme' ? 'checked="checked"' : user()->gender == 'Mme' ? 'checked="checked"':'') }}>
                                                <i></i>Mme
                                            </label>
                                        </div>
                                    </div>
                                </div>
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Sons Notifications</label>
                                        <div class="inline-group">
                                            <label class="radio" style="margin-top: 0px;">
                                                <input type="radio" name="sound" value="1" {{ ($errors->any() && old('sound') == 1 ? 'checked="checked"' : user()->sound == 1 ? 'checked="checked"':'') }}>
                                                <i></i>Activé
                                            </label>
                                            <label class="radio" style="margin-top: 0px;">
                                                <input type="radio" name="sound" value="0" {{ ($errors->any() && old('sound') == 0 ? 'checked="checked"' : user()->sound == 0 ? 'checked="checked"':'') }}>
                                                <i></i>Désactivé
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('born_at', $errors) }}">
                                        <label for="password">Date d'Anniversaire</label>
                                        <div class="input-group">
                                            <input id="born_at" type="text" class="form-control" name="born_at" placeholder="Selectionnez votre date d'anniversaire" value="{{ ($errors->any()? old('born_at') : user()->born_at) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('born_at', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <section class="form-group {{ form_error_class('photo', $errors) }}">
                                <label>Image du Profil (250x250px)</label>
                                <div class="input-group input-group-sm">
                                    <input id="photo-label" type="text" class="form-control" onclick="document.getElementById('photo').click();" readonly placeholder="Rechercher une image">
                                    <span class="input-group-btn">
                                  <button type="button" class="btn btn-default" onclick="document.getElementById('photo').click();">Chercher</button>
                                </span>
                                    <input id="photo" style="display: none" accept="{{ get_file_extensions('image') }}" type="file" name="photo" onchange="$('#form-profil'].submit()">
                                </div>
                                {!! form_error_message('photo', $errors) !!}
                            </section>

                            @if(user()->image)
                                <section>
                                    <img src="{{ profile_image() }}" style="max-height: 300px;">
                                    <input type="hidden" name="image" value="{{ user()->image }}">
                                </section>
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
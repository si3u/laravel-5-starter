@extends('layouts.auth')

@section('scripts')
	@parent
	<script type="text/javascript">
		$(function(){ $('input#email').focus(); });
	</script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

            <div class="logo"><img src="{{ asset(infos('logo')) }}"/></div>

            <div class="body">
				
                <h4 class="auth-title">Connexion à l'Administration <strong>{{ config('app.name') }}</strong></h4>

                @include('alert::alert')
                @include('admin.partials.errors')

                <form action="{{ url('/auth/login') }}" method="post" class="admin">
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback margin-top-10">
                        <input type="email" id="email" class="form-control" placeholder="E-mail" name="email" value="{{ old('email') }}"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Mot de passe" name="password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <label class="checkbox">
                        <input type="checkbox" name="remember">
                        <i></i>Rester connecté
                    </label>

                    <div class="row margin-top-10">
                        <div class="col-xs-8">
                            <a class="btn btn-link" href="{{ route('forgot-password') }}" style="padding-left: 0;">Mot de passe oublié?</a>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat btn-submit">
                                Connexion&nbsp;
                                <i class="fa fa-sign-in"></i>
                            </button>
                        </div>
                    </div>
                </form>
				
            </div>

			<div class="row">
				<div class="col-md-12 text-right">
					<br/>
					<p><i><a href="/">&DoubleLongLeftArrow;&nbsp; Retour au site</a></i></p>
				</div>

			</div>

			<div class="row">
				<div class="col-md-12 text-center text-muted">
					<br/>
					<p><b class="text-success fa-2x">&Sqrt;</b>&nbsp; Développé par</p>
					<h2>
						<a href="{{ asset(infos('webmaster_url')) }}" target="_blank">
							<img src="{{ asset(infos('webmaster_logo')) }}" alt="{{ infos('webmaster_name') }}"/>
						</a>
					</h2>
					<br/>
					<p>{!! infos('webmaster_telmobile', '&nbsp; &starf;', 'webmaster_telfixe') !!}</p>
					<p>{!! infos('webmaster_cp', '&nbsp;,', 'webmaster_ville') !!}</p>
				</div>

			</div>
        </div>
    </div>

@endsection

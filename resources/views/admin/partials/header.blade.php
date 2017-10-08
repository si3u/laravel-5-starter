<header class="main-header">
    <a href="{{ url('/admin') }}" class="logo">
        <span class="logo-mini"><b>{{ config('app.name-short') }}</b><!--<img src="/images/logo-mini.png" style="width: 100%;"/>--></span>
        <span class="logo-lg"><b>{{ config('app.name') }}</b><!--<img src="/images/logo.png" style="width: 80%;"/>--></span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Menu</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                @if (impersonate()->isActive())
                    <li>
                        <a href="{{ route('impersonate.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('impersonate-logout-form').submit();">
                            Retour à l'utilisateur original
                        </a>
                        <form id="impersonate-logout-form" action="{{ route('impersonate.logout') }}" method="post" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif

				<li>
					<a href="/" target="_blank">Site &nbsp;<i class="fa fa-external-link"></i></a>
				</li>
				
                <li class="dropdown messages-menu">
                    <a id="js-notifications" href="#" class="dropdown-toggle" data-toggle="modal" data-target="#modal-notifications">
                        <i class="fa fa-envelope-o"></i>
                        <span data-user="{{ user()->id }}" id="js-notifications-badge" class="label label-success" style="display: none;"></span>
                    </a>
                </li>

                <li class="dropdown messages-menu">
                    <a data-type="activities" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span id="js-activities-badge" class="label label-warning" style="display: none;"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul id="js-activities-list" class="menu">

                            </ul>
                        </li>
                        <li class="footer"><a href="/admin/latest-activity/website">Voir les activités Website</a>
                        </li>
                        <li class="footer"><a href="/admin/latest-activity/admin">Voir les activités Admin</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ profile_image() }}" class="user-image" alt="image user:{!! user()->id !!}">
                        <span class="hidden-xs">{!! user()->fullname !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ profile_image() }}" class="img-circle" alt="User Image">
                            <p>
                                {!! user()->fullname !!}
                                <small>Inscrit depuis le {{ user()->created_at->format('d F Y') }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url('/admin/profile') }}" class="btn btn-default btn-flat">Profil</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
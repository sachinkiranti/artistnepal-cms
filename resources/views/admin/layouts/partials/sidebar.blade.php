<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element text-center">
                    @auth
                        @if(auth()->user()->hasRole(\App\Foundation\Enums\Role::ROLE_SUPER_ADMIN->value,\App\Foundation\Enums\Role::ROLE_ADMIN->value))
                            <img alt="image" width="70%" src="{{ asset('images/default-logo.png') }}"/>
                            @else
                            <img alt="image" width="60" height="60" class="img-circle" src="{{ auth()->user()->getImage() }}"/>
                        @endif
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">
                            {{ ucwords(auth()->user()->first_name ?? '') }} &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                        </span>
                        <small class="text-muted text-xs block" title="Last login at">
                            <i class="fa fa-clock-o"></i>  {{ optional(auth()->user()->last_login)->diffForHumans() }}
                        </small>
                    </a>
                    @endauth
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="{{ route('admin.profile.edit',auth()->user()->id) }}">Profile</a></li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);"
                               onclick="event.preventDefault();document.getElementById('logout-form-dropdown').submit();">
                                <i class="fa fa-sign-out"></i>
                                Logout
                            </a>
                            <form id="logout-form-dropdown" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {!! csrf_field() !!}
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    AM
                </div>
            </li>

            @include('admin.menu')

        </ul>
    </div>
</nav>

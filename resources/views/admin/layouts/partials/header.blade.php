<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            @php
                $lang = active_lang();
            @endphp
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="false">
                    <img src="{{ asset('images/'. $lang . '.png') }}" alt="English" class="img-circle" style="width:7%;"> {{ $lang === 'np' ? 'Nepali' : 'English' }} <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('translate', 'en') }}">
                            <img src="{{ asset('images/en.png') }}" alt="English" class="img-circle" style="width:8%;">
                            English
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('translate', 'np') }}">
                            <img src="{{ asset('images/np.png') }}" alt="Nepali" class="img-circle" style="width:8%;">
                            Nepali
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/') }}" target="_blank">
                    <i class="fa fa-globe"></i>
                    Frontend
                </a>
            </li>
            @if (auth()->user()->hasAccess())

            <li>
                <a href="{{ url('/customizer') }}" target="_blank">
                    <i class="fa fa-adjust"></i>
                    Customizer
                </a>
            </li>
            <li>
                <a href="{{ route('post.single.customizer', [ 'slug' => app('db')->table('posts')->where('post_type', '!=', 1)->value('unique_identifier') ?? 11111, ]) }}" target="_blank">
                    <i class="fa fa-adjust"></i>
                    Page Customizer
                </a>
            </li>

            @endif
            <li>
                <a href="javascript:void(0);"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>
                    Log Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {!! csrf_field() !!}
                </form>
            </li>
            @if (auth()->user()->hasAccess())
            <li>
                <a class="right-sidebar-toggle">
                    <i class="fa fa-tasks"></i>
                </a>
            </li>
            @endif
        </ul>

    </nav>
</div>

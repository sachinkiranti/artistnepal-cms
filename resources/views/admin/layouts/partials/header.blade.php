<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="{{ url('/') }}" target="_blank">
                    <i class="fa fa-globe"></i>
                    Frontend
                </a>
            </li>

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
{{--            @if (auth()->user()->hasAccess())--}}
{{--            <li>--}}
{{--                <a class="right-sidebar-toggle">--}}
{{--                    <i class="fa fa-tasks"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @endif--}}
        </ul>

    </nav>
</div>

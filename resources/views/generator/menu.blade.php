@hasaccess('admin_{menu}_index|admin_{menu}_create')
    <li class="@isurl('admin/{menu}*') active @endisurl">
        <a href="#">
            <i class="fa fa-question-circle"></i><span class="nav-label">{MENU} </span><span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level @isurl('admin/{menu}*') collapse in @else collapse @endisurl">
            @hasaccess('admin_{menu}_create')
            <li class="@isurl('admin/{menu}/create') @endisurl">
                <a href="{{ route('admin.{menu}.create') }}">
                    <span class="nav-label">Add {MENU}</span></a>
            </li>
            @endhasaccess

            @hasaccess('admin_{menu}_index')
            <li class="@isurl('admin/{menu}') @endisurl">
                <a href="{{ route('admin.{menu}.index') }}">
                    <span class="nav-label">List {MENU}</span></a>
            </li>
            @endhasaccess
        </ul>
    </li>
@endhasaccess

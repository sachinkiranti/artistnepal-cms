<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>{{ $role->name }} Management</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.user-type.index', $role->id) }}">{{ $role->name }}</a>
            </li>

            <li class="breadcrumb-item">
                <strong>{{ $title }}</strong>
            </li>
        </ol>
    </div>

    <div class="col-lg-6" style="padding-top: 30px;">

        <div class="btn-toolbar pull-right">
            @if (is_active("admin.user-type.index") || is_active("admin.user-type.show") || is_active("admin.user-type.edit"))
                <a href="{{ route('admin.user-type.create', $role->id) }}" class="btn btn-sm btn-success pull-right m-t-n-xs mr-3">
                    <i class="fa fa-plus"></i><strong> Create</strong>
                </a>
            @endif

            @if (is_active("admin.user-type.create") || is_active("admin.user-type.show") || is_active("admin.user-type.edit"))
                <a href="{{ route('admin.user-type.index', $role->id) }}" class="btn btn-sm btn-success pull-right m-t-n-xs mr-3"><i
                        class="fa fa-list"></i><strong> List</strong></a>
            @endif

            @if (is_active("admin.user-type.show"))
                <a href="{{ route('admin.user-type.edit', [ 'role' => $role->id, 'user' => $id, ]) }}" class="btn btn-sm btn-success pull-right m-t-n-xs mr-3"><i
                        class="fa fa-edit"></i><strong> Edit </strong></a>
            @endif

            @if (is_active("admin.user-type.edit"))
                <a href="{{ route('admin.user-type.show', [ 'role' => $role->id, 'user' => $id, ]) }}" class="btn btn-sm btn-success pull-right m-t-n-xs mr-3"><i
                        class="fa fa-eye"></i><strong> View </strong></a>
            @endif
        </div>

    </div>

</div>

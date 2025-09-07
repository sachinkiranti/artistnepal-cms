<div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle">Action</button>
    <ul class="dropdown-menu">
        @can("admin.{$model}.edit")
            <li>
                <a href="{{ route("admin.{$model}.edit", $data->id) }}" class=" dropdown-item" title="Edit"><i class="fa fa-edit"></i> Edit </a>
            </li>
        @endcan
        @can("admin.{$model}.show")
            <li>
                <a href="{{ route("admin.{$model}.show", $data->id) }}" class=" dropdown-item" title="Show"> <i class="fa fa-eye"></i> Show</a>
            </li>
        @endcan
        @can("admin.{$model}.destroy")
            <li>
                <a href="javascript:void(0);" id="delete" title="Delete" class="confirm-delete-row bulk_list dropdown-item">
                    <i class="fa fa-trash "></i> Delete</a>
                {!! Form::open(['url' => route("admin.{$model}.destroy", $data->id), 'method' => 'delete', ]) !!}
                {!! Form::close() !!}
            </li>
        @endcan
        <li class="dropdown-divider"></li>
        @can("admin.{$model}.force-delete")
            <li>
                <a class="dropdown-item confirm-delete-row" id="force-delete" title="Force Delete" href="javascript:void(0);"><i class="fa fa-trash-o "></i> Force delete</a>
                {!! Form::open(['url' => route("admin.{$model}.force-delete", $data->id), 'method' => 'delete']) !!}
                {!! Form::close() !!}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                {!! Form::close() !!}
            </li>
        @endcan
        @can("admin.{$model}.restore")
            @if(isset($data->deleted_at) && $data->deleted_at != null)
            <li>
                <a class="dropdown-item confirm-delete-row" id="restore" title="Restore" href="javascript:void(0);"><i class="fa fa-refresh"></i> Restore</a>
                {!! Form::open(['url' => route("admin.{$model}.restore", $data->id), 'method' => 'delete']) !!}
                {!! Form::close() !!}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                {!! Form::close() !!}
            </li>
            @endif
        @endcan
    </ul>
</div>




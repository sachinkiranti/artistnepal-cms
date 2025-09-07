<a href="javascript:void(0);" title="Delete" class="btn btn-xs btn-danger confirm-delete-row bulk_list"><i
        class="fa fa-trash"></i></a>
{!! Form::open(['url' => route($route, $id), 'method' => 'delete', 'id'=>'formSubmit' ]) !!}
{!! Form::close() !!}

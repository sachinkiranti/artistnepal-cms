<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables-list" >
        <thead>
        <tr>
            <th id="parent" class="no-sort">
                @include('admin.common.bulk-action',[ 'model' => 'users', ])
            </th>
            <th>Full Name</th>
            <th>Roles</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tfoot>
    </table>
</div>

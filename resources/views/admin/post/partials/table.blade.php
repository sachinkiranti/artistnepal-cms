<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables-list" >
        <thead>
        <tr>
            <th id="parent" class="no-sort">
                @include('admin.common.bulk-action',[ 'model' => 'posts', ])
            </th>
            <th>Category</th>
            <th>Title</th>
            <th>Author</th>
            <th>Date</th>
            <th>Status</th>
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
            <th></th>
        </tfoot>
    </table>
</div>

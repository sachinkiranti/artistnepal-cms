<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables-list" >
        <thead>
        <tr>
            <th id="parent" class="no-sort">
                @include('admin.common.bulk-action',[ 'model' => 'faqs', ])
            </th>
            <th>Title</th>
            <th>Body</th>
            <th>Created At</th>
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
        </tfoot>
    </table>
</div>

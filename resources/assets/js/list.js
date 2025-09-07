$(document).ready(function () {
    var $document =  $(document);

    dataTable = $('.dataTables-list').DataTable({
        pageLength: DataTableOptions.defaultPagination,
        // responsive: true,
        processing: DataTableOptions.hasOwnProperty('processing') ? DataTableOptions.processing : true,
        serverSide: DataTableOptions.hasOwnProperty('serverSide') ? DataTableOptions.serverSide : true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {
                extend: 'colvis',
                text: 'Column visibility <i class="fa fa-eye-slash"></i>',
                    columns: ':not(:first-child):not(:last-child)'
            },
            {
                extend: 'copy',
                text: 'Copy <i class="fa fa-files-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported):not(:first-child):not(:last-child)',
                    rows: ':visible',
                },
            },
            {
                extend: 'csv',
                text: 'CSV <i class="fa fa-file-text-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported):not(:first-child):not(:last-child)',
                    rows: ':visible',
                },
            },
            {
                extend: 'excel',
                text: 'Excel <i class="fa fa-file-excel-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported):not(:first-child):not(:last-child)',
                    rows: ':visible',
                },
            },
            {
                extend: 'pdf',
                text: 'PDF <i class="fa fa-file-pdf-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported):not(:first-child):not(:last-child)',
                    rows: ':visible',
                },
            },

            {
                extend: 'print',
                text: 'Print <i class="fa fa-print" aria-hidden="true"></i>',

                exportOptions: {
                    columns: ':visible:Not(.not-exported):not(:first-child):not(:last-child)',
                    rows: ':visible',
                },

                customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                },

            },

            {
                extend: 'collection',
                text: 'Bulk Actions <i class="fa fa-cogs"></i>',
                className: 'buttons-delete',
                buttons: [
                    {
                        text: '<i class="fa fa-trash-o"></i> Delete',
                        className: 'buttons-delete',
                        action: function (e, dt, node, config) {
                            BulkActionManager.init(
                                router.get('admin.actions.delete').replace('{model}', $('#parent-checkbox').data('model')),
                                'delete'
                            );
                        }
                    },
                    {
                        text: '<i class="fa fa-circle-o" style="color:#0068ca;"></i> Active',
                        className: 'buttons-delete',
                        action: function (e, dt, node, config) {
                            BulkActionManager.init(
                                router.get('admin.actions.active').replace('{model}', $('#parent-checkbox').data('model')),
                                'active'
                            );
                        }
                    },
                    {
                        text: '<i class="fa fa-circle-o" style="color:#e40000;"></i> In Active',
                        className: 'buttons-delete',
                        action: function (e, dt, node, config) {
                            BulkActionManager.init(
                                router.get('admin.actions.inactive').replace('{model}', $('#parent-checkbox').data('model')),
                                'inactive'
                            );
                        }
                    },
                ],
                fade: true
            }
        ],
        initComplete: DataTableOptions.filters,
        ajax: DataTableOptions.ajax,
        columns: DataTableOptions.columns,
        order: DataTableOptions.order,
        columnDefs: DataTableOptions.columnDefs
    });

    $('#filter-btn').on('click', function (e) {
        e.preventDefault();
        dataTable.draw();
    });

    $("#reset-btn").on('click', function(e) {
        $('#filter-form')[0].reset();
        e.preventDefault();
        $('#filter-btn').click();
    });

    var BulkActionManager = {
        init : function (url, action) {
            var IDs = this.getIdsForBulkActions();
            var that = this;
            if (IDs.length === 0) {
                toastr.info('Please select one of the record.');
            } else {
                swal({
                        title: "Are you sure?",
                        text: "Are you sure that you want to "+ action +" this record?",
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        confirmButtonText: "Yes, "+ action +" it!",
                        confirmButtonColor: "#ec6c62"
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            that.submitActionForm(IDs, url);
                        }
                    })
            }
        },

        /**
         * Submit action form
         *
         * @param IDs
         * @param url
         */
        submitActionForm: function (IDs, url) {
            var $form = $('#bulk-action-form');

            $('#ids').val(IDs, url);
            $form.attr("action", url);
            $form.submit();
        },

        /**
         * Return Ids for  bulk actions
         *
         * @returns {[]}
         */
        getIdsForBulkActions: function () {
            var IDS = [];

            $.each($("input[name='single-checkbox']:checked"), function () {
                IDS = IDS + $(this).val() + ',';
            });

            return IDS;
        }
    };

    $document.on('click', '.confirm-delete-row',function (e) {
        var $this = $(this), id = $this.attr('id');
        swal({
            title: id === 'restore' ? 'Do you want to restore ?' : (id === 'force-delete' ? 'Do you want to force delete ?' : 'Do you want to delete ?'),
            text: id === 'restore' ? 'Your record will be restore':"You won't be able to revert this!",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: id === 'restore' ? 'yes restore it!' : (id === 'force-delete' ? 'yes force delete it!' : 'Yes, delete it!'),
            html: false
        }, function (isConfirm) {
            if (isConfirm) {
                $this.parents('li').find('form').submit();
            }
        })
    });

    /**
     * This is for check all table checkbox
     */
    $document.on('click', '#parent-checkbox', function (){
        $('.table input').not(this).prop('checked', $(this).is(':checked'));
    });

});

// document.addEventListener('turbolinks:before-cache', () => {
//     if (dataTable !== null) {
//         dataTable.destroy();
//         dataTable = null;
//     }
// });

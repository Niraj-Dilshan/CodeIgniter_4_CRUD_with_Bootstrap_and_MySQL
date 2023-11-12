<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.delete-button').click(function(){
                var delete_id = $(this).data('delete_id');
                $('#delete_id').val(delete_id);
            });

            // edit bank account record by id
            $('.edit').click(function(){
                var id = $(this).data('id');
                // get bank account record by id
                $.ajax({
                    url: '<?= site_url('/edit-bank-account') ?>',
                    method: 'post',
                    data: {id: id},
                    dataType: 'json',
                    success: function(response){
                        // setting the fetched data into input fields
                        $('#edit_id').val(response.id);
                        $('#edit_bank_name').val(response.bank_name);
                        $('#edit_branch').val(response.branch);
                        $('#edit_account_number').val(response.account_number);
                    }
                });
            });

            <?php if(session()->getFlashdata('success')):?>
            $('#successMessage').text('<?= session()->getFlashdata('success');?>');
            $('#successModal').modal('show');
            <?php endif;?>

            <?php if(session()->getFlashdata('error')):?>
            var errors = <?= json_encode(session()->getFlashdata('error')); ?>;
            $.each(errors, function(i, error) {
                $('#errorList').append('<li>' + error + '</li>');
            });
            $('#errorModal').modal('show');
            <?php endif;?>
        });
    </script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
            max-width:1540px
        }
        .table-responsive {
            margin: 30px 0;
        }
        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            min-width: 1000px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .table-title {
            padding-bottom: 15px;
            background: #0397d6;
            color: #fff;
            padding: 16px 30px;
            min-width: 100%;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
        .table-title .btn-group {
            float: right;
        }
        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }
        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }
        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }
        table.table tr th:first-child {
            width: 60px;
        }
        table.table tr th:last-child {
            width: 100px;
        }
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }
        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }
        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }
        table.table td a:hover {
            color: #2196F3;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #F44336;
        }
        table.table td i {
            font-size: 19px;
        }
        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }
        .modal .modal-header, .modal .modal-body, .modal .modal-footer {
            padding: 20px 30px;
        }
        .modal .modal-content {
            border-radius: 3px;
            font-size: 14px;
        }
        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }
        .modal .modal-title {
            display: inline-block;
        }
        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }
        .modal textarea.form-control {
            resize: vertical;
        }
        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }
        .modal form label {
            font-weight: normal;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage<b> Bank Accounts</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addBankAccountModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add Bank Account</span></a>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Bank Name</th>
                    <th>Branch</th>
                    <th>Account Number</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (isset($bankAccounts)) {
                    foreach($bankAccounts as $bankAccount) { ?>
                        <tr>
                            <td><?= esc($bankAccount['bank_name']) ?></td>
                            <td><?= esc($bankAccount['branch']) ?></td>
                            <td><?= esc($bankAccount['account_number']) ?></td>
                            <td>
                                <a href="#editBankAccountModal" data-id="<?=$bankAccount['id']?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit"></i></a>
                                <a href="#deleteBankAccountModal" data-delete_id="<?=$bankAccount['id']?>"  class="delete delete-button" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
                            </td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Add Modal HTML -->
<div id="addBankAccountModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method ="post" action="<?= site_url('/add-bank-account') ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Add Bank Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Bank Name</label>
                        <input type="text" name ="bank_name" id = "bank_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Branch</label>
                        <input type="text" name ="branch" id = "branch" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Account Number</label>
                        <input type="number" name ="account_number" id ="account_number" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal HTML -->
<div id="editBankAccountModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method ="post" action="<?= site_url('/update-bank-account') ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Update Bank Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Bank Name</label>
                        <input type="text" name ="bank_name" id = "edit_bank_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Branch</label>
                        <input type="text" name ="branch" id = "edit_branch" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Account Number</label>
                        <input type="number" name ="account_number" id ="edit_account_number" class="form-control" required>
                        <input type="hidden" name ="id" id = "edit_id" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal HTML -->
<div id="deleteBankAccountModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method ="post" action="<?= site_url('/delete-bank-account') ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Bank Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this bank account?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                    <input type="hidden" id="delete_id" name="delete_id">
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="successMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div id="errorModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="errorList"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>



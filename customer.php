<?php
include 'includes/connect.php';
include 'includes/header.php';
include 'includes/top-left-nav.php';
?>


<span style="float:right">

    <a href="javascript:void(0)" data-toggle="modal" data-target="#add-new-event" class="btn btn-primary">
        <i class="fas fa-user-plus"></i> Add Customer
    </a>

</span><br><br>


<!-- Modal Adding customers-->
<div class="modal fade none-border" id="add-new-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Record A new</strong> customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <form action="./includes/store-customer.php" method="POST">
                <div class=" container-fluid">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">


                                <label for="">Customer <span class="text-danger">*</span></label>
                                <input id="" name="fullname" type="text" class="form-control" required>

                                <label for="">Phone <span class="text-danger">*</span></label>
                                <input id="" name="phone" type="text" class="form-control" required>

                                <label for=""> Email<span class="text-danger">*</span></label>
                                <input id="" name="email" type="text" class="form-control" required>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save" class="btn btn-secondary">Save</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL -->


<div class="card">
    <div class="card-body">
        <h5 class="card-title">CUSTOMERS </h5>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>

                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Email</th>


                        <th>Actions</th>
                    </tr>
                </thead>

                <?php
                $my_data = "SELECT * FROM customers WHERE deleted_at IS NOT NULL ORDER BY id DESC";
                $parkresult = mysqli_query($conn,$my_data);
                if (!$parkresult) {
                    die("Query Failed: " . mysqli_error($conn));
                }
                $i = 0;
                    while ($lots = mysqli_fetch_assoc($parkresult)) {
                        $i++;
                ?>
                    <tr>
                        <td><?= $i ?> </td>


                        <td><?= $lots['fullname'] ?> </td>
                        <td><?= $lots['phone'] ?> </td>
                        <td><?= $lots['email'] ?> </td>

                        <td>
                            <a href="#" data-toggle="modal" data-target="#edit<?= $lots['id'] ?>" class="btn btn-primary"><i class="fas fa-pencil-square-o"></i> Edit</a>
                            <a href="#" data-toggle="modal" data-target="#delete<?= $lots['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    
                    <!-- BEGIN DELETE MODAL -->

                    <div class="modal fade none-border" id="delete<?= $lots['id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">DELETE CUSTOMER: <?= $lots['fullname'] ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form action="./includes/delete-customer.php" method="POST">
                                    <div class="modal-body">
                                        <p style="color: red;" > <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>                                            IF you click <b>YES</b>,the information of <?= $lots['fullname'] ?> Won't appear again</p>

                                        <input id="" name="fullname" value="<?= $lots['id'] ?>" type="hidden" class="form-control" required>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="delete" class="btn btn-danger ">Yes</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- -----edit--- -->


                    <div class="modal fade none-border" id="edit<?= $lots['id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit <?= $lots['fullname'] ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>

                                <form action="includes/edit-customer.php" method="POST">
                                    <div class=" container-fluid">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="">Customer <span class="text-danger">*</span></label>
                                                    <input id="" name="fullname" value="<?= $lots['fullname'] ?>" type="text" class="form-control" required>
                                                    <input id="" name="updatecustomer" value="<?= $lots['id'] ?>" type="hidden" class="form-control" required>

                                                    <label for="">Phone <span class="text-danger">*</span></label>
                                                    <input id="" name="phone" value="<?= $lots['phone'] ?>" type="text" class="form-control" required>
                                                    <input id="" name="updatecustomer" value="<?= $lots['id'] ?>" type="hidden" class="form-control" required>


                                                    <label for="">email<span class="text-danger">*</span></label>
                                                    <input id="" name="email" value="<?= $lots['email'] ?>" type="text" class="required form-control" required>
                                                    <input id="" name="updatecustomer" value="<?= $lots['id'] ?>" type="hidden" class="form-control" required>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="update" class="btn btn-secondary">Save</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                


                    <!-- ,,...............end........./. -->
                <?php    } ?>
            </table>


        </div>


    </div>

</div>

<?php include 'includes/footer.php' ?>
<?php
include 'includes/connect.php';
include 'includes/header.php';
include 'includes/top-left-nav.php';

?>

<span style="float:right">
    <a href="javascript:void(0)" data-toggle="modal" data-target="#add-new-event" class="btn btn-primary">
        <i class="fas fa-user"></i> New Staff Member
    </a>
</span><br><br>

<!-- Modal Adding staffs-->
<div class="modal fade none-border" id="add-new-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Record A new</strong> Staff Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form action="./includes/store-staffs.php" method="POST">
                <div class="container-fluid">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Staff Member <span class="text-danger">*</span></label>
                                <input name="name" type="text" class="form-control" required>
                                <label for="">Phone <span class="text-danger">*</span></label>
                                <input name="phone" type="text" class="form-control" required>
                                <label for="">Email <span class="text-danger">*</span></label>
                                <input name="email" type="text" class="form-control" required>
                                <label for="">Role <span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" required>
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
        <h5 class="card-title">STAFF MEMBERS</h5>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Staff Member</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $my_data = "SELECT * FROM staffs WHERE deleted_at IS NOT NULL ORDER BY id DESC";
                    $parkresult = mysqli_query($conn, $my_data);

                    if (!$parkresult) {
                        die("Query Failed: " . mysqli_error($conn));
                    }

                    $i = 0;
                    while ($lots = mysqli_fetch_assoc($parkresult)) {
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= htmlspecialchars($lots['name']) ?></td>
                            <td><?= htmlspecialchars($lots['phone']) ?></td>
                            <td><?= htmlspecialchars($lots['email']) ?></td>
                            <td><?= htmlspecialchars($lots['title']) ?></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#edit<?= $lots['id'] ?>" class="btn btn-primary"><i class="fas fa-pencil-square-o"></i> Edit</a>
                                <a href="#" data-toggle="modal" data-target="#delete<?= $lots['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>

                        <!-- DELETE MODAL -->
                        <div class="modal fade none-border" id="delete<?= $lots['id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">DELETE STAFF MEMBER: <?= htmlspecialchars($lots['name']) ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <form action="./includes/staffs.php" method="POST">
                                        <div class="modal-body">
                                            <p style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> If you click <b>YES</b>, Staff Member <?= htmlspecialchars($lots['name']) ?> won't appear again</p>
                                            <input name="id" value="<?= $lots['id'] ?>" type="hidden" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="delete" class="btn btn-danger">Yes</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END DELETE MODAL -->

                        <!-- EDIT MODAL -->
                        <div class="modal fade none-border" id="edit<?= $lots['id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit <?= htmlspecialchars($lots['name']) ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <form action="includes/edit-staffs.php" method="POST">
                                        <div class="container-fluid">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">Staff Member <span class="text-danger">*</span></label>
                                                        <input name="name" value="<?= htmlspecialchars($lots['name']) ?>" type="text" class="form-control" required>
                                                        <input name="updatestaffs" value="<?= $lots['id'] ?>" type="hidden" class="form-control" required>
                                                        <label for="">Phone <span class="text-danger">*</span></label>
                                                        <input name="phone" value="<?= htmlspecialchars($lots['phone']) ?>" type="text" class="form-control" required>
                                                        <label for="">Email <span class="text-danger">*</span></label>
                                                        <input name="email" value="<?= htmlspecialchars($lots['email']) ?>" type="text" class="form-control" required>
                                                        <label for="">Role <span class="text-danger">*</span></label>
                                                        <input name="title" value="<?= htmlspecialchars($lots['title']) ?>" type="text" class="form-control" required>
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
                        <!-- END EDIT MODAL -->
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

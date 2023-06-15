<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">user</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">user List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="card m-b-30">

                <div class="card-body">
                    <div class="btn-group">
                        <div>
                            <a href="<?= base_url() ?>super_admin/add_user/" class="btn btn-info btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Company List">
                                <i class="fas fa-pencil"></i>Add user
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>email </th>
                                    <th>Phone Number</th>
                                    <th>Logo</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;

                                foreach ($this->aum->get_user() as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
										<td><?= $row->inst_name ?></td>								
                                        <td><?= $row->email ?></td>
                                        <td><?= $row->inst_contact ?></td>
                                        <td>

                                            <img style="width: 80px;" src="<?= base_url() ?>uploads/institute/<?= $row->inst_logo ?>">

                                        </td>
                                        <td class="project-actions text-right">

											<a class="btn btn-primary btn-sm" href="<?= base_url() ?>super_admin/user_details/<?= $row->inst_user_id  ?>">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="<?= base_url() ?>super_admin/edit_user/<?= $row->inst_user_id ?>">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Want to delete?');" href="<?= base_url() ?>super_admin/user_delete/<?= $row->inst_user_id ?>" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>

                                        </td>

                                    </tr>
                                    <!-- <?php include "modal/update_zonal_office.php" ?> -->
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- /.row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
</div>

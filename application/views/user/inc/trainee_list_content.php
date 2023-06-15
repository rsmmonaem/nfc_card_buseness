<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Trainee</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Trainee List</li>
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
                            <a href="<?= base_url() ?>institute_admin/add_trainee/" class="btn btn-info btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Company List">
                                <i class="fas fa-pencil"></i>Add Trainee
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
                                    <th>Image</th>
                                    <th>Trainee Name</th>
                                    <th>Mobile</th>
                                    <th>NID</th>
                                    <th>Date Of Birth</th>
                                    <th>Father's Name</th>
                                    <th>Mother's Name</th>
                                    <th>Gender</th>
                                    <th>Religion</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sl =1 ;
                                foreach($this->atm->get_trainee() as $row): ?>
                                    <tr>
                                        <td><?= $sl++ ?></td>
                                        <td><img style="width:55px; height:55px;" src="<?= base_url() ?>uploads/trainees/<?= $row->trainee_image ?>"> </td>
                                        <td><?= $row->trainee_name ?></td>
                                        <td><?= $row->trainee_phone ?></td>
                                        <td><?= $row->trainee_nid ?></td>
                                        <td><?= $row->trainee_dob ?></td>
                                        <td><?= $row->trainee_father_name ?></td>
                                        <td><?= $row->trainee_mother_name ?></td>
                                        <td><?= $row->trainee_gender ?></td>
                                        <td><?= $row->trainee_religion ?></td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="<?= base_url() ?>institute_admin/trainee_details/<?= $row->trainee_id  ?>">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="<?= base_url() ?>institute_admin/edit_trainee/<?= $row->trainee_id  ?>">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Want to delete?');" href="<?= base_url() ?>institute_admin/trainee_delete/<?= $row->trainee_id  ?>" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>

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

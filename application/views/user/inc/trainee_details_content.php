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
                        <li class="breadcrumb-item active">Trainee Details</li>
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
                            <a href="<?= base_url() ?>institute_admin/step_trainee/" class="btn btn-info btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Company List">
                                <i class="fas fa-pencil"></i>Add Trainee
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Trainee Details</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                </thead>
                                <tbody>
                                <tr>
                                    <td width="25%">Trainee Image</td>
                                    <td><img class="img-fluid w-25" src="<?= base_url() ?>uploads/trainees/<?= $data->trainee_image ?>"></td>
                                </tr>
                                <tr>
                                    <td width="25%">Trainee Name</td>
                                    <td><?= $data->trainee_name ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Trainee Name (English)</td>
                                    <td><?= $data->trainee_name_eng ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Father Name</td>
                                    <td><?= $data->trainee_father_name ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Father Name (English)</td>
                                    <td><?= $data->trainee_father_name_eng ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Mother Name</td>
                                    <td><?= $data->trainee_mother_name ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Mother Name (English)</td>
                                    <td><?= $data->trainee_mother_name_eng ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Date Of Birth</td>
                                    <td><?= $data->trainee_dob ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Current Age</td>
                                    <td><?= $data->trainee_current_age ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">NID Number</td>
                                    <td><?= $data->trainee_nid ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Gender</td>
                                    <td><?= $data->trainee_gender ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Religion</td>
                                    <td><?= $data->trainee_religion ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Phone Number</td>
                                    <td><?= $data->trainee_phone ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Religion</td>
                                    <td><?= $data->trainee_religion ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Alternate Phone Number</td>
                                    <td><?= $data->trainee_alternate_phone ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Educational Qualification (Year)</td>
                                    <td><?= $data->trainee_education ?></td>
                                </tr>

                                <tr>
                                    <td width="25%">Past Training Info (Optional)</td>
                                    <td><?= $data->trainee_past_training ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Name Of Youth Development Organization</td>
                                    <td><?= $data->trainee_youth_member ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Present Address</td>
                                    <td><?= $data->trainee_present_address ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Permanent Address</td>
                                    <td><?= $data->trainee_permanent_address ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Future Plan/Reason of taking This Training</td>
                                    <td><?= $data->trainee_training_reason ?></td>
                                </tr>
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

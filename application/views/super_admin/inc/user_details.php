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


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>User Details</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                </thead>
                                <tbody>
                                <tr>
                                    <td width="25%">User Image</td>
                                    <td><img class="img-fluid w-25" src="<?= base_url() ?>uploads/institute/<?= $data->inst_logo ?>"></td>
                                </tr>
                                <tr>
                                    <td width="25%">User Name</td>
                                    <td><?= $data->inst_name ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Future Plan/Reason of taking This Training</td>
                                    <td><?= $data->inst_contact ?></td>
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

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
                        <li class="breadcrumb-item active">Add Trainee</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="card m-b-30 m-t-30">

                <div class="card-body">
                    <div class="btn-group">
                        <div>
                            <a href="<?= base_url() ?>institute_admin/trainee_list/" class="btn btn-info btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Trainee List">
                                <i class="fas fa-pencil"></i>Trainee List
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Add Trainee</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="bs-stepper linear">
                                <div class="bs-stepper-header" role="tablist">

                                    <div class="step active" data-target="#logins-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger" aria-selected="true">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Please Enter NID/Birth ID Number</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" aria-selected="false" disabled="disabled">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Admission Form</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">

								<form action="<?= base_url() ?>institute_admin/nid_chack" method="post" enctype="multipart/form-data">
                                    <div id="logins-part" class="content active dstepper-block" role="tabpanel" aria-labelledby="logins-part-trigger">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">NID/Birth Registration Number</label>
                                            <input type="number" name="nid" class="form-control" id="exampleInputEmail1" placeholder="Enter NID/Birth Number" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Next</button>
                                    </div>
								</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
</div>

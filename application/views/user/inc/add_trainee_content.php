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
                            <a href="<?= base_url() ?>institute_admin_admin/department_list/" class="btn btn-info btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Company List">
                                <i class="fas fa-pencil"></i>Trainee List
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <form action="<?= base_url() ?>institute_admin_admin/add_trainee" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <h5 class="modal-title" id="exampleModalform">Add Trainee</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Trainee Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" name="trainee_name" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Trainee Name (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" name="trainee_name_eng" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Father Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" name="trainee_father_name" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Father Name (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" name="trainee_father_name_eng" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Mother Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" name="trainee_mother_name" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Mother Name (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" name="trainee_mother_name_eng" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dob">Date Of Birth <span class="text-danger">*</span></label>
                                                <input class="form-control col-md-12 col-xs-12" name="trainee_dob" id="dob" value="" placeholder="Birth Date" type="date" autocomplete="off" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Current Age <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" name="trainee_current_age" required="" placeholder="20 Years">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">NID Number <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="field-1" name="trainee_nid" required="">
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                                <select class="form-control col-md-12 col-xs-12" name="trainee_gender" id="gender" required="required">
                                                    <option value="">--Select--</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="religion">Religion </label>
                                                <select class="form-control col-md-12 col-xs-12" name="trainee_religion" id="add_religion">
                                                    <option value="">--Select--</option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Christian">Christian</option>
                                                    <option value="Buddha">Buddha</option>
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="phone">Phone Number<span class="text-danger">*</span></label>
                                                <input class="form-control col-md-12 col-xs-12" name="trainee_phone" id="number" required="required" type="number" autocomplete="off">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="phone">Alternate Phone Number<span class="text-danger">*</span></label>
                                                <input class="form-control col-md-12 col-xs-12" name="trainee_alternate_phone" id="number" required="required" type="number" autocomplete="off">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="phone">Educational Qualification (Year)<span class="text-danger">*</span></label>
                                                <input class="form-control col-md-12 col-xs-12" name="trainee_education" id="phone" value="" placeholder="Educational Qualification (Year)" required="required" type="text" autocomplete="off">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="phone">Past Training Info (Optional)</label>
                                                <input class="form-control col-md-12 col-xs-12" name="trainee_past_training" id="phone" value=""  type="text" autocomplete="off">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="phone">Name Of Youth Development Organization</label>
                                                <input class="form-control col-md-12 col-xs-12" name="trainee_youth_member" id="phone" value=""  type="text" autocomplete="off">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Trainee Image</label>
                                                <input type="file" class="form-control" id="field-6" name="trainee_image" required="">
                                            </div>
                                        </div>

										<div class="col-md-6 col-sm-3 col-xs-12">
                                            <div class="item form-group">
											<label for="health_condition">Kazi Username</label>
                                			<input class="form-control col-md-12 col-xs-12" value="<?= random_int(100000, 999999); ?>" name="kazi_username"  type="text" readonly="readonly">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
										
										<div class="col-md-6 col-sm-3 col-xs-12">
                                            <div class="item form-group">
											<label for="health_condition">Password</label>
                                			<input class="form-control col-md-12 col-xs-12"  value="<?= random_int(100000, 999999); ?>" name="kazi_password" type="text" readonly="readonly" >
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Present Address</label>
                                                <textarea name="trainee_present_address" id="" class="form-control" cols="10" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Permanent Address</label>
                                                <textarea name="trainee_permanent_address" id="" class="form-control" cols="10" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Future Plan/Reason of taking This Training</label>
                                                <textarea name="trainee_training_reason" id="" class="form-control" cols="5" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-raised btn-primary ml-2">ADD</button>
                                    <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <!-- /.row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
</div>

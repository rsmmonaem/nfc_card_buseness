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

                <form action="<?= base_url() ?>institute_admin/save_another_course" method="post" enctype="multipart/form-data">
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
                                                <input type="text" class="form-control" id="field-1" value="<?= $data->trainee_name ?>" readonly="readonly" name="trainee_name" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Trainee Name (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" value="<?= $data->trainee_name_eng ?>" readonly="readonly" name="trainee_name_eng" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Father Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" value="<?= $data->trainee_father_name ?>" name="trainee_father_name" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Father Name (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" value="<?= $data->trainee_father_name_eng ?>" name="trainee_father_name_eng" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Mother Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" value="<?= $data->trainee_mother_name ?>" name="trainee_mother_name" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Mother Name (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" value="<?= $data->trainee_mother_name_eng ?>" name="trainee_mother_name_eng" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dob">Date Of Birth <span class="text-danger">*</span></label>
                                                <input class="form-control col-md-12 col-xs-12" name="trainee_dob" id="dob" value="<?= $data->trainee_dob ?>" placeholder="Birth Date" type="date" autocomplete="off" required="required" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Current Age <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="field-1" value="<?= $data->trainee_current_age ?>" readonly="readonly"  name="trainee_current_age" required="" placeholder="20 Years">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">NID Number <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="field-1" value="<?= $data->trainee_nid ?>" readonly="readonly"  name="trainee_nid" required="">
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                                <select class="form-control col-md-12 col-xs-12" name="trainee_gender" id="gender" required="required" readonly="readonly">
                                                    <option value="">--Select--</option>
                                                    <option value="Male" <?php if ($data->trainee_gender == 'Male'){ echo 'selected';}?>>Male</option>
                                                    <option value="Female" <?php if ($data->trainee_gender == 'Female'){ echo 'selected';}?>>Female</option>
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="religion">Religion </label>
                                                <select class="form-control col-md-12 col-xs-12" name="trainee_religion" id="add_religion" readonly="readonly">
                                                    <option value=""  >--Select--</option>
                                                    <option value="Islam" <?php if ($data->trainee_religion == 'Islam'){ echo 'selected';}?> >Islam</option>
                                                    <option value="Hindu" <?php if ($data->trainee_religion == 'Hindu'){ echo 'selected';}?>>Hindu</option>
                                                    <option value="Christian" <?php if ($data->trainee_religion == 'Christian'){ echo 'selected';}?>>Christian</option>
                                                    <option value="Buddha" <?php if ($data->trainee_religion == 'Buddha'){ echo 'selected';}?>>Buddha</option>
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="phone">Phone Number<span class="text-danger">*</span></label>
                                                <input class="form-control col-md-12 col-xs-12" value="<?= $data->trainee_phone ?>" readonly="readonly"  name="trainee_phone" id="number" required="required" type="number" autocomplete="off">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="phone">Alternate Phone Number<span class="text-danger">*</span></label>
                                                <input class="form-control col-md-12 col-xs-12" value="<?= $data->trainee_alternate_phone ?>" readonly="readonly"  name="trainee_alternate_phone" id="number" required="required" type="number" autocomplete="off">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="phone">Educational Qualification (Year)<span class="text-danger">*</span></label>
                                                <input class="form-control col-md-12 col-xs-12" value="<?= $data->trainee_education ?>"  name="trainee_education" id="phone"  placeholder="Educational Qualification (Year)" required="required" type="text" autocomplete="off">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="phone">Past Training Info (Optional)</label>
                                                <input class="form-control col-md-12 col-xs-12" value="<?= $data->trainee_past_training ?>"  name="trainee_past_training" id="phone"  type="text" autocomplete="off">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="phone">New Course Name</label>
                                                <input class="form-control col-md-12 col-xs-12" value="<?= $data->trainee_course ?>"  name="trainee_course" id="phone"  type="text" autocomplete="off">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="phone">Name Of Youth Development Organization</label>
                                                <input class="form-control col-md-12 col-xs-12" value="<?= $data->trainee_youth_member ?>"  name="trainee_youth_member" id="phone"   type="text" autocomplete="off">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Trainee Image</label>
                                                <input type="hidden" name="old_image" value="<?= $data->trainee_image ?>">
                                                <img style="width:150px; height:150px;"  class="control-label" src="<?= base_url() ?>uploads/trainees/<?= $data->trainee_image ?>" alt="">
                                            </div>
                                        </div>

														<div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-6" class="control-label">Trainee Username</label>
                                                                <input class="form-control col-md-12 col-xs-12" value="<?= $data->trainee_username ?>" name="trainee_username"  type="text" readonly="readonly">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-6" class="control-label">Trainee Password</label>
                                                                <input class="form-control col-md-12 col-xs-12"  value="<?= $data->trainee_password ?>" name="trainee_password" type="text" readonly="readonly" >
                                                            </div>
                                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Present Address</label>
                                                <textarea name="trainee_present_address" id="" class="form-control" cols="10" rows="5" ><?= $data->trainee_present_address ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Permanent Address</label>
                                                <textarea name="trainee_permanent_address" id="" class="form-control" cols="10" rows="5" readonly="readonly"><?= $data->trainee_permanent_address ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Future Plan/Reason of taking This Training</label>
                                                <textarea name="trainee_training_reason" id="" class="form-control" cols="5" rows="5" ><?= $data->trainee_training_reason ?></textarea>
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

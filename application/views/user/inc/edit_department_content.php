<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Department</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Department</li>
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
                            <a href="<?= base_url() ?>super_admin/department_list/" class="btn btn-info btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Company List">
                                <i class="fas fa-pencil"></i>Department List
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <form action="<?= base_url('super_admin/update_department/'.$data->dept_id)?>" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <h5 class="modal-title" id="exampleModalform">Update Department</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Department Name</label>
                                                <input type="text" class="form-control" id="field-1" name="dept_name" value="<?= $data->dept_name ?>" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Department Code</label>
                                                <input type="text" class="form-control" id="field-1" name="dept_code" value="<?= $data->dept_code ?>" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Department Image</label>
                                                <input type="hidden" name="old_image" value="<?= $data->dept_image ?>">
                                                <input class="form-control" name="dept_image" id="photo" type="file">
                                                <div class="text-info" style="font-size: 9px;">Image file format: .jpg, .jpeg, .png or .gif</div>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Existing Photo</label><br>
                                                <img style="width:150px; height:150px;"  class="control-label" src="<?= base_url() ?>uploads/departments/<?= $data->dept_image ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Department Information</label>
                                                <textarea name="dept_info" id="" class="form-control" cols="20" rows="8"><?= $data->dept_info ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-raised btn-primary ml-2">UPDATE</button>
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

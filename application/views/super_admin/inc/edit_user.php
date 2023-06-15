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
                        <li class="breadcrumb-item active">Update user</li>
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
                            <a href="<?= base_url() ?>super_admin/user_list/" class="btn btn-info btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Company List">
                                <i class="fas fa-pencil"></i>user List
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <form action="<?php echo base_url()?>super_admin/update_user" method="post" enctype="multipart/form-data">
<input value="<?=$data->user_id?>" name="user_id"  type="hidden">
<input value="<?=$data->inst_user_id?>" type="hidden">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <h5 class="modal-title" id="exampleModalform">Update user</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">


                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">Full Name</label>
                                                <input type="text" class="form-control" value="<?=$data->inst_name?>" id="field-1" name="inst_name" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-2" class="control-label">E-mail</label>
                                                
                                                <input type="email" class="form-control" id="field-2"  value="<?=$data->email?>" name="email" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-3" class="control-label">Map Addres</label>
                                                <input type="text" class="form-control" id="field-3" value="<?=$data->map_address?>" name="map_address" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-4" class="control-label">user Phone Number</label>
                                                <input type="tel" class="form-control" id="field1" value="<?=$data->inst_contact?>" name="inst_contact" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-5" class="control-label">Facebook Url</label>
                                                <input type="text" class="form-control" id="division"  value="<?=$data->facebook?>" name="facebook" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-5" class="control-label">Instagram Url</label>
                                                <input type="text" class="form-control" id="division" value="<?=$data->instagram?>" name="instagram" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-5" class="control-label">linkedin Url</label>
                                                <input type="text" class="form-control" id="division" value="<?=$data->linkedin?>" name="linkedin" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-5" class="control-label">github Url</label>
                                                <input type="text" class="form-control" id="division" value="<?=$data->github?>" name="github" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-5" class="control-label">Facebook Page Url</label>
                                                <input type="text" class="form-control" id="division" value="<?=$data->facebook_page?>" name="facebook_page" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-5" class="control-label">Whatsapp Number</label>
                                                <input type="tel" class="form-control" id="division" value="<?=$data->whatsapp?>" name="whatsapp" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-5" class="control-label">About</label>
                                                <input type="text" class="form-control" id="division" value="<?=$data->bio?>" name="bio" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="field-5" class="control-label">Education Title</label>
                                                <input type="text" class="form-control" id="division" value="<?=$data->education?>" name="education" >
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="health_condition">user Username</label>
                                                <input class="form-control col-md-12 col-xs-12" value="<?=$data->user_name;  ?>" id="result" name="inst_username"  type="text" readonly="readonly">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="health_condition">user Password</label>
                                                <input class="form-control col-md-12 col-xs-12"  value="<?=$data->pass_word ; ?>" name="inst_password" type="text" >
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">user Logo</label>
                                                <input type="hidden" name="old_logo" value="<?= $data->inst_logo ?>">
                                                <input type="file" class="form-control" id="field-6" name="inst_logo" >
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="field-6" class="control-label">Existing user Logo</label>
                                                <img class="img-fluid" src="<?= base_url() ?>uploads/institute/<?= $data->inst_logo ?>">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-raised btn-primary ml-2">Update</button>
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

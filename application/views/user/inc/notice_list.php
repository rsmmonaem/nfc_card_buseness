<?php include "breadcrumb.php" ?>

<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">News</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Create News</li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div><!-- /.content-header -->

<section class="content">
	<div class="container-fluid">

<div class="card m-b-30">

</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php echo $this->session->flashdata('message'); ?>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Thumbnail </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($this->anm->get_notice() as $row) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row->not_title ?></td>
                                <td><?= $row->not_category  ?></td>
                                <td><?= $row->not_description  ?></td>
                                <td> 
                                   
                                     <img style="width: 80px;" src="<?= base_url() ?>uploads/notice/<?= $row->not_thumbnail ?>">   
                                     
                                </td>

                                <td><a onclick="return confirm('Want to delete?');" href="<?= base_url() ?>super_admin/notice_delete/<?= $row->not_id ?>" class="btn btn-secondary btn-block mt-0 tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <a class="btn btn-warning btn-block mt-0" data-toggle="" href="<?= base_url() ?>super_admin/edit_notice/<?= $row->not_id ?>"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                            </tr>
                            <!-- <?php include "modal/update_zonal_office.php" ?> -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

</div><!-- /.container-fluid -->
</section>

</div>






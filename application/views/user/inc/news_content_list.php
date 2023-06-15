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
								<li class="breadcrumb-item"><a href="">Home</a></li>
								<li class="breadcrumb-item active"> News List</li>
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
							<a href="<?= base_url() ?>super_admin/create_news/" class="btn btn-info btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Company List">
									<i class="fas fa-pencil"></i>Create News
								</a>
							</div>
						</div>
					</div>
				</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
		<?php echo $this->session->flashdata('message'); ?>
            <div class="card-body">
                
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>News Title</th>
                            <th>Category</th>
                            <th>Sub Categroy</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $sl =1 ;
                    	foreach($this->anm->get_news() as $row): ?>
                    		<tr>
	                			<td><?= $sl++ ?></td>
		                    	 <td><img style="width:55px; height:55px;" src="<?= base_url() ?>uploads/news/<?= $row->news_image ?>"> </td>
		                    	 <td><?= $row->news_title ?></td>
		                    	 <td><?= $row->news_category ?></td>
		                    	 <td><?= $row->news_sub_category ?></td>
		                    	 <td><?= $row->news_description ?></td>
		                    	 <td>
		                    	 	<a onclick="return confirm('Want to delete?');" href="<?= base_url() ?>super_admin/news_delete/<?= $row->news_id ?>" class="btn btn-secondary btn-block mt-0 tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                <i class="fas fa-times"></i>
                            </a>

		                            <a class="btn btn-warning btn-block mt-0" data-toggle="" href="<?= base_url() ?>super_admin/edit_news/<?= $row->news_id ?>"><i class="fas fa-pencil-alt"></i></a>
		                          </td>
                    		</tr>

                    	 

                    	 <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> 
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>

</div>


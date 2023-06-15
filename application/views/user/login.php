<?php

//include "inc/head_links.php";
include "inc/form_header_links.php";
?>

<div class="login-box">
	<!-- /.login-logo -->
	<div class="card card-outline card-primary">
		<div class="card-header text-center">
			<a href="" class="h1"><b>Admin</b>LTE</a>
		</div>
		<div class="card-body">
			<p class="login-box-msg">Sign in to start your session</p>

			<form action="<?= base_url() ?>login/login_process" method="post">
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="user_name" placeholder="Username">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" class="form-control" name="pass_word" placeholder="Password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-8">
						<div class="icheck-primary">
							<input type="checkbox" id="remember">
							<label for="remember">
								Remember Me
							</label>
						</div>
					</div>
					<!-- /.col -->
					<div class="col-4">
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					</div>
					<div class="form-group m-t-10 mb-0 row">
						<div class="col-sm-7 m-t-20">
							Login Details: <br>
							<b>Super Admin:</b> User: admin Password: admin
							<br>
							<b>Institute Admin:</b> user: int_admin password: 123
                            <b>Trainee Login:</b> user: 924987 password: 817549
						</div>
					</div>
					<!-- /.col -->
				</div>
			</form>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>assets/dist/js/adminlte.min.js"></script>
</body>
</html>

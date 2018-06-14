<?php 
session_start();
?>
		<link rel="stylesheet" href="vendor/bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.css">
		<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/core.css">

	<body class="img-cover" style="background-image: url(img/photos-1/2.jpg);">
		
		<div class="container-fluid">
			<div class="sign-form">
				<div class="row">
					<div class="col-md-4 offset-md-4 px-3">
						<div class="box b-a-0">
							<div class="logodiv">
								<img src="img/lrlogo.png">
							</div>
							<form action="login_db" method="post" class="form-material mb-1">
								<div class="form-group">
								<input type="email" name="email" class="form-control" value="" id="input-email" required="required" pattern="[a-zA-Z][\w\.-]*[a-zA-Z0-9]@([a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z])" placeholder="Email Address">
								</div>

								<div class="px-4 form-group mb-0">
									<button type="submit" name="forgot_password" value="Submit" class="btn btn-purple btn-block text-uppercase">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="vendor/jquery/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="vendor/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap4/js/bootstrap.min.js"></script>
	
<?php
if(isset($_POST['cus_add_network_type'])){
		$name = htmlentities(trim($_POST['name']));
		$location = htmlentities(trim($_POST['location']));
		$package_type = htmlentities(trim($_POST['package_type']));
		
		try{
		
		if(empty($name) || empty($location) || empty($package_type)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
    			    $stmt = $reg_user->runQuery("INSERT INTO network_type(Name,package_type,Location) VALUES('$name','$package_type','$location')");
                    $stmt->execute();
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New Network Type!</strong> Added Successfully.</div>";
            		header("Location: /add-network-type");
            		exit();
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}
include 'include/header.php';
?>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Create New Internet Pack</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/internet-pack-list">Internet Packages</a></li>
							<li class="breadcrumb-item active"><a href="#">Add Internet Pack</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Name" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>Location*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Location" name="location" value="<?php if(isset($_POST['location'])){ echo $_POST['location']; }else{ echo "Bangalore";} ?>" required>
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
									    <label><b>Package Type*</b></label>
									<select name="package_type" class="form-control" required>
									    <option value="">Select Package Type</option>
										<option <?php if(isset($_POST['package_type']) && $_POST['package_type']=='1'){ echo "selected"; } ?> value="1">Broadband</option>
										<option <?php if(isset($_POST['package_type']) && $_POST['package_type']=='2'){ echo "selected"; } ?> value="2">Cable</option>
                                	</select>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Add Network Type" name="cus_add_network_type">
									</div>
									</div>
						
							</form>
							</div>
						</div>
					</div>
				</div>
		<script type="text/javascript" src="vendor/jquery/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="vendor/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap4/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="vendor/detectmobilebrowser/detectmobilebrowser.js"></script>
		<script type="text/javascript" src="vendor/jscrollpane/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="vendor/jscrollpane/mwheelIntent.js"></script>
		<script type="text/javascript" src="vendor/jscrollpane/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" src="vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
		<script type="text/javascript" src="vendor/waves/waves.min.js"></script>
		<script type="text/javascript" src="vendor/switchery/dist/switchery.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
		<script type="text/javascript" src="vendor/autoNumeric/autoNumeric-min.js"></script>
		<script type="text/javascript" src="vendor/dropify/dist/js/dropify.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<script type="text/javascript" src="vendor/clockpicker/dist/jquery-clockpicker.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<!-- Neptune JS -->
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="js/forms-masks.js"></script>
		<script type="text/javascript" src="js/forms-upload.js"></script>
		<script type="text/javascript" src="js/forms-pickers.js"></script>
		</body>
		</html>
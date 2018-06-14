<?php
if(isset($_GET['id']) && !empty($_GET['id'])){
$usrid = $_GET['id'];
}else{
    header("Location: /cable-user-list");
}

if(isset($_POST['cus_update'])){
    try{
		$package_id = htmlentities(trim($_POST['package_id']));
		if(empty($package_id)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
    			    $stmt = $reg_user->runQuery("UPDATE user_has_cable SET package_id='".$package_id."' WHERE user_id='$usrid'");
                    $stmt->execute();
                    
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>User Cable Plan!</strong> Updated Successfully.</div>";
            		header("Location: /edit-cable-user-list?id=".$usrid);
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
						<h4>Update User List Details</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="customer-list">User List</a></li>
							<li class="breadcrumb-item active"><a href="#">Edit User</a></li>
						</ol>
						<div class="box box-block bg-white">
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>
						    
							<form class="form-horizontal" method="post" name="edit_ad" action="#" enctype="multipart/form-data">
								<div class="row">
								<?php
                				$stmt_details = $reg_user->runQuery("SELECT * FROM user us INNER JOIN user_has_cable ub ON ub.user_id=us.id WHERE us.id='$usrid'");
                				$stmt_details->execute();
                				$row_details = $stmt_details->fetch(PDO::FETCH_ASSOC);
                				?>
									<div class="col-md-6">
									<div class="form-group">
										<label>User ID</label>
										<div class="input-group">
											<input type="text" class="form-control" value="<?php echo $row_details['user_id']; ?>" disabled>
										</div>
									</div>	
									<div class="form-group">
										<label>Name</label>
										<div class="input-group">
											<input type="text" class="form-control" value="<?php echo $row_details['full_name']; ?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label>Package Id</label>
										<select name="package_id" class="form-control" required>
        										<?php
                                        				$stmt = $reg_user->runQuery("SELECT *, ip.id as PackID,ip.name as PackName, nt.Name as Net_Name FROM cable_package ip INNER JOIN provider nt ON nt.id=ip.Provider_id");
                                        				$stmt->execute();
                                        				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                        				<option <?php if($row_details['package_id']==$stmt1->PackID){ echo "selected"; } ?> value="<?php echo $stmt1->PackID; ?>">
                                        				    <?php echo $stmt1->Net_Name." - ".$stmt1->PackName; ?></option>
                                        	    <?php } ?>
                                			</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update" name="cus_update">
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
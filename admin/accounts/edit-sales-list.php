<?php
if(isset($_GET['id'])){
$internet_pack_id=$_GET['id'];
}else{
    header("Location: /view-sales-list");
}


if(isset($_POST['cus_update_user'])){
		try{
		    
		$user_id = trim($_POST['user_id']);
		$full_name = htmlentities(trim($_POST['full_name']));
		$password = md5(trim($_POST['password']));
		$email = addslashes(trim($_POST['email']));
		$phone = htmlentities(trim($_POST['phone']));
		$country = htmlentities(trim($_POST['country']));
		$city = htmlentities(trim($_POST['city']));
		$state = htmlentities(trim($_POST['state']));
		$address_1 = htmlentities(trim($_POST['address_1']));
		$pincode = htmlentities(trim($_POST['pincode']));
		
		if(empty($user_id) || empty($full_name) || empty($email) || empty($phone) || empty($country) || empty($city) || empty($state) || empty($address_1)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
    			    $stmt = $reg_user->runQuery("UPDATE tbl_admin_customers SET user_id='$user_id',name='$full_name',email='$email',mobile='$phone',address='$address_1',city='$city',state='$state',country='$country',pincode='$pincode' WHERE id='$internet_pack_id'");
                    $stmt->execute();
                    
                    if(!empty($password)){
                        $stmt_pass = $reg_user->runQuery("UPDATE tbl_admin_customers SET password='$password' WHERE id='$internet_pack_id'");
                        $stmt_pass->execute();
                    }
                    
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>User Details!</strong> Updated Successfully.</div>";
            		header("Location: /edit-sales-list?id=".$internet_pack_id);
            		exit();
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}

include 'include/header.php';
$user_id = $_GET['id'];
$stmt_user = $reg_user->runQuery("SELECT * FROM tbl_admin_customers WHERE id='$user_id' ");
$stmt_user->execute();
$row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
?>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Update Admin User List Details</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="customer-list">User List</a></li>
							<li class="breadcrumb-item active"><a href="#">Edit User</a></li>
						</ol>
						<div class="box box-block bg-white">
						<div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label>User Name*</label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="User ID" name="user_id" value="<?php echo $row_user['user_id']; ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label>Full Name*</label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Full Name" name="full_name" value="<?php echo $row_user['name']; ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label>Password</label>
										<div class="input-group">
											<input type="password" class="form-control" placeholder="Password" name="password" value="">
										</div>
									</div>
		
									<div class="form-group">
									    <label>Address*</label>
									    <textarea name="address_1" rows="4" class="form-control" placeholder="Address" required><?php echo $row_user['address']; ?></textarea>
									</div>
									<div class="form-group">
									    <label>Country*</label>
										<select name="country" class="form-control" required>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM country");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if($row_user['country_id']==$stmt1->id){ echo "selected"; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label>Email*</label>
										<input type="text" placeholder="Email" name="email" class="form-control" value="<?php echo $row_user['email']; ?>" required>
									</div>
									<div class="form-group">
									    <label>Phone*</label>
										<input type="text" placeholder="Phone" name="phone" class="form-control" value="<?php echo $row_user['mobile']; ?>" required>
									</div>
									<div class="form-group">
									    <label>City*</label>
										<select name="city" class="form-control" required>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM city");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if($row_user['city_id']==$stmt1->id){ echo "selected"; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									
									<div class="form-group">
									    <label>State*</label>
										<select name="state" class="form-control" required>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM state");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if($row_user['state_id']==$stmt1->id){ echo "selected"; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									
									<div class="form-group">
									    <label>Pincode</label>
										<input type="text" maxlength="6" placeholder="Pincode" name="pincode" value="<?php echo $row_user['pincode']; ?>" class="form-control">
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update Sales User" name="cus_update_user">
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

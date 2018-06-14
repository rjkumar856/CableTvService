<?php
if(isset($_POST['cus_add_new_user'])){
		$full_name = htmlentities(trim($_POST['full_name']));
		$password = md5(trim($_POST['password']));
		$email = addslashes(trim($_POST['email']));
		$phone = htmlentities(trim($_POST['phone']));
		$country = htmlentities(trim($_POST['country']));
		$city = htmlentities(trim($_POST['city']));
		$state = htmlentities(trim($_POST['state']));
		$address_1 = htmlentities(trim($_POST['address_1']));
		$card_no = htmlentities(trim($_POST['card_no']));
		$pincode = htmlentities(trim($_POST['pincode']));
		$user_door_no = htmlentities(trim($_POST['user_door_no']));
		
		$cable_package = htmlentities(trim($_POST['cable_package']));
		$cable_due = htmlentities(trim($_POST['cable_due']));
		$smart_card_number = addslashes(trim($_POST['smart_card_number']));
		
		$smart_card_amount = addslashes(trim($_POST['smart_card_amount']));
		
		try{
		
		if(empty($password) || empty($full_name) || empty($email) || empty($phone) 
		|| empty($country) || empty($city) || empty($state) || empty($address_1) || empty($cable_package) || empty($cable_due) || empty($smart_card_number)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
		    
		    $stmt_check = $reg_user->runQuery("SELECT * FROM user_as_smartcard WHERE smart_card_no='$smart_card_number'");
            $stmt_check->execute();
            if($stmt_check->rowCount() == 0){
    			    $stmt = $reg_user->runQuery("INSERT INTO user(userid,full_name,password,email,phone,user_type,card_no,role_id,status) 
    			    VALUES('$user_id','$full_name','$password','$email','$phone','1','$card_no','1','1')");
                    $stmt->execute();
                    $new_user_id = $reg_user->lasdID();
                    
                    $stmt_addr = $reg_user->runQuery("INSERT INTO profile(user_id,door_no,address_1,address_2,zip_code,city_id,state_id,country_id,avatar,status) 
                    VALUES('$new_user_id','$user_door_no','$address_1','','$pincode','$city','$state','$country','','1')");
                    $stmt_addr->execute();
                            $stmt_addr = $reg_user->runQuery("INSERT INTO user_has_cable(user_id,package_id,total_amount,due_date,status) 
                            VALUES('$new_user_id','$cable_package','$smart_card_amount','$cable_due','1')");
                            $stmt_addr->execute();
                            
                            $stmt_addr = $reg_user->runQuery("INSERT INTO user_as_smartcard(user_id,smart_card_no,package_id1,cable_amount,status) 
                            VALUES('$new_user_id','$smart_card_number','$cable_package','$smart_card_amount','1')");
                            $stmt_addr->execute();
                    
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New User!</strong> Added Successfully.</div>";
            		header("Location: /create-new-cable-user");
            		exit();
            }else{
                $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> <b>Smart Card Number</b> Already Exist!</div>";
            }
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
						<h4>Create New User</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/customer-list">User List</a></li>
							<li class="breadcrumb-item active"><a href="#">Add User</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
									    <label><b>Smart Card Number*</b></label>
										<input type="text" placeholder="Smart Card Number" name="smart_card_number" value="<?php if(isset($_POST['smart_card_number'])){ echo $_POST['smart_card_number']; } ?>" class="form-control" required>
									</div>
									<div class="form-group">
										<label><b>Full Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Full Name" name="full_name" value="<?php if(isset($_POST['full_name'])){ echo $_POST['full_name']; } ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>Password*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Password" name="password" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>" required>
										</div>
									</div>
									<div class="form-group">
									    <label><b>Address*</b></label>
									    <textarea name="address_1" rows="4" class="form-control" placeholder="Address" required><?php if(isset($_POST['address_1'])){ echo $_POST['address_1']; } ?></textarea>
									</div>
									<div class="form-group">
										<label><b>Door No</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Door No" name="user_door_no" value="<?php if(isset($_POST['user_door_no'])){ echo $_POST['user_door_no']; } ?>">
										</div>
									</div>
									<div class="form-group">
									    <label><b>Country*</b></label>
										<select name="country" class="form-control" required>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM country");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if(isset($_POST['country']) && $_POST['country']==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
									    <label><b>Pincode</b></label>
										<input type="text" maxlength="6" placeholder="Pincode" name="pincode" value="<?php if(isset($_POST['pincode'])){ echo $_POST['pincode']; } ?>" class="form-control">
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
									    <label><b>Phone*</b></label>
										<input type="text" placeholder="Phone" name="phone" class="form-control" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; } ?>" required>
									</div>
									<div class="form-group">
										<label><b>Email*</b></label>
										<input type="text" placeholder="Email" name="email" class="form-control" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" required>
									</div>
									<div class="form-group">
									    <label><b>City*</b></label>
										<select name="city" class="form-control" required>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM city");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if(isset($_POST['city']) && $_POST['city']==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
									    <label><b>State*</b></label>
										<select name="state" class="form-control" required>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM state");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if(isset($_POST['state']) && $_POST['state']==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
									    <label><b>Active Cable Package*</b></label>
										<select name="cable_package" class="form-control" required>
										    <option value="">Select a Cable Package</option>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM cable_package");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if(isset($_POST['cable_package']) && $_POST['cable_package']==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
									    <label><b>Cable Due Date*</b></label>
										<input type="text" id="Cable-date-container" placeholder="Due Date" name="cable_due" value="<?php if(isset($_POST['cable_due'])){ echo $_POST['cable_due']; } ?>" class="form-control" required>
									</div>
									<div class="form-group">
									    <label><b>Card Number*</b></label>
										<input type="number" placeholder="Card Number" name="card_no" value="<?php if(isset($_POST['card_no'])){ echo $_POST['card_no']; } ?>" class="form-control" required>
									</div>
									<div class="form-group">
									    <label><b>Amount</b></label>
										<input type="text" placeholder="Amount" name="smart_card_amount" value="<?php if(isset($_POST['smart_card_amount'])){ echo $_POST['smart_card_amount']; } ?>" class="form-control">
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Add User" name="cus_add_new_user">
									</div>
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
		<script type="text/javascript">
		$('#Cable-date-container').datepicker({format: 'yyyy-mm-dd'});
		$('#Broadband-date-container').datepicker({format: 'yyyy-mm-dd'});
        </script>
		</body>
		</html>
<?php
$id=$_GET['id'];
$UserID = $_GET['id'];

if(isset($_POST['cus_update_user'])){
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
		$user_status = addslashes(trim($_POST['user_status']));
		
		try{
		    
		if(empty($password) || empty($full_name) || empty($email) || empty($phone) 
		|| empty($country) || empty($city) || empty($state) || empty($address_1) || empty($cable_package) || empty($cable_due) || empty($smart_card_number)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
    			    $stmt = $reg_user->runQuery("UPDATE user SET userid='$user_id',full_name='$full_name',email='$email',phone='$phone',card_no='$card_no',status='$user_status' WHERE id='$UserID'");
                    $stmt->execute();
                    
                    $stmt_addr = $reg_user->runQuery("UPDATE profile SET door_no='$user_door_no',address_1='$address_1',zip_code='$pincode',city_id='$city',state_id='$state',country_id='$country' WHERE user_id='$UserID'");
                    $stmt_addr->execute();
                    
                    if(!empty($password)){
                        $stmt_pass = $reg_user->runQuery("UPDATE user SET password='$password' WHERE id='$UserID'");
                        $stmt_pass->execute();
                    }
                            $stmt_addr = $reg_user->runQuery("UPDATE user_has_cable SET package_id='$cable_package',total_amount='$smart_card_amount',due_date='$cable_due' WHERE user_id='$UserID'");
                            $stmt_addr->execute();
                            
                            $stmt_addr = $reg_user->runQuery("UPDATE user_as_smartcard SET smart_card_no='$smart_card_number',package_id1='$cable_package',cable_amount='$smart_card_amount' WHERE user_id='$UserID'");
                            $stmt_addr->execute();
                    
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>User Details!</strong> Updated Successfully.</div>";
            		header("Location: /edit-cable-user-details?id=".$UserID);
            		exit();
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}

include 'include/header.php';
$stmt_user = $reg_user->runQuery("SELECT *,us.id as UserID,us.status as USStatus,ub.due_date as UBdue_date,uc.due_date as UCdue_date,ub.id as UBActive,uc.id as UCActive,ub.package_id as UBpackage_id,uc.package_id as UCpackage_id FROM user us INNER JOIN profile pr ON pr.user_id=us.id LEFT JOIN user_has_broadband ub ON ub.user_id=us.id LEFT JOIN user_has_cable uc ON uc.user_id=us.id LEFT JOIN user_as_smartcard uas ON uas.user_id=us.id WHERE us.id='$UserID'");
$stmt_user->execute();
$row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
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

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
									    <label><b>Smart Card Number</b></label>
										<input type="text" placeholder="Smart Card Number" name="smart_card_number" value="<?php echo $row_user['smart_card_no']; ?>" class="form-control">
									</div>
									<div class="form-group">
										<label><b>Full Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Full Name" name="full_name" value="<?php echo $row_user['full_name']; ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>Password</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Password" name="password">
										</div>
									</div>
									<div class="form-group">
									    <label><b>Address*</b></label>
									    <textarea name="address_1" rows="4" class="form-control" placeholder="Address" required><?php echo $row_user['address_1']; ?></textarea>
									</div>
									<div class="form-group">
										<label><b>Door No</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Door No" name="user_door_no" value="<?php echo $row_user['door_no']; ?>">
										</div>
									</div>
									<div class="form-group">
									    <label><b>Country*</b></label>
										<select name="country" class="form-control" required>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM country");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if($row_user['country_id'] == $stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
									    <label><b>Pincode</b></label>
										<input type="text" maxlength="6" placeholder="Pincode" name="pincode" value="<?php echo $row_user['zip_code']; ?>" class="form-control">
									</div>
									<div class="form-group">
									    <label><b>Status*</b></label>
										<select name="user_status" class="form-control">
										    <option <?php if($row_user['USStatus'] == '1'){ echo "selected"; } ?> value="1">Active</option>
										    <option <?php if($row_user['USStatus'] == '0'){ echo "selected"; } ?> value="0">Diable</option>
                                		</select>
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
									    <label><b>Phone*</b></label>
										<input type="text" placeholder="Phone" name="phone" class="form-control" value="<?php echo $row_user['phone']; ?>" required>
									</div>
									<div class="form-group">
										<label><b>Email*</b></label>
										<input type="text" placeholder="Email" name="email" class="form-control" value="<?php echo $row_user['email']; ?>" required>
									</div>
									<div class="form-group">
									    <label><b>City*</b></label>
										<select name="city" class="form-control" required>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM city");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if($row_user['city_id'] == $stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
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
                                				<option <?php if($row_user['state_id'] == $stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
									    <label><b>Active Cable Package</b></label>
										<select name="cable_package" class="form-control">
										    <option value="">Select a Cable Package</option>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM cable_package");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if($row_user['UCpackage_id'] == $stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
									    <label><b>Cable Due Date</b></label>
										<input type="text" id="Cable-date-container" placeholder="Due Date" name="cable_due" value="<?php echo $row_user['UCdue_date']; ?>" class="form-control">
									</div>
									<div class="form-group">
									    <label><b>Card Number</b></label>
										<input type="number" placeholder="Card Number" name="card_no" value="<?php echo $row_user['card_no']; ?>" class="form-control">
									</div>
									<div class="form-group">
									    <label><b>Amount</b></label>
										<input type="text" placeholder="Amount" name="smart_card_amount" value="<?php echo $row_user['total_amount']; ?>" class="form-control">
									</div>
								</div>
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update User" name="cus_update_user">
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
        </script>
        </body>
		</html>
<?php
if(isset($_GET['id'])){
$internet_pack_id=$_GET['id'];
}else{
    header("Location: /view-new-connection");
}

if(isset($_POST['cus_update_internet_pack'])){
		$name = htmlentities(trim($_POST['name']));
		$phone = htmlentities(trim($_POST['phone']));
		$city = htmlentities(trim($_POST['city']));
		$address = htmlentities(trim($_POST['address']));
		$request_status = htmlentities(trim($_POST['request_status']));
		$email = htmlentities(trim($_POST['email']));
		$service = htmlentities(trim($_POST['service']));
		$pincode = htmlentities(trim($_POST['pincode']));
		$message = htmlentities(trim($_POST['message']));
		$comments = htmlentities(trim($_POST['comments']));
		
		try{
		
		if(empty($name) || empty($phone) || empty($email) || empty($service) || empty($city) || empty($pincode) || empty($address) || empty($message)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
    			    $stmt = $reg_user->runQuery("UPDATE new_connection SET name='$name',email='$email',phone='$phone',service='$service',city='$city',pincode='$pincode',address='$address',message='$message',request_status='$request_status',comments='$comments' WHERE id='$internet_pack_id'");
                    $stmt->execute();
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New connection request!</strong> Updated Successfully.</div>";
            		header("Location: /edit-new-connetion-request?id=".$internet_pack_id);
            		exit();
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}
include 'include/header.php';

$stmt = $reg_user->runQuery("SELECT * FROM new_connection WHERE id='$internet_pack_id'");
$stmt->execute();
$internet_pack_details = $stmt->fetchObject();
?>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Edit New Connection Request</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/view-new-connection">View New Connection Request</a></li>
							<li class="breadcrumb-item active"><a href="#">Edit New Connection Request</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $internet_pack_details->name; ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Mobile*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Mobile" name="phone" value="<?php echo $internet_pack_details->phone; ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>City*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="City" name="city" value="<?php echo $internet_pack_details->city; ?>" required>
										</div>
									</div>	
									<div class="form-group">
									    <label><b>Address*</b></label>
										<textarea name="address" placeholder="Address" class="form-control" required><?php echo $internet_pack_details->address; ?></textarea>
									</div>
		
									<div class="form-group">
									    <label><b>Request Status*</b></label>
										<select name="request_status" class="form-control" required>
										    <option value="">Select Request Status</option>
										    <option <?php if($internet_pack_details->request_status=='Pending'){ echo "selected"; } ?> value="Pending">Pending</option>
										    <option <?php if($internet_pack_details->request_status=='On Progress<'){ echo "selected"; } ?> value="On Progress<">On Progress</option>
										    <option <?php if($internet_pack_details->request_status=='Completed'){ echo "selected"; } ?> value="Completed">Completed</option>
										    <option <?php if($internet_pack_details->request_status=='Rejected'){ echo "selected"; } ?> value="Rejected">Rejected</option>
										    <option <?php if($internet_pack_details->request_status=='On Hold'){ echo "selected"; } ?> value="On Hold">On Hold</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
									    <label><b>Email*</b></label>
									<input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $internet_pack_details->email; ?>" required>
									</div>
									<div class="form-group">
									    <label><b>Service*</b></label>
									<select name="service" class="form-control" required>
									    <option value="">Select a Service</option>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM package_type");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if($internet_pack_details->service==$stmt1->Name){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->Name; ?>"><?php echo $stmt1->Name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
									    <label><b>Pincode*</b></label>
										<input type="text" placeholder="Pincode" name="pincode" class="form-control" value="<?php echo $internet_pack_details->pincode; ?>" required>
									</div>
									<div class="form-group">
									    <label><b>Message*</b></label>
										<textarea name="message" placeholder="Message" class="form-control" required><?php echo $internet_pack_details->message; ?></textarea>
									</div>
									<div class="form-group">
									    <label><b>Comments</b></label>
										<textarea name="comments" placeholder="Comments" class="form-control"><?php echo $internet_pack_details->comments; ?></textarea>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update Request" name="cus_update_internet_pack">
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
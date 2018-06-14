<?php 
ob_start();
include 'class.user.php';  
$reg_user = new USER();
include("header.php");
if (isset($_POST['add_emp'])) 
{

	$stmt = $reg_user->runQuery("SELECT * FROM tbl_admin_customers WHERE id=:id");
	$stmt->execute(array(":id"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);


	$emp_fname = trim($_POST['emp_fname']);
	$emp_lname = trim($_POST['emp_lname']);
	$emp_email = trim($_POST['emp_email']);
	$emp_phone = trim($_POST['emp_phone']);
	$emp_dob = trim($_POST['emp_dob']);
	$emp_address1 = trim($_POST['emp_address1']);
	$emp_address2 = trim($_POST['emp_address2']);
	$emp_state = trim($_POST['emp_state']);
	$emp_city = trim($_POST['emp_city']);
	$emp_role = trim($_POST['emp_role']);
	$emp_pincode = trim($_POST['emp_pincode']);
	$emp_id = trim($_POST['emp_id']);
	$emp_designation = trim($_POST['emp_designation']);
	$emp_doj = trim($_POST['emp_doj']);
	$emp_accno = trim($_POST['emp_accno']);
	$emp_gender = trim($_POST['emp_gender']);
	$emp_department = trim($_POST['emp_department']);
	$emp_qualification = trim($_POST['emp_qualification']);
	$emp_marital = trim($_POST['emp_marital']);
	$emp_panno = trim($_POST['emp_panno']);
	
//Image Upload
	$emp_bannerimg=array();
    $i=0;
    $aa=date('dmyhms');
    foreach ($_FILES["emp_bannerimg"]["name"] as  $value) {
        $target_path = "uploads/bannerpic/" .$aa.$value;
        move_uploaded_file($_FILES['emp_bannerimg']['tmp_name'][$i], $target_path);
        array_push($emp_bannerimg, $aa.$value);
        $i++;
    }
    $emp_bannerimg1=implode($emp_bannerimg,",");

    $emp_profileimg=array();
    $i=0;
    $aa=date('dmyhmss');
    foreach ($_FILES["emp_profileimg"]["name"] as  $value1) {
        $target_path = "uploads/profilepic/" .$aa.$value1;
        move_uploaded_file($_FILES['emp_profileimg']['tmp_name'][$i], $target_path);
        array_push($emp_profileimg, $aa.$value1);
        $i++;
    }
    $emp_profileimg1=implode($emp_profileimg,",");
	//Image Upload 

	$emp_code = md5(uniqid(rand()));

	$user = new USER();
	
	if($user->addemp($emp_fname, $emp_lname, $emp_email, $emp_phone, $emp_dob, $emp_address1, $emp_address2,$emp_state, $emp_city, $emp_role,$emp_profileimg1,$emp_bannerimg1, $emp_pincode, $emp_id, $emp_designation, $emp_doj, $emp_accno,$emp_gender, $emp_department,$emp_qualification,$emp_marital,$emp_panno,$emp_code))
			{			
				$id = $user->lasdID();		
				$key = base64_encode($id);
				$id = $key;
				$message = "					
				Hello ".$emp_fname." ".$emp_lname.",
				<br /><br />
				Welcome to webliststore.in!<br/>
				
				
				Thanks,";

				$subject = "Added You As Our NEW EMPLOYEE";

				$reg_user->send_mail($emp_email,$message,$subject);	

				$_SESSION['empAdded'] = "<strong>Success!</strong>  We've sent an email to ".$emp_email.".
					Please click on the  link in the email to confirm.";

				$user->redirect('add-employee');

			}
			else
			{
				echo "sorry , Query could no execute...";
			} 




}

?>

		
<div class="site-content">
				<!-- Content -->
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Add New Employee</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="#">Employee</a></li>
							<li class="breadcrumb-item active">Add Employee</li>
						</ol>
						<div class="box box-block bg-white">
						<?php 
							if(isset($_SESSION['empAdded'])) 
							{ ?>
							<div class='alert alert-success' style="margin: 20px">
							<button class='close' data-dismiss='alert'>&times;</button>
							<?php echo $_SESSION['empAdded']; ?>
							</div>
							<?php 
							}
							?>
							 <br/>
							<form class="form-horizontal" method="post" action="#" enctype="multipart/form-data">
							<?php 
								$stmt = $reg_user->runQuery("SELECT * FROM tbl_admin_customers WHERE id=:id");
								$stmt->execute(array(":id"=>$_SESSION['userSession']));
								$row = $stmt->fetch(PDO::FETCH_ASSOC); 
								?>
								<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" placeholder="" name="emp_fname" class="form-control" required="required">
									</div>
									<div class="form-group">
										<label>Email Id</label>
										<input type="text" placeholder="" name="emp_email" class="form-control">
									</div>
									<div class="form-group">
										<label>Date Of Birth</label>
										<div class="input-group">
											<input type="text" class="form-control" name="emp_dob" id="datepicker-autoclose" placeholder="mm/dd/yyyy">
											<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
										</div>
									</div>
									<div class="form-group"><br/>
										<label>Gender </label>
										&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="Male" placeholder="" name="emp_gender" class="">&nbsp;&nbsp;Male
										&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="Female" placeholder="" name="emp_gender" class="">&nbsp;&nbsp;Female
									</div><br/>
									<div class="form-group">
										<label>Designation</label>
										<input type="text" placeholder="" name="emp_designation" class="form-control">
									</div>
									<div class="form-group">
										<label>Role</label>
										<select class="form-control" id="exampleSelect1" name="emp_role">
											<option>Management</option>
											<option>Super Admin</option>
											<option>Admin</option>	
											<option>Team Leader</option>
											<option>Sales</option>
											<option>Developer</option>		
										</select>
									</div>
									<div class="form-group">
										<label>Account Number</label>
										<input type="text" placeholder="" name="emp_accno" class="form-control">
									</div>
									<div class="form-group">
										<label>Address1</label>
										<input type="text" placeholder="" name="emp_address1" class="form-control">
									</div>
									<div class="form-group">
										<label>State</label>
										<select type="text" class="form-control" value="" placeholder="Seller State" name="emp_state" onChange="getCity(this.value);" required="required">
										<option value="">Select State</option>
										<?php
										$stmt = $reg_user->runQuery("SELECT * FROM tbl_states");
										$stmt->execute();
										for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
										{ ?> 
										<option value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
										<?php } ?>			
										</select>
									</div>
									<div class="form-group">
										<label>Pincode</label>
										<input type="text" placeholder="" name="emp_pincode" class="form-control">
									</div>
									
									
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" placeholder="" name="emp_lname" class="form-control">
									</div>
									<div class="form-group">
										<label>Phone</label>
										<input type="text" placeholder="" name="emp_phone" data-mask="(999) 999-9999" class="form-control">
									</div>
									<div class="form-group">
										<label>DOJ</label>
										<div class="input-group">
											<input type="text" class="form-control mydatepicker" name="emp_doj" id="datepicker-autoclose" placeholder="mm/dd/yyyy">
											<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
										</div>
									</div>
									<div class="form-group"><br/>
										<label>Marital Status</label>
										&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="Single" placeholder="" name="emp_marital" class="">&nbsp;&nbsp;Single
										&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="Married" placeholder="" name="emp_marital" class="">&nbsp;&nbsp;Married
									</div>
									<br/>
									<div class="form-group">
										<label>Department</label>
										<input type="text" placeholder="" name="emp_department" class="form-control">
									</div>
									<div class="form-group">
										<label>Qualification</label>
										<input type="text" placeholder="" name="emp_qualification" class="form-control">
									</div>
									<div class="form-group">
										<label>PAN Card Number</label>
										<input type="text" placeholder="" name="emp_panno" class="form-control">
									</div>
									<div class="form-group">
										<label>Address2</label>
										<input type="text" placeholder="" name="emp_address2" class="form-control">
									</div>
									<div class="form-group">
										<label>City</label>
										<select type="text" class="form-control" id="city" value="" placeholder="Seller City" name="emp_city" required="required">
										<option value="">Select City</option>
										</select>
										<script type="text/javascript">
										function getCity(val) {
										$.ajax({
										type: "POST",
										url: "city.php",
										data:'state_id='+val,
										success: function(data){
										$("#city").html(data);
										}
										});
										}
										</script>
									</div>
									<div class="form-group">
										<label>Employee ID</label>
										<input type="text" placeholder="" name="emp_id" class="form-control">
									</div>
									
									
									
									
								</div>
								</div>
								<div class="row">
								<div class="col-md-6">
									<label>Choose Your Banner Image</label>
									<input type="file" id="input-file-max-fs files" name="emp_bannerimg[]" class="dropify" data-max-file-size="2M" />
								</div>
								<div class="col-md-6">
									<label>Choose Your Profile Image</label>
									<input type="file" id="input-file-max-fs files" name="emp_profileimg[]" class="dropify" data-max-file-size="1M" />
								</div>
								</div><br/>
							<div class="row">
								<div class="pull-right">
							<input type="submit" class="btn btn-primary" value="Submit" name="add_emp">
							</div></div>
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


<?php 
$id = $_GET['id'];
if(isset($_POST['cus_update']))
{
		$cusFname = $_POST['cusFname'];
		$cusEmail = $_POST['cusEmail'];
		$role = $_POST['role'];
		
	

		$stmt = $reg_user->runQuery("UPDATE tbl_admin_customers SET cusFname='".$cusFname."',cusEmail='".$cusEmail."',role='".$role."' WHERE id=:id");
        $stmt->execute(array(":id"=>$id));
		$msg = "
		<div class='alert alert-success'>
			<button class='close' data-dismiss='alert'>&times;</button>
			<strong>Classified Ad !</strong> Updated Successfully.
		</div>
		";
}

include 'include/header.php';


?>
<style>
.edit-post-file{
    display: inline-block;
    position: absolute;
    width: 80px;
    padding: 4px;
    opacity: 0;
    z-index: 1;
	}
</style>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Update Customer Details</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="customer-list">Customer List</a></li>
							<li class="breadcrumb-item active"><a href="#">Edit Customer</a></li>
						</ol>
						<div class="box box-block bg-white">
							<form class="form-horizontal" method="post" name="edit_ad" action="#" enctype="multipart/form-data">
								<div class="row">
			<?php
				$stmt = $reg_user->runQuery("SELECT * FROM tbl_admin_customers WHERE id=:id ");
				$stmt->execute(array(":id"=>$id));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$image=explode(",", $row['apImages']);
			?>
									<div class="col-md-6">
									<div class="form-group">
										<label>Customer FName</label>
										<div class="input-group">
											<input type="text" class="form-control" value="<?php echo $row['cusFname']; ?>" name="cusFname">
										</div>
									</div>	
									<div class="form-group">
										<label>Customer Email</label>
										<input type="text" placeholder="" name="cusEmail" value="<?php echo $row['cusEmail']; ?>" class="form-control">
									</div>
									<div class="form-group">
										<label>Customer Role</label>&nbsp;&nbsp;<label><b><?php echo $row['role']; ?></b></label>
										<select type="text" class="form-control" value="" placeholder="Ad Plan" name="role" required="required">
										 <option value="<?php echo $row['role']; ?>" selected><?php echo $row['role']; ?></option>
										 <option value="admin">Admin</option>
										<option value="manager">Manager</option>
										<option value="sales">Sales</option>
										<option value="marketing">Marketing</option>
										<option value="developer">Developer</option>
										<option value="seo">SEO</option>
										<option value="others">Others</option>
										</select>
									</div>						
									
									
								</div>	<br/>
														
								<div class="row"><div class="col-md-6">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Submit" name="cus_update">
									</div></div>
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

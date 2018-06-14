<?php
if(isset($_GET['id'])){
$internet_pack_id=$_GET['id'];
}else{
    header("Location: /add-internet-pack");
}

if(isset($_POST['cus_update_internet_pack'])){
		$name = htmlentities(trim($_POST['name']));
		$serial_number = htmlentities(trim($_POST['serial_number']));
		$speed = htmlentities(trim($_POST['speed']));
		$after_fub = htmlentities(trim($_POST['after_fub']));
		$gst = htmlentities(trim($_POST['gst']));
		$validity = htmlentities(trim($_POST['validity']));
		$netword_type = htmlentities(trim($_POST['netword_type']));
		$data_transfer= htmlentities(trim($_POST['data_transfer']));
		$traiff = htmlentities(trim($_POST['traiff']));
		$total = htmlentities(trim($_POST['total']));
		
		try{
		
		if(empty($speed) || empty($after_fub) || empty($gst) || empty($validity) || empty($netword_type) || empty($data_transfer) || empty($traiff) || empty($total)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
    			    $stmt = $reg_user->runQuery("UPDATE internet_pack SET Network_id='$netword_type',Name='$name',Speed='$speed',Data_Transfer='$data_transfer',After_Fup='$after_fub',
    			    Traiff='$traiff',GST='$gst',Total='$total',Validity='$validity',serial_number='$serial_number' WHERE id='$internet_pack_id'");
                    $stmt->execute();
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>Internet Pack!</strong> Updated Successfully.</div>";
            		header("Location: /edit-internet-packages?id=".$internet_pack_id);
            		exit();
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}
include 'include/header.php';

$stmt = $reg_user->runQuery("SELECT * FROM internet_pack WHERE id='$internet_pack_id'");
$stmt->execute();
$internet_pack_details = $stmt->fetchObject();
?>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Edit Internet Pack</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/internet-pack-list">Internet Packages</a></li>
							<li class="breadcrumb-item active"><a href="#">Edit Internet Pack</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									  <div class="form-group">
										<label><b>Serial Number(Order)*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Serial Number" name="serial_number" value="<?php echo $internet_pack_details->serial_number; ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>Title</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $internet_pack_details->Name; ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Speed*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Speed" name="speed" value="<?php echo $internet_pack_details->Speed; ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>After FUB*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="After FUB" name="after_fub" value="<?php echo $internet_pack_details->After_Fup; ?>" required>
										</div>
									</div>	
									<div class="form-group">
									    <label><b>GST*</b></label>
										<input type="text" placeholder="GST" name="gst" class="form-control" value="<?php echo $internet_pack_details->GST; ?>" required>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
									    <label><b>Network Type*</b></label>
									<select name="netword_type" class="form-control" required>
									    <option value="">Select Netword Type</option>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM network_type");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if($internet_pack_details->Network_id==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->Name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
									    <label><b>Data Transfer*</b></label>
										<input type="text" placeholder="Data Transfer" name="data_transfer" class="form-control" value="<?php echo $internet_pack_details->Data_Transfer; ?>" required>
									</div>
									<div class="form-group">
									    <label><b>Traiff*</b></label>
										<input type="text" placeholder="Traiff" name="traiff" class="form-control" value="<?php echo $internet_pack_details->Traiff; ?>" required>
									</div>
									
									<div class="form-group">
									    <label><b>Total*</b></label>
										<input type="text" placeholder="Total" name="total" class="form-control" value="<?php echo $internet_pack_details->Total; ?>" required>
									</div>
									
									<div class="form-group">
									    <label><b>Validity*</b></label>
									    <select name="validity" class="form-control" required>
										    <option value="">Select Validity</option>
										    <option <?php if($internet_pack_details->Validity=='30 days'){ echo "selected"; } ?> value="30 days">30 days</option>
										    <option <?php if($internet_pack_details->Validity=='1 months'){ echo "selected"; } ?> value="1 months">1 month</option>
										    <option <?php if($internet_pack_details->Validity=='3 months'){ echo "selected"; } ?> value="3 months">3 months</option>
										    <option <?php if($internet_pack_details->Validity=='6 months'){ echo "selected"; } ?> value="6 months">6 months</option>
										    <option <?php if($internet_pack_details->Validity=='12 months'){ echo "selected"; } ?> value="12 months">12 months</option>
										    <option <?php if($internet_pack_details->Validity=='24 months'){ echo "selected"; } ?> value="24 months">24 months</option>
										</select>
									    </div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update Internet Pack" name="cus_update_internet_pack">
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
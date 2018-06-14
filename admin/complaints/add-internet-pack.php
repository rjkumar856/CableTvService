<?php
if(isset($_POST['cus_add_internet_pack'])){
		$name = htmlentities(trim($_POST['name']));
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
    			    $stmt = $reg_user->runQuery("INSERT INTO internet_pack(Network_id,Package_type_id,Name,Speed,Data_Transfer,After_Fup,Traiff,GST,Total,Validity,status) 
    			    VALUES('$netword_type','1','$name','$speed','$data_transfer','$after_fub','$traiff','$gst','$total','$validity','1')");
                    $stmt->execute();
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New Internet Pack!</strong> Added Successfully.</div>";
            		header("Location: /add-internet-pack");
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
										<label><b>Name</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Name" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Speed*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Speed" name="speed" value="<?php if(isset($_POST['speed'])){ echo $_POST['speed']; } ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>After FUB*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="After FUB" name="after_fub" value="<?php if(isset($_POST['after_fub'])){ echo $_POST['after_fub']; } ?>" required>
										</div>
									</div>	
									<div class="form-group">
									    <label><b>GST*</b></label>
										<input type="text" placeholder="GST" name="gst" class="form-control" value="<?php if(isset($_POST['gst'])){ echo $_POST['gst']; } ?>" required>
									</div>
		
									<div class="form-group">
									    <label><b>Validity*</b></label>
									    <select name="validity" class="form-control" required>
										    <option value="">Select Validity</option>
										    <option <?php if(isset($_POST['validity']) && $_POST['validity']=='1 months'){ echo "selected"; } ?> value="1 months">1 month</option>
										    <option <?php if(isset($_POST['validity']) && $_POST['validity']=='3 months'){ echo "selected"; } ?> value="3 months">3 months</option>
										    <option <?php if(isset($_POST['validity']) && $_POST['validity']=='6 months'){ echo "selected"; } ?> value="6 months">6 months</option>
										    <option <?php if(isset($_POST['validity']) && $_POST['validity']=='12 months'){ echo "selected"; } ?> value="12 months">12 months</option>
										    <option <?php if(isset($_POST['validity']) && $_POST['validity']=='24 months'){ echo "selected"; } ?> value="24 months">24 months</option>
										</select>
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
                                				<option <?php if(isset($_POST['netword_type']) && $_POST['netword_type']==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->Name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
									    <label><b>Data Transfer*</b></label>
										<input type="text" placeholder="Data Transfer" name="data_transfer" class="form-control" value="<?php if(isset($_POST['data_transfer'])){ echo $_POST['data_transfer']; } ?>" required>
									</div>
									<div class="form-group">
									    <label><b>Traiff*</b></label>
										<input type="text" placeholder="Traiff" name="traiff" class="form-control" value="<?php if(isset($_POST['traiff'])){ echo $_POST['traiff']; } ?>" required>
									</div>
									
									<div class="form-group">
									    <label><b>Total*</b></label>
										<input type="text" placeholder="Total" name="total" class="form-control" value="<?php if(isset($_POST['total'])){ echo $_POST['total']; } ?>" required>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Add Internet Pack" name="cus_add_internet_pack">
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
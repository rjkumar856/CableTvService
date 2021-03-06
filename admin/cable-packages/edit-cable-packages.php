<?php
$Package_id=$_GET['id'];

if(isset($_POST['cus_update_cable_pack'])){
		$name = htmlentities(trim($_POST['name']));
		$price = htmlentities(trim($_POST['price']));
		$provider = htmlentities(trim($_POST['provider']));
		$description = htmlentities(trim($_POST['description']));
		$validity = htmlentities(trim($_POST['validity']));
		$channels = $_POST['channels'];
		
		try{
		    
		if(empty($name) || empty($price) || empty($provider) || empty($validity) || empty($description) || empty($channels)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
		        $stmt = $reg_user->runQuery("UPDATE cable_package SET name='$name',Provider_id='$provider',price='$price',Validity='$validity',description='$description' WHERE id='$Package_id'");
                $stmt->execute();
                
                $new_channel_str=implode(", ", $channels);
                $stmt = $reg_user->runQuery("DELETE FROM channel_package WHERE cp_id='$Package_id' AND channel_id NOT IN ($new_channel_str)");
                $stmt->execute();
                
                foreach($channels as $value){
                    $stmt_check = $reg_user->runQuery("SELECT * FROM channel_package WHERE cp_id='$Package_id' AND channel_id='$value'");
                    $stmt_check->execute();
                    if($stmt_check->rowCount() == 0){
                            $stmt_addr = $reg_user->runQuery("INSERT INTO channel_package(cp_id,channel_id,status) 
                            VALUES('$Package_id','$value','1')");
                            $stmt_addr->execute();
                    }
                }
        		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>Cable Package!</strong> Updated Successfully.</div>";
        		header("Location: /edit-cable-packages?id=".$Package_id);
        		exit();
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}

$stmt_pack = $reg_user->runQuery("SELECT * FROM cable_package ca WHERE ca.id='$Package_id' LIMIT 1");
$stmt_pack->execute();
$pack_arr = $stmt_pack->fetchObject();

$pack_channel=array();
$stmt_channel = $reg_user->runQuery("SELECT channel_id FROM channel_package cp WHERE cp.cp_id='$Package_id'");
$stmt_channel->execute();
for($i = 0; $object = $stmt_channel->fetch(PDO::FETCH_ASSOC); $i++){
$pack_channel[]=$object['channel_id'];
}
include 'include/header.php';
?>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Edit Cable Package</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/all-packages">Cable Packages</a></li>
							<li class="breadcrumb-item active"><a href="#">Edit Cable Package</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <?php if($stmt_pack->rowCount()){ ?>
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $pack_arr->name; ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>Price*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Price" name="price" value="<?php echo $pack_arr->price; ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>Provider*</b></label>
										<select name="provider" class="form-control" required>
										    <option selected="true" disabled="true" value="">Select Provider</option>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM provider WHERE package_type='2'");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if($pack_arr->Provider_id==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
									    <label><b>Description</b></label>
									    <textarea name="description" rows="6" class="form-control textarea" placeholder="Description"><?php echo $pack_arr->description; ?></textarea>
									</div>
									<div class="form-group">
									    <label><b>Validity</b></label>
									<select name="validity" class="form-control" required>
										    <option value="">Select Validity</option>
										    <option <?php if($pack_arr->Validity=='30 days'){ echo "selected"; } ?> value="30 days">30 days</option>
										    <option <?php if($pack_arr->Validity=='1 months'){ echo "selected"; } ?> value="1 months">1 month</option>
										    <option <?php if($pack_arr->Validity=='3 months'){ echo "selected"; } ?> value="3 months">3 months</option>
										    <option <?php if($pack_arr->Validity=='6 months'){ echo "selected"; } ?> value="6 months">6 months</option>
										    <option <?php if($pack_arr->Validity=='12 months'){ echo "selected"; } ?> value="12 months">12 months</option>
										</select>
										</div>
								</div>
								
								<div class="col-xs-12">
								       <div class="form-group">
									    <label><b>Select Channels</b></label>
        									    <div class="channel-list">
        									        <?php
        									            $count=1;
                                        				$stmt = $reg_user->runQuery("SELECT * FROM channel ORDER BY channel_name ASC");
                                        				$stmt->execute();
                                        				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                        				<input type="checkbox" <?php if(in_array($stmt1->id,$pack_channel)){ echo "checked"; } ?> class="channels-box" name="channels[]" id="channels<?php echo $count; ?>" value="<?php echo $stmt1->id; ?>">
                                        				<label for="channels<?php echo $count; ?>" class="label-for-channel"><span><i class="fa fa-check" aria-hidden="true"></i></span> <?php echo $stmt1->channel_name; ?></label>
                                        	    <?php $count++; } ?>
        									    </div>
									    </div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update Cable Package" name="cus_update_cable_pack">
									</div>
									</div>
						
							</form>
							
							<?php }else{ ?>
							<div class="alert alert-danger">Cable Package not Available</div>
							<?php } ?>
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
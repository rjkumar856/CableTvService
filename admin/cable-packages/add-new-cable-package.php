<?php
if(isset($_POST['cus_add_new_cable'])){
		$name = htmlentities(trim($_POST['name']));
		$price = htmlentities(trim($_POST['price']));
		$provider = htmlentities(trim($_POST['provider']));
		$description = htmlentities(trim($_POST['description']));
		$validity = htmlentities(trim($_POST['validity']));
		$channels = $_POST['channels'];
		
		try{
		
		if(empty($name) || empty($price) || empty($validity) || empty($description) || empty($channels)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
			    
			    $stmt = $reg_user->runQuery("INSERT INTO cable_package(name,Package_type_id,Provider_id,price,Validity,status,description) VALUES('$name','2','$provider','$price','$validity','1','$description')");
                $stmt->execute();
                $new_user_id = $reg_user->lasdID();
                
                foreach($channels as $value){
                $stmt_addr = $reg_user->runQuery("INSERT INTO channel_package(cp_id,channel_id,status) 
                VALUES('$new_user_id','$value','1')");
                $stmt_addr->execute();
                }
        		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New Cable Package!</strong> Added Successfully.</div>";
        		header("Location: /add-new-cable-package");
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
						<h4>Add New Cable Package</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/all-packages">Cable Packages</a></li>
							<li class="breadcrumb-item active"><a href="#">Add New Cable Package</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Name" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>Price*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Price" name="price" value="<?php if(isset($_POST['price'])){ echo $_POST['price']; } ?>" required>
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
                                				<option <?php if(isset($_POST['provider']) && $_POST['provider']==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
									    <label><b>Description</b></label>
									    <textarea name="description" rows="6" class="form-control textarea" placeholder="Description"><?php if(isset($_POST['description'])){ echo $_POST['description']; } ?></textarea>
									</div>
									<div class="form-group">
									    <label><b>Validity</b></label>
									<select name="validity" class="form-control" required>
										    <option value="">Select Validity</option>
										    <option <?php if(isset($_POST['validity']) && $_POST['validity']=='30 days'){ echo "selected"; } ?> value="30 days">30 days</option>
										    <option <?php if(isset($_POST['validity']) && $_POST['validity']=='1 months'){ echo "selected"; } ?> value="1 months">1 month</option>
										    <option <?php if(isset($_POST['validity']) && $_POST['validity']=='3 months'){ echo "selected"; } ?> value="3 months">3 months</option>
										    <option <?php if(isset($_POST['validity']) && $_POST['validity']=='6 months'){ echo "selected"; } ?> value="6 months">6 months</option>
										    <option <?php if(isset($_POST['validity']) && $_POST['validity']=='12 months'){ echo "selected"; } ?> value="12 months">12 months</option>
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
                                        				<input type="checkbox" class="channels-box" name="channels[]" id="channels<?php echo $count; ?>" value="<?php echo $stmt1->id; ?>">
                                        				<label for="channels<?php echo $count; ?>" class="label-for-channel"><span><i class="fa fa-check" aria-hidden="true"></i></span> <?php echo $stmt1->channel_name; ?></label>
                                        	    <?php $count++; } ?>
        									    </div>
									    </div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Add Cable Package" name="cus_add_new_cable">
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
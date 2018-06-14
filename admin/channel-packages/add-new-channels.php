<?php
if(isset($_POST['cus_add_new_cable'])){
		$channel_name = htmlentities(trim($_POST['channel_name']));
		$genre = htmlentities(trim($_POST['genre']));
		$package = $_POST['package'];
		
		try{
		
		if(empty($channel_name) || empty($genre) || empty($_FILES['channel_image'])){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
		    $file_name='';
		    if(isset($_FILES['channel_image'])){
		        $target_dir = "../uploads/channels/";
		        $imageFileType = strtolower(pathinfo($_FILES['channel_image']["name"],PATHINFO_EXTENSION));
                $file_name = time().rand(1,999).".".$imageFileType;
		        move_uploaded_file($_FILES["channel_image"]["tmp_name"], $target_dir.$file_name);
		    }
			    
			    $stmt = $reg_user->runQuery("INSERT INTO channel(channel_name,channel_image,genre_id,status) VALUES('$channel_name','$file_name','$genre','1')");
                $stmt->execute();
                $new_user_id = $reg_user->lasdID();
                
                foreach($package as $value){
                $stmt_addr = $reg_user->runQuery("INSERT INTO channel_package(cp_id,channel_id,status) 
                VALUES('$value','$new_user_id','1')");
                $stmt_addr->execute();
                }
                
        		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New Channel!</strong> Added Successfully.</div>";
        		header("Location: /add-new-channels");
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
						<h4>Add New Channel</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/channel-packages-list">View Channel</a></li>
							<li class="breadcrumb-item active"><a href="#">Add New Channel</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Channel Name" name="channel_name" value="<?php if(isset($_POST['channel_name'])){ echo $_POST['channel_name']; } ?>" required>
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label><b>Genre*</b></label>
										<select name="genre" class="form-control" required>
										    <option selected="true" disabled="true" value="">Select Genre</option>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM genre");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if(isset($_POST['genre']) && $_POST['genre']==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
								</div>
								
								<div class="col-xs-12">
								       <div class="form-group">
									    <label><b>Select Packages</b></label>
        									    <div class="channel-list">
        									        <?php
        									            $count=1;
                                        				$stmt = $reg_user->runQuery("SELECT * FROM cable_package ORDER BY name ASC");
                                        				$stmt->execute();
                                        				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                        				<input type="checkbox" class="channels-box" name="package[]" id="channels<?php echo $count; ?>" value="<?php echo $stmt1->id; ?>">
                                        				<label for="channels<?php echo $count; ?>" class="label-for-channel"><span><i class="fa fa-check" aria-hidden="true"></i></span> 
                                        				<?php echo $stmt1->name; ?></label>
                                        	    <?php $count++; } ?>
        									    </div>
									    </div>
								</div>
								
								<div class="col-xs-12">
								       <div class="form-group">
									    <label><b>Images*</b></label>
        									    <div class="channel-list">
        									       <input type="file" class="form-control" placeholder="Channel Image" name="channel_image" value="<?php if(isset($_POST['channel_image'])){ echo $_POST['channel_image']; } ?>" required>
        									    </div>
									    </div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Add New Channel" name="cus_add_new_cable">
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
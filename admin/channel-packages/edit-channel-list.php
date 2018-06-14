<?php
if(isset($_GET['id'])){
$internet_pack_id=$_GET['id'];
}else{
    header("Location: /channel-packages-list");
}

if(isset($_POST['cus_update_channel'])){
		$channel_name = htmlentities(trim($_POST['channel_name']));
		$genre = htmlentities(trim($_POST['genre']));
		$package = $_POST['package'];
		
		try{
		
		if(empty($channel_name) || empty($genre)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
		    $file_name='';
		    if(isset($_FILES['channel_image']) && !empty($_FILES['channel_image'])){
		        
		        if($_FILES["channel_image"]["tmp_name"]){
		            $check = getimagesize($_FILES["channel_image"]["tmp_name"]);
                    if($check !== false){
        		        $target_dir = "../uploads/channels/";
        		        $imageFileType = strtolower(pathinfo($_FILES['channel_image']["name"],PATHINFO_EXTENSION));
                        $file_name = time().rand(1,999).".".$imageFileType;
        		        move_uploaded_file($_FILES["channel_image"]["tmp_name"], $target_dir.$file_name);
        		        
        		        $stmt = $reg_user->runQuery("UPDATE channel SET channel_image='$file_name' WHERE id='$internet_pack_id'");
                        $stmt->execute();
                    }
                }
		    }
			    
			    $stmt = $reg_user->runQuery("UPDATE channel SET channel_name='$channel_name',genre_id='$genre' WHERE id='$internet_pack_id'");
                $stmt->execute();
                
                $new_channel_str=implode(", ", $package);
                $stmt = $reg_user->runQuery("DELETE FROM channel_package WHERE channel_id='$internet_pack_id' AND cp_id NOT IN ($new_channel_str)");
                $stmt->execute();
                
                foreach($package as $value){
                    $stmt_check = $reg_user->runQuery("SELECT * FROM channel_package WHERE cp_id='$value' AND channel_id='$internet_pack_id'");
                    $stmt_check->execute();
                    if($stmt_check->rowCount() == 0){
                            $stmt_addr = $reg_user->runQuery("INSERT INTO channel_package(cp_id,channel_id,status) 
                            VALUES('$value','$internet_pack_id','1')");
                            $stmt_addr->execute();
                    }
                }
                
        		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>Channel List!</strong> Updated Successfully.</div>";
        		header("Location: /edit-channel-list?id=".$internet_pack_id);
        		exit();
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}

include 'include/header.php';

$pack_channel=array();
$stmt_channel = $reg_user->runQuery("SELECT cp_id FROM channel_package cp WHERE cp.channel_id='$internet_pack_id'");
$stmt_channel->execute();
for($i = 0; $object = $stmt_channel->fetch(PDO::FETCH_ASSOC); $i++){
$pack_channel[]=$object['cp_id'];
}

$stmt = $reg_user->runQuery("SELECT * FROM channel WHERE id='$internet_pack_id'");
$stmt->execute();
$internet_pack_details = $stmt->fetchObject();
?>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Edit Channel List</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/channel-packages-list">View Channel List</a></li>
							<li class="breadcrumb-item active"><a href="#">Edit Channel List</a></li>
						</ol>
						<div class="box box-block bg-white">
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Channel Name" name="channel_name" value="<?php echo $internet_pack_details->channel_name;  ?>" required>
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
                                				<option <?php if($internet_pack_details->genre_id==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name; ?></option>
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
                                        				<input type="checkbox" <?php if(in_array($stmt1->id,$pack_channel)){ echo "checked"; } ?> class="channels-box" name="package[]" id="channels<?php echo $count; ?>" value="<?php echo $stmt1->id; ?>">
                                        				<label for="channels<?php echo $count; ?>" class="label-for-channel"><span><i class="fa fa-check" aria-hidden="true"></i></span> <?php echo $stmt1->name; ?></label>
                                        	    <?php $count++; } ?>
        									    </div>
									    </div>
								</div>
								
								<div class="col-xs-12">
								    <div class="image-container">
								        <img src="https://www.worldvisioncable.in/uploads/channels/<?php echo $internet_pack_details->channel_image; ?>" alt="Channel Image" class="img-responsive" />
								    </div>
								    
								       <div class="form-group">
									    <label><b>Change Image</b></label>
        									    <div class="channel-list">
        									       <input type="file" class="form-control" placeholder="Channel Image" name="channel_image" >
        									    </div>
									    </div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update Channel" name="cus_update_channel">
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
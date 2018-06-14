<?php
$genre_id=$_GET['id'];

if(isset($_POST['cus_update_genre'])){
		$name = htmlentities(trim($_POST['name']));
		$priority = htmlentities(trim($_POST['priority']));
		$status = htmlentities(trim($_POST['status']));

		try{
		if(empty($name) || ($priority<=0 && $priority>=20)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
    			    $stmt = $reg_user->runQuery("UPDATE genre SET name='$name',status='$status',priority='$priority' WHERE id='$genre_id'");
                    $stmt->execute();
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>Genre!</strong> Updated Successfully.</div>";
            		header("Location: /edit-genre-details?id=".$genre_id);
            		exit();
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}
include 'include/header.php';

$stmt_genre = $reg_user->runQuery("SELECT * FROM genre WHERE id='$genre_id'");
$stmt_genre->execute();
$genre_details = $stmt_genre->fetchObject();
?>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Update Genre Details</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/customer-list">User List</a></li>
							<li class="breadcrumb-item active"><a href="#">Update Genre Details</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $genre_details->name; ?>" required>
										</div>
									</div>
									<div class="form-group">
									    <label><b>Status</b></label>
									<select name="status" class="form-control" required>
										    <option value="">Select Status</option>
										    <option <?php if($genre_details->status=='1'){ echo "selected"; } ?> value="1">Enable</option>
										    <option <?php if($genre_details->status=='0'){ echo "selected"; } ?> value="0">Disable</option>
										</select>
										</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label><b>Piority*</b></label>
										<input type="number" min="0" max="20" placeholder="Priority" name="priority" class="form-control" value="<?php echo $genre_details->priority; ?>" required>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update Genre" name="cus_update_genre">
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
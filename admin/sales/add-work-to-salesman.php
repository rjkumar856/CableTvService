<?php
if(isset($_POST['cus_add_new_user'])){
		$user_id = trim($_POST['user_id']);
		$amount = htmlentities(trim($_POST['amount']));
		$sales_id = htmlentities(trim($_POST['sales_id']));
		$date = htmlentities(trim($_POST['date']));
		
		try{
		
		if(empty($user_id) || empty($amount) || empty($sales_id) || empty($date)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
		 
    			    $stmt = $reg_user->runQuery("INSERT INTO sales_tickets(sales_id,user_id,amount,date,tickets_status) VALUES('$sales_id','$user_id','$amount','$date','Pending')");
                    $stmt->execute();
                    $new_user_id = $reg_user->lasdID();
                    
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New User!</strong> Added Successfully.</div>";
            		header("Location: /add-work-to-salesman");
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
						<h4>Add work to Salesman</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/view-sales-status-today">Sales List</a></li>
							<li class="breadcrumb-item active"><a href="#">Add work to Salesman</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label>Salesman*</label>
										<select name="sales_id" class="form-control" required>
										    <option value="">Select Salesman</option>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM tbl_admin_customers WHERE role='2' AND status='1'");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if(isset($_POST['sales_id']) && $_POST['sales_id']==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->name." (".$stmt1->id.")"; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
										<label>Amount*</label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Amount" name="amount" value="<?php if(isset($_POST['amount'])){ echo $_POST['amount']; } ?>" required>
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label>Smart Card Number*</label>
										<select name="user_id" class="form-control" required>
										    <option value="">Select Smart Card(Name)</option>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT *,us.id as UserID FROM user us INNER JOIN user_as_smartcard ua ON ua.user_id=us.id WHERE us.status='1' ORDER BY full_name ASC");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if(isset($_POST['user_id']) && $_POST['user_id']==$stmt1->UserID){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->UserID; ?>"><?php echo $stmt1->	smart_card_no." (".$stmt1->full_name.")"; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
									    <label>Date</label>
										<input type="text" id="sandbox-date-container" placeholder="Date" name="date" value="<?php if(isset($_POST['date'])){ echo $_POST['date']; } ?>" class="form-control">
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Add Work" name="cus_add_new_user">
									</div>
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
		<script type="text/javascript">
		$('#sandbox-date-container').datepicker({format: 'yyyy-mm-dd'});
        </script>
		</body>
		</html>
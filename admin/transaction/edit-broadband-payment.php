<?php
if(isset($_GET['id'])){
$internet_pack_id=$_GET['id'];
}else{
    header("Location: /broadband-transaction-list");
}

if(isset($_POST['cus_add_new_payment'])){
		$user_id = htmlentities(trim($_POST['user_id']));
		$payment_type = htmlentities(trim($_POST['payment_type']));
		$package_id = htmlentities(trim($_POST['package_id']));
		$due_date = htmlentities(trim($_POST['due_date']));
		$amount = htmlentities(trim($_POST['amount']));
		
		try{
		
		if(empty($user_id) || empty($payment_type) || empty($package_id) || empty($due_date)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
    			    $stmt = $reg_user->runQuery("UPDATE wvc_payment SET user_id='$user_id',Type='$payment_type',Package_id='$package_id',Amount='$amount',Due_date='$due_date' WHERE id='$internet_pack_id'");
                    $stmt->execute();
                    
                    $stmt = $reg_user->runQuery("UPDATE user_has_broadband SET due_date='$due_date' WHERE user_id='$user_id' AND due_date<'$due_date'");
                    $stmt->execute();
                   
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>Payment!</strong> Updated Successfully.</div>";
            		header("Location: /edit-broadband-payment?id=".$internet_pack_id);
            		exit();
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}
include 'include/header.php';
$stmt = $reg_user->runQuery("SELECT * FROM wvc_payment WHERE id='$internet_pack_id'");
$stmt->execute();
$internet_pack_details = $stmt->fetchObject();
?>
<script src="/js/angular.min.js"></script>
<div class="site-content" ng-app="WVCApp" ng-controller="WVCCtrl">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Edit Payment</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/view-all-transactions">View All Payments</a></li>
							<li class="breadcrumb-item active"><a href="#">Edit Payment</a></li>
						</ol>
						<div class="box box-block bg-white">
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>User ID*</b></label>
										<div class="input-group">
                                			<select name="user_id" class="form-control" required>
										    <option value="">Select Username</option>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT *,us.id as UserID FROM user_has_broadband ub INNER JOIN user us ON us.id=ub.user_id WHERE us.status='1' ORDER BY us.userid ASC");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if($internet_pack_details->user_id == $stmt1->UserID){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->UserID; ?>"><?php echo $stmt1->userid; ?></option>
                                	    <?php } ?>
                                			</select>
										</div>
									</div>
									<div class="form-group">
									    <label><b>Package Name*</b></label>
                                			<select name="package_id" class="form-control" required>
										    <option value="">Select Package Name</option>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT *,ip.id as PackID, ip.Name as PackName,nt.Name as NetworkName FROM internet_pack ip INNER JOIN network_type nt ON nt.id=ip.Network_id ORDER BY ip.Network_id ASC");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if($internet_pack_details->Package_id == $stmt1->PackID){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->PackID; ?>">
                                				    <?php $PackName=($stmt1->PackName)?$stmt1->PackName:$stmt1->Speed."-".$stmt1->Data_Transfer." @Rs.".$stmt1->Traiff; echo $stmt1->NetworkName."-".$PackName; ?></option>
                                	    <?php } ?>
                                			</select>
									</div>
									<div class="form-group">
										<label><b>Amount*</b></b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Amount" name="amount" value="<?php echo $internet_pack_details->Amount; ?>" required>
										</div>
									</div>	
									
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
									    <label><b>Payment Type*</b></label>
									<select name="payment_type" class="form-control" required>
										    <option value="">Select Payment Type</option>
										    <option <?php if($internet_pack_details->Type=='Online'){ echo "selected"; } ?> value="Online">Online</option>
										    <option <?php if($internet_pack_details->Type=='Cash'){ echo "selected"; } ?> value="Cash">Cash</option>
										    <option <?php if($internet_pack_details->Type=='Card'){ echo "selected"; } ?> value="Cash">Card</option>
										</select>
									</div>
									<div class="form-group">
									    <label><b>Due Date*</b></label>
										<input type="text" id="sandbox-date-container" placeholder="Due Date" name="due_date" value="<?php echo $internet_pack_details->Due_date; ?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update Payment" name="cus_add_new_payment">
									</div>
								</div>
							</div>
							</form>
							</div>
						</div>
					</div>
				</div>
		<script type="text/javascript" src="/vendor/jquery/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="/vendor/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="/vendor/bootstrap4/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/vendor/detectmobilebrowser/detectmobilebrowser.js"></script>
		<script type="text/javascript" src="/vendor/jscrollpane/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="/vendor/jscrollpane/mwheelIntent.js"></script>
		<script type="text/javascript" src="/vendor/jscrollpane/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" src="/vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
		<script type="text/javascript" src="/vendor/waves/waves.min.js"></script>
		<script type="text/javascript" src="/vendor/switchery/dist/switchery.min.js"></script>
		<script type="text/javascript" src="/vendor/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
		<script type="text/javascript" src="/vendor/autoNumeric/autoNumeric-min.js"></script>
		<script type="text/javascript" src="/vendor/dropify/dist/js/dropify.min.js"></script>
		<script type="text/javascript" src="/vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<script type="text/javascript" src="/vendor/clockpicker/dist/jquery-clockpicker.min.js"></script>
		<script type="text/javascript" src="/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<!-- Neptune JS -->
		<script type="text/javascript" src="/js/app.js"></script>
		<script type="text/javascript" src="/js/demo.js"></script>
		<script type="text/javascript" src="/js/forms-masks.js"></script>
		<script type="text/javascript" src="/js/forms-upload.js"></script>
		<script type="text/javascript" src="/js/forms-pickers.js"></script>
		<script type="text/javascript">
		$('#sandbox-date-container').datepicker({format: 'yyyy-mm-dd'});
        </script>
	</body>
</html>
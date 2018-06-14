<?php
if(isset($_POST['cus_add_new_payment'])){
		$user_id = htmlentities(trim($_POST['user_id']));
		$package_type = htmlentities(trim($_POST['package_type']));
		$payment_type = htmlentities(trim($_POST['payment_type']));
		$package_id = htmlentities(trim($_POST['package_id']));
		$due_date = htmlentities(trim($_POST['due_date']));
		$amount = htmlentities(trim($_POST['amount']));
		
		try{
		
		if(empty($user_id) || empty($package_type) || empty($payment_type) || empty($package_id) || empty($due_date)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
    			    $stmt = $reg_user->runQuery("INSERT INTO wvc_payment(user_id,transaction_id,Type,Package_type,Package_id,Amount,Due_date,payment_response,status) 
    			    VALUES('$user_id','0','$payment_type','$package_type','$package_id','$amount','$due_date','','1')");
                    $stmt->execute();
                   
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New Payment!</strong> Added Successfully.</div>";
            		header("Location: /add-payment-list");
            		exit();
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}
include 'include/header.php';
?>
<script src="/js/angular.min.js"></script>
<div class="site-content" ng-app="WVCApp" ng-controller="WVCCtrl">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Create New Payment</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/customer-list">User List</a></li>
							<li class="breadcrumb-item active"><a href="#">Add User</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" action="/add-payment-list" method="post" name="edit_ad" enctype="multipart/form-data" ng-submit="submit()">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>User ID*</b></label>
										<div class="input-group">
										<select name="user_id" class="form-control" required>
										    <option value="">Select Username</option>
										<?php
                                				$stmt = $reg_user->runQuery("SELECT * FROM user WHERE status='1' ORDER BY full_name ASC");
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if(isset($_POST['user_id']) && $_POST['user_id']==$stmt1->id){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->id; ?>"><?php echo $stmt1->full_name." (".$stmt1->id.")"; ?></option>
                                	    <?php } ?>
                                			</select>
										</div>
									</div>
									<div class="form-group">
										<label><b>Package Type*</b></label>
										<div class="input-group">
											<select name="package_type" class="form-control" required ng-model="packageType1" ng-change="packageType()">
										    <option value="">Select Package Type</option>
										    <option <?php if(isset($_POST['package_type']) && $_POST['package_type']=='1'){ echo "selected"; } ?> value="1">Broadband</option>
										    <option <?php if(isset($_POST['package_type']) && $_POST['package_type']=='2'){ echo "selected"; } ?> value="2">Cable</option>
										   </select>
										</div>
									</div>
									<div class="form-group">
										<label><b>Amount*</b></b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Amount" name="amount" value="<?php if(isset($_POST['amount'])){ echo $_POST['amount']; } ?>" required>
										</div>
									</div>	
									
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
									    <label><b>Payment Type*</b></label>
									<select name="payment_type" class="form-control" required>
										    <option value="">Select Payment Type</option>
										    <option <?php if(isset($_POST['payment_type']) && $_POST['payment_type']=='Online'){ echo "selected"; } ?> value="Online">Online</option>
										    <option <?php if(isset($_POST['payment_type']) && $_POST['payment_type']=='Cash'){ echo "selected"; } ?> value="Cash">Cash</option>
										    <option <?php if(isset($_POST['payment_type']) && $_POST['payment_type']=='Card'){ echo "selected"; } ?> value="Cash">Card</option>
										</select>
									</div>
									<div class="form-group">
									    <label><b>Package Name*</b></label>
										<select name="package_id" class="form-control" required>
										    <option value="">Select Role</option>
										    <option ng-repeat="names in packageName" value="{{names.id}}">{{names.Network}}-{{names.Name}}</option>
										</select>
									</div>
									<div class="form-group">
									    <label><b>Due Date*</b></label>
										<input type="text" id="sandbox-date-container" placeholder="Due Date" name="due_date" value="<?php if(isset($_POST['due_date'])){ echo $_POST['due_date']; } ?>" class="form-control" required>
									</div>
								</div>
								
								
								<p>{{myWelcome}}</p>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Add Payment" name="cus_add_new_payment">
									</div>
									</div>
						
							</form>
							</div>
						</div>
					</div>
				</div>
		<script src="/js/app-angular.js"></script>
		
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
        <script type="text/javascript">
		$('#sandbox-date-container1').datepicker({format: 'yyyy-mm-dd'});
        </script>
	</body>
</html>
<?php
require_once("PHPExcel/PHPExcel.php");

if(isset($_POST['SubmitButton'])){
		try{
		if($_FILES["result_file"]["size"]<1){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please select the file!</div>";
		}else{
		    
		    $target_dir = "uploads/userlist/";
            $target_file = $target_dir . basename($_FILES["result_file"]["name"]);
            $uploadOk = 1;
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
                if($FileType == 'xls' || $FileType == 'xlsx'){
                    $file_name = time().".".$FileType;
                    $target_file_new = $target_dir . $file_name;
                    if (move_uploaded_file($_FILES["result_file"]["tmp_name"], $target_file_new)){
                        
                        $html="<table border='1'>";  
                         $objPHPExcel = PHPExcel_IOFactory::load($target_file_new);  
                         foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){  
                              $highestRow = $worksheet->getHighestRow();
                              if((strtolower($worksheet->getCellByColumnAndRow(0, 1)->getValue()) == 'card no') && (strtolower($worksheet->getCellByColumnAndRow(1, 1)->getValue()) == 'smartcard nos')
                              && (strtolower($worksheet->getCellByColumnAndRow(2, 1)->getValue()) == 'name') && (strtolower($worksheet->getCellByColumnAndRow(3, 1)->getValue()) == 'mobile')
                              && (strtolower($worksheet->getCellByColumnAndRow(8, 1)->getValue()) == 'active cable package') && (strtolower($worksheet->getCellByColumnAndRow(9, 1)->getValue()) == 'cable due date')
                              && (strtolower($worksheet->getCellByColumnAndRow(10, 1)->getValue()) == 'amount')){
                              for ($row=2; $row<=$highestRow; $row++){
                                  
                                   $card_no = addslashes($worksheet->getCellByColumnAndRow(0, $row)->getValue());  
                                   $smartcard_no = addslashes($worksheet->getCellByColumnAndRow(1, $row)->getValue());  
                                   $full_name = addslashes($worksheet->getCellByColumnAndRow(2, $row)->getValue());
                                   $mobile = addslashes($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                                   $email = addslashes($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                                   $door_nos = addslashes($worksheet->getCellByColumnAndRow(5, $row)->getValue());
                                   
                                   $address = addslashes($worksheet->getCellByColumnAndRow(6, $row)->getValue());
                                   $pincode = addslashes($worksheet->getCellByColumnAndRow(7, $row)->getValue());
                                   $package_name = addslashes($worksheet->getCellByColumnAndRow(8, $row)->getValue());
                       
                                   $due_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCellByColumnAndRow(9, $row)->getValue()));
                                   $amount = addslashes($worksheet->getCellByColumnAndRow(10, $row)->getValue());
                                   
                                   if($smartcard_no != ''){
                                    $stmt_user = $reg_user->runQuery("SELECT * FROM user_as_smartcard WHERE smart_card_no='$smartcard_no' LIMIT 1");
                                    $stmt_user->execute();
                                    if($stmt_user->rowCount() == 0){
                                    $stmt_user1 = $stmt_user->fetchObject();
                                    $user_id = $stmt_user1->user_id;
                                    
                                    if(strtolower($package_name) == 'royal'){
                                        $package_id=2;
                                    }elseif(strtolower($package_name) == 'royal hd'){
                                        $package_id=3;
                                    }else{
                                        $package_id=1;
                                    }
                                    $package_type = 1;
                                    
                                    $password = md5("welcome@123");
                                    
                                   $stmt = $reg_user->runQuery("INSERT INTO user(userid,full_name,email,password,phone,user_type,card_no,status,role_id) 
                    			   VALUES('','$full_name','$email','$password','$mobile','$package_type','$card_no','1','1')");
                                   $stmt->execute();
                                   $new_user_id = $reg_user->lasdID();
                                   
                                   $stmt = $reg_user->runQuery("INSERT INTO profile(user_id,door_no,address_1,address_2,zip_code,city_id,state_id,country_id,avatar,status) 
                    			   VALUES('$new_user_id','$door_nos','$address','','$pincode','1','1','1','','1')");
                                   $stmt->execute();
                                   
                                   $stmt = $reg_user->runQuery("INSERT INTO user_has_cable(user_id,package_id,total_amount,due_date,status) 
                    			   VALUES('$new_user_id','$package_id','$amount','$due_date','1')");
                                   $stmt->execute();
                                   
                                   $stmt = $reg_user->runQuery("INSERT INTO user_as_smartcard(user_id,smart_card_no,package_id1,cable_amount,status) 
                    			   VALUES('$new_user_id','$smartcard_no','$package_id','$amount','1')");
                                   $stmt->execute();
                                   
                              }else{
                                    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>This Smartcard number (".$smartcard_no.") is already Exist!</div>";
                                    unlink($target_file_new);
                                    header("Location: /add-cable-user-from-excel");
                        		    exit();
                              }
                            }
                            }
                                
                                
                                unlink($target_file_new);
                                $_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New Cable TV User list!</strong> Added Successfully.</div>";
                        		header("Location: /add-cable-user-from-excel");
                        		exit();
                              }else{
                                  $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>The Fields Name(s) in the file was missing or changed</div>";
                              }
                         }
            		
                    } else {
                        $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Sorry, there was an error uploading your file.</div>";
                    }
                    
                }else {
                    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Selected file is not a Excel.</div>";
                }
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}
include 'include/header.php';
?>
<div class="site-content" ng-app="WVCApp" ng-controller="WVCCtrl">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Add New Payment</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/transaction-list">Transaction List</a></li>
							<li class="breadcrumb-item active"><a href="#">Add User</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form name="news upload" id="news" method="POST" enctype="multipart/form-data">
							    <div class="row">
							    <div class="col-sm-12">
								<div class="form-group">
									<label for="exampleInputFile"><b>File (xls & xlsx files only)</b></label>
									<input type="file" class="form-control-file" name="result_file" id="result_file" accept=".xls,.xlsx" required="required"/>
									<small id="fileHelp" class="form-text text-muted">Here admin can upload the blogs picture.</small>
								</div>
								</div>
								
								</div>
								<button type="submit" name="SubmitButton" class="btn btn-primary">Import Transaction Details</button> &nbsp;
								<button type="reset" class="btn btn-danger">Reset</button>
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
        	<script type="text/javascript">
		$('#sandbox-date-container1').datepicker({format: 'yyyy-mm-dd'});
        </script>
	</body>
</html>
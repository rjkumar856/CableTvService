<?php
if(isset($_GET['id'])){
$usr_id=$_GET['id'];
}


if(isset($_POST['cus_add_new_payment'])){
		$user_id = htmlentities(trim($_POST['user_id']));
		$package_type = '1';
		$payment_type = htmlentities(trim($_POST['payment_type']));
		$package_id = htmlentities(trim($_POST['package_id']));
		$due_date = htmlentities(trim($_POST['due_date']));
		$amount = htmlentities(trim($_POST['amount']));
		$month_date = htmlentities(trim($_POST['month_date']));
		$month_amount = htmlentities(trim($_POST['month_amount']));
		
		try{
		
		if(empty($user_id) || empty($package_type) || empty($payment_type) || empty($package_id) || empty($due_date)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
		    
		            $transaction_id = "wvcn_".time().$user_id;
		            $total = $amount;
		            $percent = round(18 * ($total / 100),2);
		            
    			    $stmt = $reg_user->runQuery("INSERT INTO wvc_payment(user_id,transaction_id,payment_id,Type,Package_type,Package_id,Amount,Due_date,payment_response,status,month_date,month_amount) 
    			    VALUES('$user_id','0','$transaction_id','$payment_type','$package_type','$package_id','$amount','$due_date','','1','$month_date','$month_amount')");
                    $stmt->execute();
                    
                    $stmt = $reg_user->runQuery("UPDATE user_has_broadband SET due_date='$due_date' WHERE user_id='$user_id' AND due_date<'$due_date'");
                    $stmt->execute();
                    
                    $stmt = $reg_user->runQuery("SELECT * FROM internet_pack WHERE id='$package_id'");
                    $stmt->execute();
                    if($stmt1 = $stmt->fetchObject()){
                    $PackName=($stmt1->PackName)?$stmt1->PackName:$stmt1->Speed."-".$stmt1->Data_Transfer." @Rs.".$stmt1->Traiff;
                    }else{
                        $PackName = '';
                    }
                    
                    $stmt = $reg_user->runQuery("SELECT * FROM user us WHERE us.id='$user_id'");
                        $stmt->execute();
                        for($i=0; $stmt1 = $stmt->fetchObject(); $i++){
                        $content .='<div style="width:650px;margin:0px auto;padding:0;position:relative;display:block;">
                        		<table style="margin:-10px auto 10px;font-size: 12px;width:100%;position:relative;">
                        <tr style="width:100%;"><td style="text-align:left;width:30%;"><b style="font-weight:bold;">07-03-2018</b></td>
                        <td colspan="3" style="text-align:center;width:70%;"><b style="font-weight:bold;">World Vision Cable</b></td></tr>
                        </table>
                        <div style="width:100%;margin:0px auto;border: 2px solid #999;padding: 0px 10px;">
                        <table style="margin:10px auto;font-size: 14px;width:100%;position:relative;">
                        <tr><td style="width:50%;"><img src="https://www.worldvisioncable.in/assets/images/logo.png" style="width:150px;"></td>
                        <td rowspan="5" style="font-size:12px;color:#666;width:50%;">
                        <b style="font-weight:bold;font-size: 22px;color: #008ad4;margin-top:10px;">Invoice</b><br>
                        <b style="margin-top:10px;">Account ID:</b> '.$stmt1->userid.'<br>
                        <b style="margin-top:10px;">Invoice Number:</b> '.$transaction_id.'<br>
                        <b style="margin-top:10px;">Invoice Date:</b>'.date("d-m-Y").'<br>
                        <b style="margin-top:10px;">Invoice Period:</b>'.date("d-m-Y").' - '.$due_date.'
                        </td></tr>
                        <tr><td><b style="font-weight:bold;">Name : </b> '.$stmt1->full_name.'</td></tr>
                        <tr><td><b style="font-weight:bold;">Email : </b> '.$stmt1->email.'</td></tr>
                        <tr><td><b style="font-weight:bold;">Mobile : </b> '.$stmt1->phone.'</td></tr>
                        <tr><td><b style="font-weight:bold;">User ID: </b>'.$stmt1->userid.'</td></tr>
                        </table>
                        <br>
                        <hr style="border: 1px solid #1629a0;" />
                        <table style="margin:10px auto;font-size: 14px;width:100%;text-align:center;position:relative;">
                        <tr style="width:100%;"><td><b style="font-weight:bold;">Previous Balance</b></td>
                        <td></td>
                        <td><b style="font-weight:bold;">Current Charges</b></td>
                        <td></td>
                        <td><b style="font-weight:bold;">Total Amount</b></td>
                        <td><b style="font-weight:bold;">Due Date</b></td>
                        <td><b style="font-weight:bold;"> After Due Date</b></td>
                        </tr><tr style="width:100%;">
                        <td><b style="font-weight:bold;">0</b></td>
                        <td>+</td>
                        <td><b style="font-weight:bold;">'.$amount.'</b></td>
                        <td>=</td>
                        <td><b style="font-weight:bold;">'.$total.'</b></td>
                        <td><b style="font-weight:bold;">N/A</b></td>
                        <td><b style="font-weight:bold;">N/A</b></td>
                        </tr>
                        </table>
                        <br>
                        <hr style="border: 1px solid #1629a0;" />
                        <table style="margin:10px 0px;padding:0;font-size: 14px;width:100%;position:relative;">
                        <tr><td colspan="2" style="width:50%;">Plan <span style="font-size: 21px;font-weight: bold;color: #0072af;">'.$PackName.'</span></td>
                        <td colspan="2" rowspan="11" style="width:50%;"><img src="https://www.worldvisioncable.in/uploads/channels/1518786279422.jpg" alt="world vision cable" style="width:300px;"></td></tr>
                        <tr><td colspan="2" style="font-size:16px;font-weight: bold;color: #0072af;">Current Month Charge</td></tr>
                        <tr><td>Plan Charge</td><td>'.$amount.'</td></tr>
                        <tr><td>Static IP Charges</td><td></td></tr>
                        <tr><td>Late/Extra Fee</td><td>'.$extra.'</td></tr>
                        <tr><td>Total</td><td>'.$total.'</td></tr>
                        <tr><td>Discount</td><td>0</td></tr>
                        <tr><td>Taxes/GST</td><td>'.$percent.'</td></tr>
                        <tr><td>Total Payable</td><td>'.$total.'</td></tr>
                        </table>
                        <table style="margin: 10px auto;font-size: 12px;border: 2px solid #888;padding: 0px 5px;width:100%;position:relative;">
                        <tr><td style="width:50%;font-size:16px;font-weight: bold;color: #0072af;">Terms and Conditions* :</td><td rowspan="6" style="border-left: 1px solid #444;"></td><td style="width:49%;font-size:16px;font-weight: bold;color: #0072af;">Franchisee :</td></tr>
                        <tr><td style="width:50%;">1.Kindly make renewal within expiry date to avoid Disconnection.</td>
                        <td style="width:49%;">Worldvision Cable Network</td></tr>
                        
                        <tr><td style="width:50%;">2.Cheque/Demand Draft should be in the favour of "World Vision Cable Networks"</td>
                        <td style="width:49%;">#30, 5th main, Teachers colony, koramangala, Bangalore-34</td></tr>
                        <tr><td style="width:50%;">3.This is Computer Generated invoice and does not require any signature</td>
                        <td style="width:49%;">Contact: 080-25534744</td></tr>
                        <tr><td style="width:50%;">4.Cheque/ECS/SI decline charges Rs.400/-</td>
                        <td style="width:49%;">Mobile: +91-9900065533</td></tr>
                        <tr><td style="width:50%;">5.For any queries, please call us on 080-25534744 or Email to:info@worldvisioncable.in</td>
                        <td style="width:49%;"></td></tr>
                        </table>
                        <table style="margin:10px 0px;padding:0;font-size: 14px;width:100%;position:relative;">
                        <tr style="width:100%;text-align:center;"><td>Pay your broadband payment in <a href="https://www.worldvisioncable.in/">https://www.worldvisioncable.in/</a></td></tr> 
                        </table>
                        </div>
                        </div>';
                        
                        require_once('html2pdf/html2pdf.class.php');
                        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
                        $html2pdf->setDefaultFont('Arial');
                        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
                        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
                        $html2pdf->WriteHTML($content);
                        $to = ($stmt1->email)?$stmt1->email:'info@worldvisioncable.in';
                        $from = 'info@worldvisioncable.in';
                        $cc = "info@worldvisioncable.in";
                        $subject = "Payment Invoice";
                        $message = "<p>Please see the attachment.</p>";
                        
                        $message_html = '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                        <style type="text/css">
                        html, body {margin: 0; padding: 0; outline: 0; font-family: "Lucida Grande",Verdana,Arial,Helvetica,sans-serif; font-size: 13px; font-weight: normal; width:100%; height:100%; }
                        body{min-width:320px; margin:0; padding:0; background:#fff;}
                        *, *:before, *:after { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }
                        .main { width:100%; margin:0; padding:0; display:block; position:relative; }
                        .main-center {background: #f6f6f6; width:100%; max-width:800px; margin:0 auto; display:block; }
                        .center { width:100%; max-width:650px; margin:0 auto; display:block; padding-top:0px; }
                        </style>
                        </head>
                        <body class="background">
                        <div class="main">
                        <div class="main-center">
                        <div class="center">
                        <table style="border: 0px solid #ccc" border="0" cellpadding="0" cellspacing="0" align="center" width="600" bgcolor="#FFFFFF">
                        <tbody>
                        <tr>
                            <td width="500" height="80" align="left" bgcolor="#FFFFFF" style="font-size: 0; line-height: 0; padding: 0 10px">
                            <span style="font-size: 0; line-height: 0"><a href="https://www.worldvisioncable.in" target="_blank" rel="noreferrer"><img src="https://www.worldvisioncable.in/assets/images/logo.png" width="200" border="0"></a></span>
                            </td>
                            <td width="100" align="right" bgcolor="#FFFFFF" class="m_-8518122674246736728responsive-image" style="font-size: 0; line-height: 0; padding: 0 10px">
                            <span style="font-size: 0; line-height: 0"><a href="https://play.google.com/store/apps/details?id=in.webliststore" target="_blank" rel="noreferrer"><img src="https://www.webliststore.in/image/icon-andriod.png" width="22" height="24" border="0"></a></span>
                            </td>
                            <td width="25" align="right" bgcolor="#FFFFFF" style="font-size: 0; line-height: 0; padding: 0 10px 0 0"><a href="https://itunes.apple.com/us/app/weblist-store-classified-and-online-shopping/id1256935760?ls=1&mt=8" target="_blank" rel="noreferrer"><img src="https://www.webliststore.in/image/icon-ios.png" width="22" height="24" border="0"></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" bgcolor="#0093de" style="padding: 30px; font-size: 16px;font-weight: bold; text-align: center; color: #fff"><span style="color:#fff;">World Vision Cable! </span> Broadband and Cable Networks</td>
                        </tr>
                        <tr>
                        <td colspan="4" style="padding: 30px 20px 10px; font-size: 14px">
                            <div><p>Please see the attachment.</p></div>
                            <br><br>
                            <div>Since, internet users are increasing day by day, we are focusing on providing unparalleled services to the customers. <a href="https://www.worldvisioncable.in" style="color:#de1d3c;"><b>World Vision Cable</b></a>.</div>
                            <br></td>
                        </tr>
                        <tr><td colspan="4" style="padding: 20px; font-size: 14px"><div style="font-size: 14px"> <span>Regards,</span></div>
                            <div style="font-size: 14px; padding-top: 10px"> <span>Team World Vision Cable</span> </div></td>
                        </tr>
                        <tr>
                        <td colspan="4" style="padding: 10px 20px; font-size: 14px;background: #0093de;color:#fff;font-size: 10px;">
                        <p>World Vision Cable is a pioneer internet and Cable network provider in Bangalore. Our motto is to become a seamless service provider across the city both for businesses and home at various levels of internet speed.</p>
                        </td></tr></tbody></table></div></div></div></body></html>';
                        
                        $separator = md5(time());
                        $eol = PHP_EOL;
                        $filename = time().".pdf";
                        $pdfdoc = $html2pdf->Output('', 'S');
                        $attachment = chunk_split(base64_encode($pdfdoc));
                        $headers = "From: " . $from . $eol;
                        $headers .= "Cc:".$cc. $eol;
                        $headers .= "MIME-Version: 1.0" . $eol;
                        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;
                        $body = '';
                        $body .= "Content-Transfer-Encoding: 7bit" . $eol;
                        $body .= "This is a MIME encoded message." . $eol; //had one more .$eol
                        $body .= "--" . $separator . $eol;
                        $body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
                        $body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
                        $body .= $message_html . $eol;
                        
                        $body .= "--" . $separator . $eol;
                        $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
                        $body .= "Content-Transfer-Encoding: base64" . $eol;
                        $body .= "Content-Disposition: attachment" . $eol . $eol;
                        $body .= $attachment . $eol;
                        $body .= "--" . $separator . "--";
                
                        if (mail($to, $subject, $body, $headers)) {
                            $msgsuccess = 'Mail Send Successfully';
                        }
                        }
                    
                   
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New Payment!</strong> Added Successfully.</div>";
            		header("Location: /add-broadband-payment-list");
            		exit();
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
							<li class="breadcrumb-item"><a href="/customer-list">User List</a></li>
							<li class="breadcrumb-item active"><a href="#">Add User</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" action="/add-broadband-payment-list" method="post" name="edit_ad" enctype="multipart/form-data" ng-submit="submit()">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>User ID*</b></label>
										<div class="input-group">
										<select name="user_id" class="form-control" required>
										<?php
										
										if(isset($_GET['id']) && !empty($user_id)){
                                		$stmt = $reg_user->runQuery("SELECT *,us.id as UserID FROM user_has_broadband ub INNER JOIN user us ON us.id=ub.user_id WHERE us.id='$user_id' ORDER BY us.userid ASC");
										}else{
										   $stmt = $reg_user->runQuery("SELECT *,us.id as UserID FROM user_has_broadband ub INNER JOIN user us ON us.id=ub.user_id");
										}
                                				$stmt->execute();
                                				for($i=0; $stmt1 = $stmt->fetchObject(); $i++){ ?>
                                				<option <?php if(isset($_POST['user_id']) && $_POST['user_id']==$stmt1->UserID){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->UserID; ?>"><?php echo $stmt1->userid; ?></option>
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
                                				<option <?php if(isset($_POST['package_id']) && $_POST['package_id']==$stmt1->PackID){ echo "selected"; }else{ echo ""; } ?> value="<?php echo $stmt1->PackID; ?>">
                                				    <?php $PackName=($stmt1->PackName)?$stmt1->PackName:$stmt1->Speed."-".$stmt1->Data_Transfer." @Rs.".$stmt1->Traiff; echo $stmt1->NetworkName."-".$PackName; ?></option>
                                	    <?php } ?>
                                			</select>
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
									    <label><b>Due Date*</b></label>
										<input type="text" id="sandbox-date-container" placeholder="Due Date" name="due_date" value="<?php if(isset($_POST['due_date'])){ echo $_POST['due_date']; } ?>" class="form-control" required>
									</div>
								</div>	<div class="col-md-12">
								    <div class="col-md-6">
									<div class="form-group">
									    <label><b>Month / Date</b></label>
									<input type="text" id="sandbox-date-container1" placeholder="Month / Date" name="month_date" value="<?php if(isset($_POST['month_date'])){ echo $_POST['month_date']; } ?>" class="form-control" required>
									</div>
									<div class="form-group">
									    <label><b>Month Amount</b></label>
										<input type="text" class="form-control" placeholder="Amount" name="month_amount" value="<?php if(isset($_POST['month_amount'])){ echo $_POST['month_amount']; } ?>" required>
									</div>
									</div>
								</div>
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
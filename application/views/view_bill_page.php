<?php
require_once('common/header.php');
$user_details=$this->session->userdata['logged_in'];
?>
<section class="content account complaints">
		<div class="container">
    		<div class="account-left col-xs-12 col-sm-3 col-md-2">
    		    <ul>
    		        <li><a href="/my-account">Account</a></li>
    		        <li><a href="/my-package">Package Detail</a></li>
    		        <li class="active"><a href="/my-view-bill">View Bills</a></li>
    		        <li><a href="/change-password">Change Password</a></li>
    		        <li><a href="/my-complaint">Complaint</a></li>
    		    </ul>
    		</div>
    		<div class="account-right col-xs-12 col-sm-9 col-md-10">
    		<h3>View Bill History</h3>
    		<div class="complaints-list">
    		   <?php
    		   foreach($get_post_payments as $key=>$value){ ?>
    		   <div class="account-details table-style col-xs-12 col-sm-6 col-md-4">
    		   <table>
    		       <thead>
    		           <tr><th colspan="2">Bill Generated on <?php echo $value['Date_added']; ?> </th></tr>
    		           </thead>
    		       <tbody>
    		       <tr><th>user_id:</th><td><?php echo $value['user_id']; ?></td></tr>
    		       <tr><th>transaction id:</th><td><?php echo $value['mer_txn']; ?></td></tr>
    		       <tr><th>Paid on:</th><td><?php echo $value['Date_added']; ?></td></tr>
    		       <tr><th>Payment Type:</th><td><?php echo $value['Type']; ?></td></tr>
    		       <tr><th>Amount:</th><td><?php echo $value['Amount']; ?></td></tr>
    		       <tr><th>Status:</th><td><?php if($value['Status'] == 1){ echo "Success";}else{ echo "Failed"; } ?></td></tr>
    		       </tbody>
    		   </table>
    		   </div>
    		   <?php } ?>
    		   
    		   </div>
    		   
    		</div>
		</div>
	</section>
	  <?php include("common/footer.php"); ?>
      <script src="assets/js/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="assets/js/slick.min.js"></script>
      <script type="text/javascript" src="assets/js/script.js"></script>
      <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
   </body>
</html>
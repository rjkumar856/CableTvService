<?php
require_once('common/header.php');
$user_details=$this->session->userdata['logged_in'];
?>
<section class="content account">
		<div class="container">
    		<div class="account-left col-xs-12 col-sm-3 col-md-2">
    		    <ul>
    		        <li class="active"><a href="/my-account">Account</a></li>
    		        <li><a href="/my-package">Package Detail</a></li>
    		        <li><a href="/my-view-bill">View Bills</a></li>
    		        <li><a href="/change-password">Change Password</a></li>
    		        <li><a href="/my-complaint">Complaint</a></li>
    		    </ul>
    		</div>
    		<div class="account-right col-xs-12 col-sm-9 col-md-10">
    		<h3>Hi <?php echo $user_details['Name']; ?>!</h3>
    		<div class="account-details table-style">
    		   <table>
    		       <thead>
    		       <tr><th colspan="2">Personal Details</th></tr>
    		       </thead>
    		       <tbody>
    		       <tr><th>User ID:</th><td><?php echo $Account_details[0]['userid']; ?></td></tr>
    		       <tr><th>Full Name:</th><td><?php echo $Account_details[0]['full_name']; ?></td></tr>
    		       <tr><th>Email:</th><td><?php echo $Account_details[0]['email']; ?></td></tr>
    		       <tr><th>Phone Number:</th><td><?php echo $Account_details[0]['phone']; ?></td></tr>
    		       <tr><th>smartcard Number:</th><td><?php if(isset($smartcard_details[0]['smart_card_no'])){ echo $smartcard_details[0]['smart_card_no']; } ?></td></tr>
    		       </tbody>
    		   </table>
    		</div>
    		<div class="account-details table-style">
    		   <table>
    		       <thead>
    		       <tr><th colspan="2">Contact Details</th></tr>
    		       </thead>
    		       <tbody>
    		       <tr><th>Address 1:</th><td><?php echo $Account_details[0]['address_1']; ?></td></tr>
    		       <tr><th>Address 2:</th><td><?php echo $Account_details[0]['address_2']; ?></td></tr>
    		       <tr><th>City:</th><td><?php echo $Account_details[0]['city_name']; ?></td></tr>
    		       <tr><th>State:</th><td><?php echo $Account_details[0]['state_name']; ?></td></tr>
    		       <tr><th>Country:</th><td><?php echo $Account_details[0]['country_name']; ?></td></tr>
    		       </tbody>
    		   </table>
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
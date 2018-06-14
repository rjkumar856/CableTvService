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
    		        <li><a href="/my-view-bill">View Bills</a></li>
    		        <li><a href="/change-password">Change Password</a></li>
    		        <li><a href="/my-complaint">Complaint</a></li>
    		    </ul>
    		</div>
    		<div class="account-right col-xs-12 col-sm-9 col-md-10">
    		<h3>View Complaints Status</h3>
    		<div class="complaints-list">
    		   <?php
    		   foreach($get_post_complaint as $key=>$value){ ?>
    		   <div class="account-details table-style col-xs-12 col-sm-6 col-md-4">
    		   <table>
    		       <thead>
    		           <tr><th colspan="2">Complainted on <?php echo $value['created_at']; ?> </th></tr>
    		           </thead>
    		       <tbody>
    		       <tr><th>Name:</th><td><?php echo $value['name']; ?></td></tr>
    		       <tr><th>Email:</th><td><?php echo $value['email']; ?></td></tr>
    		       <tr><th>Mobile:</th><td><?php echo $value['phone']; ?></td></tr>
    		       <tr><th>Nature Of Complaint:</th><td><?php echo $value['nature_of_complaint']; ?></td></tr>
    		       <tr><th>Technician:</th><td><?php echo $value['technician']; ?></td></tr>
    		       <tr><th>Description:</th><td><?php echo $value['description']; ?></td></tr>
    		       <tr><th>Status:</th><td><?php echo $value['complaint_status']; ?></td></tr>
    		       <tr><th>Comments:</th><td><?php echo $value['comments']; ?></td></tr>
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
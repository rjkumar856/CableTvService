<?php
require_once('common/header.php');
$user_details=$this->session->userdata['logged_in'];
?>
<section class="content account">
		<div class="container">
    		<div class="account-left col-xs-12 col-sm-3 col-md-2">
    		    <ul>
    		        <li><a href="/my-account">Account</a></li>
    		        <li class="active"><a href="/my-package">Package Detail</a></li>
    		        <li><a href="/my-view-bill">View Bills</a></li>
    		        <li><a href="/change-password">Change Password</a></li>
    		        <li><a href="/my-complaint">Complaint</a></li>
    		    </ul>
    		</div>
    		<div class="account-right col-xs-12 col-sm-9 col-md-10">
    		<h3><i class="fa fa-calendar-o" aria-hidden="true"></i> Active Plans</h3>
    		<div class="col-xs-6">
    		    <div class="account-details active-plan">
    		    <?php if(isset($active_internet_package[0]) && is_array($active_internet_package)){ ?>
    		   <h4>Active Broadband Plan</h4>
    		   <div class="amount">Rs.<?php echo $active_internet_package[0]['Total']; ?> per <?php echo $active_internet_package[0]['Validity'];?></div>
    		   <div class="details">
    		   <span><b>Plan Name:</b></span><span> <?php echo $active_internet_package[0]['Speed']." Speed ".$active_internet_package[0]['Data_Transfer']." FUB ".$active_internet_package[0]['After_Fup']."@ Rs.".$active_internet_package[0]['Traiff']." (Validity ".$active_internet_package[0]['Validity'].")"; ?></span><br>
    		   <span><b>Provider:</b></span><span> <?php echo $active_internet_package[0]['Provider_name']; ?></span><br>
    		   <span><b>Due Date:</b></span><span> <?php echo $active_internet_package[0]['due_date']; ?></span>
    		   </div>
    		   <a href="<?php echo $payment_url_broadband; ?>" class="pay-now">Pay Now</a>
    		   <?php }else{ ?>
    		   <h4>No Active Broadband Plan</h4>
    		   <?php } ?>
    		</div>
    		<div class="account-details recommanded-plan">
    		<table class="plan-table">
    		    <thead><tr><th colspan="5">Recommanded Broadband Plan</th></tr></thead>
    		    <tbody>
    		    <tr><th>Sno</th><th>Name</th><th>Network</th><th>Amount</th><th>Action</th></tr>
    		    <?php $count =1; foreach($recommended_internet_package as $key=>$value){ ?>
    		    
    		       <tr>
    		           <td><?php echo $count; ?></td>
    		           <td><?php echo $value['Speed']." Speed ".$value['Data_Transfer']." FUB ".$value['After_Fup']."@ Rs.".$value['Traiff']." (Validity ".$value['Validity'].")"; ?></td>
    		           <td><?php echo $value['Provider_name']; ?></td>
    		           <td>Rs.<?php echo $value['Total']; ?></td>
    		           <td><a href="#" class="change-plan" data-toggle="modal" data-target="#view_change_plan_popup">Change</a></td>
    		      </tr>
    		       <?php $count++; } ?>
    		       </tbody>
    		   </table>
    		</div>
    		
    		</div>
    		<div class="col-xs-6">
    		    <div class="account-details active-plan">
    		   <?php if(isset($active_cable_package[0]) && is_array($active_cable_package)){ ?>
    		   <h4>Active Cable Plan</h4>
    		   <div class="amount">Rs.<?php echo $active_cable_package[0]['price']; ?> per <?php echo $active_cable_package[0]['Validity'];?></div>
    		   <div class="details">
    		   <span><b>Plan Name:</b></span><span> <?php echo $active_cable_package[0]['Package_name']; ?></span><br>
    		   <span><b>Provider:</b></span><span> <?php echo $active_cable_package[0]['Provider_name']; ?></span><br>
    		   <span><b>Due Date:</b></span><span> <?php echo $active_cable_package[0]['due_date']; ?></span>
    		   </div>
    		   <a href="<?php echo $payment_url_cable; ?>" class="pay-now">Pay Now</a>
    		   <?php }else{ ?>
    		   <h4>No Active Cable Plan</h4>
    		   <?php } ?>
    		</div>
    		
    		<div class="account-details recommanded-plan">
    		<table class="plan-table">
    		    <thead><tr><th colspan="5">Recommanded Cable Plan</th></tr></thead>
    		    <tbody>
    		    <tr><th>Sno</th><th>Name</th><th>Network</th><th>Amount</th><th>Action</th></tr>
    		    <?php $count =1; foreach($recommended_cable_package as $key=>$value){ ?>
    		    
    		       <tr>
    		           <td><?php echo $count; ?></td>
    		           <td><?php echo $value['Plan_name']; ?></td>
    		           <td><?php echo $value['Provider_name']; ?></td>
    		           <td>Rs.<?php echo $value['price']; ?></td>
    		           <td><a href="#" class="change-plan" data-toggle="modal" data-target="#view_change_plan_popup">Change Plan</a></td>
    		      </tr>
    		       <?php $count++; } ?>
    		       </tbody>
    		   </table>
    		</div>
    		</div>
    		</div>
		</div>
	</section>
<section id="view_change_plan_popup" class="modal view_new_connection_popup view_login_popup" role="dialog" aria-labelledby="view_change_plan_popup" aria-hidden="true">
<div class="modal-body">
<div class="map-heading"><h4 class="title"><i class="fa fa-key" aria-hidden="true"></i> To Change Plan</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="form-body">
<div class="form-container View_inquiry_popup_form_container">
<p>To change existing plan, Please call us at <b>080-25534744 or 9900065533</b> or Mail us at <b>info@worldvision.com</b></p>
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
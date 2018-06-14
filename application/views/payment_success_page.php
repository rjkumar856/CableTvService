<?php
require_once('common/header.php');
?>
<section class="content account payment">
		<div class="container">
		<h3><i class="fa fa-money" aria-hidden="true"></i> Payment Information</h3>
		<div class="account-details payment-table <?php if($_POST['f_code'] == "Ok"){ echo "success"; }else{ echo "failure"; } ?>">
    		<table>
    		    <thead><tr><th colspan="2"><?php if($_POST['f_code'] == "Ok"){ echo "Payment Success"; }else{ echo "Payment Failure"; } ?></th></tr></thead>
    		    <tbody>
    		       <tr><th>Transaction ID</th><td><?php echo $_POST['mer_txn']; ?></td></tr>
    		       <tr><th>Amount</th><td><?php echo $_POST['amt']; ?></td></tr>
    		       <tr><th>Date</th><td><?php echo $_POST['date']; ?></td></tr>
    		       <tr><th>Bank Name</th><td><?php echo $_POST['bank_name']; ?></td></tr>
    		       <tr><th>Description</th><td><?php echo $_POST['desc']; ?></td></tr>
    		       <tr><th>Status</th><td><?php if($_POST['f_code'] == "Ok"){ echo "Success"; }else{ echo "Failure"; } ?></td></tr>
    		       <tr><th>Transaction Number</th><td><?php echo $_POST['mmp_txn']; ?></td></tr>
    		    </tbody>
    		   </table>
    		   <script type="text/javascript">
                  showAndroidToast("<?php echo implode(",",$_POST); ?>");
                  function showAndroidToast(reponseText) {
                      Android.onResponse(reponseText);
                      window.Android.onResponse(reponseText);
                  }
                </script>
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
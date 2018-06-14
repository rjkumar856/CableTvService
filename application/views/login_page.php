<?php
require_once('common/header.php');
?>
<section class="content contact-us login-page">
		<div class="container">
		<h3>Login</h3>
<div class="col-xs-12 contact-left">
<div class="form">
<div class="alert alert-danger" id="login_send_login_error" style="<?php if(validation_errors()){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>"><?php if(validation_errors()){echo validation_errors();} ?></div>
<div class="alert alert-success" style="<?php if(isset($message)){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>"><?php if(isset($message)){ echo $message;} ?></div>
<div class="alert alert-success" style="<?php if($this->session->flashdata('message')){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>"><?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?></div>
<form method="POST" enctype="multipart/form-data" action="/login-page-submission" >
<div id="contact_View_inquiry_popup_msg_container">
<div class="form-group">
<span>User ID or Smartcard Number*</span>
<input type="text" name="user_name" id="login_user_name" value="<?php if(set_value('user_name')) {echo set_value('user_name'); } ?>" class="input" placeholder="User ID or Smartcard Number" required="required">
</div>
<div class="form-group">
<span>Password*</span>
<input type="password" name="user_password" id="login_user_password" value="<?php if(set_value('user_password')) {echo set_value('user_password'); } ?>" class="input" placeholder="Password" required="required">
</div>
<div class="form-group">
<input type="submit" name="login_to_client" class="submit" value="Login" id="login_to_client_login">
</div>
</div>

<div class="forgot_password"><a href="/forgot_password" title="Forgot password?">Forgot password?</a></div>
</form>
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
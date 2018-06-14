<?php
if(isset($this->session->userdata['logged_in'])){
   $user_details=$this->session->userdata['logged_in'];
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Broadband & Cable TV Services, Internet Connection | Koramangala, HSR Layout</title>
      <meta name="description" content="World Vision Cable Network, Broadband services in Koramangala and HSR Layout, Cable TV services in HSR Layout and Koramangala, also Internet connection in HSR layout." />
      <meta name="keywords" content="Broadband services in Koramangala and HSR Layout, Cable TV services in HSR Layout and Koramangala, also Internet connection in HSR layout"/>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <link rel="shortcut icon" href="/assets/images/favicon_1.png" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="/assets/css/font-monia.css" />
      <link rel="stylesheet" href="/assets/css/main.css">
      <link rel="stylesheet" href="/assets/css/hover.css">
      <link href="/assets/css/bootstrap-datetimepicker.css" rel="stylesheet">
      <link rel="stylesheet" href="/assets/css/animate.css">
      <link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
      <link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet" type='text/css'>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
      <script src="/assets/js/11549a4d42.js"></script>
      <script src="/assets/js/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   </head>
   <body ng-app="WVCApp" ng-controller="WVCCtrl">
      <div id="mob-overlay" class="hidden-lg hidden-sm hidden-md"></div>
      <div id="slider-block" class="hidden-lg hidden-sm hidden-md">
         <div class="close-sidebar-btn">
            <button class="btn btn-lg btn-danger" id="close-mob-header"><i class="fa fa-arrow-left" aria-hidden="true"></i> CLOSE</button>
         </div>
         <nav class="sidebar-nav">
            <ul class="sidebar-nav-ul">
               <li><a href="/" class="nav-link"><i class="fa fa-home fa-lg" aria-hidden="true"></i> Home</a></li>
               <li><a href="/about-us" class="nav-link"><i class="fa fa-link fa-lg" aria-hidden="true"></i> About us</a></li>
               <li><a href="/internet-packs" class="nav-link"><i class="fa fa-bullhorn fa-lg" aria-hidden="true"></i> Internet packs</a></li>
               <li><a href="/cable-pack" class="nav-link"><i class="fa fa-graduation-cap fa-lg" aria-hidden="true"></i> Cable tv packs</a></li>
               <li><a href="/contact-us" data-toggle="modal" data-target="#view_contact_us_popup" class="nav-link"><i class="fa fa-phone fa-lg" aria-hidden="true"></i> Contact us</a></li>
               <li><a href="/contact-us" data-toggle="modal" data-target="#view_new_connection_popup" class="nav-link"><i class="fa fa-globe fa-lg" aria-hidden="true"></i> New Connection</a></li>
               <li><a href="/my-package" class="nav-link"><i class="fa fa-tachometer fa-lg" aria-hidden="true"></i> Pay Bill</a></li>
               <li><a href="#" class="nav-link"></a></li>
            </ul>
         </nav>
         <div class="mob-social-icons">
            <a href="#" target="_blank" data-toggle="tooltip" data-placement="bottom" title="follow us on Google+"><i class="fa fa-google-plus fa-lg" aria-hidden="true"></i></a>
            <a href="#" target="_blank" data-toggle="tooltip" data-placement="bottom" title="follow us on FaceBook"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
            <a href="#" target="_blank" data-toggle="tooltip" data-placement="bottom" title="follow us on Twitter"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
            <a href="#" target="_blank" data-toggle="tooltip" data-placement="bottom" title="follow us on Linkedin"><i class="fa fa-linkedin fa-lg" aria-hidden="true" ></i></a>
         </div>
      </div>
      <div class="container mobile-header hidden-lg hidden-sm hidden-md">
         <i class="fa fa-bars fa-lg" aria-hidden="true" id="toggle-sidebar"></i> <a href="/">World Vision Cable Network</a>
      </div>
      <nav class="navbar navbar-default hidden-xs" id="navbar-small">
         <div class="container">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
               <ul class="nav navbar-nav home-business-link">
                  <li><a href="#" id="support-link">Our Support <i class="fa fa-chevron-down" aria-hidden="true"></i></a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"><i class="fa fa-globe fa-lg" aria-hidden="true"></i> Bangalore</a></li>
                  <?php
                  if(isset($this->session->userdata['logged_in'])){ ?>
                  <li class="hidden-xs hidden-sm hidden-md hidden-lg"><a href="/my-account"><i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i><?php echo $user_details['Name']; ?></a>
                  <ul class="submenu">
    		        <li><a href="/my-account">Account</a></li>
    		        <li><a href="/my-package">Package Detail</a></li>
    		        <li><a href="#">Usage Details</a></li>
    		        <li><a href="/my-view-bill">View Bills</a></li>
    		        <li><a href="/change-password">Change Password</a></li>
    		        <li><a href="/my-complaint">Complaint</a></li>
    		        <li><a href="/view-complaint">View Complaints</a></li>
    		    </ul>
                  </li>
                <?php }else{ ?>
                <li class="hidden-xs hidden-sm hidden-md hidden-lg"><a href="/login" data-toggle="modal" data-target="#view_login_popup"><i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i> Sign In</a></li>
                <?php } ?>
               </ul>
            </div>
         </div>
      </nav>
      <div id="custom-nav">
         <div class="container">
            <div class="nav-section">
               <a href="/"><img src="/assets/images/logo.png" alt="logo" title="logo" class="img-responsive logo"></a>
               <div id="triangle-topright">
                   <?php
                  if(isset($this->session->userdata['logged_in'])){ ?>
                  <a href="/my-account" onclick="return false" ng-click="toggleSubmenu()">
                     <div><i class="fa fa-user-o fa-3x" aria-hidden="true"></i></div>
                     <div class="busy-res"><?php echo $user_details['Name']; ?></div>
                  </a>
                  <ul class="submenu ng-hide" ng-show="hoverLogin">
    		        <li><a href="/my-account">Account</a></li>
    		        <li><a href="/my-package">Package Detail</a></li>
    		        <li><a href="#">Usage Details</a></li>
    		        <li><a href="/my-view-bill">View Bills</a></li>
    		        <li><a href="/change-password">Change Password</a></li>
    		        <li><a href="/my-complaint">Complaint</a></li>
    		        <li><a href="/view-complaint">View Complaints</a></li>
    		        <li><a href="/logout">Logout</a></li>
    		    </ul>
    		    
                <?php }else{ ?>
                <a href="/login" data-toggle="modal" data-target="#view_login_popup">
                     <div><i class="fa fa-user-o fa-3x" aria-hidden="true"></i></div>
                     <div class="busy-res">Login</div>
                  </a>
                <?php } ?>
               </div>
               <ul id="nav-links1" class="nav navbar-nav main-nav hidden-xs">
                  <li><a class="mega-menu-link" href="/">Home</a></li>
                  <li><a class="mega-menu-link" href="/about-us">About us</a></li>
                  <li><a class="mega-menu-link" href="/internet-packs">Internet Packs</a></li>
                  <li><a class="mega-menu-link" href="/cable-pack">Cable TV Packs</a></li>
                  <li><a class="mega-menu-link" href="/contact-us">Contact us</a></li>
               </ul>
            </div>
         </div>
      </div>
      <section id="support">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="contact">
                      <p><b>Office Time</b></p>
                     <p>Sunday to Saturday: 10AM - 8:30PM</p>
                     <br/>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="contact">
                     <h5><strong><i class="fa fa-mobile fa-2x" aria-hidden="true"></i> Call us</strong></h5>
                     <p><b>080-25534744</b></p>
                     <p><b>+91-9900065533</b></p>
                  </div>
               </div>
               <div class="col-md-4 sec-email-col">
                  <div class="contact">
                     <h5><strong><i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i> Email us</strong></h5>
                     <p><b>info@worldvisioncable.in</b></p>
                  </div>
               </div>
               <!--  <div class="col-md-4">
                  <img src="" class="img-responsive img-circle tele-contact" align="right"> 
                  </div> -->
            </div>
         </div>
      </section>
      <div class="side-fixed-block hidden-sm hidden-xs">
         <div class="side-links">
            <a href="/contact-us" data-toggle="modal" data-target="#view_new_connection_popup">
               <p><i class="fa fa-globe" aria-hidden="true"></i></p>
               <p>New</p>
               <p>connection</p>
            </a>
         </div>
         <div class="side-links">
            <a href="/contact-us" data-toggle="modal" data-target="#view_contact_us_popup">
               <p><i class="fa fa-envelope-o fa-5x" aria-hidden="true"></i></p>
               <p>Contact us</p>
            </a>
         </div>
      </div>
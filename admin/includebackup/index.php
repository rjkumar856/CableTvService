<?php 
ob_start();
$reg_user = new USER(); 
if (!isset($_SESSION['userSession'])) {
 header('location:login');
}
include("header.php");

 
?>
<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/jquery.imgareaselect.js" type="text/javascript"></script>
<script src="js/jquery.form.js"></script>
<link rel="stylesheet" href="css/imgareaselect.css">
<script src="js/functions.js"></script>
<style>
.u-img.img-cover{background: url(https://www.admin.webliststore.in/img/logo.png) #cecece center;
    /* background-size: contain; */
    /* background: #000; */
    background-repeat: no-repeat;}
    .shadow-white {
    -webkit-box-shadow: 0 0 0 1px #fff !important;
    box-shadow: 0 0 0 1px #fff !important; 
    padding: 10px;
    background: #d4d4d4;
}
.zc-ref {
  display: none;
}
.nav-tabs>li>a { 
  border-color: #014373; /*50%*/
  color:#000000;    padding: 10px;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
  color: #fff;
  background-color: #014373;
  border: 1px solid #014373;
      padding: 10px;
}ul.nav.nav-tabs li {
    background: #99d1f9;
    /* color: white; */
}
.nav-tabs>li>a:hover {
  border-color: #014373;
  background-color: #014373;color:white;
}
.nav-tabs > li, .nav-pills > li {
    float:none;
    display:inline-block;
    *display:inline; /* ie7 fix */
     zoom:1;    padding: 10px 0 10px 0;
}
.nav-tabs, .nav-pills {
    text-align:center;
}
.nav-tabs {
    border-bottom: 2px solid #014373;
}
.img-center {
  margin:0 auto;
  padding: 15px;
}

.col-md-6 {
  padding: 15px;
}

.new-row {
  clear: left;    
}
  .tab-content {
    padding: 20px;
}
.no-title-col {
  padding-top: 30px;      
}a.btn.btn-primary {
    padding: 10px 25px 10px 25px;
    font-size: 15px;
    background: #014373;
}
</style>
        <div class="site-content">
                <!-- Content -->
                <div class="content-area py-1">
                    <div class="container-fluid">
                        <div class="row row-md mb-1">
<?php
$stmt = $reg_user->runQuery("SELECT * FROM tbl_admin_customers WHERE id = '".$_SESSION['userSession']."' ");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
{
?>
                            <div class="col-md-4">
                                <div class="box bg-white user-1">
                                    <div class="u-img img-cover" style="background-image: url(<?php echo $stmt1->cusBannerpic;?>);"></div>
                                    <div class="u-content">
                                        <div class="avatar box-64">
                                            
                                        </div>
                                        <h5><a class="text-black" href="#"><?php echo $stmt1->cusFname;?></a></h5>
                                        <p class="text-muted pb-0-5" style="text-transform:uppercase"><?php echo $stmt1->role;?></p>
                                        
                                    </div>
                                    
                                </div>
                            </div> 
                            
                            <?php } ?>
                        </div><hr/>
                    
</head>
	<body>
		


                </div>
<footer class="footer">
                    <div class="container-fluid">
                        <div class="row text-xs-center">
                            <div class="col-sm-4 text-sm-left mb-0-5 mb-sm-0">
                                2017 webliststore.in
                            </div>
                            <div class="col-sm-8 text-sm-right">
                                <ul class="nav nav-inline l-h-2">
                                    <li class="nav-item"><a class="nav-link text-black" href="#">Privacy</a></li>
                                    <li class="nav-item"><a class="nav-link text-black" href="#">Terms</a></li>
                                    <li class="nav-item"><a class="nav-link text-black" href="#">Help</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
</div>

        <!-- Vendor JS -->
        <script type="text/javascript" src="vendor/tether/js/tether.min.js"></script>
        <script type="text/javascript" src="vendor/bootstrap4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="vendor/detectmobilebrowser/detectmobilebrowser.js"></script>
        <script type="text/javascript" src="vendor/jscrollpane/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="vendor/jscrollpane/mwheelIntent.js"></script>
        <script type="text/javascript" src="vendor/jscrollpane/jquery.jscrollpane.min.js"></script>
        <script type="text/javascript" src="vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
        <script type="text/javascript" src="vendor/waves/waves.min.js"></script>
        <script type="text/javascript" src="vendor/switchery/dist/switchery.min.js"></script>
        <script type="text/javascript" src="vendor/flot/jquery.flot.min.js"></script>
        <script type="text/javascript" src="vendor/flot/jquery.flot.resize.min.js"></script>
        <script type="text/javascript" src="vendor/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script type="text/javascript" src="vendor/CurvedLines/curvedLines.js"></script>
        <script type="text/javascript" src="vendor/TinyColor/tinycolor.js"></script>
        <script type="text/javascript" src="vendor/sparkline/jquery.sparkline.min.js"></script>
        <script type="text/javascript" src="vendor/raphael/raphael.min.js"></script>
        <script type="text/javascript" src="vendor/morris/morris.min.js"></script>
        <script type="text/javascript" src="vendor/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
        <script type="text/javascript" src="vendor/jvectormap/jquery-jvectormap-world-mill.js"></script>
        <script type="text/javascript" src="vendor/peity/jquery.peity.js"></script>

        <!-- Neptune JS -->
        <script type="text/javascript" src="js/app.js"></script>
        <script type="text/javascript" src="js/demo.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        
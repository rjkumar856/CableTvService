<!DOCTYPE html>
<html lang="en">
<head>
<meta name="keywords" content="" />
<meta name="author" content="">
<meta name="robots" content="noindex, nofollow" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://use.fontawesome.com/ef3000c315.js"></script>
<style>.raisetick {
    position: fixed;
    right: 100px;
    top: 0px;
    z-index: 9999;
    width: 120px;
}.raisetick img {
    width: 120px;
}div#infor {
       position: fixed;
    right: 0;
    /* z-index: 999; */
    background: #fff;
    top: 60px;
}</style>
<?php include 'style.php'; ?>
	</head>
	<body class="fixed-sidebar fixed-header skin-default content-appear">

		<div class="wrapper"> 

			<!-- Preloader -->
			<div class="preloader"></div>

			<!-- Sidebar -->
			<div class="site-overlay"></div>
			<?php
			if (isset($_SESSION['userSession'])) {
			require_once 'class.user.php';
			$user = new User();
			$stmt = $user->runQuery("SELECT * FROM tbl_admin_customers WHERE id = '" . $_SESSION["userSession"] . "' ");
			$stmt->execute();
			for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
			{ $name = $stmt1->cusFname; 
			$admin = $stmt1->role;
			$cusid = $stmt1->id;
			$id = $stmt1->id;
			}
			?>
			<div class="site-sidebar">
				<div class="custom-scroll custom-scroll-light">
					<ul class="sidebar-menu">
					
						<li class="menu-title">Main</li>
						<li class="with-sub">
							<a href="/" class="waves-effect  waves-light">
								<span class="s-icon"><i class="ti-themify-favicon"></i></span>
								<span class="s-text"><?php echo ucwords($name); ?></span>
							</a>
						</li>
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-shopping-cart"></i></span>
								<span class="s-text">User List</span>
							</a>
							<ul>
								<li><a href="cable-user-list">Cable User List</a></li>
								<li><a href="broadband-user-list">Broadband User List</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a href="customer-list" class="waves-effect  waves-light">
								<span class="s-icon"><i class="ti-user"></i></span>
								<span class="s-text">User List</span>
							</a>
						</li>
						<li class="with-sub">
							<a href="search-classified-ads-admin" class="waves-effect  waves-light">
								<span class="s-icon"><i class="ti-search"></i></span>
								<span class="s-text">Search Classified Ads</span>
							</a>
						</li>
						<li class="with-sub">
							<a href="search-classified-ads-sales" class="waves-effect  waves-light">
								<span class="s-icon"><i class="ti-search"></i></span>
								<span class="s-text">Search Classified Ads</span>
							</a>
						</li>
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-view-grid"></i></span>
								<span class="s-text">Classified Ads Categories</span>
							</a>
							<ul>
								<li><a href="all-category">All Categories</a></li>
								<li><a href="sub-category">Sub Categories</a></li>
								<li><a href="add-new-category">Add New Category</a></li>
								<li><a href="add-new-sub-category">Add New Sub Category</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-shopping-cart-full"></i></span>
								<span class="s-text">Buy / Sell Categories</span>
							</a>
							<ul>
								<li><a href="all-bs-category">All Categories</a></li>
								<li><a href="bs-sub-category">Sub Categories</a></li>
								<li><a href="bs-add-new-category">Add New Category</a></li>
								<li><a href="bs-add-new-sub-category">Add New Sub Category</a></li>
							</ul>
						</li>
					    <li class="with-sub">
							<a href="add-areas" class="waves-effect  waves-light">
								<span class="s-icon"><i class="ti-world"></i></span>
								<span class="s-text">Add Areas</span>
							</a>
						</li>	
						<li class="with-sub">
							<a href="add-keywords" class="waves-effect  waves-light">
								<span class="s-icon"><i class="ti-check-box"></i></span>
								<span class="s-text">Add Keywords</span>
							</a>
						</li>
						<li class="with-sub">
							<a href="add-faq" class="waves-effect  waves-light">
								<span class="s-icon"><i class="ti-pencil-alt"></i></span>
								<span class="s-text">Add FAQ's</span>
							</a>
						</li>
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-gallery"></i></span>
								<span class="s-text">Website Sliders</span>
							</a>
							<ul>
								<li><a href="all-sliders">All Sliders</a></li>
								<li><a href="add-new-slider">Add New Slider</a></li>
							</ul>
						</li>
						<li class="with-sub compact-hide active">
							<a href="" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-calendar"></i></span>
								<span class="s-text">Daily Report</span>
							</a>
						</li>
						<li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-ticket"></i></span>
								<span class="s-text">Raise Tickets</span>
							</a>
							<ul>
								<li><a href="raise-ticket">Raise New Ticket</a></li>
								<li><a href="view-my-tickets">Tickets (<?php echo ucwords($name); ?>)</a></li>
								<li><a href="view-all-tickets">View All Tickets</a></li>
							</ul>
						</li>
						<li class="compact-hide active">
							<a href="view-all-report" class="waves-effect  waves-light">
								<span class="s-icon"><i class="ti-pulse"></i></span>
								<span class="s-text">View All Report</span>
							</a>
						</li>
						<li class="with-sub compact-hide active">
							<a href="javascript: void(0);" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-calendar"></i></span>
								<span class="s-text">Daily Report SEO</span>
							</a>
							<ul style="display: block;">
							    <li class="with-sub compact-hide active">
								<a href="javascript: void(0);" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down pull-right"></i></span>								
								<span class="s-text">Report Submission</span>
							    </a>
								<ul style="display: block;">
								<li><a href="developer-report">Report Entry</a></li>
								<li><a href="view-report">View Report</a></li>	
								</ul>
								</li>
							</ul>
						</li>
						<li>
							<a href="logout" class="waves-effect  waves-light">
							<span class="s-icon"><i class="ti-lock"></i></span>
							<span class="s-text">Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- Template options -->
			

			<!-- Header -->
			<div class="site-header">
				<nav class="navbar navbar-light">
					<div class="navbar-left">
						<a class="navbar-brand" href="index">
							<div class="logo"></div>
						</a>
						<div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
							<span class="hamburger"></span>
						</div>
						<div class="toggle-button-second dark float-xs-right hidden-md-up">
							<i class="ti-arrow-left"></i>
						</div>
						<div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
							<span class="more"></span>
						</div>
					</div>
					<div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
						<div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down">
							<span class="hamburger"></span>
						</div>
						<div class="toggle-button-second light float-xs-right hidden-sm-down">
							<i class="ti-arrow-left"></i>
						</div>
						<ul class="nav navbar-nav float-md-right">
							
							<li class="nav-item dropdown hidden-sm-down">
								<?php
$stmt = $reg_user->runQuery("SELECT * FROM tbl_admin_customers WHERE id = '".$_SESSION['userSession']."' ");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
{ ?>
								<a href="#" data-toggle="dropdown" aria-expanded="false">
									<!--<span class="avatar box-32">
										<img src="uploads/profilepic/<?php echo $stmt1->cusPic; ?>" alt="">
									</span>-->
									<span class="avatar box-32 name">
									<?php echo $stmt1->cusFname[0]; ?>
									</span>
								</a><?php } ?>
								<div class="dropdown-menu dropdown-menu-right animated fadeInUp">
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="logout"><i class="ti-power-off mr-0-5"></i> Sign out</a>
								</div>
							</li>
							
						</ul>
						<ul class="nav navbar-nav">
							<li class="nav-item hidden-sm-down">
								<a class="nav-link toggle-fullscreen" href="#">
									<i class="ti-fullscreen"></i>
								</a>
							</li>
							<li class="nav-item dropdown hidden-sm-down">
								<a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
									<i class="ti-layout-grid3"></i>
								</a>
								<div class="dropdown-apps dropdown-menu animated fadeInUp">
									<div class="a-grid">
										<div class="row row-sm">
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/dropbox.png" alt=""></div>
														<div class="ai-title">Dropbox</div>
													</a>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/github.png" alt=""></div>
														<div class="ai-title">Github</div>
													</a>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/wordpress.png" alt=""></div>
														<div class="ai-title">Wordpress</div>
													</a>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/gmail.png" alt=""></div>
														<div class="ai-title">Gmail</div>
													</a>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/drive.png" alt=""></div>
														<div class="ai-title">Drive</div>
													</a>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/dribbble.png" alt=""></div>
														<div class="ai-title">Dribbble</div>
													</a>
												</div>
											</div>
										</div>
									</div>
									<a class="dropdown-more" href="#">
										<strong>View all apps</strong>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
            
            <script>jQuery("#infor").delay(6000).fadeOut("slow");</script>
			<?php } ?>
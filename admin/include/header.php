<!DOCTYPE html>
<html lang="en">
<head>
<meta name="keywords" content="" />
<meta name="author" content="">
<meta name="robots" content="noindex, nofollow" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://use.fontawesome.com/ef3000c315.js"></script>
<style>.raisetick {position: fixed;right: 100px;top: 0px;z-index: 9999;width: 120px;}.raisetick img {width: 120px;}div#infor { position: fixed;right: 0;background: #fff;top: 60px;}</style>
<?php include 'style.php'; ?>
	</head>
	<body class="fixed-sidebar fixed-header skin-default content-appear">
		<div class="wrapper"> 
			<!-- Preloader -->
			<div class="preloader"></div>
			<!-- Sidebar -->
			<div class="site-overlay"></div>
			<?php
			if(isset($_SESSION['userSession'])) {
			require_once 'class.user.php';
			$user = new User();
			$stmt = $user->runQuery("SELECT * FROM tbl_admin_customers WHERE id='".$_SESSION["userSession"]."'");
			$stmt->execute();
			for($i=0; $stmt1 = $stmt->fetchObject(); $i++){
			$name = $stmt1->name; 
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
						<li class="menu-title">CABLE</li>
						<li class="with-sub">
							<a class="waves-effect waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-shopping-cart"></i></span>
								<span class="s-text">User</span>
							</a>
							<ul>
							    <li><a href="/cable-user-list">Cable User List</a></li>
							    <li><a href="/free-cable-user-list">Free Cable User List</a></li>
							    <li><a href="/search-cable-user">Search User</a></li>
							    <li><a href="/create-new-cable-user">Create New User</a></li>
							    <li><a href="/add-cable-user-from-excel">Add New User from Excel</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-view-grid"></i></span>
								<span class="s-text">Cable Packages</span>
							</a>
							<ul>
							    <li><a href="/all-packages">View Cable Packages</a></li>
							    <li><a href="/add-new-cable-package">Add New Packages</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-shopping-cart-full"></i></span>
								<span class="s-text">Channels</span>
							</a>
							<ul>
							    <li><a href="/channel-packages-list">View Channels</a></li>
							    <li><a href="/add-new-channels">Add New Channels</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-gallery"></i></span>
								<span class="s-text">Transactions</span>
							</a>
							<ul>
							    <li><a href="/cable-transaction-list">View Cable Payments</a></li>
							    <li><a href="/add-cable-payment-list">Add Payment</a></li>
							    <li><a href="/add-cable-payment-from-excel">Add Payment from Excel</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-pencil-alt"></i></span>
								<span class="s-text">Request</span>
							</a>
							<ul>
							    <li><a href="/view-new-connection">View New Connetion Requests</a></li>
							</ul>
						</li>
						<li class="menu-title">BROADBAND</li>
						<li class="with-sub">
							<a class="waves-effect waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-shopping-cart"></i></span>
								<span class="s-text">User List</span>
							</a>
							<ul>
							    <li><a href="/broadband-enet-user-list">ENET User List</a></li>
							    <li><a href="/broadband-ttn-user-list">TTN User List</a></li>
							    <li><a href="/broadband-user-list">All Broadband User List</a></li>
							    <li><a href="/search-broadband-user">Search User</a></li>
							    <li><a href="/create-new-broadband-user">Create New User</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-world"></i></span>
								<span class="s-text">Internet Pack</span>
							</a>
							<ul>
							    <li><a href="/internet-pack-list">View Internet Packs</a></li>
							    <li><a href="/add-internet-pack">Add Internet Pack</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-pencil-alt"></i></span>
								<span class="s-text">Network Type</span>
							</a>
							<ul>
							    <li><a href="/network-type">View Network Types</a></li>
							    <li><a href="/add-network-type">Add Network Type</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-gallery"></i></span>
								<span class="s-text">Transactions</span>
							</a>
							<ul>
							    <li><a href="/broadband-transaction-list">View Broadband Payments</a></li>
							    <li><a href="/add-broadband-payment-list">Add Payment</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-pencil-alt"></i></span>
								<span class="s-text">Request</span>
							</a>
							<ul>
							    <li><a href="/view-new-connection">View New Connetion Requests</a></li>
							</ul>
						</li>
						
						<li class="menu-title">SALES</li>
						<li class="with-sub">
							<a class="waves-effect waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-shopping-cart"></i></span>
								<span class="s-text">Sales Details</span>
							</a>
							<ul>
							    <li><a href="/view-sales-status-today">View Sales Status Today</a></li>
							    <li><a href="/add-work-to-salesman">Add work to Salesman</a></li>
							    <li><a href="/view-sales-all-work">View All Work</a></li>
							</ul>
						</li>
						
						<li class="menu-title">Accounts</li>
						<li class="with-sub">
							<a class="waves-effect waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-pencil-alt"></i></span>
								<span class="s-text">View Logged User</span>
							</a>
							<ul>
							    <li><a href="/logged-user-list">View Logged User list</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-pencil-alt"></i></span>
								<span class="s-text">Admin</span>
							</a>
							<ul>
							    <li><a href="/view-admin-list">View Admin List</a></li>
							    <li><a href="/add-new-admin">Add New Admin A/C</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-pencil-alt"></i></span>
								<span class="s-text">Sales</span>
							</a>
							<ul>
							    <li><a href="/view-sales-list">View Sales List</a></li>
							    <li><a href="/add-new-salesman">Add New Salesman A/C</a></li>
							</ul>
						</li>
						<li class="menu-title">Complaints and Request</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-pencil-alt"></i></span>
								<span class="s-text">Request and Complaints</span>
							</a>
							<ul>
							    <li><a href="/view-new-connection">View New Connetion Requests</a></li>
							    <li><a href="/view-user-complaints">View User Complaints</a></li>
							    <li><a href="/view-forgot-password">Forgot Password Requests</a></li>
							    <li><a href="/add-user-complaints">Add New Complaints</a></li>
							    <li><a href="/view-contact-requests">View Contact Requests</a></li>
							</ul>
						</li>
						<li>
							<a href="/logout" class="waves-effect  waves-light">
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
						<a class="navbar-brand" href="/">
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
						
						<ul class="nav navbar-nav float-md-right">
							<li class="nav-item dropdown hidden-sm-down">
								<?php
                                $stmt = $reg_user->runQuery("SELECT * FROM tbl_admin_customers WHERE id = '".$_SESSION['userSession']."' ");
                                $stmt->execute();
                                for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                                { ?>
								<a href="#" data-toggle="dropdown" aria-expanded="false">
									<span class="avatar box-32 name">
									<?php echo $stmt1->name[0]; ?>
									</span>
								</a><?php } ?>
								<div class="dropdown-menu dropdown-menu-right animated fadeInUp">
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="logout"><i class="ti-power-off mr-0-5"></i> Sign out</a>
								</div>
							</li>
						</ul>
						
						<div class="notification light color-white float-xs-right">
						    <a href="/notification">
						    <?php
						    $stmt_not = $reg_user->runQuery("SELECT count(*) as count FROM notification WHERE status='2'");
                            $stmt_not->execute();
                            for($i=0; $stmt_not1 = $stmt_not->fetchObject(); $i++){
                                    echo "<span class='count count".$stmt_not1->count."'>".$stmt_not1->count."</span>";
                                }
						    ?>
							<i class="fa fa-bell"></i>
							</a>
						</div>
						
						
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
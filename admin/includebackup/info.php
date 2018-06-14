<?php 
ob_start();
if (!isset($_SESSION['userSession'])) {
	header('location:login');
}
include("header.php");?>
<?php
$stmt = $reg_user->runQuery("SELECT * FROM tbl_admin_customers WHERE id = '".$_SESSION['userSession']."' ");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
{ ?>
			<div class="site-content">
				<!-- Content -->
				<div class="content-area pb-1">
					<div class="profile-header mb-1">
						<div class="profile-header-cover img-cover" ><img src="uploads/bannerpic/<?php echo $stmt1->cusBannerpic; ?>" /> </div>
					</div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-4 col-md-3">
								<div class="card profile-card">
									<div class="profile-avatar">
										<img src="uploads/profilepic/<?php echo $stmt1->cusPic; ?>" alt="">
									</div>
									<div class="card-block">
										<h4 class="mb-0-25"><?php echo $stmt1->cusFname; ?></h4>
										<div class="text-muted mb-1">Software Engineer</div>							
									</div>
									<ul class="list-group">
										<a class="list-group-item" href="#">
											<i class="ti-world mr-0-5"></i> example.com
										</a>
										<a class="list-group-item" href="#">
											<i class="ti-facebook mr-0-5"></i> facebook.com/example
										</a>
										<a class="list-group-item" href="#">
											<i class="ti-twitter mr-0-5"></i> twitter.com/example
										</a>
									</ul>
								</div>
								<div class="card">
									<div class="card-header text-uppercase"><b>Who to follow</b></div>
									<div class="items-list">
										<div class="il-item">
											<a class="text-black" href="#">
												<div class="media">
													<div class="media-left">
														<div class="avatar box-48">
															<img class="b-a-radius-circle" src="img/avatars/1.jpg" alt="">
															<i class="status bg-success bottom right"></i>
														</div>
													</div>
													<div class="media-body">
														<h6 class="media-heading">John Doe</h6>
														<span class="text-muted">Software Engineer</span>
													</div>
												</div>
												<div class="il-icon"><i class="fa fa-angle-right"></i></div>
											</a>
										</div>
										<div class="il-item">
											<a class="text-black" href="#">
												<div class="media">
													<div class="media-left">
														<div class="avatar box-48">
															<img class="b-a-radius-circle" src="img/avatars/2.jpg" alt="">
															<i class="status bg-danger bottom right"></i>
														</div>
													</div>
													<div class="media-body">
														<h6 class="media-heading">John Doe</h6>
														<span class="text-muted">Software Engineer</span>
													</div>
												</div>
												<div class="il-icon"><i class="fa fa-angle-right"></i></div>
											</a>
										</div>
										<div class="il-item">
											<a class="text-black" href="#">
												<div class="media">
													<div class="media-left">
														<div class="avatar box-48">
															<img class="b-a-radius-circle" src="img/avatars/3.jpg" alt="">
															<i class="status bg-secondary bottom right"></i>
														</div>
													</div>
													<div class="media-body">
														<h6 class="media-heading">John Doe</h6>
														<span class="text-muted">Software Engineer</span>
													</div>
												</div>
												<div class="il-icon"><i class="fa fa-angle-right"></i></div>
											</a>
										</div>
									</div>
									<div class="card-block">
										<button type="submit" class="btn btn-primary btn-block">Show more</button>
									</div>
								</div>
								<div class="box bg-white">
									<ul class="nav nav-4">
										<li class="nav-item">
											<a class="nav-link" href="#">
												<i class="ti-home"></i> My Profile
												<div class="tag tag-warning float-xs-right">14</div>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">
												<i class="ti-pulse"></i> Balance
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">
												<i class="ti-wallet"></i> Friends
												<div class="tag tag-purple float-xs-right">14</div>
											</a>
										</li>
										<li class="nav-item b-b-0">
											<a class="nav-link" href="#">
												<i class="ti-help-alt"></i> Settings
											</a>
										</li>
									</ul>
								</div>
								<div class="box bg-info mb-0">
									<div class="box-block">
										<div class="media">
											<div class="media-left">
												<div class="avatar box-48">
													<img class="b-a-radius-circle" src="img/avatars/4.jpg" alt="">
												</div>
											</div>
											<div class="media-body">
												<h6 class="media-heading mt-0-5"><a class="text-white mr-1" href="#">John Doe</a></h6>
												<div class="font-90 mb-0-5">Software Engineer</div>
												<button type="button" class="btn btn-outline-white btn-rounded">Accept</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-8 col-md-9">
								<form class="card write-something">
									<textarea placeholder="What's new?"></textarea>
									<div class="card-footer">
										<div class="clearfix">
											<div class="float-xs-left">
												<a href="#" class="text-primary" data-toggle="tooltip" data-placement="bottom" title="Attach image"><i class="ti-image"></i></a>
												<a href="#" class="text-primary" data-toggle="tooltip" data-placement="bottom" title="Attach video"><i class="ti-video-clapper"></i></a>
												<a href="#" class="text-primary" data-toggle="tooltip" data-placement="bottom" title="Attach audio"><i class="ti-music-alt"></i></a>
											</div>
											<div class="float-xs-right">
												<button type="submit" class="btn btn-success btn-rounded">Publish</button>
											</div>
										</div>
									</div>
								</form>
								<div class="card mb-0">
									<ul class="nav nav-tabs nav-tabs-2 profile-tabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#stream" role="tab">Stream</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#photos" role="tab">Photos</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#friends" role="tab">Friends</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="stream" role="tabpanel">
											<div class="media stream-item">
												<div class="media-left">
													<div class="avatar box-64">
														<img class="b-a-radius-circle" src="img/avatars/5.jpg" alt="">
													</div>
												</div>
												<div class="media-body">
													<h6 class="media-heading">
														<a class="text-black" href="#">John Doe</a>
														<span class="font-90 text-muted">posted an update</span>
													</h6>
													<span class="font-90 stream-meta">Active 14 minute ago</span>
													<div class="stream-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae neque incidunt cumque, dolore eveniet porro asperiores itaque! Eligendi minus cupiditate molestiae praesentium, facilis, neque saepe, soluta sapiente aliquid modi sunt.</p>
													</div>
												</div>
											</div>
											<div class="media stream-item">
												<div class="media-left">
													<div class="avatar box-64">
														<img class="b-a-radius-circle" src="img/avatars/6.jpg" alt="">
													</div>
												</div>
												<div class="media-body">
													<h6 class="media-heading">
														<a class="text-black" href="#">Adam Khaury</a>
														<span class="font-90 text-muted">posted an update</span>
													</h6>
													<span class="font-90 stream-meta">Active 25 minutes ago</span>
													<div class="stream-body">
														<a href="img/1.html">
															<img class="stream-img" src="img/photos-1/2.jpg" alt="">
														</a>
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae neque incidunt cumque, dolore eveniet porro asperiores itaque! Eligendi minus cupiditate molestiae praesentium, facilis, neque saepe, soluta sapiente aliquid modi sunt.</p>
													</div>
												</div>
											</div>
											<div class="media stream-item">
												<div class="media-left">
													<div class="avatar box-64">
														<img class="b-a-radius-circle" src="img/avatars/7.jpg" alt="">
													</div>
												</div>
												<div class="media-body">
													<h6 class="media-heading">
														<a class="text-black" href="#">Dani Smith</a>
														<span class="font-90 text-muted">has birthday</span>
													</h6>
													<span class="font-90 stream-meta">Active now</span>
													<div class="stream-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae neque incidunt cumque, dolore eveniet porro asperiores itaque! Eligendi minus cupiditate molestiae praesentium, facilis, neque saepe, soluta sapiente aliquid modi sunt.</p>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane card-block" id="photos" role="tabpanel">
											<div class="gallery-2 row">
												<div class="col-md-4 col-sm-6 col-xs-6">
													<div class="g-item">
														<a href="img/photos-1/1.jpg">
															<img src="img/photos-1/1.jpg" alt="">
														</a>
														<div class="g-item-overlay clearfix">
															<div class="float-xs-left">
																<a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-heart mr-0-5"></i>105</a>
															</div>
															<div class="float-xs-right">
																<a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-comment mr-0-5"></i>20</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4 col-sm-6 col-xs-6">
													<div class="g-item">
														<a href="img/photos-1/2.jpg">
															<img src="img/photos-1/2.jpg" alt="">
														</a>
														<div class="g-item-overlay clearfix">
															<div class="float-xs-left">
																<a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-heart mr-0-5"></i>105</a>
															</div>
															<div class="float-xs-right">
																<a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-comment mr-0-5"></i>20</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4 col-sm-6 col-xs-6">
													<div class="g-item">
														<a href="img/photos-1/3.jpg">
															<img src="img/photos-1/3.jpg" alt="">
														</a>
														<div class="g-item-overlay clearfix">
															<div class="float-xs-left">
																<a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-heart mr-0-5"></i>105</a>
															</div>
															<div class="float-xs-right">
																<a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-comment mr-0-5"></i>20</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane card-block" id="friends" role="tabpanel">
											<div class="row">
												<div class="col-xs-12 col-sm-6">
													<div class="box box-block mb-1">
														<div class="media">
															<div class="media-left">
																<div class="avatar box-48">
																	<img class="b-a-radius-circle" src="img/avatars/8.jpg" alt="">
																	<i class="status bg-success bottom right"></i>
																</div>
															</div>
															<div class="media-body">
																<h6 class="media-heading mt-0-5"><a class="text-black" href="#">John Doe</a></h6>
																<span class="font-90 text-muted">Software Engineer</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="box box-block mb-1">
														<div class="media">
															<div class="media-left">
																<div class="avatar box-48">
																	<img class="b-a-radius-circle" src="img/avatars/9.jpg" alt="">
																	<i class="status bg-success bottom right"></i>
																</div>
															</div>
															<div class="media-body">
																<h6 class="media-heading mt-0-5"><a class="text-black" href="#">John Doe</a></h6>
																<span class="font-90 text-muted">Software Engineer</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="box box-block mb-1">
														<div class="media">
															<div class="media-left">
																<div class="avatar box-48">
																	<img class="b-a-radius-circle" src="img/avatars/10.jpg" alt="">
																	<i class="status bg-success bottom right"></i>
																</div>
															</div>
															<div class="media-body">
																<h6 class="media-heading mt-0-5"><a class="text-black" href="#">John Doe</a></h6>
																<span class="font-90 text-muted">Software Engineer</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="box box-block">
														<div class="media">
															<div class="media-left">
																<div class="avatar box-48">
																	<img class="b-a-radius-circle" src="img/avatars/1.jpg" alt="">
																	<i class="status bg-success bottom right"></i>
																</div>
															</div>
															<div class="media-body">
																<h6 class="media-heading mt-0-5"><a class="text-black" href="#">John Doe</a></h6>
																<span class="font-90 text-muted">Software Engineer</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php } ?>
<?php include("footer.php"); ?>
		
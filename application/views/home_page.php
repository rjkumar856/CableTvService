<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('common/header.php');
?>
<style>
.my-slider-home{display:inline-block; width:100%;position:relative;height:auto;}
.my-slider-home #slides_control > div{height: 200px;}
.my-slider-home #slides_control img{margin:auto;width: 100%;}
.my-slider-home #slides_control {position:relative;width: 100%;}
.my-slider-home .carousel-indicators li{font-size:0;line-height:0;display: inline-block;position:relative;width:20px;height:20px;margin: 2px;text-indent: 0;padding:5px;border-radius:4px;cursor:pointer;color:transparent;border:1px solid #fff;outline:0;background:transparent}
.my-slider-home .carousel-indicators li:hover,.my-slider-home .carousel-indicators li:focus{outline:0}
.my-slider-home .carousel-indicators li:hover:before,.my-slider-home .carousel-indicators li:focus:before{opacity:1}
.my-slider-home .carousel-indicators li:before{font-family: FontAwesome;content: "\f0c8";font-size: 14px;line-height: 18px;position: absolute;top: 0;left: 0;
width: 19px;height: 20px;text-align: center;margin: 0;opacity: 1;color: #fff;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
.my-slider-home .carousel-indicators li.active:before{opacity:.75;color:#12a1e1}
.my-slider-home a.carousel-control {cursor: pointer;}
.carousel-control .icon-next, .carousel-control .icon-prev {width: 50px;height: 50px;margin-top: -25px;font-size: 50px;}
</style>
<section class="my-slider-home">
         <div id="slides_control">
                <div>
                  <carousel interval="myInterval">
                    <slide ng-repeat="slide in slides" active="slide.active">
                      <img ng-src="{{slide.image}}">
                      <div class="carousel-caption">
                        <h4>Slide {{$index+1}}</h4>
                      </div>
                    </slide>
                  </carousel>
                </div>
        </div>
</section>
      
      <section class="services">
         <div class="container">
            <h3 class="head-in modtitle">Our Services</h3>
         </div>
         <div class="wrapper">
            <div class="col-md-6 col-lg-6 col-xs-12 service-sub red left">
               <div class="text">
                  <h2>Broadband</h2>
                  <h4 class="sub-text">Since, internet users are increasing day by day, we are focusing on providing unparalleled services to the customers.</h4>
                  <a href="/internet-packs">Learn More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
               </div>
               <div class="table-responsive gcn-table bussiness">
                  <table>
                     <tr>
                        <td>
                           <a href="/internet-packs">
                              <h4>Broadband</h4>
                              <h4>Network</h4>
                              </a>
                        </td>
                        <td><a href="/internet-packs"><i class="fa fa-wifi fa-3x" aria-hidden="true"></i></a></td>
                     </tr>
                  </table>
               </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xs-12 service-sub grey right">
            <div class="text">
            <h2>High Definition Cable TV</h2>
            <h4 class="sub-text">Are you bored of watching your favorite shows with so many interruptions? Now don’t worry about it.</h4>	
            <a href="/cable-pack">Learn More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            </div>								
            <div class="table-responsive gcn-table bussiness">
            <table>
            <tr>
            <td>
            <a href="/cable-pack"><h4>High Definition Cable TV</h4>
            <h4>Network</h4></a>
            </td>
            <td><a href="/cable-pack"><i class="fa fa-television fa-3x" aria-hidden="true"></i></a></td>
            </tr>
            </table>
            </div>
            </div>		
         </div>
      </section>
      <section id="provide-gcn">
         <div class="container">
            <div class="row">
               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                     <div class="flipper">
                        <div class="front">
                           <div class="front-ele">
                              <P><i class="fa fa-sitemap fa-5x" aria-hidden="true"></i></P>
                              <h4>ENET</h4>
                           </div>
                        </div>
                        <div class="back">
                           <div class="back-ele">
                              <h4>ENET</h4>
                              <p>We use fiber net instead of copper cable or DSL cable in order to provide you faster internet than ever.</p>
                              <a href="/internet-packs">View Packs <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                     <div class="flipper">
                        <div class="front">
                           <div class="front-ele">
                              <P><i class="fa fa-cloud-download fa-5x" aria-hidden="true"></i></P>
                              <h4>TTN</h4>
                           </div>
                        </div>
                        <div class="back">
                           <div class="back-ele">
                              <h4>TTN</h4>
                              <p>We at World Vision Cable provide you with unlimited internet at a huge speed without any throttling speed at any fair usage policy.</p>
                              <a href="/internet-packs">View Packs <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                     <div class="flipper">
                        <div class="front">
                           <div class="front-ele">
                              <P><i class="fa fa-envelope-o fa-5x" aria-hidden="true"></i></P>
                              <h4>Best Plans</h4>
                           </div>
                        </div>
                        <div class="back">
                           <div class="back-ele">
                              <h4>Enquiry</h4>
                              <p>We have Best Plans for Cable TV, Broadband and Internet Connections at an Affordable Price.</p>
                              <a href="/contact-us">Contact us <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      
      <section id="benefits-area" class="background_blue_section">
         <div class="container">
            <div class="row benifits_section-content">
               <div class="benifits_margin" >
						<h3 class="kc_title">Benefits of <span>World Vision Cable</span> is Speed & Simply Better</h3>
				</div>
            </div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="benefits_img_align_center">
					<img width="104" height="104" src="assets/images/bundle.png" class="" alt="bundle" />
				</div>
				<h4 class="benefits_img_text">Bundle Your Pack</h4>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="benefits_img_align_center">
					<img width="104" height="104" src="assets/images/super-speed.png" class="" alt="super-speed" />
				</div>
				<h4 class="benefits_img_text">Super-Fast Speeds</h4>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="benefits_img_align_center">
					<img width="104" height="104" src="assets/images/wifi.png" class="" alt="wifi" />
				</div>
				<h4 class="benefits_img_text">Broadband Network</h4>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="benefits_img_align_center">
					<img width="104" height="104" src="assets/images/customize.png" class="" alt="customize" />
				</div>
				<h4 class="benefits_img_text">Customise Package</h4>
			</div>
         </div>
      </section>
      
    <section class="banner-container12 trend-container">
         <div class="container" >
            <div class="module tab-slider titleLine">
               <h3 class="modtitle">Internet Packs</h3>
               <div id="so_listing_tabs_1" class="so-listing-tabs first-load module">
                  <div class="loadeding"></div>
                  <div class="ltabs-wrap">
                     <div class="ltabs-tabs-container" data-delay="300" data-duration="600" data-effect="starwars" data-ajaxurl="" data-type_source="0">
                        <div class="ltabs-tabs-wrap">
                           <span class="ltabs-tab-selected">Enet</span><span class="ltabs-tab-arrow">▼</span>
                           <div class="item-sub-cat">
                              <ul class="ltabs-tabs cf">
                                  
                                 <li class="ltabs-tab tab-sel" data-category-id="20" data-active-content=".items-category-20" title="Enet"><span class="ltabs-tab-label">Enet</span></li>
                                 <li class="ltabs-tab " data-category-id="17" data-active-content=".items-category-17" title="TTN"><span class="ltabs-tab-label">TTN</span></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="ltabs-items-container productinfo">
                        <!--Begin Items-->
                        <div class="ltabs-items ltabs-items-selected items-category-20 grid" data-total="50">
                           <div class="ltabs-items-inner ltabs-slider">
                            <?php foreach($internet_packages['Enet Network'] as $key=>$value){ ?>
                              <div class="ltabs-item product-layout">
                                 <div class="product-item-container ">
                                    <div class="left-block">
                                       <h2><?php echo $value['Speed']."-".$value['Data_Transfer']."@Rs.".$value['Traiff']; ?></h2>
                                       <div class="post-price">
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-globe" aria-hidden="true"></i>
                                             <p><strong><?php echo $value['Speed']; ?></strong> <br>Speed</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-wifi" aria-hidden="true"></i>
                                             <p><strong><?php echo $value['Data_Transfer']; ?></strong> <br>FUP Limit</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-internet-explorer" aria-hidden="true"></i>
                                             <p><strong><?php echo $value['After_Fup']; ?></strong> <br>After FUP</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-inr" aria-hidden="true"></i>
                                             <p><strong>Rs.<?php echo $value['Traiff']; ?></strong> <br>Traiff</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-calculator" aria-hidden="true"></i>
                                             <p><strong>Rs.<?php echo $value['GST']; ?></strong> <br>GST(18%)</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-inr" aria-hidden="true"></i>
                                             <p><strong>Rs.<?php echo $value['Total']; ?></strong> <br>Total Amount</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-calendar" aria-hidden="true"></i>
                                             <p><strong><?php echo $value['Validity']; ?></strong> <br>Validity</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-map-marker" aria-hidden="true"></i>
                                             <p><strong>Bangalore</strong> <br>City</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                           </div>
                        </div>
                        
                        <div class="ltabs-items items-category-17 grid" data-total="50">
                           <div class="ltabs-items-inner ltabs-slider ">
                               <?php
                            foreach($internet_packages['TTN Network'] as $key=>$value){ ?>
                              <div class="ltabs-item product-layout">
                                 <div class="product-item-container ">
                                    <div class="left-block">
                                       <h2><?php echo $value['Speed']."-".$value['Data_Transfer']."@Rs.".$value['Traiff']; ?></h2>
                                       <div class="post-price">
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-globe" aria-hidden="true"></i>
                                             <p><strong><?php echo $value['Speed']; ?></strong> <br>Speed</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-wifi" aria-hidden="true"></i>
                                             <p><strong><?php echo $value['Data_Transfer']; ?></strong> <br>FUP Limit</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-internet-explorer" aria-hidden="true"></i>
                                             <p><strong><?php echo $value['After_Fup']; ?></strong> <br>After FUP</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-inr" aria-hidden="true"></i>
                                             <p><strong>Rs.<?php echo $value['Traiff']; ?></strong> <br>Traiff</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-calculator" aria-hidden="true"></i>
                                             <p><strong>Rs.<?php echo $value['GST']; ?></strong> <br>GST(18%)</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-inr" aria-hidden="true"></i>
                                             <p><strong>Rs.<?php echo $value['Total']; ?></strong> <br>Total Amount</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-calendar" aria-hidden="true"></i>
                                             <p><strong><?php echo $value['Validity']; ?></strong> <br>Validity</p>
                                          </div>
                                          <div class="inner-details col-xs-6">
                                             <i class="fa fa-map-marker" aria-hidden="true"></i>
                                             <p><strong>Bangalore</strong> <br>City</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                     <!--End Items-->
                  </div>
               </div>
            </div>
         </div>
      </section>
      
      <section class="home-about">
         <div class="container">
            <h3 class="head-in modtitle">ABOUT US</h3>
            <div id="container">
               <div class="wrapper welcome-content ">
                  <div class="row">
                     <div class="col-md-12 col-lg-12">
                        <h3 class="head-fiber-joy">Welcome to World Vision Cable Network</h3>
                        <p class="about-gcn">World Vision Cable is a pioneer internet and Cable network provider in Bangalore. 
                        Our motto is to become a seamless service provider across the city both for businesses and home at various levels of internet speed. 
                        Our fiber net cable is our core strength that is responsible for high speed internet and Cable TV services to our users.</p>
                        <br>
                        <p class="about-gcn">We have few USPs that will attract you to our amazing superfast services.</p>
                        <h4 class="head-h4">Finest services</h4>
                        <p class="about-gcn">We offer High Definition Cable TV services along with lightening speed internet only for you.</p>
                        <div class="kc-cta-button"><a href="/about-us">About US</a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      
      <section id="start-now">
         <div class="container-fluid background_blue_section">
            <div class="row">
				<div class="container">
					<div class="row happy_cus_section-content">
						  <div class="col-sm-3">
								<div class="kc_counter_box">
								   <i class="mn-icon-380 element-icon"></i>	<span class="counterup">1000+</span>
								   <h4>Happy Customers</h4>
								</div>
						  </div>
						  <div class="col-sm-3">
								<div class="kc_counter_box">
								   <i class="mn-icon-1103 element-icon"></i>	<span class="counterup">20+</span>
								   <h4>Support Services</h4>
								</div>
						  </div>
						  <div class="col-sm-3">
								<div class="kc_counter_box">
								   <i class="mn-icon-776 element-icon"></i>	<span class="counterup">50+</span>
								   <h4>Areas Coverage</h4>
								</div>
						  </div>
						  <div class="col-sm-3">
								<div class="kc_counter_box">
								   <i class="mn-icon-1225 element-icon"></i>	<span class="counterup">10+</span>
								   <h4>Awards Winning </h4>
								</div>
						  </div>
					</div>
				</div>
			</div>
         </div>
      </section>
      
      <section id="footer-map">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-12">
                  <div id="map"></div>
               </div>
               
               <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="row">
                     <div class="col-lg-12">
                        <h3 class="footprint-heading"><i class="fa fa-map-marker fa-2x" aria-hidden="true"></i> Cable Network in Bangalore</h3>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-3 col-xs-6 text-center">
                        <img src="assets/images/teacherscolony.jpg" alt="Teachers Colony" title="Teachers Colony" class="img-responsive location-img">
                        <h3 class="loc-name">Teachers Colony</h3>
                     </div>
                     <div class="col-md-3 col-xs-6">
                        <img src="assets/images/venkatapura.jpg" alt="Venkatapura" title="Venkatapura" class="img-responsive location-img">
                        <h3 class="loc-name">Venkatapura</h3>
                     </div>
                     <div class="col-md-3 col-xs-12">
                        <img src="assets/images/hsr layout.jpg" alt="HSR 5th & 6th Sector" title="HSR 5th & 6th Sector" class="img-responsive location-img">
                        <h3 class="loc-name">HSR 5th & 6th Sector</h3>
                     </div>
                    <div class="col-md-3 col-xs-6">
                        <img src="assets/images/silkboard.jpg" alt="Silkboard" title="Silkboard" class="img-responsive location-img">
                        <h3 class="loc-name">Silkboard</h3>
                     </div>
                  </div>
               </div>
               
               
               <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="row">
                     <div class="col-lg-12">
                        <h3 class="footprint-heading"><i class="fa fa-map-marker fa-2x" aria-hidden="true"></i> Broadband Network in Bangalore</h3>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-3 col-xs-6 text-center">
                        <img src="assets/images/teacherscolony.jpg" alt="Teachers Colony" title="Teachers Colony" class="img-responsive location-img">
                        <h3 class="loc-name">Teachers Colony</h3>
                     </div>
                     <div class="col-md-3 col-xs-6">
                        <img src="assets/images/venkatapura.jpg" alt="Venkatapura" title="Venkatapura" class="img-responsive location-img">
                        <h3 class="loc-name">Venkatapura</h3>
                     </div>
                     <div class="col-md-3 col-xs-12">
                        <img src="assets/images/hsr layout.jpg" alt="HSR Layout" title="HSR Layout" class="img-responsive location-img">
                        <h3 class="loc-name">HSR Layout</h3>
                     </div>
                     <div class="col-md-3 col-xs-6 text-center">
                        <img src="assets/images/jakkasandra.jpg" alt="Jakkasandra" title="Jakkasandra" class="img-responsive location-img">
                        <h3 class="loc-name">Jakkasandra</h3>
                     </div>
                  </div>
                  <div class="row">
                     <br/>
                  </div>
                  <div class="row">
                     <div class="col-md-3 col-xs-6 text-center">
                        <img src="assets/images/koramangala.jpg" alt="Koramangala" title="Koramangala" class="img-responsive location-img">
                        <h3 class="loc-name">Koramangala</h3>
                     </div>
                     <div class="col-md-3 col-xs-6">
                        <img src="assets/images/silkboard.jpg" alt="Silkboard" title="Silkboard" class="img-responsive location-img">
                        <h3 class="loc-name">Silkboard</h3>
                     </div>
                     <div class="col-md-3 col-xs-12 hidden-xs">
                        <img src="assets/images/bommanahalli.jpg" alt="Bommanahalli" title="Bommanahalli" class="img-responsive location-img">
                        <h3 class="loc-name">Bommanahalli</h3>
                     </div>
                  </div>
               </div>
               
               
               
               
            </div>
         </div>
      </section>
	  <?php include("common/footer.php"); ?>
<script>
function initMap(){
         	var loc = {lat: 12.9135833, lng:77.609895};
         	var element = document.getElementById('map');
         	var map = new google.maps.Map(element,{
         		center: loc,
         		zoom: 13
         	});
         
         	var marker = new google.maps.Marker({
         		position: loc,
         		map: map
         	});
         }
      </script>
      <script>
         function initMap() {
           var map = new google.maps.Map(document.getElementById('map'), {
             zoom: 14,
             center: {lat: 12.9181833, lng: 77.620895}
           });

           var labels = 'ABCDEF';
         
           var markers = locations.map(function(location, i) {
             return new google.maps.Marker({
               position: location,
               label: labels[i % labels.length]
             });
           });
         
           // Add a marker clusterer to manage the markers.
           var markerCluster = new MarkerClusterer(map, markers,
               {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
         }
         
         var locations = [
           {lat: 12.9102997, lng: 77.6281508},
           {lat: 12.9006443, lng: 77.6125546},
           {lat: 12.9196489, lng: 77.6293662},
           {lat: 12.9310959, lng: 77.6239551},
           {lat: 12.9126821, lng: 77.6161538},
           {lat: 12.9034584, lng: 77.6298732}
         ]
      </script>			
      <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
      <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
      <script src="assets/js/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="assets/js/slick.min.js"></script>
      <script type="text/javascript" src="assets/js/script.js"></script>
      <script type="text/javascript" src="assets/js/owl.carousel.js"></script>
      <script type="text/javascript" src="assets/js/application.js"></script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZMjItDFU6xVLcPr9XscjG50XjADCXLQ0&amp;callback=initMap"></script>
   </body>
</html>
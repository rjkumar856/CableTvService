<?php
require_once('common/header.php');
?>
<section class="content contact-us">
		<div class="container">
		<h3>Contact Us</h3>
<div class="col-sm-8 col-xs-12 contact-left">
<div class="form">
    
<div class="alert alert-danger" style="<?php if(validation_errors()){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>"><?php if(validation_errors()){echo validation_errors();} ?></div>
<div class="alert alert-success" style="<?php if(isset($message)){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>"><?php if(isset($message)){ echo $message;} ?></div>
<div class="alert alert-success" style="<?php if($this->session->flashdata('message')){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>"><?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?></div>

<form method="POST" enctype="multipart/form-data" action="/contact-form-submission" >
<div id="contact_View_inquiry_popup_msg_container">
<div class="form-group">
<span>Full Name*</span>
<input type="text" name="inquiry_name" id="contact_inquiry_name" value="<?php if(set_value('inquiry_name')) {echo set_value('inquiry_name'); } ?>" class="input" placeholder="Full Name" required="required">
</div>
<div class="form-group">
<span>Mobile Number*</span>
<input type="text" name="inquiry_phone" id="contact_inquiry_phone" value="<?php if(set_value('inquiry_phone')) {echo set_value('inquiry_phone'); } ?>" class="input" placeholder="Mobile Number" required="required">
</div>
<div class="form-group">
<span>Email ID*</span>
<input type="text" name="inquiry_email" id="contact_inquiry_email" value="<?php if(set_value('inquiry_email')) {echo set_value('inquiry_email'); } ?>" class="input" placeholder="Email ID" required="required">
</div>
<div class="form-group">
<span>City*</span>
<select name="inquiry_city" id="contact_inquiry_city" class="input select" required="required">
    <option disabled selected value="">Select City</option>
    <option <?php if(set_value('inquiry_city')=='Bangalore'){echo "selected";} ?> value="Bangalore">Bangalore</option>
    <option <?php if(set_value('inquiry_city')=='Others'){echo "selected";} ?> value="Others">Others</option>
</select>
</div>

<div class="form-group message">
<span>Address*</span>
<textarea name="inquiry_address" id="contact_inquiry_address" class="input textarea" placeholder="Address" rows="4" required="required"><?php if(set_value('inquiry_address')) {echo set_value('inquiry_address'); } ?></textarea>
</div>
<div class="form-group message">
<span>Message*</span>
<textarea name="inquiry_message" id="contact_inquiry_message" class="input textarea" placeholder="Message" rows="4" required="required"><?php if(set_value('inquiry_message')) {echo set_value('inquiry_message'); } ?></textarea>
</div>
<div class="form-group">
<input type="submit" name="send_inquiry_to_client" class="submit" value="Send Inquiry" id="contact_send_inquiry_to_client">
</div>
</div>
</form>
</div>
</div>
<div class="col-sm-4 col-xs-12 contact-right">
    <div class="address">
                        <h4>Address</h4>
                        <p><b>World Vision Cable Network</b></p>
                        <p>#30, Teachers Colony</p>
                        <p>5th Main, Koramangala</p>
                        <p>Bangalore-560034</p>
    </div>
    <div class="phone">
                <h4>Phone</h4>
                <ul class="list-unstyled">
                    <li>+(91)-9900065533</li>
                    <li>+(91)-9900249945</li>
                    <li>080-25534744</li>
                    </ul>
                    <h4>Email</h4>
                    <p>info@worldvisioncable.in</p>   
    </div>
</div>

		</div>
	</section>
<section id="footer-map">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xs-12">
                  <div id="map"></div>
               </div>
              </div>
        </div>
</section>             
	  <?php include("common/footer.php"); ?>
      <script>
         function initMap() {
           var map = new google.maps.Map(document.getElementById('map'), {
             zoom: 18,
             center: {lat: 12.9184971, lng: 77.6321722}
           });
           // Create an array of alphabetical characters used to label the markers.
           var labels = 'A';
         
           // Add some markers to the map.
           // Note: The code uses the JavaScript Array.prototype.map() method to
           // create an array of markers based on a given "locations" array.
           // The map() method here has nothing to do with the Google Maps API.
           var contentString = "World Vision Cable Network ";
           infowindow = new google.maps.InfoWindow({ content: contentString});
           
           var markers = locations.map(function(location, i) {
             return new google.maps.Marker({
               position: location,
               map:map,
               label: "World Vision Cable Network",
               title: "World Vision Cable Network",
               icon:"/assets/images/building.png",
               infowindow:infowindow
             });
           });
         
           // Add a marker clusterer to manage the markers.
           var markerCluster = new MarkerClusterer(map, markers,
               {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
         }
         
         var locations = [
           {lat: 12.9184971, lng: 77.6321722}
         ]
      </script>
      <script src="assets/js/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="assets/js/slick.min.js"></script>
      <script type="text/javascript" src="assets/js/script.js"></script>
      <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
      
      <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZMjItDFU6xVLcPr9XscjG50XjADCXLQ0&amp;callback=initMap"></script>
   </body>
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('common/header.php');
?>
<section class="content">
		<div class="container">
		<h3>Cable Packs <small>Select a pack suiting your viewing preferences.</small></h3>
		
		<div class="container">
	<div class="tab-slider--nav col-md-6 col-sm-12">
		<?php
		echo "<ul class='tab-slider--tabs col-". count($cable_packages) ."'>";
		    $count=1;
		    foreach($cable_packages as $key=>$value){
			echo "<li class='tab-slider--trigger ";
			if($count === 1){ echo "active"; }
			echo "' rel='tab$count'>$value[name]</li>";
			$count++;
		    }
		    ?>
		</ul>
	</div>
	
	<div class="packages">
	    <div class="div"><img src="/uploads/channels/1518786279422.jpg" class="packages-img"> <p>Standard Definition Set Top Box - 1350 Rs<br/></p></div>
	    <div class="div"><img src="/uploads/channels/1518786279422.jpg" class="packages-img"> <p>High Definition PVR (with recording specility) Set Top Box - 3100 Rs</p></div>
	    <div class="div"><img src="/uploads/channels/1518786279422.jpg" class="packages-img"> <p>High Definition Digital Set Top Box - 2100 Rs</p></div>
	</div>
	
	<div class="tab-slider--container">
	    <?php
		    $count=1;
		    foreach($cable_packages as $key=>$value){ ?>
		    
		<div id="tab<?php echo $count; ?>" class="tab-slider--body">
		    <h2><?php echo $value['name']; ?> <span><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $value['price']; ?> per Month</span></h2>
		    
		    <div class="invaccordion">
		 <?php
		 $item_count=1;
		 foreach($channel_list[$value['id']] as $key_ch=>$value_ch){
		 ?>
		<div class="accordion-group nobor">
		<div class="accordion-heading">
		<a class="accordion-toggle <?php if($item_count !== 1){ echo "collapsed";} ?>" href="#collapseinvcont<?php echo $count.$item_count; ?>" data-toggle="collapse"><?php echo $key_ch; ?> <span>&nbsp;</span></a>
        </div>
            <div class="accordion-body collapse <?php if($item_count === 1){ echo "in";} ?>" id="collapseinvcont<?php echo $count.$item_count; ?>" style>
                <div class="accordion-inner">
				<?php
				foreach($value_ch as $package_values){
				echo "<div class='channel-list'><img src='/uploads/channels/$package_values[channel_image]' alt='' title='' />";
				echo "<span>".$package_values['channel_name']."</span></div>";
				} ?>
				
				<?php if($item_count == 1 && $value['id'] == "3"){ echo "<i class='fa fa-plus plus-icon'></i> <h4>Royal Package</h4>"; ?>
				
				<?php
        		 $item_count_sub=1;
        		 foreach($channel_list['2'] as $key_ch=>$value_ch){
        		 ?>
				<div class="accordion-group nobor">
            		<div class="accordion-heading">
            		<a class="accordion-toggle <?php if($item_count_sub !== 1){ echo "collapsed";} ?>" href="#collapseinvcontsub<?php echo $count.$item_count_sub; ?>" data-toggle="collapse"><?php echo $key_ch; ?> <span>&nbsp;</span></a>
                    </div>
                        <div class="accordion-body collapse <?php if($item_count_sub === 1){ echo "in";} ?>" id="collapseinvcontsub<?php echo $count.$item_count_sub; ?>" style>
                            <div class="accordion-inner">
            				<?php
            				foreach($value_ch as $package_values){
            				echo "<div class='channel-list'><img src='/uploads/channels/$package_values[channel_image]' alt='' title='' />";
            				echo "<span>".$package_values['channel_name']."</span></div>";
            				} ?>
            				</div>
                        </div>
                    </div>
				
			<?php $item_count_sub++; }
				  } ?>
				
				</div>
            </div>
        </div>
        <?php 
        $item_count++; 
        } 
        ?>
        </div>
			
		</div>
		<?php $count++; } ?>

	</div>
</div>


		
		
        </div>
		</div>
	</section>
	  <?php include("common/footer.php"); ?>
      <script src="assets/js/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="assets/js/slick.min.js"></script>
      <script type="text/javascript" src="assets/js/script.js"></script>
      <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
      <script type="text/javascript">
    $("document").ready(function(){
  $(".tab-slider--body").hide();
  $(".tab-slider--body:first").show();
});

$(".tab-slider--nav li").click(function() {
  $(".tab-slider--body").hide();
  var activeTab = $(this).attr("rel");
  $("#"+activeTab).fadeIn();
	if($(this).attr("rel") == "tab2"){
		$('.tab-slider--tabs').addClass('slide');
	}else{
		$('.tab-slider--tabs').removeClass('slide');
	}
  $(".tab-slider--nav li").removeClass("active");
  $(this).addClass("active");
});
</script>
   </body>
</html>
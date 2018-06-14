<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('common/header.php');
?>
<section class="content">
		<div class="container">
		<h3>Internet Packs <small>Select a pack suiting your viewing preferences</small></h3>
	<div class="invaccordion">
	<?php
	$item_count=1;
	foreach($internet_packages as $key=>$value){  ?>
	<div class="accordion-group nobor">
		<div class="accordion-heading">
		<a class="accordion-toggle <?php if($item_count !== 1){ echo "collapsed";} ?>" href="#collapseinvcont<?php echo $item_count; ?>" data-toggle="collapse"><?php echo $key; ?> <span>&nbsp;</span></a>
        </div>
            <div class="accordion-body collapse <?php if($item_count === 1){ echo "in";} ?>" id="collapseinvcont<?php echo $item_count; ?>" style>
                <div class="accordion-inner">
				<table>
				<thead><tr><th>Sl No.</th><th>Speed</th><th>Data Transfer</th><th>After FUB</th><th>Triff</th><th>GST(18%)</th><th>Total</th><th>Validity</th></tr></thead>
				<tbody>
				<?php
				$count=1;
				foreach($value as $package_values){
				echo "<tr>";
				echo "<td>$count</td>";
				echo "<td>".$package_values['Speed']."</td>";
				echo "<td>".$package_values['Data_Transfer']."</td>";
				echo "<td>".$package_values['After_Fup']."</td>";
				echo "<td>".$package_values['Traiff']."</td>";
				echo "<td>".$package_values['GST']."</td>";
				echo "<td>".$package_values['Total']."</td>";
				echo "<td>".$package_values['Validity']."</td>";
				echo "</tr>";
				$count++; 
				} ?>
				</tbody>
				</table>
				</div>
            </div>
        </div>
        <?php 
        $item_count++; 
        } 
        ?>
		
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
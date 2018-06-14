<?php 
ob_start();
if(isset($_GET['delete_id'])){
	$stmt = $reg_user->runQuery("DELETE FROM cable_package WHERE id=".$_GET['delete_id']);
	$stmt->execute();
	$stmt = $reg_user->runQuery("DELETE FROM channel_package WHERE cp_id=".$_GET['delete_id']);
	$stmt->execute();
	
	header("Location: /all-packages");
}
include("include/header.php");
?>
    <link rel="stylesheet" href="vendor/jsgrid/dist/jsgrid-theme.min.css">
	<link rel="stylesheet" href="vendor/DataTables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="vendor/DataTables/Responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="vendor/DataTables/Buttons/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css">
		
<div class="site-content">
				<!-- Content -->
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>View All Transanctions</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">View All Transanctions</li>
						</ol>
						<div class="box box-block bg-white">
							<h5 class="mb-1">Exporting Transanctions List Data</h5>
							<table class="table jsgrid table-striped table-bordered dataTable table-responsive" id="table-2">
								<thead>
									<tr>
										<th>USER NAME</th>
										<th>FULL NAME</th>
										<th>Network Type</th>
										<th>Package</th>
										<th>Amount</th>
										<th>mmp_txn</th>
										<th>mer_txn</th>
										<th>prod</th>
										<th>bank_txn</th>
										<th>f_code</th>
										<th>bank_name</th>
										<th>date</th>
										<th>discriminator</th>
										<th>descr</th>
										<th>Month Date</th>
										<th>month amount</th>
									</tr>
								</thead>
								<tbody>
                            <?php
                            $stmt = $reg_user->runQuery("SELECT *,wt.id as PaymentID,nt.Name as NetworkName,ip.Name as PackageName FROM wvc_transaction wt INNER JOIN user us ON us.id=wt.user_id INNER JOIN internet_pack ip ON ip.id=wt.Package_id INNER JOIN network_type nt ON nt.id=ip.Network_id LEFT JOIN user_as_smartcard ua ON ua.user_id=us.id WHERE wt.Package_type='1' ORDER BY wt.created_at DESC");
                            $stmt->execute();
                            for($i=0; $stmt1 = $stmt->fetchObject(); $i++){
                            ?><tr>
										<td><?php echo $stmt1->userid;?></td>
										<td><?php echo $stmt1->full_name;?></td>
										<td><?php echo $stmt1->NetworkName; ?></td>
										<td><?php echo ($stmt1->PackageName)?$stmt1->PackageName:$stmt1->Speed."-".$stmt1->Data_Transfer." @Rs.".$stmt1->Traiff;?></td>
										<td><?php echo $stmt1->amt;?></td>
										<td><?php echo $stmt1->mmp_txn;?></td>
										<td><?php echo $stmt1->mer_txn;?></td>
										<td><?php echo $stmt1->prod;?></td>
										<td><?php echo $stmt1->bank_txn;?></td>
										<td><?php echo $stmt1->f_code;?></td>
										<td><?php echo $stmt1->bank_name;?></td>
										<td><?php echo $stmt1->date;?></td>
										<td><?php echo $stmt1->discriminator;?></td>
										<td><?php echo $stmt1->descr;?></td>
										<td><?php echo $stmt1->month_date;?></td>
										<td><?php echo $stmt1->month_amount;?></td>
										</tr>
										<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			<script type="text/javascript" src="vendor/jquery/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="vendor/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap4/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="vendor/detectmobilebrowser/detectmobilebrowser.js"></script>
		<script type="text/javascript" src="vendor/jscrollpane/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="vendor/jscrollpane/mwheelIntent.js"></script>
		<script type="text/javascript" src="vendor/jscrollpane/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" src="vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
		<script type="text/javascript" src="vendor/waves/waves.min.js"></script>
		<script type="text/javascript" src="vendor/switchery/dist/switchery.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Responsive/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Responsive/js/responsive.bootstrap4.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Buttons/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Buttons/js/buttons.bootstrap4.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/JSZip/jszip.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/pdfmake/build/pdfmake.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/pdfmake/build/vfs_fonts.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Buttons/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Buttons/js/buttons.print.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Buttons/js/buttons.colVis.min.js"></script>

		<!-- Neptune JS -->
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="js/tables-datatable.js"></script>
		<script type="text/javascript">
function delete_id(id)
{
	if(confirm('Are You sure you want to Delete this Cable Package?'))
	{
		window.location.href='/all-packages?delete_id='+id;
	}
}
</script>
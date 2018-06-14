<?php 
ob_start();

if(isset($_GET['delete_id'])){
	$stmt = $reg_user->runQuery("DELETE FROM internet_pack WHERE id=".$_GET['delete_id']);
	$stmt->execute();
	header("Location: /internet-pack-list");
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
						<h4>Internet Packages</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/">Home</a></li>
							<li class="breadcrumb-item active">Internet Packages</li>
						</ol>
						<div class="box box-block bg-white">
							<h5 class="mb-1">Exporting Internet Package List Data</h5>
							<table class="table jsgrid table-striped table-bordered dataTable table-responsive" id="table-2">
								<thead> 
									<tr>
									    <th>OPTIONS</th>
										<th>Serial Number</th>
										<th>Name</th>
										<th>NETWORK</th>
										<th>SPEED</th>
										<th>DATA TRANSFER</th>
										<th>AFTER FUP</th>
										<th>TRAIFF</th>
										<th>GST</th>
										<th>TOTAL</th>
										<th>VALIDITY</th>
										<th>STATUS</th>
										<th>DATE ADDED</th>
										<th>DATE MODIFIED</th>
									</tr>
								</thead>
								<tbody>

                                <?php
                                $stmt = $reg_user->runQuery("SELECT * FROM internet_pack ORDER BY serial_number DESC");
                                $stmt->execute();
                                for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                                {
                                ?><tr>	
                                <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
										<a href="/edit-internet-packages?id=<?php echo $stmt1->id;?>"><button class="jsgrid-button jsgrid-edit-button" type="button" title="Edit"></button></a>
										<a href="javascript:delete_id(<?php echo $stmt1->id; ?>)"><button type="submit" class="jsgrid-button jsgrid-delete-button" href="" title="Delete" name="delete-ad"></button></a>
									</td>
										<td><?php echo $stmt1->serial_number;?></td>
										<td><?php echo $stmt1->Name;?></td>
										<td><?php
										  $stmt2 = $reg_user->runQuery("SELECT * FROM network_type WHERE id='".$stmt1->Network_id."' ");
                                            $stmt2->execute();
                                            $row = $stmt2->fetch(PDO::FETCH_ASSOC);
                                            echo $row['Name']; ?></td>
										
										<td><?php echo $stmt1->Speed;?></td>
										<td><?php echo $stmt1->Data_Transfer;?></td>
										<td><?php echo $stmt1->After_Fup;?></td>
										<td><?php echo $stmt1->Traiff;?></td>
										<td><?php echo $stmt1->GST;?>
										<td><?php echo $stmt1->Total;?></td>
										<td><?php echo $stmt1->Validity;?></td>
										<td><?php if($stmt1->status == 1){ echo "Enabled"; }else{ echo "Disabled"; } ?></td>
										<td><?php echo $stmt1->date_added;?></td>
										<td><?php echo $stmt1->date_modified;?></td>
										</tr><?php } ?>
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
	if(confirm('Are you sure you Want to Delete this Internet Pack?'))
	{
		window.location.href='/internet-pack-list?delete_id='+id;
	}
}
</script> 	 	 	
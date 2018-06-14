<?php 
ob_start();
if (!isset($_SESSION['userSession'])) {
	header('location:login');
}
if(isset($_GET['delete_id']))
{

	$stmt = $reg_user->runQuery("DELETE FROM tbl_admin_customers1 WHERE id=".$_GET['delete_id']);
	$stmt->execute(array(":id"=>$id));
	header("Location: customer-list");
}
include("include/header.php");?>


<?php
$stmt = $reg_user->runQuery("SELECT * FROM tbl_admin_customers WHERE id = '".$_SESSION['userSession']."' ");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
{ ?>
		<link rel="stylesheet" href="vendor/jsgrid/dist/jsgrid-theme.min.css">
		<link rel="stylesheet" href="vendor/DataTables/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="vendor/DataTables/Responsive/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="vendor/DataTables/Buttons/css/buttons.dataTables.min.css">
		<link rel="stylesheet" href="vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css">
		
<div class="site-content">
				<!-- Content -->
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>View Sales User List</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Sales User List</li>
						</ol>
						<div class="box box-block bg-white">
							<h5 class="mb-1">Exporting Sales User List Data</h5>
							<table class="table jsgrid table-striped table-bordered dataTable table-responsive" id="table-2">
								<thead>
									<tr>
									    <th>EDIT</th>
										<th>Name</th>
										<th>Full Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Address</th>
										<th>City</th>
										<th>Pincode</th>
										<th>STATUS<br/><span>Click to deactivate</span></th>
									</tr>
								</thead>
								<tbody>

                                   <?php
                                    $stmt = $reg_user->runQuery("SELECT *, ac.name as UserName, ci.name as CityName FROM tbl_admin_customers ac LEFT JOIN city ci ON ci.id=ac.city WHERE ac.role='2'");
                                    $stmt->execute();
                                    for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                                    {
                                    ?><tr>	
                                    <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
                                    										<a href="edit-admin-list?id=<?php echo $stmt1->id;?>"><button class="jsgrid-button jsgrid-edit-button" type="button" title="Edit"></button></a>
                                    									</td>
                                    										<td><?php echo $stmt1->user_id;?></td>
                                    										<td><?php echo $stmt1->UserName;?></td>
                                    										<td><?php echo $stmt1->email;?></td>
                                    										<td><?php echo $stmt1->mobile;?></td>
                                    										<td><?php echo $stmt1->address;?></td>
                                    										<td><?php echo $stmt1->CityName;?></td>
                                    										<td><?php echo $stmt1->pincode;?></td>
                                    										<td><?php
                                    if(($stmt1->status)=='0')
                                    {
                                    ?>
                                    <a class="btn btn-primary" href="adminuserstatusupdate?id=<?php echo $stmt1->id;?>" > Active </a>
                                    <?php
                                    }
                                    if(($stmt1->status)=='1')
                                    {
                                    ?>
                                    <a class="btn btn-primary" href="adminuserstatusupdate?id=<?php echo $stmt1->id;?>" > Deactive</a>
                                    <?php
                                    }
                                    ?></td>
										</tr><?php } ?>
									
								</tbody>
							</table>
						</div>
						
					</div>

				</div>
				<?php } ?>
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
	if(confirm('Move this AD to TRASH?'))
	{
		window.location.href='customer-list?delete_id='+id;
	}
}
</script>
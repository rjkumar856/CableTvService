<?php 
if(isset($_GET['delete_id']))
{
	$stmt = $reg_user->runQuery("DELETE FROM tbl_admin_customers WHERE id=".$_GET['delete_id']);
	$stmt->execute(array(":id"=>$id));
	header("Location: /cable-user-list");
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
						<h4>Cable User List</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Cable TV List</li>
						</ol>
						<div class="box box-block bg-white">
							<h5 class="mb-1">Exporting Cable TV List Data</h5>
							<table class="table jsgrid table-striped table-bordered dataTable table-responsive" id="table-2">
								<thead>
									<tr>
									    <th>S.No</th>
									    <th>OPTIONS</th>
										<th>SMARTCARD NUMBER</th>
										<th>FULLNAME</th>
										<th>CARDNO</th>
										<th>EMAILID</th>
										<th>PHONE</th>
										<th>ADDRESS</th>
										<th>PACKAGE</th>
										<th>DUE DATE</th>
										<th>STATUS</th>
									</tr>
								</thead>
								<tbody>

                            <?php
                            $count=1;
                            $stmt = $reg_user->runQuery("SELECT *,us.id as UsrID FROM user_has_cable uc INNER JOIN user us ON uc.user_id=us.id 
                            LEFT JOIN user_as_smartcard uas ON uas.user_id=us.id LEFT JOIN profile pr ON us.id = pr.user_id INNER JOIN cable_package cp ON uc.package_id=cp.id WHERE us.card_no='0' ORDER BY us.card_no ASC");
                            $stmt->execute();
                            for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                            {
                            ?><tr>
                                <td><?php echo $count; ?></td>
                            <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
								<a href="/edit-cable-user-details?id=<?php echo $stmt1->UsrID;?>"><button class="jsgrid-button jsgrid-edit-button" type="button" title="Edit"></button></a>
								<a href="/edit-cable-user-list?id=<?php echo $stmt1->UsrID;?>"><i class="fa fa-external-link" aria-hidden="true" title="Change Plan"></i></a>
							</td>
							            <td><?php echo $stmt1->smart_card_no; ?></td>
										<td><?php echo $stmt1->full_name;?></td>
										<td><?php echo $stmt1->card_no;
										if($stmt1->card_no){
										    echo "<br/><a href='/view-card-details?id=".$stmt1->card_no."' class='btn btn-primary' >Details</a>";
										}
										?></td>
										<td><?php echo $stmt1->email;?></td>
										<td><?php echo $stmt1->phone;?></td>
										<td><?php echo $stmt1->address_1;?></td>
										<td><?php echo $stmt1->name;?></td>
										<td><?php echo $stmt1->due_date;?></td>
										<td><?php
                                            if(($stmt1->status)=='0')
                                            {
                                            ?>
                                            <a class="btn btn-primary" href="userstatusupdate?url='cable-user-list'&id=<?php echo $stmt1->id;?>" > Active </a>
                                            <?php
                                            }
                                            if(($stmt1->status)=='1')
                                            {
                                            ?>
                                            <a class="btn btn-primary" href="userstatusupdate?url='cable-user-list'&id=<?php echo $stmt1->id;?>" > Deactive</a>
                                            <?php
                                            }
                                            ?></td>
										</tr><?php $count++; } ?>
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
	if(confirm('Move this AD to TRASH?'))
	{
		window.location.href='customer-list?delete_id='+id;
	}
}
</script>
</body>
</html>
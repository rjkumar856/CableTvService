<?php 
ob_start();
if (!isset($_SESSION['userSession'])) {
	header('location:login');
}
if(isset($_GET['delete_id']))
{

	$stmt = $reg_user->runQuery("DELETE FROM tbl_admin_customers WHERE id=".$_GET['delete_id']);
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
						<h4>View Sales Status Today</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">View Sales Status Today</li>
						</ol>
						<div class="box box-block bg-white">
							<h5 class="mb-1">Exporting View Sales Status Today List Data</h5>
							<table class="table jsgrid table-striped table-bordered dataTable table-responsive" id="table-2">
								<thead>
									<tr>
									    <th>EDIT</th>
										<th>TicketID</th>
										<th>Salesman Name (ID)</th>
										<th>Cust.Name (ID)</th>
										<th>Smartcard</th>
										<th>Due Amount</th>
										<th>STATUS</th>
										<th>Mode of Pay</th>
										<th>Collected Amount</th>
										<th>Comments</th>
										<th>Date Added</th>
									</tr>
								</thead>
								<tbody>

<?php
$stmt = $reg_user->runQuery("SELECT *,st.date_added as Ticdate_added,st.date_modified as Ticdate_modified,us.email as CustEmail,us.phone as CustPhone,ac.id as SalesID, ac.name as SalesName,st.user_id as usrID,st.id as TicketID FROM sales_tickets st 
				INNER JOIN tbl_admin_customers ac ON ac.id=st.sales_id INNER JOIN user us ON us.id=st.user_id LEFT JOIN profile pr ON pr.user_id=st.user_id LEFT JOIN user_as_smartcard uas ON uas.user_id=st.user_id
				WHERE st.date=date(NOW()) ORDER BY st.date_added DESC");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
{
?><tr>	
                <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
					<a href="edit-user-list?id=<?php echo $stmt1->id;?>"><button class="jsgrid-button jsgrid-edit-button" type="button" title="Edit"></button></a>
				</td>
				    <td><?php echo $stmt1->TicketID;?></td>
					<td><?php echo $stmt1->SalesName." (".$stmt1->SalesID.")";?></td>
					<td><?php echo $stmt1->full_name." (".$stmt1->usrID.")";?></td>
					<td><?php echo $stmt1->smart_card_no;?></td>
					<td><?php echo $stmt1->amount;?></td>
					<td><?php echo $stmt1->tickets_status;?></td>
					<td><?php echo $stmt1->mode_of_pay;?></td>
					<td><?php echo $stmt1->collected_amount;?></td>
					<td><?php echo $stmt1->comments;?></td>
					<td><?php echo $stmt1->date;?></td>
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
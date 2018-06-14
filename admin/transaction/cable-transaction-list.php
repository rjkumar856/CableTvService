<?php 
ob_start();
if(isset($_GET['delete_id']) && !empty($_GET['delete_id'])){
	$stmt = $reg_user->runQuery("DELETE FROM wvc_payment WHERE id=".$_GET['delete_id']);
	$stmt->execute();
	
	header("Location: /cable-transaction-list");
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
					    
						<h4>View All Cable Payments</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">View All Cable Payments</li>
						</ol>
						<div class="box box-block bg-white">
						    <h4>View by Date</h4>
						    <form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-5">
									<div class="form-group">
										<label><b>From Date*</b></label>
										<div class="input-group">
											<input type="text" class="form-control from_date" placeholder="From Date" name="from_date" value="<?php if(isset($_POST['from_date'])){ echo $_POST['from_date']; } ?>" required>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
									    <label><b>To Date*</b></label>
										<input type="text" class="form-control to_date" placeholder="To Date" name="to_date" value="<?php if(isset($_POST['to_date'])){ echo $_POST['to_date']; } ?>" required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group"><br>
									    <label><b> </b></label>
									<input type="submit" class="btn btn-primary" value="search" name="cus_add_new_payment">
									</div>
								</div>
							</div>
							</form>
							<br><br>
						    
							<h5 class="mb-1">Exporting Payments List Data</h5>
							<table class="table jsgrid table-striped table-bordered dataTable table-responsive" id="table-2">
								<thead>
									<tr>
									    <th>OPTIONS</th>
										<th>FULL NAME</th>
										<th>Smartcard No</th>
										<th>Payment TYPE</th>
										<th>Package Type</th>
										<th>Package ID</th>
										<th>Amount</th>
										<th>Due Date</th>
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
										<th>bb no</th>
										<th>extra</th>
									</tr>
								</thead>
								<tbody>
                            <?php
                            $query="SELECT *,wp.id as PaymentID FROM wvc_payment wp INNER JOIN user us ON us.id=wp.user_id 
                            LEFT JOIN wvc_transaction wt ON wp.transaction_id=wt.id LEFT JOIN user_as_smartcard ua ON ua.user_id=us.id INNER JOIN cable_package cp ON cp.id=wp.Package_id WHERE wp.Package_type='2' ";
                            
                            if(isset($_POST['from_date']) && isset($_POST['to_date'])){
                                $query .="AND date(wp.Date_added) BETWEEN '".$_POST['from_date']."' AND '".$_POST['to_date']."' ";
                            }
                            $query .="ORDER BY wt.created_at DESC";
                            $stmt = $reg_user->runQuery($query);
                            $stmt->execute();
                            for($i=0; $stmt1 = $stmt->fetchObject(); $i++){
                            ?><tr>	
                                <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
										<a href="/edit-cable-payment?id=<?php echo $stmt1->PaymentID;?>"><button class="jsgrid-button jsgrid-edit-button" type="button" title="Edit"></button></a>
										<a href="javascript:delete_id(<?php echo $stmt1->PaymentID; ?>)"><button type="submit" class="jsgrid-button jsgrid-delete-button" href="" title="Delete" name="delete-ad"></button></a>
									</td>
										<td><?php echo $stmt1->full_name;?></td>
										<td><?php echo $stmt1->smart_card_no;?></td>
										<td><?php echo $stmt1->Type;?></td>
										<td><?php if($stmt1->Package_type==1){ echo "Broadband";}else{ echo "Cable";}?></td>
										<td><?php echo $stmt1->name;?></td>
										<td><?php echo $stmt1->Amount;?></td>
										<td><?php echo $stmt1->Due_date;?></td>
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
										<td><?php echo $stmt1->bb_num;?></td>
										<td><?php echo $stmt1->extra;?></td>
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
		window.location.href='/cable-transaction-list?delete_id='+id;
	}
}
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
$(function () {
    $('.from_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('.to_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
});
</script>
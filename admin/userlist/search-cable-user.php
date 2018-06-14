<?php 
ob_start();
if (!isset($_SESSION['userSession'])) {
	header('location:login');
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
						<h4>Search User List</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Search User List</li>
						</ol>
						
						<div class="box box-block bg-white">
							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-3 col-xs-6">
									<div class="form-group">
										<label><b>Name</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Name" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>" >
										</div>
									</div>
								</div>
								
								<div class="col-md-3 col-xs-6">
									<div class="form-group">
										<label><b>Mobile</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Mobile" name="mobile" value="<?php if(isset($_POST['mobile'])){ echo $_POST['mobile']; } ?>" >
										</div>
									</div>
								</div>
								
								<div class="col-md-3 col-xs-6">
									<div class="form-group">
										<label><b>Smartcard</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Smartcard" name="smartcard" value="<?php if(isset($_POST['smartcard'])){ echo $_POST['smartcard']; } ?>" >
										</div>
									</div>
								</div>
								
								<div class="col-md-3 col-xs-6">
									<div class="form-group">
										<label><b>Address</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Address" name="address" value="<?php if(isset($_POST['address'])){ echo $_POST['address']; } ?>" >
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Search User" name="cus_add_new_user">
									</div>
									</div>
						        </div>
							</form>
						</div>
							
						<?php 
						if((isset($_POST['name']) && !empty($_POST['name'])) || (isset($_POST['mobile']) && !empty($_POST['mobile'])) || (isset($_POST['smartcard']) && !empty($_POST['smartcard'])) || (isset($_POST['address']) && !empty($_POST['address'])))
                        {?>
						<div class="box box-block bg-white">
							<h5 class="mb-1">Exporting Search User List Data</h5>
							<table class="table jsgrid table-striped table-bordered dataTable table-responsive" id="table-2">
								<thead>
									<tr>
									    <th>S.no</th>
									    <th>OPTIONS</th>
									    <th>CARDNO</th>
										<th>FULLNAME</th>
										<th>EMAILID</th>
										<th>PHONE</th>
										<th>ADDRESS</th>
										<th>SMARTCARD</th>
										<th>STATUS</th>
										<th>PACKAGE</th>
										<th>DUE DATE</th>
									</tr>
								</thead>
								<tbody>
                        <?php
                         $count=1;
                        $sql="SELECT *, us.id as UsrID FROM user_has_cable uc INNER JOIN user us ON uc.user_id=us.id LEFT JOIN profile pr ON us.id=pr.user_id 
                        LEFT JOIN user_as_smartcard ua ON us.id=ua.user_id INNER JOIN cable_package cp ON uc.package_id=cp.id ";
                        
                        if((isset($_POST['name']) && !empty($_POST['name'])) || (isset($_POST['mobile']) && !empty($_POST['mobile'])) || (isset($_POST['smartcard']) && !empty($_POST['smartcard'])) || (isset($_POST['address']) && !empty($_POST['address'])))
                        {
                        $sql.=" WHERE ";
                        $flag=0;
                        if(isset($_POST['name']) && !empty($_POST['name'])){
                            $sql.="us.full_name LIKE '$_POST[name]%' ";
                            $flag++;
                        }
                        
                        if((isset($_POST['mobile']) && !empty($_POST['mobile']))){
                            if($flag){  $sql.="AND ";}
                            $sql.="us.phone LIKE '$_POST[mobile]%' ";
                            $flag++;
                        }
        
                        if((isset($_POST['address']) && !empty($_POST['address']))){
                            if($flag){  $sql.="AND ";}
                            $sql.="pr.address_1 LIKE '%$_POST[address]%' ";
                            $flag++;
                        }
                        
                        if((isset($_POST['smartcard']) && !empty($_POST['smartcard']))){
                            if($flag){  $sql.="AND ";}
                            $sql.="ua.smart_card_no LIKE '%$_POST[smartcard]%' ";
                            $flag++;
                        }
                        }
                        
                        $sql.= "ORDER BY us.card_no ASC";

                        $stmt = $reg_user->runQuery($sql);
                        $stmt->execute();
                        for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                        {
                        ?><tr>
                            <td><?php echo $count; ?></td>
                            <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
								<a href="/edit-cable-user-details?id=<?php echo $stmt1->UsrID;?>"><button class="jsgrid-button jsgrid-edit-button" type="button" title="Edit"></button></a>
								<a href="/edit-cable-user-list?id=<?php echo $stmt1->UsrID;?>"><i class="fa fa-external-link" aria-hidden="true" title="Change Plan"></i></a>
									</td>
									    <td><?php echo $stmt1->card_no;
										if($stmt1->card_no){
										    echo "<br/><a href='/view-card-details?id=".$stmt1->card_no."' class='btn btn-primary' >Details</a>";
										}
										?></td>
										<td><?php echo $stmt1->full_name;?></td>
										<td><?php echo $stmt1->email;?></td>
										<td><?php echo $stmt1->phone;?></td>
										<td><?php echo $stmt1->address_1;?></td>
										<td><?php echo $stmt1->smart_card_no;?></td>
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
										<td><?php echo $stmt1->name;?></td>
										<td><?php echo $stmt1->due_date;?></td>
										</tr>
										<?php $count++; } ?>
								</tbody>
							</table>
						</div>
						<?php } ?>
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
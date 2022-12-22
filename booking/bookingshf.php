<!-- BEGIN: Head-->
<?php 
$pname = "Bookings";
include 'inc/head.php';
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			
        } else {
			header("location: index.php");
			exit;
		}
?>
<style>
.xdcontainer {
  position: relative;
  width: 100%;
  overflow: hidden;
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
}

.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}
</style>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
    <?php 
	include 'inc/header.php';
	?>
    <!-- END: Header-->
	
    <!-- BEGIN: Main Menu-->
    <?php 
	include 'inc/menu.php';
	?>
    <!-- END: Main Menu-->
	
	
	<!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
				
				<div class="row" id="table-bordered">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recent Bookings with health fund</h4>
                            </div>
							<div class="card-body">
                                <a href="bookings.php">
								<button type="button" class="btn btn-relief-primary">View All</button>
								</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Service</th>
                                            <th>Date</th>
                                            <th>Duration</th>
                                            <th>Timeslot</th>
                                            <th>Invoice ID</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
									<?php 
	
					/*$sql = "SELECT id, service, practitioner, bdate, duration, timeslot, booking_for, recipient, address, note, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM booking WHERE id='$uid'";
					
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$uname = $row['first_name']." ".$row['last_name'];
						$remail = $row['email'];
						
						}
					}*/
					
					$uid = $_SESSION['id'];
	        $stmta = $conn->prepare("SELECT id, service, fullname, dob, email, address, health_provider, health_provider_no, practitioner_gender, practitioner, BDate, duration, time_slot, add_req, scharge, tfee, total, status, payment_status, transaction_id, invoice_id, uid, cur_time FROM health_fund_booking WHERE uid=$uid && status='0' OR status='1' ORDER BY id DESC");
	
	        //executing the query 
	        $stmta->execute();
	
	        //binding results to the query 
	        $stmta->bind_result($id, $service, $fullname, $dob, $email, $address, $health_provider, $health_provider_no, $practitioner_gender, $practitioner, $BDate, $duration, $time_slot, $add_req, $scharge, $tfee, $total, $status, $payment_status, $transaction_id, $invoice_id, $uid, $cur_time);
	
	
	        //traversing through all the result 
	        while($stmta->fetch()){
			
			
			if($status == "0") {
				$barcolor = "badge badge-glow bg-primary";
				$bstatus = "Booked";
			} else if($status == "1"){
				$barcolor = "badge badge-glow bg-info";
				$bstatus = "Approved";
			} else if($status == "2"){
				$barcolor = "badge badge-glow bg-success";
				$bstatus = "Completed";
			} else if($status == "3"){
				$barcolor = "badge badge-glow bg-danger";
				$bstatus = "Cancelled";
			} else if($status == "4"){
				$barcolor = "badge badge-glow bg-success";
				$bstatus = "Completed";
			}
				$client_name = $fullname;
	
	?>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="fw-bold"><?php echo $client_name;?></span>
                                            </td>
                                            <td><?php echo $service;?></td>
											<td><?php echo $BDate;?></td>
                                            <td><?php echo $duration;?></td>
                                            <td><?php echo $time_slot;?></td>
                                            <td>
											<div class="modal-size-lg d-inline-block">
											<button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#<?php echo $invoice_id;?>">
                                                <i data-feather='paperclip'></i> <?php echo $invoice_id;?>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade text-start" id="<?php echo $invoice_id;?>" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel17">Invoice - <?php echo $invoice_id;?></h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="xdcontainer"> 
																<iframe class="responsive-iframe" src="..//invoice/invoice.php?invoice_id=<?php echo $invoice_id;?>"></iframe>
															</div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
											</td>
											<td>
												<span class="<?php echo $barcolor;?>"><?php echo $bstatus;?></span>
											</td>
                                            <td>
											<?php 
											if ($bstatus == "Completed") {
												
											} else if ($bstatus == "Cancelled"){
													
												} else {
													
												?>
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="inc/php_actions/cancel_booking.php?id=<?php echo $id;?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                            <span>Cancel</span>
                                                        </a>
                                                    </div>
													<?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
									<?php }?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
										
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php include 'inc/footer.php';?>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="app-assets/vendors/js/extensions/moment.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/dashboard-analytics.js"></script>
    <script src="app-assets/js/scripts/pages/app-invoice-list.js"></script>
    <!-- END: Page JS-->
	
	<!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/components/components-modals.js"></script>
    <!-- END: Page JS-->
	
	<!-- Sweetalert2 JS -->
	<script src="app-assets/js/plugins/sweetalert2/sweetalert2.min.js"></script>
	
	<script type="module">
  import Swal from 'app-assets/js/plugins/sweetalert2/sweetalert2.min.js'
</script>

<?php
		if(isset($_SESSION['sweet_status']) && $_SESSION['sweet_status'] !='')
		{
			?>
			
			<script>
				Swal.fire({
  title: "<?php echo $_SESSION['sweet_status']; ?>",
  icon: "<?php echo $_SESSION['status_code'];?>",
  confirmButtonText: `Ok`,
  allowOutsideClick: false,
}).then((result) => {
  if (result.isConfirmed) {
    <?php
					if(empty($_SESSION['link'])){
						
					} else {?>
						window.location = "<?php echo $_SESSION['link'];?>";
						<?php
					}
					
					?>
  }
})
			</script>
			<?php
			unset($_SESSION['sweet_status']);
            unset($_SESSION['link']);
            unset($_SESSION['status_code']);
		}
		?>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
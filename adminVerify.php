<!DOCTYPE html>
<?php
session_start();
if (empty($_SESSION['inputAdmin'])) {
	header("location: adminLogin.php");
}
?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>GOR SAHABAT - Verification</title>

	<!-- Custom fonts for this template-->
	<link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<?php include('adminSidebar.php') ?>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<form class="form-inline">
						<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
							<i class="fa fa-bars"></i>
						</button>
					</form>


					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<!-- Nav Item - Search Dropdown (Visible Only XS) -->


						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>

							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<h1 class="h3 mb-2 text-gray-800">Verification</h1>
					<p class="mb-4">Booking Verification</p>
					<?php
					include "dbConnect.php";
					$sql = mysqli_query($db_connection, "SELECT * FROM verifikasi order by tgl desc");

					$sql2 = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlah FROM verifikasi");
					$get_jumlah = mysqli_fetch_array($sql2);
					?>
					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Verification Data</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Booking ID</th>
											<th>Username</th>
											<th>Phone Number</th>
											<th>Date</th>
											<th>Start</th>
											<th>End</th>
											<th>Duration</th>
											<th>Courts</th>
											<th>Action</th>
										</tr>
									</thead>
									<?php
					while ($data = mysqli_fetch_array($sql)) {
					?>
						<tbody>
							<tr>
								<td class="align-middle"><?php echo $data['transnum']; ?></td>
								<td class="align-middle"><?php echo $data['username']; ?></td>
								<td class="align-middle"><?php echo $data['phonenum']; ?></td>
								<td class="align-middle"><?php echo $data['tgl']; ?></td>
								<td class="align-middle"><?php echo $data['start']; ?>.00</td>
								<td class="align-middle"><?php echo $data['end']; ?>.00</td>
								<td class="align-middle"><?php echo $data['duration']; ?> hour(s)</td>
								<td class="align-middle"><?php echo $data['fieldnum']; ?></td>
								<td><a href="responseAccept.php?transnum=<?php echo $data['transnum']; ?>" class="btn btn-success">Accept</a>
									<a href="responseReject.php?transnum=<?php echo $data['transnum']; ?>" class="btn btn-danger">Reject</a>
								</td>
							</tr>
						</tbody>
					<?php
					}
					?>
								</table>
							</div>
						</div>
					</div>
					<?php echo $get_jumlah['jumlah']; ?> data(s) waiting for confirmation.<br><br>

				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; GOR BANTHONG</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">??</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="adminLogout.php">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->


	<script src="./assets/vendor/jquery/jquery.min.js"></script>
	<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="./assets/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="./js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="./assets/vendor/chart.js/Chart.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="./js/demo/chart-area-demo.js"></script>
	<script src="./js/demo/chart-pie-demo.js"></script>
</body>

</html>
<?php
session_start();
include("db/config.php");


// Check if adminId exists in the session
if (!isset($_SESSION['adminId'])) {
	// Decode the base64-encoded adminId
	$decodedAdminId = base64_decode($_SESSION['adminId']);

	$stmt = $db->prepare("SELECT * FROM admin WHERE admin_id = ?");
	$stmt->bind_param("i", $decodedAdminId); // Assuming admin_id is an integer
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	header("location: index.php");
}
// Get the user's name from the session
$userName = $_SESSION['userName'];



// SQL query to count services
$sql = "SELECT COUNT(*) as total_request FROM team_members";
$result = $db->query($sql);

$total_request = 0;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$total_request = $row['total_request'];
}

$sql = "SELECT COUNT(*) as total_apply FROM apply_now";
$result = $db->query($sql);

$total_apply = 0;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$total_apply = $row['total_apply'];
}


// SQL query to count blogs
$sql = "SELECT COUNT(*) as total_blogs FROM blog";
$result = $db->query($sql);

$total_blogs = 0;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$total_blogs = $row['total_blogs'];
}


// SQL query to count photos
$sql = "SELECT COUNT(*) as total_slider FROM sliders";
$result = $db->query($sql);

$total_slider = 0;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$total_slider = $row['total_slider'];
}

// SQL query to count admin users
$sql = "SELECT COUNT(*) as total_admins FROM admin";
$result = $db->query($sql);

$total_admins = 0;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$total_admins = $row['total_admins'];
}

// SQL query to count team member users
$sql = "SELECT COUNT(*) as total_team FROM team_members";
$result = $db->query($sql);

$total_team = 0;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$total_team = $row['total_team'];
}

// SQL query to count contact query
$sql = "SELECT COUNT(*) as total_contact FROM contact";
$result = $db->query($sql);

$total_contact = 0;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$total_contact = $row['total_contact'];
}


// SQL query to count apply query
$sql = "SELECT COUNT(*) as total_courses FROM courses";
$result = $db->query($sql);

$total_courses = 0;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$total_courses = $row['total_courses'];
}

// SQL query to count apply query
$sql = "SELECT COUNT(*) as total_services FROM services";
$result = $db->query($sql);

$total_services = 0;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$total_services = $row['total_services'];
}

// SQL query with a prepared statement
$sqlfav = "SELECT favicon FROM system_setting LIMIT 1";

if ($stmt = $db->prepare($sqlfav)) {
	// Execute the statement
	$stmt->execute();

	// Bind the result to a variable
	$stmt->bind_result($favicon);

	// Fetch the result
	if ($stmt->fetch()) {
		$faviconPath = "logo/" . $favicon; // Build the full path

	}
	$stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="robots" content="noindex, nofollow">
	<title>Dashboard - Education Options</title>
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlspecialchars($faviconPath); ?>">

	<!-- Theme Script -->
	<script src="assets/js/theme-script.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Feather CSS -->
	<link rel="stylesheet" href="assets/plugins/icons/feather/feather.css">

	<!-- Tabler Icon CSS -->
	<link rel="stylesheet" href="assets/plugins/tabler-icons/tabler-icons.css">

	<!-- Daterangepikcer CSS -->
	<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="assets/plugins/fullcalendar/calendar.js">
	<link rel="stylesheet" href="assets/plugins/fullcalendar/calendar-data.js">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

	<!-- Datatable CSS -->
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<div class="header">

			<?php
			require_once('header.php'); ?>

		</div>
		<!-- /Header -->

		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<?php
			require_once('admin-sidebar.php');
			?>
		</div>
		<!-- /Sidebar -->

		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content">

				<!-- Page Header -->
				<div class="d-md-flex d-block align-items-center justify-content-between mb-3">
					<div class="my-auto mb-2">
						<h3 class="page-title mb-1">Admin Dashboard</h3>
						<nav>
							<ol class="breadcrumb mb-0">
								<li class="breadcrumb-item">
									<a href="dashboard.php">Dashboard</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
							</ol>
						</nav>
					</div>
				</div>
				<!-- /Page Header -->

				<div class="row">
					<div class="col-md-12">

						<!-- Dashboard Content -->
						<div class="card" style="background-color:  #309255;">
							<div class="overlay-img">
								<img src="assets/img/bg/shape-04.png" alt="img" class="img-fluid shape-01">
								<img src="assets/img/bg/shape-01.png" alt="img" class="img-fluid shape-02">
								<img src="assets/img/bg/shape-02.png" alt="img" class="img-fluid shape-03">
								<img src="assets/img/bg/shape-03.png" alt="img" class="img-fluid shape-04">
							</div>
							<div class="card-body">
								<div
									class="d-flex align-items-xl-center justify-content-xl-between flex-xl-row flex-column">
									<div class="mb-3 mb-xl-0">
										<div class="d-flex align-items-center flex-wrap mb-2">
											<h1 class="text-white me-2">Welcome Back,
												<?php echo htmlspecialchars($userName); ?>
											</h1>
											<a href="profile.php"
												class="avatar avatar-sm img-rounded bg-gray-800 dark-hover">
												<i class="ti ti-edit text-white"></i>
											</a>
										</div>
										<p class="text-white">Have a Good day at work</p>
									</div>
								</div>
							</div>
						</div>
						<!-- /Dashboard Content -->

					</div>
				</div>


				<div class="row">
					<div class="col-md-6 col-xl-3">
						<div class="card d-flex justify-content-between" style="background: linear-gradient(45deg,rgb(13, 125, 136), rgb(1, 150, 163));
						 border-radius: 8px; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
							<div class="card-body d-flex justify-content-between align-items-center">
								<!-- Icon and Text -->
								<a href="admin-contact.php">
									<div class="d-flex align-items-center">
										<i class="ti ti-file-plus text-white"
											style="font-size: 24px; margin-right: 12px;"></i>
										<h5 class="text-white mb-0">Contact Request</h5>
									</div>
								</a>
								<!-- Counter -->
								<h1 class="text-white mb-0"><?php echo $total_contact; ?></h1>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-xl-3">
						<div class="card d-flex justify-content-between" style="background: linear-gradient(45deg, #001f3f, #001a33);
						 border-radius: 8px; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
							<div class="card-body d-flex justify-content-between align-items-center">
								<!-- Icon and Text -->
								<a href="admin-service.php">
									<div class="d-flex align-items-center">
										<i class="ti ti-clipboard-data text-white"
											style="font-size: 24px; margin-right: 12px;"></i>
										<h5 class="text-white mb-0"> Services List</h5>
									</div>
								</a>
								<!-- Counter -->
								<h1 class="text-white mb-0"><?php echo $total_services; ?></h1>
							</div>
						</div>
					</div>


					<div class="col-md-6 col-xl-3">
						<div class="card d-flex justify-content-between" style="background: linear-gradient(45deg, #1e3c72, #2a5298);

							 border-radius: 8px; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
							<div class="card-body d-flex justify-content-between align-items-center">
								<!-- Icon and Text -->
								<a href="admin-blog.php">
									<div class="d-flex align-items-center">
										<i class="ti ti-brand-blogger text-white"
											style="font-size: 24px; margin-right: 12px;"></i>
										<h5 class="text-white mb-0">Blogs</h5>
									</div>
								</a>
								<!-- Counter -->
								<h1 class="text-white mb-0"><?php echo $total_blogs; ?></h1>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-xl-3">
						<div class="card d-flex justify-content-between" style="background: linear-gradient(45deg, #ff7300, #ff3d00);
						 border-radius: 8px; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
							<div class="card-body d-flex justify-content-between align-items-center">
								<!-- Icon and Text -->
								<a href="admin-team.php">
									<div class="d-flex align-items-center">
										<i class="ti ti-layout-distribute-vertical text-white"
											style="font-size: 24px; margin-right: 12px;"></i>
										<h5 class="text-white mb-0">Team Member</h5>
									</div>
								</a>
								<!-- Counter -->
								<h1 class="text-white mb-0"><?php echo $total_request; ?></h1>
							</div>
						</div>
					</div>

				</div>
				<div class="row">

					<div class="col-md-6 col-xl-3">
						<div class="card d-flex justify-content-between" style="background: linear-gradient(45deg, #56ab2f,rgb(94, 145, 33));
							 border-radius: 8px; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
							<div class="card-body d-flex justify-content-between align-items-center">
								<!-- Icon and Text -->
								<a href="admin-user.php">
									<div class="d-flex align-items-center">
										<i class="ti ti-user text-white"
											style="font-size: 24px; margin-right: 12px;"></i>
										<h5 class="text-white mb-0">User</h5>
									</div>
								</a>
								<!-- Counter -->
								<h1 class="text-white mb-0"><?php echo $total_admins; ?></h1>
							</div>
						</div>
					</div>



					<div class="col-md-6 col-xl-3">
						<div class="card d-flex justify-content-between" style="background: linear-gradient(45deg, #9d50bb, #6e48aa);

							 border-radius: 8px; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
							<div class="card-body d-flex justify-content-between align-items-center">
								<!-- Icon and Text -->
								<a href="admin-sliders.php">
									<div class="d-flex align-items-center">
										<i class="fa fa-image text-white"
											style="font-size: 24px; margin-right: 12px;"></i>
										<h5 class="text-white mb-0">Image Slider</h5>
									</div>
								</a>
								<!-- Counter -->
								<h1 class="text-white mb-0"><?php echo $total_slider; ?></h1>
							</div>
						</div>
					</div>

				</div>


			</div>

			<div class="row">
				<div class="content">
					<!-- Calendar -->
					<div class="col-lg-12 col-md-12">
						<div class="card bg-white">
							<div class="card-body">
								<div id="calendar"></div>
							</div>
						</div>
					</div>
					<!-- /Calendar -->
				</div>

			</div>




			<!-- /Page Wrapper -->





			<footer class="footer">
				<div class="mt-5 text-center">
					<?php
					require_once('copyright.php');
					?>
				</div>
			</footer>

		</div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
		<script data-cfasync="false" src="assets/js/email-decode.min.js"></script>
		<script src="assets/js/jquery-3.7.1.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

		<!-- Bootstrap Core JS -->
		<script src="assets/js/bootstrap.bundle.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

		<!-- Daterangepikcer JS -->
		<script src="assets/js/moment.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>
		<script src="assets/plugins/daterangepicker/daterangepicker.js"
			type="feb024e4d970c7c806ef5348-text/javascript"></script>

		<!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

		<!-- Slimscroll JS -->
		<script src="assets/js/jquery.slimscroll.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

		<!-- Datatable JS -->
		<script src="assets/js/jquery.dataTables.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>
		<script src="assets/js/dataTables.bootstrap5.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>
		<script src="assets/plugins/fullcalendar/calendar.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>
		<script src="assets/plugins/fullcalendar/calendar-data.js"
			type="feb024e4d970c7c806ef5348-text/javascript"></script>

		<!-- Datetimepicker JS -->
		<script src="assets/js/bootstrap-datetimepicker.min.js"
			type="feb024e4d970c7c806ef5348-text/javascript"></script>

		<!-- Custom JS -->
		<script src="assets/js/script.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

		<script src="assets/js/rocket-loader.min.js" data-cf-settings="feb024e4d970c7c806ef5348-|49" defer=""></script>


</body>

</html>
<?php
session_start();
require_once('db/config.php');

if (!isset($_SESSION['adminId'])) {
    header("Location: index.php");
    exit;
}


// Set default timezone
date_default_timezone_set('Asia/Kolkata');

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Add a new "Why Choose Us" entry
        if ($action === 'add') {
            $name = htmlspecialchars($_POST['name']);
            $content = htmlspecialchars($_POST['content']);
            $status = isset($_POST['status']) ? 1 : 0; // Status is 1 for active, 0 for inactive
            $date = date("Y-m-d"); // Use current date for the entry

            // Handle file upload (Icon)
            if (isset($_FILES['icon']) && $_FILES['icon']['error'] == 0) {
                $targetDir = "choose_us_icon/"; // Define the directory for uploading the icon
                $targetFile = $targetDir . basename($_FILES["icon"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Check if image file is a valid image (validate file type)
                $check = getimagesize($_FILES["icon"]["tmp_name"]);
                if ($check !== false) {
                    if (move_uploaded_file($_FILES["icon"]["tmp_name"], $targetFile)) {
                        $icon = $targetFile; // Assign the uploaded file path to the icon variable
                    } else {
                        $_SESSION['message'] = "Sorry, there was an error uploading your file.";
                        header('Location: admin-why-choose.php');
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "File is not an image.";
                    header('Location: admin-why-choose.php');
                    exit();
                }
            } else {
                $icon = ''; // If no icon is uploaded, leave it empty
            }

            // Insert the data into the database
            $stmt = $db->prepare("INSERT INTO why_choose_us (name, content, date, icon, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $name, $content, $date, $icon, $status);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Entry added successfully!";
            } else {
                $_SESSION['message'] = "Error: " . $stmt->error;
            }

            $stmt->close();
            $db->close();

            header('Location: admin-why-choose.php');
            exit();
        }

        // Edit a "Why Choose Us" entry
        if ($action === 'edit') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $content = $_POST['content'];
            $status = isset($_POST['status']) ? 1 : 0;
            $currentIcon = $_POST['current_icon'];  // Current icon if no new icon is uploaded

            // Handle the icon upload if a new file is selected
            if (!empty($_FILES["icon"]["name"])) {
                $targetDir = "choose_us_icon/";
                $targetFile = $targetDir . basename($_FILES["icon"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Check if the file is a valid image
                $check = getimagesize($_FILES["icon"]["tmp_name"]);
                if ($check !== false) {
                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($_FILES["icon"]["tmp_name"], $targetFile)) {
                        // Use the new icon if successfully uploaded
                        $icon = $targetFile;
                    } else {
                        $_SESSION['message'] = "Sorry, there was an error uploading your file.";
                        header('Location: admin-why-choose.php');
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "File is not a valid image.";
                    header('Location: admin-why-choose.php');
                    exit();
                }
            } else {
                // If no new icon is uploaded, keep the current icon
                $icon = $currentIcon;
            }

            // Update the entry in the database
            $stmt = $db->prepare("UPDATE why_choose_us SET name=?, content=?, icon=?, status=? WHERE id=?");
            $stmt->bind_param("sssii", $name, $content, $icon, $status, $id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Entry updated successfully!";
            } else {
                $_SESSION['message'] = "Error: " . $stmt->error;
            }
        }

        // Delete a "Why Choose Us" entry
        if ($action === 'delete') {
            $id = $_POST['id'];

            $stmt = $db->prepare("DELETE FROM why_choose_us WHERE id=?");
            $stmt->bind_param('i', $id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Entry deleted successfully!";
            } else {
                $_SESSION['message'] = "Error: " . $stmt->error;
            }
        }

        // Redirect back after action
        header('Location: admin-why-choose.php');
        exit();
    }
}


 // Fetch data from the database
 $stmt = $db->prepare("SELECT * FROM why_choose_us ORDER BY id DESC");
 $stmt->execute();
 $result_why_choose_us = $stmt->get_result();

 if (!$result_why_choose_us) {
     $_SESSION['message'] = "No Data found: " . $db->error;
     header('Location: admin-why-choose.php');
     exit();
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
    <title>Why Choose Us - Education Options</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlspecialchars($faviconPath); ?>">

    <!-- Theme Script -->
    <script src="assets/js/theme-script.js" type="094c2cc781cee01c60adaad3-text/javascript"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/feather/feather.css">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="assets/plugins/tabler-icons/tabler-icons.css">

    <!-- Daterangepicker CSS -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">
            <?php
            require_once('header.php');
            ?>
        </div>
        <!-- /Header -->

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <?php
            require_once('admin-sidebar.php') ?>
        </div>
        <!-- /Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                    <div class="my-auto mb-2">
                        <h3 class="page-title mb-1">Why Choose Us</h3>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Why Choose Us</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                        <div class="pe-1 mb-2">
                            <a href="#" class="btn btn-outline-light bg-white btn-icon me-1" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh" data-bs-original-title="Refresh">
                                <i class="ti ti-refresh"></i>
                            </a>
                        </div>
                        <div class="pe-1 mb-2">
                            <button type="button" class="btn btn-outline-light bg-white btn-icon me-1" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Print" data-bs-original-title="Print">
                                <i class="ti ti-printer"></i>
                            </button>
                        </div>
                        <div class="dropdown me-2 mb-2">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-light fw-medium d-inline-flex align-items-center" data-bs-toggle="dropdown">
                                <i class="ti ti-file-export me-2"></i>Export
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1"><i class="ti ti-file-type-pdf me-1"></i>Export as PDF</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1"><i class="ti ti-file-type-xls me-1"></i>Export as Excel </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mb-2">
                            <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#add_why_choose_us"><i class="ti ti-square-rounded-plus me-2"></i>Add Entry</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <!-- Filter Section -->
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
                        <h4 class="mb-3">Why Choose Us List</h4>
                        <div class="d-flex align-items-center flex-wrap">
                            <div class="dropdown mb-3 me-2">
                                <a href="javascript:void(0);" class="btn btn-outline-light bg-white dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside"><i class="ti ti-filter me-2"></i>Filter</a>
                                <div class="dropdown-menu drop-width">
                                    <!-- Filter form can be added here -->
                                </div>
                            </div>
                            <div class="dropdown mb-3">
                                <a href="javascript:void(0);" class="btn btn-outline-light bg-white dropdown-toggle" data-bs-toggle="dropdown"><i class="ti ti-sort-ascending-2 me-2"></i>Sort by A-Z
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item rounded-1 active">
                                            Ascending
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                            Descending
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                            Recently Viewed
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                            Recently Added
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 py-3">
                        <!-- Why Choose Us List -->
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo '<div id="messageBox" class="alert ' . (strpos($_SESSION['message'], 'successfully') !== false ? 'alert-success' : 'alert-danger') . ' alert-dismissible fade show" role="alert">';
                            echo $_SESSION['message'];
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo '</div>';
                            unset($_SESSION['message']);
                        }
                        ?>
                        <?php
                       
                        if ($result_why_choose_us->num_rows > 0) {
                            echo '<table class="table datatable">';
                            echo '<thead class="thead-light">';
                            echo '<tr>';
                            echo '<th class="no-sort"><div class="form-check form-check-md"><input class="form-check-input" type="checkbox" id="select-all"></div> </th>';
                            echo '<th>SN</th>';  // Serial number column
                            echo '<th>Name</th>';
                            echo '<th>Icon</th>';
                            echo '<th>Date</th>';
                            echo '<th>Status</th>';
                            echo '<th>Action</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            // Initialize the counter for serial numbers
                            $i = 1;

                            while ($data_why_choose_us = $result_why_choose_us->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td><div class="form-check form-check-md"><input class="form-check-input" type="checkbox">&nbsp;</div></td>';

                                // Display the serial number dynamically
                                echo '<td class="text-gray-9">' . $i . '</td>';  // Display serial number
                                $i++;  // Increment the counter after each row

                                echo '<td>' . htmlspecialchars($data_why_choose_us['name'], ENT_QUOTES, 'UTF-8') . '</td>';
                                echo '<td>';

                                if (!empty($data_why_choose_us['icon'])) {
                                    echo '<a href="javascript:void(0);" class="avatar avatar-xxl rounded flex-shrink-0 me-3">';
                                    echo '<img src="' . htmlspecialchars($data_why_choose_us['icon'], ENT_QUOTES, 'UTF-8') . '" alt="icon">';
                                    echo '</a>';
                                }

                                echo '</td>';
                                echo '<td>' . $data_why_choose_us['date'] . '</td>';

                                // Display status
                                echo '<td>';
                                if ($data_why_choose_us['status'] == 1) {
                                    echo '<span class="badge badge-soft-success d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Active</span>';
                                } else {
                                    echo '<span class="badge badge-soft-danger d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Inactive</span>';
                                }
                                echo '</td>';

                                // Action buttons
                                echo '<td>';
                                echo '<div class="dropdown">';
                                echo '<a href="#" class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0" data-bs-toggle="dropdown" aria-expanded="false">';
                                echo '<i class="ti ti-dots-vertical fs-14"></i>';
                                echo '</a>';
                                echo '<ul class="dropdown-menu dropdown-menu-right p-3">';
                                echo '<li>';
                                echo '<a class="dropdown-item rounded-1 edit-btn" href="#" data-bs-toggle="modal" data-bs-target="#edit_why_choose_us"
                                    data-id="' . $data_why_choose_us['id'] . '"
                                    data-name="' . htmlspecialchars($data_why_choose_us['name'], ENT_QUOTES) . '"
                                    data-icon="' . htmlspecialchars($data_why_choose_us['icon'], ENT_QUOTES, 'UTF-8') . '"
                                    data-content="' . htmlspecialchars($data_why_choose_us['content'], ENT_QUOTES) . '"
                                    data-status="' . $data_why_choose_us['status'] . '"
                                    onclick="setEditValues(this)">';
                                echo '<i class="ti ti-edit-circle me-2"></i>Edit';
                                echo '</a>';
                                echo '</li>';
                                echo '<li><a class="dropdown-item rounded-1" href="#" data-bs-toggle="modal" data-bs-target="#delete-modal" data-id="' . $data_why_choose_us['id'] . '"><i class="ti ti-trash-x me-2"></i>Delete</a></li>';
                                echo '</ul>';
                                echo '</div>';
                                echo '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo '<p>No entries found.</p>';
                        }

                      
                        ?>

                    </div>
                </div>
                <!-- /Filter Section -->

            </div>
        </div>
        <!-- /Page Wrapper -->

        <!-- Add Why Choose Us -->
        <div class="modal fade" id="add_why_choose_us">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Entry</h4>
                        <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                    <form id="whyChooseUsForm" action="admin-why-choose.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Icon</label>
                                    <div class="d-flex align-items-center upload-pic flex-wrap row-gap-3">
                                        <div class="d-flex align-items-center justify-content-center avatar avatar-xxl border border-dashed me-2 flex-shrink-0 text-dark frames">
                                            <i class="ti ti-photo-plus fs-16"></i>
                                        </div>
                                        <div class="profile-upload">
                                            <div class="profile-uploader d-flex align-items-center">
                                                <div class="drag-upload-btn mb-3">
                                                    Upload
                                                    <input type="file" class="form-control image-sign" name="icon" required>
                                                </div>
                                            </div>
                                            <p>Upload image size 4MB, Format JPG, PNG, SVG</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="">Select Status...</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="title" class="form-label">Content *</label>
                                    <textarea name="content" class="form-control" rows="4" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" name="add-submit" class="btn btn-primary">Add Entry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add Why Choose Us -->

        <!-- Edit Why Choose Us -->
        <div class="modal fade" id="edit_why_choose_us" tabindex="-1" aria-labelledby="edit_why_choose_usLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="edit_why_choose_usLabel">Edit Entry</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                    <form action="admin-why-choose.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" id="edit-id">
                        <input type="hidden" name="current_icon" id="edit-current-icon">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" id="edit-name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Icon</label>
                                    <div class="frames">
                                        <img id="edit-icon-preview" src="" alt="Icon" class="avatar-img">
                                    </div>
                                    <input type="file" name="icon" class="form-control" id="edit-icon-file">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status" id="edit-status" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="title" class="form-label">Content *</label>
                                    <textarea name="content" id="edit-content" class="form-control" rows="4" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="edit-submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Edit Why Choose Us -->

        <!-- Delete Modal -->
        <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="admin-why-choose.php" method="POST">
                        <input type="hidden" name="action" value="delete">
                        <div class="modal-body text-center">
                            <span class="delete-icon">
                                <i class="ti ti-trash-x"></i>
                            </span>
                            <h4>Confirm Deletion</h4>
                            <p>You want to delete this entry, this can't be undone once you delete.</p>
                            <input type="hidden" name="id" id="delete-id"> <!-- Hidden input for entry ID -->
                            <div class="d-flex justify-content-center">
                                <a href="#" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                                <button type="submit" name="delete-submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Delete Modal -->

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
	<script src="assets/plugins/daterangepicker/daterangepicker.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

	<!-- Feather Icon JS -->
	<script src="assets/js/feather.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

	<!-- Slimscroll JS -->
	<script src="assets/js/jquery.slimscroll.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

	<!-- Datatable JS -->
	<script src="assets/js/jquery.dataTables.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>
	<script src="assets/js/dataTables.bootstrap5.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

	<!-- Select2 JS -->
	<script src="assets/plugins/select2/js/select2.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

	<!-- Datetimepicker JS -->
	<script src="assets/js/bootstrap-datetimepicker.min.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

	<!-- Custom JS -->
	<script src="assets/js/script.js" type="feb024e4d970c7c806ef5348-text/javascript"></script>

	<script src="assets/js/rocket-loader.min.js" data-cf-settings="feb024e4d970c7c806ef5348-|49" defer=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const messageBox = document.getElementById('messageBox');
            if (messageBox) {
                setTimeout(() => {
                    messageBox.style.display = 'none';
                }, 5000); // Hide the message after 5 seconds
            }
        });
    </script>

    <script>
        // Function to set values in the Edit modal
        function setEditValues(element) {
            var id = $(element).data('id');
            var name = $(element).data('name');
            var icon = $(element).data('icon');
            var content = $(element).data('content');
            var status = $(element).data('status');

            // Set values in modal inputs
            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#edit-current-icon').val(icon);
            $('#edit-status').val(status);

            // Display the current icon if it exists
            if (icon) {
                $('#edit-icon-preview').attr('src', icon).show();
            } else {
                $('#edit-icon-preview').hide();
            }

            // Set the content to the textarea
            $('#edit-content').val(content);
        }

        // Attach event handlers to Edit and Delete links
        $('a[data-bs-toggle="modal"]').on('click', function() {
            if ($(this).data('action') === 'edit') {
                setEditValues(this);
            } else {
                $('#delete-id').val($(this).data('id'));
            }
        });
    </script>

</body>

</html>
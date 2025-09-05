<?php
session_start();
require_once('db/config.php');

if (!isset($_SESSION['adminId'])) {
    header("Location: index.php");
    exit; // or die();
}



// Fetch existing data for About Us section
$sql_check_about = "SELECT * FROM about_section LIMIT 1";
$result_about = $db->query($sql_check_about);

$title = '';
$content = '';
$image = '';

if ($result_about->num_rows > 0) {
    $row_about = $result_about->fetch_assoc();
    $title = $row_about['title'];
    $content = $row_about['content'];
    $image = $row_about['image'];
}

// Fetch existing data for Why Choose Us section
$sql_check_choose = "SELECT * FROM why_choose_us LIMIT 1";
$result_choose = $db->query($sql_check_choose);

$name = '';
$choose_content = '';
$icon = '';

// if ($result_choose->num_rows > 0) {
//     $row_choose = $result_choose->fetch_assoc();
//     $name = $row_choose['name'];
//     $choose_content = $row_choose['content'];
//     $icon = $row_choose['icon'];
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['about_submit'])) {
        // Process About Us section
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
        $image_tmp = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
        $upload_dir = "about/";
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d");

        // Re-fetch the existing data to ensure the result is accurate
        $result_about = $db->query($sql_check_about);

        if ($result_about->num_rows > 0) {
            // Update record
            $row_about = $result_about->fetch_assoc();
            $image = !empty($image) ? $image : $row_about['image']; // Keep old image if new one is not provided
            if (!empty($image_tmp)) {
                move_uploaded_file($image_tmp, $upload_dir . $image);
            }
            $sql_update = "UPDATE about_section SET title = ?, content = ?, image = ?, date = ? WHERE id = ?";
            $stmt = $db->prepare($sql_update);
            $stmt->bind_param("ssssi", $title, $content, $image, $date, $row_about['id']);
            $stmt->execute();
            $_SESSION['message'] = "About us record updated successfully.";
        } else {
            // Insert record
            if (!empty($image_tmp)) {
                move_uploaded_file($image_tmp, $upload_dir . $image);
            }
            $sql_insert = "INSERT INTO about_section (title, content, image, date) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($sql_insert);
            $stmt->bind_param("ssss", $title, $content, $image, $date);
            $stmt->execute();
            $_SESSION['message'] = "About us record added successfully.";
        }
    }

    header("Location: admin-about-us.php");
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
    <title>About Founder - Education Options</title>

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

    <!-- Summernote CSS -->
    <link rel="stylesheet" href="assets/plugins/summernote/summernote-lite.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        a:hover {
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if (isset($_SESSION['message'])): ?>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: "<?php echo htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8'); ?>",
                showConfirmButton: false,
                timer: 8000,
                timerProgressBar: true
            });
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['message'])): ?>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'error',
                title: "<?php echo htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8'); ?>",
                showConfirmButton: false,
                timer: 8000,
                timerProgressBar: true
            });
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
    });
</script>

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
                <div class="d-md-flex d-block align-items-center justify-content-between border-bottom pb-3">
                    <div class="my-auto mb-2">
                        <h3 class="page-title mb-1">About Founder</h3>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">About Founder</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                        <div class="pe-1 mb-2">
                            <a href="#" class="btn btn-outline-light bg-white btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh" data-bs-original-title="Refresh">
                                <i class="ti ti-refresh"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-12 col-xl-12">
                        <div class="container mt-5">
                            

                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="about-container container p-4 bg-light rounded shadow-sm">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?php echo htmlspecialchars($title); ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <?php if (!empty($image)): ?>
                                                <img src="about/<?php echo htmlspecialchars($image); ?>" alt="Current Image" style="max-width: 100px; margin-top: 10px;">
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="summernote" class="form-label">Content</label>
                                            <textarea class="form-control" id="summernote" name="content" placeholder="Enter content"><?php echo htmlspecialchars($content); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="text-left">
                                        <button type="submit" class="btn btn-primary px-5" name="about_submit"><?php echo $result_about->num_rows > 0 ? 'Update' : 'Add'; ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <!-- <div class="content">
                    <div class="row">
                        <div class="col-xxl-10 col-xl-9">
                            <h3 class="page-title mb-1">Why Choose Us Section</h3>
                            <p>Please add the section for the why choose us</p>

                            <div class="container mt-5">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="about-container container p-4 bg-light rounded shadow-sm">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo htmlspecialchars($name); ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="icon" class="form-label">Icon</label>
                                                <input type="file" class="form-control" id="icon" name="icon">
                                                <?php if (!empty($icon)): ?>
                                                    <img src="choose_us_icon/<?php echo htmlspecialchars($icon); ?>" alt="Current Icon" style="max-width: 100px; margin-top: 10px;">
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="summernote_choose" class="form-label">Content</label>
                                                <textarea class="form-control" id="summernote_choose" name="choose_content" placeholder="Enter content"><?php echo htmlspecialchars($choose_content); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-primary px-5" name="choose_submit"><?php echo $result_choose->num_rows > 0 ? 'Update' : 'Add'; ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div> -->
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
	<script src="assets/js/jquery-3.7.1.min.js" type="094c2cc781cee01c60adaad3-text/javascript"></script>

<!-- Bootstrap Core JS -->
<script src="assets/js/bootstrap.bundle.min.js" type="094c2cc781cee01c60adaad3-text/javascript"></script>

<!-- Daterangepicker JS -->
<script src="assets/js/moment.js" type="094c2cc781cee01c60adaad3-text/javascript"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js" type="094c2cc781cee01c60adaad3-text/javascript"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js" type="094c2cc781cee01c60adaad3-text/javascript"></script>

<!-- Feather Icon JS -->
<script src="assets/js/feather.min.js" type="094c2cc781cee01c60adaad3-text/javascript"></script>

<!-- Slimscroll JS -->
<script src="assets/js/jquery.slimscroll.min.js" type="094c2cc781cee01c60adaad3-text/javascript"></script>

<!-- Select2 JS -->
<script src="assets/plugins/select2/js/select2.min.js" type="094c2cc781cee01c60adaad3-text/javascript"></script>

<!-- Summernote JS -->
<script src="assets/plugins/summernote/summernote-lite.min.js" type="094c2cc781cee01c60adaad3-text/javascript"></script>

<!-- Custom JS -->
<script src="assets/js/script.js" type="094c2cc781cee01c60adaad3-text/javascript"></script>

<script src="assets/js/rocket-loader.min.js" data-cf-settings="094c2cc781cee01c60adaad3-|49" defer=""></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
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
        $(document).ready(function() {
            // Initialize Summernote for Description
            $('#summernote').summernote({
                height: 200, // Set the height of the editor
                placeholder: 'Enter Description here...',
                tabsize: 2
            });

            $('#summernote_choose').summernote({
                height: 200, // Set the height of the editor
                placeholder: 'Enter Description here...',
                tabsize: 2
            });

            // Handle form submission
            $('#submitForm').on('submit', function(e) {
                // Get content from Summernote editor and store it in the hidden input field
                $('#content').val($('#summernote').summernote('code'));
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('check_data.php')
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        document.getElementById('submitButton').textContent = 'Update';
                    } else {
                        document.getElementById('submitButton').textContent = 'Add';
                    }
                });
        });
    </script>

</body>

</html>
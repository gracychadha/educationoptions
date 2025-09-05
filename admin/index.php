<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("db/config.php");

$stmt = $db->prepare("SELECT * FROM captcha WHERE status = '1'");
$stmt->execute();
$result_captcha = $stmt->get_result();
if (!$result_captcha) {
    die("Error fetching Cloudflare Turnstile configuration: " . $db->error);
}
$data_captcha = $result_captcha->fetch_assoc();

$site_key = $data_captcha['sitekey']; // Replace with your actual site key

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $login_identifier = mysqli_real_escape_string($db, $_POST['login_identifier']);
        $password = $_POST['password'];
        $captchaResponse = $_POST['cf-turnstile-response'] ?? '';

        // Verify Cloudflare Turnstile
        $secret_key = $data_captcha['secretkey']; // Replace with your actual secret key
        $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
        $data = [
            'secret' => $secret_key,
            'response' => $captchaResponse,
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);

        if (!$response['success']) {
            $_SESSION['msg'] = "Error in Cloudflare Turnstile verification.";
            $_SESSION['msg_type'] = 'error';
            header("location: index.php");
            exit();
        }

        // Check login credentials in the database
        $stmt = $db->prepare("SELECT * FROM admin WHERE (username = ? OR email = ?)");
        if (!$stmt) {
            die("Prepare statement failed: " . $db->error);
        }
        $stmt->bind_param("ss", $login_identifier, $login_identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $rowadmin = $result->fetch_assoc();

            // Optional: Check account status
            if ($rowadmin['status'] === 'Disabled') {
                $_SESSION['msg'] = "Account access denied. Please contact support for more information.";
                $_SESSION['msg_type'] = 'error';
                header("location: index.php");
                exit();
            }

            // Verify password
            if (password_verify($password, $rowadmin['password'])) {
                // Store user information in the session
                $_SESSION['adminId'] = base64_encode($rowadmin['admin_id']);
                $_SESSION['userName'] = $rowadmin['username']; // Assuming 'username' is the column storing the user's name

                // Redirect to the dashboard or home page
                header("location: dashboard.php");
                exit();
            } else {
                $_SESSION['msg'] = "Invalid password. Please try again.";
                $_SESSION['msg_type'] = 'error';
                header("location: index.php");
                exit();
            }
        } else {
            $_SESSION['msg'] = "Access denied: Invalid username or email.";
            $_SESSION['msg_type'] = 'error';
            header("location: index.php");
            exit();
        }
    }
}

// SQL query with a prepared statement
$sqlfav = "SELECT favicon, backpanel_logo, black_image, helpdesk FROM system_setting LIMIT 1";

if ($stmt = $db->prepare($sqlfav)) {
    // Execute the statement
    $stmt->execute();

    // Bind the result to variables
    $stmt->bind_result($favicon, $backpanel_logo, $black_image, $helpdesk);

    // Fetch the result
    if ($stmt->fetch()) {
        // Build the full paths
        $faviconPath = "logo/" . $favicon;
        $backpanelLogoPath = "logo/" . $backpanel_logo;
        $blackImagePath = "logo/" . $black_image;

        // Optionally use $helpdesk here if needed
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle errors, if any
    echo "Failed to prepare the statement.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Education Options</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlspecialchars($faviconPath); ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="assets/plugins/icons/feather/feather.css">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="assets/plugins/tabler-icons/tabler-icons.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Cloudflare Turnstile CSS -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>

<body class="account-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="">
            <div class="login-wrapper w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div
                            class="d-lg-flex align-items-center justify-content-center d-lg-block  d-md-block d-none flex-wrap  overflowy-auto">
                            <img src="<?php echo htmlspecialchars($backpanelLogoPath); ?>" alt="Backpanel Logo">

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap ">
                            <div class="mx-auto p-4">
                                <div>
                                    <div class="mx-auto mb-3 text-center">
                                        <img src="<?php echo htmlspecialchars($blackImagePath); ?>" alt="Backpanel Logo"
                                            style="width: 80%;">
                                    </div>
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <div class="mb-4">
                                                <h2 class="mb-2">Welcome</h2>
                                                <p class="mb-0">Please enter your details to sign in</p>
                                            </div>
                                            <?php
                                            if (isset($_SESSION['msg'])) {
                                                $message = $_SESSION['msg'];
                                                $message_type = $_SESSION['msg_type']; // Get the message type (success/error)
                                            
                                                // Display the message
                                                echo "<div class='alert alert-$message_type alert-dismissible fade show' id='alert-message' style='color:red'>
                                                        $message
                                                    </div>";

                                                // Unset session message after displaying
                                                unset($_SESSION['msg']);
                                                unset($_SESSION['msg_type']);
                                            }
                                            ?>

                                            <form action="index.php" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label class="form-label">Username or Email</label>
                                                    <div class="input-icon mb-3 position-relative">
                                                        <span class="input-icon-addon">
                                                            <i class="ti ti-user"></i>
                                                        </span>
                                                        <input type="text" name="login_identifier" class="form-control"
                                                            placeholder="Email or Username" required>
                                                    </div>
                                                    <label class="form-label">Password</label>
                                                    <div class="pass-group">
                                                        <input type="password" name="password" id="password"
                                                            placeholder="Password" class="pass-input form-control"
                                                            required>
                                                        <span class="ti toggle-password ti-eye-off"
                                                            id="togglePassword"></span>
                                                    </div>
                                                </div>

                                                <!-- Cloudflare Turnstile CAPTCHA -->
                                                <div class="form-group">
                                                    <div class="cf-turnstile" data-sitekey="<?php echo $site_key; ?>"
                                                        data-callback="enableSubmitButton"></div>
                                                    <input type="hidden" name="cf-turnstile-response"
                                                        id="cf-turnstile-response">
                                                </div>

                                                <div class="form-wrap form-wrap-checkbox mb-3">
                                                    <div class="text-end">
                                                        <a href="#" class="link-danger">Forgot Password?</a>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" id="submitButton" name="login"
                                                        class="btn btn-primary w-30" disabled><i class="fa fa-save "
                                                            style="padding-right: 8apx;"></i> Submit</button>
                                                </div>
                                            </form>
                                            <div class="text-center pr-5 pl-5">
                                                <hr style="border-color: #2740c3 !important;">
                                                <p class="text-dark">HelpDesk/Helpline No: <?php echo $helpdesk; ?></p>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="mt-5 text-center">
                                        <?php require_once('copyright.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Core JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        function enableSubmitButton(token) {
            document.getElementById('cf-turnstile-response').value = token;
            document.getElementById('submitButton').disabled = false;
        }

        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the eye icon
            this.classList.toggle('ti-eye');
            this.classList.toggle('ti-eye-off');
        });
    </script>
</body>

</html>
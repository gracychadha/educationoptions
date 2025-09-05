<?php
require_once("admin/db/config.php");
session_start();

// Fetch favicon
$sqlfav = "SELECT favicon FROM system_setting LIMIT 1";
if ($stmt = $db->prepare($sqlfav)) {
    $stmt->execute();
    $stmt->bind_result($favicon);
    if ($stmt->fetch()) {
        $faviconPath = "http://localhost/educationoptions/admin/logo/" . $favicon;
    } else {
        $faviconPath = "assets/img/logo/favicon.ico"; 
    }
    $stmt->close();
} else {
    $faviconPath = "assets/img/logo/favicon.ico";
}

// Fetch services
$stmtFetch1 = $db->prepare("SELECT * FROM services WHERE STATUS = '1'");
$stmtFetch1->execute();
$services = $stmtFetch1->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch company info
$query_info = "SELECT * FROM company_info";
$result_info = $db->query($query_info);
$info = $result_info->fetch_assoc();

// Define reCAPTCHA keys
$recaptcha_secret = "6Lf53aUrAAAAANnlYINXWDRYFUKaoF9BdoIwJzOF"; //  secret key

// Form submission handler
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["name"])) {
    // Sanitize inputs
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $service = trim(filter_input(INPUT_POST, 'service', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

    $errors = [];

    // Validation
    if (empty($name) || !preg_match("/^[a-zA-Z\s]{2,50}$/", $name)) {
        $errors[] = "Please enter a valid name (2–50 letters and spaces only).";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($service) || !in_array($service, array_column($services, 'title'))) {
        $errors[] = "Please select a valid service.";
    }

    if (empty($phone) || !preg_match('/^[\+]?[0-9]{10,15}$/', $phone)) {
        $errors[] = "Please enter a valid phone number (10–15 digits).";
    }

    if (empty($message) || strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters long.";
    }

    if (empty($recaptcha_response)) {
        $errors[] = "Please complete the reCAPTCHA to prove you're not a robot.";
    }

    // Return validation errors
    if (!empty($errors)) {
        echo json_encode(["status" => "error", "message" => implode(" ", $errors)]);
        exit();
    }

    // Verify reCAPTCHA with Google
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($recaptcha_data)
        ]
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($recaptcha_url, false, $context);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => "reCAPTCHA verification failed. Network error."]);
        exit();
    }

    $captcha_result = json_decode($result);

    if (!$captcha_result->success) {
        echo json_encode(["status" => "error", "message" => "reCAPTCHA verification failed. Please try again."]);
        exit();
    }

    // Insert into database (prepared statement)
    $stmt = $db->prepare("INSERT INTO contact (name, email, phone, service, message) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $db->error]);
        exit();
    }

    $stmt->bind_param("sssss", $name, $email, $phone, $service, $message);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Thank you, $name! We've received your message and will get back to you soon."
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to submit. Please try again later."
        ]);
    }

    $stmt->close();
    exit();
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Contact Us || Education Options</title>
    <meta name="description" content="Contact us for study abroad, admissions, visa support, and career guidance.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlspecialchars($faviconPath); ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/custom-animation.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/venobox.min.css">
    <link rel="stylesheet" href="assets/css/backToTop.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.css">
    <link rel="stylesheet" href="assets/css/default.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- intl-tel-input -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

   <style>
        .set-service {
            height: 29px;
            line-height: 22px;
            padding-left: 0px;

        }

        .goog-te-gadget-simple {
            height: 40px;
        }

        .goog-te-gadget-simple img {
            display: none !important;
        }

        .VIpgJd-ZVi9od-ORHb {
            visibility: hidden;
            display: none;
        }

        .VIpgJd-ZVi9od-ORHb-OEVmcd {
            display: none;
        }

        .VIpgJd-ZVi9od-aZ2wEe-wOHMyf {
            display: none;
        }
    </style>
</head>

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">
            You are using an <strong>outdated</strong> browser. 
            Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.
        </p>
    <![endif]-->

    <!-- Header -->
    <header>
        <?php
        require_once('inc/header.php');
        require_once('inc/navbar.php');
        ?>
    </header>

    <!-- Page Title -->
    <div class="page-title__area pt-110" style="background-image: url(assets/img/bg/contact-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="page__title-wrapper text-center">
                        <h3>Contact Us</h3>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadccrumb-bg">
            <ul class="breadcrumb justify-content-center pt-20 pb-20">
                <li class="bd-items"><a href="index.php">Home</a></li>
                <li class="bd-items">|</li>
                <li class="bd-items"><a href="contact-us.php">Contact Us</a></li>
            </ul>
        </nav>
    </div>

    <main>
        <!-- Contact Cards -->
        <div class="card-area mt-60">
            <div class="card-area-title">
                <h3 class="theme-title">We'd Love to Hear from You!</h3>
                <p>A descriptive paragraph that tells clients how good you are and proves that you are the best choice.
                </p>
            </div>
            <div class="conatiner-cards mt-60 mb-60">
                <div class="card-item">
                    <div class="card-icon"><i class="fal fa-map-marker-alt"></i></div>
                    <div class="card-heading">
                        <h3 class="theme-title">Our Location</h3>
                    </div>
                    <div class="card-details">
                        <a><?= htmlspecialchars($info['address'] . ', ' . $info['city'] . ', ' . $info['state']) ?></a>
                    </div>
                </div>
                <div class="card-item">
                    <div class="card-icon"><i class="fal fa-phone"></i></div>
                    <div class="card-heading">
                        <h3 class="theme-title">Call Us On</h3>
                    </div>
                    <div class="card-details">
                        <a><?= htmlspecialchars($info['phone1']) ?></a><br>
                        <a><?= htmlspecialchars($info['phone2']) ?></a>
                    </div>
                </div>
                <div class="card-item">
                    <div class="card-icon"><i class="fal fa-envelope"></i></div>
                    <div class="card-heading">
                        <h3 class="theme-title">E-mail Us</h3>
                    </div>
                    <div class="card-details">
                        <a><?= htmlspecialchars($info['email']) ?></a><br>
                        <a>admissions@educationoptions.com.au</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact__area mb-130">
            <div class="contact__vmap">
                <iframe src="https://maps.google.com/maps?q=Level+5,+55+Gawler+Place,+Adelaide,+SA+5000&output=embed"
                    width="100%" height="350" style="border:0;" allowfullscreen loading="lazy"></iframe>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6"></div>
                    <div class="col-xl-6 col-xl-6 col-lg-6">
                        <div class="contact__form pt-110">
                            <h2 class="contact-form__title theme-title">Get in <span>Touch</span></h2>
                            <form id="contactForm" action="" method="POST">
                                <div class="row">
                                    <div class=" input_group">
                                        <span> <i class="fas fa-user theme-clr"></i></span>
                                        <input name="name" class="" type="text" placeholder="Your Name" required>
                                    </div>
                                    <div class="input_group">
                                        <span> <i class="fas fa-envelope theme-clr"></i></span>
                                        <input name="email" class="" type="email" placeholder="Your Email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" input_group">

                                        <input name="phone" class="" type="text" placeholder="Phone" id="mobile"
                                            required>
                                    </div>
                                    <div class=" input_group">
                                        <span class="btn-primaryadd"><i class="fas fa-briefcase theme-clr"></i></span>
                                        <select class="set-service" name="service" required>
                                            <option value="" disabled selected>Select Service</option>
                                            <?php
                                            foreach ($services as $item) {
                                                ?>
                                                <option value="<?php echo $item['title']; ?>"><?php echo $item['title']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12 input_group_text">
                                        <i class="fas fa-comments theme-clr"></i>
                                        <textarea name="message" class="" cols="30" rows="10"
                                            placeholder="Message"></textarea>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-lg-12">
                                        <div class="g-recaptcha"
                                            data-sitekey="6Lf53aUrAAAAAGCdsl9-W6cy7K5Xp5HLlCMy_0-7"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <button class="theme-btn" type="submit" value="submit">Submit Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php
    require_once('inc/footer.php');
    require_once('inc/copyright.php');
    ?>

    <!-- Scripts -->
    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/swiper-bundle.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/venobox.min.js"></script>
    <script src="assets/js/backToTop.js"></script>
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- intl-tel-input -->
    <script>
        fetch("https://ipapi.co/json/")
            .then(response => response.json())
            .then(data => {
                const userCountry = data.country_code.toLowerCase() || "us";
                const phoneInput = document.querySelector("#mobile");
                window.intlTelInput(phoneInput, {
                    initialCountry: userCountry,
                    strictMode: true,
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
                });
            })
            .catch(() => {
                // Fallback if API fails
                const phoneInput = document.querySelector("#mobile");
                window.intlTelInput(phoneInput, {
                    initialCountry: "us",
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
                });
            });
    </script>

    <!-- AJAX Form Handler -->
    <script>
        $(document).ready(function () {
            $('#contactForm').on('submit', function (e) {
                e.preventDefault();

                const recaptchaResponse = grecaptcha.getResponse();
                if (!recaptchaResponse) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'reCAPTCHA Required',
                        text: 'Please complete the reCAPTCHA to proceed.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Sending...',
                    text: 'Please wait while we process your request.',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: 'contact-us.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (res) {
                        if (res.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: res.message,
                                confirmButtonColor: '#28a745'
                            }).then(() => {
                                $('#contactForm')[0].reset();
                                grecaptcha.reset();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Network Error',
                            text: 'Unable to connect. Please check your internet connection.',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
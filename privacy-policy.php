<?php
include('admin/db/config.php');
include("env.php");
// fetch privacy policy data
$querypolicy = "SELECT * FROM policy";
$resultpolicy = $db->query($querypolicy);



// Fetch favicon
$sqlfav = "SELECT favicon FROM system_setting LIMIT 1";
if ($stmt = $db->prepare($sqlfav)) {
    $stmt->execute();
    $stmt->bind_result($favicon);
    if ($stmt->fetch()) {
        $faviconPath = "http://localhost/educationoptions/admin/logo/" . $favicon;
    }
    $stmt->close();
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Privacy Policy || Education Options </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlspecialchars($faviconPath); ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
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
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body>

    <header>
        <?php
        require_once('inc/header.php');
        require_once('inc/navbar.php');

        ?>
    </header>

    <!-- Fullscreen search -->
    <div class="search-wrap">
        <div class="search-inner">
            <i class="fal fa-times search-close" id="search-close"></i>
            <div class="search-cell">
                <form method="get">
                    <div class="search-field-holder">
                        <input type="search" class="main-search-input" placeholder="Search Entire Store...">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end fullscreen search -->

    <!-- header area end here -->

    <!-- page title area start -->
    <div class="page-title__area pt-110" style="background-image: url(assets/img/bg/aboutbg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="page__title-wrapper text-center">
                        <h3 class="pb-100">Privacy Policy</h3>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadccrumb-bg">
            <ul class="breadcrumb justify-content-center pt-20 pb-20">
                <li class="bd-items"><a href="index.php">Home</a></li>
                <li class="bd-items bdritems">|</li>
                <li class="bd-items"> <a href="about-us.php"> Privacy Policy</a></li>
            </ul>
        </nav>
    </div>
    <!-- page title area end -->

    <main class="pt-130 pb-130">
        <div class="container">
            <?php

            if ($resultpolicy->num_rows > 0) {
                $policy = $resultpolicy->fetch_assoc();
                echo $policy['content']; 
            } else {
                echo "No policy available";
            }
            ?>
        </div>
    </main>

    <!-- footer-area start -->
    <?php
    require_once('inc/footer.php');
    require_once('inc/copyright.php');
    ?>
    <!-- footer-area end -->

    <!-- JS here -->
    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
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
    <script src="assets/js/ajax-form.js"></script>
    <script src="assets/js/wow.min.js"></script>
     <!-- for newsform -->
    <script>
        $(document).ready(function () {
            $('#newsForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission
                Swal.fire({
                    title: 'Submitting...',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        $.ajax({
                            url: 'index.php',
                            type: 'POST',
                            data: $(this).serialize(),
                            // dataType: 'json',
                            success: function (response) {
                                console.log(response);
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Thank you ! We have received your message and will get back to you soon.',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6'
                                });
                                $("#newsForm")[0]
                                    .reset(); // Reset the form fields
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Submission failed: ' + error,
                                    icon: 'error',
                                    confirmButtonColor: '#d33'
                                });

                            }
                        });
                    }
                });
            });
        });
    </script>
   

</body>

</html>
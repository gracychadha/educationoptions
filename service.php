<?php

include('admin/db/config.php');
include("env.php");
$urlPath = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($urlPath, '/'));
$slug = end($segments);

$queryservice = "SELECT * FROM  services WHERE slug = '$slug'";
$resultservie = $db->query($queryservice);
$service = $resultservie->fetch_assoc();
// print_r($service);
// exit();
// fetch services
$stmtFetch1 = $db->prepare("SELECT * FROM  services WHERE STATUS ='1' ");
$stmtFetch1->execute();
$services = $stmtFetch1->get_result()->fetch_all(MYSQLI_ASSOC);
// Fetch favicon
$sqlfav = "SELECT favicon FROM system_setting LIMIT 1";
if ($stmt = $db->prepare($sqlfav)) {
    $stmt->execute();
    $stmt->bind_result($favicon);
    if ($stmt->fetch()) {
        $faviconPath = "<?= getenv('BASEURL') ?>/admin/logo/" . $favicon;
    }
    $stmt->close();
}
// print_r($sqlfav);
// exit();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $service['title'] ?> || Education Options</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlspecialchars($faviconPath); ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/animate.min.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/custom-animation.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/meanmenu.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/flaticon.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/nice-select.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/venobox.min.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/backToTop.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/slick.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/swiper-bundle.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/default.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>/assets/css/main.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- Add your site or application content here -->


    <!-- header area start here -->

    <?php
    require_once("inc/header.php");
    require_once("inc/navbar.php");
    ?>

    <!-- header area end here -->

    <!-- page title area start -->
    <div class="page-title__area pt-110"
        style="background-image: url(<?= getenv('BASEURL') ?>assets/img/bg/aboutbg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="page__title-wrapper text-center">
                        <h3 class="pb-100"><?= $service['title'] ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadccrumb-bg">
            <ul class="breadcrumb justify-content-center pt-20 pb-20">
                <li class="bd-items"><a href="<?= getenv('BASEURL') ?>index.php">Home</a></li>
                <li class="bd-items bdritems">|</li>
                <li class="bd-items"><a href="services.php/<?php echo $item['slug'] ?>"><?= $service['title'] ?></a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- page title area end -->
    <main>


        <!-- business area start here -->
        <div class="businnes-area pt-120 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-4 col-lg-4">
                        <?php
                        require_once('sidebar-service.php');
                        ?>
                    </div>

                    <div class="col-xxl-8 col-xl-8 col-lg-8">
                        <div class="sidebar__deatils">
                            <div class="visa-details">
                                <div class="visa-deatils__thumb mb-40">
                                    <img src="<?= getenv('BASEURL') ?>admin/<?= $service['image'] ?>" alt="">
                                </div>
                                <p class="mb-30"><?= $service['description'] ?></p>
                            </div>
                            <div class="business__items">
                                <div class="row">
                                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                                        <div class="business__items-single faq-bg mb-50">
                                            <i class="flaticon-requirement"></i>
                                            <h4 class="business__items-single-title mt-25 mb-20">
                                                Ensure <br> The Requrements
                                            </h4>
                                            <p>Work permit approval in higher education is designed for career
                                                professionals seeking</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                                        <div class="business__items-single faq-bg mb-50">
                                            <i class="flaticon-paperwork"></i>
                                            <h4 class="business__items-single-title mt-25 mb-20">
                                                Collection <br>
                                                The Documents
                                            </h4>
                                            <p>Work permit approval in higher education is designed for career
                                                professionals seeking</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                                        <div class="business__items-single faq-bg mb-50">
                                            <i class="flaticon-application"></i>
                                            <h4 class="business__items-single-title mt-25 mb-20">
                                                Fill Up <br>
                                                The Required From
                                            </h4>
                                            <p>Work permit approval in higher education is designed for career
                                                professionals seeking</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="necessary">
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-6">
                                        <div class="necessary__box-thumb">
                                            <img src="<?= getenv('BASEURL') ?>/assets/img/business-visa/business-1.jpg"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6">
                                        <div class="necessary__box">
                                            <h4 class="necessary__title mb-25">
                                                Necessary Documents
                                            </h4>
                                            <ul class="necessary-link mb-20">
                                                <li><i class="fal fa-check-square"></i> Two Recently taken posts must be
                                                    attas</li>
                                                <li><i class="fal fa-check-square"></i> A valid passport</li>
                                                <li><i class="fal fa-check-square"></i> Round trip reservation or
                                                    itinerary</li>
                                                <li><i class="fal fa-check-square"></i> Travel insurance policy</li>
                                                <li><i class="fal fa-check-square"></i> Proof of accommodation </li>
                                                <li><i class="fal fa-check-square"></i> Proof of paid visa fee</li>
                                            </ul>
                                            <a href="contact-us.php" class="business-btn">View More Requrements</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="information mt-60 ">
                                <h3 class="information__title mb-25">
                                    Visa Application Whole Process
                                </h3>
                                <p class="mb-30">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto, quae
                                    temporibus? Placeat ea dolorum at officiis laborum recusandae enim magni.</p>
                                <div class="row">
                                    <div class="col-xxl-6">
                                        <div class="information-info">
                                            <ul>
                                                <li><span>Processing time</span>: <span>7 - 28 Days</span></li>
                                                <li><span>Stay period</span>: <span>Up to 180 Days</span></li>
                                                <li><span>Entry Persons</span>: <span>Single / Double</span></li>
                                                <li><span>Life Insurance</span>: <span>Yes</span></li>
                                                <li><span>Medical Checkup</span>: <span>Yes</span></li>
                                                <li><span>Total Charges</span>: <span>$23,570</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xxl-6">
                                        <div class="information-right">
                                            <img src="assets/img/business-visa/bussiness-2.jpg" alt="">
                                            <div class="information__wrapper d-flex align-items-center theme-bg">
                                                <div class="information__wrapper-icon">
                                                    <i class="fal fa-headset"></i>
                                                </div>
                                                <div class="information__wrapper-cell">
                                                    <span>Call for support</span>
                                                    <h5><a href="tel:+1878298023">+1 890 565 398</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <!-- <div class="business-according">
                                <p class="mt-40 mb-40 ">England dotted with a lush, green landscape, rustic villages and
                                    throbbing with humanity. South Asian country that has plenty to offer to visitors
                                    with its diverse wildlife .We have helped students, business persons, tourists,
                                    clients with medical needs. There are many variations of passages of Lorem Ipsum
                                    available.</p>
                                <div class="tab-content mb-30">
                                    <div class="tab-pane fade show active">
                                        <div class="faq-content faq-white">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            How long does it take for a Transit Visa to process?
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            The European business visa is mainly for people who want to
                                                            participate in business meetings, conferences in Europe.
                                                            Visa holders are not allowed to work or seek employment in
                                                            Europe. Individuals and circumstances influence how long it
                                                            takes to apply for a business visa.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            What is the purpose of the United States Business visa?
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>The European business visa is mainly for people who want
                                                                to participate in business meetings, conferences in
                                                                Europe. Visa holders are not allowed to work or seek
                                                                employment in Europe. Individuals and circumstances
                                                                influence how long it takes to apply for a business
                                                                visa. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                            aria-expanded="false" aria-controls="collapseThree">
                                                            If the applicant is intending to stay more than 3 months?
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThree" class="accordion-collapse collapse"
                                                        aria-labelledby="headingThree"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>The European business visa is mainly for people who want
                                                                to participate in business meetings, conferences in
                                                                Europe. Visa holders are not allowed to work or seek
                                                                employment in Europe. Individuals and circumstances
                                                                influence how long it takes to apply for a business
                                                                visa. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree1">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseThree1"
                                                            aria-expanded="false" aria-controls="collapseThree1">
                                                            What are the important things to know as a Transit Visa
                                                            applicant?
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThree1" class="accordion-collapse collapse"
                                                        aria-labelledby="headingThree1"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>The European business visa is mainly for people who want
                                                                to participate in business meetings, conferences in
                                                                Europe. Visa holders are not allowed to work or seek
                                                                employment in Europe. Individuals and circumstances
                                                                influence how long it takes to apply for a business
                                                                visa. </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- business area end here -->

    </main>


    <!-- footer area start -->
    <?php
    require('inc/footer.php');
    require('inc/copyright.php');
    ?>

    <!-- footer area end -->
    <!-- JS here -->
    <script src="http://localhost/educationoptions/assets/js/vendor/jquery.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/isotope.pkgd.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/slick.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/swiper-bundle.js"></script>
    <script src="http://localhost/educationoptions/assets/js/jquery.nice-select.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/venobox.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/backToTop.js"></script>
    <script src="http://localhost/educationoptions/assets/js/jquery.meanmenu.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/waypoints.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/jquery.counterup.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/owl.carousel.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/ajax-form.js"></script>
    <script src="http://localhost/educationoptions/assets/js/wow.min.js"></script>
    <script src="http://localhost/educationoptions/assets/js/main.js"></script>

    <!-- form submission -->
    <script>
        $(document).ready(function () {
            $('#contactForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission
                Swal.fire({
                    title: 'Submitting...',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        $.ajax({
                            url: 'contact-us.php',
                            type: 'POST',
                            data: $(this).serialize(),
                            success: function (response) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Thank you ! We have received your message and will get back to you soon.',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6'
                                });
                                $("#contactForm")[0]
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
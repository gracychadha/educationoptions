<?php

include('admin/db/config.php');
include("env.php");
$urlPath = $_SERVER['REQUEST_URI'];
   $segments = explode('/', trim($urlPath, '/'));
   $slug = end($segments); 
//    echo "<pre>";
// print_r($slug);
// exit();
$queryservice = "SELECT * FROM  services WHERE slug = '$slug'";
$resultservie = $db->query($queryservice);
$service = $resultservie->fetch_assoc();
// print_r($service);
// exit();
// fetch services
$stmtFetch1 = $db->prepare("SELECT * FROM  services WHERE STATUS ='1' ");
$stmtFetch1->execute();
$services=$stmtFetch1->get_result()->fetch_all(MYSQLI_ASSOC);
// Fetch favicon
$sqlfav = "SELECT favicon FROM system_setting LIMIT 1";
if ($stmt = $db->prepare($sqlfav)) {
	$stmt->execute();
	$stmt->bind_result($favicon);
	if ($stmt->fetch()) {
		$faviconPath = "<?= getenv('BASEURL') ?>admin/logo/" . $favicon;
	}
	$stmt->close();
}
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
     <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
    <header>
        <?php
   
   require_once('inc/header.php');
   require_once('inc/navbar.php');
   ?>
    </header>

  

    <!-- header area end here -->

    <!-- page title area start -->
    <div class="page-title__area pt-110" style="background-image: url(<?= getenv('BASEURL') ?>assets/img/about-us/ab-us.jpg);">
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
                <li class="bd-items"><a href="services.php/<?php echo $item['slug']?>"><?= $service['title'] ?></a></li>
            </ul>
        </nav>
    </div>
    <!-- page title area end -->

    <!-- services featurs start -->
    <div class="services-featurs pt-100">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="services-fimg">
                        <img src="<?= getenv('BASEURL')?>admin/<?= $service['image'] ?>" alt="">
                    </div>
                    <div class="section_title_wrapper pt-40">
                        <span class="subtitle">
                            <?= $service['title'] ?>
                        </span>
                        <h2 class="section-title">
                            We Take The Challenge to Make The Life Easier
                        </h2>
                        <p class="pt-30 pb-25 mr-25"><?= $service['description'] ?></p>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="services-items services-itm-color mb-30">
                                <h4 class="services-items__title">
                                    Proper <br>
                                    Information
                                </h4>
                                <p>Work permit approval in higher education is designed for career professionals seeking
                                </p>
                                <a class="aborder1" href="business-visa.html"><i
                                        class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="services-items services-itm-color2 mb-30">
                                <h4 class="services-items__title">
                                    Advice & <br>
                                    Consultancy
                                </h4>
                                <p>Work permit approval in higher education is designed for career professionals seeking
                                </p>
                                <a class="aborder2" href="business-visa.html"><i
                                        class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="services-items services-itm-color3 mb-30">
                                <h4 class="services-items__title">
                                    Tour & Travel <br>
                                    Guidelines
                                </h4>
                                <p>Work permit approval in higher education is designed for career professionals seeking
                                </p>
                                <a class="aborder3" href="business-visa.html"><i
                                        class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="services-items services-itm-color4 mb-30">
                                <h4 class="services-items__title">
                                    Education <br>
                                    Tips and Tricks
                                </h4>
                                <p>Work permit approval in higher education is designed for career professionals seeking
                                </p>
                                <a class="aborder4" href="business-visa.html"><i
                                        class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services featurs end -->

    <!-- service swiper start -->
        <section class="featurs-services pt-110 pb-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-10">
                        <div class="section_title_wrapper text-center mb-50 wow fadeInUp" data-wow-delay="0.3s"
                            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                            <span class="subtitle">
                                Featured Services
                            </span>
                            <h2 class="section-title">
                                We Provide Visa & Immigration Service <br> From Experienced Lawyers
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php
                        foreach($services as $item){
                        ?>

                        <div class="swiper-slide wow fadeInUp" data-wow-delay="0.3s"
                            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                            <div class="features">
                                <div class="features__thumb">
                                    <a href="<?= getenv('BASEURL') ?>services.php/<?php echo $item['slug']?>"><img src="<?= getenv('BASEURL')?>admin/<?php echo $item['image'] ;?>"
                                            alt=""></a>
                                </div>
                                <div class="features__content">
                                    <h3 class="features__content-title"> <a
                                            href="<?= getenv('BASEURL') ?>services.php/<?php echo $item['slug']?>"><?php echo $item['title'] ;?></a>
                                    </h3>
                                    <p>
                                    </p>
                                    <a href="<?= getenv('BASEURL') ?>services.php/<?php echo $item['slug']?>">Read More <i class="fal fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>


                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

            </div>
        </section>
        <!-- swiper service end -->

    <!-- Ab-fact-area start -->

    <div class="abfact-area services-vrly pt-85 pb-285"
        style="background-image: url(<?= getenv('BASEURL') ?>/assets/img/services/services-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 mb-30">
                    <div class="fact fact-2 abfact-items text-center">
                        <h1 class="counter-count"><span class="counter">25</span>k+</h1>
                        <span>Happy Clients & Students</span>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 mb-30">
                    <div class="fact fact-2 abfact-items text-center ">
                        <h1 class="counter-count"><span class="counter">80</span>+</h1>
                        <span>Countries Affiliation</span>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 mb-30">
                    <div class="fact fact-2 abfact-items text-center ">
                        <h1 class="counter">360</h1>
                        <span>Top University Partner</span>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 mb-30">
                    <div class="fact fact-2 abfact-items text-center ">
                        <h1 class="counter-count"><span class="counter">23</span>k+</h1>
                        <span>Visa & Immigration</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ab-fact-area end -->

    <!-- intro-area start -->
    <section class="intro-area">
        <div class="container">
            <div class="row service-intro-top g-0">
                <div class="col-xxl-6 col-xl-6 col-lg-6 d-flex align-items-center">
                    <div class="section_title_wrapper pl-50 pr-70">
                        <span class="subtitle">
                            Working Process
                        </span>
                        <h2 class="section-title">
                            We Take 1-2 Working Months For Processing
                        </h2>
                        <p class="pt-30 pb-25 ">For the last 25 years, We have helped students, business persons,
                            tourists, clients with medical needs. There are many variations of passages of Lorem Ipsum
                            available.</p>
                        <div class="check-use mb-40">
                            <a href="business-visa.html"><i class="far fa-check-square"></i> Visa Requests</a>
                            <a href="business-visa.html"><i class="far fa-check-square"></i> Visa Apply</a>
                            <a href="business-visa.html"><i class="far fa-check-square"></i> Visa Service</a>
                        </div>
                        <div class="abinfro-btn d-flex align-items-center">
                            <a href="services.html" class="theme-btn">See Packages</a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="intro-right">
                        <img src="<?= getenv('BASEURL') ?>/assets/img/about-us/ab-m.jpg" alt="">
                        <div class="intro-btn">
                            <a class="play-btn popup-video" href="https://www.youtube.com/watch?v=pNje3bWz7V8"><i
                                    class="flaticon-play-button"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- intro-area end -->



    <!-- abbrand-area start -->
    <div class="abbrand-area pt-120 pb-120 wow fadeInUp" data-wow-delay="0.3s"
        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
        <div class="container">
            <div class="abbrand-active owl-carousel">
                <div class="abbrand-img">
                    <a href="partners.html"><img src="<?= getenv('BASEURL') ?>/assets/img/testimonial/1.png" alt=""></a>
                </div>
                <div class="abbrand-img">
                    <a href="partners.html"><img src="<?= getenv('BASEURL') ?>/assets/img/testimonial/2.png" alt=""></a>
                </div>
                <div class="abbrand-img">
                    <a href="partners.html"><img src="<?= getenv('BASEURL') ?>/assets/img/testimonial/3.png" alt=""></a>
                </div>
                <div class="abbrand-img">
                    <a href="partners.html"><img src="<?= getenv('BASEURL') ?>/assets/img/testimonial/4.png" alt=""></a>
                </div>
                <div class="abbrand-img">
                    <a href="partners.html"><img src="<?= getenv('BASEURL') ?>/assets/img/testimonial/5.png" alt=""></a>
                </div>
                <div class="abbrand-img">
                    <a href="partners.html"><img src="<?= getenv('BASEURL') ?>/assets/img/testimonial/4.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <!-- abbrand-area end -->

    <!-- footer area start -->
    <?php 
    require_once('inc/footer.php');
    require_once('inc/copyright.php');
    
    ?>
    <!-- footer area end -->


    <!-- JS here -->
    <script src="<?= getenv('BASEURL') ?>/assets/js/vendor/jquery.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/isotope.pkgd.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/slick.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/swiper-bundle.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/jquery.nice-select.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/venobox.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/backToTop.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/jquery.meanmenu.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/waypoints.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/jquery.counterup.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/ajax-form.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/wow.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>/assets/js/main.js"></script>
     <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
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
<?php

require_once('admin/db/config.php');
// fetch slider
$stmtFetch = $db->prepare("SELECT * FROM  sliders WHERE STATUS ='1' AND  page='home'");
$stmtFetch->execute();
$sliders = $stmtFetch->get_result()->fetch_all(MYSQLI_ASSOC);
// If no sliders found, fetch default slider
if (empty($sliders)) {
    $stmtDefault = $db->prepare("SELECT * FROM sliders WHERE status = '1' AND page = 'default'");
    $stmtDefault->execute();
    $sliders = $stmtDefault->get_result()->fetch_all(MYSQLI_ASSOC);
}
// fetch services
$stmtFetch1 = $db->prepare("SELECT * FROM  services WHERE STATUS ='1'");
$stmtFetch1->execute();
$services = $stmtFetch1->get_result()->fetch_all(MYSQLI_ASSOC);
// fetch about company
$querychooseus = "SELECT * FROM why_choose_us ";
$resultchooseus = $db->query($querychooseus);
$datachoose = $resultchooseus->fetch_assoc();
// fetch counter data
$querycounter = "SELECT * FROM counters ";
$resultcounter = $db->query($querycounter);
$counter = $resultcounter->fetch_assoc();
// fetch partner
$stmtFetch5 = $db->prepare("SELECT * FROM partners WHERE status ='1' ");
$stmtFetch5->execute();
$partners = $stmtFetch5->get_result()->fetch_all(MYSQLI_ASSOC);
// fetch testimonial
$stmtFetch6 = $db->prepare("SELECT * FROM testimonials WHERE status = 1 ORDER BY id ASC  ");
$stmtFetch6->execute();
$testimonial = $stmtFetch6->get_result()->fetch_all(MYSQLI_ASSOC);
// fetch blog
$stmtFetch7 = $db->prepare("SELECT * FROM blog  WHERE status = 1 ORDER BY idblog ASC ");
$stmtFetch7->execute();
$blog_data = $stmtFetch7->get_result()->fetch_all(MYSQLI_ASSOC);
// fetch common services data
$query_common_services = "SELECT * FROM commonservices ";
$result_common_services = $db->query($query_common_services);
$common_services = $result_common_services->fetch_assoc();
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
// to submit footer newsform
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $db->real_escape_string(trim($_POST['email']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            "status" => "error",
            "message" => "Please enter Valid mail"
        ]);
        exit();
    }
    $sql = "INSERT INTO subscriber   (email ) 
            VALUES ('$email')";
    if ($db->query($sql)) {
        echo json_encode([
            "status" => "success",
            "message" => "Thank You for reaching us out . We will get back to you soon!!!"
        ]);
        exit();
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error:" . $db->error
        ]);
        exit();
    }
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Welcome to Education options</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo ($faviconPath); ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/animate.min.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/custom-animation.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/meanmenu.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/flaticon.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/nice-select.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/venobox.min.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/backToTop.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/slick.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/swiper-bundle.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/default.css">
    <link rel="stylesheet" href="<?= getenv('BASEURL') ?>assets/css/main.css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- MeanMenu -->
    <script src="assets/js/jquery.meanmenu.min.js"></script>

    <!-- Google Translate widget -->
    <div id="google_translate_element" style="display:none;"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,fr,es,de,it,hi,ja'
            }, 'google_translate_element');
        }
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


    <style>
        @media only screen and (max-width: 786px) {
            .mySwiper3 .swiper-wrapper .swiper-slide {
                height: 400px;
            }

        }

        /* .goog-te-gadget-simple {
            height: 40px;
        }

        .goog-te-gadget-simple img {
            display: none !important;
        }
        .VIpgJd-ZVi9od-ORHb{
            visibility: hidden ;
            display:none;
        }
        .VIpgJd-ZVi9od-ORHb-OEVmcd{
            display: none;
        }
        .VIpgJd-ZVi9od-aZ2wEe-wOHMyf{
            display:none;
        } */
    </style>

</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->



    <!-- header area start here -->
    <header>

        <?php
        require_once('inc/header.php');
        require_once('inc/navbar.php');
        ?>
    </header>



    <!-- header area end here -->

    <main>
        <!-- hero area start here -->
        <div class="hero-container">
            <div class="swiper mySwiper3">
                <div class="swiper-wrapper">
                    <?php

                    foreach ($sliders as $item) {
                    ?>
                        <div class="swiper-slide ">
                            <img src="admin/<?php echo $item['image']; ?>">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <!-- carousel -->
        <!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                $first = true;
                foreach ($sliders as $item) {
                ?>
                    <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                        <img class="d-block w-100" src="admin/<?php echo htmlspecialchars($item['image']); ?>" alt="Slide">
                    </div>
                    <?php
                    $first = false;
                }
                    ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> -->
        <!-- <section class="slider-area fix">
            <div class="slider-active swiper-container" style="max-height: 480px">
                <div class="swiper-wrapper">

                    <?php
                    foreach ($sliders as $item) {
                    ?>
                        <div class="single-slider slider-height d-flex align-items-center swiper-slide"
                            data-swiper-autoplay="5000">
                            <div class="slide-bg" data-background="admin/<?php echo $item['image']; ?>"></div>
                        </div>
                        <?php
                    }
                        ?>
                </div>
                
                <div class="swiper-button-prev slide-prev"><i class="far fa-long-arrow-left"></i></div>
                <div class="swiper-button-next slide-next"><i class="far fa-long-arrow-right"></i></div>
            </div>
        </section> -->

        <!-- hero area end here -->

        <!-- visa area start here -->

        <section class="visa-area theme-bg">
            <div class="container">
                <div class="row g-0">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="visa__items br-none">
                            <div class="visa__items-single d-flex align-items-center">
                                <div class="visa__items-single-icon">
                                    <i class="flaticon-passport"></i>
                                </div>
                                <h4 class="visa__items-single-title">
                                    <a href=""><?= htmlspecialchars($common_services['title1']) ?></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="visa__items">
                            <div class="visa__items-single d-flex align-items-center">
                                <div class="visa__items-single-icon">
                                    <i class="flaticon-content"></i>
                                </div>
                                <h4 class="visa__items-single-title">
                                    <a href="#"><?= htmlspecialchars($common_services['title2']) ?></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="visa__items">
                            <div class="visa__items-single d-flex align-items-center">
                                <div class="visa__items-single-icon">
                                    <i class="flaticon-customer"></i>
                                </div>
                                <h4 class="visa__items-single-title">
                                    <a href="#"><?= htmlspecialchars($common_services['title3']) ?></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="visa__items">
                            <div class="visa__items-single d-flex align-items-center">
                                <div class="visa__items-single-icon">
                                    <i class="flaticon-passport-1"></i>
                                </div>
                                <h4 class="visa__items-single-title">
                                    <a href="#"><?= htmlspecialchars($common_services['title4']) ?></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- visa area end here -->
        <!-- About  start here -->

        <section class="about-area pt-120 pb-90">
            <div class="container">
                <div class="row wow fadeInUp" data-wow-delay="0.2s"
                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-30">
                        <div class="section_title_wrapper">
                            <span class="subtitle">
                                About Education Options
                            </span>
                            <h2 class="section-title about-span mb-30">

                                <?= htmlspecialchars($datachoose['title']) ?>
                            </h2>
                            <div class="section_title_wrapper-about-content">

                                <?= $datachoose['content'] ?>

                                <a href="about-us" class="theme-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-30">
                        <div class="about_wrapper">
                            <div class="about_wrapper__certificate">
                                <img src="<?= isset($datachoose['image4']) ? "admin/choose_us_icon/" . $datachoose['image4'] : "<?= getenv('BASEURL') ?>assets/img/about/certificate.png"
                                            ?>" alt="">
                            </div>
                            <div class="about_wrapper__group">
                                <div class="about_wrapper__group-top mb-15">
                                    <img src="<?= isset($datachoose['image3']) ? "admin/choose_us_icon/" . $datachoose['image3'] : "<?= getenv('BASEURL') ?>assets/img/about/certificate.png"
                                                ?>" alt="">
                                </div>
                                <div class="about_wrapper__group-btm d-flex align-items-center justify-content-end">
                                    <div class="about_wrapper__group-btm-img1 ml-30">
                                        <img src="admin/choose_us_icon/<?= $datachoose['image2'] ?>" alt="">
                                    </div>
                                    <div class="about_wrapper__group-btm-img2 ml-15">
                                        <img src="admin/choose_us_icon/<?= $datachoose['image1'] ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About  end here -->


        <section class="calltoaction-area d-flex align-items-center mb-80"
            style="background-image: url(<?= getenv('BASEURL') ?>assets/img/calltoaction/cl-bg.jpg);">
            <div class="container">
                <div class="row  text-center">

                    <div class="">
                        <h4 class="calltoaction-title pt-80 pb-75">
                            Empowering Your Future Through Global Education
                        </h4>
                    </div>

                </div>
            </div>
        </section>

        <section class="fact-area pb-80 wow fadeInUp" data-wow-delay="0.3s"
            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
            <div class="container">
                <div class="row">

                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 mb-30">
                        <div class="fact text-center">
                            <h1 class="counter-count"><span
                                    class="counter"><?= htmlspecialchars($counter['counter1']) ?></span>+</h1>
                            <span> <img src="admin/uploads/icons/<?= $counter['icon1'] ?>"> <?= htmlspecialchars($counter['title1']) ?></span>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 mb-30">
                        <div class="fact text-center ">
                            <h1 class="counter-count"><span
                                    class="counter"><?= htmlspecialchars($counter['counter2']) ?></span>+</h1>
                            <span><img src="admin/uploads/icons/<?= $counter['icon2'] ?>"> <?= htmlspecialchars($counter['title2']) ?></span>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 mb-30">
                        <div class="fact text-center ">
                            <h1 class="counter"><?= htmlspecialchars($counter['counter3']) ?></h1>
                            <span><img src="admin/uploads/icons/<?= $counter['icon3'] ?>"> <?= htmlspecialchars($counter['title3']) ?></span>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 mb-30">
                        <div class="fact text-center ">
                            <h1 class="counter-count"><span
                                    class="counter"><?= htmlspecialchars($counter['counter4']) ?></span>k+</h1>
                            <span><img src="admin/uploads/icons/<?= $counter['icon4'] ?>"> <?= htmlspecialchars($counter['title4']) ?></span>
                        </div>
                    </div>

                </div>
            </div>

        </section>

        <!-- Scholarship Programs start here -->
        <!-- <section class="scholarship-area d-flex align-items-center mb-4"
            style="background-image: url(<?= getenv('BASEURL') ?>assets/img/scholarship/scholarship-bg.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 ">
                        <div class="scholarship-left">
                            <img src="<?= getenv('BASEURL') ?>assets/img/scholarship/scholarship-left.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay="0.3s"
                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                        <div class="scholarship__wrapper pt-110 pb-90">
                            <h2 class="scholarship__wrapper-title mb-30">20+ Best Universities Scholarship Programs From
                                20 Countries</h2>
                            <p>We also help with other family based employment based and investment based Immigration.
                                Praesent eui vel aliquam nisl efficitur eu.</p>
                            <div class="scholarship__wrapper-img mb-40">
                                <img src="<?= getenv('BASEURL') ?>assets/img/scholarship/s-1.png" alt="">
                                <img src="<?= getenv('BASEURL') ?>assets/img/scholarship/s-2.png" alt="">
                                <img src="<?= getenv('BASEURL') ?>assets/img/scholarship/s-3.png" alt="">
                                <img src="<?= getenv('BASEURL') ?>assets/img/scholarship/s-4.png" alt="">
                                <img src="<?= getenv('BASEURL') ?>assets/img/scholarship/s-5.png" alt="">
                            </div>
                            <h5>Validity From : 05 March 2025 - 25 Jan 2026</h5>
                            <a href="contact-us" class="theme-btn blacks-hover">Apply Now </a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- Scholarship Programs end here -->

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
                <?php

                // funtionn to trim description in short according to word limit

                function trim_to_words($text, $limit = 20) //set word limit accordingly
                {
                    $words = explode(' ', $text); // convert into array on basis of space
                    if (count($words) > $limit) {  //check description
                        $words = array_slice($words, 0, $limit);   //slicing done
                        return implode(' ', $words) . '...'; // Add ellipsis
                    }
                    return $text;
                } ?>

                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php

                        foreach ($services as $item) {
                            $desc = $item['description'];
                            $short_description = trim_to_words($desc);

                        ?>

                            <div class="swiper-slide wow fadeInUp" data-wow-delay="0.3s"
                                style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                <div class="features">
                                    <div class="features__thumb">
                                        <a href="<?= getenv('BASEURL') ?>service/<?php echo $item['slug'] ?>"><img
                                                src="<?= getenv('BASEURL') ?>admin/<?php echo $item['image']; ?>"
                                                alt=""></a>
                                    </div>
                                    <div class="features__content">
                                        <h3 class="features__content-title"> <a
                                                href="<?= getenv('BASEURL') ?>service/<?php echo $item['slug'] ?>"><?php echo $item['title']; ?></a>
                                        </h3>
                                        <!-- <p class="hover-white ">

                                            <?=
                                            $short_description;
                                            ?>
                                        </p> -->
                                        <a class="service-btn "
                                            href="<?= getenv('BASEURL') ?>service/<?php echo $item['slug'] ?>">Read More
                                            <i class="fal fa-long-arrow-right"></i></a>
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


        <!-- Globall area start -->
        <section class="global-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="section_title_wrapper global-text mb-30">
                            <span class="subtitle">
                                Global Visa Business
                            </span>
                            <h2 class="section-title">
                                We Work Globally With Partners In 80+ Popular Countries
                            </h2>
                            <p>We have helped students, business persons, tourists, clients with medical needs to
                                acquire U.S. visas. Besides, we also help with other family and provide counseling
                                services for immigration </p>
                            <div class="global-subscribe">
                                <form action="#">
                                    <input type="email" placeholder=" Enter you NID No">
                                    <button type="submit">Check Availability <i
                                            class="fal fa-long-arrow-right"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="global-area-img">
                            <img src="<?= getenv('BASEURL') ?>assets/img/eo/global-map.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Globall area end -->

        <!-- Calltoaction area start -->
        <section class="calltoaction-area d-flex align-items-center"
            style="background-image: url(<?= getenv('BASEURL') ?>assets/img/calltoaction/cl-bg.jpg);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-3 col-xl-3 col-lg-3">
                        <div class="calltoaction-img ">
                            <img src="<?= getenv('BASEURL') ?>assets/img/calltoaction/cl-1.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8">
                        <h4 class="calltoaction-title pt-80 pb-75">
                            Get a skilled job in abroad taking our technical courses
                        </h4>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4">
                        <div class="calltoaction-btn text-right">
                            <a href="contact-us" class="theme-btn cl-btn">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Calltoaction area end -->



        <!-- Our Partners start -->
        <section class="partners-area pt-120 pb-100"
            style="background-image: url(<?= getenv('BASEURL') ?>assets/img/partners/partners-1.png);">
            <div class="container">
                <div class="row ">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay="0.3s"
                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                        <div class="section_title_wrapper partners-65 mb-30">
                            <span class="subtitle">
                                Our Partners
                            </span>
                            <h2 class="section-title">
                                Our Partner Companies <br>And Institutions
                            </h2>
                            <p class="mt-30 mb-40">We have helped students, business persons, tourists, clients with
                                medical needs to acquire U.S. visas. Besides, we also help with other family and provide
                                counseling services for immigration </p>
                            <a href="partners" class="theme-btn partner-btn">See All Partners</a>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay="0.5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="row g-0">
                            <?php
                            foreach ($partners as $item) {
                            ?>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="partner-img">
                                        <a href="partners"><img src="admin/<?php echo $item['image']; ?>" alt=""></a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Our Partners end -->


        <!-- Testimonial 2 start -->
        <div class="testimonial-2 pt-110 pb-135 d-flex align-items-center"
            style="background-image: url(assets/img/testimonial/testi1-bg.jpg);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-10">
                        <div class="section_title_wrapper text-center mb-20 ">
                            <span class="">
                                Testimonials
                            </span>
                            <h2 class="text-white">
                                What Clients Say About Us and <br> Our Services
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="testimonail2-active  owl-carousel text-center testi-pad">
                        <?php
                        foreach ($testimonial as $item) {
                        ?>
                            <div class="testimonail__wrapper testimonail__wrapper2">
                                <div class="testimonail__header">
                                    <div class="testimonail__header__img mb-25">
                                        <img src="assets/img/testimonial/tauthor-1.png" alt="">
                                    </div>
                                    <div class="testimonail__header__content mb-35">
                                        <h4><?php echo $item['name']; ?></h4>
                                        <p><?php echo $item['designation']; ?></p>
                                    </div>
                                </div>
                                <div class="testimonail__body mb-35">
                                    <p><?php echo $item['message']; ?></p>
                                </div>
                                <div class="testimonail__footer">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <!-- <li>(Switzerland Visa)</li> -->
                                    </ul>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial 2 end -->

        <!-- Blog start -->
        <section class="blog-area pt-120 pb-90 wow fadeInUp" data-wow-delay="0.3s"
            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="section_title_wrapper mb-50">
                            <span class="subtitle">
                                Our Latest Insights
                            </span>
                            <h2 class="section-title">
                                Recent Updates of Visa <br> And Immagration
                            </h2>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="section-title-right mb-30 mr-20">
                            <p>Stay updated with the latest insights, tips, and stories from our experts. Explore a
                                variety of topics designed to inform, inspire, and keep you connected with what matters
                                most.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    foreach ($blog_data as $item) {
                        $content = $item['content'];
                        $short_content = trim_to_words($content);
                    ?>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                            <article class="blog mb-30">
                                <div class="blog__thumb">
                                    <a href=""><img src="<?= getenv('BASEURL') ?>admin/<?= $item['image'] ?>" alt=""></a>
                                </div>
                                <div class="blog__content">
                                    <div class="blog-meta">
                                        <span> <i class="far fa-user"></i><a
                                                href="blog-details?id=<?= htmlspecialchars(base64_encode($item['idblog'])) ?>"><?= $item['title'] ?></a></span>
                                        <span> <i class=" fal fa-calendar-day"></i>
                                            <?= date("M j", strtotime($item['date'])) ?></span>
                                        <!-- <span><i class="far fa-comments"></i><a href="news-details.html">(36)</a></span> -->
                                    </div>
                                    <div class="blog-text">
                                        <h3 class="blog__content__title">
                                            <a
                                                href="blog-details?id=<?= htmlspecialchars(base64_encode($item['idblog'])) ?>"><?= $item['title'] ?></a>
                                        </h3>
                                        <p><?= $short_content ?></p>
                                        <div class="read-more theme-btn">
                                            <a
                                                href="blog-details?id=<?= htmlspecialchars(base64_encode($item['idblog'])) ?>">Read
                                                More </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </section>
        <!-- Blog end -->
    </main>

    <!-- Footer start -->

    <?php
    require_once('inc/footer.php');
    require_once('inc/copyright.php');
    ?>




    <!-- Footer end -->



    <!-- JS here -->
    <script src="<?= getenv('BASEURL') ?>assets/js/vendor/jquery.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/isotope.pkgd.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/slick.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/swiper-bundle.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/jquery.nice-select.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/venobox.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/backToTop.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/jquery.meanmenu.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/waypoints.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/jquery.counterup.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/ajax-form.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/wow.min.js"></script>
    <script src="<?= getenv('BASEURL') ?>assets/js/main.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Bootstrap 4.6 JS + jQuery + Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
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
            breakpoints: {

                768: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },

            },
        });
    </script>
    <!-- for newsform -->
    <script>
        $(document).ready(function() {
            $('#newsForm').on('submit', function(e) {
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
                            success: function(response) {
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
                            error: function(xhr, status, error) {
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
    <script>
        var swiper = new Swiper(".mySwiper3", {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

        });
    </script>
</body>

</html>
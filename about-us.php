<?php
require_once("admin/db/config.php");
// fetch services
$stmtFetch1 = $db->prepare("SELECT * FROM  services WHERE STATUS ='1' ");
$stmtFetch1->execute();
$services = $stmtFetch1->get_result()->fetch_all(MYSQLI_ASSOC);
// fetch partner
$stmtFetch5 = $db->prepare("SELECT * FROM partners WHERE status ='1' ");
$stmtFetch5->execute();
$partners = $stmtFetch5->get_result()->fetch_all(MYSQLI_ASSOC);
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
    <title>About Us || Education Options </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlspecialchars($faviconPath); ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/animate.min.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/custom-animation.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/meanmenu.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/flaticon.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/nice-select.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/venobox.min.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/backToTop.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/slick.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/swiper-bundle.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/default.css">
    <link rel="stylesheet" href="http://localhost/educationoptions/assets/css/main.css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* dont remove partner styling  */
        .partner-item {
            background: rgba(255, 255, 255, 0.08);
            padding: 30px 20px;
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            height: 120px;
            width: 250px;
            background-position: center center;
            background-size: cover;
        }

        .partner-item:hover {
            transform: translateY(-8px);
            /* background: rgba(255, 255, 255, 0.15); */
        }

        .partner-container-div {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
    </style>
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
                        <h3 class="pb-100">About Us </h3>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadccrumb-bg">
            <ul class="breadcrumb justify-content-center pt-20 pb-20">
                <li class="bd-items"><a href="index.php">Home</a></li>
                <li class="bd-items bdritems">|</li>
                <li class="bd-items"> <a href="about-us.php"> About Us</a></li>
            </ul>
        </nav>
    </div>
    <!-- page title area end -->

    <main>
        <!-- About-us area start here -->
        <section class="about-area-2 pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-30 wow fadeInUp" data-wow-delay="0.3s"
                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                        <div class="about2-left d-flex">
                            <div class="about2-left__img1 mr-10">
                                <img src="assets/img/about/about-1.jpg" alt="">
                            </div>
                            <div class="about2-left__img2">
                                <img src="assets/img/about/about-2.jpg" alt="">
                                <div class="about2-left__info d-flex align-items-center">
                                    <div class="about2-left__info__left mr-15">
                                        <img src="assets/img/about/certify.png" alt="" style="max-height:55px;">
                                    </div>
                                    <div class="about2-left__info__right">
                                        <h4>ISO Certified</h4>
                                        <p>1990-2000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-30 wow fadeInUp" data-wow-delay="0.5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="section_title_wrapper">
                            <span class="subtitle">
                                About visapass
                            </span>
                            <h2 class="section-title about-span mb-30 ">
                                <span>25+</span> Years of Your Trust <br> and Recommendation
                            </h2>
                            <div class="section_title_wrapper__about-content mb-40">
                                <p>For the last 25 years, We have helped students, business persons,clients with medical
                                    needs. There are many variations tourists, clients with medical needs. There are
                                    many variations of passages of Lorem Ipsum available, but the majority have suffered
                                    alteration tourists, clients with medical needs. There are many variations</p>
                            </div>
                        </div>
                        <div class="about-trust">
                            <div class="row mb-10">
                                <div class="col-lg-6">
                                    <div class="about2__item d-flex  mb-20">
                                        <div class="about2__icon">
                                            <i class="flaticon-fair-trade"></i>
                                        </div>
                                        <div class="about2__content">
                                            <h4>Trusted by Millions</h4>
                                            <p>Most trusted & recommended by millions of students</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="about2__item d-flex  mb-20">
                                        <div class="about2__icon">
                                            <i class="flaticon-trophy"></i>
                                        </div>
                                        <div class="about2__content">
                                            <h4>Awards Winner</h4>
                                            <p>Most trusted & recommended by millions of students</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About-us area end here -->

        <!-- Histry Tabs area start here -->
        <div class="histry-area pt-110 pb-90" style="background-image: url(assets/img/bg/about-bg.jpg);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-10">
                        <div class="section_title_wrapper text-center wow fadeInUp" data-wow-delay="0.3s"
                            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                            <h2 class=" white-color">
                                Visapass Carries 25+ Year's <br> Awesome History
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Histry Tabs area end here -->

        <!-- About- Tabs area start here -->
        <div class="ab-tabs pb-70">
            <div class="abtb-hr1">
                <span></span>
            </div>
            <div class="abtb-pth">
                <img src="assets/img/about/pth.png" alt="">
            </div>
            <div class="container">
                <div class="row ">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                        <div class="price-tab pb-130 abtab-top">
                            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link nav-radius active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true">1990 - 1995</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">1996 - 2000</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab1" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">2001 - 2005</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">2006 - 2010</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link navr-radius" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">2011 - 2020</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="row ">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content text-right pr-105 mb-45">
                                    <div class="abtbs-round">
                                        <span></span>
                                    </div>
                                    <div class="abtb-mbr">
                                        <span></span>
                                    </div>
                                    <span>22 jan 1995</span>
                                    <h4 class="abtb-title">
                                        Started Journey in New York
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content pl-105 mb-45">
                                    <span>25 Aug 1994</span>
                                    <h4 class="abtb-title">
                                        First Trophy Winner in World
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content text-right pr-105 mb-45">
                                    <div class="abtbs-round">
                                        <span></span>
                                    </div>
                                    <div class="abtb-mbr">
                                        <span></span>
                                    </div>
                                    <span>22 jan 1995</span>
                                    <h4 class="abtb-title">
                                        Started Journey in New York
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content pl-105 mb-45">
                                    <span>25 Aug 1994</span>
                                    <h4 class="abtb-title">
                                        First Trophy Winner in World
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row ">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content text-right pr-105 mb-45">
                                    <div class="abtbs-round">
                                        <span></span>
                                    </div>
                                    <div class="abtb-mbr">
                                        <span></span>
                                    </div>
                                    <span>22 jan 1995</span>
                                    <h4 class="abtb-title">
                                        Started Journey in New York
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content pl-105 mb-45">
                                    <span>25 Aug 1994</span>
                                    <h4 class="abtb-title">
                                        First Trophy Winner in World
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content text-right pr-105 mb-45">
                                    <div class="abtbs-round">
                                        <span></span>
                                    </div>
                                    <div class="abtb-mbr">
                                        <span></span>
                                    </div>
                                    <span>22 jan 1995</span>
                                    <h4 class="abtb-title">
                                        Started Journey in New York
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content pl-105 mb-45">
                                    <span>25 Aug 1994</span>
                                    <h4 class="abtb-title">
                                        First Trophy Winner in World
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="row ">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content text-right pr-105 mb-45">
                                    <div class="abtbs-round">
                                        <span></span>
                                    </div>
                                    <div class="abtb-mbr">
                                        <span></span>
                                    </div>
                                    <span>22 jan 1995</span>
                                    <h4 class="abtb-title">
                                        Started Journey in New York
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content pl-105 mb-45">
                                    <span>25 Aug 1994</span>
                                    <h4 class="abtb-title">
                                        First Trophy Winner in World
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content text-right pr-105 mb-45">
                                    <div class="abtbs-round">
                                        <span></span>
                                    </div>
                                    <div class="abtb-mbr">
                                        <span></span>
                                    </div>
                                    <span>22 jan 1995</span>
                                    <h4 class="abtb-title">
                                        Started Journey in New York
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="abtb-content pl-105 mb-45">
                                    <span>25 Aug 1994</span>
                                    <h4 class="abtb-title">
                                        First Trophy Winner in World
                                    </h4>
                                    <p>Bring to the table win-win survival strategies to ensure proactive domination. At
                                        the end of the day, going forward, a new normal that has evolved from
                                        generation.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About- Tabs area end here -->

        <!-- Ab-fact-area start -->

        <div class="abfact-area pt-80 pb-170" style="background-image: url(assets/img/bg/aboutbg2.jpg);">
            <div class="container">
                <div class="row mb-20">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 mb-30">
                        <div class="fact fact-2 abfact-items text-center">
                            <h1 class="counter-count"><span class="counter">25</span>k+</h1>
                            <span>Happy Clients & Students</span>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 mb-30 ">
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
                <div class="row abintro-top g-0">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 d-flex align-items-center wow fadeInUp"
                        data-wow-delay="0.3s"
                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                        <div class="section_title_wrapper pl-50 pr-70 wow fadeInUp" data-wow-delay="0.5s"
                            style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                            <span class="subtitle">
                                What Drives Us
                            </span>
                            <h2 class="section-title">
                                Our Mission Is Rooted in Lasting Impact
                            </h2>
                            <p class="pt-30 pb-30 " align="justify">At Education Options Visa, our mission is to empower
                                students by opening doors to global educational opportunities. We are committed to
                                providing honest, personalized, and end-to-end guidance for study abroad and visa
                                processes. From course selection to university admissions and visa approvals, we ensure
                                every step is clear, informed, and aligned with each student’s aspirations.</p>
                            <div class="abinfro-btn d-flex align-items-center">
                                <a href="contact-us" class="theme-btn">See Packages</a>
                                <a href="#0" class="btn-download"> <i class="fal fa-download"></i> Download Brochure</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay="0.5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="intro-right">
                            <img src="assets/img/about/mission.jpg" alt="">
                            <!-- <div class="intro-btn">
                                <a class="play-btn popup-video" href="https://www.youtube.com/watch?v=pNje3bWz7V8"><i
                                        class="flaticon-play-button"></i></a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- intro-area end -->

        <!-- Testimonail start -->
        <!-- <section class="testimonail-area pt-110 pb-190">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-10">
                        <div class="section_title_wrapper text-center mb-50">
                            <span class="subtitle">
                                Testimonials
                            </span>
                            <h2 class="section-title">
                                What Clients Say About Us and <br> Our Services
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="textimonail-active owl-carousel">
                        <div class="testimonail__wrapper">
                            <div class="testimonail__wrapper__info d-flex align-items-center mb-30">
                                <div class="testimonail__wrapper__info__img ">
                                    <img src="assets/img/testimonial/ts-1.png" alt="">
                                </div>
                                <div class="testimonail__wrapper__info__author">
                                    <h4>Daniel Groveria</h4>
                                    <span>Student</span>
                                </div>
                                <div class="testimonail__wrapper__info__quotes">
                                    <i class="flaticon-quote"></i>
                                </div>
                            </div>
                            <div class="testimonail__wrapper__content">
                                <p>Travellers from countries categorized under the high-risk list who are eligible to
                                    enter Germany, aged 12 and older, are obliged to present their vaccination
                                    certificates</p>
                                <div class="testimonail__wrapper__content__reviews">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li>(Switzerland Visa)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="testimonail__wrapper">
                            <div class="testimonail__wrapper__info d-flex align-items-center mb-30">
                                <div class="testimonail__wrapper__info__img ">
                                    <img src="assets/img/testimonial/ts-2.png" alt="">
                                </div>
                                <div class="testimonail__wrapper__info__author">
                                    <h4>Daniel Groveria</h4>
                                    <span>Student</span>
                                </div>
                                <div class="testimonail__wrapper__info__quotes">
                                    <i class="flaticon-quote"></i>
                                </div>
                            </div>
                            <div class="testimonail__wrapper__content">
                                <p>Travellers from countries categorized under the high-risk list who are eligible to
                                    enter Germany, aged 12 and older, are obliged to present their vaccination
                                    certificates</p>
                                <div class="testimonail__wrapper__content__reviews ">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li>(Switzerland Visa)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="testimonail__wrapper">
                            <div class="testimonail__wrapper__info d-flex align-items-center mb-30">
                                <div class="testimonail__wrapper__info__img ">
                                    <img src="assets/img/testimonial/ts-3.png" alt="">
                                </div>
                                <div class="testimonail__wrapper__info__author">
                                    <h4>Daniel Groveria</h4>
                                    <span>Student</span>
                                </div>
                                <div class="testimonail__wrapper__info__quotes">
                                    <i class="flaticon-quote"></i>
                                </div>
                            </div>
                            <div class="testimonail__wrapper__content">
                                <p>Travellers from countries categorized under the high-risk list who are eligible to
                                    enter Germany, aged 12 and older, are obliged to present their vaccination
                                    certificates</p>
                                <div class="testimonail__wrapper__content__reviews">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li>(Switzerland Visa)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="testimonail__wrapper">
                            <div class="testimonail__wrapper__info d-flex align-items-center mb-30">
                                <div class="testimonail__wrapper__info__img ">
                                    <img src="assets/img/testimonial/ts-1.png" alt="">
                                </div>
                                <div class="testimonail__wrapper__info__author">
                                    <h4>Daniel Groveria</h4>
                                    <span>Student</span>
                                </div>
                                <div class="testimonail__wrapper__info__quotes">
                                    <i class="flaticon-quote"></i>
                                </div>
                            </div>
                            <div class="testimonail__wrapper__content">
                                <p>Travellers from countries categorized under the high-risk list who are eligible to
                                    enter Germany, aged 12 and older, are obliged to present their vaccination
                                    certificates</p>
                                <div class="testimonail__wrapper__content__reviews">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li>(Switzerland Visa)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="testimonail__wrapper">
                            <div class="testimonail__wrapper__info d-flex align-items-center mb-30">
                                <div class="testimonail__wrapper__info__img ">
                                    <img src="assets/img/testimonial/ts-1.png" alt="">
                                </div>
                                <div class="testimonail__wrapper__info__author">
                                    <h4>Daniel Groveria</h4>
                                    <span>Student</span>
                                </div>
                                <div class="testimonail__wrapper__info__quotes">
                                    <i class="flaticon-quote"></i>
                                </div>
                            </div>
                            <div class="testimonail__wrapper__content">
                                <p>Travellers from countries categorized under the high-risk list who are eligible to
                                    enter Germany, aged 12 and older, are obliged to present their vaccination
                                    certificates</p>
                                <div class="testimonail__wrapper__content__reviews">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li>(Switzerland Visa)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="testimonail__wrapper">
                            <div class="testimonail__wrapper__info d-flex align-items-center mb-30">
                                <div class="testimonail__wrapper__info__img ">
                                    <img src="assets/img/testimonial/ts-1.png" alt="">
                                </div>
                                <div class="testimonail__wrapper__info__author">
                                    <h4>Daniel Groveria</h4>
                                    <span>Student</span>
                                </div>
                                <div class="testimonail__wrapper__info__quotes">
                                    <i class="flaticon-quote"></i>
                                </div>
                            </div>
                            <div class="testimonail__wrapper__content">
                                <p>Travellers from countries categorized under the high-risk list who are eligible to
                                    enter Germany, aged 12 and older, are obliged to present their vaccination
                                    certificates</p>
                                <div class="testimonail__wrapper__content__reviews">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li>(Switzerland Visa)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="testimonail__wrapper">
                            <div class="testimonail__wrapper__info d-flex align-items-center mb-30">
                                <div class="testimonail__wrapper__info__img ">
                                    <img src="assets/img/testimonial/ts-1.png" alt="">
                                </div>
                                <div class="testimonail__wrapper__info__author">
                                    <h4>Daniel Groveria</h4>
                                    <span>Student</span>
                                </div>
                                <div class="testimonail__wrapper__info__quotes">
                                    <i class="flaticon-quote"></i>
                                </div>
                            </div>
                            <div class="testimonail__wrapper__content">
                                <p>Travellers from countries categorized under the high-risk list who are eligible to
                                    enter Germany, aged 12 and older, are obliged to present their vaccination
                                    certificates</p>
                                <div class="testimonail__wrapper__content__reviews">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li>(Switzerland Visa)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- Testimonail end -->

        <!-- Team area start -->
        <?php
        require_once('team-section.php');
        ?>
        <!-- Team area end -->


        <!-- abbrand-area start -->
        <!-- <div class="abbrand-area pt-120 pb-120 wow fadeInUp" data-wow-delay="0.3s"
            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
            <div class="container">
                <div class="abbrand-active owl-carousel">
                    <?php
                    foreach ($partners as $item) {
                        ?>
                        <div class="abbrand-img wow fadeInUp" data-wow-delay="0.3s"
                            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                            <a href="partners.php"><img src="admin/<?php echo $item['image']; ?>" alt=""></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div> -->
        <!-- abbrand-area end -->

      
    </main>

    <!-- footer-area start -->
    <?php
    require_once('inc/footer.php');
    require_once('inc/copyright.php');
    ?>
    <!-- footer-area end -->

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
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- swiper for team -->
    <script>
        var swiper = new Swiper(".mySwiper1", {
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
                    spaceBetween: 20,
                },

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
<?php
require_once("admin/db/config.php");
include("env.php");


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
// fetch partner
$stmtFetch5 = $db->prepare("SELECT * FROM partners WHERE status ='1' ");
$stmtFetch5->execute();
$partners=$stmtFetch5->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Partners || Education Options</title>
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
    <div class="page-title__area pt-110" style="background-image: url(assets/img/about-us/ab-us.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="page__title-wrapper text-center">
                        <h3 class="pb-100">Our Partners</h3>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadccrumb-bg">
            <ul class="breadcrumb justify-content-center pt-20 pb-20">
                <li class="bd-items"><a href="index.php">Home</a></li>
                <li class="bd-items bdritems">|</li>
                <li class="bd-items"> <a href="partners.php">Our Partners</a></li>
            </ul>
        </nav>
    </div>
    <!-- page title area end -->

    <main>
        <!--  partners-ofinner-area start -->
        <div class="partners-ofinner-area pt-120 pb-90">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="section_title_wrapper mb-50">
                            <span class="subtitle">
                                Honorable Partners
                            </span>
                            <h2 class="section-title">
                                We've Some Honorable Partners Globally
                            </h2>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="section-title-right mb-30 mr-20">
                            <p>Partner Institutes & Universities Lorem Ipsum is simply dummy text of the printing has
                                been the standard. when an unknown printer took a galley of type and scrambled it to
                                make a type specimen book.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="project-filter">
                            <ul>
                                <li class="active" data-filter="*">See All</li>
                                <li data-filter=".unitedstates">United States</li>
                                <li data-filter=".canada">Canada</li>
                                <li data-filter=".australia">Australia</li>
                                <li data-filter=".france">France</li>
                                <li data-filter=".unitedkingdom">United Kingdom</li>
                                <li data-filter=".switzerland">Switzerland</li>
                                <li data-filter=".newzealand">New Zealand</li>
                                <li data-filter=".china">China</li>
                                <li data-filter=".norway">Norway</li>
                                <li data-filter=".germany">Germany</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="row project-grid g-0">
                    <div class="col-xxl-2 partner-item canada unitedstates france unitedkingdom newzealand norway">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-1.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item unitedstates australia unitedkingdom china">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-2.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item switzerland canada australia china norway">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-3.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item canada finance newzealand">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-4.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item switzerland consultancy newzealand china">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-5.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item switzerland australia germany">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-6.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item unitedstates finance france newzealand">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-7.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item switzerland">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-8.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item unitedstates australia unitedkingdom newzealand">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-9.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item canada newzealand china germany">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-10.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item canada france germany">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-11.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item unitedstates canada france unitedkingdom china">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-12.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item unitedstates canada france unitedkingdom china">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-13.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item unitedstates canada france unitedkingdom china">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-14.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item unitedstates canada france unitedkingdom china">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-15.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item unitedstates canada france unitedkingdom china">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-16.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item unitedstates canada france unitedkingdom china">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-17.png" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-2 partner-item unitedstates canada france unitedkingdom china">
                        <div class="partner-img">
                            <img src="assets/img/partners/pt-18.png" alt="">
                        </div>
                    </div>
                </div> -->
               
                
                <div class="partner-container">
                     <?php
                foreach($partners as $item){
                ?>
                    <div class="col-xxl-2 partner-item canada unitedstates france unitedkingdom newzealand norway">
                        <div class="partner-img">
                            <img src="admin/<?php echo $item['image'] ;?>" alt="">
                        </div>
                    </div>
                 <?php
                }
                ?>
                </div>
               
                <div class="load-more text-center mt-60">
                    <a href="#" class="theme-btn">Load More</a>
                </div>
            </div>
        </div>
        <!--  partners-ofinner-area end -->
    </main>

    <!-- footer area start -->
    <?php
    require_once("inc/footer.php");
    require_once("inc/copyright.php");
    ?>
    <!-- footer area end -->

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
    <script src="assets/js/main.js"></script>
</body>

</html>
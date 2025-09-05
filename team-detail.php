<?php

require_once("admin/db/config.php");
require("env.php");
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

// Check if the event  ID is provided in the URL
if (isset($_GET['id'])) {
    // Decode the base64-encoded ID
    $event_id = base64_decode($_GET['id']);

    // Query to fetch the details of the selected event post
    $query_event = "SELECT *  FROM team_members WHERE idteam_members = ? AND status = 1";
    $stmt = $db->prepare($query_event);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result_event = $stmt->get_result();

    // Check if the event post is found
    if ($result_event->num_rows > 0) {
        $row_event = $result_event->fetch_assoc();

        // Extracting event post details
        $title = $row_event["member_name"];
       $designation = $row_event["role"];
        $image = $row_event["profile_picture"];
        $description = $row_event["bio"];
        $email = $row_event["email"];
        $phone = $row_event["phone"];
        $linkedin = $row_event["linkedin"];
        $facebook = $row_event["facebook"];
        $twitter = $row_event["twitter"];
        // print_r($title);
        // exit();
      
    } else {
        echo "<p>Event not found or has been removed.</p>";
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    echo "<p>Invalid request.</p>";
    exit();
}

// Close the connection
// $db->close();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Team Details || Education Options</title>
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
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- Add your site or application content here -->

      <header>

        <?php
        require_once('inc/header.php');
        require_once('inc/navbar.php');
        ?>
    </header>

<!-- header area end here -->

<!-- page title area start -->
<div class="page-title__area pt-110" style="background-image: url(http://localhost/educationoptions/assets/img/bg/about-bg.jpg);">
    <div class="container">
        <div class="row">
           <div class="col-xxl-12">
              <div class="page__title-wrapper text-center">
                 <h3 class="pb-100">Team</h3>
              </div>
           </div>
        </div>
     </div>
     <nav class="breadccrumb-bg">
        <ul class="breadcrumb justify-content-center pt-20 pb-20">
           <li class="bd-items"><a href="http://localhost/educationoptions/">Home</a></li>
           <li class="bd-items bdritems">|</li>
           <li class="bd-items"> <a href="">Our Team</a></li>
        </ul>
     </nav>
</div>
 <!-- page title area end -->

  <!-- tagent  area start -->
<!-- <section class="tagent__area mb-90 grey-bg-3 pt-110 pb-40">
    <div class="tagent__bg" style="background-image: url(http://localhost/educationoptions/assets/img/team/team.jpg);"></div>
    <div class="container">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 d-flex align-items-center">
                <div class="section_title_wrapper pr-70">
                    <span class="subtitle">
                        Authorized Agents
                    </span>                       
                    <h2 class="section-title">
                        Agents are Dedicatedly Working With Us
                    </h2>
                    <p class="pt-30 mb-40">We have helped students, business persons, tourists, clients with medical needs to acquire U.S. visas. Besides, we also help with other family and provide counseling services for immigration </p>
                    <a href="contact-us" class="theme-btn">Join With Us</a>
                </div>
            </div> 
        </div>
    </div>
 </section> -->
  <!-- tagent area end -->

<!-- team details area start -->
<section class="team__details pt-120 pb-160">
    <div class="container">
        <div class="team__details-inner p-relative white-bg">
            <div class="team__details-shape p-absolute wow fadeInRight" data-wow-delay=".2s">
                <img src="http://localhost/educationoptions/assets/img/icon/team/shape-1.png" alt="">
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="team__details-img w-img mr-50">
                        <img src="http://localhost/educationoptions/admin/<?= $image?>" class="w-100" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="team__details-content pt-105">
                        <span class="wow fadeInUp" data-wow-delay=".4s"><?= $designation?></span>
                        <h3 class="wow fadeInUp" data-wow-delay=".6s"><?= $title ?></h3>
                        <p class="wow fadeInUp" data-wow-delay=".8s">At Education Options , our team is made up of dedicated professionals with expertise in international education, student visa processes, and career counseling. </p>
                        <div class="team__details-contact mb-45">
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay="1s">
                                    <div class="icon">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="text">
                                        <span><a href="/cdn-cgi/l/email-protection#abd8dedbdbc4d9dfebd1c2c9c9ced985c8c4c6"><span class="__cf_email__" data-cfemail="c1b2b4b1b1aeb3b581bba8a3a3a4b3efa2aeac">[email&#160;protected]</span></a></span>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-delay="1s">
                                    <div class="icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="text">
                                        <span><a href="tel:(+642)-394-396-432">(+642) 394 396 432</a></span>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-delay="1s">
                                    <div class="icon">
                                        <i class="fal fa-map-marker-alt"></i>
                                    </div>
                                    <div class="text">
                                        <span>Ave 14th Street, Mirpur 210, <br> San Franciso, USA 3296.</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="team__details-social theme-social wow fadeInUp" data-wow-delay="1s">
                            <ul>
                                <li>
                                    <a href="<?= $facebook ?>">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $twitter ?>">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-10 offset-xl-1">
                <div class="team__details-info mt-60">
                    <h4 class="wow fadeInUp" data-wow-delay=".4s">Information</h4>
                    <p class="wow fadeInUp" data-wow-delay=".6s"><?= $description ?></p>
                    <a href="contact-us" class="theme-btn blacks-hover mt-10">Appionment </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- team details area end -->

 <!-- Footer start -->

    <?php
    require_once('inc/footer.php');
    require_once('inc/copyright.php');
    ?>




    <!-- Footer end -->


    <!-- JS here -->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="http://localhost/educationoptions/assets/js/vendor/jquery.min.js"></script>
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
</body>

</html>
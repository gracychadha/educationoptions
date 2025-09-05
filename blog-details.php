<?php
require_once("admin/db/config.php");
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
    $query_event = "SELECT *  FROM blog WHERE idblog = ? AND status = 1";
    $stmt = $db->prepare($query_event);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result_event = $stmt->get_result();

    // Check if the event post is found
    if ($result_event->num_rows > 0) {
        $row_event = $result_event->fetch_assoc();

        // Extracting event post details
        $title = $row_event["title"];
       $description = $row_event["content"];
       $image = $row_event["image"];
       $publish = $row_event["user"];
       $date = $row_event["date"];
        // print_r($date);
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

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Blog Details || Education Options</title>
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
                 <h3 class="pb-100"><?= $title ?></h3>
              </div>
           </div>
        </div>
     </div>
     <nav class="breadccrumb-bg">
        <ul class="breadcrumb justify-content-center pt-20 pb-20">
           <li class="bd-items"><a href="http://localhost/educationoptions/">Home</a></li>
           <li class="bd-items bdritems">|</li>
           <li class="bd-items"><a href="blog-details.php">Blog Details</a></li>
        </ul>
     </nav>
</div>
 <!-- page title area end -->


        <!-- blog area start here -->
        <section class="blog-details-area pt-120 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog__details--wrapper mr-50 mb-50">
                            <div class="ablog ablog-4 mb-55">
                                <div class="ablog__img wow fadeInUp">
                                    <img src="admin/<?=$image?>" class="img-fluid" alt="img">
                                </div>
                                <div class="ablog__text ablog__text4">
                                    <div class="ablog__meta ablog__meta4">
                                        <ul>
                                            <li><a href="#0"><i class="far fa-calendar-check"></i> <?= $date ?></a></li>
                                            <li><a href="#0"><i class="far fa-user"></i> <?= $publish ?></a></li>
                                            <li><a href="#0"><i class="fal fa-comments"></i> No Comments</a></li>
                                        </ul>
                                    </div>
                                    <h3 class="ablog__text--title4 mb-20"><?= $title ?></h3>
                                    <p class="mb-30"><?= $description?></p>
                                    <blockquote class="wow fadeInUp">
                                        <p>Tosser argy-bargy mush loo at public school Elizabeth up the duff buggered chinwag on your bike mate don’t get shirty with me super, Jeffrey bobby Richard cheesed off spend a penny a load of old tosh blag horse.</p>
                                        <p><cite>Topmost Deo</cite></p>
                                    </blockquote>
                                    <!-- <p class="mb-30 wow fadeInUp">Cheeky bugger cracking goal starkers lemon squeezy lost the plot pardon me no biggie the BBC burke gosh boot so I said wellies, zonked a load of old tosh bodge barmy skive off he legged it morish spend a penny my good sir wind up hunky-dory. Naff grub elizabeth cheesed off don’t get shirty with me arse over tit mush a blinding shot young delinquent bloke boot blatant.</p>
                                    <div class="blog__details--thumb mb-30 wow fadeInUp">
                                        <img src="assets/img/blog/blog-single/b7.jpg" class="img-fluid" alt="img">
                                    </div>
                                    <h4 class="blog__details--subtitle wow fadeInUp">Visapass is the only theme you will ever need</h4>
                                    <p class="mb-30 wow fadeInUp">Are you taking the piss young delinquent wellies absolutely bladdered the Eaton my good sir, cup of tea spiffing bleeder David mufty you mug cor blimey guvnor, burke bog-standard brown bread wind up barney. Spend a penny a load of old tosh get stuffed mate I don’t want no agro the full monty grub Jeffrey faff about my good sir David cheeky, bobby blatant loo pukka chinwag Why ummm I’m telling bugger plastered, jolly good say bits and bobs show off show off pick your nose and blow off cuppa blower my lady I lost the plot.</p>
                                    <p class="mb-40 wow fadeInUp">Cheeky bugger cracking goal starkers lemon squeezy lost the plot pardon me no biggie the BBC burke gosh boot so I said wellies, zonked a load of old tosh bodge barmy skive off he legged it morish spend a penny my good sir wind up hunky-dory. Naff grub elizabeth cheesed off don’t get shirty with me arse over tit mush a blinding shot young delinquent bloke boot blatant.</p>
                                    <div class="blog__deatails--tag wow fadeInUp">
                                        <span>Post Tags : </span>
                                        <a href="news.html">Visapass</a>
                                        <a href="news.html">Pix Saas Blog</a>
                                        <a href="news.html">The Saas</a>
                                    </div> -->
                                </div>
                            </div>

                            <!-- <div class="blog__author mb-95 d-sm-flex wow fadeInUp">
                                <div class="blog__author-img mr-30">
                                    <img src="assets/img/blog/blog-single/blog-author.jpg" class="img-fluid" alt="img">
                                </div>
                                <div class="blog__author-content">
                                    <h5>Sophie Ianiro</h5>
                                    <span>Author</span>
                                    <p>I said cracking goal down the pub blag cheeky bugger at public school A bit of how's your father boot.!</p>
                                </div>
                            </div>

                            <div class="post-comments mb-95 wow fadeInUp">
                                <div class="post-comment-title mb-40">
                                    <h3>3 Comments</h3>
                                </div>
                                <div class="latest-comments">
                                    <ul>
                                        <li>
                                            <div class="comments-box">
                                                <div class="comments-avatar">
                                                    <img src="assets/img/blog/blog-single/blog-sm-6.png" class="img-fluid" alt="img">
                                                </div>
                                                <div class="comments-text">
                                                    <div class="avatar-name">
                                                        <h5>David Angel Makel</h5>
                                                        <span class="post-meta">October 26, 2020</span>
                                                    </div>
                                                    <p>The bee's knees bite your arm off bits and bobs he nicked it gosh gutted mate blimey, old off his nut argy bargy vagabond buggered dropped.</p>
                                                    <a href="#0" class="comment-reply"><i class="fal fa-reply"></i> Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="children">
                                            <div class="comments-box">
                                                <div class="comments-avatar">
                                                    <img src="assets/img/blog/blog-single/blog-sm-7.png" class="img-fluid" alt="img">
                                                </div>
                                                <div class="comments-text">
                                                    <div class="avatar-name">
                                                        <h5>Bailey Wonger</h5>
                                                        <span class="post-meta">October 27, 2020</span>
                                                    </div>
                                                    <p>Do one say wind up buggered bobby bite your arm off gutted mate, David victoria sponge cup of char chap fanny around.</p>
                                                    <a href="#0" class="comment-reply"><i class="fal fa-reply"></i> Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="children">
                                            <div class="comments-box">
                                                <div class="comments-avatar">
                                                    <img src="assets/img/blog/blog-single/blog-sm-8.png" class="img-fluid" alt="img">
                                                </div>
                                                <div class="comments-text">
                                                    <div class="avatar-name">
                                                        <h5>Hilary Ouse</h5>
                                                        <span class="post-meta">October 28, 2020</span>
                                                    </div>
                                                    <p>Baking cakes is cobblers wellies William geeza bits and bobs what a plonker it's your round,</p>
                                                    <a href="#0" class="comment-reply"><i class="fal fa-reply"></i> Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="post-comment-form wow fadeInUp">
                                <h4>Leave a Reply </h4>
                                <span>Your email address will not be published.</span>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="post-input">
                                                <textarea placeholder="Your message..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <div class="post-input">
                                                <input type="text" placeholder="Your Name">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <div class="post-input">
                                                <input type="email" placeholder="Your Email">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="post-input mb-30">
                                                <input type="text" placeholder="Website">
                                            </div>
                                        </div> 
                                    </div>
                                    <button type="submit" class="theme-btn">Send Message</button>
                                </form>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <?php
                        require('blog-sidebar.php');
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog area end here -->


  <!-- footer-area start -->
    <?php
    require_once('inc/footer.php');
    require_once('inc/copyright.php');
    ?>
    <!-- footer-area end -->


    <!-- JS here -->
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
</body>

</html>
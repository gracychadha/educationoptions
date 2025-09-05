<?php
require_once("admin/db/config.php");
$stmtFetch = $db->prepare("SELECT *  FROM blog WHERE  status = 1");
$stmtFetch->execute();
$blog = $stmtFetch->get_result()->fetch_all(MYSQLI_ASSOC);
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
    <title>Blog || Education Options</title>
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
    <style>
       
    </style>
</head>

<body>


    <?php
    require("inc/header.php");
    require("inc/navbar.php");
    ?>

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
                        <h3 class="pb-100">Blog</h3>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadccrumb-bg">
            <ul class="breadcrumb justify-content-center pt-20 pb-20">
                <li class="bd-items"><a href="index.html">Home</a></li>
                <li class="bd-items bdritems">|</li>
                <li class="bd-items"><a href="blog.php">Blog</a></li>
            </ul>
        </nav>
    </div>
    <!-- page title area end -->


    <section class="blog-area pt-120 pb-90 wow fadeInUp" data-wow-delay="0.3s"
        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8  blog-container">
                    <?php

                    function trim_to_words($text, $limit = 20) //set word limit accordingly
                    {
                        $words = explode(' ', $text); // convert into array on basis of space
                        if (count($words) > $limit) {  //check description
                            $words = array_slice($words, 0, $limit);   //slicing done
                            return implode(' ', $words) . '...'; // Add ellipsis
                        }
                        return $text;
                    }
                    foreach ($blog as $item) {
                        $content = $item['content'];
                        $short_content = trim_to_words($content);
                        ?>
                        <div class="blog-item">
                            <article class="blog mb-30">
                                <div class="blog__thumb">
                                    <a href="blog-details?id=<?= htmlspecialchars(base64_encode($item['idblog'])) ?>"><img
                                            src="admin/<?= $item['image'] ?>" alt=""></a>
                                </div>
                                <div class="blog__content">
                                    <div class="blog-meta">
                                        <span> <i class="far fa-user"></i><a
                                                href="blog-details?id=<?= htmlspecialchars(base64_encode($item['idblog'])) ?>"><?= $item['user'] ?></a></span>
                                        <span > <i class=" fal fa-calendar-day"></i>
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
                <div class="col-lg-4">
                    <?php
                    require('blog-sidebar.php');
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- footer strat -->
    <?php
    require("inc/footer.php");
    require("inc/copyright.php");
    ?>


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
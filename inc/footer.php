<footer class="footer-area footer-bg pt-95">
    <div class="container">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                <div class="footer-about-1">
                    <div class="footer-about-1-content">
                        <div class="footer-logo footer-logo-3 mb-30">
                            <a href="https://vibrantick.org/educationoptions/"><img
                                    src="<?= getenv('BASEURL') ?>assets/img/eo/educationoptionsw.png" alt=""></a>
                        </div>
                        <p class="mb-50" align="justify">At Options, we understand that our success is connected to the
                            success of our students. We are proud of our unique, handcrafted approach, and are committed
                            to providing our students with the best possible opportunities that Australia has to offer.
                        </p>
                        <h4 class="footer-about-1__title mb-30">
                            Follow Us
                        </h4>
                        <ul class="social_links">
                            <li>
                                <a class="" href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <!-- <li>
                                <a class="" href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li> -->
                            <li>
                                <a class="" href="#">
                                    <i class="fab fa-instagram"></i>

                                </a>
                            </li>
                            <!-- <li>
                                <a class="" href="#">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                            </li>
                            <li>
                                <a class="" href="#">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-6">
                <div class="footer-widget footer-2 footer-btm-mobile ml-30">
                    <h3 class="footer-widget__title mb-25">
                        Quick Links
                    </h3>
                    <ul class="footer-widget_menu-link">
                        <li><a href="about-us"><i class="fas fa-arrow-right"></i>
                                About Us</a></li>
                        <!-- <li><a href="">Latest Services</a></li> -->
                        <li><a href="contact-us"> <i class="fas fa-arrow-right"></i>
                                Payment Type</a></li>
                        <li><a href="about-us"><i class="fas fa-arrow-right"></i>
                                Awards Winnings</a></li>
                        <li><a href="partners"> <i class="fas fa-arrow-right"></i>
                                Our Partner</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6">
                <div class="footer-widget footer-3 footer-btm-mobile ml-50">
                    <h3 class="footer-widget__title mb-25">
                        Services
                    </h3>
                    <ul class="footer-widget_menu-link">
                        <?php

                        foreach ($services as $item) {
                            ?>
                            <li><i class="fas fa-arrow-right pr-10" style="color:#A6ABB2;"></i>
                                <a
                                    href="<?= getenv('BASEURL') ?>service.php/<?php echo $item['slug'] ?>"><?php echo $item['title']; ?></a>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6">
                <div class="footer-widget footer-4 footer-btm-mobile ml-40">
                    <h3 class="footer-widget__title mb-25">
                        Get in Touch
                    </h3>
                    <ul class="footer-widget_menu-link-info">
                        <li><a href="tel:+61-0433092086"><i class="far fa-phone-alt"></i> <span><?= htmlspecialchars($info['phone1'])?></span>
                            </a></li>
                        <li><a href="/cdn-cgi/l/email-protection#ef9c9a9f9f809d9baf88828e8683c18c8082"><i
                                    class="fal fa-envelope"></i> <span><span class="__cf_email__"
                                        data-cfemail="c9babcb9b9a6bbbd89aea4a8a0a5e7aaa6a4">
                                       <?= htmlspecialchars($info['email'])?></span></span></a>
                        </li>
                        <li><a href="contact-us"><i class="fal fa-map-marker-alt"></i> <span><?= htmlspecialchars($info['address'])?> , <?= htmlspecialchars($info['city'])?></span> </a></li>
                        <li><a href="contact-us"><i class="fal fa-briefcase"></i> <span>ABN : 83 914 571 673</span> </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
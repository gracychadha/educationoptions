<div class="sidebar-left__wrapper">
    <div class="sidebar__widget mb-30">
        <div class="sidebar__widget-content">
            <div class="cat-link">
                <ul>
                    <?php

                    function toTitleCase($string)
                    {
                        $string = strtolower($string); // Convert all to lowercase
                        $string = preg_replace('/[^a-z0-9]+/i', ' ', $string); // Replace non-alphanumerics with space
                        $string = ucwords(trim($string)); // Capitalize each word
                        return $string;
                    }



                    foreach ($services as $item) {
                        ?>
                        <li><a
                                href="<?= getenv('BASEURL') ?>service.php/<?php echo $item['slug'] ?>"><?php echo toTitleCase($item['title']); ?></a>
                        </li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>
    <div class="sidebar__widget mb-30 theme-bg pd-30">
        <div class="sidebar__widget-title title-white mb-40">
            <h4>Download</h4>
        </div>
        <div class="sidebar__widget-content">
            <ul>
                <li class="d-flex align-items-center mb-20 pdf-btm-border">
                    <div class="docu__thumb mr-15">
                        <a href="contact-us.php"><i class="fas fa-file-pdf"></i></a>
                    </div>
                    <div class="docu__text">
                        <h6><a href="contact-us.php">Service Broohoru</a></h6>
                        <p>PDF<span>12Mb</span></p>
                    </div>
                </li>
                <li class="d-flex align-items-center mb-20 pdf-btm-border">
                    <div class="docu__thumb mr-15">
                        <a href="contact-us.php"><i class="fas fa-file-pdf"></i></a>
                    </div>
                    <div class="docu__text">
                        <h6><a href="contact-us.php">Visa Application Form</a></h6>
                        <p>PDF<span>12Mb</span></p>
                    </div>
                </li>
                <li class="d-flex align-items-center mb-20 pdf-btm-border pdf-btm-none">
                    <div class="docu__thumb mr-15">
                        <a href="contact-us.php"><i class="fas fa-file-pdf"></i></a>
                    </div>
                    <div class="docu__text">
                        <h6><a href="contact-us.php">Admission Form</a></h6>
                        <p>PDF<span>12Mb</span></p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="faqfrm__visa mb-30">
        <div class="sidebar-title mb-40">
            <h3>Ask Us Custom</h3>
        </div>
        <div class="faqfrm__visa-form">
            <form id="contactForm" action="" method="POST" >
                <input type="text" placeholder="Name*" name="name" required>
                <input type="email" placeholder="Email*" name="email" required>
                <input type="text" placeholder="Phone*" name="phone" required>
                <select class="set-service" name="service" required>
                    <option value="" disabled selected>Select Service</option>
                    <?php
                    foreach ($services as $item) {
                        ?>
                        <option value="<?php echo $item['title']; ?>"><?php echo $item['title']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                
                <textarea cols="30" rows="10" name="message"></textarea>
                <button class="theme-btn" type="submit">Submit Now</button>
            </form>
        </div>
    </div>
    <!-- <div class="sidebar__widget mb-30">
        <div class="sidebar__widget-content">
            <div class="sidebar__widget-content-banner">
                <img src="assets/img/business-visa/business-adds.jpg" alt="">
                <div class="sidebar__widget-content-banner-text">
                    <span>Higher Study</span>
                    <h2>In Austalia</h2>
                    <a href="contact-us.php" class="banner-btn">Apply Visa</a>
                </div>
            </div>
        </div>
    </div> -->
</div>
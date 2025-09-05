<?php
error_reporting(1);
require_once('admin/db/config.php');
$stmtFetch = $db->prepare("SELECT * FROM  services WHERE STATUS ='1'");
$stmtFetch->execute();
$services=$stmtFetch->get_result()->fetch_all(MYSQLI_ASSOC);

?>
    <div class="header-menu header-sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-8">
                    <div class="header-logo ">
                        <a href="https://vibrantick.org/educationoptions/"><img src="<?= getenv('BASEURL') ?>assets/img/eo/educationoptions.png" class="img-fluid" alt="img"></a>
                   
                    </div>
                </div>
                <div class="col-xxl-7 col-xl-7 col-lg-7 col-4">
                    <div class="main-menu d-none d-lg-block ">
                        <nav id="mobile-menu">
                            <ul>
                                <li class="menu-item"><a href="https://vibrantick.org/educationoptions/">HOME</a>
                                    
                                </li>
                                <li class="menu-item"><a href="<?= getenv('BASEURL') ?>about-us">ABOUT US</a>
                                </li>
                                <li class="menu-item"><a href="blog.php">Our Blogs</a>
                                </li>
                                <li class="menu-item-has-children"><a href="javascript:void(0)">Our Services</a>
                                    <ul class="sub-menu">
                                        <?php
                                        foreach($services as $item){
                                        ?>
                                        <li><a href="<?= getenv('BASEURL') ?>service/<?php echo $item['slug']?>"><?php echo $item['title']; ?></a></li>
                                       <?php
                                        }
                                       ?>
                                    </ul> 
                                </li>
                                <li><a href="<?= getenv('BASEURL') ?>contact-us">CONTACT US</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="side-menu-icon d-lg-none text-end">
                        <button class="side-toggle"><i class="far fa-bars"></i></button>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-3">
                    <div class="main-menu-wrapper d-flex align-items-center justify-content-end">
                        <!-- <div class="main-menu-wrapper__search text-left">
                                <a class="search-btn nav-search search-trigger" href="#"><i
                                        class="fal fa-search"></i></a>
                            </div> -->
                        <div class="main-menu-wrapper__call-number d-flex align-items-center">
                            <div class="main-menu-wrapper__call-icon mr-10">
                                <img src="<?= getenv('BASEURL') ?>assets/img/menu-icon/chatting.png" alt="">
                            </div>
                            <div class="main-menu-wrapper__call-text">
                                <span>Contact Us</span>
                                <h5><a href="tel:<?= htmlspecialchars($info['phone1'])?>"><?= htmlspecialchars($info['phone1'])?></a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-overlay"></div>
    <div class="fix">
        <div class="side-info">
            <button class="side-info-close"><i class="fal fa-times"></i></button>
            <div class="side-info-content">
                <div class="mobile-menu"></div>
            </div>
        </div>
    </div>
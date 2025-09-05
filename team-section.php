<?php
require_once('admin/db/config.php');

$stmtFetch3 = $db->prepare("SELECT * FROM team_members  WHERE status='1'");
$stmtFetch3->execute();
$team=$stmtFetch3->get_result()->fetch_all(MYSQLI_ASSOC);
// print_r($team);
// exit();
?>
<section class="team-area grey-soft-bg pt-110 pb-80">
    <div class="container">
        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s"
            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
            <div class="col-xxl-10">
                <div class="section_title_wrapper text-center mb-50">
                    <span class="subtitle">
                        Authorized Agents
                    </span>
                    <h2 class="section-title">
                        Our Agents Who are <br> Dedicatedly Working With Us
                    </h2>
                </div>
            </div>
        </div>
         <div class="swiper mySwiper1">
                <div class="swiper-wrapper">
                     <?php
             foreach($team as $item){
             ?>
             <div class="swiper-slide">
                <div class=" wow fadeInUp" data-wow-delay="0.3s"
                style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                <div class="team text-center mb-30">
                    <div class="team__thumb team__thumb-2 mb-25">
                        <img src="<?= getenv('BASEURL') ?>admin/<?php echo $item['profile_picture']; ?>" alt="">
                        <div class="team__thumb-info">
                            <div class="team-social">
                                <a href="<?php echo $item['facebook']; ?>"><i class="fab fa-facebook-f"></i></a>
                                <a href="<?php echo $item['twitter']; ?>"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team__text">
                        <h3 class="team__text-title">
                            <a href="team-detail?id=<?php echo htmlspecialchars(base64_encode($item['idteam_members'])); ?>"><?php echo $item['member_name']; ?></a>
                        </h3>
                        <span><?php echo $item['role']; ?></span>
                    </div>
                </div>
            </div>
             </div>
             <?php
             }
             ?>
                </div>
             </div>
        <div class="row">

            <!-- <?php
             foreach($team as $item){
             ?>
            
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s"
                style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                <div class="team text-center mb-30">
                    <div class="team__thumb team__thumb-2 mb-25">
                        <img src="<?= getenv('BASEURL') ?>admin/<?php echo $item['profile_picture']; ?>" alt="">
                        <div class="team__thumb-info">
                            <div class="team-social">
                                <a href="<?php echo $item['facebook']; ?>"><i class="fab fa-facebook-f"></i></a>
                                <a href="<?php echo $item['twitter']; ?>"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team__text">
                        <h3 class="team__text-title">
                            <a href="team-details.html"><?php echo $item['member_name']; ?></a>
                        </h3>
                        <span><?php echo $item['role']; ?></span>
                    </div>
                </div>
            </div>
            <?php
             }
            ?> -->
            <!-- <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="team text-center mb-30">
                            <div class="team__thumb team__thumb-2 mb-25">
                                <img src="assets/img/team/t-2.jpg" alt="">
                                <div class="team__thumb-info">
                                    <div class="team-social">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team__text">
                                <h3 class="team__text-title">
                                    <a href="team-details.html">Daniel Hasmass</a>
                                </h3>
                                <span>Sr. Consultant</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s"
                        style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInUp;">
                        <div class="team text-center mb-30">
                            <div class="team__thumb team__thumb-2 mb-25">
                                <img src="assets/img/team/t-3.jpg" alt="">
                                <div class="team__thumb-info">
                                    <div class="team-social">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team__text">
                                <h3 class="team__text-title">
                                    <a href="team-details.html">Narayan Kamora</a>
                                </h3>
                                <span>Senior Lawyer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.9s"
                        style="visibility: visible; animation-delay: 0.9s; animation-name: fadeInUp;">
                        <div class="team text-center mb-30">
                            <div class="team__thumb team__thumb-2 mb-25">
                                <img src="assets/img/team/t-4.jpg" alt="">
                                <div class="team__thumb-info">
                                    <div class="team-social">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team__text">
                                <h3 class="team__text-title">
                                    <a href="team-details.html">Marida Tohaman</a>
                                </h3>
                                <span>Manager</span>
                            </div>
                        </div>
                    </div> -->
        </div>
    </div>
</section>
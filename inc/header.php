<!-- Add your site or application content here -->
<?php
// fetch data
$query_info = "SELECT * FROM company_info ";
$result_info = $db->query($query_info);
$info = $result_info->fetch_assoc();

?>
<!-- preloader -->
<!-- <div id="preloader">
      <div class="preloader">
          <span></span>
          <span></span>
      </div>
  </div> -->
<!-- preloader end  -->

<!-- back to top start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- back to top end -->
<div class="header-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xxl-8 col-lg-7">
                <div class="header-top-left">
                    <ul class="d-flex" style="gap:20px;">
                        <li><span><i class="fas fa-envelope"></i></span> <?= htmlspecialchars($info['email']) ?></li>
                        <li><span><i class="fas fa-clock"></i></span> 8:30 AM - 9:30 PM</li>
                        <li><span><i class="fas fa-map-marker-alt"></i>
                            </span> <?= htmlspecialchars($info['country']) ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-5">
                <div class="topheader-info">
                    <div class="top-button f-right ">
                        <a href="contact-us.php">Apply Now</a>
                    </div>
                    <div class="header-language f-right">
                        <div id="google_element" style="display:none;"></div>

                    </div>
                    <div class="header-language">
                        <select id="language-select">
                            <option value="en" selected>English</option>
                            <option value="fr">French</option>
                            <option value="es">Spanish</option>
                            <option value="de">German</option>
                            <option value="hi">Hindi</option>
                            <option value="it">Italian</option>
                            <option value="ja">Japanese</option>
                        </select>
                    </div>


                    <!-- <div class="header-language f-right">
                        <select id="google_translate_element" class="test">
                            <option data-display="English">English</option>
                            <option value="en">English</option>
                            <option value="fr">French</option>

                        </select>
                    </div> -->
                    <div class="header-location f-right">
                        <ul class="d-flex">
                            <li>Follow us : </li>
                            <li class="right-border"> <a class="" href="#">
                                    &nbsp; <i class="fab fa-facebook-f"></i>&nbsp;
                                </a>
                            <li>
                            <li class="">
                                <a class="" href="#">
                                    &nbsp; <i class="fab fa-instagram"></i>&nbsp;

                                </a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
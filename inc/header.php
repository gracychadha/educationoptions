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
            <div class="col-xxl-7 col-lg-7">
                <div class="header-top-left">
                    <ul class="d-flex">
                        <li><span><i class="fas fa-envelope me-1"></i></span> <?= htmlspecialchars($info['email']) ?></li>
                        <span class="me-2 ms-0">|</span>
                        <li><span><i class="fas fa-clock me-1"></i></span> 8:30 AM - 9:30 PM</li>
                        <span class="me-2 ms-0">|</span>
                        <li><span><i class="fas fa-map-marker-alt me-1"></i>
                            </span> <?= htmlspecialchars($info['country']) ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-xxl-5 col-lg-5">
                <div class="topheader-info d-flex align-items-center justify-content-end gap-2">
                     <!-- Language Dropdown -->
                    <div class="header-language">
                        <select id="languageSelect">
                            <option value="en">English</option>
                            <option value="fr">French</option>
                            <option value="es">Spanish</option>
                            <!-- <option value="de">German</option> -->
                            <option value="it">Italian</option>
                            <option value="hi">Hindi</option>
                            <option value="ja">Japanese</option>
                        </select>
                    </div>
                    <!-- Apply Now Button -->
                    <div class="top-button">
                        <a href="contact-us.php">Apply Now   <i class="fas fa-paper-plane fa-xs me-2"></i></a>
                    </div>

                   

                    <!-- Social Icons -->
                    <div class="header-location ms-1">
                        <ul class="d-flex list-unstyled align-items-center mb-0">
                            <li class="me-2">Follow us :</li>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="me-2 ms-0">|</li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
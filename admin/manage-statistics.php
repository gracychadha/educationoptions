<?php
session_start();

if (!isset($_SESSION["login_user"]))
{
    header("location: index.php");
}

include('db/config.php');
$query = "SELECT * FROM statistics";
$result = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>All Statistics</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="" />

    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.tiny.cloud/1/l0jt1pl0jxgk8lnq5hkx6x384hqvgjse7l8c3mnanxhhzju3/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body class="">

    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- Header -->
   	<?php
		include("header.php");
	?>
	<!-- /Header -->

	<!-- navbar -->
	<?php
		include("navbar.php");
	?>
	<!-- /navbar -->

    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">All Statistics
                            </div>
<!--                             <ul class="breadcrumb"> -->
<!--                                 <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a> -->
<!--                                 </li> -->
<!--                             </ul> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                    <div class="card-body add-product pb-0">
                        <div class="dt-responsive table-responsive">
                            
                                     <?php

                                if (isset($_GET['status'])) {
                                    $st = $_GET['status'];
                                    $st1 = base64_decode($st);

                                    if ($st1 > 0) {
                                        echo " <div class='alert alert-success alert-dismissible fade show' role='alert' style='font-size:16px;' id='goldmessage'>
  <strong><i class='feather icon-check'></i>Success!</strong> the Statistics has been Updated Successfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div> ";
                                    } else {

                                        echo " <div class='alert alert-danger alert-dismissible fade show' role='alert' style='font-size:16px;' id='goldmessage'>
  <strong>Error!</strong> Statistics has been not Updated.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div> ";
                                    }
                                }

                                ?>
                                <br />
                        
                            <?php
                            echo '<table id="basic-btn" class="table table-striped table-bordered nowrap">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>SNO</th>";
                            //echo "<th>OUR ACHIEVEMENTS</th>";
                            //echo "<th>PERFORMANCE RATING</th>";
                            echo "<th>NUMBER OF CLIENTS</th>";
                            echo "<th>NUMBER OF PROJECTS</th>";
                            echo "<th>YEARS'S OF FIELD EXPERIENCE</th>";
                            //echo "<th>NUMBER OF OVERSEAS ENGAGEMENTS</th>";
                            echo "<th>STATUS</th>";
                            echo "<th>EDIT</th>";
                            echo "</tr>";
                            echo "</thead>";

                            $count = 1;
                            echo "<tbody>";
                            while ($row = mysqli_fetch_row($result)) {
                                echo "<tr class='record'>";
                                echo "<td>$count</td>";
                               // echo "<td>" . $row['1'] . "</td>";
                                //echo "<td>" . $row['2'] . "</td>";
                                echo "<td>" . $row['3'] . "</td>";
                                echo "<td>" . $row['4'] . "</td>";
                                echo "<td>" . $row['5'] . "</td>";
                                //echo "<td>" . $row['6'] . "</td>";
                                echo "<td>";
                                if ($row['7'] == 1) {
                                    echo "Enable";
                                } else {
                                    echo "Disable";
                                }
                                echo "</td>";
                                $res = base64_encode($row[0]);

                                echo "<td>
                                        <a href='edit-statistics.php?id=$res' class='btn btn-warning'>
                                            <i class='feather icon-edit'></i> Edit
                                        </a>
                                        <a href='delete-statistics.php?id=$res' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete these statistics?\")'>
                                            <i class='feather icon-trash'></i> Delete
                                        </a>
                                    </td>";

                                echo "</tr>";

                                $count++;
                            }

                            echo "</tbody>";
                            echo "</table>";
                            ?>
                        </div>
                    </div>
               </div>
        </div>
    </section>

    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!--<script src="assets/js/menu-setting.min.js"></script>-->

    <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/plugins/buttons.colVis.min.js"></script>
    <script src="assets/js/plugins/buttons.print.min.js"></script>
    <script src="assets/js/plugins/pdfmake.min.js"></script>
    <script src="assets/js/plugins/jszip.min.js"></script>
    <script src="assets/js/plugins/dataTables.buttons.min.js"></script>
    <script src="assets/js/plugins/buttons.html5.min.js"></script>
    <script src="assets/js/plugins/buttons.bootstrap4.min.js"></script>
    <script src="assets/js/pages/data-export-custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>$(".multiple-select").select2({
            //   maximumSelectionLength: 2
        });</script>
    <script>
        $(document).ready(function () {
            $("#goldmessage").delay(5000).slideUp(300);
        });
    </script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant"))
        });
    </script>
</body>

</html>
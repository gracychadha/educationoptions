<?php
session_start();

//require_once "../vendor/autoload.php";

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

error_reporting(0);

if (!isset($_SESSION["login_user"])) {
    header("location: index.php");
}

$name = $_SESSION['login_user'];
require("db/config.php");


// Register user
if (isset($_POST['submit'])) {
    $name = strip_tags(($_POST['username']));
    $password = md5(($_POST['password']));
    $mobile = $_POST['mobile'];
    $email = strip_tags(($_POST['email']));
    $status = strip_tags(($_POST['status']));
    //$email1 = 'rakeshrai71@gmail.com';
    $type = $_POST['brand'];
    $date = date('m-d-Y ');
    $activationToken = bin2hex(random_bytes(16)); // Replace with your activation token
    $query = "insert into admin (username,password, email, status, history, type, mobile, activation_token) values('$name','$password','$email','$status','$date','$type','$mobile','$activationToken')";
    $quuery = mysqli_query($db, $query);

    //$mail = new PHPMailer(true);

    //Enable SMTP debugging.

    //$mail->SMTPDebug = 0;


    //Set PHPMailer to use SMTP.

    //$mail->isSMTP();

    //Set SMTP host name                      

   // $mail->Host = "smtp.gmail.com";

    //Set this to true if SMTP host requires authentication to send email

    //$mail->SMTPAuth = true;

    //Provide username and password

    //$mail->Username = "vibrantick@gmail.com";

    //$mail->Password = "yqpvzydmzhpcaotr";

    //If SMTP requires TLS encryption then set it

   // $mail->SMTPSecure = "tls";

    //Set TCP port to connect to

   // $mail->Port = 587;

    //$mail->From = "info@quotender.com";

    //$mail->FromName = "Quote Tender  ";

   // $mail->addAddress($email1, "Recepient Name");

   // $mail->isHTML(true);

    //$activationLink = 'https://quotetender.in/login/activate.php?token=' . $activationToken;
    //$mail->Subject = "User Account Activation";

//     $mail->Body =  "<p> Dear Admin, <br/>" .
//         "The " . " $name " . " has been requested to create the account. Click the following link to activate this account: <a href='$activationLink' style='background-color:green; color:#fff; padding:10px; text-decoration:none;'>Click Here</a> <br/><br/>
//                 <strong>Quote Tender</strong> <br/>
//             Mobile: +91-9870443528 | Email: info@quotender.com ";



//     if (!$mail->send()) {

//         echo "Mailer Error: " . $mail->ErrorInfo;
//     }


    if ($quuery > 0) {
        $msg = "User has been successfully created.";
    }
    else {
        $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' style='font-size:16px;' id='goldmessage'>
        <strong><i class='feather icon-check'></i>Error !</strong> in creating the user.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />



<head>
    <title>Add New Admin User </title>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="#" />

    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">


    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        .red-text {
            color: red;
    }     
    </style>
    
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
                                <h5 class="m-b-10">Add New Admin User
                                </h5>
                            </div>
<!--                             <ul class="breadcrumb"> -->
<!--                                 <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a> -->
<!--                                 </li> -->

<!--                             </ul> -->
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-sm-12">
                    <div class="card">


                        <div class="card-header table-card-header">
                            <?php

                            echo "<span id='user-availability-status'></span>";

                            if ($msg) {



                                echo " <div class='alert alert-success alert-dismissible fade show' role='alert' style='font-size:16px;' id='successMessage'>
  <strong><i class='feather icon-check'></i>Thanks!</strong>$msg.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div> ";
                            }
                            ?>

                            <br />


                            <form method="post" action="" enctype="multipart/form-data" autocomplete="off">
                                <div class=" ">
                                    <!-- Text input-->
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-4 col-sm-12 col-12">
                                            <div class="form-group">Enter Username <span class="red-text">*</span>
                                                <label class="sr-only control-label" for="name">Username<span class=" ">
                                                    </span></label>
                                                <input name="username" type="text" id="username" placeholder="Enter Username"
                                                    class="form-control input-md" onBlur="checkUserAvailability()"
                                                    required autocomplete="off"
                                                    oninvalid="this.setCustomValidity('Please Enter Username')"
                                                    oninput="setCustomValidity('')">
                                                <p><img src="loader.gif" id="loader" style="display:none" /></p>

                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-4 col-sm-12 col-12">
                                            <div class="form-group">Enter Password <span class="red-text">*</span>
                                                <label class="sr-only control-label" for="name">Password<span class=" ">
                                                    </span></label>
                                                <input id="name" name="password" type="password"
                                                    placeholder=" Enter Password *" class="form-control input-md"
                                                    required oninvalid="this.setCustomValidity('Please Enter Password')"
                                                    oninput="setCustomValidity('')">
                                            </div>
                                        </div>


                                        <div class="col-xl-6 col-lg-6 col-md-4 col-sm-12 col-12">
                                            <div class="form-group">Mobile No <span class="red-text">*</span>
                                                <label class="sr-only control-label" for="name">Mobile No<span
                                                        class=" ">
                                                    </span></label>
                                                <input id="name" name="mobile" type="number"
                                                    placeholder=" Enter Mobile No *" class="form-control input-md"
                                                    required
                                                    oninvalid="this.setCustomValidity('Please Enter Mobile Number')"
                                                    oninput="setCustomValidity('')">
                                            </div>
                                        </div>



                                        <div class="col-xl-6 col-lg-6 col-md-4 col-sm-12 col-12">
                                            <div class="form-group">Email <span class="red-text">*</span>
                                                <label class="sr-only control-label" for="name">Email<span class=" ">
                                                    </span></label>
                                                <input id="name" name="email" type="email" class="form-control input-md"
                                                    required placeholder="Enter valid email address" autocomplete="off"
                                                    title="Enter valid Email Address"
                                                    oninvalid="this.setCustomValidity('Please Enter valid email address')"
                                                    oninput="setCustomValidity('')" pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-4 col-sm-12 col-12">
                                            <div class="form-group">Status <span class="red-text">*</span>
                                                <label class="sr-only control-label" for="name">Status<span class=" ">
                                                    </span></label>
                                                <select id="" name="status" class="form-control"
                                                    oninvalid="this.setCustomValidity('Please Select Status')"
                                                    oninput="setCustomValidity('')" required>
                                                    <option value="">Choose</option>
                                                    <option value="1">Enable</option>
                                                    <option value="0">Disable</option>

                                                </select>
                                            </div>
                                        </div>

                                        <!--                                  <div class="col-xl-6 col-lg-6 col-md-4 col-sm-12 col-12">-->
                                        <!--                                      <div class="form-group">Role*-->
                                        <!--                                          <label class="sr-only control-label" for="name">User Type<span-->
                                        <!--                                                  class=" "> </span></label>-->
                                        <!--                                     <select  name="brand[]" placeholder="Select permission"  multiple="multiple" required class="form-control">-->
                                        <!--<option value="all" >All</option>-->
                                        <!--<option value="view" selected>View Tender Request</option>-->
                                        <!--<option value="reply" selected>Reply Tender Request</option>-->
                                        <!--<option value="delete" >Delete Tender Request</option>-->
                                        <!--<option value="sentTender" selected>View Sent Tender</option>-->
                                        <!--<option value="alot" selected>Alot Tender</option>-->
                                        <!--<option value="alotEdit" >Alot Tender Edit</option>					 -->
                                        <!--<option value="alotDelete" >Alot Tender Delete</option>-->
                                        <!--<option value="category" >Manage Category</option>-->
                                        <!--<option value="brand" >Manage Brands</option>-->
                                        <!--<option value="price" selected>Price List</option>-->
                                        <!--<option value="priceAdd" selected>Price List Add</option>-->
                                        <!--<option value="priceEdit" selected>Price List Edit</option>-->
                                        <!--<option value="priceDelete" >Price List Delete</option>-->

                                        <!--<option value="dpt" selected>Manage Department</option>					-->
                                        <!--              </select>-->
                                        <!--                                      </div>-->
                                        <!--                                  </div>-->
                                        <!-- Text input-->



                                        <!-- Button -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                            <button type="submit" class="btn btn-secondary" name="submit" id="submit">
                                                <i class="feather icon-save lg"></i>&nbsp; Add Admin User
                                            </button>


                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">


                            </div>
                        </div>
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

    <script>
    function InvalidMsg(textbox) {

        if (textbox.value == '') {
            textbox.setCustomValidity('Required email address');
        } else if (textbox.validity.typeMismatch) {
            textbox.setCustomValidity('please enter a valid email address');
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }
    </script>

</body>
<script>
function checkUserAvailability() {
    $("#loader").show();
    jQuery.ajax({
        url: "check.php",
        data: 'username=' + $("#username").val(),
        type: "POST",
        success: function(data) {
            if (data == 1) {
                $("#user-availability-status").html(
                    "<div class='alert alert-danger'> <i class=' feather  icon icon-info'></i> &nbsp;Username already exists in our record.</div>"
                );
                $("#user-availability-status").removeClass('available');
                $("#user-availability-status").addClass('not-available');
                $("#submit").attr('disabled', true);
            } else {
                $("#user-availability-status").html(
                    "<div class='alert alert-success' ><i class='feather icon-check'></i> &nbsp;Username is Available.</div>"
                );
                $("#user-availability-status").removeClass('not-available');
                $("#user-availability-status").addClass('available');
                $("#submit").attr('disabled', false);
            }
            $("#loader").hide();
        },
        error: function() {}
    });
}
</script>
<script>
 $(document).ready(function() {
        $("#goldmessage").delay(5000).slideUp(300);
    });
    </script>
<script>
$(document).ready(function() {
    $("#successMessage").delay(5000).slideUp(300);
});
</script>
</html>
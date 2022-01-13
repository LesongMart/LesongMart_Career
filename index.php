<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["admin_logged"]) && $_SESSION["admin_logged"] === true){
    header("location: homepage.php");
    exit;
}

 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM user_lesong WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);

                    if(mysqli_stmt_fetch($stmt)){

                        

                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            

                                $_SESSION["admin_logged"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;           
                            // Redirect user to welcome page
                            header("location: homepage.php");

                            

                            
                           
                        } else{
                            // Password is not valid, display a generic error message
                            ?>
                            <script language="JavaScript">
                                alert('Password tidak sah. Silahkan diulang kembali!');
                            document.location='index.php';
                            </script>
                            <?php

                            $login_err = "Password tidak sah.";
                        }
                      

                }

                } else{
                    // email doesn't exist, display a generic error message
                ?>
                <script language="JavaScript">
                    alert('Email belum berdaftar!');
                document.location='index.php';
                </script>
                <?php
                     
                    $login_err = "Email belum berdaftar.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html>
<head>
  <!-- Basic Page Info -->
  <meta charset="utf-8">
  <title>Lesong Mart Career</title>

  <!-- Site favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
  <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-119386393-1');
  </script>
</head>
<body class="login-page">
  <div class="login-header box-shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <div class="brand-logo">
          <a href="index.php">
          <img src="vendors/images/logo_lesong.png" style="height: 50px;" alt="">
        </a>
      </div>
      <div class="brand-logo">
          <a href="apply_jobs.php">
          <img src="vendors/images/jobs.png" style="height: 50px;" alt="">
        </a>
      </div>
    </div>
  </div>
  <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-md-6 col-lg-7">


          <div class="w3-content w3-section" style="max-width:100%;">
      <img class="mySlides w3-animate-right" src="images/poster1.png" style="width:100%; height: 400px; ">
      <img class="mySlides w3-animate-right" src="images/poster2.png" style="width:100%; height: 400px;">
      <img class="mySlides w3-animate-right" src="images/poster3.png" style="width:100%; height: 400px;">

    </div>
        </div>
        
        <div class="col-md-6 col-lg-5">
          <div class="login-box bg-white box-shadow border-radius-10">
            <div class="login-title">
              <h2 class="text-center" style="color: red;">Welcome To Lesong Mart Career</h2>
            </div>


            <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>


            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
              <div class="input-group custom">
                <input type="text" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" placeholder="Email" name="email" id="email" value="<?php echo $email; ?>">

                <div class="input-group-append custom">
                  <span class="input-group-text"><i class="icon-copy fa fa-envelope-o" aria-hidden="true"></i></span>
                </div>
              </div>
              <div class="input-group custom">
                <input type="password" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Password"name="password" id="password">
                <div class="input-group-append custom">
                  <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
              </div>
              <div class="row pb-30">
                
  
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="input-group mb-0">
                     <input class="btn btn-primary btn-lg btn-block" style="background-color: red;" name="login" id="login" type="submit" value="Login">
                  </div>
                </div>
              </div>
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>


   <div style="padding: 10px;padding-left: 20px;object-fit: contain;width: 100%;background-color: black;align-content: center;left: 0;bottom: 0;flex-flow: row;display: flex;">

    <div style="padding: 15px;padding-bottom: 0;margin-right: 50px;object-fit: contain;width: 350px;height: auto;align-content: center;font-family: sans-serif;text-align: left;flex-flow: column;" >
      <img style="margin-top: 5px;margin-left: 5px;margin-right: 10px;margin-bottom: 10px;padding: 0;object-fit: contain;width: 100px;height: auto;float: center;" src="images/logo_lesong.png">
        
      <p style="color: white;">Copyright © 2021 <br>
      Lesong Mart Sdn Bhd (Headquater) <br>
      JC 552, Jalan Bestari 5, Bdr Jasin Bestari Seksyen 2, 77200 Bemban Melaka</p>

    </div>

    <div style="padding: 15px;padding-bottom: 0;margin-right: 50px;object-fit: contain;width: 350px;height: auto;align-content: center;font-family: sans-serif;text-align: left;flex-flow: column;" >
      <h3 style="color: white;">Hubungi Kami</h3>
      <p style="color: white;">

      Waktu Pejabat: <br>
      Isnin-Jumaat ( 08: 00am-5:00pm )<br>
      <i class="fa fa-envelope"></i> lesongmart2020@gmail.com <br>
      <i class="fa fa-phone"></i> +606 - 5341317 <br>
      <i class="fa fa-phone"></i> +6019 - 6050548
      </p>

    </div>
       
  </div>
  <!-- js -->
  <script src="vendors/scripts/core.js"></script>
  <script src="vendors/scripts/script.min.js"></script>
  <script src="vendors/scripts/process.js"></script>
  <script src="vendors/scripts/layout-settings.js"></script>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

  <script>
    var myIndex = 0;
    carousel();

    function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 10500);    
    }
  </script>
</body>
</html>
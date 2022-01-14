<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once 'config.php';

?>

 <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM job_type ORDER BY type";
        

        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
             // while
            
            ?>


            <?php
// Include config file


// Define variables and initialize with empty values
$fullname = $age = $email = $phoneno = $address = $education = $job_apply = $current_job = $experience =  "";

$fullname_err = $age_err = $email_err = $phoneno_err = $address_err = $education_err = $job_apply_err = $current_job_err = $experience_err =  "";


 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    if(isset($_FILES['image'])){

      $errors= array();
      $file_name = uniqid();
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];

      
    

      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"resume/".$file_name);
         $resume = $file_name;
         
      }else{
         print_r($errors);
      }

   }


 
    // Validate fullname
    if(empty(trim($_POST["fullname"]))){
        $fullname_err = "Please enter your full name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM job_application WHERE fullname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_fullname);
            
            // Set parameters
            $param_fullname = trim($_POST["fullname"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $fullname = trim($_POST["fullname"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later3.";
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
    } //


    // Validate age
    if(empty(trim($_POST["age"]))){
        $age_err = "Please enter your age.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM job_application WHERE age = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_age);
            
            // Set parameters
            $param_age = trim($_POST["age"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $age = trim($_POST["age"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later3.";
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
    } //


    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM job_application WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                ?>
                <script language="JavaScript">
                    alert('Email has been used! Please use other email.');
                </script>
                <?php

                    $email_err = "Email has been used. Please use other email.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.4";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate phoneno
    if(empty(trim($_POST["phoneno"]))){
        $phoneno_err = "Please enter your phone number.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM job_application WHERE phoneno = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_phoneno);
            
            // Set parameters
            $param_phoneno = trim($_POST["phoneno"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $phoneno = trim($_POST["phoneno"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.5";
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }


    // Validate address
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter your home address.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM job_application WHERE address = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_address);
            
            // Set parameters
            $param_address = trim($_POST["address"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $address = trim($_POST["address"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.5";
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }



    // Validate education
    if(empty(trim($_POST["education"]))){
        $education_err = "Please enter your highest level of education.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM job_application WHERE education = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_education);
            
            // Set parameters
            $param_education = trim($_POST["education"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $education = trim($_POST["education"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.5";
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    

    

    // Validate type of job
    if(empty(trim($_POST["job_apply"]))){
        $job_apply_err = "Please select the type of job.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM job_application WHERE job_apply = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_job_apply);
            
            // Set parameters
            $param_job_apply = trim($_POST["job_apply"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $job_apply = trim($_POST["job_apply"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.6";
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }


    // Validate current job
    if(empty(trim($_POST["current_job"]))){
        $current_job_err = "Please enter your current job.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM job_application WHERE current_job = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_current_job);
            
            // Set parameters
            $param_current_job = trim($_POST["current_job"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $current_job = trim($_POST["current_job"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.7";
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }



    // Validate experience
    if(empty(trim($_POST["experience"]))){
        $current_job_err = "Please enter your experience.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM job_application WHERE experience = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_experience);
            
            // Set parameters
            $param_experience = trim($_POST["experience"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $experience = trim($_POST["experience"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.7";
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }


    

    

 
    // Check input errors before inserting in database

    if(empty($fullname_err) && empty($age_err) && empty($email_err) && empty($phoneno_err) && 
    empty($address_err) && empty($education_err) && empty($job_apply_err) && empty($current_job_err) && empty($experience_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO job_application (id, fullname, age, email, phoneno, address, education, job_apply, current_job, experience, resume) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss", $param_id, $param_fullname, $param_age, $param_email, $param_phoneno, $param_address, $param_education, $param_job_apply, $param_current_job, $param_experience, $param_resume);

            
            // Set parameters
            $param_id = uniqid();
            $param_fullname = $fullname;
            $param_age = $age;
            $param_email = $email;
            $param_phoneno = $phoneno;
            $param_address = $address;
            $param_education = $education;
            $param_job_apply = $job_apply;
            $param_current_job = $current_job;
            $param_resume = $resume;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

//             $message = "
//             <h2>Permohonan Pekerjaan.</h2>
//             <p>Satu permohonan baru telah dilakukan. Sila semak dan berikan pengesahan permohonan segera!</p>
//             <p>Maklumat pemohon:</p>
//             <p>Email: ".$param_email."</p>
//             <p>Nama: ".$param_fullname."</p>";


//             require 'vendor\autoload.php';
//             $mail = new PHPMailer(TRUE);

//             try {
//                 //Server settings
//                 $mail->isSMTP();                                     
//                 $mail->Host = 'smtp.gmail.com';                      
//                 $mail->SMTPAuth = true;
                
//                 $mail->Username = 'muhdhabib301@gmail.com'; 
//                 $mail->Password = 'mhyja8144';                               
                                    
//                 $mail->SMTPOptions = array(
//                     'ssl' => array(
//                     'verify_peer' => false,
//                     'verify_peer_name' => false,
//                     'allow_self_signed' => true
//                     )
//                 );                         
//                 $mail->SMTPSecure = 'ssl';                           
//                 $mail->Port = 465;                                   

//                 $mail->setFrom('muhdhabib301@gmail.com', 'Lesong Mart Career');
                
//                 //Recipients
//                 $mail->addAddress('habibslayer@gmail.com');
               
//                 //Content
//                 $mail->isHTML(true);                                  
//                 $mail->Subject = 'Permohonan Pekerjaan Lesong Mart';
//                 $mail->Body    = $message;

//                 $mail->send();

//                 $_SESSION['success'] = 'Email has been sent.';

//             } catch (Exception $e) {
//                 $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                
//             }
                // Redirect to login page
                ?>
                <script language="JavaScript">
                    alert('Permohonan pekerjaan anda sudah dihantar. Sila tunggu pengesahan daripada pihak syarikat!');
                    document.location='index.php';
                </script>
                <?php
            } else{
                ?>
                <script language="JavaScript">
                    alert('Oops! Something went wrong. Please try again later1.');
                    document.location='apply_jobs.php';
                </script>
                <?php
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
  <div class="d-flex  justify-content-center" style=" padding-top: 30px;">
    <div class="container" style="margin-top: 0; width: 1800px;">
      

        <div class="main-container" style="padding: 0; margin: 0;">
    <div class="pb-20" >
      <div class="min-height-200px">




        <div class="page-header" style="margin-top: 10px;">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="title">
                <h4>Apply Jobs With Lesong Mart</h4>
              </div>
              

            </div>
          </div>
        </div>

        
                <div style="margin-left: 3px; margin-right: 3px;" class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Fill This Form</h4>
                            <p class="mb-20"></p>
                        </div>
                    </div>
                    <div class="wizard-content">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                            <section>

                        
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label >Full Name </label>
                                            <input name="fullname" type="text" class="form-control <?php echo (!empty($fullname_err)) ? 'is-invalid' : ''; ?>" required="true" autocomplete="off" value="<?php echo $fullname; ?>">
                                            <span class="invalid-feedback"><?php echo $fullname_err; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label >Age </label>
                                            <input name="age" type="text" class="form-control <?php echo (!empty($age_err)) ? 'is-invalid' : ''; ?>" required="true" autocomplete="off" value="<?php echo $age; ?>">
                                            <span class="invalid-feedback"><?php echo $age_err; ?></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input name="email" type="text" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" required="true" autocomplete="off"  value="<?php echo $email; ?>">
                                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Phone Number </label>
                                            <input name="phoneno" type="text" class="form-control <?php echo (!empty($phoneno_err)) ? 'is-invalid' : ''; ?>" required="true" autocomplete="off" value="<?php echo $phoneno; ?>">
                                            <span class="invalid-feedback"><?php echo $phoneno_err; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Home Address</label>
                                            <textarea id="address" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" required length="50" maxlength="400" style='height: 80px;' required="true" autocomplete="off" value="<?php echo $address; ?>"></textarea>
                                            <span class="invalid-feedback"><?php echo $address_err; ?></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Highest Level Education </label>
                                            
                                            <input name="education" type="text" class="form-control <?php echo (!empty($education_err)) ? 'is-invalid' : ''; ?>"  required="true" autocomplete="off" value="<?php echo $education; ?>">
                                            *Please type with the course taken (if applicable)
                                            <span class="invalid-feedback"><?php echo $education_err; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Type of Job Apply</label>
                                            <select name="job_apply" class="form-control <?php echo (!empty($job_apply)) ? 'is-invalid' : ''; ?>" required="true" autocomplete="off">
                                            <option value="">Select type of job</option>

                                             <?php
                                             foreach($result as $typerow) {
                                             ?>

                                             <option value="<?php echo $typerow['id_type']; ?>"><?php echo $typerow['type'];?></option>

                                             <?php
                                             } // while
                                             $conn = null;
                                             ?>
                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Current Job </label>
                                            
                                            <input name="current_job" type="text" class="form-control <?php echo (!empty($current_err)) ? 'is-invalid' : ''; ?>" required="true" autocomplete="off" value="<?php echo $current_job; ?>">
                                            *Please type "-" if applicable doesn't have job.
                                            <span class="invalid-feedback"><?php echo $current_job_err; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <textarea id="experience" name="experience" class="form-control <?php echo (!empty($experience_err)) ? 'is-invalid' : ''; ?>" required length="50" maxlength="400" style='height: 80px;' required="true" autocomplete="off" value="<?php echo $experience; ?>"></textarea>
                                            <span class="invalid-feedback"><?php echo $experience_err; ?></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Resume </label>
                                            
                                            <input type="file" id="image" name="image" required="true"/>    

                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            
                                                <button class="btn btn-primary" style="float: right; margin-top: 40px;" name="submit" id="submit" type="submit" value="Submit">Apply</button>
                                            </div>
                                        
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>

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

  

</body>
</html>

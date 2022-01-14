<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

 ?>



<?php
// Include config file



 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 



            $message = "
            <h2>Pengesahan pendaftaran akaun.</h2>
            <p>Satu pendaftaran pengguna baru telah dilakukan. Sila berikan pengesahan pendaftaran segera!</p>
            <p>Maklumat akaun:</p>";


            require 'vendor\autoload.php';
            $mail = new PHPMailer(TRUE);

            try {
                //Server settings
                $mail->isSMTP();                                     
                $mail->Host = 'smtp.gmail.com';                      
                $mail->SMTPAuth = true;
                
                $mail->Username = 'noreply.opdp@gmail.com'; 
                $mail->Password = 'opdp123!';                               
                                    
                $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                );                         
                $mail->SMTPSecure = 'ssl';                           
                $mail->Port = 465;                                   

                $mail->setFrom('noreply.opdp@gmail.com', 'Objek Pembelajaran Digital Pengaturcaraan (OPDP)');
                
                //Recipients
                $mail->addAddress('habibslayer@gmail.com');
               
                //Content
                $mail->isHTML(true);                                  
                $mail->Subject = 'OPDP Pendaftaran Akaun';
                $mail->Body    = $message;

                $mail->send();

                $_SESSION['success'] = 'Account created. Check your email to activate.';

            } catch (Exception $e) {
                $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                
            }
                // Redirect to login page
                ?>


                
                <?php

}
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <style type="text/css"></style>
  <title>OPDP : Daftar</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]   images/background.png   -->
    <style>
body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

</style>

</head>
<body style="background-color: #FFFFFF; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">

   <?php
   if(isset($message))
    {
      echo '<label class="text-danger">'.$message.'</label>';
    }
    ?>  

     <center><div class="daftar">

  <!-- Trigger the modal with a button -->
        <h2>Daftar Akaun</h2>
        <p>Sila isi maklumat pendaftaran akaun anda</p> 
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


            <div class="form-group">
                <label>Nama Pengajar</label>
                <input type="text" name="nama" class="form-control" value="" required>
                
            </div>

            <div class="form-group">
                <label>Katalaluan</label>
                <input type="password" name="password" class="form-control" value="" required>
                
            </div>
            

            


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            
        </form>
    </div> </center> 

    <div class="footer">
      <footer>
          <p>Hakcipta © 2020 Muhammad Habib Bin Yahya</p>
        </footer> 
     </div>



     
     

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
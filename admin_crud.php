<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once 'config.php';
include_once 'session.php';

 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//edit
if (isset($_GET['edit'])) {


    try {

        $stmt = $conn->prepare("SELECT * FROM job_application WHERE 
          id = :uid");
      $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
        $uid = $_GET['edit'];
      $stmt->execute();
      $readrow1 = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

  $message = "
            <h2>Assalamualaikum. Terima kasih atas minat anda untuk berkerja bersama kami.</h2>
            <p>Di harap encik/puan ".$readrow1['fullname']." dapat mendaftarkan diri anda di laman web myfuturejobs untuk kami teruskan proses permohonan encik/puan. Di bawah saya sertakan sekali langkah-langkah untuk mendaftarkan diri di laman web tersebut.
            </p>
            <h3>LANGKAH MENDAFTAR DI MYFUTUREJOB:-</h3>
            <p>1. KLIK LINK - https://www.myfuturejobs.gov.my/ <br>
            2. KLIK ICON - JOBSEEKER <br>
            3. KLIK DI NEW USER - REGISTER <br>
            4. ISI DETAILS <br>
            - E-mail <br>
            - IC Number (NRIC without dash(-)) <br>
            - Password <br>
            5. Please accept the Terms and Conditions and Privacy Policy to proceed with your registration - ACCEPT <br>
            6. ISI DETAILS - PERSONAL INFORMATION <br>
            7. COMPETE DETAILS SAVE <br>
            8. LEPAS TU PERGI KE - SEARCH JOB <br>
            9. WHAT - SALES FLOOR OPERATION <br>
            10. WHERE - JASIN <br>
            11. KLIK - SEARCH <br>
            12. LAST KENE KLIK - APPLY <br>
            13. SEND IC COPY KEPADA lesongmart2020@gmail.com BILA DAH KLIK APPLY <br>
            -------------------------TAMAT-------------------</p>
            <p>Terima kasih.</p>
          ";

          require 'vendor\autoload.php';

  $mail = new PHPMailer(TRUE);
 
  try {

    $stmt = $conn->prepare("UPDATE job_application SET status = :status WHERE id = :sid");
     
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
       
    $sid = $_GET['edit'];
    $status = 'Accepted';

    try {
                //Server settings
                $mail->isSMTP();                                     
                $mail->Host = 'smtp.gmail.com';                      
                $mail->SMTPAuth = true;
                
                $mail->Username = 'muhdhabib301@gmail.com'; 
                $mail->Password = 'mhyja8144';                               
                                    
                $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                );                         
                $mail->SMTPSecure = 'ssl';                           
                $mail->Port = 465;                                   

                $mail->setFrom('muhdhabib301@gmail.com', 'Lesong Mart Career');
                $mail->AddReplyTo('muhdhabib301@gmail.com');
                
                //Recipients
                $mail->addAddress($readrow1['email']);
               
                //Content
                $mail->isHTML(true);                                  
                $mail->Subject = 'Lesong Mart Career';
                $mail->Body    = $message;

                $mail->send();

                
                unset($_SESSION['email']);

                $_SESSION['success'] = 'Email has been sent.';

            } 
            catch (Exception $e) {
                $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                header("Location: logout.php");
            }


  
    $stmt->execute();
 
    header("Location: homepage.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
 
//Delete
if (isset($_GET['delete'])) {

  try {

      $stmt = $conn->prepare("SELECT * FROM job_application WHERE 
          id = :uid");
      $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
        $uid = $_GET['delete'];
      $stmt->execute();
      $readrow1 = $stmt->fetch(PDO::FETCH_ASSOC);

      header("Location: reason.php?edit=$uid");
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    

    
}
 

 
?>
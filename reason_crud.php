<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once 'config.php';
include_once 'session.php';

 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Update
if (isset($_POST['update'])) {


    try {
 
    
    $stmt = $conn->prepare("SELECT * FROM job_application WHERE id = :uid");
   
    
    $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
       
    $uid = $_GET['edit'];
     
    
    $stmt->execute();
 
    
  $editrow = $stmt->fetch(PDO::FETCH_ASSOC);

    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
   

   $message = "
            
            <p>Assalamualaikum encik/puan ".$editrow['fullname']."</p>

            <p>Terima kasih atas minat anda untuk berkerja bersama kami.</p>
            <p>Selepas menyemak kelayakan anda, kami mohon maaf kerana kami tidak dapat menawarkan anda jawatan kali ini. Ini bukan cerminan kemahiran dan kebolehan anda tetapi keperluan kami untuk memastikan kami memadankan pekerjaan yang betul dengan orang yang betul.</p>

            <p>Kami doakan anda berjaya dalam usaha anda pada masa hadapan.</p>

            <p>Terima kasih.</p>
          ";

          require 'vendor\autoload.php';

  $mail = new PHPMailer(TRUE);

  try {

    $check = 'Rejected';
    
    $stmt2 = $conn->prepare("UPDATE job_application SET status = :status, reason = :reason WHERE id = :oid");
   
    $stmt2->bindParam(':oid', $oid, PDO::PARAM_STR);

    $stmt2->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt2->bindParam(':reason', $reason, PDO::PARAM_STR);
       
    $oid = $_GET['edit'];
    
    $status = $check;
    $reason = $_POST['reason'];


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
                $mail->addAddress($editrow['email']);
               
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
     
    $stmt2->execute();

    header("Location: homepage.php");
 
    
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }




}



//Edit
if (isset($_GET['edit'])) {
   
    try {
 
    
    $stmt2 = $conn->prepare("SELECT * FROM job_application WHERE id = :oid");
   
    
    $stmt2->bindParam(':oid', $oid, PDO::PARAM_STR);
       
    $oid = $_GET['edit'];
     
    
    $stmt2->execute();
 
    
  $editrow2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
 

 

 
?>
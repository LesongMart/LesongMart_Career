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
   


  try {

    $check = 'Rejected';
    
    $stmt2 = $conn->prepare("UPDATE job_application SET status = :status, reason = :reason WHERE id = :oid");
   
    $stmt2->bindParam(':oid', $oid, PDO::PARAM_STR);

    $stmt2->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt2->bindParam(':reason', $reason, PDO::PARAM_STR);
       
    $oid = $_GET['edit'];
    
    $status = $check;
    $reason = $_POST['reason'];

     
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

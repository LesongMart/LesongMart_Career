<?php

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
include_once 'config.php';
include_once 'session.php';

 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 
//Delete
if (isset($_GET['delete'])) {

  try {

      $stmt = $conn->prepare("SELECT * FROM job_application WHERE 
          id = :uid");
      $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
        $uid = $_GET['delete'];
      $stmt->execute();
      $readrow1 = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
 
  try {

    $stmt2 = $conn->prepare("DELETE FROM job_application where id = :sid");
   
    $stmt2->bindParam(':sid', $sid, PDO::PARAM_STR);
     
    $sid = $_GET['delete'];
     
    $stmt2->execute();
 
    header("Location: application_history.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 

 
?>
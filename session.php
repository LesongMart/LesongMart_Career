<?php
include_once 'config.php';

session_start(); 
	
	$sid = $_SESSION['id'];
	
	$stmt = $conn->prepare("SELECT * FROM user_lesong WHERE id = '$sid'");

	$stmt->execute();
	
	$readrow = $stmt->fetch(PDO::FETCH_ASSOC);

	$sid = $readrow['id'];
	$email = $readrow['email'];
	$nama = $readrow['name'];
	$pass = $readrow['password'];
	



		if(!isset($_SESSION["admin_logged"]) || $_SESSION["admin_logged"] !== true){
    header("location: index.php");
    exit;
	}

else if($sid==''){
	header("location:index.php");
	}
	else {
	header("");
	}
?>
<?php
 
// $servername = "lrgs.ftsm.ukm.my";
// $username = "a170584";
// $password = "bigredhorse";
// $dbname = "a170584";


$servername = "remotemysql.com";
$username = "Ox6MaC56bL";
$password = "OJ6wGRITfp";
$dbname = "Ox6MaC56bL4";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
?>
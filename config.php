<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'remotemysql.com');
define('DB_USERNAME', 'Ox6MaC56bL');
define('DB_PASSWORD', 'OJ6wGRITfp');
define('DB_NAME', 'Ox6MaC56bL');

/* Attempt to connect to MySQL database */
$link = mysqli_connect('remotemysql.com','Ox6MaC56bL','OJ6wGRITfp','Ox6MaC56bL');
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<?php
 
$servername = "remotemysql.com";
$username = "Ox6MaC56bL";
$password = "OJ6wGRITfp";
$dbname = "Ox6MaC56bL";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$dbh = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME,DB_USERNAME, DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
?>
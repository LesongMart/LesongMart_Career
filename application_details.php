<?php
  include_once 'config.php';
  include_once 'session.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Lesong Mart Career</title>

  <!-- Site favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/logo_lesong.png">
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

  <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
 

<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM job_application WHERE id = :pid");
  $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $pid = $_GET['pid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>

 
<div class="container-fluid">
  
      <div class="panel panel-default">
      <div class="panel-heading"><strong>Application Details</strong></div>
      <div class="panel-body">
            Below are specifications of the application.
        </div>
      <table class="table">
        <tr>
          <td class="col-xs-4 col-sm-4 col-md-4"><strong>Full Name</strong></td>
          <td><?php echo $readrow['fullname'] ?></td>
        </tr>
        <tr>
          <td><strong>Age</strong></td>
          <td><?php echo $readrow['age'] ?></td>
        </tr>
       <td><strong>Email</strong></td>
          <td><?php echo $readrow['email'] ?></td>
        </tr>
        <tr>
          <td><strong>Phone Number</strong></td>
          <td><?php echo $readrow['phoneno'] ?></td>
        </tr>
        <tr>
          <td><strong>Home Address</strong></td>
          <td><?php echo $readrow['address'] ?></td>
        </tr>
        <tr>
          <td><strong>High Level Education</strong></td>
          <td><?php echo $readrow['education'] ?></td>
        </tr>
        <tr>
          <td><strong>Type Job Apply</strong></td>
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM job_type WHERE id_type = :tid");
            $stmt->bindParam(':tid', $tid, PDO::PARAM_STR);
            $tid = $readrow['job_apply'];
            $stmt->execute();
            $readrow2 = $stmt->fetch(PDO::FETCH_ASSOC);
          }
          catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
          $conn = null;
          ?>

          <td><?php echo $readrow2['type'] ?></td>
        </tr>
        <tr>
          <td><strong>Current Jobs</strong></td>
          <td><?php echo $readrow['current_job'] ?></td>
        </tr>
        <tr>
          <td><strong>Experience</strong></td>
          <td><?php echo $readrow['experience'] ?></td>
        </tr>


        <?php if($readrow['status'] != ''){
        ?>

        <tr>
          <td><strong>Application Status</strong></td>
          <td><?php echo $readrow['status'] ?></td>
        </tr>

    <?php } ?>

    <?php if($readrow['reason'] != ''){
        ?>

        <tr>
          <td><strong>Rejection Reason</strong></td>
          <td><?php echo $readrow['reason'] ?></td>
        </tr>

    <?php } ?>

        <tr>
          <td><strong>Resume</strong></td>
          <td><a href="resume/<?php echo $readrow['resume']; ?>" target="_blank" class="btn btn-success btn-xs" role="button">Open</a></td>
        </tr>
      </table>  
      </div>  
    </div>
  </div>
</div>
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 
</body>
</html>
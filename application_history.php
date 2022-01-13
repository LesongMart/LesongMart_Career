<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

  include_once 'config.php';
  include_once 'session.php';
  include_once 'history_crud.php';

?>

<!DOCTYPE html>
<html>
<head>
  <!-- Basic Page Info -->
  <meta charset="utf-8">
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



  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-119386393-1');
  </script>
</head>


<body>

  <div class="login-header box-shadow">
    <div class="container-fluid align-items-center">
      <div class="brand-logo">
          <a href="homepage.php">
          <img src="vendors/images/logo_lesong.png" alt="" style="height: 70%;">
        </a>
      </div>

          <a href="logout.php" onclick="return confirm('You are sure to logout?');" class="btn btn-primary btn-xs" style="float: right; margin-bottom: 10px;" role="button">LOGOUT</a>
      
     
    </div>
  </div>



  <div class="main-container" style="background-color: #f0f0f0; padding: 20px; padding-top: 40px;">
    <div class="pb-20">
      <div class="min-height-200px">
        <div class="page-header" style="margin-top: 10px;">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="title">
                <h4>List Jobs Application</h4>
              </div>
              

            </div>
          </div>
        </div>



        <div class="row pb-10">
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
          <div class="card-box height-100-p widget-style3">


             <?php
            $sql = "SELECT id from job_application";
            $stmt= $conn -> prepare($sql);
            $stmt->execute();
            $results=$stmt->fetchAll(PDO::FETCH_OBJ);
            $appcount=$stmt->rowCount();
            ?>


            <div class="d-flex flex-wrap">
              <div class="widget-data">
                <div class="weight-700 font-24 text-dark"><?php echo($appcount);?></div>
                <div class="font-14 text-secondary weight-500">Total Application</div>
              </div>
              <div class="widget-icon">
                <div class="icon"><i class="icon-copy dw dw-user-2" style="color: #00eccf;"></i></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
          <div class="card-box height-100-p widget-style3">

                <?php
            $sql = "SELECT id from job_application where status = '' ";
            $stmt= $conn -> prepare($sql);
            $stmt->execute();
            $results=$stmt->fetchAll(PDO::FETCH_OBJ);
            $pendingcount=$stmt->rowCount();
            ?>   

            <div class="d-flex flex-wrap">
              <div class="widget-data">
                <div class="weight-700 font-24 text-dark"><?php echo($pendingcount); ?></div>
                <div class="font-14 text-secondary weight-500">Pending Leave</div>
              </div>
              <div class="widget-icon">
                <div class="icon"><i class="icon-copy fa fa-hourglass-end" style="color: #ffff3b;" aria-hidden="true"></i></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
          <div class="card-box height-100-p widget-style3">

                    <?php
            $sql = "SELECT id from job_application where status = 'Accepted' ";
            $stmt= $conn -> prepare($sql);
            $stmt->execute();
            $results=$stmt->fetchAll(PDO::FETCH_OBJ);
            $acceptcount=$stmt->rowCount();
            ?> 

            <div class="d-flex flex-wrap">
              <div class="widget-data">
                <div class="weight-700 font-24 text-dark"><?php echo htmlentities($acceptcount); ?></div>
                <div class="font-14 text-secondary weight-500">Accepted Application</div>
              </div>
              <div class="widget-icon">
                <div class="icon"><i class="icon-copy fa fa-hourglass" style="color: #09cc06;"></i></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
          <div class="card-box height-100-p widget-style3">

              <?php
            $sql = "SELECT id from job_application where status = 'Rejected' ";
            $stmt= $conn -> prepare($sql);
            $stmt->execute();
            $results=$stmt->fetchAll(PDO::FETCH_OBJ);
            $rejectcount=$stmt->rowCount();
            ?> 

            <div class="d-flex flex-wrap">
              <div class="widget-data">
                <div class="weight-700 font-24 text-dark"><?php echo($rejectcount); ?></div>
                <div class="font-14 text-secondary weight-500">Rejected Application</div>
              </div>
              <div class="widget-icon">
                <div class="icon"><i class="icon-copy fa fa-hourglass-o" style="color: #ff5b5b;" aria-hidden="true"></i></div>
              </div>
            </div>
          </div>
        </div>
      </div>


        <div style="margin-left: 3px; margin-right: 3px;" class="pd-20 card-box mb-30">
          <div class="clearfix">
            <div class="pull-left" style="border-color: black; border-style: solid; border-right-style: hidden; border-bottom-style: hidden; padding-left: 10px; padding-right: 10px;">

              <h4 class="text-blue h4"><a href="homepage.php"><b>New Application</b></a></h4>



              <p class="mb-20"></p>
            </div>
            <div class="pull-left" style="background-color: #d8d8d8; border-color: black; border-style: solid; border-bottom-style: hidden; padding-left: 10px; padding-right: 10px;">
            

              <h4 class="text-blue h4"><a href="application_history.php"><b>Application History</b></a></h4>



              <p class="mb-20"></p>
            </div>

            <div class="pull-right">

              Sort status by:

              <a href="application_history.php" class="btn btn-success btn-xs" style="width: 70px;" role="button">All</a>
               <a href="application_history_accepted.php" class="btn btn-default btn-xs" style="width: 70px;" role="button">Accepted</a>
                <a href="application_history_rejected.php" class="btn btn-default btn-xs" style="width: 70px;" role="button">Rejected</a>


            </div>





          </div>



          <table class="table table-striped table-bordered">
      
        <tr style="background-color:#d8d8d8; opacity:0.9">
         <th>Full Name</th>
          <th>Age</th> 
          <th>Email</th>
          <th>Phone No</th>
          <th>Home Address</th>
          <th>Education Level</th>
          <th>Status</th>  
          <th>more...</th>
        </tr>

        <?php


      // Read
          $per_page = 20;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;

      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select * from job_application WHERE status != '' LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $total_records = count($result);
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>  

      <?php if($total_records > 0){
        ?>

        <tr>
        <td><?php echo $readrow['fullname']; ?></td>
        <td><?php echo $readrow['age']; ?></td>
        <td><?php echo $readrow['email']; ?></td>      
        <td><?php echo $readrow['phoneno']; ?></td>
        <td><?php echo $readrow['address']; ?></td>
        <td><?php echo $readrow['education']; ?></td>
        <td><?php echo $readrow['status']; ?></td>
        
        <td>

          <button data-href="application_details.php?pid=<?php echo $readrow['id']; ?>" class="btn btn-warning btn-xs" role="button">Details</button>

          <a href="application_history.php?delete=<?php echo $readrow['id']; ?>" onclick="return confirm('You are sure to delete this application?') ; " class="btn btn-danger btn-xs" role="button">Delete</a>
       
        </td>
    </tr>

    <?php } ?>

    <?php } ?>

    <?php if($total_records == 0){
        ?>

        <tr>
            <td colspan="7">
              <center>Tiada Rekod</center>

            </td>
          </tr>

          <?php } ?>
      
  </table>


  <div style="margin-left: 40%;">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM job_application WHERE status != '' ");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }

          $total_pages = ceil($total_records / $per_page);
          ?>

          <?php if($total_records > 0){
        ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="application_history.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"application_history.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"application_history.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="application_history.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
          <?php } ?>


        </ul>
      </nav>
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


  <div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
   
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Product Details</h3>
                    <button type="button" class="close" href="homepage.php" data-dismiss="modal">&times;</button>
                    
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
          <button type="button" class="btn btn-primary" href="homepage.php" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>


  <!-- js -->
  <script src="../vendors/scripts/core.js"></script>
  <script src="../vendors/scripts/script.min.js"></script>
  <script src="../vendors/scripts/process.js"></script>
  <script src="../vendors/scripts/layout-settings.js"></script>
  <script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
  <script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
  <script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
  <script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
  <script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
  <script src="../vendors/scripts/datagraph.js"></script>

  <!-- buttons for Export datatable -->
  <script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
  <script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
  <script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
  <script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
  <script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
  <script src="../src/plugins/datatables/js/pdfmake.min.js"></script>
  <script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
  
  <script src="../vendors/scripts/advanced-components.js"></script>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    

  <!--  for modal popup -->
   <script>
    $(document).ready(function(){
        $(".btn").click(function(){
           var dataURL = $(this).attr( "data-href" )
            $('.modal-body').load(dataURL,function(){
        $('#myModal').modal({show:true});
    });
        });
    });
</script>
 <style>
    .bs-example{
      margin: 20px;
    }
</style>

</body>
</html>
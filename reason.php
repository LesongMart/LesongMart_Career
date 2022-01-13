<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

  include_once 'config.php';
  include_once 'session.php';
  include_once 'reason_crud.php';

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

</head>


<body>




  <div class="main-container" style=" padding: 20px; padding-top: 40px;">
    <div class="pb-20">
      <div class="min-height-200px">
        

        <div style="margin-left: 3px; margin-right: 3px;" class="pd-20 card-box mb-30">
          <div class="clearfix">
            <div class="pull-left">

              <h4 class="text-blue h4"><b>Reason to reject this applicant</b></h4>



              <p class="mb-20"></p>
            </div>
           
          </div>


          <div class="wizard-content">
                        <form action="reason.php?edit=<?php echo $_GET['edit'];?>" method="post" enctype="multipart/form-data">
                            <section>


                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <textarea id="reason" class="form-control"  name="reason" placeholder="Type here..." style="height:80px" required><?php if(isset($_GET['edit'])) echo $editrow2['reason']; ?></textarea>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            
                                                <?php if (isset($_GET['edit'])) { ?>
      <button class="btn btn-success" type="submit" name="update">Send</button>
      <?php } else { ?>
      <button class="btn btn-default" type="submit" name="create">Save</button>
      <?php } ?>

                                                <a href="homepage.php" class="btn btn-danger" style="margin-left: 10px;" role="button">Cancel</a>

                                            </div>


                                        
                                    </div>
                                </div>
                            </section>
                        </form>
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

  

</body>
</html>
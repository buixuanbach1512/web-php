<?php
  ob_start();
  session_start();
  if(!$_SESSION["login"]){
    header("location:login.php");
  }
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  require_once("../connection.php");
  include("./function.php");
  
  $sqlSelect = "SELECT `admin`.*, position.* FROM `admin` INNER JOIN position ON `admin`.pos_id = position.pos_id WHERE admin_id=".$_SESSION["login"][0];
  $resultSelect = mysqli_query($conn,$sqlSelect);
  $rowSelect = mysqli_fetch_assoc($resultSelect);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>
    <!-- Bootstrap -->
    <link href="../assets/backend/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../assets/backend/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../assets/backend/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../assets/backend/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="../assets/backend/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../assets/backend/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../assets/backend/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../assets/backend/build/css/custom.min.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
  </head>

  <body>
  <div class="nav-md">
    <div class="container body">
      <div class="main_container">

        <?php
            include("modules/leftMenu.php"); 
        ?>

        <div class="top_nav">
          <div class="nav_menu">
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <?php
                    if(isset($_GET["page"])){
                        if($rowSelect["pos_id"]==2){
                          $regexResult = checkPrivilegeNV();
                          if(!$regexResult){
                            echo '<script>alert("Bạn không có quyền truy cập trang này !!")</script>';exit;
                          }
                        }elseif($rowSelect["pos_id"]==3){
                          $regexResult = checkPrivilegeNVK();
                          if(!$regexResult){
                            echo '<script>alert("Bạn không có quyền truy cập trang này !!")</script>';exit;
                          }
                        }
                        $page = $_GET["page"];
                        $file = "modules/".$page.".php";
                        include($file);
                    }
                    else{
                ?>
                  <ul style="list-style: none;">
                    <li><h2> Chào mừng : <?php echo $rowSelect["admin_name"]; ?></h2></li>
                    <li><h2> Chức vụ : <?php echo $rowSelect["pos_name"]; ?></h2></li>
                    <li><h2> Số điện thoại : <?php echo $rowSelect["admin_phone"]; ?></h2></li>
                    <li><h2> Địa chỉ : <?php echo $rowSelect["admin_address"]; ?></h2></li>
                  </ul>
                <?php     
                    }
                ?>    
            
            </div>
        </div>
        <!-- /page content -->

        <footer>
          <div class="pull-right">
          Gentelella - Bootstrap Admin Template by Colorlib
          </div>
          <div class="clearfix"></div>
        </footer>
      </div>
    </div>
</div>
    <!-- jQuery -->
    <script src="../assets/backend/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/backend/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/backend/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../assets/backend/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../assets/backend/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../assets/backend/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../assets/backend/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../assets/backend/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../assets/backend/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../assets/backend/vendors/Flot/jquery.flot.js"></script>
    <script src="../assets/backend/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../assets/backend/vendors/Flot/jquery.flot.time.js"></script>
    <script src="../assets/backend/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../assets/backend/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../assets/backend/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../assets/backend/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../assets/backend/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../assets/backend/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../assets/backend/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../assets/backend/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../assets/backend/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../assets/backend/vendors/moment/min/moment.min.js"></script>
    <script src="../assets/backend/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../assets/backend/build/js/custom.min.js"></script>

  </body>
</html>

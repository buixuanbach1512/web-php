<?php
  ob_start();
  session_start();
  if(isset($_SESSION["login"])){
    header("location:index.php");
  }
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  require_once("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Đăng nhập </title>

    <!-- Bootstrap -->
    <link href="../assets/backend/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../assets/backend/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../assets/backend/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../assets/backend/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../assets/backend/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body> 
      <div class="login">
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
                <?php
                    if(isset($_POST["login"])){
                        $userName = $_POST["admin_username"];
                        $password = md5($_POST["admin_password"]);
                        $sqlLogin = "SELECT * FROM `admin` WHERE admin_username='$userName' AND `admin_password` ='$password'";
                        $resultLog = mysqli_query($conn,$sqlLogin);
                        if(mysqli_num_rows($resultLog)){
                            //tạo session
                            $rowlogin = mysqli_fetch_array($resultLog);
                            $_SESSION["login"] = $rowlogin;
                            header("location:index.php");
                        }else{
                            echo "Thông tin đăng nhập chưa chính xác";
                            // header("location:login.php ");
                        }
                    }
                ?>
              <h1>From Đăng Nhập</h1>
              <div>
                <input type="text" class="form-control" id="admin_username" name="admin_username" placeholder="Tài khoản" required="" />
              </div>
              <div>
                <input type="password" class="form-control" id="admin_password" name="admin_password" placeholder="Mật khẩu" required="" />
              </div>
              <div>
                  <button type="submit" name="login">Đăng nhập</button>
                <!--<a class="btn btn-default submit" href="index.html">Log in</a>-->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                  <a href="register.php" class="to_register"> Tạo tài khoản </a>
              </div>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

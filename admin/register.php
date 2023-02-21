<?php
  ob_start();
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

    <title>Đăng ký </title>

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
            if(isset($_POST["addNew"])){
                $name = $_POST["admin_name"];
                $userName = $_POST["admin_username"];
                $password = md5($_POST["admin_password"]);

                $sqlRegister = "INSERT INTO `admin`(admin_name,admin_username,admin_password)";
                $sqlRegister .= " VALUES('$name','$userName','$password')";
                        //Thực thi câu lệnh
                mysqli_query($conn,$sqlRegister) or die("Lỗi câu lệnh truy vấn!");
            }
            ?>
            <h1>Đăng ký tài khoản</h1>
            <div>
            <input type="text" class="form-control" id="admin_name" name="admin_name" placeholder="Họ tên" required="" />
            </div>
            <div>
            <input type="text" class="form-control" id="admin_username" name="admin_username" placeholder="Tài khoản" required="" />
            </div>
            <div>
            <input type="password" class="form-control" id="admin_password" name="admin_password" placeholder="Mật khẩu" required="" />
            </div>
            <div>
                <button type="submit" name="addNew">Đăng ký</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
            <p class="change_link">Bạn đã có tài khoản ?
                <a href="login.php" class="to_register"> Đăng nhập </a>
            </p>
            </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

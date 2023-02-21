<?php
  ob_start();
  session_start();
  if(isset($_SESSION["loginHome"])){
    header("location:index.php");
  }
  require_once("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Đăng nhập TB-Shop</title>
  <link rel="stylesheet" href="./assets/frontend/css/login.css">
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>Đăng nhập</h1>
      <?php
        if(isset($_POST["loginHome"])){
            $user = trim($_POST["cus_user"]);
            $password = md5(trim($_POST["cus_password"]));
            $sqlLog = "SELECT * FROM customer WHERE cus_user='$user' AND cus_password ='$password'";
            $resultLog = mysqli_query($conn,$sqlLog);
            if(mysqli_num_rows($resultLog)){
                //tạo session
                $rowLog = mysqli_fetch_row($resultLog);
                $_SESSION["loginHome"] = $rowLog;
                header("location:index.php");
            }else{
                //header("location:login.php ");
                echo "Tài khoản hoặc mật khẩu không đúng!!";
            }
        }
      ?>
      <form method="post">
        <p><input type="text" name="cus_user" placeholder="Tài khoản"></p>
        <p><input type="password" name="cus_password" placeholder="Mật khẩu"></p>
        <p class="remember_me">
        <p class="submit"><input type="submit" name="loginHome" value="Đăng nhập"></p>
      </form>
    </div>

    <div class="login-help">
      <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>.</p>
    </div>
  </section>
</body>
</html>

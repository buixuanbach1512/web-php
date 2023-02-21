<?php
  ob_start();
  session_start();
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Đăng ký TB-Shop</title>
    <link rel="stylesheet" href="./assets/frontend/css/login.css">
  </head>
  <body>
    <section class="container">
      <div class="login">
        <h1>Đăng ký</h1>
        <?php
          if(isset($_POST["registerHome"])){
              $name = trim($_POST["cus_name"]);
              $userName = trim($_POST["cus_user"]);
              $password = md5(trim($_POST["cus_password"]));
              $phone = trim($_POST["cus_phone"]);
              $email = trim($_POST["cus_email"]);
              $address = trim($_POST["cus_address"]);
              $_POST["date_created"]=date("Y-m-d H:i:s");
              $date_create = $_POST["date_created"]; 
              $sql = "INSERT INTO customer (cus_name,cus_user,cus_password,cus_phone,cus_email,cus_address,date_created)
              VALUE ('$name','$userName','$password','$phone','$email','$address','$date_create') ";
              $result = mysqli_query($conn,$sql) or die("Lỗi !!");
              if($result){
                echo '<script>alert("Đăng ký thành công !!")</script>';
              }else {
                echo '<script>alert("Đăng ký thất bại !!")</script>';
              }
          }
        ?>
        <form method="post">
          <p><input type="text" name="cus_name" placeholder="Họ tên"></p>
          <p><input type="text" name="cus_user" placeholder="Tài khoản"></p>
          <p><input type="password" name="cus_password" placeholder="Mật khẩu"></p>
          <p><input type="text" name="cus_phone" placeholder="Điện thoại"></p>
          <p><input type="text" name="cus_email" placeholder="Email"></p>
          <p><input type="text" name="cus_address" placeholder="Điạ chỉ"></p>
          <p class="submit"><input type="submit" name="registerHome" value="Đăng ký"></p>
        </form>
      </div>
      <div class="login-help">
        <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a>.</p>
      </div>
    </section>
  </body>
</html>
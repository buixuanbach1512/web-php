<?php include "partials/header.php"; ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="./assets/frontend/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Giỏ hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.php">Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<?php
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}
$error = false;
$success = false;
if (isset($_GET["action"])) {
    function update_cart($add = false)
    {
        foreach ($_POST['quantity'] as $id => $quantity) {
            if ($quantity == 0) {
                unset($_SESSION["cart"][$id]);
            } else {
                if ($add) {
                    $_SESSION["cart"][$id] += $quantity;
                } else {
                    $_SESSION["cart"][$id] = $quantity;
                }
            }
        }
    }

    switch ($_GET["action"]) {
        case "add":
            update_cart(true);
            echo "<script> window.location.href='shoping-cart.php';</script>";
            break;
        case "delete":
            if (isset($_GET["id"])) {
                unset($_SESSION["cart"][$_GET["id"]]);
            }
            echo "<script> window.location.href='shoping-cart.php';</script>";
            break;
        case "submit":
            if (isset($_POST["update-click"])) {
                update_cart();
            } elseif (isset($_POST["order-click"])) {
                if(empty($_POST["quantity"])) {
                    $error = "Giỏ hàng rỗng !!";
                }

                if ($error == false && !empty($_POST["quantity"])) {
                    $date_create = date("Y-m-d H:i:s");
                    $sqlCart = "SELECT * FROM `product` WHERE `pro_id` IN (" . implode(",", array_keys($_POST["quantity"])) . ")";
                    $resultCart = mysqli_query($conn, $sqlCart);
                    $total = 0;
                    $orderPro = array();
                    while ($rowCart = mysqli_fetch_array($resultCart)) {
                        $orderPro[] = $rowCart;
                        $total += $rowCart["pro_price"] * $_POST["quantity"][$rowCart["pro_id"]];
                    }
                    if(isset($_SESSION["loginHome"])){
                        $order_status = 1;
                        $sqlOrder = "INSERT INTO `orders` ( order_name,cus_id, order_phone, order_address, order_note, order_total, order_status, date_created)
                            VALUES ('" . $_POST["o_name"] . "','".$_SESSION["loginHome"][0]."', '" . $_POST["phone_number"] . "', '" . $_POST["address"] . "', '" . $_POST["note"] . "', '" . $total . "','". $order_status ."', '" . $date_create . "');";
                        $resultOrder = mysqli_query($conn, $sqlOrder);
                        $oderID = $conn->insert_id;
                        $string = "";
                        foreach ($orderPro as $key => $resultCart) {
                            $string .= "('" . $oderID . "', '" . $resultCart["pro_id"] . "', '" . $_POST["quantity"][$resultCart["pro_id"]] . "', '" . $resultCart["pro_price"] . "', '" . $date_create . "')";
    
                            if ($key != count($orderPro) - 1) {
                                $string .= ",";
                            }
                        }
                        $sqlOrderDetail = "INSERT INTO order_detail (order_id, pro_id, o_quantity, o_price, date_created) VALUES " . $string . ";";
                        $resultOrderDetail = mysqli_query($conn, $sqlOrderDetail);
                        $success = "Đặt hàng thành công";
                        unset($_SESSION["cart"]);
                    }else{
                        echo '<script>alert("Bạn cần đăng nhập để đặt hàng !!!")</script>';
                    }
                }
            }
            break;
    }
}
if (!empty($_SESSION["cart"])) {
    $sqlCart = "SELECT * FROM `product` WHERE `pro_id` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")";
    $resultCart = mysqli_query($conn, $sqlCart);
}
?>
<div class="category-oder">
    <?php if (!empty($error)) { ?>
        <div style="margin-top:50px;" id="notify-msg"><?php echo $error ?>. <a class="text-cart" href="javascript:history.back()">Quay lại</a></div>
    <?php } elseif (!empty($success)) { ?>
        <div style="margin-top:50px;" id="notify-msg"><?php echo $success ?>. <a class="text-cart" href="./">Tiếp tục mua hàng</a></div>
    <?php } else { ?>
        <form id="cart-form" action="shoping-cart.php?action=submit" method="post">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th class="product-number">STT</th>
                        <th class="product-name">Tên sản phẩm</th>
                        <th class="product-img">Ảnh sản phẩm</th>
                        <th class="product-price">Đơn giá</th>
                        <th class="product-quantity">Số lượng</th>
                        <th class="total-money">Thành tiền</th>
                        <th class="product-delete">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($resultCart)) {
                        $total = 0;
                        $num = 0;
                        while ($row = mysqli_fetch_array($resultCart)) {
                            $num++;
                    ?>
                            <tr>
                                <td class="product-number"><?php echo $num; ?></td>
                                <td class="product-name"><?php echo $row["pro_name"]; ?></td>
                                <td class="product-img"><img src="<?php echo $row["pro_image"] ?>" alt="" width="80" style="margin:5px;"></td>
                                <td class="product-price"><?php echo number_format($row["pro_price"], 0, ",", "."); ?></td>
                                <td class="product-quantity">
                                    <div class="quantity-input"><input  type="text" value="<?php echo $_SESSION["cart"][$row["pro_id"]]; ?>" name="quantity[<?php echo $row["pro_id"]; ?>]" /></div>
                                </td>
                                <td class="total-money"><?php echo number_format($row["pro_price"] * $_SESSION["cart"][$row["pro_id"]], 0, ",", "."); ?><sup>đ</sup></td>
                                <td class="product-delete"><a style="color:#000;" href="shoping-cart.php?action=delete&id=<?php echo $row["pro_id"]; ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm  này?')"><i class="fa fa-trash icon-delete" ></i></a></td>
                            </tr>
                        <?php
                            $total += $row["pro_price"] * $_SESSION["cart"][$row["pro_id"]];
                        }
                        ?>
                        <tr>
                            <th>&nbsp</th>
                            <td>Tổng tiền</td>
                            <td>&nbsp</td>
                            <td>&nbsp</td>
                            <td>&nbsp</td>
                            <td><?php echo number_format($total, 0, ",", "."); ?><sup>đ</sup></td>
                            <td>&nbsp</td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
            <div class="table-wrapper"></div>
            <div class="button_cart">
                <input type="submit" class="btn-update" name="update-click" value="Cập nhật" />
            </div>
            <div style="clear:both;"></div>
            <hr>
            <div><label>Người nhận : </label><input type="text" value="" name="o_name"></div>
            <div><label>Điện thoại : </label><input type="text" value="" name="phone_number" ></div>
            <div><label>Địa chỉ : </label><input type="text" value="" name="address"></div>
            <div><label>Ghi chú : </label><textarea name="note" cols="50" rows="7"></textarea></div>
            <input style="margin-top:30px;" type="submit" name="order-click" value="Đặt hàng">
            
        </form>
    <?php } ?>
</div>
<!-- Shoping Cart Section End -->
<?php include "partials/footer.php"; ?>
<?php 
	$sqlWare = "SELECT product_warehouse.*,product.pro_name,product.pro_image,`admin`.admin_name 
    FROM product_warehouse 
    INNER JOIN product ON product_warehouse.pro_id=product.pro_id
    INNER JOIN `admin` ON product_warehouse.admin_id=`admin`.admin_id
    WHERE pro_ware_id =".$_GET["id"];
	$resultWare = mysqli_query($conn,$sqlWare);
	$rowWare = mysqli_fetch_assoc($resultWare);

    $total = ($rowWare["pro_ware_quantity"]*$rowWare["pro_im_price"]);
?>

<script>
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }

</script>

<div class="col-md-12 col-sm-12  ">
    <div class="x_content">
        <section id="my-section">  
            <h1 style="text-transform: uppercase; text-align: center;">phiếu nhập hàng</h1>
            <ul style="list-style: none ;padding-left:0;margin-top:50px">
                <li>
                    Mã phiếu nhập hàng: <?php echo $rowWare["pro_ware_id"]; ?>
                </li>
                <li>
                    Người nhập: <?php echo $rowWare["admin_name"]; ?>
                </li>
                <li>
                    Nội dung nhập hàng: <?php echo $rowWare["pro_ware_content"]; ?>
                </li>
                <li>
                    Ngày nhập hàng: <?php echo $rowWare["date_created"]; ?>
                </li>
            </ul>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Số lượng </th>   
                    <th>Giá nhập</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $rowWare["pro_name"]; ?></td>
                    <td><?php echo $rowWare["pro_ware_quantity"]; ?></td>
                    <td><?php echo number_format($rowWare["pro_im_price"], 0, ",", "."); ?><sup>đ</sup></td>
                </tr>
                </tbody>
            </table>
            <h4 style="float: right;">Tổng tiền : <?php echo number_format($total, 0, ",", "."); ?><sup>đ</sup></h4>
            <div style="clear: both;"></div>
            <h4 style="float: right;margin-top:30px;color: #333;font-weight: bold;">
                Người nhập hóa đơn
            </h4>
            <div style="clear: both;"></div>
            <h6 style="float: right;color: #333;">(Kí ghi rõ họ tên)</h6>
            <div style="clear: both;"></div>
        </section>
        <div>
            <?php 
                //Lấy thông tin đơn nhập
                $sqlSelect = "SELECT * FROM product_warehouse WHERE pro_ware_id=".$_GET["id"];
                $resultSelect = mysqli_query($conn,$sqlSelect);
                $rowSelect = mysqli_fetch_assoc($resultSelect);

                if(isset($_POST["confirm"])){
                    
                    //Cập nhật trạng thái đơn nhập
                    $sqlUpdate = "UPDATE product_warehouse SET pro_ware_status = 1 WHERE pro_ware_id=".$_GET["id"];
                    mysqli_query($conn,$sqlUpdate)or die("Error");

                    //Cập nhật số lượng sản phẩm
                    $sqlUpdatePro = "UPDATE product SET pro_quantity = pro_quantity + ".$rowSelect["pro_ware_quantity"]." WHERE pro_id=".$rowSelect["pro_id"];
                    mysqli_query($conn,$sqlUpdatePro)or die("Error");

                    header("location:index.php?page=list_pro_ware");
                } 
            ?>
            <form method="post">
                <button class="btn btn-success" onclick="printContent('my-section')">In phiếu nhập hàng</button>
                <?php
                    if($rowSelect["pro_ware_status"]==0){
                ?>
                <button class="btn btn-success" name="confirm">Chuyển vào kho</button>
                <?php
                    }
                ?>
            </form>
        </div>
    </div>
</div>

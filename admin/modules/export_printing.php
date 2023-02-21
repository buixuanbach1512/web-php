<?php 
	$sqlEx = "SELECT product_export.*,product.pro_name,`admin`.admin_name 
    FROM product_export
    INNER JOIN product ON product_export.pro_id=product.pro_id
    INNER JOIN `admin` ON product_export.admin_id=`admin`.admin_id
    WHERE pro_ex_id =".$_GET["id"];
	$resultEx = mysqli_query($conn,$sqlEx);
	$rowEx = mysqli_fetch_assoc($resultEx);

    $total = ($rowEx["pro_ex_quantity"]*$rowEx["pro_price"]);
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
            <h1 style="text-transform: uppercase; text-align: center;">phiếu xuất hàng</h1>
            <ul style="list-style: none ;padding-left:0;margin-top:50px">
                <li>
                    Mã phiếu xuất hàng: <?php echo $rowEx["pro_ex_id"]; ?>
                </li>
                <li>
                    Người xuất: <?php echo $rowEx["admin_name"]; ?>
                </li>
                <li>
                    Nội dung xuất hàng: <?php echo $rowEx["pro_ex_content"]; ?>
                </li>
                <li>
                    Ngày nhập xuất: <?php echo $rowEx["date_created"]; ?>
                </li>
            </ul>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Số lượng </th>   
                    <th>Giá bán</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $rowEx["pro_name"]; ?></td>
                    <td><?php echo $rowEx["pro_ex_quantity"]; ?></td>
                    <td><?php echo number_format($rowEx["pro_price"], 0, ",", "."); ?><sup>đ</sup></td>
                </tr>
                </tbody>
            </table>
            <h4 style="float: right;">Tổng tiền : <?php echo number_format($total, 0, ",", "."); ?><sup>đ</sup></h4>
            <div style="clear: both;"></div>
            <h4 style="float: right;margin-top:30px;color: #333;font-weight: bold;">
                Người xuất hóa đơn
            </h4>
            <div style="clear: both;"></div>
            <h6 style="float: right;color: #333;">(Kí ghi rõ họ tên)</h6>
        </section>
        <div>
            <?php 
                //Lấy thông tin đơn nhập
                $sqlSelect = "SELECT * FROM product_export WHERE pro_ex_id=".$_GET["id"];
                $resultSelect = mysqli_query($conn,$sqlSelect);
                $rowSelect = mysqli_fetch_assoc($resultSelect);

                if(isset($_POST["confirm"])){
                    //Cập nhật trạng thái đơn nhập
                    $sqlUpdate = "UPDATE product_export SET pro_ex_status = 1 WHERE pro_ex_id=".$_GET["id"];
                    mysqli_query($conn,$sqlUpdate)or die("Error");

                    //Cập nhật số lượng sản phẩm
                    $sqlUpdatePro = "UPDATE product SET pro_quantity = pro_quantity - ".$rowSelect["pro_ex_quantity"]." WHERE pro_id=".$rowSelect["pro_id"];
                    mysqli_query($conn,$sqlUpdatePro)or die("Error");

                    header("location:index.php?page=list_pro_ex");
                } 
            ?>
            <form method="post">
                <button class="btn btn-success" onclick="printContent('my-section')">In phiếu xuất hàng</button>
                <?php
                    if($rowSelect["pro_ex_status"]==0){
                ?>
                <button class="btn btn-success" name="confirm"> Xuất kho</button>
                <?php
                    }
                ?>
            </form>
        </div>
    </div>
</div>

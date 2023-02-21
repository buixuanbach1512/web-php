<div class="col-md-12 col-sm-12  ">
<div class="x_panel">
    <div class="x_title">
    <h2>Danh Sách Khách Hàng</h2>
    <div class="clearfix"></div>
    </div>
    <div class="x_content">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Tên Khách Hàng</th>  
            <th>Tài khoản</th>
            <th>Số Điện Thoại</th>
            <th>Email</th>
            <th>Địa Chỉ</th>
            <th>Ngày Tạo</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $sqlSelectPro = " SELECT * FROM customer";
            $resultSelectPro = mysqli_query($conn, $sqlSelectPro) or die("Lỗi truy vấn select!!");
            if(mysqli_num_rows($resultSelectPro) > 0) {
                $i = 0;
                while($row = mysqli_fetch_assoc($resultSelectPro)) {
                    $i++;
        ?>
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row["cus_name"]; ?></td>
            <td><?php echo $row["cus_user"]; ?></td>
            <td><?php echo $row["cus_phone"]; ?></td>
            <td><?php echo $row["cus_email"]; ?></td>
            <td><?php echo $row["cus_address"]; ?></td>
            <td><?php echo date("d-m-Y",strtotime($row["date_created"]));?></td>
        </tr>
        <?php } } ?>
        </div>
        </tbody>
    </table>
    </div>
</div>
</div>
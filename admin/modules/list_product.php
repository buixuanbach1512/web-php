<style>
.navd {
  list-style-type: none;
  text-align: center;
  margin: 0;
  padding: 0;
}

.navd li {
  display: inline-block;
  font-size: 20px;
  padding: 20px;
}
</style>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
        <h2><a>Danh sách sản phẩm</a></h2>
        <div class="clearfix"></div>
    </div>
     
    <div class="x_content">
        <form class="form-horizontal form-label-left"  method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Mã sản phẩm : </label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" name="text_id_search" class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" name="pro_id_search" class="btn btn-primary">Tìm kiếm</button>
                        </span>
                    </div>
                </div>
                <label class="col-sm-2 col-form-label">Tên sản phẩm : </label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text" name="text_name_search" class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" name="pro_name_search" class="btn btn-primary">Tìm kiếm</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    <?php
        //Kiểm tra id trên url trường hợp xóa
        if(isset($_GET["id"]) && isset($_GET["del"])){
            $sqlDelete = "DELETE FROM product WHERE pro_id=".$_GET["id"];
            mysqli_query($conn,$sqlDelete) or die("Lỗi xóa bản ghi!!");
            header("location:index.php?page=list_product");
        }
    ?>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>MSP</th>
            <th>Tên Sản Phẩm</th>
            <th>Ảnh </th>   
            <th>Size</th>
            <th>Giá bán</th>
            <th>Giá nhập</th>
            <th>Chất liệu</th>
            <th>Số lượng</th>
            <th>Ngày tạo</th> 
            <th>Lượt xem</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $item_page = 10;
            $current_page = !empty($_GET["trang"])?$_GET["trang"]:1;
            $offset = ($current_page - 1 ) * $item_page;
            $sqlSelectPro =" SELECT * FROM product LIMIT $offset,$item_page ";
            $resultSelectPro = mysqli_query($conn, $sqlSelectPro) or die("Lỗi truy vấn select!!");
            if(isset($_POST["pro_id_search"])){
                $sqlSearch = "SELECT * FROM product WHERE pro_id =".$_POST["text_id_search"];
                $resultSelectPro = mysqli_query($conn, $sqlSearch);
            }
            elseif(isset($_POST["pro_name_search"])){
                $sqlSearch = "SELECT * FROM product WHERE pro_name like '%".$_POST['text_name_search']."%'";
                $resultSelectPro = mysqli_query($conn, $sqlSearch);
            }
            $totalRecords = mysqli_query($conn,"SELECT * FROM product ");
            $totalRecords = $totalRecords->num_rows;
            $totalPage = ceil($totalRecords / $item_page);
            if(mysqli_num_rows($resultSelectPro) > 0) {
                while($row = mysqli_fetch_assoc($resultSelectPro)) {
        ?>
        <tr>
            <th scope="row"><?php echo $row["pro_id"]; ?></th>
            <td><?php echo $row["pro_name"]; ?></td>
            <td><img src="../<?php echo $row["pro_image"]; ?>" alt="" width="80"></td>
            <td><?php echo $row["pro_size"]; ?></td>
            <td><?php echo $row["pro_price"]; ?></td>
            <td><?php echo $row["pro_im_price"]; ?></td>
            <td><?php echo $row["pro_material"]; ?></td>
            <td><?php echo $row["pro_quantity"]; ?></td>
            <td><?php echo $row["date_created"]; ?></td>
            <td><?php echo $row["pro_view"]; ?></td>
            <td>
                <a href="index.php?page=editproduct&id=<?php echo $row["pro_id"] ?>&edit=1"><i class="fa fa-pencil-square-o"></i> Sửa </a>
            </td>
            <td>
                <a href="index.php?page=list_product&id=<?php echo $row["pro_id"] ?>&del=1" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm  này?')"><i class="fa fa-trash-o"></i> Xóa</a>
            </td>
        </tr>
        <?php } } ?>
        </div>
        </tbody>
    </table>
    </div>
    <ul class="navd">
       

            <?php for($i=1;$i<=$totalPage;$i++) { ?>
            <li><a href="index.php?page=list_product&trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
    </ul>
</div>
</div>
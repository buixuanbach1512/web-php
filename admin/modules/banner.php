<div class="col-md-5">
    <div class="x_panel">
        <div class="x_title">
            <h2> Banner </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <?php
                if(isset($_POST["addNew"])){
                    // Xử lý upload file ảnh
                    $path="../uploads";
                        if(isset($_FILES["ban_image"])){
                            if(isset($_FILES["ban_image"]["name"])){
                                if($_FILES["ban_image"]["type"]=="image/jpeg" || $_FILES["ban_image"]["type"]=="image/png" || $_FILES["ban_image"]["type"]=="image/gif"){
                                    if($_FILES["ban_image"]["size"]<=24000000){
                                        if($_FILES["ban_image"]["error"]==0){
                                            //Di chuyển file vào uploads
                                            move_uploaded_file($_FILES["ban_image"]["tmp_name"],$path."/".$_FILES["ban_image"]["name"]);
                                            $fileName ="uploads/".$_FILES["ban_image"]["name"];
                                        }else{
                                            echo "Lỗi file";
                                        }
                                    }else{
                                        echo "file quá lớn";
                                    }
                                }else{
                                    echo "file ko phải là ảnh";
                                }
                            }else{
                                echo "Chưa chọn file";
                            }
                        }
                    $_POST["ban_image"]=$fileName;
                    $status = isset($_POST["ban_status"])?1:0;
                    if(isset($_GET["id"]) && isset($_GET["edit"])){
                        $sqlUpdate = "UPDATE banners SET ban_status='$status',ban_image='$fileName' WHERE ban_id=".$_GET["id"];
                        mysqli_query($conn,$sqlUpdate) or die("Lỗi câu lệnh truy vấn!");
                        header("location:index.php?page=banner");
                    }else{
                        $sqlInsert = "INSERT INTO banners(ban_image,ban_status)";
                        $sqlInsert .= " VALUES('$fileName',' $status')";
                        mysqli_query($conn,$sqlInsert) or die("Lỗi câu lệnh truy vấn!");
                        header("location:index.php?page=banner");
                    }
                }
                //Kiểm tra id trên url trường hợp sửa
                $status = false;
                if(isset($_GET["id"]) && isset($_GET["edit"])){
                    $sqlEdit = "SELECT * FROM banners WHERE ban_id=".$_GET["id"];
                    $resultEdit = mysqli_query($conn, $sqlEdit);
                    $rowEdit = mysqli_fetch_row($resultEdit);
                    $status = ($rowEdit[2])?true:false;
                }
                

                //Kiểm tra id trên url trường hợp xóa
                if(isset($_GET["id"]) && isset($_GET["del"])){
                    $sqlDelete = "DELETE FROM banners WHERE ban_id=".$_GET["id"];
                    mysqli_query($conn,$sqlDelete) or die("Lỗi xóa bản ghi!!");
                    header("location:index.php?page=banner");
                }

            ?>
            <form class="form-label-left input_mask" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Chọn ảnh : </label>
                    <div class="col-md-6 col-sm-6  form-group has-feedback">
                        <input type="file" id="ban_image" name="ban_image" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-sm-3  control-label">Trạng thái</label>
                    <div class="col-md-9 col-sm-9 ">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" <?php echo ($status)?"checked":"" ?> name="ban_status" id="ban_status"> Hiển thị
                            </label>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button class="btn btn-primary" type="reset">Làm mới</button>
                        <button type="submit" class="btn btn-success" name="addNew">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-7">
<div class="x_panel">
    <div class="x_content">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody>
        <?php
            //Câu lệnh Select
            $sqlSelect = "SELECT * FROM banners";
            //Thực thi câu lệnh
            $result = mysqli_query($conn, $sqlSelect) or die("Lỗi truy vấn select!!");
            if(mysqli_num_rows($result) > 0) {
                $i = 0;
                while($row = mysqli_fetch_assoc($result)) {
                    $i++;
        ?>
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><img src="../<?php echo $row["ban_image"]; ?>" alt="" width="80"></td>
            <td><?php echo ($row["ban_status"])?"Hiển thị":"Ẩn"; ?></td>
            <td>
            <a href="index.php?page=banner&id=<?php echo $row["ban_id"]; ?>&edit=1">
                <i class="fa fa-pencil-square-o"></i> Sửa</a>
            </td>
            <td>
            <a href="index.php?page=banner&id=<?php echo $row["ban_id"]; ?>&del=1" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')"><i class="fa fa-trash-o"></i> Xóa</a>
            </td>
        </tr>
        <?php } } ?>
        </tbody>
    </table>
    </div>

</div>
</div> 

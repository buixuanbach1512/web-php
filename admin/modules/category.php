<div class="col-md-5">
    <div class="x_panel">
        <div class="x_title">
            <h2>Thêm mới danh mục</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <?php
                if(isset($_POST["addNew"])){
                    // Xử lý upload file ảnh
                    $path="../uploads";
                        if(isset($_FILES["cat_image"])){
                            if(isset($_FILES["cat_image"]["name"])){
                                if($_FILES["cat_image"]["type"]=="image/jpeg" || $_FILES["cat_image"]["type"]=="image/png" || $_FILES["cat_image"]["type"]=="image/gif"){
                                    if($_FILES["cat_image"]["size"]<=24000000){
                                        if($_FILES["cat_image"]["error"]==0){
                                            //Di chuyển file vào uploads
                                            move_uploaded_file($_FILES["cat_image"]["tmp_name"],$path."/".$_FILES["cat_image"]["name"]);
                                            $fileName ="uploads/".$_FILES["cat_image"]["name"];
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
                    $_POST["cat_image"]=$fileName;
                    $error = array();
                    $length = strlen($_POST["cat_name"]);
                    if(empty($_POST["cat_name"])){
                        $error["cat_name"] = "Chưa nhập tên danh mục";
                    }else if(!preg_match("/^[a-zA-Z ]*$/", $_POST["cat_name"])){
                        $error["cat_name"] = "Danh mục có kí tự đặc biệt";
                    }else if($length > 20){
                        $error["cat_name"] = "Tên danh mục dài tối đa 20 kí tự";
                    }else{
                        $catName = $_POST["cat_name"];
                    }
                    $status = isset($_POST["cat_status"])?1:0;

                    if(empty($error)){
                        if(isset($_GET["id"]) && isset($_GET["edit"])){
                            $sqlUpdate = "UPDATE category SET cat_name='$catName',cat_status='$status',cat_image='$fileName' WHERE cat_id=".$_GET["id"];
                            mysqli_query($conn,$sqlUpdate) or die("Lỗi câu lệnh truy vấn!");
                            header("location:index.php?page=category");
                        }else{
                            $sqlInsert = "INSERT INTO category(cat_name,cat_image,cat_status)";
                            $sqlInsert .= " VALUES('$catName','$fileName',' $status')";
                            mysqli_query($conn,$sqlInsert) or die("Lỗi câu lệnh truy vấn!");
                            header("location:index.php?page=category");
                        }
                    }
                }
                //Kiểm tra id trên url trường hợp sửa
                 $cat_name = "";
                $status = false;
                if(isset($_GET["id"]) && isset($_GET["edit"])){
                    $sqlEdit = "SELECT * FROM category WHERE cat_id=".$_GET["id"];
                    $resultEdit = mysqli_query($conn, $sqlEdit);
                    $rowEdit = mysqli_fetch_row($resultEdit);
                    $cat_name = $rowEdit[1];
                    $status = ($rowEdit[3])?true:false;
                    $image = $rowEdit[2];
                }
                

                //Kiểm tra id trên url trường hợp xóa
                if(isset($_GET["id"]) && isset($_GET["del"])){
                    $sqlDelete = "DELETE FROM category WHERE cat_id=".$_GET["id"];
                    mysqli_query($conn,$sqlDelete) or die("Lỗi xóa bản ghi!!");
                    header("location:index.php?page=category");
                }

            ?>
            <form class="form-label-left input_mask" method="post" enctype="multipart/form-data">
                <?php 
                    if(isset($error['cat_name'])){
                        echo '<script>alert("'. $error["cat_name"] .'")</script>';
                    }
                ?>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Danh mục : </label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" value="<?php echo $cat_name; ?>" name="cat_name" id="cat_name" placeholder="Tên danh mục">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">Chọn ảnh : </label>
                    <div class="col-md-6 col-sm-6  form-group has-feedback">
                        <input type="file" id="cat_image" name="cat_image" >
                        <img style="margin-top: 20px" src="../<?php echo $image; ?>" alt="" width="100px">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-sm-3  control-label">Trạng thái</label>
                    <div class="col-md-9 col-sm-9 ">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" <?php echo ($status)?"checked":"" ?> name="cat_status" id="cat_status"> Hiển thị
                            </label>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button class="btn btn-primary" type="reset">Làm mới</button>
                        <button type="submit" class="btn btn-success" name="addNew">
                            <?php 
                                if(isset($_GET["id"])){
                                    echo "Sửa";
                                }else{
                                    echo "Thêm mới";
                                }
                            ?>
                        </button>
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
            <th>Tên danh mục</th>
            <th>Ảnh danh mục</th>
            <th>Trạng thái</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody>
        <?php
            //Câu lệnh Select
            $sqlSelect = "SELECT * FROM category";
            //Thực thi câu lệnh
            $result = mysqli_query($conn, $sqlSelect) or die("Lỗi truy vấn select!!");
            if(mysqli_num_rows($result) > 0) {
                $i = 0;
                while($row = mysqli_fetch_assoc($result)) {
                    $i++;
        ?>
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $row["cat_name"]; ?></td>
            <td><img src="../<?php echo $row["cat_image"]; ?>" alt="" width="80"></td>
            <td><?php echo ($row["cat_status"])?"Hiển thị":"Ẩn"; ?></td>
            <td>
            <a href="index.php?page=category&id=<?php echo $row["cat_id"]; ?>&edit=1">
                <i class="fa fa-pencil-square-o"></i> Sửa</a>
            </td>
            <td>
            <a href="index.php?page=category&id=<?php echo $row["cat_id"]; ?>&del=1" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')"><i class="fa fa-trash-o"></i> Xóa</a>
            </td>
        </tr>
        <?php } } ?>
        </tbody>
    </table>
    </div>

</div>
</div> 

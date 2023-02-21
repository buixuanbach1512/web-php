    <div class="col-md-7">
        <div class="x_panel">
            <div class="x_title">
                <h2>Sửa sản phẩm</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <?php
                    if(isset($_POST["edit"])){

                        $catId = $_POST["cat_id"];
                        $error = array();
                        if(empty($_POST["pro_name"])){
                            $error["pro_name"] = "Chưa nhập tên sản phẩm";
                        }else{
                            $proName = $_POST["pro_name"];
                        }

                        if(empty($_POST["pro_size"])){
                            $error["pro_size"] = "Chưa nhập size sản phẩm";
                        }else{
                            $proSize = $_POST["pro_size"];
                        }

                        if(empty($_POST["pro_price"])){
                            $error["pro_price"] = "Chưa nhập giá bán sản phẩm";
                        }else if(!preg_match("/^[0-9]*$/", $_POST["pro_price"])){
                            $error["pro_price"] = "Giá bán có kí tự đặc biệt";
                        }else{
                            $proPrice = $_POST["pro_price"];
                        }

                        if(empty($_POST["pro_im_price"])){
                            $error["pro_im_price"] = "Chưa nhập giá nhập sản phẩm";
                        }else if(!preg_match("/^[0-9]*$/", $_POST["pro_im_price"])){
                            $error["pro_im_price"] = "Giá nhập có kí tự đặc biệt";
                        }else{
                            $proImPrice = $_POST["pro_im_price"];
                        }

                        if(empty($_POST["pro_material"])){
                            $error["pro_material"] = "Chưa nhập chất liệu sản phẩm";
                        }else if(!preg_match("/^[a-zA-Z ]*$/", $_POST["pro_material"])){
                            $error["pro_material"] = "Chất liệu có kí tự đặc biệt";
                        }else{
                            $proMaterial = $_POST["pro_material"];
                        }

                        if(empty($_POST["pro_quantity"])){
                            $error["pro_quantity"] = "Chưa nhập số lượng sản phẩm";
                        }else if(!preg_match("/^[0-9]*$/", $_POST["pro_quantity"])){
                            $error["pro_quantity"] = "Số lượng có kí tự đặc biệt";
                        }else{
                            $proQuantity = $_POST["pro_quantity"];
                        }
 
                        if(empty($_POST["pro_desc"])){
                            $error["pro_desc"] = "Chưa nhập mô tả sản phẩm";
                        }else{
                            $proDesc = $_POST["pro_desc"];
                        }
                        $date_updated = date("Y-m-d H:i:s");
                        $path="../uploads";
                        if(isset($_FILES["pro_image"])){
                            if(isset($_FILES["pro_image"]["name"])){
                                if($_FILES["pro_image"]["type"]=="image/jpeg" || $_FILES["pro_image"]["type"]=="image/png" || $_FILES["pro_image"]["type"]=="image/gif"){
                                    if($_FILES["pro_image"]["size"]<=24000000){
                                        if($_FILES["pro_image"]["error"]==0){
                                            //Di chuyển file vào uploads
                                            move_uploaded_file($_FILES["pro_image"]["tmp_name"],$path."/".$_FILES["pro_image"]["name"]);
                                            $fileName = "uploads/".$_FILES["pro_image"]["name"];
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
                        $_POST["pro_image"]=$fileName;

                        if(empty($error)){

                            $sqlUpdate = "UPDATE product SET pro_name = '$proName', cat_id = '$catId',pro_size = '$proSize', pro_material = '$proMaterial',pro_quantity = '$proQuantity', pro_price = '$proPrice', pro_im_price = '$proImPrice', 
                            `pro_image` = '$fileName', `pro_desc` = '$proDesc', date_created = '$date_updated' WHERE 
                            pro_id = ".$_GET["id"];
                            $query = mysqli_query($conn,$sqlUpdate);
                            if($query){
                                header("location:index.php?page=list_product");
                            }
                        }
                    }
                    if(isset($_GET["id"])){
                        $sqlSelect = "SELECT * FROM product WHERE pro_id =".$_GET["id"];
                        $result = mysqli_query($conn,$sqlSelect);
                        $rowPro = mysqli_fetch_assoc($result);
                    }
                ?>
                <form class="form-label-left input_mask" method="post" enctype="multipart/form-data">
                    <?php 
                        if(isset($error['pro_name'])){
                            echo '<script>alert("'. $error["pro_name"] .'")</script>';
                        }

                        if(isset($error['pro_size'])){
                            echo '<script>alert("'. $error["pro_size"] .'")</script>';
                        }

                        if(isset($error['pro_price'])){
                            echo '<script>alert("'. $error["pro_price"] .'")</script>';
                        }

                        if(isset($error['pro_im_price'])){
                            echo '<script>alert("'. $error["pro_im_price"] .'")</script>';
                        }

                        if(isset($error['pro_material'])){
                            echo '<script>alert("'. $error["pro_material"] .'")</script>';
                        }

                        if(isset($error['pro_quantity'])){
                            echo '<script>alert("'. $error["pro_quantity"] .'")</script>';
                        }

                        if(isset($error['pro_desc'])){
                            echo '<script>alert("'. $error["pro_desc"] .'")</script>';
                        }
                    ?>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Tên sản phẩm : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="pro_name" name="pro_name" value="<?php echo $rowPro["pro_name"];?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Chọn danh mục : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <?php
                                $sqlSelectCat = "SELECT * FROM category WHERE cat_status = 1";
                                $resultCat = mysqli_query($conn, $sqlSelectCat) or die("Lỗi truy vấn select!!");
                            ?>
                            <select class="form-control" id="cat_id" name="cat_id">
                                <option value="">--Chọn danh mục--</option>
                                <?php
                                    if(mysqli_num_rows($resultCat) > 0) {
                                        while($rowCat = mysqli_fetch_assoc($resultCat)) {
                                ?>
                                    <option value="<?php echo $rowCat["cat_id"]; ?>"<?php echo ($rowCat["cat_id"]== $rowPro["cat_id"])?'selected':'' ?>><?php echo $rowCat["cat_name"]; ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Nhập size : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="pro_size" name="pro_size" value="<?php echo $rowPro["pro_size"]; ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Nhập giá bán : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="pro_price" name="pro_price" value="<?php echo $rowPro["pro_price"]; ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Nhập giá nhập : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="pro_im_price" name="pro_im_price" value="<?php echo $rowPro["pro_im_price"]; ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Nhập chất liệu : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="pro_material" name="pro_material" value="<?php echo $rowPro["pro_material"]; ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Nhập số lượng : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="pro_quantity" name="pro_quantity" value="<?php echo $rowPro["pro_quantity"]; ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Chọn ảnh : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="file" id="pro_image" name="pro_image" >
                            <img style="margin-top: 20px" src="../<?php echo $rowPro["pro_image"]; ?>" alt="" width="100px">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  x_content">
                    <textarea class="form-control" name="pro_desc" id="pro_desc" ><?php echo $rowPro["pro_desc"]; ?></textarea>
                    <div class="ln_solid"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button class="btn btn-primary" type="reset">Làm mới</button>
                            <button type="submit" class="btn btn-success" name="edit">Sửa</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
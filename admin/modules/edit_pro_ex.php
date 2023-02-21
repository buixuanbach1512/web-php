<div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Sửa nhập hàng</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <?php
                    if(isset($_POST["editNew"])){
                        $sqlCheck = "SELECT pro_quantity FROM product WHERE pro_id=".$_POST["pro_id"];
                        $resultCheck = mysqli_query($conn,$sqlCheck);
                        $rowCheck = mysqli_fetch_assoc($resultCheck);

                        $proExId = $_POST["pro_ex_id"];
                        $proExCont = $_POST["pro_ex_content"];
                        $proExNote = $_POST["pro_ex_note"];
                        $proId = $_POST["pro_id"];
                        $proExQuan = $_POST["pro_ex_quantity"];
                        $proPrice = $_POST["pro_price"];
                        $date_updated = date("Y-m-d H:i:s");
                        $adminId = $_SESSION["login"][0];
                        if($proExQuan <= $rowCheck["pro_quantity"]){
                            $sqlUpdate = "UPDATE product_export SET pro_ex_id = '$proExId', admin_id = '$adminId',pro_ex_content = '$proExCont', pro_ex_note = '$proExNote', pro_id = '$proId', pro_price = '$proPrice', pro_ex_quantity = '$proExQuan', date_created = '$date_updated' 
                            WHERE pro_ex_id = ".$_GET["id"];
                            mysqli_query($conn,$sqlUpdate) or die("Error");           
                            header("location:index.php?page=list_pro_ex");
                        }else{
                            echo '<script>alert("Sản phẩm trong kho không đủ !!")</script>';
                        }
                       
                    }

                    if(isset($_GET["id"])){
                        $sqlSelect = "SELECT * FROM product_export WHERE pro_ex_id =".$_GET["id"];
                        $result = mysqli_query($conn,$sqlSelect);
                        $rowProW = mysqli_fetch_assoc($result);
                    }


                ?>
                <form class="form-label-left input_mask" method="post">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2 col-sm-2 ">Mã đơn nhập : </label>
                        <div class="col-md-10 col-sm-10 ">
                            <input type="text" class="form-control" id="pro_ex_id" name="pro_ex_id" value="<?php echo $rowProW["pro_ex_id"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2 col-sm-2 ">Nội dung nhập : </label>
                        <div class="col-md-10 col-sm-10 ">
                            <input type="text" class="form-control" id="pro_ex_content" name="pro_ex_content" value="<?php echo $rowProW["pro_ex_content"]; ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2 col-sm-2 ">Ghi chú : </label>
                        <div class="col-md-10 col-sm-10 ">
                            <textarea class="form-control" id="pro_ex_note" name="pro_ex_note" ><?php echo $rowProW["pro_ex_note"]; ?></textarea>
                        </div>
                    </div>
                    <div style="margin-top:50px;"></div>
                    <div class="form-group row">
                        <label>Dữ liệu nhập hàng : </label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th>
                                    <?php
                                        $sqlSelectPro = "SELECT * FROM product";
                                        $resultPro = mysqli_query($conn, $sqlSelectPro) or die("Lỗi truy vấn select!!");
                                    ?>
                                    <select class="form-control" id="pro_id" name="pro_id">
                                        <option value="">--Chọn sản phẩm--</option>
                                        <?php
                                            if(mysqli_num_rows($resultPro) > 0) {
                                                while($rowPro = mysqli_fetch_assoc($resultPro)) {
                                        ?>
                                            <option value="<?php echo $rowPro["pro_id"]; ?>"<?php echo ($rowPro["pro_id"]== $rowProW["pro_id"])?'selected':'' ?>><?php echo $rowPro["pro_name"]; ?></option>
                                        <?php } } ?>
                                    </select>
                                </th>
                                <td>
                                    <input type="text" class="form-control" id="pro_ex_quantity" name="pro_ex_quantity" value="<?php echo $rowProW["pro_ex_quantity"]; ?>" >
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="pro_price" name="pro_price" value="<?php echo $rowProW["pro_price"]; ?>" >
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button class="btn btn-primary" type="reset">Làm mới</button>
                            <button type="submit" class="btn btn-success" name="editNew">Sửa</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
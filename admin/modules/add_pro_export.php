<div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thêm mới xuất hàng</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <?php
                    if(isset($_POST["addNew"])){
                        if($_POST["pro_id"]==0){
                            echo '<script>alert("Vui lòng chọn sản phẩm")</script>';
                        }else{
                            $sqlCheck = "SELECT pro_quantity FROM product WHERE pro_id=".$_POST["pro_id"];
                            $resultCheck = mysqli_query($conn,$sqlCheck);
                            $rowCheck = mysqli_fetch_assoc($resultCheck);

                            $proExId = $_POST["pro_ex_id"];
                            $proExCont = $_POST["pro_ex_content"];
                            $proExNote = $_POST["pro_ex_note"];
                            $proId = $_POST["pro_id"];
                            $proExQuan = $_POST["pro_ex_quantity"];
                            $proPrice = $_POST["pro_price"];
                            $proExStatus = 0;
                            $date_created = date("Y-m-d H:i:s");
                            $adminId = $_SESSION["login"][0];
                            if($proExQuan <= $rowCheck["pro_quantity"]){
                                $sqlInsert = "INSERT INTO product_export(pro_ex_id,admin_id,pro_ex_content,pro_ex_note,pro_id,pro_ex_quantity,pro_price,pro_ex_status,date_created)";
                                $sqlInsert .= " VALUES('$proExId','$adminId',' $proExCont', '$proExNote','$proId', '$proExQuan','$proPrice','$proExStatus','$date_created')";
                                mysqli_query($conn,$sqlInsert) or die($sqlInsert);

                                header("location:index.php?page=list_pro_ex");
                            }else{
                                echo '<script>alert("Sản phẩm trong kho không đủ !!")</script>';
                            }
                        }
                    }


                ?>
                <form class="form-label-left input_mask" method="post">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2 col-sm-2 ">Mã đơn xuất : </label>
                        <div class="col-md-10 col-sm-10 ">
                            <input type="text" class="form-control" id="pro_ex_id" name="pro_ex_id" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2 col-sm-2 ">Nội dung xuất : </label>
                        <div class="col-md-10 col-sm-10 ">
                            <input type="text" class="form-control" id="pro_ex_content" name="pro_ex_content" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2 col-sm-2 ">Ghi chú : </label>
                        <div class="col-md-10 col-sm-10 ">
                            <textarea class="form-control" id="pro_ex_note" name="pro_ex_note" ></textarea>
                        </div>
                    </div>
                    <div style="margin-top:50px;"></div>
                    <div class="form-group row">
                        <label>Dữ liệu xuất hàng : </label>
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
                                <td>
                                    <?php
                                        $sqlSelectPro = "SELECT * FROM product";
                                        $resultPro = mysqli_query($conn, $sqlSelectPro) or die("Lỗi truy vấn select!!");
                                    ?>
                                    <select class="form-control" id="pro_id" name="pro_id">
                                        <option value="0">--Chọn sản phẩm--</option>
                                        <?php
                                            if(mysqli_num_rows($resultPro) > 0) {
                                                while($rowPro = mysqli_fetch_assoc($resultPro)) {
                                        ?>
                                            <option value="<?php echo $rowPro["pro_id"]; ?>"><?php echo $rowPro["pro_name"]; ?></option>
                                        <?php } } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="pro_ex_quantity" name="pro_ex_quantity" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="pro_price" name="pro_price" required>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button class="btn btn-primary" type="reset">Làm mới</button>
                            <button type="submit" class="btn btn-success" name="addNew">Thêm mới</button>  
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
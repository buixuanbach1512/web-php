<div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thêm mới nhập hàng</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <?php
                    if(isset($_POST["addNew"])){

                        $error = array();
                        $lengthCont = strlen($_POST["pro_ware_content"]);
                        $lengthNote = strlen($_POST["pro_ware_note"]);

                        if(empty($_POST["pro_ware_content"])){
                            $error["pro_ware_content"] = "Bạn chưa nhập nội dung nhập kho";
                        }else if($lengthCont > 50){
                            $error["pro_ware_content"] = "Nội dung không được vượt quá 50 kí tự";
                        }else{
                            $proWareCont = $_POST["pro_ware_content"];
                        }

                        if(empty($_POST["pro_ware_note"])){
                            $error["pro_ware_note"] = "Bạn chưa nhập ghi chú nhập kho";
                        }else if($lengthNote > 50){
                            $error["pro_ware_note"] = "Ghi chú không được vượt quá 50 kí tự";
                        }else{
                            $proWareNote = $_POST["pro_ware_note"];
                        }

                        $proId = $_POST["pro_id"];

                        if(empty($_POST["pro_ware_quantity"])){
                            $error["pro_ware_quantity"] = "Bạn chưa nhập số lượng sản phẩm";
                        }else if(!preg_match("/^[0-9]*$/", $_POST["pro_ware_quantity"])){
                            $error["pro_ware_quantity"] = "Số lượng chỉ có thể là số";
                        }else{
                            $proWareQuan = $_POST["pro_ware_quantity"];
                        }

                        if(empty($_POST["pro_im_price"])){
                            $error["pro_im_price"] = "Bạn chưa nhập giá nhập sản phẩm";
                        }else if(!preg_match("/^[0-9]*$/", $_POST["pro_im_price"])){
                            $error["pro_im_price"] = "Giá nhập phải là số";
                        }else{
                            $proImPrice = $_POST["pro_im_price"];
                        }
                        $proWareStatus = 0;
                        $date_created = date("Y-m-d H:i:s");
                        $adminId = $_SESSION["login"][0];

                        if(empty($error)){

                            $sqlInsert = "INSERT INTO product_warehouse(admin_id,pro_ware_content,pro_ware_note,pro_id,pro_ware_quantity,pro_im_price,pro_ware_status,date_created)";
                            $sqlInsert .= " VALUES('$adminId',' $proWareCont', '$proWareNote','$proId', '$proWareQuan','$proImPrice','$proWareStatus','$date_created')";
                            mysqli_query($conn,$sqlInsert) or die($sqlInsert);
     
                            header("location:index.php?page=list_pro_ware");
                        }

                    }
                ?>
                <form class="form-label-left input_mask" method="post">
                    <?php 
                        if(isset($error['pro_ware_content'])){
                            echo '<script>alert("'. $error["pro_ware_content"] .'")</script>';
                        }

                        if(isset($error['pro_ware_note'])){
                            echo '<script>alert("'. $error["pro_ware_note"] .'")</script>';
                        }

                        if(isset($error['pro_ware_quantity'])){
                            echo '<script>alert("'. $error["pro_ware_quantity"] .'")</script>';
                        }

                        if(isset($error['pro_im_price'])){
                            echo '<script>alert("'. $error["pro_im_price"] .'")</script>';
                        }
                    ?>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2 col-sm-2 ">Nội dung nhập : </label>
                        <div class="col-md-10 col-sm-10 ">
                            <input type="text" class="form-control" id="pro_ware_content" name="pro_ware_content" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2 col-sm-2 ">Ghi chú : </label>
                        <div class="col-md-10 col-sm-10 ">
                            <textarea class="form-control" id="pro_ware_note" name="pro_ware_note" ></textarea>
                        </div>
                    </div>
                    <div style="margin-top:50px;"></div>
                    <div class="form-group row">
                        <label>Dữ liệu nhập hàng : </label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
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
                                        <option value="0">--Chọn sản phẩm--</option>
                                        <?php
                                            if(mysqli_num_rows($resultPro) > 0) {
                                                while($rowPro = mysqli_fetch_assoc($resultPro)) {
                                        ?>
                                            <option value="<?php echo $rowPro["pro_id"]; ?>"><?php echo $rowPro["pro_name"]; ?></option>
                                        <?php } } ?>
                                    </select>
                                </th>
                                <td>
                                    <input type="text" class="form-control" id="pro_ware_quantity" name="pro_ware_quantity" >
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="pro_im_price" name="pro_im_price" >
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
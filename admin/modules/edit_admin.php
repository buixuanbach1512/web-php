<div class="col-md-7">
        <div class="x_panel">
            <div class="x_title">
                <h2>Sửa thông tin nhân viên</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <?php
                    if(isset($_POST["edit"])){
                        $adminName = $_POST["admin_name"];
                        $address = $_POST["admin_address"];
                        $phone = $_POST["admin_phone"];
                        $posID = $_POST["pos_id"];

                        $sqlUpdate = "UPDATE `admin` SET admin_name = '$adminName', admin_address = '$address',admin_phone = '$phone', pos_id = '$posID' WHERE admin_id = ".$_GET["id"];
                        $query = mysqli_query($conn,$sqlUpdate);
                        if($query){
                            header("location:index.php?page=list_admin");
                        }else{
                            echo "error";
                        }
                    }
                    if(isset($_GET["id"])){
                        $sqlSelect = "SELECT * FROM `admin` WHERE admin_id =".$_GET["id"];
                        $resultSelect = mysqli_query($conn,$sqlSelect);
                        $rowSelect = mysqli_fetch_assoc($resultSelect);
                    }
                ?>
                <form class="form-label-left input_mask" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Họ tên : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="admin_name" name="admin_name" value="<?php echo $rowSelect["admin_name"];?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Chọn chức vụ : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <?php
                                $sqlSelectPos = "SELECT * FROM position";
                                $resultPos = mysqli_query($conn, $sqlSelectPos) or die("Lỗi truy vấn select!!");
                            ?>
                            <select class="form-control" id="pos_id" name="pos_id">
                                <option value="">-- Chọn chức vụ --</option>
                                <?php
                                    if(mysqli_num_rows($resultPos) > 0) {
                                        while($rowPos = mysqli_fetch_assoc($resultPos)) {
                                ?>
                                    <option value="<?php echo $rowPos["pos_id"]; ?>"<?php echo ($rowPos["pos_id"]== $rowSelect["pos_id"])?'selected':'' ?>><?php echo $rowPos["pos_name"]; ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Nhập địa chỉ : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="admin_address" name="admin_address" value="<?php echo $rowSelect["admin_address"]; ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Nhập số điện thoại : </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="admin_phone" name="admin_phone" value="<?php echo $rowSelect["admin_phone"]; ?>" >
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="button" class="btn btn-primary">Quay lại</button>
                            <button class="btn btn-primary" type="reset">Làm mới</button>
                            <button type="submit" class="btn btn-success" name="edit">Sửa</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
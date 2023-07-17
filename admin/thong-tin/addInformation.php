<?php include '../index/head.php' ?>
<?php include '../index/nav.php' ?>

<section class="main_content dashboard_part">
<?php
    include '../index/userAdmin.php';

    ?>




    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">

                <div class="col-lg-12">
                    <div class="white_box mb_30">
                        <div class="box_header ">
                            <div class="main-title">
                                <h3 class="mb-0">Loại Sản Phẩm</h3>
                            </div>
                        </div>
                        <form>
                            <div class="row justify-content-center">
                                <div class="mb-3 ">
                                    <label class="form-label" for="exampleFormControlInput1">Hình Ảnh</label>
                                    <input type="file" name='hinh' class="form-control" id="inputGroupFile01">
                                </div>

                                <div class="mb-3  ">
                                    <label class="form-label" for="exampleFormControlInput1">Mô Tả</label>
                                    <textarea name=""  class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                                <!-- <div class="mb-3 col-lg-4 ">
                                    <label class="form-label" for="exampleFormControlInput1">Tên loại</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1">
                                </div> -->


                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-info" id="inputGroupFile01" style="float:right" value="CẬP NHẬT">
                            </div>
                        </form>
                    </div>
                </div>


            </div>

        </div>

        <?php include '../index/footer.php' ?>
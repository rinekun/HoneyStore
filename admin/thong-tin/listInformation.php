<?php include '../index/head.php' ?>
<?php include '../index/nav.php' ?>
<section class="main_content dashboard_part">
    <?php
    include '../index/userAdmin.php';

    ?>



    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Table</h4>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form active="#">
                                            <div class="search_field">
                                                <input type="text" placeholder="Search content here...">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="add_button ms-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn_1">Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="QA_table ">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên Sản Phẩm</th>
                                        <th scope="col">Hình Ảnh</th>
                                        <th scope="col">Nội dung</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Iphone 14</td>
                                        <td><img src="../img/logo.png" alt=""></td>
                                        <td>dsdasdasdasdasdasdasd</td>

                                        <td>
                                            <a href="#" class="status_btn">sữa</a>
                                            <a href="#" class="status_btn" style="background-color: red;">Xóa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Iphone 14</td>
                                        <td><img src="../img/logo.png" alt=""></td>
                                        <td>dsdasdasdasdasdasdasd</td>

                                        <td>
                                            <a href="#" class="status_btn">sữa</a>
                                            <a href="#" class="status_btn" style="background-color: red;">Xóa</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include '../index/footer.php' ?>
<?php
include '../../config/config.php';


if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

$admin_id = $_SESSION['admin_name'];
if (!isset($admin_id)) {
   header('location:../../dang_nhap.php');
}
if (isset($_POST['logout'])) {
   session_destroy();
   header('location:../../dang_nhap.php');
}

?>


<!DOCTYPE html>
<html lang="zxx">
<!-- Mirrored from demo.dashboardpack.com/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jun 2023 17:09:18 GMT -->

<head>

   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <title>Finance</title>
   <link rel="icon" href="../../admin/asset/img/logo.png" type="image/png">


   <link rel="stylesheet" href="../../admin/asset/css/bootstrap1.min.css" />

   <link rel="stylesheet" href="../../admin/asset/vendors/themefy_icon/themify-icons.css" />

   <link rel="stylesheet" href="../../admin/asset/vendors/swiper_slider/css/swiper.min.css" />

   <link rel="stylesheet" href="../../admin/asset/vendors/select2/css/select2.min.css" />

   <link rel="stylesheet" href="../../admin/asset/vendors/niceselect/css/nice-select.css" />

   <link rel="stylesheet" href="../../admin/asset/vendors/owl_carousel/css/owl.carousel.css" />

   <link rel="stylesheet" href="../../admin/asset/vendors/gijgo/gijgo.min.css" />

   <link rel="stylesheet" href="../../admin/asset/vendors/font_awesome/css/all.min.css" />
   <link rel="stylesheet" href="../../admin/asset/vendors/tagsinput/tagsinput.css" />

   <link rel="stylesheet" href="../../admin/asset/vendors/datatable/css/jquery.dataTables.min.css" />
   <link rel="stylesheet" href="../../admin/asset/vendors/datatable/css/responsive.dataTables.min.css" />
   <link rel="stylesheet" href="../../admin/asset/vendors/datatable/css/buttons.dataTables.min.css" />

   <link rel="stylesheet" href="../../admin/asset/vendors/text_editor/summernote-bs4.css" />

   <link rel="stylesheet" href="../../admin/asset/vendors/morris/morris.css">

   <link rel="stylesheet" href="../../admin/asset/vendors/material_icon/material-icons.css" />

   <link rel="stylesheet" href="../../admin/asset/css/metisMenu.css">

   <link rel="stylesheet" href="../../admin/asset/css/style1.css" />
   <link rel="stylesheet" href="../../admin/asset/css/colors/default.css" id="colorSkinCSS">

</head>

<body class="crm_body_bg">
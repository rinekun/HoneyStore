<?php
include_once '../config/config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:./dang_nhap.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:./dang_nhap.php');
}
?>
<style type="text/css">
    <?php
    include '../css/main.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- slick slider link -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <!--  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Home page</title>
</head>

<body>
    <?php
    include './user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>ABOUT US</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, tenetur.</p>
            <a href="../index.php">home</a>/<span>about us</span>
        </div>
    </div>
    <div class="line"></div>
    <!-- about ut -->
    <div class="about-ut">
        <div class="row">
            <div class="box">
                <div class="title">
                    <span>ABOUT OUR ONLINE SRORY</span>
                    <h1>Lorem ipsum dolor sit amet.</h1>
                </div>
                <p>Lorem, ipsum dolor sit amet consectetur
                    adipisicing elit. Possimus porro alias quis, quidem nam eum!</p>
            </div>
            <div class="img-box">
                <img src="../hinh/doi_tac.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="line"></div>
    <!-- about ut end -->
    <!-- features -->
    <div class="features">
        <div class="title">
            <h1>Complete Customer Ideas</h1>
            <span>best features</span>
        </div>
        <div class="row">
            <div class="box">
                <img src="../hinh/icon.png" alt="">
                <h4>24 x 7</h4>
                <p>Online support 24/24</p>
            </div>
            <div class="box">
                <img src="../hinh/icon.png" alt="">
                <h4>24 x 7</h4>
                <p>Online support 24/24</p>
            </div>
            <div class="box">
                <img src="../hinh/icon.png" alt="">
                <h4>24 x 7</h4>
                <p>Online support 24/24</p>
            </div>
            <div class="box">
                <img src="../hinh/icon.png" alt="">
                <h4>24 x 7</h4>
                <p>Online support 24/24</p>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <!-- team section -->
    <div class="team">
        <div class="title">
            <h1>Our Workable Team</h1>
            <span>best team</span>
        </div>
        <div class="row">
            <div class="box">
                <div class="img-box">
                    <img src="../hinh/profile.jpg" alt="">
                </div>
                <div class="detail">
                    <span>Finace Manager</span>
                    <h4>Miguel Rodrigez</h4>
                    <div class="social-link">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="../hinh/profile1.jpg" alt="">
                </div>
                <div class="detail">
                    <span>Finace Manager</span>
                    <h4>Miguel Rodrigez</h4>
                    <div class="social-link">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="../hinh/profile2.jpg" alt="">
                </div>
                <div class="detail">
                    <span>Finace Manager</span>
                    <h4>Miguel Rodrigez</h4>
                    <div class="social-link">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="../hinh/profile3.jpg" alt="">
                </div>
                <div class="detail">
                    <span>Finace Manager</span>
                    <h4>Miguel Rodrigez</h4>
                    <div class="social-link">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="project">
        <div class="title">
            <h1>Our Best Project</h1>
            <span>how it works</span>
            <div class="row">
                <div class="box">
                    <img src="../hinh/doi_tac_1.jpg" alt="">
                </div>
                <div class="box">
                    <img src="../hinh/doi_tac_2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="ideas">
        <div class="title">
            <h1>Lorem ipsum dolor sit amet.</h1>
            <span>Our features</span>
        </div>
        <div class="row">
            <div class="box">
                <i class="bi bi-stack"></i>
                <div class="detail">
                    <h2>What We Realy Do</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo quasi ve
                        ro debitis rerum iste animi error cum aperiam ducimus at.</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-grid-1x2-fill"></i>
                <div class="detail">
                    <h2>History of Beginning</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo quasi ve
                        ro debitis rerum iste animi error cum aperiam ducimus at.</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-tropical-storm"></i>
                <div class="detail">
                    <h2>Our Vision</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo quasi ve
                        ro debitis rerum iste animi error cum aperiam ducimus at.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <?php include '../user/user_footer.php'; ?>
    <!-- slick slider link -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>
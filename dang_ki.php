<?php
include_once './config/config.php';

if (isset($_POST['submit-btn'])) {
    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);

    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, $filter_password);

    $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
    $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);


    $select_user = mysqli_query($conn, "SELECT*FROM `users` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_user) > 0) {
        $message[] = 'User already exists';
    } else {
        if ($name == '' || $email == '' | $password == '' || $cpassword == '') {
            $message[] = 'Information cannot be left blank';
        } else if ($password != $cpassword) {
            $message[] = 'Wrong password';
        } else {
            mysqli_query($conn, "INSERT INTO `users` (`name`,`email`,`password`) VALUES ('$name','$email','$password')") or die('query failed');
            $message[] = 'Registered sucessfully';
            header('location:dang_nhap.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="./admin/css/style.css"> -->
    <link rel="stylesheet" href="./shop/css/style.css">

    <title>Đăng kí</title>
</head>

<body>

    <section class="form-container">
        <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo
                '
              <div class="message">
               <span>
                 ' . $message . '
               </span>
               <i class="bx bx-x-circle" onclick="this.parentElement.remove()"></i>
              </div>
            ';
            }
        }
        ?>
        <form method="post" enctype="multipart/form-data">
            <h1>Đăng kí ngay</h1>
            <input type="text" name="name" placeholder="enter your name" require>
            <input type="email" name="email" placeholder="enter your email" require>
            <input type="password" name="password" placeholder="enter your password" require>
            <input type="password" name="cpassword" placeholder="confirm your password" require>
            <input type="submit" name="submit-btn" value="register now" class="btn">
            <p>Already have an account ? <a href="dang_nhap.php">Login now ?</a></p>
        </form>
    </section>
</body>

</html>
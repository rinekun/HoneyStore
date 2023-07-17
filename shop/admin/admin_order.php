<?php
 include_once '../config/config.php';
 session_start();
 $admin_id=$_SESSION['admin_name'];
 if(!isset($admin_id))
 {
    header('location:./dang_nhap.php');
 }
 if(isset($_POST['logout']))
 {
   session_destroy();
   header('location:./dang_nhap.php');
 }
 //delete product
 if(isset($_GET['delete']))
 {
   $delete_id=$_GET['delete'];
   mysqli_query($conn,"DELETE FROM `order` WHERE id='$delete_id'") or die ('query failed');
   $message[]='order removed successfully';
   header('location:admin_order.php');
 }
 if(isset($_POST['update_order']))
 {
    $order_id=$_POST['order_id'];
    $update_payment=$_POST['update_payment'];

    mysqli_query($conn,"UPDATE `order` SET payment_status='$update_payment' WHERE id='$order_id' ") or die ('query failed');
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>Bảng điều khiển admin</title>
</head>
<style>
.show-products,
.order-container
{
    position: relative;
    background: var(--orange);
    margin-top: -3.5rem;
}
.order-container
{
    padding: 3% 7%;
}
.order-container .box-container
{
    grid-template-columns: repeat(auto-fit,mixmax(20rem,1fr));
    justify-content: center;
    align-items: flex-start;
}
.box-container .box
{
    text-align: left;
    padding: 1rem 2rem;
}
.order-container .box-container .box p
{ 
  margin-bottom: .5rem;
  text-transform: capitalize;
  color: hotpink;
  padding: 10px;
}
.order-container .box span
{
    color: #555;
}
.order-container form
{
    text-align: center;
}
.order-container form select
{
    width: 100%;
    margin: 1rem auto;
    padding: .5rem 0;
    cursor: pointer;
    border-radius: 3px;
}
.order-container .box .delete
{
    width: 100%;
}
.order-container form input
{
 width: 40%;
 height: 35px;
 border-radius: unset;
 border: none;
 text-align: center;
 background: orange;
 color: #000;
 text-transform: capitalize;
}
.order-container form input:hover
{
  color: #fff;   
}
.box-container .box img
{
    width: 100%;
    height: 80%;
    margin-bottom: 1rem;
}
.box-container .box h4
{
   font-size: 20px;
   color: #FF0060;
}
.box-container .box p
{
   font-size: 20px;
   color: #0079FF;
}

select
{
   outline: none;
   border: 1px solid #55555544;
   background: transparent;
   width: 100%;
   padding: 1rem 1.5rem;
   border-radius: 10px;
   margin: 1rem 0;
}
.edit,
.delete
{
    color: black;
    font-weight: 700;
    background:orange;
    padding: .5rem 1.5rem;
    text-transform: capitalize;
    line-height:2;
}
.update-container
{
    position: fixed;
    top:0;
    left: 0;
    right:0;
    height: 100%;
    width: 100%;
    overflow-y: auto;
    background: var(--orange);
    z-index: 1100;
    padding: 2rem;
    align-items: center;
    justify-content: center;
    display: none;
}
.update-container form
{
    box-shadow: var(--box-shadow);
    width: 50%;
    background: #fff;
    padding: 1rem;
    margin: 2rem auto;
    text-align: center;
}

.update-container .edit,
.update-container .btn
{
  width: 40%;
  cursor: pointer;
}
.update-container form img
{
 width: 60%;
}
.order-container .title
{
  text-transform: uppercase;
  padding-top: 3rem;
}
</style>
<body>
  <?php
  include_once 'admin_header.php';
  ?>
  <?php
  if(isset($message))
     {
        foreach ($message as $message)
        {
            echo
            '
              <div class="message">
               <span>
                 '.$message.'
               </span>
               <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
              </div>
            ';
        }
     }
  ?>
  <div class="line2"></div>
  <div class="order-container">
   <h1 class="title">
      total order placed
   </h1>

   <div class="box-container">
     <?php
      $select_orders=mysqli_query($conn,"SELECT*FROM `order`") or die('query failed');
      if(mysqli_num_rows($select_orders)>0)
      {
         while($fetch_orders=mysqli_fetch_assoc($select_orders))
         {
    ?>
            <div class="box">
               <p>user name: <span><?php echo $fetch_orders['name']?></span></p>
               <p>user id: <span><?php echo $fetch_orders['user_id']?></span></p>
               <p>placed on : <span><?php echo $fetch_orders['place_on']?></span></p>
               <p>number : <span><?php echo $fetch_orders['number']; ?></span></p>
               <p>email : <span><?php echo $fetch_orders['email']; ?></span></p>
               <p>total price : <span><?php echo $fetch_orders['total_price']; ?></span></p>
               <p>method : <span><?php echo $fetch_orders['method']; ?></span></p>
               <p>address : <span><?php echo $fetch_orders['address']; ?></span></p>
               <p>total product : <span><?php echo $fetch_orders['total_product']; ?></span></p>
               <form method="post">
                 <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id'] ?>">
                 <select name="update_payment">
                    <option disabled selected><?php echo $fetch_orders['payment_status'] ?></option>
                    <option value="pending">Pending</option>
                    <option value="complete">Complete</option>
                 </select>
                 <input type="submit" name="update_order" value="update payment">
                 <a href="admin_order.php?delete=<?php echo $fetch_orders['id'];?>" onclick="return confirm('deleted this message')" class="delete">Delete</a>
               </form>
            </div>
   <?php   
         }
      }
      else
      {
          echo '<div class="empty">
                   <p> no order placed yet!</p>
                 </div>';
      }
     ?>
   </div>
  </div>
  <script src="../js/script.js"></script>
</body>
</html>
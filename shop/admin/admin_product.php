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
 //adding the products to database
 if(isset($_POST['add_product']))
 {
    $product_name=mysqli_real_escape_string($conn,$_POST['name']);
    $product_price=mysqli_real_escape_string($conn,$_POST['price']);
    $product_detail=mysqli_real_escape_string($conn,$_POST['detail']);
    $image=$_FILES['image']['name'];
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_folder='../hinh/'.$image;
   
   $select_product_name =  mysqli_query($conn,"SELECT name FROM `product` WHERE name='$product_name'") or die ('query failed');
   
   if(mysqli_num_rows($select_product_name)>0)
   {
      $message[]='product name already exists';
   }
   else
   {
      $insert_product= mysqli_query($conn,"INSERT INTO `product`(`name`,`price`,`product_detail`,`image`) 
      VALUES ('$product_name','$product_price','$product_detail','$image')") or die ('query failed');

      if($insert_product)
      {
         if($image_size >2000000)
         {
            $message[]='image size is too large';
         }
         else
         {
            move_uploaded_file($image_tmp_name,$image_folder);
            $message[]='product added succcessfully';
         }
      }
   }
 }
 //delete product
 if(isset($_GET['delete']))
 {
   $delete_id=$_GET['delete'];
   $select_delete_image=mysqli_query($conn,"SELECT image FROM `product` WHERE id='$delete_id'") or die ('query failed');
   $fetch_delete_image=mysqli_fetch_assoc($select_delete_image);
   unlink('../hinh/'.$fetch_delete_image['image']);

   mysqli_query($conn,"DELETE FROM `product` WHERE id='$delete_id'") or die ('query failed');
   mysqli_query($conn,"DELETE FROM `cart` WHERE pid='$delete_id'") or die ('query failed');
   mysqli_query($conn,"DELETE FROM `wishlist` WHERE pid='$delete_id'") or die ('query failed');

   header('location:admin_product.php');
 }

 //update product
 if(isset($_POST['update_product']))
 {
   $update_id=$_POST['update_id'];
   $update_name=$_POST['update_name'];
   $update_price=$_POST['update_price'];
   $update_detail=$_POST['update_detail'];
   $update_image=$_FILES['update_image']['name'];
   $update_image_tmp_name=$_FILES['update_image']['tmp_name'];
   $update_image_folder='../hinh/'.$update_image;

   $update_query=mysqli_query($conn,"UPDATE `product` SET `id`='$update_id', `name`='$update_name',`price`='$update_price',
                                             `product_detail`='$update_detail',`image`='$update_image' WHERE id='$update_id' ") 
                                              or die('query failed');
   if($update_query)
   {
      move_uploaded_file($update_image_tmp_name,$update_image_folder);
      {
         header('location:admin_product.php');
      }
   }                                
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
.show-products
{
    position: relative;
    background: var(--orange);
    margin-top: -3.5rem;
}
.show-products .box-container
{
    grid-template-columns: repeat(auto-fit,minmax(20rem,1fr));
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
.edit,
.delete
{
    color: #884A39;
    background:#F9E0BB;
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
  
  <section class="add-products form-container">
     <form method="post" action="" enctype="multipart/form-data">
        <div class="input-field">
           <label>product name</label>
           <input type="text" name="name" required>
        </div>

         <div class="input-field">
           <label>product price</label>
           <input type="text" name="price" required>
        </div>

         <div class="input-field">
           <label>product detail</label>
           <textarea name="detail" required></textarea>
        </div>

         <div class="input-field">
           <label>product image</label>
           <input type="file" name="image" required>
        </div>
        
        <input type="submit" name="add_product" value="add product" class="btn">
     </form>
  </section>

  <div class="line3"></div>

  <div class="line4"></div>
  
  <section class="show-products">
     <div class="box-container">
         <?php
          $select_products=mysqli_query($conn,"SELECT*FROM `product`") or die ('query failed');
          if(mysqli_num_rows($select_products)>0){
         while($fetch_products = mysqli_fetch_assoc($select_products)){ 
         ?>
         <div class="box">
           <img src="../hinh/<?php echo $fetch_products['image'];?>" alt="">
           <h4><?php echo $fetch_products['name'];?></h4>
           <p>price: $<?php echo $fetch_products['price']; ?></p>
           <details><?php echo $fetch_products['product_detail'];?></details>
           <a href="admin_product.php?edit=<?php echo $fetch_products['id']; ?>" class="edit">Edit</a>
           <a href="admin_product.php?delete=<?php echo $fetch_products['id']; ?>" class="delete" onclick="return confirm('want to delete this product')">
           Delete
           </a>
         </div>
         <?php
              }
         }
         else
         {
            echo '<div class="empty">
                   <p> no product added yet!</p>
                 </div>';
         }
         ?>
     </div>
  </section>

  <section class="update-container">
    <?php
    if(isset($_GET['edit']))
    {
      $edit_id=$_GET['edit'];
      $edit_query=mysqli_query($conn,"SELECT*FROM `product` WHERE id='$edit_id'") or die ('query failed');
        if(mysqli_num_rows($edit_query)>0)
        {
           while($fetch_edit = mysqli_fetch_assoc($edit_query))
           {
    ?>
               <form method="post" enctype="multipart/form-data">
                   <img src="../hinh/<?php echo $fetch_edit['image']; ?>" alt="">
                   <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                   <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?>">
                   <input type="number" name="update_price" min="0" value="<?php echo $fetch_edit['price']; ?>">
                   <textarea name="update_detail"><?php echo $fetch_edit['product_detail']; ?></textarea>
                   <input type="file" name="update_image" >
                   <input type="submit" name="update_product" value="update" class="edit">
                   <input type="reset" value="cancle" class="option-btn btn" id="close-form">
               </form>
    <?php
            }
        }
        echo "<script>document.querySelector('.update-container').style.display='block'</script>";
      }
    ?>
  </section>
  <script src="../js/script.js"></script>
</body>
</html>
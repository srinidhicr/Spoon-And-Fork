<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:index.php');
};

if(isset($_POST['delete'])){
   $faves_id = $_POST['faves_id'];
   $delete_faves_item = $conn->prepare("DELETE FROM `faves` WHERE id = ?");
   $delete_faves_item->execute([$faves_id]);
   $message[] = 'faves item deleted!';
}

if(isset($_POST['delete_all'])){
   $delete_faves_item = $conn->prepare("DELETE FROM `faves` WHERE user_id = ?");
   $delete_faves_item->execute([$user_id]);
   // header('location:faves.php');
   $message[] = 'deleted all from faves!';
}

if(isset($_POST['update_qty'])){
   $faves_id = $_POST['faves_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $update_qty = $conn->prepare("UPDATE `faves` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $faves_id]);
   $message[] = 'faves quantity updated';
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>faves</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Favourites</h3>
   <p><a href="index.php">home</a> <span> / favourites</span></p>
</div>

<!-- shopping faves section starts  -->

<section class="recipes">

   <h1 class="title">your faves</h1>

   <div class="box-container">

      <?php
         $grand_total = 0;
         $select_faves = $conn->prepare("SELECT * FROM `faves` WHERE user_id = ?");
         $select_faves->execute([$user_id]);
         if($select_faves->rowCount() > 0){
            while($fetch_faves = $select_faves->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="faves_id" value="<?= $fetch_faves['id']; ?>">
         <a href="quick_view.php?rid=<?= $fetch_faves['rid']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('delete this recipe?');"></button>
         <img src="uploaded_img/<?= $fetch_faves['image']; ?>" alt="">
         <div class="name"><?= $fetch_faves['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_faves['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_faves['quantity']; ?>" maxlength="2">
            <button type="submit" class="fas fa-edit" name="update_qty"></button>
         </div>
         <div class="sub-total"> sub total : <span>$<?= $sub_total = ($fetch_faves['price'] * $fetch_faves['quantity']); ?>/-</span> </div>
      </form>
      <?php
               $grand_total += $sub_total;
            }
         }else{
            echo '<p class="empty">you haven\'t picked any favourites!</p>';
         }
      ?>

   </div>


   <div class="more-btn">
      <form action="" method="post">
         <button type="submit" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" name="delete_all" onclick="return confirm('delete all from faves?');">delete all</button>
      </form>
      <a href="menu.php" class="btn">continue searching for delicacies!</a>
   </div>

</section>

<!-- shopping faves section ends -->










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
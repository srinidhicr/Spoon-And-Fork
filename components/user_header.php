<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="index.php" class="logo">S&F 🍽️.</a>

      <nav class="navbar">
         <a href="index.php">home</a>
         <a href="about.php">about</a>
         <a href="menu.php">recipes</a>
         <!--<a href="orders.php">favourites</a>-->
         <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
         <?php
            $count_faves_items = $conn->prepare("SELECT * FROM `faves` WHERE user_id = ?");
            $count_faves_items->execute([$user_id]);
            $total_faves_items = $count_faves_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="faves.php"><i class="fas fa-shopping-faves"></i><span>(<?= $total_faves_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn">profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         </div>
         <p class="account">
            <a href="login.php">login</a> or
            <a href="register.php">register</a>
         </p> 
         <?php
            }else{
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>


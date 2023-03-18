<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
};

if(isset($_POST['add_recipe'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $desc = $_POST['desc'];
   $desc = filter_var($desc, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $ingredqty = $_POST['ingredqty'];
   $ingredqty = filter_var($ingredqty, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $serves = $_POST['serves'];
   $serves = filter_var($serves, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $instr = $_POST['instr'];
   $instr = filter_var($instr, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_recipes = $conn->prepare("SELECT * FROM `recipes` WHERE recipeName = ?");
   $select_recipes->execute([$name]);

   if($select_recipes->rowCount() > 0){
      $message[] = 'recipe name already exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_recipe = $conn->prepare("INSERT INTO `recipes`(recipeName, recipeDesc, ingredQty, serves, recipeInstr, category, image) VALUES(?,?,?,?,?,?,?)");
         $insert_recipe->execute([$name, $desc, $ingredqty, $serves, $instr, $category, $image]);

         $message[] = 'new recipe added!';
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_recipe_image = $conn->prepare("SELECT * FROM `recipes` WHERE recipeID = ?");
   $delete_recipe_image->execute([$delete_id]);
   $fetch_delete_image = $delete_recipe_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_recipe = $conn->prepare("DELETE FROM `recipes` WHERE recipeID = ?");
   $delete_recipe->execute([$delete_id]);
   $delete_faves = $conn->prepare("DELETE FROM `faves` WHERE pid = ?");
   $delete_faves->execute([$delete_id]);
   header('location:recipes.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>recipes</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add recipes section starts  -->

<section class="add-recipes">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add recipe</h3>
      <input type="text" required placeholder="enter recipe name" name="name" maxlength="100" class="box"></textarea>
      <textarea type="text" required placeholder="enter recipe descriptions" name="desc" maxlength="10000000" class="box" style="height: 200px"></textarea>
      <textarea type="text" required placeholder="enter recipe ingredients and quantity" name="ingredqty" maxlength="10000000" class="box" style="height: 400px"></textarea>
      <input type="number" min="0" max="9999999999" required placeholder="enter recipe serves" name="serves" onkeypress="if(this.value.length == 10) return false;" class="box">
      <textarea type="text" required placeholder="enter recipe instructions" name="instr" maxlength="10000000" class="box" style="height: 500px"></textarea>
      <select name="category" class="box" required>
         <option value="" disabled selected>select category --</option>
         <option value="starters">starters</option>
         <option value="main dish">main dish</option>
         <option value="snacks">snacks</option>
         <option value="desserts">desserts</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="add recipe" name="add_recipe" class="btn">
   </form>

</section>

<!-- add recipes section ends -->

<!-- show recipes section starts  -->

<section class="show-recipes" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_recipes = $conn->prepare("SELECT * FROM `recipes`");
      $show_recipes->execute();
      if($show_recipes->rowCount() > 0){
         while($fetch_recipes = $show_recipes->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="../project_images/<?= $fetch_recipes['image']; ?>" alt="">
      <div class="flex">
         <div class="category"><?= $fetch_recipes['category']; ?></div>
      </div>
      <div class="recipeName"><?= $fetch_recipes['recipeName']; ?></div>
      <div class="flex-btn">
         <a href="update_recipe.php?update=<?= $fetch_recipes['recipeID']; ?>" class="option-btn">update</a>
         <a href="recipes.php?delete=<?= $fetch_recipes['recipeID']; ?>" class="delete-btn" onclick="return confirm('delete this recipe?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no recipes added yet!</p>';
      }
   ?>

   </div>

</section>

<!-- show recipes section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
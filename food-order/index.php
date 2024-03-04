<?php include("partials-front/menu.php"); ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL;?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset ($_SESSION['order']);
    }
?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php 
              if(isset($_SESSION["login"])){
                echo $_SESSION["login"];
                unset($_SESSION['login']);

              }
            ?>

        <?php 
        // Create SQL query to display categories from the database
        $sql = "SELECT * FROM tbl_category WHERE active ='Yes' AND featured='Yes' LIMIT 3";
        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether categories are available or not
        if(mysqli_num_rows($res) > 0) {
            // Categories available
            while($row = mysqli_fetch_assoc($res)) {
                // Get the values like title, image_name, and id
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                    <div class="box-3 float-container">
                        <?php 
                        // Check whether image is available or not
                        if($image_name == "") {
                            // Image not available
                            echo "<div class='error'>Image not Available.</div>";
                        } else {
                            // Image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            // Category not available
            echo "<div class='error'>No categories found.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php 
        // Getting food from the database that are active and featured
        $sql2 = "SELECT * FROM tbl_food WHERE active ='yes' AND featured='Yes' LIMIT 6";
        // Execute query
        $res2 = mysqli_query($conn, $sql2);

        // Check whether food available or not 
        if(mysqli_num_rows($res2) > 0) {
            // Food available
            while($row = mysqli_fetch_assoc($res2)) {
                // Get all values
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php 
                        // Check whether image available or not
                        if($image_name == "") {
                            // Image not available
                            echo "<div class='error'>Image Not available</div>";
                        } else {
                            // Image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">&#x20B5;<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br>
                        <a href="<?php echo SITEURL?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            // Food not available
            echo "<div class='error'>Food not Available.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("partials-front/footer.php"); ?>

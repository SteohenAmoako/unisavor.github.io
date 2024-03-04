<?php 
include("partials-front/menu.php"); 
?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
        // Check if search keyword is set and not empty
        if(isset($_POST['search']) && !empty(trim($_POST['search']))) {
            // Sanitize the input for display
            $search_display = htmlspecialchars(trim($_POST['search']), ENT_QUOTES, 'UTF-8');

            // Use prepared statements for database query
            $search_query = "%{$search_display}%";
        } else {
            $search_display = '';
            echo "<div class='error'> Please enter a search keyword</div>";
        }
        ?>
        
        <h2>Foods on <a href="#" class="text-white"><?php echo $search_display; ?></a></h2>

    </div>
</section>
<!-- FOOD SEARCH Section Ends Here -->

<!-- FOOD MENU Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        if(!empty($search_display)) {
            // Prepared statement for SQL query
            $sql = "SELECT * FROM tbl_food WHERE title LIKE ? OR description LIKE ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $search_query, $search_query);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            // Count rows
            $count = mysqli_num_rows($res);

            // Check whether food available or not
            if($count > 0) {
                // Food available
                while($row = mysqli_fetch_assoc($res)) {
                    // Get the details
                    $id = $row['id'];
                    $title = htmlspecialchars($row['title']);
                    $price = htmlspecialchars($row['price']);
                    $description = htmlspecialchars($row['description']);
                    $image_name = htmlspecialchars($row['image_name']);
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            // Check whether image name is available or not
                            if($image_name == "") {
                                // Image not available
                                echo "<div class='error'> Image not Available</div>";
                            } else {
                                // Image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">&#x20B5;<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // Food not available
                echo "<div class='error'> Food not Found</div>";
            }
        }

        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- FOOD Menu Section Ends Here -->

<?php include("partials-front/footer.php"); ?>
 
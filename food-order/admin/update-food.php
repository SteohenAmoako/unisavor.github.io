<?php include('partials/menu.php'); ?>

<?php
    // Check if ID is set
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        // SQL query to get selected food
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        // Execute the query
        $res2 = mysqli_query($conn, $sql2);

        // Check if query executed successfully
        if($res2) {
            $row = mysqli_fetch_assoc($res2);

            // Get the individual values of selected food
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $current_image = $row['image_name'];
            $current_category = $row['category_id'];
            $featured = $row['featured'];
            $active = $row['active'];
        } else {
            // Redirect to manage food page if food not found
            $_SESSION['no-food-found'] = "<div class='error'>Food not found.</div>";
            header('location: '.SITEURL.'admin/manage-food.php');
            exit(); // Terminate script execution after redirection
        }
    } else {
        // Redirect to manage food page if ID is not set
        header('location: '.SITEURL.'admin/manage-food.php');
        exit(); // Terminate script execution after redirection
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="22" rows="2"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "") {
                                echo "<img src='".SITEURL."images/food/".$current_image."' width='150px'>";
                            } else {
                                echo "<div class='error'>Image not available.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                $sql ="SELECT * FROM tbl_category WHERE active ='Yes'";
                                $res = mysqli_query($conn,$sql);

                                if(mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)){
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        echo "<option value='$category_id'";
                                        if($current_category == $category_id) { echo " selected"; }
                                        echo ">$category_title</option>";
                                    }
                                } else {
                                    echo "<option value='0'>Category Not Available</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if($featured == "Yes"){echo "checked";} ?>> Yes
                        <input type="radio" name="featured" value="No" <?php if($featured == "No"){echo "checked";} ?>> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if($active == "Yes"){echo "checked";} ?>> Yes
                        <input type="radio" name="active" value="No" <?php if($active == "No"){echo "checked";} ?>> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])) {
                // Process form submission
                // Retrieve form data
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $status = $_POST['status'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // Check if new image is selected
                if(isset($_FILES['image']['name'])) {
                    // Upload new image
                    $image_name = $_FILES['image']['name'];
                
                    // Check if image name is not empty
                    if($image_name != "") {
                        // Get the file extension
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                
                        // Generate a unique name for the image
                        $image_name = "Food-Name-" . rand(0000,9999) . "." . $ext;
                
                        // Get the source path and destination path
                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/food/" . $image_name;
                
                        // Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);
                
                        // Check if image upload was successful
                        if($upload == false) {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                            header('location: '.SITEURL.'admin/manage-food.php');
                            exit(); // Terminate script execution after redirection
                        }
                
                        // If a current image exists, remove it
                        if($current_image != "") {
                            $remove_path = "../images/food/" . $current_image;
                            $remove = unlink($remove_path);
                
                            // Check if the current image was removed successfully
                            if($remove == false) {
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                                header('location: '.SITEURL.'admin/manage-food.php');
                                exit(); // Terminate script execution after redirection
                            }
                        }
                    }
                    else{
                        // 
                        $image_name = $current_image; // default image when image is not selected
                    }
                } else {
                    // Use current image
                    $image_name = $current_image; //default image when button isnt clicked
                }

                // Update food in database
                $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = '$price',
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
                ";
                
                // Execute query
                $res3 = mysqli_query($conn,$sql3);

                // Check whether the query is executed or not
                if($res3==true){
                    // Food updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location: '.SITEURL.'admin/manage-food.php');
                    exit();
                } else {
                    // Failed to update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location: '.SITEURL.'admin/manage-food.php');
                    exit();
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>

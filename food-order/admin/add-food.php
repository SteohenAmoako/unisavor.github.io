<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl--30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="title of the Food" id="">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description"  cols="22" rows="2" placeholder="description of the Food" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" >
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" >
                            <?php
                                // create php code to display
                                // 1 create sql queries to get all active category from database
                                $sql ="SELECT * FROM tbl_category WHERE active= 'Yes'";

                                // ececuting queries
                                $res = mysqli_query($conn,$sql);

                                // count rows to check whether we have catefories or not
                                $count = mysqli_num_rows($res);

                                // if count is greater then zero, we have categories else we dont
                                if($count >0){
                                    // we have categories
                                    while($row = mysqli_fetch_assoc($res)){
                                        // get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>

                                        <option value="<?php echo $id;?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else{
                                    // we do not have catefories
                                    ?>
                                    <option value="0">No Cate</option>
                                    <?php
                                    
                                  
                                }

                                // 2 display on droppdown
                            
                            ?>
                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" >
                        <input type="radio" name="featured" value="No" >
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes" >
                        <input type="radio" name="active" value="No" >
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary" >
                    </td>
                </tr>


            </table>
        </form>
        <?php
            // Check whether the submit button is clicked
            if(isset($_POST['submit'])){
                // Sanitize form inputs
                $title = mysqli_real_escape_string($conn, trim($_POST['title']));
                $description = mysqli_real_escape_string($conn, trim($_POST['description']));
                $price = mysqli_real_escape_string($conn, trim($_POST['price']));
                $category = mysqli_real_escape_string($conn, trim($_POST['category']));
                $featured = isset($_POST['featured']) ? mysqli_real_escape_string($conn, $_POST['featured']) : "No";
                $active = isset($_POST['active']) ? mysqli_real_escape_string($conn, $_POST['active']) : "No";

                $image_name = ""; // Default to empty if no image is selected

                // Process the uploaded file if it exists
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
                    $image_name = $_FILES['image']['name'];
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $new_image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext; // New image name
                    
                    // Specify the upload directory
                    $upload_dir = "../images/food/";
                    $upload_file = $upload_dir . $new_image_name;

                    // Attempt to move the uploaded file to the target directory
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)){
                        // File uploaded successfully
                        $image_name = $new_image_name; // Only change if upload is successful
                    } else {
                        // Failed to upload the file
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location: '.SITEURL.'admin/add-food.php');
                        die(); // Stop the script
                    }
                }

                // Prepare an SQL query to insert the food item
                $sql = "INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active) VALUES (?, ?, ?, ?, ?, ?, ?)";
                
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssdssss", $title, $description, $price, $image_name, $category, $featured, $active);

                // Execute the prepared statement
                $result = mysqli_stmt_execute($stmt);

                if($result){
                    $_SESSION['add'] = "<div class='success'>Food Successfully Added.</div>";
                    header('location: '.SITEURL.'admin/manage-food.php');
                } else {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location: '.SITEURL.'admin/add-food.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
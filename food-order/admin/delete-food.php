<?php
    include('../config/constants.php');

    // Check if both id and image_name are set
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available
        if($image_name != ""){
            $path = "../images/food/".$image_name;

            // Remove the image
            $remove = unlink($path);
            if(!$remove){
                // Set session message for error
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Food</div>";
                // Redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
                exit(); // Terminate script execution after redirection
            }
        }

        // Sanitize input data to prevent SQL injection
        $id = mysqli_real_escape_string($conn, $id);

        // Delete data from database
        $sql = "DELETE FROM tbl_food WHERE id = $id";
        $res = mysqli_query($conn, $sql);

        if($res){
            // Set session message for success
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
            // Redirect to manage food page
            header('location:' . SITEURL . 'admin/manage-food.php');
            exit(); // Terminate script execution after redirection
        } else {
            // Set session message for error
            $_SESSION['error'] = "<div class='error'>Failed to Delete Food</div>";
            // Redirect to manage food page
            header('location:' . SITEURL . 'admin/manage-food.php');
            exit(); // Terminate script execution after redirection
        }
    } else {
        // Redirect to Manage Food if id or image_name is not set
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit(); // Terminate script execution after redirection
    }
?>

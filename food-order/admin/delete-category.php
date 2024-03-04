<?php
    include('../config/constants.php');

    // Check if both id and image_name are set
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available
        if($image_name != ""){
            $path = "../images/category/".$image_name;

            // Remove the image
            $remove = unlink($path);
            if(!$remove){
                // Set session message for error
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category</div>";
                // Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                exit(); // Terminate script execution after redirection
            }
        }

        // Sanitize input data to prevent SQL injection
        $id = mysqli_real_escape_string($conn, $id);

        // Delete data from database
        $sql = "DELETE FROM tbl_category WHERE id = $id";
        $res = mysqli_query($conn, $sql);

        if($res){
            // Set session message for success
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            // Redirect to manage category page
            header('location:' . SITEURL . 'admin/manage-category.php');
            exit(); // Terminate script execution after redirection
        } else {
            // Set session message for error
            $_SESSION['error'] = "<div class='error'>Failed to Delete Category</div>";
            // Redirect to manage category page
            header('location:' . SITEURL . 'admin/manage-category.php');
            exit(); // Terminate script execution after redirection
        }
    } else {
        // Redirect to Manage Category if id or image_name is not set
        header('location:' . SITEURL . 'admin/manage-category.php');
        exit(); // Terminate script execution after redirection
    }

    // // include constants file
    // include('../config/constants.php');


    // // echo "delete page"
    // // check whether the id and image_name value is set as not 
    // if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //     // Get the value and delete
    //     // echo "GET VALUE AND DELETE";
    //     $id = $_GET['id'];
    //     $image_name = $_GET['image_name'];

    //     // remove the physical image file if available
    //     if($image_name != ""){

    //         // image is available so remove it
    //         $path = "../images/category/".$image_name;

    //         // remove the image
    //         $remove = unlink($path);

    //         if($remove == false){
    //             // set the session message 
    //             $_SESSION['remove'] = "<div class = 'error'>Failed to Remove Category</div>";
    //             // redirect to manage category page
    //             header('location:'.SITEURL.'admin/manage-category.php');
    //             // stop the process
    //             die();
    //         }
    //     }

    //     // delete data from database
    //     $sql = "DELETE FROM tbl_category WHERE id = $id";

    //     // execute the query
    //     $res = mysqli_query($conn, $sql);



    //     // redirect to manage catefory page with message
    // }else{
    //     //redirect to Manage Category
    //     header('location:' .SITEURL.'admin/manage-category.php');
    // }

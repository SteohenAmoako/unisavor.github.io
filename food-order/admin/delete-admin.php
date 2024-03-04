<?php

    //include constant.php file here
    include('../config/constants.php');

    //1. get the id of the admin to be deleted
    echo $id = $_GET['id'];



    //2. create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";
    
    // execute the query
    $res = mysqli_query($conn, $sql);

    // check whether the query executed succ or not
    if($res == true){
        //query executed successfully and admin deleted
        //echo "admin deleted";
        // create sys variable to display message
        $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfully.</div>";

        //redirrect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        // fale to delete admin
       // echo "delete admin";
       $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again.</div>";
       header('location:'.SITEURL.'admin/manage-admin.php');

    }
    //3. redirect to manage admin page with message (success/error)



?>
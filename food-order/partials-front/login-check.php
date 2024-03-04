<?php 
    // AUTHORIZATION - ACCESS CONTROL
    // CHECK WHETHER THE USER IS IN OR NOT
    if(!isset($_SESSION['user'])) // if user session is not set
    {
        // user is not logged in
        // redirect to login with message
        $_SESSION['no-login-message'] = "<div class='error text-center'> Please login to access Admin Panel.</div>";
        header('location:'.SITEURL.'login.php');
        

    }
?>
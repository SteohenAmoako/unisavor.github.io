
<?php 
    include('../config/constants.php'); 
    include('login-check.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<style>
    /* Base styles */
body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.wrapper {
    max-width: 1200px;
    margin: auto;
    padding: 15px;
}

.main-content {
    text-align: center;
}

.col-4 {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
    float: left;
}

/* Clearfix to clear the floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Responsive styles */
@media (min-width: 768px) {
    .col-4 {
        width: 25%; /* Make four columns in a row on larger screens */
    }
}

@media (max-width: 767px) {
    .wrapper {
        padding: 5px;
    }
}

</style>

<body>
    <!-- Menu Section Start-->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">logout</a></li>

            </ul>
        </div>
    </div>
    
    <!-- Menu Section End-->
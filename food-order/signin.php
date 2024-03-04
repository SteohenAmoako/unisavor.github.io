<?php include( "config/constants.php");?>
<?php
// Include database connection code
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file here

    // Get the username and password from the form submission
    $username = mysqli_real_escape_string($conn, $_POST["signin-username"]);
    $password = mysqli_real_escape_string($conn, $_POST["signin-password"]);
    $hashed_password = $password; // Consider using password_hash() in real applications

    // SQL to check whether the user with username and password exists or not
    // Use prepared statements to prevent SQL Injection
    $sql = "SELECT * FROM tbl_users WHERE username=? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    // Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);     
    if ($count == 1) {
        // User available and signin successful
        $_SESSION['signin-btn'] = "<div class='success'>signin Successful.</div>";
        $_SESSION['user'] = htmlspecialchars($username); // Escape output to prevent XSS

        // Redirect to home page
        header('location:' . SITEURL . 'index.php');
        exit(); // Exit to prevent further execution
    } else {
        // User not available and signin failed
        $_SESSION['signin-btn'] = "<div class='error text-center'>Username or Password did not match.</div>";

        // Redirect to signin page
        header('location:' . SITEURL . 'signin.php');
        exit(); // Exit to prevent further execution
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign In</title>
    <style>
        /* Add your existing styles here */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f7f7f7; /* Adjust background color as needed */
        }

        .container {
            display: flex;
            max-width: 900px; /* Adjust width as needed */
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Adjust box-shadow as needed */
        }

        .left-container {
            background: #17a2b8; /* Adjust background color to match your design */
            padding: 30px;
            color: #fff;
            flex-basis: 40%; /* Adjust size as needed */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .right-container {
            padding: 30px;
            flex-basis: 60%; /* Adjust size as needed */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="fullname"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn {
            background: #dc3545; /* Adjust button background color to match your design */
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-container">
        <img src="images/logo.png" alt="" style="width: 100px; border: 2px solid black; border-radius: 5px;">
            <h3 style="text-align: center;" >If you dont have an account, Sign Up.</h3>
            
            <button class="btn"><a href="signup.php" style="color:white;  text-decoration: none;
 ">Sign Up</a></button>
        </div>
        <div class="right-container"><br><br><br><br><br>
            <h2>Sign In to Your Account</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="signin-username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="signin-password" required>
                </div>
                <button type="submit" class="btn" name="signin-btn">Sign In</button>
                <br><br><br> <br><br> <br>
            </form>
        </div>
    </div>
</body>
</html>

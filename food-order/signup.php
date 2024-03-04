<?php include( "config/constants.php");?>
<?php
// Include database connection code

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup-btn'])) {
    // Retrieve form data
    $fullname = ($_POST['signup-fullname']);
    $username = ($_POST['signup-username']);
    $email = ($_POST['signup-email']);
    $password = ($_POST['signup-password']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert user data
    $stmt = $conn->prepare("INSERT INTO tbl_users (fullname, username, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $username, $email, $hashed_password);
    if ($stmt->execute()) {
        // display logged in success message 
        $_SESSION['message'] = "<div class='success'>User Added Successfully.</div>";
        header("location:". SITEURL. 'signin.php');
    } 
    // if user already exist using else if user
    else if ($stmt->errno == 1062) {
        $_SESSION['message'] = "<div class='error'>User Already Exist.</div>";
        header("location:". SITEURL. 'signin.php');
    }
    else {
        $_SESSION['message'] = "<div class='error'>Failed to Add User.</div>";
        header("location:". SITEURL. 'signup.php');
    }
    
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
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

            <h3 style="text-align: center;">If you already have an account, just sign in.</h3>
            <button class="btn"><a href="signin.php" style="color:white;  text-decoration: none;
 ">Sign In</a></button>
        </div>
        <div class="right-container"><br><br>
            <h2>Sign In to Your Account</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Fullname</label>
                    <input type="text" id="fullname" name="signup-fullname" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="signup-username" required>
                </div>
                <div class="form-group">
                    <label for="username">email</label>
                    <input type="email" id="email" name="signup-email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="signup-password" required>
                </div>
                <button type="submit" class="btn" name="signup-btn">Sign Up</button>
            </form>
        </div>
    </div>
</body>
</html>

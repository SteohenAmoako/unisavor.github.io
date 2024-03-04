<!-- <?php 

// // Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Include your database connection file here
//     include('../config/constants.php');

//     // Get the username and password from the form submission
//     $username = mysqli_real_escape_string($conn, $_POST["username"]);
//     $password = mysqli_real_escape_string($conn, $_POST["password"]);
//     $hashed_password = md5($password); // Consider using password_hash() in real applications

//     // SQL to check whether the user with username and password exists or not
//     // Use prepared statements to prevent SQL Injection
//     $sql = "SELECT * FROM tbl_admin WHERE username=? AND password = ?";
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
//     mysqli_stmt_execute($stmt);
//     $res = mysqli_stmt_get_result($stmt);

//     // Count rows to check whether the user exists or not
//     $count = mysqli_num_rows($res);     
//     if ($count == 1) {
//         // User available and login successful
//         $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
//         $_SESSION['user'] = htmlspecialchars($username); // Escape output to prevent XSS

//         // Redirect to home page
//         header('location:' . SITEURL . 'admin/index.php');
//         exit(); // Exit to prevent further execution
//     } else {
//         // User not available and login failed
//         $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";

//         // Redirect to login page
//         header('location:' . SITEURL . 'login.php');
//         exit(); // Exit to prevent further execution
//     }
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signin.css">
    <title>Document</title>
    <style>
        *{
    margin: 0 0;
    padding: 0 0;
    font-family: Arial, Helvetica, sans-serif;
}
.container{
    width: 80%;
    margin: 0 auto;
    padding: 1%;
}
.img-responsive{
    width: 100%;
}
.img-curve{
    border-radius: 15px;
}

.text-right{
    text-align: right;
}
.text-center{
    text-align: center;
}
.text-left{
    text-align: left;
}
.text-white{
    color: white;
}

.clearfix{
    clear: both;
    float: none;
}

a{
    color: #ff6b81;
    text-decoration: none;
}
a:hover{
    color: #ff4757;
}

.btn{
    padding: 1%;
    border: none;
    font-size: 1rem;
    border-radius: 5px;
}
.btn-primary{
    background-color: #ff6b81;
    color: white;
    cursor: pointer;
}
.btn-primary:hover{
    color: white;
    background-color: #ff4757;
}
h2{
    color: #2f3542;
    font-size: 2rem;
    margin-bottom: 2%;
}
h3{
    font-size: 1.5rem;
}
.float-container{
    position: relative;
}
.float-text{
    position: absolute;
    bottom: 50px;
    left: 40%;
}
fieldset{
    border: 1px solid white;
    margin: 5%;
    padding: 3%;
    border-radius: 5px;
}
.mx-auto {
  margin-left: auto;
  margin-right: auto;
}

.h-28 {
  height: 7rem; /* Assuming 1 rem = 4 pixels (standard Tailwind conversion) */
}

.w-auto {
  width: auto;
}


/* CSSS for navbar section */

.logo{
    width: 10%;
    float: left;
}
.menu{
    line-height: 60px;
}
.menu ul{
    list-style-type: none;
}

.menu ul li{
    display: inline;
    padding: 1%;
    font-weight: bold;
}


/* CSS for Food SEarch Section */

.food-search{
    background-image: url(../images/bg.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    padding: 7% 0;
}

.food-search input[type="search"]{
    width: 50%;
    padding: 1%;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
}


/* CSS for Categories */
.categories{
    padding: 4% 0;
}

.box-3{
    width: 28%;
    float: left;
    margin: 2%;
}


/* CSS for Food Menu */
.food-menu{
    background-color: #ececec;
    padding: 4% 0;
}
.food-menu-box{
    width: 43%;
    margin: 1%;
    padding: 2%;
    float: left;
    background-color: white;
    border-radius: 15px;
}

.food-menu-img{
    width: 20%;
    float: left;
}

.food-menu-desc{
    width: 70%;
    float: left;
    margin-left: 8%;
}

.food-price{
    font-size: 1.2rem;
    margin: 2% 0;
}
.food-detail{
    font-size: 1rem;
    color: #747d8c;
}


/* CSS for Social */
.social ul{
    list-style-type: none;
}
.social ul li{
    display: inline;
    padding: 1%;
}

/* for Order Section */
.order{
    width: 50%;
    margin: 0 auto;
}
.input-responsive{
    width: 96%;
    padding: 1%;
    margin-bottom: 3%;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
}
.order-label{
    margin-bottom: 1%; 
    font-weight: bold;
}



/* CSS for Mobile Size or Smaller Screen */

@media only screen and (max-width:768px){
    .logo{
        width: 80%;
        float: none;
        margin: 1% auto;
    }

    .menu ul{
        text-align: center;
    }

    .food-search input[type="search"]{
        width: 90%;
        padding: 2%;
        margin-bottom: 3%;
    }

    .btn{
        width: 91%;
        padding: 2%;
    }

    .food-search{
        padding: 10% 0;
    }

    .categories{
        padding: 20% 0;
    }
    h2{
        margin-bottom: 10%;
    }
    .box-3{
        width: 100%;
        margin: 4% auto;
    }

    .food-menu{
        padding: 20% 0;
    }

    .food-menu-box{
        width: 90%;
        padding: 5%;
        margin-bottom: 5%;
    }
    .social{
        padding: 5% 0;
    }
    .order{
        width: 100%;
    }
}

    </style>
</head>
<body>
    <div>
        <?php
            // if(isset($_SESSION['login'])){
            //     echo $_SESSION['login'];
            //     unset($_SESSION['login']);
            // }
            // if(isset($_SESSION['no-login-message'])){
            //     echo $_SESSION['no-login-message'];
            //     unset($_SESSION['no-login-message']);
            // }
        ?>

        <form class="space-y-6" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <br>
            <br>
            <div class="cont">
                <div class="form sign-in">
                    <h2>            <img class="mx-auto h-28 w-auto" src="../images/logo.png" alt="Your Company">
</h2>
                    <label id="username">
                        <span>Username</span>
                        <input type="text" name="username" autocomplete="username" required class="block w-full p-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </label>
                    <label>
                        <span>Password</span>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full p-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </label>
                    <p class="forgot-pass">Forgot password?</p>
                    <button type="submit" class="submit">Sign In</button>
                </div>
                <div class="sub-cont">
                    <div class="img">
                        <div class="img__text m--up">
                            <h3>Don't have an account? Please Sign up!</h3>
                        </div>
                        <div class="img__text m--in">
                            <h3>If you already have an account, just sign in.</h3>
                        </div>
                        <div class="img__btn">
                            <span class="m--up">Sign Up</span>
                            <span class="m--in">Sign In</span>
                        </div>
                    </div>
                    <div class="form sign-up">
                        <h2>Create your Account</h2>
                        <label>
                            <span>Name</span>
                            <input type="text" />
                        </label>
                        <label>
                            <span>username</span>
                            <input type="username" />
                        </label>
                        <label>
                            <span>Password</span>
                            <input type="password" />
                        </label>
                        <button type="submit" class="submit">Sign Up</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.querySelector('.img__btn').addEventListener('click', function() {
            document.querySelector('.cont').classList.toggle('s--signup');
        });
    </script>
</body>
</html>
 -->



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
        <img class="mx-auto h-28 w-auto" src="../images/logo.png" alt="" style="width: 100px; border: 2px solid black; border-radius: 5px;">
            <h3>If you already have an account, just sign in.</h3>
            <button class="btn"><a href="signup.php" style="color:white;  text-decoration: none;
 ">Sign Up</a></button>
        </div>
        <div class="right-container">
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
            </form>
        </div>
    </div>
</body>
</html>

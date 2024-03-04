<?php include('../config/constants.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1><br><br>
        <?php
            if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);

            }
        ?>
        <br>
        <!-- LOGIN FORM START HERE -->
        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username"  placeholder="Enter Username"><br><br>
            Password:   <br>
            <input type="password" name="password"  placeholder="Enter Password"> <br><br>
            <input type="submit" name="submit" value="login" class="btn-primary"><br><br>
        </form>
        <!-- LOGIN FORM ENDS HERE -->

        <p  class="text-center" >Created By - <a href="#">SteveTeck</a></p>
    </div>
</body>
</html>
<?php
    // CHECK WHETHER THE SUBMIT BUTTON IS CLICKED OR NOT
    if(isset($_POST["submit"]) ){
        // PROCESS FOR LOGIN
        // 1. GET THE DATA FROM LOGIN FORM
        $username = $_POST["username"];
        $password = md5($_POST["password"]);


        // 2. SQL TO CHECK WHETHER THE USER WITH USERNAME AND PASSWORD EXISTS OR NOT
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password = '$password'";

        // 3. EXECUTE THE QUERY
        $res = mysqli_query($conn, $sql);

        // 4. COUNT ROWS TO CHECK WHETHER THE USER EXISTS OR NOT
        $count = mysqli_num_rows($res);
        if($count == 1){
            // USER AVAILABLE AND LOGIN SUCCESS
            $_SESSION['login' ] = "<div class='success'>Login Successful.</div>" ;
            $_SESSION['user'] = $username; //TO CHECK WHETHER THE USER IS LOGGED IN OR NOT AND LOGOUT WILL UNSET IT


            //REDIREXCT TO HOME PAGE
            header('location:'.SITEURL.'admin/');
            
        }
        else{
            // USER NOT AVAILABLE AND LOGIN FAIL
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>" ;

            //REDIREXCT TO HOME PAGE
            header('location:'.SITEURL.'admin/login.php');
            

        }

    }

?>
<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br> <br>
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                // echo''.$id.'';
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Old Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php 
        // check if submit button is clicked or not
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);
        
            $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password = '$current_password'";
            $res = mysqli_query($conn, $sql);
        
            if ($res == true) {
                $count = mysqli_num_rows($res);
        
                if ($count == 1) {
                    // User exists and password can be changed
        
                    // Check whether the new password and current password do not match
                   // Check whether the new password and current password do not match
                    if ($new_password != $current_password) {
                        // Check whether the new password and confirm password match
                        if ($new_password == $confirm_password) {
                            // Use MD5 to hash the new password (not recommended for security reasons)
                            $hashed_password = $new_password;

                            // Update the password in the database
                            $sql2 = "UPDATE tbl_admin SET password = '$hashed_password' WHERE id = $id";
                            $res2 = mysqli_query($conn, $sql2);

                            if ($res2 == true) {
                                // Display success message
                                $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully.</div>";
                    } else {
                        // Display error message
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to change password.</div>";
                    }
                        } else {
                 // Redirect to manage admin page with error message
                        $_SESSION['pwd-not-match'] = "<div class='error'>New password and confirm password do not match.</div>";
             }
         } else {
                    // Redirect to manage admin page with error message
                    $_SESSION['pwd-not-match'] = "<div class='error'>New password should not match the old password.</div>";
                }

                } else {
                    // Redirect to manage admin page with error message
                    $_SESSION['pwd-not-match'] = "<div class='error'>Old password did not match.</div>";
                }
        
                // Redirect the user in all cases
                header("location:" . SITEURL . "admin/manage-admin.php");
            }
        }
        

?>



<?php include('partials/footer.php'); ?>

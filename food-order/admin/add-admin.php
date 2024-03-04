<?php 
include('partials/menu.php');    

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your full name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Your Username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
include('partials/footer.php'); 

if (isset($_POST['submit'])) {
    // Sanitize input data
    $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password']; // Get password directly since it will be hashed

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to prevent SQL injection
    $sql = $conn->prepare("INSERT INTO tbl_admin (full_name, username, password) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $full_name, $username, $hashed_password);

    if ($sql->execute()) {
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        // Log error to a file
        error_log("Failed to add admin: " . $sql->error);
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin. Please try again later.</div>";
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}
?>

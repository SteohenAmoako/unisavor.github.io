<?php 
include('partials/menu.php');
// Include database connection file here with mysqli_real_escape_string for security

?><div class="main-content">
<div class="wrapper">
    <h1>Update Admin</h1>
    <br><br>

    <?php
        // Get the ID of the selected admin
        $id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : ""; 

        if(empty($id)){
            header('Location:'.SITEURL.'admin/manage-admin.php');
            exit;
        }

        // SQL Query to Get the Details
        $sql = "SELECT * FROM tbl_admin WHERE id=?";
        $stmt = $conn->prepare($sql);
        if(!$stmt){
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        } else {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $res = $stmt->get_result();

            if($res->num_rows == 1){
                $row = $res->fetch_assoc();
                $full_name = htmlspecialchars($row['full_name']);
                $username = htmlspecialchars($row['username']);
            } else {
                header('Location:'.SITEURL.'admin/manage-admin.php');
                exit;
            }
        }
    ?>

    <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
            </tr>

            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form>
</div>
</div>

<?php
if(isset($_POST['submit'])){
$id = mysqli_real_escape_string($conn, $_POST['id']);
$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
$username = mysqli_real_escape_string($conn, $_POST['username']);

$sql = "UPDATE tbl_admin SET full_name=?, username=? WHERE id=?";
$stmt = $conn->prepare($sql);

if(!$stmt){
    $_SESSION['update'] = "<div class='error'>Prepare failed: (" . $conn->errno . ") " . $conn->error . "</div>";
} else {
    $stmt->bind_param("ssi", $full_name, $username, $id);
    if($stmt->execute()){
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
    }
}
header('Location:'.SITEURL.'admin/manage-admin.php');
exit;
}
?>

<?php include('partials/footer.php'); ?>
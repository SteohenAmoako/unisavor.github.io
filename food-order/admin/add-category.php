<?php
include('partials/menu.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1> <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>

        <!-- Add Category Form Start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" Name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <!-- Add Category Form End -->
        <?php
        if (isset($_POST['submit'])) {
            // Sanitize user input
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $featured = isset($_POST['featured']) ? mysqli_real_escape_string($conn, $_POST['featured']) : 'No';
            $active = isset($_POST['active']) ? mysqli_real_escape_string($conn, $_POST['active']) : 'No';

            $image_name = ""; // Default if no image
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                // Process the image
                $image_name = $_FILES['image']['name'];
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array($ext, $allowed)) {
                    // Rename the image
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    // Upload image
                    $upload = move_uploaded_file($source_path, $destination_path);
                    if (!$upload) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        $image_name = ""; // Ensure no name is set if upload fails
                    }
                } else {
                    $_SESSION['upload'] = "<div class='error'>Invalid File Type.</div>";
                }
            }

            // SQL Query
            $sql = "INSERT INTO tbl_category (title, image_name, featured, active) VALUES (?, ?, ?, ?)";

            // Prepared statement
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $title, $image_name, $featured, $active);

            // Execute and check
            $res = mysqli_stmt_execute($stmt);
            if ($res) {
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
            }

            header('location: ' . SITEURL . 'admin/manage-category.php');
            exit();
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>

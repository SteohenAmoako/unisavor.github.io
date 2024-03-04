<?php include("config/constants.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <?php if(isset($_SESSION['user'])): ?>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">Profile</a>
                        <div class="dropdown-content" id="dropdown-content">
                            <a href="<?php echo SITEURL; ?>profile-settings.php">Profile Settings</a>
                            <a href="<?php echo SITEURL; ?>logout.php">Logout</a>
                        </div>
                    </li>

                    <?php else: ?>
                        <li><a href="<?php echo SITEURL; ?>signin.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    // When the user clicks on the dropbtn...
    document.querySelector('.dropbtn').addEventListener('click', function() {
        // Toggle the dropdown content
        document.getElementById("dropdown-content").classList.toggle("show");
    });

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
});
</script>

<?php

// Destroy session data
include("../config/constants.php");
session_unset();
session_destroy();

// Delete session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Prevent caching
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Redirect to login page
header("Location: login.php");
exit();

    // // INCLUDE CONSTANTS.PHP FOR SITEURL
    // include("../config/constants.php");
    
    // // 1. DESTROY THE SESSION
    // // session_start(); // Start the session if not already started
    // session_unset(); // Unset all session variables
    // session_destroy(); // Destroy the session
    
    // // 2. DELETE SESSION COOKIE
    // if (ini_get("session.use_cookies")) {
    //     $params = session_get_cookie_params();
    //     setcookie(session_name(), '', time() - 42000,
    //         $params["path"], $params["domain"],
    //         $params["secure"], $params["httponly"]
    //     );
    // }
    
    // // 3. REDIRECT TO LOGIN PAGE
    // header('Location: ' . SITEURL . 'admin/login.php');
    // exit(); // Terminate script execution after redirection


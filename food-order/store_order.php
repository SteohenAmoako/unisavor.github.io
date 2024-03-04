
<?php
// Include database connection file and other necessary files
include("config/constants.php");

// Check if the request is coming from AJAX and the submit button was clicked
if(isset($_POST['submit'])) {
    // Retrieve the form data
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty; // Calculate the total
    $order_date = date("Y-m-d h:i:sa"); // Get the current date and time
    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled
    $customer_name = $_POST['full_name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];
    
    // SQL query to save the order in the database
    $sql = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare the SQL query
    $stmt = $conn->prepare($sql);
    
    // Check if the preparation was successful
    if (!$stmt) {
        // Error handling
        die('Prepare failed: (' . $conn->errno . ') ' . $conn->error);
    }
    
    // Bind the parameters
    $bind = $stmt->bind_param("ssssssssss", $food, $price, $qty, $total, $order_date, $status, $customer_name, $customer_contact, $customer_email, $customer_address);
    
    // Check if the parameters were bound successfully
    if (!$bind) {
        // Error handling
        die('Binding parameters failed: (' . $stmt->errno . ') ' . $stmt->error);
    }
    
    // Execute the query
    $result = $stmt->execute();
    
    // Check if the query executed successfully
    if($result) {
        // Data inserted successfully
        echo json_encode(['success' => true]);
    } else {
        // Error handling
        die('Execute failed: (' . $stmt->errno . ') ' . $stmt->error);
    }
}



// Include the menu file if required
// include('partials/menu.php');

// if (isset($_POST['button'])) {
//     // Sanitize and validate input data
//     $food = filter_input(INPUT_POST, 'food', FILTER_SANITIZE_STRING);
//     $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
//     $qty = filter_input(INPUT_POST, 'qty', FILTER_VALIDATE_INT);
//     $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
//     $contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
//     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
//     $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

//     // Validate if required fields are not empty
//     if (empty($food) || empty($price) || empty($qty) || empty($full_name) || empty($contact) || empty($email) || empty($address)) {
//         // Handle empty fields error
//         $_SESSION['message'] = "<div class='error'>Please fill in all required fields.</div>";
//         header("location:" . SITEURL . 'order.php');
//         exit(); // Terminate script execution
//     }

//     // Calculate total price
//     $total = $price * $qty;
//     $order_date = date("Y-m-d h:i:sa");
//     $status = "Ordered";

//     // Prepare SQL statement to prevent SQL injection
//     $sql = $conn->prepare("INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) 
//                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

//     // Bind parameters
//     $sql->bind_param("sidiisssss", $food, $price, $qty, $total, $order_date, $status, $full_name, $contact, $email, $address);

//     // Execute the query
//     if ($sql->execute()) {
//         $_SESSION['message'] = "<div class='success'>Order placed successfully.</div>";
//         header("location:" . SITEURL . 'order.php');
//     } else {
//         // Log error to a file
//         error_log("Failed to store order: " . $sql->error);
//         $_SESSION['message'] = "<div class='error'>Failed to place order. Please try again later.</div>";
//         header("location:" . SITEURL . 'order.php');
//     }
// } else {
//     // Redirect if form not submitted
//     header("location:" . SITEURL . 'order.php');
// }


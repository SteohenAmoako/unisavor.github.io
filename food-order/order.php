<?php 
include("partials-front/menu.php");

// Function to sanitize input data
function sanitizeInput($data) {
    // Remove leading/trailing whitespace
    $data = trim($data);
    // Convert special characters to HTML entities to prevent XSS
    $data = htmlspecialchars($data, ENT_QUOTES);
    return $data;
}

// Check whether food id is set and is a valid integer
$food_id = filter_input(INPUT_GET, 'food_id', FILTER_VALIDATE_INT);
if($food_id !== false) {
    // Prepare the SQL statement using a prepared statement to prevent SQL injection
    $sql = "SELECT * FROM tbl_food WHERE id=?";
    $stmt = $conn->prepare($sql);
    // Bind parameters to the prepared statement
    $stmt->bind_param("i", $food_id);
    // Execute the prepared statement
    $stmt->execute();
    // Get the result set
    $res = $stmt->get_result();

    // Check whether the data is available or not
    if($res->num_rows == 1){
        // We have data
        // Get data from the result set
        $row = $res->fetch_assoc();
        // Sanitize data to prevent XSS
        $title = sanitizeInput($row['title']);
        $price = sanitizeInput($row['price']);
        $image_name = sanitizeInput($row['image_name']);
    } else {
        // Food not available, redirect to home page
        header('location:'.SITEURL);
        exit(); // Terminate script execution
    }
} else {
    // Invalid food id, redirect to homepage
    header('location:'.SITEURL);
    exit(); // Terminate script execution
}
?>

<!-- fOOD SEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form id="orderForm" action="store_order.php" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if($image_name == ""){
                        // Image not available
                        echo "<div class='error'>Image not available.</div>";
                    }
                    else{
                        // Image available
                        ?>
                       <img src="<?php echo htmlspecialchars(SITEURL . 'images/food/' . $image_name); ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo htmlspecialchars($title); ?></h3>
                    <input type="hidden" name="food" value="<?php echo htmlspecialchars($title); ?>">
                    <p class="food-price">&#x20B5;<?php echo htmlspecialchars($price); ?></p>
                    <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                    
                </div>

            </fieldset>
            
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full_name" placeholder="E.g. Steve Teck" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 23343xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. group6@steveteck.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="button" id="paystackPaymentButton" value="Pay with Paystack" class="btn btn-primary">
                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary" hidden> <!-- Hide this button by default -->
            </fieldset>

        </form>
    </div>
</section>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
//     document.getElementById('paystackPaymentButton').onclick = function() {
//     // Get the price of the selected food
//     var price = document.querySelector('input[name="price"]').value;

//     // Convert the price to kobo (Paystack needs the amount in kobo)
//     var amountInKobo = price * 100;

//     var handler = PaystackPop.setup({
//         key: 'pk_test_1cb4c7e1e422c2c68c5296fc716c2c4e4464c47d', // Replace with your public key
//         email: document.querySelector('input[name="email"]').value,
//         amount: amountInKobo,
//         currency: "GHS", // Set the currency to Ghana cedis
//         ref: ''+Math.floor((Math.random() * 1000000000) + 1), // Generate a random reference number
//         callback: function(response) {
//             // Payment was successful, so now we can submit the form data to the server
//             alert('Payment successful. Reference: ' + response.reference);
            
//             // Prepare form data for submission
//             var formData = new FormData(document.getElementById('orderForm'));
//             formData.append('reference', response.reference); // Append the Paystack reference to the form data
            
//             // Send the form data to store_order.php via AJAX
//             fetch('store_order.php', {
//                 method: 'POST',
//                 body: formData
//             })
//             .then(response => response.json()) // Expecting a JSON response
//             .then(data => {
//                 // Handle response from server
//                 if(data.success) {
//                     // If the server responded with a success message
//                     window.location.href = "<?php echo SITEURL; ?>/order-success.php?ref=" + response.reference;
//                 } else {
//                     // If there was an error inserting the data into the database
//                     alert('Order could not be stored in the database.');
//                 }
//             })
//             .catch(error => {
//                 // Handle any errors that occurred during the fetch operation
//                 console.error('Error:', error);
//                 alert('An error occurred while storing your order details.');
//             });
//         },
//         onClose: function() {
//             alert('Transaction was not completed, window closed.');
//         }
//     });
//     handler.openIframe();
// }

document.getElementById('paystackPaymentButton').onclick = function() {
    // Get the price of the selected food
    var price = document.querySelector('input[name="price"]').value;

    // Convert the price to kobo (Paystack needs the amount in kobo)
    var amountInKobo = price * 100;

    var handler = PaystackPop.setup({
        key: 'pk_test_1cb4c7e1e422c2c68c5296fc716c2c4e4464c47d', // Replace with your public key
        // demo key pk_test_1cb4c7e1e422c2c68c5296fc716c2c4e4464c47d
        // live public key pk_live_200968e7924d430c5669848edc39b0a594fab15b
        email: document.querySelector('input[name="email"]').value,
        amount: amountInKobo,
        currency: "GHS", // Set the currency to Ghana cedis
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // Generate a random reference number
        callback: function(response) {
            // After payment is completed, submit the form
            alert('Payment successful. Reference: ' + response.reference);
            
            // Now, make an AJAX call to store the details in the database
            var formData = new FormData(document.getElementById('orderForm'));
            formData.append('submit', true); // Manually append the submit true value
            
            fetch('store_order.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                // Redirect to success page or display success message
                window.location.href = "<?php echo SITEURL; ?>/foods.php";
            })
            .catch(error => {
                console.error('Error:', error);
                // Display error message or handle error appropriately
                alert('An error occurred while processing your payment.');
            });
        },
        onClose: function() {
            alert('Payment window closed.');
        }
    });
    handler.openIframe();
}

</script>


<?php include("partials-front/footer.php"); ?>

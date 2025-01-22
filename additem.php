<?php

// Initialize variables
$item_name = "";
$item_price = "";

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'inventorymanagement');
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if (isset($_POST['add'])) {
    echo "connect"; // Debugging message

    // Sanitize and validate inputs
    $item_name = mysqli_real_escape_string($db, $_POST['product_name']);
    $item_price = mysqli_real_escape_string($db, $_POST['price']);
    $quant = mysqli_real_escape_string($db, $_POST['quant']);

    // Check if all fields are provided
    if (empty($item_name) || empty($item_price) || empty($quant)) {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        // Prepare and execute the query
        $query = "INSERT INTO product (product_name, price, quantity) 
                  VALUES ('$item_name', '$item_price', '$quant')";

        if (mysqli_query($db, $query)) {
            echo "<script>alert('Successfully stored');</script>";
        } else {
            // Debugging message for query failure
            echo "<script>alert('Error: " . mysqli_error($db) . "');</script>";
        }
    }

    // Include table.php to display updated data
    require('./table.php');
}
?>

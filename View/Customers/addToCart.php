<?php
require "../../Controller/Db_connection.php";

session_start();
$id=$_SESSION['id'];

if(isset($_POST['additemtocartwithbutton'])){
    $productId = $_POST['additemtocartwithbutton'];

    // Assuming $conn is your database connection
    $stmt = $conn->prepare("INSERT INTO cart (User_ID, Product_ID, Quantity) VALUES (?, ?, 1)");
    $stmt->bind_param("ii", $id, $productId);
    
    if ($stmt->execute()) {
        // Return a success message as a JSON response
        $response = array('success' => true, 'message' => 'Item added to cart');
        echo json_encode($response);
    } else {
        // Return an error message as a JSON response
        $response = array('success' => false, 'message' => 'Failed to add item to cart');
        echo json_encode($response);
    }
    exit(); // Stop further execution after handling the request
}


?>

<?php
include 'config.php';

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the user from the database
    $query = "DELETE FROM users WHERE id=$id";
    mysqli_query($conn, $query);

    header("Location: users info.php");
    exit();
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    $conn = new mysqli('localhost', 'root', '', 'login');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Update the password in the database
        $update_query = "UPDATE users SET password='$new_password' WHERE username='$username'";

        if ($conn->query($update_query) === TRUE) {
            echo "Password updated successfully.";
        } else {
            echo "Error updating password: " . $conn->error;
        }
        
    } else {
        echo "Username not found. Please try again.";
    }

    $conn->close();
}
?>

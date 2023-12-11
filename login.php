<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Your database connection configuration
    $host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'login';

    // Create a database connection
    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    // Check for connection errors
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $query = "SELECT id, password, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if a matching user was found
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $hashed_password, $role);
        $stmt->fetch();

        // Verify the password using a custom match function
        if (custom_match($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;

            // Redirect based on the user's role
            if ($role == 0) {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: student_dashboard.php');
            }
            exit();
        }
    }

    // If the code reaches this point, the login is invalid
    echo "Invalid credentials. Please try again.";

    // Close the database connection
    $conn->close();
}

/**
 * Custom match function to verify the password
 *
 * @param string $input_password
 * @param string $hashed_password
 * @return bool
 */
function custom_match($input_password, $hashed_password) {
    // Implement your own password comparison logic here
    return ($input_password == $hashed_password);
}
?>

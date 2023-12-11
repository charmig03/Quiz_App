<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sub_id = $_POST['sub_id'];
    $question_text = $_POST['question_text'];
    $option_1 = $_POST['option_1'];
    $option_2 = $_POST['option_2'];
    $option_3 = $_POST['option_3'];
    $option_4 = $_POST['option_4'];
    $correct_option = $_POST['correct_option'];

    $conn = new mysqli('localhost', 'root', '', 'login');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Ensure that the sub_id is an integer
    if (!filter_var($sub_id, FILTER_VALIDATE_INT)) {
        echo "Invalid sub_id. Please provide a valid subject ID.";
    } else {
        // The sub_id is valid; proceed with the question insertion
        $query = "INSERT INTO quiz_questions (sub_id, question_text, option_1, option_2, option_3, option_4, correct_option)
                  VALUES ('$sub_id', '$question_text', '$option_1', '$option_2', '$option_3', '$option_4', $correct_option)";

        if ($conn->query($query) === TRUE) {
            // Show a pop-up on successful question addition
            echo "<script>alert('Question added successfully.');</script>";
            // Redirect to the admin dashboard after showing the pop-up
            echo "<script>window.location.href = 'admin_dashboard.php';</script>";
        } else {
            echo "Error adding question: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }

        .result-container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            width: 70%;
        }

        h1 {
            color: #333;
        }

        p {
            color: #777;
        }

        .score {
            font-size: 24px;
            font-weight: bold;
            color: #0077cc;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h1>Quiz Result</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['sub_id']) && isset($_GET['answers'])) {
            $sub_id = intval($_GET['sub_id']); // Sanitize the input to an integer.
            $answers = json_decode($_GET['answers'], true);

            // Connect to the database
            $conn = new mysqli('localhost', 'root', '', 'login');
            if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
            }

            $score = 0; // Initialize the score

            foreach ($answers as $question_id => $selected_option) {
                $selected_option = intval($selected_option); // Sanitize the input to an integer.

                // Query the correct option for the question with $question_id
                $query = "SELECT correct_option FROM quiz_questions WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $question_id);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();

                    $correct_option = $row['correct_option'];

                    // Only count the question if the selected option matches the correct option
                    if ($selected_option === $correct_option) {
                        $score++;
                    }
                }
            }

            // Close the database connection
            $conn->close();

            // Display the score
            echo "<p>Your Score:</p>";
            echo "<p class='score'>$score</p>";
        } else {
            echo "Invalid request. Please submit the quiz form.";
        }
        ?>
        <a href="student_dashboard.php">Go Back to Quiz</a>
    </div>
</body>
</html>

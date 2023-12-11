<!DOCTYPE html>
<html>
<head>
    <title>Question Bank</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .question {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .question-text {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .option {
            margin-left: 20px;
        }
        .correct-answer {
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Question Bank</h1>
        <?php
        if (isset($_GET['sub_id'])) {
            $sub_id = intval($_GET['sub_id']); // Sanitize the input to an integer.
            $conn = new mysqli("localhost", "root", "", "login");

            $subject_query = "SELECT * FROM subjects WHERE sub_id = ?";
            $stmt = $conn->prepare($subject_query);

            if ($stmt) {
                $stmt->bind_param("i", $sub_id);

                if ($stmt->execute()) {
                    $subject_result = $stmt->get_result();

                    if ($subject_result->num_rows > 0) {
                        // Get questions for the selected subject
                        $questions_query = "SELECT * FROM quiz_questions WHERE sub_id = ?";
                        $stmt = $conn->prepare($questions_query);

                        if ($stmt) {
                            $stmt->bind_param("i", $sub_id);

                            if ($stmt->execute()) {
                                $questions_result = $stmt->get_result();

                                if ($questions_result->num_rows > 0) {
                                    // Display questions and highlight the correct answer
                                    while ($row = $questions_result->fetch_assoc()) {
                                        echo '<div class="question">';
                                        echo "<p class='question-text'>Question: " . $row['question_text'] . "</p>";
                                        echo '<div class="option">';
                                        echo "<p>Option 1: " . $row['option_1'] . "</p>";
                                        echo "<p>Option 2: " . $row['option_2'] . "</p>";
                                        echo "<p>Option 3: " . $row['option_3'] . "</p>";
                                        echo "<p>Option 4: " . $row['option_4'] . "</p>";
                                        echo "<p class='correct-answer'>Correct Answer: Option " . $row['correct_option'] . "</p>";
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo "No questions found for this subject.";
                                }
                            }
                        }
                    }
                }
            }

            $conn->close();
        } else {
            echo "Invalid sub_id parameter.";
        }
        ?>
    </div>
</body>
</html>

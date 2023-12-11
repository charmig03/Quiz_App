<?php
// Database connection
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'login';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Function to get the answer from cookies or set the default value
function getAnswer($questionId) {
    return isset($_COOKIE['answers'][$questionId]) ? $_COOKIE['answers'][$questionId] : '';
}

// Function to check if a question has been answered
function isAnswered($questionId) {
    return isset($_COOKIE['answers'][$questionId]);
}

// Function to get correct answers from the database
function getCorrectAnswers($sub_id) {
    global $conn;
    $query = "SELECT id, correct_option FROM quiz_questions WHERE sub_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt->bind_param("i", $sub_id);

    if (!$stmt->execute()) {
        die('Error executing statement: ' . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz</title>
    <!-- Your existing styles -->
    <style>

      /* Reset some default styles */
body, h1, p {
    margin: 0;
    padding: 0;
}

/* Global Styles */
body {
    background-image: url('./img/1.jpg');
    background-size: cover;
    background-position: center;
    background-color: #f2f2f2;
    height: 100vh;
    margin: 0;
    position: relative;
    font-family: Arial, sans-serif;
    color: #333;
}

h1 {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
    margin: 0;
    font-size: 24px;
}

/* Quiz Container Styles */
.quiz-container {
    width: 80%;
    margin: 0 auto;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 20px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    border-radius: 12px;
    transition: transform 0.3s ease-in-out;
}

/* .quiz-container:hover {
    transform: scale(1.02);
} */

/* Question Text Styles */
.question-text {
    font-weight: bold;
    margin-bottom: 20px;
    font-size: 18px;
}

/* Option Label Styles */
.option-label {
    display: block;
    margin: 10px 0;
    font-size: 16px;
}

/* Radio Input Styles */
input[type="radio"] {
    border: 1px solid #333;
    padding: 8px;
}

/* Button Container Styles */
.button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
}

.button-container input[type="submit"] {
    padding: 12px 24px;
    background-color: #3498db; /* Blue button color */
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s, transform 0.2s ease-in-out;
}

.button-container input[type="submit"]:hover {
    background-color: #2980b9; /* Darker blue on hover */
    transform: scale(1.05);
}

/* Question Options Container Styles */
.question-options {
    display: flex;
    flex-direction: column;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Question Navigation Styles */
#question-navigation {
    margin: 30px 0;
    text-align: center;
}

#question-navigation h3 {
    margin-bottom: 10px;
    color: #0288d1;
}

#question-navigation ul {
    background-color: #fff;
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 10px;
}

#question-navigation li {
    display: inline;
    margin: 0 10px;
}

#question-navigation a {
    text-decoration: none;
    padding: 8px 16px;
    border: 1px solid #333;
    border-radius: 4px;
    color: #333;
    font-size: 14px;
    transition: background-color 0.3s, color 0.3s;
}

#question-navigation a.current-question {
    background-color: #333;
    color: white;
}

#question-navigation a.unanswered-question {
    background-color: grey;
    color: white;
}

#question-navigation a.answered-question {
    background-color: green;
    color: white;
}

/* Responsive Styles (if needed) */
@media (max-width: 768px) {
    .quiz-container {
        width: 90%;
    }
}

    </style>
    <script>
    // Retrieve answers from local storage
    document.addEventListener('DOMContentLoaded', function() {
        var storedAnswers = localStorage.getItem('quizAnswers');
        if (storedAnswers) {
            storedAnswers = JSON.parse(storedAnswers);

            // Set the answers in the form
            Object.keys(storedAnswers).forEach(function(questionId) {
                var answerKey = 'question_' + questionId;
                var selectedAnswer = storedAnswers[questionId];
                var input = document.querySelector('input[name="' + answerKey + '"][value="' + selectedAnswer + '"]');
                if (input) {
                    input.checked = true;
                }
            });
        }
    });

    function goToQuestion(questionIndex) {
        // Save the clicked question and its answer in local storage
        var currentQuestionId = <?php echo $questions[$currentQuestion]['id']; ?>;
        var selectedAnswer = document.querySelector('input[name="question_' + currentQuestionId + '"]:checked');
        
        if (selectedAnswer) {
            saveAnswer(currentQuestionId, selectedAnswer.value);
        }

        document.getElementById('currentQuestion').value = questionIndex;
        document.querySelector('form').submit();
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Retrieve answers from cookies
        var storedAnswers = getCookies();
        if (storedAnswers) {
            storedAnswers = JSON.parse(storedAnswers);

            // Set the answers in the form
            Object.keys(storedAnswers).forEach(function (questionId) {
                var answerKey = 'question_' + questionId;
                var selectedAnswer = storedAnswers[questionId];
                var input = document.querySelector('input[name="' + answerKey + '"][value="' + selectedAnswer + '"]');
                if (input) {
                    input.checked = true;
                }

                // Update question navigation style
                updateQuestionNavigationStyle(questionId);
            });
        }
    });

    function saveAnswer(questionId, answer) {
        saveAnswerInCookies(questionId, answer);
        updateQuestionNavigationStyle(questionId);
    }

    function saveAnswerInCookies(questionId, answer) {
        var storedAnswers = getCookies() || '{}';
        storedAnswers = JSON.parse(storedAnswers);
        storedAnswers[questionId] = answer;
        document.cookie = 'quizAnswers=' + JSON.stringify(storedAnswers) + '; path=/';
    }

    function getCookies() {
        var name = 'quizAnswers=';
        var decodedCookie = decodeURIComponent(document.cookie);
        var cookieArray = decodedCookie.split(';');
        for (var i = 0; i < cookieArray.length; i++) {
            var cookie = cookieArray[i].trim();
            if (cookie.indexOf(name) === 0) {
                return cookie.substring(name.length, cookie.length);
            }
        }
        return null;
    }

    function updateQuestionNavigationStyle(questionId) {
        var linkElement = document.querySelector('#question-navigation a[data-question-id="' + questionId + '"]');
        if (linkElement) {
            linkElement.classList.remove('unanswered-question');
            linkElement.classList.add('answered-question');
        }
    }
</script>


</head>
<body>
    <div class="quiz-container">
        <h1>Student Dashboard</h1>
        <?php
        if (isset($_GET['sub_id'])) {
            $sub_id = intval($_GET['sub_id']);

            $subject_query = "SELECT * FROM subjects WHERE sub_id = ?";
            $stmt = $conn->prepare($subject_query);

            if (!$stmt) {
                die('Error preparing statement: ' . $conn->error);
            }

            $stmt->bind_param("i", $sub_id);

            if (!$stmt->execute()) {
                die('Error executing statement: ' . $stmt->error);
            }

            $subject_result = $stmt->get_result();

            if ($subject_result->num_rows > 0) {
                $query = "SELECT * FROM quiz_questions WHERE sub_id = ?";
                $stmt = $conn->prepare($query);

                if (!$stmt) {
                    die('Error preparing statement: ' . $conn->error);
                }

                $stmt->bind_param("i", $sub_id);

                if (!$stmt->execute()) {
                    die('Error executing statement: ' . $stmt->error);
                }

                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $questions = $result->fetch_all(MYSQLI_ASSOC);
                    $totalQuestions = count($questions);

                    if (isset($_POST['currentQuestion'])) {
                        $currentQuestion = $_POST['currentQuestion'];
                    } else {
                        $currentQuestion = 0;
                    }

                    if (isset($_POST['next'])) {
                        $currentQuestion++;
                    } elseif (isset($_POST['previous'])) {
                        $currentQuestion--;
                    }

                    // Fetch correct answers from the database
                    $correctAnswers = getCorrectAnswers($sub_id);

                    if (isset($_POST['submit'])) {
                        $answers = [];
                        $totalMarks = 0;

                        foreach ($questions as $question) {
                            $questionId = $question['id'];
                            $answerKey = "question_$questionId";
                            if (isset($_POST[$answerKey])) {
                                $userAnswer = $_POST[$answerKey];

                                // Check if the user's answer is correct
                                $correctAnswer = $correctAnswers[$questionId]['correct_option'];
                                if ($userAnswer == $correctAnswer) {
                                    $totalMarks++;
                                }

                                $answers[$questionId] = $userAnswer;
                            }
                        }

                        // Set cookie with a 7-day expiration
                        $jsonAnswers = json_encode($answers);
                        setcookie("answers", $jsonAnswers, time() + (7 * 24 * 60 * 60), "/");
                    }
                    ?>
                    <div id="question-navigation">
                        <ul>
                            <?php
                            for ($i = 0; $i < $totalQuestions; $i++) {
                                $questionNumber = $i + 1;
                                $linkClass = ($i === $currentQuestion) ? 'current-question' : '';

                                // Check if the question has been answered
                                $questionId = $questions[$i]['id'];
                                $answerKey = "question_$questionId";

                                if (isAnswered($questionId)) {
                                    $linkClass .= ' answered-question';
                                } else {
                                    $linkClass .= ' unanswered-question';
                                }

                                echo "<li><a href='#' class='$linkClass' onclick='goToQuestion($i)'>Question $questionNumber</a></li>";
                            }
                            ?>
                        </ul>
                    </div>

                    <form method="POST" action="take_quiz.php?sub_id=<?php echo $sub_id; ?>">
                        <input type="hidden" name="sub_id" value="<?php echo $sub_id; ?>">
                        <input type="hidden" name="currentQuestion" id="currentQuestion" value="<?php echo $currentQuestion; ?>">

                        <?php foreach ($questions as $question) : ?>
                            <input type="hidden" name="answers[<?php echo $question['id']; ?>]" value="<?php echo getAnswer($question['id']); ?>">
                        <?php endforeach; ?>

                        <div class="question-options">
                            <p class="question-text"><?php echo "Question " . ($currentQuestion + 1) . ": " . $questions[$currentQuestion]['question_text']; ?></p>
                            <!-- Modify the radio button part in the form -->
                            <div class="option-label">
                                <input type="radio" name="question_<?php echo $questions[$currentQuestion]['id']; ?>" value="1" <?php echo (getAnswer($questions[$currentQuestion]['id']) == '1') ? 'checked' : ''; ?>>
                                <label for="question_<?php echo $questions[$currentQuestion]['id']; ?>_1"><?php echo $questions[$currentQuestion]['option_1']; ?></label>
                            </div>
                            <div class="option-label">
                                <input type="radio" name="question_<?php echo $questions[$currentQuestion]['id']; ?>" value="2" <?php echo (getAnswer($questions[$currentQuestion]['id']) == '2') ? 'checked' : ''; ?>>
                                <label for="question_<?php echo $questions[$currentQuestion]['id']; ?>_2"><?php echo $questions[$currentQuestion]['option_2']; ?></label>
                            </div>
                            <div class="option-label">
                                <input type="radio" name="question_<?php echo $questions[$currentQuestion]['id']; ?>" value="3" <?php echo (getAnswer($questions[$currentQuestion]['id']) == '3') ? 'checked' : ''; ?>>
                                <label for="question_<?php echo $questions[$currentQuestion]['id']; ?>_3"><?php echo $questions[$currentQuestion]['option_3']; ?></label>
                            </div>
                            <div class="option-label">
                                <input type="radio" name="question_<?php echo $questions[$currentQuestion]['id']; ?>" value="4" <?php echo (getAnswer($questions[$currentQuestion]['id']) == '4') ? 'checked' : ''; ?>>
                                <label for="question_<?php echo $questions[$currentQuestion]['id']; ?>_4"><?php echo $questions[$currentQuestion]['option_4']; ?></label>
                            </div>
                        </div>
                        <div class="button-container">
                            <?php if ($currentQuestion > 0): ?>
                                <input type="submit" name="previous" value="Previous">
                            <?php endif; ?>
                            <?php if ($currentQuestion < $totalQuestions - 1): ?>
                                <input type="submit" name="next" value="Next">
                            <?php else: ?>
                                <input type="submit" name="submit" value="Submit Quiz">
                            <?php endif; ?>
                        </div>
                    </form>
                    <script>
                        function goToQuestion(questionIndex) {
                            document.getElementById('currentQuestion').value = questionIndex;
                            document.querySelector('form').submit();
                        }
                    </script>

                    <?php
                } else {
                    echo "No questions found for the specified sub_id.";
                }
            } else {
                echo "Invalid sub_id. Please provide a valid subject ID.";
            }
        } else {
            echo "Please provide a valid sub_id parameter in the URL.";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
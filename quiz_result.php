<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
</head>
<body>
    <h1>Quiz Result</h1>
    <?php
    if (isset($_GET['score'])) {
        $score = $_GET['score'];
        echo "Your score is: $score";
    } else {
        echo "No score available.";
    }
    ?>
</body>
</html>

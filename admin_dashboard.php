<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            background-image: url('./img/1.jpg');
            background-size: cover;
            background-position: center;
            background-color: #f2f2f2;
            height: 100vh;
            margin: 0;
        }

        h1 {
            background-color: black;
            color: white;
            text-align: center;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
        }

        form {
            max-width: 450px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Style for select elements */
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Add Quiz Question</h2>
    <form action="add_question.php" method="POST">
        <div>
            <label for="sub_id">Subject ID:</label>
            <select id="sub_id" name="sub_id" required>
                <option value="1">1 PHP</option>
                <option value="2">2 HTML</option>
                <option value="3">3 Python</option>
                <option value="4">4 JAVA</option>
                <option value="5">5 CSS</option>
            </select>
        </div>

        <div>
            <label for="question_text">Question:</label>
            <input type="text" id="question_text" name="question_text" required>
        </div>

        <div>
            <label for="option_1">Option 1:</label>
            <input type="text" id="option_1" name="option_1" required>
        </div>

        <div>
            <label for="option_2">Option 2:</label>
            <input type="text" id="option_2" name="option_2" required>
        </div>

        <div>
            <label for="option_3">Option 3:</label>
            <input type="text" id="option_3" name="option_3" required>
        </div>

        <div>
            <label for="option_4">Option 4:</label>
            <input type="text" id="option_4" name="option_4" required>
        </div>

        <div>
            <label for="correct_option">Correct Option (1-4):</label>
            <select id="correct_option" name="correct_option" required>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
            </select>
        </div> <!-- Fix the typo here -->

        <button type="submit">Add Question</button>
    </form>
</body>
</html>

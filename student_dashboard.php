<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="dashboard.css" type="text/css">
</head>
<body>
    <h1 style="background-color: black; color: white" align="center";>Student Dashboard</h1>

<br><br><br><br><br><br>
<link rel="stylesheet" href="dashboard.css" type="text/css">

<?php
    $conn = new mysqli("localhost","root","","login");

    $query="SELECT * from subjects";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
    ?>
    <div class="subject_format">
        <?php
            while ($row = $result->fetch_assoc()) 
            {  
    ?>
    <div class="container">
    <div class="card">
        <img src="img/<?php echo $row['img_icon'];?>" alt="Person" class="card__image">
        <p class="card__name"> <?php echo $row['subject_name']?></p>
        
        <!-- <div class="grid-child-posts">
               
        </div> -->
        <!-- <a href="./take_quiz.php?sub_id=$row['sub_id']" ><button class="btn draw-border">Start Quiz</button></a> -->
        <a href="./take_quiz.php?sub_id=<?php echo $row['sub_id']; ?>"><button class="btn draw-border">Start Quiz</button></a>
        <a href="./question_bank.php?sub_id=<?php echo $row['sub_id']; ?>"><button class="btn draw-border">Question Bank</button></a>

    </div>
    </div>

    <?php }
    } ?>
    </div>



    
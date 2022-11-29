<?php
session_start();
require_once "pdo.php";
$_SESSION['studentid'] = $_POST['studentid'];
$_SESSION['password'] = $_POST['password'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/courseSelect.css">
    <title>Course List</title>
</head>

<body>
    <h1 id="heading">List of the courses assigned</h1>
    <form action="exam.php" method="POST">
        <?php
        $querry = "select * from student_assignment where stud_id = :id";
        $check = $pdo->prepare($querry);
        $check->bindParam(':id', $_SESSION['studentid']);
        $check->execute();
        echo '<table border = "1">' . "\n";
        echo '<tr><td>Student ID</td>';
        echo '<td>Course ID</td>';
        echo '<td>Quiz Status</td></tr>';
        while ($row = $check->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>";
            echo ($row['stud_id']);
            echo ("</td><td>");
            echo ($row['course_id']);
            echo ("</td><td>");
            if ($row['exam_taken'] == "") {
                echo '<a href="exam.php?id=' .  ($row['course_id']) . '">'
                    . 'Take Exam</a>';
            } else {
                echo "Exam Already Taken";
                echo "<br>";
                echo '<a href="check_score.php?id=' .  ($row['course_id']) . '">'
                    . 'Check Score</a>';
            }
            echo ("</td></tr>\n");
        }
        ?>
    </form>
</body>

</html>
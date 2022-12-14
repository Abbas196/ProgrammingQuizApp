<?php
require_once('pdo.php');
session_start();
?>

<html>

<head>
    <title> Add Student </title>
</head>
<?php

if (isset($_POST['submit'])) {
    
    $question = $_POST['question'];
    $course_id =  $_POST['course_id'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_answer = $_POST['correct_answer'];
    
   
    if (isset($_POST['question'] ) && isset($_POST['correct_answer'] ))
       // && ($_POST['option1'] != "") && ($_POST['option2'] != "") && ($_POST['option3'] != "")&& ($_POST['option4'] != "")&& ($_POST['correct_answer'] != "")
    {
        insert_data($pdo, $course_id, $question, $option1, $option2, $option3, $option4, $correct_answer);
        if(isset($_SESSION['error'])) {
            echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])) {
             echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
             unset($_SESSION['success']);
        }
    } else echo "All fields should be entered!!";
}




function insert_data($pdo, $course_id, $question, $option1, $option2, $option3, $option4, $correct_answer )
{
    //echo "inserting new row";


    try {
        
        
           
        $insert_query = "INSERT INTO question_bank(course_id, question, option_1, option_2, option_3, option_4, answer) 
        VALUES (:course_id, :question, :option_1, :option_2, :option_3, :option_4, :answer)";
        $dbstmt1 = $pdo->prepare($insert_query);
        $dbstmt1->execute(array(
            ':course_id' => $course_id,
             ':question' => $question, 
             'option_1' => $option1, 
             ':option_2' => $option2, 
             ':option_3' => $option3, 
             ':option_4' => $option4,
              ':answer' => $correct_answer

        ));
        $_SESSION['success'] = 'Question Added in to the question bank';
    }
        
       
     catch (Exception $ex) {
        date_default_timezone_set("America/Chicago");
        
        $message = $ex->getMessage();
        createLog($message);
        $_SESSION['error'] = 'Error in Insertion';
        
        
    }
}


function createLog($data)
{
    $file = "log.txt";
    $fh = fopen($file, 'a') or die("can't open file");
    $date = date("Y-m-d");
    $time = date("h:i:sa");
    $error = "[" . $date . ":  " . $time . "]  " . $data . ".\n";
    fwrite($fh, $error);
    fclose($fh);
}



?>
<?php
if(isset($_SESSION['account']))
{   
   
  include 'side_nav.html'; 
    
    
    ?>
    <html>
        <head><link rel="stylesheet" href="./css/add_question.css"></head>
    
<body>
    <div>
    <form method="post" action="add_question.php" id="qb">
        <select name="course_id">
        <?php
            $sql = "Select course_id from batch";
            $stmt = $pdo->query($sql);
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           
                echo "<option value=$row[course_id]>$row[course_id]</option>"; 

            }

        ?>


        </select><br>
        
       
         
            <textarea name="question" id="question"   rows="15" cols="100"  placeholder = "Enter Question"></textarea><br>
 
            <input type="text" name="option1" id="option1"  placeholder = "option1" ><br>

            
            <input type="text" name="option2" id="option2"  placeholder = "option2"><br>

            
            <input type="text" name="option3" id="option3"  placeholder = "option3" ><br>

            <input type="text" name="option4" id="option4"  placeholder = "option4"><br>

            
            <input type="text" name="correct_answer" id="correct_answer"  placeholder = "correct_answer" ><br>

            <input type="submit" name="submit" id="submit" value="Add">
            
           

    </form>
        </div>
    <?php } else { ?>
<a href = 'admin_login.php' > <h1> Please Login </h1> </a>

<?php } ?>  
</body>
</html>
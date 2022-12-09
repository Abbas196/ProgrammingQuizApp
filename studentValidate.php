<?php
require_once "pdo.php";
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/studentLogin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Student Login</title>
</head>

<body>
    <div class="navbar navbar-dark bg-primary">
        <p class="studentLogin">Student Login Page</p>
    </div>
    <div id="studentForm">
        <form method="POST" action="Course_select.php">
            <label for="studentid">StudentID</label>
            <input type="text" id="studentid" name="studentid" class="loginInput"><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="loginInput"><br>
            <a href="passwordReset.php" style="float:inline-start;padding-right:20px">forgot password ?</a>
            <a href="admin_login.php">Admin ?</a>
            <br><br>
            <input type="submit" class="btn btn-primary" value="submit" id="submitButton" style="width:100px;">
        </form>
    </div>
    <script src="./JS_files/studentValidate.js"></script>
</body>

</html>
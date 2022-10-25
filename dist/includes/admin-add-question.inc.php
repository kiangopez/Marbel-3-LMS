<?php
include "../config/constants.php";

if (isset($_POST['submit'])){
    $quiz_id = $_POST['quiz_id'];
    $subj_id = $_POST['subj_id'];
    $question = $_POST['question'];
    $type = $_POST['question_type'];
    $answer = $_POST['answer'];
    $correct = $_POST['correct'];
    
    $ans1 = $_POST['ans1'];
    $ans2 = $_POST['ans2'];
    $ans3 = $_POST['ans3'];
    $ans4 = $_POST['ans4'];

    date_default_timezone_set('Asia/Manila');
    $date = date('d-m-y h:i:s');
    
    if ($type  == '2'){
        $sql = "INSERT INTO quiz_question (quiz_id, question_text, question_type_id, date_added, answer) VALUES ($quiz_id, '$question', '$type', '$date', '$correct')";
        $res = mysqli_query($conn, $sql);

        header("location:".SITEURL."admin/questions.php?id=$quiz_id");
        $_SESSION['addQuestion'] = "<div class='success p-20 mt-20'>Question added successfully!</div>";
    }else{
        $sql1 = "INSERT INTO quiz_question (quiz_id, question_text, question_type_id, date_added, answer) VALUES ($quiz_id, '$question', '$type', '$date', '$answer')";
        $res1 = mysqli_query($conn, $sql1);

        $sql2 = "SELECT * FROM quiz_question ORDER BY quiz_question_id DESC LIMIT 1";
        $res2 = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($res2);
        $quiz_question_id = $row['quiz_question_id'];
        
        mysqli_query($conn,"insert into answer (quiz_question_id,answer_text,choices) values('$quiz_question_id','$ans1','A')")or die(mysqli_error());
        mysqli_query($conn,"insert into answer (quiz_question_id,answer_text,choices) values('$quiz_question_id','$ans2','B')")or die(mysqli_error());
        mysqli_query($conn,"insert into answer (quiz_question_id,answer_text,choices) values('$quiz_question_id','$ans3','C')")or die(mysqli_error());
        mysqli_query($conn,"insert into answer (quiz_question_id,answer_text,choices) values('$quiz_question_id','$ans4','D')")or die(mysqli_error());
    
        header("location:".SITEURL."admin/questions.php?id=$quiz_id");
        $_SESSION['addQuestion'] = "<div class='success p-20 mt-20'>Question added successfully!</div>";
    }
}
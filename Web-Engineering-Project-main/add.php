<?php include 'database.php';?>
<?php
    if(isset($_POST['submit'])){
         $question_number = $_POST['question_number'];
         $question_text = $_POST['question_text'];
         $correct_choice = $_POST['correct_choice'];
         $quizno = $_POST["quizno"];

         
         $choices=array();
         $choices[1]= $_POST['choice1'];
         $choices[2]= $_POST['choice2'];
         $choices[3]= $_POST['choice3'];
         $choices[4]= $_POST['choice4'];
         $choices[5]= $_POST['choice5'];
         

         
        //  Question Query
        $query="INSERT INTO `quiz`(quizID,quesID,text) VALUES('$quizno','$question_number','$question_text')";

        // run Query
        $insert_row=$con->query($query) or die($con->error.__LINE__);
        
        // validate insert
        if($insert_row){
            foreach ($choices as $choice => $value) {
                if($value!=''){
                    if($correct_choice == $choice){
                        $is_correct = 1;
                    }
                    else{
                        $is_correct = 0;
                    }
                    $query="INSERT INTO `choices`(quesID,is_correct,text) VALUES('$question_number','$is_correct','$value')";
                    // run Query
                    $insert_row=$con->query($query) or die($con->error._LINE_);
                     // validate insert
                     if($insert_row){
                        continue;
                     }
                     else{
                        die('Error : ('.$con->errno. ')' .$con->error);
                     }
                }
            }
                $msg='Ques has been added';
            }
        }
        
        $query= "SELECT * FROM quiz";
       $results=$con->query($query) or die($con->error.__LINE__);
       $total=$results->num_rows;
       $next = $total+1;
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" type="text/css"></link>
</head>
<body>
    <header>
        <div class="container">
            <h1>Quiz</h1>
        </div>
    </header>
    <main>
    <div class="container">
        <h2>Add a Question</h2>
        <?php
            if(isset($msg)){
            echo '<p>'.$msg.'</p>';}?>
        <form method="post" action="add.php">
            <p>
                <label>Question Number</label>
                <input type="number" value='<?php echo $next;?>' name="question_number"/>
            </p>
            <p>
            <label>Quiz no</label>
                <input type="number" name="quizno"/> 
            </p>
            <p>
                <label>Question text</label>
                <input type="text" name="question_text"/>
            </p>
            <p>
                <label>Choice #1</label>
                <input type="text" name="choice1"/>
            </p>
            <p>
                <label>Choice #2</label>
                <input type="text" name="choice2"/>
            </p>
            <p>
                <label>Choice #3</label>
                <input type="text" name="choice3"/>
            </p>
            <p>
                <label>Choice #4</label>
                <input type="text" name="choice4"/>
            </p>
            <label>Choice #5</label>
                <input type="text" name="choice5"/>
            </p>
            <p>
                <label>Correct choice Number:</label>
                <input type="number" name="correct_choice"/>
            </p>
            <p>
                
                <input type="submit" name="submit" value="Submit"/>
            </p>

    </div>
    </main>
         
</body>
</html>
<?php
include_once ('../qcm/Question.php');
include_once ('../qcm/Answer.php');

$question = new Question(14,"Combien font 2 + 2 ?",2,1);
$answer1 = new Answer(63, "8", 0, 14);
$answer2 = new Answer(64, "2", 1, 14);
$answer3 = new Answer(65, "22", 0, 14);

$question->addAnswer($answer1);
$question->addAnswer($answer2);
$question->addAnswer($answer3);

//var_dump($question);
echo $question->getAnswers()[0]->getBody();

?>

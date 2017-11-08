<?php
include_once('Answer.php');

class Question {
  private $id = NULL;
  private $title = NULL;
  private $category = NULL;
  private $level = NULL;
  private $answers = array(); // propriété permettant de stocker des réponses

  public function __construct($id, $title, $category, $level) {
    $this->id = $id;
    $this->title = $title;
    $this->category = $category;
    $this->level = $level;
  }

  public function addAnswer(Answer $answer) {
    // ajoute au tableau $this->answers la réponse fournie
    // en argument
    array_push($this->answers, $answer);
    return;
  }

  public function getId() {return $this->id;}
  public function getTitle() {return $this->title;}

  public function getAnswers() {return $this->answers;}
}

?>

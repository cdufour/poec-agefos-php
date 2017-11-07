<?php
class Answer {
  private $id = NULL;
  private $body = NULL;
  private $correct = NULL;
  private $id_question = NULL;

  public function __construct($id, $body, $correct, $id_question) {
    // Petite liberté du prof, assignation directe, sans setters
    $this->id = $id;
    $this->body = $body;
    $this->correct = $correct;
    $this->id_question = $id_question;
  }

  public function getId() { return $this->id;}
  public function getBody() { return $this->body;}
  public function getCorrect() { return $this->correct;}
  public function getIdQuestion() { return $this->id_question;}
}
?>

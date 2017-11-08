<?php
include_once ('Question.php');
include_once ('Answer.php');

class QCM {
  private $db = NULL;
  private $category = NULL;
  private $level = NULL;
  private $nb_questions = NULL;
  private $questions = array(); // permet de stocker les résultats de la
  // méthode generate

  public function __construct($db, $category, $level, $nb_questions) {
    $this->setDb($db);
    $this->setCategory($category);
    $this->setLevel($level);
    $this->setNbQuestions($nb_questions);
  }

  // getters
  public function getCategory() {
    return $this->category;
  }
  public function getLevel() {
    return $this->level;
  }
  public function getNbQuestions() {
    return $this->nb_questions;
  }
  public function getQuestions() {
    return $this->questions;
  }

  // setters
  private function setDb(PDO $db) {
    // on indique de quel type sera l'argument
    // ce renseignement, qu'on utilise uniquement dans le cas
    // de types complexes (array, object), est facultatif
    $this->db = $db;
    return $this->db;
  }
  public function setCategory($category) {
    $this->category = $category;
    return $this->category;
  }
  public function setLevel($level) {
    $this->level = $level;
    return $this->level;
  }
  public function setNbQuestions($nb_questions) {
    $this->nb_questions = $nb_questions;
    return $this->nb_questions;
  }
  private function setQuestions(array $questions) {
    $this->questions = $questions;
    return $this->questions;
  }

  public function generate() {
    // La jointure interne JOIN renverra nécessairement
    // des questions possèdant des réponses
    // les questions sans réponse seront exclues
    // la jointure interne est restrictive (à la différence
    // des jointures externes (LEFT JOIN et RIGHT JOIN)
    // qui, elles, peuvent retourner des éléments sans
    // qu'une table ait de correspondance dans l'autre)

    $query = $this->db->prepare
    ('SELECT question.title, question.category, question.level,
      answer.body, answer.correct, answer.id_question,
      answer.id AS id_answer
      FROM question
      JOIN answer ON question.id = answer.id_question
      WHERE category = :category
      AND level = :level
      ORDER BY question.id ASC
    ');
    // la méthode bindValue est une autre façon d'associer des valeurs
    // aux placeholders (binding)
    $query->bindValue(':category', $this->getCategory(), PDO::PARAM_INT);
    $query->bindValue(':level', $this->getLevel(), PDO::PARAM_INT);
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if (sizeof($results) > 0) {
      $resultsTransformed =  $this->transformData($results);
      return $this->setQuestions($resultsTransformed);
    } else {
      return false;
    }

  }

  private function transformData($rows) {
    // fonction destinées à transformer les données (lignes)
    // reçues par la méthode generate() en tableau
    // d'objets Question. Chaque objet Question
    // contiendra un tableau d'objets Answer
    $questions = [];
    $id_question = $rows[0]->id_question; // id de la première question
    $question = new Question(NULL, NULL, NULL, NULL);
    $i = -1; // indice permettant d'insérer une question "au bon endroit"
    // dans le tableau des questions
    $firstQuestion = true;

    foreach($rows as $row) {
      $answer = new Answer(
        $row->id_answer, $row->body, $row->correct, $row->id_question);

      if ($row->id_question != $id_question || $firstQuestion) {
        $i++;
        // changement de question
        $question = new Question(
          $row->id_question, $row->title, $row->category, $row->level);

        $questions[$i] = $question;

        $id_question = $row->id_question;
        $firstQuestion = false;
      }
      $questions[$i]->addAnswer($answer);
    }
    return $questions;

  }

  public function processChoices($choices) {

    //$results = 0;
    foreach($this->getQuestions() as $question) {
      $question_id = strval($question->getId()); // 14 => "14"

      // cette variable correspond au tableau de réponses
      // cochées par le client
      $client_answers = $choices[$question_id]; // choices["14"];

      // boucle sur les réponses du client
      foreach($client_answers as $client_answer) {
        echo 'id question: ' . $question_id;
        echo ', id réponse: ' . $client_answer . '<br />';

        // comparaison avec le tableau des réponses contenu dans la question
        foreach ($question->getAnswers() as $answer) {
          if ($answer->getId() == intval($client_answer)) {
            if ($answer->getCorrect() == 1) {
              echo 'bonne réponse !';
            }
          }
        }
      }


    }

  }

}


?>

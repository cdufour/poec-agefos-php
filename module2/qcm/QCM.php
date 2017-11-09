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
    // $choices reçoit $_POST
    $results = 0; // variable servant au cumul DES bonnes réponses
    $result = 0; // variable servant à recevoir le résultat
    // de l'évaluation d'UNE question

    // Boucle de niveau 1, on parcourt le tableau des questions
    foreach($this->getQuestions() as $question) {
      $question_id = strval($question->getId()); // 14 => "14"
      // conversion de l'id en chaîne de caractère afin d'établir
      // la correspondance avec la clé dans le tableau associatif $choices

      // cette variable correspond au tableau de réponses
      // cochées par le client
      $client_answers = $choices[$question_id]; // choices["14"];
      // exemple de contenu pour la variable $client_answers:
      // array(15, 16) où 15 et 16 sont des identifiants de réponses
      // il s'agit des cases que le client à cocher


      // boucle de niveau 2, on parcourt les réponses du client
      foreach($client_answers as $client_answer) {
        // exemple: $client_answer vaudra au premier passage: 15
        // exemple: $client_answer vaudra au deuxième passage: 16

        // boucle de niveau 3, on parcourt le tableau complet de réponses
        // associées à la question traitée (boucle de niveau 1)
        // exemple: si la question d'id 14 contient un tableau de 4
        // réponses possible, cette boucle de niveau 3 fera 4 passages
        // on compare l'ensemble des réponses possibles
        // avec les réponses choisies par le client
        foreach ($question->getAnswers() as $answer) {
          if ($answer->getId() == intval($client_answer)) {
            // on vérifie que la réponse est correcte
            if ($answer->getCorrect() == 1) {
              $result++;
            } else {
              // si la réponse est mauvaise, on décremente la variable $result
              // "on enlève un point"
              $result--;
            }
          }
        } // fin de la boucle de niveau 3
      } // fin de la boucle de niveau 2
      // afin de ne pas fausser le résultat final, il faut éviter une valeur
      // pontentiellement négatif, on met à 0 $result si sa valeur est négative
      if ($result < 0) $result = 0;
      $results += $result; // on ajoute à results (variable de cumul)
      // le résultat obtenu pour la question qu'on vient de traiter
      $result = 0; // réinitialisation de la variable afin de la rendre
      // opérationnelle pour la question suivante

    } // fin de la boucle de niveau 1
    return $results;
  } // fin de la méthode processChoices

} // fin de la classe QCM


?>

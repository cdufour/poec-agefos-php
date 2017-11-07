<?php
class QCM {
  private $db = NULL;
  private $category = NULL;
  private $level = NULL;
  private $nb_questions = NULL;

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

  public function generate() {
    // La jointure interne JOIN renverra nécessairement
    // des questions possèdant des réponses
    // les questions sans réponse seront exclues
    // la jointure interne est restrictive (à la différence
    // des jointures externes (LEFT JOIN et RIGHT JOIN)
    // qui, elles, peuvent retourner des éléments sans
    // qu'une table ait de correspondance dans l'autre)

    $query = $this->db->prepare
    ('SELECT question.title, answer.body,
      answer.id_question, answer.id AS id_answer
      FROM question
      JOIN answer ON question.id = answer.id_question
      WHERE category = :category
      AND level = :level
    ');
    // la méthode bindValue est une autre façon d'associer des valeurs
    // aux placeholders (binding)
    $query->bindValue(':category', $this->getCategory(), PDO::PARAM_INT);
    $query->bindValue(':level', $this->getLevel(), PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_OBJ);
  }

}


?>

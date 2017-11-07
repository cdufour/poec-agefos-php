<?php
class Color {
  const DEFAULT_COLOR = 'black';
  public $colorHuman = NULL;

  private $colors = array(
    array(
      'human' => 'red',
      'hexa' => 'FF0000',
      'rgb' => '255,0,0'
    ),
    array(
      'human' => 'green',
      'hexa' => '00FF00',
      'rgb' => '0,255,0'
    ),
    array(
      'human' => 'black',
      'hexa' => '000000',
      'rgb' => '0,0,0'
    ),
  );

  // constructeur: function déclenchée automatiquement
  // lors de l'instantiation (new) d'un objet
  // permet de fournir à l'objet des données dès l'instantiation
  public function __construct($colorHuman) {
    // hydratation: "alimente" les propriétés en données fournies
    // au constructeur au moment de l'instantiation

    if ($this->checkColor($colorHuman)) {
      // couleur donnée à l'instanciation trouvée par la méthode
      // checkColor => hydratation
      $this->colorHuman = $colorHuman;
    } else {
      // l'opérateur self permet de cibler (résoudre) la constance
      // de classe DEFAULT_COLOR
      $this->colorHuman = self::DEFAULT_COLOR;
    }
  }

  private function checkColor($colorStr) {
    $colorHumanFound = false;
    foreach($this->colors as $color) {
      if ($color['human'] == $colorStr) {
        $colorHumanFound = true;
        break;
      }
    }
    return $colorHumanFound;
  }

  public function convertToHexa() {
    $colorHexa = NULL;
    foreach($this->colors as $color) {
      if ($color['human'] == $this->colorHuman) {
        $colorHexa = $color['hexa'];
        break;
      }
    }
    return $colorHexa;
  }

  public function convertToRgb() {
    $colorRgb = NULL;
    foreach($this->colors as $color) {
      if ($color['human'] == $this->colorHuman) {
        $colorRgb = $color['rgb'];
        break;
      }
    }
    return $colorRgb;
  }

}

?>

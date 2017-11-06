<?php
class Color {
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
  );

  // constructeur: function déclenchée automatiquement
  // lors de l'instantiation (new) d'un objet
  // permet de fournir à l'objet des données dès l'instantiation
  public function __construct($colorHuman) {
    // hydratation: "alimente" les propriétés en données fournies
    // au constructeur au moment de l'instantiation
    $this->colorHuman = $colorHuman;
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

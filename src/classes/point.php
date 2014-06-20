<?php

class Point extends Base{

  public $x;
  public $y;
  public function __construct($x,$y){
    $this->x=$x;
    $this->y=$y;
  }
  public function toString(){
    return '('.$this->x.','.$this->y.')';
  }
}
?>
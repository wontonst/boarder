<?php

class CPU extends Chip{
  public function __construct($x,$y,$width){
    parent::__construct('CPU',$x,$y,$width,$width);
    $this->addPins(Direction::UP,$GLOBALS['config']['MIN_CPU_PIN_EDGE']);
    $this->addPins(Direction::DOWN,$GLOBALS['config']['MIN_CPU_PIN_EDGE']);
    $this->addPins(Direction::LEFT,$GLOBALS['config']['MIN_CPU_PIN_EDGE']);
    $this->addPins(Direction::RIGHT,$GLOBALS['config']['MIN_CPU_PIN_EDGE']);
  }
  public function addPins($direction,$min_pin_edge=-1){
    parent::addPins($direction,
		    ($min_pin_edge==-1?$GLOBAL['config']['MIN_CPU_PIN_EDGE']:$min_pin_edge));
  }
}
?>
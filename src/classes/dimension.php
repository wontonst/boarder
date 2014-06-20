<?php

class Dimension extends Base{
  public $width;
  public $length;
  public function __construct($width,$length){
    $this->width=$width;
    $this->length=$length;
  }
  public function toString(){
    return '('.$this->width.'x'.$this->length.')';
  }
}
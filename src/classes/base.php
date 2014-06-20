<?php
/**
Root class extended by all objects.
*/
abstract class Base {

  public function __construct(){

  }
  public function explain(){
    echo $this->toString();
  }
  abstract public function toString();
}

?>
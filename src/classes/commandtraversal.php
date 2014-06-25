<?php

class CommandTraversal{

  const IN_ORDER=0;
  const PRE_ORDER=1;
  const POST_ORDER=2;

  public static function get($parent,$type){
    switch($type){
    case CommandTraversal::IN_ORDER:
      return new PostOrderCT($parent);
    case CommandTraversal::PRE_ORDER:
      return new PreOrderCT($parent);
    case CommandTraversal::POST_ORDER:
      return new PostOrderCT($parent);
    default:
      return NULL;
    }
  }

  public function __construct($parent){
    $this->parent=$parent;
  }
}

?>
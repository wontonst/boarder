<?php

abstract class CommandTraversal{

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
  /**
     Get a glimpse of what the next executable command would be.
   */
  public function peekCommand(){
    if($this->parent->isDone())
      return null;
    $dependent=$this->peekDependent();
    if($dependent != NULL)
      return $dependent;
    return $this->parent->data['cmd'];
  }
  abstract protected function peekDependent();
  /**
     Retrieves the next executable command and removes it from the command tree.
   */
  public function popCommand(){
    if($this->parent->isDone())
      return null;
    $dependent=$this->popDependent();
    if($dependent != NULL)
      return $dependent;
    $this->parent->data['done']=true;
    return $this->parent->data['cmd'];
  }
  abstract protected function popDependent();
}

?>
<?php

/**
Executes commands starting at leaf nodes.
*/
class PostOrderCT extends CommandTraversal{
  public function peekCommand(){
    if($this->parent->isDone())
      return null;
    $keys=array_keys($this->parent->data['dependents']);
    foreach($keys as $key){
      if($this->parent->data['dependents'][$key]->isDone()){
	unset($this->parent->data['dependents'][$key]);
	continue;
      }
      return $this->parent->data['dependents'][$key]->peekCommand();   
    }
    return $this->parent->data['cmd'];
  }
  /**
     Retrieves the next executable string.
   */
  public function popCommand(){
    if($this->parent->isDone())
      return null;
    $keys=array_keys($this->parent->data['dependents']);
    foreach($keys as $key){
      if($this->parent->data['dependents'][$key]->isDone()){
	unset($this->parent->data['dependents'][$key]);
	continue;
      }
      return $this->parent->data['dependents'][$key]->popCommand();   
    }
    $this->parent->data['done']=true;
    return $this->parent->data['cmd'];
  }
}
?>
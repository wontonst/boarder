<?php

/**
Executes commands starting at leaf nodes.
*/
class PostOrderCT extends CommandTraversal{
  protected function peekDependent(){
    $keys=array_keys($this->parent->data['dependents']);
    foreach($keys as $key){
      if($this->parent->data['dependents'][$key]->isDone()){
	unset($this->parent->data['dependents'][$key]);
	continue;
      }
      return $this->parent->data['dependents'][$key]->peekCommand();   
    }
    return NULL;
  }
  protected function popDependent(){
    $keys=array_keys($this->parent->data['dependents']);
    foreach($keys as $key){
      if($this->parent->data['dependents'][$key]->isDone()){
	unset($this->parent->data['dependents'][$key]);
	continue;
      }
      return $this->parent->data['dependents'][$key]->popCommand();   
    }
    return NULL;
  }
}
?>
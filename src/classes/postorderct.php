<?php

/**
Executes commands starting at leaf nodes.
*/
class PostOrderCT extends CommandTraversal{
  public function peekCommand(){
    if($this->parent->isDone())
      return null;
    $dependent=$this->peekDependent();
    if($dependent != NULL)
      return $dependent;
    return $this->parent->data['cmd'];
  }
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
  public function popCommand(){
    if($this->parent->isDone())
      return null;
    $dependent=$this->popDependent();
    if($dependent != NULL)
      return $dependent;
    $this->parent->data['done']=true;
    return $this->parent->data['cmd'];
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
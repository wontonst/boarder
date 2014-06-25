<?php

/**
Executes commands starting at leaf nodes.
*/
class PostOrder extends CommandTraversal{
  public function peekCommand(){
    if($this->data['done'])
      return null;
    $keys=array_keys($this->data['dependents']);
    foreach($keys as $key){
      if($this->data['dependents'][$key]->isDone()){
	unset($this->data['dependents'][$key]);
	continue;
      }
      return $this->data['dependents'][$key]->peekCommand();   
    }
    return $this->data['cmd'];
  }
  /**
     Retrieves the next executable string.
   */
  public function popCommand(){
    if($this->data['done'])
      return null;
    $keys=array_keys($this->data['dependents']);
    foreach($keys as $key){
      if($this->data['dependents'][$key]->isDone()){
	unset($this->data['dependents'][$key]);
	continue;
      }
      return $this->data['dependents'][$key]->popCommand();   
    }
    $this->data['done']=true;
    return $this->data['cmd'];
  }
}
?>
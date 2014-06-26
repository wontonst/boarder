<?php
/**
Returns commands starting at the root
*/
class PreOrderCT extends CommandTraversal{

  public function peekCommand(){
    if(!$this->isDone()){
      return $this->data['cmd'];
    }
    foreach($this->data['dependent'] as $cmd){
      $out = $cmd->peekCommand();
      if($out)
	return $out;
    }
    return NULL;
  }
  public function popCommand(){
    if(!$this->isDone()){
      $this->data['done']=true;
      return $this->data['cmd'];
    }
    foreach($this->data['dependent'] as $cmd){
      $out = $cmd->popCommand();
      if($out)
	return $out;
    }
    return NULL;
  }
}

?>
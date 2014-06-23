<?php
/**
A string command to be executed by the Executor to create the image.
 */
class Command{
  public function __construct(){
    $this->data=array();
    $this->data['dependents']=array();
    $this->data['size']=0;
    $this->data['done']=true;
    $this->data['cmd']=null;
  }
  public function setCommand($cmd){
    $this->data['cmd']=$cmd;
    $this->data['done']=false;
  }
  public function addSubcommand($cmd){
    $this->data['dependents'][]=$cmd;
    $this->data['size']+=$cmd->totalLength();
  }
  public function setIn($in){
    $this->data['in']=$in;
  }
  public function setOut($out){
    $this->data['out']=$out;
  }
  public function commandLength(){
    return strlen($this->data['cmd']);
  }
  public function totalLength(){
    return $this->data['size']+$this->commandLength();
  }
  public function peekCommand(){
    if(!$this->data['cmd'])
      return '';
    if($this->data['done'])
      return '';
    $keys=array_keys($this->data['dependents']);
    foreach($keys as $key){
      if($this->data['dependents'][$key]->isDone())
	unset($this->data['dependents'][$key]);
      return $this->data['dependents'][$key]->peekCommand();   
    }
    $this->data['done']=true;
    return $this->data['cmd'];
  }
  /**
     Retrieves the next executable string.
   */
  public function popCommand(){
    if(!$this->data['cmd'])
      return null;
    if($this->data['done'])
      return null;
    $keys=array_keys($this->data['dependents']);
    foreach($keys as $key){
      if($this->data['dependents'][$key]->isDone())
	unset($this->data['dependents'][$key]);
      return $this->data['dependents'][$key]->popCommand();   
    }
    $this->data['done']=true;
    return $this->data['cmd'];
  }
  public function isDone(){
    return $this->data['done'];
  }
  public function cmdString(){
    return $this->data['cmd'];
  }
}


?>
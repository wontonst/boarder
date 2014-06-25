<?php
/**
A string command to be executed by the Executor to create the image.
 */
abstract class Command{
  public function __construct($traversal=CommandTraversal::PRE_ORDER){
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
  public function isDone(){
    return $this->data['done'];
  }
  public function cmdString(){
    return $this->data['cmd'];
  }
  public function peekCommand(){
    return $this->traversal->peekCommand();
  }
  public function popCommand(){
    return $this->traversal->popCommand();
  }
}


?>
<?php
/**
Stores and executes commands
*/
class Executor{
  public function __construct(){
    $this->data=array();
    $this->data['cmds']=array();
  }
  public function addCmd($cmd){
    $this->data['cmds'][]=$cmd;
  }
  private function optimizeCommands(){

  }
  public function generateCommands(){

  }
}
?>
<?php

class PreOrderCTTestLinkedList extends PHPUnit_Framework_TestCase{

  public function setUp(){
    for($i = 0 ; $i != 5; $i++){
      $this->cmds[$i]=new Command(CommandTraversal::PRE_ORDER);
      $this->cmds[$i]->setCommand('Command #'.$i);
    }
    $this->cmds[0]->addSubcommand($this->cmd[1]);
    $this->cmds[1]->addSubcommand($this->cmd[2]);
    $this->cmds[2]->addSubcommand($this->cmd[3]);
    $this->cmds[3]->addSubcommand($this->cmd[4]);
  }
  public function testPeek(){

  }
  public function testPop(){
    for($i = 0 ; $i != 5; $i++){
      $this->assertEquals('Command #'.$i,$this->cmds[0]->popCommand());
    }
  }

}

?>
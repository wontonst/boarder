<?php

class PreOrderCTTest extends PHPUnit_Framework_TestCase{
  public function setUp(){
    for($i = 0 ; $i != 9; $i++){
      $this->cmds[$i]=new Command(CommandTraversal::IN_ORDER);
      $this->cmds[$i]->setCommand('Command #'.$i);
    }
    $this->cmds[0]->addSubcommand($this->cmds[1]);
    $this->cmds[0]->addSubcommand($this->cmds[2]);
    $this->cmds[0]->addSubcommand($this->cmds[3]);
    $this->cmds[2]->addSubcommand($this->cmds[4]);
    $this->cmds[3]->addSubcommand($this->cmds[5]);
    $this->cmds[3]->addSubcommand($this->cmds[6]);
    $this->cmds[3]->addSubcommand($this->cmds[7]);
    $this->cmds[7]->addSubcommand($this->cmds[8]);
  }
  public function testPeek(){

  }
  public function testPop(){
    for($i = 0 ; $i != 9; $i++){
            $this->assertEquals('Command #'.$i,$this->cmds[0]->popCommand());
    }
  }


}

?>
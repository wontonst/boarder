<?php

class CommandTest extends PHPUnit_Framework_TestCase{

  public function testInitialize(){
    $cmd = new Command();
    $this->assertTrue($cmd->isDone());
    $this->assertTrue(isset($cmd->data));
    $this->assertCount(0,$cmd->data['dependents']);
    $this->assertEquals(0,$cmd->data['size']);
    $this->assertEquals(null,$cmd->popCommand());
    $this->assertEquals(null,$cmd->peekCommand());
    $this->assertNull($cmd->data['cmd']);
  }
  public function testCmdData(){
    for($i = 0 ; $i != 5; $i++){
      $cmds[$i]=new Command();
      $cmds[$i]->setCommand('Command #'.$i);
    }
    $cmds[1]->addSubcommand($cmds[0]);
    $cmds[4]->addSubcommand($cmds[1]);
    $cmds[4]->addSubcommand($cmds[2]);
    $cmds[4]->addSubcommand($cmds[3]);

    $this->assertCount(3,$cmds[4]->data['dependents']);
    for($i = 0 ; $i != 5; $i++){
      $this->assertEquals('Command #'.$i,$cmds[$i]->data['cmd']);
    }
  }
  public function testAddSubcommand(){
    for($i = 0 ; $i != 13; $i++){
      $cmds[$i]=new Command();
      $cmds[$i]->setCommand('Command #'.$i);
    }
    $cmds[1]->addSubcommand($cmds[0]);
    $cmds[4]->addSubcommand($cmds[2]);
    $cmds[4]->addSubcommand($cmds[3]);
    $cmds[6]->addSubcommand($cmds[5]);
    $cmds[9]->addSubcommand($cmds[7]);
    $cmds[9]->addSubcommand($cmds[8]);
    $cmds[10]->addSubcommand($cmds[6]);
    $cmds[10]->addSubcommand($cmds[9]);
    $cmds[12]->addSubcommand($cmds[1]);
    $cmds[12]->addSubcommand($cmds[4]);
    $cmds[12]->addSubcommand($cmds[10]);
    $cmds[12]->addSubcommand($cmds[11]);
    for($i = 0 ; $i != 13; $i++){
      $this->assertEquals('Command #'.$i,$cmds[$i]->cmdString());
    }
  }
}

?>
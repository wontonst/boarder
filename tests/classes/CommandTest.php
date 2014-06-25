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
  public function testLeafPeak(){
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
    $nulls=array(0,2,3,5,7,8);
    foreach($nulls as $null){
      $this->assertEquals('Command #'.$null,$cmds[$null]->peekCommand());
      $cmds[$null]->popCommand();
      $this->assertNull($cmds[$null]->peekCommand());
    }
  }
  public function testPeakPop(){
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

    $this->assertEquals('Command #0',$cmds[1]->peekCommand(),'Peek implementation wrong.');
    $this->assertEquals('Command #0',$cmds[12]->peekCommand(),'Peek implementation wrong.');

    $this->assertEquals('Command #5',$cmds[6]->peekCommand(),'Peek implementation wrong.');
    $this->assertEquals('Command #5',$cmds[10]->peekCommand(),'Peek implementation wrong.');

    $this->assertEquals('Command #5',$cmds[10]->popCommand());
    $this->assertEquals('Command #6',$cmds[10]->popCommand());

    $this->assertEquals('Command #7',$cmds[9]->peekCommand(),'Peek after pop incorrect');
    $this->assertEquals('Command #7',$cmds[10]->peekCommand(),'Peek after pop incorrect');

    $this->assertEquals('Command #0',$cmds[1]->peekCommand(),'Somehow, by modifying other parts of the command tree, an unrelated part was changed.');
    $this->assertEquals('Command #0',$cmds[12]->peekCommand(),'Somehow, by modifying other parts of the command tree, an unrelated part was changed.');

    $this->assertEquals('Command #0',$cmds[12]->popCommand());
    $this->assertEquals('Command #1',$cmds[12]->popCommand());
    $this->assertEquals('Command #2',$cmds[12]->peekCommand());
    $this->assertEquals('Command #2',$cmds[12]->popCommand());
    $this->assertEquals('Command #3',$cmds[12]->peekCommand());
  }
  public function testPop1(){
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
  }
}

?>
<?php

class PostOrderCTTest extends PHPUnit_Framework_TestCase{
  public function setUp(){
    for($i = 0 ; $i != 13; $i++){
      $this->cmds[$i]=new Command();
      $this->cmds[$i]->setCommand('Command #'.$i);
    }
    $this->cmds[1]->addSubcommand($this->cmds[0]);
    $this->cmds[4]->addSubcommand($this->cmds[2]);
    $this->cmds[4]->addSubcommand($this->cmds[3]);
    $this->cmds[6]->addSubcommand($this->cmds[5]);
    $this->cmds[9]->addSubcommand($this->cmds[7]);
    $this->cmds[9]->addSubcommand($this->cmds[8]);
    $this->cmds[10]->addSubcommand($this->cmds[6]);
    $this->cmds[10]->addSubcommand($this->cmds[9]);
    $this->cmds[12]->addSubcommand($this->cmds[1]);
    $this->cmds[12]->addSubcommand($this->cmds[4]);
    $this->cmds[12]->addSubcommand($this->cmds[10]);
    $this->cmds[12]->addSubcommand($this->cmds[11]);
  }
  public function testPeek(){
    for($i = 0 ; $i != 13; $i++){
      $this->cmds[$i]=new Command();
      $this->cmds[$i]->setCommand('Command #'.$i);
    }
    $this->cmds[1]->addSubcommand($this->cmds[0]);
    $this->cmds[4]->addSubcommand($this->cmds[2]);
    $this->cmds[4]->addSubcommand($this->cmds[3]);
    $this->cmds[6]->addSubcommand($this->cmds[5]);
    $this->cmds[9]->addSubcommand($this->cmds[7]);
    $this->cmds[9]->addSubcommand($this->cmds[8]);
    $this->cmds[10]->addSubcommand($this->cmds[6]);
    $this->cmds[10]->addSubcommand($this->cmds[9]);
    $this->cmds[12]->addSubcommand($this->cmds[1]);
    $this->cmds[12]->addSubcommand($this->cmds[4]);
    $this->cmds[12]->addSubcommand($this->cmds[10]);
    $this->cmds[12]->addSubcommand($this->cmds[11]);
    $nulls=array(0,2,3,5,7,8);
    foreach($nulls as $null){
      $this->assertEquals('Command #'.$null,$this->cmds[$null]->peekCommand());
      $this->cmds[$null]->popCommand();
      $this->assertNull($this->cmds[$null]->peekCommand());
    }
  }
  public function testPeekPop(){
    for($i = 0 ; $i != 13; $i++){
      $this->cmds[$i]=new Command();
      $this->cmds[$i]->setCommand('Command #'.$i);
    }
    $this->cmds[1]->addSubcommand($this->cmds[0]);
    $this->cmds[4]->addSubcommand($this->cmds[2]);
    $this->cmds[4]->addSubcommand($this->cmds[3]);
    $this->cmds[6]->addSubcommand($this->cmds[5]);
    $this->cmds[9]->addSubcommand($this->cmds[7]);
    $this->cmds[9]->addSubcommand($this->cmds[8]);
    $this->cmds[10]->addSubcommand($this->cmds[6]);
    $this->cmds[10]->addSubcommand($this->cmds[9]);
    $this->cmds[12]->addSubcommand($this->cmds[1]);
    $this->cmds[12]->addSubcommand($this->cmds[4]);
    $this->cmds[12]->addSubcommand($this->cmds[10]);
    $this->cmds[12]->addSubcommand($this->cmds[11]);

    $this->assertEquals('Command #0',$this->cmds[1]->peekCommand(),'Peek implementation wrong.');
    $this->assertEquals('Command #0',$this->cmds[12]->peekCommand(),'Peek implementation wrong.');

    $this->assertEquals('Command #5',$this->cmds[6]->peekCommand(),'Peek implementation wrong.');
    $this->assertEquals('Command #5',$this->cmds[10]->peekCommand(),'Peek implementation wrong.');

    $this->assertEquals('Command #5',$this->cmds[10]->popCommand());
    $this->assertEquals('Command #6',$this->cmds[10]->popCommand());

    $this->assertEquals('Command #7',$this->cmds[9]->peekCommand(),'Peek after pop incorrect');
    $this->assertEquals('Command #7',$this->cmds[10]->peekCommand(),'Peek after pop incorrect');

    $this->assertEquals('Command #0',$this->cmds[1]->peekCommand(),'Somehow, by modifying other parts of the command tree, an unrelated part was changed.');
    $this->assertEquals('Command #0',$this->cmds[12]->peekCommand(),'Somehow, by modifying other parts of the command tree, an unrelated part was changed.');

    $this->assertEquals('Command #0',$this->cmds[12]->popCommand());
    $this->assertEquals('Command #1',$this->cmds[12]->popCommand());
    $this->assertEquals('Command #2',$this->cmds[12]->peekCommand());
    $this->assertEquals('Command #2',$this->cmds[12]->popCommand());
    $this->assertEquals('Command #3',$this->cmds[12]->peekCommand());
  }
  public function testPop1(){
    for($i = 0 ; $i != 13; $i++){
      $this->cmds[$i]=new Command();
      $this->cmds[$i]->setCommand('Command #'.$i);
    }
    $this->cmds[1]->addSubcommand($this->cmds[0]);
    $this->cmds[4]->addSubcommand($this->cmds[2]);
    $this->cmds[4]->addSubcommand($this->cmds[3]);
    $this->cmds[6]->addSubcommand($this->cmds[5]);
    $this->cmds[9]->addSubcommand($this->cmds[7]);
    $this->cmds[9]->addSubcommand($this->cmds[8]);
    $this->cmds[10]->addSubcommand($this->cmds[6]);
    $this->cmds[10]->addSubcommand($this->cmds[9]);
    $this->cmds[12]->addSubcommand($this->cmds[1]);
    $this->cmds[12]->addSubcommand($this->cmds[4]);
    $this->cmds[12]->addSubcommand($this->cmds[10]);
    $this->cmds[12]->addSubcommand($this->cmds[11]);
    for($i = 0 ; $i != 13; $i++){
      $this->cmds[$i]->setCommand('Command #'.$i);
      $this->assertEquals('Command #'.$i,$this->cmds[12]->popCommand());
    }
  }
  public function testPop2(){
    for($i = 0 ; $i != 13; $i++){
      $this->cmds[$i]=new Command();
      $this->cmds[$i]->setCommand('Command #'.$i);
    }
    $this->cmds[1]->addSubcommand($this->cmds[0]);
    $this->cmds[4]->addSubcommand($this->cmds[2]);
    $this->cmds[4]->addSubcommand($this->cmds[3]);
    $this->cmds[6]->addSubcommand($this->cmds[5]);
    $this->cmds[9]->addSubcommand($this->cmds[7]);
    $this->cmds[9]->addSubcommand($this->cmds[8]);
    $this->cmds[10]->addSubcommand($this->cmds[6]);
    $this->cmds[10]->addSubcommand($this->cmds[9]);
    $this->cmds[12]->addSubcommand($this->cmds[1]);
    $this->cmds[12]->addSubcommand($this->cmds[4]);
    $this->cmds[12]->addSubcommand($this->cmds[10]);
    $this->cmds[12]->addSubcommand($this->cmds[11]);

    for($i = 5; $i != 10; $i++){
      $this->assertEquals('Command #'.$i,$this->cmds[10]->popCommand());
    }
    $this->assertEquals('Command #0',$this->cmds[1]->popCommand());
    $this->assertEquals('Command #2',$this->cmds[4]->popCommand());
    $this->assertEquals('Command #3',$this->cmds[4]->popCommand());

    $this->assertEquals('Command #1',$this->cmds[12]->popCommand());
    $this->assertEquals('Command #4',$this->cmds[12]->popCommand());
    $this->assertEquals('Command #10',$this->cmds[12]->popCommand());
    $this->assertEquals('Command #11',$this->cmds[12]->popCommand());
  }
}
?>
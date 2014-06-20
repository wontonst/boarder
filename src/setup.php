<?php

function __autoload($classname){
  include('classes/'.strtolower($classname).'.php');
}
include('config.php');
$GLOBALS['config']=$config;

function randomBoard(){
  $board=new Board(2400,2400);
  for($i = 0; $i != 10; $i++){
    for($ii = 0 ;$ii != 10; $ii++){
      $board->addChip(new CPU(20+$i*200,20+$ii*200,rand(50,180)));
    }
  }
  $board->execute('chen.png');
  $board->explain();
  return;
}
public function genericBoard(){
  $board = new Board(140,140);
  $board->addChip(new CPU(10,10,100));
  $board->execute('cpu.png');
  $board->explain();
}

?>
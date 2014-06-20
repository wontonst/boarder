<?php
spl_autoload_register(function ($classname){
 include __DIR__.'/classes/'.strtolower($classname).'.php';
 });
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
function genericBoard(){
  $board = new Board(140,140);
  $board->addChip(new CPU(10,10,100));
  $board->explain();
  $board->execute('cpu.png');
}

?>
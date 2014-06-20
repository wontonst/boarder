<?php
  define('CPU_EDGE_MIN',2);

function __autoload($classname){
  include('classes/'.strtolower($classname).'.php');
}
include('config.php');

function randonBoard(){
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
$board = new Board(360,220);
$board->addChip(new CPU(10,10,200));
$chip = new Chip("YttConv",240,10,100,200);
$chip->addPins(Direction::RIGHT);
$board->addChip($chip);
$board->execute('cpu.png');
$board->explain();
?>
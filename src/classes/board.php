<?php

class Board extends Base{
  
  public function __construct($width, $length){
    $this->data['width']=$width;
    $this->data['length']=$length;
    $this->data['dimensions']=new Dimension($width,$length);
  }

  public function addChip($chip){
    if(!(is_a($chip,'Chip')))
      {
	echo 'Cannot add non-CPU object:';
	var_dump($chip);
      }
    $this->data['chips'][]=$chip;
  }
  public function build(){
    $cmd = array();
$cmd[] = '-size '.$this->data['width'].'x'.$this->data['length'].' xc:#00000000 ';

    if($this->data['chips'])
      foreach($this->data['chips'] as $chip){
	$cmd=array_merge($cmd,$chip->build());
      }
    return $cmd;
  }
  public function execute($output){
    $cmds=$this->build();
    $this->executeOne('convert '.$cmds[0].' '.$output);
    for($i = 1 ;$i < count($cmds); $i++){
      $this->executeOne('convert '.$output.' '.$cmds[$i].' '.$output);
    }
  }
  private function executeOne($cmd){
    echo 'Executing command: '.$cmd."\n";
    exec($cmd);
  }
  public function explain(){
    parent::explain();
    echo "\n";
  }
  public function toString(){
    $val= 'Board with dimensions '.$this->data['dimensions']->toString();
    foreach($this->data['chips'] as $chip)
      $val .= "\n".$chip->toString();
    return $val;
  }
}

?>
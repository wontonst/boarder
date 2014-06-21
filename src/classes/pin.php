<?php

/**
Represents a pin on a chip
*/
class Pin extends Base{

  public function __construct($x,$y,$direction){
    $this->data['x']=$x;
    $this->data['y']=$y;
    $this->data['point']=new Point($x,$y);
    $this->data['direction']=$direction;
    $this->calculateLines();
  }
  private function calculateLines(){
    $this->data['lines']=array();

    switch($this->data['direction']){
    case Direction::UP:
      $this->data['lines'][]=array(//horizontal
			 $this->data['x']-$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['y']-$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['x']+$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['y']-$GLOBALS['config']['PIN_LENGTH']
			 );
      $this->data['lines'][]=array(//left vertical
			 $this->data['x']-$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['y']-$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['x']-$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['y']
				   );
      $this->data['lines'][]=array(//right vertical
			 $this->data['x']+$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['y']-$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['x']+$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['y']
				   );
      break;
    case Direction::DOWN:
      $this->data['lines'][]=array(//horizontal
 		         $this->data['x']-$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['y']+$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['x']+$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['y']+$GLOBALS['config']['PIN_LENGTH']
			 );
      $this->data['lines'][]=array(//left vertical
			 $this->data['x']-$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['y'],
			 $this->data['x']-$GLOBALS['config']['PIN_WIDTH']/2,
				   $this->data['y']+$GLOBALS['config']['PIN_LENGTH']
			 );
      $this->data['lines'][]=array(//right vertical
			 $this->data['x']+$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['y'],
			 $this->data['x']+$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['y']+$GLOBALS['config']['PIN_LENGTH']
			 );
      break;
    case Direction::LEFT:
      $this->data['lines'][]=array(//vertical
			 $this->data['x']-$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['y']-$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['x']-$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['y']+$GLOBALS['config']['PIN_WIDTH']/2
			 );
      $this->data['lines'][]=array(//top horizontal
			 $this->data['x']-$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['y']-$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['x'],
			 $this->data['y']-$GLOBALS['config']['PIN_WIDTH']/2
			 );
      $this->data['lines'][]=array(//bottom horizontal
			 $this->data['x']-$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['y']+$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['x'],
			 $this->data['y']+$GLOBALS['config']['PIN_WIDTH']/2
			 );
      break;
    case Direction::RIGHT:
      $this->data['lines'][]=array(//vertical
			 $this->data['x']+$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['y']-$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['x']+$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['y']+$GLOBALS['config']['PIN_WIDTH']/2
			 );
      $this->data['lines'][]=array(//top horizontal
			 $this->data['x'],
			 $this->data['y']-$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['x']+$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['y']-$GLOBALS['config']['PIN_WIDTH']/2
			 );
      $this->data['lines'][]=array(//bottom horizontal
			 $this->data['x'],
			 $this->data['y']+$GLOBALS['config']['PIN_WIDTH']/2,
			 $this->data['x']+$GLOBALS['config']['PIN_LENGTH'],
			 $this->data['y']+$GLOBALS['config']['PIN_WIDTH']/2
			 );
      break;
    }

  }
  /**
     Draw 3 lines to represent the pin.
  */
  public function build(){
    $cmd =array();
$cmd =' -strokewidth '.$GLOBALS['config']['PIN_STROKEWIDTH'];
    foreach($this->data['lines'] as $line){
      $cmd.=' -draw "line '.implode(',',$line).'"';
    }
    return array($cmd);
  }
  public function toString(){
    $val= 'Pin@('.$this->data['x'].','.$this->data['y'].') with lines';    
    foreach($this->data['lines'] as $line){
      $val.= "\n(".$line[0].','.$line[1].')->('.$line[2].','.$line[3].')';
    }
    return $val;
  }
}

?>
<?php
/**
A generic chip of any type.

TODO: Get rid of x,y and use only point
*/
class Chip extends Base {

  public function __construct($name,$x,$y,$width,$length){
    if(!is_string($name)){
      die( 'Chip constructor arg1 must be a string.');
    }
    $this->data['name']=$name;
    $this->data['point']=new Point($x,$y);
    $this->data['x']=$x;
    $this->data['y']=$y;
    $this->data['dimensions']=new Dimension($width,$length);
    $this->data['width']=$width;
    $this->data['length']=$length;
  }

  public function addPins($direction,$min_pin_edge=-1){
    if($min_pin_edge==-1)
      $min_pin_edge=$GLOBALS['config']['MIN_CHIP_PIN_EDGE'];
    $pin_space=null;          //how much space is 
                              //available for pins
    $pin_spacing=null;        //space between pins
    $pin_width=null;          //width of pin
    $pin_length=null;         //length of pin
    $pins = null;             //number of pins on the side
    $offset = null;           //distance between first pin
                              //and edge of CPU
    if($direction == Direction::UP || $direction==Direction::DOWN){
      $pin_space = $this->data['width']-2*$min_pin_edge;
    }else{//LEFT OR RIGHT
      $pin_space = $this->data['length']-2*$min_pin_edge;
    }
    $pin_spacing=$GLOBALS['config']['PIN_SPACING'];
    $pin_width=$GLOBALS['config']['PIN_WIDTH'];
    $pin_length=$GLOBALS['config']['PIN_LENGTH'];
    $pins=floor(($pin_space+$pin_spacing)/($pin_width+$pin_spacing));//derive number of pins to use
                                                                     //algebraically
    $offset=.5*($pin_space+2*$min_pin_edge-($pin_width*$pins+$pin_spacing*($pins-1)));
    //var_dump(get_defined_vars());
    switch($direction){
    case Direction::UP:
      $x = $this->data['x']+$offset;
      for($i = 0; $i != $pins; $i++){
	if($i == 0)
	  $x += $pin_width/2;
	else{
	  $x += $pin_width+$pin_spacing;
	}
	$this->data['pins'][]=new Pin($x,$this->data['y'],Direction::UP);
      }
      break;
    case Direction::DOWN:
      $x = $this->data['x']+$offset;
      for($i = 0; $i != $pins; $i++){
	if($i == 0)
	  $x += $pin_width/2;
	else{
	  $x += $pin_width+$pin_spacing;
	}
	$this->data['pins'][]=new Pin($x,$this->data['y']+$this->data['length'],Direction::DOWN);
      }
      break;
    case Direction::LEFT:
      $y = $this->data['y']+$offset;
      for($i = 0; $i != $pins; $i++){
	if($i == 0)
	  $y += $pin_width/2;
	else{
	  $y += $pin_width+$pin_spacing;
	}
	$this->data['pins'][]=new Pin($this->data['x'],$y,Direction::LEFT);
      }
      break;
    case Direction::RIGHT:
      $y = $this->data['y']+$offset;
      for($i = 0; $i != $pins; $i++){
	if($i == 0)
	  $y += $pin_width/2;
	else{
	  $y += $pin_width+$pin_spacing;
	}
	$this->data['pins'][]=new Pin($this->data['x']+$this->data['width'],$y,Direction::RIGHT);
      }
      break;
    }
  }
  /*
    Build the string for generating the chip
  */
  public function build(){
    $cmd =array();
$cmd[]= ' -stroke black -strokewidth 1.5 -fill white -draw "rectangle '.implode(',',
		   array(
			 $this->data['x'],
			 $this->data['y'],
			 $this->data['x'] + $this->data['width'],
			 $this->data['y'] + $this->data['length']
			 )
		   ).'"';
    if(isset($this->data['pins']))
      foreach($this->data['pins'] as &$pin){
	$cmd = array_merge($cmd,$pin->build());
      }
    return $cmd;
  }
  public function toString(){
    $val= 'Chip '.$this->data['name'].' at '.$this->data['point']->toString().' size '.$this->data['dimensions']->toString().' with pins ';
    if(isset($this->data['pins']))
    foreach($this->data['pins'] as $pin){
      $val.= str_replace("\n","\n\t","\n".$pin->toString());
    }
    return $val;
  }
}

?>
<?php
class ChipTest extends PHPUnit_Framework_TestCase{

  public function testInitialize(){
    $errorsuffix=' not passed correctly in constructor.';
    $name='trofl#132(*&^';
    $x=321;
    $y=123;
    $w=100000;
    $h=1;
    $chip = new Chip($name,$x,$y,$w,$h);
    $this->assertEquals($name,$chip->data['name'],'Chip name'.$errorsuffix);
    $this->assertEquals($x,$chip->data['point']->x,'Chip x-coordinate'.$errorsuffix);
    $this->assertEquals($y,$chip->data['point']->y,'Chip y-coordinate'.$errorsuffix);
    $this->assertEquals($w,$chip->data['dimensions']->width,'Chip width dimension'.$errorsuffix);
    $this->assertEquals($h,$chip->data['dimensions']->length,'Chip length dimension'.$errorsuffix);
  }
  /**
     @depends testInitialize
  */
  public function testAddPin(){
    $minEdge=$GLOBALS['config']['MIN_CHIP_PIN_EDGE'];
    $pinlength=$GLOBALS['config']['PIN_LENGTH'];
    $pinwidth=$GLOBALS['config']['PIN_WIDTH'];
    $pinspacing=$GLOBALS['config']['PIN_SPACING'];
    $length=$minEdge*2+$pinwidth;
  $width=$minEdge*2+$pinwidth;
    $chip = new Chip('',0,0,$width,$length);
    $this->assertFalse(isset($chip->data['pins']));
    $chip->addPins(Direction::UP);
    $this->assertArrayHasKey('pins',$chip->data);
    $this->assertCount(1,$chip->data['pins'],'Could not add pin Direction::UP');
    $this->assertEquals($minEdge+$pinwidth/2,$chip->data['pins'][0]->data['point']->x);
    $this->assertEquals(0,$chip->data['pins'][0]->data['point']->y);
    $chip->addPins(Direction::LEFT);
    $this->assertCount(2,$chip->data['pins'],'Could not add pin Direction::LEFT');
    $this->assertEquals(0,$chip->data['pins'][1]->data['point']->x);
    $this->assertEquals($minEdge+$pinwidth/2,$chip->data['pins'][1]->data['point']->y);
    $chip->addPins(Direction::DOWN);
    $this->assertCount(3,$chip->data['pins'],'Could not add pin Direction::DOWN');
    $this->assertEquals($minEdge+$pinwidth/2,$chip->data['pins'][2]->data['point']->x);
    $this->assertEquals($length,$chip->data['pins'][2]->data['point']->y);
    $chip->addPins(Direction::RIGHT);
    $this->assertCount(4,$chip->data['pins'],'Could not add pin Direction::RIGHT');
    $this->assertEquals($width,$chip->data['pins'][3]->data['point']->x);
    $this->assertEquals($minEdge+$pinwidth/2,$chip->data['pins'][3]->data['point']->y);
  }
}


?>
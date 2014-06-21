<?php
class ChipTest extends PHPUnit_Framework_TestCase{

  public function testInitialize(){
    $name='trofl#132(*&^';
    $x=321;
    $y=123;
    $w=100000;
    $h=1;
    $chip = new Chip($name,$x,$y,$w,$h);
    $this->assertEquals($name,$chip->data['name']);
    $this->assertEquals($x,$chip->data['point']->x);
    $this->assertEquals($y,$chip->data['point']->y);
    $this->assertEquals($w,$chip->data['dimensions']->width);
    $this->assertEquals($h,$chip->data['dimensions']->length);
  }
  /**
     @depends testInitialize
  */
  public function testAddPin(){
    $minEdge=$GLOBALS['config']['MIN_CHIP_PIN_EDGE'];
    $pinlength=$GLOBALS['config']['PIN_LENGTH'];
    $pinwidth=$GLOBALS['config']['PIN_WIDTH'];
    $pinspacing=$GLOBALS['config']['PIN_SPACING'];
    $chip = new Chip('',0,0,$minEdge*2+$pinwidth,$minEdge*2+$pinwidth);
    $this->assertFalse(isset($chip->data['pins']));
    $chip->addPins(Direction::UP);
    $this->assertArrayHasKey('pins',$chip->data);
    $this->assertCount(1,$chip->data['pins']);
    $this->assertEquals($minEdge+$pinwidth/2,$chip->data['pins'][0]->data['point']->x);
    $chip->addPins(Direction::LEFT);
    $chip->addPins(Direction::DOWN);
    $chip->addPins(Direction::RIGHT);
  }

}


?>
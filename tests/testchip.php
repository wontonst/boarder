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
  }
  /**
@depends testInitialize
  */
  public function testPin(){

  }

}


?>
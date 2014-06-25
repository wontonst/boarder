<?php
function verifyConfig(){

  $exists=function(){
    $mandatory=array(
		     'PIN_LENGTH',
		     'PIN_WIDTH',
		     'MIN_CPU_PIN_EDGE',
		     'MIN_CHIP_PIN_EDGE',
		     'PIN_STROKEWIDTH',
		     'MAX_COMMAND_LENGTH',
		     );
    foreach($mandatory as $v){
      if(!in_array($v,$GLOBALS['config']))
	return false;
    }
  }
  $exists();

  $is_integer=function($v){
    return is_integer($v);
  };
  $is_greater_than_zero=function($v){
    return $v > 0;
  };
  $is_geq_zero=function($v){
    return $v >= 0;
  }
  $integer_greater_than_zero=function($v){
    return (is_integer($v)&&$v>0);
  };
  $float_greater_than_zero=function($v){
    return (is_numeric($v) && $v >= 0);
  }
  $valueVerify=array(
		     'PIN_LENGTH'=>$integer_greater_than_zero,
		     'PIN_WIDTH'=>$integer_greater_than_zero,
		     'MIN_CPU_PIN_EDGE'=>$is_geq_zero,
		     'MIN_CHIP_PIN_EDGE'=$is_geq_zero,
		     'PIN_STROKEWIDTH'=>$float_greater_than_zero,
		     'MAX_COMMAND_LENGTH'=>$integer_greater_than_zero,
		     );
  
  foreach($valueVerify as $verify){
    if(!$verify[1]($GLOBALS['config'][$verify[0]]))
      return false;
  }
  return true;
}
?>
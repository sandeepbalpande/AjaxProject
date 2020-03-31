<?php
$a=array(1,1,1,2,2,2,3,3,3,4,4,5,6,6);
$count_value=array();
foreach($a as $value)
{
	@$count_value[$value]++;
}

print_r($count_value);
?>
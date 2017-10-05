<?php

require 'autoload.php';

$watchman = new Lex\Watchman();

$rules = [
	new Lex\Rules\RuleOne(),
	new Lex\Rules\RuleTwo(),
	new Lex\Rules\RuleThree()
];

$order = $watchman->findOrder(2);



if  (!$order) {
	echo 'Order not found';
}
else {
	$discounts = array();
	foreach($rules as $rule)
		if($rule->test($order)) 
			array_push($discounts, $rule->calc($order));
	
	if(!count($discounts)) 
		print 'Today this customer without discounts';
	else
		var_dump($discounts);	
}
<?php

$string = "hello"; 

$daemon = 0;

function printit ($string) {
	if (!$GLOBALS['daemon']) {
		echo "$string";
	}
}

printit($string); 
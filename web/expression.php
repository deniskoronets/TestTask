<?php
/*

Use PHP 5.x

Task:
Develop a function which validates string looking like this "[{}]"
Every opening bracket should have corresponding closing bracket of same type
"[{}]" is a correct string, "[{]}" is malformed one.


Usage: <your host>/validateString.php?i={input string}

Example: <your host>/validateString.php?i={[{{}

*/

$pairs = [
	'{' => '}',
	'[' => ']',
];

$allowedSymbols = [
	'[', ']', '{', '}',
];

function validateString(&$inputString) {

	global $pairs, $allowedSymbols;

	if (!is_array($inputString)) {
		$inputString = str_split($inputString);
	} elseif (empty($inputString)) {
		return true;
	}

	$firstSymbol = array_shift($inputString);

	if (!isset($pairs[$firstSymbol])) {
		return false;
	}

	$lastSymbol = array_pop($inputString);

	if ($pairs[$firstSymbol] != $lastSymbol) {
		return false;
	}

	return validateString($inputString);
}

$inputString = str_repeat('{', 10000) . str_repeat('}', 10001); //$_GET['i'];

echo "'".$inputString."' is ";
echo validateString($inputString)?"correct":"incorrect";
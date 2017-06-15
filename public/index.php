<?php
namespace Panel;

require '../vendor/autoload.php';

use FormulaInterpreter\Compiler;

$string = "((:var1 + :var2) / :var3 * :var4) * 100";


$var_count = substr_count($string, ':');
$delimiter = ' ';
$pattern = '/[()]/';
$replacement = '';
$string_parts = explode($delimiter, $string) ;
$vars = array();
$var_name = array();

for ($i = 0; $i < count($string_parts); $i++ ) {
    // echo $string_parts[$i] . '<br/>';
    if (stristr($string_parts[$i],   ':')) {
       array_push($vars, preg_replace($pattern, $replacement, $string_parts[$i]));
    }
}


for ($i = 0; $i < $var_count; $i++) {
    // echo '<input type="text" name="' . $vars . '" value="">';
    // echo '<br/>';
}

$values = ['26', '30', '60', '1'];

$string = str_replace($vars, $values, $string);

$compiler = new Compiler();
$executable = $compiler->compile($string);
$result = round($executable->run(), 2);

// dd('La formula: [' . $string . ']  tiene: ' . $var_count . ' variables y da como resultado: ' . $result . '%');


// dd(convert_min_to_days(540));
convertMinutesToDaysHoursMinutes(61);




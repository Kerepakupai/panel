<?php
namespace Panel;

require '../vendor/autoload.php';
use FormulaInterpreter\Compiler;

// $string = "((:var1 + :var2) / (:var3 * :var4) * 100";
$search = array('{', '}');

$subject = '(({value1} * {value2}) - {value3}) / 100';
$fx = str_replace($search, '', $subject);
$pattern = '~\{([^}]*)\}~';
$vars    = array();
$values = array();

preg_match_all($pattern, $subject, $vars);

echo "<form>";
foreach ($vars[1] as $var) {
    echo "$var: ";
    echo "<input type=\"text\" name=\"$var\"><br>";
    echo "<br>";
}
echo "<input type='button' id='calcular' value='Calcular'>";
echo "</form>";

// $var_count = substr_count($string, ':');
// $delimiter = ' ';

// $replacement = '';
// $string_parts = explode($delimiter, $string) ;
// $vars = array();
// $var_name = array();


foreach ($vars[1] as $key) {
    $values[$key] = rand(1, 50);
}

/*
    $variables = array(
    'value1' => 40,
    'value2' => 2,
    'value3' => 2
);
*/





/*
for ($i = 0; $i < count($string_parts); $i++ ) {
    // echo $string_parts[$i] . '<br/>';
    if (stristr($string_parts[$i],   ':')) {
        array_push($vars, preg_replace($pattern, $replacement, $string_parts[$i]));
    }
}
*/
/*
for ($i = 0; $i < $var_count; $i++) {
    // echo '<input type="text" name="' . $vars . '" value="">';
    // echo '<br/>';
}
*/
// $values = ['26', '30', '60', '1'];

// $string = str_replace($vars, $values, $string);


$compiler = new Compiler();
$executable = $compiler->compile($fx);
$result = round($executable->run($values), 2);

dd($result);
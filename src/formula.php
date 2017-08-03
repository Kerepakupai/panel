<?php
namespace Panel;

require '../vendor/autoload.php';
use FormulaInterpreter\Compiler;
use Rezzza\Formulate\Formula;

$search = array('{', '}');
$subject = '(({value1} * {value2}) - {value3}) / 100';
$subject = $_GET['formula'];


$fx = str_replace($search, '', $subject);

$pattern = '~\{([^}]*)\}~';
$vars    = array();
$values = array();
$data = array();

preg_match_all($pattern, $subject, $vars);

$formula = new Formula('{{ variable1 }} + {{ variable2 }}');
$formula->setParameter('variable1', 10);
$formula->setParameter('variable2', 13);

if('2017-05-20' >= '2017-07-23 08:00:00') {  // 2017-07-23 08:00:00
    print('True');
} else {
    print ('false');
}
exit();

echo $formula->render(); // "10 + 13"

$formula->setIsCalculable(true);

echo $formula->render(); // "23"

exit();


/* echo "<form>";
foreach ($vars[1] as $var) {
    echo "$var: ";
    echo "<input type=\"text\" name=\"$var\"><br>";
    echo "<br>";
}
echo "<input type='button' id='calcular' value='Calcular'>";
echo "</form>";

foreach ($vars[1] as $key) {
    $values[$key] = rand(1, 50);
}
*/
// $compiler = new Compiler();
// $executable = $compiler->compile($fx);
// $result = round($executable->run($values), 2);
return json_encode($vars[1]);
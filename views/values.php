<?php
namespace Panel;

require '../vendor/autoload.php';
use FormulaInterpreter\Compiler;
use Rezzza\Formulate\Formula;

$search = array('{', '}');
// $subject = '({{value1} * {value2}) - {value3}) / 100';
$subject = $_GET['formula'];


$fx = str_replace($search, '', $subject);

$pattern = '~\{([^}]*)\}~';
$vars    = array();
$values = array();
$data = array();

preg_match_all($pattern, $subject, $vars);

$formula = new Formula('((({{ variable1 }} + {{ variable2 }}) - ({{ variable3 }} + {{ variable4 }})) / 100) * 2');
$formula->setParameter('variable1', 50);
$formula->setParameter('variable2', 80);
$formula->setParameter('variable3', 5);
$formula->setParameter('variable4', 5);

$formula->render(); // "10 + 13"
$formula->setIsCalculable(true);
echo $formula->render(); // "23"

exit();
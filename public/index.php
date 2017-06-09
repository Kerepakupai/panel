<?php
namespace Panel;

require '../vendor/autoload.php';

use FormulaInterpreter\Compiler;
$indicator = "{var1} * {var2}";



$compiler = new Compiler();
$executable = $compiler->compile('((20 * 3)/30)+5');
$result = $executable->run();

dd($result);


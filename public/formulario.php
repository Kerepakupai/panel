<?php
namespace Panel;

require (__DIR__ . '/../bootstrap/start.php');

// $subject = '(({value1} * {value2}) - {value3}) / 100';
$subject = $_GET['formula'];
$pattern = '~\{([^}]*)\}~';
$vars    = array();

preg_match_all($pattern, $subject, $vars);

return json_encode($vars[1]);
<?php
namespace Panel;

require '../vendor/autoload.php';

use DateTime;
use FormulaInterpreter\Compiler;

weekDays();


if (strtotime('2017-05-20') > strtotime( '2017-05-21' )) {
    dd('Es Mayor!');
} else {
    dd('Es Menor!');
}




// dd('La formula: [' . $string . ']  tiene: ' . $var_count . ' variables y da como resultado: ' . $result . '%');


// dd(convert_min_to_days(540));
convertMinutesToDaysHoursMinutes(61);




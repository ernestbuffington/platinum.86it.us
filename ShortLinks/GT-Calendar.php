<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Calendar.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Calendar&amp;op=ShowMonth&amp;month=([0-9]*)&amp;day=([0-9]*)&amp;year=([0-9]*)'",
"'(?<!/)modules.php\?name=Calendar&amp;op=ShowDay&amp;month=([0-9]*)&amp;day=([0-9]*)&amp;year=([0-9]*)'",
"'(?<!/)modules.php\?name=Calendar&amp;op=ShowDay&amp;day=([0-9]*)&amp;month=([0-9]*)&amp;year=([0-9]*)'",
"'(?<!/)modules.php\?name=Calendar&amp;op=ShowEvent&amp;month=([0-9]*)&amp;day=([0-9]*)&amp;year=([0-9]*)&amp;eventid=([0-9]*)'",
"'(?<!/)modules.php\?name=Calendar&amp;printing=([0-9]*)&amp;day=([0-9]*)&amp;month=([0-9]*)&amp;year=([0-9]*)'",
"'(?<!/)modules.php\?name=Calendar&amp;month=([0-9]*)&amp;year=([0-9]*)'",
"'(?<!/)modules.php\?name=Calendar&amp;op=AddEvent'",
"'(?<!/)modules.php\?name=Calendar&amp;op=SubmitEvent'",
"'(?<!/)modules.php\?name=Calendar'"
);

$urlout = array(
"calendar-showmonth-\\1-\\2-\\3.html",
"calendar-showday-month-\\1-\\2-\\3.html",
"calendar-showday-\\1-\\2-\\3.html",
"calendar-showevent-month-\\1-\\2-\\3-id-\\4.html",
"calendar-print-\\1-\\2-\\3-\\4.html",
"calendar-\\1-\\2.html",
"calendar-addevent.html",
"calendar-submitevent.html",
"calendar.html"
);

?>
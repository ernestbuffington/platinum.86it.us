<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Staff.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Staff;'"
);

$urlout = array(
"staff.html"
);

?>
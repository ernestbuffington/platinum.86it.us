<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Contact.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Contact'"
);

$urlout = array(
"contact.html"
);

?>
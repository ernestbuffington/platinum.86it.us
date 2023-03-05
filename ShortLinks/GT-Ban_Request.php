<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Ban_Request.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Ban_Request;'"
);

$urlout = array(
"banrequest.html"
);

?>
<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Docs.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Docs&amp;file=(about|disclaimer|privacy|terms)'",
"'(?<!/)modules.php\?name=Docs'"
);

$urlout = array(
"\\1.html",
"notice.html"
); 

?>
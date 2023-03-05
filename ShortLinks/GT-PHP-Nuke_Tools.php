<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-PHP-Nuke_Tools.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=PHP-Nuke_Tools'"
);

$urlout = array(
"phpnuketools.html"
);

?>
<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Mailing_List.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Mailing_List&amp;op=MLAction;'",
"'(?<!/)modules.php\?name=Mailing_List;'"
);

$urlout = array(
"mailinglist-action.html",
"mailinglist.html"
);

?>
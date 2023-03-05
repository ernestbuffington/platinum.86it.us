<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Shout_Box.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)'",
"'(?<!/)modules.php\?name=Shout_Box&amp;Action=(Edit|Delete)&amp;shoutID=([0-9]*)&amp;page=([0-9]*)'",
"'(?<!/)modules.php\?name=Shout_Box&amp;page=([0-9]*)'",
"'(?<!/)modules.php\?name=Shout_Box'"
);

$urlout = array(
"userinfo-\\1.html",
"shouthistory-\\1-\\2-\\3.html",
"shouthistory-page-\\1.html",
"shouthistory.html"
);

?>
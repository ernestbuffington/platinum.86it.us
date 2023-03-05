<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Banner_Ads.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Banner_Ads&amp;op=(ClientNew|ClientPassLost)'",
"'(?<!/)modules.php\?name=Banner_Ads'"
);

$urlout = array(
"bannerads-\\1.html",
"bannerads.html"
);

?>
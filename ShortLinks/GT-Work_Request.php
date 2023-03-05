<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Work_Request.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Work_Request&amp;op=WRRequestCommentSubmit&amp;request_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Work_Request&amp;op=WRViewRequest&amp;request_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Work_Request&amp;op=WRRequestSubmit&amp;project_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Work_Request&amp;op=WRViewProject&amp;project_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Work_Request&amp;op=WRProjectRequests'",
"'(?<!/)modules.php\?name=Work_Request&amp;op=WRRequestMap'",
"'(?<!/)modules.php\?name=Work_Request&amp;op=WRViewRequestList'",
"'(?<!/)modules.php\?name=Work_Request'"
);

$urlout = array(
"workrequest-submitcomment-\\1.html",
"workrequest-viewrequest-\\1.html",
"workrequest-submitrequest-\\1.html",
"workrequest-project-\\1.html",
"workrequest-projectrequests.html",
"workrequest-requestmap.html",
"workrequest-requestlist.html",
"workrequest.html"
);

?>
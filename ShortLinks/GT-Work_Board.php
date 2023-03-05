<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Work_Board.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Work_Board&amp;op=WBViewProject&amp;project_id=([0-9]*)&amp;column=(status_id|task_name|priority_id)&amp;direction=(asc|desc)'",
"'(?<!/)modules.php\?name=Work_Board&amp;op=WBTaskMap&amp;column=(status_id|task_name|priority_id)&amp;direction=(asc|desc)'",
"'(?<!/)modules.php\?name=Work_Board&amp;op=WBViewProject&amp;project_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Work_Board&amp;op=WBViewTask&amp;task_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Work_Board&amp;op=WBViewTaskList'",
"'(?<!/)modules.php\?name=Work_Board&amp;op=WBTaskMap'",
"'(?<!/)modules.php\?name=Work_Board'"
);

$urlout = array(
"workboard-project-\\1-\\2-\\3.html",
"workboard-map-\\1-\\2.html",
"workboard-project-\\1.html",
"workboard-task-\\1.html",
"workboard-tasklist.html",
"workboard-map.html",
"workboard.html"
);

?>
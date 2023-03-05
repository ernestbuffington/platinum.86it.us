<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Work_Probe.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Work_Probe&amp;op=WPReportCommentSubmit&amp;report_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Work_Probe&amp;op=WPViewReport&amp;report_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Work_Probe&amp;op=WPReportSubmit&amp;project_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Work_Probe&amp;op=WPViewProject&amp;project_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Work_Probe&amp;op=WPProjectReports'",
"'(?<!/)modules.php\?name=Work_Probe&amp;op=WPReportMap'",
"'(?<!/)modules.php\?name=Work_Probe&amp;op=WPViewReportList'",
"'(?<!/)modules.php\?name=Work_Probe'"
);

$urlout = array(
"workprobe-submitcomment-\\1.html",
"workprobe-viewreport-\\1.html",
"workprobe-submitreport-\\1.html",
"workprobe-project-\\1.html",
"workprobe-projectreports.html",
"workprobe-reportmap.html",
"workprobe-reportlist.html",
"workprobe.html"
);

?>
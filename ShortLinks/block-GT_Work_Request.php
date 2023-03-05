<?php

/********************************************************/
/* NSN Work Request                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/************************************************************************/
/* PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/* Refer to TechGFX.com for detailed information on PHP-Nuke Platinum   */
/*                                                                      */
/* TechGFX: Your dreams, our imagination                                */
/************************************************************************/

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Work_Request.php")) {
    Header("Location: ../index.html");
    die();
}

global $prefix, $db, $bgcolor2;
$modname = "Work_Request";
get_lang($modname);
require_once("modules/$modname/includes/functions.php");
$wr_config = wrget_configs();

$content = "<table align='center' border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
$content .= "<tr>\n";
$content .= "<td bgcolor='$bgcolor2' colspan='2' width=100%><strong>"._WR_PROJECTNAME."</strong></td>\n";
$content .= "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WR_REQUESTS."</strong></nobr></td>\n";
$content .= "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WR_LASTSUBMISSION."</strong></nobr></td>\n";
$content .= "</tr>\n";
$projectresult = $db->sql_query("SELECT project_id FROM ".$prefix."_nsnwb_projects WHERE featured='1' ORDER BY project_name");
while (list($project_id) = $db->sql_fetchrow($projectresult)) {
    $project = wrproject_info($project_id);
    $wrimage = wrimage2("project.png", $modname);
    $content .= "<tr>\n<td align='center'><img src='$wrimage'></td>\n<td width='100%'>".$project['project_name']."</td>\n";
    $requestnumber = $db->sql_numrows($db->sql_query("SELECT request_id FROM ".$prefix."_nsnwr_requests WHERE project_id='$project_id'"));
    $content .= "<td align='center'><a href='workrequest-project-$project_id.html'>$requestnumber</a></td>\n";
    $lastresult = $db->sql_query("SELECT date_submitted FROM ".$prefix."_nsnwr_requests WHERE project_id='$project_id' ORDER BY date_submitted DESC LIMIT 1");
    if($db->sql_numrows($lastresult) == 0){
        $date_submitted = _WR_NA;
    } else {
        list($date_submitted) = $db->sql_fetchrow($lastresult);
        $date_submitted = date($wr_config['request_date_format'], $date_submitted);
    }
    $content .= "<td align='center'><nobr>$date_submitted</nobr></td>\n</tr>\n";
}
$content .=  "</table>\n";

?>
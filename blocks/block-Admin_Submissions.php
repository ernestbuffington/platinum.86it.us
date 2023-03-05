<?php
/************************************************************************/
/* TechGFX Administrator Submissions Block           VERSION 1.0.0 BETA */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */ 
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to PlatinumNukePro.com for detailed information on PNPro*/
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */
/* Compliance fix 042511 DH                               				*/ 
/************************************************************************/
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $admin, $prefix, $db, $admin_file;
if (is_admin($admin)) {
$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_queue"));
$content .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\"><tr><td><strong>"._ASNR."</strong></td></tr>";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=submissions\">"._SUBMISSIONS."</a>: <strong>$num</strong></td></tr>\n";
$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_reviews_pend"));
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=reviews\">"._WREVIEWS."</a>: <strong>$num</strong></td></tr>\n";
$content .= "<tr><td><strong>"._CALENDAR."</strong></td></tr>\n";
$numwaitevents = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_calendar_events WHERE isapproved='0'"));
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=Calendar\">"._NUMWAITINGEVENTS."</a>: <strong>$numwaitevents</strong></td></tr>\n";
$content .= "<tr><td><strong>"._UDOWNLOADS."</strong></td></tr>\n";
$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_newdownload"));
$brokend = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_modrequest WHERE brokendownload='1'"));
$modreqd = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_modrequest WHERE brokendownload='0'"));
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=DownloadsListBrokenDownloads\">"._BROKENDOWN."</a>: <strong>$brokend</strong></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=downloads\">"._UDOWNLOADS."</a>: <strong>$num</strong></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=DownloadsListModRequests\">"._MODREQDOWN."</a>: <strong>$modreqd</strong></td></tr>\n";
$content .= "<tr><td><strong>"._ASNSNSUP."</strong></td></tr>\n";
//$supact = $db->sql_numrows($db->sql_query("select * FROM ".$prefix."_nsnsp_sites WHERE site_status='1'"));
$suppen = $db->sql_numrows($db->sql_query("select * FROM ".$prefix."_nsnsp_sites WHERE site_status='0'"));
//$supdea = $db->sql_numrows($db->sql_query("select * FROM ".$prefix."_nsnsp_sites WHERE site_status='-1'"));
//$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=SPActive\">"._ASUPPORT."</a>: <strong>$supact</strong></TD></TR>\n";
//$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=SPInactive\">"._DSUPPORT."</a>: <strong>$supdea</strong></TD></TR>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=SPPending\">"._WSUPPORT."</a>: <strong>$suppen</strong></td></tr>\n";
$content .= "<tr><td><strong>"._ASNSNSUP2."</strong></td></tr>\n";
//$supact = $db->sql_numrows($db->sql_query("select * FROM ".$prefix."_nsnsp_2_sites WHERE site_status='1'"));
//$suppen = $db->sql_numrows($db->sql_query("select * FROM ".$prefix."_nsnsp_2_sites WHERE site_status='0'"));
$supdea = $db->sql_numrows($db->sql_query("select * FROM ".$prefix."_nsnsp_2_sites WHERE site_status='-1'"));
//$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=Supporters_2active_2\">"._ASUPPORT."</a>: <strong>$supact</strong></TD></TR>\n";
//$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=Supporters_2inactive_2\">"._DSUPPORT."</a>: <strong>$supdea</strong></TD></TR>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=Supporters_2pending_2\">"._WSUPPORT."</a>: <strong>$suppen</strong></td></tr>\n";
$content .= "<tr><td><strong>"._ASUNI."</strong></td></tr>\n";
$numwaiting = $db->sql_numrows($db->sql_query("SELECT id from ".$prefix."_universal_queue"));
$numrequestwaiting = $db->sql_numrows($db->sql_query("SELECT id from ".$prefix."_universal_requests where approved = '0'"));
$nummodrequestwaiting = $db->sql_numrows($db->sql_query("SELECT id from ".$prefix."_universal_modify"));
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=Universal&amp;file=admin&amp;op=ItemQueue\">"._ASUNIWI."</a>: <strong>$numwaiting</strong></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=Universal&amp;file=admin&amp;op=WaitingMods\">"._ASUNIWM."</a>: <strong>$nummodrequestwaiting</strong></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=Universal&amp;file=admin&amp;op=requestadmin\">"._ASUNIWR."</a>: <strong>$numrequestwaiting</strong></td></tr>\n";
$content .= "<tr><td><strong>"._ASWL."</strong></td></tr>\n";
$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_newlink"));
$brokenl = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_modrequest WHERE brokenlink='1'"));
$modreql = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_modrequest WHERE brokenlink='0'"));
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=LinksListBrokenLinks\">"._BROKENLINKS."</a>: <strong>$brokenl</strong></td></tr>\n";

$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=LinksListModRequests\">"._MODREQLINKS."</a>: <strong>$modreql</strong></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=Links\">"._WLINKS."</a>: <strong>$num</strong></td></tr>\n";
$content .= "<tr><td><strong>"._CLASS1."</strong></td></tr>\n";
$num = $db->sql_numrows($db->sql_query("SELECT * FROM nukec30_ads_ads WHERE active='0'"));
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=NukeC30\">"._CLASSIFIEDS."</a>:<strong> $num</strong></td></tr>\n";
$content .= "</table>";
} else {
$content .="<center>Access Denied</center>";
}
?>

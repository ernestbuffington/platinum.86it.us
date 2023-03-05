<?php

/******************************************************/
/* ================================                   */
/* Enhanced Downloads Module - V3.0                   */
/* ================================                   */
/*                                                    */
/* Released: January, 8 2017                          */
/* Modified by w2ibc http://www.w2ibc.com             */
/* w2ibc@w2ibc.com                                    */
/*                                                    */
/* ================================                   */
/* Enhanced Downloads Module - V2.1                   */
/* ================================                   */
/*                                                    */
/* Released: January, 14 2003                         */
/* Copyright (c) 2003 by Shawn Archer                 */
/* shawn@nukestyles.com                               */
/* http://www.NukeStyles.com                          */
/*                                                    */
/******************************************************/
/*                                                    */
/* Copyright Notice:                                  */
/* =================                                  */
/*                                                    */
/* Francisco Burzi & the Nuke credits MUST            */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Downloads'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
		$auth_user = 1;
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
	
include_once("admin/modules/NukeStyles/EDL/ns_edl_functions.php");
include_once("admin/modules/NukeStyles/EDL/ns_edl_language.php");

function ns_edl_recom() {
global $prefix, $db, $bgcolor2, $admin_file;
ns_edl_top("recom");
$result = $db->sql_query("SELECT ns_dl_rec, ns_dl_rec_num, ns_dl_rec_msg, ns_dl_rec_stats, ns_dl_rec_stats_user, ns_dl_rec_email, ns_dl_rec_subject from ".$prefix."_ns_downloads_recommend");
list($ns_dl_rec, $ns_dl_rec_num, $ns_dl_rec_msg, $ns_dl_rec_stats, $ns_dl_rec_stats_user, $ns_dl_rec_email, $ns_dl_rec_subject) = $db->sql_fetchrow($result);
ns_dl_OpenTable();
echo "<center><font class=\"title\">"._NSDLRECOMSETTINGS."</font></center>";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"tabledesign\">";
echo "<br />";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"right\"><strong>"._NSDLALLOWRECOM.":</strong></td>";
echo "<td align=\"left\" width=\"40%\">";
    if ($ns_dl_rec == 1) {	
		echo "<input type=\"radio\" name=\"ns_dl_rec\" value=\"1\" checked> "._NSYES." &nbsp;";
		echo "<input type=\"radio\" name=\"ns_dl_rec\" value=\"0\"> "._NSNO."";
    } else {	
		echo "<input type=\"radio\" name=\"ns_dl_rec\" value=\"1\"> "._NSYES." &nbsp;";
		echo "<input type=\"radio\" name=\"ns_dl_rec\" value=\"0\" checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\"><font class=\"tiny\">";
echo ""._NSDLDESIMAGE3."</font><br />";
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br /><hr color=\"$bgcolor2\" width=\"80%\"><br /></td></tr>";
    if ($ns_dl_rec_num == "1") {
		$sel1 = "selected";
		$sel2 = "";
		$sel3 = "";
		$sel4 = "";
		$sel5 = "";
    } elseif ($ns_dl_rec_num == "2") {
		$sel1 = "";
		$sel2 = "selected";
		$sel3 = "";
		$sel4 = "";
		$sel5 = "";
    } elseif ($ns_dl_rec_num == "3") {
		$sel1 = "";
		$sel2 = "";
		$sel3 = "selected";
		$sel4 = "";
		$sel5 = "";
    } elseif ($ns_dl_rec_num == "4") {
		$sel1 = "";
		$sel2 = "";
		$sel3 = "";
		$sel4 = "selected";
		$sel5 = "";
    } elseif ($ns_dl_rec_num == "5") {
		$sel1 = "";
		$sel2 = "";
		$sel3 = "";
		$sel4 = "";
		$sel5 = "selected";
    } 
echo "<tr><td align=\"right\">"._NSDLNUMRECOMBOXES.":</td>";
echo "<td align=\"left\" width=\"40%\"><select name=\"ns_dl_rec_num\">";
echo "<option value=\"1\" $sel1>&nbsp;1</option>";
echo "<option value=\"2\" $sel2>&nbsp;2</option>";
echo "<option value=\"3\" $sel3>&nbsp;3</option>";
echo "<option value=\"4\" $sel4>&nbsp;4</option>";
echo "<option value=\"5\" $sel5>&nbsp;5</option>";
echo "</select>";
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLALLOWRECMSG.":</td>";
echo "<td align=\"left\" width=\"40%\">";
    if ($ns_dl_rec_msg == 1) {	
		echo "<input type='radio' name='ns_dl_rec_msg' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_rec_msg' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_rec_msg' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_rec_msg' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLKEEPRECOMSTATS.":</td>";
echo "<td align=\"left\" width=\"40%\">";
    if ($ns_dl_rec_stats == 1) {	
		echo "<input type='radio' name='ns_dl_rec_stats' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_rec_stats' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_rec_stats' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_rec_stats' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLSHOWUSERRECOMSTATS.":</td>";
echo "<td align=\"left\" width=\"40%\">";
    if ($ns_dl_rec_stats_user == 1) {	
		echo "<input type='radio' name='ns_dl_rec_stats_user' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_rec_stats_user' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_rec_stats_user' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_rec_stats_user' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
    if (($ns_dl_rec == 1) && ($ns_dl_rec_stats == 1)) {
		echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
		echo "<tr><td colspan=\"2\" align=\"center\">";
		echo "[ <a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=dload#recstats\">";
		echo ""._NSDLVIEWRECDSTATS."</a> ] - [ ";
		echo "<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=ruser#recstats\">";
		echo ""._NSDLTOPREFERRERS."</a> ]</td></tr>";
	}
echo "<tr><td colspan=\"2\"><br /><hr color=\"$bgcolor2\" width=\"80%\"><br /></td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">"._NSDLRECOMEMAILSUB.":</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<input type=\"text\" name=\"ns_dl_rec_subject\" value=\"$ns_dl_rec_subject\" ";
echo "size=\"80\" maxlength=\"255\">";
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">"._NSDLRECOMEMAILMSG.":</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<textarea name=\"ns_dl_rec_email\" cols=\"80\" rows=\"15\">";
echo "".stripslashes($ns_dl_rec_email)."</textarea>";
echo "</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">"._NSDLRECOMEMAILMSG2."</td></tr>";
echo "</table><br /><br />";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><input type=\"hidden\" name=\"op\" value=\"ns_edl_recom_save\">";
echo "<center><input type=\"submit\" name=\"submit\" value=\"Save Changes\"></center>";
echo "<br />";
ns_dl_CloseTable();
echo "</form>";
ns_edl_bottom(); 
}

function ns_edl_recom_astats($type, $list) {
global $prefix, $db, $admin_file;
ns_edl_top("recstats");
ns_dl_OpenTable();
echo "<center><font class=\"title\">"._NSDLRECOMSETTINGS."</font></center>";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" align=\"center\" width=\"95%\">";
	if ($type == "dload") {
		if (!$list) {
			$list = "ns_dl_rec_num desc";
		} elseif ($list == "numup") {
			$list = "ns_dl_rec_num desc";
		} elseif ($list == "numdn") {
			$list = "ns_dl_rec_num asc";
		} elseif ($list == "dtitlea") {
			$list = "ns_dl_rec_title desc";
		} elseif ($list == "dtitlez") {
			$list = "ns_dl_rec_title asc";
		} elseif ($list == "dlidup") {
			$list = "lid desc";
		} elseif ($list == "dliddn") {
			$list = "lid asc";
		}
		echo "<tr><td colspan=\"3\" align=\"center\"><strong>"._NSDLTOPRECOMDL."</strong></td></tr>";
		echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
		echo "<tr><td align=\"left\"><strong><u>"._NSDLRECDLID."</u></strong>&nbsp;";
		echo "<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=dload&amp;list=dlidup#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._NSDLRECREFNAMEA."\">";
		echo "</span></a>&nbsp;<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=dload&amp;list=dliddn#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._NSDLRECREFNAMEZ."\">";
		echo "</span></a></td>";
		echo "<td align=\"left\"><strong><u>"._NSDLRECDLTITLE."</u></strong>&nbsp;";
		echo "<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=dload&amp;list=dtitlez#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._NSDLRECREFNUMM."\">";
		echo "</span></a>&nbsp;<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=dload&amp;list=dtitlea#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._NSDLRECREFNUML."\">";
		echo "</span></a></td>";
		echo "<td align=\"center\"><strong><u>"._NSDLRECDLNUM."</u></strong>&nbsp;";
		echo "<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=dload&amp;list=numup#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._NSDLRECREFIPH."\">";
		echo "</span></a>&nbsp;<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=dload&amp;list=numdn#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._NSDLRECREFIPL."\">";
		echo "</span></a></td></tr>";
		$result = $db->sql_query("select * from ".$prefix."_ns_downloads_recom_dlstats order by $list");
		if ($db->sql_numrows($result) > 0) {
			while(list($rdid, $lid, $ns_dl_rec_title, $ns_dl_rec_num) = $db->sql_fetchrow($result)) {
				echo "<tr><td align=\"left\">&nbsp;$lid</td>";
				echo "<td align=\"left\"><a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\">";
				echo "$ns_dl_rec_title</a></td>";
				echo "<td align=\"center\">$ns_dl_rec_num</td></tr>";
			}
		} else {
			echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
			echo "<tr><td colspan=\"3\" align=\"center\"><strong>"._NSDLNORECOMDL."</strong></td></tr>";
			echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
		}
		echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
		echo "<tr><td colspan=\"3\" align=\"center\">";
		echo "[ <a href=\"".$admin_file.".php?op=ns_edl_recom#recom\">";
		echo ""._NSDLRECMAIN."</a> ] - [ ";
		echo "<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=ruser#recstats\">";
		echo ""._NSDLTOPREFERRERS."</a> ] - [ ";
		echo "<a href=\"".$admin_file.".php?op=ns_edl_recom_stats_purge&amp;type=dload#recstats\">";
		echo ""._NSDLPURGESTATS."</a> ]</td></tr>";
		echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
	} elseif ($type == "ruser") {
		if (!$list) {
			$list = "ns_dl_rec_rnum desc";
		} elseif ($list == "rnumup") {
			$list = "ns_dl_rec_rnum desc";
		} elseif ($list == "rnumdn") {
			$list = "ns_dl_rec_rnum asc";
		} elseif ($list == "rnamea") {
			$list = "ns_dl_rec_rname desc";
		} elseif ($list == "rnamez") {
			$list = "ns_dl_rec_rname asc";
		} elseif ($list == "ripup") {
			$list = "ns_dl_rec_uip desc";
		} elseif ($list == "ripdn") {
			$list = "ns_dl_rec_uip asc";
		}
		echo "<tr><td colspan=\"3\" align=\"center\"><strong>"._NSDLTOPREFERRERS."</strong></td></tr>";
		echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
		echo "<tr><td align=\"left\"><strong><u>"._NSDLRECREFNAME."</u></strong>&nbsp;";
		echo "<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=ruser&amp;list=rnamez#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._NSDLRECREFNAMEA."\">";
		echo "</span></a>&nbsp;<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=ruser&amp;list=rnamea#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._NSDLRECREFNAMEZ."\">";
		echo "</span></a></td>";
		echo "<td align=\"center\"><strong><u>"._NSDLRECREFNUM."</u></strong>&nbsp;";
		echo "<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=ruser&amp;list=rnumup#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._NSDLRECREFNUMM."\">";
		echo "</span></a>&nbsp;<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=ruser&amp;list=rnumdn#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._NSDLRECREFNUML."\">";
		echo "</span></a></td>";
		echo "<td align=\"center\"><strong><u>"._NSDLRECREFIP."</u></strong>&nbsp;";
		echo "<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=ruser&amp;list=ripup#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._NSDLRECREFIPH."\">";
		echo "</span></a>&nbsp;<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=ruser&amp;list=ripdn#recstats\">";
		echo "<span style=\"vertical-align=-20%\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._NSDLRECREFIPL."\">";
		echo "</span></a></td></tr>";
		$result4 = $db->sql_query("select * from ".$prefix."_ns_downloads_recom_usrstats order by $list");
		if ($db->sql_numrows($result4) > 0) {
			while(list($rduid, $rdid, $ulid, $ns_dl_rec_rname, $ns_dl_rec_remail, $ns_dl_rec_uip, $ns_dl_rec_rnum) = $db->sql_fetchrow($result4)) {
				echo "<tr><td align=\"left\">$ns_dl_rec_rname</td>";
				echo "<td align=\"center\">$ns_dl_rec_rnum</td>";
				echo "<td align=\"center\">$ns_dl_rec_uip</td></tr>";
			}
		} else {
			echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
			echo "<tr><td colspan=\"3\" align=\"center\"><strong>"._NSDLNORECOMDL."</strong></td></tr>";
			echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
		}
		echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
		echo "<tr><td colspan=\"3\" align=\"center\">";
		echo "[ <a href=\"".$admin_file.".php?op=ns_edl_recom#recom\">";
		echo ""._NSDLRECMAIN."</a> ] - [ ";
		echo "<a href=\"".$admin_file.".php?op=ns_edl_recom_astats&amp;type=dload#recstats\">";
		echo ""._NSDLVIEWRECDSTATS."</a> ] - [ ";
		echo "<a href=\"".$admin_file.".php?op=ns_edl_recom_stats_purge&amp;type=ruser#recstats\">";
		echo ""._NSDLPURGESTATS."</a> ]</td></tr>";
		echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
	}
echo "</table>";
ns_dl_CloseTable();
ns_edl_bottom(); 
}

function ns_edl_recom_save($ns_dl_rec, $ns_dl_rec_num, $ns_dl_rec_msg, $ns_dl_rec_stats, $ns_dl_rec_stats_user, $ns_dl_rec_email, $ns_dl_rec_subject) {
global $prefix, $db, $admin_file;
	if ($ns_dl_rec_stats == 0) {
		$ns_dl_rec_stats_user = 0;
	}
$db->sql_query("update ".$prefix."_ns_downloads_recommend set ns_dl_rec='$ns_dl_rec', ns_dl_rec_num='$ns_dl_rec_num', ns_dl_rec_msg='$ns_dl_rec_msg', ns_dl_rec_stats='$ns_dl_rec_stats', ns_dl_rec_stats_user='$ns_dl_rec_stats_user', ns_dl_rec_email='$ns_dl_rec_email', ns_dl_rec_subject='$ns_dl_rec_subject'");
Header("Location: ".$admin_file.".php?op=ns_edl_recom#recom");
}

function ns_edl_recom_stats_purge($type, $confirm = "no") {
global $prefix, $db, $admin_file;
	if ($confirm == "yes") {
		if ($type == "dload") {
			$db->sql_query("delete from ".$prefix."_ns_downloads_recom_dlstats");
		} elseif ($type == "ruser") {
			$db->sql_query("delete from ".$prefix."_ns_downloads_recom_usrstats");
		}
		Header("Location: ".$admin_file.".php?op=ns_edl_recom#recom");
	} else {
		ns_edl_top("recstats");
		ns_dl_OpenTable();
		echo "<center><font class=\"title\">"._NSDLRECOMSETTINGS."</font></center>";
		ns_dl_CloseTable();
		ns_dl_OpenTable();   
		echo "<center><br /><br />";
			if ($type == "dload") {
				echo "<strong>"._NSDLSUREPURGESTATSD."</strong>";
			} elseif ($type == "ruser") {
				echo "<strong>"._NSDLSUREPURGESTATSU."</strong>";
			}
		echo "<br /><br /><br />";
    	echo "<input type=\"button\" value=\""._NSBYES."\" title=\""._NSYES."\" ";
    	echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_recom_stats_purge";
    	echo "&amp;type=$type&amp;confirm=yes'\">&nbsp;&nbsp;";
    	echo "<input type=\"button\" value=\""._NSBNO."\" title=\""._NSNO."\" ";
    	echo "onClick=\"window.location='javascript:history.go(-1)'\">";
		echo "</center><br /><br />";    
		ns_dl_CloseTable();
		ns_edl_bottom(); 
	}
}

switch($op) {

    case "ns_edl_recom":
    ns_edl_recom();
    break;

    case "ns_edl_recom_astats":
    ns_edl_recom_astats($type, $list);
    break;

    case "ns_edl_recom_stats_purge":
    ns_edl_recom_stats_purge($type, $confirm);
    break;

    case "ns_edl_recom_save":
    ns_edl_recom_save($ns_dl_rec, $ns_dl_rec_num, $ns_dl_rec_msg, $ns_dl_rec_stats, $ns_dl_rec_stats_user, $ns_dl_rec_email, $ns_dl_rec_subject);
    break;

}

} else {
echo "Access Denied";
}

?>
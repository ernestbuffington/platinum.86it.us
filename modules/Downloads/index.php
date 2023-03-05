<?php
/***********************************************************************/
/*wysiwyg editor and dbi conversion added/completed by DocHaVoC#0003262012*/
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = " - $module_name";
require_once("modules/$module_name/ns_downloads_file.php");
require_once("modules/$module_name/ns_fields_file.php");
ns_dl_right_blocks();	
$ns_theme = get_theme();


function getparent($parentid,$title) {
    global $prefix, $db;
    $result = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories where cid=$parentid");
    list($cid, $ptitle, $pparentid) = $db->sql_fetchrow($result);
    $cid = intval($cid);
    if ($ptitle!="") $title=$ptitle." / ".$title;
    if ($pparentid!=0) {
	$title=getparent($pparentid,$title);
    }
    return $title;
}



function getparentlink($parentid,$title) {
    global $prefix, $db, $module_name;
    $result = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories where cid='$parentid'");
    list($cid, $ptitle, $pparentid) = $db->sql_fetchrow($result);
    $cid = intval($cid);
    if ($ptitle!="") $title="<a href=modules.php?name=$module_name&d_op=viewdownload&cid=$cid>$ptitle</a> / ".$title;
    if ($pparentid!=0) {
    	$title=getparentlink($pparentid,$title);
    }
    return $title;
}



function menu($maindownload) {
global $prefix, $db, $user, $module_name;
$result_ns = $db->sql_query("select ns_dl_add from ".$prefix."_ns_downloads_add_modify");
list($ns_dl_add) = $db->sql_fetchrow($result_ns);
ns_download_mod_title();
OpenTable();
//ns_dl_OpenTable();
$result_mn = $db->sql_query("select ns_dl_main_note, ns_dl_main_note_show from ".$prefix."_ns_downloads_general");
list($ns_dl_main_note, $ns_dl_main_note_show) = $db->sql_fetchrow($result_mn);
$ns_dl_main_note = stripslashes($ns_dl_main_note);
if ($ns_dl_main_note != "") {
    if ($ns_dl_main_note_show == 0 && $maindownload == 0) {
    	echo "<br /><div align=\"justify\"><font class=\"content\">$ns_dl_main_note</font><div><br />";
    } elseif ($ns_dl_main_note_show == 1) {
    	echo "<br /><div align=\"justify\"><font class=\"content\">$ns_dl_main_note</font><div><br />";
    }
}	
echo "<br /><center><form action=\"modules.php?name=$module_name&d_op=search";
echo "#searchresults\" method=\"post\">";
echo "<center><input type=\"text\" size=\"25\" name=\"query\"> ";
echo "<input type=\"submit\" name=\"submit\" value=\""._SEARCH."\" title=\""._SEARCH."\">";
echo "</center></form><br />";
ns_dl_OpenTable();
echo "<center>";
ns_download_menu($maindownload, $ns_dl_add);
echo "</center>";
ns_dl_CloseTable();
CloseTable();
}



function downloadinfomenu($cid, $lid, $ttitle) {
$cid = intval($cid);
$lid = intval($lid);
global $module_name, $prefix, $db, $user, $ns_details, $ns_comments, $ns_editorial, $ns_recommend;
$result = $db->sql_query("select totalcomments from ".$prefix."_downloads_downloads where lid='$lid'");
list($totalcomments) = $db->sql_fetchrow($result);
$result_ed = $db->sql_query("select * from ".$prefix."_downloads_editorials where downloadid = $lid");
$ed_exist = $db->sql_numrows($result_ed);
$totalcomments = intval($totalcomments);
echo "<br /><center><font class=\"content\">";
echo "[ <a href=\"javascript:history.go(-1)\">"._NSDLGOBACK."</a> ] - ";
	if ($totalcomments > 0) {
    	if ($ns_comments > 0) {
    		echo "[ <a href=\"modules.php?name=$module_name&d_op=viewdownloadcomments";
    		echo "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$ttitle#dlcom\">"._DOWNLOADCOMMENTS."</a> ] - ";
    	}
	}
	if ($ns_details > 0) {
		echo "[ <a href=\"modules.php?name=$module_name&d_op=viewdownloaddetails";
		echo "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$ttitle#dldetails\">"._DETAILS."</a> ] - ";
	}
	if (($ns_editorial > 0) && ($ed_exist)) {
		echo "[ <a href=\"modules.php?name=$module_name&d_op=viewdownloadeditorial";
		echo "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$ttitle#dlreview\">"._EDITORIAL."</a> ] - ";
	}
	if ($ns_recommend > 0) {
		echo "[ <a href=\"modules.php?name=$module_name&amp;d_op=ns_dl_rec_dl&amp;cid=$cid";
		echo "&amp;lid=$lid&amp;ttitle=$ttitle#recom\">"._NSDLFOOTREC."</a> ] - ";
	}
echo "[ <a href=\"modules.php?name=$module_name&d_op=modifydownloadrequest";
echo "&amp;lid=$lid#mod\">"._MODIFY."</a> ] - ";
echo "[ <a href=\"modules.php?name=$module_name&d_op=brokendownload";
echo "&amp;lid=$lid#reportbroken\">"._REPORTBROKEN."</a> ]</font></center>";
}



function index() {
global $prefix, $db, $module_name, $regdownload, $user;
$result_gen = $db->sql_query("select ns_dl_show_sub_cats, ns_dl_show_num, ns_dl_show_full from ".$prefix."_ns_downloads_general");
list($ns_dl_show_sub_cats, $ns_dl_show_num, $ns_dl_show_full) = $db->sql_fetchrow($result_gen);
$result_ft = $db->sql_query("select fdid from ".$prefix."_ns_downloads_nfeatured");
$ns_featured = $db->sql_numrows($result_ft);
$fdid = intval($fdid);
$result_sc = $db->sql_query("select ns_dl_empty_cat from ".$prefix."_ns_downloads_general");
list($ns_dl_empty_cat) = $db->sql_fetchrow($result_sc);
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
    menu($maindownload = 0);
	if ($ns_featured > 0) {
		require_once("modules/$module_name/ns_featured_file.php");
		ns_dl_main_feat_list();
	}
    ns_mod_title3("main_categories",""._DOWNLOADSMAINCAT."");    
    OpenTable();
//   ns_dl_OpenTable();
    echo "<br /><br />";

    echo "<table width=\"90%\" border=\"0\" cellspacing=\"5\" ";
    echo "cellpadding=\"0\" align=\"center\"><tr>";
    $result = $db->sql_query("select cid, title, cdescription from ".$prefix."_downloads_categories where parentid=0 order by title");
    $count = 0;
    while(list($cid, $title, $cdescription) = $db->sql_fetchrow($result)) {
                $cid = intval($cid);
		$cnumm = "";
	if ($ns_dl_show_num == 1) {
	    $cresult = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid' && ns_disable='0'");
	    $cnumrows = $db->sql_numrows($cresult);
            if ($cnumrows < 1) {
            $cnumrows = 0;
            }
			if($cnumrows>0){
	    		$cnumm = "&nbsp;<font class=\"content\"><strong>($cnumrows)</strong><br /></font>";
			}
	} else {
	    $cnumm = "";
	}
	echo "<td width=\"50%\" valign=\"top\">";
	echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
	echo "<tr><td align=\"right\" valign=\"top\">";
	ns_dl_cat_image();
	echo "</td><td align=\"left\">";
	echo "<a href=\"modules.php?name=$module_name&d_op=viewdownload";
	echo "&amp;cid=$cid#cat\"><br />$title</a>$cnumm";
	categorynewdownloadgraphic($cid);
	echo "</td></tr>";
	if ($cdescription) {
	    echo "<tr><td align=\"right\">&nbsp;</td><td>";
	    echo "<div align=\"justify\"><font class=\"content\"><br />$cdescription<br /></font></div>";
	    echo "</td></tr>";
	} else {
	    echo "";
	}
	echo "</table>";
    if ($ns_dl_show_sub_cats == 1) {
	$result2 = $db->sql_query("select cid, title from ".$prefix."_downloads_categories where parentid=$cid order by title limit 0,6");
	$space = 0;
	while(list($cid, $stitle) = $db->sql_fetchrow($result2)) {
                $cid = intval($cid);
		$cnum = "";
	if ($space == 0) {
	    echo "";
	}
    	    if ($space > 0) {
		    echo "";
	        }
            if ($ns_dl_show_num == 1) {
		    $cresult2 = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid' && ns_disable='0'");
        	$cnumrows2 = $db->sql_numrows($cresult2);
        	if ($cnumrows2 < 1) {
        	$cnumrows2 = 0;
        	}
			if($cnumrows2 > 0){
				$cnum = "&nbsp;<font class=\"content\"><strong>($cnumrows2)</strong></font>";
			}
	    } else {
		$cnum = "";
	    }
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td align=\"right\" valign=\"top\">&nbsp;&nbsp;&nbsp;";
		ns_dl_subcat_image();
		echo "</td><td align=\"left\">";
		echo "<a href=\"modules.php?name=$module_name";
		echo "&d_op=viewdownload&amp;cid=$cid#cat\">$stitle</a>$cnum";
		echo "</td></tr></table>";
	    $space++;
	}
    }
	if ($count < 1) {
	    echo "</td><td>&nbsp;&nbsp;&nbsp;</td>";
	    $dum = 1;
	}
	$count++;
	if ($count == 2) {
	    echo "</td></tr><tr><td>&nbsp;</td></tr><tr>";
	    $count = 0;
	    $dum = 0;
	}
    }
    if ($dum == 1) {
	echo "</tr></table>";
    } elseif ($dum == 0) {
	echo "<td>&nbsp;</td></tr></table>";
    }

/*
    echo "<table width=\"90%\" border=\"0\" cellspacing=\"5\" ";
    echo "cellpadding=\"0\" align=\"center\"><tr>";

    $result = $db->sql_query("select cid, title, cdescription from ".$prefix."_downloads_categories where parentid=0 order by title");
    $count = 0;
    while(list($cid, $title, $cdescription) = $db->sql_fetchrow($result)) {
    $cid = intval($cid);
	$cnumm = "";
	if ($ns_dl_show_num == 1) {
		$ns_view_dis = ns_dl_admin_view(2);
	    $cresult = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid' $ns_view_dis");
	    $cnumrows = $db->sql_numrows($cresult);
        if ($cnumrows < 1) {
            $cnumrows = 0;
        }
		if($cnumrows>0){
	    	$cnumm = "&nbsp;<font class=\"content\"><strong>($cnumrows)</strong></font>";
		}
	} else {
	    $cnumm = "";
	}



	if ($ns_dl_empty_cat == 1) {


		echo "<td width=\"50%\" valign=\"top\">";
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td align=\"right\" valign=\"top\">";
		ns_dl_cat_image();
		echo "</td><td align=\"left\">";
		echo "<a href=\"modules.php?name=$module_name&d_op=viewdownload";
		echo "&amp;cid=$cid#cat\">$title</a>$cnumm";
		categorynewdownloadgraphic($cid);
		echo "</td></tr>";
		if ($cdescription) {
	    	echo "<tr><td align=\"right\">&nbsp;</td><td>";		
	    	echo "<div align=\"justify\"><font class=\"content\">$cdescription</font></div>";
	    	echo "</td></tr>";


		} else {
	    	echo "";
		}

echo "</table>";



	} else if ($cnumrows > 0) {



		echo "<td width=\"50%\" valign=\"top\">";
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td align=\"right\" valign=\"top\">";
		ns_dl_cat_image();
		echo "</td><td align=\"left\">";
		echo "<a href=\"modules.php?name=$module_name&d_op=viewdownload";
		echo "&amp;cid=$cid#cat\">$title</a>$cnumm";
		categorynewdownloadgraphic($cid);
		echo "</td></tr>";
		if ($cdescription) {
	    	echo "<tr><td align=\"right\">&nbsp;</td><td>";		
	    	echo "<div align=\"justify\"><font class=\"content\">$cdescription</font></div>";
	    	echo "</td></tr>";



		} else {
	    	echo "";
		}
echo "</table>";


	}


//echo "</td></tr></table>";


	echo "<td width=\"50%\" valign=\"top\">";
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	echo "<tr><td align=\"right\" valign=\"top\">";
	ns_dl_cat_image();
	echo "</td><td align=\"left\">";
	echo "<a href=\"modules.php?name=$module_name&d_op=viewdownload";
	echo "&amp;cid=$cid#cat\">$title</a>$cnumm";
	categorynewdownloadgraphic($cid);
	echo "</td></tr>";
	if ($cdescription) {
	    echo "<tr><td align=\"right\">&nbsp;</td><td>";		
	    echo "<div align=\"justify\"><font class=\"content\">$cdescription</font></div>";
	    echo "</td></tr>";
	} else {
	    echo "";
	}
	echo "</table>";




    if ($ns_dl_show_sub_cats == 1) {
	$result2 = $db->sql_query("select cid, title from ".$prefix."_downloads_categories where parentid=$cid order by title limit 0,6");
	$space = 0;
	while(list($cid, $stitle) = $db->sql_fetchrow($result2)) {
    $cid = intval($cid);
	$cnum = "";
	if ($space == 0) {
	    echo "";
	}
    	if ($space > 0) {
		    echo "";
	    }
        if ($ns_dl_show_num == 1) {
		$ns_view_dis = ns_dl_admin_view(2);
		$cresult2 = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid' $ns_view_dis");
        $cnumrows2 = $db->sql_numrows($cresult2);
        	if ($cnumrows2 < 1) {
        		$cnumrows2 = 0;
        	}
			if($cnumrows2 > 0){
				$cnum = "&nbsp;<font class=\"content\"><strong>($cnumrows2)</strong></font>";
			}
	    } else {
			$cnum = "";
	    }
			if ($ns_dl_empty_cat == 1) {
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td align=\"right\" valign=\"top\">&nbsp;&nbsp;&nbsp;";
		ns_dl_subcat_image();
		echo "</td><td align=\"left\">";
		echo "<a href=\"modules.php?name=$module_name";
		echo "&d_op=viewdownload&amp;cid=$cid#cat\">$stitle</a>$cnum";
		echo "</td></tr></table>";
			} else {
				if ($cnumrows2 > 0) {
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td align=\"right\" valign=\"top\">&nbsp;&nbsp;&nbsp;";
		ns_dl_subcat_image();
		echo "</td><td align=\"left\">";
		echo "<a href=\"modules.php?name=$module_name";
		echo "&d_op=viewdownload&amp;cid=$cid#cat\">$stitle</a>$cnum";
		echo "</td></tr></table>";
				}
			}
	    $space++;
		}
    }
	if ($count < 1) {
	    echo "</td><td>&nbsp;&nbsp;&nbsp;</td>";
	    $dum = 1;
	}
	$count++;
		if ($count == 2) {
	    	echo "</td></tr><tr><td>&nbsp;</td></tr><tr>";
	    	$count = 0;
	    	$dum = 0;
		}
    }
    if ($dum == 1) {
		echo "</tr></table>";
    } elseif ($dum == 0) {
		echo "<td>&nbsp;</td></tr></table>";
    }

*/

    echo "<br />";
	$ns_view_dis = ns_dl_admin_view(1);
    $result = $db->sql_query("select * from ".$prefix."_downloads_downloads $ns_view_dis");
    $numrows = $db->sql_numrows($result);
    $result = $db->sql_query("select * from ".$prefix."_downloads_categories");
    $catnum = $db->sql_numrows($result);
    $result_m = $db->sql_query("select ns_dl_reg_down from ".$prefix."_ns_downloads_general");
    list($ns_dl_reg_down) = $db->sql_fetchrow($result_m);
    if ($ns_dl_reg_down == 1 && (!is_user($user))) {
    	echo "<center><font class=\"tiny\">"._NSDLNOTE."</font></center><br />";
    }
//    ns_dl_CloseTable();   
    if ($ns_dl_show_full == 1) {	
    	ns_dl_OpenTable();

    	echo "<center><font class=\"content\">"._THEREARE." <strong>$numrows</strong> ";
    	echo ""._DOWNLOADS." "._AND." <strong>$catnum</strong> "._CATEGORIES." "._INDB."</font></center>";
    	ns_dl_CloseTable();
    }
    CloseTable();
/******downloads tag cloud*****Start**/
/******tag cloud added by***Dochavoc**pnp04240012**/
OpenTable();
ns_dl_OpenTable();
echo "<div align=\"center\"><strong>Downloads Tag Cloud</strong></div>";
    ns_dl_CloseTable();
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"15\">";
echo "<tr><td>";	
    echo "<br />";	
      function pnpdlTag($tag, $link, $dl_fscol=10, $dl_pncol=18) {
$rdltsc='#'.dechex(rand(1,16)).dechex(rand(3,16)).dechex(rand(0,16)).dechex(rand(0,16)).dechex(rand(6,16)).dechex(rand(0,16));
$ranfs=rand($dl_fscol,$dl_pncol);

echo '<a href="'.$link.'"
style="font-size: ' . $ranfs . 'px;color:'.$rdltsc.'"
tag="' . $tag . '">' . $tag . '</a> ';

}

$result_pndlt=$db->sql_query("SELECT lid,title FROM ".$prefix."_downloads_downloads ORDER BY rand() limit 50");
while ($pnp_ndlt=$db->sql_fetchrow($result_pndlt))
     {
echo pnpdlTag($pnp_ndlt[title],'modules.php?name=Downloads&d_op=viewdownloaddetails&amp;lid='.$pnp_ndlt[lid]);
}
echo "</td></tr></table>";
/******downloads tag cloud*****End**/
CloseTable();	
    ns_dl_link_bar($maindownload);
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }
}



function NewDownloads($newdownloadshowdays) {
global $module_name, $prefix, $db;
$result_ms = $db->sql_query("select ns_dl_num_new_one, ns_dl_num_new_two, ns_dl_num_new_three from ".$prefix."_ns_downloads_new_pop");
list($ns_dl_num_new_one, $ns_dl_num_new_two, $ns_dl_num_new_three) = $db->sql_fetchrow($result_ms);
$result_tc = $db->sql_query("select prbgcolor1, prbgcolor2, tttextcolor, tbtextcolor from ".$prefix."_ns_downloads_general");
list($prbgcolor1, $prbgcolor2, $tttextcolor, $tbtextcolor) = $db->sql_fetchrow($result_tc);
    include_once("header.php");
    menu(1);
    echo "<a name=\"newdownloads\">";
    ns_mod_title3("new_downloads",""._NEWDOWNLOADS."");
    OpenTable();
    $counter = 0;
    $allweekdownloads = 0;
    while ($counter <= 7-1){
	$newdownloaddayRaw = (time()-(86400 * $counter));
	$newdownloadday = date("d-M-Y", $newdownloaddayRaw);
	$newdownloadView = date("F d, Y", $newdownloaddayRaw);
	$newdownloadDB = Date("Y-m-d", $newdownloaddayRaw);
	$ns_view_dis = ns_dl_admin_view(2);
	$result = $db->sql_query("select * FROM ".$prefix."_downloads_downloads WHERE date LIKE '%$newdownloadDB%' $ns_view_dis");
	$totaldownloads = $db->sql_numrows($result); 
	$counter++;
	$allweekdownloads = $allweekdownloads + $totaldownloads;
    }
    $counter = 0;
    while ($counter <=30-1){
        $newdownloaddayRaw = (time()-(86400 * $counter));
        $newdownloadDB = Date("Y-m-d", $newdownloaddayRaw);
        $result = $db->sql_query("select * FROM ".$prefix."_downloads_downloads WHERE date LIKE '%$newdownloadDB%' $ns_view_dis");
        $totaldownloads = $db->sql_numrows($result);
        $allmonthdownloads = $allmonthdownloads + $totaldownloads;
        $counter++;
    }    
    ns_dl_OpenTable();
    echo "<table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\" align=\"center\"><tr>";
    echo "<td colspan=\"2\" width=\"100%\">";
    echo "<center><font class=\"title\"><u>"._TOTALNEWDOWNLOADS."</u></font></center></td></tr>";
    echo "<tr><td width=\"55%\" align=\"right\">"._LASTWEEK.":</td><td align=\"left\" width=\"45%\"><strong>$allweekdownloads</strong></td></tr>";
    echo "<td align=\"right\" width=\"55%\">"._LAST30DAYS.":</td><td align=\"left\" width=\"45%\"><strong>$allmonthdownloads</strong></td></tr>";
    echo "<tr><td colspan=\"2\" width=\"100%\">";
    echo "<center><strong>"._SHOW.":</strong>&nbsp;&nbsp;";
    echo "<a href=\"modules.php?name=$module_name&d_op=NewDownloads&amp;newdownloadshowdays=$ns_dl_num_new_one#newdownloads\">$ns_dl_num_new_one "._NSDLDAYS."</a> - <a href=\"modules.php?name=$module_name&d_op=NewDownloads&amp;newdownloadshowdays=$ns_dl_num_new_two#newdownloads\">$ns_dl_num_new_two "._NSDLDAYS."</a> - <a href=\"modules.php?name=$module_name&d_op=NewDownloads&amp;newdownloadshowdays=$ns_dl_num_new_three#newdownloads\">$ns_dl_num_new_three "._NSDLDAYS."</a> ";
    echo "</center></td></tr></table>";
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    if (!isset($newdownloadshowdays)) {
		$newdownloadshowdays = $ns_dl_num_new_one;
    }
    echo "<br /><br /><table width=\"70%\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" align=\"center\">";
    echo "<tr><td colspan=\"2\" width=\"100%\">";
	if ($newdownloadshowdays <= 30) {
		$ns_newnum = ""._DTOTALFORLAST."";
	} else {
		$ns_newnum = ""._DTOTALFORLAST2."";
	}
    echo "<center><strong>$ns_newnum $newdownloadshowdays ";
    echo ""._DAYS."</strong></center></td></tr>";
    $counter = 0;
    $allweekdownloads = 0;
    while ($counter <= $newdownloadshowdays-1) {
	$newdownloaddayRaw = (time()-(86400 * $counter));
	$newdownloadday = date("d-M-Y", $newdownloaddayRaw);
	$newdownloadView = date("F d, Y", $newdownloaddayRaw);
	$newdownloadDB = Date("Y-m-d", $newdownloaddayRaw);
	$result = $db->sql_query("select * FROM ".$prefix."_downloads_downloads WHERE date LIKE '%$newdownloadDB%' $ns_view_dis");
	$totaldownloads = $db->sql_numrows($result);
	if ($totaldownloads < 1) {
	$totaldownloads = 0;	
	}
	$counter++;
	$allweekdownloads = $allweekdownloads + $totaldownloads;
	echo "<tr>";
	echo "<td width=\"65%\" align=\"center\"><strong>&#8226;</strong> ";
	echo "<a href=\"modules.php?name=$module_name&d_op=NewDownloadsDate";
	echo "&amp;selectdate=$newdownloaddayRaw#newdlstart\">$newdownloadView</a>";
	echo "<strong> - $totaldownloads</strong>";
	echo "</td></tr>";
    }
    $counter = 0;
    $allmonthdownloads = 0;
    echo "</table><br /><br />";
    ns_dl_CloseTable();
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
}



function NewDownloadsDate($selectdate) {
global $prefix, $db, $admin, $module_name;
$result_md = $db->sql_query("select ns_dl_main_dec from ".$prefix."_ns_downloads_rating");
list($ns_dl_main_dec) = $db->sql_fetchrow($result_md);
$dateDB = (date("d-M-Y", $selectdate));
$dateView = (date("F d, Y", $selectdate));
include_once("header.php");
menu(1);
echo "<a name=\"newdlstart\">";
ns_mod_title3("new_downloads",""._NEWDOWNLOADS."");
OpenTable();
$newdownloadDB = Date("Y-m-d", $selectdate);
$ns_view_dis = ns_dl_admin_view(2);
$result = $db->sql_query("select * FROM ".$prefix."_downloads_downloads WHERE date LIKE '%$newdownloadDB%' $ns_view_dis");
$totaldownloads = $db->sql_numrows($result);
    if ($totaldownloads != 1) {
      $ns_num = ""._NEWDOWNLOADS."";
    } else {
      $ns_num = ""._NEWDOWNLOAD."";
    }
ns_dl_OpenTable();
echo "<br /><center><font class=\"option\"><strong>$totaldownloads $ns_num "._ADDEDON."  $dateView</strong></font></center><br />";
ns_dl_CloseTable();
	if ($totaldownloads > 0) {
    	ns_download_image();
    	echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" ";
		echo "align=\"center\"><tr><td>";
    	echo "<font class=\"content\">";
    	$result_nl = $db->sql_query("select lid, cid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage, ns_compat, ns_des_img, ns_mirror_one, ns_mirror_two, ns_dl_down_note from ".$prefix."_downloads_downloads where date LIKE '%$newdownloadDB%' $ns_view_dis order by title ASC");
    	while(list($lid, $cid, $title, $description, $time, $hits, $downloadratingsummary, $totalvotes, $totalcomments, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two, $ns_dl_down_note) = $db->sql_fetchrow($result_nl)) {
        $cid = intval($cid);
        $lid = intval($lid);
        $hits = intval($hits);
        $totalvotes = intval($totalvotes);
        $totalcomments = intval($totalcomments);
        ns_dl_OpenTable();
		$downloadratingsummary = number_format($downloadratingsummary, $ns_dl_main_dec);
		$title = stripslashes($title); 
        $description = stripslashes($description);
    	echo "<br />";
		$result_rec = $db->sql_query("select ns_dl_rec from ".$prefix."_ns_downloads_recommend");
		list($ns_dl_rec) = $db->sql_fetchrow($result_rec);
		echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
		echo "<tr><td align=\"left\" valign=\"top\">";
		ns_dl_image($lid, $title);
		echo "<a href=\"modules.php?name=$module_name&d_op=getit&amp;lid=$lid#dl\">$title</a>";
		newdownloadgraphic($datetime, $time);
		popgraphic($hits);
		echo "</td>";
			if ($ns_dl_rec == 1) {
				echo "<td align=\"right\" valign=\"top\">";
				echo "<a href=\"modules.php?name=$module_name&amp;d_op=ns_dl_rec_dl&amp;cid=$cid";
				echo "&amp;lid=$lid&amp;ttitle=$title#recom\" title=\""._NSDLRECDOWNLOAD."\">";
				echo "<span style=\"vertical-align=-2\">";
				echo "<img src=\"images/NukeStyles/EDL/mod/friend.gif\" border=\"0\" ";
				echo "title=\""._NSDLRECDOWNLOAD."\"></span>&nbsp;&nbsp;"._NSDLFOOTREC."</a>";
				echo "&nbsp;&nbsp;</td>";
			}
		echo "</tr></table>";
		ns_download_image_pop($cid, $lid, $title, $description, $ns_des_img, $ns_dl_down_note);
		ns_dl_show_mirror($lid, $ns_mirror_one, $ns_mirror_two);
	    $result3 = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories where cid=$cid");
	    list($cid3, $title3, $parentid3) = $db->sql_fetchrow($result3);
        $cid3 = intval($cid3);
		if ($parentid3>0) $title3 = getparent($parentid3,$title3);
		echo "<strong>"._CATEGORY.":</strong> <a href=modules.php?name=$module_name";
		echo "&d_op=viewdownload&cid=$cid#cat>$title3</a><br />";
		mktime (LC_TIME, $locale);
		preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $time, $datetime);
		$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
		ns_dl_list_pfields($version, $ns_compat, $filesize, $datetime, $hits, $title, $transfertitle, $totalvotes, $votestring, $downloadratingsummary);	
    	ns_download_foot($homepage, $cid, $lid, $transfertitle, $totalcomments);
		detecteditorial($cid, $lid, $transfertitle, 1);
    	ns_dl_admin($lid, $admin);
		echo "</font></div>";
    	ns_dl_CloseTable();
    	}
    	echo "</td></tr></table>";
    	CloseTable();
	} else {
    	CloseTable();
	} 
    ns_dl_link_bar($maindownload = 1);
}



function TopRated($ratenum, $ratetype) {			
    global $prefix, $db, $admin, $module_name;
    $result_md = $db->sql_query("select ns_dl_main_dec from ".$prefix."_ns_downloads_rating");
    list($ns_dl_main_dec) = $db->sql_fetchrow($result_md);
    $result_ms = $db->sql_query("select ns_dl_num_top, ns_dl_num_top_num, ns_dl_num_top_per from ".$prefix."_ns_downloads_new_pop");
    list($ns_dl_num_top, $ns_dl_num_top_num, $ns_dl_num_top_per) = $db->sql_fetchrow($result_ms);
    include_once("header.php");
    menu(1);
    echo "<a name=\"toprated\">";
    ns_mod_title3("top_rated",""._NSDLBESTRATED2."");
    OpenTable();
    ns_dl_OpenTable();
    echo "<br />";
    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">";
    echo "<tr><td align=\"center\">";
    if ($ratenum != "" && $ratetype != "") {
    	$ns_dl_num_top_num = $ratenum;
    	if ($ratetype == "percent") {
	    	$ns_dl_num_top_per = 1;
		}
    }
    if ($ns_dl_num_top_per == 1) {
    	$ns_dl_num_top_numpercent = $ns_dl_num_top_num;
    	$result = $db->sql_query("select * from ".$prefix."_downloads_downloads where downloadratingsummary != 0");
    	$totalrateddownloads = $db->sql_numrows($result);
    	$ns_dl_num_top_num = $ns_dl_num_top_num / 100;
    	$ns_dl_num_top_num = $totalrateddownloads * $ns_dl_num_top_num;
    	$ns_dl_num_top_num = round($ns_dl_num_top_num);
    }
    if ($ns_dl_num_top_per == 1) { 
		echo "<font class=\"content\"><strong>"._DBESTRATED." $ns_dl_num_top_numpercent% ";
		echo "("._OF." $totalrateddownloads "._TRATEDDOWNLOADS.")</strong></font>";
    } else {
		echo "<font class=\"content\"><strong>"._DBESTRATED." $ns_dl_num_top_num";
		echo "</strong></font>";
    }
    echo "</td></tr>";
    echo "<tr><td>&nbsp;</td></tr>";
    echo "<tr><td><center>";
    echo ""._SHOWTOP.":  [ <a href=\"modules.php?name=$module_name&d_op=TopRated";
    echo "&amp;ratenum=10&amp;ratetype=num#toprated\">10</a> - ";
    echo "<a href=\"modules.php?name=$module_name&d_op=TopRated";
    echo "&amp;ratenum=25&amp;ratetype=num#toprated\">25</a> - ";
    echo "<a href=\"modules.php?name=$module_name&d_op=TopRated";
    echo "&amp;ratenum=50&amp;ratetype=num#toprated\">50</a> ] "._OR." "._TOP.": ";
    echo "[ <a href=\"modules.php?name=$module_name&d_op=TopRated";
    echo "&amp;ratenum=1&amp;ratetype=percent#toprated\">1%</a> - ";
    echo "<a href=\"modules.php?name=$module_name&d_op=TopRated";
    echo "&amp;ratenum=5&amp;ratetype=percent#toprated\">5%</a> - ";
    echo "<a href=\"modules.php?name=$module_name&d_op=TopRated";
    echo "&amp;ratenum=10&amp;ratetype=percent#toprated\">10%</a> ]";
    echo "</center></td></tr></table><br />";
    ns_dl_CloseTable();
    $result_tr = $db->sql_query("select * from ".$prefix."_downloads_downloads where downloadratingsummary != 0 and totalvotes >= $ns_dl_num_top");
    $ns_num_top = $db->sql_numrows($result_tr);
    if ($ns_num_top > 0) {
		$ns_view_dis = ns_dl_admin_view(2);
    	$result = $db->sql_query("select lid, cid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage, ns_compat, ns_des_img, ns_mirror_one, ns_mirror_two, ns_dl_down_note from ".$prefix."_downloads_downloads where downloadratingsummary != 0 and totalvotes >= $ns_dl_num_top $ns_view_dis order by downloadratingsummary DESC limit 0,$ns_dl_num_top_num ");
    	echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" ";
		echo "align=\"center\"><tr><td><font class=\"content\">";
    	ns_download_image();
    	while(list($lid, $cid, $title, $description, $time, $hits, $downloadratingsummary, $totalvotes, $totalcomments, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two, $ns_dl_down_note) = $db->sql_fetchrow($result)) {
        $lid = intval($lid);
        $cid = intval($cid);
        $hits = intval($hits);
        $totalvotes = intval($totalvotes);
        $totalcomments = intval($totalcomments);
		$transfertitle = preg_replace ("/ /", "/_/", $title);
        ns_dl_OpenTable();
		$downloadratingsummary = number_format($downloadratingsummary, $ns_dl_main_dec);
		$title = stripslashes($title);
		$description = stripslashes($description);
    	echo "<br />";
		$result_rec = $db->sql_query("select ns_dl_rec from ".$prefix."_ns_downloads_recommend");
		list($ns_dl_rec) = $db->sql_fetchrow($result_rec);
		echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
		echo "<tr><td align=\"left\" valign=\"top\">";
		ns_dl_image($lid, $title);
		echo "<a href=\"modules.php?name=$module_name&d_op=getit&amp;lid=$lid#dl\">$title</a>";
		newdownloadgraphic($datetime, $time);
		popgraphic($hits);
		echo "</td>";
			if ($ns_dl_rec == 1) {
				echo "<td align=\"right\" valign=\"top\">";
				echo "<a href=\"modules.php?name=$module_name&amp;d_op=ns_dl_rec_dl&amp;cid=$cid";
				echo "&amp;lid=$lid&amp;ttitle=$title#recom\" title=\""._NSDLRECDOWNLOAD."\">";
				echo "<span style=\"vertical-align=-2\">";
				echo "<img src=\"images/NukeStyles/EDL/mod/friend.gif\" border=\"0\" ";
				echo "title=\""._NSDLRECDOWNLOAD."\"></span>&nbsp;&nbsp;"._NSDLFOOTREC."</a>";
				echo "&nbsp;&nbsp;</td>";
			}
		echo "</tr></table>";
		ns_download_image_pop($cid, $lid, $title, $description, $ns_des_img, $ns_dl_down_note);
		ns_dl_show_mirror($lid, $ns_mirror_one, $ns_mirror_two);
	    $result3 = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories where cid=$cid");
	    list($cid3, $title3, $parentid3) = $db->sql_fetchrow($result3);
        $cid3 = intval($cid3);
		if ($parentid3 > 0) $title3 = getparent($parentid3, $title3);
			echo "<strong>"._CATEGORY.":</strong> ";
			echo "<a href=modules.php?name=$module_name&d_op=viewdownload&cid=$cid#cat>";
			echo "$title3</a><br />";
			mktime (LC_TIME, $locale);
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $time, $datetime);
			$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
			$datetime = ucfirst($datetime);
			ns_dl_list_pfields($version, $ns_compat, $filesize, $datetime, $hits, $title, $transfertitle, $totalvotes, $votestring, $downloadratingsummary);
    		ns_download_foot($homepage, $cid, $lid, $transfertitle, $totalcomments);
			detecteditorial($cid, $lid, $transfertitle, 1);
    		ns_dl_admin($lid, $admin);
			echo "</font></div>";
    		ns_dl_CloseTable();
    	}
    	echo "</td></tr></table>";
    } else {
    	ns_dl_OpenTable();
    	echo "<br /><br /><center>";    
    	echo "<font class=\"content\"><strong>"._NSDLNOTOPRATED."</strong></font>";
    	echo "</center><br /><br />";
    	ns_dl_CloseTable();
    }
    ns_dl_OpenTable();    
    echo "<br /><center><font class=\"tiny\">"._NOTE." $ns_dl_num_top "._TVOTESREQ."";
    echo "</font></center><br />";
    ns_dl_CloseTable();
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
}



function MostPopular($ratenum, $ratetype) {
global $prefix, $db, $admin, $module_name;
$result_ii = $db->sql_query("select ns_dl_main_dec from ".$prefix."_ns_downloads_rating");
list($ns_dl_main_dec) = $db->sql_fetchrow($result_ii);
$result_ns = $db->sql_query("select ns_dl_num_pop, ns_dl_num_pop_num, ns_dl_num_pop_per from ".$prefix."_ns_downloads_new_pop");
list($ns_dl_num_pop, $ns_dl_num_pop_num, $ns_dl_num_pop_per) = $db->sql_fetchrow($result_ns);
include_once("header.php");
menu(1);
echo "<a name=\"mostpop\">";
ns_mod_title3("most_popular",""._NSMOSTPOPULAR2."");
OpenTable();
ns_dl_OpenTable();
    if ($ratenum != "" && $ratetype != "") {
    	$ns_dl_num_pop_num = $ratenum;
    	if ($ratetype == "percent") {
			$ns_dl_num_pop_per = 1;
		}
    }
    if ($ns_dl_num_pop_per == 1) {
    	$ns_dl_num_top_numpercent = $ns_dl_num_pop_num;
    	$result = $db->sql_query("select * from ".$prefix."_downloads_downloads");
    	$totalns_dl_num_pop_num = $db->sql_numrows($result);
    	$ns_dl_num_pop_num = $ns_dl_num_pop_num / 100;
    	$ns_dl_num_pop_num = $totalns_dl_num_pop_num * $ns_dl_num_pop_num;
    	$ns_dl_num_pop_num = round($ns_dl_num_pop_num);
    }    
    if ($ns_dl_num_pop_per == 1) {
		echo "<br /><center><font class=\"option\"><strong>"._MOSTPOPULAR." ";
		echo "$ns_dl_num_top_numpercent% ("._OFALL." $totalns_dl_num_pop_num ";
		echo ""._DOWNLOADS.")</strong></font></center><br />";
    } else {
		echo "<br /><center><font class=\"option\"><strong>"._MOSTPOPULAR." ";
		echo "$ns_dl_num_pop_num</strong></font></center><br />";
    }
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" ";
echo "border=\"0\" align=\"center\"><tr><td align=\"center\">";
echo "<tr><td><center>"._SHOWTOP.": [ <a href=\"modules.php?name=$module_name";
echo "&d_op=MostPopular&amp;ratenum=10&amp;ratetype=num#mostpop\">10</a> - ";
echo "<a href=\"modules.php?name=$module_name";
echo "&d_op=MostPopular&amp;ratenum=25&amp;ratetype=num#mostpop\">25</a> - ";
echo "<a href=\"modules.php?name=$module_name";
echo "&d_op=MostPopular&amp;ratenum=50&amp;ratetype=num#mostpop\">50</a> ] "._OR." "._TOP.": ";
echo "[ <a href=\"modules.php?name=$module_name";
echo "&d_op=MostPopular&amp;ratenum=1&amp;ratetype=percent#mostpop\">1%</a> - ";
echo "<a href=\"modules.php?name=$module_name";
echo "&d_op=MostPopular&amp;ratenum=5&amp;ratetype=percent#mostpop\">5%</a> - ";
echo "<a href=\"modules.php?name=$module_name";
echo "&d_op=MostPopular&amp;ratenum=10&amp;ratetype=percent#mostpop\">10%</a> ]</center>";
echo "</td></tr></table><br />";
ns_dl_CloseTable();
$ns_view_dis = ns_dl_admin_view(1);
$result = $db->sql_query("select lid, cid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage, ns_compat, ns_des_img, ns_mirror_one, ns_mirror_two, ns_dl_down_note from ".$prefix."_downloads_downloads $ns_view_dis order by hits DESC limit 0,$ns_dl_num_pop_num ");
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" ";
echo "border=\"0\" align=\"center\"><tr><td><font class=\"content\">";
ns_download_image();
while(list($lid, $cid, $title, $description, $time, $hits, $downloadratingsummary, $totalvotes, $totalcomments, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two, $ns_dl_down_note) = $db->sql_fetchrow($result)) {
    $cid = intval($cid);
    $lid = intval($lid);
    $hits = intval($hits);
    $totalvotes = intval($totalvotes);
    $totalcomments = intval($totalcomments);
	$transfertitle = preg_replace ("/ /", "/_/", $title);
    ns_dl_OpenTable();
	$downloadratingsummary = number_format($downloadratingsummary, $ns_dl_main_dec);
	$title = stripslashes($title);
	$description = stripslashes($description);
    echo "<br />";
	$result_rec = $db->sql_query("select ns_dl_rec from ".$prefix."_ns_downloads_recommend");
	list($ns_dl_rec) = $db->sql_fetchrow($result_rec);
	echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
	echo "<tr><td align=\"left\" valign=\"top\">";
	ns_dl_image($lid, $title);
	echo "<a href=\"modules.php?name=$module_name&d_op=getit&amp;lid=$lid#dl\">$title</a>";
	newdownloadgraphic($datetime, $time);
	popgraphic($hits);
	echo "</td>";
		if ($ns_dl_rec == 1) {
			echo "<td align=\"right\" valign=\"top\">";
			echo "<a href=\"modules.php?name=$module_name&amp;d_op=ns_dl_rec_dl&amp;cid=$cid";
			echo "&amp;lid=$lid&amp;ttitle=$title#recom\" title=\""._NSDLRECDOWNLOAD."\">";
			echo "<span style=\"vertical-align=-2\">";
			echo "<img src=\"images/NukeStyles/EDL/mod/friend.gif\" border=\"0\" ";
			echo "title=\""._NSDLRECDOWNLOAD."\"></span>&nbsp;&nbsp;"._NSDLFOOTREC."</a>&nbsp;&nbsp;";
			echo "</td>";
		}
	echo "</tr></table>";
	ns_download_image_pop($cid, $lid, $title, $description, $ns_des_img, $ns_dl_down_note);
	ns_dl_show_mirror($lid, $ns_mirror_one, $ns_mirror_two);
	$result3 = $db->sql_query("select cid,title,parentid from ".$prefix."_downloads_categories where cid=$cid");
	list($cid3,$title3,$parentid3) = $db->sql_fetchrow($result3);
    $cid3 = intval($cid3);
	if ($parentid3>0) $title3 = getparent($parentid3,$title3);
	echo "<strong>"._CATEGORY.":</strong> ";
	echo "<a href=modules.php?name=$module_name&d_op=viewdownload&cid=$cid#cat>$title3</a><br />";
	mktime (LC_TIME, $locale);
	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $time, $datetime);
	$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
	$datetime = ucfirst($datetime);
	ns_dl_list_pfields($version, $ns_compat, $filesize, $datetime, $hits, $title, $transfertitle, $totalvotes, $votestring, $downloadratingsummary);
    ns_download_foot($homepage, $cid, $lid, $transfertitle, $totalcomments);
	detecteditorial($cid, $lid, $transfertitle, 1);
    ns_dl_admin($lid, $admin);
	echo "</font>";
    ns_dl_CloseTable();
    }
    echo "</td></tr></table>";
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
}



function newdownloadgraphic($datetime, $time) {
    global $prefix, $db, $module_name;
    $result_ns = $db->sql_query("select ns_dl_newimage_on, ns_dl_new_one, ns_dl_new_two, ns_dl_new_three from ".$prefix."_ns_downloads_new_pop");
    list($ns_dl_newimage_on, $ns_dl_new_one, $ns_dl_new_two, $ns_dl_new_three) = $db->sql_fetchrow($result_ns);
    if ($ns_dl_newimage_on == 1) {
    echo "&nbsp;";
    mktime (LC_TIME, $locale);
    preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $time, $datetime);  
    $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
    $datetime = ucfirst($datetime);		   
    $startdate = time();
    $count = 0;
    while ($count <= $ns_dl_new_three) {
	$daysold = date(_NSDAY1, $startdate);
        if ("$daysold" == "$datetime") {
    	    if ($count <= $ns_dl_new_one) {
		echo "<img src=\"modules/$module_name/images/new_1.gif\" alt=\""._DCATNEWTODAY."\">";
	    }
            if ($count <= $ns_dl_new_two && $count > $ns_dl_new_one) {
		echo "<img src=\"modules/$module_name/images/new_3.gif\" alt=\""._DCATLAST3DAYS."\">";
	    }
            if ($count <= $ns_dl_new_three && $count > $ns_dl_new_two) {
		echo "<img src=\"modules/$module_name/images/new_7.gif\" alt=\""._DCATTHISWEEK."\">";
	    }
	}
        $count++;
        $startdate = (time()-(86400 * $count));
        }
    }
}


function categorynewdownloadgraphic($cat) {
    global $prefix, $db, $module_name;
    $result_ns = $db->sql_query("select ns_dl_newimage_on, ns_dl_new_one, ns_dl_new_two, ns_dl_new_three from ".$prefix."_ns_downloads_new_pop");
    list($ns_dl_newimage_on, $ns_dl_new_one, $ns_dl_new_two, $ns_dl_new_three) = $db->sql_fetchrow($result_ns);
    if ($ns_dl_newimage_on == 1) {
	$ns_view_dis = ns_dl_admin_view(2);
    $newresult = $db->sql_query("select date from ".$prefix."_downloads_downloads where cid='$cat' $ns_view_dis order by date desc limit 1");
    list($time)=$db->sql_fetchrow($newresult);
    echo "&nbsp;";
    mktime (LC_TIME, $locale);
    preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $time, $datetime);
    $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
    $datetime = ucfirst($datetime);		   
    $startdate = time();
    $count = 0;
    while ($count <= $ns_dl_new_three) {
	$daysold = date(_NSDAY1, $startdate);
        if ("$daysold" == "$datetime") {
    	    if ($count <= $ns_dl_new_one) {
		echo "<img src=\"modules/$module_name/images/new_1.gif\" alt=\""._DCATNEWTODAY."\">";
	    }
            if ($count <= $ns_dl_new_two && $count > $ns_dl_new_one) {
		echo "<img src=\"modules/$module_name/images/new_3.gif\" alt=\""._DCATLAST3DAYS."\">";
	    }
            if ($count <= $ns_dl_new_three && $count > $ns_dl_new_two) {
		echo "<img src=\"modules/$module_name/images/new_7.gif\" alt=\""._DCATTHISWEEK."\">";
	    }
	}
        $count++;
        $startdate = (time()-(86400 * $count));
    }
  }
}



function popgraphic($hits) {
    $hits = intval($hits);
    global $prefix, $db, $module_name;
    $result_ns = $db->sql_query("select ns_dl_num_pop, ns_dl_num_pop_image, ns_dl_popimage_on from ".$prefix."_ns_downloads_new_pop");
    list($ns_dl_num_pop, $ns_dl_num_pop_image, $ns_dl_popimage_on) = $db->sql_fetchrow($result_ns);
    if ($ns_dl_popimage_on == 1) {
        if ($hits>=$ns_dl_num_pop) {
	echo "&nbsp;<img src=\"modules/$module_name/images/$ns_dl_num_pop_image\" alt=\""._POPULAR."\">";
        }
    }
}



function convertorderbyin($orderby) {
    if ($orderby == "titleA")	$orderby = "title ASC"; 
    if ($orderby == "dateA")	$orderby = "date ASC";
    if ($orderby == "hitsA")	$orderby = "hits ASC";
    if ($orderby == "ratingA")	$orderby = "downloadratingsummary ASC";
    if ($orderby == "titleD")	$orderby = "title DESC"; 
    if ($orderby == "dateD")	$orderby = "date DESC";
    if ($orderby == "hitsD")	$orderby = "hits DESC";
    if ($orderby == "ratingD")	$orderby = "downloadratingsummary DESC";
    return $orderby;
}



function convertorderbytrans($orderby) {
    if ($orderby == "hits ASC")			$orderbyTrans = ""._POPULARITY1."";
    if ($orderby == "hits DESC")		$orderbyTrans = ""._POPULARITY2."";
    if ($orderby == "title ASC")		$orderbyTrans = ""._TITLEAZ."";
    if ($orderby == "title DESC")		$orderbyTrans = ""._TITLEZA."";
    if ($orderby == "date ASC")			$orderbyTrans = ""._DDATE1."";
    if ($orderby == "date DESC")		$orderbyTrans = ""._DDATE2."";
    if ($orderby == "downloadratingsummary ASC")	$orderbyTrans = ""._RATING1."";
    if ($orderby == "downloadratingsummary DESC")	$orderbyTrans = ""._RATING2."";
    return $orderbyTrans;
}



function convertorderbyout($orderby) {
    if ($orderby == "title ASC")		$orderby = "titleA";
    if ($orderby == "date ASC")			$orderby = "dateA";
    if ($orderby == "hits ASC")			$orderby = "hitsA";
    if ($orderby == "downloadratingsummary ASC")	$orderby = "ratingA";
    if ($orderby == "title DESC")		$orderby = "titleD";
    if ($orderby == "date DESC")		$orderby = "dateD";
    if ($orderby == "hits DESC")		$orderby = "hitsD";
    if ($orderby == "downloadratingsummary DESC")	$orderby = "ratingD";
    return $orderby;
}



function getit($lid) {
$lid = intval($lid);
global $prefix, $db, $module_name, $user;
$result = $db->sql_query("select ns_dl_reg_down from ".$prefix."_ns_downloads_general");
list($ns_dl_reg_down) = $db->sql_fetchrow($result);
$result_get = $db->sql_query("select ns_getit from ".$prefix."_ns_downloads_fetch");
list($ns_getit) = $db->sql_fetchrow($result_get);
$result2 = $db->sql_query("select cid, url from ".$prefix."_downloads_downloads where lid='$lid'");
list($cid, $url)=$db->sql_fetchrow($result2);
$cid = intval($cid);
    if (file_exists("modules/$module_name/copyright.php")) {
	if ($ns_dl_reg_down == 0) {
		if ($ns_getit == 1) {
			Header("Location: modules.php?name=$module_name&d_op=ns_getit&cid=$cid&lid=$lid&type=url#get");
		} else {
    		$db->$db->sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 where lid='$lid'");
    		Header("Location: $url");
		}
    } else if ($ns_dl_reg_down == 1 && (is_user($user))) {
		if ($ns_getit == 1) {
			Header("Location: modules.php?name=$module_name&d_op=ns_getit&cid=$cid&lid=$lid&type=url#get");
		} else {
    		$db->$db->sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 where lid=$lid");
    		Header("Location: $url");
		}
    } else if ($ns_dl_reg_down == 1 && (!is_user($user))) {	 
    	include_once("header.php");
    	menu(1);
    	echo "<a name=\"dl\">";
    	ns_mod_title3("download_reg",""._REGDOWNLOAD."");
    	OpenTable();
    	ns_dl_register2($dlreg = 2);
    	CloseTable();
    	ns_dl_link_bar($maindownload = 1);
	}
    	} else {
    		die();
    }
}



function viewdownloadeditorial($cid, $lid, $ttitle) {
    $lid = intval($lid);
    global $prefix, $db, $admin, $module_name, $ns_details, $ns_comments, $ns_editorial;
    $ns_details = 1;
    $ns_comments = 1;
    $ns_editorial = 0;
    include_once("header.php");
    menu(1);
    echo "<a name=\"dlreview\">";
    ns_mod_title3("download_review",""._NDDLREVIEW."");
    $result=$db->sql_query("SELECT adminid, editorialtimestamp, editorialtext, editorialtitle FROM ".$prefix."_downloads_editorials WHERE downloadid = $lid");
    $recordexist = $db->sql_numrows($result);
    $transfertitle = preg_replace ("/_/", " ", $ttitle);
    $displaytitle = $transfertitle;
    OpenTable();
	ns_dl_OpenTable();
	ns_dl_cat_jump($cid);
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<br /><center><font class=\"option\"><strong>"._DOWNLOADPROFILE.": $displaytitle</strong>";
    echo "</font><br /><br />";
    downloadinfomenu($cid, $lid, $ttitle);
    echo "</center><br />";
    ns_dl_CloseTable();
    if ($recordexist != 0) {     
	while(list($adminid, $editorialtimestamp, $editorialtext, $editorialtitle)=$db->sql_fetchrow($result)) {
    	$editorialtitle = stripslashes($editorialtitle); 
	    $editorialtext = stripslashes($editorialtext);
    	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $editorialtimestamp, $editorialtime);
	    $editorialtime = strftime("%F",mktime($editorialtime[4],$editorialtime[5],$editorialtime[6],$editorialtime[2],$editorialtime[3],$editorialtime[1]));
	    $date_array = explode("-", $editorialtime); 
	    $timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]); 
       	$formatted_date = date("d-M-Y", $timestamp);
       	ns_dl_OpenTable();
	    echo "<br /><br />";
	    echo "<center><font class=\"option\"><strong>'$editorialtitle'</strong></font><br />";
	    echo "<font class=\"tiny\">"._EDITORIALBY." ";
	    echo "$adminid - $formatted_date</font></center><br />";
	    echo "<div align=\"justify\">$editorialtext</div>";
	    echo "<br /><br />";
	    ns_dl_CloseTable();
   	    }
    } else {
    	ns_dl_OpenTable();
    	echo "<br /><br />";
    	echo "<center><font class=\"option\"><strong>"._NOEDITORIAL."</strong></font></center>";
    	echo "<br /><br />";
    	ns_dl_CloseTable();
    }
    echo "<center>";
    downloadfooter($cid, $lid, $ttitle);
    echo "</center>";
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
}



function detecteditorial($cid, $lid, $transfertitle, $img) {
$lid = intval($lid);
global $prefix, $db, $module_name, $ns_theme;
$resulted2 = $db->sql_query("select adminid from ".$prefix."_downloads_editorials where downloadid=$lid");
$recordexist = $db->sql_numrows($resulted2);
	if ($recordexist != 0) {
    	if (($img == 1) AND (file_exists("modules/$module_name/images/downloads/editorial.gif"))) {
			echo "<a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadeditorial";
			echo "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$transfertitle#dlreview\">";
			echo "<img src=\"modules/$module_name/images/downloads/editorial.gif\" ";
			echo "alt=\""._EDITORIAL."\" border=\"0\"></a>";
    	} elseif (($img == 1) AND (file_exists("themes/$ns_theme/images/downloads/editorial.gif"))) {
			echo "<a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadeditorial";
			echo "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$transfertitle#dlreview\">";
			echo "<img src=\"themes/$ns_theme/images/downloads/editorial.gif\" ";
			echo "alt=\""._EDITORIAL."\" border=\"0\"></a>";
    	} else {
			echo " - [ <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadeditorial";
			echo "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$transfertitle#dlreview\">";
			echo ""._EDITORIAL."</a> ]";
		}
    }
}



function viewdownloadcomments($cid, $lid, $ttitle) {
$lid = intval($lid);
global $prefix, $db, $admin, $prbgcolor1, $prbgcolor2, $tttextcolor, $tbtextcolor, $module_name, $ns_details, $ns_comments, $ns_editorial, $ns_recommend;
$ns_details = 1;
$ns_comments = 0;
$ns_editorial = 1;
$ns_recommend = 1;
include_once("header.php");
menu(1);
echo "<a name=\"dlcom\">";
ns_mod_title3("download_comments",""._NDDLCOMM."");
$result=$db->sql_query("select ratinguser, rating, ratingcomments, ratingtimestamp from ".$prefix."_downloads_votedata where ratinglid='$lid' && ratingcomments != '' order by ratingtimestamp desc");
$totalcomments = $db->sql_numrows($result);
$transfertitle = preg_replace ("/_/", " ", $ttitle);
$displaytitle = $transfertitle;
    if ($totalcomments < 1) {
    	$totalcomments = 0;
    }
OpenTable();
ns_dl_OpenTable();
ns_dl_cat_jump($cid);
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><center><font class=\"option\"><strong>"._DOWNLOADPROFILE.": $displaytitle</strong>";
echo "</font><br /><br />";
downloadinfomenu($cid, $lid, $ttitle); 
echo "<br /><br />"._TOTALOF." <strong>$totalcomments</strong> ";
	if ($totalcomments != 1) {
    	echo ""._COMMENTS."";
	} else {
    	echo ""._NSCOMMENT."";
	}
echo "</font></center><br />";
ns_dl_CloseTable();   
echo "<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
echo "<tr><td>";
$x=0;
    while(list($ratinguser, $rating, $ratingcomments, $ratingtimestamp)=$db->sql_fetchrow($result)) {
        $rating = intval($rating);
    	$ratingcomments = stripslashes($ratingcomments);
    	mktime (LC_TIME, $locale);
    	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $datetime);
    	$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
    	$formatted_date = ucfirst($datetime);
		$result2=$db->sql_query("select rating FROM ".$prefix."_downloads_votedata WHERE ratinguser = '$ratinguser'");
    	$usertotalcomments = $db->sql_numrows($result2);
    	$useravgrating = 0;
    	while(list($rating2)=$db->sql_fetchrow($result2))
        $useravgrating = $useravgrating + $rating2;
        $useravgrating = $useravgrating / $usertotalcomments;
        $useravgrating = number_format($useravgrating, 1);
		ns_dl_OpenTable();
        echo "<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\" width=\"100%\">";
        echo "<tr><td bgcolor=\"$prbgcolor1\">";
    	echo "<font color=\"$tttextcolor\"><strong> "._USER.": ";
    	echo "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;uname=$ratinguser\">";
    	echo "$ratinguser</a></strong></font>";
		echo "</td><td bgcolor=\"$prbgcolor1\">";
		echo "<font color=\"$tttextcolor\"><strong>"._RATING.": $rating</strong></font></td>";
		echo "<td bgcolor=\"$prbgcolor1\" align=\"right\">";
    	echo "<font color=\"$tttextcolor\"><strong>$formatted_date</strong></font></td></tr>";
		echo "<tr><td valign=\"top\" bgcolor=\"$prbgcolor2\">";
		echo "<font class=\"tiny\"><strong>"._USERAVGRATING.": $useravgrating</strong></font></td>";
		echo "<td valign=\"top\" colspan=\"2\" bgcolor=\"$prbgcolor2\">";
		echo "<font class=\"tiny\"><strong>"._NUMRATINGS.": $usertotalcomments</strong></font></td>";
		echo "</tr><tr><td colspan=\"3\" bgcolor=\"$prbgcolor2\">";
		echo "<div align=\"justify\">";
		echo "<img src=\"images/NukeStyles/EDL/mod/comments.gif\" border=\"0\" alt=\""._NSCOMMENT."\">";
		echo "&nbsp;&nbsp;";
		echo "<font color=\"$tbtextcolor\">$ratingcomments</font></div>";
    	ns_dl_admin($lid, $admin);        
		echo "</td></tr></table>";
    	ns_dl_CloseTable();
		$x++; 
    }
    echo "</td></tr></table>";
    downloadfooter($cid, $lid, $ttitle);
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
}



function downloadfooter($cid, $lid, $ttitle) {
$cid = intval($cid);
$lid = intval($lid);
global $module_name, $prefix, $db;
$result_bf = $db->sql_query("select ns_dl_foot_button from ".$prefix."_ns_downloads_general");
list($ns_dl_foot_button) = $db->sql_fetchrow($result_bf);
$result_perm = $db->sql_query("select ns_dl_field_rate from ".$prefix."_ns_downloads_field_perm");
list($ns_dl_field_rate) = $db->sql_fetchrow($result_perm);
ns_dl_OpenTable();
    if ($ns_dl_foot_button != 1) {
    	echo "<table align=\"center\" cellpadding=\"6\" cellspacing=\"0\" border=\"0\">";
    	echo "<tr><td align=\"center\" valign=\"middle\">";
    	echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
    	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    	echo "</td><td align=\"center\" valign=\"middle\">";
    	echo "<font class=\"content\">";
    	echo "[ <a href=\"modules.php?name=$module_name&d_op=getit&amp;lid=$lid#dl\">";
    	echo ""._DOWNLOADNOW."</a> ]";
    	if ($ns_dl_field_rate == 1) {
    		echo " - [ <a href=\"modules.php?name=$module_name&d_op=ratedownload&amp;";
    		echo "cid=$cid&amp;lid=$lid&amp;ttitle=$ttitle\">"._RATETHISDL."</a> ]";
		}
    	echo "</font></td><td align=\"center\" valign=\"middle\">";
    	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    	echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">";
    	echo "</td></tr></table>";
    } else {
    	$ntitle = preg_replace ("/_/", " ", $ttitle);
    	echo "<table align=\"center\" cellpadding=\"6\" cellspacing=\"0\" border=\"0\">";
    	echo "<tr><td align=\"center\" valign=\"middle\">";
    	echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
    	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    	echo "</td><td align=\"center\" valign=\"middle\">";
    	echo "<input type=\"button\" value=\""._NSDLDLNOWL."\" title=\""._DOWNLOADB." $ntitle\" ";
    	echo "onClick=\"window.location = 'modules.php?name=$module_name&d_op=getit";
    	echo "&amp;lid=$lid#dl'\">";
    	if ($ns_dl_field_rate == 1) {
			echo "&nbsp;&nbsp;&nbsp;";
    		echo "<input type=\"button\" value=\""._NSDLRATEDL."\" title=\""._RATERESOURCE." $ntitle\" ";
    		echo "onClick=\"window.location = 'modules.php?name=$module_name&d_op=ratedownload";
    		echo "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$ttitle#rate'\">";
		}
    	echo "</td><td align=\"center\" valign=\"middle\">";
    	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    	echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">";
    	echo "</td></tr></table>";
    }
ns_dl_CloseTable();
}



function downloadfooterchild($lid) {
    $lid = intval($lid);
    global $module_name, $prefix, $db;
    $result_os = $db->sql_query("select ns_dl_outside_vote from ".$prefix."_ns_downloads_rating");
    list($ns_dl_outside_vote) = $db->sql_fetchrow($result_os);
    if ($ns_dl_outside_vote == 1) { 
    ns_dl_OpenTable();
    echo "<center><font class=\"content\">"._ISTHISYOURSITE." ";
    echo "<a href=\"modules.php?name=$module_name&d_op=outsidedownloadsetup";
    echo "&amp;lid=$lid#outsidelink\">";
    echo ""._ALLOWTORATE."</a> "._ALLOWTORATE2."</font></center>";
    ns_dl_CloseTable();
    }
}



function outsidedownloadsetup($lid) {
   $lid = intval($lid); 
   global $module_name, $sitename, $nukeurl;
    include_once("header.php");
    menu(1);
    echo "<a name=\"outsidelink\">";
    ns_mod_title3("outside_link",""._DPROMOTEYOURSITE2."");
    OpenTable();
ns_dl_OpenTable();
    echo "<br /><div align=\"justify\">"._DPROMOTE01."</div><br /><br />";
ns_dl_CloseTable();
ns_dl_OpenTable();
    echo "<br /><br /><strong>1) "._TEXTLINK."</strong><br /><br />
    "._DPROMOTE02."<br /><br />
    <center><a href=\"$nukeurl/modules.php?name=$module_name&d_op=ratelink&amp;lid=$lid\">"._RATETHISSITE." @ $sitename</a></center><br /><br />
    <center>"._HTMLCODE1."</center><br />
    <center><strong>&lt;a href=\"$nukeurl/modules.php?name=$module_name&d_op=ratelink&lid=$lid\"&gt;"._RATETHISSITE." @ $sitename&lt;/a&gt;</strong></center>
    <br /><br />
    "._THENUMBER." <strong>\"$lid\"</strong> "._IDREFER." $sitename"._IDREFER2."<br /><br /><br />";
ns_dl_CloseTable();

ns_dl_OpenTable();
    echo "<br /><br /><strong>2) "._BUTTONLINK."</strong><br /><br />
    "._PROMOTE03."<br /><br />
    <center>
    <form action=\"modules.php?name=$module_name\" method=\"post\">\n
	<input type=\"hidden\" name=\"lid\" value=\"$lid\">\n
	<input type=\"hidden\" name=\"d_op\" value=\"ratedownload\">\n
	<input type=\"submit\" value=\""._RATEIT."\">\n
    </form>\n
    </center>
    <center>"._HTMLCODE2."</center><br /><br />
    <table border=\"0\" align=\"center\"><tr><td align=\"left\"><i>
    &lt;form action=\"$nukeurl/modules.php?name=$module_name\" method=\"post\"&gt;<br />\n
    &nbsp;&nbsp;&lt;input type=\"hidden\" name=\"lid\" value=\"$lid\"&gt;<br />\n
    &nbsp;&nbsp;&lt;input type=\"hidden\" name=\"d_op\" value=\"ratedownload\"&gt;<br />\n
    &nbsp;&nbsp;&lt;input type=\"submit\" value=\""._RATEIT."\"&gt;<br />\n
    &lt;/form&gt;\n
    </i></td></tr></table>
    <br /><br />";
    ns_dl_CloseTable();
    ns_dl_OpenTable();    
     echo "<br /><br /><strong>3) "._REMOTEFORM."</strong><br /><br />
   "._PROMOTE04."
    <center>
    <form method=\"post\" action=\"$nukeurl/modules.php?name=$module_name\">
    <table align=\"center\" border=\"0\" width=\"175\" cellspacing=\"0\" cellpadding=\"0\">
    <tr><td align=\"center\"><strong>"._VOTE4THISSITE."</strong></a></td></tr>
    <tr><td>
    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
    <tr><td valign=\"top\">
        <select name=\"rating\">
        <option selected>--</option>
	<option>10</option>
	<option>9</option>
	<option>8</option>
	<option>7</option>
	<option>6</option>
	<option>5</option>
	<option>4</option>	
	<option>3</option>
	<option>2</option>
	<option>1</option>
	</select>
    </td><td valign=\"top\">
	<input type=\"hidden\" name=\"ratinglid\" value=\"$lid\">
        <input type=\"hidden\" name=\"ratinguser\" value=\"outside\">
        <input type=\"hidden\" name=\"op value=\"addrating\">
	<input type=\"submit\" value=\""._DOWNLOADVOTE."\">
    </td></tr></table>
    </td></tr></table></form>
    <br />"._HTMLCODE3."<br /><br /></center>
    <blockquote><i>
    &lt;form method=\"post\" action=\"$nukeurl/modules.php?name=$module_name\"&gt;<br />
	&lt;table align=\"center\" border=\"0\" width=\"175\" cellspacing=\"0\" cellpadding=\"0\"&gt;<br />
	    &lt;tr&gt;&lt;td align=\"center\"&gt;&lt;b&gt;"._VOTE4THISSITE."&lt;/b&gt;&lt;/a&gt;&lt;/td&gt;&lt;/tr&gt;<br />
	    &lt;tr&gt;&lt;td&gt;<br />
	    &lt;table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\"&gt;<br />
		&lt;tr&gt;&lt;td valign=\"top\"&gt;<br />
    		&lt;select name=\"rating\"&gt;<br />
    		&lt;option selected&gt;--&lt;/option&gt;<br />
		&lt;option&gt;10&lt;/option&gt;<br />
		&lt;option&gt;9&lt;/option&gt;<br />
		&lt;option&gt;8&lt;/option&gt;<br />
		&lt;option&gt;7&lt;/option&gt;<br />
		&lt;option&gt;6&lt;/option&gt;<br />
		&lt;option&gt;5&lt;/option&gt;<br />
		&lt;option&gt;4&lt;/option&gt;<br />	
		&lt;option&gt;3&lt;/option&gt;<br />
		&lt;option&gt;2&lt;/option&gt;<br />
		&lt;option&gt;1&lt;/option&gt;<br />
		&lt;/select&gt;<br />
	    &lt;/td&gt;&lt;td valign=\"top\"&gt;<br />
		&lt;input type=\"hidden\" name=\"ratinglid\" value=\"$lid\"&gt;<br />
    		&lt;input type=\"hidden\" name=\"ratinguser\" value=\"outside\"&gt;<br />
    		&lt;input type=\"hidden\" name=\"d_op\" value=\"addrating\"&gt;<br />
		&lt;input type=\"submit\" value=\""._DOWNLOADVOTE."\"&gt;<br />
	    &lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;<br />
	&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;<br />
    &lt;/form&gt;<br />
    </i></blockquote>
    <br /><br /><center>
    "._PROMOTE05."<br /><br />
    - $sitename "._STAFF."
    <br /><br /></center>";
    ns_dl_CloseTable();
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
}



function brokendownload($lid) {
$lid = intval($lid);
global $prefix, $db, $user, $cookie, $module_name, $ns_details, $ns_comments, $ns_editorial, $ns_recommend, $anonymous;
$ns_details = 1;
$ns_comments = 1;
$ns_editorial = 1;
$ns_recommend = 1;
include_once("header.php");
    if(is_user($user)) {
		$user2 = base64_decode($user);
		$cookie = explode(":", $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
    } else { 
		$ratinguser = "Anonymous";
    }
$result = $db->sql_query("select cid, title from ".$prefix."_downloads_downloads where lid='$lid'");
list($cid, $title) = $db->sql_fetchrow($result);
$cid = intval($cid);
$ttitle = preg_replace ("/_/", " ", $title);
menu(1);
echo "<a name=\"reportbroken\">";
ns_mod_title3("report_broken",""._REPORTBROKEN2."");
OpenTable();
ns_dl_OpenTable();
ns_dl_cat_jump($cid);
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><center><font color=\"#CC0000\"><strong>$ttitle</strong></font><br /><br />";
downloadinfomenu($cid, $lid, $ttitle); 
echo "<br /><br /><font class=\"content\">"._THANKSBROKEN."<br />"._SECURITYBROKEN."</font><br /><br />";
echo "<form action=\"modules.php?name=$module_name#reportbroken\" method=\"post\">";
echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
echo "<input type=\"hidden\" name=\"modifysubmitter\" value=\"$ratinguser\">"; 
echo "<input type=\"hidden\" name=\"d_op\" value=\"brokendownloadS\"><br />";
echo "<input type=\"submit\" value=\""._REPORTBROKENB."\" title=\""._REPORTBROKENB2."\">&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSBCANCEL."\" title=\""._NSBCANCEL."\" ";
echo "onClick=\"window.location='javascript:history.go(-1)'\">";
echo "</center></form>";
ns_dl_CloseTable();
CloseTable();
$maindownload = 1;
ns_dl_link_bar($maindownload);    
}



function brokendownloadS($lid, $modifysubmitter) {
$lid = intval($lid);
global $prefix, $db, $user, $cookie, $module_name, $ns_details, $ns_comments, $ns_editorial, $ns_recommend;
$ns_details = 1;
$ns_comments = 1;
$ns_editorial = 1;
$ns_recommend = 1;
$db->sql_query("insert into ".$prefix."_downloads_modrequest values (NULL, $lid, 0, 0, '', '', '', '$modifysubmitter', 1, '$auth_name', '$email', '$filesize', '$version', '$homepage', '$ns_compat', 'ns_des_img', '$ns_mirror_one', '$ns_mirror_two')");
$result = $db->sql_query("select cid, title from ".$prefix."_downloads_downloads where lid='$lid'");
list($cid, $title) = $db->sql_fetchrow($result);
$cid = intval($cid);
$ttitle = preg_replace ("/_/", " ", $title);
include_once("header.php");
menu(1);
echo "<a name=\"reportbroken\">";
ns_mod_title3("report_broken",""._REPORTBROKEN."");
OpenTable();
ns_dl_OpenTable();
ns_dl_cat_jump($cid);
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><center><font color=\"#CC0000\"><strong>$ttitle</strong></font><br /><br />";
downloadinfomenu($cid, $lid, $ttitle);
echo "<br /><br />"._THANKSFORINFO."<br /><br />"._LOOKTOREQUEST."<br /><br /><br />";
ns_dl_CloseTable();
CloseTable();
$maindownload = 1;
ns_dl_link_bar($maindownload);
}



function modifydownloadrequest($lid) {
$lid = intval($lid);
global $prefix, $db, $user, $module_name, $anonymous;
$result_di = $db->sql_query("select ns_dl_des_img from ".$prefix."_ns_downloads_desc_img");
list($ns_dl_des_img) = $db->sql_fetchrow($result_di);
$result_add = $db->sql_query("select ns_dl_allow_html, ns_dl_affiliate_links, ns_dl_add_email, ns_dl_add_filesize, ns_dl_add_compat, ns_dl_mod, ns_dl_mod_anon, ns_dl_owner_mod from ".$prefix."_ns_downloads_add_modify");
list($ns_dl_allow_html, $ns_dl_affiliate_links, $ns_dl_add_email, $ns_dl_add_filesize, $ns_dl_add_compat, $ns_dl_mod, $ns_dl_mod_anon, $ns_dl_owner_mod) = $db->sql_fetchrow($result_add); 
$result_sub = $db->sql_query("select submitter from ".$prefix."_downloads_downloads where lid='$lid'");
list($submitter) = $db->sql_fetchrow($result_sub);
$result_up = $db->sql_query("select ns_dl_allow_file, ns_dl_allow_img from ".$prefix."_ns_downloads_upload");
list($ns_dl_allow_file, $ns_dl_allow_img) = $db->sql_fetchrow($result_up);
$ns_mod_allow = "yes";
if(is_user($user)) {
    $user2 = base64_decode($user);
    $cookie = explode(":", $user2);
    cookiedecode($user);
    $ratinguser = $cookie[1];
} else {
    $ratinguser = "$anonymous";
}
if ($ns_dl_owner_mod == 1) {
    if ($ratinguser != $submitter) {
    $ns_mod_allow = "no";
    include_once("header.php");
    menu(1);
    echo "<a name=\"mod\">";    	
    ns_mod_title3("modify_request",""._MODIFYDL."");
    OpenTable();
    ns_dl_OpenTable();
    echo "<br /><br /><center>"._DONLYORIGOWNERMODIFY."";
    echo "<br /><br />"._GOBACK."</center><br />";
    ns_dl_CloseTable();
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
    die();
    }
}
if ($ns_dl_owner_mod == 0) {
    if ($ns_dl_mod == 0) {
    $ns_mod_allow = "no";
    include_once("header.php");
    menu(1);
    echo "<a name=\"mod\">";
    ns_mod_title3("modify_request",""._MODIFYDL."");
    OpenTable();
    ns_dl_OpenTable();
    echo "<br /><br /><center>"._DNODOWNMODIFY."";
    echo "<br /><br />"._GOBACK."</center><br />";
    ns_dl_CloseTable();
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
    die();
    }
} 
if ($ns_dl_owner_mod == 0) {
    if (($ns_dl_mod == 1) && ($ns_dl_mod_anon == 0 && $ratinguser=="$anonymous")) {
    $ns_mod_allow = "no";
    include_once("header.php");
    menu(1);
    echo "<a name=\"mod\">";
    ns_mod_title3("modify_request",""._MODIFYDL."");
    OpenTable();
    ns_dl_OpenTable();
    echo "<br /><br /><center>"._DONLYREGUSERSMODIFY."";
    echo "<br /><br />"._GOBACK."</center><br />";
    ns_dl_CloseTable();
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
    die();
    }
}
if ($ns_mod_allow == "yes") {
include_once("header.php");
menu(1);
echo "<a name=\"mod\">";
ns_mod_title3("modify_request",""._MODIFYDL."");
OpenTable();
ns_dl_OpenTable();
$result = $db->sql_query("select cid, title, url, description, name, email, filesize, version, homepage, ns_compat, ns_des_img, ns_mirror_one, ns_mirror_two from ".$prefix."_downloads_downloads where lid='$lid'");
list($cid, $title, $url, $description, $auth_name, $email, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two) = $db->sql_fetchrow($result);
$cid = intval($cid);
$title = stripslashes($title);
$description = stripslashes($description);
echo "<center><font class=\"option\"><strong>"._REQUESTDOWNLOADMOD."";
echo "</strong></font></center><br /><font class=\"content\">";
echo "<form action=\"modules.php?name=$module_name#nssubmit\" method=\"post\" ";
echo "name=\"add_download\">";
echo "<table cellpadding=\"7\" cellspacing=\"0\" border=\"0\" align=\"center\">";
echo "<tr><td align=\"left\"><strong>"._DOWNLOADID.": $lid</strong></td></tr>";
echo "<tr><td align=\"left\"><strong>"._DOWNLOADNAME.":</strong> ";
echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font><br />";
echo "<input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\">";
echo "</td></tr>";
echo "<tr><td align=\"left\"><strong>"._FILEURL.":</strong> ";
echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font><br />";
echo "<input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"255\">&nbsp;&nbsp;";
	if ($ns_dl_allow_file == 1) {
		ns_dl_upload();
		echo "<input type=\"button\" value=\""._NSUPLOADDESIMG."\" onClick=\"newWindow";
		echo "('modules.php?name=$module_name&amp;file=ns_uploads_file";
		echo "&amp;type=file','window2')\">";
    }
echo "</td></tr>";
echo "<tr><td align=\"left\"><strong>"._NSDOWNLOADMIRROR.":<br />";
echo "<input type=\"text\" name=\"ns_mirror_one\" value=\"$ns_mirror_one\" ";
echo "size=\"60\" maxlength=\"255\">";
echo "</td></tr>";
echo "<tr><td align=\"left\"><strong>"._NSDOWNLOADMIRROR." 2:<br />";
echo "<input type=\"text\" name=\"ns_mirror_two\" value=\"$ns_mirror_two\" ";
echo "size=\"60\" maxlength=\"255\">";
echo "</td></tr>";
echo "<tr><td align=\"left\"><strong>"._CATEGORY.":</strong> ";
echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font><br />";
echo "<select name=\"cat\">";
$result2=$db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories order by parentid,title");
    while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
        $cid2 = intval($cid2);
	if ($cid2 == $cid) { 
	    $sel = "selected"; 
	} else { 
	    $sel = ""; 
	}
	if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
	    echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
    }
echo "</select></td></tr>";
echo "<tr><td align=\"left\"><strong>"._LDESCRIPTION."</strong> ";
echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font><br />";
echo "<textarea name=\"description\" cols=\"75\" rows=\"22\">$description</textarea>";
    if ($ns_dl_allow_html == 1) {
    	echo "<br />"._HTMLISFINE."";
    } else {
    	echo "<br />"._HTMLOFF."";
    }
echo "</td></tr>";
    if ($ns_dl_des_img == 1) {
	    echo "<tr><td align=\"left\"><strong>"._NSDESIMAGE.":</strong><br />";
	    echo "<input type=\"text\" name=\"ns_des_img\" value=\"$ns_des_img\" size=\"40\" ";
		echo "maxlength=\"100\">";
	    echo "&nbsp;&nbsp;";
		if ($ns_dl_allow_img == 1) {
	    	    ns_dl_upload();
	    	    echo "<input type=\"button\" value=\""._NSUPLOADDESIMG."\" onClick=\"newWindow";
	    	    echo "('modules.php?name=$module_name&amp;file=ns_uploads_file";
	    	    echo "&amp;type=image','window2')\">";
        }	
	    	echo "</td></tr>";	
        } else {
    	    echo "<input type=\"hidden\" name=\"ns_des_img\" value=\"\">";
        }
echo "<tr><td align=\"left\"><strong>"._AUTHORNAME.":</strong><br />";
echo "<input type=\"text\" name=\"auth_name\" value=\"$auth_name\" size=\"30\" maxlength=\"80\">";
echo "</td></tr>";
echo "<tr><td align=\"left\"><strong>"._AUTHOREMAIL.":</strong> ";
    if ($ns_dl_add_email == 1) {
    	echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font>";
    }
echo "<br /><input type=\"text\" name=\"email\" value=\"$email\" size=\"30\" maxlength=\"80\"></td></tr>";
echo "<tr><td align=\"left\"><strong>"._NSCOMPAT.":</strong> ";
    if ($ns_dl_add_compat == 1) {
    	echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font>";
    }
echo "<br /><input type=\"text\" name=\"ns_compat\" size=\"30\" ";
echo "value=\"$ns_compat\" size=\"35\" maxlength=\"35\"></td></tr>";
echo "<tr><td align=\"left\"><strong>"._FILESIZE.":</strong> ";
    if ($ns_dl_add_filesize == 1) {
    	echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font> ";
    }
echo "<br /><input type=\"text\" name=\"filesize\" value=\"$filesize\" ";
echo "size=\"12\" maxlength=\"11\"> ";
echo "<span style=\"vertical-align=30%\"><font echo class=\"tiny\">";
echo "("._INBYTES.")</font></span></td></tr>";
echo "<tr><td align=\"left\"><strong>"._VERSION.":</strong>";
echo "<br /><input type=\"text\" name=\"version\" value=\"$version\" ";
echo "size=\"11\" maxlength=\"10\"></td></tr>";
echo "<tr><td align=\"left\"><strong>"._HOMEPAGE.":</strong>";
echo "<br /><input type=\"text\" name=\"homepage\" value=\"$homepage\" ";
echo "size=\"50\" maxlength=\"200\"></td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";
echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
echo "<input type=\"hidden\" name=\"modifysubmitter\" value=\"$ratinguser\">";
echo "<input type=\"hidden\" name=\"d_op\" value=\"modifydownloadrequestS\">";
echo "<input type=\"submit\" value=\""._SENDREQUEST."\" title=\""._SENDREQUEST."\">&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSBCANCEL."\" title=\""._NSBCANCEL."\" ";
echo "onClick=\"window.location='javascript:history.go(-1)'\">";
echo "</td></tr>";
echo "</table></form>";
ns_dl_CloseTable();
CloseTable();
$maindownload = 1;
ns_dl_link_bar($maindownload);
    } 
}



function modifydownloadrequestS($lid, $cat, $title, $url, $description, $modifysubmitter, $auth_name, $email, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two) {
$lid = intval($lid);
global $prefix, $db, $user, $module_name;
$result_mr = $db->sql_query("select ns_dl_mod, ns_dl_mod_anon from ".$prefix."_ns_downloads_add_modify");
list($ns_dl_mod, $ns_dl_mod_anon) = $db->sql_fetchrow($result_mr);

/////////////////////////////////////////////////////////////////

    if ($ns_dl_mod != 1) {
    Header("Location: modules.php?name=$module_name");
    die(); 
	}

/////////////////////////////////////////////////////////////////

if(is_user($user)) {
	$user2 = base64_decode($user);
	$cookie = explode(":", $user2);
	cookiedecode($user);
	$ratinguser = $cookie[1];
} else {
	$ratinguser = "$anonymous";
}
$blocknow = 0;

//////////////////////////////////////////////////////////////////

    if ($ns_dl_mod_anon != 1 && (!is_user($user))) { 
	$blocknow = 1; 
	include_once("header.php");
	menu(1);
	echo "<a name=\"nssubmit\">";
	ns_mod_title3("modify_request",""._MODIFYDL."");
	OpenTable();
	ns_dl_OpenTable();
	echo "<br /><br /><center>"._DONLYREGUSERSMODIFY."";
	echo "<br /><br />"._GOBACK."</center><br />";
	ns_dl_CloseTable();
	CloseTable();
	$maindownload = 1;
    ns_dl_link_bar($maindownload);
	die();
    }

//////////////////////////////////////////////////////////////////

include_once("ns_error.php");
    if ($blocknow != 1) {
    	$cat = explode("-", $cat);
    	if ($cat[1]=="") {
    	    $cat[1] = 0;
    	}
    $title = stripslashes(FixQuotes($title));
    $url = stripslashes(FixQuotes($url));
	$ns_mirror_one = stripslashes(FixQuotes($ns_mirror_one));
	$ns_mirror_two = stripslashes(FixQuotes($ns_mirror_two));
/*
    if (strtolower(substr($url,0,7)) != "http://") { 
    	$url = "http://" . $url; 
    }
*/
    $description = stripslashes(FixQuotes($description));
    if ($ns_dl_allow_html == 0) {
		$description = FixQuotes(filter_text($description, "nohtml"));
    }
    $auth_name = stripslashes(FixQuotes($auth_name));
    $email = stripslashes(FixQuotes($email));
    $filesize = preg_replace("/\./","",$filesize);
    $filesize = preg_replace("/\,/","",$filesize);
    $filesize = intval($filesize);
    $cat[0] = intval($cat[0]);
    $cat[1] = intval($cat[1]);
    $homepage = stripslashes(FixQuotes($homepage));
    if ($homepage != "") {
        if (strtolower(substr($homepage,0,7)) != "http://") { 
    		$homepage = "http://". $homepage; 
        } 
    }
    $db->sql_query("insert into ".$prefix."_downloads_modrequest values (NULL, $lid, $cat[0], $cat[1], '$title', '$url', '$description', '$ratinguser', 0, '$auth_name', '$email', '$filesize', '$version', '$homepage', '$ns_compat', '$ns_des_img', '$ns_mirror_one', '$ns_mirror_two')");
	include_once("header.php");
	menu(1);
	echo "<br />";
	echo "<a name=\"nssubmit\">";
	ns_mod_title3("modify_submit",""._NSDLMODSUBMIT."");
	OpenTable();
	ns_dl_OpenTable();
    echo "<br /><center><font class=\"content\"><strong>"._THANKSFORINFO2."<br />";
    echo "<br />"._LOOKTOREQUEST."</strong></font><br /><br />";
    echo "[ <a href=\"modules.php?name=$module_name\">"._DOWNLOADSMAIN."</a> ]";
    echo "</center><br />";
	ns_dl_CloseTable();
	CloseTable();
	include_once("footer.php");
    }
}



function rateinfo($lid) {
    $lid = intval($lid);
    global $prefix, $db;
    $db->sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 where lid=$lid");
    $result = $db->sql_query("select url from ".$prefix."_downloads_downloads where lid=$lid");
    list($url) = $db->sql_fetchrow($result);
    Header("Location: $url");							
}



function addrating($cid, $ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments) {	
$rating = intval($rating);
$ratinglid = intval($ratinglid);
global $prefix, $db, $cookie, $user, $module_name, $sitename, $ns_details, $ns_comments, $ns_editorial;
$result_gi = $db->sql_query("select ns_dl_anon_wait_days, ns_dl_outside_wait_days from ".$prefix."_ns_downloads_rating");
list($ns_dl_anon_wait_days, $ns_dl_outside_wait_days) = $db->sql_fetchrow($result_gi);
$ns_details = 1;
$ns_comments = 1;
$ns_editorial = 1;
$passtest = "yes";
include_once("header.php");
menu(1);
echo "<a name=\"ratedownload\">";
    if(is_user($user)) {
		$user2 = base64_decode($user);
   		$cookie = explode(":", $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
    } else if ($ratinguser == "outside") {
		$ratinguser = "outside";
    } else {
		$ratinguser = "$anonymous";
    }
$results3 = $db->sql_query("select title FROM ".$prefix."_downloads_downloads WHERE lid='$ratinglid'");
while(list($title)=$db->sql_fetchrow($results3)) $ttitle = $title;
/* Make sure only 1 anonymous from an IP in a single day. */
$ip = getenv("REMOTE_HOST");
    if (empty($ip)) {
       $ip = getenv("REMOTE_ADDR");
    }
    /* Check if Rating is Null */
    if ($rating == "-----") {
		ns_mod_title3("rate_error",""._NSDLRERROR."");
		OpenTable();
		ns_dl_OpenTable();
		ns_dl_cat_jump($cid);
		ns_dl_CloseTable();
		ns_dl_OpenTable();
		$error = "nullerror";
    	completevote($error);
		$passtest = "no";
    }
    /* Check if Download POSTER is voting (UNLESS Anonymous users allowed to post) */
    if ($ratinguser != $anonymous && $ratinguser != "outside") {
    	$result=$db->sql_query("select submitter from ".$prefix."_downloads_downloads where lid='$ratinglid'");
    	while(list($ratinguserDB)=$db->sql_fetchrow($result)) {
    	    if ($ratinguserDB==$ratinguser) {
	        	ns_mod_title3("rate_error",""._NSDLRERROR."");
	        	OpenTable();
				ns_dl_OpenTable();
				ns_dl_cat_jump($cid);
				ns_dl_CloseTable();
	        	ns_dl_OpenTable();
    			$error = "postervote";
    	        completevote($error);
				$passtest = "no";
    	    }
   		}
    }
    /* Check if REG user is trying to vote twice. */
    if ($ratinguser!=$anonymous && $ratinguser != "outside") {
    	$result=$db->sql_query("select ratinguser from ".$prefix."_downloads_votedata where ratinglid=$ratinglid");
    	while(list($ratinguserDB)=$db->sql_fetchrow($result)) {
    	    if ($ratinguserDB==$ratinguser) {
	        	ns_mod_title3("rate_error",""._NSDLRERROR."");
	        	OpenTable();
				ns_dl_OpenTable();
				ns_dl_cat_jump($cid);
				ns_dl_CloseTable();
	        	ns_dl_OpenTable();
				downloadinfomenu($cid, $lid,$ttitle);
				echo "<br />";
    	        $error = "regflood";
                completevote($error);
				$passtest = "no";
	    	}
        }
    }
    /* Check if ANONYMOUS user is trying to vote more than once per day. */
    if ($ratinguser == $anonymous){
    	$yesterdaytimestamp = (time()-(86400 * $ns_dl_anon_wait_days));
    	$ytsDB = Date("Y-m-d H:i:s", $yesterdaytimestamp);
    	$result = $db->sql_query("select * FROM ".$prefix."_downloads_votedata WHERE ratinglid=$ratinglid AND ratinguser='$anonymous' AND ratinghostname = '$ip' AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < $ns_dl_anon_wait_days");
        $anonvotecount = $db->sql_numrows($result); 
    	if ($anonvotecount >= 1) {
	    	ns_mod_title3("rate_error",""._NSDLRERROR."");
	    	OpenTable();
			ns_dl_OpenTable();
			ns_dl_cat_jump($cid);
			ns_dl_CloseTable();
	    	ns_dl_OpenTable();
    	    $error = "anonflood";
            completevote($error);
    	    $passtest = "no";
    	}
    }
    /* Check if OUTSIDE user is trying to vote more than once per day. */
    if ($ratinguser == "outside") {
    	$yesterdaytimestamp = (time()-(86400 * $ns_dl_outside_wait_days));
    	$ytsDB = Date("Y-m-d H:i:s", $yesterdaytimestamp);
    	$result=$db->sql_query("select * FROM ".$prefix."_downloads_votedata where ratinglid='$ratinglid' and ratinguser='outside' and ratinghostname='$ip' and TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < $ns_dl_outside_wait_days");
        $outsidevotecount = $db->sql_numrows($result); 
    	if ($outsidevotecount >= 1) {
	    	ns_mod_title3("rate_error",""._NSDLRERROR."");
	    	OpenTable();
			ns_dl_OpenTable();
			ns_dl_cat_jump($cid);
			ns_dl_CloseTable();
	    	ns_dl_OpenTable();
    	    $error = "outsideflood";
            completevote($error);
    	    $passtest = "no";
    	}
    }
    /* Passed Tests */
    if ($passtest == "yes") {
    	$comment = stripslashes(FixQuotes($comment));
		$db->$db->sql_query("INSERT into ".$prefix."_downloads_votedata values (NULL,'$ratinglid', '$ratinguser', '$rating', '$ip', '$ratingcomments', now())");	
        $voteresult = $db->sql_query("select rating, ratinguser, ratingcomments from ".$prefix."_downloads_votedata where ratinglid = $ratinglid");
		$totalvotesDB = $db->sql_numrows($voteresult);
        $totalvotesDB = intval($totalvotesDB);
		include_once("modules/$module_name/voteinclude.php");     
        $db->sql_query("UPDATE ".$prefix."_downloads_downloads SET downloadratingsummary='$finalrating', totalvotes='$totalvotesDB', totalcomments='$truecomments' where lid='$ratinglid'");
		ns_mod_title3("rate_ok",""._NSDLROK."");
		OpenTable();
		ns_dl_OpenTable();
		ns_dl_cat_jump($cid);
		ns_dl_CloseTable();
		ns_dl_OpenTable();
        $error = "none";
        completevote($error);
        echo "<br /><center><font class=\"content\">"._THANKSTOTAKETIME." <strong>$sitename</strong>.<br />";
        echo ""._DLETSDECIDE."</font></center><br />";
    	if ($ratinguser=="outside") {
        	$result2 = $db->sql_query("select title, url from ".$prefix."_downloads_downloads where lid='$lid'");
        	list($title, $url) = $db->sql_fetchrow($result2);
        	$ttitle = preg_replace ("/ /", "_", $title);
			echo "<center><font class=\"content\">".WEAPPREACIATE." <strong>$sitename</strong>!";
			echo "<br />"._RETURNTO."<a href=\"$url\">$ttitle</a></font><center><br /><br />";
    	}
    }



//    completevotefooter($cid, $ratinglid, $ttitle, $ratinguser);

	downloadinfomenu($cid, $lid,$ttitle);
	echo "<br />";
	ns_dl_CloseTable();
	CloseTable();
    ns_dl_link_bar($maindownload = 1);
}



function completevote($error) {
global $prefix, $db, $module_name;
$result_i = $db->sql_query("select ns_dl_anon_wait_days, ns_dl_outside_wait_days from ".$prefix."_ns_downloads_rating");
list($ns_dl_anon_wait_days, $ns_dl_outside_wait_days) = $db->sql_fetchrow($result_i);
if ($error == "none") {
echo "<br /><center><font class=\"content\"><strong>"._COMPLETEVOTE1."</strong></font></center>";
}
if ($error == "anonflood") {
echo "<br /><center><font class=\"content\"><strong>"._COMPLETEVOTE2." $ns_dl_anon_wait_days ";
if ($ns_dl_anon_wait_days != 1) {
echo ""._COMPLETEVOTE22."";
} else {
echo ""._COMPLETEVOTE23."";
}
echo "</strong></font></center>";
}
if ($error == "regflood") {
echo "<br /><center><font class=\"content\"><strong>"._COMPLETEVOTE3."</strong></font></center>";
}
if ($error == "postervote") {
echo "<br /><center><font class=\"content\"><strong>"._COMPLETEVOTE4."</strong></font></center>";
}
if ($error == "nullerror") {
echo "<br /><center><font class=\"content\"><strong>"._COMPLETEVOTE5."</strong></font></center>";
}
if ($error == "outsideflood") {
echo "<br /><center><font class=\"content\"><strong>"._COMPLETEVOTE6." $ns_dl_outside_wait_days ";
if ($ns_dl_outside_wait_days != 1) {
echo ""._COMPLETEVOTE22."";
} else {
echo ""._COMPLETEVOTE23."";
}
echo "</strong></font></center>";
    }
}



function ratedownload($cid, $lid, $user, $ttitle) {
$lid = intval($lid);
global $prefix, $db, $cookie, $datetime, $module_name, $ns_theme, $ns_details, $ns_editorial, $ns_comments;
$ns_details = 1;
$ns_comments = 1;
$ns_editorial = 1;
$transfertitle = preg_replace ("/_/", " ", $ttitle);
$displaytitle = $transfertitle;
$ip = getenv("REMOTE_HOST");
if (empty($ip)) {
   $ip = getenv("REMOTE_ADDR");
}
include_once("header.php");
menu(1);
echo "<a name=\"rate\">";
ns_mod_title3("rate_download",""._NSDLRATEDL."");
OpenTable();
ns_dl_OpenTable();
ns_dl_cat_jump($cid);
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><center><strong>$displaytitle</strong><br /><br />";
downloadinfomenu($cid, $lid, $ttitle);
echo "</center><br /><br /><br />";
echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\" border=\"0\" align=\"center\">";
echo "<font class=\"content\">";
echo "<tr><td width=\"8\"><strong>&#8226;</strong></td><td align=\"left\">"._RATENOTE1."</td></tr>";
echo "<tr><td width=\"8\"><strong>&#8226;</strong></td><td align=\"left\">"._RATENOTE2."</td></tr>";
echo "<tr><td width=\"8\" valign=\"top\"><strong>&#8226;</strong></td>";
echo "<td align=\"left\">"._RATENOTE3."</td></tr>";
echo "<tr><td width=\"8\"><strong>&#8226;</strong></td>";
echo "<td align=\"left\">"._RATENOTE4." ";
echo "<a href=\"modules.php?name=$module_name&amp;d_op=TopRated#toprated\">";
echo ""._NDDLTOPDL."</a>.</td></tr>";
echo "<tr><td width=\"8\"><strong>&#8226;</strong></td><td align=\"left\">"._RATENOTE5."</td></tr>";
if(is_user($user)) {
    $user2 = base64_decode($user);
    $cookie = explode(":", $user2);
    echo "<tr><td width=\"8\"><strong>&#8226;</strong></td>";
    echo "<td align=\"left\">"._YOUAREREGGED."</td></tr>";
    cookiedecode($user);
    $auth_name = $cookie[1];
} else {
	echo "<tr><td width=\"8\"><strong>&#8226;</strong></td><td align=\"left\">"._YOUARENOTREGGED."</td></tr>";
	echo "<tr><td width=\"8\"><strong>&#8226;</strong></td><td align=\"left\">"._IFYOUWEREREG."</td></tr>";
	echo "<tr><td width=\"8\"><strong>&#8226;</strong></td><td align=\"left\">"._WHYNOTREGISTER."</td></tr>";
	$auth_name = "$anonymous";
}
echo "</table>";
echo "<form method=\"post\" action=\"modules.php?name=$module_name#ratedownload\">";
echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">";
echo "<tr><td align=\"center\">";
echo "<input type=\"hidden\" name=\"cid\" value=\"$cid\">";
echo "<input type=\"hidden\" name=\"ratinglid\" value=\"$lid\">";
echo "<input type=\"hidden\" name=\"ratinguser\" value=\"$auth_name\">";
echo "<input type=\"hidden\" name=\"ratinghost_name\" value=\"$ip\">";
echo "<font class=\"content\"><strong>"._NSCHOOSESC.":</strong></font><br />";
echo "<select name=\"rating\">";
echo "<option>-----</option>";
echo "<option>10</option>";
echo "<option>9</option>";
echo "<option>8</option>";
echo "<option>7</option>";
echo "<option>6</option>";
echo "<option>5</option>";
echo "<option>4</option>";
echo "<option>3</option>";
echo "<option>2</option>";
echo "<option>1</option>";
echo "</select>";
echo "<br /><br />";
if(is_user($user)) {
    echo "<strong>"._SCOMMENTS.":</strong><br />";
    echo "<textarea wrap=\"virtual\" cols=\"50\" rows=\"10\" name=\"ratingcomments\">";
    echo "</textarea>";
    echo "<br /><br />";
    echo "</font>";
} else {
    echo"<input type=\"hidden\" name=\"ratingcomments\" value=\"\">";
}
echo "<input type=\"submit\" value=\""._BRATERESOURCE."\" ";
echo "title=\"$displaytitle "._RATERESOURCE."\">";
echo "</td></tr></table></form>";
ns_dl_CloseTable(); 
$result_bf = $db->sql_query("select ns_dl_foot_button from ".$prefix."_ns_downloads_general");
list($ns_dl_foot_button) = $db->sql_fetchrow($result_bf);
ns_dl_OpenTable();
    if ($ns_dl_foot_button != 1) {
echo "<table align=\"center\" cellpadding=\"6\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"center\" valign=\"middle\">";
echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "</td><td align=\"center\" valign=\"middle\">";
echo "<font class=\"content\">";
echo "[ <a href=\"modules.php?name=$module_name&d_op=getit&amp;lid=$lid#dl\">";
echo ""._DOWNLOADNOW."</a> ]";
echo "</td><td align=\"center\" valign=\"middle\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">";
echo "</td></tr></table>";
    } else {
echo "<table align=\"center\" cellpadding=\"6\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"center\" valign=\"middle\">";
echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "</td><td align=\"center\" valign=\"middle\">";
echo "<input type=\"button\" value=\""._NSDLDLNOWL."\" title=\""._DOWNLOAD." $ttitle\" ";
echo "onClick=\"window.location = 'modules.php?name=$module_name&d_op=getit";
echo "&amp;lid=$lid#dl'\">";
echo "</td><td align=\"center\" valign=\"middle\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">";
echo "</td></tr></table>";
    }
ns_dl_CloseTable();
CloseTable();
$maindownload = 1;
ns_dl_link_bar($maindownload);
}


function CoolSize($size) {
    $mb = 1024*1024;
    if ( $size > $mb ) {
        $mysize = sprintf ("%01.2f",$size/$mb) . " MB";
    } elseif ( $size >= 1024 ) {
        $mysize = sprintf ("%01.2f",$size/1024) . " Kb";
    } else {
        $mysize = $size . " bytes";
    }
    return $mysize;
}



if (isset($ratinglid) && isset ($ratinguser) && isset ($rating)) {
    $ret = addrating($cid, $ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments);
}


switch($d_op) {

    default:
    index();
    break;

    case "menu":
    menu($maindownload);
    break;

    case "AddDownload":
	require_once("ns_add_download_file.php");
    AddDownload();
    break;

    case "NewDownloads":
    NewDownloads($newdownloadshowdays);
    break;
	
    case "NewDownloadsDate":
    NewDownloadsDate($selectdate);
    break;

    case "CoolSize":
    CoolSize($size);
    break;

    case "TopRated":
    TopRated($ratenum, $ratetype);
    break;
	
    case "MostPopular":
    MostPopular($ratenum, $ratetype);
    break;

    case "viewdownload":
	require_once("ns_view_download_file.php");
    viewdownload($cid, $min, $orderby, $show);
    break;

    case "brokendownload":
    brokendownload($lid);
    break;
	
    case "modifydownloadrequest":	
    modifydownloadrequest($lid);
    break;
    
    case "modifydownloadrequestS":	
    modifydownloadrequestS($lid, $cat, $title, $url, $description, $modifysubmitter, $auth_name, $email, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two);
    break;
   
    case "brokendownloadS":
    brokendownloadS($lid, $modifysubmitter);
    break;
    
    case "getit":
    getit($lid);
    break;

    case "ns_dl_get_mirror_one":
    ns_dl_get_mirror_one($lid);
    break;

    case "ns_dl_get_mirror_two":
    ns_dl_get_mirror_two($lid);
    break;

    case "Add":
	require_once("ns_add_download_file.php");
	require_once("ns_error.php");
#    Add($title, $url, $auth_name, $cat, $description, $email, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two);
    Add($title, $url, $auth_name, $cat, $desc, $email, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two);
    break;

    case "search":
	require_once("ns_search_file.php");
    search($query, $min, $orderby, $show);
    break;

    case "rateinfo":
    rateinfo($lid, $user, $title);
    break;

    case "ratedownload":
    ratedownload($cid, $lid, $user, $ttitle);
    break;

    case "addrating":
    addrating($cid, $ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments, $user);
    break;

    case "viewdownloadcomments":
    viewdownloadcomments($cid, $lid, $ttitle);
    break;

    case "outsidedownloadsetup":
    outsidedownloadsetup($lid);
    break;

    case "viewdownloadeditorial":
    viewdownloadeditorial($cid, $lid, $ttitle);
    break;

    case "viewdownloaddetails":
	require_once("ns_add_details_file.php");
    viewdownloaddetails($cid, $lid, $ttitle);				
    break;

    case "ns_dl_rec_dl":
	require_once("ns_recommend_file.php");
    ns_dl_rec_dl($cid, $lid, $ttitle, $dref);				
    break;

    case "ns_dl_send_rec":
	require_once("ns_recommend_file.php");
    ns_dl_send_rec($dref, $rip, $cid, $lid, $ttitle, $ns_rec_yname, $ns_rec_yemail, $ns_friend_name, $ns_friend_email, $ns_rec_send_msg);				
    break;

    case "ns_dl_rec_sent":
	require_once("ns_recommend_file.php");
    ns_dl_rec_sent($cid, $lid, $ttitle);				
    break;

    case "ns_getit":
	require_once("ns_get_download_file.php");
    ns_getit($cid, $lid, $type);				
    break;

    case "ns_dl_auth_full_list":
	require_once("ns_auth_list_file.php");
    ns_dl_auth_full_list($author);				
    break;

    case "ns_pass_help":
	require_once("ns_get_download_file.php");
    ns_pass_help($thepass);				
    break;

    case "ns_get_download":
	require_once("ns_get_download_file.php");
    ns_get_download($cid, $lid, $ftid, $passcode, $checkpass, $title, $dref);				
    break;

    case "gfx":
	require_once("ns_get_download_file.php");
    gfx($random_num);				
    break;


}

?>

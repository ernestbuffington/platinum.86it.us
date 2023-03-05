<?php
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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $redirect, $mode, $f, $t, $sitekey, $nukeurl, $user, $cookie, $prefix, $user_prefix, $db, $anonymous, $gfx_chk;
include_once("modules/Your_Account/includes/functions.php");
$ya_config = ya_get_configs();
$content = "";
// User Login
if (is_user($user)) {
    $memname = $cookie[1];
    $content .= ""._BWEL.", <strong>$memname</strong>.<br />(<a href=\"modules.php?name=Your_Account&op=logout\">"._BLOGOUT."</a>)\n";
    $content .= "<hr noshade size=\"1\">\n";
    if(is_active("Private_Messages")) {
        list($uid) = $db->sql_fetchrow($db->sql_query("select user_id from $user_prefix"._users." where username='$memname'"));
        $newpms = $db->sql_numrows($db->sql_query("select privmsgs_to_userid from $prefix"._bbprivmsgs." where privmsgs_to_userid='$uid' and (privmsgs_type='1' OR privmsgs_type='5')"));
        $savpms = $db->sql_numrows($db->sql_query("select privmsgs_to_userid from $prefix"._bbprivmsgs." where privmsgs_to_userid='$uid' and privmsgs_type='3'"));
        $oldpms = $db->sql_numrows($db->sql_query("select privmsgs_to_userid from $prefix"._bbprivmsgs." where privmsgs_to_userid='$uid' and privmsgs_type='0'"));
        $totpms = $newpms + $oldpms + $savpms;
        $content .= "<a href=\"modules.php?name=Private_Messages\"><strong>"._BPM.":</strong></a><br />\n";
        $content .= "<big><strong>&middot;</strong></big> "._BUNREAD.": <strong>$newpms</strong><br />\n";
        $content .= "<big><strong>&middot;</strong></big> "._BREAD.": <strong>$oldpms</strong><br />\n";
        $content .= "<big><strong>&middot;</strong></big> "._BSAVED.": <strong>$savpms</strong><br />\n";
        $content .= "<big><strong>&middot;</strong></big> "._BTT.": <strong>$totpms</strong><br />\n";
        $content .= "<hr noshade size=\"1\">\n";
    }
} else {
    mt_srand ((double)microtime()*1000000);
    $maxran = 10 * intval($ya_config['codesize']);
    $random_num = mt_rand(0, $maxran);
    $content .= ""._BWEL.", <strong>$anonymous</strong><br />\n<br />\n";
    $content .= "<table border=0 cellpadding=0 cellspacing=0>\n";
    $content .= "<tr><form action=\"modules.php?name=Your_Account\" method=\"post\">\n";
    $content .= "<td>"._BNICK.": <input type=\"text\" name=\"username\" size=\"10\" maxlength=\"25\"><br />\n";
    $content .= ""._BPASS.": <input type=\"password\" name=\"user_password\" size=\"10\" maxlength=\"20\" AutoComplete=\"off\"><br />\n";
/*****[BEGIN]******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
    $gfxchk = array(2,4,5,7);
    $content .= security_code($gfxchk);
/*****[END]********************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
    $content .="<input type=\"hidden\" name=\"redirect\" value=$redirect>\n";
    $content .="<input type=\"hidden\" name=\"mode\" value=$mode>\n";
    $content .="<input type=\"hidden\" name=\"f\" value=$f>\n";
    $content .="<input type=\"hidden\" name=\"t\" value=$t>\n";
    $content .="<input type=\"hidden\" name=\"op\" value=\"login\">\n";
    $content .= "<input type=\"submit\" value=\""._BLOGIN."\"> (<a href=\"modules.php?name=Your_Account&op=new_user\">"._BREG."</a>)\n";
    $content .= "</td>\n";
    $content .= "</form></tr>\n";
    $content .= "</table>\n";
}
?>

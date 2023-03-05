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
/* Tutorials Module v.1.1.2                                   COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2002 - 2006 by http://www.portedmods.com               */
/*     Mighty_Y - Yannick Reekmans             (mighty_y@portedmods.com)*/
/*                                                                      */
/* See TechGFX.com for detailed information on the Tutorials Module     */
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */
/************************************************************************/
global $admin_file;
if(empty($admin_file)){
  $admin_file="admin";
}
function menu($main=0, $t_title='') {
    global $module_name, $admin, $user, $db, $prefix, $cookie, $tutconfig, $admin_file;
    if ($t_title!=''){
    title(_TUTMAINTUTMODULE.": ".$t_title);
    }else{
    title(_TUTMAINTUTMODULE);
    }
    OpenTable();
    echo"<table width=\"100%\"><tr><td width=\"25%\" align=\"left\">";
    echo "<font class=\"content\">";
    if ($main != 1) {
	echo "<a href=\"modules.php?name=$module_name\">"._TUTMAINTUTORIALSMAIN."</a><br />";
    }
    echo "<a href=\"modules.php?name=$module_name&t_op=NewTutorials\">"._TUTMAINNEW."</a>"
	."<br /><a href=\"modules.php?name=$module_name&t_op=PopularTutorials\">"._TUTMAINPOPULAR."</a>"
	."<br /><a href=\"modules.php?name=$module_name&t_op=TopTutorials\">"._TUTMAINTOPRATED."</a>";
    if (is_user($user)){
        echo "<br /><a href=\"modules.php?name=$module_name&t_op=FavoriteTutorials\">"._TUTMAINFAVORITE."</a>";
    }
    if ((is_user($user)) && ($tutconfig['submit_on'] == 1)){
        echo "<br /><a href=\"modules.php?name=$module_name&file=submit\">"._TUTMAINSUBMITTUT."</a>";
    }
    if (is_admin($admin)){
    echo "<br /><a href=\"".$admin_file.".php?op=tutorials\">"._TUTADMIN_PANEL."</a>";
    }
    echo "</font></center>";
    echo"</td><td width=\"50%\" align=\"left\" valign=\"middle\">";
    echo "<center><form action=\"modules.php?name=$module_name&t_op=search\" method=\"post\">"
	."<font class=\"content\"><input type=\"text\" size=\"25\" name=\"query\"><br /><input type=\"submit\" value=\""._TUTMAINSEARCH."\"></font>"
	."</form>";
    if (is_user($user)){
    echo "</td><td width=\"25%\" align=\"left\" valign=\"middle\">";
$sql = "SELECT " . $prefix . "_tutorials_tutorials.t_title, " . $prefix . "_tutorials_favorites.t_id
    FROM " . $prefix . "_tutorials_favorites LEFT JOIN " . $prefix . "_tutorials_tutorials
    ON " . $prefix . "_tutorials_favorites.t_id = " . $prefix . "_tutorials_tutorials.t_id
    WHERE " . $prefix . "_tutorials_favorites.user_id = '" . $cookie[0] . "' AND " . $prefix . "_tutorials_favorites.showlist = '1'";
$result = $db->sql_query($sql);
$i = 0;
while ( $row = $db->sql_fetchrow($result) ) {
echo "<a href=\"modules.php?name=".$module_name."&t_op=showtutorial&pid=".$row['t_id']."\">".$row['t_title']."</a>";
if ($i < 5){
echo "<br />";
}
$i++;
}
if ($i < 5){
$num = 5 - $i;
echo "<strong><center>"._TUTMAINTOP5STILL1." ".$num." "._TUTMAINTOP5STILL2."</center></strong>";
}
    }else{
    echo "</td><td width=\"25%\" align=\"center\" valign=\"middle\">";
    echo ""._TUTMAINLOGINFAV."";
    }
    echo"</td></tr></table>";
    CloseTable();
}

?>

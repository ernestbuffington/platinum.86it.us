<?php



#####################################################

#													#

#	Universal Module 2.5							#

#	For PHP-Nuke 6.5+								#

#	By Barry Caplin - http://www.e-devstudio.com	#

#													#

#	This is software is bound by the terms of the	#

#	license distrubuted with it. 					#

#	Please read license.txt							#

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



global $prefix, $db, $modulename, $mainprefix, $admin;



$boxtitle = ""._RELATED."";

$boxstuff = "<font class=\"content\">";



unset($location);

$links = array();

$hrefs = array();

$pos = 0;

while (!(($pos = strpos($bodytext,"<",$pos)) === false)) {

    $pos++;

    $endpos = strpos($bodytext,">",$pos);

    $tag = substr($bodytext,$pos,$endpos-$pos);

    $tag = trim($tag);

    if (isset($location)) {

        if (!strcasecmp(strtok($tag," "),"/A")) {

            $link = substr($bodytext,$linkpos,$pos-1-$linkpos);

            $links[] = $link;

            $hrefs[] = $location;

            unset($location);

        }

	$pos = $endpos+1;

    } else {

	if (!strcasecmp(strtok($tag," "),"A")) {

	    if (preg_match("#HREF[ \t\n\r\v]*=[ \t\n\r\v]*\"([^\"]*)\"#i",$tag,$regs));

	    else if (preg_match("#HREF[ \t\n\r\v]*=[ \t\n\r\v]*([^ \t\n\r\v]*)#i",$tag,$regs));

	    else $regs[1] = "";

	    if ($regs[1]) {

	        $location = $regs[1];

	    }

	    $pos = $endpos+1;

	    $linkpos = $pos;

	} else {

	    $pos = $endpos+1;

	}

    }

}



for ($i=0; $i<sizeof($links); $i++) {

    if (strlen($links[$i]) > 20 AND !preg_match("# #", $links[$i])) {

	$alttext = "$links[$i]";

	$links[$i] = substr($links[$i],0,52) . '...';

    } else {

	$alttext = "";

    }

    $boxstuff .= "<strong><big>&middot;</big></strong> <a href=\"".$hrefs[$i]."\" target='blank' title='".stripslashes($alttext)."'>".stripslashes($links[$i])."</a><br>\n";

} 



$sql = "select name, url from ".$prefix."_".$mainprefix."_related where tid=$vid";

$number = $db->sql_numrows($db->sql_query($sql));

if ($number >= 1) {

	$result = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result)) {

    $name = stripslashes($row[name]);

    $url = $row[url];

    $boxstuff .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"$url\" target=\"new\">$name</a><br>\n";

} 

} else {

	$boxstuff .= "<center>"._NOITEMSSTORED."</center>\n";

}



if (is_admin($admin)) {

$boxstuff .= "<br><center><a href=\"modules.php?name=$modulename&file=admin&op=relatedadmin\">"._ADDRLINK."</a></center>\n";

}



$boxstuff .= "</font><br><hr noshade width=\"95%\" size=\"1\"><center><font class=\"content\"><strong>"._MOSTREAD.":</strong><br>\n";



$sql = "select id, title from ".$prefix."_".$mainprefix."_items order by views desc limit 0,1";

$result = $db->sql_query($sql);

$row = $db->sql_fetchrow($result);

$topstory = $row[id];

$ttitle = $row[title];

$ttitle = stripslashes($ttitle);



$boxstuff .= "<a href=\"modules.php?name=$modulename&op=ViewItems&vid=$topstory\">$ttitle</a></font></center><br>\n";





?>


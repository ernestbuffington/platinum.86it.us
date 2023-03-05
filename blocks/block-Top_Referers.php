<?php
/************************************************************************/
/* Top Referers block for PHP-Nuke                                      */
/* Copyright (c) 2004 by David Karn (david@halfsane.net)                */
/* http://www.webdever.net/                                             */
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
global $prefix, $db, $admin, $admin_file;
$ref = 10; // how many referers in block
$length = 14; // maximum url length
$shownum = TRUE; // show the ranks for the urls
$a = 1;
$sql = "SELECT rid, url FROM ".$prefix."_referer ORDER BY rid DESC";
$result = $db->sql_query($sql);
$name = array();
while ($row = $db->sql_fetchrow($result)) {
    $rid = $row[rid];
    $url = $row[url];
	$aa = parse_url($url);
	$url = $aa['host'];
	if (!isset($$url)){
		$$url = 0;
	}
	$$url++;
	$id{$url} = $rid;
	$names[$url] = $$url;
}
natsort($names);
arsort($names);

for($i=1;$i<=$ref;$i++ && current($names))
{
	$url = key($names);
	$in = current($names);
	$url2 = preg_replace('/www./', '', $url);
    if(strlen($url2) > $length) {
		$url2 = substr($url2,0,$length);
        $url2 .= "..";
    }
	if ($shownum == TRUE)
	{
	$content .= "$i: <a href=\"http://$url/\" target=\"new\">$url2</a> (in: $in)<br />";
	} else
	{
    $content .= "<a href=\"http://$url/\" target=\"new\">$url2</a> (in: $in)<br />";
    }
	$a++;
	next($names);
}
if (is_admin($admin)) {
    $total = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_referer"));
    $content .= "<br /><center>$total "._HTTPREFERERS."<br />[ <a href=\"".$admin_file.".php?op=delreferer\">"._DELETE."</a> ]</center>";
}
?>

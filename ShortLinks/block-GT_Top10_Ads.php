<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Top10_Ads.php")) {
    Header("Location: ../index.html");
    die();
}

global $prefix, $db, $currentlang, $multilingual;
$nowdate = date("Y-m-d");
$a = 1;
$sql = "select id_ads, title from ".$prefix."_nukec_ads_ads where active ='1' and validuntil > '$nowdate'";
if ($multilingual)
{
	$sql .= " and language='$currentlang'";
}
else
{
	$sql .= " and language=''";
}
$a = 1;
$sql .= " order by hits DESC limit 0,10";
$result = $db->sql_query($sql);
while(list($id_ads, $title) = $db->sql_fetchrow($result))
{
	if (strlen($title) > 18)
	{
		$title2 = substr("$title", 0,18)."...";
	}
	else
	{
		$title2 = $title;
	}
	$content .= "<strong><big>&middot;</big></strong>&nbsp;$a: <a href=\"advert-view-details-$id_ads.html\">$title2</a><br>";
	$a++;
}

?>
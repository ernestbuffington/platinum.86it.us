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
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
/************************************************************************/


if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}

global $prefix, $multilingual, $currentlang, $db, $bgcolor2;
$nowdatetmpblck = date("H i s m d Y");
$datearraytmpblck = explode (" ", $nowdatetmpblck);
$mktimeUnixblock = mktime($datearraytmpblck[0],$datearraytmpblck[1],$datearraytmpblck[2],$datearraytmpblck[3],$datearraytmpblck[4],$datearraytmpblck[5]);
if ($multilingual == 1) {
    $querylang = 'WHERE (alanguage=\''.$currentlang.'\' OR alanguage=\'\')';
} else {
    $querylang = '';
}

$content = '';
$sql = "SELECT id_ads, title, ads_desc, imageads, curr, price FROM nukec30_ads_ads WHERE active = '1' and validuntil > '".$mktimeUnixblock."' order by rand() DESC LIMIT 0,1";
$result = $db->sql_query($sql);
if ($db->sql_numrows($result)) {
    $content .= '<table width="100%" border="0">';
    while (list($id_ads, $title, $ads_desc, $imageads, $currencycodeB, $valuepriceB) = $db->sql_fetchrow($result)) {
        $title = stripslashes($title);
        $sid = intval($id_ads);
        $ads_desc = strip_tags($ads_desc);  
        $content .= '<tr><td align="center" bgcolor="'.$bgcolor2.'">';
         $content .= '<a href="modules.php?name=NukeC&amp;op=ViewDetail&amp;id_ads='.$sid.'"><strong>'.$title.'</strong></a>';   
        $content .= '</td></tr><tr><td>'.$ads_desc.'';
if (($valuepriceB != "") and ($valuepriceB != 0)) {
			$resultcurrB = $db->sql_query("select curr from nukec30_ads_currency where no='$currencycodeB'");
			list($currencynameB) = $db->sql_fetchrow($resultcurrB);
			$content .= $currencynameB." ".number_format($valuepriceB,2)."";
		}
 if ($imageads == "") {
$content .= '<br /><img alt="no image" src="modules/NukeC/imagecatg/noimage.gif" /><br />';
}
 if ($imageads != "") {
			$imageadsexploded = explode(".",$imageads);
			$imageads_thumb = $imageadsexploded[0]."_thumb.".$imageadsexploded[1];
			$fileLocation = "modules/NukeC/imageads/$imageads_thumb";
			if (file_exists($fileLocation)) {

			$content .= '<br /><center><img alt="'.$title.'" src="modules/NukeC/imageads/'.$imageads_thumb.'" width="42" height="42" /></center>';
			}
		} 
        $content .= '</td></tr>';
    }
    $content .= '</table>';
}
$content .= '<br /><center>[ <a href="modules.php?name=NukeC">View Ads</a> ]</center>';
?>

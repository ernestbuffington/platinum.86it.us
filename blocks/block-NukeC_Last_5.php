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
$content = '<center><a href="/nukecbackend.php"><img src="/images/blocks/nukecrss.gif" alt="RSS" border="0" /></a></center><br /> ';
$content .= '<table width="100%">';

$sql = "SELECT id_ads, title, ads_desc, curr, price FROM nukec30_ads_ads where active = '1' and validuntil > '".$mktimeUnixblock."' ORDER BY id_ads DESC LIMIT 0,5";
$result = $db->sql_query($sql);
if ($db->sql_numrows($result)) {       
    while (list($id_ads, $title, $ads_desc, $currencycodeB, $valuepriceB) = $db->sql_fetchrow($result)) {
        $title = stripslashes($title);
        $sid = intval($id_ads);
        $ads_desc =strip_tags(trim($ads_desc));  
		$content .= '<tr><td align="left" bgcolor="'.$bgcolor2.'">';
            $content .= '<a href="modules.php?name=NukeC&amp;op=ViewDetail&amp;id_ads='.$sid.'"><strong>'.$title.'</strong></a>';          
        $content .= '</td></tr><tr><td>'.$ads_desc.'';
if (($valuepriceB != "") and ($valuepriceB != 0)) {
			$resultcurrB = $db->sql_query("select curr from nukec30_ads_currency where no='$currencycodeB'");
			list($currencynameB) = $db->sql_fetchrow($resultcurrB);
			$content .= $currencynameB."".number_format($valuepriceB,2)."";
		}
 //$content .= '<hr />';
        
    }
$content .= '</td></tr>';
    
}
$content .= '</table>';
$content .= '<br /><center>[ <a href="modules.php?name=NukeC">View Ads</a> ]</center>';

?>

<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed COPYRIGHT */
/* */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com [^] */
/* Techgfx - Graeme Allan (goose@techgfx.com) */
/* */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com [^] */
/* Loki / Teknerd - Scott Partee (loki@nukeplanet.com) */
/* */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com [^] */
/* */
/* Refer to platinumnukepro.com for detailed information on this CMS */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com [^] */
/* */
/* This program is free software; you can redistribute it and/or */
/* modify it under the terms of the GNU General Public License */
/* as published by the Free Software Foundation; either version 2 */
/* of the License, or any later version. */
/* */
/* This program is distributed in the hope that it will be useful, */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the */
/* GNU General Public License for more details. */
/* */
/* You should have received a copy of the GNU General Public License */
/* along with this program; if not, write to the Free Software */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA. */
/*******************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}
if (!defined('FXSLIDE'))
{
	define('FXSLIDE', true);
}
include_once(NUKE_BASE_DIR.'header.php');
global $Version_Num;
	
    $verchck = eval(@file_get_contents('http://www.platinumnukepro.com/platinum_version.txt'));
	$Version_Num = strtoupper($Version_Num);
	$Platinumversion = strtoupper($Platinumversion);
    OpenTable();
        echo '<div align="center">';
        echo "<strong><big><span class=\"title\">"._VER_TITLE."</span><big></strong><br />";
        echo"<br />";
        echo '<font style="size: 2;color: orange;font-weight: bold;">'._NG_CURRENTVER.'</font><font size="2"> '.$Platinumversion.'</font><br />';
        echo "<font style=\"size: 2;color: orange;font-weight: bold;\">"._NG_YOURVER." </font><font size=\"2\"> ".$Version_Num."</font><br />";
        if ($Platinumversion == $Version_Num){ 
			echo '<font color="green"><strong>'._NG_VERSION_CURRENT.'</strong></font><br />';
        } elseif ($Platinumversion < $Version_Num){ 
			echo '<font color="orange"><strong>'._NG_VERSION_BETA.'</strong></font><br />';
		} else { 
        echo '<font style="size: 2;color: red;font-weight: bold;"><strong>'.$message.'</font><br /><a href="'.$download.'" target="_BLANK"><font color="green">'._NG_DOWNLOADLINK.'</strong></font></a><br />';
        }
	echo '<br /><strong><a href="'.$admin_file.'.php">'._NG_BACK.'</a></strong><br />';
	echo '</div>';
CloseTable();
OpenTable();
echo '<fieldset><br /><legend><font style=\"color: '.$textcolor2.';\"><strong>'._NG_PUBLICANNOUNCE.'</strong></font></legend><table>';
if (empty($Announcements)) { 
echo '<div align="center">';
echo '<strong>'._NG_NO_PUBLICANNOUNCE.'</strong>'; 
} else {
	echo '<strong>'.$Announcements.'<strong></font>';
}
	echo '</div>';
	echo "</table><br /></fieldset>";
CloseTable();
OpenTable();
echo '<fieldset><br /><legend><font style=\"color: '.$textcolor2.';\"><strong>'._NG_TEAM.'</strong></font></legend>';
if (empty($devs)) { 
echo '<div align="center">';
echo '<strong>'._NG_TEAMNONE.'</strong>'; 
echo '</div>';
} else {
echo '<div align="center">';
echo '<table border="1" width="60%" align="center"><tr>';
echo '<th colspan="2">'._NG_DEVS.'</th></tr><tr>';
echo '<th>'._NG_NAME.'</th><th>'._NG_JOB_TITLE.'</th></tr>';
for ($i=0; $i < sizeof($devs); $i++) {
$dev = explode('|', $devs[$i]);
$DevName = $dev[0]; 
$DevUrl = $dev[1];  
//echo '<tr><td style="background-color: '.$bgcolor2.';">&nbsp;'.$DevName.'&nbsp;</td><td>&nbsp;<a href="'.$DevUrl.'" target="_BLANK">'.$DevUrl.'</a>&nbsp;</td></tr>';
echo '<tr><td style="background-color: '.$bgcolor2.';">&nbsp;'.$DevName.'&nbsp;</td><td>&nbsp;'.$DevUrl.'&nbsp;</td></tr>';
}
echo '<tr><th colspan="2">'._NG_BETA.'</th></tr><tr>';
echo '<th>'._NG_NAME.'</th><th>'._NG_WEBURL.'</th></tr>';
for ($i=0; $i < sizeof($testers); $i++) {
$tester = explode('|', $testers[$i]);
$BetaName = $tester[0]; 
$BetaUrl = $tester[1];  
echo '<tr><td style="background-color: '.$bgcolor2.';">&nbsp;'.$BetaName.'&nbsp;</td><td>&nbsp;<a href="'.$BetaUrl.'" target="_BLANK">'.$BetaUrl.'</a>&nbsp;</td></tr>';
}
echo '</table>';
echo '</div><br /></fieldset>';
}
CloseTable();
OpenTable();
echo '<div align="center" width="100%"><span class="title"><strong>'._NG_TITLE_CHANGELOG.'</strong></span></div>';
?>
<fieldset class="trigger"> 
<legend><a href="#"> Expand / Collapse</a></legend> 
<div style="display: none;"> 
<br /> 
<iframe id=1 name="portal" src=http://platinumnukepro.com/changelog.txt width="100%" scrolling="auto" height="800" frameborder="0"></iframe></div></fieldset>
<?php
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');
?>
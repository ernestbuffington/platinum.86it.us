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

if (stristr(htmlentities($_SERVER['PHP_SELF']), 'footer.php')) {
    Header('Location: index.php');
    die();
}

$footer = 1;
define('NUKE_FOOTER', true);
function footmsg() {
    global $foot1, $foot2, $foot3, $copyright, $total_time, $start_time;
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $end_time = $mtime;
    $total_time = ($end_time - $start_time);
    $total_time = ""._PAGEGENERATION." ".substr($total_time,0,4)." "._SECONDS."";
	$footmsg = '<div class="footmsg">';
	if (!empty($foot1)) {
		$footmsg .= $foot1.'<br />';
	}
	if (!empty($foot2)) {
		$footmsg .= $foot2.'<br />';
	}
	if (!empty($foot3)) {
		$footmsg .= $foot3.'<br />';
	}
    // DO NOT REMOVE THE FOLLOWING COPYRIGHT LINE. YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS.
    // IF YOU REALLY NEED TO REMOVE IT AND HAVE MY WRITTEN AUTHORIZATION CHECK: http://phpnuke.org/modules.php?name=Commercial_License
    // PLAY FAIR AND SUPPORT THE DEVELOPMENT, PLEASE!
    echo "$copyright<br>$total_time<br>\n</font>\n";
}

function foot() {
    global $prefix, $user_prefix, $db, $index, $user, $cookie, $storynum, $user, $cookie, $Default_Theme, $foot1, $foot2, $foot3, $foot4, $home, $module, $name, $admin;
/*****************************************************/
/* Addon - Center Blocks v.2.1.1               START */
/* Addon - Conditional Blocks v.1.1.1          START */
/*****************************************************/
    if(defined('HOME_FILE')){
        include_once("includes/cblocks2.php");
	blocks('Down');
    }
    elseif ($home == 1){
        include_once("includes/cblocks2.php");
	blocks('Down');
    }
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/* Addon - Center Blocks v.2.1.1                 END */
/*****************************************************/
	if (!isset($commercial__license)) $commercial_license = '';
	if (basename($_SERVER['PHP_SELF']) != 'index.php' AND defined('MODULE_FILE') AND file_exists('modules/'.$name.'/copyright.php') && $commercial_license != 1) {
		$cpname = str_replace('_', ' ', $name);
		echo '<div align="right"><a href="javascript:openwindow()">'.$cpname.' &copy;</a></div>';
	}
	if (basename($_SERVER['PHP_SELF']) != 'index.php' AND defined('MODULE_FILE') AND (file_exists('modules/'.$name.'/admin/panel.php') && is_admin($admin))) {
		echo '<br />';
		OpenTable();
		include_once('modules/'.$name.'/admin/panel.php');
		CloseTable();
	}
	themefooter();
/*****[BEGIN]******************************************
 [ Base:    Snavi Menu Bar                       v2.5.]
 ******************************************************/
if (defined('SNAVI_IS_ACTIVE') && file_exists('includes/snavi/snavi.php'))
{
  echo "</body>\n";
  echo "<body></td></tr></table>";
}
/*****[END]********************************************
 [ Base:    Snavi Menu Bar                       v2.5.]
 ******************************************************/
	if (file_exists('includes/custom_files/custom_footer.php')) {
		include_once('includes/custom_files/custom_footer.php');
	}
/***START***Initialize JS Body arrays ********/
/************RN Compatability Layer  ********/	
writeBODYJS();
/***END****Initialize JS Body arrays ********/
/************RN Compatability Layer  ********/	
// GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
//Modified by montego from http://montegoscripts.com for RavenNUke76
global $tnsl_bUseShortLinks, $tnsl_bAutoTapBlocks, $tnsl_bAutoTapLinks, $tnsl_bDebugShortLinks, $tnsl_sGTFilePath;
if (defined('TNSL_USE_SHORTLINKS')) {
  tnsl_fPageTapFinish();
}
	echo '</body>'."\n".'</html>';
	ob_end_flush();
	die();
}

foot();

?>
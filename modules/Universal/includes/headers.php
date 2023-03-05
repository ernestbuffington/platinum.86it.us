<?php

#####################################################
#													#
#	Universal Module 2.5							#
#	For PHP-Nuke 6.5+								#
#	By Barry Caplin - http://www.e-devstudio.net	#
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

if (stristr($_SERVER['SCRIPT_NAME'], "headers.php")) {
	die("Illegal Desolate File Access");
}

function mainheader($mainindex) {
	global $modulename, $bgcolor2, $admin, $isnt, $bgcolor3;
		OpenTable();
		 if (getconfigvar("imageon") == 1) {
			echo "<br /><center><a href=\"modules.php?name=$modulename\"><strong>Universal Module</strong></a><br />";
		 }
		 	echo "<center><br />";
    		echo "<form action=\"modules.php?name=$modulename&op=search\" method=\"post\">";
        	echo "<font class=\"content\"><input type=\"text\" size=\"25\" name=\"query\"> <input type=\"submit\" value=\""._SEARCH."\"></font>";
       		echo "</form>";
           	echo "</center>";
        if ($mainindex==1) {
            $wdh = 100;
        } else {
            $wdh = 100;
        }
			echo "<table width=\"$wdh%\" align=\"center\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\" bgcolor=\"$bgcolor2\"><tr bgcolor=\"$bgcolor2\">";
        if ($mainindex>0) {
        	echo "<td align=\"center\" $script onClick=\"javascript:location.href='modules.php?name=$modulename'\">"._MODMAIN."</td>";
        }
		if (getconfigvar("allowusersubmit") == 1) {
        	echo "<td align=\"center\" $script onClick=\"javascript:location.href='modules.php?name=$modulename&file=add'\">"._ADDITEM."</td>";
		}
        	echo "<td align=\"center\" $script onClick=\"javascript:location.href='modules.php?name=$modulename&op=TopRated'\">"._TOPRATED."</td>";
            echo "<td align=\"center\" $script onClick=\"javascript:location.href='modules.php?name=$modulename&op=Random'\">"._RANDOM."</td>";
        if (getconfigvar("mostwanted") == 1) {
         	echo "<td align=\"center\" $script onClick=\"javascript:location.href='modules.php?name=$modulename&op=MostWanted'\">"._MOSTWANTED."</td>";
        }
         if (is_admin($admin)) {
            echo "<td align=\"center\" $script onClick=\"javascript:location.href='modules.php?name=$modulename&file=admin'\">"._MODADMIN."</td>";
         }
            echo "</tr>";
            echo    "</table>";
    	CloseTable();
            echo "<p>";
   // Checking for install.php and that settings.php is writable
    if (is_admin($admin)) { // We only want admins to see this message - no need to let vistors know this information
    if (is_writable("modules/$modulename/settings.php")) {
    	$writable = 1;
    }
    if (file_exists("modules/$modulename/install.php")) {
    	$install_exists = 1;
    }
    
    if ($writable == 1 OR $install_exists == 1 AND $isnt == 0) {
    	//echo "<br />";
    	if (!$isnt) OpenTable();
    	if ($writable == 1) {
    		if ($isnt == 1) {
    			// System is a NT System, file permissions may not be possible, so we won't show the message
    		} else {
    			echo ""._BIGWARN.": modules/$modulename/settings.php "._ISWRITABLE."<br />";	
    		}	
    	}
    	if ($install_exists == 1) {
    		echo ""._BIGWARN.": modules/$modulename/install.php "._INSTALLEXISTS."";	 		
    	}
    	if (!$isnt) CloseTable();
    }
    }
    // End Checking
}

function main_admin_header() {
	global $prefix, $db, $mainprefix, $modulename;
	$phpversion = phpversion();
	$v_status = version_check();
	list($mysql_ver) = $db->sql_fetchrow($db->sql_query("SELECT VERSION() as version"));	
		OpenTable();
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "	<tr>\n";
			echo "		<td width=\"55%\">"._ADPRODUCTNAME.": Universal Module Version 2.5</td>\n";
			echo "		<td colspan=\"2\">"._ADVERSIONCHECK.":\n";
			echo "			$v_status\n";
			echo "</td>\n";
			echo "	</tr>\n";
			echo "	<tr>\n";
			echo "		<td width=\"55%\">&nbsp;[<a href=\"modules.php?name=$modulename&file=admin\">"._ADADMINMENU."\n";
			echo "		</a> ]</td>\n";
			echo "		<td width=\"19%\">"._ADPHPVERSION.": $phpversion</td>\n";
			echo "		<td width=\"26%\">"._ADMYSQLVERSION.": $mysql_ver</td>\n";
			echo "	</tr>\n";
			echo "</table>\n";		
		CloseTable();
}

function version_check() {
	global $db, $prefix, $mainprefix;
	if (getconfigvar("versioncheck")) {
		$currentime = time();
		$newtime = getconfigvar("lastupdatecheck") * 86400;	
			if ($currentime == $newtime) {
				$data = @file_get_contents("http://update.e-devstudio.net/ver/unimod/check.php?ver=2.5.0.1");
					if ($data) { $data = $data; } else { $data = "Unable to perform version check"; } 
					$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_cfg SET value = '$data' where name = 'lastupdatecheck'");
					$time = time();
					$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_cfg SET value = '$currenttime' where name = 'lastupdatecheck'");
					return $data;				
			} else {
				return getconfigvar("versioncheck");	
			}
	} else {
	$data = @file_get_contents("http://update.e-devstudio.net/ver/unimod/check.php?ver=2.5.0.1");
	if ($data) { $data = $data; } else { $data = "Unable to perform version check"; } 
		$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_cfg VALUES ('versioncheck', '$data')");
		$time = time();
		$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_cfg VALUES ('lastupdatecheck', '$time')");
		return $data;
	}
}

?>
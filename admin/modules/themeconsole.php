<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ==================================================================== */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
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

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}
include_once('mainfile.php');
global $admin_file;
	$result = $db->sql_query("select radminsuper from ".$prefix."_authors where aid='$aid'");
	list($radminsuper) = $db->sql_fetchrow($result);
	if ($radminsuper==1) {
	if (file_exists("admin/language/themeconsole/lang-$language-".$admin_file.".php"))
		{
			include_once("admin/language/themeconsole/lang-$language-".$admin_file.".php");
		}
	else
		{
			include_once("admin/language/themeconsole/lang-english-admin.php");
		}
// START - Theme Reset by sgtmudd
function ResetUserTheme() {
global $prefix, $db, $Default_Theme, $admin_file, $module_name;
	include_once("header.php");
	OpenTable();
		echo "<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">";
		echo "<div align=\"center\"><a href=\"". $admin_file .".php\">" . _TC_MAINADMIN . "</a></div><br />";				
		echo "<tr align=\"center\">";
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=themeconsole\">" . _TC_ADMIN . "</a></td>";
		// START - Theme Reset by sgtmudd
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=themereset\">" . _TC_RESETTHEME . ":</a> " .$Default_Theme . "</td>";
		// END - Theme Reset by sgtmudd
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=InstallTheme\">" . _TC_INSTSALLTHEME . "</a></td>";
		//echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=InstallTheme\">" . _TC_DOWNLOADTHEME . "</a></td>";
		echo "</tr></table>";
	CloseTable();
	OpenTable();
	echo "<center><p>" . _TC_RESETTING . ": " .$Default_Theme. "</p></center>\n";
		if(!$db->db_connect_id) {
  		die("<br><br><center><img src=images/logo.gif><br><br><strong>There seems to be a problem with the $dbtype server, sorry for the inconvenience.<br><br>We should be back shortly.</center></strong>\n");
}
$query=("UPDATE ".$prefix."_users SET theme='$Default_Theme'");
mysql_query($query) or die ("Could not insert new data :" . mysql_error());
mysql_close();

	echo "<center><p>" . _TC_UPDATED . "</p></center>\n";
	CloseTable();
	echo "<script type=\"text/javascript\">\n";
	echo "\n";
	echo "function tcopenpopup(){\n";
	echo "	window.open (\"".$admin_file.".php?op=tccopyright\",\"ThemeConsole\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=auto,resizable=no,copyhistory=no,width=400,height=230\");\n";
	echo "}\n";
	echo "//\n";
	echo "</script>\n\n";
	echo "<div align=\"right\">© <a href=\"javascript:tcopenpopup()\">ThemeConsole</a></div>";
    include_once("footer.php");
}
// END - Theme Reset by sgtmudd
function IndexAdmin() {
global $user, $userinfo, $Default_Theme, $cookie, $module_name, $admin_file;
	include_once("header.php");
	OpenTable();
		echo "<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">";
		echo "<div align=\"center\"><a href=\"". $admin_file .".php\">" . _TC_MAINADMIN . "</a></div><br />";				
		echo "<tr align=\"center\">";
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=themeconsole\">" . _TC_ADMIN . "</a></td>";
		// START - Theme Reset by sgtmudd
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=themereset\">" . _TC_RESETTHEME . ":</a> " .$Default_Theme . "</td>";
		// END - Theme Reset by sgtmudd
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=InstallTheme\">" . _TC_INSTSALLTHEME . "</a></td>";
		//echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=InstallTheme\">" . _TC_DOWNLOADTHEME . "</a></td>";
		echo "</tr></table>";
	CloseTable();
	OpenTable();
	title(_TC_THEMESELECTION);		
	echo "<br /><strong><center><u>" . _TC_ATNTHEMECONSOLE . "</u></center></strong><br /><br />";		
	echo "<center><div align='center' class='tabcontb2'>\n"
		."<form action='".$admin_file.".php' method='post'>\n"
		."<strong>"._TC_SELECTTHEME."</strong><br /><br />\n"
		."<select name='theme'>\n";
	$handle=opendir('themes');
	while ($file = readdir($handle)) {
		if ( (!preg_match("/[.]/",$file) AND file_exists("themes/$file/theme.php")) ) {
			$themelist .= "$file ";
		}
	}
	closedir($handle);
	$themelist = explode(" ", $themelist);
	sort($themelist);
	for ($i=0; $i < sizeof($themelist); $i++) {
		if($themelist[$i]!="") {
			echo "<option value='$themelist[$i]'>$themelist[$i]</option>\n";
		}
	}
	echo "</select>&nbsp;&nbsp;\n"
		."<input type='hidden' name='op' value='themeconsolemake'>\n"
		."<input type='submit' value='"._TC_THEME."'>\n"
		."</form><br /></div>\n";
	CloseTable();		
	echo "<script type=\"text/javascript\">\n";
	echo "<!--\n";
	echo "function tcopenpopup(){\n";
	echo "	window.open (\"".$admin_file.".php?op=tccopyright\",\"ThemeConsole\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=auto,resizable=no,copyhistory=no,width=400,height=230\");\n";
	echo "}\n";
	echo "//-->\n";
	echo "</script>\n\n";
	echo "<div align=\"right\">© <a href=\"javascript:tcopenpopup()\">ThemeConsole</a></div>";
	include_once("footer.php");
}
function ThemeConsole($theme) {
    global $prefix, $db, $Default_Theme, $bgcolor2, $admin_file;
    $result = $db->sql_query("SELECT * FROM ".$prefix."_themeconsole WHERE themename='$theme'");  
    if ($db->sql_numrows($result) == 0){
    $db->sql_query("INSERT INTO ".$prefix."_themeconsole SET themename='$theme'");
    $result = $db->sql_query("SELECT * FROM ".$prefix."_themeconsole WHERE themename='$theme'");
    $themeconsole = $db->sql_fetchrow($result);
    }else{
    $themeconsole = $db->sql_fetchrow($result);
    }
    include_once("header.php");
	Opentable();
		echo "<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">";
		echo "<div align=\"center\"><a href=\"". $admin_file .".php\">" . _TC_MAINADMIN . "</a></div><br />";				
		echo "<tr align=\"center\">";
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=themeconsole\">" . _TC_ADMIN . "</a></td>";
		// START - Theme Reset by sgtmudd
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=themereset\">" . _TC_RESETTHEME . ":</a> " .$Default_Theme . "</td>";
		// END - Theme Reset by sgtmudd
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=InstallTheme\">" . _TC_INSTSALLTHEME . "</a></td>";
		//echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=InstallTheme\">" . _TC_DOWNLOADTHEME . "</a></td>";
		echo "</tr></table>";
	Closetable();
    OpenTable();
    title(_TC_THEMECONSOLE.$theme);	
	echo "<br /><strong><center><u>" . _TC_ATNTHEMECONSOLE . "</u></center></strong><br /><br />";
    echo "<center><font class='option'><strong>" . _TC_THEMECONSOLE1 . "</strong></font></center><br />"
	."<form action='".$admin_file.".php' method='post'>";
	echo '<div style="height: 31px; padding: 0px 10px;">';
	echo '<ul id="conftab" class="shadetabs">
		  <li><a href="#" rel="conftab1" class="selected"><span class="center">&nbsp;</span>' . _TC_MARSET . '<span class="right">&nbsp;</span></a></li>
          <li><a href="#" rel="conftab2"><span class="center">&nbsp;</span>' . _TC_LINKSET . '<span class="right">&nbsp;</span></a></li>
          <li><a href="#" rel="conftab3"><span class="center">&nbsp;</span>' . _TC_THEMESET . '<span class="right">&nbsp;</span></a></li>
          </ul>';
	echo '</div>';
	echo '<div class="tabcontb"><br /><br />';
	echo '<div id="conftab1" class="tabcontent" padding: 15px">';
    echo "<br /><br /><center><font class='option'><strong>" . _TC_MARSET . "</strong></font></center><br /><br />";
	echo "<table align='center' border='0' cellpadding='4'>\n";	
    echo "<tr><td>"._TC_MESSSTYLE."</td><td><select name='xstyle'>\n";
    if ($themeconsole['marqstyle'] == '1'){
    echo "<option value='1' selected>JqMarquee</option>\n";
    }else{
    echo "<option value='1'>JqMarquee</option>\n";
    } 
    if ($themeconsole['marqstyle'] == '2'){
    echo "<option value='2' selected>Fading Scroller</option>\n";
    }else{
    echo "<option value='2'>Fading Scroller</option>\n";
    } 
    if ($themeconsole['marqstyle'] == '3'){
    echo "<option value='3' selected>Marquee</option>\n";
    }else{
    echo "<option value='3'>Marquee</option>\n";
    }
    if ($themeconsole['marqstyle'] == '99'){
    echo "<option value='99' selected>None</option>\n";
    }else{
    echo "<option value='99'>None</option>\n";
    }
    echo "</select></td></tr>\n";
	echo "<tr><td>"._TC_MESS1."</td><td><input type='text' name='xmess1' value='".$themeconsole['marq1']."' size='60' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_MESS2."</td><td><input type='text' name='xmess2' value='".$themeconsole['marq2']."' size='60' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_MESS3."</td><td><input type='text' name='xmess3' value='".$themeconsole['marq3']."' size='60' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_MESS4."</td><td><input type='text' name='xmess4' value='".$themeconsole['marq4']."' size='60' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_MESS5."</td><td><input type='text' name='xmess5' value='".$themeconsole['marq5']."' size='60' maxlength='255'></td></tr>\n";
	echo '</table><br /><br /></div>';
	echo '<div id="conftab2" class="tabcontent" padding: 15px">';		
    echo "<br /><br /><center><font class='option'><strong>" . _TC_LINKSET . "</strong></font></center><br /><br />";	
	echo "<table align='center' border='0' cellpadding='4'>\n";	
    echo "<tr><td>"._TC_LINK1."</td><td><input type='text' name='link1text' value='".$themeconsole['link1text']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK1URL."</td><td><input type='text' name='link1' value='".$themeconsole['link1']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK2."</td><td><input type='text' name='link2text' value='".$themeconsole['link2text']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK2URL."</td><td><input type='text' name='link2' value='".$themeconsole['link2']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK3."</td><td><input type='text' name='link3text' value='".$themeconsole['link3text']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK3URL."</td><td><input type='text' name='link3' value='".$themeconsole['link3']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK4."</td><td><input type='text' name='link4text' value='".$themeconsole['link4text']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK4URL."</td><td><input type='text' name='link4' value='".$themeconsole['link4']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK5."</td><td><input type='text' name='link5text' value='".$themeconsole['link5text']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK5URL."</td><td><input type='text' name='link5' value='".$themeconsole['link5']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK6."</td><td><input type='text' name='link6text' value='".$themeconsole['link6text']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK6URL."</td><td><input type='text' name='link6' value='".$themeconsole['link6']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK7."</td><td><input type='text' name='link7text' value='".$themeconsole['link7text']."' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td>"._TC_LINK7URL."</td><td><input type='text' name='link7' value='".$themeconsole['link7']."' size='40' maxlength='255'></td></tr></table>\n";
	echo '<br /><br /></div>';
	echo '<div id="conftab3" class="tabcontent" padding: 15px">';		
    echo "<br /><br /><center><font class='option'><strong>" . _TC_THEMESET . "</strong></font></center><br /><br />";	
	echo "<table align='center' border='0' cellpadding='4'>\n";		
    if ($themeconsole['searchbox']==1) {$sel1 = "checked"; $sel2 = ""; } else { $sel1 = ""; $sel2 = "checked"; }
    echo "<tr><td>"._TC_SEARCHBOX." </td><td><input type='radio' name='xsearchbox' value='1' $sel1>"._TC_ON." &nbsp; <input type='radio' name='xsearchbox' value='0' $sel2>"._TC_OFF."</td></tr>\n";
    if ($themeconsole['flashswitch']==1) {$sel1 = "checked"; $sel2 = ""; } else { $sel1 = ""; $sel2 = "checked"; }
    echo "<tr><td>"._TC_FLASH." </td><td><input type='radio' name='xflashswitch' value='1' $sel1>"._TC_ON." &nbsp; <input type='radio' name='xflashswitch' value='0' $sel2>"._TC_OFF."</td></tr>\n";
    if ($themeconsole['pubbox']==1) {$sel1 = "checked"; $sel2 = ""; } else { $sel1 = ""; $sel2 = "checked"; }
    echo "<tr><td>"._TC_PUBBOX." </td><td><input type='radio' name='xpubbox' value='1' $sel1>"._TC_ON." &nbsp; <input type='radio' name='xpubbox' value='0' $sel2>"._TC_OFF."</td></tr>\n";
	if ($themeconsole['disrightclick']==1) {$sel1 = "checked"; $sel2 = ""; } else { $sel1 = ""; $sel2 = "checked"; }
    echo "<tr><td>"._TC_RIGHTCLICKDIS." </td><td><input type='radio' name='xdisrightclick' value='1' $sel1>"._TC_ON." &nbsp; <input type='radio' name='xdisrightclick' value='0' $sel2>"._TC_OFF."</td></tr>\n";
	if ($themeconsole['adminright']==1) {$sel1 = "checked"; $sel2 = ""; } else { $sel1 = ""; $sel2 = "checked"; }
    echo "<tr><td>"._TC_ADMINRIGHT." </td><td><input type='radio' name='xadminright' value='1' $sel1>"._TC_ON." &nbsp; <input type='radio' name='xadminright' value='0' $sel2>"._TC_OFF."</td></tr>\n";
    if ($themeconsole['disselectall']==1) {$sel1 = "checked"; $sel2 = ""; } else { $sel1 = ""; $sel2 = "checked"; }
    echo "<tr><td>"._TC_SELECTALLDIS." </td><td><input type='radio' name='xdisselectall' value='1' $sel1>"._TC_ON." &nbsp; <input type='radio' name='xdisselectall' value='0' $sel2>"._TC_OFF."</td></tr>\n";
	if ($themeconsole['adminselect']==1) {$sel1 = "checked"; $sel2 = ""; } else { $sel1 = ""; $sel2 = "checked"; }
	echo "<tr><td>"._TC_ADMINSELECT." </td><td><input type='radio' name='xadminselect' value='1' $sel1>"._TC_ON." &nbsp; <input type='radio' name='xadminselect' value='0' $sel2>"._TC_OFF."</td></tr>\n";
	if ($themeconsole['encrypt']==1) {$sel1 = "checked"; $sel2 = ""; } else { $sel1 = ""; $sel2 = "checked"; }
    echo "<tr><td>"._TC_ENCRYPT." </td><td><input type='radio' name='xencrypt' value='1' $sel1>"._TC_ON." &nbsp; <input type='radio' name='xencrypt' value='0' $sel2>"._TC_OFF."</td></tr>\n";
    echo "</table>\n";	
	echo '<br /><br /></div>';	
	echo '</div>';	
	echo "<table align='center' border='0' cellpadding='4'>\n";		
	echo "<tr><td colspan='2' align='center'>";
// START - Save to all themes - sgtmudd	
	echo "<input type=\"checkbox\" name=\"allthemes\" value=\"All\" /> "._TC_SAVETOALL." <br />";
// END - Save to all themes - sgtmudd	
    echo "<input type='hidden' name='theme' value='$theme'>";
    echo "<input type='hidden' name='op' value='themeconsolesave'>";
    echo "<br /><input type='submit' value='"._TC_SAVECHANGES."'></td></tr>";
    echo "</form>\n";
    echo "</table>\n";	
	$inlineuiJS = '<script type="text/javascript">
			  var themeconsolesave=new ddtabcontent("conftab")
			  themeconsolesave.setpersist(true)
			  themeconsolesave.setselectedClassTarget("link")
			  themeconsolesave.init()
			  </script>';
	addJSToBody($inlineuiJS,'inline');	
    CloseTable();
	echo "<script type=\"text/javascript\">\n";
	echo "<!--\n";
	echo "function tcopenpopup(){\n";
	echo "	window.open (\"".$admin_file.".php?op=tccopyright\",\"ThemeConsole\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=auto,resizable=no,copyhistory=no,width=400,height=230\");\n";
	echo "}\n";
	echo "//-->\n";
	echo "</script>\n\n";
	echo "<div align=\"right\">© <a href=\"javascript:tcopenpopup()\">ThemeConsole</a></div>";
    include_once("footer.php");
}
/***[BEGIN]***************************************** Theme installer v1.0.2 **************************************************/
function InstallTheme() 
{
global $admin_file, $db, $prefix, $admin, $Default_Theme, $cookie, $user, $userinfo, $module_name, $userinfo, $HTTP_POST_FILES, $_POST;
include_once('header.php');
	$AllowedExtensions = array('zip');
	$path_parts = pathinfo($HTTP_POST_FILES['file']['name']);
	$extension  = $path_parts['extension'];
	$extension  = strtolower($extension);
	$filename = $HTTP_POST_FILES['file']['name'];
	if( in_array($extension, $AllowedExtensions) ) 
	{
		$theme_name_check = substr($filename, 0, -4);
		if( !file_exists('themes/'. $theme_name_check) )
		{
		if( move_uploaded_file($HTTP_POST_FILES['file']['tmp_name'], 'themes/'.$HTTP_POST_FILES['file']['name']) ) 
		{
			$archive = new PclZip('themes/'.$filename);
			if (($list = $archive->listContent()) == 0) 
			{
				die("Error : ".$archive->errorInfo(true));
			}
			$valid = false;
			foreach($list as $id => $file) 
			{
				if (strpos($file['filename'], 'theme.php') !== false) 
				{
					$valid = true;
				}
			}
			if (!$valid)			
			{	
				@unlink('themes/'.$HTTP_POST_FILES['file']['name']);
				die("Error : Not a valid theme zip.");
			}
			if ($archive->extract(PCLZIP_OPT_PATH, 'themes/') == 0) 
			{
				die("Error : ".$archive->errorInfo(true));
			}
			if($valid == TRUE)
			{
				@unlink('themes/'.$HTTP_POST_FILES['file']['name']);			
				$theme = substr($filename, 0, -4);
			header ('Location: '.$admin_file.'.php?op=themeconsole');	
			}		
		}
	}
	else
	{
		die('Error: Theme already installed.');
	}
}
	OpenTable();
		echo "<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">";
		echo "<div align=\"center\"><a href=\"". $admin_file .".php\">" . _TC_MAINADMIN . "</a></div><br />";				
		echo "<tr align=\"center\">";
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=themeconsole\">" . _TC_ADMIN . "</a></td>";
		// START - Theme Reset by sgtmudd
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=themereset\">" . _TC_RESETTHEME . ":</a> " .$Default_Theme . "</td>";
		// END - Theme Reset by sgtmudd
		echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=InstallTheme\">" . _TC_INSTSALLTHEME . "</a></td>";
		//echo "<td width=\"25%\"><a href=\"". $admin_file .".php?op=InstallTheme\">" . _TC_DOWNLOADTHEME . "</a></td>";
		echo "</tr></table>";
	CloseTable();	
	OpenTable();
		echo "<strong><center><u>Import a new Theme</u></center></strong><br /><br />";			
		echo "<div align=\"center\">";			
		echo '<div class="tabcontb1">';			
		echo "<table border='0' align='center' width='85%' cellpadding='3'>\n";
		echo  "<tr><br /><th width='100%' align='center' colspan='6'><span class=\"title\">"._TC_THEMECONIMPORT."</span></th></tr></table><br />\n\n";
		echo '<div class="tabcontb2"><br /><br />';				
		echo  "<table border='0' align='center' width='85%' cellpadding='3'>\n"
			."<tr><td width='100%' align='center'><form method='post' enctype='multipart/form-data'>"
			."<input type='hidden' name='op' value='InstallTheme'>"
			."<input type='file' name='file' size='50'><br /><br />"
			."<input type='submit' value='Import Theme'></form>"
			."</td></tr></table></div></div></div>\n";
	CloseTable();	
	echo "<script type=\"text/javascript\">\n";
	echo "<!--\n";
	echo "function tcopenpopup(){\n";
	echo "	window.open (\"".$admin_file.".php?op=tccopyright\",\"ThemeConsole\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=auto,resizable=no,copyhistory=no,width=400,height=230\");\n";
	echo "}\n";
	echo "//-->\n";
	echo "</script>\n\n";
	echo "<div align=\"right\">© <a href=\"javascript:tcopenpopup()\">ThemeConsole</a></div>";
		include_once("footer.php");
}
/***[END]******************************************* Theme installer v1.0.2 **************************************************/
function tccopyright() {
    $module_version = "1.0.2.PNP";
    $module_description = "This Theme Console allows you to edit different parts of a Theme Console compatible theme, very easy to add 5 lines of marquee, up to 7 links and some extra functions to turn on or off";
    echo "<html>\n"
	."<body bgcolor=\"#F6F6EB\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n"
	."<title>Theme Console: Copyright Information</title>\n"
	."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n"
	."<center><strong>Theme Console &copy; Information</strong></center><br />"
	."<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<strong>Orginal Author:</strong> Mighty_Y, TechGFX<br />\n"
	."<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<strong>Updated by:</strong> DocHaVoC, <a href=\"http://www.havocst.net\" target=\"blank\">havocst</a><br /> sgtmudd, <a href=\"http://www.platinumnukepro.com\" target=\"blank\">Platinum Nuke Pro</a><br />\n"	
	."<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<strong>Version:</strong> $module_version<br />\n"
	."<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<strong>Description:</strong> $module_description<br />\n"
	."<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<strong>Bug Tested by:</strong> <a href=\"http://www.techgfx.com\" target=\"blank\">TechGFX</a>, <a href=\"http://www.portedmods.com\" target=\"blank\">Mighty_Y</a><br /><br />\n"
	."<center>[ <a href=\"http://www.techgfx.com\" target=\"new\">Author's HomePage</a> | <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
	."</font>\n"
	."</body>\n"
	."</html>";
}
switch($op) {
	default:
		case "themeconsole":
		IndexAdmin();
		break;
		case "themeconsolemake":
		ThemeConsole($theme);
		break;
		case "themereset":
		ResetUserTheme();
		break;
		case "InstallTheme":
		InstallTheme($file);
		break;
		case "downloadTheme": 
		downloadTheme($theme);
		break;
		case "themeconsolesave":
		$xmess1 = htmlentities($xmess1, ENT_QUOTES);
		$xmess2 = htmlentities($xmess2, ENT_QUOTES);
		$xmess3 = htmlentities($xmess3, ENT_QUOTES);
		$xmess4 = htmlentities($xmess4, ENT_QUOTES);
		$xmess5 = htmlentities($xmess5, ENT_QUOTES);
		$link1text = htmlentities($link1text, ENT_QUOTES);
		$link2text = htmlentities($link2text, ENT_QUOTES);
		$link3text = htmlentities($link3text, ENT_QUOTES);
		$link4text = htmlentities($link4text, ENT_QUOTES);
		$link5text = htmlentities($link5text, ENT_QUOTES);
		$link6text = htmlentities($link6text, ENT_QUOTES);
		$link7text = htmlentities($link7text, ENT_QUOTES);
		$link1 = htmlentities($link1, ENT_QUOTES);
		$link2 = htmlentities($link2, ENT_QUOTES);
		$link3 = htmlentities($link3, ENT_QUOTES);
		$link4 = htmlentities($link4, ENT_QUOTES);
		$link5 = htmlentities($link5, ENT_QUOTES);
		$link6 = htmlentities($link6, ENT_QUOTES);
		$link7 = htmlentities($link7, ENT_QUOTES);
// START - Save to all themes - sgtmudd
if(isset($_POST['allthemes']) &&
   $_POST['allthemes'] == 'All')
  {
		$db->sql_query("UPDATE ".$prefix."_themeconsole SET marq1='$xmess1', marq2='$xmess2', marq3='$xmess3', marq4='$xmess4', marq5='$xmess5', link1text='$link1text', link1='$link1', link2text='$link2text', link2='$link2', link3text='$link3text', link3='$link3', link4text='$link4text', link4='$link4', link5text='$link5text', link5='$link5', link6text='$link6text', link6='$link6', link7text='$link7text', link7='$link7', searchbox='$xsearchbox', flashswitch='$xflashswitch', disrightclick='$xdisrightclick', adminright='$xadminright', disselectall='$xdisselectall', adminselect='$xadminselect', encrypt='$xencrypt', marqstyle='$xstyle', pubbox='$xpubbox'");
  }
else
  {
// END - Save to all themes - sgtmudd
		$db->sql_query("UPDATE ".$prefix."_themeconsole SET marq1='$xmess1', marq2='$xmess2', marq3='$xmess3', marq4='$xmess4', marq5='$xmess5', link1text='$link1text', link1='$link1', link2text='$link2text', link2='$link2', link3text='$link3text', link3='$link3', link4text='$link4text', link4='$link4', link5text='$link5text', link5='$link5', link6text='$link6text', link6='$link6', link7text='$link7text', link7='$link7', searchbox='$xsearchbox', flashswitch='$xflashswitch', disrightclick='$xdisrightclick', adminright='$xadminright', disselectall='$xdisselectall', adminselect='$xadminselect', encrypt='$xencrypt', marqstyle='$xstyle', pubbox='$xpubbox' WHERE themename='$theme'");
  }

		Header("Location: ".$admin_file.".php?op=themeconsolemake&theme=$theme");
		break;
		case "tccopyright":
		tccopyright();
		break;
	}
} else {
    echo "Access Denied";
}
?>
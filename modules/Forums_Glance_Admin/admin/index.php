<?php
/************************************************************************/
/******************* Forums Glance Admin v2.0****************************/
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
/* Forums Glance Admin v1.1 by sgtmudd (sgtmudd@mach-hosting.com)              */
/* Copyright (c) 2017 sgtmudd http://platinumnukepro.com                       */
/* Forums Glance Admin v2.0 Updated by DocHaVoC (DocHaVoC@havocst.net.net)     */
/*******************************************************************************/
/* Forums Glance Admin v2.0 Updated by DocHaVoC (01232014)*/
if ( !defined('ADMIN_FILE') ) die ('Access Denied');
global $prefix, $db, $admin_file;
$module_name = 'Forums_Glance_Admin';
$aid = substr($aid, 0,25);
if (!isset($ok)) {$ok = 0; }
$query = $db->sql_query('SELECT title, admins FROM '.$prefix.'_modules where title=\''.$module_name.'\'');
list($title, $admins) = $db->sql_fetchrow($query);
$query2 = $db->sql_query('SELECT name, radminsuper FROM '.$prefix.'_authors where aid=\''.$aid.'\'');
list($name, $radminsuper) = $db->sql_fetchrow($query2);
$admins = explode(',', $admins);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($name == $admins[$i] AND !empty($admins)) {
        $auth_user = 1;
    }
}
if ($radminsuper == 1 || $auth_user == 1) {
    if (!isset($sid)) $sid = '';
    if (!isset($op)) $op = ''; 
    switch($op) {

    case 'Forums_Glance_Admin_Main_Config':
    Forums_Glance_Admin_Main_Config();
    break;
	
    case 'FGAC_Save':
 csrf_check();
    FGAC_Save ($xglance_enable, $xglance_news_forum_id, $xglance_num_news, $xglance_num_recent, $xglance_recent_ignore, $xglance_news_heading, $xglance_recent_heading, $xglance_show_new_bullets, $xglance_track, $xglance_auth_read, $xglance_topic_length, $xglance_direct_latest);
    break;	
    } 
} else {
    include_once('header.php');
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=Forums_Glance_Admin_Main_Config'>" . _FGAADMIN . "</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>" . _FGAMAINADMIN . "</a></center></strong>";
CloseTable();
    OpenTable();
    echo '<center><strong>'._ERROR.'</strong><br /><br />You do not have administration permission for module \''.$module_name.'\'</center>';
    CloseTable();
    include_once('footer.php');
}
die();

function Forums_Glance_Admin_Main_Config()
	{
	global $module_name, $prefix, $db, $admin_file, $currentlang;
	include_once(NUKE_BASE_DIR. 'header.php');
	$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_fga_config"));
		$glance_forum_dir = 'modules.php?name=Forums&amp;file=';
		$glance_enable = $row['glance_enable'];
		$glance_news_forum_id =$row['glance_news_forum_id'];
		$glance_num_news = $row['glance_num_news'];
		$glance_num_recent = $row['glance_num_recent'];
		$glance_recent_ignore = $row['glance_recent_ignore'];
		$glance_news_heading = $row['glance_news_heading'];
		$glance_recent_heading = $row['glance_recent_heading'];
		$glance_show_new_bullets = $row['glance_show_new_bullets'];
		$glance_track = $row['glance_track'];
		$glance_auth_read = $row['glance_auth_read'];
		$glance_topic_length = $row['glance_topic_length'];
		$glance_direct_latest = $row['glance_direct_latest'];
		$glance_version = $row['glance_version'];		
/* Forums Glance Admin v2.0 Updated by DocHaVoC (01232014)*/
$inlinefgaJS = '<script type="text/javascript">
			$(document).ready(function(){
				$(".inline").colorbox({inline:true, width:"50%"});
			});
		</script>'."\n";
addJSToBody($inlinefgaJS,'inline');
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=Forums_Glance_Admin_Main_Config'>" . _FGAADMIN . "</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>" . _FGAMAINADMIN . "</a></center></strong>";
CloseTable();
OpenTable()
?>
<link href="/modules/Forums_Glance_Admin/admin/css/fga.css" rel="stylesheet" type="text/css">
<p><center><strong><?php echo "" . _FGAADMIN . "" ?></strong></center></p>
<p><strong><?php echo "" . _FGAINFO . "" ?></strong></p>
<?php echo '<form action="'.$admin_file.'.php" method="post">' ?>
<table border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td class="form_text"><?php echo "<b>" . _FGAENABLE . "</b>" ?></td>
    <td><span class="form_text">
    	<?php if ($glance_enable=='1') {
     	    echo "<input type=\"radio\" name=\"xglance_enable\" value=\"1\" checked><b>" . _FGAENABLED . "</b>";
		    echo "<input type=\"radio\" name=\"xglance_enable\" value=\"0\">" . _FGADISABLED . "";
		} else {
			echo "<input type=\"radio\" name=\"xglance_enable\" value=\"1\">" . _FGAENABLED . "";
	        echo "<input type=\"radio\" name=\"xglance_enable\" value=\"0\" checked><b>" . _FGADISABLED . "</b>";
		}
		?>
    </span></td>
  </tr>
  <tr>
    <td class="form_text"><?php echo "" . _FGANFID . "" ?></td>
    <td><span class="form_text">
      <input type="text" name="xglance_news_forum_id" value="<?php echo $glance_news_forum_id; ?>" />
    </span></td>
  </tr>
  <tr>
    <td class="form_text"><?php echo "" . _FGANNID . "" ?></td>
    <td><span class="form_text">
      <input type="text" name="xglance_num_news" value="<?php echo $glance_num_news; ?>" />
    </span></td>
  </tr>
  <tr>
    <td class="form_text"><?php echo "" . _FGANRA . "" ?></td>
    <td><span class="form_text">
      <input type="text" name="xglance_num_recent" value="<?php echo $glance_num_recent; ?>" />
    </span></td>
  </tr>
  <tr>
    <td class="form_text"><?php echo "" . _FGAFIGNORE . "" ?></td>
    <td><span class="form_text">
      <input type="text" name="xglance_recent_ignore" value="<?php echo $glance_recent_ignore; ?>" />
    </span></td>
  </tr>
  <tr>
    <td class="form_text"><?php echo "" . _FGANHEADING . "" ?>:</td>
    <td><span class="form_text">
      <input type="text" name="xglance_news_heading" value="<?php echo $glance_news_heading; ?>" />
    </span></td>
  </tr>
  <tr>
    <td class="form_text"><?php echo "" . _FGARECENTHEADING . "" ?>:</td>
    <td><span class="form_text">
      <input type="text" name="xglance_recent_heading" value="<?php echo $glance_recent_heading; ?>" />
    </span></td>
  </tr>
  <tr>
    <td class="form_text"><?php echo "" . _FGABULLETNEW . "" ?></td>
    <td><span class="form_text">
      <input type="text" name="xglance_show_new_bullets" value="<?php echo $glance_show_new_bullets; ?>" />
    </span></td>
  </tr>
  <tr>
    <td class="form_text"><?php echo "" . _FGANMSGTRACKING . "" ?></td>
    <td><span class="form_text">
      <input type="text" name="xglance_track" value="<?php echo $glance_track; ?>" />
    </span></td>
  </tr>
  <tr>
    <td class="form_text"><?php echo "" . _FGASHOWTOPICS . "" ?></td>
    <td><span class="form_text">
      <input type="text" name="xglance_auth_read" value="<?php echo $glance_auth_read; ?>" />
    </span></td>
  </tr>
    <tr>
    <td class="form_text"><?php echo "" . _FGALIMITCHAR . "" ?></td>
    <td><span class="form_text">
      <input type="text" name="xglance_topic_length" value="<?php echo $glance_topic_length; ?>" />
    </span>        </tr>
    <tr>
    <td class="form_text"><?php echo "" . _FGANPOSTTOPIC . "" ?></td>
    <td><span class="form_text">
      <input type="text" name="xglance_direct_latest" value="<?php echo $glance_direct_latest; ?>" /> 
    </span>        </tr>
</table><br />
<?php    echo '<input type="hidden" name="op" value="FGAC_Save" />'
	.'<center><input type="submit" value="'._FGASAVECHANGES.'" /></center>'
	.'</form>';
	?>
<div align="right">Forums Glance Administration v<?php echo $glance_version ?><p><a class='inline' href="#inline_content">&copy Copyright 2014</a></p>

		<!-- This contains the hidden content for inline calls -->
		<div style='display:none'>
			<div id='inline_content' style='padding:10px; background:#fff;'>
			<p><h3><center>Module Copyright © Information<br />Forums Glance Administration v2.0 for Platinum Nuke Pro v1 and v2</center></h3><br /><br />
 Module's Name: Forums Glance Administration.<br /><br />  
 Module's Version: 2.0<br />
 License: GNU/GPL<br /> 
 Original Platinum Nuke Pro Author's Name: sgtmudd<br /> 
 Platinum Nuke Pro update Author's Name: DocHaVoC<br /> 
 Platinum Nuke Pro Homepage: http://platinumnukepro.com<br /><br />
 <strong>Module's Description:<br /> This is an updated version of the Forums Glance Administration MOD for Platinum Nuke Pro v1 and v2 Forum At-A-Glance MOD , Allows you to customize the appearance, edit the number of news articles you want to display, edit the number of recent articles you want displayed, Enable or Disable the Forum At-A-Glance MOD and much more.</strong><br /><br /></div>
</div>
	</div>
<?php
CloseTable();
		include_once(NUKE_BASE_DIR. 'footer.php');
}	
/* Forums Glance Admin v2.0 Updated by DocHaVoC (01232014) */
function FGAC_Save ($xglance_enable,$xglance_news_forum_id, $xglance_num_news, $xglance_num_recent, $xglance_recent_ignore, $xglance_news_heading, $xglance_recent_heading, $xglance_show_new_bullets, $xglance_track, $xglance_auth_read, $xglance_topic_length, $xglance_direct_latest) {
    global $prefix, $db, $admin_file;
    $db->sql_query("UPDATE ".$prefix."_fga_config SET $glance_enable='$$xglance_enable', glance_news_forum_id='$xglance_news_forum_id', glance_num_news='$xglance_num_news', glance_num_recent='$xglance_num_recent', glance_recent_ignore='$xglance_recent_ignore', glance_news_heading='$xglance_news_heading', glance_recent_heading='$xglance_recent_heading', glance_show_new_bullets='$xglance_show_new_bullets', glance_track='$xglance_track', glance_auth_read='$xglance_auth_read', glance_topic_length='$xglance_topic_length', glance_direct_latest='$xglance_direct_latest'");
}
/* Forums Glance Admin v2.0 Updated by DocHaVoC (01232014) */
	
?>
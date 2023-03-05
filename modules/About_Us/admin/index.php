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
/* About Us v1.0 by sgtmudd (sgtmudd@mach-hosting.com)                         */
/* Copyright (c) 2017 sgtmudd http://platinumnukepro.com                       */
/*******************************************************************************/

if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}
// start save
if (isset($_GET['action']) && $_GET['action'] == "save") {  

global $prefix, $db, $admin_file, $currentlang;

include_once(NUKE_BASE_DIR. 'header.php');
include_once(NUKE_BASE_DIR. 'modules/About_Us/admin/language/lang-'.$currentlang.'.php');

echo "<script type=\"text/javascript\" src=\"includes/javascript/notify.js\"></script>\n";
echo "<script type=\"text/javascript\">$.notify(\"Updated\", \"success\");</script>";

$au_result = mysql_connect($dbhost, $dbuname, $dbpass);
mysql_select_db($dbname); 
if (!$au_result)
  {
  die('Could not connect: ' . mysql_error());
  }

$about_data=mysql_real_escape_string($_POST['about_data']);

$query=("UPDATE ".$prefix."_about_us SET about_data='$about_data'");

$result = $db->sql_query($query);
if (!$result) {
    die('Could not query:' . mysql_error());
	}
}
//end save
function AboutUsAdmin() {
	global $module_name, $prefix, $db, $admin_file, $currentlang;
	
	include_once(NUKE_BASE_DIR. 'header.php');

		$query = "SELECT about_data FROM ".$prefix."_about_us WHERE id='1'";
		
		if ($result = $db->query($query)) {
			while ($row = $result->fetch_row()) {
				$about_data = $row[0];
			}
			$result->close();
}
		
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=About_Us'>" . _AU_ADMIN . "</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>" . _AU_MAINADMIN . "</a></center></strong>";
CloseTable();
    OpenTable();
    echo "<center><font class=\"title\"><strong>" . _AU_ADMIN . "</strong></font></center>";
    CloseTable();
OpenTable()
?>
<div align="center">
<p><strong><?php echo "" . _AU_INFO . "" ?></strong></p>
<form action="admin.php?op=About_Us&action=save" method="post">
<table border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td><?php wysiwyg_textarea("about_data", "$about_data", "AboutData", "120", "15"); ?></td>
  </tr>
</table><br />
<input type="submit" value=<?php echo "" . _AU_SAVECHANGES . "" ?> /> <input type="button" value=<?php echo "" . _AU_CANCEL . "" ?> onclick="window.location.href='admin.php?op=About_Us'" />
</form><br />
</div>
<?php
CloseTable();
echo '<div align="right">About Us Admin v1.1 Copyright &copy; '.date(Y).' sgtmudd - <a target="_blank" href="http://platinumnukepro.com">Platinum Nuke Pro</a></div>';
		include_once(NUKE_BASE_DIR. 'footer.php');
	}
	switch($op)
	{
		default:
			AboutUsAdmin();
			break;
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Set Platinum Nuke Permissions</title>
</head>
<body>
<h2>Setting Platinum Nuke Permissions</h2>
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
$file_dir = "/";
echo "Setting Permissions - Please Wait ...<br/>\n";
echo "<br/>\n";
echo "Attempting to set permissions on folder /files to 777...";
if( @chmod("files", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /files/thumbs to 777...";
if( @chmod("files/thumbs", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/coppermine/albums to 777...";
if( @chmod("modules/coppermine/albums", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";	
echo "Attempting to set permissions on file /includes/smtp.php to 666...";
if( @chmod("includes/smtp.php", 0666 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on file /config.php to 644...";
if( @chmod("config.php", 0644 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/NukeC30/imageads to 777...";
if( @chmod("modules/NukeC30/imageads", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/NukeC30/imagecatg to 777...";
if( @chmod("modules/NukeC30/imagecatg", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/Forums/cache to 777...";
if( @chmod("modules/Forums/cache", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/Forums/images/avatars to 777...";
if( @chmod("modules/Forums/images/avatars", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on file /modules/Forums/language/lang_english/lang_faq.php to 666...";
if( @chmod("modules/Forums/language/lang_english/lang_faq.php", 0666 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on file /modules/Forums/language/lang_english/lang_rules.php to 666...";
if( @chmod("modules/Forums/language/lang_english/lang_rules.php", 0666 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/Supporters/images/supporters to 777...";
if( @chmod("modules/Supporters/images/supporters", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/Downloads/dl to 777...";
if( @chmod("modules/Downloads/dl", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/Member_Application/admin/update.log to 666...";
if( @chmod("modules/Member_Application/admin/update.log", 0666 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/PrivateDownloads/loads to 777...";
if( @chmod("modules/PrivateDownloads/loads", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/HTML_Newsletter/archive to 777...";
if( @chmod("modules/HTML_Newsletter/archive", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /images/CZUser to 777...";
if( @chmod("images/CZUser", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /images/CZUser/admin to 777...";
if( @chmod("images/CZUser/admin", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/Link_Us/buttons to 777...";
if( @chmod("modules/Link_Us/buttons", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /modules/Universal/images/uploaded to 777...";
if( @chmod("modules/Universal/images/uploaded", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /userfiles to 777...";
if( @chmod("userfiles", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
/*
echo "Attempting to set permissions on folder /userfiles/_thumbs to 777...";
if( @chmod("userfiles/_thumbs", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /userfiles/_thumbs/Images to 777...";
if( @chmod("userfiles/_thumbs/Images", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
*/
echo "Attempting to set permissions on folder /userfiles/files to 777...";
if( @chmod("userfiles/files", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /userfiles/flash to 777...";
if( @chmod("userfiles/flash", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
echo "Attempting to set permissions on folder /userfiles/images to 777...";
if( @chmod("userfiles/images", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
// START SNAVI Permissions
echo "Attempting to set permissions on folder /includes/snavi to 777...";
if( @chmod("includes/snavi", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
// END SNAVI Permissions
// START At-A-Glance config Permissions
echo "Attempting to set permissions on file /modules/Forums/glance_config.php to 777...";
if( @chmod("modules/Forums/glance_config.php", 0777 ) )
	echo "<font color=green>Success</font><br/>\n";
else
	echo "<font color=red><strong>Failed. Please perform this step manually.</strong></font><br/>\n";
// END At-A-Glance config Permissions
	echo "<br/>\n";
	echo "<br/>\n";
	echo "Double check that all permissions were successfully set.<br/>\n";
	echo "<br/>\n";
	echo "*** IMPORTANT IMPORTANT IMPORTANT *** <br/>\n";
	echo "Once you have completed the remaining steps, Delete the \"SETPERMISSIONS.PHP\" file and the INSTALL directory.<br/>\n";
	echo "Close this Window to return to the Site.<br/>\n";
?>
<input type="button" value="Close Window" onClick="window.close()">
</body>
</html>

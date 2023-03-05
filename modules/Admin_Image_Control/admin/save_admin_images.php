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
/* Admin Image Control v1.0 by sgtmudd (sgtmudd@mach-hosting.com)              */
/* Copyright (c) 2017 sgtmudd http://platinumnukepro.com                       */
/*******************************************************************************/

if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}

include_once(NUKE_BASE_DIR. 'header.php');

	$path="http://".$_SERVER['SERVER_NAME']."/modules/".$module_name."/admin_images/";
	$img_name=$_FILES["file"]["name"];
	$PathFile=$path.$img_name;
	
Opentable();

	echo '<h3>'._AICRESULTS.':</h3>';
	
		global $module_name, $admin_file;
	
			if ((($_FILES["file"]["type"] == "image/gif")
				|| ($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/jpg")
				|| ($_FILES["file"]["type"] == "image/png")
				|| ($_FILES["file"]["type"] == "application/x-shockwave-flash"))
			&& ($_FILES["file"]["size"] < 20000000))
			  {
			  if ($_FILES["file"]["error"] > 0)
				{
				echo ""._AICRETURNCODE.": " . $_FILES["file"]["error"] . "<br />";
				echo '<a href='.$admin_file.'.php?op=Admin_Image_Control><strong>['._AICBACK.']</strong></a>';
				}
			  else
				{
				echo "<table border='0' cellpadding='3' cellspacing='1'>";
				echo "<tr><td><img height='200' width='200' src=$PathFile /><br />  ("._AICIMAGERESIZED." 200x200 px.)</td></tr>";
				echo "<tr class='form_text'><td>"._AICINAME.": </td><td>" . $_FILES["file"]["name"] . "</td></tr>";
				echo "<tr class='form_text'><td>"._AICITYPE.": </td><td>" . $_FILES["file"]["type"] . "</td></tr>";
				echo "<tr class='form_text'><td>"._AICISIZE.": </td><td>" . ($_FILES["file"]["size"] / 1024) . " Kb</td></tr>";
				echo '</td></tr></table>';
			
				if (file_exists(NUKE_MODULES_DIR.$module_name."/admin_images/" . $_FILES["file"]["name"]))
				  {
				  echo "<h3 class='warning'>"._AICALREADYEXISTS."</h3>";
			
					echo '<a href='.$admin_file.'.php?op=Admin_Image_Control><strong>['._AICBACK.']</strong></a>';
			
				  }
				else
				  {
				  move_uploaded_file($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/modules/".$module_name."/admin_images/" . $_FILES["file"]["name"]);
				  echo '<h3 class="success">'._AICSUCCESS.'!</h3>';
				  echo '<a href='.$admin_file.'.php?op=Admin_Image_Control><strong>['._AICCONTINUE.']</strong></a>';
				  }
				}
			  }
			else
			  {
			  echo '<br /><h3 class="failed">'._AICINVALID.'.</h3><br />';
			  echo '<a href='.$admin_file.'.php?op=Admin_Image_Control><strong>['._AICBACK.']</strong></a>';
			  }
			echo '<ul></ul>';
CloseTable();
	echo '<div align="right">Admin Image Control v1.0 Copyright &copy; 2017 sgtmudd - <a target="_blank" href="http://platinumnukepro.com">Platinum Nuke Pro</a></div>';
include_once(NUKE_BASE_DIR.'footer.php');
?>
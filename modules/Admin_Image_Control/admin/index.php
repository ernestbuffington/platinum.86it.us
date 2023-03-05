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
function adminImageCTRL() {
	
		global $module_name, $prefix, $db, $admin_file, $currentlang;

		include_once(NUKE_BASE_DIR. 'header.php');
		
		Opentable();
			echo "<strong><center><a href='".$admin_file.".php?op=Admin_Image_Control'>"._AICADMIN."</a></center></strong>";
			echo "<strong><center><a href='".$admin_file.".php'>"._AICMAINADMIN."</a></center></strong>";
		CloseTable();
		OpenTable();
			echo '<h3 align="center">'._AICADMIN.'</h3>'; 
			?>
			<p align="center"><?php echo _AICINFO; ?></p>
			<div align="center">
			  <table border="1px">
				<tr><td><?php echo _AICADDIMAGE; ?>:</td></tr>
				<tr><td>
			  <form action=<?php echo $admin_file.".php?op=Admin_Image_Save"; ?> method="post" enctype="multipart/form-data">
			  <label for="file">Filename:</label>
			  <input type="file" name="file" id="file" />
			  <br />
				(<?php echo _AICALLOWEDEXT; ?>: gif, jpg, png, swf)<br />
				<input type="submit" name="submit" value="<?php echo _AICADDIMAGE; ?>" />
			  </form>
			  </td></tr></table>
			</div>
			<?php
			echo '<div align="center">('._AICSTORED.' /modules/'.$module_name.'/admin_images/) (CHMOD: 777)<br /><br />';
			echo ''._AICCURRENT.': ('._AICRESIZED.' 100x300 px.)<br />';
			echo "<table border='1px'>
					<tr>
						<td>"._AICDELETE."?</td>
						<td>Image URL</td>
						<td>Image <font size='-2'><strong>("._AICCLICK2VIEW.")</strong></font></td>
					</tr>";
			$path=NUKE_MODULES_DIR.$module_name.'/admin_images/';
			$image_path="http://".$_SERVER['SERVER_NAME']."/modules/".$module_name."/admin_images/";
			$images = scandir($path);
			$ignore = Array(".", "..", ".htaccess", "thumbs.db", "index.html");
			foreach($images as $curimg){if(!in_array($curimg, $ignore)) {
			echo "<tr>
					<td><form action=$admin_file.php?op=Admin_Image_Delete method='post'><input type='hidden' name='img_name' value='$curimg'>
			<center><input type='submit' value='Delete'><br />"._AICNOUNDO."!</center>
			</form></td>
			<td><input size='100' type='text' value=$image_path$curimg /><br /> ("._AICCOPYPASTE.")</td>
			<td id='lbox'><a target='_blank' href='$image_path$curimg'><img height='75px' width='150' src='$image_path$curimg' /></a></td>
			";
			};
			}
			
			echo "</tr></table></div><br />";
			echo '<ul></ul>';
			
		CloseTable();
			echo '<div align="right">Admin Image Control v1.0 Copyright &copy; '.date(Y).' sgtmudd - <a target="_blank" href="http://platinumnukepro.com">Platinum Nuke Pro</a></div>';
		include_once(NUKE_BASE_DIR. 'footer.php');
	}
	switch($op)
	{
		default:
			adminImageCTRL();
			break;
	}
?>
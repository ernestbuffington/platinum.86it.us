<?php
/************************************************************************/
/* NukeTreasury - Financial management for PHP-Nuke                      */
/* Copyright (c) 2004 by Dave Lawrence AKA Thrash                       */
/*                       thrash@fragnastika.com                         */
/*                       thrashn8r@hotmail.com                          */
/*                                                                      */
/* This program is free software; you can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/* This program is distributed in the hope that it will be useful, but  */
/* WITHOUT ANY WARRANTY; without even the implied warranty of           */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU     */
/* General Public License for more details.                             */
/*                                                                      */
/* You should have received a copy of the GNU General Public License    */
/* along with this program; if not, write to the Free Software          */
/* Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307  */
/* USA                                                                  */
/* Upgraded and cleaned up by Telli http://codezwiz.com                 */
/************************************************************************/
if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}
global $admin_file;

if (($radminsuper==1) OR ($radmintreasury==1)) {
    adminmenu("".$admin_file.".php?op=Donations#AdminTop", "Donations", "donations.gif");
}

?>
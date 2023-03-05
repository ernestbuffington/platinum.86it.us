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
/********************************************************************

                    DarkForgeGFX Link To Us
				  
	(c) 2007 - 2008 by DarkForgeGFX - http://www.darkforgegfx.com
		
********************************************************************/

function inactive_sites(){

		global $prefix, $db, $admin_file, $op;

OpenTable();

	$num = 0;
	$result = $db->sql_query("SELECT id, site_name, site_url, site_image, site_description, site_hits, site_status, date_added FROM ".$prefix."_link_us WHERE site_status = '0' AND button_type = '1'");
	$numrows = $db->sql_numrows($result);

	if ($numrows > 0) {
	echo "<table border='0' cellpadding='2' cellspacing='5' width='100%' align='center'>";
	echo "<tr><th width='100%'>Standard Size Buttons</th></tr>";
	echo "</table>";
  	echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
  	while(list($id, $site_name, $site_url, $site_image, $site_description, $site_hits, $site_status, $date_added) = $db->sql_fetchrow($result)) {

    if ($num == 0) { echo "<tr>"; }
    echo "<td width='50%' valign='top'>";
    LinkusTableOpen();
    echo "<table border='0' width='100%'>";
    echo "<tr><td width='25%' align='center' rowspan='3'>";	
	echo "<img src='".$site_image."' border='0' align='absmiddle'>";
	if (is_admin($admin_file)) {
      echo "<br /><br /><a href='".$admin_file.".php?op=edit_button&id=".$id."'><img src='images/edit.gif' border='0' alt='Edit' title='Edit'></a>";
      echo " <a href='".$admin_file.".php?op=delete_button&id=".$id."'><img src='images/delete.gif' border='0' alt='Delete' title='Delete'></a>";
    }
    echo "</td>";	
	echo "<td width='75%' valign='top'><strong>Site Name:</strong> ".$site_name." <br /> <strong>Description:</strong> ".$site_description." <br /> <strong>Added:</strong> ".$date_added." <br /> <strong>Visits:</strong> ".$site_hits."</td></tr>";
    echo "</table>";
    LinkusTableClose();
    echo "</td>";
    $num++;
    if ($num == 2) { echo "</tr>"; $num = 0; }
  }
  if ($num ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
}

	$num = 0;
	$result = $db->sql_query("SELECT id, site_name, site_url, site_image, site_description, site_hits, site_status, date_added FROM ".$prefix."_link_us WHERE site_status = '0' AND button_type = '2'");
	$numrows = $db->sql_numrows($result);

	if ($numrows > 0) {
	echo "<br /><br />";
	echo "<table border='0' cellpadding='2' cellspacing='5' width='100%' align='center'>";
	echo "<tr><th width='100%'>Banner Size Buttons</th></tr>";
	echo "</table>";
  	echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
  	while(list($id, $site_name, $site_url, $site_image, $site_description, $site_hits, $site_status, $date_added) = $db->sql_fetchrow($result)) {

    if ($num == 0) { echo "<tr>"; }
    echo "<td width='50%' valign='top'>";
    LinkusTableOpen();
    echo "<table border='0' width='100%'>";
    echo "<tr><td width='25%' align='center' valign='top' rowspan='3'>";	
	echo "<img src='".$site_image."' border='0'>";
	echo "<br /><strong>Site Name:</strong> ".$site_name." <br /> <strong>Description:</strong> ".$site_description." <br /> <strong>Added:</strong> ".$date_added." <br /> <strong>Visits:</strong> ".$site_hits."";
	if (is_admin($admin_file)) {
      echo "<br /><br /><a href='".$admin_file.".php?op=edit_button&id=".$id."'><img src='images/edit.gif' border='0' alt='Edit' title='Edit'></a>";
      echo " <a href='".$admin_file.".php?op=delete_button&id=".$id."'><img src='images/delete.gif' border='0' alt='Delete' title='Delete'></a>";
    }
    echo "</td>";	
	//echo "<td width='75%' valign='top'><strong>Site Name:</strong> ".$site_name." <br /><br /> <strong>Description:</strong> ".$site_description." <br /><br /> <strong>Added:</strong> ".$date_added." <br /><br /> <strong>Visits:</strong> ".$site_hits."</td></tr>";
    echo "</table>";
    LinkusTableClose();
    echo "</td>";
    $num++;
    if ($num == 1) { echo "</tr>"; $num = 0; }
  }
  if ($num ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
}


	$num = 0;
	$result = $db->sql_query("SELECT id, site_name, site_url, site_image, site_description, site_hits, site_status, date_added FROM ".$prefix."_link_us WHERE site_status = '0' AND button_type = '3'");
	$numrows = $db->sql_numrows($result);

	if ($numrows > 0) {
	echo "<br /><br />";
	echo "<table border='0' cellpadding='2' cellspacing='5' width='100%' align='center'>";
	echo "<tr><th width='100%'>Resources</th></tr>";
	echo "</table>";
  	echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
  	while(list($id, $site_name, $site_url, $site_image, $site_description, $site_hits, $site_status, $date_added) = $db->sql_fetchrow($result)) {

    if ($num == 0) { echo "<tr>"; }
    echo "<td width='25%' valign='top'>";
    LinkusTableOpen();
    echo "<table border='0' width='100%'>";
    echo "<tr><td width='25%' align='center'>";	
	echo "<img src='".$site_image."' border='0' align='absmiddle'><br />Clicks ".$site_hits."";
	if (is_admin($admin_file)) {
      echo "<br /><br /><a href='".$admin_file.".php?op=edit_button&id=".$id."'><img src='images/edit.gif' border='0' alt='Edit' title='Edit'></a>";
      echo " <a href='".$admin_file.".php?op=delete_button&id=".$id."'><img src='images/delete.gif' border='0' alt='Delete' title='Delete'></a>";
    }
    echo "</td>";	
	//echo "<td width='75%' valign='top'><strong>Site Name:</strong> ".$site_name." <br /> <strong>Description:</strong> ".$site_description." <br /> <strong>Added:</strong> ".$date_added." <br /> <strong>Visits:</strong> ".$site_hits."</td>";
	echo "</tr>";
    echo "</table>";
    LinkusTableClose();
    echo "</td>";
    $num++;
    if ($num == 4) { echo "</tr>"; $num = 0; }
  }
  if ($num == 1) { echo "<td width='25%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
}

CloseTable();
}

switch($op){

	case 'inactive_sites': inactive_sites(); break;
	
}


?>
<?php
// ------------------------------------------------------------------------ //
// Coppermine Photo Gallery 1.3.1c for CMS     2007.09.05                   //
// ------------------------------------------------------------------------ //
// Copyright (C) 2002,2003  GrAcgory DEMAR <gdemar@wanadoo.fr>              //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------ //
// Updated by the Coppermine Dev Team                                       //
// (http://coppermine.sf.net/team/)                                         //
// see /docs/credits.html for details                                       //
// ------------------------------------------------------------------------ //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------ //
// Pc-Nuke! Systems - Development/Support - Coppermine for PHP-Nuke         //
// http://www.pcnuke.com                                                    //
// Website for Port Upgrades from 1.3.0 and up...                           //
// ------------------------------------------------------------------------ //
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
if (preg_match("#modules/#i", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}
define('DISPLAYIMAGE_PHP', true);
define('NO_HEADER', true);
require("modules/" . $name . "/include/load.inc");
if (is_numeric($pid)) {
    $result = db_query("SELECT filepath,filename,pwidth,pheight,p.title FROM {$CONFIG['TABLE_PICTURES']} as p INNER JOIN {$CONFIG['TABLE_ALBUMS']} ON (".VIS_GROUPS.") WHERE approved = 'YES' AND p.pid = $pid GROUP BY p.pid");
    $row = mysql_fetch_array($result);
    if ($row[0]=''){
        cpg_die(ERROR, $lang_errors['members_only']);
    }
    $pic_url = get_pic_url($row, 'fullsize');
    $geom = 'width="' . $row['pwidth'] . '" height="' . $row['pheight'] . '"'; 
} else {
    cpg_die(3, $lang_errors['param_missing']);
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title> <?php $row["title"];?> ( <?php $lang_fullsize_popup["click_to_close"] ?>)</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no">
<link rel="stylesheet" href="<?php echo $CPG_M_DIR;?>/themes/default/style.css" />
<meta http-equiv="imagetoolbar" content="no">
<script type="text/javascript" src="<?php echo $CPG_M_DIR;?>/scripts.js"></script>
<style type="text/css">
<!--
.imgtblCover { overflow: visible; position: absolute; visibility: visible; left: 0px; top: 0px; ; z-index: 2;  background-attachment: fixed; background-image: url(/<?php echo $CPG_M_DIR;?>/images/spacer.gif); background-repeat: repeat; height: 95%; width: 100%}
-->
</style>
<link rel="stylesheet" href="/modules/coppermine/themes/default/style.css" type="text/css">
</head>
<body onClick="self.close()" onBlur="self.close()">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="2" class="imgtbl">
     <tr><td align="center" valign="middle"> 
    <?php 
    print '<img src="' . $pic_url . '" ' . $geom . ' class="image" border="0" alt="' . $alt . '">';
?></td></tr>
</table>
<table border="0" cellpadding="0"  class="imgtblCover">
     <tr onClick="self.close()"><td align="center" valign="bottom"><p class="piccopy">&copy <?php $sitename ?></p>
</td></tr>
</table>
</body>
</html>

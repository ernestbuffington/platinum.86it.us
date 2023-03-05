<?php
/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    Created by Pc-Nuke! Systems -- Released: 2008                     */
/*    http://www.pcnuke.com                             	            */
/*    All Rights Reserved || 2003-2008 || by Pc-Nuke!                   */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/
/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.pcnuke.com/modules.php?name=GNU_GPL                     */
/************************************************************************/
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
// Coppermine Photo Gallery 1.3.2 for CMS     2008.02.01               //
// -------------------------------------------------------------------- //
// Copyright (C) 2002,2003  GrAcgory DEMAR <gdemar@wanadoo.fr>          //
// http://www.chezgreg.net/coppermine/                                  //
// -------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                   //
// (http://coppermine.sf.net/team/)                                     //
// see /docs/credits.html for details                                   //
// ---------------------------------------------------------------------//
// New Port by GoldenTroll                                              //
// http://coppermine.findhere.org/                                      //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/           //
/************************************************************************/
define('DISPLAYIMAGE_PHP', true);
define('NO_HEADER', true);
require("modules/" . $name . "/include/load.inc");
if (phpversion() <= '4.0.6') {
    $_GET = ($_GET);
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><? echo $lang_fullsize_popup["click_to_close"] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="<? echo $CPG_M_DIR;?>/themes/default/style.css" />
<meta http-equiv="imagetoolbar" content="no">
<script type="text/javascript" src="<? echo $CPG_M_DIR;?>/scripts.js"></script>
<style type="text/css">
<!--
.imgtbl {  position: absolute; left: 0px; top: 0px; overflow: scroll; }
-->
</style>
</head>
<!-- <body>
<a href="javascript:self.close();" title="<? echo $lang_fullsize_popup["click_to_close"];?>"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="2" class="imgtbl">
-->
<body onClick="self.close()">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="2" class="imgtbl" title="<?php  $lang_fullsize_popup["click_to_close"];?>">
     <td align="center" valign="middle"> 
          <table cellspacing="2" cellpadding="0" style="border: 1px solid #000000; background-color: #FFFFFF;">
               <td> 
<script type="text/javascript"><!--
<?php
   // showpic() function taken from: http://www.dragonquest.con/
?>
function showpic(src, w, h, alt, aln, pw, ph, bw, bh) {
if (src == null) return;
var iw, ih; // Set inner width and height
if (window.innerWidth == null) {
iw = document.body.clientWidth;
ih=document.body.clientHeight;
}
else {
iw = window.innerWidth;
ih = window.innerHeight;
}
if (w == null) w = iw;
if(h == null)  h = ih;
if(alt == null) alt = src;
if(aln == null) aln = "center";
if(pw == null) pw = 100;
if(ph == null) ph = 100;
if(bw == null) bw = 24;
if(bh == null) bh = 24;
var sw = Math.round((iw - bw) * pw / 100);
var sh = Math.round((ih - bh) * ph / 100);
if ((w * sh) / (h * sw) < 1) sw = Math.round(w * sh / h);
else sh = Math.round(h * sw / w);
document.write('<img src="'+src+'" alt="'+alt+'" width="'+sw+'" height="'+sh+'" class="image" border="0" align="'+aln+'">');
}
//-->
</script>
<?php
if (isset($picfile)) {
    $picname = $CONFIG['fullpath'] . $picfile;
    $imagesize = @getimagesize($picname);
    $img_src = path2url($picname);
    $img_width = $imagesize[0];
    $img_height = $imagesize[1];
    $img_alt = $picfile;
} elseif (isset($pid)) {
    $result = db_query("SELECT * from {$CONFIG['TABLE_PICTURES']} where pid='$pid'");
    $row = mysql_fetch_array($result);
    $img_src = get_pic_url($row, 'fullsize');
    $img_width = $row['pwidth'];
    $img_height = $row['pheight'];
    $img_alt = $lang_fullsize_popup["click_to_close"];
}
if(!empty($img_src) AND (($img_height = intval($img_height)) > 0))
{
   echo "<script language=\"javascript\">\n";
   if(($img_width = intval($img_width)) > 0)
   {
      echo "showpic(\"".$img_src."\", $img_width, $img_height, \"".$img_alt."\", \"middle\");";
   }
   else
   {
      // image fit the browser's window (...)
      echo "showpic(\"".$img_src."\", null, null, \"".$img_alt."\");";
   }
   echo "\n</script>";
}
else
{
   echo "Invalid image/arguments..";
}
?>
               </td>
          </table>
     </td>
</table><!-- </a> -->
<script language="JavaScript" type="text/javascript">
</script>
</body>
</html>

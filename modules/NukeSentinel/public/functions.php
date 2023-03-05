<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/
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

if(!defined("NUKESENTINEL_PUBLIC")) { header("Location: ../../../index.php"); }

function stmain_menu($subtitle = "") {
  global $db, $prefix, $module_name;
  if($subtitle > "") { $subtitle = ": ".$subtitle; }
  OpenTable();
  $checkrow = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country`"));
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
  echo '<tr><td align="center" colspan="3" class="title">'._AB_NUKESENTINEL.$subtitle.'</td></tr>'."\n";
  echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STIPS">'._AB_BLOCKEDIPS.'</a></td></tr>'."\n";
  echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STRanges">'._AB_BLOCKEDRANGES.'</a></td></tr>'."\n";
  echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STReferers">'._AB_BLOCKEDREFERERS.'</a></td></tr>'."\n";
  if($checkrow > 0) { echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STIP2C">'._AB_IP2COUNTRY.'</a></td></tr>'."\n"; }
  echo '</table>'."\n";
  CloseTable();
}

function stpagenumspub($op, $totalselected, $perpage, $max, $column, $direction) {
  global $module_name;
  $pagesint = ($totalselected / $perpage);
  $pageremainder = ($totalselected % $perpage);
  if($pageremainder != 0) {
    $pages = ceil($pagesint);
    if($totalselected < $perpage) { $pageremainder = 0; }
  } else {
    $pages = $pagesint;
  }
  if($pages != 1 && $pages != 0) {
    $counter = 1;
    $currentpage = ($max / $perpage);
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
    echo '<tr>'."\n";
    echo '<td width="33%">'."\n";
    echo '<form action="modules.php?name='.$module_name.'&amp;op='.$op.'" method="post" style="padding: 0px; margin: 0px;">'."\n";
    echo '<input type="hidden" name="min" value="'.(($max - $perpage) - $perpage).'" />'."\n";
    echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
    echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
    if($currentpage <= 1) {
      echo '&nbsp;';
    } else {
      echo '<input type="submit" value="'._AB_PREVPAGE.'" />';
    }
    echo '</form>'."\n";
    echo '</td>'."\n";
    echo '<td align="center" width="34%" nowrap>'."\n";
    echo '<form action="modules.php?name='.$module_name.'&amp;op='.$op.'" method="post" style="padding: 0px; margin: 0px;">'."\n";
    echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
    echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
    echo '<strong>'._AB_PAGE.':</strong> <select name="min">'."\n";
    while ($counter <= $pages ) {
      $cpage = $counter;
      $mintemp = ($perpage * $counter) - $perpage;
      echo '<option value="'.$mintemp.'"';
      if($counter == $currentpage) { echo ' selected="selected"'; }
      echo '>'.$counter.'</option>'."\n";
      $counter++;
    }
    echo '</select><strong> '._AB_OF.' '.$pages.' '._AB_PAGES.'</strong> <input type="submit" value="'._AB_GO.'" />'."\n";
    echo '</form>'."\n";
    echo '</td>'."\n";
    echo '<td align="right" width="33%">';
    echo '<form action="modules.php?name='.$module_name.'&amp;op='.$op.'" method="post" style="padding: 0px; margin: 0px;">'."\n";
    echo '<input type="hidden" name="min" value="'.$max.'" />'."\n";
    echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
    echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
    if($currentpage >= $pages) {
      echo '&nbsp;';
    } else {
      echo '<input type="submit" value="'._AB_NEXTPAGE.'" />';
    }
    echo '</form>'."\n";
    echo '</td>'."\n";
    echo '</tr>'."\n";
    echo '</table>'."\n";
  }
}

?>
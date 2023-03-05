<?php
######################################################################
# Emporium 2.3.5
######################################################################
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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $db, $prefix, $ab_config, $cartconfig;
$module_name = "Shopping_Cart";
//require_once("modules/$module_name/includes/minicore.php");
get_lang($module_name);
$result = $db->sql_query("select category_id, title, cdescription, image from ".$prefix."_cart_categories where parentid='0' order by title");
$numrows = $db->sql_numrows($result);
$content = "<table width=\"100%\"><tr>";
$rownum = 0;
if($numrows > 0){
        while(list($category_id, $title, $cdescription, $image) = $db->sql_fetchrow($result) ) {
                $content .= "<td width=\"50%\"><table width=\"100%\">";
                $content .= "<tr><td colspan=\"2\"><a href=\"modules.php?name=$module_name&file=category&c_op=viewcat&amp;category_id=$category_id\"><strong>$title</strong></a></td></tr>";
                $content .= "<tr><td width=\"25%\" valign=top>";
                if ($image != ""){
                        $content .= "<a href=\"modules.php?name=$module_name&file=category&c_op=viewcat&amp;category_id=$category_id\"><IMG SRC=\"".$cartconfig->value("thumbFolder")."$image\" BORDER=0 VSPACE=3 HSPACE=3></a>";
                }
                $content .= "</td><td width=\"75%\" valign=\"top\">";
                // Child list
                $result2 = $db->sql_query("select category_id, title, cdescription from ".$prefix."_cart_categories where parentid='".$category_id."' order by title");
                $numrows2 = $db->sql_numrows($result2);
                if($numrows > 0) {
                        while(list($category_id2, $title2, $cdescription2) = $db->sql_fetchrow($result2) ) {
                                
                                $content .= "<a href=\"modules.php?name=$module_name&file=category&c_op=viewcat&amp;category_id=$category_id2\">$title2</a><br />";
                        }
                }
                $content .= "</td>";
                $content .= "</tr></table>";
               // $content .= "</td>";
                $rownum++;
                if ($rownum % 2 == 0)
                        $content .= "</tr><tr>";
        }
        $content .= "</tr></table>";
} else {
        $content .= ""._EMPORIUM_BLOCK_CATEGORIES_NOCATEGORIES."</table>";
}
?>

<?php 

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Block display categories of Top Sites                                */
/* Copyright (c) 2003-2004 by Sid                                       */
/* http://nuke.xanys.com                                                */
/* webmaster@xanys.com                                                  */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/* PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/* Refer to TechGFX.com for detailed information on PHP-Nuke Platinum   */
/*                                                                      */
/* TechGFX: Your dreams, our imagination                                */
/************************************************************************/

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Top_Sites_Categories.php")) {
    Header("Location: ../index.html");
    die();
}

global $prefix, $db; 
$result=$db->sql_query("select catid,catname from ".$prefix."_top_sites_categories order by catname"); 
$numrows = $db->sql_numrows($result); 
$content .= "<br>"; 
if ($numrows!==0) { 
    //@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
   while(list($catid,$catname) = $db->sql_fetchrow($result)) { 
         $catid=intval($catid); 
         $catname=stripslashes($catname); 
         $content .= "::<a href=\"topsites-$catid.html\">$catname</a><br>"; 
   } 
} else { $content .="No catégories"; } 
$content .= "<br>";  

?>
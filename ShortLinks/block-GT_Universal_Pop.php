<?php

#####################################################
#													#
#	Universal Module 2.5							#
#	For PHP-Nuke 6.5+								#
#	By Barry Caplin - http://www.interactsoft.net	#
#													#
#	This is software is bound by the terms of the	#
#	license distrubuted with it. 					#
#	Please read license.txt							#
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

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Universal_Pop.php")) {
    Header("Location: ../index.html");
    die();
}

$mainprefix = "cheats";

global $prefix, $db;

$result = $db->sql_query("SELECT id, title, views FROM ".$prefix."_".$mainprefix."_items ORDER BY views DESC LIMIT 0,5");
//@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
while(list($eid, $title, $views) = $db->sql_fetchrow($result)) {
    $content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"universal-viewid$eid.html\">$title ($views)</a><br>";
}

?>
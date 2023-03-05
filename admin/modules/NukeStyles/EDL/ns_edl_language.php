<?php

/******************************************************/
/* ================================                   */
/* Enhanced Downloads Module - V3.0                   */
/* ================================                   */
/*                                                    */
/* Released: January, 8 2017                          */
/* Modified by w2ibc http://www.w2ibc.com             */
/* w2ibc@w2ibc.com                                    */
/*                                                    */
/* ================================                   */
/* Enhanced Downloads Module - V2.1                   */
/* ================================                   */
/*                                                    */
/* Released: January, 14 2003                         */
/* Copyright (c) 2003 by Shawn Archer                 */
/* shawn@nukestyles.com                               */
/* http://www.NukeStyles.com                          */
/*                                                    */
/******************************************************/
/*                                                    */
/* Copyright Notice:                                  */
/* =================                                  */
/*                                                    */
/* Francisco Burzi & the Nuke credits MUST            */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/

require_once("mainfile.php");

function ns_get_lang($module) {
    global $currentlang, $language;
    if ($module == admin) {
		if (file_exists("admin/modules/NukeStyles/EDL/language/lang-$currentlang.php")) {
			include_once("admin/modules/NukeStyles/EDL/language/lang-$currentlang.php");
		} else {
			include_once("admin/modules/NukeStyles/EDL/language/lang-english.php");
		}
    }
}

ns_get_lang(admin);

?>
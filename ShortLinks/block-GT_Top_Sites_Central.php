<?php

/************************************************************************/
/* Block Central Top Sites 6.5 and +                                    */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2003-2004 by Sid                                       */
/* http://nuke.xanys.com                                                */
/*                                                                      */
/* Block central TopSites for PHPNuke 6.5  and +                        */
/* Simple Center Block for TopSites from http://nuke.xanys.com/ module. */   
/* Displays random TopSite and counts clicks, if no banner images link  */
/* is displayed.                                                        */
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

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Top_Sites_Central.php")) {
    Header("Location: ../index.html");
    die();
}

global $prefix, $db;
$content = "<A name= \"scrollingCode\"></A>";
$content .="<MARQUEE behavior= \"scroll\" align= \"center\" direction= \"up\" height=\"80\" scrollamount= \"2\" scrolldelay= \"50\" onmouseover='this.stop()' onmouseout='this.start()'>";
$a = 1;
$result4 = $db->sql_query("select lid, title,url,urlban from ".$prefix."_top_sites where urlban <>'' and validation='Y' order by totalvotes desc");
while(list($lid, $title,$url,$urlban) = $db->sql_fetchrow($result4)) {
	$lid =intval($lid);
	$title =stripslashes($title);
	$url =stripslashes($url);
	$urlban =stripslashes($urlban);
$title2 = ereg_replace("_", " ", $title);
$content .= "<br><center><a href=\"topsites-visit-$lid.html\" target=\"_blank\">";
		            if (strpos($urlban,"swf")==TRUE) {
		               $image_size_flash = getimagesize("$urlban");
                       //@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
                       $width=$image_size_flash[0];
                       $height=$image_size_flash[1];
					   $content .= "<center><OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\"width=\"$width\" height=\"$height\"><PARAM NAME=movie value=\"$urlban\"><PARAM NAME=quality VALUE=high><PARAM NAME=bgcolor VALUE=#000000><PARAM NAME=menu VALUE=false><EMBED src=\"$urlban\" quality=high bgcolor=#000000  WIDTH=400 HEIGHT=250 TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" menu=\"false\"></EMBED></OBJECT>\n";

			        } else  {
                      $content .="<img src=\"$urlban\" border=\"0\" alt=\"$title\" title=\"$title\"></a>";
                    }
$content .="<br><strong>$title</strong> [<a href=\"topsites-ratelink-$lid.html\">VOTE</a> ]</center><br><br>";
$a++;
}

?>
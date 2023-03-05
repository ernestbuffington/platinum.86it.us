<?php

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

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Top_Sites_5.php")) {
    Header("Location: ../index.html");
    die();
}

global $prefix, $db;
$content .="<center>";
$content .="[ <a href=\"topsites.html\">TopSites</a> ] ";
$content .="[ <a href=\"topsites-AddLink.html\" >Ajouter</a> ]";
$content .="</center>";
$a = 1;
$result = $db->sql_query("select lid, title,url,urlban,hits,totalvotes  from ".$prefix."_top_sites where validation='Y' order by totalvotes DESC limit 0,5");
while(list($lid, $title_1,$url,$urlban,$hits,$totalvotes) = $db->sql_fetchrow($result)) {
	$lid =intval($lid);
	$title_1 =stripslashes($title_1);
	$url =stripslashes($url);
	$urlban =stripslashes($urlban);
	$hits =intval($hits);
	$totalvotes =intval($totalvotes);
	$title2 = ereg_replace("_", " ", $title_1);
	if ($a==1) {$ab="<img src=\"modules/Top_Sites/images/n1.gif\" width=\"15\" border=\"0\">";}
    //@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
	if ($a==2) {$ab="<img src=\"modules/Top_Sites/images/n2.gif\" width=\"15\" border=\"0\">";}
	if ($a==3) {$ab="<img src=\"modules/Top_Sites/images/n3.gif\" width=\"15\" border=\"0\">";}
	if ($a==4) {$ab="<img src=\"modules/Top_Sites/images/n4.gif\" width=\"15\" border=\"0\">";}
	if ($a==5) {$ab="<img src=\"modules/Top_Sites/images/n5.gif\" width=\"15\" border=\"0\">";}
    $content .= "$ab <a href=\"topsites-$lid-$title_1.html\">$title2</a><br>";
    if ($urlban !="") {
	$content .="<center><a href=\"topsites-$lid-$title_1.html\" target=\"_blank\" ><img src=\"$urlban\" width=\"88\" height=\"31\" border=\"0\"></a></center>";
    }
	$clicks=$hits + $totalvotes;
	$content .="[clicks : $clicks ] [<a href=\"topsites-ratelink-$lid.html\">Voter</a>]<br><br>";
	$a++;
}

?>
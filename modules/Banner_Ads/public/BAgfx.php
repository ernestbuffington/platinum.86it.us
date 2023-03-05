<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$ThemeSel = get_theme();
$secimg = "modules/Banner_Ads/images/code_bg.png";
if (file_exists("themes/$ThemeSel/images/code_bg.png")) { $secimg = "themes/$ThemeSel/images/code_bg.png"; }
$datekey = date("F j");
$rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
$code = substr($rcode, 2, 8);
$image = ImageCreateFromPNG($secimg);
$text_color = ImageColorAllocate($image, 0, 0, 0);
Header("Content-type: image/png");
ImageString ($image, 5, 5, 2, $code, $text_color);
ImagePNG($image, '', 75);
ImageDestroy($image);
die();

?>
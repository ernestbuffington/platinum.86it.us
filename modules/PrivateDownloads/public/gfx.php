<?php

/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on Platinum Nuke Pro*/
/*                                                                      */
/* Platinum: Your dreams, our imagination                               */
/************************************************************************/

$datekey = date("F j");
$rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
$code = substr($rcode, 2, 8);
$ThemeSel = get_theme();
if (file_exists("themes/$ThemeSel/images/code_bg.png")) {
  $codeimg = "themes/$ThemeSel/images/code_bg.png";
  include_once("themes/$ThemeSel/theme.php");
  $tcolor = str_replace("#", "", $textcolor1);
  $tc_r = hexdec(substr($tcolor, 0, 2));
  $tc_g = hexdec(substr($tcolor, 2, 2));
  $tc_b = hexdec(substr($tcolor, 4, 2));
} else {
  $codeimg = "images/code_bg.png";
  $tc_r = $tc_g = $tc_b = 0;
}
$image = ImageCreateFromPNG($codeimg);
$text_color = ImageColorAllocate($image, $tc_r, $tc_g, $tc_b);
Header("Content-type: image/png");
ImageString ($image, 5, 5, 2, $code, $text_color);
ImagePNG($image, '', 75);
ImageDestroy($image);
die();

?>

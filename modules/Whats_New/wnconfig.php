<?php


if (!defined('IN_WNM')) {
	die("Sorry, You can't access this file directly.");
}

$index = 1; //Turn Right Blocks On (1) or Off (0) / Bloques Derechos Activos (1) o Inactivos (0)
define('INDEX_FILE', true); //Turn Right Blocks On (TRUE) or Off (FALSE) / Bloques Derechos Activos (TRUE) o Inactivos (FALSE)
$ipb = 15; //Number Of Items Per Block / Items Por Bloque
$newsmod = "News"; // If you have changed your News module name specify it here, else leave as shown.
$reviewsmod = "Reviews"; // If you have changed your Reviews module name specify it here, else leave as shown.
$contentmod = "Content";// If you have changed your Content module name specify it here, else leave as shown.
$downloadsmod = "Downloads"; // If you have changed your Downloads module name specify it here, else leave as shown.
$weblinksmod = "Web_Links"; // If you have changed your Web_Links module name specify it here, else leave as shown.
$topmusicmod = "topMusic"; // If you have changed your topMusic module name specify it here, else leave as shown.
$youraccountmod = "Your_Account"; // If you have changed your Your_Account module name specify it here, else leave as shown.

//

$nsnnews = FALSE; // If you are using NSN News 2.0.0 or newer set this to TRUE, else set to FALSE.
$nsngd = FALSE; // If you are using NSN Group Downloads set this to TRUE, else set to FALSE.

?>

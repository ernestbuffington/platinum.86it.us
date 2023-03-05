<?php
/************************************************************************************************/
/**  Platinum Nuke Pro Theme																	*/
/**  ===============================															*/
/**  Theme BB_CFiber																			*/
/**  Designed By   : D. Miller AkA. DocHaVoC - http://www.havocst.net 							*/
/**  Theme Version : v1.0 (100% Width)															*/
/** Copyright     : A public theme for use with Platinum Nuke Pro http://www.platinumnukepro.com	*/
/**																								*/
/**	  Copyright (c) 2011 D. Miller AkA. DocHaVoC | All Rights Reserved							*/
/************************************************************************************************/
 
if (stristr($_SERVER['SCRIPT_NAME'], "header.php")) {
    die ("Access Denied");
}
echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"Table_01\">\n";
echo "<tr>\n";
echo "		<td rowspan=\"9\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_01.gif\" width=\"20\" height=\"255\" alt=\"\"></td>\n";
echo "		<td colspan=\"2\" rowspan=\"7\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_02.gif\" width=\"94\" height=\"211\" alt=\"\"></td>\n";
echo "		<td colspan=\"5\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_03.gif\" width=\"332\" height=\"18\" alt=\"\"></td>\n";
echo "		<td rowspan=\"9\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_04.gif\" width=\"73\" height=\"255\" alt=\"\"></td>\n";
echo "		<td rowspan=\"9\" background=\"themes/BB_CFiber/images/bb_cfiber_header_05.gif\" width=\"100%\" height=\"255\" alt=\"\"></td>\n";
echo "<td colspan=\"5\" rowspan=\"2\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_06.gif\" width=\"391\" height=\"35\" alt=\"\"></td>\n";
echo "		<td rowspan=\"9\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_07.gif\" width=\"20\" height=\"255\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"1\" height=\"18\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"5\" rowspan=\"5\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_logo.gif\" width=\"332\" height=\"159\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"1\" height=\"17\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"2\" rowspan=\"3\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_09.gif\" width=\"37\" height=\"135\" alt=\"\"></td>\n";
echo "		<td colspan=\"2\" background=\"themes/BB_CFiber/images/bb_cfiber_header_10.gif\" width=\"333\" height=\"51\" alt=\"\"><div align=\"center\">$slogan</div></td>\n";
echo "		<td rowspan=\"5\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_11.gif\" width=\"21\" height=\"176\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"1\" height=\"51\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"2\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_12.gif\" width=\"333\" height=\"14\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"1\" height=\"14\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"2\" background=\"themes/BB_CFiber/images/bb_cfiber_header_13.gif\" width=\"333\" height=\"70\" alt=\"\"><div align=\"center\">$theuser</div></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"1\" height=\"70\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"4\" rowspan=\"2\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_14.gif\" width=\"370\" height=\"41\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"1\" height=\"7\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"5\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_15.gif\" width=\"332\" height=\"34\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"1\" height=\"34\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td rowspan=\"2\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_16.gif\" width=\"69\" height=\"44\" alt=\"\"></td>\n";
echo "	<td colspan=\"2\" align=\"center\" background=\"themes/BB_CFiber/images/bb_header_17.gif\" width=\"86\" height=\"31\" border=\"0\" alt=\"\"><a href=\"" .   $themeconsole['link1'] . "\" class=menutitle>" . $themeconsole['link1text'] .
    "</a></td>\n"; 
echo "		<td align=\"center\" background=\"themes/BB_CFiber/images/bb_cfiber_header_18.gif\" width=\"87\" height=\"31\" border=\"0\" alt=\"\"><a href=\"" . $themeconsole['link2'] . "\" class=menutitle>" . $themeconsole['link2text'] .
    "</a></td>\n"; 
echo "		<td align=\"center\" background=\"themes/BB_CFiber/images/bb_cfiber_header_19.gif\" width=\"85\" height=\"31\" border=\"0\" alt=\"\"><a href=\"" .
    $themeconsole['link3'] . "\" class=menutitle>" . $themeconsole['link3text'] .
    "</a></td>\n"; 
echo "		<td align=\"center\" background=\"themes/BB_CFiber/images/bb_cfiber_header_20.gif\" width=\"87\" height=\"31\" border=\"0\" alt=\"\"><a href=\"" .
    $themeconsole['link4'] . "\" class=menutitle>" . $themeconsole['link4text'] .
    "</a></td>\n";
echo "		<td rowspan=\"2\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_21.gif\" width=\"12\" height=\"44\" alt=\"\"></td>\n";
echo "		<td rowspan=\"2\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_22.gif\" width=\"28\" height=\"44\" alt=\"\"></td>\n";
echo "		<td colspan=\"2\" background=\"themes/BB_CFiber/images/bb_cfiber_header_23.gif\" width=\"329\" height=\"31\" alt=\"\">\n";
	include_once('themes/BB_CFiber/tcmarquee_info.php');
echo "   </td>\n";
echo "		<td colspan=\"2\" rowspan=\"2\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_24.gif\" width=\"34\" height=\"44\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"1\" height=\"31\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"5\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_25.gif\" width=\"345\" height=\"13\" alt=\"\"></td>\n";
echo "		<td colspan=\"2\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_header_26.gif\" width=\"329\" height=\"13\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"1\" height=\"13\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"20\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"69\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"25\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"61\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"87\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"85\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"87\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"12\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"73\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"30\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"28\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"9\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"320\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"13\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"21\" height=\"1\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/spacer.gif\" width=\"20\" height=\"1\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "</table>\n";
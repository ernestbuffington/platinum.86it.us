<?php

/************************************************************************************************/
/**  Platinum Nuke Pro Theme																	*/
/**  ===============================															*/
/**  Theme PNP_WB																				*/
/**  Designed By   : D. Miller AkA. DocHaVoC - http://www.havocst.net 							*/
/**  Theme Version : v1.0 (100% Width)															*/
/** Copyright     : A public theme for use with Platinum Nuke Pro http://www.platinumnukepro.com	*/
/**																								*/
/**	  Copyright (c) 2011 D. Miller AkA. DocHaVoC | All Rights Reserved							*/
/************************************************************************************************/
 
if (stristr($_SERVER['SCRIPT_NAME'], "header.php")) {
    die ("Access Denied");
}
echo "<table width=\"100%\" height=\"255\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"Table_01\">\n";
echo "<tr>\n";
echo "		<td rowspan=\"10\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_01.gif\" width=\"20\" height=\"255\" alt=\"\"></td>\n";
echo "		<td rowspan=\"10\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_02.gif\" width=\"21\" height=\"255\" alt=\"\"></td>\n";
echo "		<td colspan=\"5\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_03.gif\" width=\"389\" height=\"18\" alt=\"\"></td>\n";
echo "		<td rowspan=\"10\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_04.gif\" width=\"8\" height=\"255\" alt=\"\"></td>\n";
echo "		<td rowspan=\"10\" width=\"100%\" height=\"255\" background=\"themes/PNP_WB/images/PNP_WB_header_05.gif\"></td>\n";
echo "		<td rowspan=\"10\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_06.gif\" width=\"8\" height=\"255\" alt=\"\"></td>\n";
echo "		<td rowspan=\"2\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_07.gif\" width=\"424\" height=\"132\" alt=\"\"></td>\n";
echo "		<td rowspan=\"10\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_08.gif\" width=\"36\" height=\"255\" alt=\"\"></td>\n";
echo "		<td rowspan=\"10\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_09.gif\" width=\"20\" height=\"255\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/spacer.gif\" width=\"1\" height=\"18\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"5\" rowspan=\"2\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_10.gif\" width=\"389\" height=\"143\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/spacer.gif\" width=\"1\" height=\"114\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td rowspan=\"2\" background=\"themes/PNP_WB/images/PNP_WB_header_11.gif\" width=\"424\" height=\"55\" alt=\"\"><div align=\"left\">$theuser</div></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/spacer.gif\" width=\"1\" height=\"29\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"5\" rowspan=\"2\" background=\"themes/PNP_WB/images/PNP_WB_header_12.gif\" width=\"389\" height=\"35\" alt=\"\"><div align=\"center\">$slogan</div></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/spacer.gif\" width=\"1\" height=\"26\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td rowspan=\"2\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_13.gif\" width=\"424\" height=\"21\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/spacer.gif\" width=\"1\" height=\"9\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"5\" rowspan=\"2\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_14.gif\" width=\"389\" height=\"15\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/spacer.gif\" width=\"1\" height=\"12\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td rowspan=\"3\" background=\"themes/PNP_WB/images/PNP_WB_header_15.gif\" width=\"424\" height=\"31\">\n";
	include_once('themes/PNP_WB/tcmarquee_info.php');
echo "   </td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/spacer.gif\" width=\"1\" height=\"3\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td rowspan=\"3\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_16.gif\" width=\"13\" height=\"44\" alt=\"\"></td>\n";
echo "	<td align=\"center\" background=\"themes/PNP_WB/images/PNP_WB_header_15-18.gif\" width=\"94\" height=\"26\" border=\"0\" alt=\"\"><strong><a href=\"" . $themeconsole['link1'] . "\" class=menutitle>" . $themeconsole['link1text'] . "</a></strong></td>\n";
echo "	<td align=\"center\" background=\"themes/PNP_WB/images/PNP_WB_header_15-18.gif\" width=\"94\" height=\"26\" border=\"0\" alt=\"\"><strong><a href=\"" . $themeconsole['link2'] . "\" class=menutitle>" . $themeconsole['link2text'] . "</a></strong></td>\n";
echo "	<td align=\"center\" background=\"themes/PNP_WB/images/PNP_WB_header_15-18.gif\" width=\"94\" height=\"26\" border=\"0\" alt=\"\"><strong><a href=\"" . $themeconsole['link3'] . "\" class=menutitle>" . $themeconsole['link3text'] . "</a></strong></td>\n";
echo "	<td align=\"center\" background=\"themes/PNP_WB/images/PNP_WB_header_15-18.gif\" width=\"94\" height=\"26\" border=\"0\" alt=\"\"><strong><a href=\"" . $themeconsole['link4'] . "\" class=menutitle>" . $themeconsole['link4text'] . "</a></strong></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/spacer.gif\" width=\"1\" height=\"26\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"4\" rowspan=\"2\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_21.gif\" width=\"376\" height=\"18\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/spacer.gif\" width=\"1\" height=\"2\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_header_22.gif\" width=\"424\" height=\"16\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/spacer.gif\" width=\"1\" height=\"16\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "</table>\n";
?>
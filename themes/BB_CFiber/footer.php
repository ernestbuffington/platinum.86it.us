<?php
/************************************************************************************************/
/**  Platinum Nuke Pro Theme																	*/
/**  ===============================															*/
/**  Theme BB_CFiber																			*/
/**  Designed By   : D. Miller AkA. DocHaVoC - http://www.havocst.net 							*/
/**  Theme Version : v1.0 (100% Width)															*/
/** Copyright    : A public theme for use with Platinum Nuke Pro http://www.platinumnukepro.com	*/
/**																								*/
/**	  Copyright (c) 2011 D. Miller AkA. DocHaVoC | All Rights Reserved							*/
/************************************************************************************************/
 
if (stristr($_SERVER['SCRIPT_NAME'], "footer.php")) {
    die ("Access Denied");
}
echo "<table id=\"Table_01\" width=\"100%\" height=\"220\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "<tr>\n";
echo "		<td rowspan=\"3\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_footer_01.gif\" width=\"20\" height=\"220\" alt=\"\"></td>\n";
echo "		<td rowspan=\"3\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_footer_02.gif\" width=\"61\" height=\"220\" alt=\"\"></td>\n";
echo "		<td colspan=\"3\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_footer_03.gif\" width=\"339\" height=\"40\" alt=\"\"></td>\n";
echo "		<td rowspan=\"3\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_footer_04.gif\" width=\"103\" height=\"220\" alt=\"\"></td>\n";
echo "		<td rowspan=\"3\" background=\"themes/BB_CFiber/images/bb_cfiber_footer_05.gif\" width=\"100%\" height=\"220\" alt=\"\"><div align=\"center\">$footer_message</div></td>\n";
echo "		<td rowspan=\"3\"><img src=\"themes/BB_CFiber/images/bb_cfiber_footer_06.gif\" width=\"140\" height=\"220\" alt=\"\"></td>\n";
echo "<td rowspan=\"3\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_footer_07.gif\" width=\"20\" height=\"220\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td background=\"themes/BB_CFiber/images/bb_footer_03.gif\" width=\"150\" height=\"134\" alt=\"\"><div align=\"center\">$showdl</div></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_footer_09.gif\" width=\"39\" height=\"134\" alt=\"\"></td>\n";
echo "		<td background=\"themes/BB_CFiber/images/bb_cfiber_footer_10.gif\" width=\"150\" height=\"134\" alt=\"\"><div align=\"center\"></div>$showlinks</td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td colspan=\"3\">\n";
echo "			<img src=\"themes/BB_CFiber/images/bb_cfiber_footer_11.gif\" width=\"339\" height=\"46\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "</table>\n";
echo "	<div align=\"center\">Page Generation:&nbsp;$total_time</div>\n";
?>
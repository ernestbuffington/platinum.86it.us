<?php
/************************************************************************************************/
/**  Platinum Nuke Pro Theme																	*/
/**  ===============================															*/
/**  Theme PNP_WB																				*/
/**  Designed By   : D. Miller AkA. DocHaVoC - http://www.havocst.net 							*/
/**  Theme Version : v1.0 (100% Width)															*/
/** Copyright    : A public theme for use with Platinum Nuke Pro http://www.platinumnukepro.com	*/
/**																								*/
/**	  Copyright (c) 2011 D. Miller AkA. DocHaVoC | All Rights Reserved							*/
/************************************************************************************************/
 
if (stristr($_SERVER['SCRIPT_NAME'], "footer.php")) {
    die ("Access Denied");
}
echo "<table align=\"center\" width=\"100%\" height=\"204\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"Table_01\">\n";
echo "<tr>\n";
echo "		<td rowspan=\"3\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_footer_01.gif\" width=\"20\" height=\"204\" alt=\"\"></td>\n";
echo "		<td rowspan=\"3\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_footer_02.gif\" width=\"54\" height=\"204\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_footer_03.gif\" width=\"151\" height=\"29\" alt=\"\"></td>\n";
echo "		<td rowspan=\"3\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_footer_03-04.gif\" width=\"65\" height=\"204\" alt=\"\"></td>\n";
echo "		<td rowspan=\"3\" width=\"100%\" height=\"204\" background=\"themes/PNP_WB/images/PNP_WB_footer_05.gif\" ><div align=\"center\">$footer_message</div></td>\n";
echo "<td rowspan=\"3\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_footer_06.gif\" width=\"66\" height=\"204\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_footer_07.gif\" width=\"148\" height=\"29\" alt=\"\"></td>\n";
echo "		<td rowspan=\"3\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_footer_08.gif\" width=\"54\" height=\"204\" alt=\"\"></td>\n";
echo "		<td rowspan=\"3\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_footer_09.gif\" width=\"20\" height=\"204\" alt=\"\"></td>\n";
echo "		<td rowspan=\"3\">\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_footer_10.gif\" width=\"1\" height=\"204\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td width=\"151\" height=\"144\" background=\"themes/PNP_WB/images/PNP_WB_footer_11.gif\"><div align=\"center\">$showlinks</div></td>\n";
echo "		<td width=\"148\" height=\"144\" background=\"themes/PNP_WB/images/PNP_WB_footer_12.gif\"><div align=\"center\">$showdl</div></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_footer_13.gif\" width=\"151\" height=\"31\" alt=\"\"></td>\n";
echo "		<td>\n";
echo "			<img src=\"themes/PNP_WB/images/PNP_WB_footer_14.gif\" width=\"148\" height=\"31\" alt=\"\"></td>\n";
echo "	</tr>\n";
echo "</table>\n";
echo "	<div align=\"center\">Page Generation:&nbsp;$total_time</div>\n";
?>
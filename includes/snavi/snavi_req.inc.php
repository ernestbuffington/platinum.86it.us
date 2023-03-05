<?php

/*
+=============================================================================+
|                                                                             |
|  Site Navigator for PHP-Nuke                                                |
|  Copyright (c) 2004 Devaz Network, All Rights Reserved                      |
|  http://devaz.uni.cc                                                        |
|                                                                             |
|  Support Functions for Direct Requests                                      |
|  Creation date    : July 13th, 2004                                         |
|  Last revised     : -                                                       |
|  Revision history : -                                                       |
|                                                                             |
+-----------------------------------------------------------------------------+
|                                                                             |
|  Converted to Nuke-Evolution by ICEMAN at http://montecitogaming.com or     |
|  http://tc-net.info (but download at http://montecitogaming.com             |
|                                                                             |
+-----------------------------------------------------------------------------+
|                                                                             |
|  This program is free software; you can redistribute it and/or modify it    |
|  under the terms of the GNU General Public License as published by the      |
|  Free Software Foundation; either version 2 of the License, or (at your     |
|  option) any later version. (http://www.gnu.org/copyleft/gpl.html)          |
|                                                                             |
|  This program is distributed in the hope that it will be useful, but        |
|  WITHOUT ANY WARRANTY; without even the implied warranty of                 |
|  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General   |
|  Public License for more details.                                           |
|                                                                             |
|  You should have received a copy of the GNU General Public License along    |
|  with this program; if not, write to the Free Software Foundation, Inc.,    |
|  59 Temple Place, Suite 330, Boston, MA  02111-1307  USA                    |
|                                                                             |
|  You run this program at your sole risk. Author cannot be held liable of    |
|  uses and misuses of this program. It advised to test this program under    |
|  a development environment. Be sure to make any backups before implement    |
|  and running this program within a production environment.                  |
|                                                                             |
|  Installing and running this program also means you agree to the terms of   |
|  usages and conditions to this program. All codes that released here are    |
|  considered as sample code only. It may be fully functional, but you use    |
|  at your own risk. No warranty is given or implied. All original header     |
|  code and copyright messages will be maintained to give credit where        |
|  credit is due. If you modify this program, the only requirement is that    |
|  you also maintain all original copyright messages.                         |
|                                                                             |
+=============================================================================+
*/

if (!defined('SNAVI_REQUEST') || preg_match('/snavi_req\.inc\.php$/i', $_SERVER['PHP_SELF']))
{
	die('<center>You cannot run this script directly.</center>');
}

function snavi_gfx()
{
	global $_SERVER, $_GET;
	$random_num   = (isset($_GET['random_num']) && preg_match('/^[0-9]+$/', $_GET['random_num'])) ? $_GET['random_num'] : '';
	$image_path   = (isset($_GET['theme_name']) && preg_match('/^[a-zA-Z0-9_-]+$/', $_GET['theme_name'])) ? '../themes/'.$_GET['theme_name'].'/images/snavi' : '';

	if(($image_path == '') || !is_dir($image_path)) $image_path = 'images';

	if (file_exists($image_path.'/bar_seccode.jpg'))
	{
		$random_image = ImageCreateFromJPEG($image_path.'/bar_seccode.jpg');
		if ($random_num != '')
		{
			include_once('../config.php');
			$datekey = date("F j");
			$rcode   = hexdec(md5($_SERVER['HTTP_USER_AGENT'].$sitekey.$random_num.$datekey));
			$xcode   = preg_split('//', substr($rcode, 2, 6), -1, PREG_SPLIT_NO_EMPTY);
			$code    = "$xcode[0]$xcode[1]$xcode[2]$xcode[3]$xcode[4]$xcode[5]";

			//$text_color1 = ImageColorAllocate($random_image, 0, 0, 0);
			$text_color2 = ImageColorAllocate($random_image, 0, 0, 0);

			//ImageString($random_image, 1, 18,  5, 'SECURITY CODE', $text_color1);
			ImageString($random_image, 2,  8,  8, $code, $text_color2);
		}

		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
		header("Expires: Mon, 1 Jan 1970 00:00:00 GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-type: image/jpeg");

		ImageJPEG($random_image, '', 85);
		ImageDestroy($random_image);
	}
	die();
}

function snavi_about()
{
if(function_exists){
echo"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">"
  . "<html>"
  . "<head>"
  . "<title>DFG Network Navigator :: About</title>"
  . "<meta http-equiv=\"expires\" content=\"0\">"
  . "</head>"
  . "<style><!--"
  . "body {font-family:verdana,arial,helvetica;font-size:10pt;font-weight:normal;margin:0px;color:#000000;background-color:#FFFFFF;cursor:default;}"
  . ".maintitle {font-family:sans-serif;font-size:20px;font-weight:normal;color:#FFFFFF;cursor:default;}"
  . ".maintext {font-family:tahoma,verdana,arial,sans-serif;font-size:11px;font-weight:normal;color:#FFFFFF;cursor:default;}"
  . ".main {font-family:verdana,arial,sans-serif;font-size:8pt;font-weight:normal;color:#000000;cursor:default;}"
  . ".foot {font-family:verdana,arial,helvetica;font-size:8pt;font-weight:normal;color:#C0C0C0;cursor:default;}"
  . "a,a:link,a:link,a:visited,a:active {color:#0060A0;text-decoration:none;}"
  . "a:hover {color:#0060A0;text-decoration:underline;}"
  . "input.main {font-family:verdana,arial,helvetica;font-size:8pt;font-weight:normal;color:#000000;background-color:#E0E0E0;border:1px solid #000000;}"
  . "input.default {font-family:verdana,arial,helvetica;font-size:8pt;font-weight:bold;color:#000000;background-color:#E0E0E0;border:2px solid #000000;}"
  . "hr.lines {width:50%;height:1px;border:0px solid #FFFFFF;border-bottom:1px solid #FF0000;margin:0px;}"
  . "</style>"
  . "<body>"
  . "<table width=\"100%\" height=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">"
  . "<tr><td height=\"60\" bgcolor=\"#0080A0\" align=\"center\" valign=\"middle\" nowrap>"
  . "<span class=\"maintitle\">Site Navigator<br /></span>"
  . "<span class=\"maintext\">Copyright &copy; 2004 Devaz Network</span><br />"
  . "<span class=\"maintext\">Copyright &copy; 2007 Montecito Gaming</span>"
  . "</td></tr>"
  . "<tr><td height=\"100\" bgcolor=\"#FFFFFF\" align=\"center\" valign=\"top\">"
  . "<marquee valign=\"top\" behavior=\"scroll\" direction=\"up\" width=\"100%\" height=\"100\" scrollamount=\"1\" scrolldelay=\"100\" onmouseover=\"this.stop()\" onmouseout=\"this.start()\">"
  . "<span class=\"main\"><center>"
  . "<strong>SITE NAVIGATOR FOR NUKE-EVOLUTION</strong><br />"
  . "Version 1.1 RC1<br /><br />"
  . "Converted to Nuke-Evolution by ICEMAN at http://montecitogaming.com<br /><br />"
  . "Released under <a href=\"http://gnu.org\">GNU/GPL</a> License<br />"
  . "<br /><br />"
  . "<strong>CREDITS</strong><hr class=\"lines\" />"
  . "Heng Yuan, JSCookMenu<br />"
  . "Francisco Burzi, PHP-Nuke<br />"
  . "Iceman-Riho Kroll, Montecito Gaming<br />"
  . "<br /><br />"
  . "<strong>THANKS</strong><hr class=\"lines\" />"
  . "GP4 Community<br />"
  . "Jon Walton<br />"
  . "NukeCops<br />"
  . "Simon Troup<br />"
  . "Montecito Gaming<br />"
  . "</center></span>"
  . "</marquee>"
  . "</td></tr>"
  . "<tr><td bgcolor=\"#FFFFFF\" align=\"center\" valign=\"top\">"
  . "<input class=\"main\" type=\"button\" value=\"Download\" onClick=\"window.open('http://montecitogaming.com/','_blank');this.disabled=true;\" />"
  . "</td></tr>"
  . "<tr><td height=\"35\" bgcolor=\"#F8F8F8\" align=\"center\" valign=\"middle\">"
  . "<input class=\"default\" type=\"button\" value=\"Close\" onClick=\"window.close()\" />"
  . "</td></tr>"
  . "</table>"
  . "</body>"
  . "</html>"
 ."";
}else{
echo"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">"
  . "<html>"
  . "<head>"
  . "<title>Site Navigator :: About</title>"
  . "<meta http-equiv=\"expires\" content=\"0\">"
  . "</head>"
  . "<style><!--"
  . "body {font-family:verdana,arial,helvetica;font-size:10pt;font-weight:normal;margin:0px;color:#000000;background-color:#FFFFFF;cursor:default;}"
  . ".maintitle {font-family:sans-serif;font-size:20px;font-weight:normal;color:#FFFFFF;cursor:default;}"
  . ".maintext {font-family:tahoma,verdana,arial,sans-serif;font-size:11px;font-weight:normal;color:#FFFFFF;cursor:default;}"
  . ".main {font-family:verdana,arial,sans-serif;font-size:8pt;font-weight:normal;color:#000000;cursor:default;}"
  . ".foot {font-family:verdana,arial,helvetica;font-size:8pt;font-weight:normal;color:#C0C0C0;cursor:default;}"
  . "a,a:link,a:link,a:visited,a:active {color:#0060A0;text-decoration:none;}"
  . "a:hover {color:#0060A0;text-decoration:underline;}"
  . "input.main {font-family:verdana,arial,helvetica;font-size:8pt;font-weight:normal;color:#000000;background-color:#E0E0E0;border:1px solid #000000;}"
  . "input.default {font-family:verdana,arial,helvetica;font-size:8pt;font-weight:bold;color:#000000;background-color:#E0E0E0;border:2px solid #000000;}"
  . "hr.lines {width:50%;height:1px;border:0px solid #FFFFFF;border-bottom:1px solid #FF0000;margin:0px;}"
  . "</style>"
  . "<body>"
  . "<table width=\"100%\" height=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">"
  . "<tr><td height=\"60\" bgcolor=\"#0080A0\" align=\"center\" valign=\"middle\" nowrap>"
  . "<span class=\"maintitle\">Site Navigator<br /></span>"
  . "<span class=\"maintext\">Copyright &copy; 2004 Devaz Network</span><br />"
  . "<span class=\"maintext\">Copyright &copy; 2007 Montecito Gaming</span>"
  . "</td></tr>"
  . "<tr><td height=\"100\" bgcolor=\"#FFFFFF\" align=\"center\" valign=\"top\">"
  . "<marquee valign=\"top\" behavior=\"scroll\" direction=\"up\" width=\"100%\" height=\"100\" scrollamount=\"1\" scrolldelay=\"100\" onmouseover=\"this.stop()\" onmouseout=\"this.start()\">"
  . "<span class=\"main\"><center>"
  . "<strong>SITE NAVIGATOR FOR NUKE-EVOLUTION</strong><br />"
  . "Version 1.1 RC1<br /><br />"
  . "Converted to Nuke-Evolution by ICEMAN at http://montecitogaming.com<br /><br />"
  . "Released under <a href=\"http://gnu.org\">GNU/GPL</a> License<br />"
  . "<br /><br />"
  . "<strong>CREDITS</strong><hr class=\"lines\" />"
  . "Heng Yuan, JSCookMenu<br />"
  . "Francisco Burzi, PHP-Nuke<br />"
  . "Iceman-Riho Kroll, Montecito Gaming<br />"
  . "<br /><br />"
  . "<strong>THANKS</strong><hr class=\"lines\" />"
  . "GP4 Community<br />"
  . "Jon Walton<br />"
  . "NukeCops<br />"
  . "Simon Troup<br />"
  . "Montecito Gaming<br />"
  . "</center></span>"
  . "</marquee>"
  . "</td></tr>"
  . "<tr><td bgcolor=\"#FFFFFF\" align=\"center\" valign=\"top\">"
  . "<input class=\"main\" type=\"button\" value=\"Download\" onClick=\"window.open('http://montecitogaming.com/','_blank');this.disabled=true;\" />"
  . "</td></tr>"
  . "<tr><td height=\"35\" bgcolor=\"#F8F8F8\" align=\"center\" valign=\"middle\">"
  . "<input class=\"default\" type=\"button\" value=\"Close\" onClick=\"window.close()\" />"
  . "</td></tr>"
  . "</table>"
  . "</body>"
  . "</html>"
 ."";}}
?>

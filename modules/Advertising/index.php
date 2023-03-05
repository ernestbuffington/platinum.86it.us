<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}
/************************************************************************/
/*         Always Backup your file system and database before           */
/*      doing any type of installation or changes such as these.        */
/*      Failure to do so may end up costing you much repair time        */
/************************************************************************/
/**********************************/
/*  Module Configuration          */
/* (right side on) v3.1           */
/* Remove the following line      */
/* will remove the right side     */
/**********************************/
define('INDEX_FILE', true);
$index = 1; 

// This system includes Google Page Rank Calculation made by GoogleCommunity.com
// Don't abuse this script. It's here for your use, to give accurate information
// about your site to your potential advertising customers. If you need the complete
// Google Page Rank Calculator script, please go to: http://www.GoogleCommunity.com
// and download the latest and stand alone release.


require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

function is_client($client) {
	global $prefix, $db;
	if(!is_array($client)) {
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(":", $client);
		$cid = "$client[0]";
		if (isset($client[2])) { $pwd = $client[2]; }
	} else {
		$cid = "$client[0]";
		if (isset($client[2])) { $pwd = $client[2]; }
	}
	if (!empty($cid) AND !empty($pwd)) {
		$result = $db->sql_query("SELECT passwd FROM ".$prefix."_banner_clients WHERE cid='$cid'");
		$row = $db->sql_fetchrow($result);
		$pass = $row['passwd'];
		if(!empty($pass) AND $pass == $pwd) {
			return 1;
		}
	}
	return 0;
}


/// Main Menu Links ///
function themenu() {
global $module_name, $admin, $prefix, $db, $client, $bgcolor1, $bgcolor2, $bgcolor3, $op;
if (is_client($client)) {
if ($op == "client_home") {
	$client_opt = _MYADS; 
	} else {
	$client_opt = "<a href=\"modules.php?name=$module_name&op=client_home\">"._MYADS."</a> ";
	}
	} else {
	$client_opt = "<a href=\"modules.php?name=$module_name&op=client\">"._CLIENTLOGIN."</a> ";
	}
echo "<table width='99%' align='center' cellspacing='5' cellpadding='5' border='0'>";
echo "<tr>";
echo "<td valign='top'>";
echo "<center><a href=\"modules.php?name=$module_name&op=theindex\">"._MAINPAGE."</a> | <a href=\"modules.php?name=$module_name&op=plans\">"._PLANSPRICES."</a> | <a href=\"modules.php?name=$module_name&op=campaigns\">"._CAMPAIGNS."</a> | <a href=\"modules.php?name=$module_name&op=terms\">"._TERMS."</a> | <a href=\"modules.php?name=$module_name&op=sitestats\">"._SITESTATS."</a> | <a href=\"modules.php?name=$module_name&op=sponsors\">"._SPONSORS."</a>";
if (is_client($client)) { echo " $client_opt |"; }
if (is_admin($admin)) { echo " | <a href=\"admin.php?op=BannersAdmin\">Admin</a> </center>"; }
echo "</td>";
echo "</tr>";
echo "</table>";
}





function plans() {
global $prefix, $sitename, $client, $client_opt, $user_prefix, $db, $module_name, $dbi, $bgcolor1, $bgcolor2, $bgcolor3, $user, $admin;
include_once("header.php");



if (is_admin($admin) OR (is_user($user))) {
OpenTable();
themenu();
echo "<table width='99%' bgcolor='$bgcolor3' align='center' cellspacing='2' cellpadding='2' border='0'>";
echo "<tr><td><center>";
title("Place my new advertisement Now! - I am a Member");
echo "<strong>Step 1: </strong>You have already placed your order below?";
echo "<br />";
echo "<strong>Step 2: </strong>You have recieved your CLIENT login information from us?";
echo "<br />";
echo "<strong>Step 3: </strong>My banner is NOT showing - Did you login and upload your Ad???";
echo "<br />";
echo "(If you have not completed any of the above steps, please do so first)";
echo "<br />";
echo "<font class=\"title\">|| <a href='modules.php?name=Advertising&op=client_home'><strong>Login in to the Client Section Now!</strong></a> ||</font></center>";
echo "</center></td>";
echo "</tr>";
echo "</table>";
CloseTable();

} else {
 
OpenTable();
themenu();
echo "<table width='99%' bgcolor='$bgcolor3' align='center' cellspacing='2' cellpadding='2' border='0'>";
echo "<tr><td><center>";
title("Place my new advertisement Now! - I am a Guest");
echo "<strong>Step 1: </strong>You are logged in as a member?";
echo "<br />";
echo "<strong>Step 2: </strong>You have already placed your order below?";
echo "<br />";
echo "<strong>Step 3: </strong>You have recieved your CLIENT login information from us?";
echo "<br />";
echo "(If you have not completed any of the above steps, please do so first)";
echo "<br />";
echo "<font class=\"title\">|| <a href='modules.php?name=Your_Account'><strong>Become a Member first - then return here!</strong></a> ||</font></center>";
echo "</center></td>";
echo "</tr>";
echo "</table>";
CloseTable();
	}
	
OpenTable();
//title(""._ADPLANS."");
$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner_plans WHERE active='1'"));
if ($numrows > 0) {
$result = $db->sql_query("SELECT * FROM ".$prefix."_banner_plans WHERE active='1'");
echo "<table border=\"1\" width=\"100%\" cellpadding=\"2\">";
echo "<tr bgcolor='$bgcolor1'>";
echo "<td colspan='5' border=\"1\" width=\"100%\" cellpadding=\"2\"><div align='center'>"._GATEWAYS."";
echo "</div></td>";
echo "</tr>";

echo "<tr>";
echo "
    	<td align=\"center\" nowrap bgcolor='$bgcolor2'><strong>"._PLANNAME."</strong></td>
    	<td bgcolor='$bgcolor2'>&nbsp;<strong>"._DESCRIPTION."</strong></td>
    	<td align=\"center\" bgcolor='$bgcolor2'><strong>"._TERMS."</strong></td>
    	<td align=\"center\" bgcolor='$bgcolor2' nowrap><strong>"._BUYLINKS."</strong></td>
    	<td align=\"center\" bgcolor='$bgcolor2' nowrap><strong>"._BUYLINKS."</strong></td>
    	</tr>";
    	while ($row = $db->sql_fetchrow($result)) {
	    	if ($row['delivery_type'] == "0") {
	    		$delivery = _IMPRESSIONS;
	    	} elseif ($row['delivery_type'] == "1") {
	    		$delivery = _CLICKS;
	    	} elseif ($row['delivery_type'] == "2") {
	    		$delivery = _DAYS;
	    	} elseif ($row['delivery_type'] == "3") {
	    		$delivery = _MONTHS;
	    	} elseif ($row['delivery_type'] == "4") {
	    		$delivery = _YEARS;
	    	}
    	echo "<tr>
    	<td valign=\"middle\" bgcolor='$bgcolor3'><strong>".$row['name']."</strong></td>
    	<td bgcolor='$bgcolor3' valign='middle'>".$row['description']."</td>
    	<td valign=\"middle\" bgcolor='$bgcolor3'><center>".$row['delivery']." $delivery<hr><strong>".$row['price']."</strong><hr></center></td>
    	<td valign=\"middle\" bgcolor='$bgcolor3' nowrap><center>".$row['buy_links']."</center></td>
    	<td valign=\"middle\" bgcolor='$bgcolor3' nowrap><center>".$row['buy_links2']."</center></td>
    	</tr>";
    	}
    	
    echo "<tr bgcolor='$bgcolor2'>";
    echo "<td colspan='5' border=\"1\" width=\"100%\" cellpadding=\"2\">";
    	
    if (is_admin($admin) OR (is_user($user))) {
    	echo "<div align='center'><strong>Important:  <a href='modules.php?name=Advertising&op=thanks'>Dont forget to Upload your Advertisement after paying!</a></strong>";
        echo "</div>";
    } else {
        echo "<div align='center'><strong>Important:  <a href='modules.php?name=Your_Account'>Dont forget to Upload your Advertisement after paying!</a></strong>";
        echo "</div>";
    }
    echo "</td>";
    echo "</tr>";
    echo "</table>";
	} else {
		echo "<center>"._ADSNOCONTENT."<br /><br />"._GOBACK."</center>";
	}
	
CloseTable();
OpenTable();
showplans();
CloseTable();
include_once("footer.php");
}





function showplans() {
    global $prefix, $sitename, $user_prefix, $db, $module_name, $dbi, $bgcolor1, $bgcolor2, $bgcolor3, $user, $admin;
    	echo "<table  width='100%' bgcolor='$bgcolor1' align='center' cellspacing='1' cellpadding='5' border='0'>";
 
        echo "<tr>";
        echo "<td width='1' valign='top'></td>";
        echo "<td width='43%' bgcolor='$bgcolor3' valign='top' cellspacing='2' cellpadding='2'>";
        echo ""._ADDETAILS."";
        echo "<br /><br />";
        echo "</td>";
        
        echo "<td width='43%' bgcolor='$bgcolor2' valign='top' cellspacing='2' cellpadding='2'>";
        echo "<div align='center'>";
        echo "<img src='modules/Advertising/images/banners-all.gif' alt='Banners' border='0'>";
        echo "</div>";
        echo "</td>";
        echo "<td width='1' valign='top'></td>";
        echo "<tr>";
        echo "<td colspan='4' align='center' valign='top'>";
        echo "<hr width='80%'>";
        echo "<img src='modules/Advertising/images/CreditCards_row.gif' alt='Accepted CreditCards' border='0'>";
        echo "<br />";
        echo "</td>";
        echo "</tr>";
        
        echo "</tr>";
        echo "</table>";
}








function terms() {
	global $module_name, $prefix, $db, $sitename;
    $today = getdate();
	$month = $today['mon'];
	if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _SEPTEMBER;} elseif ($month == 10) {$month = _OCTOBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}
	$year = $today['year'];
    include_once("header.php");
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_terms"));
    $terms = preg_replace("/\[sitename\]/", $sitename, $row['terms_body']);
	$terms = preg_replace("/\[country\]/", $row['country'], $terms);
    OpenTable();
    themenu();
    title(""._TERMSCONDITIONS."");
    echo "<br />"
		."$terms"
		."<p align='right'>".$row['country'].", $month $year</p>";
    CloseTable();
    include_once("footer.php");
}

function client() {
	global $module_name, $prefix, $db, $sitename, $client;
	if (is_client($client)) {
		Header("Location: modules.php?name=$module_name&op=client_home");
	} else {
		include_once("header.php");
    OpenTable();
    themenu();
		title(""._CLIENTLOGIN."");
		echo "<form method=\"POST\" action=\"modules.php?name=$module_name\"><table border=\"0\" align=\"center\" cellpadding=\"3\"><tr>";
		echo "<td align=\"right\">"._LOGIN.":</td><td><input type=\"text\" name=\"login\" size=\"15\"></td></tr>";
		echo "<td align=\"right\">"._PASSWORD.":</td><td><input type=\"password\" name=\"pass\" size=\"15\"></td></tr>";
		echo "<td>&nbsp;</td><td><input type=\"hidden\" name=\"op\" value=\"client_valid\"><input type=\"submit\" value=\""._ENTER."\"></tr></td></table></form>";
		CloseTable();
		include_once("footer.php");
	}
}

function zeroFill($a, $b) {
    $z = hexdec(80000000);
	if ($z & $a) {
    	$a = ($a>>1);
        $a &= (~$z);
        $a |= 0x40000000;
        $a = ($a>>($b-1));
    } else {
        $a = ($a>>$b);
    }
    return $a;
}

function mix($a,$b,$c) {
  $a -= $b; $a -= $c; $a ^= (zeroFill($c,13));
  $b -= $c; $b -= $a; $b ^= ($a<<8);
  $c -= $a; $c -= $b; $c ^= (zeroFill($b,13));
  $a -= $b; $a -= $c; $a ^= (zeroFill($c,12));
  $b -= $c; $b -= $a; $b ^= ($a<<16);
  $c -= $a; $c -= $b; $c ^= (zeroFill($b,5));
  $a -= $b; $a -= $c; $a ^= (zeroFill($c,3));   
  $b -= $c; $b -= $a; $b ^= ($a<<10);
  $c -= $a; $c -= $b; $c ^= (zeroFill($b,15));
  return array($a,$b,$c);
}

function GoogleCH($url, $length=null, $init=GOOGLE_MAGIC) {
    if(is_null($length)) {
        $length = sizeof($url);
    }
    $a = $b = 0x9E3779B9;
    $c = $init;
    $k = 0;
    $len = $length;
    while($len >= 12) {
        $a += ($url[$k+0] +($url[$k+1]<<8) +($url[$k+2]<<16) +($url[$k+3]<<24));
        $b += ($url[$k+4] +($url[$k+5]<<8) +($url[$k+6]<<16) +($url[$k+7]<<24));
        $c += ($url[$k+8] +($url[$k+9]<<8) +($url[$k+10]<<16)+($url[$k+11]<<24));
        $mix = mix($a,$b,$c);
        $a = $mix[0]; $b = $mix[1]; $c = $mix[2];
        $k += 12;
        $len -= 12;
    }
    $c += $length;
    switch($len) {
        case 11: $c+=($url[$k+10]<<24);
        case 10: $c+=($url[$k+9]<<16);
        case 9 : $c+=($url[$k+8]<<8);
        case 8 : $b+=($url[$k+7]<<24);
        case 7 : $b+=($url[$k+6]<<16);
        case 6 : $b+=($url[$k+5]<<8);
        case 5 : $b+=($url[$k+4]);
        case 4 : $a+=($url[$k+3]<<24);
        case 3 : $a+=($url[$k+2]<<16);
        case 2 : $a+=($url[$k+1]<<8);
        case 1 : $a+=($url[$k+0]);
    }
    $mix = mix($a,$b,$c);
    return $mix[2];
}

function strord($string) {
    for($i=0;$i<strlen($string);$i++) {
        $result[$i] = ord($string{$i});
    }
    return $result;
}

function getrank($url) {
	define('GOOGLE_MAGIC', 0xE6359A60);
    $url = 'info:'.$url;
    $ch = GoogleCH(strord($url));
    $file = "http://www.google.com/search?client=navclient-auto&ch=6$ch&features=Rank&q=$url";
    $data = file($file);
    $rankarray = explode (':', $data[2]);
    $rank = $rankarray[2];
    return $rank;
}

function client_logout() {
	global $module_name;
	$client = "";
	setcookie("client");
	Header("Location: modules.php?name=$module_name&op=client");
	die();
}

function client_valid($login, $pass) {
	global $prefix, $db, $module_name, $sitename;
	$login = filter($login, "nohtml");
	$pass = filter($pass, "nohtml");
	$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner_clients WHERE login='$login' AND passwd='$pass'"));
	if ($numrows != 1) {
		include_once("header.php");
    OpenTable();
    themenu();
		title(""._ADSYSTEM."");
		echo "<center>"._LOGININCORRECT."<br /><br />"._GOBACK."</center>";
		CloseTable();
		include_once("footer.php");
		die();
	} else {
		$row = $db->sql_fetchrow($db->sql_query("SELECT cid FROM ".$prefix."_banner_clients WHERE login='$login' AND passwd='$pass'"));
		$cid = $row['cid'];
		$info = base64_encode("$cid:$login:$pass");
		setcookie("client","$info",time()+3600);
		Header("Location: modules.php?name=$module_name&op=client_home");
	}
}



/////// Updated 06.10.05 /////////
function client_home() {
	global $prefix, $db, $sitename, $bgcolor2, $module_name, $client;
	if (!is_client($client)) {
		Header("Location: modules.php?name=$module_name&op=client");
		die();
	} else {
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(":", $client);
		$cid = $client[0];
		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_clients WHERE cid='$cid'"));
		include_once("header.php");
    OpenTable();
    themenu();
		title(""._ADSYSTEM."");
		echo "<center><hr>";
		echo "<font class=\"title\"><a href='modules.php?name=Advertising&op=addbanner'><strong>Click... Only to Submit Newly PAID for Advertisements!</strong></a></font>";
		echo "</center><hr>";
		echo "<center>"._ACTIVEADSFOR." ".$row['name']."</center><br />"
   			."<table width=\"100%\" border=\"1\"><tr>"
   			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._NAME."</strong></td>"
   			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._ENDDATE."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPMADE."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPTOTAL."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPLEFT."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._CLICKS."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>% "._CLICKS."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._TYPE."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._FUNCTIONS."</strong></td><tr>";
		$sql = "SELECT * FROM ".$prefix."_banner WHERE cid='".$row['cid']."' AND active='1'";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$bid = $row['bid'];
			$bid = intval($bid);
			$enddate = $row['enddate'];
			$imptotal = $row['imptotal'];
			$imptotal = intval($imptotal);
			$impmade = $row['impmade'];
			$impmade = intval($impmade);
			$clicks = $row['clicks'];
			$clicks = intval($clicks);
			$date = $row['date'];
			

			if ($impmade == 0) {
				$percent = 0;
			} else {
				$percent = substr(100 * $clicks / $impmade, 0, 5);
				$percent = "$percent%";
			}
			if ($imptotal == 0) {
				$left = _UNLIMITED;
				$imptotal = _UNLIMITED;
			} else {
				$left = $imptotal-$impmade;
			}
			if ($row['ad_class'] == "flash" || $row['ad_class'] == "code") {
				$clicks = "N/A";
				$percent = "N/A";
			}
			if ($row['name'] == "") {
				$row['name'] = _NONE;
			}
			echo "<td align=\"center\">".$row['name']."</td>"
			    ."<td align=\"center\">$enddate</td>"
				."<td align=\"center\">$impmade</td>"
				."<td align=\"center\">$imptotal</td>"
				."<td align=\"center\">$left</td>"
				."<td align=\"center\">$clicks</td>"
				."<td align=\"center\">$percent</td>"
				."<td align=\"center\">".ucFirst($row['ad_class'])."</td>"
				."<td align=\"center\"><a href=\"modules.php?name=$module_name&op=client_report&cid=$cid&bid=$bid\"><img src=\"images/edit.gif\" border=\"0\" alt=\""._EMAILSTATS."\" title=\""._EMAILSTATS."\"></a>  <a href=\"modules.php?name=$module_name&op=view_banner&cid=$cid&bid=$bid\"><img src=\"images/view.gif\" border=\"0\" alt=\""._VIEWBANNER."\" title=\""._VIEWBANNER."\"></a></td><tr>";
		}
		echo "</table>";
		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_clients WHERE cid='$cid'"));
		echo "<br /><br /><center>"._INACTIVEADS." ".$row['name']."</center><br />"
    		."<table width=\"100%\" border=\"1\"><tr>"
    		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._NAME."</strong></td>"
    		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._ENDDATE."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPMADE."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPTOTAL."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPLEFT."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._CLICKS."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>% "._CLICKS."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._TYPE."</strong></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._FUNCTIONS."</strong></td><tr>";
		$sql = "SELECT * FROM ".$prefix."_banner WHERE cid='".$row['cid']."' AND active='0'";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$bid = $row['bid'];
			$bid = intval($bid);
			$enddate = $row['enddate'];
			$imptotal = $row['imptotal'];
			$imptotal = intval($imptotal);
			$impmade = $row['impmade'];
			$impmade = intval($impmade);
			$clicks = $row['clicks'];
			$clicks = intval($clicks);
			$date = $row['date'];
			if($impmade == 0) {
				$percent = 0;
			} else {
				$percent = substr(100 * $clicks / $impmade, 0, 5);
				$percent = "$percent%";
			}
			if($imptotal == 0) {
			$left = _UNLIMITED;
				$imptotal = _UNLIMITED;
			} else {
				$left = $imptotal-$impmade;
			}
			if ($row['ad_class'] == "flash" || $row['ad_class'] == "code") {
				$clicks = "N/A";
				$percent = "N/A";
			}
			if ($row['name'] == "") {
				$row['name'] = _NONE;
			}
			echo "<td align=\"center\">".$row['name']."</td>"
			    ."<td align=\"center\">$enddate</td>"
				."<td align=\"center\">$impmade</td>"
				."<td align=\"center\">$imptotal</td>"
				."<td align=\"center\">$left</td>"
				."<td align=\"center\">$clicks</td>"
				."<td align=\"center\">$percent</td>"
				."<td align=\"center\">".ucFirst($row['ad_class'])."</td>"
				."<td align=\"center\"><a href=\"modules.php?name=$module_name&op=client_report&cid=$cid&bid=$bid\"><img src=\"images/edit.gif\" border=\"0\" alt=\""._EMAILSTATS."\" title=\""._EMAILSTATS."\"></a>  <a href=\"modules.php?name=$module_name&op=view_banner&cid=$cid&bid=$bid\"><img src=\"images/view.gif\" border=\"0\" alt=\""._VIEWBANNER."\" title=\""._VIEWBANNER."\"></a></td><tr>";
			$a = 1;
		}
		if ($a != 1) {
			echo "<td align=\"center\" colspan=\"9\"><i>"._NOCONTENT."</i></td></tr>";
		}
		echo "</table><br /><br /><center>[ <a href=\"modules.php?name=$module_name&op=client_logout\">"._LOGOUT."</a> ]</center>";
		CloseTable();
		include_once("footer.php");
	}
}

function view_banner($cid, $bid) {
	global $prefix, $db, $module_name, $client, $bgcolor2, $sitename;
	if (!is_client($client)) {
		Header("Location: modules.php?name=$module_name&op=client");
		die();
	} else {
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(":", $client);
		$client_id = $client[0];
		if ($cid != $client_id) {
			include_once("header.php");
    OpenTable();
    themenu();
			title(""._ADSYSTEM."");
			echo "<center>"._ADISNTYOUR."<br /><br />"._GOBACK."</center>";
			CloseTable();
			include_once("footer.php");
			die();
		} else {
			include_once("header.php");
    OpenTable();
    themenu();
			title(""._ADSYSTEM."");
			$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner WHERE bid='$bid'"));	
			$cid = intval($row['cid']);
			$imptotal = intval($row['imptotal']);
			$impmade = intval($row['impmade']);
			$clicks = intval($row['clicks']);
			$imageurl = $row['imageurl'];
			$clickurl = $row['clickurl'];
			$ad_class = $row['ad_class'];
			$ad_code = $row['ad_code'];
			$ad_width = $row['ad_width'];
			$ad_height = $row['ad_height'];
			$alttext = $row['alttext'];
			echo "<center><font class=\"title\"><strong>" . _YOURBANNER . ": ".$row['name']."</strong></font><br /><br />";
			if ($ad_class == "code") {
				$ad_code = stripslashes(FixQuotes($ad_code));
				echo "<table border=\"0\" align=\"center\"><tr><td>$ad_code</td></tr></table><br /><br />";
			} elseif ($ad_class == "flash") {
				echo "<center>
					<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"
					codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"
					WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\" id=\"$bid\">
					<PARAM NAME=movie VALUE=\"$imageurl\">
					<PARAM NAME=quality VALUE=high>
					<EMBED src=\"$imageurl\" quality=high WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\"
					NAME=\"$bid\" ALIGN=\"\" TYPE=\"application/x-shockwave-flash\"
					PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\">
					</EMBED>
					</OBJECT>
					</center><br /><br />";
			} else {
				echo "<center><img src=\"$imageurl\" border=\"1\" alt=\"$alttext\" title=\"$alttext\" width=\"$ad_width\" height=\"$ad_height\"></center><br /><br />";
			}
			echo "<center>Banner Information: ".$row['name']."</center><br />"
	   			."<table width=\"100%\" border=\"1\"><tr>"
	   			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._NAME."</strong></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPMADE."</strong></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPTOTAL."</strong></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPLEFT."</strong></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._CLICKS."</strong></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>% "._CLICKS."</strong></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._TYPE."</strong></td><tr>";
			$bid = $row['bid'];
			$bid = intval($bid);
			$imptotal = $row['imptotal'];
			$imptotal = intval($imptotal);
			$impmade = $row['impmade'];
			$impmade = intval($impmade);
			$clicks = $row['clicks'];
			$clicks = intval($clicks);
			$date = $row['date'];
			if ($impmade == 0) {
				$percent = 0;
			} else {
				$percent = substr(100 * $clicks / $impmade, 0, 5);
				$percent = "$percent%";
			}
			if ($imptotal == 0) {
				$left = _UNLIMITED;
				$imptotal = _UNLIMITED;
			} else {
				$left = $imptotal-$impmade;
			}
			if ($row['ad_class'] == "flash" || $row['ad_class'] == "code") {
				$clicks = "N/A";
				$percent = "N/A";
			}
			if ($row['name'] == "") {
				$row['name'] = _NONE;
			}
			if ($row['active'] == 1) {
				$status = _ACTIVE;
			} elseif ($row['active'] == 0) {
				$status = _INACTIVE;
			}
			echo "<td align=\"center\">".$row['name']."</td>"
				."<td align=\"center\">$impmade</td>"
				."<td align=\"center\">$imptotal</td>"
				."<td align=\"center\">$left</td>"
				."<td align=\"center\">$clicks</td>"
				."<td align=\"center\">$percent</td>"
				."<td align=\"center\">".ucFirst($row['ad_class'])."</td></tr><tr>"
				."<td align=\"center\" colspan=\"7\">"._CURRENTSTATUS." $status</td></tr>"
				."</table><br /><br />"
				."[ <a href=\"modules.php?name=$module_name&op=client_report&cid=$cid&bid=$bid\">"._EMAILSTATS."</a> | <a href=\"modules.php?name=$module_name&op=logout\">"._LOGOUT."</a> ]";
			CloseTable();
			include_once("footer.php");
		}
	}
}

function client_report($cid, $bid) {
	global $prefix, $db, $module_name, $client, $sitename;
	if (!is_client($client)) {
		Header("Location: modules.php?name=$module_name&op=client");
		die();
	} else {
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(":", $client);
		$client_id = $client[0];
		if ($cid != $client_id) {
			include_once("header.php");
    OpenTable();
    themenu();
			title(""._ADSYSTEM."");
			echo "<center>"._FUNCTIONSNOTALLOWED."<br /><br />"._GOBACK."</center>";
			CloseTable();
			include_once("footer.php");
			die();
		} else {
			include_once("header.php");
    OpenTable();
    themenu();
			title(""._ADSYSTEM."");
			$bid = intval($bid);
			$cid = intval($cid);
			$sql = "SELECT name, email FROM ".$prefix."_banner_clients WHERE cid='$cid'";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$name = htmlentities($row['name']);
			$email = $row['email'];
			if ($email == "") {
				echo "<center><br /><br />"
					."<strong>"._STATSNOTSEND."</strong><br /><br />"
					."<a href=\"javascript:history.go(-1)\">"._GOBACK."</a>";
				CloseTable();
				include_once("footer.php");
				die();
			} else {
				$sql2 = "SELECT bid, name, imptotal, impmade, clicks, imageurl, clickurl, date, ad_class FROM ".$prefix."_banner WHERE bid='$bid' AND cid='$cid'";
				$result2 = $db->sql_query($sql2);
				$row2 = $db->sql_fetchrow($result2);
				$bid = $row2['bid'];
				$bid = intval($bid);
				$imptotal = $row2['imptotal'];
				$imptotal = intval($imptotal);
				$impmade = $row2['impmade'];
				$impmade = intval($impmade);
				$clicks = $row2['clicks'];
				$clicks = intval($clicks);
				$imageurl = $row2['imageurl'];
				$clickurl = $row2['clickurl'];
				$date = $row2['date'];
				if($impmade==0) {
					$percent = 0;
				} else {
					$percent = substr(100 * $clicks / $impmade, 0, 5);
				}
				if($imptotal==0) {
					$left = _UNLIMITED;
					$imptotal = _UNLIMITED;
				} else {
					$left = $imptotal-$impmade;
				}
				$fecha = date("F jS Y, h:iA.");
				$subject = ""._YOURSTATS." $sitename";
				if (empty($row2['ad_class']) || $row2['ad_class'] == "image") {
					$message = ""._FOLLOWINGSTATS." $sitename:\n\n\n"._CLIENTNAME.": $name\n"._BANNERID.": $bid\n"._BANNERNAME.": ".$row['name']."\n"._BANNERIMAGE.": $imageurl\n"._BANNERURL.": $clickurl\n\n"._IMPPURCHASED.": $imptotal\n"._IMPREMADE.": $impmade\n"._IMPRELEFT.": $left\n"._RECEIVEDCLICKS.": $clicks\n"._CLICKSPERCENT.": $percent%\n\n\n"._GENERATEDON.": $fecha";
				} elseif ($row2['ad_class'] == "flash") {
					$message = ""._FOLLOWINGSTATS." $sitename:\n\n\n"._CLIENTNAME.": $name\n"._BANNERID.": $bid\n"._BANNERNAME.": ".$row['name']."\n"._FLASHMOVIE.": $imageurl\n\n"._IMPPURCHASED.": $imptotal\n"._IMPREMADE.": $impmade\n"._IMPRELEFT.": $left\n"._RECEIVEDCLICKS.": N/A\n"._CLICKSPERCENT.": N/A\n\n\n"._GENERATEDON.": $fecha";
				} elseif ($row2['ad_class'] == "code") {
					$message = ""._FOLLOWINGSTATS." $sitename:\n\n\n"._CLIENTNAME.": $name\n"._BANNERID.": $bid\n"._BANNERNAME.": ".$row['name']."\n\n"._IMPPURCHASED.": $imptotal\n"._IMPREMADE.": $impmade\n"._IMPRELEFT.": $left\n"._RECEIVEDCLICKS.": N/A\n"._CLICKSPERCENT.": N/A\n\n\n"._GENERATEDON.": $fecha";
				}
				$from = "$sitename";
				mail($email, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
				echo "<center><br /><br /><br />"
					."<strong>"._STATSSENT." $email</strong><br /><br />"
					."[ <a href=\"javascript:history.go(-1)\">"._GOBACK."</a> ]";
				CloseTable();
				include_once("footer.php");
			}
		}
	}
}


/////////////////  PCN ADVERTISING UPGRADE EXTRAS  --  START    ////////////////////

/***************************/
/* ADVERTISING HOMEPAGE    */
/***************************/
function theindex() {
    global $prefix, $sitename, $user_prefix, $db, $module_name, $dbi, $bgcolor1, $bgcolor2, $bgcolor3, $admin;
    include_once("header.php");  
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_frontpage"));
    $frontpage = preg_replace("/\[sitename\]/", $sitename, $row['frontpage_body']);
    OpenTable();
    themenu();
    title(""._MAIN."");
    echo "$frontpage";
    CloseTable();
    include_once("footer.php");
}


/*****************************/
/* ADVERTISING Cancel Page   */
/*****************************/
function cancel() {
global $module_name, $admin, $buttons;
include_once("header.php"); 
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_cancel"));
    $cancel = preg_replace("/\[sitename\]/", $sitename, $row['cancel_body']);
    OpenTable();
    themenu();
    title("Did you mean to cancel your Order!");
	 echo "$cancel";
    CloseTable();
    include_once("footer.php");
}



/*****************************/
/* ADVERTISING Campaign Page */
/*****************************/
function campaigns() {
global $module_name, $admin, $buttons;
include_once("header.php"); 
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_campaigns"));
    $campaigns = preg_replace("/\[sitename\]/", $sitename, $row['campaigns_body']);
    OpenTable();
    themenu();
    title(""._ADCAMPAIGNS.""); 
	 echo "$campaigns";
    CloseTable();
    include_once("footer.php");
}




/***************************/
/* ADVERTISING STATS page  */
/***************************/
function sitestats() {
    global $hlpfile,$nowyear,$nowmonth,$nowdate,$nowhour, $sitename, $startdate, $prefix, $dbi, $now, $module_name,  $admin, $buttons;
    global $module_name, $prefix, $db, $user_prefix, $nukeurl, $sitename;
	$url = $nukeurl;	
    $result = $db->sql_query("SELECT hits FROM ".$prefix."_stats_year WHERE hits!='0'");
    $hits = 0;
    $a = 0;
    while ($row = $db->sql_fetchrow($result)) {
    	$hits = $hits+$row['hits'];
    	$a++;
    }
    $views_y = $hits/$a;
    $result = $db->sql_query("SELECT hits FROM ".$prefix."_stats_month WHERE hits!='0'");
    $hits = 0;
    $a = 0;
    while ($row = $db->sql_fetchrow($result)) {
    	$hits = $hits+$row['hits'];
    	$a++;
    }
    $views_m = $hits/$a;
    $result = $db->sql_query("SELECT hits FROM ".$prefix."_stats_date WHERE hits!='0'");
    $hits = 0;
    $a = 0;
    while ($row = $db->sql_fetchrow($result)) {
    	$hits = $hits+$row['hits'];
    	$a++;
    }
    $views_d = $hits/$a;
	$result = $db->sql_query("SELECT hits FROM ".$prefix."_stats_hour WHERE hits!='0'");
	$hits = 0;
    $a = 0;
    while ($row = $db->sql_fetchrow($result)) {
    	$hits = $hits+$row['hits'];
    	$a++;
    }
    $views_h = $hits/$a;
    $views_y = round($views_y);
    $views_m = round($views_m);
    $views_d = round($views_d);
    $views_h = round($views_h);
    $row = $db->sql_fetchrow($db->sql_query("SELECT count FROM ".$prefix."_counter WHERE type='total'"));
    $views_t = $row['count'];
	$regusers = $db->sql_numrows($db->sql_query("SELECT user_id FROM ".$user_prefix."_users"));
    include_once("header.php");
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_stats"));
    $stats = preg_replace("/\[sitename\]/", $sitename, $row['stats_body']);
    OpenTable();
    themenu();
	title(""._GENERALSTATS."");
    echo "$stats";

    echo "<table cellSpacing=\"1\" cellPadding=\"0\" width=\"100%\"  border=\"1\">
  <tr>
    <td>
	    <table cellSpacing=\"1\" cellPadding=\"8\" width=\"100%\"  border=\"1\">
      <tr>
        <td>";
		

    $result = sql_query("select count from ".$prefix."_counter order by type desc", $dbi);
    list($total) = sql_fetch_row($result, $dbi);

    echo "<center>"._STATSTEXT."<br />"
    	.""._TOTALVIEWS." <strong>$views_t</strong><br />"
    	.""._VIEWSYEAR." <strong>$views_y</strong><br />"
		.""._VIEWSMONTH." <strong>$views_m</strong><br />"
		.""._VIEWSDAY." <strong>$views_d</strong><br />"
		.""._VIEWSHOUR." <strong>$views_h</strong><br />"
		.""._CURREGUSERS." <strong>$regusers</strong><br />";
	if ($url != "http://--------.---") {
		echo ""._GOOGLERANK." <strong>".getrank($url)."</strong><br />";
	}

    $result = sql_query("select year, month, hits from ".$prefix."_stats_month order by hits DESC limit 0,1", $dbi);
    list($year, $month, $hits) = sql_fetch_row($result, $dbi);
    if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _OCTOBER;} elseif ($month == 10) {$month = _SEPTEMBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}
    echo ""._MOSTMONTH.": $month $year ($hits "._HITS.")<br />";

    $result = sql_query("select year, month, date, hits from ".$prefix."_stats_date order by hits DESC limit 0,1", $dbi);
    list($year, $month, $date, $hits) = sql_fetch_row($result, $dbi);
    if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _OCTOBER;} elseif ($month == 10) {$month = _SEPTEMBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}
    echo ""._MOSTDAY.": $date $month $year ($hits "._HITS.")<br />";

    $result = sql_query("select year, month, date, hour, hits from ".$prefix."_stats_hour order by hits DESC limit 0,1", $dbi);
    list($year, $month, $date, $hour, $hits) = sql_fetch_row($result, $dbi);
    if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _OCTOBER;} elseif ($month == 10) {$month = _SEPTEMBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}
    if ($hour < 10) {
	$hour = "0$hour:00 - 0$hour:59";
    } else {
	$hour = "$hour:00 - $hour:59";
    }

    echo ""._MOSTHOUR.": $hour "._ON." $month $date, $year ($hits "._HITS.")<br /><br />"
	."[ <a href=\"modules.php?name=Statistics\">See More Stats</a> ]</center><br />";
	
echo"  </td>
      </tr>
    </table>
    </td>
  </tr>
</table>";  
    CloseTable();
    include_once("footer.php");
}



/*****************************/
/* ADVERTISING THANKS Page   */
/*****************************/
function thanks() {
global $module_name, $admin, $buttons;
include_once("header.php");  
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_thanks"));
    $thanks = preg_replace("/\[sitename\]/", $sitename, $row['thanks_body']);
    OpenTable();
    themenu();
    title("Thanks you for your Order");
    echo "<table width='95%' bgcolor='$bgcolor3' align='center' cellspacing='2' cellpadding='2' border='0'>";
    echo "<tr><td>";
    echo "$thanks";
    echo "<br /><br />";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "<br /><br />";
    CloseTable();
    include_once("footer.php");
}



////////////////////////////////////////////////////////////////////////////////
// Add Banner Section  -- START -- Added 06.10.05 y.m.d
////////////////////////////////////////////////////////////////////////////////	

function addbanner() {
global $prefix, $sitename, $nukeurl, $banners, $admin_file,  $user_prefix, $db, $module_name, $dbi, $bgcolor1, $bgcolor2, $bgcolor3, $user, $admin, $buttons;

include_once("header.php");
OpenTable();
themenu();
CloseTable();

if (is_admin($admin) OR (is_user($user))) {

title("Upload your Advertisement information");
OpenTable();
echo "<table width='99%' bgcolor='$bgcolor3' align='center' cellspacing='2' cellpadding='2' border='0'>";
echo "<tr><td>";
echo "<font class=\"title\">"._STEP1."</font>";
include_once("ad_files/upload.php");
//echo "<center><strong>"._ADSPATH."</strong>  $nukeurl/modules/Advertising/files/banners/image.xxx <br /></center>";
echo "<center><strong>"._ADSPATH."</strong>  /modules/Advertising/ad_files/banners/image.xxx</center>";
echo "<br />";
echo "<center><strong>"._ADSPATH2."</strong></center>";
echo "<br />";
echo "<center>(Remember to also use this path as in the form below after submitting the image first!)</center>";
echo "<br />";
echo "</td>";
echo "</tr>";
echo "</table>";
CloseTable();


OpenTable();
echo "<table width='99%' bgcolor='$bgcolor3' align='center' cellspacing='2' cellpadding='2' border='0'>";
echo "<tr><td>";
echo "<font class=\"title\">"._STEP2."</font>";
echo "<br /><br />";

echo "" . _ADTOPNOTE . "";
echo "<hr width='90%'>";


$result = $db->sql_query("select * from ".$prefix."_banner_clients");
$numrows = $db->sql_numrows($result);
if($numrows > 0) {
echo "<center><font class=\"title\"><strong>" . _ADDNEWBANNER . "</strong></font></center><br /><br />"
."<table border=\"0\"><tr><td>"
."<form action=\"modules.php?name=Advertising&op=BannersAdd2\" method=\"post\">"
."" . _CLIENTNAME . ":</td>"
."<td><select name=\"cid\">";
			$result = $db->sql_query("SELECT cid, name from " . $prefix . "_banner_clients ORDER BY name");
			while ($row = $db->sql_fetchrow($result)) {
				$cid = intval($row['cid']);
				$name = $row['name'];
				echo "<option value=\"$cid\">$name</option>";
			}
			echo "</select> Select the <strong>Client Name</strong> you logged in here with</td></tr>"
			."<tr><td nowrap>" . _BANNERNAME . ":</td><td><input type=\"text\" name=\"adname\" size=\"12\" maxlength=\"50\"> <strong>Example:</strong> (membername22)</td></tr>"
			."<tr><td nowrap>" . _ENDDATE . ":</td><td><input type=\"text\" name=\"enddate\" size=\"12\" maxlength=\"100\"> " . _ENDDATE2 . "</td></tr>"
			."<tr><td nowrap>" . _PURCHASEDIMPRESSIONS . ":</td><td><input type=\"text\" name=\"imptotal\" size=\"12\" maxlength=\"11\"> Select 0 for " . _UNLIMITED . " - we will adjust if needed.</td></tr>"
			."<tr><td>" . _ADCLASS . ":</td><td><select name=\"ad_class\">"
			."<option name=\"type\" value=\"image\">" . _ADIMAGE . "</option>"
			."<option name=\"type\" value=\"code\">" . _ADCODE . "</option>"
			."<option name=\"type\" value=\"flash\">" . _ADFLASH . "</option>"
			."</select></td></tr>"
			."<tr><td>&nbsp;</td><td><i>"._CLASSNOTE."</i></td></tr>"
			."<tr><td>" . _IMAGESWFURL . ":</td><td><input type=\"text\" name=\"imageurl\" size=\"50\" maxlength=\"100\" value=\"http://\"></td></tr>"
			."<tr><td>" . _IMAGESIZE . ":</td><td>"._WIDTH.": <input type=\"text\" name=\"ad_width\" size=\"4\" maxlength=\"4\"> &nbsp; "._HEIGHT.": <input type=\"text\" name=\"ad_height\" size=\"4\" maxlength=\"4\"> &nbsp; "._INPIXELS."</td></tr>"
			."<tr><td>" . _CLICKURL . "</td><td><input type=\"text\" name=\"clickurl\" size=\"50\" maxlength=\"200\" value=\"http://\"></td></tr>"
			."<tr><td>" . _ALTTEXT . ":</td><td><input type=\"text\" name=\"alttext\" size=\"50\" maxlength=\"255\"></td></tr>"
			."<tr><td>" . _ADCODE . ":</td><td><textarea name=\"ad_code\" rows=\"8\" cols=\"60\"></textarea></td></tr>"
			."<tr><td>" . _TYPE . ":</td><td><select name=\"position\">";
			$result = $db->sql_query("SELECT position_number, position_name FROM ".$prefix."_banner_positions ORDER BY position_number");
			while ($row = $db->sql_fetchrow($result)) {
				echo "<option name=\"position\" value=\"".$row['position_number']."\">".$row['position_number']." - ".$row['position_name']."</option>";
			}
			echo "</select></td></tr><tr><td>&nbsp;</td><td>"._POSITIONNOTE."</td></tr>"
				//."<tr><td>" . _ACTIVATE . ":</td><td><input type=\"radio\" name=\"active\" value=\"1\" checked>" . _YES . "&nbsp;&nbsp;<input type=\"radio\" name=\"active\" value=\"0\">" . _NO . " &nbsp; Please select: <strong>NO</strong> we will review the ad first</td></tr>"
				."<tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"op\" value=\"BannersAdd2\">"
				."<input type=\"submit\" value=\"" . _ADDBANNER . "\">"
				."</form></td></tr></table>";
		} else {
			echo "<center><font class=\"title\"><strong>" . _ADDNEWBANNER . "</strong></font></center><br /><br />"
				."<center>"._ADSNOCLIENT."<br /><br />"._GOBACK."</center>";
		}
echo "<br /><center>";
echo "<strong>Be sure to review all details of this form prior to submitting it!</strong>";
echo "<br /><hr width='90%'><center><br />";
OpenTable();
showplans();
CloseTable();

  }

echo "<br /><br />";
echo "</td>";
echo "</tr>";
echo "</table>"; 
CloseTable();
include_once("footer.php");
}	

////////////////////////////////////////////////////////////////////////////////
// Now add the banner
////////////////////////////////////////////////////////////////////////////////

function BannersAdd2($name, $cid, $adname, $enddate, $imptotal, $imageurl, $clickurl, $alttext, $position, $active, $ad_class, $ad_code, $ad_width, $ad_height) {
global $prefix, $db, $admin_file;
$alttext = filter($alttext, "nohtml", 1);
$cid = intval($cid);
$imptotal = intval($imptotal);
$active = intval($active);
if (($ad_class == "image" OR $ad_class == "flash") AND ($ad_width == "" OR $ad_height == "")) { $a = 1; }
if (($ad_class == "image") AND ($imageurl == "http://" OR $imageurl == "")) { $a = 1; }
if (($ad_class == "image" OR $ad_class == "flash") AND ((!is_numeric($ad_width) || !is_numeric($ad_height)))) { $a = 1; }
if (($ad_class == "code") AND ($ad_code == "")) { $a = 1; }
if ($a == 1) {
include_once("header.php");
OpenTable();
themenu();
CloseTable();
title("Incomplete: review the form information");
OpenTable();
echo "<center>"._ADINFOINCOMPLETE."<br /><br />"._GOBACK."</center>";
CloseTable();
include_once("footer.php");
die();
}
$adname = filter($adname, "nohtml", 1);
$enddate = filter($enddate, "nohtml", 1);
$db->sql_query("insert into " . $prefix . "_banner values (NULL, '$cid', '$adname', '$enddate', '$imptotal', '1', '0', '$imageurl', '$clickurl', '$alttext', now(), '00-00-0000 00:00:00', '$position', '$active', '$ad_class', '$ad_code', '$ad_width', '$ad_height')");
Header("Location: modules.php?name=Advertising&op=BannersGood");
}
	

//// Banner Uploaded Good ////	
function BannersGood() {
global $prefix, $db, $admin_file;
include_once("header.php");
OpenTable();
themenu();
CloseTable();
title("Complete: We have the Advertisement");
OpenTable();
echo "<center><br /><strong>"._ADINFOCOMPLETE."</strong><br /><br />";
echo "|| <a href='modules.php?name=Advertising&op=client_home'><strong>Go back to the Client Main Page?</strong></a> ||</center>"; 
echo "<br /><br />";
CloseTable();
include_once("footer.php");
}	
	
////////////////////////////////////////////////////////////////////////////////
// Add Banner Section  -- END
////////////////////////////////////////////////////////////////////////////////		
	

//// Payment Gateways types ////	
function gateways() {
global $prefix, $db, $admin_file;
include_once("header.php");
OpenTable();
themenu();
title("Payment Gateway Information");
echo "<center>";
include_once("includes/payments.php");
echo "</center>"; 
echo "<br /><br />";
CloseTable();
include_once("footer.php");
}	


//// Sponsors - view all uploaded banners ////	
function sponsors() {
global $prefix, $db, $admin_file, $sitename;
include_once("header.php");
OpenTable();
themenu();
title("$sitename - Sponsors");
echo "<table width='100%' align='center' valign='top' cellspacing='5' cellpadding='5' border='0'>";
echo "<tr>";
echo "<td valign='top'>";
$result = $db->sql_query("SELECT * FROM ".$prefix."_banner order by position,cid");
while ($row = $db->sql_fetchrow($result)) {

$cid = intval($row['cid']);
$bid = intval($row['bid']);
$imageurl = $row['imageurl'];
$clickurl = $row['clickurl'];
$alttext = filter($row['alttext'], "nohtml");
$date = $row['date'];
$date = explode(" ", $date);
$date = "$date[0] @ $date[1]";
$position = $row['position'];
$active = intval($row['active']);
$ad_class = $row['ad_class'];
$ad_code = $row['ad_code'];
$ad_width = $row['ad_width'];
$ad_height = $row['ad_height'];

	if ($ad_class == "code") {
	$ad_code = stripslashes(FixQuotes($ad_code));
	echo "<table border=\"0\" align=\"center\"><tr><td>$ad_code</td></tr></table><hr width='90%'>";
	} elseif ($ad_class == "flash") {
	echo "<center>
	<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"
	codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"
	WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\" id=\"$bid\">
	<PARAM NAME=movie VALUE=\"$imageurl\">
	<PARAM NAME=quality VALUE=high>
	<EMBED src=\"$imageurl\" quality=high WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\"
	NAME=\"$did\" ALIGN=\"\" TYPE=\"application/x-shockwave-flash\"
	PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\">
	</EMBED>
	</OBJECT>
	</center><hr width='90%'>";
	} else {
	echo "<center><a href=\"$clickurl\" target=\"_blank\"><img src=\"$imageurl\" border=\"0\" alt=\"$alttext\" title=\"$alttext\" width=\"$ad_width\" height=\"$ad_height\"></a></center><hr width='90%'>";
	}
    }
    
echo "</td>";
echo "</tr>";
echo "</table>";   
CloseTable();
include_once("footer.php");
}	


/////////////////  PCN ADVERTISING UPGRADE EXTRAS  --  END    ////////////////////


switch ($op) {
 /////////////////  PCN ADVERTISING UPGRADE EXTRAS  --  START    ////////////////////
    case "theindex":
    theindex();
    break;
	
	case "campaigns":
    campaigns();
    break;
	
	case "cancel":
    cancel();
    break;
	
	case "thanks":
    thanks();
    break;

    case "sitestats":
    sitestats();
    break;

    case "terms":
    terms();
    break;
	/////////////////  PCN ADVERTISING UPGRADE EXTRAS  --  END    ////////////////////
	
	
	default:
    plans();
    break;
	
	case "client":
	client();
	break;
	
	case "client_home":
	client_home();
	break;
	
	case "client_valid":
	client_valid($login, $pass);
	break;
	
	case "client_logout":
	client_logout();
	break;
	
	case "client_report":
	client_report($cid, $bid);
	break;
	
	case "view_banner":
	view_banner($cid, $bid);
	break;
	
	
	case "addbanner":
	addbanner();
	break;
	
	case "BannersGood":
	BannersGood();
	break;
	
    case "BannersAdd2":
	BannersAdd2($name, $cid, $adname, $enddate, $imptotal, $imageurl, $clickurl, $alttext, $position, $active, $ad_class, $ad_code, $ad_width, $ad_height);
	break;

	case "showplans":
	showplans();
	break;
	
	case "gateways":
	gateways();
	break;
	
	case "sponsors":
	sponsors();
	break;
	

}

?>

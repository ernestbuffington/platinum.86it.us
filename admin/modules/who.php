<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ==================================================================== */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
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
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */ 
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */ 
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to PlatinumNukePro.com for detailed information on PNPro*/
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */ 
/************************************************************************/

if ( !defined('ADMIN_FILE') ) { 
die("Illegal Admin File Access");
} 

global $admin_file; 

global $user, $db, $admin, $bgcolor; 
include_once("header.php"); 
global $bgcolor2, $sitename, $db, $bgcolor1, $prefix, $language, $multilingual, $admin_file; 
OpenTable(); 
$serverdate = date("l, d F Y h:i a"); 
print("<p align=\"center\"><strong>$sitename</strong> - "._who00."<br /><br />"._who01."<a href=\"".$admin_file.".php\">Administration menu</A><br /><br />"._who02."<strong>$serverdate</strong></p>"); 
print ("<center><img src=\"images/who/group-3.gif\" align=\"middle\" height=\"14\" width=\"17\">"._who03."</center><br />"); 
CloseTable(); 
print ("<br />"); 
OpenTable(); 
print ("<center><img src=\"images/who/info.gif\" align=\"middle\" border=\"0\" alt=\""._who13."\">&nbsp;"._who13."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"images/who/edit.gif\" align=\"middle\" border=\"0\" alt=\""._who08."\">&nbsp;=&nbsp;"._who08."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"images/who/delete.gif\" align=\"middle\" border=\"0\" alt=\""._who20."\">&nbsp;=&nbsp;"._who20."</center>"); 
print ("<br /><table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\"><tr><td bgcolor=$bgcolor2><strong>"._who04."</strong></td><td bgcolor=$bgcolor1><strong>"._who05."</strong></td><td bgcolor=$bgcolor2><strong>"._who06."</strong></td><td bgcolor=$bgcolor1><strong>"._who10."</strong></td><td bgcolor=$bgcolor2><strong>"._who07."</strong></td></tr>");
$result3 = $db->sql_query("SELECT uname, host_addr, time, guest FROM $prefix"._session.""); 
while (list($uname, $host_addr, $time, $guest) = $db->sql_fetchrow($result3)) { 
if($guest == 0) { 
$uname = "<img src=\"images/who/ur-member.gif\" align=\"middle\" border=\"0\" alt=\"$uname\">&nbsp;$uname&nbsp;&nbsp;<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname\"><img src=\"images/who/info.gif\" align=\"middle\" border=\"0\" alt=\""._who13."\"></a><a href=".$admin_file.".php?op=modifyUser&chng_uid=$uname><img src=\"images/who/edit.gif\" align=\"middle\" border=\"0\" alt=\""._who08."\"></a>&nbsp;<a href=".$admin_file.".php?op=delUser&chng_uid=$uname><img src=\"images/who/delete.gif\" align=\"middle\" border=\"0\" alt=\""._who20."\"></a>";
} 
if($guest == 1) { 
$uname = "<img src=\"images/who/ur-anony.gif\" align=\"middle\" border=\"0\" alt=\""._who14."\">&nbsp;"._who14.""; 
}
if($host_addr == '') {
  $host_addr = '127.0.0.1';
}
$host = gethostbyaddr ($host_addr); 
$array = explode(".", $host);
$top_domain = $array[sizeof($array)-1]; 
$country = ""; 
switch($top_domain) { 
case 'biz':$country="Business";break; 
case 'info':$country="Info";break; 
case 'com':$country="Commercial";break; 
case 'arpa':$country="ARPANet/USA";break; 
case 'edu':$country="Education";break; 
case 'gov':$country="Government/USA";break; 
case 'int':$country="Oganization established by an Iinternational Teaty";break; 
case 'mil':$country="Military/USA";break;
case 'net':$country="Network";break; 
case 'org':$country="Organization/USA";break; 
case 'ad':$country="Andorra";break; 
case 'ae':$country="United Arab Emirates";break; 
case 'af':$country="Afghanistan";break; 
case 'ag':$country="Antigua & Barbuda";break; 
case 'ai':$country="Anguilla";break; 
case 'al':$country="Albania";break; 
case 'am':$country="Armenia";break; 
case 'an':$country="Neterland Antilles";break; 
case 'ao':$country="Angola";break; 
case 'aq':$country="Antarctica";break; 
case 'ar':$country="Argentina";break; 
case 'as':$country="American Samoa";break; 
case 'at':$country="Austria";break; 
case 'au':$country="Australia";break; 
case 'aw':$country="Aruba";break; 
case 'az':$country="Azerbaijan";break; 
case 'ba':$country="Bosnia-Herzegovina";break; 
case 'bb':$country="Barbados";break; 
case 'bd':$country="Bangladesh";break; 
case 'be':$country="Belgium";break; 
case 'bf':$country="Burkina Faso";break; 
case 'bg':$country="Bulgaria";break; 
case 'bh':$country="Bahrain";break; 
case 'bi':$country="Burundi";break; 
case 'bj':$country="Benin";break; 
case 'bm':$country="Bermuda";break; 
case 'bn':$country="Brunei Darussalam";break; 
case 'bo':$country="Bolivia";break; 
case 'br':$country="Brasil";break; 
case 'bs':$country="Bahamas";break; 
case 'bt':$country="Bhutan";break; 
case 'bv':$country="Bouvet Island";break; 
case 'bw':$country="Botswana";break; 
case 'by':$country="Belarus";break; 
case 'bz':$country="Belize";break; 
case 'ca':$country="Canada";break; 
case 'cc':$country="Cocos (Keeling) Islands";break; 
case 'cf':$country="Central African Republic";break; 
case 'cg':$country="Congo";break; 
case 'ch':$country="Switzerland";break; 
case 'ci':$country="Ivory Coast";break; 
case 'ck':$country="Cook Islands";break; 
case 'cl':$country="Chile";break; 
case 'cm':$country="Cameroon";break; 
case 'cn':$country="China";break; 
case 'co':$country="Colombia";break; 
case 'cr':$country="Costa Rica";break; 
case 'cs':$country="Czechoslovakia";break; 
case 'cu':$country="Cuba";break; 
case 'cv':$country="Cape Verde";break; 
case 'cx':$country="Christmas Island";break; 
case 'cy':$country="Cyprus";break; 
case 'cz':$country="Czech Republic";break; 
case 'de':$country="Germany";break; 
case 'dj':$country="Djibouti";break; 
case 'dk':$country="Denmark";break; 
case 'dm':$country="Dominica";break; 
case 'do':$country="Dominican Republic";break; 
case 'dz':$country="Algeria";break; 
case 'ec':$country="Ecuador";break; 
case 'ee':$country="Estonia";break; 
case 'eg':$country="Egypt";break; 
case 'eh':$country="Western Sahara";break; 
case 'er':$country="Eritrea";break; 
case 'es':$country="Spain";break; 
case 'et':$country="Ethiopia";break; 
case 'fi':$country="Finland";break; 
case 'fj':$country="Fiji";break; 
case 'fk':$country="Falkland Islands (Malvibas)";break; 
case 'fm':$country="Micronesia";break; 
case 'fo':$country="Faroe Islands";break; 
case 'fr':$country="France";break; 
case 'fx':$country="France (European Territory)";break; 
case 'ga':$country="Gabon";break; 
case 'gb':$country="Great Britain";break; 
case 'gd':$country="Grenada";break; 
case 'ge':$country="Georgia";break; 
case 'gf':$country="Guyana (French)";break; 
case 'gh':$country="Ghana";break; 
case 'gi':$country="Gibralta";break; 
case 'gl':$country="Greenland";break; 
case 'gm':$country="Gambia";break; 
case 'gn':$country="Guinea";break; 
case 'gp':$country="Guadeloupe (French)";break; 
case 'gq':$country="Equatorial Guinea";break; 
case 'gr':$country="Greece";break; 
case 'gs':$country="South Georgia & South Sandwich Islands";break; 
case 'gt':$country="Guatemala";break; 
case 'gu':$country="Guam (US)";break; 
case 'gw':$country="Guinea Bissau";break; 
case 'gy':$country="Guyana";break; 
case 'hk':$country="Hong Kong";break; 
case 'hm':$country="Heard & McDonald Islands";break; 
case 'hn':$country="Honduras";break; 
case 'hr':$country="Croatia";break; 
case 'ht':$country="Haiti";break; 
case 'hu':$country="Hungary";break; 
case 'id':$country="Indonesia";break; 
case 'ie':$country="Ireland";break; 
case 'il':$country="Israel";break; 
case 'in':$country="India";break; 
case 'io':$country="British Indian Ocean Territories";break; 
case 'iq':$country="Iraq";break; 
case 'ir':$country="Iran";break; 
case 'is':$country="Iceland";break; 
case 'it':$country="Italy";break; 
case 'jm':$country="Jamaica";break; 
case 'jo':$country="Jordan";break; 
case 'jp':$country="Japan";break; 
case 'ke':$country="Kenya";break; 
case 'kg':$country="Kyrgyz Republic";break; 
case 'kh':$country="Cambodia";break; 
case 'ki':$country="Kiribati";break; 
case 'km':$country="Comoros";break; 
case 'kn':$country="Saint Kitts Nevis Anguilla";break; 
case 'kp':$country="Korea (North)";break; 
case 'kr':$country="Korea (South)";break; 
case 'kw':$country="Kuwait";break; 
case 'ky':$country="Cayman Islands";break; 
case 'kz':$country="Kazachstan";break; 
case 'la':$country="Laos";break; 
case 'lb':$country="Lebanon";break; 
case 'lc':$country="Saint Lucia";break; 
case 'li':$country="Liechtenstein";break; 
case 'lk':$country="Sri Lanka";break; 
case 'lr':$country="Liberia";break; 
case 'ls':$country="Lesotho";break; 
case 'lt':$country="Lithuania";break; 
case 'lu':$country="Luxembourg";break; 
case 'lv':$country="Latvia";break; 
case 'ly':$country="Libya";break; 
case 'ma':$country="Morocco";break; 
case 'mc':$country="Monaco";break; 
case 'md':$country="Moldova";break; 
case 'mg':$country="Madagascar";break; 
case 'mh':$country="Marshall Islands";break; 
case 'mk':$country="Macedonia";break; 
case 'ml':$country="Mali";break; 
case 'mm':$country="Myanmar";break; 
case 'mn':$country="Mongolia";break; 
case 'mo':$country="Macau";break; 
case 'mp':$country="Northern Mariana Islands";break; 
case 'mq':$country="Martinique (French)";break; 
case 'mr':$country="Mauretania";break; 
case 'ms':$country="Montserrat";break; 
case 'mt':$country="Malta";break; 
case 'mu':$country="Mauritius";break; 
case 'mv':$country="Maldives";break; 
case 'mw':$country="Malawi";break; 
case 'mx':$country="Mexico";break; 
case 'my':$country="Malaysia";break; 
case 'mz':$country="Mozambique";break; 
case 'na':$country="Namibia";break; 
case 'nc':$country="New Caledonia (French)";break; 
case 'ne':$country="Niger";break; 
case 'nf':$country="Norfolk Island";break; 
case 'ng':$country="Nigeria";break; 
case 'ni':$country="Nicaragua";break; 
case 'nl':$country="Netherlands";break; 
case 'no':$country="Norway";break; 
case 'np':$country="Nepal";break; 
case 'nr':$country="Nauru";break; 
case 'nt':$country="Saudiarab. Irak)";break; 
case 'nu':$country="Niue";break; 
case 'nz':$country="New Zealand";break; 
case 'om':$country="Oman";break; 
case 'pa':$country="Panama";break; 
case 'pe':$country="Peru";break; 
case 'pf':$country="Polynesia (French)";break; 
case 'pg':$country="Papua New Guinea";break; 
case 'ph':$country="Philippines";break; 
case 'pk':$country="Pakistan";break; 
case 'pl':$country="Poland";break; 
case 'pm':$country="Saint Pierre & Miquelon";break; 
case 'pn':$country="Pitcairn";break; 
case 'pr':$country="Puerto Rico (US)";break; 
case 'pt':$country="Portugal";break; 
case 'pw':$country="Palau";break; 
case 'py':$country="Paraguay";break; 
case 'qa':$country="Qatar";break; 
case 're':$country="Reunion (French)";break; 
case 'ro':$country="Romania";break; 
case 'ru':$country="Russian Federation";break; 
case 'rw':$country="Rwanda";break; 
case 'sa':$country="Saudi Arabia";break; 
case 'sb':$country="Salomon Islands";break; 
case 'sc':$country="Seychelles";break; 
case 'sd':$country="Sudan";break; 
case 'se':$country="Sweden";break; 
case 'sg':$country="Singapore";break; 
case 'sh':$country="Saint Helena";break; 
case 'si':$country="Slovenia";break; 
case 'sj':$country="Svalbard & Jan Mayen";break; 
case 'sk':$country="Slovakia";break; 
case 'sl':$country="Sierra Leone";break; 
case 'sm':$country="San Marino";break; 
case 'sn':$country="Senegal";break; 
case 'so':$country="Somalia";break; 
case 'sr':$country="Suriname";break; 
case 'st':$country="Sao Tome & Principe";break; 
case 'su':$country="Soviet Union";break; 
case 'sv':$country="El Salvador";break; 
case 'sy':$country="Syria";break; 
case 'sz':$country="Swaziland";break; 
case 'tc':$country="Turks & Caicos Islands";break; 
case 'td':$country="Chad";break; 
case 'tf':$country="French Southern Territories";break; 
case 'tg':$country="Togo";break; 
case 'th':$country="Thailand";break; 
case 'tj':$country="Tadjikistan";break; 
case 'tk':$country="Tokelau";break; 
case 'tm':$country="Turkmenistan";break; 
case 'tn':$country="Tunisia";break; 
case 'to':$country="Tonga";break; 
case 'tp':$country="East Timor";break; 
case 'tr':$country="Turkey";break; 
case 'tt':$country="Trinidad & Tobago";break; 
case 'tv':$country="Tuvalu";break; 
case 'tw':$country="Taiwan";break; 
case 'tz':$country="Tanzania";break; 
case 'ua':$country="Ukraine";break; 
case 'ug':$country="Uganda";break; 
case 'uk':$country="United Kingdom";break; 
case 'um':$country="US Minor outlying Islands";break; 
case 'us':$country="United States";break; 
case 'uy':$country="Uruguay";break; 
case 'uz':$country="Uzbekistan";break; 
case 'va':$country="Vatican City State";break; 
case 'vc':$country="St Vincent & Grenadines";break; 
case 've':$country="Venezuela";break; 
case 'vg':$country="Virgin Islands (British)";break; 
case 'vi':$country="Virgin Islands (US)";break; 
case 'vn':$country="Vietnam";break; 
case 'vu':$country="Vanuatu";break; 
case 'wf':$country="Wallis & Futuna Islands";break; 
case 'ws':$country="Samoa";break; 
case 'ye':$country="Yemen";break; 
case 'yt':$country="Mayotte";break; 
case 'yu':$country="Yugoslavia";break; 
case 'za':$country="South Africa";break; 
case 'zm':$country="Zambia";break; 
case 'zr':$country="Zaire";break; 
case 'zw':$country="Zimbabwe";break; 
default: 
if (is_numeric($host)) 
$country = ""._who16.""; 
else 
$country = ""._who15.""; 
} 
print ("<tr><td bgcolor=$bgcolor1>$uname</td>"); 
if($guest == 0) { 
print ("<td><img src=\"images/who/green_dot.gif\" align=\"middle\">&nbsp;&nbsp;$host_addr</td><td bgcolor=$bgcolor1>"); 
}else{ 
print ("<td><img src=\"images/who/red_dot.gif\" align=\"middle\">&nbsp;&nbsp;$host_addr</td><td bgcolor=$bgcolor1>"); 
} 
print ("<img src=\"images/who/star.gif\" align=\"middle\">&nbsp;&nbsp;$host</td><td>"); 
if ( strstr($host, "aol")) 
print ("<img src=\"images/who/center_l.gif\" align=\"middle\">&nbsp;&nbsp;America Online</td>"); 
else 
print ("<img src=\"images/who/center_l.gif\" align=\"middle\">&nbsp;&nbsp;$country</td>"); 
$unixtime = time() - $time; 
if($unixtime < 60){ 
$sec=$unixtime; 
$min=0; 
$hour=0; 
} else if($unixtime < 3600){ 
$sec=$unixtime%60; 
$hour=0; 
$min_t = explode('.', number_format($unixtime/60,2)); 
$min=$min_t[0]; 
} else if($unixtime >= 216000){ 
$hour_t = explode('.',number_format($unixtime/216000,2)); 
$hour=$hour_t[0]; 
 
$sec=$unixtime%60; 
$min_te = $unixtime%216000; 
$min_t = explode('.',number_format($min_te/60,2)); 
$min=$min_t[0]; 
} 
if($guest == 0) { 
print ("<td bgcolor=$bgcolor1><img src=\"images/who/green_dot.gif\" align=\"middle\">&nbsp;&nbsp;$min min : $sec sec </td>"); 
}else{ 
print ("<td bgcolor=$bgcolor1><img src=\"images/who/red_dot.gif\" align=\"middle\">&nbsp;&nbsp;$min min : $sec sec </td>"); 
} 
} 
print ("</tr></table><br />"); 
$resultws = $db->sql_query("SELECT uname,guest FROM $prefix"._session." where guest=1"); 
$guest_online_count = $db->sql_numrows($resultws); 
$result4thd = $db->sql_query("SELECT uname,guest FROM $prefix"._session." where guest=0"); 
$member_online_count = $db->sql_numrows($result4thd); 
$DataOnlineWho .= "<img src=\"images/who/group-1.gif\" height=\"14\" width=\"17\">&nbsp;&nbsp;"._who17."&nbsp;<strong>$guest_online_count</strong>&nbsp;"._who18."&nbsp;<strong>$member_online_count</strong>&nbsp;"._who19.""; 
if (is_user($user)) { 
list($user_id) = $db->sql_fetchrow($db->sql_query("select user_id from $prefix"._users." where uname='$uname'")); 
} 
$result2 = $db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest='0' ORDER BY uname ASC"); 
$member_online_count = $db->sql_numrows($result2); 
if (is_user($user)) { 
list($user_id) = $db->sql_fetchrow($db->sql_query("select user_id from $prefix"._users." where uname='$uname'")); 
} else { 
$result2 = $db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest='0' ORDER BY uname ASC"); 
$member_online_count = $db->sql_numrows($result2); 
} 
if ($numUsersOnline>0) { 
while($row = mysql_fetch_array($unameResult)){ 
$uname = $row[uname]; 
} 
} 
print ("<center>[&nbsp;<a href=\"".$admin_file.".php?op=who\">"._who09."</a>&nbsp;]</center>\n"); 
CloseTable(); 
print ("<br />\n"); 
list($lastuser) = $db->sql_fetchrow($db->sql_query("select username from $user_prefix"._users." order by user_id DESC limit 0,1")); 
$totalmembers = $db->sql_numrows($db->sql_query("select * from $user_prefix"._users."")); 
$totalmem = number_format($totalmembers, 0); 
OpenTable(); 
print ("<center>$DataOnlineWho</center>\n"); 
print ("<br /><center>"._who11.": <A HREF=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$lastuser\"><strong>$lastuser</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"._who12.": <strong>$totalmem</strong></center>\n"); 
CloseTable(); 
// START - Please do not edit and/or delete this lines - THANKS! 
print ("<br />\n"); 
OpenTable(); 
print ("<center>"._whocopy."</center>\n"); 
CloseTable(); 
// END - Please do not edit and/or delete this lines - THANKS! 
include_once("footer.php"); 

?>


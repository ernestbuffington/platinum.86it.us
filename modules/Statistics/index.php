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
require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- '._STATS;
if (isset($year)) {
    $year = intval($year);
}
$ThemeSel = get_theme();

$now = date('d-m-Y');
$dot = explode ('-',$now);
$nowdate = $dot[0];
$nowmonth = $dot[1];
$nowyear = $dot[2];
$total = 0;

if (!isset($op)) $op = '';
switch($op) {

    default:
        Stats_Main();
    break;

    case 'Stats':
        Stats($total);
    break;

    case 'YearlyStats':
        YearlyStats($year);
    break;

    case 'MonthlyStats':
        MonthlyStats($year,$month);
    break;

    case 'DailyStats':
        DailyStats($year,$month,$date);
    break;

}
die();
//Only functions after this line

function Stats_Main() {
    global $prefix, $db, $startdate, $sitename, $ThemeSel, $user_prefix, $Version_Num, $module_name, $textcolor2;
    include_once('header.php');
    $result = $db->sql_query('SELECT type, var, count from '.$prefix.'_counter order by type desc');
    while ($row = $db->sql_fetchrow($result)) {
        $type = stripslashes(check_html($row['type'], 'nohtml'));
        $var = stripslashes(check_html($row['var'], 'nohtml'));
        $count = intval($row['count']);
        if(($type == 'total') && ($var == 'hits')) {
            $total = $count;
        } elseif($type == 'browser') {
            if($var == 'FireFox') {
                $firefox[] = $count;
                $firefox[] = substr(100 * $count / $total, 0, 5);
                $firefox[] = substr(100 * $count / $total, 0, 2);
            } elseif($var == 'Netscape') {
                $netscape[] = $count;
                $netscape[] = substr(100 * $count / $total, 0, 5);
                $netscape[] = substr(100 * $count / $total, 0, 2);
            } elseif($var == 'MSIE') {
                $msie[] = $count;
                $msie[] =  substr(100 * $count / $total, 0, 5);
                $msie[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'Konqueror') {
                $konqueror[] = $count;
                $konqueror[] =  substr(100 * $count / $total, 0, 5);
                $konqueror[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'Opera') {
                $opera[] = $count;
                $opera[] =  substr(100 * $count / $total, 0, 5);
                $opera[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'Lynx') {
                $lynx[] = $count;
                $lynx[] =  substr(100 * $count / $total, 0, 5);;
                $lynx[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'Bot') {
                $bot[] = $count;
                $bot[] =  substr(100 * $count / $total, 0, 5);
                $bot[] =  substr(100 * $count / $total, 0, 2);
            } elseif(($type == 'browser') && ($var == 'Other')) {
                $b_other[] = $count;
                $b_other[] =  substr(100 * $count / $total, 0, 5);
                $b_other[] =  substr(100 * $count / $total, 0, 2);
            }
        } elseif($type == 'os') {
            if($var == 'Windows') {
                $windows[] = $count;
                $windows[] =  substr(100 * $count / $total, 0, 5);
                $windows[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'Mac') {
                $mac[] = $count;
                $mac[] =  substr(100 * $count / $total, 0, 5);
                $mac[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'Linux') {
                $linux[] = $count;
                $linux[] =  substr(100 * $count / $total, 0, 5);
                $linux[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'FreeBSD') {
                $freebsd[] = $count;
                $freebsd[] =  substr(100 * $count / $total, 0, 5);
                $freebsd[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'SunOS') {
                $sunos[] = $count;
                $sunos[] =  substr(100 * $count / $total, 0, 5);
                $sunos[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'IRIX') {
                $irix[] = $count;
                $irix[] =  substr(100 * $count / $total, 0, 5);
                $irix[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'BeOS') {
                $beos[] = $count;
                $beos[] =  substr(100 * $count / $total, 0, 5);
                $beos[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'OS/2') {
                $os2[] = $count;
                $os2[] =  substr(100 * $count / $total, 0, 5);
                $os2[] =  substr(100 * $count / $total, 0, 2);
            } elseif($var == 'AIX') {
                $aix[] = $count;
                $aix[] =  substr(100 * $count / $total, 0, 5);
                $aix[] =  substr(100 * $count / $total, 0, 2);
            } elseif(($type == 'os') && ($var == 'Other')) {
                $os_other[] = $count;
                $os_other[] =  substr(100 * $count / $total, 0, 5);
                $os_other[] =  substr(100 * $count / $total, 0, 2);
            }
        }
    }
    title($sitename.' '._STATS);
    OpenTable();
    OpenTable();
/* START-Get total page views from core stats-sgtmudd */
/*{
  $totalhits = 0;
  $result = $db->sql_query( 'SELECT sum(hits) FROM ' . $prefix . '_stats_year' );
  list( $totalhits ) = $db->sql_fetchrow( $result );
}
    echo "<center><font class=\"option\"><strong>$sitename "._STATS."</strong></font><br /><br />"._WERECEIVED." <strong>$totalhits</strong> "._PAGESVIEWS." $startdate<br /><br />"
        ."[ <a href=\"modules.php?name=$module_name&amp;op=Stats\">"._VIEWDETAILED."</a> ]</center>";
/* END-Get total page views from core stats-sgtmudd */
    echo "<center><font class=\"option\"><strong>$sitename "._STATS."</strong></font><br /><br />"._WERECEIVED." <strong>$total</strong> "._PAGESVIEWS." $startdate<br /><br />"
        ."[ <a href=\"modules.php?name=$module_name&amp;op=Stats\">"._VIEWDETAILED."</a> ]</center>";
    CloseTable();
    echo "<br /><br />";
    $l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
    $m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
    $r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
    OpenTable2();
    echo "<table cellspacing=\"0\" cellpadding=\"2\" border=\"0\" align=\"center\"><tr><td colspan=\"2\">\n";
    echo "<center><font color=\"$textcolor2\"><strong>"._BROWSERS."</strong></font></center><br /></td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/explorer.gif\" border=\"0\" alt=\"\" />&nbsp;MSIE: </td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"Internet Explorer\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"Internet Explorer\" height=\"$m_size[1]\" width=\"", $msie[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"Internet Explorer\" /> $msie[1] % ($msie[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/firefox.gif\" border=\"0\" alt=\"\" />&nbsp;FireFox: </td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"FireFox\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"FireFox\" height=\"$m_size[1]\" width=\"", $firefox[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"FireFox\" /> $firefox[1] % ($firefox[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/netscape.gif\" border=\"0\" alt=\"\" />&nbsp;Netscape: </td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"Netscape\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"Netscape\" height=\"$m_size[1]\" width=\"", $netscape[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"Netscape\" /> $netscape[1] % ($netscape[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/opera.gif\" border=\"0\" alt=\"\" />&nbsp;Opera: </td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"Opera\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"Opera\" height=\"$m_size[1]\" width=\"", $opera[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"Opera\" /> $opera[1] % ($opera[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/konqueror.gif\" border=\"0\" alt=\"\" />&nbsp;Konqueror: </td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"Konqueror\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"Konqueror (KDE)\" height=\"$m_size[1]\" width=\"", $konqueror[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"Konqueror\" /> $konqueror[1] % ($konqueror[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/lynx.gif\" border=\"0\" alt=\"\" />&nbsp;Lynx: </td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"Lynx\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"Lynx\" height=\"$m_size[1]\" width=\"", $lynx[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"Lynx\" /> $lynx[1] % ($lynx[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/altavista.gif\" border=\"0\" alt=\"\" />&nbsp;"._SEARCHENGINES.": </td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"Robots - Spiders - Buscadores\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"Robots - Spiders - Buscadores\" height=\"$m_size[1]\" width=\"", $bot[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\""._BOTS, "\" /> $bot[1] % ($bot[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/question.gif\" border=\"0\" alt=\"\" />&nbsp;"._UNKNOWN.": </td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"Otros - Desconocidos\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"Otros - Desconocidos\" height=\"$m_size[1]\" width=\"", $b_other[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\""._OTHER, "\" /> $b_other[1] % ($b_other[0])\n";
    echo "</td></tr></table>";
    CloseTable2();
    echo "<br /><br />\n";
    OpenTable2();
    echo "<table cellspacing=\"0\" cellpadding=\"2\" border=\"0\" align=\"center\"><tr><td colspan=\"2\">\n";
    echo "<center><font color=\"$textcolor2\"><strong>"._OPERATINGSYS."</strong></font></center><br /></td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/windows.gif\" border=\"0\" alt=\"\" />&nbsp;Windows:</td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"Windows\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"Windows\" height=\"$m_size[1]\" width=\"", $windows[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"Windows\" /> $windows[1] % ($windows[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/linux.gif\" border=\"0\" alt=\"\" />&nbsp;Linux:</td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"Linux\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"Linux\" height=\"$m_size[1]\" width=\"", $linux[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"Linux\" /> $linux[1] % ($linux[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/mac.gif\" border=\"0\" alt=\"\" />&nbsp;Mac/PPC:</td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"Mac/PPC\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"Mac - PPC\" height=\"$m_size[1]\" width=\"", $mac[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"Mac/PPC\" /> $mac[1] % ($mac[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/bsd.gif\" border=\"0\" alt=\"\" />&nbsp;FreeBSD:</td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"FreeBSD\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"FreeBSD\" height=\"$m_size[1]\" width=\"", $freebsd[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"FreeBSD\" /> $freebsd[1] % ($freebsd[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/sun.gif\" border=\"0\" alt=\"\" />&nbsp;SunOS:</td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"SunOS\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"SunOS\" height=\"$m_size[1]\" width=\"", $sunos[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"SunOS\" /> $sunos[1] % ($sunos[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/irix.gif\" border=\"0\" alt=\"\" />&nbsp;IRIX:</td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"SGI Irix\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"SGI Irix\" height=\"$m_size[1]\" width=\"", $irix[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"SGI Irix\" /> $irix[1] % ($irix[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/be.gif\" border=\"0\" alt=\"\" />&nbsp;BeOS:</td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"BeOS\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"BeOS\" height=\"$m_size[1]\" width=\"", $beos[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"BeOS\" /> $beos[1] % ($beos[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/os2.gif\" border=\"0\" alt=\"\" />&nbsp;OS/2:</td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"OS/2\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"OS/2\" height=\"$m_size[1]\" width=\"", $os2[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"OS/2\" /> $os2[1] % ($os2[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/aix.gif\" border=\"0\" alt=\"\" />&nbsp;AIX:</td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"AIX\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"AIX\" height=\"$m_size[1]\" width=\"", $aix[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"AIX\" /> $aix[1] % ($aix[0])</td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/question.gif\" border=\"0\" alt=\"\" />&nbsp;"._UNKNOWN.":</td><td><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"Otros - Desconocidos\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" alt=\"Otros - Desconocidos\" height=\"$m_size[1]\" width=\"", $os_other[2] * 2, "\" /><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\""._OTHER, "\" /> $os_other[1] % ($os_other[0])\n";
    echo "</td></tr></table>\n";
    CloseTable2();
    echo "<br /><br />\n";

    $unum = $db->sql_numrows($db->sql_query("select user_id from ".$user_prefix."_users"));
    $anum = $db->sql_numrows($db->sql_query("select * from ".$prefix."_authors"));
    $snum = $db->sql_numrows($db->sql_query("select sid from ".$prefix."_stories"));
    $cnum = $db->sql_numrows($db->sql_query("select tid from ".$prefix."_comments"));
    $subnum = $db->sql_numrows($db->sql_query("select * from ".$prefix."_queue"));
    if (is_active("Topics")) {
        $tnum = $db->sql_numrows($db->sql_query("select * from ".$prefix."_topics"));
    }
    if (is_active("Web_Links")) {
        $links = $db->sql_numrows($db->sql_query("select * from ".$prefix."_links_links"));
        $cat = $db->sql_numrows($db->sql_query("select * from ".$prefix."_links_categories"));
    }
    OpenTable2();
    echo "<table cellspacing=\"0\" cellpadding=\"2\" border=\"0\" align=\"center\"><tr><td colspan=\"2\">\n";
    echo "<center><font color=\"$textcolor2\"><strong>"._MISCSTATS."</strong></font></center><br /></td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/users.gif\" border=\"0\" alt=\"\" />&nbsp;"._REGUSERS."</td><td><strong>$unum</strong></td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/authors.gif\" border=\"0\" alt=\"\" />&nbsp;"._ACTIVEAUTHORS."</td><td><strong>$anum</strong></td></tr>\n";
    echo "<tr><td><img src=\"modules/$module_name/images/news.gif\" border=\"0\" alt=\"\" />&nbsp;"._STORIESPUBLISHED."</td><td><strong>$snum</strong></td></tr>\n";
    if (is_active("Topics")) {
        echo "<tr><td><img src=\"modules/$module_name/images/topics.gif\" border=\"0\" alt=\"\" />&nbsp;"._SACTIVETOPICS."</td><td><strong>$tnum</strong></td></tr>\n";
    }
    echo "<tr><td><img src=\"modules/$module_name/images/comments.gif\" border=\"0\" alt=\"\" />&nbsp;"._COMMENTSPOSTED."</td><td><strong>$cnum</strong></td></tr>\n";
    if (is_active("Web_Links")) {
        echo "<tr><td><img src=\"modules/$module_name/images/topics.gif\" border=\"0\" alt=\"\" />&nbsp;"._LINKSINLINKS."</td><td><strong>$links</strong></td></tr>\n";
        echo "<tr><td><img src=\"modules/$module_name/images/sections.gif\" border=\"0\" alt=\"\" />&nbsp;"._LINKSCAT."</td><td><strong>$cat</strong></td></tr>\n";
    }
    echo "<tr><td><img src=\"modules/$module_name/images/waiting.gif\" border=\"0\" alt=\"\" />&nbsp;"._NEWSWAITING."</td><td><strong>$subnum</strong></td></tr>\n";

    echo "</table>\n";
    CloseTable2();
    CloseTable();
    include_once("footer.php");
}

function Stats($total) {
    global $hlpfile, $nowyear, $nowmonth, $nowdate, $nowhour, $sitename, $startdate, $prefix, $db, $now, $module_name;
    $row = $db->sql_query("SELECT count from ".$prefix."_counter order by type desc");
    list($total) = $db->sql_fetchrow($row);
    include_once("header.php");
    title("$sitename "._STATS."");
    $total++;
    OpenTable();
    OpenTable();
    echo "<center><font class=\"option\"><strong>$sitename "._STATS."</strong></font><br /><br />"._WERECEIVED." <strong>$total</strong> "._PAGESVIEWS." $startdate<br />"._TODAYIS.": $now[0]/$now[1]/$now[2]<br /><br />";
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT year, month, hits from ".$prefix."_stats_month order by hits DESC limit 0,1"));
    $year = intval($row2['year']);
    $month = intval($row2['month']);
    $hits = intval($row2['hits']);
    if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _SEPTEMBER;} elseif ($month == 10) {$month = _OCTOBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}
    echo ""._MOSTMONTH.": $month $year ($hits "._HITS.")<br />";
    $row3 = $db->sql_fetchrow($db->sql_query("SELECT year, month, date, hits from ".$prefix."_stats_date order by hits DESC limit 0,1"));
    $year = intval($row3['year']);
    $month = intval($row3['month']);
    $date = intval($row3['date']);
    $hits = intval($row3['hits']);
    if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _SEPTEMBER;} elseif ($month == 10) {$month = _OCTOBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}
    echo ""._MOSTDAY.": $date $month $year ($hits "._HITS.")<br />";
    $row4 = $db->sql_fetchrow($db->sql_query("SELECT year, month, date, hour, hits from ".$prefix."_stats_hour order by hits DESC limit 0,1"));
    $year = intval($row4['year']);
    $month = intval($row4['month']);
    $date = intval($row4['date']);
    $hour = intval($row4['hour']);
    $hits = intval($row4['hits']);
    if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _SEPTEMBER;} elseif ($month == 10) {$month = _OCTOBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}
    if ($hour < 10) {
        $hour = "0$hour:00 - 0$hour:59";
    } else {
        $hour = "$hour:00 - $hour:59";
    }
    echo ""._MOSTHOUR.": $hour "._ON." $month $date, $year ($hits "._HITS.")<br /><br />"
        ."[ <a href=\"modules.php?name=$module_name\">"._RETURNBASICSTATS."</a> ]</center>";

    CloseTable();
    echo "<br /><br />";
    showYearStats($nowyear);
    echo "<br /><br />";
    showMonthStats($nowyear,$nowmonth);
    echo "<br /><br />";
    showDailyStats($nowyear,$nowmonth,$nowdate);
    echo "<br /><br />";
    showHourlyStats($nowyear,$nowmonth,$nowdate);
    echo "<br /><br /><center>"._GOBACK."</center><br /><br />";
    CloseTable();
    include_once("footer.php");
}

function YearlyStats($year){
    global $hlpfile,$nowyear,$nowmonth,$nowdate, $sitename, $module_name;
    include_once("header.php");
    title("$sitename "._STATS."");
    opentable();
    $year = intval($year);
    $nowmonth = intval($nowmonth);
    showMonthStats($year,$nowmonth);
    echo "<br />";
    echo "<center>[ <a href=\"modules.php?name=$module_name\">"._BACKTOMAIN."</a> | <a href=\"modules.php?name=$module_name&amp;op=Stats\">"._BACKTODETSTATS."</a> ]</center>";
    closetable();
    include_once("footer.php");
}

function MonthlyStats($year,$month){
    global $sitename, $module_name, $nowdate;
    include_once("header.php");
    title("$sitename "._STATS."");
    opentable();
    $year = intval($year);
    $month = intval($month);
    $nowdate = intval($nowdate);
    showDailyStats($year,$month,$nowdate);
    echo "<br />";
    echo "<center>[ <a href=\"modules.php?name=$module_name\">"._BACKTOMAIN."</a> | <a href=\"modules.php?name=$module_name&amp;op=Stats\">"._BACKTODETSTATS."</a> ]</center>";
    closetable();
    include_once("footer.php");
}

function DailyStats($year,$month,$date){
    global $sitename, $module_name;
    include_once("header.php");
    title("$sitename "._STATS."");
    opentable();
    $year = intval($year);
    $month = intval($month);
    $date = intval($date);
    showHourlyStats($year,$month,$date);
    echo "<br />";
    echo "<center>[ <a href=\"modules.php?name=$module_name\">"._BACKTOMAIN."</a> | <a href=\"modules.php?name=$module_name&amp;op=Stats\">"._BACKTODETSTATS."</a> ]</center>";
    closetable();
    include_once("footer.php");
}


function showYearStats($nowyear){
    global $db,$prefix,$bgcolor1,$bgcolor2, $ThemeSel, $module_name;
    $l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
    $m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
    $r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
    $resulttotal = $db->sql_query("SELECT sum(hits) as TotalHitsYear from ".$prefix."_stats_year");
    list($TotalHitsYear) = $db->sql_fetchrow($resulttotal);
    $result = $db->sql_query("select year,hits from ".$prefix."_stats_year order by year");
    echo "<center><strong>"._YEARLYSTATS."</strong></center><br />";
    echo "<table align=\"center\" bgcolor=\"#000000\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">";
    echo "<tr><td width=\"25%\" bgcolor=\"$bgcolor2\">"._YEAR."</td><td bgcolor=\"$bgcolor2\">"._SPAGESVIEWS."</td></tr>";
    while($row = $db->sql_fetchrow($result)) {
        $year = intval($row['year']);
        $hits = intval($row['hits']);
        echo "<tr bgcolor=\"$bgcolor1\"><td>";
        if ($year != $nowyear) {
            echo "<a href=\"modules.php?name=$module_name&amp;op=YearlyStats&amp;year=$year\">$year</a>";
        } else {
            echo "$year";
        }
        echo "</td><td>";
        $WidthIMG = round(100 * $hits/$TotalHitsYear,0);
        echo "<img src=\"themes/$ThemeSel/images/leftbar.gif\" alt=\"\" width=\"$l_size[0]\" height=\"$l_size[1]\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" height=\"$m_size[1]\" width=\"",$WidthIMG * 2,"\" alt=\"\" />"
            ."<img src=\"themes/$ThemeSel/images/rightbar.gif\" alt=\"\" width=\"$r_size[0]\" height=\"$r_size[1]\" /> ($hits)</td></tr>";
    }
    echo "</table>";
}

function showMonthStats($nowyear,$nowmonth){
    global $prefix,$bgcolor1,$bgcolor2,$db, $ThemeSel, $module_name;
    $l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
    $m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
    $r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
    $resultmonth = $db->sql_query("SELECT sum(hits) as TotalHitsMonth from ".$prefix."_stats_month where year='$nowyear'");
    list($TotalHitsMonth) = $db->sql_fetchrow($resultmonth);
    $result = $db->sql_query("select month,hits from ".$prefix."_stats_month where year='$nowyear'");
    echo "<center><strong>"._MONTHLYSTATS." $nowyear</strong></center><br />";
    echo "<table align=\"center\" bgcolor=\"#000000\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">";
    echo "<tr><td width=\"25%\" bgcolor=\"$bgcolor2\">"._UMONTH."</td><td bgcolor=\"$bgcolor2\">"._SPAGESVIEWS."</td></tr>";
    while($row = $db->sql_fetchrow($result)) {
        $month = intval($row['month']);
        $hits = intval($row['hits']);
        echo "<tr bgcolor=\"$bgcolor1\"><td>";
        if ($month != $nowmonth) {
            echo "<a href=\"modules.php?name=$module_name&amp;op=MonthlyStats&amp;year=$nowyear&amp;month=$month\" class=\"hover_orange\">";
            getmonth($month);
            echo "</a>";
        } else {
            getmonth($month);
        }
        echo "</td><td>";
        $WidthIMG = round(100 * $hits/$TotalHitsMonth,0);
        echo "<img src=\"themes/$ThemeSel/images/leftbar.gif\" alt=\"\" width=\"$l_size[0]\" height=\"$l_size[1]\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" height=\"$m_size[1]\" width=\"",$WidthIMG * 2,"\" alt=\"\" />";
        echo "<img src=\"themes/$ThemeSel/images/rightbar.gif\" alt=\"\" width=\"$r_size[0]\" height=\"$r_size[1]\" /> ($hits)";
        echo "</td></tr>";
    }
    echo "</table>";
}

function showDailyStats($year,$month,$nowdate){
    global $prefix,$bgcolor1,$bgcolor2,$db, $ThemeSel, $module_name;
    $l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
    $m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
    $r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
    $resulttotal = $db->sql_query("SELECT sum(hits) as TotalHitsDate from ".$prefix."_stats_date where year='$year' and month='$month'");
    list($TotalHitsDate) = $db->sql_fetchrow($resulttotal);
    $result = $db->sql_query("select year,month,date,hits from ".$prefix."_stats_date where year='$year' and month='$month' order by date");
    $total = $db->sql_numrows($result);
    echo "<center><strong>"._DAILYSTATS." ";
    getmonth($month);
    echo ", $year</strong></center><br />";
    echo "<table align=\"center\" bgcolor=\"#000000\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">";
    echo "<tr><td width=\"25%\" bgcolor=\"$bgcolor2\">"._DATE."</td><td bgcolor=\"$bgcolor2\">"._SPAGESVIEWS."</td></tr>";
    while($row = $db->sql_fetchrow($result)) {
        $year = intval($row['year']);
        $month = intval($row['month']);
        $date = intval($row['date']);
        $hits = intval($row['hits']);
        echo "<tr bgcolor=\"$bgcolor1\"><td>";
        if ($date != $nowdate) {
            echo "<a href=\"modules.php?name=$module_name&amp;op=DailyStats&amp;year=$year&amp;month=$month&amp;date=$date\" class=\"hover_orange\">";
            echo $date;
            echo "</a>";
        } else {
            echo $date;
        }
        echo "</td><td>";
        if ($hits == 0) {
            $WidthIMG = 0;
            $d_percent = 0;
        } else {
            $WidthIMG = round(100 * $hits/$TotalHitsDate,0);
            $d_percent = substr(100 * $hits / $TotalHitsDate, 0, 5);
        }
        echo "<img src=\"themes/$ThemeSel/images/leftbar.gif\" alt=\"\" width=\"$l_size[0]\" height=\"$l_size[1]\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" height=\"$m_size[1]\" width=\"",$WidthIMG * 2,"\" alt=\"\" />"
        ."<img src=\"themes/$ThemeSel/images/rightbar.gif\" alt=\"\" width=\"$r_size[0]\" height=\"$r_size[1]\" /> $d_percent% ($hits)"
        ."</td></tr>";
    }
    echo "</table>";
}

function showHourlyStats($year,$month,$date){
    global $prefix,$bgcolor1,$bgcolor2,$db, $ThemeSel;
    $l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
    $m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
    $r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
    $resulttotal = $db->sql_query("SELECT sum(hits) as TotalHitsHour from ".$prefix."_stats_hour where year='$year' and month='$month' and date='$date'");
    list($TotalHitsHour) = $db->sql_fetchrow($resulttotal);
    $nowdate = date("d-m-Y");
    $nowdate_arr = explode("-",$nowdate);
    echo "<center><strong>"._HOURLYSTATS." ";
    echo getmonth($month)." ".$date.", " .$year."</strong></center><br />";
    echo "<table align=\"center\" bgcolor=\"#000000\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">";
    echo "<tr><td width=\"25%\" bgcolor=\"$bgcolor2\">"._HOUR."</td><td bgcolor=\"$bgcolor2\" width=\"70%\">"._SPAGESVIEWS."</td></tr>";
    for ($k = 0;$k<=23;$k++) {
        $result = $db->sql_query("select hour,hits from ".$prefix."_stats_hour where year='$year' and month='$month' and date='$date' and hour='$k'");
        if ($db->sql_numrows($result) == 0){
            $hits=0;
        } else {
            $row = $db->sql_fetchrow($result);
            $hour = intval($row['hour']);
            $hits = intval($row['hits']);
        }
        echo "<tr><td bgcolor=\"$bgcolor1\">";
        if ($k < 10) {
            $a = "0$k";
        } else {
            $a = $k;
        }
        echo "$a:00 - $a:59";
        $a = "";
        echo "</td><td bgcolor=\"$bgcolor1\">";
        if ($hits == 0) {
            $WidthIMG = 0;
            $d_percent = 0;
        } else {
            $WidthIMG = round(100 * $hits/$TotalHitsHour,0);
            $d_percent = substr(100 * $hits / $TotalHitsHour, 0, 5);
        }
        echo "<img src=\"themes/$ThemeSel/images/leftbar.gif\" alt=\"\" width=\"$l_size[0]\" height=\"$l_size[1]\" /><img src=\"themes/$ThemeSel/images/mainbar.gif\" height=\"$m_size[1]\" width=\"",$WidthIMG * 2,"\" alt=\"\" />"
            ."<img src=\"themes/$ThemeSel/images/rightbar.gif\" alt=\"\" width=\"$r_size[0]\" height=\"$r_size[1]\" /> $d_percent% ($hits)"
            ."</td></tr>";
    }
    echo "</table>";
}

function getmonth($month){
    if ($month == 1) echo _JANUARY;
    if ($month == 2) echo _FEBRUARY;
    if ($month == 3) echo _MARCH;
    if ($month == 4) echo _APRIL;
    if ($month == 5) echo _MAY;
    if ($month == 6) echo _JUNE;
    if ($month == 7) echo _JULY;
    if ($month == 8) echo _AUGUST;
    if ($month == 9) echo _SEPTEMBER;
    if ($month == 10) echo _OCTOBER;
    if ($month == 11) echo _NOVEMBER;
    if ($month == 12) echo _DECEMBER;
}

?>

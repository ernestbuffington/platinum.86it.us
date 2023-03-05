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
define('FBACKEND_MAXPOSTS', 15); //Set this to the maximum posts which should ever be allowed
define('FBACKEND_MAXPOSTSIZE', 500); //Set this to the maximum size of the text to show
////////////////////////////////////////////////////////
//You should not have to change anything below this line
////////////////////////////////////////////////////////
include_once('mainfile.php');
//Get and cleanse any input
$fid = isset($_GET['fid']) ? intval($_GET['fid']) : 0;
$rssFeedLimit = isset($_GET['rssFeedLimit']) ? intval($_GET['rssFeedLimit']) : FBACKEND_MAXPOSTS;
if ($rssFeedLimit > FBACKEND_MAXPOSTS) $rssFeedLimit = FBACKEND_MAXPOSTS;
header('Content-Type: application/xml;charset=iso-8859-1');
echo makeBackendForumRSS($fid,$rssFeedLimit);
// Only functions below this line
function makeBackendForumRSS($fid,$rssFeedLimit) {
    global $db, $nukeurl, $prefix, $backend_language, $sitename, $adminemail, $backend_title;
    $whereClause = '';
    $counter = 0;
    $xmlHeader = '';
    $xmlBody = '';
    $xmlFooter = '';
    $nukeurl = htmlspecialchars($nukeurl);
    $addForumName = FALSE;
    if ($fid) {
        $whereClause  = 'AND forum_id=\''.$fid.'\' ';
        $addForumName = TRUE;
    }
    $gmtdiff = date('O', time());
    $gmtstr = substr($gmtdiff, 0, 3) . ':' . substr($gmtdiff, 3, 9);
    $now = date('Y-m-d\TH:i:s', time());
    $now = $now . $gmtstr;
    $xmlHeader .= '<?xml version="1.0" encoding="iso-8859-1"?>'."\n";
    $xmlHeader .= '<rss version="2.0" '."\n";
    $xmlHeader .= '  xmlns:dc="http://purl.org/dc/elements/1.1/"'."\n";
    $xmlHeader .= '  xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"'."\n";
    $xmlHeader .= '  xmlns:admin="http://webns.net/mvcb/"'."\n";
    $xmlHeader .= '  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">'."\n\n";
    $xmlHeader .= '<channel>'."\n";
    $xmlHeader .= '<title>'.entity_to_decimal_value($sitename).' - Forums%%_NAME_%%</title>'."\n";
    $xmlHeader .= '<link>'.$nukeurl.'/modules.php?name=Forums</link>'."\n";
    $xmlHeader .= '<description>'.htmlspecialchars($backend_title).'</description>'."\n";
    $xmlHeader .= '<dc:language>'.$backend_language.'</dc:language>'."\n";
    $xmlHeader .= '<dc:creator>'.$adminmail.'</dc:creator>'."\n";
    $xmlHeader .= '<dc:date>'.$now.'</dc:date>'."\n\n";
    $xmlHeader .= '<sy:updatePeriod>hourly</sy:updatePeriod>'."\n";
    $xmlHeader .= '<sy:updateFrequency>1</sy:updateFrequency>'."\n";
    $xmlHeader .= '<sy:updateBase>'.$now.'</sy:updateBase>'."\n\n";
    $sql = 'SELECT topic_id, a.forum_id as forum_id, topic_last_post_id, topic_title, topic_moved_id, '
        .'forum_name, post_text FROM '.$prefix.'_bbtopics a, '.$prefix.'_bbforums b, '.$prefix.'_bbposts_text c '
        .'WHERE a.forum_id = b.forum_id AND a.topic_last_post_id = c.post_id '.$whereClause.'ORDER BY topic_last_post_id DESC';
    $result = $db->sql_query($sql);
    if (mysql_error()) die('MySQL said: '.mysql_error());
    while (list($topic_id, $forum_id, $topic_last_post_id, $topic_title, $topic_moved_id, $forum_name, $post_text) = $db->sql_fetchrow($result)) {
        $result1 = $db->sql_query('SELECT auth_view, auth_read, forum_name, cat_id FROM '.$prefix.'_bbforums where forum_id = \''.$forum_id.'\'');
        list($auth_view, $auth_read, $forum_name, $cat_id) = $db->sql_fetchrow($result1);
        if (($auth_view != 0) or ($auth_read != 0)) continue;
        if ($topic_moved_id != 0) continue;
        ++$counter;
        $result3 = $db->sql_query('SELECT topic_id, post_time, username, user_id FROM '.$prefix.'_bbposts,' .$prefix.'_users where post_id=\''.$topic_last_post_id.'\' AND user_id=poster_id Limit 1');
        list($topic_id, $post_time, $username, $user_id) = $db->sql_fetchrow($result3);
        $rtitle = entity_to_decimal_value($topic_title);
        $rtitle = entity_to_decimal_value(str_replace('_',' ',$rtitle)); //added 9/1/2004
        // format: 2004-08-02T12:15:23-06:00
        $date = date('Y-m-d\TH:i:s', $post_time);
        $date = $date . $gmtstr;
        //Strip bbcode from the post_text and chop to the requested max size
        $post_text = preg_replace('/\[(.*?)\](.*?)\[\/(.*?)\]/s','$2', strip_tags($post_text));
        $iStrLen = strlen($post_text);
        $iStrLen = ($iStrLen > FBACKEND_MAXPOSTSIZE) ? FBACKEND_MAXPOSTSIZE : $iStrLen;
        $post_text = substr($post_text, 0, $iStrLen);
        $xmlBody .= '<item>'."\n";
        $xmlBody .= '<title>'.$rtitle.'</title>'."\n";
        $xmlBody .= '<link>'.$nukeurl.'/modules.php?name=Forums&amp;file=viewtopic&amp;p='.$topic_last_post_id.'#'.$topic_last_post_id.'</link>'."\n";
        $xmlBody .= '<description><![CDATA['.entity_to_decimal_value($post_text).']]></description>'."\n";
        $xmlBody .= '<guid isPermaLink="false">'.$topic_id.'@'.$nukeurl.'</guid>'."\n";
        $xmlBody .= '<dc:subject>'.$forum_name.'</dc:subject>'."\n";
        $xmlBody .= '<dc:date>'.$date.'</dc:date>'."\n";
        $xmlBody .= '<dc:creator>Posted by '.$username.'</dc:creator>';
        $xmlBody .= '</item>'."\n";
        if ($counter==$rssFeedLimit) break;
    }
    $xmlFooter .= '</channel>'."\n";
    $xmlFooter .= '</rss>'."\n";
    if ($addForumName) $xmlHeader = str_replace('%%_NAME_%%',': '.$forum_name,$xmlHeader);
    else $xmlHeader = str_replace('%%_NAME_%%','',$xmlHeader);
    return $xmlHeader.$xmlBody.$xmlFooter;
}
/* entity to unicode decimal value */
function entity_to_decimal_value($string){
  $entity_to_decimal = array(
    '&nbsp;' => '&#160;',
    '&iexcl;' => '&#161;',
    '&cent;' => '&#162;',
    '&pound;' => '&#163;',
    '&curren;' => '&#164;',
    '&yen;' => '&#165;',
    '&brvbar;' => '&#166;',
    '&sect;' => '&#167;',
    '&uml;' => '&#168;',
    '&copy;' => '&#169;',
    '&ordf;' => '&#170;',
    '&laquo;' => '&#171;',
    '&not;' => '&#172;',
    '&shy;' => '&#173;',
    '&reg;' => '&#174;',
    '&macr;' => '&#175;',
    '&deg;' => '&#176;',
    '&plusmn;' => '&#177;',
    '&sup2;' => '&#178;',
    '&sup3;' => '&#179;',
    '&acute;' => '&#180;',
    '&micro;' => '&#181;',
    '&para;' => '&#182;',
    '&middot;' => '&#183;',
    '&cedil;' => '&#184;',
    '&sup1;' => '&#185;',
    '&ordm;' => '&#186;',
    '&raquo;' => '&#187;',
    '&frac14;' => '&#188;',
    '&frac12;' => '&#189;',
    '&frac34;' => '&#190;',
    '&iquest;' => '&#191;',
    '&Agrave;' => '&#192;',
    '&Aacute;' => '&#193;',
    '&Acirc;' => '&#194;',
    '&Atilde;' => '&#195;',
    '&Auml;' => '&#196;',
    '&Aring;' => '&#197;',
    '&AElig;' => '&#198;',
    '&Ccedil;' => '&#199;',
    '&Egrave;' => '&#200;',
    '&Eacute;' => '&#201;',
    '&Ecirc;' => '&#202;',
    '&Euml;' => '&#203;',
    '&Igrave;' => '&#204;',
    '&Iacute;' => '&#205;',
    '&Icirc;' => '&#206;',
    '&Iuml;' => '&#207;',
    '&ETH;' => '&#208;',
    '&Ntilde;' => '&#209;',
    '&Ograve;' => '&#210;',
    '&Oacute;' => '&#211;',
    '&Ocirc;' => '&#212;',
    '&Otilde;' => '&#213;',
    '&Ouml;' => '&#214;',
    '&times;' => '&#215;',
    '&Oslash;' => '&#216;',
    '&Ugrave;' => '&#217;',
    '&Uacute;' => '&#218;',
    '&Ucirc;' => '&#219;',
    '&Uuml;' => '&#220;',
    '&Yacute;' => '&#221;',
    '&THORN;' => '&#222;',
    '&szlig;' => '&#223;',
    '&agrave;' => '&#224;',
    '&aacute;' => '&#225;',
    '&acirc;' => '&#226;',
    '&atilde;' => '&#227;',
    '&auml;' => '&#228;',
    '&aring;' => '&#229;',
    '&aelig;' => '&#230;',
    '&ccedil;' => '&#231;',
    '&egrave;' => '&#232;',
    '&eacute;' => '&#233;',
    '&ecirc;' => '&#234;',
    '&euml;' => '&#235;',
    '&igrave;' => '&#236;',
    '&iacute;' => '&#237;',
    '&icirc;' => '&#238;',
    '&iuml;' => '&#239;',
    '&eth;' => '&#240;',
    '&ntilde;' => '&#241;',
    '&ograve;' => '&#242;',
    '&oacute;' => '&#243;',
    '&ocirc;' => '&#244;',
    '&otilde;' => '&#245;',
    '&ouml;' => '&#246;',
    '&divide;' => '&#247;',
    '&oslash;' => '&#248;',
    '&ugrave;' => '&#249;',
    '&uacute;' => '&#250;',
    '&ucirc;' => '&#251;',
    '&uuml;' => '&#252;',
    '&yacute;' => '&#253;',
    '&thorn;' => '&#254;',
    '&yuml;' => '&#255;',
    '&fnof;' => '&#402;',
    '&Alpha;' => '&#913;',
    '&Beta;' => '&#914;',
    '&Gamma;' => '&#915;',
    '&Delta;' => '&#916;',
    '&Epsilon;' => '&#917;',
    '&Zeta;' => '&#918;',
    '&Eta;' => '&#919;',
    '&Theta;' => '&#920;',
    '&Iota;' => '&#921;',
    '&Kappa;' => '&#922;',
    '&Lambda;' => '&#923;',
    '&Mu;' => '&#924;',
    '&Nu;' => '&#925;',
    '&Xi;' => '&#926;',
    '&Omicron;' => '&#927;',
    '&Pi;' => '&#928;',
    '&Rho;' => '&#929;',
    '&Sigma;' => '&#931;',
    '&Tau;' => '&#932;',
    '&Upsilon;' => '&#933;',
    '&Phi;' => '&#934;',
    '&Chi;' => '&#935;',
    '&Psi;' => '&#936;',
    '&Omega;' => '&#937;',
    '&alpha;' => '&#945;',
    '&beta;' => '&#946;',
    '&gamma;' => '&#947;',
    '&delta;' => '&#948;',
    '&epsilon;' => '&#949;',
    '&zeta;' => '&#950;',
    '&eta;' => '&#951;',
    '&theta;' => '&#952;',
    '&iota;' => '&#953;',
    '&kappa;' => '&#954;',
    '&lambda;' => '&#955;',
    '&mu;' => '&#956;',
    '&nu;' => '&#957;',
    '&xi;' => '&#958;',
    '&omicron;' => '&#959;',
    '&pi;' => '&#960;',
    '&rho;' => '&#961;',
    '&sigmaf;' => '&#962;',
    '&sigma;' => '&#963;',
    '&tau;' => '&#964;',
    '&upsilon;' => '&#965;',
    '&phi;' => '&#966;',
    '&chi;' => '&#967;',
    '&psi;' => '&#968;',
    '&omega;' => '&#969;',
    '&thetasym;' => '&#977;',
    '&upsih;' => '&#978;',
    '&piv;' => '&#982;',
    '&bull;' => '&#8226;',
    '&hellip;' => '&#8230;',
    '&prime;' => '&#8242;',
    '&Prime;' => '&#8243;',
    '&oline;' => '&#8254;',
    '&frasl;' => '&#8260;',
    '&weierp;' => '&#8472;',
    '&image;' => '&#8465;',
    '&real;' => '&#8476;',
    '&trade;' => '&#8482;',
    '&alefsym;' => '&#8501;',
    '&larr;' => '&#8592;',
    '&uarr;' => '&#8593;',
    '&rarr;' => '&#8594;',
    '&darr;' => '&#8595;',
    '&harr;' => '&#8596;',
    '&crarr;' => '&#8629;',
    '&lArr;' => '&#8656;',
    '&uArr;' => '&#8657;',
    '&rArr;' => '&#8658;',
    '&dArr;' => '&#8659;',
    '&hArr;' => '&#8660;',
    '&forall;' => '&#8704;',
    '&part;' => '&#8706;',
    '&exist;' => '&#8707;',
    '&empty;' => '&#8709;',
    '&nabla;' => '&#8711;',
    '&isin;' => '&#8712;',
    '&notin;' => '&#8713;',
    '&ni;' => '&#8715;',
    '&prod;' => '&#8719;',
    '&sum;' => '&#8721;',
    '&minus;' => '&#8722;',
    '&lowast;' => '&#8727;',
    '&radic;' => '&#8730;',
    '&prop;' => '&#8733;',
    '&infin;' => '&#8734;',
    '&ang;' => '&#8736;',
    '&and;' => '&#8743;',
    '&or;' => '&#8744;',
    '&cap;' => '&#8745;',
    '&cup;' => '&#8746;',
    '&int;' => '&#8747;',
    '&there4;' => '&#8756;',
    '&sim;' => '&#8764;',
    '&cong;' => '&#8773;',
    '&asymp;' => '&#8776;',
    '&ne;' => '&#8800;',
    '&equiv;' => '&#8801;',
    '&le;' => '&#8804;',
    '&ge;' => '&#8805;',
    '&sub;' => '&#8834;',
    '&sup;' => '&#8835;',
    '&nsub;' => '&#8836;',
    '&sube;' => '&#8838;',
    '&supe;' => '&#8839;',
    '&oplus;' => '&#8853;',
    '&otimes;' => '&#8855;',
    '&perp;' => '&#8869;',
    '&sdot;' => '&#8901;',
    '&lceil;' => '&#8968;',
    '&rceil;' => '&#8969;',
    '&lfloor;' => '&#8970;',
    '&rfloor;' => '&#8971;',
    '&lang;' => '&#9001;',
    '&rang;' => '&#9002;',
    '&loz;' => '&#9674;',
    '&spades;' => '&#9824;',
    '&clubs;' => '&#9827;',
    '&hearts;' => '&#9829;',
    '&diams;' => '&#9830;',
    '&quot;' => '&#34;',
    '&amp;' => '&#38;',
    '&lt;' => '&#60;',
    '&gt;' => '&#62;',
    '&OElig;' => '&#338;',
    '&oelig;' => '&#339;',
    '&Scaron;' => '&#352;',
    '&scaron;' => '&#353;',
    '&Yuml;' => '&#376;',
    '&circ;' => '&#710;',
    '&tilde;' => '&#732;',
    '&ensp;' => '&#8194;',
    '&emsp;' => '&#8195;',
    '&thinsp;' => '&#8201;',
    '&zwnj;' => '&#8204;',
    '&zwj;' => '&#8205;',
    '&lrm;' => '&#8206;',
    '&rlm;' => '&#8207;',
    '&ndash;' => '&#8211;',
    '&mdash;' => '&#8212;',
    '&lsquo;' => '&#8216;',
    '&rsquo;' => '&#8217;',
    '&sbquo;' => '&#8218;',
    '&ldquo;' => '&#8220;',
    '&rdquo;' => '&#8221;',
    '&bdquo;' => '&#8222;',
    '&dagger;' => '&#8224;',
    '&Dagger;' => '&#8225;',
    '&permil;' => '&#8240;',
    '&lsaquo;' => '&#8249;',
    '&rsaquo;' => '&#8250;',
    '&euro;' => '&#8364;');
  return preg_replace(
    '/&[A-Za-z]+;/',
    ' ',
    strtr($string,$entity_to_decimal) );
}
?>

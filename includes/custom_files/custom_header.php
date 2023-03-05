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
/* 
   This file is to customize whatever stuff you need to include in your site 
   when the header loads. This can be used for third party banners, custom
   javascript, popup windows, etc. With this file you don't need to edit 
   system code each time you upgrade to a new version. Just remember, in case
   you add code here to not overwrite this file when updating!
   Whatever you put here will be between <head> and </head> tags.
*/

// Start Who is where / Début Qui est ou
	global $user, $cookie, $prefix, $db, $name;
	cookiedecode($user);
    $ip = $_SERVER["REMOTE_ADDR"];
	$url = $_SERVER["REQUEST_URI"];
    $uname = $cookie[1];
    if (!isset($uname)) {
        $uname = "$ip";
        $guest = 1;
	$httphost=gethostbyaddr($ip);

// debut robots code aidé par le script robotstats
$detecte = false;

if ( strstr(substr("$ip", 0, strlen("216.239.46.")), "216.239.46.") !== false )
{
$uname = "Google-$ip";
}
else if ( strstr(substr("$ip", 0, strlen("64.68.8")), "64.68.8") !== false )
{
$uname = "Google-$ip";
}
else if ( strstr(substr("$ip", 0, strlen("66.77.73.")), "66.77.73.") !== false )
{
$uname = "Fast-$ip";
}
else if ( strstr(substr("$ip", 0, strlen("216.35.116.")), "216.35.116.") !== false )
{
$uname = "Inktomi-$ip";
}
else if ( strstr(substr("$ip", 0, strlen("66.237.60.")), "66.237.60.") !== false )
{
$uname = "OpenFind-$ip";
}
else if ( strstr(substr("$ip", 0, strlen("131.107.")), "131.107.") !== false )
{
$uname = "MsnBot-$ip";
}
  
else if (stristr("$httphost", "Pompos") !== false)
{
$uname = "Pompos-$ip";
}
else if (stristr("$httphost", "ia_archiver") !== false)
{
$uname = "Alexa-$ip";
}
else if (stristr("$httphost", "Mercator") !== false)
{
$uname = "Mercator (Altavista)-$ip";
}
else if (stristr("$httphost", "Scooter") !== false)
{
$uname = "Scooter (Altavista)-$ip";
}
else if (stristr("$httphost", "SlySearch") !== false)
{
$uname = "SlySearch-$ip";
}
else if (stristr("$httphost", "ASPseek") !== false)
{
$uname = "ASP seek-$ip";
}
else if (stristr("$httphost", "http://www.almaden.ibm.com/cs/crawler") !== false)
{
$uname = "Almaden-$ip";
}
else if (stristr("$httphost", "Ask Jeeves") !== false)
{
$uname = "Ask Jeeves-$ip";
}
else if (stristr("$httphost", "Googlebot-Image") !== false)
{
$uname = "Googlebot-Image-$ip";
}
else if (stristr("$httphost", "TurnitinBot") !== false)
{
$uname = "Turnitin-$ip";
}
else if (stristr("$httphost", "VoilaBot") !== false)
{
$uname = "VoilaBot-$ip";
}
else if (stristr("$httphost", "ZyBorg") !== false)
{
$uname = "ZyBorg (WiseNut)-$ip";
}
else if (stristr("$httphost", "DeepIndex") !== false)
{
$uname = "DeepIndex-$ip";
}
else if (stristr("$httphost", "exabot") !== false)
{
$uname = "Exabot-$ip";
}
else if (stristr("$httphost", "ZBot") !== false)
{
$uname = "Zeus-$ip";
}
else if (stristr("$httphost", "xcrawler@cosmos.inria.fr") !== false)
{
$uname = "Inria-$ip";
}
else if (stristr("$httphost", "Xenu Link Sleuth") !== false)
{
$uname = "Xenu-$ip";
}
else if (stristr("$httphost", "WWWOFFLE") !== false)
{
$uname = "WWWOffle-$ip";
}
else if (stristr("$httphost", "WiseWire-Spider") !== false)
{
$uname = "WiseWire-Spider-$ip";
}
else if (stristr("$httphost", "WISEbot") !== false)
{
$uname = "Wisenut - Korea-$ip";
}
else if (stristr("$httphost", "Willow Internet Crawler by Twotrees") !== false)
{
$uname = "TwoTrees-$ip";
}
else if (stristr("$httphost", "whatUseek") !== false)
{
$uname = "What U Seek-$ip";
}
else if (stristr("$httphost", "WebZIP") !== false)
{
$uname = "WebZip-$ip";
}
else if (stristr("$httphost", "WebTrends") !== false)
{
$uname = "WebTrends-$ip";
}
else if (stristr("$httphost", "WebStripper") !== false)
{
$uname = "Web Stripper-$ip";
}
else if (stristr("$httphost", "Webspinne") !== false)
{
$uname = "WebSpinne-$ip";
}
else if (stristr("$httphost", "WebReaper") !== false)
{
$uname = "WebReaper-$ip";
}
else if (stristr("$httphost", "Web Image Collector") !== false)
{
$uname = "Web Image Collector-$ip";
}
else if (stristr("$httphost", "WebCopier") !== false)
{
$uname = "WebCopier-$ip";
}
else if (stristr("$httphost", "WebCompass") !== false)
{
$uname = "WebCompass-$ip";
}
else if (stristr("$httphost", "webbandit") !== false)
{
$uname = "webbandit-$ip";
}
else if (stristr("$httphost", "WDG_Validator") !== false)
{
$uname = "WDG-$ip";
}
else if (stristr("$httphost", "W3C_Validator") !== false)
{
$uname = "W3C-$ip";
}
else if (stristr("$httphost", "vspider") !== false)
{
$uname = "VSpider-$ip";
}
else if (stristr("$httphost", "UtilMind HTTPGet") !== false)
{
$uname = "WebThief-$ip";
}
else if (stristr("$httphost", "URLGetFile") !== false)
{
$uname = "URLGetFile-$ip";
}
else if (stristr("$httphost", "Ultraseek") !== false)
{
$uname = "Infoseek-$ip";
}
else if (stristr("$httphost", "tricosMetaCheck") !== false)
{
$uname = "Tricos-$ip";
}
else if (stristr("$httphost", "Trampelpfad-Spider") !== false)
{
$uname = "Trampelpfad-$ip";
}
else if (stristr("$httphost", "Toutatis") !== false)
{
$uname = "Hoppa-$ip";
}
else if (stristr("$httphost", "TJG/Spider") !== false)
{
$uname = "TJGroup-$ip";
}
else if (stristr("$httphost", "tivraSpider") !== false)
{
$uname = "Tivra-$ip";
}
else if (stristr("$httphost", "teomaagent") !== false)
{
$uname = "Teoma-$ip";
}
else if (stristr("$httphost", "Szukacz") !== false)
{
$uname = "Szukacz-$ip";
}
else if (stristr("$httphost", "SyncIT") !== false)
{
$uname = "SyncIT-$ip";
}
else if (stristr("$httphost", "suzuran") !== false)
{
$uname = "Yokogao-$ip";
}
else if (stristr("$httphost", "SurferF") !== false)
{
$uname = "Wanadoo-$ip";
}
else if (stristr("$httphost", "Spinne") !== false)
{
$uname = "Spider.de-$ip";
}
else if (stristr("$httphost", "speedfind ramBot xtreme") !== false)
{
$uname = "Speedfind-$ip";
}
else if (stristr("$httphost", "SlySearch") !== false)
{
$uname = "SlySearch-$ip";
}
else if (stristr("$httphost", "Slider_Search") !== false)
{
$uname = "Slider-$ip";
}
else if (stristr("$httphost", "sitecheck.internetseer.com") !== false)
{
$uname = "Internetseer-$ip";
}
else if (stristr("$httphost", "SearchExpress Spider") !== false)
{
$uname = "Searchexpress-$ip";
}
else if (stristr("$httphost", "search.ch") !== false)
{
$uname = "Search.ch-$ip";
}
else if (stristr("$httphost", "Search+") !== false)
{
$uname = "URLSearch+-$ip";
}
else if (stristr("$httphost", "PlantyNet_WebRobot") !== false)
{
$uname = "PlantyNet-$ip";
}
else if (stristr("$httphost", "PJspider") !== false)
{
$uname = "PortalJuice-$ip";
}
else if (stristr("$httphost", "PingALink Monitoring Services") !== false)
{
$uname = "PingALink-$ip";
}
else if (stristr("$httphost", "PicoSearch") !== false)
{
$uname = "Pico-$ip";
}
else if (stristr("$httphost", "ParaSite") !== false)
{
$uname = "IANett-$ip";
}
else if (stristr("$httphost", "Oracle Ultra Search") !== false)
{
$uname = "Oracle Search-$ip";
}
else if (stristr("$httphost", "OpenTextSiteCrawler") !== false)
{
$uname = "OpenText-$ip";
}
else if (stristr("$httphost", "nttdirectory_robot") !== false)
{
$uname = "NTT Dir-$ip";
}
else if (stristr("$httphost", "Nokia-WAPToolkit/1.2 googlebot(at)googlebot.com") !== false)
{
$uname = "Google WAP-$ip";
}
else if (stristr("$httphost", "Nocilla") !== false)
{
$uname = "Telefonica(es)-$ip";
}
else if (stristr("$httphost", "Noago Spider") !== false)
{
$uname = "Noago-$ip";
}
else if (stristr("$httphost", "NICO") !== false)
{
$uname = "NICO Zone-$ip";
}
else if (stristr("$httphost", "NetZippy") !== false)
{
$uname = "NetZippy-$ip";
}
else if (stristr("$httphost", "Netprospector JavaCrawler") !== false)
{
$uname = "Netprospector-$ip";
}
else if (stristr("$httphost", "NetMechanic") !== false)
{
$uname = "NetMechanic-$ip";
}
else if (stristr("$httphost", "NetAnts") !== false)
{
$uname = "NetAnts-$ip";
}
else if (stristr("$httphost", "NEC Research Agent -- compuman at research.nj.nec.com") !== false)
{
$uname = "NEC-$ip";
}
else if (stristr("$httphost", "NationalDirectory-WebSpider") !== false)
{
$uname = "NationalDirectory-$ip";
}
else if (stristr("$httphost", "NABOT") !== false)
{
$uname = "Korea Telekom-$ip";
}
else if (stristr("$httphost", "MyGetRight") !== false)
{
$uname = "GetRight-$ip";
}
else if (stristr("$httphost", "eidetica.com/spider)") !== false)
{
$uname = "Eidetica-$ip";
}
else if (stristr("$httphost", "Sleek Spider") !== false)
{
$uname = "ASI-$ip";
}
else if (stristr("$httphost", "QXW03018") !== false)
{
$uname = "Wespe.de-$ip";
}
else if (stristr("$httphost", "www.galaxy.com") !== false)
{
$uname = "Galaxy-$ip";
}
else if (stristr("$httphost", "TrueRobot") !== false)
{
$uname = "Echo.com-$ip";
}
else if (stristr("$httphost", "FDSE robot") !== false)
{
$uname = "Abador-$ip";
}
else if (stristr("$httphost", "Advanced Email Extractor") !== false)
{
$uname = "Advanced Email Extractor-$ip";
}
else if (stristr("$httphost", "Links2Go Similarity Engine") !== false)
{
$uname = "Links2GO-$ip";
}
else if (stristr("$httphost", "webagent@wise-guys.nl") !== false)
{
$uname = "WiseGuys-$ip";
}
else if (stristr("$httphost", "Slurp.so/Goo") !== false)
{
$uname = "GOO.jp-$ip";
}
else if (stristr("$httphost", "Web Link Validator") !== false)
{
$uname = "Web Link Validator-$ip";
}
else if (stristr("$httphost", "MuscatFerret") !== false)
{
$uname = "Euroferret-$ip";
}
else if (stristr("$httphost", "Fluffy the spider") !== false)
{
$uname = "SearchHippo-$ip";
}
else if (stristr("$httphost", "Check&Get") !== false)
{
$uname = "Check&Get-$ip";
}
else if (stristr("$httphost", "T-H-U-N-D-E-R-S-T-O-N-E") !== false)
{
$uname = "Thunderstone-$ip";
}
else if (stristr("$httphost", "NEWT ActiveX") !== false)
{
$uname = "WebCollector-$ip";
}
else if (stristr("$httphost", "EZResult -- Internet Search Engine") !== false)
{
$uname = "DirectHit-$ip";
}
else if (stristr("$httphost", "somewhere.com") !== false)
{
$uname = "SomeWhere.com-$ip";
}
else if (stristr("$httphost", "MediaSearch") !== false)
{
$uname = "WWW.fi-$ip";
}
else if (stristr("$httphost", "Mata Hari") !== false)
{
$uname = "Lexibot-$ip";
}
else if (stristr("$httphost", "Marvin") !== false)
{
$uname = "Marvin-$ip";
}
else if (stristr("$httphost", "Kolibri gncwebbot") !== false)
{
$uname = "Kolibri-$ip";
}
else if (stristr("$httphost", "MantraAgent") !== false)
{
$uname = "LookSmart-$ip";
}
else if (stristr("$httphost", "Lycos_Spider_(modspider)") !== false)
{
$uname = "LycosSpider (mod_spider)-$ip";
}
else if (stristr("$httphost", "Lycos_Spider_(T-Rex)") !== false)
{
$uname = "Lycos Spider (T-Rex)-$ip";
}
else if (stristr("$httphost", "lwp-trivial") !== false)
{
$uname = "Search4Free-$ip";
}
else if (stristr("$httphost", "LinkWalker") !== false)
{
$uname = "SevenTwentyFour-$ip";
}
else if (stristr("$httphost", "Link Valet Online") !== false)
{
$uname = "Link valet-$ip";
}
else if (stristr("$httphost", "libwww-perl/5.41") !== false)
{
$uname = "CMP-$ip";
}
else if (stristr("$httphost", "LEIAcrawler") !== false)
{
$uname = "GSeek-$ip";
}
else if (stristr("$httphost", "larbin (samualt9@bigfoot.com)") !== false)
{
$uname = "BigFoot-$ip";
}
else if (stristr("$httphost", "larbin_2.2.2 sugayama@lab7.kuis.kyoto-u.ac.jp") !== false)
{
$uname = "Kyoto Uni-$ip";
}
else if (stristr("$httphost", "KIT-Fireball") !== false)
{
$uname = "Fireball-$ip";
}
else if (stristr("$httphost", "Kenjin Spider") !== false)
{
$uname = "Kenjin-$ip";
}
else if (stristr("$httphost", "Internet Ninja") !== false)
{
$uname = "Dream Train-$ip";
}
else if (stristr("$httphost", "look.com") !== false)
{
$uname = "Look.com-$ip";
}
else if (stristr("$httphost", "IncyWincy page crawler") !== false)
{
$uname = "IncyWincy-$ip";
}
else if (stristr("$httphost", "Hippias") !== false)
{
$uname = "Hippias-$ip";
}
else if (stristr("$httphost", "Harvest-NG") !== false)
{
$uname = "Harvest-NG-$ip";
}
else if (stristr("$httphost", "Gulper Web Bot") !== false)
{
$uname = "Yuntis-$ip";
}
else if (stristr("$httphost", "Gulliver") !== false)
{
$uname = "Northernlight-$ip";
}
else if (stristr("$httphost", "googlebot (larbin2.6.0@unspecified.mail)") !== false)
{
$uname = "PackerdBell-$ip";
}
else if (stristr("$httphost", "Go!Zilla") !== false)
{
$uname = "GoZilla-$ip";
}
else if (stristr("$httphost", "GNODSPIDER") !== false)
{
$uname = "Gnod.net-$ip";
}
else if (stristr("$httphost", "gigabaz") !== false)
{
$uname = "GigaBaz-$ip";
}
else if (stristr("$httphost", "geckobot") !== false)
{
$uname = "geckobot-$ip";
}
else if (stristr("$httphost", "gazz") !== false)
{
$uname = "NTTRD.com-$ip";
}
else if (stristr("$httphost", "Gaisbot") !== false)
{
$uname = "GaisLab-$ip";
}
else if (stristr("$httphost", "GAIS Robot") !== false)
{
$uname = "Seed-$ip";
}
else if (stristr("$httphost", "Firefly") !== false)
{
$uname = "Fireball-$ip";
}
else if (stristr("$httphost", "Excalibur Internet Spider") !== false)
{
$uname = "Excalibur-$ip";
}
else if (stristr("$httphost", "ESISmartSpider") !== false)
{
$uname = "SmartSpider-$ip";
}
else if (stristr("$httphost", "EroCrawler") !== false)
{
$uname = "EroCrawler-$ip";
}
else if (stristr("$httphost", "Enterprise_Search") !== false)
{
$uname = "Enterprise Search-$ip";
}
else if (stristr("$httphost", "EmailWolf") !== false)
{
$uname = "EmailWolf-$ip";
}
else if (stristr("$httphost", "EmailSiphon") !== false)
{
$uname = "EmailSiphon-$ip";
}
else if (stristr("$httphost", "EchO!") !== false)
{
$uname = "Echo.fr-$ip";
}
else if (stristr("$httphost", "dtSearchSpider") !== false)
{
$uname = "dtSearchSpider-$ip";
}
else if (stristr("$httphost", "DoCoMo/1.0/N210i/c10") !== false)
{
$uname = "NTT-$ip";
}
else if (stristr("$httphost", "DIIbot") !== false)
{
$uname = "Findsame-$ip";
}
else if (stristr("$httphost", "DittoSpyder") !== false)
{
$uname = "Ditto-$ip";
}
else if (stristr("$httphost", "DigOut4U") !== false)
{
$uname = "openPortal4U-$ip";
}
else if (stristr("$httphost", "Digger") !== false)
{
$uname = "DiggIt-$ip";
}
else if (stristr("$httphost", "dbDig") !== false)
{
$uname = "dbDig-$ip";
}
else if (stristr("$httphost", "DaviesBot") !== false)
{
$uname = "WholeWeb-$ip";
}
else if (stristr("$httphost", "Custom Spider www.bisnisseek.com") !== false)
{
$uname = "Bisnisseek-$ip";
}
else if (stristr("$httphost", "CurryGuide SiteScan") !== false)
{
$uname = "CurryGuide-$ip";
}
else if (stristr("$httphost", "Cuam") !== false)
{
$uname = "TTNet-$ip";
}
else if (stristr("$httphost", "CrawlerBoy Pinpoint.com") !== false)
{
$uname = "pinPoint-$ip";
}
else if (stristr("$httphost", "Crawler V 0.2.x admin@crawler.de") !== false)
{
$uname = "Abacho.de (1)-$ip";
}
else if (stristr("$httphost", "Crawler admin@crawler.de") !== false)
{
$uname = "Abacho (2)-$ip";
}
else if (stristr("$httphost", "cosmos/0.9_(robot@xyleme.com)") !== false)
{
$uname = "SA France-$ip";
}
else if (stristr("$httphost", "combine") !== false)
{
$uname = "Combine-$ip";
}
else if (stristr("$httphost", "CheckWeb") !== false)
{
$uname = "CheckWeb-$ip";
}
else if (stristr("$httphost", "Checkbot") !== false)
{
$uname = "CheckBot-$ip";
}
else if (stristr("$httphost", "cg-eye interactive") !== false)
{
$uname = "CG-Exe-$ip";
}
else if (stristr("$httphost", "BullsEye") !== false)
{
$uname = "BullsEye-$ip";
}
else if (stristr("$httphost", "Bot mailto:craftbot@yahoo.com") !== false)
{
$uname = "Cybercity-$ip";
}
else if (stristr("$httphost", "BigBrother") !== false)
{
$uname = "BB4-$ip";
}
else if (stristr("$httphost", "Atomz") !== false)
{
$uname = "Atomz-$ip";
}
else if (stristr("$httphost", "ASSORT") !== false)
{
$uname = "Associative Sort-$ip";
}
else if (stristr("$httphost", "ASPSeek") !== false)
{
$uname = "Aspseek robot-$ip";
}
else if (stristr("$httphost", "ArchitextSpider") !== false)
{
$uname = "Excite-$ip";
}
else if (stristr("$httphost", "Arachnoidea") !== false)
{
$uname = "EuroSeek-$ip";
}
else if (stristr("$httphost", "Aport") !== false)
{
$uname = "Aport-$ip";
}
else if (stristr("$httphost", "walhello.com") !== false)
{
$uname = "WalHello-$ip";
}
else if (stristr("$httphost", "Allesklar") !== false)
{
$uname = "AllesKlar-$ip";
}
else if (stristr("$httphost", "AlkalineBOT") !== false)
{
$uname = "Vestris-$ip";
}
else if (stristr("$httphost", "Aladin") !== false)
{
$uname = "Aladin.de-$ip";
}
else if (stristr("$httphost", "AESOP_com_SpiderMan") !== false)
{
$uname = "AESOP-$ip";
}
else if (stristr("$httphost", "Acoon Robot") !== false)
{
$uname = "Acoon.de-$ip";
}
else if (stristr("$httphost", "AcoiRobot") !== false)
{
$uname = "Acoi-$ip";
}
else if (stristr("$httphost", "About/0.1libwww-perl/5.47") !== false)
{
$uname = "About-$ip";
}
else if (stristr("$httphost", "AbachoBOT") !== false)
{
$uname = "AbachoBot-$ip";
}
else if (stristr("$httphost", "A-Online Search") !== false)
{
$uname = "A-Online Search-$ip";
}
else if (stristr("$httphost", "4anything.com LinkChecker") !== false)
{
$uname = "4anything.com-$ip";
}
else if (stristr("$httphost", "MicrosoftPrototypeCrawler") !== false)
{
$uname = "MS Prototype-$ip";
}
else if (stristr("$httphost", "Surfnomore Spider") !== false)
{
$uname = "Surfnomore-$ip";
}
// fin robots
    }
    $past = time()-900;
    $sql = "DELETE FROM ".$prefix."_whoiswhere WHERE time < $past";
    $db->sql_query($sql);
    $sql = "SELECT time FROM ".$prefix."_whoiswhere WHERE username='$uname'";
    $result = $db->sql_query($sql);
    $ctime = time();
    if ($row = $db->sql_fetchrow($result)) {
	$sql = "UPDATE ".$prefix."_whoiswhere SET username='$uname', time='$ctime', host_addr='$ip', guest='$guest' , module='$name', url='$url' WHERE username='$uname'";
	$db->sql_query($sql);
    } else {
	$sql = "INSERT INTO ".$prefix."_whoiswhere (username, time, host_addr, guest,module,url) VALUES ('$uname', '$ctime', '$ip', '$guest','$name','$url')";
	$db->sql_query($sql);
    }
// End Who is where / Fin Qui est ou
?>

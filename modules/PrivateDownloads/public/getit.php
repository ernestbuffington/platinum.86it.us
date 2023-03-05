<?php

/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on Platinum Nuke Pro*/
/*                                                                      */
/* Platinum: Your dreams, our imagination                               */
/************************************************************************/

$lid = intval($lid);
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE lid=$lid AND active>'0'");
$lidinfo = $db->sql_fetchrow($result);
include_once("header.php");
$priv = $lidinfo['sid'] - 2;
if (($lidinfo['sid'] == 0) || ($lidinfo['sid'] == 1 AND is_user($user))  || ($lidinfo['sid'] == 2 AND is_admin($admin)) || ($lidinfo['sid'] > 2 AND in_group($priv)) || $dl_config['show_download'] == '1') {
  if ($lidinfo['lid'] == "" OR $lidinfo['active'] == 0) {
    title(_DOWNLOADPROFILE.": "._INVALIDDOWNLOAD);
    OpenTable();
    echo "<center><strong>"._INVALIDDOWNLOAD."</strong></center>\n";
  } else {
    $fetchid = base64_encode($lidinfo['url']);
    $title = stripslashes($lidinfo['title']);
    title(_DOWNLOADPROFILE.": $title");
    OpenTable();
    mt_srand ((double)microtime()*1000000);
    $maxran = 1000000;
    $random_num = mt_rand(0, $maxran);
    $lidinfo['description'] = stripslashes($lidinfo['description']);
    $lidinfo['description'] = str_replace ("\r\n", "<br />", $lidinfo['description']);
    echo "<font class='content'>".$lidinfo['description']."<br /><hr>";
    echo "<strong>"._VERSION.":</strong> ".$lidinfo['version']."<br />\n";
    echo "<strong>"._FILESIZE.":</strong> ".CoolSize($lidinfo['filesize'])."<br />";
    echo "<strong>"._ADDEDON.":</strong> ".CoolDate($lidinfo['date'])."<br />\n";
    echo "<strong>"._DOWNLOADS.":</strong> ".$lidinfo['hits']."<br />";
    echo "<strong>"._HOMEPAGE.":</strong> ";
    if ($lidinfo['homepage'] == "" || $lidinfo['homepage'] == "http://") {
      echo _DL_NOTLIST;
    } else {
      echo "<a href='".$lidinfo['homepage']."' target='new'>".$lidinfo['homepage']."</a>";
    }
    echo "<hr>";
    if (($lidinfo['sid'] == 0) || ($lidinfo['sid'] == 1 AND is_user($user))  || ($lidinfo['sid'] == 2 AND is_admin($admin)) || ($lidinfo['sid'] > 2 AND in_group($priv))) {
      echo _DL_DIRECTIONS." "._DL_DLNOTES1."$title"._DL_DLNOTES2."</font><br /><br />";
      echo "<center><table border='0'>";
      echo "<form action='modules.php?name=$module_name' method='POST'>";
      echo "<input type='hidden' name='op' value='go'>";
      echo "<input type='hidden' name='lid' value='".$lidinfo['lid']."'>";
      echo "<input type='hidden' name='fetchid' value='$fetchid'>";
      if ($dl_config['usegfxcheck'] == 1) {
        if (extension_loaded("gd")) {
          echo "<tr><td><strong>"._DL_YOURPASS.":</strong></td><td><img src='modules.php?name=$module_name&amp;op=gfx&amp;random_num=$random_num' height='20' width='80' border='0' alt='"._DL_YOURPASS."' title='"._DL_YOURPASS."'></td></tr>";
          echo "<tr><td><strong>"._DL_TYPEPASS.":</strong></td><td><input type='text' name='passcode' size='10' maxlength='10'></td></tr>";
          echo "<input type='hidden' NAME='checkpass' value='$random_num'>";
        } else {
          $datekey = date("F j");
          $rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
          $code = substr($rcode, 2, 8);
          $ThemeSel = get_theme();
          if (file_exists("themes/$ThemeSel/images/downloads/code_bg.png")) {
            $imgpath = "themes/$ThemeSel/images";
          } else {
            $imgpath = "images";
          }
          echo "<tr><td><strong>"._DL_YOURPASS.":</strong></td><td height='20' width='80' background='$imgpath/code_bg.png' class='storytitle' align='center'><strong>$code</strong></td></tr>";
          echo "<tr><td><strong>"._DL_TYPEPASS.":</strong></td><td><input type='text' name='passcode' size='10' maxlength='10'></td></tr>";
          echo "<input type='hidden' name='checkpass' value='$code'>";
        }
      }
      echo "<tr><td colspan='2' align='center'><input type='submit' name='"._DL_GOGET."' value='"._DL_GOGET."'></td></tr>";
      echo "</form>";
      echo "</table></center><br />";
      echo "<center><font class='content'>[ <a href='modules.php?name=$module_name&amp;op=modifydownloadrequest&amp;lid=$lid'>"._MODIFY."</a> ]</font></center>\n";
    } else {
      restricted($lidinfo['sid']);
    }
  }
  CloseTable();
} else {
  OpenTable();
  restricted($lidinfo['sid']);
  CloseTable();
}
include_once("footer.php");

?>

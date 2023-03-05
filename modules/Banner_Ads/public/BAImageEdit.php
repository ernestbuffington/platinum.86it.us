<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." - "._BA_EDITBANN;
if (is_baclient($baclient)) {
  @include_once("header.php");
  if (is_numeric($bid)) {
    title(_BA_EDITBANN);
    BAMenu();
    echo"<br>\n";
    OpenTable();
    $bidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE bid='$bid' AND cid='$bacookie[0]'"));
    echo "<center><table border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<form action='modules.php?name=$module_name' method='post'>\n";
    echo "<input type='hidden' name='bid' value='$bid'>\n";
    echo "<input type='hidden' name='op' value='BAImageEditSave'>\n";
    echo "<tr><td align='center' bgcolor='$bgcolor2' colspan='2'><b>"._BA_BANNED."</b></td></tr>\n";
    echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_NEWSRC.":</td><td><input type='text' name='new_image' value='".$bidinfo['imageurl']."' size='40'></td></tr>\n";
    if ($bidinfo['flash'] == 0 && $bidinfo['code'] == 0) {
      echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_CLKU.":</td><td><input type='text' name='new_url' size='50' maxlength='200' value='".$bidinfo['clickurl']."'></td></tr>\n";
      echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_ALTTXT.":</td><td><input type='text' name='new_alttext' size='50' maxlength='255' value='".$bidinfo['alttext']."'></td></tr>\n";
    } else {
      echo "<input type='hidden' name='new_url' value=''>\n";
      echo "<input type='hidden' name='new_alttext' value=''>\n";
    }
    echo "<tr><td align='center' colspan='2'><input type='submit' value='"._BA_SUBMIT."'></td></tr>\n";
    echo "</form>\n</table></center>\n";
    CloseTable();
  } else {
    title(_BA_HCKATP);
    OpenTable();
    echo "<b>"._BA_HCKAMP."</b>\n";
    CloseTable();
    $fecha = date("F jS Y, h:iA.");
    $subject  = _BA_HCKATPON." $sitename";
    $message  = _BA_HCKATPON." $sitename:\n";
    $message .= "----------------------------------------\n";
    $message .= _BA_IP." - ".$_SERVER['REMOTE_ADDR']."\n";
    $message .= _BA_HCKSTR." - ".$_SERVER['QUERY_STRING']."\n";
    $message .= "----------------------------------------\n";
    $message .= _BA_REPORTON.": $fecha";
    $from = "$sitename <$adminmail>";
    mail($adminmail, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
  }
  @include_once("footer.php");
} else {
  header("Location: modules.php?name=$module_name");
}

?>
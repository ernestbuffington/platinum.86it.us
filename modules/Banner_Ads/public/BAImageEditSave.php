<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if (is_baclient($baclient)) {
  $cid = $bacookie[0];
  $bid = intval($bid);
  $cid = intval($cid);
  $flash = intval($flash);
  $code = intval($code);
  $new_url = baclear_text($newimage);
  $new_alttext = baclear_text($new_alttext);
  $db->sql_query("UPDATE ".$prefix."_nsnba_banners SET imageurl='$imgurl', clickurl='$new_url', alttext='$new_alttext' WHERE bid='$bid' and cid='$bacookie[0]'");
  header("Location: modules.php?name=$module_name");
} else {
  header("Location: modules.php?name=$module_name");
}

?>
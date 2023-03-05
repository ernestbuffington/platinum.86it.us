<?php

      $id = $_GETVAR->get('id', 'GET', 'int');

      $result = $db->sql_query("SELECT `site_url`, `site_status` FROM `".$prefix."_link_us` WHERE `id`='$id'");
      list($url, $site_status) = $db->sql_fetchrow($result);

      if ($site_status == 1) {
        $db->sql_uquery("UPDATE `".$prefix."_link_us` SET `site_hits`=`site_hits`+1 WHERE `id`='$id'");
      }

      redirect($url);

?>
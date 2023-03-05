<?php
///////////////////////////////////////////////////////////////////////
// content_pagebreak_convert.php by Gremmie
// This script converts content with the old <!--pagebreak--> style
// pagebreaks into the newer [--pagebreak--] style.
//
// To use:
// 1) Upload this script to the root directory of your PHP-Nuke
// site (the same directory as index.php).
// 2) Log into your site as an admin.
// 3) Execute the script from your browser, e.g.
// http://www.mysite.com/content_pagebreak_convert.php
// 4) Delete this script from your server
//
///////////////////////////////////////////////////////////////////////

require_once 'mainfile.php';
include 'header.php';
OpenTable();

if (is_admin($admin))
{
   $sql = 'SELECT pid, text FROM ' . $prefix . '_pages';
   $result = $db->sql_query($sql);
   while ($row = $db->sql_fetchrow($result))
   {
      $pid = intval($row['pid']);
      $text = $row['text'];

      $text = str_replace(array('<!--pagebreak-->', '&lt;!--pagebreak--&gt;'),
                          '[--pagebreak--]',
                          $text);
      $text = addslashes($text);

      $sql = "UPDATE {$prefix}_pages SET text = '$text' WHERE pid = '$pid'";
      $result2 = $db->sql_query($sql);
      if ($result2 === false)
      {
         echo "Oops, problem updating row #$pid!<br />";
      }
   }
   echo '<strong>Conversion complete</strong><br /><br />';
   echo '<strong>Please delete this script from your server now.</strong><br /><br />';
}
else
{
   echo '<strong>You must be admin to run this script</strong><br /><br />';
}

CloseTable();
include 'footer.php';
?>
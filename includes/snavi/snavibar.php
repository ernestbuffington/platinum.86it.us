<?php
/**
 * @author D. Miller
 * @copyright 2011
 */
if (stristr($_SERVER['SCRIPT_NAME'], "snavibar.php")) {
    Header("Location: ../index.php");
    die();
}
/*****[BEGIN]******************************************/
/* [ Base:    Snavi Menu Bar                    v2.5.]*/
/******************************************************/ 
global $theme_name;
$theme_name = get_theme();
if (file_exists('includes/snavi/snavi.js')) {
  if (file_exists('themes/' . $theme_name . '/style/snavi.css')) {
    echo '<link href="themes/' . $theme_name . '/style/snavi.css" rel="stylesheet" type="text/css">' . "\n";
  } else
  if (file_exists('includes/snavi/style/snavi.css')) {
    echo '<link href="includes/snavi/style/snavi.css" rel="stylesheet" type="text/css">' . "\n";
  }
  echo '<script language="JavaScript" src="includes/snavi/snavi.js" type="text/javascript"></script>' . "\n";
  if (!defined('SNAVI_IS_ACTIVE')) define('SNAVI_IS_ACTIVE', 1);
}
?>
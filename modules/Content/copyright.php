<?php
/**********************************************/
/* Content Plus Module For PHP-Nuke 7.3 - 8.0
/* Written by: Jonathan Estrella
/* http://slaytanic.sourceforge.net
/* Copyright (c) 2004-2008 Jonathan Estrella
/**********************************************/

$module_name = basename(dirname(__FILE__));
$mod_name = 'Content Plus';
$author_email = 'jestrella04 (at) gmail (dot) com';
$author_homepage = 'http://slaytanic.sourceforge.net';
$author_name = '<a href="'.$author_homepage.'" target="new">Jonathan Estrella</a>';
$license = 'GNU/GPL';
$download_location = 'http://slaytanic.sourceforge.net/modules.php?name=Downloads&amp;op=getit&amp;lid=1';
$module_version = '2.2.1';
$release_date = '';
$module_description = 'Revamped Content Module';
$mod_cost = '';
if (empty($mod_name)) { $mod_name = preg_replace('/_/i', ' ', $module_name); }

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.PHP_EOL;
echo '<html xmlns="http://www.w3.org/1999/xhtml">'.PHP_EOL;
echo '<head>'.PHP_EOL;
echo '<title>'.$mod_name.': Copyright Information</title>'.PHP_EOL;
echo '<style type="text/css">'.PHP_EOL;
echo '	body{ margin: 0.5em; padding: 0; font: 70%/1.5 Verdana, Tahoma, Arial, Helvetica, sans-serif; }'.PHP_EOL;
echo '</style>'.PHP_EOL;
echo '</head>'.PHP_EOL;
$bullet = '<img src="images/icons/accepted_48.png" alt="-" border="0" width="16" style="vertical-align: middle;" />';
echo '<body bgcolor="#FFFFFF" link="#000000" alink="#000000" vlink="#000000">'.PHP_EOL;
echo '<center><strong>Module Copyright &copy; Information</strong><br />'.PHP_EOL;
echo $mod_name.' module for PHP-Nuke &amp; Derivatives</center><hr />'.PHP_EOL;
echo ''.$bullet.'&nbsp;<strong>Module\'s Name:</strong> '.$mod_name.'<br />'.PHP_EOL;
if (!empty($module_version)) { echo ''.$bullet.'&nbsp;<strong>Module\'s Version:</strong> '.$module_version.'<br />'.PHP_EOL; }
if (!empty($release_date)) { echo ''.$bullet.'&nbsp;<strong>Release Date:</strong> '.$release_date.'<br />'.PHP_EOL; }
if (!empty($mod_cost)) { echo ''.$bullet.'&nbsp;<strong>Module\'s Cost:</strong> '.$mod_cost.'<br />'.PHP_EOL; }
if (!empty($license)) { echo ''.$bullet.'&nbsp;<strong>License:</strong> '.$license.'<br />'.PHP_EOL; }
if (!empty($author_name)) { echo ''.$bullet.'&nbsp;<strong>Author\'s Name:</strong> '.$author_name.'<br />'.PHP_EOL; }
if (!empty($author_email)) { echo ''.$bullet.'&nbsp;<strong>Author\'s Email:</strong> '.$author_email.'<br />'.PHP_EOL; }
if (!empty($module_description)) { echo ''.$bullet.'&nbsp;<strong>Module\'s Description:</strong> '.$module_description.'<br />'.PHP_EOL; }
if (!empty($download_location)) { echo ''.$bullet.'&nbsp;<strong>Module\'s Download:</strong> <a href="'.$download_location.'" target="new">Download</a><br />'.PHP_EOL; }
echo '<hr />'.PHP_EOL;
echo '<center>[ <a href="#" onclick="javascript:self.close()">Close Window</a> ]</center>'.PHP_EOL;
echo '</body>'.PHP_EOL;
echo '</html>'.PHP_EOL;
?>
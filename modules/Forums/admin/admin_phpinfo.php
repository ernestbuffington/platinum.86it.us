<?php


if (!empty($setmodules))
{
	$filename = basename(__FILE__);
	$module['Platinum MODs']['PHP Info'] = $filename;
	return;
}

define('IN_PHPBB', 1);
// Load default header
$phpbb_root_path = '../';
require_once($phpbb_root_path . 'extension.inc');
require_once('pagestart.' . $phpEx);

//
// Just a little playing around with PHP
//
// $board_config['version'] = '.0.9';  //  ;-)
switch ($board_config['version'])
{
	case '.0.6':
		$version = '2.0.6';
		break;
	case '.0.7':
		$version = '2.0.7';
		break;
	case '.0.8':
		$version = '2.0.8';
		break;
	case '.0.9':
		$version = '2.0.9';
		break;
}

// 
// Get the PHP Info
//
ob_start(); 
phpinfo(INFO_GENERAL | INFO_CONFIGURATION | INFO_MODULES | INFO_VARIABLES); 
$phpinfo = ob_get_contents(); 
ob_end_clean(); 

// Get used layout
$layout = (preg_match('#bgcolor#i', $phpinfo)) ? 'old' : 'new';

// Here we play around a little with the PHP Info HTML to try and stylise
// it along phpBB's lines ... hopefully without breaking anything. The idea
// for this was nabbed from the PHP annotated manual
preg_match_all('#<body[^>]*>(.*)</body>#siU', $phpinfo, $output); 

switch ($layout)
{
	case 'old':
		$output = preg_replace('#<table#', '<table class="bg"', $output[1][0]);
		$output = preg_replace('# bgcolor="\#(\w){6}"#', '', $output);
		$output = preg_replace('#(\w),(\w)#', '\1, \2', $output);
		$output = preg_replace('#border="0" cellpadding="3" cellspacing="1" width="600"#', 'border="0" cellspacing="1" cellpadding="4" width="95%"', $output);
		$output = preg_replace('#<tr valign="top"><td align="left">(.*?<a .*?</a>)(.*?)</td></tr>#s', '<tr class="row1"><td style="{background-color: #9999cc;}"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td style="{background-color: #9999cc;}">\2</td><td style="{background-color: #9999cc;}">\1</td></tr></table></td></tr>', $output);
		$output = preg_replace('#<tr valign="baseline"><td[ ]{0,1}><strong>(.*?)</strong>#', '<tr><td class="row1" nowrap="nowrap">\1', $output);
		$output = preg_replace('#<td align="(center|left)">#', '<td class="row2">', $output);
		$output = preg_replace('#<td>#', '<td class="row2">', $output);
		$output = preg_replace('#valign="middle"#', '', $output);
		$output = preg_replace('#<tr >#', '<tr>', $output);
		$output = preg_replace('#<hr(.*?)>#', '', $output);
		$output = preg_replace('#<h1 align="center">#i', '<h1>', $output);
		$output = preg_replace('#<h2 align="center">#i', '<h2>', $output);
		break;
	case 'new':
		$output = preg_replace('#<table#', '<table class="bg" align="center"', $output[1][0]);
		$output = preg_replace('#(\w),(\w)#', '\1, \2', $output);
		$output = preg_replace('#border="0" cellpadding="3" width="600"#', 'border="0" cellspacing="1" cellpadding="4" width="95%"', $output);
		$output = preg_replace('#<tr class="v"><td>(.*?<a .*?</a>)(.*?)</td></tr>#s', '<tr class="row1"><td><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td>\2</td><td>\1</td></tr></table></td></tr>', $output);
		$output = preg_replace('#<td>#', '<td style="{background-color: #9999cc;}">', $output);
		$output = preg_replace('#class="e"#', 'class="row1" nowrap="nowrap"', $output);
		$output = preg_replace('#class="v"#', 'class="row2"', $output);
		$output = preg_replace('# class="h"#', '', $output);
		$output = preg_replace('#<hr />#', '', $output);
		preg_match_all('#<div class="center">(.*)</div>#siU', $output, $output); 
		$output = $output[1][0];
		break;
}


//
// The Final output
//
echo '<center><h1>PHP Info</h1>';
echo '<center><strong><p>Platinum Version 1.0</strong></p></center>';
echo $output; 

include_once('./page_footer_admin.'.$phpEx);
?>

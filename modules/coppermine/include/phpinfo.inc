<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2a for CMS                                   //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR <gdemar@wanadoo.fr>                 //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License, or        //
// (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //
if (!defined('IN_COPPERMINE')) DIE();
function cpgGetPhpinfoConf($search)
{ 
    // this could be done much better with regexpr - anyone who wants to change it: go ahead
    ob_start();
    phpinfo(INFO_CONFIGURATION);
    $string = ob_get_contents();
    ob_end_clean(); 
    // find out the first occurence of "</tr" and throw the superfluos stuff in front of it away
    $string = strchr($string, '</tr>');
    $string = str_replace('</td>', '|', $string);
    $string = str_replace('</tr>', '§', $string);
    $string = chop(strip_tags($string));
    $pieces = explode("§", $string);
    foreach($pieces as $val) {
        $bits = explode("|", $val);
        if (strchr($bits[0], $search)) {
            return $bits;
        } 
    } 
} 
function cpgGetPhpinfoMod($search)
{ 
    // this could be done much better with regexpr - anyone who wants to change it: go ahead
    ob_start();
    phpinfo(INFO_MODULES);
    $string = ob_get_contents();
    $module = $string;
    ob_end_clean(); 
    // find out the first occurence of "<h2" and throw the superfluos stuff away
    $string = strchr($string, 'module_' . $search);
    $string = preg_replace('#</table>(.*)#', '', $string);
    $string = strchr($string, '<tr>');
    $string = str_replace('</td>', '|', $string);
    $string = str_replace('</tr>', '§', $string);
    $string = chop(strip_tags($string));
    $pieces = explode("§", $string);
    foreach($pieces as $key => $val) {
        $bits[$key] = explode("|", $val);
    } 
    return $bits;
} 
function cpgModOutput($search)
{
    $pieces = cpgGetPhpinfoMod($search);
    $summ = '';
    starttable('100%', $search, 2);
    foreach($pieces as $val) {
        if ($val[0] != '')
            print '<tr><td>' . $val[0] . '</td><td>' . $val[1] . '</td></tr>';
        else
            print '<tr><td>' . $val[0] . '</td><td></td></tr>';
        $summ .= $val[0];
    } 
    if ($summ == '') {
        print '<tr><td colspan="2">module doesn\'t exist</td></tr>';
    } 
    endtable();
    return $summ;
} 
function cpgMysqlVersion()
{
    $result = mysql_query("SELECT VERSION() as version");
    $row = mysql_fetch_row($result);
    return $row[0];
} 
function test_im()
{
    global $errors, $DFLT, $im_installed, $CONFIG;
    $im_installed = false;
    $CONFIG['impath'] = '/tmp/';
    if ($CONFIG['impath'] != '') {
        if (!preg_match('|/\Z|', $CONFIG['impath']))
            $CONFIG['impath'] .= '/';
        if (!is_dir($CONFIG['impath'])) {
            $errors .= "<hr /><br />The installer can not find the '{$CONFIG['impath']}' directory you have specified for ImageMagick or it does not have permission to access it. Check that your typing is correct and that you have access to the specified directory.<br /><br />";
        } elseif (preg_match('/ /', $CONFIG['impath'])) {
            $errors .= "<hr /><br />The path you have entered for ImageMagick ('{$CONFIG['impath']}') contains at least one space. This will cause problems in the script.<br /><br />
                        You must move ImageMagick to another directory.<br /><br />";
        } elseif (!file_exists($CONFIG['impath'] . 'convert') && !file_exists($CONFIG['impath'] . 'convert.exe')) {
            $errors .= "<hr /><br />The installer can not find the 'convert' or 'convert.exe' ImageMagick program in directory '{$CONFIG['impath']}'. Check that you have entered the correct directory name.<br /><br />";
        } else {
            $output = array();
            $tst_image = "{$DFLT['alb_d']}/{$DFLT['upl_d']}/im.gif";
            exec ("{$CONFIG['impath']}convert images/nopic.jpg $tst_image", $output, $result);
            $size = getimagesize($tst_image);
            unlink($tst_image);
            $im_installed = ($size[2] == 1);
            if (!$im_installed)
                $errors .= "<hr /><br />The installer found the ImageMagick 'convert' program in '{$CONFIG['impath']}', however it can't be executed by the script.<br /><br />
                                        You may consider using GD instead of ImageMagick.<br /><br />";
            if ($result && count($output)) {
                $errors .= "The convert program said:<br /><pre>";
                foreach($output as $line) $errors .= htmlspecialchars($line);
                $errors .= "</pre><br /><br />";
            } 
        } 
    } 
    return $im_installed;
} 
print '<div align="left">
<h2>PHP version: ' . phpversion() . '</h2>
';
if (strcmp('4.0.0', phpversion()) == 1) {
    print ' - your PHP version isn\'t new enough! Minimum requirements: 4.x';
} 
print '<br />
';
$mySqlVersion = cpgMysqlVersion();
print '<h2>mySQL version: ' . $mySqlVersion . '</h2>
';
if (strcmp('3.23.23', $mySqlVersion) == 1) {
    print ' - your mySQL version isn\'t new enough! Minimum requirements: 3.23.23';
} 
print '<hr />
';
print '<h2>Image Lib(s)</h2>
';
cpgModOutput("gd"); 
starttable('100%', 'Server restrictions (safe mode)?', 3);
print '<tr><td><strong>Directive</strong></td><td><strong>Local Value</strong></td><td><strong>Master Value</strong></td></tr>';
$pieces = cpgGetPhpinfoConf("safe_mode");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("safe_mode_exec_dir");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("safe_mode_gid");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("safe_mode_include_dir");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("safe_mode_exec_dir");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("sql.safe_mode");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("disable_functions");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("file_uploads");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("include_path");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("open_basedir");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
endtable();
print '
<br />
';
starttable('100%', 'email', 3);
print '<tr><td><strong>Directive</strong></td><td><strong>Local Value</strong></td><td><strong>Master Value</strong></td></tr>';
$pieces = cpgGetPhpinfoConf("sendmail_from");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("sendmail_path");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("SMTP");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("smtp_port");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
endtable();
print '
<br />
';
starttable('100%', 'Size and Time', 3);
print '<tr><td><strong>Directive</strong></td><td><strong>Local Value</strong></td><td><strong>Master Value</strong></td></tr>';
$pieces = cpgGetPhpinfoConf("max_execution_time");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("max_input_time");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("upload_max_filesize");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
$pieces = cpgGetPhpinfoConf("post_max_size");
print '<tr><td>' . $pieces[0] . '</td><td>' . $pieces[1] . '</td><td>' . $pieces[2] . '</td></tr>';
endtable();
print '
</div>
';
?>

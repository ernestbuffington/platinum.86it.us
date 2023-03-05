<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/* This module Was Made By STALKER From www.nuke4gamers.com Please      */
/*                                                                      */
/************************************************************************/

if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
$path = "modules/$module_name/images/sigs/";
$max_size = 3145728; //http://www.onlineconversion.com/computer.htm// 

function upload() {
global $module_name;
include("header.php");
if (file_exists("modules/$module_name/copyright.php")) {
Opentable();
echo"<FORM ENCTYPE=\"multipart/form-data\" ACTION=\"modules.php?name=$module_name&func=finished\" METHOD=\"POST\">"
  . "  <p align=\"center\">&nbsp;</p>"
  . "  <p align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"></p>"
  . "  <center><h3>-AS- SigHosting</h3></center><p>"
  . "  <p align=\"center\">Sig MaxSize: 3MB<br>Sig File Types: .jpg, .jpeg, & .gif<hr>"
  . "  <p align=\"center\">Name your file using your Alias, ie: sgtmudd_sig1.jpg<br>(This helps to keep them organized.)<br>Then Just Browse For The Sig You Want Hosted, Then Click 'Host My Sig!'<br> The Forums BBCode And Sig Path Will Be Shown After It's Uploaded. Write it down!</p>"
  . "  <p align=\"center\">Sig Addy:<br>http://assaultsnipers.com/modules/N4G-SigHost/images/sigs/(sigfilename)"
  . "    <center><INPUT TYPE=\"file\" NAME=\"userfile\">&nbsp;&nbsp;&nbsp;<INPUT TYPE=\"submit\" VALUE=\"Host My Sig!\"></center>"
  . "    </p>"
  . "</FORM>";
CloseTable();
include("footer.php");
    } else {
    echo "<br>";
    OpenTable();
    echo "<br><center><b>Hey ya nub you didn't upload the copyright.php file.<br><br>Upload it now so this module will work and you wont be such a nub</b> </center><br>";
    CloseTable();
    include("footer.php");
    die();
    }
}

function finished() {
global $path, $max_size,$HTTP_POST_FILES, $module_name, $nukeurl;

include("header.php");
if (file_exists("modules/$module_name/copyright.php")) {
Opentable();
echo "  <p align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"></p>";
echo"<hr>";
if (!isset($HTTP_POST_FILES['userfile'])) exit;
if (is_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'])) {

if ($HTTP_POST_FILES['userfile']['size']>$max_size) { echo "You n00b, the file is too big<br>\n"; exit; }
if (($HTTP_POST_FILES['userfile']['type']=="image/gif") || ($HTTP_POST_FILES['userfile']['type']=="image/pjpeg") || ($HTTP_POST_FILES['userfile']['type']=="image/jpeg") || ($HTTP_POST_FILES['userfile']['type']=="image/swf")) {

if (file_exists($path . $HTTP_POST_FILES['userfile']['name'])) { echo "The file already exists ya n00b<br>\n"; exit; }

$res = copy($HTTP_POST_FILES['userfile']['tmp_name'], $path .
$HTTP_POST_FILES['userfile']['name']);
if (!$res) { echo "Upload failed! HAHAH you n00b!<br>\n"; exit; } else { echo "Upload sucessful<br>\n"; }
echo"<br>";
echo"<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">"
  . "  <tr>"
  . "    <td width=\"20%\">Sig Name: </td>"
  . "    <td width=\"80%\">".$HTTP_POST_FILES['userfile']['name']."</td>"
  . "  </tr>"
  . "  <tr>"
  . "    <td width=\"20%\">Sig Size: </td>"
  . "    <td width=\"80%\">".$HTTP_POST_FILES['userfile']['size']." bytes</td>"
  . "  </tr>"
  . "  <tr>"
  . "    <td width=\"20%\">Sig Type: </td>"
  . "    <td width=\"80%\">".$HTTP_POST_FILES['userfile']['type']."</td>"
  . "  </tr>"
  . "  <tr>"
  . "    <td width=\"20%\">Sig BBCode: </td>"
  . "    <td width=\"80%\">[img]$nukeurl/modules/$module_name/images/sigs/".$HTTP_POST_FILES['userfile']['name']."[/img]</td>"
  . "  </tr>"
  . "  <tr>"
  . "    <td width=\"20%\">Sig Path: </td>"
  . "    <td width=\"80%\">$nukeurl/modules/$module_name/images/sigs/".$HTTP_POST_FILES['userfile']['name']."</td>"
  . "  </tr>"
  . "</table>";  
CloseTable();
Opentable();
echo "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">"
  . "  <tr>"
  . "    <td><center><h2>Sig Preview</h2></center></td>"
  . "  </tr>"
  . "  <tr>"
  . "    <td><center><img src=\"$nukeurl/modules/$module_name/images/sigs/".$HTTP_POST_FILES['userfile']['name']."\"></center></td>"
  . "  </tr>"
  . "</table>";
} else { echo "Wrong file type<br>\n"; exit; }  }
CloseTable();
include("footer.php");
    } else {
    echo "<br>";
    OpenTable();
    echo "<br><center><b>Hey ya nub you didn't upload the copyright.php file.<br><br>Upload it now so this module will work and you wont be such a nub</b> </center><br>";
    CloseTable();
    include("footer.php");
    die();
    }
}
switch($func) {

    default:
    upload();
    break;

    case "finished":
    finished();
    break;
    }
?>
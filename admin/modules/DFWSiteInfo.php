<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
if ( !defined('ADMIN_FILE') ) {
  die( 'Access Denied' );
}

global $prefix, $db, $admin_file, $dfw_getsets, $currentlang, $dfw_getsets;


// Define Some Variables
$yesImage = 'images/DFW/yes.gif';
$noImage = 'images/DFW/no.gif';

// Include the language
if ( file_exists('language/DFWSiteInfo/lang-' . $currentlang . '.php') ) {
  include_once ( 'language/DFWSiteInfo/lang-' . $currentlang . '.php' );
} elseif ( file_exists('language/DFWSiteInfo/lang-english.php') ) {
  include_once ( 'language/DFWSiteInfo/lang-english.php' );
}

$aid = substr( $aid, 0, 25 );
$row = $db->sql_fetchrow( $db->sql_query('SELECT radminsuper FROM ' . $prefix . '_authors WHERE aid=\'' . $aid . '\'') );
if ( $row['radminsuper'] == 1 ) {

  switch ( $op ) {

    case "DFWAdmin":
      DFWAdmin();
      break;

    case "DFWSaveSettings":
      DFWSaveSettings();
      break;

    case "DFWSaveTooltips":
      DFWSaveTooltips();
      break;

    case 'DFWTagImage':
      DFWTagImage();
      break;

    case 'DFWSaveStaff':
      DFWSaveStaff();
      break;

    case 'DFWEditStaff':
      DFWEditStaff( $s );
      break;

    case 'DFWUpdateStaff':
      DFWUpdateStaff( $urid );
      break;

    case 'DFWDeleteStaff':
      DFWDeleteStaff( $user_is );
      break;

    case 'DFWSaveImageSettings':
      DFWSaveImageSettings();
      break;

    case 'DFWSaveTooltipImageSettings':
      DFWSaveTooltipImageSettings();
      break;
  }

} else {
  echo "Access Denied";
}

function AddTwoColumnRow( $key, $value, $title = null )
{
  global $tmpl, $dfw_getsets, $bgcolor2, $textcolor2;
      if ($key == "")
            $key = "&nbsp;";
      if ($value == "")
            $value = "&nbsp;";
	  if (empty($title))
            $title = '';

  $tmpl['AddTwoColumnRow']['key'] = $key;
  $tmpl['AddTwoColumnRow']['value'] = $value;
  $tmpl['AddTwoColumnRow']['title'] = $title;
  if ( $dfw_getsets['admin_tooltips'] == 1 ) {
      echo '<li title="' . $tmpl['AddTwoColumnRow']['title'] . '" style="color: ' . $textcolor2 . ';background-color: ' . $bgcolor2 . ';border-right: 1px solid ' . $bgcolor2 . ';" class="LineLeft rounded">' . $tmpl['AddTwoColumnRow']['key'] . '</li>';
  } else {
		  echo '<li style="color: ' . $textcolor2 . ';background-color: ' . $bgcolor2 . ';border-right: 1px solid ' . $bgcolor2 . ';" class="LineLeft">' . $tmpl['AddTwoColumnRow']['key'] . '</li>';	
	  }
      echo '<li style="color: ' . $textcolor2 . ';background-color: ' . $bgcolor2 . ';" class="LineRight">' . $tmpl['AddTwoColumnRow']['value'] .
      '</li>';
  }

function tblAddThreeColumnRow( $key, $value, $extra )
{
  global $tmpl, $dfw_getsets, $bgcolor2, $textcolor2;
      if ($key == "")
            $key = "&nbsp;";
      if ($value == "")
            $value = "&nbsp;";
	  if (empty($extra))
            $extra = '';

  $tmpl['tblAddThreeColumnRow']['key'] = $key;
  $tmpl['tblAddThreeColumnRow']['value'] = $value;
  $tmpl['tblAddThreeColumnRow']['extra'] = $extra;

  echo '<tr style="background-color: ' . $bgcolor2 . ';" class="threerow">';
  echo '<td class="threerow">' . $tmpl['tblAddThreeColumnRow']['key'] . '</td>';
  echo '<td class="threerow">' . $tmpl['tblAddThreeColumnRow']['value'] . '</td>';
  echo '<td class="threerow">' . $tmpl['tblAddThreeColumnRow']['extra'] . '</td>';
  echo '</tr>';
}


function scan_directory_recursively( $directory, $filter = false )
{
  if ( substr($directory, -1) == '/' ) {
    $directory = substr( $directory, 0, -1 );
  }
  if ( !file_exists($directory) || !is_dir($directory) ) {
    return false;
  } elseif ( is_readable($directory) ) {
    $directory_list = opendir( $directory );
    while ( false !== ($file = readdir($directory_list)) ) {
      if ( $file != '.' && $file != '..' ) {
        $path = $directory . '/' . $file;
        if ( is_readable($path) ) {
          $subdirectories = explode( '/', $path );

          if ( is_dir($path) ) {
            $directory_tree[] = array( 'path' => $path, 'name' => end($subdirectories), 'kind' => 'directory', 'content' => scan_directory_recursively($path, $filter) );

          } elseif ( is_file($path) ) {
            $extension = end( explode('.', end($subdirectories)) );

            if ( $filter === false || $filter == $extension ) {
              $directory_tree[] = array( 'path' => $path, 'name' => end($subdirectories), 'extension' => $extension, 'size' => filesize($path), 'kind' => 'file' );
            }
          }
        }
      }
    }
    closedir( $directory_list );

    return $directory_tree;
  } else {
    return false;
  }
}


function DFWAdmin()
{
  global $db, $prefix, $user_prefix, $admin_file, $dfw_getsets, $noImage, $yesImage, $bgcolor1, $bgcolor2, $textcolor2;
  $MouseyOver = 'onmouseover="this.style.backgroundColor=\'' . $bgcolor2 . '\'"';
  $MouseyOut = 'onmouseout="this.style.backgroundColor=\'' . $bgcolor1 . '\'"';
  include_once ( 'header.php' );
  OpenTable();
  echo '<div align="center">';
  echo '<a href="' . $admin_file . '.php?op=DFWAdmin">';
  echo '<strong>' . _DFW_SITEINFOADMIN . '</strong></a>';
  echo '<br /><a href="' . $admin_file . '.php">';
  echo '<strong>' . _DFW_BACKADMIN . '</strong></a>';
  echo '</div>';
  CloseTable();
  OpenTable();
  echo '<div align="center">';
  echo '<h1><font style="font-weight: bold;font-size: 16px;">' . _DFW_ADMIN . '</font></h1>';
  echo '<strong>' . _DFW_VERS . '&nbsp;' . $dfw_getsets['version'] . '</strong>';
  echo '</div>';
  echo '<br /><br />';

?>
<table align="center" id="Nav_Bar" border="0" cellpadding="0" cellspacing="0">
<tr>
<td>
<img src="images/DFW/nav_01.gif" width="49" height="35" alt="" /></td>
<td>
<img id="toggle-main" src="images/DFW/nav_02.gif" width="124" height="35" alt="" /></td>
<td>
<img id="toggle-settings" src="images/DFW/nav_03.gif" width="127" height="35" alt="" /></td>
<td>
<img id="toggle-tooltip" src="images/DFW/nav_04.gif" width="129" height="35" alt="" /></td>
<td>
<img id="toggle-image" src="images/DFW/nav_05.gif" width="126" height="35" alt="" /></td>
<td>
<img src="images/DFW/nav_06.gif" width="30" height="35" alt="" /></td>
</tr>
</table>
<?php

  // Main Tab START
  echo '<div align="center" style="display: none;" id="mainbox">';
  echo '<table style="vertical-align: top;" width="100%" border="0" cellspacing="0" cellpadding="0">' . "\n";
  echo '<tr>' . "\n";
  echo '<td colspan="2">' . "\n";
  echo '<ul class="AddRows">' . "\n";
  echo '<li>' . "\n";
  echo '<br /><h3 align="center" style="padding: 5px;border: 1px solid;border-color: ' . $bgcolor2 . ';">' . _DFW_MAIN_SHOWING . '</h3>' . "\n";
  echo '</li>' . "\n";
  echo '</ul>' . "\n";
  echo '</td>' . "\n";
  echo '</tr>' . "\n";
  echo '<tr align="center">' . "\n";
  echo '<td style="vertical-align: top;" width="50%">' . "\n";
  echo '<ul id="adminpretty" class="AddRows">';
  $YesNo = ( $dfw_getsets['user_ip'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  $tippy = htmlentities( '<font style="color: ' . $textcolor2 . ';">' . _DFW_TIP_USERIP . '</font><br /><br />' );

  AddTwoColumnRow( '' . _DFW_USERIP . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />', '' . $tippy . '' );

  $YesNo = ( $dfw_getsets['avatars'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  $tippy = htmlentities( '<font style="color: ' . $textcolor2 . ';">' . _DFW_TIP_AVATAR . '</font><br /><br />' );
  AddTwoColumnRow( '' . _DFW_AVATARS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />', '' . $tippy . '' );

  $YesNo = ( $dfw_getsets['prvt_msgs'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_PM . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['site_points'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_SPOINTS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['user_posts'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_USERPOSTS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );
  $YesNo = ( $dfw_getsets['show_ranks'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_SHOWRANKS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['online_users'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_ONUSERS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['online_guests'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_ONGUESTS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['tooltip'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_BLOCKTOOLTIPS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['prvt_msgs_voice'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_PMVOICEOVER . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['show_hits'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_SHOWHITS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

/*  $YesNo = ( $dfw_getsets['member_flags'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_MEMFLAGS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['guest_flags'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_GUESTFLAGS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );
*/
  echo '</ul>';
  echo '</td><td style="vertical-align: top;">';
  echo '<ul id="adminpretty1" class="AddRows">';

  $YesNo = ( $dfw_getsets['show_most'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_SHOWMOST . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['nsn_groups'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  $tippy = htmlentities( '<font style="color: ' . $textcolor2 . ';">' . _DFW_TIP_NSNGROUPS . '</font><br /><br />' );
  AddTwoColumnRow( '' . _DFW_NSNGROUPS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />', '' . $tippy . '' );

  $YesNo = ( $dfw_getsets['bbgroups'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  $tippy = htmlentities( '<font style="color: ' . $textcolor2 . ';">' . _DFW_TIP_BBGROUPS . '</font><br /><br />' );
  AddTwoColumnRow( '' . _DFW_MEMBERSHIPS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />', '' . $tippy . '' );

  $YesNo = ( $dfw_getsets['memberships'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_SHOWMEMSHIPS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );
  $nameMaxLength = intval( $dfw_getsets['username_length'] );
  $displayNameLength = '<font style="font-size: 14px;font-weight: bold;">' . $nameMaxLength . '</font>';
  ;
  AddTwoColumnRow( '' . _DFW_MAXUNAME . '', '' . $displayNameLength . '' );

  $YesNo = ( $dfw_getsets['online_image'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  $tippy = htmlentities( '<font style="color: ' . $textcolor2 . ';">' . _DFW_TIP_ONLINEIMAGE . '<br /><br />' . _DFW_TIP_ONLINEIMAGE_2 . '</font><br /><br />' );
  AddTwoColumnRow( '' . _DFW_ONLINEIMAGE . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />', '' . $tippy . '' );

  $YesNo = ( $dfw_getsets['admin_tooltips'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_ADMINTOOLTIPS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['live_online'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_LIVEONLINE . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['server_datetime'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_SVRDATETIME . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $YesNo = ( $dfw_getsets['server_datetime_admin'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_SVRDATETIMEADMIN . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );

  $displayOrder = ( $dfw_getsets['order_mode'] == 1 ) ? '' . _DFW_ORDERUNAME . '' : '' . _DFW_ORDERUID . '';
  ;
  AddTwoColumnRow( '' . _DFW_USERORDER . '', '' . $displayOrder . '' );

  $YesNo = ( $dfw_getsets['bbgroups'] == 1 ) ? '' . $yesImage . '' : '' . $noImage . '';
  AddTwoColumnRow( '' . _DFW_MEMBERSHIPS . '', '<img src="' . $YesNo . '" width="18" height="18" alt="" />' );
  echo '</ul>';
  echo '</td>
  </tr>
</table>';
  echo '</div>';
  // Main Tab END

  // Settings Tab START
  echo '<div align="center" style="display: none;" id="settingsbox">';
  echo '<ul class="AddRows">';
  echo '<li><br /><h3 style="width: 80%;padding: 5px;border: 1px solid;border-color: ' . $bgcolor2 . ';">' . _DFW_TICKBOXS . '</h3><br /></li>';
  echo '</ul>';
  echo '<form method="post" action="' . $admin_file . '.php">';
  echo '<table align="center" width="80%" border="1" cellspacing="0" cellpadding="0">';
  echo '<tr>';
  echo '<th colspan="4">' . _DFW_CHGSETTINGS . '</th>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_USERIP . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xuser_ip" value="1"';
  $checked = ( $dfw_getsets['user_ip'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_AVATARS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xavatars" value="1"';
  $checked = ( $dfw_getsets['avatars'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_PM . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xprvt_msgs" value="1"';
  $checked = ( $dfw_getsets['prvt_msgs'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_SPOINTS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xsite_points" value="1"';
  $checked = ( $dfw_getsets['site_points'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';

  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_USERPOSTS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xuser_posts" value="1"';
  $checked = ( $dfw_getsets['user_posts'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_SHOWRANKS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xshow_ranks" value="1"';
  $checked = ( $dfw_getsets['show_ranks'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_ONUSERS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xonline_users" value="1"';
  $checked = ( $dfw_getsets['online_users'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_ONGUESTS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xonline_guests" value="1"';
  $checked = ( $dfw_getsets['online_guests'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_SHOWHITS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xshow_hits" value="1"';
  $checked = ( $dfw_getsets['show_hits'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_SHOWMOST . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xshow_most" value="1"';
  $checked = ( $dfw_getsets['show_most'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_NSNGROUPS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xnsn_groups" value="1"';
  $checked = ( $dfw_getsets['nsn_groups'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_SHOWMEMSHIPS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xmemberships" value="1"';
  $checked = ( $dfw_getsets['memberships'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_MAXUNAME . '</td>';
  $nameMaxLength = intval( $dfw_getsets['username_length'] );
  echo '<td align="center">';
  echo '<input type="text" name="xusername_length" size="2" value="' . $nameMaxLength . '" />';
  echo '</td>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_ONLINEIMAGE . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xonline_image" value="1"';
  $checked = ( $dfw_getsets['online_image'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_ADMINTOOLTIPS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xadmin_tooltips" value="1"';
  $checked = ( $dfw_getsets['admin_tooltips'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_LIVEONLINE . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xlive_online" value="1"';
  $checked = ( $dfw_getsets['live_online'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_SVRDATETIME . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xserver_datetime" value="1"';
  $checked = ( $dfw_getsets['server_datetime'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_SVRDATETIMEADMIN . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xserver_datetime_admin" value="1"';
  $checked = ( $dfw_getsets['server_datetime_admin'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_PMVOICEOVER . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xprvt_msgs_voice" value="1"';
  $checked = ( $dfw_getsets['prvt_msgs_voice'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_USERORDER . '</td>';
  $selected = ' selected="selected"';
  echo '<td align="center">';
  //echo '<input type="text" name="xorder_mode" value="' . $displayOrder . '" />';
  echo '<select name="xorder_mode">';
  if ( $dfw_getsets['order_mode'] == 1 ) {
    echo '<option value="1"' . $selected . '>Username</option>';
    echo '<option value="0">User ID</option>';
  } else {
    echo '<option value="1">Username</option>';
    echo '<option value="0"' . $selected . '>User ID</option>';
  }
  echo '</select>';
  echo '</td>';
  echo '</tr>';

  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_MEMBERSHIPS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xbbgroups" value="1"';
  $checked = ( $dfw_getsets['bbgroups'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
/*  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_MEMFLAGS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xmember_flags" value="1"';
  $checked = ( $dfw_getsets['member_flags'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';*/
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;Next One Here</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xbbgroups" value="1"';
  $checked = ( $dfw_getsets['bbgroups'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
 /*  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_GUESTFLAGS . '</td>';
 echo '<td align="center">';
  echo '<input type="checkbox" name="xguest_flags" value="1"';
  $checked = ( $dfw_getsets['guest_flags'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';*/
	echo '</table>';
	echo '<br /><br />';
	echo '<table align="center" width="80%" border="1" cellspacing="0" cellpadding="0">';
	    echo '<tr>';
    echo '<th colspan="4">' . _DFW_CHGFOTO . '</th>';
    echo '</tr>';
	echo '<tr>';
	echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;'._DFW_IMGDIMENSIONS.'</td>';
	echo '<td align="center">';
    echo '<input type="text" name="xfotodimensions" value="' . $dfw_getsets['fotodimensions'] . '" />';
    echo '</td>';
 /*	echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_GUESTFLAGS . '</td>';
	echo '<td align="center">';
    echo '<input type="checkbox" name="xguest_flags" value="1"';
	$checked = ($dfw_getsets['guest_flags'] == 1) ? ' checked="checked"' : '';
	echo '' . $checked . ' />';
    echo '</td>';
	echo '</tr>'; */
	
	


  echo '</table>';
  echo '<br />';
  echo '<input name="op" type="hidden" value="DFWSaveSettings" />';
  echo '<input name="submit" type="submit" value="submit" />';
  echo '</form>';
  echo '</div>';
  // Settings Tab END

  // Tooltip Tab START
  echo '<div align="center" style="display: none;" id="tooltipbox">';
  echo '<ul class="AddRows">';
  echo '<li><br /><h3 style="width: 80%;padding: 5px;border: 1px solid;border-color: ' . $bgcolor2 . ';">' . _DFW_TIPSETTINGS . '</h3><br /></li>';
  echo '</ul>';
  echo '<form method="post" action="' . $admin_file . '.php">';
  echo '<table align="center" width="80%" border="1" cellspacing="0" cellpadding="0">';
  echo '<tr>';
  echo '<th colspan="2">' . _DFW_CHGSETTINGS . '</th>';
  echo '</tr>';
  echo '<tr>';
  $OnOff = ( $dfw_getsets['tooltip'] == 1 ) ? '' . _DFW_TOOLTIP_2 . '' : '' . _DFW_TOOLTIP_3 . '';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TOOLTIP . '&nbsp;<font style="color: red;font-weight: bold;">(' . $OnOff . ')</font></td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xtooltip" value="1"';
  $checked = ( $dfw_getsets['tooltip'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';

  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPBGCOLOR . '</td>';
  $TooltipBgColor = $dfw_getsets['tooltip_bgcolor'];
  echo '<td align="center">';
  echo '<input type="text" name="xtooltip_bgcolor" size="9" maxlength="7" value="' . $TooltipBgColor . '" />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPTXTCOLOR . '</td>';
  $TooltipTxtColor = $dfw_getsets['tooltip_txtcolor'];
  echo '<td align="center">';
  echo '<input type="text" name="xtooltip_txtcolor" size="9" maxlength="7" value="' . $TooltipTxtColor . '" />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPBDRCOLOR . '</td>';
  $TooltipBorderColor = $dfw_getsets['tooltip_bordercolor'];
  echo '<td align="center">';
  echo '<input type="text" name="xtooltip_bordercolor" size="9" maxlength="7" value="' . $TooltipBorderColor . '" />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPBDRSIZE . '</td>';
  $TooltipBorderSize = intval( $dfw_getsets['tooltip_bordersize'] );
  echo '<td align="center">';
  echo '<input type="text" name="xtooltip_bordersize" size="2" maxlength="1" value="' . $TooltipBorderSize . '" />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPBDRTYPE . '</td>';
  echo '<td align="center">';
  echo '<select name="xtooltip_bordertype">';
  echo '<option value="">&nbsp;</option>';
  $SetBorderType = $dfw_getsets['tooltip_bordertype'];
  $DFW_Type = array( 'solid', 'dashed', 'dotted', 'double', 'groove', 'hidden', 'inset', 'outset', 'ridge' );
  foreach ( $DFW_Type as $value ) {
    echo '<option value="' . $value . '"';
    if ( $SetBorderType == $value ) {
      echo ' selected="selected"';
    }
    echo '>' . $value . '</option>';
  }
  unset( $value ); // break the reference with the last element
  echo '</select>';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPOPACITY . '</td>';
  $TooltipOpacity = intval( $dfw_getsets['tooltip_opacity'] );
  echo '<td align="center">';
  echo '<input type="text" name="xtooltip_opacity" size="2" maxlength="1" value="' . $TooltipOpacity . '" />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPPADDING . '</td>';
  $TooltipPadding = intval( $dfw_getsets['tooltip_padding'] );
  echo '<td align="center">';
  echo '<input type="text" name="xtooltip_padding" size="3" maxlength="2" value="' . $TooltipPadding . '" />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPAVATAR . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xtooltip_avatar" value="1"';
  $checked = ( $dfw_getsets['tooltip_avatar'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPUSERNAME . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xtooltip_username" value="1"';
  $checked = ( $dfw_getsets['tooltip_username'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPEMAIL . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xtooltip_email" value="1"';
  $checked = ( $dfw_getsets['tooltip_email'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPREGDATE . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xtooltip_regdate" value="1"';
  $checked = ( $dfw_getsets['tooltip_regdate'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPPOSTS . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xtooltip_posts" value="1"';
  $checked = ( $dfw_getsets['tooltip_posts'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td align="left" ' . $MouseyOver . ' ' . $MouseyOut . '>&nbsp;' . _DFW_TIPTHEME . '</td>';
  echo '<td align="center">';
  echo '<input type="checkbox" name="xtooltip_theme" value="1"';
  $checked = ( $dfw_getsets['tooltip_theme'] == 1 ) ? ' checked="checked"' : '';
  echo '' . $checked . ' />';
  echo '</td>';
  echo '</tr>';
  echo '</table>';
  echo '<br />';
  echo '<input name="op" type="hidden" value="DFWSaveTooltips" />';
  echo '<input name="submit" type="submit" value="submit" />';
  echo '</form>';
  echo '</div>';
  // Tooltip Tab END


  // Image Tab START
  echo '<div align="center" style="display: none;" id="imagebox">';
  echo '<ul class="AddRows">';
  echo '<li><br /><h3 style="width: 80%;padding: 5px;border: 1px solid;border-color: ' . $bgcolor2 . ';">' . _DFW_IMAGESETTINGS . '</h3><br /></li>';
  echo '</ul>';
  echo '<div align="center">';
  echo '<br />';
  echo '<a class="button" href="' . $admin_file . '.php?op=DFWTagImage"><span>' . _DFW_ADDIMAGE . '</span></a>';
  echo '<br /><br />';
  echo '</div>';

  echo "
		<script language=\"javascript\" type=\"text/javascript\">
			function update_pic(newimage) {
				document.pic_image.src = 'images/DFW/admin/' + newimage;
			}
		</script>";
  echo "<table border='1' cellpadding='3' cellspacing='0' align='center'>";
  $result = $db->sql_query( "SELECT w.pic, w.view, w.king, w.gname FROM " . $prefix . "_dfw_img AS w LEFT JOIN " . $user_prefix . "_users AS u ON u.username = w.view" );

  while ( list($pic, $view, $king, $gname) = $db->sql_fetchrow($result) ) {

    echo '<tr><td valign="middle" align="center">' . $view . '&nbsp;<img src="images/DFW/admin/' . $pic . '" border="0" alt="' . $pic . '" /></td>';

    $img = ( $king == 1 ) ? 'admin.png' : 'msg.png';
    echo '<td valign="middle" align="center"><img src="images/DFW/admin/' . $img . '" alt="' . $img . '" border="0" /></td><td valign="middle" align="center">';

    echo '<a href="' . $admin_file . '.php?op=DFWEditStaff&amp;s=' . $view . '"><img src="images/DFW/edit.gif" title="Edit" border="0" alt="Edit" /></a>';

    echo '<a href="' . $admin_file . '.php?op=DFWDeleteStaff&amp;user_is=' . $view . '"><img src="images/DFW/delete.gif" alt="Delete" border="0" /></a></td>';

    $NoGroup = ( empty($gname) ) ? _DFW_NOGROUPSEL : $gname;
    echo '<td valign="middle" align="center">' . $NoGroup . '</td></tr>';
  }
  echo '</table><br />';

	$result = $db->sql_query("SELECT u.username FROM ".$user_prefix."_users AS u LEFT JOIN ".$prefix."_dfw_img i ON u.username=i.view WHERE u.user_id > 1 AND i.view IS NULL ORDER BY u.username");

  $ut = $db->sql_numrows( $result );
  $lista = array();
	while ($listuser = $db->sql_fetchrow($result)) 
		array_push($lista, $listuser['username']);

  // Need a better way to show a lot of users.
  /*
  if (!empty($ut) && $ut > 500) {
  echo '<table border="1" cellpadding="3" cellspacing="0" align="center">' . "\n";
  echo '<tr>' . "\n";
  echo '<td align="middle" colspan="2"><strong>User Selection</strong></td>' . "\n";
  echo '</tr><tr>' . "\n";
  echo '<td align="right">List selector</td>' . "\n";
  echo '<td align="left">' . "\n";	
  }
  */
  echo '<form action="'.$admin_file.'.php" method="post">';
  echo '<select name="add_name">';
  //$p = $_GET['p'];
  //if (isset($p) && (($p - 1) * 500) < $ut) { 
  //$inizio = ($p - 1) * 500; 
  //} else {
  $inizio = 0;
  //}
  $fine = $inizio + 899; 
  if ($fine > $ut - 1) { 
  $fine = $ut - 1;
  }
  for ($u = $inizio; $u <= $fine; $u++) {
  echo '<option value="'.$lista[$u].'">'.$lista[$u].'</option>';
  }
  echo '</select>';
  // Need a better way to show a lot of users.
  /*
  if ($ut > 500) {
  $tp = floor($ut / 500);
  $np = $tp + (fmod($ut, 500) > 0 ? 1 : 0);
  $lp = '';
  for ($p = 1; $p < $np; $p++) 
  $lp .= '<a href="'.$admin_file.'.php?op=DFWAdmin&amp;p='.$p.'">'.$p.'</a> | ';
  $lp .= '<a href="'.$admin_file.'.php?op=DFWAdmin&amp;p='.$np.'">'.$np.'</a>';
  echo '</td>' . "\n";
  echo '</tr>' . "\n";
  echo '<tr>' . "\n";
  echo '<td align="right">' . _DFW_PAGESEL . '</td>' . "\n";
  echo '<td align="left">' . $lp . '</td>' . "\n";
  echo '</tr>' . "\n";
  echo '<tr>' . "\n";
  echo '<td align="right">' . _DFW_MANINPUT . '</td>' . "\n";
  echo '<td align="left">' . "\n";
  echo '<input type="text" name="manual_name" value="" title="' . _DFW_EMPTYTOUSESEL . '" />' . "\n";
  echo '</td>' . "\n";
  echo '</tr>' . "\n";
  echo '</td></tr></table><br />';
  } else {
  echo '&nbsp;';
  }
  */
	
  echo '&nbsp;' . _DFW_IMAGE . ':&nbsp;<select id="MyImage" name="add_pic">';
  echo '<option value="blank.gif" selected="selected">' . _DFW_SELIMAGE . '</option>';
  $handle = opendir('images/DFW/admin/');
  $tlist = '';
  while ($file = readdir($handle)) 
  if (preg_match("#.*\.(png|gif|jpg|jpeg)$#", $file)) $tlist .= "$file|";
  closedir($handle);
  $tlist = explode("|", $tlist);
  sort($tlist);
  for ($i = 0; $i < sizeof($tlist); $i++) if ($tlist[$i] != "")
    echo '<option value="' . $tlist[$i] . '">' . $tlist[$i] . '</option>';
  echo '</select>&nbsp;';

  echo '<img id="NewPic" src="images/DFW/admin/blank.gif" alt="" />';
  echo '&nbsp;<img src="images/DFW/admin/admin.png" border="0" alt="" />';
  $StaffTip = htmlentities(''._DFW_TIP_ADMINICON1.' - '._DFW_TIP_ADMINICON2.' - <img src="images/DFW/admin/admin.png" border="0" alt="" />&nbsp;'._DFW_TIP_ADMINICON3.'');	
  echo '<input type="checkbox" name="add_king" id="add_king" value="1" /><label for="add_king"><span id="pretty" title="'.$StaffTip.'">' . _DFW_STAFF . '</span></label>';
  echo '&nbsp;&nbsp;&nbsp;<select name="gname">';
  echo '<option value="">' . _DFW_GROUPSEL . '</option>';

  $i = 0;
  $fmsql = "SELECT * FROM ".$prefix."_bbgroups WHERE group_single_user = '0'";
  if( !($fmresult = $db->sql_query($fmsql)) ){
  echo _DFW_DBGROUPSTBL;
  exit();
  }
  while ($groups = $db->sql_fetchrow($fmresult))
  {

  $group_name = $groups['group_name'];

  echo "<option value='".$group_name."'>".$group_name."</option>";

  }
  echo "</select>";
  //echo '<input type="hidden" name="add_name" value="" />';
  echo '<input type="hidden" name="op" value="DFWSaveStaff" />';
  echo "<br /><br /><input type='submit' value='Add User To Database' />";
  echo "</form>";
  echo "<br />";


  $BckImgSql = $db->sql_query( "SELECT * FROM `" . $prefix . "_dfw_block_img`" );
  $BckImgResult = $db->sql_fetchrow( $BckImgSql );

  echo '<a class="button" id="toggle-block" href="#"><span><strong>' . _DFW_BLOCKIMAGES . '</strong></span></a>';
  echo '<a class="button" id="toggle-blocktip" href="#"><span><strong>' . _DFW_TOOLTIPIMAGES . '</strong></span></a>';
  echo '<br /><br />';


  echo '<div id="blockstoggle" style="display: none;">';
  OpenTable2();
  echo '<center>';
  echo '<br /><br />';
  echo "<form action=\"" . $admin_file . ".php\" method=\"post\">";
  echo '<table width="80%">';

tblAddThreeColumnRow(_DFW_ACCOUNTINFO, '<input name="account_info" type="text" size="65" value="'.$BckImgResult['account_info'].'" />', '<img src="'.$BckImgResult['account_info'].'" alt="" />'); 
tblAddThreeColumnRow(_DFW_BL_MEMSTATS, '<input name="member_ship" type="text" size="65" value="'.$BckImgResult['member_ship'].'" />', '<img src="'.$BckImgResult['member_ship'].'" vspace="2" alt="" />'); 
tblAddThreeColumnRow(_DFW_MOSTONLINE, '<input name="most_online" type="text" size="65" value="'.$BckImgResult['most_online'].'" />', '<img src="'.$BckImgResult['most_online'].'" alt="" />');
tblAddThreeColumnRow(_DFW_ONLINESTATS, '<input name="online_stats" type="text" size="65" value="'.$BckImgResult['online_stats'].'" />', '<img src="'.$BckImgResult['online_stats'].'" alt="" />'); 

tblAddThreeColumnRow(_DFW_PAGEVIEWS, '<input name="page_views" type="text" size="65" value="'.$BckImgResult['page_views'].'" />', '<img src="'.$BckImgResult['page_views'].'" alt="" />'); 
tblAddThreeColumnRow(_DFW_MEMBERSHIPS, '<input name="member_group" type="text" size="65" value="'.$BckImgResult['member_group'].'" />', '<img src="'.$BckImgResult['member_group'].'" alt="" />'); 
tblAddThreeColumnRow(_DFW_MEMBERS, '<input name="online_mem" type="text" size="65" value="'.$BckImgResult['online_mem'].'" />', '<img src="'.$BckImgResult['online_mem'].'" alt="" />'); 
tblAddThreeColumnRow('sub_img', '<input name="sub_img" type="text" size="65" value="'.$BckImgResult['sub_img'].'" />', '<img src="'.$BckImgResult['sub_img'].'" alt="" />'); 
  echo '</table>';
  echo "<input type=\"hidden\" name=\"op\" value=\"DFWSaveImageSettings\" />";
  echo "<br /><br />";
  echo "<input type=\"submit\" value=\"Save Image Settings\" />";
  echo "</form>";
  echo '</center>';
  CloseTable2();
  echo '</div>';


  // START Custom Tooltip Images
  $ImgSql = $db->sql_query( "SELECT * FROM `" . $prefix . "_dfw_tooltip_img`" );
  $ImgResult = $db->sql_fetchrow( $ImgSql );

  echo '<div align="center" id="blockstip-toggle" style="display: none;">';
  OpenTable2();
  echo '<center>';
  echo '<br /><br />';
  echo "<form action=\"" . $admin_file . ".php\" method=\"post\">";
  echo '<table width="80%">';

tblAddThreeColumnRow(_DFW_TOOLTIPUNAME, '<input name="tipimage_username" type="text" size="65" value="'.$ImgResult['tipimage_username'].'" />' ,'<img src="'.$ImgResult['tipimage_username'].'" alt="" />');
tblAddThreeColumnRow(_DFW_TOOLTIPEMAIL, '<input name="tipimage_email" type="text" size="65" value="'.$ImgResult['tipimage_email'].'" />' ,'<img src="'.$ImgResult['tipimage_email'].'" alt="" />');
tblAddThreeColumnRow(_DFW_TOOLTIPREGDATE, '<input name="tipimage_regdate" type="text" size="65" value="'.$ImgResult['tipimage_regdate'].'" />' ,'<img src="'.$ImgResult['tipimage_regdate'].'" alt="" />');
tblAddThreeColumnRow(_DFW_TOOLTIPGROUP, '<input name="tipimage_group" type="text" size="65" value="'.$ImgResult['tipimage_group'].'" />' ,'<img src="'.$ImgResult['tipimage_group'].'" alt="" />');
tblAddThreeColumnRow(_DFW_TOOLTIPPOSTS, '<input name="tipimage_posts" type="text" size="65" value="'.$ImgResult['tipimage_posts'].'" />' ,'<img src="'.$ImgResult['tipimage_posts'].'" alt="" />');
tblAddThreeColumnRow(_DFW_TOOLTIPTHEME, '<input name="tipimage_theme" type="text" size="65" value="'.$ImgResult['tipimage_theme'].'" />' ,'<img src="'.$ImgResult['tipimage_theme'].'" alt="" />');

  echo '</table>';
  echo "<input type=\"hidden\" name=\"op\" value=\"DFWSaveTooltipImageSettings\" />";
  echo "<br /><br />";
  echo "<input type=\"submit\" value=\"Save Image Settings\" />";
  echo "</form>";
  echo '</center>';
  CloseTable2();
  echo '</div>';
  // END Custom Tooltip Images
  echo '</div>'; // Image Tab END
  CloseTable();
  include_once ( 'footer.php' );
}

function DFWTagImage() {
global $admin_file, $dfw_getsets;
include_once('includes/classes/class.foto_upload.php');
  include_once ( 'header.php' );
  OpenTable();
  echo '<div align="center">';
  echo '<a href="' . $admin_file . '.php?op=DFWAdmin">';
  echo '<strong>' . _DFW_SITEINFOADMIN . '</strong></a>';
  echo '<br /><a href="' . $admin_file . '.php">';
  echo '<strong>' . _DFW_BACKADMIN . '</strong></a>';
  echo '</div>';
  CloseTable();
  OpenTable();
$dimension = $dfw_getsets['fotodimensions'];
$max_size = 1024*1024; // the max. size for uploading
  $foto_upload = new Foto_upload;

$foto_upload->upload_dir = 'images/DFW/admin/'; // "files" is the folder for the uploaded files (you have to create these folder)
$foto_upload->foto_folder = 'images/DFW/admin/';
$foto_upload->thumb_folder = 'images/DFW/admin/';
$foto_upload->extensions = array('.png', '.gif', '.jpg'); // specify the allowed extension(s) here
$foto_upload->language = 'en';
$foto_upload->x_max_size = $dimension;
$foto_upload->y_max_size = $dimension;
$foto_upload->x_max_thumb_size = $dimension;
$foto_upload->y_max_thumb_size = $dimension;
/*
$my_upload = new Foto_upload;

$my_upload->upload_dir = 'images/DFW/admin/'; // "files" is the folder for the uploaded files (you have to create this folder)
$my_upload->foto_folder = 'images/DFW/admin/';
$my_upload->thumb_folder = 'images/DFW/admin/';
$my_upload->extensions = array(".png", ".gif", ".jpg"); // specify the allowed extensions here

//$my_upload->extensions = "en"; // use this to switch the messages into an other language (translate first!!!)
$my_upload->max_length_filename = 50; // change this value to fit your field length in your database (standard 100)
$my_upload->rename_file = false;
$my_upload->x_max_size = 80;
$my_upload->y_max_size = 80;
*/
if(isset($_POST['Submit'])) {
    $foto_upload->the_temp_file = $_FILES['upload']['tmp_name'];
    $foto_upload->the_file = $_FILES['upload']['name'];
    $foto_upload->http_error = $_FILES['upload']['error'];
    $foto_upload->replace = ( isset($_POST['replace']) ) ? $_POST['replace'] : "n"; // because only a checked checkboxes is true
	$foto_upload->do_filename_check = (isset($_POST['check'])) ? $_POST['check'] : "n"; // use this boolean to check for a valid filename
	$new_name = (isset($_POST['name'])) ? $_POST['name'] : "";
	if ($foto_upload->upload($new_name)) { // new name is an additional filename information, use this to rename the uploaded file
		$foto_upload->process_image();
		//$full_path = $my_upload->file_copy;
		//$info = $my_upload->get_uploaded_file_info($full_path);
		$Image = 'images/DFW/admin/'.$foto_upload->file_copy;
		// ... or do something like insert the filename to the database
  }
}// the code to create the test table
echo '<form enctype="multipart/form-data" method="post" action="'.$admin_file.'.php?op=DFWTagImage">' . "\n";
  echo '<input type="hidden" name="MAX_FILE_SIZE" value="'.$max_size.'" /><br />' . "\n";
  echo '<label for="upload">' . _DFW_TAGSELFILE . '</label><input type="file" name="upload" size="30" /><br clear="all" />' . "\n";
  echo '<label for="name">' . _DFW_TAGNEWNAME . '</label><input type="text" name="name" size="8" />' . _DFW_NOEXT . '<br clear="all" />' . "\n";
  echo '<label for="replace">' . _DFW_TAGREPLACE . '</label><input type="checkbox" name="replace" value="y" /><br clear="all" />' . "\n";
  echo '<input name="check" type="hidden" value="y" checked /><br clear="all" />' . "\n";
  echo '<input style="margin-left:120px;" type="submit" name="Submit" value="Submit" />' . "\n";
  echo '</form>' . "\n";
  echo '<br clear="all" />';
echo $foto_upload->show_error_string();
if (!empty($Image)) {
echo '<img src="'.$Image.'" alt="" />' . "\n";
}
  echo '</div>' . "\n";
  CloseTable();
  include_once ( 'footer.php' );

}


function DFWSaveStaff() {
  global $db, $prefix, $user_prefix, $admin_file;
  $add_pic = ( isset($_POST['add_pic']) ? $_POST['add_pic'] : '' );
  $add_king = ( isset($_POST['add_king']) ? $_POST['add_king'] : 0 );
  $gname = ( isset($_POST['gname']) ? $_POST['gname'] : '' );
  if ( isset($_POST['add_name']) ) {
    $add_name = $_POST['add_name'];
  }
  $tmp = $db->sql_query( "SELECT user_id FROM " . $user_prefix . "_users WHERE username = '$add_name'" );
  $tmp = $db->sql_query( "SELECT user_id FROM " . $user_prefix . "_users WHERE username = '$add_name'" );
  $tmpResult = $db->sql_numrows( $tmp );
  if ( $db->sql_numrows($tmp) != 1 ) {
    include_once ( 'header.php' );
    OpenTable();
    echo "<center><strong>ERROR: The user " . $add_name . " does not exist.<br /><br />" . _GOBACK . "</strong></center>";
    CloseTable();
    include_once ( 'footer.php' );
  } else {
    $db->sql_query( "INSERT INTO " . $prefix . "_dfw_img (pic, view, king, gname) VALUES ('$add_pic', '$add_name', '$add_king', '$gname')" );
    Header( "Location: " . $admin_file . ".php?op=DFWAdmin" );
  }
}

function DFWEditStaff( $s )
{
  global $db, $prefix, $admin_file, $user_prefix;
  include_once ( 'header.php' );
  OpenTable();
  echo '<div align="center">';
  echo '<a href="' . $admin_file . '.php?op=DFWAdmin">';
  echo '<strong>' . _DFW_SITEINFOADMIN . '</strong></a>';
  echo '<br /><a href="' . $admin_file . '.php">';
  echo '<strong>' . _DFW_BACKADMIN . '</strong></a>';
  echo '</div>';
  CloseTable();
  OpenTable();
  echo '<script language="javascript" type="text/javascript">
			function update_pic(newimage) {
				document.pic_image.src = "images/DFW/admin/" + newimage;
			}
		</script>';
  $result = $db->sql_query( "SELECT pic, king, gname FROM " . $prefix . "_dfw_img AS w LEFT JOIN " . $user_prefix . "_users AS u ON u.username = w.view WHERE view = '$s'" );
  echo '<center><table width="220" border="1" cellpadding="1" cellspacing="1" align="center"><tr>';
  list( $pic, $king, $gname ) = $db->sql_fetchrow( $result );

  $img = ( $king == 1 ) ? 'admin.png' : 'msg.png';
  echo '<strong><font class="title">Editing ' . $s . '</font><br /><br />' . _GOBACK . '</strong><br /><br /><br />';
  echo '<td valign="middle" align="center">' . $s . ' <img src="images/DFW/admin/' . $pic . '" name="pic_image" alt="" border="0" /></td><td valign="middle" align="center"><img src="images/DFW/admin/' . $img . '" alt="" border="0" /></td>';
  if ( !$gname ) {
    echo '<td valign="middle" align="center">No group Selected</td>';
  } else {
    echo '<td valign="middle" align="center">' . $gname . '</td>';
  }
  echo '</tr></table><br /><br />';
  echo '
		<form action="' . $admin_file . '.php?op=DFWUpdateStaff" method="post">
			Image <select name="pic" onchange="update_pic(this.options[selectedIndex].value);">
	';
  echo '<option selected="selected">' . _DFW_SELIMAGE . '</option>';
  $handle = opendir( "images/DFW/admin/" );
  $tlist = '';
  while ( $file = readdir($handle) )
    if (preg_match("#.*\.(png|gif|jpg|jpeg)$#", $file))
      $tlist .= "$file|";
  closedir( $handle );
  $tlist = explode( "|", $tlist );
  sort( $tlist );
  for ( $i = 0; $i < sizeof($tlist); $i++ ) {
    if ( $tlist[$i] != "" ) {
      if ($tlist[$i] == $pic)
        $sel = 'selected="selected"';
      else
        $sel = '';
      echo '<option value="' . $tlist[$i] . '" ' . $sel . '>' . $tlist[$i] . '</option>';
    }
  }
  echo '</select>&nbsp;';
  echo '<img src="images/DFW/admin/admin.png" border="0" alt="" />';
  echo '<input type="checkbox" name="king" id="king" value="1" /><label for="king">' . _DFW_STAFF . '</label>';
  echo '&nbsp;&nbsp;&nbsp;<select name="gname"><option value="">' . _DFW_GROUPSEL . '</option>';

  $i = 0;
  $fmsql = "SELECT * FROM " . $prefix . "_bbgroups WHERE group_single_user = '0'";
  if ( !($fmresult = $db->sql_query($fmsql)) ) {
    echo _DFW_DBGROUPSTBL;
    exit();
  }
  while ( $groups = $db->sql_fetchrow($fmresult) ) {
    $group_name = $groups['group_name'];
    if ( $gname == $group_name ) {
      echo '<option selected="' . $group_name . '">' . $group_name . '</option>';
    } else {
      echo '<option value="' . $group_name . '">' . $group_name . '</option>';
    }
  }
  echo '</select>';
  echo '		<br /><br /><input type="submit" value="Update User" />';
  echo '		<input type="hidden" name="urid" value="' . $s . '" />';
  echo '	</form>';
  echo '	</center><br />';
  echo '<div align="right"><a href="http://www.platinumnukepro.com">&copy; Platinum Nuke Pro</a></div>';
  CloseTable();
  include_once ( 'footer.php' );
}


function DFWUpdateStaff($urid) {
  global $prefix, $db, $admin_file, $bgcolor2, $textcolor2;
  include_once ( 'header.php' );
  OpenTable();

  $pic = ( isset($_POST['pic']) ? $_POST['pic'] : '' );
  $king = ( isset($_POST['king']) ? $_POST['king'] : 0 );
  $gname = ( isset($_POST['gname']) ? $_POST['gname'] : '' );

  $db->sql_query( 'UPDATE ' . $prefix . '_dfw_img SET pic=\'' . $pic . '\', king = \'' . $king . '\', gname=\'' . $gname . '\' WHERE view=\'' . $urid . '\'' );

  echo '<div align="center" style="color: ' . $textcolor2 . ';background-color: ' . $bgcolor2 . ';">';
  echo '<h3><br />' . _DFW_DBSUCCESS . '<br />' . _DFW_DBSUCCESS_2 . '<br /><br /></h3>';
  echo '</div>';
  Header( 'Refresh: 3; url=' . $admin_file . '.php?op=DFWAdmin' );
  CloseTable();
  include_once ( 'footer.php' );
}

function DFWDeleteStaff( $user_is )
{
  global $prefix, $db, $admin_file, $bgcolor2, $textcolor2;
  include_once ( 'header.php' );
  OpenTable();

  $user_is = ( isset($_GET['user_is']) ? strip_tags($_GET['user_is']) : '' );

  $db->sql_query( 'DELETE FROM ' . $prefix . '_dfw_img WHERE view=\'' . $user_is . '\'' );


  echo '<div align="center" style="color: ' . $textcolor2 . ';background-color: ' . $bgcolor2 . ';">';
  echo '<h3><br />' . _DFW_DBSUCCESS . '<br />' . _DFW_DBSUCCESS_2 . '<br /><br /></h3>';
  echo '</div>';
  Header( 'Refresh: 3; url=' . $admin_file . '.php?op=DFWAdmin' );
  CloseTable();
  include_once ( 'footer.php' );
}


function DFWSaveSettings()
{
  global $prefix, $db, $admin_file, $dfw_getsets, $bgcolor2, $textcolor2;
  include_once( 'header.php' );
  OpenTable();
  if ( isset($_POST['xuser_ip']) && $_POST['xuser_ip'] == 1 ) {
    $dfw_savesets['user_ip'] = 1;
  } else {
    $dfw_savesets['user_ip'] = 0;
  }
  if ( isset($_POST['xavatars']) && $_POST['xavatars'] == 1 ) {
    $dfw_savesets['avatars'] = 1;
  } else {
    $dfw_savesets['avatars'] = 0;
  }
  if ( isset($_POST['xprvt_msgs']) && $_POST['xprvt_msgs'] == 1 ) {
    $dfw_savesets['prvt_msgs'] = 1;
  } else {
    $dfw_savesets['prvt_msgs'] = 0;
  }
  if ( isset($_POST['xsite_points']) && $_POST['xsite_points'] == 1 ) {
    $dfw_savesets['site_points'] = 1;
  } else {
    $dfw_savesets['site_points'] = 0;
  }
  if ( isset($_POST['xshow_ranks']) && $_POST['xshow_ranks'] == 1 ) {
    $dfw_savesets['show_ranks'] = 1;
  } else {
    $dfw_savesets['show_ranks'] = 0;
  }
  if ( isset($_POST['xuser_posts']) && $_POST['xuser_posts'] == 1 ) {
    $dfw_savesets['user_posts'] = 1;
  } else {
    $dfw_savesets['user_posts'] = 0;
  }
  if ( isset($_POST['xonline_users']) && $_POST['xonline_users'] == 1 ) {
    $dfw_savesets['online_users'] = 1;
  } else {
    $dfw_savesets['online_users'] = 0;
  }
  if ( isset($_POST['xonline_guests']) && $_POST['xonline_guests'] == 1 ) {
    $dfw_savesets['online_guests'] = 1;
  } else {
    $dfw_savesets['online_guests'] = 0;
  }
  if ( isset($_POST['xshow_hits']) && $_POST['xshow_hits'] == 1 ) {
    $dfw_savesets['show_hits'] = 1;
  } else {
    $dfw_savesets['show_hits'] = 0;
  }
  if ( isset($_POST['xshow_most']) && $_POST['xshow_most'] == 1 ) {
    $dfw_savesets['show_most'] = 1;
  } else {
    $dfw_savesets['show_most'] = 0;
  }
  if ( isset($_POST['xnsn_groups']) && $_POST['xnsn_groups'] == 1 ) {
    $dfw_savesets['nsn_groups'] = 1;
  } else {
    $dfw_savesets['nsn_groups'] = 0;
  }
  if ( isset($_POST['xmemberships']) && $_POST['xmemberships'] == 1 ) {
    $dfw_savesets['memberships'] = 1;
  } else {
    $dfw_savesets['memberships'] = 0;
  }
  if ( isset($_POST['xusername_length']) ) {
    $dfw_savesets['username_length'] = intval( $_POST['xusername_length'] );
  }
  if ( isset($_POST['xonline_image']) && $_POST['xonline_image'] == 1 ) {
    $dfw_savesets['online_image'] = 1;
  } else {
    $dfw_savesets['online_image'] = 0;
  }
  if ( isset($_POST['xadmin_tooltips']) && $_POST['xadmin_tooltips'] == 1 ) {
    $dfw_savesets['admin_tooltips'] = 1;
  } else {
    $dfw_savesets['admin_tooltips'] = 0;
  }
  if ( isset($_POST['xlive_online']) && $_POST['xlive_online'] == 1 ) {
    $dfw_savesets['live_online'] = 1;
  } else {
    $dfw_savesets['live_online'] = 0;
  }
  if ( isset($_POST['xserver_datetime']) && $_POST['xserver_datetime'] == 1 ) {
    $dfw_savesets['server_datetime'] = 1;
  } else {
    $dfw_savesets['server_datetime'] = 0;
  }
  if ( isset($_POST['xserver_datetime_admin']) && $_POST['xserver_datetime_admin'] == 1 ) {
    $dfw_savesets['server_datetime_admin'] = 1;
  } else {
    $dfw_savesets['server_datetime_admin'] = 0;
  }
  if ( isset($_POST['xprvt_msgs_voice']) && $_POST['xprvt_msgs_voice'] == 1 ) {
    $dfw_savesets['prvt_msgs_voice'] = 1;
  } else {
    $dfw_savesets['prvt_msgs_voice'] = 0;
  }
  if ( isset($_POST['xorder_mode']) ) {
    $dfw_savesets['order_mode'] = intval( $_POST['xorder_mode'] );
  }
  if ( isset($_POST['xbbgroups']) && $_POST['xbbgroups'] == 1 ) {
    $dfw_savesets['bbgroups'] = 1;
  } else {
    $dfw_savesets['bbgroups'] = 0;
  }
/*  if ( isset($_POST['xmember_flags']) && $_POST['xmember_flags'] == 1 ) {
    $dfw_savesets['member_flags'] = 1;
  } else {
    $dfw_savesets['member_flags'] = 0;
  }
  if ( isset($_POST['xguest_flags']) && $_POST['xguest_flags'] == 1 ) {
    $dfw_savesets['guest_flags'] = 1;
  } else {
    $dfw_savesets['guest_flags'] = 0;
  }
*/	
	$dfw_savesets['fotodimensions'] = isset($_POST['xfotodimensions']) ? intval($_POST['xfotodimensions']) : 20;
		
  foreach ( $dfw_savesets as $key => $value ) {

			$sql = "UPDATE `".$prefix."_dfw_cfg` "
						."SET `cfg_val` = '$value' "
						."WHERE `cfg_nm` = '$key'";


    if ( !$db->sql_query($sql) ) { //Had an error in the UPDATE
      $dfw_dberror = $db->sql_error();
      echo '<p><strong>' . _DFW_ERR_SQL . ': </strong>' . $sql . '</p>';
      echo '<p><strong>' . _DFW_ERR_MSG . ': </strong>' . $dfw_dberror['message'] . '</p>';

      echo 'Error for ' . $key . '<br />';

    }

  } //End of FOREACH
  echo '<div align="center" style="color: ' . $textcolor2 . ';background-color: ' . $bgcolor2 . ';">';
  echo '<h3><br />' . _DFW_DBSUCCESS . '<br />' . _DFW_DBSUCCESS_2 . '<br /><br /></h3>';
  echo '</div>';
  Header( 'Refresh: 3; url=' . $admin_file . '.php?op=DFWAdmin' );
  CloseTable();
  include_once ( 'footer.php' );

}


function DFWSaveTooltips()
{
  global $prefix, $db, $admin_file, $dfw_getsets, $bgcolor2, $textcolor2;
  include_once( 'header.php' );
  OpenTable();
  if ( isset($_POST['xtooltip']) && $_POST['xtooltip'] == 1 ) {
    $dfw_savesets['tooltip'] = 1;
  } else {
    $dfw_savesets['tooltip'] = 0;
  }
  if ( isset($_POST['xtooltip_avatar']) && $_POST['xtooltip_avatar'] == 1 ) {
    $dfw_savesets['tooltip_avatar'] = 1;
  } else {
    $dfw_savesets['tooltip_avatar'] = 0;
  }
  if ( isset($_POST['xtooltip_username']) && $_POST['xtooltip_username'] == 1 ) {
    $dfw_savesets['tooltip_username'] = 1;
  } else {
    $dfw_savesets['tooltip_username'] = 0;
  }
  if ( isset($_POST['xtooltip_email']) && $_POST['xtooltip_email'] == 1 ) {
    $dfw_savesets['tooltip_email'] = 1;
  } else {
    $dfw_savesets['tooltip_email'] = 0;
  }
  if ( isset($_POST['xtooltip_regdate']) && $_POST['xtooltip_regdate'] == 1 ) {
    $dfw_savesets['tooltip_regdate'] = 1;
  } else {
    $dfw_savesets['tooltip_regdate'] = 0;
  }
  if ( isset($_POST['xtooltip_posts']) && $_POST['xtooltip_posts'] == 1 ) {
    $dfw_savesets['tooltip_posts'] = 1;
  } else {
    $dfw_savesets['tooltip_posts'] = 0;
  }
  if ( isset($_POST['xtooltip_theme']) && $_POST['xtooltip_theme'] == 1 ) {
    $dfw_savesets['tooltip_theme'] = 1;
  } else {
    $dfw_savesets['tooltip_theme'] = 0;
  }

  if ( isset($_POST['xtooltip_bgcolor']) ) {
    $tooltip_bgcolor = ( (strlen($_POST['xtooltip_bgcolor']) == 7) ? $_POST['xtooltip_bgcolor'] : '#FFFFFF' );
    $dfw_savesets['tooltip_bgcolor'] = $tooltip_bgcolor;
  }
  if ( isset($_POST['xtooltip_bordercolor']) ) {
    $tooltip_bgcolor = ( (strlen($_POST['xtooltip_bordercolor']) == 7) ? $_POST['xtooltip_bordercolor'] : '#FFFFFF' );
    $dfw_savesets['tooltip_bordercolor'] = $tooltip_bgcolor;
  }
  if ( isset($_POST['xtooltip_txtcolor']) ) {
    $tooltip_txtcolor = ( (strlen($_POST['xtooltip_txtcolor']) == 7) ? $_POST['xtooltip_txtcolor'] : '#000000' );
    $dfw_savesets['tooltip_txtcolor'] = $tooltip_txtcolor;
  }

  if ( isset($_POST['xtooltip_bordersize']) ) {
    $tooltip_bordersize = ( ($_POST['xtooltip_bordersize']) ? intval($_POST['xtooltip_bordersize']) : '1' );
    $dfw_savesets['tooltip_bordersize'] = $tooltip_bordersize;
  }
  if ( isset($_POST['xtooltip_opacity']) ) {
    $tooltip_opacity = ( ($_POST['xtooltip_opacity']) ? intval($_POST['xtooltip_opacity']) : '1' );
    $dfw_savesets['tooltip_opacity'] = $tooltip_opacity;
  }
  if ( isset($_POST['xtooltip_padding']) ) {
    $tooltip_padding = ( ($_POST['xtooltip_padding']) ? intval($_POST['xtooltip_padding']) : '20' );
    $dfw_savesets['tooltip_padding'] = $tooltip_padding;
  }
  if ( isset($_POST['xtooltip_bordertype']) ) {
    $dfw_savesets['tooltip_bordertype'] = $_POST['xtooltip_bordertype'];
  }

  foreach ( $dfw_savesets as $key => $value ) {

			$sql = "UPDATE `".$prefix."_dfw_cfg` "
						."SET `cfg_val` = '$value' "
						."WHERE `cfg_nm` = '$key'";


    if ( !$db->sql_query($sql) ) { //Had an error in the UPDATE
      $dfw_dberror = $db->sql_error();
      echo '<p><strong>' . _DFW_ERR_SQL . ': </strong>' . $sql . '</p>';
      echo '<p><strong>' . _DFW_ERR_MSG . ': </strong>' . $dfw_dberror['message'] . '</p>';

      echo 'Error for ' . $key . '<br />';

    }

  } //End of FOREACH
  echo '<div align="center" style="color: ' . $textcolor2 . ';background-color: ' . $bgcolor2 . ';">';
  echo '<h3><br />' . _DFW_DBSUCCESS . '<br />' . _DFW_DBSUCCESS_2 . '<br /><br /></h3>';
  echo '</div>';
  Header( 'Refresh: 3; url=' . $admin_file . '.php?op=DFWAdmin' );
  CloseTable();
  include_once ( 'footer.php' );

}


function DFWSaveImageSettings()
{
  global $prefix, $db, $admin_file, $bgcolor2, $textcolor2;
  include_once ( 'header.php' );
  OpenTable();

$account_info = (isset($_POST['account_info']) ? $_POST['account_info'] : '');
$member_ship = (isset($_POST['member_ship']) ? $_POST['member_ship'] : '');
$most_online = (isset($_POST['most_online']) ? $_POST['most_online'] : '');
$online_stats = (isset($_POST['online_stats']) ? $_POST['online_stats'] : '');
$page_views = (isset($_POST['page_views']) ? $_POST['page_views'] : '');
$member_group = (isset($_POST['member_group']) ? $_POST['member_group'] : '');
$online_mem = (isset($_POST['online_mem']) ? $_POST['online_mem'] : '');
  $sub_img = ( isset($_POST['sub_img']) ? $_POST['sub_img'] : '' );

$db->sql_query('UPDATE '.$prefix.'_dfw_block_img SET account_info=\''.$account_info.'\', member_ship=\''.$member_ship.'\', most_online=\''.$most_online.'\', online_stats=\''.$online_stats.'\', page_views=\''.$page_views.'\', member_group=\''.$member_group.'\', online_mem=\''.$online_mem.'\', sub_img=\''.$sub_img.'\'');



  echo '<div align="center" style="color: ' . $textcolor2 . ';background-color: ' . $bgcolor2 . ';">';
  echo '<h3><br />' . _DFW_DBSUCCESS . '<br />' . _DFW_DBSUCCESS_2 . '<br /><br /></h3>';
  echo '</div>';
  Header( 'Refresh: 3; url=' . $admin_file . '.php?op=DFWAdmin' );
  CloseTable();
  include_once ( 'footer.php' );
}


function DFWSaveTooltipImageSettings()
{
  global $prefix, $db, $admin_file, $bgcolor2, $textcolor2;
  include_once ( 'header.php' );
  OpenTable();

  $tipimage_username = ( isset($_POST['tipimage_username']) ? $_POST['tipimage_username'] : '' );
  $tipimage_email = ( isset($_POST['tipimage_email']) ? $_POST['tipimage_email'] : '' );
  $tipimage_regdate = ( isset($_POST['tipimage_regdate']) ? $_POST['tipimage_regdate'] : '' );
  $tipimage_group = ( isset($_POST['tipimage_group']) ? $_POST['tipimage_group'] : '' );
  $tipimage_posts = ( isset($_POST['tipimage_posts']) ? $_POST['tipimage_posts'] : '' );
  $tipimage_theme = ( isset($_POST['tipimage_theme']) ? $_POST['tipimage_theme'] : '' );

$db->sql_query('UPDATE '.$prefix.'_dfw_tooltip_img SET tipimage_username=\''.$tipimage_username.'\', tipimage_email=\''.$tipimage_email.'\', tipimage_regdate=\''.$tipimage_regdate.'\', tipimage_group=\''.$tipimage_group.'\', tipimage_posts=\''.$tipimage_posts.'\', tipimage_theme=\''.$tipimage_theme.'\'');



  echo '<div align="center" style="color: ' . $textcolor2 . ';background-color: ' . $bgcolor2 . ';">';
  echo '<h3><br />' . _DFW_DBSUCCESS . '<br />' . _DFW_DBSUCCESS_2 . '<br /><br /></h3>';
  echo '</div>';
  Header( 'Refresh: 3; url=' . $admin_file . '.php?op=DFWAdmin' );
  CloseTable();
  include_once ( 'footer.php' );
}

?>
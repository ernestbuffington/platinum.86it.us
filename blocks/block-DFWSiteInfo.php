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
if ( !defined('BLOCK_FILE') ) {
  die( "Illegal Block File Access" );
}
// Some global definitions
global $user, $anonymous, $prefix, $user_prefix, $db, $gfx_chk, $admin, $cookie, $userinfo, $dfw_getsets, $admin_file, $currentlang, $Default_Theme, $startdate, $nukeurl, $textcolor2, $bgcolor2, $newPM;

// Include the language
if ( file_exists('language/DFWSiteInfo/lang-' . $currentlang . '.php') ) {
  include_once ( 'language/DFWSiteInfo/lang-' . $currentlang . '.php' );
} elseif ( file_exists('language/DFWSiteInfo/lang-english.php') ) {
  include_once ( 'language/DFWSiteInfo/lang-english.php' );
}
cookiedecode( $user );
if ( count($cookie) < 2 ) $uname = '';
else  $uname = $cookie[1];
getusrinfo( $user );
// Define some variables
$nameMaxLength = intval( $dfw_getsets['username_length'] );
$content = '';
// Grab Block Images
$BlockImgSql = $db->sql_query( "SELECT * FROM `" . $prefix . "_dfw_block_img`" );
$BlockImgResult = $db->sql_fetchrow( $BlockImgSql );
$welcImg = '<img src="' . $BlockImgResult['welc_note'] . '" width="16" border="0" alt="Welcome Image" />&nbsp;';
$ipImg = '<img src="' . $BlockImgResult['your_ip'] . '" width="16" border="0" alt="Your IP Image" />&nbsp;';
$postsImg = '<img src="' . $BlockImgResult['posts'] . '" width="16" border="0" alt="Posts Image" />&nbsp;';
$logoutImg = '<img src="' . $BlockImgResult['logout'] . '" width="16" border="0" alt="Logout Image" />&nbsp;';
$pmImg = '<img src="' . $BlockImgResult['pm_img'] . '" width="16" border="0" />&nbsp;';
$pmUnreadImg = '<img src="' . $BlockImgResult['pm_unread'] . '" width="16" border="0" />&nbsp;';
$pmReadImg = '<img src="' . $BlockImgResult['pm_read'] . '" width="16" border="0" />&nbsp;';
$mbrStatsImg = '<img src="' . $BlockImgResult['mbr_stats'] . '" width="16" border="0" />&nbsp;';
$mbrLatest = '<img src="' . $BlockImgResult['mbr_latest'] . '" width="16" border="0" />&nbsp;';
$mbrToday = '<img src="' . $BlockImgResult['mbr_today'] . '" width="16" border="0" />&nbsp;';
$mbrYesterday = '<img src="' . $BlockImgResult['mbr_yesterday'] . '" width="16" border="0" />&nbsp;';
$mbrWaiting = '<img src="' . $BlockImgResult['mbr_waiting'] . '" width="16" border="0" />&nbsp;';
$mbrOverall = '<img src="' . $BlockImgResult['mbr_overall'] . '" width="16" border="0" />&nbsp;';
$bbgroupImg = '<img src="' . $BlockImgResult['bbgroups'] . '" width="16" border="0" />&nbsp;';
$nsngroupImg = '<img src="' . $BlockImgResult['nsngroups'] . '" width="16" border="0" />&nbsp;';
$onlineMemberImg = '<img src="' . $BlockImgResult['online_member'] . '" width="16" border="0" />&nbsp;';
$onlineGuestImg = '<img src="' . $BlockImgResult['online_guest'] . '" width="16" border="0" />&nbsp;';
$subImg = '<img src="' . $BlockImgResult['sub_img'] . '" width="10" border="0" />&nbsp;';
function get_visitor_ip()
{
  if ( getenv('HTTP_CLIENT_IP') ) return getenv( 'HTTP_CLIENT_IP' );
  elseif ( getenv('HTTP_X_FORWARDED_FOR') ) return getenv( 'HTTP_X_FORWARDED_FOR' );
  elseif ( getenv('HTTP_X_FORWARDED') ) return getenv( 'HTTP_X_FORWARDED' );
  elseif ( getenv('HTTP_FORWARDED_FOR') ) return getenv( 'HTTP_FORWARDED_FOR' );
  elseif ( getenv('HTTP_FORWARDED') ) return getenv( 'HTTP_FORWARDED' );
  elseif ( $_SERVER['REMOTE_ADDR'] ) return $_SERVER['REMOTE_ADDR'];
  else  return 'none';
}
function DFWconvertIP( $xip )
{
  global $admin;
  if ( is_admin($admin) ) return $xip;
  $xipx = explode( '.', $xip );
  for ( $i = 2; $i < count($xipx); $i++ ) {
    $xipx[$i] = preg_replace( '/(0|1|2|3|4|5|6|7|8|9)/', 'x', $xipx[$i] );
  }
  return implode( '.', $xipx );
}
function dfw_get_countrytitle( $c2c )
{
  global $prefix, $db;
  $countrytitleinfo = $db->sql_fetchrow( $db->sql_query("SELECT * FROM `" . $prefix . "_nsnst_countries` WHERE `c2c`='$c2c' LIMIT 0,1") );
  if ( !$countrytitleinfo ) {
    $countrytitleinfo['c2c'] = "00";
    $countrytitleinfo['country'] = _AB_UNKNOWN;
  } else {
    if ( !file_exists("images/nukesentinel/countries/" . $countrytitleinfo['c2c'] . ".png") ) {
      $countrytitleinfo['c2c'] = "00";
    }
  }
  return $countrytitleinfo;
}
function dfw_get_country( $tempip )
{
  global $prefix, $db;
  $tempip = str_replace( ".*", ".0", $tempip );
  $tempip = sprintf( "%u", ip2long($tempip) );
  $countryinfo = $db->sql_fetchrow( $db->sql_query("SELECT `c2c` FROM `" . $prefix . "_nsnst_ip2country` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip' LIMIT 0,1") );
  $ctitle = dfw_get_countrytitle( $countryinfo['c2c'] );
  $countryinfo['country'] = ( !empty($ctitle['country']) ) ? '' . $ctitle['country'] . '' : '00';
  $countryinfo['c2c'] = ( !empty($countryinfo['c2c']) ) ? '' . $countryinfo['c2c'] . '' : '00';
  if ( $countryinfo['c2c'] !== "00" ) {
    if ( !file_exists('images/nukesentinel/countries/' . $countryinfo['c2c'] . '.png') ) {
      $countryinfo['c2c'] = "00";
    }
  }
  return $countryinfo;
}
function grab_flag( $c2c )
{
  global $prefix, $db;
  $c2c = strtolower( $c2c );
  list( $xcountry ) = $db->sql_fetchrow( $db->sql_query("SELECT `country` FROM `" . $prefix . "_nsnst_countries` WHERE `c2c`='$c2c' LIMIT 0,1") );
  if ( !file_exists("images/nukesentinel/countries/" . $c2c . ".png") ) {
    return '<img src="images/nukesentinel/countries/00.png" border="0" height="15" width="25" alt="(' . $c2c . ') ' . $xcountry . '" title="(' . $c2c . ') ' . $xcountry . '" />';
  } else {
    return '<img src="images/nukesentinel/countries/' . $c2c . '.png" border="0" height="15" width="25" alt="(' . $c2c . ') ' . $xcountry . '" title="(' . $c2c . ') ' . $xcountry .
      '" />';
  }
}
// Get the last user added to the database and the total users, minus anonymous
$sql = 'SELECT username,user_id FROM ' . $user_prefix . '_users ORDER BY user_id DESC LIMIT 0,1';
$result = $db->sql_query( $sql );
$row = $db->sql_fetchrow( $result );
$lastusername = $row['username'];
$lastuser = $row['user_id'];
$numrows = $db->sql_fetchrow( $db->sql_query('SELECT count(user_id) user_id FROM ' . $user_prefix . '_users') );
$numrows = $numrows['user_id'];
$numrows1 = $numrows - 1;
/*****************************************/
/* Jquery Who's Online            START  */
/*****************************************/
function tooltip_online_display( $members, $guests )
{
  global $prefix, $db, $dfw_getsets;
  $BlockImgSql2 = $db->sql_query( "SELECT * FROM `" . $prefix . "_dfw_block_img`" );
  $BlockImgResult2 = $db->sql_fetchrow( $BlockImgSql2 );
  $subImg = '<img src="' . $BlockImgResult2['sub_img'] . '" width="10" border="0" />&nbsp;';
  $out = '';
  $guest_online_num = $db->sql_numrows( $db->sql_query("SELECT uname FROM " . $prefix . "_session WHERE guest='1' OR guest='3'") );
  $member_online_num = $db->sql_numrows( $db->sql_query("SELECT uname, host_addr FROM " . $prefix . "_session WHERE guest = '0'") );
  $LiveOnline = ( $dfw_getsets['online_users'] == 0 && $dfw_getsets['online_guests'] == 0 ) ? '' : '<strong><u>' . _DFW_LIVEONLINE1 . '</u></strong>';
  $out .= $LiveOnline;
  if ( $dfw_getsets['online_users'] == 1 ) {
    if ( $member_online_num > 10 ) {
      $out .= '<br />' . $subImg . '' . _DFW_MEMBRS . ':&nbsp;<br />';
      $out .= '<div style="border: 0pt none; height: 100px; width: 100%; overflow: auto;">' . $members['text'] . '</div>';
    } else {
      $out .= '<br /><div id="DFWSite">' . $subImg . '' . _DFW_MEMBERS . ':&nbsp;<br />' . $members['text'] . '</div>';
    }
  }
  if ( $dfw_getsets['online_guests'] == 1 ) {
    if ( $guest_online_num > 10 ) {
      $out .= '<br />' . $subImg . '' . _DFW_GSTS . ':&nbsp;<br />';
      $out .= '<div style="border: 0pt none; height: 100px; width: 100%; overflow: auto;">' . $guests['text'] . '</div>';
    } else {
      $out .= '<br />' . $subImg . '' . _DFW_GUEST . ':&nbsp;' . $guests['text'] . '';
    }
  } // online_guests switch END
  $LiveOnlineHr = ( $dfw_getsets['online_users'] == 0 && $dfw_getsets['online_guests'] == 0 ) ? '' : '<hr />';
  $out .= $LiveOnlineHr;
  return $out;
}
function tooltip_get_members_online()
{
  global $prefix, $db, $user_prefix, $cookie, $user, $userinfo, $admin, $Default_Theme, $name, $dfw_getsets, $subImg;
  $out['text'] = '';
  $imagebase = 'images/DFW/';
  $nameMaxLength = intval( $dfw_getsets['username_length'] );
  //$usersord = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_czuser_conf"));
  if ( $dfw_getsets['order_mode'] == 1 ) {
    $order = 'w.uname ASC';
  } else {
    $order = 'u.user_id ASC';
  }
  $i = 1;
  $DFW_ToolTipSQL = ", u.user_email, u.femail, u.user_regdate, u.user_posts, u.theme, u.user_id, u.user_avatar_type, u.user_avatar, u.last_ip";
  $result = $db->sql_query( "SELECT w.uname, u.user_level" . $DFW_ToolTipSQL . " FROM " . $prefix . "_session AS w LEFT JOIN " . $user_prefix .
    "_users AS u ON u.username = w.uname WHERE w.guest = '0' OR w.guest = '2' ORDER BY " . $order . "" );
  $member_online_num = $db->sql_numrows( $result );
  $out['text'] .= '<table>';
  while ( $member_result = $db->sql_fetchrow($result) ) {
    if ( $i < 10 ) {
      $num = '0' . $i;
    } else {
      $num = $i;
    }
    $dfwSql = $db->sql_query( "SELECT pic, king, gname FROM " . $prefix . "_dfw_img WHERE view = '" . $member_result['uname'] . "'" );
    list( $pic, $king, $gname ) = $db->sql_fetchrow( $dfwSql );
    $kingImage = ( (!empty($king) && $king == 1) ? 'admin.png' : 'online.png' );
    $img = $kingImage;
    if ( strlen($member_result['uname']) > $nameMaxLength ) {
      $NameModded = substr( "$member_result[uname]", 0, $nameMaxLength );
      $NameModded .= "...";
    } else {
      $NameModded = $member_result['uname'];
    }
    if ( $member_result['user_level'] == 2 ) {
      $NameModded = '<span style="color: #FFA34F;">' . $NameModded . '</span>';
    } else {
      $NameModded = $NameModded;
    }
    if ( $dfw_getsets['member_flags'] == 1 ) {
      if ( is_user($user) || is_admin($admin) ) {
        $MEMip = $member_result['last_ip'];
        $DFWMemFlag = str_replace( ".*", ".0", $MEMip );
        $DFWMemFlag = sprintf( "%u", ip2long($DFWMemFlag) );
        $DFWMemFlag = dfw_get_country( $DFWMemFlag );
        $DFWMemFlag['c2c'] = strtoupper( $DFWMemFlag['c2c'] );
        $DisplayFLAG = grab_flag( $DFWMemFlag['c2c'] );
      }
    }
    //$link_view = $member_result['url'];
    //$font_color = $member_result['user_color_gc'];
    // Admin will always see real email address
    // if user is using a fake email other uses will see it
    // Guest will see hidden
    if ( is_admin($admin) ) {
      $email = $member_result['user_email'];
    } elseif ( is_user($user) && $userinfo['user_viewemail'] == 1 ) {
      if ( !empty($member_result['femail']) ) {
        $email = $member_result['femail'];
      } else {
        $email = $member_result['user_email'];
      }
    } else {
      $email = _DFW_HIDDEN;
    }
    $registered = $member_result['user_regdate'];
    $posts = $member_result['user_posts'];
    $theme = empty( $member_result['theme'] ) ? $Default_Theme : $member_result['theme'];
    //if ($member_result['module'] == "") {
    //	$where = "Home";
    //} else {
    //	$where = $member_result['module'];
    //}
    $out['text'] .= '<tr>';
    if ( $dfw_getsets['online_image'] == 1 ) {
      $out['text'] .= "<td><img src='" . $imagebase . "" . $img . "' alt=\"\" border='0' />";
    } else {
      $out['text'] .= "<td>$num. ";
    }
    if ( $dfw_getsets['tooltip'] == 1 ) {
      $ImgSql = $db->sql_query( "SELECT * FROM `" . $prefix . "_dfw_tooltip_img`" );
      $ImgResult = $db->sql_fetchrow( $ImgSql );
      $img_u = '<img src="' . $ImgResult['tipimage_username'] . '" width="16" border="0" />&nbsp;';
      $img_e = '<img src="' . $ImgResult['tipimage_email'] . '" width="16" border="0" />&nbsp;';
      $img_r = '<img src="' . $ImgResult['tipimage_regdate'] . '" width="16" border="0" />&nbsp;';
      $img_z = '<img src="' . $ImgResult['tipimage_group'] . '" width="16" border="0" />&nbsp;';
      $img_p = '<img src="' . $ImgResult['tipimage_posts'] . '" width="16" border="0" />&nbsp;';
      $img_t = '<img src="' . $ImgResult['tipimage_theme'] . '" width="16" border="0" />&nbsp;';
// START-Testing - sgtmudd
      $img_w = '<img src="images/DFW/tooltip/where.gif" width="16" border="0" />&nbsp;';
      $img_x = '<img src="images/DFW/tooltip/unknown.gif" width="16" border="0" />&nbsp;';
      $img_m = '<img src="images/DFW/tooltip/male.gif" width="16" border="0" />&nbsp;';
      $img_g = '<img src="images/DFW/tooltip/female.gif" width="16" border="0" />&nbsp;';
// END-Testing - sgtmudd
      $out['text'] .= "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=" . $member_result["uname"] . "\" title=\"";
      if ( $dfw_getsets['tooltip_avatar'] == 1 ) {
        if ( $member_result['user_avatar_type'] == 1 ) {
          $out['text'] .= htmlentities( "<center><img src=\"modules/Forums/images/avatars/" . $member_result['user_avatar'] . "\" /></center><br />" );
        } elseif ( $member_result['user_avatar_type'] == 2 ) {
          $out['text'] .= htmlentities( "<center><img src=\"" . $member_result['user_avatar'] . "\" /></center><br />" );
        } elseif ( $member_result['user_avatar_type'] == 3 ) {
          $out['text'] .= htmlentities( "<center><img src=\"modules/Forums/images/avatars/" . $member_result['user_avatar'] . "\" /></center><br />" );
        }
      }
      if ( $dfw_getsets['tooltip_username'] == 1 ) {
        $out['text'] .= htmlentities( "" . $img_u . "" . _DFW_USRNAME . ": <strong>" . $member_result["uname"] . "</strong><br />" );
      } else {
        $out['text'] .= htmlentities( "" . $img_u . "" . _DFW_USRNAME . ": " . _DFW_HIDDEN . "<br />" );
      }
      if ( $dfw_getsets['tooltip_email'] == 1 ) {
        $out['text'] .= htmlentities( "" . $img_e . "" . _DFW_EMAIL . ": " . $email . "<br />" );
      }
      if ( $dfw_getsets['tooltip_regdate'] == 1 ) {
        $out['text'] .= htmlentities( "" . $img_r . "" . _DFW_REG . ": " . $registered . "<br />" );
      } else {
        $out['text'] .= htmlentities( "" . $img_r . "" . _DFW_REG . ": " . _DFW_HIDDEN . "<br />" );
      }
      if ( $gname ) {
        $out['text'] .= htmlentities( "" . $img_z . "" . _DFW_MBRSTATUS . ": " . $gname . "<br />" );
      }
      if ( $dfw_getsets['tooltip_posts'] == 1 ) {
        $out['text'] .= htmlentities( "" . $img_p . "" . _DFW_POSTS . ": " . $posts . "<br />" );
      } else {
        $out['text'] .= htmlentities( "" . $img_p . "" . _DFW_POSTS . ": " . _DFW_HIDDEN . "<br />" );
      }
      if ( $dfw_getsets['tooltip_theme'] == 1 ) {
        $out['text'] .= htmlentities( "" . $img_t . "" . _DFW_THEME . ": " . $theme . "<br />" );
      } else {
        $out['text'] .= htmlentities( "" . $img_t . "" . _DFW_THEME . ": " . _DFW_HIDDEN . "<br />" );
      }
      if ( is_user($user) && $dfw_getsets['member_flags'] == 1 ) {
        $out['text'] .= "\"><strong>" . $NameModded . "</strong></a></td><td>" . $DisplayFLAG . "</td>";
      } else {
        $out['text'] .= "\"><strong>" . $NameModded . "</strong></a></td>";
      } // member_flags switch END
    } else {
      "</strong></font></a></td>\n";
      if ( $dfw_getsets['member_flags'] == 1 ) {
        $out['text'] .= '<td><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $member_result['uname'] . '"><strong>' . $NameModded . '</strong></a></td><td>' . $DisplayFLAG .
          '</td>' . "\n";
      } else {
        $out['text'] .= '<td><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $member_result['uname'] . '"><strong>' . $NameModded . '</strong></a></td>' . "\n";
      } // member_flags switch END
    }
    if ( isset($pic) && $pic != '' ) $out['text'] .= '<td><img src="images/DFW/admin/' . $pic . '" border="0" alt="" /></td>' . "\n";
    $out['text'] .= '</tr>';
    $i++;
  }
  $out['text'] .= '</table>';
  $i--;
  $out['total'] = $i;
  return $out;
}
function tooltip_get_guests_online( $start )
{
  global $prefix, $db, $dfw_getsets, $admin, $user;
  $BlockImgSql3 = $db->sql_query( "SELECT * FROM `" . $prefix . "_dfw_block_img`" );
  $BlockImgResult3 = $db->sql_fetchrow( $BlockImgSql3 );
  $onlineGuestImg = '<img src="' . $BlockImgResult3['online_guest'] . '" width="16" border="0" />&nbsp;';
  $result = $db->sql_query( "SELECT uname FROM " . $prefix . "_session WHERE guest='1' OR guest='3'" );
  $out['total'] = $db->sql_numrows( $result );
  $out['text'] = '';
  $i = $start;
  while ( $session = $db->sql_fetchrow($result) ) {
    if ( $i < 10 ) {
      $num = '0' . $i;
    } else {
      $num = $i;
    }
    //$module = $session['module'];
    //$url = $session['url'];
    //$url = str_replace("&", "&amp;", $url);
    //if ($url == "/index.php") {
    //	$module .= "news";
    //}
    //if ($usersord['pick'] == 1) {
    //	$where = "<a href='$url' title='$module'><img src='images/DFW/online_guest.png' border='0' /></a>&nbsp;";
    //} else {
    //	$where = "<a href=\"$url\" title=\"$module\">$num</a>.&nbsp;";
    //}
    if ( is_admin($admin) and is_user($user) ) {
      $uname = $session['uname'];
    } else {
      $uname = DFWconvertIP( $session['uname'] );
    }
    if ( $dfw_getsets['guest_flags'] == 1 ) {
      if ( is_admin($admin) || is_user($user) ) {
        $DFWFlag = str_replace( ".*", ".0", $uname );
        $DFWFlag = sprintf( "%u", ip2long($DFWFlag) );
        $DFWFlag = dfw_get_country( $DFWFlag );
        $DFWFlag['c2c'] = strtoupper( $DFWFlag['c2c'] );
        $DisplayFLAG = grab_flag( $DFWFlag['c2c'] );
        //if ($user_agent['engine'] == 'bot') {
        //	$out['text'] .= "<br /><img src='images/DFW/online_guest.png' border='0' />" . $where . "" . $user_agent['ua'] . "\n";
        //} else {
        $out['text'] .= '<br />&nbsp;' . $onlineGuestImg . '' . $uname . '&nbsp;' . $DisplayFLAG . '' . "\n";
      } else {
        $out['text'] .= '<br />&nbsp;' . $onlineGuestImg . '' . $uname . '' . "\n";
      } // admin and user switch END
    } else {
      $out['text'] .= '<br />&nbsp;' . $onlineGuestImg . '' . $uname . '' . "\n";
    } // guest_flags switch END
    //}
    $i++;
  }
  $db->sql_freeresult( $result );
  return $out;
}
$tooltip_online_members = tooltip_get_members_online();
$tooltip_online_guests = tooltip_get_guests_online( $tooltip_online_members['total'] + 1 );
/*****************************************/
/* Jquery Who's Online              END  */
/*****************************************/
if ( is_user($user) ) {
  $content .= '<br />' . $welcImg . '' . _DFW_WELCOME . ', <strong>' . $uname . '</strong><br />' . "\n\n";
  if ( $dfw_getsets['user_ip'] == 1 ) {
    $onlyip = get_visitor_ip();
    $content .= '' . $ipImg . '<strong>' . _YOURIP . $onlyip . '</strong>';
  } // user_ip switch END
} else {
  $content .= '<form action="modules.php?name=Your_Account" method="post">';
  //$content .= '<center><strong>'._YOURIP.$onlyip.'</strong></center><br />';
  $content .= '' . _DFW_WELCOME . ', <strong>' . $anonymous . "</strong>\n<hr />";
  $content .= '<table><tr><td>' . _NICKNAME . '</td><td><input type="text" name="username" size="10" maxlength="25" /></td></tr>';
  $content .= '<tr><td>' . _PASSWORD . '</td><td><input type="password" name="user_password" size="10" maxlength="20" /></td></tr></table>';
  /*****[BEGIN]******************************************
  [ Base:    GFX Code                           v1.0.0 ]
  ******************************************************/
  $content .= security_code( array(2, 4, 5, 7), 'stacked' );
  /*****[END]********************************************
  [ Base:    GFX Code                           v1.0.0 ]
  ******************************************************/
  $content .= '<input type="hidden" name="op" value="login" />';
  $content .= '<input type="submit" value="' . _LOGIN . '" />' . "\n" . '<br /><a href="modules.php?name=Your_Account&amp;op=new_user">&middot;&nbsp;' . _BREG . '</a><br />';
  $content .= '<a href="modules.php?name=Your_Account&amp;op=pass_lost">&middot;&nbsp;' . _PASSWORDLOST . '</a><hr />';
  $content .= '</form>';
} // End IF is_user
if ( is_user($user) ) {
  $sqlp = 'SELECT user_avatar, user_avatar_type, user_id AS uid, user_posts AS posts FROM ' . $user_prefix . '_users WHERE username = \'' . $uname . '\'';
  $result = $db->sql_query( $sqlp );
  $row = $db->sql_fetchrow( $result );
  $posts = $row['posts'];
  $uid = $row['uid'];
  $user_avatar = $row['user_avatar'];
  $user_avatar_type = $row['user_avatar_type'];
  if ( $result ) {
    if ( $dfw_getsets['avatars'] == 1 ) {
      $sql = 'SELECT config_name, config_value FROM ' . $prefix . '_bbconfig WHERE config_name IN(\'avatar_path\',\'avatar_gallery_path\') LIMIT 0,2';
      $result = $db->sql_query( $sql );
      while ( $row = $db->sql_fetchrow($result) ) {
        $board_config[$row['config_name']] = $row['config_value'];
      }
      if ( $user_avatar_type == 1 ) $user_avatar = $board_config['avatar_path'] . '/' . $user_avatar;
      elseif ( $user_avatar_type != 2 ) $user_avatar = $board_config['avatar_gallery_path'] . '/' . $user_avatar;
      $content .= '<br /><br /><center><img alt="" src="' . $user_avatar . '" /></center>';
    } // avatar switch END
  }
  if ( $dfw_getsets['show_ranks'] == 1 ) {
    $result_rank = $db->sql_query( "SELECT * FROM " . $prefix . "_bbranks ORDER BY rank_special, rank_min" );
    $ranksrow = array();
    while ( $row = $db->sql_fetchrow($result_rank) ) {
      $ranksrow[] = $row;
    }
    $db->sql_freeresult( $result_rank );
    if ( $userinfo['user_rank'] ) {
      for ( $j = 0; $j < count($ranksrow); $j++ ) {
        if ( $userinfo['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] ) {
          $poster_rank = $ranksrow[$j]['rank_title'];
          $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="modules/Forums/' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
          $content .= "<br /><center>" . $rank_image . "" . $poster_rank . "</center>\n";
        }
      }
    } else {
      for ( $j = 0; $j < count($ranksrow); $j++ ) {
        if ( $userinfo['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] ) {
          $poster_rank = $ranksrow[$j]['rank_title'];
          $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="modules/Forums/' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
          $content .= "<br /><center>" . $rank_image . "" . $poster_rank . "</center>\n";
        }
      }
    }
  } // show_ranks switch END
  if ( $dfw_getsets['user_posts'] == 1 ) {
    if ( $posts == 0 ) {
      $content .= '<br />' . $postsImg . '0 post\'s' . "\n";
    } elseif ( $posts == 1 ) {
      $content .= '<br />' . $postsImg . '' . intval( $posts ) . ' post' . "\n";
    } else {
      $content .= '<br />' . $postsImg . '' . intval( $posts ) . ' post\'s<br />' . "\n";
    }
  } // user posts switch END
  $content .= '<br /><a href="modules.php?name=Your_Account&amp;op=logout">' . $logoutImg . '' . _LOGOUT . "</a>\n<hr />\n";
  if ( $dfw_getsets['prvt_msgs'] == 1 ) {
    $sql = 'SELECT privmsgs_type pmType, count(privmsgs_type) pmCount' . ' FROM ' . $prefix . '_bbprivmsgs' . ' WHERE privmsgs_to_userid=' . intval( $uid ) . '' .
      ' AND privmsgs_type IN(0,1,5)' . ' GROUP BY privmsgs_type' . ' LIMIT 0 , 3';
    $result = $db->sql_query( $sql );
    $newpms = 0;
    $oldpms = 0;
    while ( $row = $db->sql_fetchrow($result) ) {
      if ( $row[0] == 0 ) $oldpms += $row[1];
      else  $newpms += $row[1];
    }
    if ( $dfw_getsets['prvt_msgs_voice'] == 1 ) {
      if ( $newpms > 0 ) {
// added ability to use wav pm msg  files instead of just swf
	$pmExt=pathinfo($newPM);
		if ($pmExt['extension'] == 'wav') {
			$content .= '<audio autoplay="autoplay">
				   <source src="'.$newPM.'" type="audio/wav">
				   Your browser does not support the audio element.
				   </audio>';
		} else {
			$content .= '<object type="application/x-shockwave-flash" data="images/DFW/'.$newPM.'" name="newpm" width="0" height="0">
				 <param name="movie" value="images/DFW/newpm.swf" />
				 <param name="quality" value="high" />
				 <param name="loop" value="false" />
				 <param name="menu" value="false" />
				 </object>';
		}
	  }
    } // prvt_msgs_voice switch END
    $content .= '' . $pmImg . '<strong>' . _DFW_ACCOUNTINFO . '</strong><br />' . "\n";
    $content .= '' . $pmUnreadImg . '<a href="modules.php?name=Private_Messages">' . _DFW_UNREAD . ':</a> <strong>' . $newpms . '</strong><br />' . "\n";
    $content .= '' . $pmReadImg . '<a href="modules.php?name=Private_Messages">' . _BREAD . ':</a> <strong>' . $oldpms . '</strong><br />' . "\n<hr />\n";
  } // IF prvt_msgs END
} // End IF is_user
// Get the last user added to the database and the total users, minus anonymous
$sql = 'SELECT username,user_id FROM ' . $user_prefix . '_users ORDER BY user_id DESC LIMIT 0,1';
$result = $db->sql_query( $sql );
$row = $db->sql_fetchrow( $result );
$lastusername = $row['username'];
$lastuser = $row['user_id'];
$numrows = $db->sql_fetchrow( $db->sql_query('SELECT count(user_id) user_id FROM ' . $user_prefix . '_users') );
$numrows = $numrows['user_id'];
$numrows1 = $numrows - 1;
//Executing SQL For Today and Yesterday
$userCount = 0;
$userCount2 = 0;
$todayDST = date( 'I', time() ) * 3600; // 2.2.0
$yesterdayDST = date( 'I', time() - 86400 ) * 3600; // 2.2.0
$Today = date( 'M d, Y', time() - $todayDST ); // 2.2.0
$Yesterday = date( 'M d, Y', time() - 86400 - $yesterdayDST ); // 2.2.0
$sql = 'SELECT user_regdate, COUNT(user_regdate) FROM ' . $user_prefix . '_users where user_regdate IN(\'' . $Today . '\', \'' . $Yesterday . '\') GROUP BY user_regdate LIMIT 0,2';
$result = $db->sql_query( $sql );
while ( $row = $db->sql_fetchrow($result) ) {
  if ( $row[0] == $Today ) $userCount = $row[1];
  elseif ( $row[0] == $Yesterday ) $userCount2 = $row[1];
}
//Executing SQL For Waiting Users
$sql = 'SELECT username FROM ' . $user_prefix . '_users_temp';
$result = $db->sql_query( $sql );
$waiting = $db->sql_numrows( $result );
if ( $dfw_getsets['memberships'] == 1 ) {
  if ( is_user($user) or is_admin($admin) ) {
    $lastUserNameModified = strlen( $lastusername ) < $nameMaxLength ? $lastusername : substr( $lastusername, 0, $nameMaxLength ) . '...'; // 2.2.0
    $lUNM = !empty( $lastUserNameModified ) ? '<strong>' . $lastUserNameModified . '</strong>' : $lastusername; //2.3.0
    $content .= '' . $mbrStatsImg . '<strong><u>' . _DFW_BL_MEMSTATS . ':</u></strong><br />' . "\n";
    $content .= '' . $mbrLatest . '' . _BLATEST . ': <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $lastusername .
      '"></a>&nbsp;<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=' . $lastuser . '">' . $lUNM . '</a><br />' . "\n"; //
  } // End IF is_user
  if ( is_admin($admin) /*AND @file_exists('modules/_Factory_/index.php')*/ ) {
    $sql = 'SELECT username, user_regdate, user_email, user_website FROM ' . $prefix . '_users where user_regdate IN (\'' . date( 'M d, Y', time() ) . '\', \'' . date( 'M d, Y', time() -
      86400 ) . '\') order by user_regdate DESC, username';
    $result = $db->sql_query( $sql );
    $displayT = $displayY = '<table border="1" align="center">' . "\n" . '<tr class="boxtitle"><td>Name</td><td>URL</td></tr>' . "\n";
    while ( $user_info = $db->sql_fetchrow($result) ) {
      if ( empty($user_info['username']) ) continue;
      if ( empty($user_info['user_website']) or $user_info['user_website'] == 'http://' ) $user_info['user_website'] = '&nbsp;';
      else  $user_info['user_website'] = '<a href="' . $user_info['user_website'] . '" target="_blank">' . $user_info['user_website'] . '</a>';
      if ( $user_info['user_regdate'] == date('M d, Y', time()) ) $displayT .= '<tr><td><a href="mailto:' . $user_info['user_email'] . '" title="Email User ' . $user_info['username'] .
          '">&nbsp;<strong>' . $user_info['username'] . '</strong></a></td><td>' . $user_info['user_website'] . "</td></tr>\n";
      elseif ( $user_info['user_regdate'] == date('M d, Y', time() - 86400) ) $displayY .= '<tr><td><a href="mailto:' . $user_info['user_email'] . '" title="Email User ' . $user_info['username'] .
          '"><strong>' . $user_info['username'] . '</strong></a></td><td>' . $user_info['user_website'] . "</td></tr>\n";
    }
    if ( preg_match('/href/', $displayT) ) $displayT .= '</table>';
    else  $displayT = '';
    if ( preg_match('/href/', $displayY) ) $displayY .= '</table>';
    else  $displayY = '';
    $btdLink = _DFW_NTD . ': <strong>' . $userCount . '</strong>';
    $bydLink = _BYD . ': <strong>' . $userCount2 . '</strong>';
    if ( $userCount > 0 ) $btdLink = '<a href="javascript:hideshow(document.getElementById(\'newToday\'))">' . _DFW_NTD . '</a>' . ': <strong>' . $userCount . '</strong>' .
        '<div id="newToday" style="display: none;">' . $displayT . '</div>';
    if ( $userCount2 > 0 ) $bydLink = '<a href="javascript:hideshow(document.getElementById(\'newYesterday\'))">' . _BYD . '</a>' . ': <strong>' . $userCount2 . '</strong>' .
        '<div id="newYesterday" style="display: none;">' . $displayY . '</div>';
  } else {
    $btdLink = _DFW_NTD;
    $bydLink = _BYD;
  } // End IF is_admin
  $content .= '' . $mbrToday . '' . $btdLink . '<br />' . "\n";
  $content .= '' . $mbrYesterday . '' . $bydLink . '<br />' . "\n";
  if ( is_admin($admin) and @file_exists('modules/Resend_Email/index.php') ) {
    $waitLink = '<a href="modules.php?name=Resend_Email" title="' . _TTL_RESENDEMAIL . '">' . $mbrWaiting . '' . _WAITLINK . '</a>';
  } else {
    $waitLink = '' . $mbrWaiting . '' . _WAITLINK . '';
  } // End IF is_admin
  $content .= '' . $waitLink . ': <strong>' . number_format( $waiting ) . '</strong><br />' . "\n";
  $content .= '' . $mbrOverall . '' . _BOVER . ': <strong>' . number_format( $numrows1, 0 ) . '</strong><br />' . "\n<hr />\n";
} // Memberships switch END
if ( $dfw_getsets['bbgroups'] == 1 ) {
  if ( is_user($user) || is_admin($admin) ) {
    $group_id = $userinfo['user_id'];
    $content .= '' . $bbgroupImg . '' . "\n";
    $content .= '<strong><u>' . _DFW_MEMBERSHIPS . ':</u></strong><br />' . "\n";
    $result = $db->sql_query( "SELECT g.group_name FROM " . $prefix . "_bbgroups g LEFT JOIN " . $prefix . "_bbuser_group u ON u.group_id=g.group_id WHERE u.user_id='" . $group_id .
      "' AND g.group_description != 'Personal User'" );
    if ( $db->sql_numrows($result) == 0 ) {
      $content .= '' . $subImg . '' . _DFW_NONE . '<br />';
    } else {
      while ( list($gname) = $db->sql_fetchrow($result) ) {
        $content .= '&nbsp;' . $subImg . '' . $gname . '<br />';
      }
    }
    $db->sql_freeresult( $result );
    $content .= '<hr noshade="noshade" />';
  }
} // bbgroups switch END
if ( $dfw_getsets['nsn_groups'] == 1 ) {
  if ( is_user($user) || is_admin($admin) ) {
    $group_id = $userinfo['user_id'];
    $content .= '' . $nsngroupImg . '' . "\n";
    $content .= '<strong><u>NSN Groups:</u></strong><br />' . "\n";
    $result = $db->sql_query( 'SELECT g.gname FROM ' . $prefix . '_nsngr_users u LEFT JOIN ' . $prefix . '_nsngr_groups g ON g.gid = u.gid WHERE u.uid = \'' . $group_id . '\' ORDER BY gname' );
    if ( $db->sql_numrows($result) == 0 ) {
      $content .= '' . $subImg . '' . _DFW_NONE . '<br />';
    } else {
      while ( list($nsn_gname) = $db->sql_fetchrow($result) ) {
        $content .= '&nbsp;' . $subImg . '' . $nsn_gname . '<br />';
      }
    }
    $db->sql_freeresult( $result );
    $content .= '<hr noshade="noshade" />';
  }
} // bbgroups switch END
/*****************************************/
/* Jquery Who's Online            START  */
/*****************************************/
$content .= tooltip_online_display( $tooltip_online_members, $tooltip_online_guests );
/*****************************************/
/* Jquery Who's Online              END  */
/*****************************************/
if ( $dfw_getsets['show_hits'] == 1 ) {
  //Executing SQL For Today and Yesterday
  $userCount = 0;
  $userCount2 = 0;
  $todayDST = date( 'I', time() ) * 3600; // 2.2.0
  $yesterdayDST = date( 'I', time() - 86400 ) * 3600; // 2.2.0
  $Today = date( 'M d, Y', time() - $todayDST ); // 2.2.0
  $Yesterday = date( 'M d, Y', time() - 86400 - $yesterdayDST ); // 2.2.0
  $sql = 'SELECT user_regdate, COUNT(user_regdate) FROM ' . $user_prefix . '_users where user_regdate IN(\'' . $Today . '\', \'' . $Yesterday . '\') GROUP BY user_regdate LIMIT 0,2';
  $result = $db->sql_query( $sql );
  while ( $row = $db->sql_fetchrow($result) ) {
    if ( $row[0] == $Today ) $userCount = $row[1];
    elseif ( $row[0] == $Yesterday ) $userCount2 = $row[1];
  }
  /* Hits for Today */
  $t_time = time() - $todayDST; // 2.2.0
  $t_year = date( 'Y', $t_time );
  $t_month = date( 'n', $t_time );
  $t_date = date( 'j', $t_time );
  $result = $db->sql_query( 'SELECT hits FROM ' . $prefix . '_stats_date WHERE year=' . $t_year . ' AND month=' . $t_month . ' AND date=' . $t_date );
  list( $today ) = $db->sql_fetchrow( $result );
  if ( is_admin($admin) ) {
    /* Hits for Yesterday */
    $y_time = $t_time - 86400 - $yesterdayDST; // 2.2.0
    $y_year = date( 'Y', $y_time );
    $y_month = date( 'n', $y_time );
    $y_date = date( 'j', $y_time );
    $result = $db->sql_query( 'SELECT hits FROM ' . $prefix . '_stats_date WHERE year=' . $y_year . ' AND month=' . $y_month . ' AND date=' . $y_date );
    list( $yesterday ) = $db->sql_fetchrow( $result );
  }
  /* Hits in Total */
  $totalhits = 0;
  $result = $db->sql_query( 'SELECT sum(hits) FROM ' . $prefix . '_stats_year' );
  list( $totalhits ) = $db->sql_fetchrow( $result );
  $content .= '<center><small>' . _WERECEIVED . '</small><br />' . "\n";
  $content .= '<strong>' . number_format( $totalhits, 0 ) . '</strong><br />' . "\n";
  $content .= '<small>' . _PAGESVIEWS . '<br />' . $startdate . '</small></center>';
  $content .= '<hr noshade="noshade" />';
  $content .= '<center>' . _BHITS . ' ' . _DFW_NTD . ': <strong>' . number_format( $today, 0 ) . '</strong><br />';
  if ( is_admin($admin) ) $content .= _BHITS . ' ' . _BYD . ': <strong>' . number_format( $yesterday, 0 ) . '</strong><br />';
  $content .= '</center>';
} // IF show_hits END
if ( $dfw_getsets['server_datetime'] == 1 || ($dfw_getsets['server_datetime_admin'] == 1 && is_admin($admin)) ) {
  if ( is_user($user) || is_admin($admin) ) {
    $content .= "<hr noshade=\"noshade\" />";
  }
  $sdt = date( "j F Y\nH:i:s T" );
  $zone = date( "Z" ) / 3600;
  if ( $zone >= 0 ) {
    $zone = "+" . $zone;
  }
  $content .= "<center>" . _SERDT . "<br />$sdt (GMT $zone)</center>";
}
// Temp spacer
$content .= '<br /><br />';
?>
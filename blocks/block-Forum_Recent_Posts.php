<?php
########################################################################
# Universal Latest Forums Block                                        #
# ============================================                         #
########################################################################
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
	die("Illegal Block File Access");
}
$HideViewReadOnly = 0;	
$Last_New_Topics  = 5;	
global $prefix, $db, $sitename,$ThemeSel,$bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4,$textcolor1, $textcolor2;
$folder_path = "themes/$ThemeSel/forums/";
if(!is_dir($folder_path))
{
	$folder_path = "themes/$ThemeSel/forums/";
}
$show = "  <!--<tr> 
    <td height=\"28\" colspan=\"6\" align=\"center\" class=\"catbottom\" background=\"".$folder_path."images/cellpic1.gif\">&nbsp;</td>
  </tr>-->
</table></td>
        </tr>
      </table></td>
  </tr>
</table>";
$Count_Topics = 0;
$Topic_Buffer = "";
$result = $db->sql_query( "SELECT topic_id, forum_id, topic_last_post_id, topic_title, topic_poster, topic_views, topic_replies, topic_moved_id FROM ".$prefix."_bbtopics ORDER BY topic_last_post_id DESC");
while( list( $topic_id, $forum_id, $topic_last_post_id, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_moved_id ) = $db->sql_fetchrow($result) )
{
   $skip_display = 0;
   if( $HideViewReadOnly == 1 )
   {
      $result2 = $db->sql_query( "SELECT auth_view, auth_read FROM ".$prefix."_bbforums where forum_id = '$forum_id'");
      list( $auth_view, $auth_read ) = $db->sql_fetchrow( $result2 );
      if( ( $auth_view != 0 ) or ( $auth_read != 0 ) ) { $skip_display = 1; }
   }
   if( $topic_moved_id != 0 )
   {
      $skip_display = 1;
   }
   if( $skip_display == 0 )
   {
	  $Count_Topics += 1;
$result2 = $db->sql_query("SELECT username, user_id, user_color_gc FROM ".$prefix."_users where user_id='$topic_poster'");
list($username, $user_id, $user_color_gc)=$db->sql_fetchrow($result2);
$avtor= UsernameColor($user_color_gc, $username); //$username;
$sifra=$user_id;
$result3 = $db->sql_query("SELECT poster_id, FROM_UNIXTIME(post_time,'%m/%d/%Y at %H:%i') as post_time FROM ".$prefix."_bbposts where post_id='$topic_last_post_id'");
list($poster_id, $post_time)=$db->sql_fetchrow($result3);
$result4 = $db->sql_query("SELECT username, user_id, user_color_gc FROM ".$prefix."_users where user_id='$poster_id'");
list($username, $user_id, $user_color_gc)=$db->sql_fetchrow($result4);

           	          $viewlast .="  <tr> 
    <td height=\"34\" nowrap bgcolor=\"$bgcolor1\" class=\"row1\"><img src=\"".$folder_path."images/folder.gif\" border=\"0\" /></td>
    <td width=\"100%\" bgcolor=\"$bgcolor1\" class=\"row1\">&nbsp;<a href=\"modules.php?name=Forums&file=viewtopic&t=$topic_id#$topic_last_post_id\">$topic_title</a></td>
    <td align=\"center\" bgcolor=\"$bgcolor1\" class=\"row2\">$topic_replies</td>
    <td align=\"center\" bgcolor=\"$bgcolor1\" class=\"row3\"><a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=$sifra\">$avtor</a></td>
    <td align=\"center\" bgcolor=\"$bgcolor1\" class=\"row2\">$topic_views</td>
    <td align=\"center\" nowrap bgcolor=\"$bgcolor1\" class=\"row3\"><font size=\"-2\"><i>&nbsp;&nbsp;$post_time&nbsp;</i></font><br />
      <a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=$user_id\">". UsernameColor($user_color_gc, $username) ."</a>&nbsp;<a href=\"modules.php?name=Forums&file=viewtopic&p=$topic_last_post_id#$topic_last_post_id\"><img src=\"".$folder_path."images/folder_new.gif\" border=\"0\" alt=\"Latest Post\"></a></td>
  </tr>";
}
   if( $Last_New_Topics == $Count_Topics ) { break 1; }
}
    $content .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
  <tr>
    <td bgcolor=\"$bgcolor1\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\" bgcolor=\"$bgcolor2\">
        <tr>
          <td><table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\">
  <tr> 
    <th height=\"28\" colspan=\"2\" align=\"center\" nowrap background=\"".$folder_path."images/cellpic3.gif\" class=\"thcornerl\"><font color=\"$textcolor1\"><strong>Topics</strong></font></th>
    <th width=\"50\" align=\"center\" nowrap background=\"".$folder_path."images/cellpic3.gif\" class=\"thtop\"><font color=\"$textcolor1\"><strong>&nbsp;Replies&nbsp;</strong></font></th>
    <th width=\"100\" align=\"center\" nowrap background=\"".$folder_path."images/cellpic3.gif\" class=\"thtop\"><font color=\"$textcolor1\"><strong>&nbsp;Author&nbsp;</strong></font></th>
    <th width=\"50\" align=\"center\" nowrap background=\"".$folder_path."images/cellpic3.gif\" class=\"thtop\"><font color=\"$textcolor1\"><strong>&nbsp;Views&nbsp;</strong></font></th>
    <th align=\"center\" nowrap background=\"".$folder_path."images/cellpic3.gif\" class=\"thcornerr\"><font color=\"$textcolor1\"><strong>&nbsp;Last Post&nbsp;</strong></font></th>
  </tr>";
    $content .= "$viewlast";
 $content .= "$show";
?>
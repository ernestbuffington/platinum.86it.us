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
LinkAdmin();
VideoStreamMenu();

if($_POST['Settings']) {
	$result = $db->sql_query("UPDATE ".$prefix."_video_stream_settings SET commentED=".$_POST['commentED'].", commentV=".$_POST['commentV'].", sendED=".$_POST['sendED'].", sendV=".$_POST['sendV'].", brokenED=".$_POST['brokenED'].", brokenV=".$_POST['brokenV'].", submitED=".$_POST['submitED'].", submitV=".$_POST['submitV'].", submitC=".$_POST['submitC'].", ratingED=".$_POST['ratingED'].", ratingV=".$_POST['ratingV'].", viewV=".$_POST['viewV'].", downloadED=".$_POST['downloadED'].", downloadV=".$_POST['downloadV'].", embededED=".$_POST['embededED'].", embededV=".$_POST['embededV']." WHERE id=1");
}

OpenTable();
$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_settings WHERE id=1");
$row = $db->sql_fetchrow($result);
$selected1[$row['commentED']] = "selected"; $selected2[$row['commentV']] = "selected"; $selected3[$row['sendED']] = "selected";
$selected4[$row['sendV']] = "selected"; $selected5[$row['brokenED']] = "selected"; $selected6[$row['brokenV']] = "selected";
$selected7[$row['submitED']] = "selected"; $selected8[$row['submitV']] = "selected"; $selected9[$row['submitC']] = "selected";
$selected10[$row['ratingED']] = "selected"; $selected11[$row['ratingV']] = "selected"; $selected12[$row['viewV']] = "selected";
$selected13[$row['downloadED']] = "selected"; $selected14[$row['downloadV']] = "selected"; $selected15[$row['embededED']] = "selected";
$selected16[$row['embededV']] = "selected";

echo "<form name=\"form1\" method=\"post\" action=\"\">\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"5\" cellpadding=\"5\">\n";
echo "  <tr>\n";
echo "    <td>"._COMMENTPOSTING."</td>\n";
echo "    <td width=\"100%\">&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"commentED\"><option value=\"1\" ".$selected1[1].">"._ENABLE."</option><option value=\"0\" ".$selected1[0].">"._DISABLE."</option></select></td>\n";
echo "    <td>"._COMMENTPOSTING." "._ENABLE."/"._DISABLE.".</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"commentV\"><option value=\"1\" ".$selected2[1].">"._REGMEMBERSONLY."</option><option value=\"0\" ".$selected2[0].">"._EVERYONE."</option></select></td>\n";
echo "    <td>"._USERSCOMMENT."</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>"._SENDTOFRIEND."</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"sendED\"><option value=\"1\" ".$selected3[1].">"._ENABLE."</option><option value=\"0\" ".$selected3[0].">"._DISABLE."</option></select></td>\n";
echo "    <td>"._SENDTOFRIEND." "._ENABLE."/"._DISABLE." </td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"sendV\"><option value=\"1\" ".$selected4[1].">"._REGMEMBERSONLY."</option><option value=\"0\" ".$selected4[0].">"._EVERYONE."</option></select></td>\n";
echo "    <td>"._USEREMAIL."</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>"._DOWNLOADLINK."</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"downloadED\"><option value=\"1\" ".$selected13[1].">"._ENABLE."</option><option value=\"0\" ".$selected13[0].">"._DISABLE."</option></select></td>\n";
echo "    <td>"._DOWNLOADLINK." "._ENABLE."/"._DISABLE." </td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"downloadV\"><option value=\"1\" ".$selected14[1].">"._REGMEMBERSONLY."</option><option value=\"0\" ".$selected14[0].">"._EVERYONE."</option></select></td>\n";
echo "    <td>"._UADOWNLOADLINK."</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";

echo "  <tr>\n";
echo "    <td>"._EMBEDEDHTML."</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"embededED\"><option value=\"1\" ".$selected15[1].">"._ENABLE."</option><option value=\"0\" ".$selected15[0].">"._DISABLE."</option></select></td>\n";
echo "    <td>"._EMBEDEDHTML." "._ENABLE."/"._DISABLE." </td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"embededV\"><option value=\"1\" ".$selected16[1].">"._REGMEMBERSONLY."</option><option value=\"0\" ".$selected16[0].">"._EVERYONE."</option></select></td>\n";
echo "    <td>"._UAEMBEDEDHTML."</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";

echo "  <tr>\n";
echo "    <td>"._BROKENVIDS."</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"brokenED\"><option value=\"1\" ".$selected5[1].">"._ENABLE."</option><option value=\"0\"".$selected5[0].">"._DISABLE."</option></select></td>\n";
echo "    <td>"._BROKENVIDS." "._ENABLE."/"._DISABLE."</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"brokenV\"><option value=\"1\" ".$selected6[1].">"._REGMEMBERSONLY."</option><option value=\"0\" ".$selected6[0].">"._EVERYONE."</option></select></td>\n";
echo "    <td>"._USERBROKEN."</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>"._SUBMITVIDS."</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"submitED\"><option value=\"1\" ".$selected7[1].">"._ENABLE."</option><option value=\"0\" ".$selected7[0].">"._DISABLE."</option></select></td>\n";
echo "    <td>"._SUBMITVIDS." "._ENABLE."/"._DISABLE."</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"submitV\"><option value=\"1\" ".$selected8[1].">"._REGMEMBERSONLY."</option><option value=\"0\"".$selected8[0].">"._EVERYONE."</option></select></td>\n";
echo "    <td>"._USERSUBMIT."</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"submitC\"><option value=\"2\" ".$selected9[2].">"._NOONE."</option><option value=\"1\" ".$selected9[1].">"._VISONLY."</option><option value=\"0\" ".$selected9[0].">"._EVERYONE."</option></select></td>\n";
echo "    <td>"._USERMODERATE."</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>"._RATING."</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"ratingED\"><option value=\"1\" ".$selected10[1].">"._ENABLE."</option><option value=\"0\" ".$selected10[0].">"._DISABLE."</option></select></td>\n";
echo "    <td>"._RATING." "._ENABLE."/"._DISABLE."</td></tr><tr><td><select name=\"ratingV\"><option value=\"1\" ".$selected11[1].">"._REGMEMBERSONLY."</option><option value=\"0\" ".$selected11[0].">"._EVERYONE."</option></select></td>\n";
echo "    <td>"._USERRATE."</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>"._VVIEW."</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><select name=\"viewV\"><option value=\"1\" ".$selected12[1].">"._REGMEMBERSONLY."</option><option value=\"0\" ".$selected12[0].">"._EVERYONE."</option></select></td>\n";
echo "    <td>"._ALLOWEDVIEW."</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td><input type=\"submit\" name=\"Settings\" value=\""._SAVESETTINGS."\"></td>\n";
echo "    <td>&nbsp;</td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "</form>\n";
CloseTable();
?>
<script type="text/javascript">
function disp_confirm(id)
{
var name = confirm("<?php echo ""._AREUSURE.""; ?>")
if (name==true)
{
window.open('modules.php?name=Video_Stream&page=comment&moderateVS=1&id='+id+'','','scrollbars=no,menubar=no,height=250,width=500,resizable=no,toolbar=no,location=no,status=no');
}
}
</script>

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
if (!preg_match("/modules.php/i", $_SERVER['SCRIPT_NAME'])) {
	die ("You can't access this file directly...");
}

if(($commentEDDD == 1) && ($request == "")) {	
	// Comments Layout
	echo "<br /><br /><div align=\"center\"><FONT class=title>"._VS_COMMENTS."</FONT></div>";
	
	$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_comments WHERE vidid='$id'");
	$commentstoshow = $db->sql_numrows($result);
	
	if($commentstoshow == "0") {
		echo "<br /><center><strong>"._NOCOMMENTS."</strong></center>";
	} else {
	
		echo "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\"><tr>
    		  <td width=\"150\"><div align=\"center\"><strong>Author</strong></div></td><td><div align=\"center\"><strong>"._VS_COMMENT."</strong></div></td></tr>";
  
  		while($row = $db->sql_fetchrow($result)) {	
  
  			echo "<tr><td valign=\"top\"><p><strong>".$row['user']."</strong><br />";
			$userav = $row['user'];
			avatars($userav);
			echo "<br /><br />";
			if($userav != "Anonymous") {
				// Gets total comments user has posted
				$totcoms = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_comments WHERE user='$userav'");
				$totcomsnum = $db->sql_numrows($totcoms);
				echo "<strong>"._VS_COMMENTS.":</strong> ".$totcomsnum."<br />";
				// When User Joined
				$joindate = $db->sql_query("SELECT user_regdate FROM ".$prefix."_users WHERE username='$userav'");
				$rowjoin = $db->sql_fetchrow($joindate);
				echo "<strong>"._JOINON.":</strong> ".$rowjoin['user_regdate']."<br />";
			}
			
			echo "</p></td><td valign=\"top\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
			<tr><td align=\"left\"><strong>"._POSTEDON.":</strong> ".$row['date']."</td>
			<td align=\"right\">";
			$commentidDE = $row['id'];
			editdeletecontrolsVS($userav, $commentidDE);
			echo "</td></tr><tr><td colspan=\"2\"><hr></td></tr><tr><td colspan=\"2\">".$row['comment']."</td></tr></table></td>
			</tr><tr><td><a href=\"#VStop\">"._BACKTOTOP."</a></td><td>";
			userdetailsVS($userav);
			echo "</td></tr><tr><td colspan=\"2\">&nbsp;</td></tr>";
		}
		echo "
		</table>";
	}
	
}
	CloseTable();

// Function to get the users email, YIM, AIM, etc
function userdetailsVS($userav) {
	global $db, $prefix;
	
	if($userav != "Anonymous") {
		$result = $db->sql_query("SELECT * FROM ".$prefix."_users WHERE username='$userav'");
		$row = $db->sql_fetchrow($result);
		echo "<a href=\"modules.php?name=Private_Messages&file=index&mode=post&u=".$row['user_id']."\"><img src=\"modules/Video_Stream/images/comment_pm.gif\" alt=\""._SENDPMESS."\" border=\"0\" /></a> ";
		echo "<a href=\"mailto:".$row['user_email']."\"><img src=\"modules/Video_Stream/images/comment_email.gif\" alt=\""._SENDEMAIL."\" border=\"0\" /></a>";
		if($row['user_website'] != "") {
			echo " <a href=\"".$row['user_website']."\"><img src=\"modules/Video_Stream/images/comment_www.gif\" alt=\""._VISITPOSTWEB."\" border=\"0\" /></a>";
		}
		if($row['user_aim'] != "") {
			echo " <a href=\"aim:goim?screenname=".$row['user_aim']."&message=Hello+Are+you+there?\"><img src=\"modules/Video_Stream/images/comment_aim.gif\" alt=\""._AIMADDRESS."\" border=\"0\" /></a>";
		}
		if($row['user_yim'] != "") {
			echo " <a href=\"http://edit.yahoo.com/config/send_webmesg?.target=".$row['user_yim']."&.src=pg\"><img src=\"modules/Video_Stream/images/comment_yim.gif\" alt=\""._YIMADDRESS."\" border=\"0\" /></a>";
		}
		if($row['user_msnm'] != "") {
			echo " <a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=".$row['user_id']."\"><img src=\"modules/Video_Stream/images/comment_msn.gif\" alt=\""._MSNMESSENGERADD."\" border=\"0\" /></a>";
		}
		if($row['user_icq'] != "") {
			echo " <a href=\"http://wwp.icq.com/scripts/search.dll?to=".$row['user_icq']."\"><img src=\"modules/Video_Stream/images/comment_icq.gif\" alt=\""._ICQNUMBER."\" border=\"0\" /></a>";
		}
	} else {
		echo "&nbsp;";
	}
}

// Function to determine when the Edit and Delete buttons are shown.
function editdeletecontrolsVS($userav, $commentidDE) {
	global $db, $prefix, $looker, $isvidstreamadmin;

	if($isvidstreamadmin == 1) {
		echo "<a href=\"javascript:loadcomment(".$commentidDE.", 2)\"><img src=\"modules/Video_Stream/images/comment_edit.gif\" alt=\""._EDITCOMM."\" border=\"0\" /></a> 
		<a href=\"#VStop\" onClick=\"javascript:disp_confirm(".$commentidDE.")\"><img src=\"modules/Video_Stream/images/comment_delete.gif\" alt=\""._DELETECOMM."\" border=\"0\" /></a>";
	} else {
		if ($userav != "Anonymous") {
			if($userav == $looker) {
				echo "<a href=\"javascript:loadcomment(".$commentidDE.", 2)\"><img src=\"modules/Video_Stream/images/comment_edit.gif\" alt=\""._EDITCOMM."\" border=\"0\" /></a> 
				<a href=\"#VStop\" onClick=\"javascript:disp_confirm(".$commentidDE.")\"><img src=\"modules/Video_Stream/images/comment_delete.gif\" alt=\""._DELETECOMM."\" border=\"0\" /></a>";
			}
		}
	}
}
?>
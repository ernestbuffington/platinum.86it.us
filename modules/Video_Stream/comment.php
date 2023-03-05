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

// enabling correct error reporting
error_reporting(E_ALL ^ E_NOTICE);
ini_set("error_reporting", E_ALL ^ E_NOTICE); 
ini_set("display_errors", 1);

if(($commentVVV == 1) && ($looker == "Anonymous")) {
	echo ""._REGCOMMENT."";
} else {
	if($commentEDDD == 1) {
		// any comments in db for that user or admin check
		if ($isvidstreamadmin == 1) {
			$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_comments WHERE id=$id");
			$numrows = $db->sql_numrows($result);
		} else {
			$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_comments WHERE id=$id AND user='$looker'");
			$numrows = $db->sql_numrows($result);
		}
	
		// If to be edited
		if($moderateVS == 2) {
			if($numrows == 1) {
				if($_POST['Submit']) {
					$commenttopost = $_POST['comment'];
					// Check if no comment
					if($commenttopost == "") {
						die(""._NOCOMMENTENT."");
					}
	
					// Strips out HTML and Censored Words
					filter_text($commenttopost, 'nohtml');
					// **********************************
	
					$result = $db->sql_query("UPDATE ".$prefix."_video_stream_comments SET comment='$EditedMessage' WHERE id=$id");
					echo ""._COMMENTMODED."";
				} else {
					$row = $db->sql_fetchrow($result);
					commentform($row['comment']);
				}
			} else {
				echo ""._ERROR."";
			}
			// If to be deleted	
		} elseif($moderateVS == 1) {
			if($numrows == 1) {
				$result = $db->sql_query("DELETE FROM ".$prefix."_video_stream_comments WHERE id=$id");
				echo "Your comment has been deleted";
			} else {
				echo ""._ERROR."";
			}
	
			// Else just do standard post comment	
		} else {
			if($_POST['Submit']) {
	
				$commenttopost = $_POST['comment'];
				// Check if no comment
				if($commenttopost == "") {
					die(""._NOCOMMENTENT."");
				}
				$date = date("h:i A dS M Y");
	
				$username = $looker;
	
				// Strips out HTML and Censored Words
				filter_text($commenttopost, 'nohtml');
				// **********************************
				userpointsVS(2);
				$result = $db->sql_query("INSERT INTO ".$prefix."_video_stream_comments (vidid, user, date, comment) VALUES ('$id', '$username', '$date', '$EditedMessage') ");
	
				echo ""._TYCOMMENT."";
	
			} else {
				$txtcomment = "";
				commentform($txtcomment);
			}
		}
	} else {
		echo "Comments are disabled";
	}
}

function commentform($txtcomment) {
		echo "<form name=\"form1\" method=\"post\" action=\"\">
		  <p align=\"center\" name=\"comment\" cols=\"50\" rows=\"10\">
			<textarea name=\"comment\" cols=\"50\" rows=\"10\">".$txtcomment."</textarea>
		</p>
		  <p align=\"center\" name=\"comment\" cols=\"50\" rows=\"10\">
			<input type=\"submit\" name=\"Submit\" value=\""._VS_COMMENT."\">  
			</p>
		</form>";
}
?>
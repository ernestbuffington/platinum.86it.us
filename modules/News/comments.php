<?php
/************************************************************************/
/* Tricked Out News 2.4a                                                */ 
/* PHP-Platinum Nuke Pro: Expect to be impressed              COPYRIGHT */
/* Copyright (c) 2011 - 2017 by http://www.havocst.net                  */
/* DocHaVoC   (dochavoc(at)havocst(dot)net)                             */ 
/* This is a heavily modified version of the original Platinum Nuke     */ 
/* news module, to act and look more like a blog.                       */ 
/* Tricked Out News that was created originally for RavenNuke(tm)       */ 
/* by Nuken at http://trickedoutnews.com                                */ 
/* Converted to Platinum Nuke by DocHaVoC http://www.havocst.net        */
/************************************************************************/
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
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

if ( !defined('MODULE_FILE') )
{
	die('You can\'t access this file directly...');
}
require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
// Quake - start
if (isset($sid)) { $sid = intval($sid); } else { $sid = ''; }
if (isset($tid)) { $tid = intval($tid); } else { $tid = ''; }
if (isset($pid)) { $pid = intval($pid); } else { $pid = ''; }
if (isset($order)) { $order = intval($order); }
if (isset($thold)) { $thold = intval($thold); }

if (!isset($mode) OR empty($mode)) {
	if(isset($userinfo['umode'])) {
		$mode = $userinfo['umode'];
	} else {
		$mode = 'thread';
	}
}
if (!isset($order) OR empty($order)) {
	if(isset($userinfo['uorder'])) {
		$order = $userinfo['uorder'];
	} else {
		$order = 0;
	}
}
if (!isset($thold) OR empty($thold)) {
	if(isset($userinfo['thold'])) {
		$thold = $userinfo['thold'];
	} else {
		$thold = 0;
	}
}
// Quake - end
if (!isset($xanonpost)) { $xanonpost = 0; }
if (!isset($anonpost)) { $anonpost = 0; }
if (!isset($op)) $op='';
if (!isset($host_name)) $host_name='';

switch($op) {

	case 'Reply':
		reply($pid, $sid, $mode, $order, $thold);
		break;

	case _PREVIEW:
		replyPreview($pid, $sid, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype);
		break;

	case _OK:
		CreateTopic($xanonpost, $subject, $comment, $pid, $sid, $host_name, $mode, $order, $thold, $posttype);
		break;

	case 'moderate':
		if(!isset($admin)) {
			require_once('mainfile.php');
		}
		global $userinfo;
		if(($admintest==1) || ($moderate==2)) {
			while(list($tdw, $emp) = each($_POST)) {
				if (stripos_clone($tdw,'dkn')) {
					$emp = explode(':', $emp);
					if($emp[1] != 0) {
						$tdw = str_replace('dkn', '', $tdw);
						$emp[0] = intval($emp[0]);
						$emp[1] = intval($emp[1]);
						$tdw = intval($tdw);
						$q = 'UPDATE '.$prefix.'_comments SET';
						if(($emp[1] == 9) AND ($emp[0]>=0)) { # Overrated
							$q .= ' score=score-1 WHERE tid=\''.$tdw.'\'';
						} elseif (($emp[1] == 10) AND ($emp[0]<=4)) { # Underrated
							$q .= ' score=score+1 WHERE tid=\''.$tdw.'\'';
						} elseif (($emp[1] > 4) AND ($emp[0]<=4)) {
							$q .= ' score=score+1, reason=\''.$emp[1].'\' WHERE tid=\''.$tdw.'\'';
						} elseif (($emp[1] < 5) AND ($emp[0] > -1)) {
							$q .= ' score=score-1, reason=\''.$emp[1].'\' WHERE tid=\''.$tdw.'\'';
						} elseif (($emp[0] == -1) || ($emp[0] == 5)) {
							$q .= ' reason='.$emp[1].' WHERE tid=\''.$tdw.'\'';
						}
						if(strlen($q) > 20) $db->sql_query($q);
					}
				}
			}
		}
		// Quake - start
		$options = '';
		$options .= '&mode='.$mode;
		$options .= '&order='.$order;
		$options .= '&thold='.$thold;
		// Quake - end

		Header('Location: modules.php?name='.$module_name.'&file=article&sid='.$sid.$options);
		break;

	case 'showreply':
		DisplayTopic($sid, $pid, $tid, $mode, $order, $thold);
		include_once('footer.php');
		break;

	default:
		if (!empty($tid) AND empty($pid)) {
			singlecomment($tid, $sid, $mode, $order, $thold);
		} elseif (!defined('NUKE_FILE') xor ($pid==0 AND !isset($pid))) {
			// Quake - start
			$options = '';
			$options .= '&mode='.$mode;
			$options .= '&order='.$order;
			$options .= '&thold='.$thold;
			// Quake - end

			Header('Location: modules.php?name='.$module_name.'&file=article&sid='.$sid.$options);
		} else {
			if(!isset($pid)) $pid=0;
			DisplayTopic($sid, $pid, $tid, $mode, $order, $thold);
		}
		break;

}

function format_url($comment) {
	global $nukeurl;
	unset($location);
	$links = array();
	$hrefs = array();
	$pos = 0;
	while (!(($pos = strpos($comment,'<',$pos)) === false)) {
		$pos++;
		$endpos = strpos($comment,'>',$pos);
		$tag = substr($comment,$pos,$endpos-$pos);
		$tag = trim($tag);
		if (isset($location)) {
			if (!strcasecmp(strtok($tag,' '),'/A')) {
				$link = substr($comment,$linkpos,$pos-1-$linkpos);
				$links[] = $link;
				$hrefs[] = $location;
				unset($location);
			}
			$pos = $endpos+1;
		} else {
			if (!strcasecmp(strtok($tag,' '),'A')) {
				if (preg_match("#HREF[ \t\n\r\v]*=[ \t\n\r\v]*\"([^\"]*)\"#i",$tag,$regs));
				else if (preg_match("#HREF[ \t\n\r\v]*=[ \t\n\r\v]*([^ \t\n\r\v]*)#i",$tag,$regs));
				else $regs[1] = '';
				if ($regs[1]) {
					$location = $regs[1];
				}
				$pos = $endpos+1;
				$linkpos = $pos;
			} else {
				$pos = $endpos+1;
			}
		}
	}
	for ($i=0; $i<sizeof($links); $i++) {
		if (!stripos_clone($hrefs[$i], 'http://')) {
			$hrefs[$i] = $nukeurl;
		} elseif (!stripos_clone($hrefs[$i], 'mailto://')) {
			$href = explode('/',$hrefs[$i]);
			$href = ' ['.$href[2].']';
			$comment = str_replace('>'.$links[$i].'</a>', ' title="'.$hrefs[$i].'"> '.$links[$i].'</a>'.$href, $comment);
		}
	}
	return($comment);
}

function modone() {
	global $admin, $moderate, $module_name, $user;
//	if(((isset($admin)) AND ($moderate == 1)) || ($moderate==2))
	if ((isset($admin)) OR ($moderate == 2 AND $user))
		echo '<form action="modules.php?name='.$module_name.'&amp;file=comments" method="post">';
}

function modtwo($tid, $score, $reason) {
	global $admin, $user, $moderate, $reasons;
//	if((((isset($admin)) AND ($moderate == 1)) || ($moderate == 2)) AND ($user)) {
	if ((isset($admin)) OR ($moderate == 2 AND $user)) {
		echo ' | <select name="dkn'.$tid.'">';
		for($i=0; $i<sizeof($reasons); $i++) {
			echo '<option value="'.$score.':'.$i.'">'.$reasons[$i].'</option>';
		}
		echo '</select>';
	}
}

function modthree($sid, $mode, $order, $thold=0) {
	global $admin, $user, $moderate;
//	if((((isset($admin)) && ($moderate == 1)) || ($moderate==2)) && ($user)) {
	if ((isset($admin)) OR ($moderate == 2 AND $user)) {
		echo '<center><input type="hidden" name="sid" value="'.$sid.'" />'
			.'<input type="hidden" name="mode" value="'.$mode.'" />'
			.'<input type="hidden" name="order" value="'.$order.'" />'
			.'<input type="hidden" name="thold" value="'.$thold.'" />'
			.'<input type="hidden" name="op" value="moderate" />'
			.'<input type="image" src="images/menu/moderate.gif" /></center></form>';
	}
}

function nocomm() {
	OpenTable();
	echo '<center><span class="content">'._NOCOMMENTSACT.'</span></center>';
	CloseTable();
}

function navbar($sid, $title, $thold, $mode, $order) {
	global $user, $bgcolor1, $bgcolor2, $textcolor1, $textcolor2, $anonpost, $prefix, $db, $module_name, $admin, $pid, $userinfo, $cookie;
	// Quake - start
	cookiedecode($user);
	getusrinfo($user);
	if (!isset($mode) OR empty($mode)) {
		if(isset($userinfo['umode'])) {
			$mode = $userinfo['umode'];
		} else {
			$mode = 'thread';
		}
	}
	if (!isset($order) OR empty($order)) {
		if(isset($userinfo['uorder'])) {
			$order = $userinfo['uorder'];
		} else {
			$order = 0;
		}
	}
	if (!isset($thold) OR empty($thold)) {
		if(isset($userinfo['thold'])) {
			$thold = $userinfo['thold'];
		} else {
			$thold = 0;
		}
	}
	// Quake - end
	$sid = intval($sid);
	$query = $db->sql_query('SELECT * FROM '.$prefix.'_comments WHERE sid=\''.$sid.'\'');
	if(!$query) {
		$count = 0;
	} else {
		$count = $db->sql_numrows($query);
	}

	$query = $db->sql_query('SELECT title FROM '.$prefix.'_stories WHERE sid=\''.$sid.'\'');
	list($un_title) = $db->sql_fetchrow($query);
	if(!isset($thold)) {
		$thold=0;
	}
	echo "\n\n".'<!-- COMMENTS NAVIGATION BAR START -->'."\n\n";
	echo '<a name="comments"></a>';
	// Header box
	OpenTable();
	echo '<table width="100%" border="0" cellspacing="1" cellpadding="2">';
	if($title) {
		echo '<tr><td align="center">'.$un_title.' | ';
		if(is_user($user)) {
			echo '<a href="modules.php?name=Your_Account&amp;op=editcomm">';
			echo _CONFIGURE;
			echo '</a>';
		} else {
			echo '<a href="modules.php?name=Your_Account">';
			echo _LOGINCREATE.'</a>';
		}
		if(($count==1)) {
			echo ' | <strong>'.$count.'</strong> '._COMMENT;
		} else {
			echo ' | <strong>'.$count.'</strong> '._COMMENTS;
		}
		if ($count > 0 AND is_active('Search')) {
			echo ' | <a href="modules.php?name=Search&amp;type=comments&amp;sid='.$sid.'">'._SEARCHDIS.'</a>';
		}
		echo '</td></tr>';
	}
	if ($anonpost==1 OR is_user($user)) {
		echo '<tr><td align="center" width="100%">';
		echo '<form action="modules.php?name='.$module_name.'&amp;file=comments" method="post">'
			.'<input type="hidden" name="pid" value="'.$pid.'" />'
			.'<input type="hidden" name="sid" value="'.$sid.'" />'
			.'<input type="hidden" name="op" value="Reply" />'
		   .'<input type="submit" value="'._REPLYMAIN.'" /></form></td></tr>';
	}
	echo '<tr><td bgcolor="'.$bgcolor2.'" align="center"><font class="tiny">'._COMMENTSWARNING.'</font></td></tr></table>'
		."\n\n".'<!-- COMMENTS NAVIGATION BAR END -->'."\n\n";
	CloseTable();
	// No Anonomous Posting Box
	if ($anonpost == 0 AND !is_user($user)) {
		OpenTable();
		echo '<center><p>'._NOANONCOMMENTS.'</p></center>';
		CloseTable();
	}
}

function DisplayKids($tid, $mode, $order=0, $thold=0, $level=0, $dummy=0, $tblwidth=99) {
	global $admin, $datetime, $user, $cookie, $bgcolor1, $reasons, $anonymous, $anonpost, $commentlimit, $prefix, $textcolor2, $db, $module_name, $user_prefix, $userinfo, $cookie;
	$comments = 0;
	static $indentAmt = 0; //Used to help get to XHTML compliance on the nested unordered lists
	if ($level == 0) $indentAmt = 0;
	cookiedecode($user);
	getusrinfo($user);
	// Quake - start
	if (!isset($mode) OR empty($mode)) {
		if(isset($userinfo['umode'])) {
			$mode = $userinfo['umode'];
		} else {
			$mode = 'thread';
		}
	}
	if (!isset($order) OR empty($order)) {
		if(isset($userinfo['uorder'])) {
			$order = $userinfo['uorder'];
		} else {
			$order = 0;
		}
	}
	if (!isset($thold) OR empty($thold)) {
		if(isset($userinfo['thold'])) {
			$thold = $userinfo['thold'];
		} else {
			$thold = 0;
		}
	}
	// Quake - end
	$hadUlTag = FALSE; //Used to help get to XHTML compliance on the nested unordered lists
	$hadListTag = FALSE; //Used to help get to XHTML compliance on the nested unordered lists
	$tid = intval($tid);
	$result = $db->sql_query('SELECT tid, pid, sid, date, name, email, host_name, subject, comment, score, reason FROM '.$prefix.'_comments WHERE pid=\''.$tid.'\' ORDER BY date, tid');
	if ($mode == 'nested') {
		/* without the tblwidth variable, the tables run of the screen with netscape */
		/* in nested mode in long threads so the text can't be read. */
		while ($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_sid = intval($row['sid']);
			$r_date = $row['date'];
			$r_name = stripslashes($row['name']);
			$r_email = stripslashes($row['email']);
			$r_host_name = $row['host_name'];
			$r_subject = stripslashes(check_html($row['subject'], 'nohtml'));
			$r_comment = stripslashes($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if($r_score >= $thold) {
				if (!isset($level)) {
				} else {
					if (!$comments) {
						$indentAmt++;
					}
				}
				$comments++;
				if (!preg_match('#[a-z0-9]#i',$r_name)) $r_name = $anonymous;
				if (!preg_match('#[a-z0-9]#i',$r_subject)) $r_subject = '['._NOSUBJECT.']';
				// HIJO enter hex color between first two appostrophe for second alt bgcolor
//				$r_bgcolor = ($dummy%2)?'':'#E6E6D2'; //montego - not used anywhere
//                echo '<a name="'.$r_tid.'">';
				echo '<table id="t'.$r_tid.'" width="90%" border="0"><tr bgcolor="'.$bgcolor1.'"><td width="',$indentAmt*25,'"></td><td>';
				formatTimestamp($r_date);
				if ($r_email) {
					echo '<p><strong>'.$r_subject.'</strong> ';
					if($userinfo['noscore'] == 0) {
						echo '('._SCORE.' '.$r_score;
						if($r_reason>0) echo ', '.$reasons[$r_reason];
						echo ')';
					}
					echo '<br />'._BY.' <a href="mailto:'.$r_email.'">'.$r_name.'</a> <strong>('.$r_email.')</strong> '._ON.' '.$datetime;
				} else {
					echo '<p><strong>'.$r_subject.'</strong> ';
					if($userinfo['noscore'] == 0) {
						echo '('._SCORE.' '.$r_score;
						if($r_reason>0) echo ', '.$reasons[$r_reason];
						echo ')';
					}
					echo '<br />'._BY.' '.$r_name.' '._ON.' '.$datetime;
				}
				if ($r_name != $anonymous) {
					$row2 = $db->sql_fetchrow($db->sql_query('SELECT user_id FROM '.$user_prefix.'_users WHERE username=\''.$r_name.'\''));
					$r_uid = intval($row2['user_id']);
					echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$r_name.'">'._USERINFO.'</a> ';
					// Quake check for pvt msg is active
					if(is_active('Private_Messages')) {
						echo '| <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$r_uid.'">'._SENDAMSG.'</a>) ';
					}
					echo ')';
					// end
				}
				$row_url = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM '.$user_prefix.'_users WHERE username=\''.$r_name.'\''));
				$url = stripslashes($row_url['user_website']);
				if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) {
					echo '<a href="'.$url.'" target="_blank">'.$url.'</a> ';
				}
				echo '</p></td></tr><tr><td width="',$indentAmt*25,'"></td><td>';
				// Quake - start
				$options = '';
				$options .= '&amp;mode='.$mode;
				$options .= '&amp;order='.$order;
				$options .= '&amp;thold='.$thold;
				// Quake - end
				if((isset($userinfo['commentmax'])) AND (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax']).'<br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;sid='.$r_sid.'&amp;tid='.$r_tid.$options.'">'._READREST.'</a></strong>';
				elseif(strlen($r_comment) > $commentlimit) echo substr($r_comment, 0, $commentlimit).'<br /><br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;sid='.$r_sid.'&amp;tid='.$r_tid.$options.'">'._READREST.'</a></strong>';
				else echo $r_comment;
				echo '<p><font color="'.$textcolor2.'"> [ ';
				if ($anonpost==1 OR is_admin($admin) OR is_user($user)) {
					echo '<a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=Reply&amp;pid='.$r_tid.'&amp;sid='.$r_sid.$options.'">'._REPLY.'</a>';
				}
				modtwo($r_tid, $r_score, $r_reason);
				echo ' ]</font></p>';
				echo '</td></tr></table>';
				DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1, $tblwidth);
			}
		}
	} elseif ($mode == 'flat') {
		while ($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_sid = intval($row['sid']);
			$r_date = $row['date'];
			$r_name = stripslashes($row['name']);
			$r_email = stripslashes($row['email']);
			$r_host_name = $row['host_name'];
			$r_subject = stripslashes(check_html($row['subject'], 'nohtml'));
			$r_comment = stripslashes($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if($r_score >= $thold) {
				if (!preg_match('#[a-z0-9]#i',$r_name)) $r_name = $anonymous;
				if (!preg_match('#[a-z0-9]#i',$r_subject)) $r_subject = '['._NOSUBJECT.']';
//                echo '<a name="'.$r_tid.'">';
				echo '<hr /><table id="t'.$r_tid.'" width="99%" border="0"><tr bgcolor="'.$bgcolor1.'"><td>';
				formatTimestamp($r_date);
				if ($r_email) {
					echo '<p><strong>'.$r_subject.'</strong> ';
					if($userinfo['noscore'] == 0) {
						echo '('._SCORE.' '.$r_score;
						if($r_reason>0) echo ', '.$reasons[$r_reason];
						echo ')';
					}
					echo '<br />'._BY.' <a href="mailto:'.$r_email.'">'.$r_name.'</a> <strong>('.$r_email.')</strong> '._ON.' '.$datetime;
				} else {
					echo '<p><strong>'.$r_subject.'</strong> ';
					if($userinfo['noscore'] == 0) {
						echo '('._SCORE.' '.$r_score;
						if($r_reason>0) echo ', '.$reasons[$r_reason];
						echo ')';
					}
					echo '<br />'._BY.' '.$r_name.' '._ON.' '.$datetime;
				}
				if ($r_name != $anonymous) {
					$row3 = $db->sql_fetchrow($db->sql_query('SELECT user_id FROM '.$user_prefix.'_users WHERE username=\''.$r_name.'\''));
					$ruid = intval($row3['user_id']);
					echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$r_name.'">'._USERINFO.'</a> | <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$ruid.'">'._SENDAMSG.'</a>) ';
				}
				$row_url2 = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM '.$user_prefix.'_users WHERE username=\''.$r_name.'\''));
				$url = stripslashes($row_url2['user_website']);
				if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) { echo '<a href="'.$url.'" target="_blank">'.$url.'</a> '; }
				echo '</p></td></tr><tr><td>';
				// Quake - start
				$options = '';
				$options .= '&amp;mode='.$mode;
				$options .= '&amp;order='.$order;
				$options .= '&amp;thold='.$thold;
				// Quake - end
				if((isset($userinfo['commentmax'])) AND (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax']).'<br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;sid='.$r_sid.'&amp;tid='.$r_tid.$options.'">'._READREST.'</a></strong>';
				elseif(strlen($r_comment) > $commentlimit) echo substr($r_comment, 0, $commentlimit).'<br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;sid='.$r_sid.'&amp;tid='.$r_tid.$options.'">'._READREST.'</a></strong>';
				else echo $r_comment;
				echo '</td></tr></table><p><font color="'.$textcolor2.'">';
				if ($anonpost==1 OR is_admin($admin) OR is_user($user)) {
					echo ' [ <a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=Reply&amp;pid='.$r_tid.'&amp;sid='.$r_sid.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._REPLY.'</a>';
				}
				modtwo($r_tid, $r_score, $r_reason);
				echo ' ]</font></p>';
				DisplayKids($r_tid, $mode, $order, $thold);
			}
		}
	} else {
		while ($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_sid = intval($row['sid']);
			$r_date = $row['date'];
			$r_name = stripslashes($row['name']);
			$r_email = stripslashes($row['email']);
			$r_host_name = $row['host_name'];
			$r_subject = stripslashes(check_html($row['subject'], 'nohtml'));
			$r_comment = stripslashes($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if($r_score >= $thold) {
				if (isset($level) && !$comments) {
					if ($indentAmt > 0) { echo '<li style="list-style:none">'; $hadListTag = TRUE; }
					echo '<ul>';
					$indentAmt++;
					$hadUlTag = TRUE;
				}
				$comments++;
				if (!preg_match('#[a-z0-9]#i',$r_name)) $r_name = $anonymous;
				if (!preg_match('#[a-z0-9]#i',$r_subject)) $r_subject = '['._NOSUBJECT.']';
				formatTimestamp($r_date);
				// Quake - start
				$options = '';
				$options .= '&amp;mode='.$mode;
				$options .= '&amp;order='.$order;
				$options .= '&amp;thold='.$thold;
				// Quake - end
				echo '<li><font color="'.$textcolor2.'"><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=showreply&amp;tid='.$r_tid.'&amp;sid='.$r_sid.'&amp;pid='.$r_pid.$options.'#'.$r_tid.'">'.$r_subject.'</a> '._BY.' '.$r_name.' '._ON.' '.$datetime.'</font></li>';
				DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1);
			}
		}
	}
	if ($hadUlTag) echo '</ul><br />';
	if ($hadListTag && $indentAmt > 1) {
		echo '</li>';
		$indentAmt--;
	}
}

/* This entire function I can find no use for... montego: 2006-12-28
function DisplayBabies($tid, $level=0, $dummy=0) {
	global $datetime, $anonymous, $prefix, $db, $module_name, $userinfo, $cookie, $user;
	cookiedecode($user);
	getusrinfo($user);
	$tid = intval($tid);
	$comments = 0;
	$result = $db->sql_query('SELECT tid, pid, sid, date, name, email, host_name, subject, comment, score, reason FROM '.$prefix.'_comments WHERE pid=\''.$tid.'\' ORDER BY date, tid');
	while ($row = $db->sql_fetchrow($result)) {
		$r_tid = intval($row['tid']);
		$r_pid = intval($row['pid']);
		$r_sid = intval($row['sid']);
		$r_date = $row['date'];
		$r_name = stripslashes($row['name']);
		$r_email = stripslashes($row['email']);
		$r_host_name = $row['host_name'];
		$r_subject = stripslashes(check_html($row['subject'], 'nohtml'));
		$r_comment = stripslashes($row['comment']);
		$r_score = intval($row['score']);
		$r_reason = intval($row['reason']);
		if (isset($level) AND !$comments) {
			echo '<ul>';
		}
		$comments++;
		if (!preg_match('#[a-z0-9]#i',$r_name)) { $r_name = $anonymous; }
		if (!preg_match('#[a-z0-9]#i',$r_subject)) { $r_subject = '['._NOSUBJECT.']'; }
		formatTimestamp($r_date);
		// Quake - start
		$options = '';
		$options .= '&amp;mode='.$mode;
		$options .= '&amp;order='.$order;
		$options .= '&amp;thold='.$thold;
		// Quake - end
		echo '<font class="content"><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=showreply&amp;tid='
			.$r_tid.$options.'">'.$r_subject.'</a> '._BY.' '.$r_name.' '._ON.' '.$datetime.'</font><br />';
		DisplayBabies($r_tid, $level+1, $dummy+1);
	}
	if ($level AND $comments) {
		echo '</ul>';
	}
}
*/

function DisplayTopic($sid, $pid=0, $tid=0, $mode="thread", $order=0, $thold=0, $level=0, $nokids=0) {
	//RN0000243: Fix by Montego - $user_prefix variable was not declared as global.
	global $title, $bgcolor1, $bgcolor2, $bgcolor3, $hr, $user, $datetime, $cookie, $admin, $commentlimit, $anonymous, $anonymousname, $reasons, $anonpost, $foot1, $foot2, $foot3, $foot4, $prefix, $acomm, $articlecomm, $db, $module_name, $nukeurl, $admin_file, $userinfo, $user_prefix;
	cookiedecode($user);
	getusrinfo($user);
	include_once('header.php');
	$count_times = 0;
	cookiedecode($user);
	getusrinfo($user);
	$q = 'SELECT tid, pid, sid, date, name, email, host_name, subject, comment, score, reason FROM '.$prefix.'_comments WHERE sid=\''.$sid.'\' and pid=\''.$pid.'\'';
	if(!empty($thold)) {
		$q .= ' AND score >= \''.$thold.'\'';
	} else {
		$q .= ' AND score >= 0';
	}
	if ($order==0) $q .= ' ORDER BY date ASC'; //RN0000665
	if ($order==1) $q .= ' ORDER BY date DESC';
	if ($order==2) $q .= ' ORDER BY score DESC';
	$something = $db->sql_query($q);
	$num_tid = $db->sql_numrows($something);
	if ($acomm == 1) {
		nocomm();
		return;
	}
	echo '<div class="content">';
	if (($acomm == 0) AND ($articlecomm == 1)) {
		navbar($sid, $title, $thold, $mode, $order);
	}
	modone();
	while ($count_times < $num_tid) {
		// Initial comment box
		OpenTable();
		$row_q = $db->sql_fetchrow($something);
		$tid = intval($row_q['tid']);
		$pid = intval($row_q['pid']);
		$sid = intval($row_q['sid']);
		$date = $row_q['date'];
		$c_name = stripslashes($row_q['name']);
		$email = stripslashes($row_q['email']);
		$host_name = $row_q['host_name'];
		$subject = stripslashes(check_html($row_q['subject'], 'nohtml'));
		$comment = stripslashes($row_q['comment']);
		$score = intval($row_q['score']);
		$reason = intval($row_q['reason']);
		if (empty($c_name)) { $c_name = $anonymous; }
		if (empty($subject)) { $subject = '['._NOSUBJECT.']'; }
//        echo '<a name="'.$tid.'"></a>';
                //Modified for the Tricked Out News Mod. To make the comments look more like forum.
		//echo '<table id="t'.$tid.'" width="99%" border="0"><tr bgcolor="'.$bgcolor1.'"><td width="500"><p>';
                echo '<table id="t'.$tid.'" width="100%" border="0" cellpadding="3" cellspacing="0"><tr bgcolor="'.$bgcolor1.'"><td width="30%"><p>';
		formatTimestamp($date);
		if ($email) {
			echo '<strong>'.$subject.'</strong> ';
			if($userinfo['noscore'] == 0) {
				echo '('._SCORE.' '.$score;
				if($reason>0) echo ', '.$reasons[$reason];
				echo ')';
			}
			echo '<br />'._BY.' <a href="mailto:'.$email.'">'.$c_name.'</a> <strong>('.$email.')</strong> '._ON.' '.$datetime;
		} else {
				echo '<strong>'.$subject.'</strong> ';
				if($userinfo['noscore'] == 0) {
					echo '('._SCORE.' '.$score;
					if($reason>0) echo ', '.$reasons[$reason];
					echo ')';
				}
				echo '<br />'._BY.' '.$c_name.' '._ON.' '.$datetime;
		}

			/* If you are admin you can see the Poster IP address */
			/* with this you can see who is flaming you...*/

# start avatar in comments mod Tricked Out News

			echo "<br />";

   if (($c_name != $anonymous)&&($c_name !=$anonymousname)) {
  $sql2 = "SELECT user_id,user_avatar FROM ".$prefix."_users WHERE username='$c_name'";

       $result2 = $db->sql_query($sql2);

      $row2 = $db->sql_fetchrow($result2);

      $avatar=$row2['user_avatar'];

      $user_id=intval($row2['user_id']);

    if(!empty($avatar) && !preg_match('#blank.gif#i', $avatar)) {
	
if(preg_match('#http://#i', $avatar)) { echo "<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$user_id\"><img src=\"$avatar\" border =\"0\" alt=\"\" /></a>"; } else  { echo "<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$user_id\"><img src=\"modules/Forums/images/avatars/$avatar\" border =\"0\" alt=\"\" /></a>"; }
}
else{
echo "&nbsp;&nbsp;<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$user_id\"><img src=\"images/news/noimage.gif\" border =\"0\" width=\"35\" height=\"35\" alt=\"\" /></a>";

}
   
   	}
# end avatar in comments mod



		$journal = '';
		if (is_active('Journal')) {
			$row = $db->sql_fetchrow($db->sql_query('SELECT jid FROM '.$prefix.'_journal WHERE aid=\''.$c_name.'\' AND status=\'yes\' ORDER BY pdate,jid DESC LIMIT 0,1'));
			$jid = intval($row['jid']);
			if (!empty($jid) AND isset($jid)) {
				$journal = ' | <a href="modules.php?name=Journal&amp;file=display&amp;jid='.$jid.'">'._JOURNAL.'</a>';
			} else {
				$journal = '';
			}
		}
		if ($c_name != $anonymous) {
			$row2 = $db->sql_fetchrow($db->sql_query('SELECT user_id FROM '.$user_prefix.'_users WHERE username=\''.$c_name.'\''));
			$r_uid = intval($row2['user_id']);
			echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$c_name.'">'._USERINFO.'</a> ';
			if(is_active('Private_Messages')) {
				echo '| <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$r_uid.'">'._SENDAMSG.'</a>';
			}
			echo $journal.') ';
		}
		$row_url = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM '.$user_prefix.'_users WHERE username=\''.$c_name.'\''));
		$url = stripslashes($row_url['user_website']);
		if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) { echo '<a href="'.$url.'" target="new">'.$url.'</a> '; }

		if(is_admin($admin)) {
			$row3 = $db->sql_fetchrow($db->sql_query('SELECT host_name FROM '.$prefix.'_comments WHERE tid=\''.$tid.'\''));
			$host_name = $row3['host_name'];
			echo '<br /><strong>(IP: '.$host_name.')</strong>';
		}
		echo '</p>';
                // Added for the Tricked Out News Mod to resemble forum post
                 echo  '</td><td width="1%"><img src="images/news/commentline.gif" alt="" />';
                echo  '</td><td width="69%">';
		// Quake - start
		$options = '';
		$options .= '&amp;mode='.$mode;
		$options .= '&amp;order='.$order;
		$options .= '&amp;thold='.$thold;
		// Quake - end
		if((isset($userinfo['commentmax'])) AND (strlen($comment) > $userinfo['commentmax'])) echo substr($comment, 0, $userinfo['commentmax']).'<br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;sid='.$r_sid.'&amp;tid='.$r_tid.$options.'">'._READREST.'</a></strong>';
		elseif(strlen($comment) > $commentlimit) echo substr($comment, 0, $commentlimit).'<br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;sid='.$sid.'&tid='.$tid.$options.'">'._READREST.'</a></strong>';
		else echo $comment;
		echo '</td></tr></table><hr />';
		if ($anonpost==1 OR is_admin($admin) OR is_user($user)) {
			echo ' [ <a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=Reply&amp;pid='.$tid.'&amp;sid='.$sid.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._REPLY.'</a>';
		}
		if ($pid != 0) {
			$row4 = $db->sql_fetchrow($db->sql_query('SELECT pid FROM '.$prefix.'_comments WHERE tid=\''.$pid.'\''));
			$erin = intval($row4['pid']);
			echo ' | <a href="modules.php?name='.$module_name.'&amp;file=comments&amp;sid='.$sid.'&amp;pid='.$erin.$options.'">'._PARENT.'</a>';
		}
		modtwo($tid, $score, $reason);

		if(is_admin($admin)) {
			echo ' | <a href="'.$admin_file.'.php?op=RemoveComment&amp;tid='.$tid.'&amp;sid='.$sid.'">'._DELETE.'</a> ]<br />';
		} elseif ($anonpost != 0 OR is_admin($admin) OR is_user($user)) {
			echo ' ]';
		}
		//echo '<br />';

		DisplayKids($tid, $mode, $order, $thold, $level);
		if($hr) echo '<hr noshade="noshade" size="1" />';
		$count_times += 1;
		CloseTable();
	}
	modthree($sid, $mode, $order, $thold);
	//RN0000242: Fix by Montego on 6/12/2006 as this code forces the footer to not be shown if navigated to top through parent links
	//if ($pid==0) {
	//    return array($sid, $pid, $subject);
	//} else {
//        include_once('footer.php');
	//}
	//End Fix by Montego
	echo '</div>';
}

function singlecomment($tid, $sid, $mode, $order, $thold) {
   global $module_name, $user, $cookie, $datetime, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $admin, $anonpost, $prefix, $textcolor2, $db,
      $anonymous;
	include_once('header.php');
	cookiedecode($user);
	getusrinfo($user);
	$row = $db->sql_fetchrow($db->sql_query('SELECT date, name, email, subject, comment, score, reason FROM '.$prefix.'_comments WHERE tid=\''.$tid.'\' AND sid=\''.$sid.'\''));
	$date = $row['date'];
	$name = stripslashes($row['name']);
	$email = stripslashes($row['email']);
	$subject = stripslashes(check_html($row['subject'], 'nohtml'));
	$comment = stripslashes($row['comment']);
	$score = intval($row['score']);
	$reason = intval($row['reason']);
	$titlebar = '<strong>$subject</strong>';
	if(empty($name)) $name = $anonymous;
	if(empty($subject)) $subject = '['._NOSUBJECT.']';
	OpenTable();
	echo '<div class="content">';
	modone();
	echo '<table width="99%" border="0"><tr bgcolor="'.$bgcolor1.'"><td width="500">';
	formatTimestamp($date);
	if($email) {
		echo '<p><strong>'.$subject.'</strong> <font color="'.$textcolor2.'">('._SCORE.' '.$score.')<br />'
			._BY.' </font><a href="mailto:'.$email.'"><font color="'.$bgcolor2.'">'
			.$name.'</font></a> <strong>('.$email.')</strong> '._ON.' '.$datetime;
	} else {
		echo '<p><strong>'.$subject.'</strong> ('._SCORE.' '.$score.')<br />'._BY." $name "._ON." $datetime";
	}
	echo '</p></td></tr><tr><td>'.$comment.'</td></tr></table>';
	if ($anonpost==1 OR is_admin($admin) OR is_user($user)) {
		// Quake - start
		$options = '';
		$options .= '&amp;mode='.$mode;
		$options .= '&amp;order='.$order;
		$options .= '&amp;thold='.$thold;
		// Quake - end
		echo ' [ <a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=Reply&amp;pid='
			.$tid.'&amp;sid='.$sid.$options.'">'._REPLY.'</a> | <a href="modules.php?name='
			.$module_name.'&amp;file=article&amp;sid='.$sid.$options.'">'._ROOT.'</a>';
	}
	modtwo($tid, $score, $reason);
	echo ' ]';
	modthree($sid, $mode, $order, $thold);
	echo '</div>';
	CloseTable();
	include_once('footer.php');
}

function reply($pid, $sid, $mode, $order, $thold) {
	//include_once("config.php");  // globalized - Quake
	include_once('header.php');
	global $prefix, $module_name, $user, $cookie, $datetime, $bgcolor1, $bgcolor2, $bgcolor3, $db, $anonpost, $anonymous, $admin, $AllowableHTML;
	cookiedecode($user);
	getusrinfo($user);
	echo '<div class="content">';
	if ($anonpost == 0 AND !is_user($user)) {
		title(_COMMENTREPLY);
		OpenTable();
		echo '<center><p>'._NOANONCOMMENTS.'</p><p>'._GOBACK.'</p></center>';
		CloseTable();
	} else {
		if ($pid != 0) {
			$row = $db->sql_fetchrow($db->sql_query('SELECT date, name, email, subject, comment, score FROM '.$prefix.'_comments WHERE tid=\''.$pid.'\''));
			$date = $row['date'];
			$name = stripslashes($row['name']);
			$email = stripslashes($row['email']);
//			if (!validateEmailFormat($email)) $email = '';
			$subject = stripslashes(check_html($row['subject'], 'nohtml'));
			$comment = stripslashes($row['comment']);
			$score = isset($row['score'])?intval($row['score']):0;
		} else {
			$row2 = $db->sql_fetchrow($db->sql_query('SELECT time, title, hometext, bodytext, informant, notes FROM '.$prefix.'_stories WHERE sid=\''.$sid.'\''));
			$date = $row2['time'];
			$subject = stripslashes(check_html($row2['title'], 'nohtml'));
			$temp_comment = stripslashes($row2['hometext']);
			$comment2 = stripslashes($row2['bodytext']);
			$name = stripslashes($row2['informant']);
			$notes = stripslashes($row2['notes']);
		}
		if(empty($comment)) {
			$comment = $temp_comment.'<br />'.$comment2;
		}
		title(_COMMENTREPLY);
		OpenTable();
		if (empty($name)) $name = $anonymous;
		if (empty($subject)) $subject = '['._NOSUBJECT.']';
		formatTimestamp($date);
		echo '<strong>'.$subject.'</strong> ';
		$score = isset($row['score'])?intval($row['score']):0;
		if (!empty($temp_comment)) echo '('._SCORE.' '.$score.')';
		if (!empty($email)) {
			echo '<br />'._BY.' <a href="mailto:'.$email.'">'.$name.'</a> <strong>('.$email.')</strong> '._ON.' '.$datetime;
		} else {
			echo '<br />'._BY.' '.$name.' '._ON.' '.$datetime;
		}
		echo '<br /><br />'.$comment.'<br /><br />';
		if ($pid == 0) {
			if (!empty($notes)) {
				echo '<strong>'._NOTE.'</strong> <i>'.$notes.'</i><br />';
			} else {
				echo '';
			}
		}
		if (!isset($pid) || !isset($sid)) { echo _SOMETHINGSNOTRIGHT; exit(); }
		if ($pid == 0) {
			$row3 = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_stories WHERE sid=\''.$sid.'\''));
			$subject = stripslashes(check_html($row3['title'], 'nohtml'));
		} else {
			$row4 = $db->sql_fetchrow($db->sql_query('SELECT subject FROM '.$prefix.'_comments WHERE tid=\''.$pid.'\''));
			$subject = stripslashes(check_html($row4['subject'], 'nohtml'));
		}
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<form action="modules.php?name='.$module_name.'&amp;file=comments" method="post">';
		echo '<font class="option"><strong>'._YOURNAME.':</strong></font> ';
		if (is_user($user)) {
			cookiedecode($user);
			echo '<a href="modules.php?name=Your_Account">'.$cookie[1].'</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">'._LOGOUT.'</a> ]<br />';
		} else {
			echo $anonymous;
			echo ' [ <a href="modules.php?name=Your_Account">'._NEWUSER.'</a> ]<br /><br />';
		}
		echo '<font class="option"><strong>'._SUBJECT.':</strong></font><br />';
		if (!stripos_clone($subject,'Re:')) $subject = 'Re: '.substr($subject,0,81);
		echo '<input type="text" name="subject" size="50" maxlength="85" value="'.$subject.'" /><br /><br />';
		echo '<font class="option"><strong>'._UCOMMENT.':</strong></font><br />';
             //wysiwyg editor integration
			//.'<textarea cols="50" rows="10" name="comment"></textarea><br />'
                      wysiwyg_textarea("comment", "", "NukeUser", "50", "12");
			//echo  '._ALLOWEDHTML."<br />"';
		//while (list($key)= each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
		//echo '<br />';
		if (is_user($user) AND ($anonpost == 1)) { echo '<input type="checkbox" name="xanonpost" /> '._POSTANON.'<br />'; }
		// Quake - start
		if (!isset($mode) OR empty($mode)) {
			if(isset($userinfo['umode'])) {
				$mode = $userinfo['umode'];
			} else {
				$mode = 'thread';
			}
		}
		if (!isset($order) OR empty($order)) {
			if(isset($userinfo['uorder'])) {
				$order = $userinfo['uorder'];
			} else {
				$order = 0;
			}
		}
		if (!isset($thold) OR empty($thold)) {
			if(isset($userinfo['thold'])) {
				$thold = $userinfo['thold'];
			} else {
				$thold = 0;
			}
		}
		// Quake - end
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
		global $modGFXChk;
		echo '<br />'.security_code($modGFXChk[$module_name], 'stacked').'<br />';
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
		echo '<input type="hidden" name="pid" value="'.$pid.'" />'
			.'<input type="hidden" name="sid" value="'.$sid.'" />'
			.'<input type="hidden" name="mode" value="'.$mode.'" />'
			.'<input type="hidden" name="order" value="'.$order.'" />'
			.'<input type="hidden" name="thold" value="'.$thold.'" />'
			.'<input type="submit" name="op" value="'._PREVIEW.'" />'
			.'<input type="submit" name="op" value="'._OK.'" />'
			.'<select name="posttype">'
			.'<option value="exttrans">'._EXTRANS.'</option>'
                       .'<option value="plaintext" >'._PLAINTEXT.'</option>'
			.'<option value="html" selected="selected">'._HTMLFORMATED.'</option>'
			.'</select></form>';
		CloseTable();
	}
	echo '</div>';
	include_once('footer.php');
}

function replyPreview($pid, $sid, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype) {
	global $module_name, $user, $cookie, $AllowableHTML, $anonymous, $anonpost, $userinfo;
	include_once('header.php');
	cookiedecode($user);
	getusrinfo($user);
	echo '<div class="content">';
	title(_COMREPLYPRE);
	OpenTable();
	cookiedecode($user);
	$subject = stripslashes(check_html($subject, 'nohtml'));
	$comment = stripslashes($comment);
	if (!isset($pid) OR !isset($sid)) {
		die(_NOTRIGHT);
	}
	echo '<p><strong>'.$subject.'</strong><br />';
	echo _BY.' ';
	if (is_user($user)) {
		echo $cookie[1];
	} else {
		echo $anonymous;
	}
	echo ' '._ONN.'</p>';
	if ($posttype == 'exttrans') {
		echo nl2br(htmlspecialchars($comment));
	} elseif ($posttype == 'plaintext') {
		echo nl2br($comment);
	} else {
		echo $comment;
	}
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<form action="modules.php?name='.$module_name.'&amp;file=comments" method="post"><p><strong>'._YOURNAME.':</strong> ';
	if (is_user($user)) {
		echo '<a href="modules.php?name=Your_Account">'.$cookie[1].'</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">'._LOGOUT.'</a> ]';
	} else {
		echo $anonymous;
	}
	echo '</p><p><strong>'._SUBJECT.':</strong><br />'
		.'<input type="text" name="subject" size="50" maxlength="85" value="'.$subject.'" /></p>'
		.'<p><strong>'._UCOMMENT.':</strong><br />';
		//.'<textarea cols="50" rows="10" name="comment">'.htmlentities($comment, ENT_QUOTES).'</textarea></p>'
		//.'<p>'._ALLOWEDHTML.'<br />';
	//while (list($key,) = each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
	 wysiwyg_textarea("comment", "$comment", "NukeUser", "50", "12");
      echo '</p>';
	if (($xanonpost) AND ($anonpost == 1)){
		echo '<input type="checkbox" name="xanonpost" checked="checked" /> '._POSTANON.'<br />';
	} elseif ((is_user($user)) AND ($anonpost == 1)) {
		echo '<input type="checkbox" name="xanonpost" /> '._POSTANON.'<br />';
	}
	// Quake - start
	if (!isset($mode) OR empty($mode)) {
		if(isset($userinfo['umode'])) {
			$mode = $userinfo['umode'];
		} else {
			$mode = 'thread';
		}
	}
	if (!isset($order) OR empty($order)) {
		if(isset($userinfo['uorder'])) {
			$order = $userinfo['uorder'];
		} else {
			$order = 0;
		}
	}
	if (!isset($thold) OR empty($thold)) {
		if(isset($userinfo['thold'])) {
			$thold = $userinfo['thold'];
		} else {
			$thold = 0;
		}
	}
	// Quake - end
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
		global $modGFXChk;
		echo '<br />'.security_code($modGFXChk[$module_name], 'stacked').'<br />';
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
	echo '<input type="hidden" name="pid" value="'.$pid.'" />'
		.'<input type="hidden" name="sid" value="'.$sid.'" />'
		.'<input type="hidden" name="mode" value="'.$mode.'" />'
		.'<input type="hidden" name="order" value="'.$order.'" />'
		.'<input type="hidden" name="thold" value="'.$thold.'" />'
		.'<input type="submit" name="op" value="'._PREVIEW.'" />'
		.'<input type="submit" name="op" value="'._OK.'" />'
		.'<select name="posttype"><option value="exttrans"';
	if ($posttype == 'exttrans') {
		echo ' selected="selected"';
	}
	echo '>'._EXTRANS.'</option>'
		.'<option value="html"';
	if ($posttype == 'html') {
		echo ' selected="selected"';
	}
	echo '>'._HTMLFORMATED.'</option>'
		.'<option value="plaintext"';
	if (($posttype != 'exttrans') && ($posttype != 'html')) {
		echo ' selected="selected"';
	}
	echo '>'._PLAINTEXT.'</option></select></form>';
	CloseTable();
	echo '</div>';
	include_once('footer.php');
}

function CreateTopic($xanonpost, $subject, $comment, $pid, $sid, $host_name, $mode, $order, $thold, $posttype) {
	global $module_name, $user, $userinfo, $EditedMessage, $cookie, $AllowableHTML, $ultramode, $prefix, $anonpost, $articlecomm, $db;
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
	global $modGFXChk;
	if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check']; else $gfx_check = '';
	if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
		include_once('header.php');
		OpenTable();
		echo '<center><font class="option"><strong><i>'._SECCODEINCOR.'</i></strong></font><br /><br />';
		echo '[ <a href="javascript:history.go(-1)">'._GOBACK2.'</a> ]</center>';
		CloseTable();
		include_once('footer.php');
		die();
	}
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
******************************************************/
	cookiedecode($user);
	getusrinfo($user);
// I can find no reference to $author anywhere so I am commenting this next line out - Raven 1/3/2007
//    $author = FixQuotes($author);
	$subject = FixQuotes(filter_text($subject, 'nohtml'));
	$comment = format_url(trim($comment));
	if($posttype == 'exttrans') {
		$comment = FixQuotes(nl2br(htmlspecialchars(check_words($comment))));
	} elseif($posttype == 'plaintext') {
		$comment = FixQuotes(nl2br(filter_text($comment)));
	} else {
		$comment = FixQuotes(stripslashes(filter_text($comment)));
	}
	if (is_user($user) AND !$xanonpost) {
		$name = $userinfo['username'];
		$email = $userinfo['femail'];
		$url = $userinfo['user_website'];
		$score = 1;
	} else {
		$name = '';
		$email = '';
		$url = '';
		$score = 0;
	}
	if (empty($ip)) {
			$ip = $_SERVER['REMOTE_ADDR'];
	}
	$fakeresult = $db->sql_query('SELECT acomm FROM '.$prefix.'_stories WHERE sid=\''.$sid.'\'');
	$fake = $db->sql_numrows($fakeresult);
	if ($fake == 1 AND $articlecomm == 1) {
		$fakerow = $db->sql_fetchrow($fakeresult);
		$acomm = intval($fakerow['acomm']);
		if ((($anonpost == 0 AND is_user($user)) OR $anonpost == 1) AND $acomm == 0) {
			// Quake - start
			$koptions = '';
			$koptions .= '&amp;mode='.$mode;
			$koptions .= '&amp;order='.$order;
			$koptions .= '&amp;thold='.$thold;
			// Quake - end
			$db->sql_query('INSERT INTO '.$prefix.'_comments VALUES (NULL, \''.$pid.'\', \''.$sid.'\', now(), \''.$name.'\', \''.$email.'\', \''.$url.'\', \''.$ip.'\', \''.$subject.'\', \''.$comment.'\', \''.$score.'\',\'0\')');
			$db->sql_query('UPDATE '.$prefix.'_stories SET comments=comments+1 WHERE sid=\''.$sid.'\'');
			update_points(5);
			if ($ultramode) { ultramode(); }
		} else {
				die(_NICETRY);
		}
	} else {
		include_once('header.php');
		echo _ANNOYINGMSG;
		include_once('footer.php');
	}
	$options = '';
	// Quake - start
	$options = '';
	$options .= '&mode='.$mode;
	$options .= '&order='.$order;
	$options .= '&thold='.$thold;
	// Quake - end
	Header('Location: modules.php?name='.$module_name.'&file=article&sid='.$sid.$options);
}

?>

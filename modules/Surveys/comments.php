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

if (!defined('MODULE_FILE')) {
    die('You can\'t access this file directly...');
}

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- '._SURVEYS;

// Quake - start
if (isset($sid)) { $sid = intval($sid); } else { $sid = ''; }
if (isset($pollID)) { $pollID = intval($pollID); } else { $pollID = ''; }
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
if (!isset($op)) { $op = ''; }
if (!isset($host_name)) $host_name='';

switch($op) {

    case 'Reply':
        reply($pid, $pollID, $mode, $order, $thold);
        break;

    case _PREVIEW:
        replyPreview($pid, $pollID, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype);
        break;

    case _OK:
        CreateTopic($xanonpost, $subject, $comment, $pid, $pollID, $host_name, $mode, $order, $thold, $posttype);
        break;

    case 'moderate':
        global $module_name;
        require_once('mainfile.php');
        if((is_admin($admin)) || ($moderate==2)) {
            while(list($tdw, $emp) = each($_POST)) {
                if (stripos_clone($tdw,'dkn')) {
                    $emp = explode(':', $emp);
                    if($emp[1] != 0) {
                        $tdw = str_replace('dkn', '', $tdw);
                        $emp[0] = intval($emp[0]);
                        $emp[1] = intval($emp[1]);
                        $tdw = intval($tdw);
                        $q = 'UPDATE '.$prefix.'_pollcomments SET';
                        if(($emp[1] == 9) && ($emp[0]>=0)) { # Overrated
                            $q .= ' score=score-1 where tid=\''.$tdw.'\'';
                        } elseif (($emp[1] == 10) && ($emp[0]<=4)) { # Underrated
                            $q .= ' score=score+1 where tid=\''.$tdw.'\'';
                        } elseif (($emp[1] > 4) && ($emp[0]<=4)) {
                            $q .= ' score=score+1, reason=\''.$emp[1].'\' where tid=\''.$tdw.'\'';
                        } elseif (($emp[1] < 5) && ($emp[0] > -1)) {
                            $q .= ' score=score-1, reason=\''.$emp[1].'\' where tid=\''.$tdw.'\'';
                        } elseif (($emp[0] == -1) || ($emp[0] == 5)) {
                            $q .= ' reason=\''.$emp[1].'\' where tid=\''.$tdw.'\'';
                        }
                        if(strlen($q) > 20) $db->sql_query($q);
                    }
                }
            }
        }
        Header("Location: modules.php?name=$module_name&op=results&pollID=$pollID");
        break;

    case 'showreply':
        DisplayTopic($pollID, $pid, $tid, $mode, $order, $thold);
        break;

    default:
        global $module_name, $mode, $userinfo, $order, $thold;
        if ((isset($tid)) && (!isset($pid))) {
            singlecomment($tid, $pollID, $mode, $order, $thold);
        } elseif (!isset($pid)) {
            Header("Location: modules.php?name=$module_name&op=results&pollID=$pollID&mode=$mode&order=$order&thold=$thold");
        } else {
            if(!isset($pid)) $pid=0;
            if(!isset($tid)) $tid=0;
            DisplayTopic($pollID, $pid, $tid, $mode, $order, $thold);
        }
        break;
}

//Only functions below this line

function format_url($comment) {
    global $nukeurl;
    unset($location);
    $comment = $comment;
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
            $comment = str_replace('>'.$links[$i].'</a>', 'title="'.$hrefs[$i].'"> '.$links[$i].'</a>'.$href, $comment);
        }
    }
    return($comment);
}

function modone() {
    global $admin, $moderate, $module_name, $user;
//    if (((isset($admin)) && ($moderate == 1)) || ($moderate==2))
    if ((isset($admin)) OR ($moderate == 2 AND $user))
        echo '<form action="modules.php?name='.$module_name.'&amp;file=comments" method="post">';
}

function modtwo($tid, $score, $reason) {
    global $admin, $user, $moderate, $reasons;
//    if((((isset($admin)) && ($moderate == 1)) || ($moderate == 2)) && ($user)) {
    if ((isset($admin)) OR ($moderate == 2 AND $user)) {
        echo ' | <select name="dkn'.$tid.'">';
        for($i=0; $i<sizeof($reasons); $i++) {
            echo '<option value="'.$score.':'.$i.'">'.$reasons[$i].'</option>';
        }
        echo '</select>';
    }
}

function modthree($pollID, $mode, $order, $thold=0) {
    global $admin, $user, $moderate;
//    if((((isset($admin)) && ($moderate == 1)) || ($moderate==2)) && ($user)) {
    if ((isset($admin)) OR ($moderate == 2 AND $user)) {
        echo '<center><input type="hidden" name="pollID" value="'.$pollID.'" />'
            .'<input type="hidden" name="mode" value="'.$mode.'" />'
            .'<input type="hidden" name="order" value="'.$order.'" />'
            .'<input type="hidden" name="thold" value="'.$thold.'" />'
            .'<input type="hidden" name="op" value="moderate" />'
            .'<input type="image" src="images/menu/moderate.gif" /></center></form>';
    }
}

function navbar($pollID, $title, $thold, $mode, $order) {
    global $user, $bgcolor1, $bgcolor2, $textcolor1, $textcolor2, $anonpost, $pollcomm, $prefix, $db, $module_name;
    OpenTable();
    $pollID = intval($pollID);
    $query = $db->sql_query('SELECT pollID FROM '.$prefix.'_pollcomments where pollID=\''.$pollID.'\'');
    if(!$query) $count = 0; else $count = $db->sql_numrows($query);
    $row = $db->sql_fetchrow($db->sql_query('SELECT pollTitle from '.$prefix.'_poll_desc where pollID=\''.$pollID.'\''));
    $title = stripslashes(check_html($row['pollTitle'], 'nohtml'));
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
    echo "\n\n<!-- COMMENTS NAVIGATION BAR START -->\n\n";
    echo '<table width="99%" border="0" cellspacing="1" cellpadding="2">';
    if($title) {
        echo '<tr><td bgcolor="'.$bgcolor2.'" align="center"><font color="'.$textcolor1.'">"'.$title.'" | ';
        if(is_user($user)) {
            echo '<a href="modules.php?name=Your_Account&amp;op=editcomm">'._CONFIGURE.'</a>';
        } else {
            echo '<a href="modules.php?name=Your_Account">'._LOGINCREATE.'</a>';
        }
        if(($count==1)) {
            echo ' | <strong>'.$count.'</strong> '._COMMENT.'</font></td></tr>';
        } else {
            echo ' | <strong>'.$count.'</strong> '._COMMENTS.'</font></td></tr>';
        }
    }
    echo '<tr><td bgcolor="'.$bgcolor1.'" align="center" width="100%">';
    cookiedecode($user);
    if (($pollcomm) AND ($mode != 'nocomments')) {
        if ($anonpost==1 OR (isset($admin) AND is_admin($admin)) OR is_user($user)) {
            if (!isset($pid)) { $pid = 0; }
            echo '<form action="modules.php?name='.$module_name.'&amp;file=comments" method="post">'
                .'<input type="hidden" name="pid" value="'.$pid.'" />'
                .'<input type="hidden" name="pollID" value="'.$pollID.'" />'
                .'<input type="hidden" name="op" value="Reply" />'
                .'<input type="submit" value="'._REPLYMAIN.'" /></form>';
        }
    }
    echo '</td></tr><tr><td bgcolor="'.$bgcolor2.'" align="center"><font class="tiny">'._COMMENTSWARNING.'</font></td></tr>'
        .'</table>'
        ."\n\n<!-- COMMENTS NAVIGATION BAR END -->\n\n";
    CloseTable();
    if ($anonpost == 0 AND !is_user($user)) {
        OpenTable();
        echo '<center><p>'._NOANONCOMMENTS.'</p></center>';
        CloseTable();
    }
}

function DisplayKids($tid, $mode, $order=0, $thold=0, $level=0, $dummy=0, $tblwidth=99) {
    global $datetime, $user, $cookie, $bgcolor1, $reasons, $anonymous, $anonpost, $commentlimit, $prefix, $module_name, $db, $userinfo, $user_prefix, $admin, $bgcolor2;
    $comments = 0;
    static $indentAmt = 0; //Used to help get to XHTML compliance on the nested unordered lists
    if ($level == 0) $indentAmt = 0;
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
    $hadUlTag = FALSE; //Used to help get to XHTML compliance on the nested unordered lists
    $hadListTag = FALSE; //Used to help get to XHTML compliance on the nested unordered lists
    $tid = intval($tid);
    $result = $db->sql_query('SELECT tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason from '.$prefix.'_pollcomments where pid = \''.$tid.'\' order by date, tid');
    if ($mode == 'nested') {
        /* without the tblwidth variable, the tables run off the screen with netscape
           in nested mode in long threads so the text can't be read. */
        while($row = $db->sql_fetchrow($result)) {
            $r_tid = intval($row['tid']);
            $r_pid = intval($row['pid']);
            $r_pollID = intval($row['pollID']);
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
                if (!preg_mach('#[a-z0-9]#i',$r_subject)) $r_subject = '['._NOSUBJECT.']';
                // enter hex color between first two appostrophe for second alt bgcolor
                $r_bgcolor = ($dummy%2) ? '' : '#E6E6D2';
                echo '<table id="t'.$r_tid.'" width="90%" border="0"><tr bgcolor="'.$bgcolor1.'"><td width="',$indentAmt*25,'"></td><td>';
                formatTimestamp($r_date);
                if ($r_email) {
                    echo '<p><strong>'.$r_subject.'</strong> ';
                    if($userinfo['noscore'] == 0) {
                        echo '('._SCORE.' '.$r_score.'';
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
                    echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$r_name.'">'._USERINFO.'</a> | <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$r_uid.'">'._SENDAMSG.'</a>) ';
                }
                $row_url = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM '.$user_prefix.'_users WHERE username=\''.$r_name.'\''));
                $url = stripslashes($row_url['user_website']);
                if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) { echo '<a href="'.$url.'" target="new">'.$url.'</a> '; }
                echo '</p></td></tr><tr><td width="',$indentAmt*25,'"></td><td>';
                if((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax']).'<br /><br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;pollID='.$r_pollID.'&amp;tid='.$r_tid.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._READREST.'</a></strong>';
                elseif(strlen($r_comment) > $commentlimit) echo substr($r_comment, 0, $commentlimit).'<br /><br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;pollID='.$r_pollID.'&amp;tid='.$r_tid.'&&amp;='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._READREST.'</a></strong>';
                else echo $r_comment;
                echo '<p><font color="'.$bgcolor2.'"> [ ';
                if ($anonpost==1 OR is_admin($admin) OR is_user($user)) {
                    echo '<a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=Reply&amp;pid='.$r_tid.'&amp;pollID='.$r_pollID.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._REPLY.'</a>';
                }
                modtwo($r_tid, $r_score, $r_reason);
                echo ' ]</font></p>';
                echo '</td></tr></table>';
                DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1, $tblwidth);
            }
        }
    } elseif ($mode == 'flat') {
        while($row = $db->sql_fetchrow($result)) {
            $r_tid = intval($row['tid']);
            $r_pid = intval($row['pid']);
            $r_pollID = intval($row['pollID']);
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
                $url = $row_url2['user_website'];
                if ($url != 'http://' AND !empty($url) AND preg_match('#http://#', $url)) { echo '<a href="'.$url.'" target="new">'.$url.'</a> '; }
                echo '</p></td></tr><tr><td>';
                if((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax']).'<br /><br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;pollID='.$r_pollID.'&amp;tid='.$r_tid.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._READREST.'</a></strong>';
                elseif(strlen($r_comment) > $commentlimit) echo substr($r_comment, 0, $commentlimit).'<br /><br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;pollID='.$r_pollID.'&amp;tid='.$r_tid.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._READREST.'</a></strong>';
                else echo $r_comment;
                echo '</td></tr></table><p><font color="'.$bgcolor2.'"> [ <a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=Reply&amp;pid='.$r_tid.'&amp;pollID='.$r_pollID.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._REPLY.'</a>';
                modtwo($r_tid, $r_score, $r_reason);
                echo ' ]</font></p>';
                DisplayKids($r_tid, $mode, $order, $thold);
            }
        }
    } else {
        while($row = $db->sql_fetchrow($result)) {
            $r_tid = intval($row['tid']);
            $r_pid = intval($row['pid']);
            $r_pollID = intval($row['pollID']);
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
                echo '<li><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=showreply&amp;tid='.$r_tid.'&amp;pollID='.$r_pollID.'&amp;pid='.$r_pid.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'#t'.$r_tid.'">'.$r_subject.'</a> '._BY.' '.$r_name.' '._ON.' '.$datetime.'</li>';
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
    global $userinfo, $datetime, $anonymous, $prefix, $db, $module_name;
    $comments = 0;
    $tid = intval($tid);
    $result = $db->sql_query('SELECT tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason from '.$prefix.'_pollcomments where pid = \''.$tid.'\' order by date, tid');
    while($row = $db->sql_fetchrow($result)) {
        $r_tid = intval($row['tid']);
        $r_pid = intval($row['pid']);
        $r_pollID = intval($row['pollID']);
        $r_date = $row['date'];
        $r_name = stripslashes($row['name']);
        $r_email = stripslashes($row['email']);
        $r_host_name = $row['host_name'];
        $r_subject = stripslashes(check_html($row['subject'], 'nohtml'));
        $r_comment = stripslashes($row['comment']);
        $r_score = intval($row['score']);
        $r_reason = intval($row['reason']);
        if (!isset($level)) {
        } else {
            if (!$comments) {
                echo '<ul>';
            }
        }
        $comments++;
        if (!preg_match('#[a-z0-9]#i',$r_name)) { $r_name = $anonymous; }
        if (!preg_match('#[a-z0-9]#i',$r_subject)) { $r_subject = '['._NOSUBJECT.']'; }
        formatTimestamp($r_date);
        echo '<a href="modules.php?name=$module_name&amp;file=comments&amp;op=showreply&amp;tid='.$r_tid.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'.$r_subject.'</a> '._BY.' $r_name '._ON.' '.$datetime.'<br />';
        DisplayBabies($r_tid, $level+1, $dummy+1);
    }
    if ($level && $comments) {
        echo '</ul>';
    }
}
*/

function DisplayTopic ($pollID, $pid=0, $tid=0, $mode='thread', $order=0, $thold=0, $level=0, $nokids=0) {
    global $title, $bgcolor1, $bgcolor2, $bgcolor3, $hr, $user, $datetime, $cookie, $admin, $commentlimit, $anonymous, $reasons, $anonpost, $foot1, $foot2, $foot3, $foot4, $prefix, $module_name, $db, $admin_file, $userinfo, $user_prefix;
    include_once('header.php');
    $count_times = 0;

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

    $q = 'select tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason from '.$prefix.'_pollcomments where pollID=\''.$pollID.'\' and pid=\''.$pid.'\'';
    if(!empty($thold)) {
        $q .= ' and score>=\''.$thold.'\'';
    } else {
        $q .= ' and score>=\'0\'';
    }
    if ($order==1) $q .= ' order by date desc';
    if ($order==2) $q .= ' order by score desc';
    $something = $db->sql_query($q);
    $num_tid = $db->sql_numrows($something);
    echo '<div class="content">';
    navbar($pollID, $title, $thold, $mode, $order);
    modone();
    while ($count_times < $num_tid) {
        OpenTable();
        $row_q = $db->sql_fetchrow($something);
        $tid = intval($row_q['tid']);
        $pid = intval($row_q['pid']);
        $pollID = intval($row_q['pollID']);
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
        echo '<table id="t'.$tid.'" width="99%" border="0"><tr bgcolor="'.$bgcolor1.'"><td width="500"><p>';
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

        // If you are admin you can see the Poster IP address (you have this right, no?)
        // with this you can see who is flaming you... ha-ha-ha

        $journal = '';
        if (is_active('Journal')) {
            $row = $db->sql_fetchrow($db->sql_query('SELECT jid from '.$prefix.'_journal where aid=\''.$c_name.'\' AND status=\'yes\' order by pdate,jid DESC limit 0,1'));
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
            echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$c_name.'">'._USERINFO.'</a> | <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$r_uid.'">'._SENDAMSG.'</a>'.$journal.') ';
        }
        $row_url = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM '.$user_prefix.'_users WHERE username=\''.$c_name.'\''));
        $url = stripslashes($row_url['user_website']);
        if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) { echo '<a href="'.$url.'" target="new">'.$url.'</a> '; }

        if(is_admin($admin)) {
            $row3 = $db->sql_fetchrow($db->sql_query('SELECT host_name from '.$prefix.'_pollcomments where tid=\''.$tid.'\''));
            $host_name = $row3['host_name'];
            echo '<br /><strong>(IP: '.$host_name.')</strong>';
        }

        echo '</p></td></tr><tr><td>';
        if((isset($userinfo['commentmax'])) && (strlen($comment) > $userinfo['commentmax'])) echo substr($comment, 0, $userinfo['commentmax']).'<br /><br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;pollID='.$r_pollID.'&amp;tid='.$r_tid.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._READREST.'</a></strong>';
        elseif(strlen($comment) > $commentlimit) echo substr($comment, 0, $commentlimit).'<br /><br /><strong><a href="modules.php?name='.$module_name.'&amp;file=comments&amp;pollID='.$pollID.'&amp;tid='.$tid.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._READREST.'</a></strong>';
        else echo $comment;
        echo '</td></tr></table><br /><br />';
        if ($anonpost==1 OR is_admin($admin) OR is_user($user)) {
            echo ' [ <a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=Reply&amp;pid='.$tid.'&amp;pollID='.$pollID.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._REPLY.'</a>';
        }
        if ($pid != 0) {
            $row4 = $db->sql_fetchrow($db->sql_query('SELECT pid from '.$prefix.'_pollcomments where tid=\''.$pid.'\''));
            $erin = intval($row4['pid']);
            echo '| <a href="modules.php?name='.$module_name.'&amp;file=comments&amp;pollID='.$pollID.'&amp;pid='.$erin.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._PARENT.'</a>';
        }
        modtwo($tid, $score, $reason);

        if(is_admin($admin)) {
            echo ' | <a href="'.$admin_file.'.php?op=RemovePollComment&amp;tid='.$tid.'&amp;pollID='.$pollID.'">'._DELETE.'</a> ]';
        } elseif ($anonpost != 0 OR is_admin($admin) OR is_user($user)) {
            echo ' ]';
        }
        echo '<br /><br />';

        DisplayKids($tid, $mode, $order, $thold, $level);
        if($hr) echo '<hr noshade="noshade" size="1" />';
        $count_times += 1;
        CloseTable();
    }
    modthree($pollID, $mode, $order, $thold);
    //RN0000247: Fix by Montego on 6/12/2006 as this code forces the footer to not be shown if navigated to top through parent links
    //f($pid==0) return array($pollID, $pid, $subject);
    //else include_once("footer.php");
    echo '</div>';
    include_once('footer.php');
    //End Fix by Montego

}

function singlecomment($tid, $pollID, $mode, $order, $thold) {
    include_once('header.php');
    global $userinfo, $user, $cookie, $datetime, $bgcolor1, $bgcolor2, $bgcolor3, $anonpost, $admin, $anonymous, $prefix, $db, $module_name;
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
    $tid = intval($tid);
    $pollID = intval($pollID);
    $row = $db->sql_fetchrow($db->sql_query('SELECT date, name, email, subject, comment, score, reason from '.$prefix.'_pollcomments where tid=\''.$tid.'\' and pollID=\''.$pollID.'\''));
    $date = $row['date'];
    $name = stripslashes($row['name']);
    $email = stripslashes($row['email']);
    $subject = stripslashes(check_html($row['subject'], 'nohtml'));
    $comment = stripslashes($row['comment']);
    $score = intval($row['score']);
    $reason = intval($row['reason']);
    $titlebar = '<strong>'.$subject.'</strong>';
    if(empty($name)) $name = $anonymous;
    if(empty($subject)) $subject = '['._NOSUBJECT.']';
    echo '<div class="content">';
    modone();
    echo '<table width="99%" border="0"><tr bgcolor="'.$bgcolor1.'"><td width="500">';
    formatTimestamp($date);
    if($email) echo '<p><strong>'.$subject.'</strong> ('._SCORE.' '.$score.')<br />'._BY.' <a href="mailto:'.$email.'"><font color="'.$bgcolor2.'">'.$name.'</font></a> <strong>('.$email.')</strong> '._ON.' '.$datetime;
    else echo '<p><strong>'.$subject.'</strong> ('._SCORE.' '.$score.')<br />'._BY.' '.$name.' '._ON.' '.$datetime.'';
    echo '</p></td></tr><tr><td>'.$comment.'</td></tr></table><br /><br /><font color="'.$bgcolor2.'"> [ <a href="modules.php?name='.$module_name.'&amp;file=comments&amp;op=Reply&amp;pid='.$tid.'&amp;pollID='.$pollID.'&amp;mode='.$mode.'&amp;order='.$order.'&amp;thold='.$thold.'">'._REPLY.'</a> | <a href="modules.php?name='.$module_name.'&amp;pollID='.$pollID.'">'._ROOT.'</a>';
    modtwo($tid, $score, $reason);
    echo ' ]';
    modthree($pollID, $mode, $order, $thold);
    echo '</div>';
    include_once('footer.php');
}

function reply($pid, $pollID, $mode, $order, $thold) {
    include_once('header.php');
    global $userinfo, $user, $cookie, $datetime, $bgcolor1, $bgcolor2, $bgcolor3, $AllowableHTML, $anonymous, $prefix, $anonpost, $module_name, $db;
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
    $pid = intval($pid);
    $pollID = intval($pollID);
    $order = htmlentities($order);
    $thold = htmlentities($thold);
    $mode = htmlentities($mode);
    echo '<div class="content">';
    if ($anonpost == 0 AND !is_user($user)) {
        title(_SURVEYCOM);
        OpenTable();
        echo '<center><p>'._NOANONCOMMENTS.'</p><p>'._GOBACK.'</p></center>';
        CloseTable();
    } else {
        if($pid!=0) {
            list($date, $name, $email, $subject, $comment, $score) = $db->sql_fetchrow($db->sql_query('select date, name, email, subject, comment, score from '.$prefix.'_pollcomments where tid=\''.$pid.'\''));
            $score = intval($score);
        } else {
            list($subject) = $db->sql_fetchrow($db->sql_query('select pollTitle FROM '.$prefix.'_poll_desc where pollID=\''.$pollID.'\''));
        }
        // note, I dont see where temp comment is ever set to anything but ill be safe 12/06
        if (!isset($temp_comment)) { $temp_comment = ''; }
        if(empty($comment)) {
            $comment = $temp_comment;
        }
        $titlebar = '<strong>'.$subject.'</strong>';
        if(empty($name)) $name = $anonymous;
        if(empty($subject)) $subject = '['._NOSUBJECT.']';
        if (!isset($date)) { $date = time(); }
        formatTimestamp($date);
        title(_SURVEYCOM);
        OpenTable();
        echo '<center><p><strong>'.$subject.'</strong></p></center>';
        if (empty($comment)) {
            echo '<center><p><i>'._DIRECTCOM.'</i></p></center>';
        } else {
            echo $comment.'<br /><br />';
        }
        CloseTable();
        if(!isset($pid) || !isset($pollID)) { echo 'Something is not right. This message is just to keep things from messing up down the road'; exit(); }
        if($pid == 0) {
            list($subject) = $db->sql_fetchrow($db->sql_query('select pollTitle from '.$prefix.'_poll_desc where pollID=\''.$pollID.'\''));
        } else {
            list($subject) = $db->sql_fetchrow($db->sql_query('select subject from '.$prefix.'_pollcomments where tid=\''.$pid.'\''));
        }
        echo '<br />';
        OpenTable();
        echo '<form action="modules.php?name='.$module_name.'&amp;file=comments" method="post">';
        echo '<p><strong>'._YOURNAME.':</strong> ';
        if (is_user($user)) {
            cookiedecode($user);
            echo '<a href="modules.php?name=Your_Account">'.$cookie[1].'</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">'._LOGOUT.'</a> ]';
        } else {
            echo $anonymous;
            $xanonpost=1;
        }
        echo '</p><p><strong>'._SUBJECT.':</strong><br />';
        if (!stripos_clone($subject,'Re:')) $subject = 'Re: '.substr($subject,0,81);
        echo '<input type="text" name="subject" size="50" maxlength="85" value="'.$subject.'" /></p>';
        echo '<p><strong>'._UCOMMENT.':</strong><br />'
            .'<textarea cols="50" rows="10" name="comment"></textarea></p>'
            .'<p>'._ALLOWEDHTML.'<br />';
        while (list($key,)= each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
        echo '</p>';
        if (is_user($user) AND ($anonpost == 1)) { echo '<input type="checkbox" name="xanonpost" /> '._POSTANON.'<br />'; }
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
        global $modGFXChk;
        echo '<br />'.security_code($modGFXChk[$module_name], 'stacked').'<br />';
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
        echo '<input type="hidden" name="pid" value="'.$pid.'" />'
            .'<input type="hidden" name="pollID" value="'.$pollID.'" />'
            .'<input type="hidden" name="mode" value="'.$mode.'" />'
            .'<input type="hidden" name="order" value="'.$order.'" />'
            .'<input type="hidden" name="thold" value="'.$thold.'" />'
            .'<br /><input type="submit" name="op" value="'._PREVIEW.'" />&nbsp;'
            .'<input type="submit" name="op" value="'._OK.'" />&nbsp;'
            .'<select name="posttype">'
            .'<option value="exttrans">'._EXTRANS.'</option>'
            .'<option value="html">'._HTMLFORMATED.'</option>'
            .'<option value="plaintext" selected="selected">'._PLAINTEXT.'</option>'
            .'</select>'
            .'</form>';
        CloseTable();
    }
    echo '</div>';
    include_once('footer.php');
}

function replyPreview($pid, $pollID, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype) {
    include_once('header.php');
    global $userinfo, $user, $cookie, $AllowableHTML, $anonymous, $module_name, $anonpost;
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
    $subject = stripslashes(check_html($subject, 'nohtml'));
    $comment = stripslashes(check_html($comment));
    $pid = intval($pid);
    $pollID = intval($pollID);
    if (!isset($pid) || !isset($pollID)) {
        die(_NOTRIGHT);
    }
    echo '<div class="content">';
    title(_SURVEYCOMPRE);
    OpenTable();
    echo '<p><strong>'.$subject.'</strong><br />';
    echo _BY.' ';
    if (is_user($user)) {
        echo $cookie[1];
    } else {
        echo $anonymous;
    }
    echo ' '._ONN.'</p>';
    if ($posttype=='exttrans') {
        echo nl2br(htmlspecialchars($comment));
    } elseif ($posttype=='plaintext') {
        echo nl2br($comment);
    } else {
        echo $comment;
    }
    CloseTable();
    echo '<br />';
    OpenTable();
    echo '<form action="modules.php?name='.$module_name.'&amp;file=comments" method="post">'
        .'<p><strong>'._YOURNAME.':</strong> ';
    if (is_user($user)) {
        echo '<a href="modules.php?name=Your_Account">'.$cookie[1].'</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">'._LOGOUT.'</a> ]';
    } else {
        echo $anonymous;
    }
    echo '</p><p><strong>'._SUBJECT.':</strong><br />'
        .'<input type="text" name="subject" size="50" maxlength="85" value="'.$subject.'" /></p>'
        .'<p><strong>'._UCOMMENT.':</strong><br />'
        .'<textarea cols="50" rows="10" name="comment">'.htmlentities($comment, ENT_QUOTES).'</textarea></p>';
    echo'<p>'._ALLOWEDHTML.'<br />';
    while (list($key,)= each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
    echo '</p>';
    if (($xanonpost) AND ($anonpost == 1)) {
        echo '<input type="checkbox" name="xanonpost" checked="checked" /> '._POSTANON.'<br />';
    } elseif ((is_user($user)) AND ($anonpost == 1)) {
        echo '<input type="checkbox" name="xanonpost" /> '._POSTANON.'<br />';
    }
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
    global $modGFXChk;
    echo '<br />'.security_code($modGFXChk[$module_name], 'stacked').'<br />';
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
    echo '<input type="hidden" name="pid" value="'.$pid.'" />'
        .'<input type="hidden" name="pollID" value="'.$pollID.'" />'
        .'<input type="hidden" name="mode" value="'.$mode.'" />'
        .'<input type="hidden" name="order" value="'.$order.'" />'
        .'<input type="hidden" name="thold" value="'.$thold.'" />'
        .'<br /><input type="submit" name="op" value="'._PREVIEW.'" />&nbsp;'
        .'<input type="submit" name="op" value="'._OK.'" />&nbsp;'
        .'<select name="posttype"><option value="exttrans"';
    if($posttype=='exttrans') echo ' selected="selected"';
    echo  '>'._EXTRANS.'</option><option value="html"';
    if($posttype=='html') echo ' selected="selected"';
    echo '>'._HTMLFORMATED.'</option><option value="plaintext"';
    if(($posttype!='exttrans') && ($posttype!='html')) echo ' selected="selected"';
    echo '>'._PLAINTEXT.'</option></select></form>';
    CloseTable();
    echo '</div>';
    include_once('footer.php');
}

function CreateTopic($xanonpost, $subject, $comment, $pid, $pollID, $host_name, $mode, $order, $thold, $posttype) {
    global $userinfo, $user, $userinfo, $EditedMessage, $cookie, $prefix, $pollcomm, $anonpost, $db, $module_name;
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
    $author = FixQuotes($author);
    $subject = FixQuotes(filter_text($subject, 'nohtml'));
    $comment = format_url($comment);
    if ($posttype=='exttrans') {
        $comment = FixQuotes(nl2br(htmlspecialchars(check_words($comment))));
    } elseif ($posttype=='plaintext') {
        $comment = FixQuotes(nl2br(filter_text($comment)));
    } else {
        $comment = FixQuotes(filter_text($comment));
    }
    if(is_user($user)) {
        getusrinfo($user);
    }
    if ((is_user($user)) && (!$xanonpost)) {
        getusrinfo($user);
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
    $ip = $_SERVER['REMOTE_HOST'];
    if (empty($ip)) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $pollID = intval($pollID);
    $result = $db->sql_query('select count(*) from '.$prefix.'_poll_desc where pollID=\''.$pollID.'\'');
    $fake = $db->sql_numrows($result);
    if ($fake == 1) {
        if ((($anonpost == 0) AND (is_user($user))) OR ($anonpost == 1)) {
            $db->sql_query('insert into '.$prefix.'_pollcomments values (NULL, \''.$pid.'\', \''.$pollID.'\', now(), \''.$name.'\', \''.$email.'\', \''.$url.'\', \''.$ip.'\', \''.$subject.'\', \''.$comment.'\', \''.$score.'\', \'0\')');
            update_points(9);
        } else {
            echo 'Nice try...';
            die();
        }
    } else {
        include_once('header.php');
        echo 'According to my records, the topic you are trying '
            .'to reply to does not exist. If you\'re just trying to be '
            .'annoying, well then too bad.';
        include_once('footer.php');
        die();
    }
    $options = '';
    if ($pollcomm == 1) {
        if (isset($userinfo['umode'])) $options .= '&amp;mode='.$userinfo['umode']; else $options .= '&amp;mode=thread';
        if (isset($userinfo['uorder'])) $options .= '&amp;order='.$userinfo['uorder']; else $options .= '&amp;order=0';
        if (isset($userinfo['thold'])) $options .= '&amp;thold='.$userinfo['thold']; else $options .= '&amp;thold=0';
    }
    Header("Location: modules.php?name=$module_name&op=results&pollID=$pollID$options");
}

?>
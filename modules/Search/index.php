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
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

require_once('mainfile.php');
$instory = '';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
global $admin, $prefix, $db, $module_name, $articlecomm, $multilingual, $admin_file;
if ($multilingual == 1) {
    $queryalang = 'AND (s.alanguage=\''.$currentlang.'\' OR s.alanguage=\'\')'; /* stories */
    $queryrlang = 'AND rlanguage=\''.$currentlang.'\' '; /* reviews */
} else {
    $queryalang = '';
    $queryrlang = '';
    $queryslang = '';
}

if (!isset($query)) { $query = ''; }
if (!isset($type)) { $type = ''; }
if (!isset($category)) { $category = 0; }
if (!isset($days)) { $days = 0; }
if (!isset($author)) { $author = ''; }

if (!isset($op)) $op = '';
    switch($op) {

        case 'comments':
        break;

        default:
            $ThemeSel = get_theme();
            $offset=10;
            if (!isset($min)) $min=0;
            if (!isset($max)) $max=$min+$offset;
            $min = intval($min);
            $max = intval($max);
            $query = stripslashes(htmlentities($query, ENT_QUOTES));
            $pagetitle = '- '._SEARCH;
            include_once('header.php');
            $topic = intval($topic);
            if ($topic>0) {
                $row = $db->sql_fetchrow($db->sql_query('SELECT topicimage, topictext from '.$prefix.'_topics where topicid=\''.$topic.'\''));
                $topicimage = stripslashes($row['topicimage']);
                $topictext = stripslashes(check_html($row['topictext'], 'nohtml'));
                if (file_exists('themes/'.$ThemeSel.'/images/topics/'.$topicimage)) {
                    $topicimage = 'themes/'.$ThemeSel.'/images/topics/'.$topicimage;
                } else {
                    $topicimage = $tipath . $topicimage;
                }
            } else {
                $topictext = _ALLTOPICS;
                if (file_exists('themes/'.$ThemeSel.'/images/topics/AllTopics.gif')) {
                    $topicimage = 'themes/'.$ThemeSel.'/images/topics/AllTopics.gif';
                } else {
                    $topicimage = $tipath . 'AllTopics.gif';
                }
            }
            if (file_exists('themes/'.$ThemeSel.'/images/topics/AllTopics.gif')) {
                $alltop = 'themes/'.$ThemeSel.'/images/topics/AllTopics.gif';
            } else {
                $alltop = $tipath . 'AllTopics.gif';
            }
            OpenTable();
            if ($type == 'users') {
                echo '<center><font class="title"><strong>'._SEARCHUSERS.'</strong></font></center><br />';
            } elseif ($type == 'reviews') {
                echo '<center><font class="title"><strong>'._SEARCHREVIEWS.'</strong></font></center><br />';
            } elseif ($type == 'comments' AND isset($sid)) {
                $res = $db->sql_query('select title from '.$prefix.'_stories where sid=\''.$sid.'\'');
                list($st_title) = $db->sql_fetchrow($res);
                $st_title = stripslashes(check_html($st_title, 'nohtml'));
                $instory = 'AND sid=\''.$sid.'\'';
                echo '<center><font class="title"><strong>'._SEARCHINSTORY.' '.$st_title.'</strong></font></center><br />';
            } else {
                echo '<center><font class="title"><strong>'._SEARCHIN.' '.$topictext.'</strong></font></center><br />';
            }

            echo '<table width="100%" border="0"><tr><td>';
            if (($type == 'users') OR ($type == 'reviews')) {
                echo '<img src="'.$alltop.'" align="right" border="0" alt="" />';
            } else {
                echo '<img src="'.$topicimage.'" align="right" border="0" alt="'.$topictext.'" />';
            }
            echo '<form action="modules.php?name='.$module_name.'" method="post">'
                .'<input size="25" type="text" name="query" value="'.$query.'" />&nbsp;&nbsp;'
                .'<input type="submit" value="'._SEARCH.'" /><br /><br />';
            if (isset($sid)) {
                echo '<input type="hidden" name="sid" value="'.$sid.'" />';
            }
            echo '<!-- Topic Selection -->';
            $toplist = $db->sql_query('SELECT topicid, topictext from '.$prefix.'_topics order by topictext');
            echo '<select name="topic">';
            echo '<option value="">'._ALLTOPICS.'</option>';
            while($row2 = $db->sql_fetchrow($toplist)) {
                $topicid = intval($row2['topicid']);
                $topics = stripslashes(check_html($row2['topictext'], 'nohtml'));
                if ($topicid==$topic) { $sel = 'selected="selected" '; } else { $sel = ''; }
                echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>';
            }
            echo '</select>';
            /* Category Selection */
            $category = intval($category);
            echo '&nbsp;<select name="category">';
            echo '<option value="0">'._ARTICLES.'</option>';
            $result3 = $db->sql_query('SELECT catid, title from '.$prefix.'_stories_cat order by title');
            while ($row3 = $db->sql_fetchrow($result3)) {
                $catid = intval($row3['catid']);
                $title = stripslashes(check_html($row3['title'], 'nohtml'));
                if ($catid==$category) { $sel = 'selected="selected" '; } else { $sel = ''; }
                echo '<option '.$sel.' value="'.$catid.'">'.$title.'</option>';
            }
            echo '</select>';
            /* Authors Selection */
            $thing = $db->sql_query('SELECT aid from '.$prefix.'_authors order by aid');
            echo '&nbsp;<select name="author">';
            echo '<option value="">'._ALLAUTHORS.'</option>';
            while($row4 = $db->sql_fetchrow($thing)) {
                $authors = stripslashes($row4['aid']);
                if ($authors==$author) { $sel = 'selected="selected" '; } else { $sel = ''; }
                echo '<option value="'.$authors.'" '.$sel.'>'.$authors.'</option>';
            }
            echo '</select>';
            /* Date Selection */
                        ?>
                &nbsp;<select name='days'>
                                <option <?php echo $days == 0 ? 'selected="selected" ' : ''; ?> value='0'><?php echo _ALL ?></option>
                                <option <?php echo $days == 7 ? 'selected="selected" ' : ''; ?> value='7'>1 <?php echo _WEEK ?></option>
                                <option <?php echo $days == 14 ? 'selected="selected" ' : ''; ?> value='14'>2 <?php echo _WEEKS ?></option>
                                <option <?php echo $days == 30 ? 'selected="selected" ' : ''; ?> value='30'>1 <?php echo _MONTH ?></option>
                    <option <?php echo $days == 60 ? 'selected="selected" ' : ''; ?> value='60'>2 <?php echo _MONTHS ?></option>
                                <option <?php echo $days == 90 ? 'selected="selected" ' : ''; ?> value='90'>3 <?php echo _MONTHS ?></option>
                        </select><br />
                <?php
            $sel1 = $sel2 = $sel3 = $sel4 = '';
            if (($type == 'stories') OR (empty($type))) {
                $sel1 = 'checked="checked"';
            } elseif ($type == 'comments') {
                $sel2 = 'checked="checked"';
            } elseif ($type == 'users') {
                $sel3 = 'checked="checked"';
            } elseif ($type == 'reviews') {
                $sel4 = 'checked="checked"';
            }
            $num_rev = $db->sql_numrows($db->sql_query('SELECT * from '.$prefix.'_reviews'));
            echo _SEARCHON;
            echo '<input type="radio" name="type" value="stories" '.$sel1.' /> '._SSTORIES;
            if ($articlecomm == 1) {
                echo '<input type="radio" name="type" value="comments" '.$sel2.' /> '._SCOMMENTS;
            }
            echo '<input type="radio" name="type" value="users" '.$sel3.' /> '._SUSERS;
            if ($num_rev > 0) {
                echo '<input type="radio" name="type" value="reviews" '.$sel4.' /> '._REVIEWS;
            }
            echo '</form></td></tr></table>';
            $query = stripslashes(check_html($query, 'nohtml'));
            if ($type=='stories' OR !$type) {

                if ($category > 0) {
                    $categ = 'AND catid=\''.$category.'\' ';
                } else {
                    $categ = '';
                }
                $q = 'select s.sid, s.aid, s.informant, s.title, s.time, s.hometext, s.bodytext, a.url, s.comments, s.topic from '.$prefix.'_stories s, '.$prefix.'_authors a where s.aid=a.aid '.$queryalang.' '.$categ;
                if (isset($query)) $q .= 'AND (s.title LIKE \'%'.$query.'%\' OR s.hometext LIKE \'%'.$query.'%\' OR s.bodytext LIKE \'%'.$query.'%\' OR s.notes LIKE \'%'.$query.'%\') ';
                if (!empty($author)) $q .= 'AND s.aid=\''.$author.'\' ';
                if (!empty($topic)) $q .= 'AND s.topic=\''.$topic.'\' ';
                if (!empty($days) && $days!=0) $q .= 'AND TO_DAYS(NOW()) - TO_DAYS(time) <= \''.$days.'\' ';
                $q .= ' ORDER BY s.time DESC LIMIT '.$min.','.$offset;
                $t = $topic;
                $result5 = $db->sql_query($q);
                $nrows = $db->sql_numrows($result5);
                $x=0;
                if (!empty($query)) {
                    echo '<br /><hr noshade="noshade" size="1" /><center><strong>'._SEARCHRESULTS.'</strong></center><br /><br />';
                    echo '<table width="99%" cellspacing="0" cellpadding="0" border="0">';
                    if ($nrows>0) {
                        while($row5 = $db->sql_fetchrow($result5)) {
                            $sid = intval($row5['sid']);
                            $aid = stripslashes($row5['aid']);
                            $informant = stripslashes($row5['informant']);
                            $title = stripslashes(check_html($row5['title'], 'nohtml'));
                            $time = $row5['time'];
                            $hometext = stripslashes($row5['hometext']);
                            $bodytext = stripslashes($row5['bodytext']);
                            $url = stripslashes($row5['url']);
                            $comments = intval($row5['comments']);
                            $topic = intval($row5['topic']);
                            $row6 = $db->sql_fetchrow($db->sql_query('SELECT topictext from '.$prefix.'_topics where topicid=\''.$topic.'\''));
                            $topictext = stripslashes(check_html($row6['topictext'], 'nohtml'));

                            $furl = 'modules.php?name=News&amp;file=article&amp;sid='.$sid;
                            $datetime = formatTimestamp($time);
                            $query = stripslashes(check_html($query, 'nohtml'));
                            if (empty($informant)) {
                                $informant = $anonymous;
                            } else {
                                $informant = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a>';
                            }
                            if (!empty($query) AND $query != '*') {
                                if (preg_match('#'.quotemeta($query).'#i',$title)) {
                                    $a = 1;
                                }
                                $text = $hometext.$bodytext;
                                if (preg_match('#'.quotemeta($query).'#i',$text)) {
                                    $a = 2;
                                }
                                if (preg_match('#'.quotemeta($query).'#i',$text) AND preg_match('#'.quotemeta($query).'#i',$title)) {
                                    $a = 3;
                                }
                                if (isset($a) && $a == 1) { //RN0000550
                                    $match = _MATCHTITLE;
                                } elseif (isset($a) && $a == 2) { //RN0000550
                                    $match = _MATCHTEXT;
                                } elseif (isset($a) && $a == 3) { //RN0000550
                                    $match = _MATCHBOTH;
                                }
                                if (!isset($a)) {
                                    $match = '';
                                } else {
                                    $match = $match.'<br />';
                                }
                            }
                            printf('<tr><td><img src="images/folders.gif" border="0" alt="" />&nbsp;<font class="option"><a href="%s"><strong>%s</strong></a></font><br /><font class="content">'._CONTRIBUTEDBY.' '.$informant.'<br />'._POSTEDBY.' <a href="%s">%s</a>',$furl,$title,$url,$aid,$informant);
                            echo ' '._ON.' '.$datetime.'<br />'
                                .$match
                                ._TOPIC.': <a href="modules.php?name='.$module_name.'&amp;query=&amp;topic='.$topic.'">'.$topictext.'</a> ';
                            if ($comments == 0) {
                                echo '('._NOCOMMENTS.')';
                            } elseif ('.$comments.' == 1) {
                                echo '('.$comments.' '._UCOMMENT.')';
                            } elseif ('.$comments.' >1) {
                                echo '('.$comments.' '._UCOMMENTS.')';
                            }
                            if (is_admin($admin)) {
                                echo ' [ <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]';
                            }
                            echo '</font><br /><br /><br /></td></tr>';
                            $x++;
                        }

                        echo '</table>';
                    } else {
                        echo '<tr><td><center><font class="option"><strong>'._NOMATCHES.'</strong></font></center><br /><br />';
                        echo '</td></tr></table>';
                    }

                    $prev=$min-$offset;
                    if ($prev>=0) {
                        print '<br /><br /><center><a href="modules.php?name='.$module_name.'&amp;author='.$author.'&amp;topic='.$t.'&amp;min='.$prev.'&amp;query='.$query.'&amp;type='.$type.'&amp;category='.$category.'">';
                        print '<strong>'.$min.' '._PREVMATCHES.'</strong></a></center>';
                    }

                    $next=$min+$offset;
                    if ($x>=9) {
                        print '<br /><br /><center><a href="modules.php?name='.$module_name.'&amp;author='.$author.'&amp;topic='.$t.'&amp;min='.$max.'&amp;query='.$query.'&amp;type='.$type.'&amp;category='.$category.'">';
                        print '<strong>'._NEXTMATCHES.'</strong></a></center>';
                    }
                }

            } elseif ($type=='comments') {
                /*
                                $sid = intval($sid);
                        if (isset($sid)) {
                        $row7 = $db->sql_fetchrow($db->sql_query('SELECT title from '.$prefix.'_stories where sid=\''.$sid.'\''));
                        $st_title = stripslashes(check_html($row7['title'], 'nohtml'));
                        $instory = 'AND sid=\''.$sid.'\'';
                        } else {
                        $instory = '';
                        }
                */
                $result8 = $db->sql_query('SELECT tid, sid, subject, date, name from '.$prefix.'_comments where (subject like \'%'.$query.'%\' OR comment like \'%'.$query.'%\') order by date DESC limit '.$min.','.$offset);
                $nrows = $db->sql_numrows($result8);
                $x=0;
                if (!empty($query)) {
                    echo '<br /><hr noshade="noshade" size="1" /><center><strong>'._SEARCHRESULTS.'</strong></center><br /><br />';
                    echo '<table width="99%" cellspacing="0" cellpadding="0" border="0">';
                    if ($nrows>0) {
                        while($row8 = $db->sql_fetchrow($result8)) {
                            $tid = intval($row8['tid']);
                            $sid = intval($row8['sid']);
                            $subject = stripslashes(check_html($row8['subject'], 'nohtml'));
                            $date = $row8['date'];
                            $name = stripslashes($row8['name']);
                            $row_res = $db->sql_fetchrow($db->sql_query('SELECT title from '.$prefix.'_stories where sid=\''.$sid.'\''));
                            $title = stripslashes(check_html($row_res['title'], 'nohtml'));
                            $reply = $db->sql_numrows($db->sql_query('SELECT * from '.$prefix.'_comments where pid=\''.$tid.'\''));
                            $furl = 'modules.php?name=News&amp;file=article&amp;thold=-1&amp;mode=flat&amp;order=1&amp;sid='.$sid.'#'.$tid;
                            if(!$name) {
                                $name = $anonymous;
                            } else {
                                $name = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$name.'">'.$name.'</a>';
                            }
                            $datetime = formatTimestamp($date);
                            echo '<tr><td><img src="images/folders.gif" border="0" alt="" />&nbsp;<font class="option"><a href="'.$furl.'"><strong>'.$subject.'</strong></a></font><font class="content"><br />'._POSTEDBY.' '.$name
                                .' '._ON.' '.$datetime.'<br />'
                                ._ATTACHART.': '.$title.'<br />';
                            if ($reply == 1) {
                                echo '('.$reply.' '._SREPLY.')';
                                if (is_admin($admin)) {
                                    echo ' [ <a href="'.$admin_file.'.php?op=RemoveComment&amp;tid='.$tid.'&amp;sid='.$sid.'">'._DELETE.'</a> ]';
                                }
                                echo '<br /><br /><br /></td></tr>';
                            } else {
                                echo '($reply '._SREPLIES.')';
                                if (is_admin($admin)) {
                                    echo ' [ <a href="'.$admin_file.'.php?op=RemoveComment&amp;tid='.$tid.'&amp;sid='.$sid.'">'._DELETE.'</a> ]';
                                }
                                echo '<br /><br /><br /></td></tr>';
                            }
                            $x++;
                        }
                        echo '</table>';
                    } else {
                        echo '<tr><td><center><font class="option"><strong>'._NOMATCHES.'</strong></font></center><br /><br />';
                        echo '</td></tr></table>';
                    }

                    $prev=$min-$offset;
                    if ($prev>=0) {
                            print '<br /><br /><center><a href="modules.php?name='.$module_name.'&amp;author='.$author.'&amp;topic='.$topic.'&amp;min='.$prev.'&amp;query='.$query.'&amp;type='.$type.'">';
                            print '<strong>'.$min.' '._PREVMATCHES.'</strong></a></center>';
                    }

                    $next=$min+$offset;
                    if ($x>=9) {
                        print '<br /><br /><center><a href="modules.php?name='.$module_name.'&amp;author='.$author.'&amp;topic='.$topic.'&amp;min='.$max.'&amp;query='.$query.'&amp;type='.$type.'">';
                        print '<strong>'._NEXTMATCHES.'</strong></a></center>';
                    }
                }
            } elseif ($type=='reviews') {
                $res_n = $db->sql_query('SELECT id, title, text, reviewer, score from '.$prefix.'_reviews where (title like \'%'.$query.'%\' OR text like \'%'.$query.'%\') '.$queryrlang.' order by date DESC limit '.$min.','.$offset);
                $nrows = $db->sql_numrows($res_n);
                $x=0;
                if (!empty($query)) {
                    echo '<br /><hr noshade="noshade" size="1" /><center><strong>'._SEARCHRESULTS.'</strong></center><br /><br />';
                    echo '<table width="99%" cellspacing="0" cellpadding="0" border="0">';
                    if ($nrows>0) {
                        while($rown = $db->sql_fetchrow($res_n)) {
                            $id = intval($rown['id']);
                            $title = stripslashes(check_html($rown['title'], 'nohtml'));
                            $text = stripslashes($rown['text']);
                            $reviewer = stripslashes($rown['reviewer']);
                            $score = intval($rown['score']);
                            $furl = 'modules.php?name=Reviews&amp;op=showcontent&amp;id='.$id;
                            $pages = count(explode( '<!--pagebreak-->', $text ));
                            echo '<tr><td><img src="images/folders.gif" border="0" alt="" />&nbsp;<font class="option"><a href="'.$furl.'"><strong>'.$title.'</strong></a></font><br />'
                                .'<font class="content">'._POSTEDBY.' '.$reviewer.'<br />'
                                ._REVIEWSCORE.': '.$score.'/10<br />';
                            if ($pages == 1) {
                                echo '($pages '._PAGE.')';
                                        } else {
                                echo '($pages '._PAGES.')';
                            }
                            if (is_admin($admin)) {
                                echo ' [ <a href="modules.php?name=Reviews&amp;op=mod_review&amp;id='.$id.'">'._EDIT.'</a> | <a href="modules.php?name=Reviews.php&amp;op=del_review&amp;id_del='.$id.'">'._DELETE.'</a> ]';
                            }
                            print '<br /><br /><br /></font></td></tr>';
                            $x++;
                        }
                        echo '</table>';
                    } else {
                        echo '<tr><td><center><font class="option"><strong>'._NOMATCHES.'</strong></font></center><br /><br />';
                        echo '</td></tr></table>';
                    }

                    $prev=$min-$offset;
                    if ($prev>=0) {
                        print '<br /><br /><center><a href="modules.php?name='.$module_name.'&amp;author='.$author.'&amp;topic='.$t.'&amp;min='.$prev.'&amp;query='.$query.'&amp;type='.$type.'">';
                        print '<strong>'.$min.' '._PREVMATCHES.'</strong></a></center>';
                    }

                    $next=$min+$offset;
                    if ($x>=9) {
                        print '<br /><br /><center><a href="modules.php?name='.$module_name.'&amp;author='.$author.'&amp;topic='.$t.'&amp;min='.$max.'&amp;query='.$query.'&amp;type='.$type.'">';
                        print '<strong>'._NEXTMATCHES.'</strong></a></center>';
                    }
                }
            } elseif ($type=='users') {
                $res_n3 = $db->sql_query('SELECT user_id, username, name from '.$user_prefix.'_users where (username like \'%'.$query.'%\' OR name like \'%'.$query.'%\' OR bio like \'%'.$query.'%\') order by username ASC limit '.$min.','.$offset);
                $nrows = $db->sql_numrows($res_n3);
                $x=0;
                if (!empty($query)) {
                    echo '<br /><hr noshade="noshade" size="1" /><center><strong>'._SEARCHRESULTS.'</strong></center><br /><br />';
                    echo '<table width="99%" cellspacing="0" cellpadding="0" border="0">';
                    if ($nrows>0) {
                        while($rown3 = $db->sql_fetchrow($res_n3)) {
                            $uid = intval($rown3['user_id']);
                            $uname = stripslashes($rown3['username']);
                            $name = stripslashes($rown3['name']);
                            $furl = 'modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$uname;
                            if (empty($name)) {
                                $name = _NONAME;
                            }
                            echo '<tr><td><img src="images/folders.gif" border="0" alt="" />&nbsp;<font class="option"><a href="'.$furl.'"><strong>'.$uname.'</strong></a></font><font class="content"> ('.$name.')';
                            if (is_admin($admin)) {
                                echo ' [ <a href="'.$admin_file.'.php?chng_uid='.$uname.'&amp;op=modifyUser">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=delUser&amp;chng_uid='.$uid.'">'._DELETE.'</a> ]';
                            }
                            echo '</font></td></tr>';
                            $x++;
                        }

                        echo '</table>';
                    } else {
                        echo '<tr><td><center><font class="option"><strong>'._NOMATCHES.'</strong></font></center><br /><br />';
                        echo '</td></tr></table>';
                    }

                    $prev=$min-$offset;
                    if ($prev>=0) {
                        print '<br /><br /><center><a href="modules.php?name='.$module_name.'&amp;author='.$author.'&amp;topic='.$t.'&amp;min='.$prev.'&amp;query='.$query.'&amp;type='.$type.'">';
                        print '<strong>'.$min.' '._PREVMATCHES.'</strong></a></center>';
                    }

                    $next=$min+$offset;
                    if ($x>=9) {
                        print '<br /><br /><center><a href="modules.php?name='.$module_name.'&amp;author='.$author.'&amp;topic='.$t.'&amp;min='.$max.'&amp;query='.$query.'&amp;type='.$type.'">';
                        print '<strong>'._NEXTMATCHES.'</strong></a></center>';
                    }
                }
            }
            CloseTable();
            $mod1 = $mod2 = $mod3 = '';
            if (isset($query) AND !empty($query)) {
                echo '<br />';
                if (is_active('Downloads')) {
                    $dcnt = $db->sql_numrows($db->sql_query('SELECT * from '.$prefix.'_downloads_downloads WHERE title LIKE \'%'.$query.'%\' OR description LIKE \'%'.$query.'%\''));
                    $mod1 = '<li> <a href="modules.php?name=Downloads&amp;d_op=search&amp;query='.$query.'">'._DOWNLOADS.'</a> ('.$dcnt.' '._SEARCHRESULTS.')</li>';
                }
                if (is_active('Web_Links')) {
                    $lcnt = $db->sql_numrows($db->sql_query('SELECT * from '.$prefix.'_links_links WHERE title LIKE \'%'.$query.'%\' OR description LIKE \'%'.$query.'%\''));
                    $mod2 = '<li> <a href="modules.php?name=Web_Links&amp;l_op=search&amp;query='.$query.'">'._WEBLINKS.'</a> ('.$lcnt.' '._SEARCHRESULTS.')</li>';
                }
                if (is_active('Encyclopedia')) {
                    $ecnt1 = $db->sql_query('SELECT eid from '.$prefix.'_encyclopedia WHERE active="1"');
                    $ecnt = 0;
                    while($row_e = $db->sql_fetchrow($ecnt1)) {
                        $eid = intval($row_e['eid']);
                        $ecnt2 = $db->sql_numrows($db->sql_query('select * from '.$prefix.'_encyclopedia WHERE title LIKE \'%'.$query.'%\' OR description LIKE \'%'.$query.'%\' AND eid=\''.$eid.'\''));
                        $ecnt3 = $db->sql_numrows($db->sql_query('select * from '.$prefix.'_encyclopedia_text WHERE title LIKE \'%'.$query.'%\' OR text LIKE \'%'.$query.'%\' AND eid=\''.$eid.'\''));
                        $ecnt = $ecnt+$ecnt2+$ecnt3;
                    }
                    $mod3 = '<li> <a href="modules.php?name=Encyclopedia&amp;file=search&amp;query='.$query.'">'._ENCYCLOPEDIA.'</a> ('.$ecnt.' '._SEARCHRESULTS.')</li>';
                }
                OpenTable();
                echo '<font class="title">'._FINDMORE.'<br /><br />'
                    ._DIDNOTFIND.'</font><br /><br />'
                    ._SEARCH.' "<strong>'.$query.'</strong>" '._ON.':<br /><br />'
                    .'<ul>'
                    .$mod1
                    .$mod2
                    .$mod3
                    .'<li> <a href="http://www.google.com/search?q='.$query.'" target="new">Google</a></li>'
                    .'<li> <a href="http://groups.google.com/groups?q='.$query.'" target="new">Google Groups</a></li>'
                    .'</ul>';
                CloseTable();
            }
            include_once('footer.php');
        break;
}

?>

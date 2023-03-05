<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*
*   file name           :   groupset.php
*   run from	          :   index.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*
***************************************************************************/

if ( !defined('MODULE_FILE') )
{
	die ("Access Denied");
}

// get group_id and forum_id.     
if ($grid < 1)
{
  echo "ERROR - GS1 - ".MA_GINSICERR."! <br>";
}

//** check forum_id here also
if ($fmid < 1)
{
  echo "ERROR - GS2 - ".MA_MAFNSICERR."! <br>";
}
$fnamqry = "SELECT `forum_name` FROM `".$prefix."_bbforums` WHERE `forum_id` = \"$fmid\"";
if ( !($fmresult = $db->sql_query($fnamqry)) )
{
  $msg .= "ERROR - GS3 - ".MA_UATOFTERR."! <br>";
}
else
{
  if ( !($fmidr = $db->sql_fetchrow($fmresult)) )
  {
    $msg .= "ERROR  - GS4 - ".MA_UTGDFFT."! <br>";
  }

  $fmname = $fmidr['forum_name'];
  if ($fmname=="")
  {
    $msg .= "WARNING - ".MA_DNFFFMARWARN."! <br><br>";
  }
}
$ptime = time();

//** create topic in bbtopics first - add last 3 fields for nuke
$bbtopqry = "INSERT INTO ".$prefix."_bbtopics (`forum_id`, `topic_title`, `topic_poster`, `topic_time`, `topic_status`, `topic_vote`, `topic_type`) VALUES ($fmid, \"New ".$mrow['formtitle']." #".$lastapp." from ".$frmusr."\", $nu, $ptime, 0, 0, 0)";
$bbtopresult = $db->sql_query($bbtopqry);
if(!$bbtopresult)
{
  echo "ERROR - GS5 - ".MA_UTCTIFERR."! <br>";
  exit();
}

$topid = $db->sql_nextid();
$db->sql_freeresult($bbtopresult);

//** create post in bbposts - add last 2 fields for nuke
$bbpoqry = "INSERT INTO ".$prefix."_bbposts (`topic_id`, `forum_id`, `poster_id`, `post_time`, `poster_ip`, `post_username`, `enable_bbcode`, `enable_html`, `enable_smilies`, `enable_sig`) VALUES ($topid, $fmid, $nu, $ptime, '$pip', '$frmusr', 0, 0, 0, 0)";
$bbporesult = $db->sql_query($bbpoqry);
if(!$bbporesult)
{
  echo "ERROR - GS6 - ".MA_UTPTFERR."! <br>";
  exit();
}

$poid = $db->sql_nextid();
$db->sql_freeresult($bbporesult);

//** create post text in bbposts_text
$bbpotqry = "INSERT INTO ".$prefix."_bbposts_text (`post_id`, `bbcode_uid`, `post_subject`, `post_text`) VALUES ($poid, 0, \"New ".$mrow['formtitle']." #".$lastapp." from ".$frmusr ."\",\"".$post."\")";
$bbpotresult = $db->sql_query($bbpotqry);
if(!$bbpotresult)
{
  echo "ERROR - GS7 - ".MA_UTPTFERR."! <br>";
  exit();
}
$db->sql_freeresult($bbpotresult);

// set post id's in the topic
$bbtopqry = "UPDATE ".$prefix."_bbtopics SET  topic_last_post_id='$poid',  topic_first_post_id='$poid' WHERE  topic_id='$topid'";
$bbtopresult = $db->sql_query($bbtopqry);
if(!$bbtopresult)
{
  echo "ERROR - GS8 - ".MA_UTPTFERR."! <br>";
  exit();
}

$db->sql_freeresult($bbtopresult);
//** update bbsearch
define('IN_PHPBB', 1);
define('SEARCH_WORD_TABLE', $prefix.'_bbsearch_wordlist');
define('SEARCH_MATCH_TABLE', $prefix.'_bbsearch_wordmatch');
define('POSTS_TABLE', $prefix.'_bbposts');
function message_die(){};
include_once("includes/functions_search.php");
add_search_words("single", $poid, $post, "New ".$mrow['formtitle']." #".$lastapp." from ".$frmusr);

//** update forum statistics
$bbforqry = "UPDATE ".$prefix."_bbforums SET forum_posts = forum_posts + 1, forum_topics = forum_topics + 1, forum_last_post_id = $poid WHERE forum_id = '$fmid'";
$bbforresult = $db->sql_query($bbforqry);
if(!$bbforresult)
{
  echo "ERROR - GS9 - ".MA_UTPTFERR."! <br>";
  exit();
}

$db->sql_freeresult($bbforresult);

//** update user post count

if (is_user($user)) 
{	
  $bbusrqry = "UPDATE ".$user_prefix."_users SET user_posts = user_posts + 1 WHERE user_id = '$cookie[0]'";
  $bbusrresult = $db->sql_query($bbusrqry);
  if(!$bbusrresult)  
  {
    echo "ERROR - GS10 - ".MA_UTPTFERR."! <br>";
    exit();
  }
  $db->sql_freeresult($bbusrresult);
}
if ($mrow['mailgroup'])
{		
//** create records in bbtopics_watch
  $usrsql = "SELECT * FROM ".$prefix."_bbuser_group AS t1, ".$user_prefix."_users AS t2 WHERE t1.group_id = '$grid' AND t1.user_id = t2.user_id";
  if( !($usrresult = $db->sql_query($usrsql)) )
  {
    echo "ERROR - GS11 - ".MA_UTPTFERR."! <br>";
    exit();
  }
  
  // ****  set topic to watch for all users found.	
  while ($usridr = $db->sql_fetchrow($usrresult))
  {
    $grusr = $usridr['user_id'];
    $tomail = $usridr['user_email'];
    if ($mrow['topicwatch'])
    {
      $bbtopwqry = "INSERT INTO ".$prefix."_bbtopics_watch (`topic_id`, `user_id`, `notify_status`) VALUES ($topid, $grusr, 0)";
      $bbtopwresult = $db->sql_query($bbtopwqry);
    
      if(!$bbtopwresult)
      {
        echo "ERROR - GS12 - ".MA_UTPTFERR."! <br>";
        exit();
      }
    }
    $sql = "SELECT username, user_email, user_password, user_level FROM ".$user_prefix."_users WHERE username='$username'";
    $result = $db->sql_query($sql);
    
    if($db->sql_numrows($result) == 0)
    {
      die("ERROR - GS13 - ".MA_UTFYURERROR."! <br>");
    }
  
    $row = $db->sql_fetchrow($result);
    $user_email = $row[user_email];
    $admin_email = $mrow['admaddr'];
    $sject = MA_NEW." ".$mrow['formtitle']." ".MA_FOR." ".$frmusr."\n\r";
    $from  = "From: $adminmail\r\n";
    $from .= "Reply-To: $adminmail\r\n";
    $from .= "Return-Path: $adminmail\r\n";
    
    if ($htmlmail)
    {
      $encode = 1;
      $from .= "Content-Type: text/html; charset=iso-8859-1\r\n";
      $gmail = str_replace("\n\r", "<br>", $gmail);
      $gmail = str_replace("\r\n", "<br>", $gmail);
      $gmail = str_replace("\n", "<br>", $gmail);
      $gmail = str_replace("&middot;", "*", $gmail);
    }
    else
    {
      $encode = 0;
      $from .= "Content-Type: text/plain; charset=iso-8859-1\r\n";
      $gmail = str_replace("<br>", "\n\r", $gmail);
    }

    if ($htmlmail)
    {
      $gmail = "".MA_INTHE." ".$fmname." ".MA_FYWFANTXT." ".$mrow['formtitle']." ".MA_FORTXT." ".$frmusr."\n\r";
      $gmail .= MA_RVWAT.":<BR><B><I><A HREF=\"".$nukeurl."/modules.php?name=Forums&file=viewtopic&t=".$topid."\">".MA_NAPTXT."</A></I></B><BR>";
    }
    else
    {
      $gmail = "".MA_INTHE." ".$fmname." ".MA_FYWFANTXT." ".$mrow['formtitle']." ".MA_FORTXT." ".$frmusr."\n\r";
      $gmail .= MA_RIATXT.":\n\r";
      $gmail .= $nukeurl."/modules.php?name=Forums&file=viewtopic&t=".$topid."\n\r";
    }


    if (defined('PNM_IS_ACTIVE'))
    {
/*
      if ($htmlmail)
      {
        phpnukemail($admin_email, $sject, $gmail, $from, $from, $encode=1);
      }
      else
      {
*/
        phpnukemail($tomail, $sject, $gmail, $adminmail, $adminmail, $encode);
//      }
    }
    else
    {
      mail($tomail, $sject, $gmail, $from);
    }

  }
}
$db->sql_freeresult($bbtopwresult);

?>

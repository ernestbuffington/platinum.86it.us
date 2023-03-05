<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 17 July, 2006
*   copyright            : (C) 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: M_A_a_status     : v2.1.4 Tim Leitz
*
*   file name           :   block-M_A_2_1_2_appstatus.php
*   run from		        :   site
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*
***************************************************************************/
if(!defined('NUKE_FILE') && !defined('BLOCK_FILE')) { die(MA_YCATFDERROR."..."); }
get_lang(Member_Application);
global $user, $sitename, $prefix, $user_prefix, $db;
$private = True;
$usename = False;
$usemarquee = 1;
$scrolldirection = "Up";
$content = "";
$cookie = cookiedecode($user);
if ((is_user($user)) && $private)
{
  	$guid = $cookie[0];
   	$nu = intval($guid);   //get int val of nuke user id
    $sql2 = "SELECT * FROM `".$prefix."_MA_mappresp` WHERE userno=".$nu." ORDER BY appnum DESC";
}
elseif ($private == False)
{    
  $sql2 = "SELECT * FROM `".$prefix."_MA_mappresp` ORDER BY appnum DESC";
}
else
{ 
  $content .= "No apps to show";
}
if( !($result = $db->sql_query($sql2)) )
{
  echo "ERROR - B1 - ".MA_UTORTERROR."! <br>";
  exit();
}
$content .= "<hr>\n";
$content .= "<Marquee Behavior=\"Scroll\" Direction=\"$scrolldirection\" Height=\"200\" ScrollAmount=\"2\" ScrollDelay=\"30\" onMouseOver=\"this.stop()\" onMouseOut=\"this.start()\"><br>";
$row = $db->sql_fetchrow($result);
$ctr = 0;
if ($row)
{
  while (($row) && ($ctr < 20))
  {
    $capp = $row['appnum'];
    $fnum = $row['formno'];
    $sql3 = "SELECT * FROM `".$prefix."_MA_mapcfg` WHERE formno = $fnum";
    if( !($result3 = $db->sql_query($sql3)) )
    {
      echo "ERROR - B2 - ".MA_UATOCTERROR."! <br>";
      exit();
    }
    $row3 = $db->sql_fetchrow($result3);
    $content .= "<strong>";
    $content .= $row3['formtitle']."<BR>";
    $content .= "#".$row['appnum'];
    $unum = $row['userno'];
    if (($usename) && ($row['userno'] > 1))
    {
      $sql4 = "SELECT * FROM `".$user_prefix."_users` WHERE user_id = $unum";
      if( !($result4 = $db->sql_query($sql4)) )
      {
        echo "ERROR - B3 - ".MA_UTFYURERROR."! <br>";
        exit();
      }
      $row4 = $db->sql_fetchrow($result4);
      $content .= "<BR>".$row4['username'];
    }
    $content .= "<br>";
    switch ($row['appstatus'])
    {
      case 0 : $content .= MA_RECIEVED;
                break;
      case 1 : $content .= MA_DECLINED;
                break;
      case 2 : $content .= MA_ACCEPTED;
                break;
    }
    $content .= "<br />\n";
    $content .= "<br />\n";
    $ctr++;
    while (($row) && ($row['appnum'] == $capp))
    {
      $row = $db->sql_fetchrow($result);
    }
  }
}
$content .= "</Marquee><br>";
?>

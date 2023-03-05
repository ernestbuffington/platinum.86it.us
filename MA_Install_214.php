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
*   file name           :   MA_Install_214.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*
***************************************************************************/

require_once("mainfile.php");
require_once("config.php");

global $msg;

$msg = "";

function upg_0_02_x()
{
  global $msg, $db, $prefix, $dbname;

  $error = 0;
  $filenm = dirname(__FILE__);
  $filenm .='/modules/Member_Application/admin/update.log';
  $handle = fopen($filenm, "wb");
  if (!( $handle ))
  {
    die( "fopen failed for $filenm" ) ;
  }
  rewind($handle);
$row = 1;
$FH_update = fopen("update.idat", "r");
while (($data = fgetcsv($FH_update, 1000, "+")) !== FALSE)
{
   $num = count($data);
   $row++;
  $data[4] = str_replace("TBLPREFIX", $prefix, $data[4]);
  $data[6] = str_replace("TBLPREFIX", $prefix, $data[6]);
  $sql = $data[3]." ".$data[4]." ".$data[5]." ".$data[6];
  if ($data[7] != "-") $sql .= " ".$data[7];
  if ($data[2] == 'y')
  {
     if ($data[1] == 't')
     {
        $tbltest = $db->sql_query("SELECT 1 FROM ".$data[4]." LIMIT 0");
        $result = TRUE;
        if ($data[5]=="RENAME")
        {
           if ($tbltest) $result = $db->sql_query($sql);
        }
        else
        {
            if (! $tbltest) $result = $db->sql_query($sql);
        }
     }
     if ($data[1] == 'c')
     {
         $fresult = $db->sql_query("SELECT * FROM ".$data[4]."");
         $fields = mysql_num_fields($fresult);
         for ($fldct=0; $fldct < $fields; $fldct++)
         {
                $fldname  = mysql_field_name($fresult, $fldct);
                $fldname = "`".$fldname."`";
                if (strcmp($fldname, $data[6]) == 0)
                {
                   $result = True;
                   break;
                }
                else
                {
                    $result = False;
                }
         }
        if ($data[5]=="CHANGE")
        {
           if ($result) $result = $db->sql_query($sql);
        }
        else
        {
            if (! $result) $result = $db->sql_query($sql);
        }
     }
  }
  else
  {
      $result = $db->sql_query($sql);
  }
  if (!$result)
  {
    $msg = "ERROR(" . mysql_errno() . ") " . mysql_error()." \n\r ";
  }
  else
  {
    $msg ="OK\n\r";
  }
  $sqn = $data[0]." *** SQL ".$sql."\n\r Result ".$msg." \n\r ";
  fwrite($handle, $sqn);
}
fclose($FH_update);


// ***** check for ip question already here

  $sql = "SELECT * FROM `".$prefix."_MA_mapp` WHERE fldname='User IP'";
  $result = $db->sql_query($sql);
  if (!$result)
  {
    $msg = "<BR>ERROR(" . mysql_errno() . ") " . mysql_error()." \n\r ";
  }
  else
  {
    $msg ="OK\n\r";
  }
  fwrite($handle, "SQL ".$sql."\n\r Result ".$msg." \n\r ");

  if (!$result)
  {
    $sql = "INSERT INTO `".$prefix."_MA_mapp` VALUES (0, 0, 'User IP', '0','0','0', 't', 0, 0, '')";
    $result = $db->sql_query($sql);
  if (!$result)
  {
    $msg = "<BR>ERROR(" . mysql_errno() . ") " . mysql_error()." \n\r ";
  }
  else
  {
    $msg ="OK\n\r";
  }
  fwrite($handle, "SQL ".$sql."\n\r Result ".$msg." \n\r ");

    if (!$result)
    {
      $msg .= "<BR>ERROR 15 - Unable to insert IP data into question table! <br>".$sql.".<BR>Error: (" . mysql_errno() . ") " . mysql_error()."<BR><BR>";
      $error = 1;
    }
  }
  // Make darn sure the field number is set to 0 for this record.
  $sql = "UPDATE  `".$prefix."_MA_mapp` SET `fldnum` = 0 WHERE `fldname` = 'User IP' LIMIT 1 ";
  $result = $db->sql_query($sql);
  if (!$result)
  {
    $msg = "<BR>ERROR(" . mysql_errno() . ") " . mysql_error()." \n\r ";
  }
  else
  {
    $msg ="OK\n\r";
  }
  fwrite($handle, "SQL ".$sql."\n\r Result ".$msg." \n\r ");

  if (!$result)
  {
    $msg .= "<BR>ERROR 16 - Unable to verify IP data in question table! <br>".$sql.".<BR>Error: (" . mysql_errno() . ") " . mysql_error()."<BR><BR>";
    $error = 2;
  }

fflush ($handle);
fclose($handle);
echo "<center><H2>Update Complete<BR></H><H4>If you have any problems with the operation of this new version, post in the support forum at www.dbfdesigns.net and paste in the contents of the file modules/Member_Application/admin/update.log.  It will help us greatly in determining the cause of any errors or malfunctions.</h></center>";
}


function install_1_0_1()
{
  global $msg, $db, $prefix;

  $error = 0;
  $filenm = dirname(__FILE__);
  $filenm .='/modules/Member_Application/admin/update.log';
  $handle = fopen($filenm, "wb");
  if (!( $handle ))
  {
    die( "fopen failed for $filenm" ) ;
  }
  rewind($handle);

  // get group here
  //-- Table structure for table MA_mapcfg

  $sql = "CREATE TABLE `".$prefix."_MA_mapcfg` ("
    ."`keyfld` int(11) NOT NULL auto_increment,"
    ."`apptxt` longtext NOT NULL,`admaddr` text NOT NULL,"
    ."`emdetail` tinyint(1) NOT NULL default '0',"
    ."`fpdetail` tinyint(1) NOT NULL default '0',"
    ."`group_id` mediumint(8) NOT NULL default '0',"
    ."`forum_id` smallint(5) NOT NULL default '0',"
    ."`tytxt` longtext NOT NULL,"
    ."`noapptxt` longtext NOT NULL,"
    ."`appson` tinyint(1) NOT NULL default '1',"
    ."`current` tinyint(1) NOT NULL default '0',"
    ."`formtitle` varchar(64) NOT NULL default '',"
    ."`appslimit` tinyint(1) NOT NULL default '0',"
    ."`appslimitno` int(11) NOT NULL default '0',"
    ."`appsfull` tinyint(1) NOT NULL default '0',"
    ."`group_add` mediumint(8) NOT NULL default '0',"
    ."`block_multi_apps` tinyint(1) NOT NULL default '1',"
    ."`email_admin` tinyint(1) NOT NULL default '1',"
    ."`mailgroup` tinyint(1) NOT NULL default '0',"
    ."`topicwatch` tinyint(1) NOT NULL default '0',"
    ."`emuser` tinyint(1) NOT NULL default '0',"
    ."`formno` int(11) NOT NULL default '0',"
    ."`annon` tinyint(1) NOT NULL default '0',"
    ."`VertAlign` tinyint(1) NOT NULL default '0',"
    ."`auto_group` tinyint(1) NOT NULL default '0',"
    ."`approvtxt` longtext NOT NULL,"
    ."`denytxt` longtext NOT NULL,"
    ."`formlist` tinyint(1) NOT NULL default '0',"
    ."`compat` BOOL NOT NULL default '0',"
    ."`emhtml` BOOL NOT NULL default '0',"
    ."UNIQUE KEY `keyfld` (`keyfld`)) AUTO_INCREMENT=0";
  $result = $db->sql_query($sql);
  if (!$result)
  {
    $msg = "<BR>ERROR(" . mysql_errno() . ") " . mysql_error()." \n\r ";
  }
  else
  {
    $msg ="OK\n\r";
  }
  fwrite($handle, "SQL ".$sql."\n\r Result ".$msg." \n\r ");

  if (!$result)
  {
    $msg .= "<BR>ERROR 22 - Unable to create config table! <br>".$sql.".<BR>Error: (" . mysql_errno() . ") " . mysql_error()."<BR><BR>";
    $error = 2;
  }
  //-- Table structure for table MA_mapp
  $sql = "CREATE TABLE `".$prefix."_MA_mapp` (`fldnum` int(10) unsigned NOT NULL auto_increment,`fldord` int(11) NOT NULL default '0',`fldname` text NOT NULL,`requrd` char(1) NOT NULL default '',`inuse` char(1) NOT NULL default '',`format` char(1) NOT NULL default '',`parent` smallint(6) NOT NULL default '0',`isdel` tinyint(1) NOT NULL default '0',`formno` int(11) NOT NULL default '0',`rgextxt` text,UNIQUE KEY `fldnum` (`fldnum`)) AUTO_INCREMENT=0 ";
  $result = $db->sql_query($sql);
  if (!$result)
  {
    $msg = "<BR>ERROR(" . mysql_errno() . ") " . mysql_error()." \n\r ";
  }
  else
  {
    $msg ="OK\n\r";
  }
  fwrite($handle, "SQL ".$sql."\n\r Result ".$msg." \n\r ");

  if (!$result)
  {
    $msg .= "ERROR 24 - Unable to create question table! <br>".$sql.".<BR>Error: (" . mysql_errno() . ") " . mysql_error()."<BR><BR>";
    $error = 2;
  }
  else
  {
    //-- Dumping data for table MA_mapp
    $sql = "INSERT INTO `".$prefix."_MA_mapp` VALUES (0, 0, 'User IP', '0', '0', 't', 0, 0, 0, NULL)";
  $result = $db->sql_query($sql);
  if (!$result)
  {
    $msg = "<BR>ERROR(" . mysql_errno() . ") " . mysql_error()." \n\r ";
  }
  else
  {
    $msg ="OK\n\r";
  }
  fwrite($handle, "SQL ".$sql."\n\r Result ".$msg." \n\r ");

  if (!$result)
    {
      $msg .= "ERROR 25 - Unable to insert IP data into question table! <br>".$sql.".<BR>Error: (" . mysql_errno() . ") " . mysql_error()."<BR><BR>";
      $error = 2;
    }

    // Make darn sure the field number is set to 0 for this record.
    $sql = "UPDATE  `".$prefix."_MA_mapp` SET `fldnum` = 0 WHERE `fldname` = 'User IP' LIMIT 1 ";
  $result = $db->sql_query($sql);
  if (!$result)
  {
    $msg = "<BR>ERROR(" . mysql_errno() . ") " . mysql_error()." \n\r ";
  }
  else
  {
    $msg ="OK\n\r";
  }
  fwrite($handle, "SQL ".$sql."\n\r Result ".$msg." \n\r ");

    if (!$result)
    {
      $msg .= "<BR>ERROR 26 - Unable to verify IP data in question table! <br>".$sql.".<BR>Error: (" . mysql_errno() . ") " . mysql_error()."<BR><BR>";
      $error = 2;
    }
  }

  //-- Table structure for table MA_mappresp
  $sql = "CREATE TABLE `".$prefix."_MA_mappresp` (`recno` bigint(11) NOT NULL auto_increment,  `appnum` bigint(20) NOT NULL default '0', `userno` bigint(20) NOT NULL default '0', `qno` bigint(20) NOT NULL default '0', `response` longtext NOT NULL,  `adate` text NOT NULL, `formno` int(11) NOT NULL default '0', `appstatus` tinyint(4) NOT NULL default '0', PRIMARY KEY  (`recno`)) ENGINE=MyISAM AUTO_INCREMENT=0 ";
  $result = $db->sql_query($sql);
  if (!$result)
  {
    $msg = "<BR>ERROR(" . mysql_errno() . ") " . mysql_error()." \n\r ";
  }
  else
  {
    $msg ="OK\n\r";
  }
  fwrite($handle, "SQL ".$sql."\n\r Result ".$msg." \n\r ");

  if (!$result)
  {
    $msg .= "<BR>ERROR 28 - Unable to create response table! <br>".$sql.".<BR>Error: (" . mysql_errno() . ") " . mysql_error()."<BR><BR>";
    $error = 2;
  }
fflush ($handle);
fclose($handle);

  switch ($error)
  {
    case '0':
      $msg = "Congratulations!  Everything appears to have completed successfully in the install. "
            . "Please enjoy using the Member Application module.  Should you need support, or have any questions, "
            . "please visit our support forums at <a href=\"http://www.dbfdesigns.net\">DBF Designs</a>";

      break;

    case '2':
      $msg .= "The install did not complete successfully.  There was an error in adding the Member Application tables to the database."
            . "If you are successful in correcting the error, you will need to rerun the installer script. "
  	    . "Should you need support, or have any questions, please visit our support forums at <a href=\"http://www.dbfdesigns.net\">DBF Designs</a>";

      break;
  }

  echo $msg;
}

// Main code

echo "<table width=\"100%\">";
echo "  <tr>";
echo "    <td width=\"100%\" align=\"center\">";
echo "      <img src=\"modules/Member_Application/images/DBFDLOGO1.png\" name=\"graphics2\" width=\"164\" height=\"100\" border=\"0\">";
echo "      <br><br>";
echo "    </td>";
echo "  </tr>";
echo "</table>";
if(!defined('NUKE_MODULES_DIR')) {
  define('NUKE_MODULES_DIR', "modules/" );
}
$module_name = "Member_Application";

// find out what kind of install to do

switch ($op)
{
  default:
    echo "<table width=\"100%\" align=\center\" border=\"0\">";
    echo "  <tr>";
    echo "    <td align=\"center\" width=\"100%\">";
    echo "      <h2>Please Select the Install/Upgrade Operation to Perform</h2>";
    echo "    </td>";
    echo "  </tr>";
    echo "  <tr>";
    echo "    <td align=\"center\" width=\"100%\">";
    echo "      <form METHOD=POST action='MA_Install_214.php'>";
    echo "      <SELECT NAME=\"op\">";
    echo "      <OPTION VALUE=\"new_install\">Clean Install of Member Application V 2.1.4</option>";
    echo "      <OPTION VALUE=\"upgrade_0_02_x\">Upgrade Member Application</option>";
    echo "    </td>";
    echo "  </tr>";
    echo "  <tr>";
    echo "    <td align=\"center\" width=\"100%\">";
    echo "      <INPUT TYPE=SUBMIT VALUE=\"Install / Upgrade\">";
    echo "      </form>";
    echo "    </td>";
    echo "  </tr>";
    echo "</table>";
    break;

    case "upgrade_0_02_x" :
      upg_0_02_x();
    	break;
    	
  case "new_install":
    // do the fresh install
    install_1_0_1();
    break;
    	
}

echo "<br><br>";
include_once(NUKE_MODULES_DIR . $module_name . "/version.php");

echo "<table align=\"center\" width=\"100%\">";
echo "  <tr>";
echo "    <td align=\"center\">";
include_once(NUKE_MODULES_DIR . $module_name . "/copyright.php");
echo "    </td>";
echo "  </tr>";
echo "</table>";

?>

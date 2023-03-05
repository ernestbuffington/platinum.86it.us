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
*   file name           :   index.php
*   run from		        :   user
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*
***************************************************************************/
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

require_once("mainfile.php");

include_once("header.php");

$module_name = basename(dirname(__FILE__));

if ( !defined('NUKE_MODULES_DIR') )
{
    define("NUKE_MODULES_DIR","modules/");
}

global $user, $user_prefix, $prefix, $sitename, $adminmail;
get_lang($module_name);
echo "<script type=\"text/javascript\" >"
."function checkappy(i)"
."{"
."  mct = i;"
."  zz = 0;"
."  while (zz < mct)"
."  {"
."    if (((document.getElementById(\"data\"+zz).value == \"\") || ((document.getElementById(\"qfmt\"+zz).value == \"c\") && (! document.getElementById(\"data\"+zz).checked))) && (document.getElementById(\"rqd\"+zz).value >0))"
."    {"
."          alert( \"".MA_YDNPARRERR."\" );"
."          document.getElementById(\"data\"+zz).focus();"
."          return false ;"
."    }"
."    else"
."    {"
."       if (document.getElementById(\"qfmt\"+zz).value == \"v\")"
."       {"
."          if ((! document.getElementById(\"data\"+zz).value == \"\") || (document.getElementById(\"rqd\"+zz).value >0))"
."          {"
."            rgtest = document.getElementById(\"data\"+zz).value;"
."            rgcode = document.getElementById(\"regexdef\"+zz).value;"
."            if (! rgtest.match(rgcode))"
."            {"
."              alert( \"".MA_YDNEAVRERR."\");"
."              document.getElementById(\"data\"+zz).focus();"
."              return false ;"
."            }"
."          }"
."       }"
."    }"
."    if ((document.getElementById(\"qfmt\"+zz).value == \"r\") && (document.getElementById(\"rqd\"+zz).value >0))"
."    {"
."      radio_choice = false;"
."      for (counter = 0; counter < document.appy.elements[\"data\"+zz].length; counter++)"
."      {"
."        if (document.appy.elements[\"data\"+zz][counter].checked) radio_choice = true;"
."      }"
."      if (! radio_choice)"
."      {"
."          alert(\"".MA_YDNSARRBERR."\");"
."          document.getElementById(\"data\"+zz).focus();"
."          return false ;"
."      }"
."    }"
."    zz++;"
."  }"
."  document.appy.submit();"
."  return true ;"
." }"
."function updFormNo()"
."{"
."  adminurl = \"modules\";"
."  formnoval = document.appy.formno.value;"
."  if (formnoval<0)"
."  {"
."    formurl = adminurl + \".php?name=Member_Application&appno=-1\";"
."  }"
."  else"
."  {"
."    formurl = adminurl + \".php?name=Member_Application&appno=\" + formnoval;"
."  }"
."  window.location = formurl;"
."}"
."</script>\n";

opentable();
if ( (! ($appnock = isset($_GET['appno']) ? trim($_GET['appno']) : '')) && (! ($appnock2 = isset($_POST['appno']) ? trim($_POST['appno']) : '')))
{
  $appno = -1;
  $msql ="SELECT * FROM `".$prefix."_MA_mapcfg` ORDER BY formno";
  if( !($mresult = $db->sql_query($msql)) )
  {
    echo "<H3>ERROR - 1 - ".MA_UATOCTERROR."</H3><br>";
    exit();
  }

  if ( !($mrow = $db->sql_fetchrow($mresult)) )
  {
    echo "<center><strong>".MA_NAFHBCYERROR."</strong></center>";
    $appno = -2;
  }
  else
  {
    $appno = $mrow['formno'];
  }
} 
else
{
  if (! ($appnock = isset($_GET['appno']) ? trim($_GET['appno']) : ''))
  {
    $appnock = isset($_POST['appno']) ? trim($_POST['appno']) : '';
  }
  $appno = $appnock;
  $msql ="SELECT * FROM `".$prefix."_MA_mapcfg` WHERE formno = $appno";
  if( !($mresult = $db->sql_query($msql)) )
  {
    echo "<H3>ERROR - 2 - ".MA_UATOCTERROR."</H3><br>";
    exit();
  }

  if ( !($mrow = $db->sql_fetchrow($mresult)) )
  {
    echo "<center><strong>".MA_UANERROR."</strong></center>";
    $appno = -2;
  }
}
cookiedecode($user);
if ((is_user($user)) || ($mrow['annon']))
{
  echo "<div align=\"left\"><br>";  
  if ($appno == -1)
  {
    $napsql = "SELECT * FROM `".$prefix."_MA_mapcfg` ORDER BY formno";
    
    if( !($napresult = $db->sql_query($napsql)) )
    {
      echo "<H3>ERROR - 3 - ".MA_UATOCTERROR."</H3><br>";
    }
    while(($appno == -1) && ($naprow = $db->sql_fetchrow($napresult)))
    {
//    $naprow = $db->sql_fetchrow($napresult);
      $appslimit = $naprow['appslimit'];
      $appsfull = $naprow['appsfull'];
      if ($appslimit == 0 OR $appsfull == 0)
      {
        $appno = $naprow['formno'];
      }
    } 
    if ($appno == -1)
    {
// ******* edit here ******  	  
      echo MA_NAFHBCYERROR."<BR><BR>";
    }
  }
  $sql = "SELECT * FROM `".$prefix."_MA_mapp` WHERE inuse <> 0 AND isdel < 1 AND fldnum > 0 AND formno = $appno ORDER BY fldord";

  if( !($result = $db->sql_query($sql)) )
  {
    echo "<H3>ERROR - 4 - ".MA_UTOQTERROR."</H3><br>";
    exit();
  }

    // get operation desired
  echo "<table align=\"left\" width=\"100%\" cellpadding = \"5%\" hspace=\"10\" vspace=\"10\" >";
  $grid = $mrow['group_id'];
  $fmid = $mrow['forum_id'];
  $appslimit = $mrow['appslimit'];
  $appslimitno = $mrow['appslimitno'];
  $appsfull = $mrow['appsfull'];
  $vertalign = $mrow['VertAlign'];
  $ecompatible = $mrow['compat'];
  $htmlmail = $mrow['emhtml'];
  if ($appslimit == 0 OR $appsfull == 0)
  {
    $op = isset($_POST['op']) ? trim($_POST['op']) : '';
    switch ($op)
    {
      default :
        $formno = $appno;

        echo "<form NAME=\"appy\" METHOD=POST action=\"modules.php?name=$module_name\">\n";
        if ($mrow['formlist'])
        {
          $sqlforms = "SELECT * FROM `".$prefix."_MA_mapcfg`";
          if ( ($resultforms = $db->sql_query($sqlforms))<0 )
          {
            echo "ERROR - 5 - ".MA_UATOCTERROR."! <br>";
            CloseTable();
            include_once("footer.php");
            exit();
          }

          echo "<tr>  <td align=\"center\" colspan=\"3\">";
          echo "<center>Available Applications<br>";
          echo "    <SELECT ID=\"formno\" NAME=\"formno\" onchange='updFormNo();'>";
          $rowform = $db->sql_fetchrow($resultforms);
          do
          {
          if ($rowform['formno']==$formno)
        	  {
        	    echo "  <OPTION selected VALUE=\"".$rowform['formno']."\">".$rowform['formtitle'];
        	  }
        	  else
        	  {
        	    echo "  <OPTION VALUE=\"".$rowform['formno']."\">".$rowform['formtitle'];
        	  }
          } while ($rowform = $db->sql_fetchrow($resultforms));
          echo "    </SELECT>";
          echo "</center>";
          echo "</td></tr>";
        }

        echo "<tr><td align=\"center\" colspan=\"3\">"; 
        echo $mrow['apptxt'];   // Out put terms file
        echo "<br><br><br>";
        echo "</td>";
        break;
//START CASE APPLY
      case "apply" :
        $cookie = cookiedecode($user);
      	if (is_user($user)) 
      	{
        	$guid = $cookie[0];
        	$nu = intval($guid);   //get int val of nuke user id
      	}
      	else
        {
          $nu = 1;
      	}
        $noerr = true;
        $i = 0;
        $qcnt = isset($_POST[i]) ? trim($_POST[i]) : '';    	
        $rr = "rqd".$i;
        $rv = "recno".$i;
        $dv = "data".$i;
        $qfrmt = "qfmt".$i;
        $rdef = "regexdef".$i;
        $sql2 = "SELECT * FROM `".$prefix."_MA_mappresp` WHERE formno = $appno";

        if( !($result = $db->sql_query($sql2)) )
        {
          echo "<H3>ERROR - 6 - ".MA_UTORTERROR."</H3><br>";
          exit();
        }

        while (($i<$qcnt) && ($noerr))
        {
//  need a format here for field error checking 
      	
          $qfmt = isset($_POST[$qfrmt]) ? trim($_POST[$qfrmt]) : '';    	
          $rrqrd = isset($_POST[$rr]) ? trim($_POST[$rr]) : '';
          $rnum = isset($_POST[$rv]) ? trim($_POST[$rv]) : '';
          $data = isset($_POST[$dv]) ? trim($_POST[$dv]) : '';
          $data = strip_tags($data);
          $rgex = isset($_POST[$rdef]) ? trim($_POST[$rdef]) : '';
          $rgex = stripslashes($rgex);
          if (($data == '') && ($qfmt == "c"))$data = 'No';
          if (($data == "on") && ($qfmt == "c")) $data = "Yes";
          if ($rrqrd == 1)
          {
            if (($qfmt == "c") && (strlen($data) < 3))
            {
              $noerr = false;
              echo "<H3>".MA_RCBNMERROR."</H3><br>";
              echo "<input type='hidden' name='op' value='error'>\n";
              echo "</form>";
            }
       
            if (strlen($data) < 1)
            {
              $noerr = false;
              echo "<H3>".MA_RFIEERROR."</H3><br>";
              echo "<input type='hidden' name='op' value='error'>\n";
              echo "</form>";
            }
          }         
          
     		  if ($qfmt == "v")
     		  {
  		      $rgex = "/".$rgex."/";
  		      if (($rrqrd == 1) || (strlen($data)>0))
  		      {
      		  	if (!(preg_match($rgex, $data)))
      		  	{
      		  	  $noerr = false;
                echo "<H3>".MA_TAWIFERROR." -> ".$data."</H3><br>";
                echo "<input type='hidden' name='op' value='error'>\n";
                echo "</form>";
              }
            }
    		  }
          $i++;
          $rv = "recno".$i;
          $dv = "data".$i;
          $rr = "rqd".$i;
          $qfrmt = "qfmt".$i;
          $rdef ="regexdef".$i;
        }

        if(!$noerr)
        {
          echo "<br><br><H3>".MA_PGBAPARIERROR."</h3><br><br>";
          echo "<tr><td align=\"CENTER\" COLSPAN=\"3\">";
          include_once("copyright.php");
          echo "</table>";
          echo "</div>";
     
          closetable();
	  	
          include_once("footer.php");
          exit();
        }
        else
        {
          // add to database
          if (is_user($user))
          {
            cookiedecode($user);
            $username = $cookie[1];
          }
	         else
	         {
	            $username = "Anonymous";
	         }
          $frmusr = $username;
          $message = MA_YHANMSG." ".$mrow['formtitle']." \n\r"
                    .MA_FRMUSRTXT." ".$frmusr."\n\r\n\r";
          $post = MA_YHANMSG." ".$mrow['formtitle']." \n\r"
                    .MA_FRMUSRTXT." ".$frmusr."\n\r\n\r";
          $ct = 0;
          $sqlla = "SELECT MAX(appnum) AS appnum FROM `".$prefix."_MA_mappresp` ";
	     
          if ( !($resultla = $db->sql_query($sqlla)) )
          {
            echo "<H3>ERROR - 7 - ".MA_UTGLANFTERROR."</H3><br>";
            exit();
          }
	
          if ( !($larow = $db->sql_fetchrow($resultla)) )
          {
            echo "<H3>ERROR - 8 - ".MA_UTLLAERROR."</H3><br>";
            exit();
          }
   
          $lastapp = $larow['appnum'];
          $lastapp++;

          while ($ct < $i)
          {
            $qfrmt = "qfmt".$ct;
            $rr = "rqd".$ct;
            $rv = "recno".$ct;
            $dv = "data".$ct;
            $qfmt = isset($_POST[$qfrmt]) ? trim($_POST[$qfrmt]) : '';    	
            $rnum = isset($_POST[$rv]) ? trim($_POST[$rv]) : '';
            $rnum = intval($rnum);
            $data = isset($_POST[$dv]) ? trim($_POST[$dv]) : '';
            $data = strip_tags($data);
            if ((strlen($data) < 1) && ($qfmt == "c")) $data = "No";
            if (($data == "off") && ($qfmt == "b")) $data = "No";
            if (($data == "on") && (($qfmt == "b") || ($qfmt == "c"))) $data = "Yes";
            if (($mrow['emdetail']) || ($mrow['fpdetail']))
            {
              $dsql = "SELECT * FROM `".$prefix."_MA_mapp` WHERE fldnum = '$rnum'";

              if( !($dresult = $db->sql_query($dsql)) )
              {
      	        echo "<H3>ERROR - 9 - ".MA_UTOQTTRQERROR."</H3><br>";
      	        exit();
      	      }
      	
       	      if ( !($drow = $db->sql_fetchrow($dresult)) )
      	      {
          	     echo "<H3>ERROR - 10 - ".MA_UATLQDERROR."</H3><br>";
      	         exit();
      	      }
              if ($drow['format']!="L")
              {
                // if (!get_magic_quotes_gpc()) { $txt = addslashes($txt); } 
    	        $q = $drow['fldname'];
              $p = $drow['parent'];
    	        $q = addslashes($q);
                if ($mrow['emdetail'])
                {
                   if ($drow['format']=="p")
      	           {
                      $message .= MA_QUESTION.":  ".$q." \n\r ".MA_RESPONSE.": ********";
                   }
                   else
                   {
                      if (($qfmt == "b") && ($p == 0))
                      {
                        $message .= " ".MA_QUESTION.":  ".$q." \n\r ";
                      }
                      else
                      {
                        if (($qfmt == "b") && ($p > 0))
                        {
                          $message .= "-->".$q." \n\r ".$data." \n\r ";
                        }
                        else
                        {
                          $message .= " ".MA_QUESTION.":  ".$q." \n\r ".MA_RESPONSE.": ".$data;
                        }
                      }
                    }



//                       $message .= MA_QUESTION.":  ".$q." \n\r ".MA_RESPONSE.": ".$data;
//                   }
                   if  ($qfmt != "b")$message .= "\n\r\n\r";
                }
                if ($qfmt == "T")
                {
                  $post .= " <strong>".MA_QUESTION.":  ".$q." \n\r ".MA_RESPONSE.": \n\r</strong>".$data."\n\r\n\r";
                }
                ELSE
                {
                if ($mrow['fpdetail'])
                {   
                    if ($drow['format']=="p")
      	            {
                       $post .= MA_QUESTION.":  ".$q." \n\r ".MA_RESPONSE.": ********";
                    }
                    else
                    {
                      if (($qfmt == "b") && ($p == 0))
                      {
                        $post .= " <strong>".MA_QUESTION.":  ".$q." </strong>";
                      }
                      else
                      {
                        if (($qfmt == "b") && ($p > 0))
                        {
                          $post .= "<strong>&#187; ".$q."</strong>\n\r<BR />".$data;
                        }
                        else
                        {
                          $post .= " <strong>".MA_QUESTION.":  ".$q." \n\r ".MA_RESPONSE.": </strong>".$data;
                        }
                      }
//                        $post .= MA_QUESTION.$q." \n\r ".MA_RESPONSE." ".$data;
                    }
                    $post .= "\n\r\n\r";
                }
              }
            }
            }
            $adate = date("F j, Y");
            $query = "INSERT INTO `".$prefix."_MA_mappresp` (`recno`,`formno`,`appnum`,`userno`,`qno`,`response`,`adate`) VALUES ('','$appno','$lastapp','$nu','$rnum','$data','$adate')";
            $result = $db->sql_query($query);

            if(!$result)
            {
              echo "<H3>ERROR - 11 - ".MA_EIADIRTERROR."</H3><br>";
      	      exit();
            }

            $db->sql_freeresult($result);
            $ct++;
          }

          $user_ip = $_SERVER['REMOTE_ADDR'];
 
          $ip_sep = explode('.', $user_ip);
          $pip = sprintf('%02u.%02u.%02u.%02u', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);

          // added this query to put user ip as last answer entered into database

          $query = "INSERT INTO `".$prefix."_MA_mappresp` (`recno`,`formno`,`appnum`,`userno`,`qno`,`response`,`adate`) VALUES ('','$appno','$lastapp','$nu','0','$pip','$adate')";
      	  $result = $db->sql_query($query);
	  
	
 	        if(!$result)
	        {
	           echo "<H3>ERROR - 11 - ".MA_EIADIRTERROR."</H3><br>";
	           exit();
	        }
	  
          $db->sql_freeresult($result);
	
          $sqlac = "SELECT DISTINCT appnum FROM `".$prefix."_MA_mappresp` WHERE formno = $appno";
          $resultac = $db->sql_query($sqlac);
          $ac = $db->sql_numrows($resultac);
          if($ac >= $appslimitno)
          {
              $query = "UPDATE ".$prefix."_MA_mapcfg SET appsfull='1' WHERE formno = $appno";
              $result = $db->sql_query($query);

              if (!$result)
              {
                echo "<H3>ERROR - 12 - ".MA_UTUCTERROR."</H3><br>";
                exit();
              }

              $db->sql_freeresult($result);
	
         }
        
         if ($mrow['fpdetail'])
         {
            include_once("groupset.php");
         }
         if ($mrow['email_admin'])
         {
            $sql = "SELECT username, user_email, user_level FROM ".$user_prefix."_users WHERE username='$username'";
            $result = $db->sql_query($sql);

            if($db->sql_numrows($result) == 0)
            {
              die("<H3>ERROR - 13 - ".MA_UTFYURERROR."</H3><br>");
            }

            $row = $db->sql_fetchrow($result);
            $user_email = $row[user_email];
            $admin_email = $mrow['admaddr'];
	
            $sject = MA_NEW.$mrow['formtitle']." #".$lastapp." ".MA_FOR.$frmusr;
            $from  = "From: $adminmail\r\n";
            $from .= "Reply-To: $user_email\r\n";
            $from .= "Return-Path: $adminmail\r\n";
            if ($htmlmail)
            {
              $encode = 1;
              $from .= "Content-Type: text/html; charset=iso-8859-1\r\n";
              $message = str_replace("\n\r", "<br>", $message);
              $message = str_replace("\r\n", "<br>", $message);
              $message = str_replace("\n", "<br>", $message);
              $message = str_replace("&middot;", "*", $message);
            }
            else
            {
              $encode = 0;
              $from .= "Content-Type: text/plain; charset=iso-8859-1\r\n";
              $message = str_replace("<br>", "\n\r", $message);
            }
            if ($mrow['fpdetail'])
            {
              if ($htmlmail)
              {
                $message .= MA_RVWAT.":<BR>";
                $message .= "<B><I><A HREF=\"".$nukeurl."/modules.php?name=Forums&file=viewtopic&t=".$topid."\">".MA_NAPTXT."</A></I></B><BR>";
              }
              else
              {
                $message .= MA_RVWAT.":\n\r";
                $message .= $nukeurl."/modules.php?name=Forums&file=viewtopic&t=".$topid."\n\r";
              }
            }
            
            if (defined('PNM_IS_ACTIVE'))
            {
/*
              if ($htmlmail)
              {
                phpnukemail($admin_email, $sject, $message, $from, $from, $encode=1);
              }
              else
              {
*/
                phpnukemail($admin_email, $sject, $message, $user_email, $username, $encode);
//              }
            }
            else
            {
              mail($admin_email, $sject, $message, $from);
            }
          }

          $db->sql_freeresult($result);
          echo "<tr><td align=\"CENTER\" COLSPAN=\"3\">";
          echo $mrow['tytxt'];
          echo "<BR><BR><h2><center>".MA_YANI." ".$lastapp."</center></h2>";
          echo "<tr><td align=\"CENTER\" COLSPAN=\"3\">";
          include_once("copyright.php");
          echo "</table>";
          echo "</div>"; 

          closetable();
          include_once("footer.php");
          exit();
        }

        break;
//END case : APPLY
      case "error" :
        echo "<br><br><h1>".MA_PPARIERROR."</h1><br><br>";

        break;
    }
//END SWITCH
    echo "<INPUT TYPE=HIDDEN NAME=\"appno\" value=\"".$appno."\">";
    echo "<input type=\"hidden\" name=\"name\" value=\"Member_Application\">\n";
    echo "<input type=\"hidden\" name=\"op\" value=\"apply\">\n";
    echo "<center><h3>".$mrow['formtitle']."</center></h3>";
    if ( $row = $db->sql_fetchrow($result) )
    {
      $i=0;
      do
      {
        if ($row['parent'] == 0)
        {
          if ($row['format'] == 'L')
          {
            echo "<tr><td align=\"Left\" colspan=\"3\" width=\"100%\">";
            echo $row['fldname'];
          }
          else
          {
            if ($vertalign)
            {
              echo "<tr><td align=\"center\" >";  
            }
            else
            {
              echo "<tr><td align=\"right\" width=\"40%\">";
            }
            echo $row['fldname'];
//            echo "</td><td align=\"RIGHT\" width=\"5%\">";
            
          }

          $fdnum = $row['fldnum'];
          $frmt = $row['format'];
          echo "<input type=\"hidden\" name=\"recno".$i."\" value=$fdnum>";
          echo "<input type=\"hidden\" name=\"qfmt".$i."\" id=\"qfmt".$i."\" value=$frmt>";
          if ($frmt == "b") echo "<INPUT TYPE=\"hidden\" name=\"data".$i."\" id=\"data".$i."\" value=\"\">";	
          echo "</td>";


          if ($vertalign)
          {
            echo "</tr><tr><td align=\"center\" >";  
          }
          else
          {
            echo "<td align=\"left\" width=\"50%\">";
          }

          if (($row['requrd'] <> 0) && ($row['format'] != 'b') && ($row['format'] != 'L'))
          {
            echo "  <I>".MA_REQUIRED."</I><BR>";
            echo "<input type=\"hidden\" name=\"rqd".$i."\" id=\"rqd".$i."\" value=\"1\">\n";
          }
          else
          {
            echo "<input type=\"hidden\" name=\"rqd".$i."\" id=\"rqd".$i."\" value=\"0\">\n";
          }


          switch ($row['format'])
          {
            default :
              break;
              
            case "L" :
       	      echo "<INPUT TYPE=\"hidden\" name=\"data".$i."\" id=\"data".$i."\" value=\" \">";					 
              break;
              
            case "v" : 
      	      echo "<INPUT type=\"hidden\" NAME=\"regexdef".$i."\" id=\"regexdef".$i."\" value=\"".$row['rgextxt']."\">";
      	      echo "<I>".MA_VALIDATED."</I><BR>";
      	      echo "<INPUT NAME=\"data".$i."\" id=\"data".$i."\" VALUE=\"\">";
      	      break;

            case "t" :	
      	      echo "<INPUT NAME=\"data".$i."\" id=\"data".$i."\" VALUE=\"".$row['rgextxt']."\">";
      	      break;
	
       	    case "T" :
      	      echo "<TEXTAREA NAME=\"data".$i."\" id=\"data".$i."\" cols=\"60\" rows=\"20\" ></TEXTAREA>";
      	      break;
	    
     	      case "p" :
              echo "<INPUT TYPE=\"password\" name=\"data".$i."\" id=\"data".$i."\">";
              break;

       	    case "c" :	
//       	      echo "<INPUT TYPE=\"hidden\" name=\"data".$i."\" id=\"data".$i."\" value=\"off\">";					 
              echo "<INPUT TYPE=CHECKBOX NAME=\"data".$i."\" id=\"data".$i."\">";
      	      break;
							
  	         case "b" :			
  	         case "r" :			
             case "l" :	
	             $csql = "SELECT * FROM `".$prefix."_MA_mapp` WHERE inuse <> 0 AND parent = '$fdnum' ORDER BY fldord";

    	         if( !($cresult = $db->sql_query($csql)) )
   	             {
	               echo "<H3>ERROR - 14 - ".MA_UTOQTERROR."</H3> <br>";
	               exit();
	             }
		
                 $ft = 1;

  	             if ($row['format'] == "l")
	             {
	               echo "<SELECT NAME=\"data".$i."\" id=\"data".$i."\">";
		
                   if ( $row['requrd'] <> 0)
                   {
	                 echo "<OPTION VALUE=\"\">";
	               }
                }
		
                $ft = 1;
		
                while ($crow = $db->sql_fetchrow($cresult))
	            {
  	                  if ($row['format'] == "b")
	                  {
                         $i++;
         	             echo "<INPUT TYPE=\"hidden\" name=\"data".$i."\" id=\"data".$i."\" value=\"off\">";					 
                         echo "<INPUT TYPE=CHECKBOX NAME=\"data".$i."\" id=\"data".$i."\">";
                         echo " ".$crow['fldname']."<BR>";
                         $ccb=$crow['fldnum'];
                         echo "<input type=\"hidden\" name=\"recno".$i."\" value=$ccb>";
                         echo "<input type=\"hidden\" name=\"qfmt".$i."\"  id=\"qfmt".$i."\"value=$frmt>";
                   }       

	               if ($row['format'] == "l")
	               {
	                 echo "<OPTION VALUE=\"".$crow['fldname']."\">".$crow['fldname'];
                }
	                if ($row['format'] == "r")
	                {
	                   if ($ft==1)
                   	{
    	                 if ( $row['requrd'] <> 0)
		                   {
		                      echo "<INPUT type=\"radio\" name=\"data".$i."\" id=\"data".$i."\" value=\"".$crow['fldname']."\"> ".$crow['fldname']."<BR>";
                     }
		                   else
		                   {
		                      echo "<INPUT type=\"radio\" name=\"data".$i."\" id=\"data".$i."\" CHECKED value=\"".$crow['fldname']."\"> ".$crow['fldname']."<BR>";
                     } 

         	             $ft = 0;								    
	                  }
	                  else
	                  {
	 	                   echo "<INPUT type=\"radio\" name=\"data".$i."\" id=\"data".$i."\" value=\"".$crow['fldname']."\"> ".$crow['fldname']."<BR>";
                   }
	               }
	             }
		
              if ($row['format'] == "l")
	            {
	               echo "</SELECT>"; 
             }		
              break;
          }
	   
          echo "</td></tr>";//<tr height=20><td></td></tr>";
          $i++;
        }
      } while ($row = $db->sql_fetchrow($result));
      
      $db->sql_freeresult($result); 
    }
    echo "</td></tr>";
    if ($appno > -2)
    {
      echo "<INPUT TYPE=\"hidden\" name=\"i\" value=\"".$i."\">";
      echo "<tr>";
      if (! $vertalign)
      {
        echo "<td></td><td align=\"left\">";
      }
      else
      {
	     echo "<td align=\"center\">";
     }
        if ($ecompatible)
        {
          echo "<INPUT TYPE=SUBMIT VALUE=\"Apply Now!\">";
        }
        else
        {
          echo "<BUTTON type=\"button\" name=\"ton\" value=\"Apply Now!\" onclick = \"checkappy($i);\">".MA_APPLYNOW."!";
//        echo "document.appy.ton.onclick = checkappy;";
          echo ' </BUTTON>';
        }
	    echo "</td><td>";
        echo "</td></tr>";
        echo "</td><td>";
        echo "</td></tr>";
    }
    echo "</form>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    include_once("copyright.php");
    echo "</table>";
    echo "</div>";
  } 
  else
  {
    echo "<tr><td colspan=\"3\">"; 
    echo $mrow['noapptxt'];   // Output terms file
    echo "<br><br><br>";
    echo "</td></tr></table></DIV>";
  }
}
else
{
  title("$sitename: Access Denied!");

  echo "<center>".MA_YATTAARAERROR."<br><br>"
    .MA_MOTMSG."</center>";
}

closetable();

include_once("footer.php");

?>

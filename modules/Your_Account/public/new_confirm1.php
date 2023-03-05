<?php

/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke     		*/
/* ============================================                         		*/
/*                                                                      		*/
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                     		*/
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                		*/
/*                                                                      		*/
/* Contact author: escudero@phpnuke.org.br                              		*/
/* International Support Forum: http://ravenphpscripts.com/forum76.html 		*/
/*                                                                      		*/
/* This program is free software. You can redistribute it and/or modify 		*/
/* it under the terms of the GNU General Public License as published by 		*/
/* the Free Software Foundation; either version 2 of the License.       		*/
/*                                                                      		*/
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion	*/
/*********************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
     echo "CNBYA protection";
     exit;
}
    include_once("header.php");

    $user_viewemail = "0";
    $ya_user_email = strtolower($ya_user_email);
    ya_userCheck($ya_username);
    ya_mailCheck($ya_user_email);

    // menelaos: makes the 'realname' field a required field
    if ($ya_realname == '') {
        OpenTable();
        echo "<center><font class='title'><strong>"._ERRORREG."</strong></font><br><br>";
        echo "<font class='content'>"._YA_NOREALNAME."<br><br>"._GOBACK."</font></center>";
        CloseTable();
        include_once("footer.php");
        die();
    }

    // menelaos: added configurable doublecheck email routine
    if ($ya_config['doublecheckemail'] == 0) {
	$ya_user_email2 == $ya_user_email;
    } else {
    	if ($ya_user_email != $ya_user_email2) {
        OpenTable();
        echo "<center><font class='title'><strong>"._ERRORREG."</strong></font><br><br>";
        echo "<font class='content'>"._EMAILDIFFERENT."<br><br>"._GOBACK."</font></center>";
        CloseTable();
        include_once("footer.php");
        die();
	}
    }

    if (!$stop) {
        $datekey = date("F j");
        $rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $_POST[random_num] . $datekey));
        $code = substr($rcode, 2, $ya_config['codesize']);
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
    if (!security_code_check($gfx_check, array(2,4,5,7))) {
        Header('Location: modules.php?name=Your_Account&op=new_user');
        die();
    }
        else security_code(array(2,4,5,7));
/*****[BEGIN]******************************************
 [ Mod:     coRpSE Nuke Honeypot					  ]
 ******************************************************/
 		global $db, $prefix;
$date = date("F j, Y, g:i A");
$ip = $_SERVER['REMOTE_ADDR'];
 
		$loadtime = $_POST['loadtime'];
		$totaltime = time() - $loadtime;
		if($totaltime < 17){
$potnum = "0";
$reason = "Submitted in $totaltime sec.";
$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES ('', '$ya_username', '$ya_realname' '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");
			 OpenTable();
  			 echo("You took less than 15 seconds to complete the form, We think your a bot...");
			 echo "<center><span class='content'><br><br><br><br>[ <a href=\"./modules.php?name=Your_Account&op=new_user\">Go Back</a> ]</span></center>";
			 CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
 		     exit;
			}
		$botblock2 = $_POST["company"];
		if (!empty($botblock2)) {
$reason = $botblock2;
$potnum = "1";
$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES ('', '$ya_username', '$ya_realname', '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");
		OpenTable();


		echo "<script type=\"text/javascript\" />
    function blink(selector){
        $(selector).fadeOut('slow', function(){
            $(this).fadeIn('slow', function(){
                blink(this);
            });
        });
    }
    $(function() {
        blink('#blink');
    });
</script>";
echo "<style type=\"text/css\">
.hpfont {
color:#FF0000;
font-weight:700;
font-size:15px;
}
</style>";
			echo "<div align=\"left\">You failed the bot test!<br>You should have deleted<br><br><div id=\"blink\"><div class=\"hpfont\">$botblock2</div></div><br> and left it blank! <br>Go back and try again.</div>";
			echo "<center><span class='content'><br><br><br><br>[ <a href=\"./modules.php?name=Your_Account&op=new_user\">Go Back</a> ]</span></center>";
					CloseTable();
		include_once(NUKE_BASE_DIR.'footer.php');	
			exit ();
			}
		$botblock = $_POST["addition"];
		if ($botblock == "4" || $botblock == "four") {
		
$reason = "Answered with $botblock";
$potnum = "2";
$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES ('', '$ya_username', '$ya_realname', '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");



			OpenTable();
			echo "You failed the bot test!";
			echo "<center><span class='content'><br><br><br><br>[ <a href=\"./modules.php?name=Your_Account&op=new_user\">Go Back</a> ]</span></center>";
		CloseTable();
		include_once(NUKE_BASE_DIR.'footer.php');	
			exit ();
			}
/*****[END]********************************************
 [ Mod:     coRpSE Nuke Honeypot           			  ]
 ******************************************************/
        if (empty($user_password) AND empty($user_password2)) {
            $user_password = YA_MakePass();
        } elseif ($user_password != $user_password2) {
            OpenTable();
            echo "<center><font class='title'><strong>"._ERRORREG."</strong></font><br><br>";
            echo "<font class='content'>"._PASSDIFFERENT."<br><br>"._GOBACK."</font></center>";
            CloseTable();
            include_once("footer.php");
            die();
        } elseif ($user_password == $user_password2 AND (strlen($user_password) < $ya_config['pass_min'] OR strlen($user_password) > $ya_config['pass_max'])) {
            OpenTable();
            echo "<center><font class='title'><strong>"._ERRORREG."</strong></font><br><br>";
            echo "<font class='content'>"._YA_PASSLENGTH."<br><br>"._GOBACK."</font></center>";
            CloseTable();
            include_once("footer.php");
            die();
        }
		
		$result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field WHERE need = '3' ORDER BY pos");
	    while ($sqlvalue = $db->sql_fetchrow($result)) {
	      $t = $sqlvalue[fid];
          if ($nfield[$t] == "") {
		    OpenTable();
			if (substr($sqlvalue[name],0,1)=='_') eval( "\$name_exit = $sqlvalue[name];"); else $name_exit = $sqlvalue[name];
            echo "<center><font class='title'><strong>"._ERRORREG."</strong></font><br><br>";
            echo "<font class='content'>"._YA_FILEDNEED1."$name_exit"._YA_FILEDNEED2."<br><br>"._GOBACK."</font></center>";
            CloseTable();
            include_once("footer.php");
            die();
		  };
	    }
		
        title(_USERAPPLOGIN);
        OpenTable();
        echo "<center><strong>"._USERAPPFINALSTEP."</strong><br><br>$ya_username, "._USERCHECKDATA."</center><br>";
        echo "<table align='center' border='0' align=\"center\">";
        echo "<tr><td width=\"50%\"><strong>"._USERNAME.":</strong></td><td align=\"left\">$ya_username<br></td></tr>";
        echo "<tr><td width=\"50%\"><strong>"._UREALNAME.":</strong></td><td align=\"left\">$ya_realname<br></td></tr>";
        echo "<tr><td width=\"50%\"><strong>"._EMAIL.":</strong></td><td align=\"left\">$ya_user_email</td></tr>";
// menelaos: removed display of the user password here. It is mailed to the user
//      echo "<tr><td align=\"right\"><strong>"._YA_PASSWORD.":</strong></td><td>$user_password<br></td></tr>";
        echo "</table><br>";
        echo "<center><strong>"._NOTE."</strong> "._WAITAPPROVAL."";
        echo "<form action='modules.php?name=$module_name' method='post'>";
		
		if (count($nfield) > 0) foreach ($nfield as $key => $var) echo "<input type='hidden' name='nfield[$key]' value='$nfield[$key]'>";
		
        echo "<input type='hidden' name='random_num' value=\"$random_num\">";
        echo "<input type='hidden' name='gfx_check' value=\"$gfx_check\">";
        echo "<input type='hidden' name='ya_username' value=\"$ya_username\">";
        echo "<input type='hidden' name='ya_realname' value=\"$ya_realname\">";
        echo "<input type='hidden' name='ya_user_email' value=\"$ya_user_email\">";
        echo "<input type='hidden' name='user_password' value=\"$user_password\">";
        echo "<input type='hidden' name='op' value='new_finish'><br>";
        echo security_code(array(3,4,6,7), 'stacked')."\n";
        echo '<input type="hidden" name="random_num" value="'.$random_num.'" />';
        echo "<input type='submit' value='"._FINISH."'> &nbsp;&nbsp;"._GOBACK."</form></center>";
        CloseTable();
    } else {
        OpenTable();
        echo "<center><font class='title'><strong>"._ERRORREG."</strong></font><br><br>";
        echo "<font class='content'>$stop<br><br>"._GOBACK."</font></center>";
        CloseTable();
    }
    include_once("footer.php");

?>

<?php 
if ( !defined('MODULE_FILE') ) {
    die ('You can\'t access this file directly...');
}
define('INDEX_FILE', true); //comment this out to hide right blocks
if (defined('INDEX_FILE')) { $index = 1; } else {$index = 0; } // auto set right blocks for pre patch 3.1 compatibility
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = "- $module_name";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Teamspeak Display Block - Evo Clans</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                <link href="../../themes/<?php echo $ThemeSel; ?>/style/style.css" rel="stylesheet" type="text/css">
		<link href="block.css" rel="stylesheet" type="text/css">
<?php
	if (isset($_GET['autorefresh'])) {
		$autorefresh = $_GET['autorefresh'];
	} else {
		$autorefresh = 0;
	}
	if ($autorefresh == 1) {
		echo("		<meta http-equiv=\"refresh\" content=\"20; URL=" . $_SERVER["PHP_SELF"] . "?autorefresh=1\">\n");
	}
?>
	</head>
	<body>
<?php	


	$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_teamspeak"));
	
	$teamspeakip =  $row['tsip'];  
	$teamspeakport = $row['tsport'];  
	$teamspeakqueryport = $row['tsqport'];
	$tsaway = $row['tsaway']; 
	$active = $row['active'];
	$undock = $row['undock'];
	$forbidden = $row['forbidden'];
	
	// Load the Teamspeak Display:
	require("teamspeakdisplay.php");
	
	// Get the default settings
	$settings = $teamspeakDisplay->getDefaultSettings();
	
	//================== BEGIN OF CONFIGURATION CODE ======================
	
	// Set the teamspeak server IP or Hostname below (DO NOT INCLUDE THE
	// PORT NUMBER):
	$settings["serveraddress"] = "".$teamspeakip."";
	//$settings["serveraddress"] = "ts31.gameservers.com";
	
	// If your you use another port than 8767 to connect to your teamspeak
	// server using a teamspeak client, then uncomment the line below and
	// set the correct teamspeak port:
	$settings["serverudpport"] = "".$teamspeakport."";
	
	// If your teamspeak server uses another query port than 51234, then
	// uncomment the line below and set the teamspeak query port of your
	// server (look in the server.ini of your teamspeak server for this
	// portnumber):
	$settings["serverqueryport"] = "".$teamspeakqueryport."";
	
	// If you want to limit the display to only one channel including it's
	// players and subchannels, uncomment the following line and set the
	// exact name of the channel. This feature is case-sensitive!
	//$settings["limitchannel"] = "";
	$settings["active"] = "".$active."";
	
	// If your teamspeak server uses another set of forbidden nickname
	// characters than "()[]{}" (look in your server.ini for this setting),
	// then uncomment the following line and set the correct set of
	// forbidden nickname characters:
	$settings["forbiddennicknamechars"] = "".$forbidden."";
	
	//================== END OF CONFIGURATION CODE ========================
	
	// Is the script improperly configured?
	if ($settings["serveraddress"] == "") { die("You need to configure this script as described inside the CONFIGURATION CODE block in " . $_SERVER["PHP_SELF"] . "<br>\n"); }
	
	// Display the Teamspeak server
	$teamspeakDisplay->displayTeamspeakEx($settings);
	
	// Display autorefresh status and control link:
	echo("<br>\n");
	if ($autorefresh == 0) {
		echo "Autorefresh: <a href=\"" . $_SERVER["PHP_SELF"] . "?autorefresh=1\">Turn on</a><br>\n";
	} else if ($autorefresh == 1) {
		echo "Autorefresh: <a href=\"" . $_SERVER["PHP_SELF"] . "?autorefresh=0\">Turn off</a><br>\n";
	}
?>
		<br>
	</body>
</html>
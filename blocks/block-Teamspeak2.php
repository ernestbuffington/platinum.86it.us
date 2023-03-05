<?php

if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    exit;
}

	global $prefix, $db, $admin_file;

	$content = "\n\n\n\n\n\n\n\n<!-- SourceForge TeamSpeakDisplay - converted for phpNuke use by Fusion\n   tsdisplay.sourceforge.net   www.artofgaming.co.uk   www.evolutionclans.com  -->\n\n\n\n\n\n\n\n<link href=\"modules/Teamspeak/block.css\" rel=\"stylesheet\" type=\"text/css\"><div id=\"tsdisplaydiv\" align=\"left\">";
	$content .="<script language=\"javascript\">\n";
	$content .="<!--\n";
	$content .="function popup_teamspeak() {\n";
	$content .="    day = new Date();\n";
	$content .="    id = day.getTime();\n";
	$content .="    eval(\"page\" + id + \" = window.open('modules/Teamspeak/index.php?autorefresh=1', '\" + id + \"', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400')\");\n";
	$content .=" }\n";
	$content .="// -->\n";
	$content .="</script>\n";
	
	$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_teamspeak"));
	
	$teamspeakip =  $row['tsip'];  
	$teamspeakport = $row['tsport'];  
	$teamspeakqueryport = $row['tsqport'];
	$tsaway = $row['tsaway']; 
	$active = $row['active'];
	$undock = $row['undock'];
	$forbidden = $row['forbidden'];
    
	require("modules/Teamspeak/blockdisplay.php");
	
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
	$settings["awaychannel"] = "".$tsaway."";
	$settings["active"] = "".$active."";
	
	// If your teamspeak server uses another set of forbidden nickname
	// characters than "()[]{}" (look in your server.ini for this setting),
	// then uncomment the following line and set the correct set of
	// forbidden nickname characters:
	$settings["forbiddennicknamechars"] = "".$forbidden."";
	
	//================== END OF CONFIGURATION CODE ========================
	
	// Is the script improperly configured?	
	if ($settings["serveraddress"] == "") { die("You need to configure the setting located in your admin panel..<br>\n"); }
	
	// Display the Teamspeak server
	$content .= $teamspeakDisplay->displayTeamspeakEx($settings);
	$content .= "</div><br>";
	if ($undock == "1"){
	$content .= "<center>[ <a href=\"javascript:popup_teamspeak()\" title=\"Undock This Block\">undock</a> ]</center>";
	}
	$content .= "<br>\n\n\n\n\n\n\n\n<!-- SourceForge TeamSpeakDisplay - converted for phpNuke use by Fusion\n   tsdisplay.sourceforge.net   www.artofgaming.co.uk   www.evolutionclans.com  -->\n\n\n\n\n\n\n\n";

?>
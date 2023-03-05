<?php
/**************************************************************************/
/* Copyright (c) 2011, Platinum Nuke Pro 
/* By DocHaVoC  http://www.havocst.net
/* Colorbox mod for Platinum Nuke Pro
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
if (stristr($_SERVER['SCRIPT_NAME'], "jquery.colorbox.php")) {

    Header("Location: ../index.php");

    die();

}
addCSSToHead('includes/jquery/css/colorbox.css','file');
addJSToHead('includes/jquery/lib/jquery.colorbox.js','file');
$inlineJS = '<script type="text/javascript">
	$(document).ready(function(){
		$(".colorbox").colorbox({opacity:0.60, current:"{current} of {total}"});
		$(".colorboxSEO").colorbox({opacity:0.50, width:"750", height:"300", iframe:true});
		$(".iframe").colorbox({opacity:0.60, width:"80%", height:"90%", iframe:true});
	});
</script>'."\n";
addJSToHead($inlineJS,'inline');

/*
echo "<link type=\"text/css\" href=\"includes/jquery/css/colorbox.css\" rel=\"stylesheet\" media=\"all\" />\n";
echo "<script type=\"text/javascript\" src=\"includes/jquery/lib/jquery.colorbox.js\"></script>\n";
echo "	<script type=\"text/javascript\" >\n";
echo "		$(document).ready(function(){\n";
echo "			$(\".colorbox\").colorbox({opacity:0.60, current:\"{current} of {total}\"});\n";
echo "			$(\".colorbox\").colorbox();\n";
echo "			$(\".iframe\").colorbox({opacity:0.60, width:\"80%\", height:\"90%\", iframe:true});\n";
echo "			});\n";
echo "	</script>\n";*/
?>
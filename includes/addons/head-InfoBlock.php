<?php
/************************************************************************/
/* CSS and JS requirements for User Info Block                          */
/* Using RavenNuke(tm) v2.4+                                            */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), 'head-InfoBlock.php')) {
	Header('Location: ../../index.php');
	die();
}

/************************************************************************/
/* Required for $MultiThemeMode  (if set to true in block)              */
/* If adding CSS manually comment out next line                         */
/************************************************************************/
	addCSSToHead('themes/infoblock.css', 'file');
/************************************************************************/
/* If your scripts depend on any RN core scripts to be loaded, (jQuery) */
/* load them first to ensure they get loaded in the correct order       */
/* jquery and jquery cookie only required if using colorbox in infoblock*/
/* options, otherwise comment out next 2 lines, if so, this  must be    */
/* set to false in the block                                            */
/* $pm_colorbox_notice  = false;                                        */
/************************************************************************/
//	addJSToHead('includes/jquery/jquery.js', 'file');
	addJSToHead('includes/jquery/jquery.cookie.js', 'file');
/************************************************************************/
/* We will let nukeNAV load these scripts for now, but in the future    */
/* they MAY be loaded on demand so uncomment if you are having issues   */
/************************************************************************/
	//addJSToHead('includes/jquery/jquery.colorbox-min.js', 'file');
	//addCSSToHead('includes/jquery/css/colorbox.css', 'file');

/************************************************************************/
/* Colorbox settings for the Info Block - Info Box CSS                  */
/* Not needed if these two settings are false                           */
/* $pm_colorbox_notice  = false;                                        */
/* $whoisUseModal       = false;                                        */
/************************************************************************/
$inlineJS = '<script type="text/javascript">
	$(document).ready(function(){
		$(\'#IByesnewpm\').colorbox({ width: "250px", height: "200px", inline:true, open:true, href:"#IBnewmessages" });
		$(".IBmodal").colorbox({opacity:0.50, width:"80%", height:"80%", iframe:true});
	});
</script>'."\n";
addJSToHead($inlineJS,'inline');
?>
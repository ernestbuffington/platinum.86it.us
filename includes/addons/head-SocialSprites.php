<?php
/************************************************************************/
/* Example use of the Site Wide CSS Addon                               */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), 'head-SocialSprites.php')) {
	Header('Location: ../../index.php');
	die();
}

	addCSSToHead('modules/News/css/socialicons.css', 'file');
	addCSSToHead('modules/News/css/med_socialicons.css', 'file');
	addCSSToHead('modules/News/css/medlg_socialicons.css', 'file');	
?>
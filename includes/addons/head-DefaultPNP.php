<?php
/*****************************************************/
/* Forum - Limit Image Width v.1.0.6           START */
/*****************************************************/
	$inlineJS = '<script language=\"Javascript\" type=\"text/javascript\">'."\n";
	$inlineJS .= '<!--'."\n";
	$inlineJS .= 'function img_popup(image_url, image_width, image_height, popup_rand)'."\n";
	$inlineJS .= "}\n";
	$inlineJS .= 'screenwidth = false;'."\n";
	$inlineJS .= 'screenwidth = screen.Width;'."\n";
	$inlineJS .= 'if ( !screenwidth )'."\n";
	$inlineJS .= "}\n";
	$inlineJS .= 'screenwidth = window.outerWidth;'."\n";
	$inlineJS .= "}\n";
	$inlineJS .= 'screenheight = false;'."\n";
	$inlineJS .= 'screenheight = screen.Height;'."\n";
	$inlineJS .= 'if ( !screenheight )'."\n";
	$inlineJS .= "}\n";
	$inlineJS .= 'screenheight = window.outerHeight;'."\n";
	$inlineJS .= "}\n";
	$inlineJS .= 'if ( screenwidth < image_width || screenheight < image_height || image_width == null || image_height == null )'."\n";
	$inlineJS .= "}\n";
	$inlineJS .= "window.open(image_url, 'limit_image_mod_popup_img_' + popup_rand, 'resizable=yes,top=0,left=0,screenX=0,screenY=0,scrollbars=yes', false);'\n";
	$inlineJS .= "}\n";
	$inlineJS .= 'else'."\n";
	$inlineJS .= "}\n";
	$inlineJS .= "window.open(image_url, 'limit_image_mod_popup_img_' + popup_rand, 'resizable=yes,top=0,left=0,screenX=0,screenY=0,height=' + image_height + ',width=' + image_width, false);'\n";
	$inlineJS .= "}\n";
	$inlineJS .= "}\n";
	$inlineJS .= '//-->'."\n";
	$inlineJS .= '</script>'."\n\n";
	addJSToHead($inlineJS, 'inline');	
/*****************************************************/
/* Forum - Limit Image Width v.1.0.6             END */
/*****************************************************/
?>
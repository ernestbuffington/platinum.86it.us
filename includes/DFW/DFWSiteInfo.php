<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
global $admin, $prefix, $db, $dfw_getsets;

/*************************************/
/* Grab The Settings           START */
/*************************************/

$dfw_getsets = array();
$dfw_getsets = dfw_getcfg();

function dfw_getcfg()
{
		global $prefix, $db;
		$getcfg = array();
		$sql = 'SELECT * FROM `' . $prefix . '_dfw_cfg`';
		$result = $db->sql_query($sql);
		if (!$result) { //DB call was not successful, so raise an application error
				echo '' . _DBCALLERROR . '';
		} else { //DB Call was successful
				while (list($cfg_nm, $cfg_val) = $db->sql_fetchrow($result)) {
						$getcfg[$cfg_nm] = $cfg_val;
				}
				return $getcfg;
		}
}
/*************************************/
/* Grab The Settings             END */
/*************************************/


if (is_admin($admin) && $_GET['op'] == 'DFWAdmin') {

// Include The JS
addCSSToHead('includes/DFW/jquery.tooltip.css','file');
addJSToHead('includes/jquery/lib/jquery.tooltip.js','file');
addCSSToHead('includes/DFW/admin.css','file');

//$js_headers[] = 'jquery.tooltip.js';
//echo '<link rel="stylesheet" type="text/css" href="includes/DFW/jquery.tooltip.css" />';
//echo '<link rel="stylesheet" type="text/css" href="includes/DFW/admin.css" />';
$inlinettJS ='<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$(\'#mainbox\').show();
	// toggles the slickbox on clicking the noted link  
	$(\'img#toggle-settings\').click(function() {
	$(\'#mainbox\').hide();
	$(\'#tooltipbox\').hide();
	$(\'#imagebox\').hide();
    $(\'#settingsbox\').toggle(400);
    return false;
  });
	$(\'img#toggle-main\').click(function() {
	$(\'#settingsbox\').hide();
	$(\'#tooltipbox\').hide();
	$(\'#imagebox\').hide();
    $(\'#mainbox\').toggle(400);
    return false;
  });
	$(\'img#toggle-tooltip\').click(function() {
	$(\'#settingsbox\').hide();
	$(\'#mainbox\').hide();
	$(\'#imagebox\').hide();
    $(\'#tooltipbox\').toggle(400);
    return false;
  });
	$(\'img#toggle-image\').click(function() {
	$(\'#settingsbox\').hide();
	$(\'#mainbox\').hide();
	$(\'#tooltipbox\').hide();
    $(\'#imagebox\').toggle(400);
    return false;
  });
	// toggles the slickbox on clicking the noted link  
	$(\'a#toggle-block\').click(function() {
	$(\'#blockstip-toggle\').hide();
    $(\'#blockstoggle\').toggle(400);
    return false;
	});
	// toggles the slickbox on clicking the noted link  
	$(\'a#toggle-blocktip\').click(function() {
	$(\'#blockstoggle\').hide();
    $(\'#blockstip-toggle\').toggle(400);
    return false;
	});
$("#MyImage").bind(\'change\', function() {
         var update_pic = $(this).val();
         if (update_pic) {
             $(\'#NewPic\').attr(\'src\', \'images/DFW/admin/\' + update_pic + \'\' );
         }
     });
}); // $(document) CLOSE
</script>';
addJSToHead($inlinettJS,'inline');

if ($dfw_getsets['admin_tooltips'] == 1) {
addCSSToHead('includes/DFW/jquery.tooltip.css','file');
addJSToHead('includes/jquery/lib/jquery.tooltip.js','file');
addCSSToHead('includes/DFW/admin.css','file');
//$js_headers[] = 'jquery.tooltip.js';
//echo '<link rel="stylesheet" type="text/css" href="includes/DFW/jquery.tooltip.css" />';
/*echo '<script type="text/javascript">' . "\n";
echo '$(document).ready(function() {' . "\n";
echo '$(\'#pretty\').tooltip({
	track: false,
	fade: 250,
	showURL: false,
	showBody: " - ",
	top: -90,
	left: 10
});';
echo '$(\'#adminpretty li\').tooltip({ 
    track: true, 
    delay: 0, 
    showURL: false, 
    showBody: " - ", 
    fade: 250 
});';
echo '$(\'#adminpretty1 li\').tooltip({ 
    track: true, 
    delay: 0, 
    showURL: false, 
    showBody: " - ", 
    fade: 250 
});';
echo '});' . "\n";
echo '</script>' . "\n";*/
$inlinet2JS ='<script type="text/javascript">
$(document).ready(function() { 
$(\'#pretty\').tooltip({
	track: false,
	fade: 250,
	showURL: false,
	showBody: " - ",
	top: -90,
	left: 10
});
$(\'#adminpretty li\').tooltip({ 
    track: true, 
    delay: 0, 
    showURL: false, 
    showBody: " - ", 
    fade: 250 
});
$(\'#adminpretty1 li\').tooltip({ 
    track: true, 
    delay: 0, 
    showURL: false, 
    showBody: " - ", 
    fade: 250 
});
});
</script>';
addJSToHead($inlinet2JS,'inline');
}
}

if ($dfw_getsets['tooltip'] == 1) {
addCSSToHead('includes/DFW/jquery.tooltip.css','file');
addJSToHead('includes/jquery/lib/jquery.tooltip.js','file');
addCSSToHead('includes/DFW/admin.css','file');
//$js_headers[] = 'jquery.tooltip.js';
//echo '<link rel="stylesheet" type="text/css" href="includes/DFW/jquery.tooltip.css" />';
// Define some variables
$BdrThickness = (!empty($dfw_getsets['tooltip_bordersize']) ? intval($dfw_getsets['tooltip_bordersize']) :  '0');
$BdrType = (!empty($dfw_getsets['tooltip_bordertype']) ? $dfw_getsets['tooltip_bordertype'] :  'none');
$BdrColor = ((strlen($dfw_getsets['tooltip_bordercolor']) == 7) ? $dfw_getsets['tooltip_bordercolor'] : '#F00000');
$TxtColor = ((strlen($dfw_getsets['tooltip_txtcolor']) == 7) ? $dfw_getsets['tooltip_txtcolor'] : '#000000'); 
$BgColor = ((strlen($dfw_getsets['tooltip_bgcolor']) == 7) ? $dfw_getsets['tooltip_bgcolor'] : '#000000'); 
$Opacity = ((!empty($dfw_getsets['tooltip_opacity'])) ? intval($dfw_getsets['tooltip_opacity']) : '9'); 
$pad = ((!empty($dfw_getsets['tooltip_padding'])) ? intval($dfw_getsets['tooltip_padding']) : '20'); 

$inlinedfwCSS = '<style type="text/css">
#tooltip.DFWClass {
	font-family: Arial;
	text-align:left;
	color: ' . $TxtColor . ';
	background-color: ' . $BgColor . ';
	border: ' . $BdrThickness . 'px ' . $BdrType . ' ' . $BdrColor . ';
	padding: ' . $pad . 'px;
	opacity: 0.' . $Opacity . ';
}
</style>';
addCSSToHead($inlinedfwCSS,'inline');

/*echo '<style type="text/css">
#tooltip.DFWClass {
	font-family: Arial;
	text-align:left;
	color: ' . $TxtColor . ';
	background-color: ' . $BgColor . ';
	border: ' . $BdrThickness . 'px ' . $BdrType . ' ' . $BdrColor . ';
	padding: ' . $pad . 'px;
	opacity: 0.' . $Opacity . ';
}
</style>';
*/
$inlinedfwsJS = '<script type="text/javascript">
$(function() {
  $(\'#DFWSite a\').tooltip({
	track: true,
	delay: 0,
	fixPNG: true,
	extraClass: "DFWClass",
	showURL: false,
	showBody: " - ",
	fade: 250
  });
});
</script>';
addJSToHead($inlinedfwsJS,'inline');
}

?>
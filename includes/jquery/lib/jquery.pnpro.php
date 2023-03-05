<?php
/**************************************************************************/
/*Platinum Nuke Pro default for required jquery.***************************/                    
/* Copyright (c) 2011, Platinum Nuke Pro        ***************************/
/* Added By DocHaVoC  http://www.havocst.net    ***************************/
/* Colorbox mod for Platinum Nuke Pro           ***************************/
/* CKeditor mod for Platinum Nuke Nuke Pro      ***************************/
/* nukeSEO                                      ***************************/
/* jquery default                               ***************************/
/* This program is free software. You can redistribute it and/or modify it*/
/* under the terms of the GNU General Public License as published by the **/
/* Free Software Foundation, version 2 of the license.*********************/
/**************************************************************************/
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
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
/**************************************************************************/
/* CKeditor mod for Platinum Nuke Pro  ************************************/
/**************************************************************************/
addJSToHead('includes/ckeditor/ckeditor.js','file');
addJSToHead('includes/ckfinder/ckfinder.js','file');	
/**************************************************************************/
/* Colorbox mod for Platinum Nuke Pro  ************************************/
/**************************************************************************/
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
/* jquery default   Advanced User Management    ***************************/
/**************************************************************************/
addJSToHead('includes/jquery/lib/jquery.pstrength-min.1.2.js','file');
addCSSToHead('includes/jquery/css/screen.css', 'file');
addCSSToHead('includes/jquery/css/jquery.css', 'file');
addJSToHead('includes/jquery/lib/jquery.validate.min.js', 'file');
/************************************************************************/
/* nukeSEO                           ************************************/
/* http://www.nukeSEO.com            ************************************/
/* Copyright © 2007 by Kevin Guske   ************************************/
/************************************************************************/
addJSToHead('includes/boxover/boxover.js', 'file');
/******************Tabs*****tags*****ajaxtabs****************************************/
addCSSToHead('modules/Tags/css/tags.css', 'file');
addJSToHead('includes/ajaxtabs/ajaxtabs.js','file');
addCSSToHead('includes/tabcontent/tabcontent.css', 'file');
addJSToHead('includes/tabcontent/tabcontent.js','file');
if (defined('_UITABS')) 
{
addCSSToHead('includes/uitabs/ui.tabs.css, media="print, projection, screen"','file');
addJSToBody('includes/uitabs/ui.core.js','file');
addJSToBody('includes/uitabs/ui.tabs.js','file');
$inlineuiJS = '<script type="text/javascript">
            $(function() {
                $(\'#container-1 ul\').tabs();
            });
        </script>';
addJSToBody($inlineuiJS,'inline');	
}
// Include jQuery
addJSToHead('includes/jquery/lib/jquery.dimensions.js','file');
/******************Tabs***********tags*****ajaxtabs***********************************/
/************************************************************************/	
/*****************************************/
/* Expand / Contract              START  */
/*****************************************/
$inlineecJS ='<script type="text/javascript">
$(function()
{

$("fieldset.trigger legend a").click(function(event)
{
event.preventDefault();
$(this).parent().parent().children("div").slideToggle();
});

$("fieldset.trigger>div>a").click(function(event) {
event.preventDefault();

$(this).parent().slideUp();
});
});
</script>';
addJSToBody($inlineecJS,'inline');	
/*****************************************/
/* Expand / Contract                END  */
/*****************************************/
/********admin/jqmenu******************************************************/
/**************************************************************************/
addJSToHead('includes/jquery/lib/jquery-ui-1.7.1.min.js','file');
addCSSToHead('includes/jquery/css/jquery.treeview.css','file');
addJSToHead('includes/jquery/lib/jquery.treeview.js','file');
$inlinetvJS = '<script type="text/javascript">
		$(function() {
			$("#tree").treeview({
				collapsed: true,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
			$("#admintree").treeview({
				collapsed: true,
				animated: "medium",
				control:"#adminsidetreecontrol",
				persist: "location"
			});
		})
		
	</script>';
addJSToHead($inlinetvJS,'inline');	
/************************************************************************/
/*****************************************/
/* Slimbox                        START  */
/*****************************************/
if (defined('LIGHTBOX')) {
	global $bgcolor2;
addJSToHead('includes/jquery/lib/jquery.lightbox.js', 'file');	
addCSSToHead('includes/jquery/css/lightbox.css', 'file');
/*	echo '<script type="text/javascript" src="includes/jquery/jquery.lightbox.js"></script>';*/
/*	echo '<link rel="stylesheet" href="includes/jquery/lightbox.css" type="text/css" media="screen" />' . "\n";*/
/*  echo '<script type="text/javascript" language="javascript">*/
$inlinelbJS = '<script type="text/javascript">	
	  	 $(function() {
  			$(\'a.lightbox\').lightBox({
			overlayBgColor: \'' . $bgcolor2 . '\',
			overlayOpacity: 0.6,
			imageLoading: \'includes/jquery/images/loading.gif\',
			imageBtnClose: \'includes/jquery/images/close.gif\',
			imageBtnPrev: \'includes/jquery/images/prev.gif\',
			imageBtnNext: \'includes/jquery/images/next.gif\',
			containerResizeSpeed: 400
			});
			});
		  </script>';
addJSToHead($inlinelbJS,'inline');		  
}
/*****************************************/
/* Slimbox                          END  */
/*****************************************/
/******************************************************/
/* A simple show/hide dhtml script by Raven           */
/******************************************************/
/*echo <<<_dhtmlHideShow_
      <script type="text/javascript">*/
$inlineshJS = '<script type="text/javascript">		  
         function hideshow(which) {
            if (!document.getElementById) {
               return;
            }
            if (which.style.display=="block") {
               which.style.display="none";
            }
            else {
               which.style.display="block";
            }
         }
      </script>';
addJSToHead($inlineshJS,'inline');
/******************************************************/
/* used in modules.php                                */
/******************************************************/
$inlinemdlJS = '<script type="text/javascript">
	function gotoURL(dropDown) {
		URL=dropDown.options[dropDown.selectedIndex].value;
		if(URL.length>0) {
			top.location.href = URL;
		}
	}
</script>
<style type="text/css">
.mymodulesselectbox{
	width:140px;
	background:#f7f8fc;
}
</style>';
addJSToHead($inlinemdlJS,'inline');
/************************************************************************/	

if ($name == 'News')
{
addJSToHead('includes/jquery/lib/jquery.MetaData.js','file');
addJSToHead('includes/jquery/lib/jquery.rating.js','file');
addCSSToHead('includes/jquery/css/jquery.rating.css','file');
}

?>
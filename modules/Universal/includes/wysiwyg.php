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

// BBCode System for PHP-Nuke phpBB by AL Tnen - http://www.tnen.zzn.com
// Modified for use in Universal Module by Barry Caplin - http://www.e-devstudio.com

if (stristr($_SERVER['SCRIPT_NAME'], "wysiwyg.php")) {
	die("Illegal Desolate File Access");
}

function wysiwyg_form($form_name, $entrybox){
    global $modulename;
    $module_name = $modulename;
    $form_name = $form_name;
    $entrybox = $entrybox;
        @include_once("modules/$modulename/includes/bbcode_javascript.php");
         echo "<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\">
	<tr>
	  <td valign=\"top\"><span class=\"gen\"> <span class=\"genmed\"> </span>
		<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
		  <tr align=\"right\" valign=\"middle\">
			<td>
			  <p dir=\"rtl\" style=\"margin-top: 0; margin-bottom: 0\" align=\"left\"><span class=\"gen\">
			  <span class=\"genmed\">
			  &nbsp;<select name=\"fc\" onChange=\"BBCfc()\" dir=\"ltr\" onMouseOver=\"helpline('fc')\">
              <option selected value=\"black\" class=\"genmed\">"._UMBBFONTCOLOR."</option>
                                          <option style=\"color:darkred;\" value=\"darkred\" class=\"genmed\">"._UMBBDARKRED."</option>
					  <option style=\"color:red;\" value=\"red\" class=\"genmed\">"._UMBBRED."</option>
					  <option style=\"color:orange;\" value=\"orange\" class=\"genmed\">"._UMBBORANGE."</option>
					  <option style=\"color:brown;\" value=\"brown\" class=\"genmed\">"._UMBBBROWN."</option>
					  <option style=\"color:yellow;\" value=\"yellow\" class=\"genmed\">"._UMBBYELLOW."</option>
					  <option style=\"color:green;\" value=\"green\" class=\"genmed\">"._UMBBGREEN."</option>
					  <option style=\"color:olive;\" value=\"olive\" class=\"genmed\">"._UMBBOLIVE."</option>
					  <option style=\"color:cyan;\" value=\"cyan\" class=\"genmed\">"._UMBBCYAN."</option>
					  <option style=\"color:blue;\" value=\"blue\" class=\"genmed\">"._UMBBBLUE."</option>
					  <option style=\"color:darkblue;\" value=\"darkblue\" class=\"genmed\">"._UMBBDARKBLUE."</option>
					  <option style=\"color:indigo;\" value=\"indigo\" class=\"genmed\">"._UMBBINDIGO."</option>
					  <option style=\"color:violet;\" value=\"violet\" class=\"genmed\">"._UMBBVIOLET."</option>
					  <option style=\"color:white;\" value=\"white\" class=\"genmed\">"._UMBBWHITE."</option>
					  <option style=\"color:black;\" value=\"black\" class=\"genmed\">"._UMBBBLACK."</option>
			  </select>&nbsp;&nbsp; <select name=\"fs\" onChange=\"BBCfs()\" dir=\"ltr\" onMouseOver=\"helpline('fs')\">
			                <option selected value=\"7\" class=\"genmed\">"._UMBBFONTSIZE."</option>
			  		  <option value=\"7\" class=\"genmed\">"._UMBBTINY."</option>
					  <option value=\"9\" class=\"genmed\">"._UMBBSMALL."</option>
					  <option value=\"12\" class=\"genmed\">"._UMBBNORMAL."</option>
					  <option value=\"18\" class=\"genmed\">"._UMBBLARGE."</option>
					  <option  value=\"24\" class=\"genmed\">"._UMBBHUGH."</option>
					</select> <span lang=\"ar-sy\">&nbsp;</span><select name=\"ft\" onChange=\"BBCft()\" onMouseOver=\"helpline('ft')\" dir=\"ltr\">
                                          <option selected value=\"Arial\" class=\"genmed\">Font type</option>
                                          <option value=\"Arial\" class=\"genmed\">Default font
                                          </option>
<option value=\"Andalus\" class=\"genmed\">
Andalus</option> 
<option value=\"Arial\" class=\"genmed\">
Arial</option> 
<option value=\"Comic Sans MS\" class=\"genmed\">
Comic Sans MS</option>
<option value=\"Courier New\" class=\"genmed\">
Courier New</option> 
                                          <option value=\"Lucida Console\" class=\"genmed\">Lucida Console
                                          </option>
<option value=\"Microsoft Sans Serif\" class=\"genmed\">
Microsoft Sans Serif</option> 
<option value=\"Symbol\" class=\"genmed\">
Symbol</option>
<option value=\"Tahoma\" class=\"genmed\">
Tahoma</option> 
<option value=\"Times New Roman\" class=\"genmed\">
Times New Roman</option>
<option value=\"Traditional Arabic\" class=\"genmed\">
Traditional Arabic</option> 
<option value=\"Verdana\" class=\"genmed\">
Verdana</option> 
<option value=\"Webdings\" class=\"genmed\">
Webdings</option> 
<option value=\"Wingdings\" class=\"genmed\">
Wingdings</option> 
                                  </select></span></span></span><p dir=\"rtl\" style=\"margin-top: 0; margin-bottom: 0\">
              <span class=\"genmed\"><span style=\"font-size: 5pt\">&nbsp;</span></span></td>
		  </tr>
		  <span class=\"gen\">
		  <tr> 
			<td width=\"450\">
			  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
				<tr> 
                        <td> 
                          <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                <tr> 
                                  <td>
                                  <p dir=\"ltr\" align=\"left\"><span class=\"gen\">
			  <span class=\"genmed\">
			                      <span lang=\"ar-sy\">&nbsp;</span><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/justify.gif\" name=\"justify\" type=\"image\" onClick=\"BBCjustify()\" onMouseOver=\"helpline('justify')\" style=\"border-style: outset; border-width: 1\" alt=\"justify\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/right.gif\" name=\"right\" type=\"image\" onClick=\"BBCright()\" onMouseOver=\"helpline('right')\"  style=\"border-style: outset; border-width: 1\" alt=\"right\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/center.gif\" name=\"center\" type=\"image\" onClick=\"BBCcenter()\" onMouseOver=\"helpline('center')\"  style=\"border-style: outset; border-width: 1\" alt=\"center\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/left.gif\" name=\"left\" type=\"image\" onClick=\"BBCleft()\" onMouseOver=\"helpline('left')\"  style=\"border-style: outset; border-width: 1\" alt=\"left\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/bold.gif\" name=\"bold\" type=\"image\" onClick=\"BBCbold()\" onMouseOver=\"helpline('b')\" style=\"border-style: outset; border-width: 1\" alt=\"bold\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/italic.gif\" name=\"italic\" type=\"image\" onClick=\"BBCitalic()\" onMouseOver=\"helpline('i')\" style=\"border-style: outset; border-width: 1\" alt=\"italic\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/under.gif\" name=\"under\" type=\"image\" onClick=\"BBCunder()\" onMouseOver=\"helpline('u')\" style=\"border-style: outset; border-width: 1\" alt=\"under line\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/fade.gif\" name=\"fade\" type=\"image\" onClick=\"BBCfade()\" onMouseOver=\"helpline('fade')\" style=\"border-style: outset; border-width: 1\" alt=\"fade\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/grad.gif\" name=\"grad\" type=\"image\" onClick=\"BBCgrad()\" onMouseOver=\"helpline('grad')\" style=\"border-style: outset; border-width: 1\" alt=\"gradient\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/rtl.gif\" name=\"dirrtl\" type=\"image\" onClick=\"BBCdir('rtl')\" onMouseOver=\"helpline('rtl')\" style=\"border-style: outset; border-width: 1\" alt=\"Right to Left\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/ltr.gif\" name=\"dirltr\" type=\"image\" onClick=\"BBCdir('ltr')\" onMouseOver=\"helpline('ltr')\" style=\"border-style: outset; border-width: 1\" alt=\"Left to Right\">&nbsp;&nbsp;
                                  </td>
                                </tr> 
                                <tr> 
                                  <td dir=\"rtl\">
                                  <p align=\"right\" dir=\"rtl\" style=\"margin-top: 0; margin-bottom: 0\">
                                  <span style=\"font-size: 5pt\">&nbsp;</span><p align=\"left\" dir=\"ltr\" style=\"margin-top: 0; margin-bottom: 0\"><span class=\"gen\">
			  <span class=\"genmed\">
			                      &nbsp;<img border=\"0\" src=\"modules/".$module_name."/images/bbcode/code.gif\" name=\"code\" type=\"image\" onClick=\"BBCcode()\" onMouseOver=\"helpline('code')\" style=\"border-style: outset; border-width: 1\" alt=\"Code\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/quote.gif\" name=\"quote\" type=\"image\" onClick=\"BBCquote()\" onMouseOver=\"helpline('quote')\" style=\"border-style: outset; border-width: 1\" alt=\"Quote\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/url.gif\" name=\"url\" type=\"image\" onClick=\"BBCurl()\" onMouseOver=\"helpline('url')\" style=\"border-style: outset; border-width: 1\" alt=\"URL\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/email.gif\" name=\"email\" type=\"image\" onClick=\"BBCmail()\" onMouseOver=\"helpline('mail')\" style=\"border-style: outset; border-width: 1\" alt=\"Email\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/web.gif\" name=\"web\" type=\"image\" onClick=\"BBCweb()\" onMouseOver=\"helpline('web')\" style=\"border-style: outset; border-width: 1\" alt=\"Wep Page\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/img.gif\" name=\"img\" type=\"image\" onClick=\"BBCimg()\" onMouseOver=\"helpline('img')\" style=\"border-style: outset; border-width: 1\" alt=\"Image\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/flash.gif\" name=\"flash\" type=\"image\" onClick=\"BBCflash()\" onMouseOver=\"helpline('flash')\" style=\"border-style: outset; border-width: 1\" alt=\"Flash\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/video.gif\" name=\"video\" type=\"image\" onClick=\"BBCvideo()\" onMouseOver=\"helpline('video')\" style=\"border-style: outset; border-width: 1\" alt=\"Video\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/sound.gif\" name=\"stream\" type=\"image\" onClick=\"BBCstream()\" onMouseOver=\"helpline('stream')\" style=\"border-style: outset; border-width: 1\" alt=\"Stream\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/ram.gif\" name=\"ram\" type=\"image\" onClick=\"BBCram()\" onMouseOver=\"helpline('ram')\" style=\"border-style: outset; border-width: 1\" alt=\"Real Media\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/hr.gif\" name=\"hr\" type=\"image\" onClick=\"BBChr()\" onMouseOver=\"helpline('hr')\" style=\"border-style: outset; border-width: 1\" alt=\"H-Line\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/plain.gif\" name=\"plain\" type=\"image\" onClick=\"BBCplain()\" onMouseOver=\"helpline('plain')\" style=\"border-style: outset; border-width: 1\" alt=\"Remove BBcode\"></span></td>
                                </tr>
                          </table> 
                        </td> 
                  </tr> 
			  </table>
         		</td>
         	</tr>
         <tr>
			<td colspan=\"9\"> <span class=\"gensmall\">
			  <input type=\"text\" name=\"helpbox\" size=\"35\" maxlength=\"100\" style=\"width:400px; font-size:10px\" class=\"helpline\" value=\"Tip: Styles can be applied quickly to selected text\" />
			  </span></td>
		  </tr>         
         </table>
       		</td>
         	</tr>
         </table>";
}

// <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marqd.gif\" name=\"marqd\" type=\"image\" onClick=\"BBCmarqd()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to down\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marqu.gif\" name=\"marqu\" type=\"image\" onClick=\"BBCmarqu()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to up\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marql.gif\" name=\"marql\" type=\"image\" onClick=\"BBCmarql()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to left\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marqr.gif\" name=\"marqr\" type=\"image\" onClick=\"BBCmarqr()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to right\"></span></span>

?>
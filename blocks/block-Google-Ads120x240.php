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
######################################################################
# PHP-Nuke Block: Google AdSense (block-Google-Ads120x240.php)       #
# Copyright(c) 2004 Steph Benoit - http://64bit.us                   #
# This script is free. You can redistribute it and/or modify         #
# it under the terms of GNU/GLP Version 2                            #
######################################################################
if (preg_match("/block-Google-Ads120x240.php/", $PHP_SELF)) {
Header("Location: index.php");
die();
}
$content = '<center><script type="text/javascript"><!--
google_ad_client = "pub-4668664202264183";
google_ad_width = 120;
google_ad_height = 240;
google_ad_format = "120x240_as";
google_ad_type = "text_image";
google_ad_channel = "3584309477+0023498799+0237876647";
google_color_border = "000000";
google_color_bg = "000000";
google_color_link = "3EB7EF";
google_color_text = "3EB7EF";
google_color_url = "3EB7EF";
google_ui_features = "rc:6";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</center>';
?>

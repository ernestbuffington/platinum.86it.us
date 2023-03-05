<?php

/************************************************************************/
/* NuCalendar                                                           */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2003 by Bill Smith                                     */
/* http://www.vettesofthetropics.com                                    */
/*                                                                      */
/* Based on Web Calendar                                                */
/* Copyright (c) 2001 by Proverbs, LLC                                  */
/* http://www.proverbs.biz                                              */
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2012 by http://www.platinumnukepro.com          */
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
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2012 by http://www.platinumnukepro.com          */
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

/*
 *  ©2001 Proverbs, LLC. All rights reserved.
 *
 *  This program is free software; you can redistribute it and/or modify it with
the following stipulations:
 *  Changes or modifications must retain all Copyright statements, including, bu
t not limited to the Copyright statement
 *  and Proverbs, LLC homepage link provided at the bottom of this page.
 */



$module_name = basename(dirname(__FILE__));
$mod_name = "NuCalendar";
$author_name = "Bill Smith";
$author_email = "boots (at) bootsware (dot) com";
$author_homepage = "http://www.vettesofthetropics.com";
$license = "GNU/GPL";
$download_location = "http://www.vettesofthetropics.com/modules.php?name=Downloads&d_op=viewdownloaddetails&lid=2";
$module_version = "0.61";
$release_date = "May 25th 2003";
$module_description = "An event calendar for PHP-Nuke version 6 and 6.5";
$forum = "http://www.vettesofthetropics.com/modules.php?name=Forums&file=viewforum&f=4";
$mod_cost = "Free";

function show_copyright() {
    global $mod_cost, $forum, $mod_name, $module_name, $release_date, $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description;
    if ($mod_name == "") { $mod_name = preg_replace("/_/", " ", $module_name); }
    echo "<html>\n";
    echo "<head><title>$mod_name: Copyright Information</title></head>\n";
    echo "<body bgcolor=\"#FFFFFF\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n<tr>\n";
    echo "<td width=\"100%\" align=\"center\"><font size=\"2\" face=\"Arial, Helvetica\"><strong>Module Copyright &copy; Information</strong><br />";
    echo "$mod_name module for <a href=\"http://phpnuke.org\" target=\"new\">PHP-Nuke</a> / <a href=\"http://www.techgfx.com\" target=\"_blank\">Platinum Nuke Pro</a></font></td>\n";
    echo "</tr>\n</table>\n<hr>\n";
    echo "<font size=\"2\" face=\"Arial, Helvetica\">";
    echo "<strong>Module's Name:</strong> $mod_name<br />\n";
    if ($module_version != "") { echo "<strong>Module's Version:</strong> $module_version<br />\n"; }
    if ($release_date != "") { echo "<strong>Release Date:</strong> $release_date<br />\n"; }
    echo "<strong>Module's Cost:</strong> $mod_cost<br />\n";
    if ($license != "") { echo "<strong>License:</strong> $license<br />\n"; }
    if ($author_name != "") { echo "<strong>Author's Name:</strong> $author_name<br />\n"; }
    if ($author_email != "") { echo "<strong>Author's Email:</strong> $author_email<br />\n"; }
    if ($module_description != "") { echo "<strong>Module's Description:</strong> $module_description<br />\n"; }
    if ($author_homepage != "") { echo "<strong>Author's HomePage:</strong> <a href=\"$author_homepage\" target=\"new\">HomePage</a><br />\n"; }
    if ($download_location != "") { echo "<strong>Module's Download:</strong> <a href=\"$download_location\" target=\"new\">Download</a><br />\n"; }
    if ($forum != "") { echo "<strong>Forum Location:</strong><a href=\"$beta_forum\" target=\"new\">Forum</a><br />\n"; }
    echo "<hr><center>[<a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close Window</a>]<br />\n";
    echo "</font>\n";
    echo "</body>\n";
    echo "</html>";
}

show_copyright();

?>

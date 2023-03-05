<?php
/*Modified by nukeSEO from http://nukeSEO.com, adapted from the MetaTag module by http://visayas.dk at 20-Jan-10 22:43:56*/


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

if (stristr($_SERVER['SCRIPT_NAME'], "meta.php")) {
    Header("Location: ../index.php");
    die();
}

##################################################
# Include for Meta Tags generation               #
##################################################

echo '<meta http-equiv=\'expires\' content=\'0\' />'."\n";
echo '<meta name=\'resource-type\' content=\'document\' />'."\n";
echo '<meta name=\'distribution\' content=\'global\' />'."\n";
echo '<meta name=\'author\' content=\'PHP-Nuke Platinum\' />'."\n";
echo '<meta name=\'copyright\' content=\'Copyright (c) by PHP-Nuke Platinum\' />'."\n";
echo '<meta name=\'keywords\' content=\'PHP-Nuke Platinum, Nuke,Web Site,Nuke,PHP-Nuke,phpnuke,Platinum Nuke Pro,PHPNuke Platinum,Platinum,nuke platinum,Platinum,Downloads,Forums, Web Links, PHP\' />'."\n";
echo '<meta name=\'description\' content=\'PHP-Nuke Platinum v3.0.0 - Expect To Be Impressed!\' />'."\n";
echo '<meta name=\'robots\' content=\'index, follow\' />'."\n";
echo '<meta name=\'revisit-after\' content=\'1 days\' />'."\n";
echo '<meta name=\'rating\' content=\'general\' />'."\n";

###############################################
# DO NOT REMOVE THE FOLLOWING COPYRIGHT LINE! #
# YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS. #
###############################################

// IF YOU REALLY NEED TO REMOVE IT AND HAVE MY WRITTEN AUTHORIZATION CHECK: http://phpnuke.org/modules.php?name=Commercial_License
// PLAY FAIR AND SUPPORT THE DEVELOPMENT, PLEASE!

echo '<meta name=\'generator\' content=\'PHP-Nuke Copyright (c) 2004 by Francisco Burzi. This is free software, and you may redistribute it under the GPL (http://phpnuke.org/files/gpl.txt). PHP-Nuke comes with absolutely no warranty, for details, see the license (http://phpnuke.org/files/gpl.txt). Powered by PHP-Nuke Platinum v3.0.0 (https://platinum.86it.us)\' />'."\n";
?>
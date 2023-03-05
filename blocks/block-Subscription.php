<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2001 by Francisco Burzi (fbc@mandrakesoft.com)         */
/* http://phpnuke.org                                                   */
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
/************************************************************************/
if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}
global $prefix, $db, $sitename, $subscription_url, $user, $cookie, $nukeurl;
if (paid()) {
    cookiedecode($user);
    $sql = 'SELECT * FROM '.$prefix.'_subscriptions WHERE userid='.intval($cookie[0]);
    $query = $db->sql_query($sql);
    $row = $db->sql_fetchrow($query);
    if (!empty($subscription_url)) {
        $content = '<center>'._YOUARE.' <a href="'.$subscription_url.'">'._SUBSCRIBER.'</a> '._OF.' '.$sitename.'<br />';
    } else {
        $content = '<center>'._YOUARE.' '._SUBSCRIBER.' '._OF.' '.$sitename.'<br />';
    }
    $diff = $row['subscription_expire']-time();
    $yearDiff = floor($diff/60/60/24/365);
    $diff -= $yearDiff*60*60*24*365;
    if ($yearDiff < 1) {
        $diff = $row['subscription_expire']-time();
    }
    $daysDiff = floor($diff/60/60/24);
    $diff -= $daysDiff*60*60*24;
    $hrsDiff = floor($diff/60/60);
    $diff -= $hrsDiff*60*60;
    $minsDiff = floor($diff/60);
    $diff -= $minsDiff*60;
    $secsDiff = $diff;
    if ($yearDiff < 1) {
        $rest = $daysDiff.' '._SBDAYS.'<br />'.$hrsDiff.' '._SBHOURS.'<br />'.$minsDiff.' '._SBMINUTES.'<br />'.$secsDiff.' '._SBSECONDS;
    } elseif ($yearDiff == 1) {
        $rest = $yearDiff.' '._SBYEAR.'<br />'.$daysDiff.' '._SBDAYS.'<br />'.$hrsDiff.' '._SBHOURS.'<br />'.$minsDiff.' '._SBMINUTES.'<br />'.$secsDiff.' '._SBSECONDS;
    } elseif ($yearDiff > 1) {
        $rest = $yearDiff.' '._SBYEARS.'<br />'.$daysDiff.' '._SBDAYS.'<br />'.$hrsDiff.' '._SBHOURS.'<br />'.$minsDiff.' '._SBMINUTES.'<br />'.$secsDiff.' '._SBSECONDS;
    }
    $content .= '<br /><strong>'._SUBEXPIREIN.'<br /><br /><font color="#FF0000">'.$rest.'</font></strong></center>';
} else {
    if (empty($subscription_url)) { 
        $temp_url = $nukeurl;
    } else {
        $temp_url = $subscription_url;
    }
    $content = '<center>'._NOTSUB.' '.$sitename.' '._SUBFROM.' <a href="'.$temp_url.'">'._HERE.'</a> '._NOW.'</center>';
}
?>

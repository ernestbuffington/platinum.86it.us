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

// Page HTML-source encrypter
// (c) Sergey Kozub, skiv@softhome.net, http://cleverscripts.com

if (stristr($_SERVER['SCRIPT_NAME'], "csource.php")) {
    die ("Access Denied");
}

function _fwk_filter_encrypt($content) 
{ 
  $table = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_@"; 
  $xor = 165; 

  // Prepare encoding table 
  $table = array_keys(count_chars($table, 1)); 
  $i_min = min($table); 
  $i_max = max($table); 
  for ($c = count($table); $c > 0; $r = mt_rand(0, $c--)) 
    array_splice($table, $r, $c - $r, array_reverse(array_slice($table, $r, $c - $r))); 
     
  // Encode sequence 
  $len = strlen($content); 
  $word = $shift = 0; 
  for ($i = 0; $i < $len; $i++) 
  { 
    $ch = $xor ^ ord($content[$i]); 
    $word |= ($ch << $shift); 
    $shift = ($shift + 2) % 6; 
    $enc .= chr($table[$word & 0x3F]); 
    $word >>= 6; 
    if (!$shift) 
    { 
      $enc .= chr($table[$word]); 
      $word >>= 6; 
    } 
  } 
  if ($shift) 
    $enc .= chr($table[$word]); 

  // Decode sequence 
  $tbl = array_fill($i_min, $i_max - $i_min + 1, 0); 
  while (list($k,$v) = each($table)) 
    $tbl[$v] = $k; 
  $tbl = implode(",", $tbl); 
   
  $fi = ",p=0,s=0,w=0,t=Array({$tbl})"; 
  $f  = "w|=(t[x.charCodeAt(p++)-{$i_min}])<<s;"; 
  
  $f .= "if(s){r+=String.fromCharCode({$xor}^w&255);w>>=8;s-=2}else{s=6}"; 
   
  // Generate page 
  $r = "<script language=JavaScript>"; 
  $r.= "function decrypt_p(x){";
  $r.= "var l=x.length,b=1024,i,j,r{$fi};"; 
  $r.= "for(j=Math.ceil(l/b);j>0;j--){r='';for(i=Math.min(l,b);i>0;i--,l--){{$f}}document.write(r)}"; 
  $r.= "}decrypt_p(\"{$enc}\")"; 
  $r.= "</script>"; 
  return $r; 
} 
ob_start("_fwk_filter_encrypt"); 

?> 
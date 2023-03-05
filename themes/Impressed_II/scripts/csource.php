<?php

/************************************************************************/
/* PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/* Refer to TechGFX.com for detailed information on PHP-Nuke Platinum   */
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */
/************************************************************************/

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
<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('YA_ADMIN')) 
{
   header('Location: ../../../index.php');
  die ();
}

if (($radminsuper==1) OR ($radminuser==1)) {
    $pagetitle = ": "._USERADMIN." - "._DELFIELD;
    include_once('header.php');
    title(_USERADMIN." - "._DELFIELD);
    amain();
    echo '<br />';
    OpenTable();
  	echo '<center><table border="0">';
    echo '<form action="'.$admin_file.'.php?op=yaDelFieldConf" method="post">';
    echo '<tr><td>'._CONFIRMDELLFIELD.' '.$fid.' ?</td></tr>';
	echo '';
	echo '<tr><td align="center"><input type="hidden" name="fid" value="'.$fid.'"><input type="submit" value="'._DELFIELD.'"></td></tr>';
    echo '</form>';
    echo '<form action="'.$admin_file.'.php?op=yaCustomFields" method="post">';
    echo '<tr><td align="center"><input type="submit" value="'._CANCEL.'"></td></tr>';
    echo '</form>';
    echo '</table>';
    CloseTable();
    include_once('footer.php'); 
}
?>
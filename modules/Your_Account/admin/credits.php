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
if (!defined('YA_ADMIN')) {
   header('Location: ../../../index.php');
  die ();
}
if (($radminsuper==1) OR ($radminuser==1)) {
    $pagetitle = ': '._USERADMIN.' - '._ADDUSER;
	include_once 'header.php';
    title(_USERADMIN." - "._ADDUSER);
    amain();
    echo '<br />';
    OpenTable();
	readfile('modules/'.$module_name.'/credits.html');
#	$creditsHTML = file_get_contents('modules/'.$module_name.'/credits.html');
#	$creditsHTML = file_get_contents('modules/Your_Account/credits.html');
#	preg_match("#<body>(.*)</body>#i", $creditsHTML, $credits);
#	echo $credits[1];
    CloseTable();
	include_once 'footer.php';
}
?>
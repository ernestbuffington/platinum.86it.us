<?php
/**************************************************************************/
/* Copyright (c) 2011, Platinum Nuke Pro 
/* By DocHaVoC  http://www.havocst.net
/* Colorbox mod for Platinum Nuke Pro
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
if (stristr($_SERVER['SCRIPT_NAME'], "head-marquee.php")) {

    Header("Location: ../index.php");

    die();

}
addCSSToHead('includes/jquery/css/jquery.marquee.css','file');
addJSToHead('includes/jquery/lib/jquery.marquee.js','file');
$inlinemqJS = '<script type="text/javascript"> $(document).ready(function (){ $("#marquee").marquee(); }); </script>'."\n";
addJSToBody($inlinemqJS,'inline');
?>
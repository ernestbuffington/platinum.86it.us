<?php
/************************************************************************
* Script:     TegoNuke(tm) ShortLinks for forumsbackend.php
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2007 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
//http://montegoscripts/modules.php?name=Forums&file=viewtopic&p=1023#1023

$urlin = array(
'"modules.php\?name=Forums&amp;file=viewtopic&amp;p=([0-9]*)"',
'"modules.php\?name=Forums"'
);

$urlout = array(
'ftopicp-\\1.html',
'forums.html'
);

?>
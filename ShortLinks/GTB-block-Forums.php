<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for the block-Forums.php
*             block file.
* Version:    1.0.1
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006-2007 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;t=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums(?!&)"'
);

$urlout = array(
'ftopict-\\1.html',
'forums.html'
);

?>
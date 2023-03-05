<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for NSN GR Downloads v1.0.3pl1
*             from http://www.nukescripts.net.
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=PrivateDownloads&amp;op=getit&amp;lid=([0-9]*)"'
);

$urlout = array(
'download-file-\\1.html'
);

?>

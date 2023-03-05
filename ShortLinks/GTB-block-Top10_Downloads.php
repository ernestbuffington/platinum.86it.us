<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for the block-Top10_Downloads.php 
*             block file.
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=([0-9]*)&amp;ttitle=([/:\-\'{}()\,\._&amp;a-zA-Z0-9+= ]*)"'
);

$urlout = array(
'downloadview-details-\\1-\\2.html'
);

?>
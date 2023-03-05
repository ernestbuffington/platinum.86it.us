<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for the block-Encyclodepia.php 
*             block file.
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=list_content&amp;eid=([0-9]*)"'
);

$urlout = array(
'encyclopedia-list-\\1.html'
);

?>
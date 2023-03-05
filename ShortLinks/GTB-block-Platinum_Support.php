<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for the block-Platinum_Support.php 
*             block file.
* Version:    1.0
* Author:     Tom Gates aka sgtmudd http://platinumnukepro.com
* Contact:    sgtmudd@platinumnukepro.com
* Copyright:  Copyright © 2017 by PlatinumNukePro.com
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Your_Account&amp;op=([a-z_]*)"'
);

$urlout = array(
'account-\\1.html'
);

?>
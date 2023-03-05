<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for the block-User_Info.php
*             block file.
* Version:    1.0.1
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006-2007 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Private_Messages&amp;mode=post&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Private_Messages"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=([a-z_]*)"',
'"(?<!/)\?gfx=gfx&amp;random_num=([0-9]*)"'
);

$urlout = array(
'userinfo-\\1.html',
'forum-userprofile-\\1.html',
'messages-post-\\1.html',
'messages.html',
'account-\\1.html',
'account-gfx-\\1.html'
);

?>
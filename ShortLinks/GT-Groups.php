<?php
/************************************************************************
* Script:     GoogleTap/TegoNuke(tm) ShortLinks "Module Tap" for Groups (NSN Groups).
* Version:    1.0
* Author:     Rob Herder (aka: montego) of montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Groups&amp;op=GRInfo&amp;gid=([0-9]*)"',
'"(?<!/)modules.php\?name=Groups"'
);

$urlout = array(
'groups-\\1.html',
'groups.html'
);

?>
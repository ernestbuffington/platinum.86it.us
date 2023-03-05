<?php
/************************************************************************
* Script:     TegoNuke(tm) ShortLinks
* Version:    1.1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2007 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
* Comments:   This should work with ShortLinks version 1.0 on up.
************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Affiliates&amp;op=SPGo&amp;site_id=([0-9]*)"',
'"(?<!/)modules.php\?name=Affiliates&amp;op=SPSubmit"',
'"(?<!/)modules.php\?name=Affiliates(?!&)"'
);

$urlout = array(
'affiliates-site\\1.html',
'affiliates-submit.html',
'affiliates.html'
);

?>

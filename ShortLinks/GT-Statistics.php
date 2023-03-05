<?php
/************************************************************************
* Script:     TegoNuke(tm) ShortLinks
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
//GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
//Original Nukecops GoogleTap done by NukeCops (http://www.nukecops.com)

$urlin = array(
'"(?<!/)modules.php\?name=Statistics&amp;op=DailyStats&amp;year=([0-9]*)&amp;month=([0-9]*)&amp;date=([0-9]*)"',
'"(?<!/)modules.php\?name=Statistics&amp;op=MonthlyStats&amp;year=([0-9]*)&amp;month=([0-9]*)"',
'"(?<!/)modules.php\?name=Statistics&amp;op=YearlyStats&amp;year=([0-9]*)"',
'"(?<!/)modules.php\?name=Statistics&amp;op=Stats"',
'"(?<!/)modules.php\?name=Statistics"'
);

$urlout = array(
'stats-\\1-\\2-\\3.html',
'stats-\\1-\\2.html',
'stats-\\1.html',
'advstats.html',
'stats.html'
);

?>
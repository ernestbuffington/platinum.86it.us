<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for the block-Survey.php
*             block file.
* Version:    1.0.1
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006-2007 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Surveys&amp;op=results&amp;pollID=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;op=results&amp;pollID=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys"'
);

$urlout = array(
'survey-results-\\1-\\2-\\3-\\4.html',
'survey-results-\\1.html',
'surveys.html'
);

?>
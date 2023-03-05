<?php
/************************************************************************/
/*Thanks Module css/xhtml  By DocHaVoC http://www.havocst.net           */
/* Platinum Nuke Pro: Expect to be impressed                            */ 
/* Copyright (c) 2011, Platinum Nuke Pro   http://platinumnukepro.com      */
/* By DocHaVoC  http://www.havocst.net                                  */
/* Refer to platinumnukepro.com for detailed information on Platinum Nuke Pro*/
/* PlatinumNuke: Your dreams, our imagination                           */
/************************************************************************/
if (!defined('MODULE_FILE')) die ('You can\'t access this file directly...');
define('INDEX_FILE', true); // Make it false if you dont want the right blocks to be visible
include_once('header.php');

OpenTable();
include_once('thanks.html');
CloseTable();

include_once('footer.php');

?>
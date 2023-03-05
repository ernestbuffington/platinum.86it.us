<?php

######################################################################
# PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT
#
# Copyright (c) 2004 - 2006 by http://www.techgfx.com
# Techgfx - Graeme Allan                       (goose@techgfx.com)
#
# Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de
# MrFluffy - Axel Conrads                 (axel@conrads-berlin.de)
#
# Copyright (c) 2004 - 2006 by http://www.nukeplanet.com
#  Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)
#
# Refer to Nukeplanet.com for detailed information on PHP-Nuke Platinum
#
# TechGFX: Your dreams, our imagination
######################################################################

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}

$platinum_loc = "../..";
$platinum_mod = "Surveys";
$platinum_url = "modules/$platinum_mod/images/admin";
$platinum_img = "$platinum_loc/$platinum_url/surveys.gif";

global $admin_file;
adminmenu("".$admin_file.".php?op=create", ""._ADMPOLLS."", "$platinum_img");

?>

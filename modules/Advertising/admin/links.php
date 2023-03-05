<?php

/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    PCN AdsPlus v2.0 -- by Pc-Nuke! --  www.pcnuke.com                */
/************************************************************************/
/*    Created by PcNuke.com -- Released on: 06.10.20. y.m.d             */
/*    http://www.max.pcnuke.com  --  http://www.pcnuke.com              */
/*    All Rights Reserved 2006 -- by Pc-Nuke!                           */
/*    No Modding, Porting, Changing, or Distribution of this program    */
/*    is allowed without written permission from www.pcnuke.com         */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/
/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.max.pcnuke.com/modules.php?name=GNU_GPL                 */
/************************************************************************/
/*         Always Backup your file system and database before           */
/*      doing any type of installation or changes such as these.        */
/*      Failure to do so may end up costing you much repair time        */
/************************************************************************/
 
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $admin_file;
if ($radminsuper == 1) {
    adminmenu($admin_file.'.php?op=BannersAdmin', _ADVERTISING, 'ads.png');
}

?>
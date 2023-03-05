<?php
// Remove install files - sgtmudd
	$installCleanup = "../manual_install_cleanup.php";
	@unlink($installCleanup);
	$setPermissions = "../setpermissions.php";
	@unlink($setPermissions);
    $dir1 = '../install/includes/';
    foreach(glob($dir1.'*.*') as $v){
    @unlink($v);
    }
	@rmdir('../install/includes');
	$dir2 = '../install/sql/';
    foreach(glob($dir2.'*.*') as $v){
    @unlink($v);
    }
	@rmdir('../install/sql');
	$dir3 = '../install/';
    foreach(glob($dir3.'*.*') as $v){
    @unlink($v);
    }
	@rmdir('../install');
	echo '<b>Installation files/folders removed...</b><br /><br />';
?>
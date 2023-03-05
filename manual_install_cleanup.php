<?php
// start - remove install folder - sgtmudd
	$setPermissions = "setpermissions.php";
	@unlink($setPermissions);
    $dir1 = 'install/includes/';
    foreach(glob($dir1.'*.*') as $v){
    @unlink($v);
    }
	rmdir('install/includes');
	$dir2 = 'install/sql/';
    foreach(glob($dir2.'*.*') as $v){
    @unlink($v);
    }
	rmdir('install/sql');
	$dir3 = 'install/';
    foreach(glob($dir3.'*.*') as $v){
    @unlink($v);
    }
	rmdir('install');
	echo 'Installation files/folders removed...<br /><br />';
// remove ip2country install files/folders
	$dir4 = 'ip2c/';
    foreach(glob($dir4.'*.*') as $v){
    @unlink($v);
    }
	rmdir('ip2c');
	$installFile = "ip2country.php";
	@unlink($installFile);
	echo 'Ip2Country files/folders removed...<br /><br />';
// remove member application files/folders
	$installFile = "MA_Install_214.php";
	@unlink($installFile);
	echo 'Member Application install files/folders removed...<br /><br />';
	echo 'Clean up complete. Click <a href="index.php">HERE</a> to continue.<br />(You can now delete this file also: "manual_install_cleanup.php")';
?>
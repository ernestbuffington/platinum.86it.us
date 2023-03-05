<?php
/***********************************************************************/
/*wysiwyg editor and dbi conversion added/completed by DocHaVoC#0003262012*/
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/

if (!preg_match("/modules.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = " - $module_name";
require_once("modules/$module_name/ns_downloads_file.php");



function ns_directory($type) {
global $prefix, $db, $module_name;
$result = $db->sql_query("select ns_dl_file_dir, ns_dl_image_dir from ".$prefix."_ns_downloads_upload");
list($ns_dl_file_dir, $ns_dl_image_dir) = $db->sql_fetchrow($result);
    if ($type == "file") {
	$ns_directory = "modules/$module_name/".$ns_dl_file_dir;
	
	
	if (!file_exists($ns_directory)) { 
	    if (!@mkdir($ns_directory, 0755)) {
	        ns_upload_head();
	        echo "<br /><br />";	
	        echo _NSPERMFILEERROR;
	        echo "<br /><br />";
	        ns_upload_foot();
	        die();
	    }
	}
	
	
    } elseif ($type == "image") {
	$ns_directory = "modules/$module_name/".$ns_dl_image_dir;
	
	
	if (!file_exists($ns_directory)) { 
	    if (!@mkdir($ns_directory, 0755)) {
	        ns_upload_head();
	        echo "<br /><br />";	
	        echo _NSPERMIMGERROR;
	        echo "<br /><br />";
	        ns_upload_foot();
	        die();
	    }
	}
	
	
    }
return ($ns_directory);
}



function ns_perm_dir_check($type) {
global $prefix, $db;
$ns_directory = ns_directory($type);
clearstatcache();
    if (($type == "file") && (!preg_match("/777/",decoct(fileperms($ns_directory))))) {
		if (!@chmod("$ns_directory", 0777)) {
	    	ns_upload_head();
	    	echo "<br /><br />";	
	    	echo _NSPERMFILEERROR;
	    	echo "<br /><br />";
	    	ns_upload_foot();
	    	die();
		}
    } elseif (($type == "image") && (!preg_match("/777/",decoct(fileperms($ns_directory))))) {
		if (!@chmod("$ns_directory", 0777)) {
	    	ns_upload_head();
	    	echo "<br /><br />";	
	    	echo _NSPERMIMGERROR;
	    	echo "<br /><br />";
	    	ns_upload_foot();
	    	die();
		}
    }
}



function ns_last($get) {
$pos = strrpos($get,".");
$lastext = substr($get,$pos+1);
return $lastext;
}



function ns_display_ext($type) {
global $prefix, $db;
$result_ext = $db->sql_query("select ns_dl_file_ext, ns_dl_image_ext from ".$prefix."_ns_downloads_upload");
list($ns_dl_file_ext, $ns_dl_image_ext) = $db->sql_fetchrow($result_ext);
    if ($type == "file") {
        $ns_dl_file_ext = explode(" ", $ns_dl_file_ext);
        for ($i = 0; $i < count($ns_dl_file_ext); $i++) {
    	if (($i <> count($ns_dl_file_ext)-1)) $sep = " - "; else $sep = "";
    	list($key, $exten) = each($ns_dl_file_ext);
    	echo $exten.$sep;
        }
    } elseif ($type == "image") {
        $ns_dl_image_ext = explode(" ", $ns_dl_image_ext);
        for ($i = 0; $i < count($ns_dl_image_ext); $i++) {
    	if (($i <> count($ns_dl_image_ext)-1)) $sep = " - "; else $sep = "";
    	list($key, $exten) = each($ns_dl_image_ext);
	echo $exten.$sep;
        }
    }	 
}



function ns_display_size($type) {
global $prefix, $db;
$result_gs = $db->sql_query("select ns_dl_file_size, ns_dl_image_size from ".$prefix."_ns_downloads_upload");
list($ns_dl_file_size, $ns_dl_image_size) = $db->sql_fetchrow($result_gs);
	if ($type == "file") {
    	$ns_size_b = $ns_dl_file_size;	
	} elseif ($type == "image") {	
    	$ns_size_b = $ns_dl_image_size;
	}
$ns_size_kb = $ns_size_b / 1024;
$ns_size_mb = $ns_size_kb / 1024;
$ns_size_gb = $ns_size_mb / 1024;
	if ($ns_size_b > 1) {
    	$ns_size = round($ns_size_b,2) . "b";
	}
	if ($ns_size_kb > 1) {
    	$ns_size = round($ns_size_kb,2) . "kb";
	}
	if ($ns_size_mb > 1) {
    	$ns_size = round($ns_size_mb,2) . "mb";
	}
	if ($ns_size_gb > 1) {
    	$ns_size = round($ns_size_gb,2) . "gb";
	}
return $ns_size;
}



function ns_upload_head() {
global $sitename;
$ns_theme = get_theme();
echo "<html>";
echo "<head>";
echo "<title>$sitename "._NSEDLUPFORM."</title>";
echo "<link rel=\"stylesheet\" href=\"themes/$ns_theme/style/style.css\" type=\"text/css\">";
echo "</head>";
echo "<body>";
echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">";
echo "<tr height=\"80%\"><td align=\"center\">";
}



function ns_upload_foot() {
echo "</td></tr>";	
echo "<tr height=\"20%\"><td align=\"center\" valign=\"baseline\"><br />";
echo "<font class=\"content\">";
echo "Enhanced Download Module V2.3<br />&copy;Copyright 2007 ";
echo "<a href=\"http://www.platinumnukepro.com.com\" target=\"_blank\">platinumnukepro.com</a>";
echo "</font>";
echo "</td></tr>";
echo "</table>";
echo "</body>";
echo "</html>";
}



function ns_upload_form($type) {
global $prefix, $db;
ns_upload_head();
echo "<br /><table cellspacing=\"0\" cellpadding=\"3\" border=\"0\" align=\"center\">";
echo "<tr><td align=\"center\">";
echo "<font class=\"title\">";
	if ($type == "file") {
		echo ""._NSUPLOADDLFILE." ";	
	} elseif ($type == "image") {	
		echo ""._NSUPLOADDESCIMG." ";
	}
echo "</font>";
echo "</td></tr>";
echo "<tr><td align=\"center\">";
echo "<font class=\"tiny\">"._NSTYPESALLOWED.": ";	
ns_display_ext($type);
echo "</font>";
echo "</td></tr>";
echo "</table>";
echo "<form method=\"post\" enctype=\"multipart/form-data\">";
echo "<table cellspacing=\"0\" cellpadding=\"3\" border=\"0\" align=\"center\">";
echo "<tr><td align=\"center\">";
	if ($type == "file") {
		echo "<font class=\"content\"><strong>"._NSFILENAME.":</strong></font>";
		echo "<font class=\"tiny\"> "._NSMAXFILESIZE." ";
		echo ns_display_size($type)." )</font>";	
	} elseif ($type == "image") {		
		echo "<font class=\"content\"><strong>"._NSIMAGENAME.":</strong></font>";
		echo "<font class=\"tiny\"> "._NSMAXIMGSIZE." ";
		echo ns_display_size($type)." )</font>";
	}
echo "</td></tr>";
echo "<tr><td align=\"center\">";
echo "<input type=\"file\" name=\"fileupload\" size=\"30\"></td></tr>";
echo "<tr><td>&nbsp;</tr><tr>";
echo "<td align=\"center\">";
$ns_directory = ns_directory($type);
echo "<input type=\"hidden\" name=\"op\" value=\"ns_upload_file\">";
echo "<input type=\"hidden\" name=\"type\" value=\"$type\">";
echo "<input type=\"hidden\" name=\"ns_directory\" value=\"$ns_directory\">";
echo "<input type=\"submit\" value=\""._NSBUPLOAD."\">&nbsp;&nbsp;&nbsp;";
echo "<input type=\"reset\" value=\""._NSBCLEAR."\">&nbsp;&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSDLCLOSE."\" onclick=\"window.close()\">";
echo "</td></tr>";
echo "<tr><td>&nbsp;</tr><tr>";
echo "<tr><td><font class=\"tiny\">"._NSUPADDNOTE."</font></td></tr>";
echo "</table></form>";
ns_upload_foot();
}



function ns_upload($type) {
global $prefix, $db;
ns_perm_dir_check($type);	
ns_upload_form($type);
}



function ns_upload_file($type, $fileupload, $ns_directory) {
global $prefix, $db, $module_name, $nukeurl;
$result_gs = $db->sql_query("select ns_dl_file_size, ns_dl_image_size, ns_dl_file_ext, ns_dl_image_ext from ".$prefix."_ns_downloads_upload");
list($ns_dl_file_size, $ns_dl_image_size, $ns_dl_file_ext, $ns_dl_image_ext) = $db->sql_fetchrow($result_gs);
$ns_copy = "";
$ns_path = $ns_directory."/";
$ns_tmp_name = $_FILES[fileupload][tmp_name];
$ns_name = $_FILES[fileupload][name];
$ns_size = $_FILES[fileupload][size];
$ns_copy = $ns_path.$ns_name;
ns_upload_head();
echo "<table cellspacing=\"0\" cellpadding=\"6\" border=\"0\" align=\"center\">";
echo "<tr><td align=\"center\">";
if ($type == "file") {
    $ns_dl_file_ext = explode(" ", $ns_dl_file_ext);
    for($i = 0; $i < count($ns_dl_file_ext); $i++) {
        if(ns_last($ns_name) != $ns_dl_file_ext[$i])
        $test.= "~~";
    }
    $exp = explode("~~",$test);
    if(count($exp) == (count($ns_dl_file_ext)+1)) {	
    echo "<br /><br /><br /><font class=\"title\">"._NSDLUPERROR."</font><br /><br />";
    echo "<div align=\"justify\"><font class=\"content\">"._NSEXTFILEERROR." - ";
    echo "<strong>( .".ns_last($ns_name)." )</strong> - "._NSEXTFILEERROR2."</font></div><br /><br />";
    echo "<a href=\"$nukeurl/modules.php?name=Downloads";
    echo "&amp;file=ns_uploads_file&amp;type=$type\">"._NSGOBACKFORM."</a>";
    echo "<br /><br /><br /><br /><br /><br /></td></tr></table>";
    ns_upload_foot();
    die();
    }
} elseif ($type == "image") {
    $ns_dl_image_ext = explode(" ", $ns_dl_image_ext);
    for($i = 0; $i < count($ns_dl_image_ext); $i++) {
        if(ns_last($ns_name) != $ns_dl_image_ext[$i])
        $test.= "~~";
    }
    $exp = explode("~~",$test);
    if(count($exp) == (count($ns_dl_image_ext)+1)) {	
    	echo "<br /><br /><br /><font class=\"title\">"._NSDLUPERROR."</font><br /><br />";
    	echo "<div align=\"justify\"><font class=\"content\">"._NSEXTIMGERROR." - ";
    	echo "<strong>( .".ns_last($ns_name)." )</strong> - "._NSEXTIMGERROR2."</font></div><br /><br />";
    	echo "<a href=\"$nukeurl/modules.php?name=Downloads";
    	echo "&amp;file=ns_uploads_file&amp;type=$type\">"._NSGOBACKFORM."</a>";
    	echo "<br /><br /><br /><br /><br /><br /></td></tr></table>";
    	ns_upload_foot();
    	die();
    }	
}
if (file_exists($ns_copy)) {
	echo "<br /><br /><br /><font class=\"title\">"._NSDLUPERROR."</font><br /><br />";
    	if ($type == "file") {
			echo "<div align=\"justify\"><font class=\"content\">";
			echo ""._NSSAMEFILEERROR."</font></div><br /><br />";
    	} elseif ($type == "image") {
			echo "<div align=\"justify\"><font class=\"content\">";
			echo ""._NSSAMEIMGERROR."</font></div><br /><br />";
    	}
	echo "<a href=\"$nukeurl/modules.php?name=Downloads";
	echo "&amp;file=ns_uploads_file&amp;type=$type\">"._NSGOBACKFORM."</a>";
	echo "<br /><br /><br /><br /><br /><br /></td></tr></table>";
	ns_upload_foot();
	die();
}
if ($type == "file") {
    if($ns_size > $ns_dl_file_size) {	
    	echo "<br /><br /><br /><font class=\"title\">"._NSDLUPERROR."</font><br /><br />";
    	echo "<div align=\"justify\"><font class=\"content\">"._NSSIZEFILEERROR." ";
    	echo "<strong>".ns_display_size($type)."</strong>.</font></div><br /><br />";
    	echo "<a href=\"$nukeurl/modules.php?name=Downloads";
    	echo "&amp;file=ns_uploads_file&amp;type=$type\">"._NSGOBACKFORM."</a>";
    	echo "<br /><br /><br /><br /><br /><br /></td></tr></table>";
    	ns_upload_foot();
    	die();
    }
} elseif ($type == "image") {
    if($ns_size > $ns_dl_image_size) {
    echo "<br /><br /><br /><font class=\"title\">"._NSDLUPERROR."</font><br /><br />";
    echo "<div align=\"justify\"><font class=\"content\">"._NSSIZEIMGERROR." ";
    echo "<strong>".ns_display_size($type)."</strong>.</font></div><br /><br />";
    echo "<a href=\"$nukeurl/modules.php?name=Downloads";
    echo "&amp;file=ns_uploads_file&amp;type=$type\">"._NSGOBACKFORM."</a>";
    echo "<br /><br /><br /><br /><br /><br /></td></tr></table>";
    ns_upload_foot();
    die();				
    }	
}
if (move_uploaded_file($ns_tmp_name,$ns_copy)) {
    if (!chmod("$ns_copy", 0644)) {
		echo "<br /><br /><br /><font class=\"title\">"._NSDLUPERROR."</font><br /><br />";
		echo "<div align=\"justify\"><font class=\"content\">";
		echo ""._NSCHMODERROR."</font></div><br /><br />";
		echo "<a href=\"$nukeurl/modules.php?name=Downloads";
		echo "&amp;file=ns_uploads_file&amp;type=$type\">"._NSGOBACKFORM."</a>";
		echo "<br /><br /><br /><br /><br /><br /></td></tr></table>";
		ns_upload_foot();
		die();				
    }
	echo"<br /><br /><font class=\"content\">The file: $ns_name - has been uploaded!</font><br /><br />";
    if ($type == "file") {
		echo "<script language=\"JavaScript\">\n";
		echo "function setForm() {\n";
		echo "opener.document.add_download.url.value = document.submit_file.fileurl.value;\n";
		echo "opener.document.add_download.filesize.value = document.submit_file.size.value;\n";
		echo "self.close();\n";
		echo "return false;\n";
		echo "}\n";
		echo "</script>\n";
		echo "<form name=\"submit_file\" onSubmit=\"return setForm();\">";
		echo "<input type=\"hidden\" name=\"fileurl\" value=\"$ns_copy\">";
		echo "<input type=\"hidden\" name=\"size\" value=\"$ns_size\">";
		echo "<br /><br /><input type=\"submit\" value=\"Submit\">";
		echo "</form>";	
    } elseif ($type == "image") {
	$result_rs = $db->sql_query("SELECT ns_dl_use_resize from ".$prefix."_ns_downloads_upload");
	list($ns_dl_use_resize) = $db->sql_fetchrow($result_rs);
    	if ($ns_dl_use_resize == 1) {
		$result = $db->sql_query("SELECT ns_dl_des_img_width, ns_dl_des_img_height from ".$prefix."_ns_downloads_desc_img");
		list($ns_dl_des_img_width, $ns_dl_des_img_height) = $db->sql_fetchrow($result);
		if (!$size_var = @getimagesize($ns_copy)) {
			echo '<br /><br /><br /><font class=\"title\">'._NSDLUPERROR.'</font><br /><br />';
			echo '<div align=\"justify\"><font class=\"content\">';
			echo 'Image does not exist, or is corrupt!<br />';
			echo 'Image is supposedly located at:'.$ns_copy;
			echo 'Please contact the Site Admin.</font></div><br /><br />';
			echo '<a href=\"'.$nukeurl.'/modules.php?name=Downloads';
			echo '&amp;file=ns_uploads_file&amp;type='.$type.'\">'._NSGOBACKFORM.'</a>';
			echo '<br /><br /><br /><br /><br /><br /></td></tr></table>';
			ns_upload_foot();
			die();				
		}
		if ($size_var[2] == "1" || $size_var[2] == "2" || $size_var[2] == "3") {
			$upload_loc = makeThumb($ns_copy, $ns_copy,$ns_path, "", "");
			if ($upload_loc[0] != "failed") {
			    makeThumb($upload_loc[0], $upload_loc[0],$ns_path.'thumb/',$ns_dl_des_img_width,$ns_dl_des_img_height);
			}
			if ($upload_loc[0] == "failed") {
				echo "<br /><br /><br /><font class=\"title\">";
				echo ""._NSDLUPERROR."</font><br /><br />";
				echo "<div align=\"justify\"><font class=\"content\">";
				echo "Image does not exist, or is corrupt!<br />";
				echo "Image is supposedly located at:'.$ns_copy.'<br />";
				echo "Please contact the Site Admin.</font></div><br /><br />";
				echo "<a href=\"$nukeurl/modules.php?name=Downloads";
				echo "&amp;file=ns_uploads_file&amp;type=$type\">"._NSGOBACKFORM."</a>";
				echo '<br /><br /><br /><br /><br /><br /></td></tr></table>';
				ns_upload_foot();
				@unlink($ns_copy);
				die();				
			} elseif ($upload_loc[0] == "folder_missing") {
				echo "<br /><br /><br /><font class=\"title\">";
				echo ""._NSDLUPERROR."</font><br /><br />";
				echo "<div align=\"justify\"><font class=\"content\">";
				echo "Folder \"'.$upload_loc[1].'\" does not exist!<br />";
				echo "Please contact the Site Admin.</font></div><br /><br />";
				echo "<a href=\"$nukeurl/modules.php?name=Downloads";
				echo "&amp;file=ns_uploads_file&amp;type=$type\">"._NSGOBACKFORM."</a>";
				echo "<br /><br /><br /><br /><br /><br /></td></tr></table>";
				ns_upload_foot();
				@unlink($ns_copy);
				die();				
			}
		} else {
			$upload_loc[0] = $ns_copy;
    	}
			echo "<script language=\"JavaScript\">\n";
			echo "function setForm() {\n";
			echo "opener.document.add_download.ns_des_img.value = document.submit_img.imgurl.value;\n";
			echo "self.close();\n";
			echo "return false;\n";
			echo "}\n";
			echo "</script>\n";
			echo "<form name=\"submit_img\" onSubmit=\"return setForm();\">";
			echo "<input type=\"hidden\" name=\"imgurl\" value=\"$upload_loc[0]\">";
			echo "<br /><br /><input type=\"submit\" value=\"Submit\">";
			echo "</form>";
		} else {
			echo "<script language=\"JavaScript\">\n";
			echo "function setForm() {\n";
			echo "opener.document.add_download.ns_des_img.value = document.submit_img.imgurl.value;\n";
			echo "self.close();\n";
			echo "return false;\n";
			echo "}\n";
			echo "</script>\n";
			echo "<form name=\"submit_img\" onSubmit=\"return setForm();\">";
			echo "<input type=\"hidden\" name=\"imgurl\" value=\"$ns_copy\">";
			echo "<br /><br /><input type=\"submit\" value=\"Submit\">";
			echo "</form>";	
		}
    }
} else {
    if ($type == "file") {
			echo "<br /><br /><br /><font class=\"title\">"._NSDLUPERROR."</font><br /><br />";
			echo "<center><font class=\"content\">"._NSUPFILEERROR."</font></center>";
			echo "<br /><br />";
			echo "<a href=\"$nukeurl/modules.php?name=Downloads";
			echo "&amp;file=ns_uploads_file&amp;type=$type\">"._NSGOBACKFORM."</a>";
			echo "<br /><br /><br /><br /><br /><br /></td></tr></table>";
			ns_upload_foot();
			die();
    } elseif ($type == "image") {
			echo "<br /><br /><br /><font class=\"title\">"._NSDLUPERROR."</font><br /><br />";
			echo "<center><font class=\"content\">"._NSUPIMGERROR."</font></center>";
			echo "<br /><br />";
			echo "<a href=\"$nukeurl/modules.php?name=Downloads";
			echo "&amp;file=ns_uploads_file&amp;type=$type\">"._NSGOBACKFORM."</a>";
			echo "<br /><br /><br /><br /><br /><br /></td></tr></table>";
			ns_upload_foot();
			die();				
    }
}				
echo "</td></tr></table>";
ns_upload_foot();
}



function makeThumb($srcFile, $dstFile, $folder, $dstW, $dstH) {
global $prefix, $db;
$result_np = $db->sql_query("SELECT ns_dl_netpath from ".$prefix."_ns_downloads_upload");
list($ns_dl_netpath) = $db->sql_fetchrow($result_np);
	if (!@is_dir($folder)) {
		$result=array('folder_missing', $folder);
	} else {
		$dstFile = end(explode('/',$dstFile));
		$dstFile = explode('.',$dstFile);
		$size_var = getimagesize($srcFile);
		$destXY = '-xysize ';
		if($dstW !='' && $dstH != '') {
			$destXY .= $dstW.' '.$dstH;
			$width = $dstW;
			$height = $dstH;
		} else {
			$destXY .= $size_var[0].' '.$size_var[1];
			$width = $size_var[0];
			$height = $size_var[1];
		}
		$final_image = "$folder$dstFile[0].";
		$npbmdir = $ns_dl_netpath;
		$npbm_exists = 'false';
		if(@is_dir($npbmdir)) {
			if(@file_exists($npbmdir.'jpegtopnm')) {
			    $npbm_exists = "true";
			}
		}
		if($npbm_exists == "true") {
			$result = npbmResize($srcFile, $final_image, $folder, $destXY, $size_var[2]);
		} else {
			$result = gdResize($srcFile, $final_image, $width, $height, $size_var[2]);
		}
		$result=array($result, $srcFile, $final_image, $width, $height, $size_var[2]);
	}
	return $result;
}



function gdResize($original_img, $dest_img, $width, $height, $type) {
	version();
	$var = gd_info();
	$var1 = explode('.',$var["GD Version"]);
	$pre = $var1[0];
	$suf = $var1[1][0];
	$ver = $pre.'.'.$suf;
	if($ver >= "2") {
	    $create=@ImageCreateTrueColor($width,$height);
	} else {
	    $create=@ImageCreate($width,$height);
	}
	if ($type == '2') {
		$source = @ImageCreateFromJPEG($original_img); 
	} elseif ($type == '3') {
		$source = @ImageCreateFromPNG($original_img);
	} elseif ($type == '1') {
		if(($ver >= '1.6') || (!function_exists(ImageCreateFromGIF))) {
			set_time_limit(90);
			include_once("modules/Downloads/ns_gif_file.php");
			if($gif = gif_loadFile($original_img)) {
				$png = $dest_img.'png';
				if(gif_outputAsPng($gif, $png)) {
					$source = @ImageCreateFromPNG($png);
					$type='3';
					@unlink($original_img);
				}
			}
		} else {
		    $source = @ImageCreateFromGif($original_img);
		}
	    }
	if($source) {
		if($ver >= '2') {
		    ImageCopyResampled($create, $source, 0, 0, 0, 0, $width, $height, ImageSX($source), ImageSY($source));
		} else {
		    ImageCopyResized($create, $source, 0, 0, 0, 0, $width, $height, ImageSX($source), ImageSY($source));
		}
		if($type=='2') {
			ImageJPEG($create, $dest_img.'jpg'); 
			$result = $dest_img.'jpg';
		} elseif($type=='3') {
			ImagePNG($create, $dest_img.'png'); 
			$result = $dest_img.'png';
		} elseif($type=='1') {
			ImageGIF($create, $dest_img.'gif');
			$result = $dest_img.'gif';
		}
	} else {
		$result = 'failed';
	}
	return $result;
}

function npbmResize($original_image, $dest_img, $folder, $destXY, $type) {
	$binpath = 'includes/netpbm/'; // path where netpbm resides
	$tmp1 = $folder.'tmp.ppm'; 
	$tmp2 = $folder.'tmp1.ppm'; 
	if($type == '2') {
		exec($binpath . "jpegtopnm ".$original_image." > $tmp1");
		exec($binpath . "pnmscale $destXY $tmp1 > $tmp2");
		if (file_exists($dest_img."jpg")) @unlink($dest_img."jpg");
		exec($binpath . "ppmtojpeg $tmp2 > ".$dest_img."jpg");
		@chmod($dest_img.'jpg', 0644);
		@unlink($tmp1);
		@unlink($tmp2);
		if (@filesize($dest_img.'jpg') != '0') {
			$result = $dest_img.'jpg';
		} else {
			$result = 'failed';
		}
	} elseif ($type == '3') {
		exec($binpath . "pngtopnm ".$original_image." > $tmp1");
		exec($binpath . "pnmscale $destXY $tmp1 > $tmp2");
		if (file_exists($dest_img."png")) @unlink($dest_img."png");
		exec($binpath . "pnmtopng $tmp2 > ".$dest_img."png");
		@chmod($dest_img.'png', 0644); 
		@unlink($tmp1);
		@unlink($tmp2);
		if (@filesize($dest_img.'png') != '0') {
			$result = $dest_img.'png';
		} else {
			$result = 'failed';
		}
	} elseif ($type == '1') {
		exec($binpath . "giftopnm ".$original_image." > $tmp1");
		exec($binpath . "pnmscale $destXY $tmp1 > $tmp2");
		if(file_exists($dest_img."gif")) @unlink($dest_img."gif");
		exec($binpath . "pnmtopng $tmp2 > ".$dest_img."png");
		@chmod($dest_img.'png', 0644); 
		@unlink($tmp1);
		@unlink($tmp2);
		if (@filesize($dest_img.'png') != '0') {
			$result = $dest_img.'png';
		} else {
			$result = 'failed';
		}
	}
	return $result;
}



function version() {
	$code = 'function gd_info() {
		 $array = Array(
						  "GD Version" => "",
						  "FreeType Support" => 0,
						  "FreeType Linkage" => "",
						  "T1Lib Support" => 0,
						  "GIF Read Support" => 0,
						"GIF Create Support" => 0,
						"JPG Support" => 0,
						  "PNG Support" => 0,
						  "WBMP Support" => 0,
						  "XBM Support" => 0
					   );
		   $gif_support = 0;
		   ob_start();
		   eval("phpinfo();");
		   $info = ob_get_contents();
		   ob_end_clean();
		   foreach(explode("\n", $info) as $line) {
			  if(strpos($line, "GD Version")!==false)
				  $array["GD Version"] = trim(str_replace("GD Version", "", strip_tags($line)));
			   if(strpos($line, "FreeType Support")!==false)
				  $array["FreeType Support"] = trim(str_replace("FreeType Support", "", strip_tags($line)));
			  if(strpos($line, "FreeType Linkage")!==false)
				  $array["FreeType Linkage"] = trim(str_replace("FreeType Linkage", "", strip_tags($line)));
			  if(strpos($line, "T1Lib Support")!==false)
				  $array["T1Lib Support"] = trim(str_replace("T1Lib Support", "", strip_tags($line)));
			  if(strpos($line, "GIF Read Support")!==false)
				  $array["GIF Read Support"] = trim(str_replace("GIF Read Support", "", strip_tags($line)));
			  if(strpos($line, "GIF Create Support")!==false)
				  $array["GIF Create Support"] = trim(str_replace("GIF Create Support", "", strip_tags($line)));
			  if(strpos($line, "GIF Support")!==false)
				  $gif_support = trim(str_replace("GIF Support", "", strip_tags($line)));
			   if(strpos($line, "JPG Support")!==false)
				   $array["JPG Support"] = trim(str_replace("JPG Support", "", strip_tags($line)));
			   if(strpos($line, "PNG Support")!==false)
				   $array["PNG Support"] = trim(str_replace("PNG Support", "", strip_tags($line)));
			   if(strpos($line, "WBMP Support")!==false)
				   $array["WBMP Support"] = trim(str_replace("WBMP Support", "", strip_tags($line)));
			   if(strpos($line, "XBM Support")!==false)
				   $array["XBM Support"] = trim(str_replace("XBM Support", "", strip_tags($line)));
		   }
		   
		  if($gif_support==="enabled") {
			   $array["GIF Read Support"]   = 1;
			   $array["GIF Create Support"] = 1;
		   }

		   if($array["FreeType Support"]==="enabled"){
			   $array["FreeType Support"] = 1;    }

		   if($array["T1Lib Support"]==="enabled")
			   $array["T1Lib Support"] = 1;     
		  
		   if($array["GIF Read Support"]==="enabled"){
			   $array["GIF Read Support"] = 1;    }

		   if($array["GIF Create Support"]==="enabled")
			   $array["GIF Create Support"] = 1;     

		   if($array["JPG Support"]==="enabled")
			   $array["JPG Support"] = 1;
			   
		   if($array["PNG Support"]==="enabled")
			   $array["PNG Support"] = 1;
			   
		   if($array["WBMP Support"]==="enabled")
			   $array["WBMP Support"] = 1;
			   
		   if($array["XBM Support"]==="enabled")
			   $array["XBM Support"] = 1;
		   
		   return $array;
	  }';
	if(!function_exists("gd_info")){
	    eval($code);
	}
}




switch($op) {

    default:
    ns_upload($type);
    break;

    case "ns_upload_file":
    ns_upload_file($type, $fileupload, $ns_directory);
    break;

}


?>

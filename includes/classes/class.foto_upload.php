<?php
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
class file_upload {

    var $the_file;
	var $the_temp_file;
    var $upload_dir;
	var $replace;
	var $do_filename_check;
	var $max_length_filename = 100;
    var $extensions;
	var $ext_string;
	var $language;
	var $http_error;
	var $rename_file; // if this var is true the file copy get a new name
	var $file_copy; // the new name
	var $message = array();
	var $create_directory = true;
	
	function file_upload() {
		$this->language = "en"; // choice of en, nl, es
		$this->rename_file = false;
		$this->ext_string = "";
	}
	function show_error_string($br = "<br />\n") {
		$msg_string = "";
		foreach ($this->message as $value) {
			$msg_string .= $value.$br;
		}
		return $msg_string;
	}
	function set_file_name($new_name = "") { // this "conversion" is used for unique/new filenames 
		if ($this->rename_file) {
			if ($this->the_file == "") return;
			$name = ($new_name == "") ? strtotime("now") : $new_name;
			sleep(3);
			$name = $name.$this->get_extension($this->the_file);
		} else {
			$name = str_replace(" ", "_", $this->the_file); // space will result in problems on linux systems
		}
		return $name;
	}
	function upload($to_name = "") {
		$new_name = $this->set_file_name($to_name);
		if ($this->check_file_name($new_name)) {
			if ($this->validateExtension()) {
				if (is_uploaded_file($this->the_temp_file)) {
					$this->file_copy = $new_name;
					if ($this->move_upload($this->the_temp_file, $this->file_copy)) {
						$this->message[] = $this->error_text($this->http_error);
						if ($this->rename_file) $this->message[] = $this->error_text(16);
						return true;
					}
				} else {
					$this->message[] = $this->error_text($this->http_error);
					return false;
				}
			} else {
				$this->show_extensions();
				$this->message[] = $this->error_text(11);
				return false;
			}
		} else {
			return false;
		}
	}
	function check_file_name($the_name) {
		if ($the_name != "") {
			if (strlen($the_name) > $this->max_length_filename) {
				$this->message[] = $this->error_text(13);
				return false;
			} else {
				if ($this->do_filename_check == "y") {
					if (preg_match("/^[a-z0-9_]*\.(.){1,5}$/i", $the_name)) {
						return true;
					} else {
						$this->message[] = $this->error_text(12);
						return false;
					}
				} else {
					return true;
				}
			}
		} else {
			$this->message[] = $this->error_text(10);
			return false;
		}
	}
	function get_extension($from_file) {
		$ext = strtolower(strrchr($from_file,"."));
		return $ext;
	}
	function validateExtension() {
		$extension = $this->get_extension($this->the_file);
		$ext_array = $this->extensions;
		if (in_array($extension, $ext_array)) { 
			// check mime type hier too against allowed/restricted mime types (boolean check mimetype)
			return true;
		} else {
			return false;
		}
	}
	// this method is only used for detailed error reporting
	function show_extensions() {
		$this->ext_string = implode(" ", $this->extensions);
	}
	function move_upload($tmp_file, $new_file) {
		if ($this->existing_file($new_file)) {
			$newfile = $this->upload_dir.$new_file;
			if ($this->check_dir($this->upload_dir)) {
				if (move_uploaded_file($tmp_file, $newfile)) {
					umask(0);
					chmod($newfile , 0644);
					return true;
				} else {
					return false;
				}
			} else {
				$this->message[] = $this->error_text(14);
				return false;
			}
		} else {
			$this->message[] = $this->error_text(15);
			return false;
		}
	}
	function check_dir($directory) {
		if (!is_dir($directory)) {
			if ($this->create_directory) {
				umask(0);
				mkdir($directory, 0777);
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	function existing_file($file_name) {
		if ($this->replace == "y") {
			return true;
		} else {
			if (file_exists($this->upload_dir.$file_name)) {
				return false;
			} else {
				return true;
			}
		}
	}
	function get_uploaded_file_info($name) {
		$str = "File name: ".basename($name)."\n";
		$str .= "File size: ".filesize($name)." bytes\n";
		if (function_exists("mime_content_type")) {
			$str .= "Mime type: ".mime_content_type($name)."\n";
		}
		if ($img_dim = getimagesize($name)) {
			$str .= "Image dimensions: x = ".$img_dim[0]."px, y = ".$img_dim[1]."px\n";
		}
		return $str;
	}
	// this method was first located inside the foto_upload extension
	function del_temp_file($file) {
		$delete = @unlink($file); 
		clearstatcache();
		if (@file_exists($file)) { 
			$filesys = preg_replace("#/#i","\\",$file); 
			$delete = @system("del $filesys");
			clearstatcache();
			if (@file_exists($file)) { 
				$delete = @chmod ($file, 0644); 
				$delete = @unlink($file); 
				$delete = @system("del $filesys");
			}
		}
	}
	// this function creates a file field and if $show_alternate is true it will show a text field if the given file already exists
	// there is also a submit button to remove the text field value 
	function create_file_field($element, $label = "", $length = 25, $show_replace = true, $replace_label = "Replace old file?", $file_path = "", $file_name = "", $show_alternate = false, $alt_length = 30, $alt_btn_label = "Delete image") {
		$field = ($label != "") ? "<label>".$label."</label>\n" : "";
		$file_field = "<input type=\"file\" name=\"".$element."\" size=\"".$length."\" />\n";
		$file_field .= ($show_replace) ? "<span>".$replace_label."</span><input type=\"checkbox\" name=\"replace\" value=\"y\" />" : "";
		if ($file_name != "" && $show_alternate) {
			$field .= "<input type=\"text\" name=\"".$element."\" size=\"".$alt_length."\" value=\"".$file_name."\" readonly=\"readonly\"";
			$field .= (!@file_exists($file_path.$file_name)) ? " title=\"".sprintf($this->error_text(17), $file_name)."\" />\n" : " />\n";
			$field .= "<input type=\"checkbox\" name=\"del_img\" value=\"y\" /><span>".$alt_btn_label."</span>\n";
		} else {
			$field .= $file_field;
		} 
		return $field;
	}
	// some error (HTTP)reporting, change the messages or remove options if you like.
	function error_text($err_num) {
		switch ($this->language) {
			case "nl":
			$error[0] = "Het bestand is succesvol gekopieerd.";
			$error[1] = "Het bestand is te groot, controlleer de max. toegelaten bestandsgrootte.";
			$error[2] = "Het bestand is te groot, controlleer de max. toegelaten bestandsgrootte.";
			$error[3] = "Fout bij het uploaden, probeer het nog een keer.";
			$error[4] = "Fout bij het uploaden, probeer het nog een keer.";
			$error[10] = "Selecteer een bestand.";
			$error[11] = "Er zijn alleen bestanden van dit type toegestaan: <strong>".$this->ext_string."</strong>";
			$error[12] = "Sorry, de bestandsnaam bevat tekens die niet zijn toegestaan. Gebruik alleen nummer, letters en het underscore teken. <br>Een geldige naam eindigt met een punt en de extensie.";
			$error[13] = "De bestandsnaam is te lang, het maximum is: ".$this->max_length_filename." tekens.";
			$error[14] = "Sorry, de opgegeven directory bestaat niet!";
			$error[15] = "Uploading <strong>".$this->the_file."...Fout!</strong> Sorry, er is al een bestand met deze naam aanwezig.";
			$error[16] = "Het gekopieerde bestand is hernoemd naar <strong>".$this->file_copy."</strong>.";
			$error[17] = "Het bestand %s bestaat niet.";
			break;
			case "de":
			$error[0] = "Die Datei: <strong>".$this->the_file."</strong> wurde hochgeladen!"; 
			$error[1] = "Die hochzuladende Datei ist gr&ouml;&szlig;er als der Wert in der Server-Konfiguration!"; 
			$error[2] = "Die hochzuladende Datei ist gr&ouml;&szlig;er als der Wert in der Klassen-Konfiguration!"; 
			$error[3] = "Die hochzuladende Datei wurde nur teilweise &uuml;bertragen"; 
			$error[4] = "Es wurde keine Datei hochgeladen"; 
			$error[10] = "W&auml;hlen Sie eine Datei aus!."; 
			$error[11] = "Es sind nur Dateien mit folgenden Endungen erlaubt: <strong>".$this->ext_string."</strong>";
			$error[12] = "Der Dateiname enth&auml;lt ung&uuml;ltige Zeichen. Benutzen Sie nur alphanumerische Zeichen f&uuml;r den Dateinamen mit Unterstrich. <br>Ein g&uuml;ltiger Dateiname endet mit einem Punkt, gefolgt von der Endung."; 
			$error[13] = "Der Dateiname &uuml;berschreitet die maximale Anzahl von ".$this->max_length_filename." Zeichen."; 
			$error[14] = "Das Upload-Verzeichnis existiert nicht!"; 
			$error[15] = "Upload <strong>".$this->the_file."...Fehler!</strong> Eine Datei mit gleichem Dateinamen existiert bereits.";
			$error[16] = "Die hochgeladene Datei ist umbenannt in <strong>".$this->file_copy."</strong>.";
			$error[17] = "Die Datei %s existiert nicht.";
			break;
			//
			// place here the translations (if you need) from the directory "add_translations"
			//
			default:
			// start http errors
			$error[0] = "File: <strong>".$this->the_file."</strong> successfully uploaded!";
			$error[1] = "The uploaded file exceeds the max. upload filesize directive in the server configuration.";
			$error[2] = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form.";
			$error[3] = "The uploaded file was only partially uploaded";
			$error[4] = "No file was uploaded";
			// end  http errors
			$error[10] = "Please select a file for upload.";
			$error[11] = "Only files with the following extensions are allowed: <strong>".$this->ext_string."</strong>";
			$error[12] = "Sorry, the filename contains invalid characters. Use only alphanumerical chars and separate parts of the name (if needed) with an underscore. <br>A valid filename ends with one dot followed by the extension.";
			$error[13] = "The filename exceeds the maximum length of ".$this->max_length_filename." characters.";
			$error[14] = "Sorry, the upload directory doesn't exist!";
			$error[15] = "Uploading <strong>".$this->the_file."...Error!</strong> Sorry, a file with this name already exitst.";
			$error[16] = "The uploaded file is renamed to <strong>".$this->file_copy."</strong>.";
			$error[17] = "The file %s does not exist.";
		}
		return $error[$err_num];
	}
}



class Foto_upload extends file_upload {
	
	var $x_size;
	var $y_size;
	var $x_max_size = 300;
	var $y_max_size = 200;
	var $x_max_thumb_size = 110;
	var $y_max_thumb_size = 88;
	var $thumb_folder;
	var $foto_folder;
	var $larger_dim;
	var $larger_curr_value;
	var $larger_dim_value;
	var $larger_dim_thumb_value;
	
	var $use_image_magick = true; // switch between true and false
	// I suggest to use ImageMagick on Linux/UNIX systems, it works on windows too, but it's hard to configurate
	// check your existing configuration by your web hosting provider
	
	function process_image($landscape_only = false, $create_thumb = false, $delete_tmp_file = false, $compression = 85) {
		$filename = $this->upload_dir.$this->file_copy;
		$this->check_dir($this->thumb_folder); // run these checks to create not existing directories
		$this->check_dir($this->foto_folder); // the upload dir is created during the file upload (if not already exists)
		$thumb = $this->thumb_folder.$this->file_copy;
		$foto = $this->foto_folder.$this->file_copy;
		if ($landscape_only) {
			$this->get_img_size($filename);
			if ($this->y_size > $this->x_size) {
				$this->img_rotate($filename, $compression);
			}
		}
		$this->check_dimensions($filename); // check which size is longer then the max value
		if ($this->larger_curr_value > $this->larger_dim_value) {
			$this->thumbs($filename, $foto, $this->larger_dim_value, $compression);
		} else {
			copy($filename, $foto);
		}
		if ($create_thumb) {
			if ($this->larger_curr_value > $this->larger_dim_thumb_value) {
				$this->thumbs($filename, $thumb, $this->larger_dim_thumb_value, $compression); // finally resize the image
			} else {
				copy($filename, $thumb);
			}
		}
		if ($delete_tmp_file) $this->del_temp_file($filename); // note if you delete the tmp file the check if a file exists will not work
	}
	function get_img_size($file) {
		$img_size = getimagesize($file);
		$this->x_size = $img_size[0];
		$this->y_size = $img_size[1];
	}
	function check_dimensions($filename) {
		$this->get_img_size($filename);
		$x_check = $this->x_size - $this->x_max_size;
		$y_check = $this->y_size - $this->y_max_size;
		if ($x_check < $y_check) {
			$this->larger_dim = "y";
			$this->larger_curr_value = $this->y_size;
			$this->larger_dim_value = $this->y_max_size;
			$this->larger_dim_thumb_value = $this->y_max_thumb_size;
		} else {
			$this->larger_dim = "x";
			$this->larger_curr_value = $this->x_size;
			$this->larger_dim_value = $this->x_max_size;
			$this->larger_dim_thumb_value = $this->x_max_thumb_size;
		}
	}
	function img_rotate($wr_file, $comp) {
		$new_x = $this->y_size;
		$new_y = $this->x_size;
		if ($this->use_image_magick) {
			exec(sprintf("mogrify -rotate 90 -quality %d %s", $comp, $wr_file));
		} else {
			$src_img = imagecreatefromjpeg($wr_file);
			$rot_img = imagerotate($src_img, 90, 0);
			$new_img = imagecreatetruecolor($new_x, $new_y);
			imageantialias($new_img, TRUE);
			imagecopyresampled($new_img, $rot_img, 0, 0, 0, 0, $new_x, $new_y, $new_x, $new_y);
			imagejpeg($new_img, $this->upload_dir.$this->file_copy, $comp);
		}
	}
	function thumbs($file_name_src, $file_name_dest, $target_size, $quality = 80) {
		//print_r(func_get_args());
		$size = getimagesize($file_name_src);
		if ($this->larger_dim == "x") {
			$w = number_format($target_size, 0, ',', '');
			$h = number_format(($size[1]/$size[0])*$target_size,0,',','');
		} else {
			$h = number_format($target_size, 0, ',', '');
			$w = number_format(($size[0]/$size[1])*$target_size,0,',','');
		}
		if ($this->use_image_magick) {
			exec(sprintf("convert %s -resize %dx%d -quality %d %s", $file_name_src, $w, $h, $quality, $file_name_dest));
		} else {
			$dest = imagecreatetruecolor($w, $h);
			imageantialias($dest, TRUE);
			$src = imagecreatefromjpeg($file_name_src);
			imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);
			imagejpeg($dest, $file_name_dest, $quality);
		}
	}
}


?>
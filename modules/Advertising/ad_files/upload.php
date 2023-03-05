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
//vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
//   You may change maxsize, and allowable upload file types.
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
//Mmaximum file size. You may increase or decrease.
$MAX_SIZE = 5000000;
                            
//Allowable file Mime Types. Add more mime types if you want
$FILE_MIMES = array('image/jpeg','image/jpg','image/gif'
                   ,'image/png','application/msword');

//Allowable file ext. names. you may add more extension names.            
$FILE_EXTS  = array('.zip','.jpg','.png','.gif', '.rar', '.mp3', '.wav' ,'.mpeg',  '.swf' , '.avi'); 

//Allow file delete? no, if only allow upload only
$DELETABLE  = false;                               


//vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
//   Do not touch the below if you are not confident.
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
/************************************************************
 *     Setup variables
 ************************************************************/
$site_name = $_SERVER['HTTP_HOST'];
$url_dir = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
$url_this =  "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

$upload_dir = "modules/Advertising/ad_files/banners/";
$upload_url = $url_dir."/modules/Advertising/ad_files/banners";
$message ="";

/************************************************************
 *     Create Upload Directory
 ************************************************************/
/*
if (!is_dir("files")) {
  if (!mkdir($upload_dir))
  	die ("upload_files directory doesn't exist and creation failed");
  if (!chmod($upload_dir,0755))
  	die ("change permission to 755 failed.");
}
*/

/************************************************************
 *     Process User's Request
 ************************************************************/
if ($_REQUEST[del] && $DELETABLE)  {
  $resource = fopen("log.txt","a");
  fwrite($resource,date("Ymd h:i:s")."DELETE - $_SERVER[REMOTE_ADDR]"."$_REQUEST[del]\n");
  fclose($resource);
  
  if (strpos($_REQUEST[del],"/.")>0);                  //possible hacking
  else if (strpos($_REQUEST[del],$upload_dir) === false); //possible hacking
  else if (substr($_REQUEST[del],0,6)==$upload_dir) {
    unlink($_REQUEST[del]);
    print "<script>window.location.href='$url_this?message=deleted successfully'</script>";
  }
}
else if ($_FILES['userfile']) {
  $resource = fopen("log.txt","a");
  fwrite($resource,date("Ymd h:i:s")."UPLOAD - $_SERVER[REMOTE_ADDR]"
            .$_FILES['userfile']['name']." "
            .$_FILES['userfile']['type']."\n");
  fclose($resource);

	$file_type = $_FILES['userfile']['type']; 
  $file_name = $_FILES['userfile']['name'];
  $file_ext = strtolower(substr($file_name,strrpos($file_name,".")));

  //File Size Check
  if ( $_FILES['userfile']['size'] > $MAX_SIZE) 
     $message = "The file size is over 10MB.";
  //File Type/Extension Check
  else if (!in_array($file_type, $FILE_MIMES) 
          && !in_array($file_ext, $FILE_EXTS) )
     $message = "Sorry, File Extension is not allowed to be uploaded.";
  else
     $message = do_upload($upload_dir, $upload_url);
  
  print "<center><br />$message<br /><br /><br /></center>";
}
else if (!$_FILES['userfile']);
else 
	$message = "Invalid File Specified.";

/************************************************************
 *     List Files
 ************************************************************/
$handle=opendir($upload_dir);
$filelist = "";
while ($file = readdir($handle)) {
   if(!is_dir($file) && !is_link($file)) {
      $filelist .= "<a target='_blank' href='$upload_dir$file'>".$file."</a>";
      if ($DELETABLE)
        $filelist .= " <a href='?del=$upload_dir".urlencode($file)."' title='delete'> (Delete)</a>";
      $filelist .= "<sub><small><font color=blue>  ".date("d-m H:i", filemtime($upload_dir.$file))
                   ."</font></small></sub>";
      $filelist .="<br />";
   }
}

function do_upload($upload_dir, $upload_url) {

	$temp_name = $_FILES['userfile']['tmp_name'];
	$file_name = $_FILES['userfile']['name']; 
  $file_name = str_replace("\\","",$file_name);
  $file_name = str_replace("'","",$file_name);
	$file_path = $upload_dir.$file_name;

	//File Name Check
  if ( $file_name =="") { 
  	$message = "Invalid File Name Specified";
  	return $message;
  }

  $result  =  move_uploaded_file($temp_name, $file_path);
  if (!chmod($file_path,0777))
   	$message = "change permission to 777 failed.";
  else
header( 'Location: modules.php?name=Advertising&op=addbanner' ) ;
     	 }


?>
<center>
   <font color=red><?php echo $_REQUEST[message]?></font>
   <br />
   <form name="upload" id="upload" ENCTYPE="multipart/form-data" method="post">
     Upload File <input type="file" id="userfile" name="userfile">
     <input type="submit" name="upload" value="Upload"><br /><br />
     Allowed file-types: .jpg, .gif, .png, & .swf
   </form>
   <strong>This list shows all current uploaded banner files.</strong>
   <hr width=45%>
   <?php echo $filelist?>
   <hr width=50%>
</center>
 

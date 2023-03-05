<script language="Javascript" type="text/javascript" src="includes/edit_area/edit_area_compressor.php?plugins"></script>
<script language="Javascript" type="text/javascript" src="includes/snavi/snavi_editor.js"></script>

<?php


	function Snavi_Main()
	{
		global $admin_file;
		include_once(NUKE_BASE_DIR.'header.php');
			OpenTable();
				echo "<div align=\"center\"><a href=\"". $admin_file .".php\">[ Main Administration ]</a></div>";
				echo "<br />";
				echo "<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"3\">";
				echo "	<tr align=\"center\">";
				echo "	  <td width=\"25%\"><a href=\"". $admin_file .".php?op=Snavi_Main_Config\">Snavi Configuration</a></td>";
				echo "	  <td width=\"25%\"><a href=\"". $admin_file .".php?op=Snavi_Menu_Items\">Snavi Menu Items</a></td>";
				echo "	  <td width=\"25%\"><a href=\"". $admin_file .".php?op=Snavi_News_Config\">Snavi News</a></td>";
				echo "	  <td width=\"25%\"><a href=\"". $admin_file .".php?op=Snavi_Style_Sheet\">Snavi Style Sheet</a></td>";
				echo "	</tr>";			
				echo "</table>";
				echo "    <br /><br /><div align=\"right\"><a href=\"http://www.darkforgegfx.com\" alt=\"DarkForge GFX\" title=\"DarkForge GFX\" target=\"_blank\">&copy; darkforgegfx</a></div>";
			CloseTable();
		include_once(NUKE_BASE_DIR. 'footer.php');	
	}
	
	function Snavi_Main_Config()
	{
		global $module_name, $admin_file, $_POST;
		include_once(NUKE_BASE_DIR. 'header.php');
		OpenTable();
				echo "<div align=\"center\"><a href=\"". $admin_file .".php?op=Snavi\">[ Snavi Administration ]</a> ::<a href=\"". $admin_file .".php\">  [ Main Administration ]</a></div>";
		CloseTable();
		OpenTable();
			$file = 'includes/snavi/snavi_config.php';
 
			echo '<div style="border: 1px solid; text-align:center;">';
			if (isset($_POST['edit']))
			{
				$contents = stripslashes($_POST['edit_file']);		 
			  	$handle = fopen($file, 'w');
			  	fwrite($handle, $contents);
			  	fclose($handle);			 
			  	echo "\n<br />File Updated Successfully!<br />\n";
			}
			 
			$contents = (@file_get_contents($file)) ? htmlspecialchars(file_get_contents($file)) : 'new file';
			 
			echo '<br />';
			echo '<form action=" " method="post">';
	 		//echo '<fieldset>';
		    echo '<legend>Snavi_Config</legend>';
			echo '<textarea id="snavi_config" name="edit_file" wrap="virtual" style="width: 100%; height: 400px; font-family:\'Courier New\', Courier, monospace;">' . $contents . '</textarea>';
			echo '<br /><br />';
			echo '<input type="submit" name="edit" value="Save">';
			//echo '</fieldset>';
			echo '</form>';
			echo '</div>';
			
			
		CloseTable();
		include_once(NUKE_BASE_DIR. 'footer.php');
	}
	
	
	function Snavi_Menu_Items()
	{
		global $module_name, $admin_file, $_POST;
		include_once(NUKE_BASE_DIR. 'header.php');
		OpenTable();
				echo "<div align=\"center\"><a href=\"". $admin_file .".php?op=Snavi\">[ Snavi Administration ]</a> ::<a href=\"". $admin_file .".php\">  [ Main Administration ]</a></div>";
		CloseTable();
		OpenTable();
			$file = 'includes/snavi/layouts/networklinks.txt';
 
			echo '<div style="border: 1px solid; text-align:center;">';
			if (isset($_POST['edit']))
			{
				$contents = stripslashes($_POST['edit_file']);		 
			  	$handle = fopen($file, 'w');
			  	fwrite($handle, $contents);
			  	fclose($handle);			 
			  	echo "\n<br />File Updated Successfully!<br />\n";
			}
			 
			$contents = (@file_get_contents($file)) ? htmlspecialchars(file_get_contents($file)) : 'new file';
			 
			echo '<br />';
			echo '<form method="post">';
			echo '<form action=" " method="post">';
	 		//echo '<fieldset>';
		    echo '<legend>Snavi_Menu</legend>';			
			echo '<textarea id="snavi_menu" name="edit_file" wrap="virtual" style="width: 100%; height: 400px; font-family:\'Courier New\', Courier, monospace;">' . $contents . '</textarea>';
			echo '<br /><br />';
			echo '<input type="submit" name="edit" value="Save">';
			//echo '</fieldset>';			
			echo '</form>';
			echo '</div>';
			
		CloseTable();
		include_once(NUKE_BASE_DIR. 'footer.php');
	}	
	
	
	function Snavi_News_Config()
	{
		global $module_name, $admin_file, $_POST;
		include_once(NUKE_BASE_DIR. 'header.php');
		OpenTable();
				echo "<div align=\"center\"><a href=\"". $admin_file .".php?op=Snavi\">[ Snavi Administration ]</a> ::<a href=\"". $admin_file .".php\">  [ Main Administration ]</a></div>";
		CloseTable();
		OpenTable();
			$file = 'includes/snavi/layouts/networknews.txt';
 
			echo '<div style="border: 1px solid; text-align:center;">';
			if (isset($_POST['edit']))
			{
				$contents = stripslashes($_POST['edit_file']);		 
			  	$handle = fopen($file, 'w');
			  	fwrite($handle, $contents);
			  	fclose($handle);			 
			  	echo "\n<br />File Updated Successfully!<br />\n";
			}
			 
			$contents = (@file_get_contents($file)) ? htmlspecialchars(file_get_contents($file)) : 'new file';
			 
			echo '<br />';
			echo '<form method="post">';
	 		//echo '<fieldset>';
		    echo '<legend>Snavi_News</legend>';			
			echo '<textarea id="snavi_news" name="edit_file" wrap="virtual" style="width: 100%; height: 400px; font-family:\'Courier New\', Courier, monospace;">' . $contents . '</textarea>';
			echo '<br /><br />';
			echo '<input type="submit" name="edit" value="Save">';
			//echo '</fieldset>';
			echo '</form>';
			echo '</div>';
			
		CloseTable();
		include_once(NUKE_BASE_DIR. 'footer.php');
	}	
	
	
	function Snavi_Style_Sheet()
	{
		global $module_name, $admin_file, $_POST;
		include_once(NUKE_BASE_DIR. 'header.php');
		OpenTable();
				echo "<div align=\"center\"><a href=\"". $admin_file .".php?op=Snavi\">[ Snavi Administration ]</a> ::<a href=\"". $admin_file .".php\">  [ Main Administration ]</a></div>";
		CloseTable();
		OpenTable();
			$file = 'includes/snavi/style/snavi.css';
 
			echo '<div style="border: 1px solid; text-align:center;">';
			if (isset($_POST['edit']))
			{
				$contents = stripslashes($_POST['edit_file']);		 
			  	$handle = fopen($file, 'w');
			  	fwrite($handle, $contents);
			  	fclose($handle);			 
			  	echo "\n<br />File Updated Successfully!<br />\n";
			}
			 
			$contents = (@file_get_contents($file)) ? htmlspecialchars(file_get_contents($file)) : 'new file';
			 
			echo '<br />';
			echo '<form method="post">';
	 		//echo '<fieldset>';
		    echo '<legend>Snavi_News</legend>';			
			echo '<textarea id="snavi_css" name="edit_file" wrap="virtual" style="width: 100%; height: 400px; font-family:\'Courier New\', Courier, monospace;">' . $contents . '</textarea>';
			echo '<br /><br />';
			echo '<input type="submit" name="edit" value="Save">';
			//echo '</fieldset>';
			echo '</form>';
			echo '</div>';
			
		CloseTable();
		include_once(NUKE_BASE_DIR. 'footer.php');
	}		
	
	switch($op)
	{
		default:
			Snavi_Main();
			break;
			
		case 'Snavi_Main_Config':
			Snavi_Main_Config();
			break;
			
		case 'Snavi_News_Config':
			Snavi_News_Config();
			break;
			
		case 'Snavi_Menu_Items':
			Snavi_Menu_Items();
			break;
		case 'Snavi_Style_Sheet':
			Snavi_Style_Sheet();
			break;
	}


?>
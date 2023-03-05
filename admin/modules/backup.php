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

if (!defined('ADMIN_FILE'))
{
	die('Access Denied');
}
global $prefix, $db, $admin_file;
$aid = substr($aid, 0, 25);
$row = $db->sql_fetchrow($db->sql_query('SELECT name, radminsuper FROM ' . $prefix . '_authors WHERE aid=\'' . $aid . '\''));
if (($row['radminsuper'] == 1) && ($row['name'] == 'God'))
{
	addJSToHead('includes/javascript/db_backup.js','file');
	
	$crlf="\n";
	$date = date ("d-m-Y");
	$filename = $dbname.'_'.$date.'.sql';

	if (isset($_POST['tablelist']))
	{
		$tablelist = $_POST['tablelist'];
	} else {
		$tablelist = array();
		$result = $db->sql_query('SHOW TABLES');
		while (list($tblname) = $db->sql_fetchrow($result))
		{
			if (preg_match("#^$prefix#", $tblname)) $tablelist[] = $tblname;
		}
		$db->sql_freeresult($result);
	}

$pagetitle .= ' - '._BACKUP_TITLE;

class SQLCtrl
{
	public static function backup($tables, $filename, $structure = true, $data = true, $drop = true, $compress = true)
	{
        global $dbname;
		if (!is_array($tables) || empty($tables))
		{
			trigger_error('No tables to backup', E_USER_WARNING);
			return false;
		}
		$crlf = "\n";
		// doing some DOS-CRLF magic...
		if(preg_match('#[^(]*\((.*)\)[^)]*#',$_SERVER['HTTP_USER_AGENT'],$regs))
		{
			$os = $regs[1];
			// this looks better under WinX
			if (preg_match('#Win#i',$os)) $crlf="\r\n";
		}

		$output = "-- ========================================================".$crlf
		."--".$crlf
		."-- Database : ".$dbname.$crlf
		."-- On ".date ("m-d-Y")." at ".date ("H:i").$crlf
		."--".$crlf
		."-- ========================================================".$crlf
		.$crlf;
			foreach($tables AS $table)
			{
				if ($structure)
				{
					$output .= $crlf."--".$crlf."-- Table structure for table '".$table."'".$crlf."--".$crlf.$crlf;
					$output .= SQLCtrl::get_table_struct($table, $crlf, $drop).";$crlf$crlf";
				}
				if ($data)
				{
					$output .= $crlf."--".$crlf."-- Dumping data for table '".$table."'".$crlf."--".$crlf.$crlf;
					$output .= SQLCtrl::get_table_content($table, $crlf);
				}
        	}
        	@set_time_limit(1200);
        		if ($compress && GZIPSUPPORT)
				{
				while (ob_end_clean());
					header("Content-Type: application/x-gzip; name=\"".$filename.".gz\"");
					header("Content-disposition: attachment; filename=".$filename.".gz");
					ob_start();
					ob_implicit_flush(0);
					echo $output;
					$Size = ob_get_length();
					$Crc = crc32(ob_get_contents());
					$contents = gzcompress(ob_get_contents());
					ob_end_clean();
					echo "\x1f\x8b\x08\x00\x00\x00\x00\x00".substr($contents, 0, strlen($contents) - 4).SQLCtrl::gzip_PrintFourChars($Crc).SQLCtrl::gzip_PrintFourChars($Size);
			}
			else
			{
				header("Content-Type: text/x-delimtext; name=\"$filename\"");
				header("Content-disposition: attachment; filename=".$filename);
				echo $output;
			}
		exit;
	}

	public static function gzip_PrintFourChars($Val)
	{
		$return = '';
			for ($i = 0; $i < 4; ++$i)
			{
				$return .= chr($Val % 256);
				$Val = floor($Val / 256);
			}
		return $return;
	}

	// Get the content of $table as a series of INSERT statements.
	public static function get_table_content($table, $crlf)
	{
		global $db;
		$result = $db->sql_query("SELECT * FROM ".$table,false,__FILE__,__LINE__);
		$fieldcount = $db->sql_numfields($result);
		$fields = "";
		if(isset($GLOBALS["showcolumns"]))
		{
			$fields = "(";
				for ($j = 0; $j < $fieldcount; $j++)
				{
					if ($j > 0) $fields .= ", ";
					$fields .= $db->sql_fieldname($j, $result);
				}
			$fields .= ") ";
		}
		$str = '';
		while($row = $db->sql_fetchrow($result))
		{
			$str .= "INSERT INTO ".$table." ".$fields." VALUES (";
				for($j = 0; $j < $fieldcount; $j++)
				{
					if ($j > 0) $str .= ", ";
						// Can't use addslashes as we don't know what value has magic_quotes_sybase.
						if (!isset($row[$j]))
						{
							$str .= "NULL";
						}
						elseif ($row[$j] != "")
						{
							$str .= "'".addcslashes($row[$j], $crlf."'")."'";
						}
						else
						{
							$str .= "''";
						}
				}
            		$str .= ");".$crlf;
		}
		$db->sql_freeresult($result);
		return $str;
	}

	// Return $table's CREATE definition
	// Returns a string containing the CREATE statement on success
	public static function get_table_struct($table, $crlf, $drop)
	{
		global $db;
		$schema_create = '';
		if ($drop)
		{
			$schema_create .= "DROP TABLE IF EXISTS ".$table.";".$crlf;
		}
		$schema_create .= "CREATE TABLE ".$table." (".$crlf;
	
		$result = $db->sql_query("SHOW FIELDS FROM ".$table,false,__FILE__,__LINE__);
		while ($row = $db->sql_fetchrow($result))
		{
			$schema_create .= "   ".$row['Field']." ".$row['Type'];
			if ($row['Null'] != 'YES') $schema_create .= ' NOT NULL';
			if (isset($row['Default']) && (!empty($row['Default']) || $row['Default'] == '0'))
				$schema_create .= " DEFAULT '".$row['Default']."'";
			if ($row['Extra'] != '') $schema_create .= " ".$row['Extra'];
			$schema_create .= ",".$crlf;
		}
		$schema_create = preg_replace("#,".$crlf.'$#', '', $schema_create);
	
		$result = $db->sql_query("SHOW KEYS FROM ".$table,false,__FILE__,__LINE__);
		$index = array();
		while($row = $db->sql_fetchrow($result))
		{
			$kname = $row['Key_name'];
			if (($kname != 'PRIMARY') && ($row['Non_unique'] == 0)) $kname = "UNIQUE|".$kname;
			if ($row['Index_type'] == 'FULLTEXT') $kname = "FULLTEXT|".$kname;
			if (!isset($index[$kname])) $index[$kname] = array();
			$colname = $row['Column_name'];
			if (!empty($row['Sub_part'])) $colname += '('.intval($row['Sub_part']).')';
			$index[$kname][] = $colname;
		}
		while(list($x, $columns) = each($index))
		{
			$schema_create .= ",".$crlf;
				if ($x == 'PRIMARY')
					$schema_create .= '   PRIMARY KEY';
				elseif (substr($x,0,6) == 'UNIQUE')
					$schema_create .= '   UNIQUE '.substr($x,7);
				elseif (substr($x,0,8) == 'FULLTEXT')
					$schema_create .= '   FULLTEXT '.substr($x,9);
				else
					$schema_create .= "   KEY ".$x;
					$schema_create .= ' ('.implode(', ', $columns).')';
		}
		$schema_create .= $crlf.")";
		// add engine and charset
		$schema_create .= ' ENGINE=MyISAM DEFAULT CHARSET=utf8';
		return $schema_create;
	}

    public static function query_file($file, &$error, $replace_prefix = false)
	{
		$error = false;
		if (!is_array($file))
		{
			$tmp['name'] = $file;
			$tmp['tmp_name'] = $file;
			$tmp['type'] = preg_match("/\.gz$/is",$file) ? 'application/x-gzip' : 'text/plain';
			$file = $tmp;
		}
		if (empty($file['tmp_name']) || empty($file['name']))
		{
			$error = _BACKUP_RESTORE_NOFILE;
			return false;
		}
		if (preg_match("/^(text\/[a-zA-Z]+)|(application\/(x\-)?gzip(\-compressed)?)|(application\/octet-stream)$/is", $file['type']))
		{
			$filedata = '';
			$open = 'gzopen';
			$eof = 'gzeof';
			$read = 'gzgets';
			$close = 'gzclose';
			if (!GZIPSUPPORT)
			{
				if (preg_match("/\.gz$/is",$file['name']))
				{
					$error = _BACKUP_RESTORE_CANTDECOPRESS;
					return false;
				}
				$open = 'fopen';
				$eof = 'feof';
				$read = 'fread';
				$close = 'fclose';
			}
			$rc = $open($file['tmp_name'], 'rb');
				if ($rc)
				{
					while (!$eof($rc)) $filedata .= $read($rc, 100000);
						$close($rc);
				}
				else
				{
					$error = _BACKUP_RESTORE_COULDNOTOPEN1." ".$file['tmp_name']." "._BACKUP_RESTORE_COULDNOTOPEN2;
				}
		}
		else
		{
			$error = _BACKUP_RESTORE_FILENAMEINCORRECT." ".$file['name'].".".$file['type'].".";
		}
		if ($error)
		{
			return false;
		}
		$filedata = SQLCtrl::remove_remarks($filedata);
		$queries = SQLCtrl::split_sql_file($filedata, ";\n");
			if (count($queries) < 1)
			{
				$error = _BACKUP_RESTORE_NOQUERIS;
				return false;
			}
		global $db, $prefix;
		foreach ($queries AS $query)
		{
			@set_time_limit(1200);
			if (!$replace_prefix)
			{
						$query = preg_replace('#(TABLE|INSERT|EXISTS|ON) ([a-zA-Z]*?(_))#', "\\1 ".$prefix.'_', $query);
			}
			else
			{
				foreach($replace_prefix AS $oldprefix => $newprefix)
				{
					if ($oldprefix != $newprefix)
					{
						$query = preg_replace("/".$oldprefix."/", $newprefix, $query);
					}
				}
			}
			$db->sql_query($query,false,__FILE__,__LINE__);
		}
		return true;
	}

	// remove_remarks will strip the sql comment lines out of an uploaded sql file
	public static function remove_remarks($lines)
	{
		$lines = explode("\n", $lines);
		$linecount = count($lines);
		$output = '';
		for ($i = 0; $i < $linecount; ++$i)
		{
		$line = trim($lines[$i]);
			if (strlen($line) > 0)
			{
				if ($line[0] != "--" && $line[0] != "-")
				{
					$output .= $line . "\n";
				}
				// Trading a bit of speed for lower mem. use here.
				$lines[$i] = '';
			}
		}
		return $output;
	}

	// split_sql_file will split an uploaded sql file into single sql statements.
	// Note: expects trim() to have already been run on $sql.
	public static function split_sql_file(&$sql, $delimiter)
	{
		// Split up our string into "possible" SQL statements.
		$tokens = explode($delimiter, $sql);
		unset($sql);
		$output = array();
	
		// we don't actually care about the matches preg gives us.
		$matches = array();
	
		// this is faster than calling count($oktens) every time thru the loop.
		$token_count = count($tokens);
		for ($i = 0; $i < $token_count; ++$i)
		{
			// Don't wanna add an empty string as the last thing in the array.
			if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0)))
			{
				// This is the total number of single quotes in the token.
				$total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
				// Counts single quotes that are preceded by an odd number of backslashes,
				// which means they're escaped quotes.
				$escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);
		
				$unescaped_quotes = $total_quotes - $escaped_quotes;
	
				// If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
				if (($unescaped_quotes % 2) == 0)
				{
					// It's a complete sql statement.
					$output[] = $tokens[$i];
					// save memory.
					$tokens[$i] = '';
				}
				else
				{
					// incomplete sql statement. keep adding tokens until we have a complete one.
					// $temp will hold what we have so far.
					$temp = $tokens[$i] . $delimiter;
					// save memory..
					$tokens[$i] = '';
		
					// Do we have a complete statement yet?
					$complete_stmt = false;
		
					for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++)
					{
					// This is the total number of single quotes in the token.
					$total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
					// Counts single quotes that are preceded by an odd number of backslashes,
					// which means they're escaped quotes.
					$escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);
		
					$unescaped_quotes = $total_quotes - $escaped_quotes;
		
						if (($unescaped_quotes % 2) == 1)
						{
							// odd number of unescaped quotes. In combination with the previous incomplete
							// statement(s), we now have a complete statement. (2 odds always make an even)
							$output[] = $temp . $tokens[$j];
			
							$tokens[$j] = '';
							$temp = '';
			
							// exit the loop.
							$complete_stmt = true;
							// make sure the outer loop continues at the right point.
							$i = $j;
						}
						else
						{
							// even number of unescaped quotes. We still don't have a complete statement.
							// (1 odd and 1 even always make an odd)
							$temp .= $tokens[$j] . $delimiter;
							$tokens[$j] = '';
						}
					} // for..
				} // else
			}
		}
		return $output;
	}
}

/***************************************************************************
 *
 * End of ported code.
 * 
 ***************************************************************************/

	switch($op)
	{
		case 'BackupDB':
			@set_time_limit(1200);
			SQLCtrl::backup($tablelist, $filename, isset($_POST['dbstruct']), isset($_POST['dbdata']), isset($_POST['drop']), isset($_POST['gzip']));
		break;
	
		case 'OptimizeDB':
		case 'CheckDB':
		case 'AnalyzeDB':
		case 'RepairDB':
		case 'StatusDB':
		
		$type = strtoupper(substr($op,0,-2));
		include_once(NUKE_BASE_DIR . 'header.php');
	//	genAdminPanel('database', _BACKUP);
	//  GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._BACKUP_TITLE."</strong></font></center>";
		echo '<center><br /><strong><a href="'.$admin_file.'.php?op=database">['._SAVEDATABASE.']</a></strong></center>';
		echo '<center><br /><strong><a href="'.$admin_file.'.php">['._NG_BACK.']</a></strong></center><br />';
		CloseTable();
		echo "<br />";
		OpenTable();
		if (count($tablelist) > 0)
		{
			if ($type == "STATUS")
			{
				$query = 'SHOW TABLE STATUS FROM `'.$dbname.'`';
			}
			else
			{
				$query = "$type TABLE ";
					foreach ($tablelist as $table)
					{
						if ($query != $type." TABLE ") $query .= ", ";
						$query .= $table;
					}
			}
		$result = $db->sql_query($query);
		$numfields = $db->sql_numfields($result);
		echo '<center><strong>'._BACKUP_ACTIONRESULTS.'</strong></center><br />
		<table align="center" border="1" cellpadding="1"><tr bgcolor="'.$bgcolor2.'">';
			for ($j = 0; $j < $numfields; $j++)
			{
				echo '<td align="left"><strong>'.$db->sql_fieldname($j, $result).'</strong></td>';
			}
		echo '</tr>';
		$bgcolor = $bgcolor3;
			while ($row = $db->sql_fetchrow($result))
			{
				$bgcolor = ($bgcolor == '') ? ' bgcolor="'.$bgcolor3.'"' : '';
				echo '<tr'.$bgcolor.'>';
					for($j = 0; $j < $numfields; $j++)
					{
						echo '<td align="left">'.$row[$j].'</td>';
					}
				echo '</tr>';
			}
			echo '</table>';
		}
		echo '<br /><center>'._GOBACK.'</center>';
		CloseTable();
		include_once(NUKE_BASE_DIR . 'footer.php');
		break;
				
		case 'RestoreDB':
		include_once(NUKE_BASE_DIR . 'header.php');
	//	genAdminPanel('database', _BACKUP);
	//  GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._BACKUP_TITLE."</strong></font></center>";
		echo '<center><br /><strong><a href="'.$admin_file.'.php?op=database">['._SAVEDATABASE.']</a></strong></center>';
		echo '<center><br /><strong><a href="'.$admin_file.'.php">['._NG_BACK.']</a></strong></center><br />';
		CloseTable();
		echo "<br />";
		if (!SQLCtrl::query_file($_FILES['sqlfile'], $error))
		{
			OpenTable();
			echo '<center><strong>'.$error.'</strong></center>';
			CloseTable();
		}
		else
		{
			OpenTable();
			echo '<center><strong>'._BACKUP_RESTORE_FIN1.' '.$_FILES['sqlfile']['name'].' '._BACKUP_RESTORE_FIN2.'</center>';
			CloseTable();
		}
		include_once(NUKE_BASE_DIR . 'footer.php');
		break;
	
		default:
		include_once(NUKE_BASE_DIR . 'header.php');
	//	genAdminPanel('database', _BACKUP);
	//   GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._BACKUP_TITLE."</strong></font></center>";
		echo '<center><br /><strong><a href="'.$admin_file.'.php?op=database">['._SAVEDATABASE.']</a></strong></center>';
		echo '<center><br /><strong><a href="'.$admin_file.'.php">['._NG_BACK.']</a></strong></center><br />';
		CloseTable();
		echo "<br />";
		OpenTable();
		echo '<form method="post" name="backup" action="'.$admin_file.'.php" enctype="multipart/form-data" accept-charset="iso-8859-2"><table><tr>';
		echo '<td valign="top" align="left"><select name="tablelist[]" size="40" multiple="multiple">';
		foreach ($tablelist as $table)
		{
			echo "<option value=\"".$table."\">".$table."</option>\n";
		}
		echo '</select>';
		echo '<br /><br /><button type="button" name="selectall" onclick="setSelectOptions(\'backup\', \'tablelist[]\', true);">'._BACKUP_TABLES_SELECTALL.'</button>';
		echo '&nbsp;&nbsp;<button type="button" name="selectall" onclick="setSelectOptions(\'backup\', \'tablelist[]\', false);">'._BACKUP_TABLES_DESELECTALL.'</button>';
		echo '</td>';
	
		echo '<td valign="middle" align="left">'._BACKUP_ACTION.' <select name="op">'
		.'<option value="AnalyzeDB">'._BACKUP_ACTION_ANALYZE.'</option>'
		.'<option value="BackupDB" selected="selected">'._BACKUP_ACTION_BACKUP.'</option>'
		.'<option value="CheckDB">'._BACKUP_ACTION_CHECK.'</option>'
		.'<option value="OptimizeDB">'._BACKUP_ACTION_OPTIMIZE.'</option>'
		.'<option value="RepairDB">'._BACKUP_ACTION_REPAIR.'</option>'
		.'<option value="StatusDB">'._BACKUP_ACTION_STATUS.'</option>'
		.'</select>'
		.'<br /><br />'._BACKUP_FORBACKUP.'<br /><input type="checkbox" value="1" name="dbdata" checked="checked">'._BACKUP_SAVEDATA.'<br /><input type="checkbox" value="1" name="dbstruct" checked="checked">'._BACKUP_CREATESTATE.'<br /><input type="checkbox" value="1" name="drop" checked="checked">'._BACKUP_DROPSTATE.'<br />';
		if (extension_loaded('zlib'))
		{
			echo '<input type="checkbox" value="1" name="gzip" checked="checked">'._BACKUP_USEGZIP.'';
		}
		else
		{
			echo '<input type="checkbox" value="0" name="gzip" checked="checked" disabled>'._BACKUP_USEGZIP.'';
		}
		echo '<br /><br /><div align="center"><input type="submit" value="&nbsp;&nbsp;'._BACKUP_GO.'&nbsp;&nbsp;"></div></td><td width="50%" valign="top" align="left">';
	
		OpenTable();
		echo '<strong>'._BACKUP_HELP_TITLE.'</strong>
		<ul>
			<li><strong>'._BACKUP_HELP_ANALYZE.'</strong><br />'._BACKUP_HELP_ANALYZE_DESC.'</li>
			<li><strong>'._BACKUP_HELP_REPAIR.'</strong><br />'._BACKUP_HELP_REPAIR_DESC.'</li>
			<li><strong>'._BACKUP_HELP_OPTIMIZE.'</strong><br />'._BACKUP_HELP_OPTIMIZE_DESC.'</li>
			<li><strong>'._BACKUP_HELP_BACKUP.'</strong><br />'._BACKUP_HELP_BACKUP_DESC.'</li>
			<li><strong>'._BACKUP_HELP_CHECK.'</strong><br />'._BACKUP_HELP_CHECK_DESC.'</li>
			<li><strong>'._BACKUP_HELP_STATUS.'</strong><br />'._BACKUP_HELP_STATUS_DESC.'</li>
		</ul>';
		CloseTable();
	
		echo '</td></tr></table></form>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<form method="post" action="'.$admin_file.'.php" name="restore" enctype="multipart/form-data">';
		if (extension_loaded('zlib'))
		{
			echo _BACKUP_RESTORE_SQLGZIP;
		}
		else
		{
			echo _BACKUP_RESTORE_SQL;
		}
		echo ' '.ini_get('upload_max_filesize').').';
		echo '<br /><input type="file" name="sqlfile" size="80">&nbsp;&nbsp;<input type="hidden" name="op" value="RestoreDB"><input type="submit" value="'._BACKUP_UPLOAD.'"></form>';
		CloseTable();
	
		include_once(NUKE_BASE_DIR . 'footer.php');
		break;
	}

}
else
{
	die('Illegal File Access');
}
?>
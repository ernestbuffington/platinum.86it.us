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
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}
if (stristr($_SERVER['QUERY_STRING'],'%25')) header('Location: index.php');
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$index = 0;	//Turn Right Blocks On (1) or Off (0) / Bloques Derechos Activos (1) o Inactivos (0); For 7.7 patched 3.1 or earlier version.
define('INDEX_FILE', true);	// Turn Right Blocks On (true) or Off (false) / Bloques Derechos Activos (true) o Inactivos (false); For 7.8 Patched 3.1 or newer version
define('IN_RPM', true);
require_once("modules/$module_name/public/functions.php");

switch($rop) {

	case "A":
	include_once("modules/$module_name/public/reviews.php");
	reviews(A, $field, $order);
	break;

	case "B":
	include_once("modules/$module_name/public/reviews.php");
	reviews(B, $field, $order);
	break;

	case "C":
	include_once("modules/$module_name/public/reviews.php");
	reviews(C, $field, $order);
	break;

	case "D":
	include_once("modules/$module_name/public/reviews.php");
	reviews(D, $field, $order);
	break;

	case "E":
	include_once("modules/$module_name/public/reviews.php");
	reviews(E, $field, $order);
	break;

	case "F":
	include_once("modules/$module_name/public/reviews.php");
	reviews(F, $field, $order);
	break;

	case "G":
	include_once("modules/$module_name/public/reviews.php");
	reviews(G, $field, $order);
	break;

	case "H":
	include_once("modules/$module_name/public/reviews.php");
	reviews(H, $field, $order);
	break;

	case "I":
	include_once("modules/$module_name/public/reviews.php");
	reviews(I, $field, $order);
	break;

	case "J":
	include_once("modules/$module_name/public/reviews.php");
	reviews(J, $field, $order);
	break;

	case "K":
	include_once("modules/$module_name/public/reviews.php");
	reviews(K, $field, $order);
	break;

	case "L":
	include_once("modules/$module_name/public/reviews.php");
	reviews(L, $field, $order);
	break;

	case "M":
	include_once("modules/$module_name/public/reviews.php");
	reviews(M, $field, $order);
	break;

	case "N":
	include_once("modules/$module_name/public/reviews.php");
	reviews(N, $field, $order);
	break;

	case "O":
	include_once("modules/$module_name/public/reviews.php");
	reviews(O, $field, $order);
	break;

	case "P":
	include_once("modules/$module_name/public/reviews.php");
	reviews(P, $field, $order);
	break;

	case "Q":
	include_once("modules/$module_name/public/reviews.php");
	reviews(Q, $field, $order);
	break;

	case "R":
	include_once("modules/$module_name/public/reviews.php");
	reviews(R, $field, $order);
	break;

	case "S":
	include_once("modules/$module_name/public/reviews.php");
	reviews(S, $field, $order);
	break;

	case "T":
	include_once("modules/$module_name/public/reviews.php");
	reviews(T, $field, $order);
	break;

	case "U":
	include_once("modules/$module_name/public/reviews.php");
	reviews(U, $field, $order);
	break;

	case "V":
	include_once("modules/$module_name/public/reviews.php");
	reviews(V, $field, $order);
	break;

	case "W":
	include_once("modules/$module_name/public/reviews.php");
	reviews(W, $field, $order);
	break;

	case "X":
	include_once("modules/$module_name/public/reviews.php");
	reviews(X, $field, $order);
	break;

	case "Y":
	include_once("modules/$module_name/public/reviews.php");
	reviews(Y, $field, $order);
	break;

	case "Z":
	include_once("modules/$module_name/public/reviews.php");
	reviews(Z, $field, $order);
	break;

	case "1":
	include_once("modules/$module_name/public/reviews.php");
	reviews(1, $field, $order);
	break;

	case "2":
	include_once("modules/$module_name/public/reviews.php");
	reviews(2, $field, $order);
	break;

	case "3":
	include_once("modules/$module_name/public/reviews.php");
	reviews(3, $field, $order);
	break;

	case "4":
	include_once("modules/$module_name/public/reviews.php");
	reviews(4, $field, $order);
	break;

	case "5":
	include_once("modules/$module_name/public/reviews.php");
	reviews(5, $field, $order);
	break;

	case "6":
	include_once("modules/$module_name/public/reviews.php");
	reviews(6, $field, $order);
	break;

	case "7":
	include_once("modules/$module_name/public/reviews.php");
	reviews(7, $field, $order);
	break;

	case "8":
	include_once("modules/$module_name/public/reviews.php");
	reviews(8, $field, $order);
	break;

	case "9":
	include_once("modules/$module_name/public/reviews.php");
	reviews(9, $field, $order);
	break;

	case "showcontent":
	include_once("modules/$module_name/public/showcontent.php");
	showcontent($id, $page);
	break;

	case "write_review":
	include_once("modules/$module_name/public/write_review.php");
	write_review();
	break;

	case "preview_review":
	include_once("modules/$module_name/public/preview_review.php");
	preview_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage);
	break;

	case ""._YES."":
	include_once("modules/$module_name/public/send_review.php");
	send_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage);
	break;

	case "del_review":
	include_once("modules/$module_name/public/del_review.php");
	del_review($id_del);
	break;

	case "mod_review":
	include_once("modules/$module_name/public/mod_review.php");
	mod_review($id);
	break;
	
	case "my_reviews":
	include_once("modules/$module_name/public/my_reviews.php");
	break;

	case "postcomment":
	include_once("modules/$module_name/public/postcomment.php");
	postcomment($id, $title);
	break;

	case "savecomment":
	include_once("modules/$module_name/public/savecomment.php");
	savecomment($xanonpost, $uname, $id, $score, $comments, $gen);
	break;

	case "del_comment":
	include_once("modules/$module_name/public/del_comment.php");
	del_comment($cid, $id);
	break;

	default:
	include_once("modules/$module_name/public/reviews_index.php");
	reviews_index();
	break;
}

?>
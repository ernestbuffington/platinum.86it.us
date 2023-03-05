<?php
/********************************************************/
/* Sommaire Paramétrable v3.0  04 october 2005          */
/* This file displays the content of your menu.         */
/*                                                      */
/* Sommaire Paramétrable (c) marcoledingue              */
/* marcoledingue@free.fr                                */
/* ---------------------------------------------------- */
/* This program's license is General Public License     */
/* http://www.gnu.org/licenses/gpl.txt                  */
/********************************************************/
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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $db, $admin, $user, $prefix, $user_prefix, $cookie, $def_module, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;
$gestiongroupe = 1; // mettre 0 permet de forcer Sommaire Paramétrable à ne pas gérer les groupes. (gain de 1 requête SQL)
$detectPM=1; // mettre 0 pour désactiver la détection des Messages Privés. (gain de 1 requête SQL)
//$detectMozilla = (preg_match("#Mozilla#",$_SERVER['HTTP_USER_AGENT']) && !preg_match("#MSIE#",$_SERVER['HTTP_USER_AGENT']) && !preg_matchi("#Opera#",$_SERVER['HTTP_USER_AGENT']) && !preg_match("#Konqueror#",$_SERVER['HTTP_USER_AGENT'])) ? 1 : 0 ;
$detectMozilla=0;
$horizontal=0;
$div=0;
// on récupère le module en page d'accueil (index) et on va tester si on doit faire la gestion des groupes.
// (requêtes regroupées pour optimiser les appels à la DB).
$sql="SELECT t1.invisible, t1.dynamic, t2.main_module FROM ".$prefix."_sommaire AS t1, ".$prefix."_main AS t2 WHERE t1.groupmenu=99 limit 1";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$main_module = $row['main_module'];
$general_dynamic=($row['dynamic']=='on') ? 1 : 0 ;
$type_invisible=$row['invisible'];
if ($gestiongroupe==1) {
	$gestiongroupe = ($row['invisible']=="4" || $row['invisible']=="5") ? 1 : 0 ;
}
else {
	$gestiongroupe=0;
}
//on va tester si le visiteur est un admin et/ou un membre
$is_admin = (is_admin($admin)) ? 1 : 0 ;
$is_user = (sommaire_is_user($user,$gestiongroupe)) ? 1 : 0 ; //cf. fonction sommaire_is_user() en bas
global $userpoints; // défini dans la fonction sommaire_is_user
$userpoints=intval($userpoints); //juste au cas où ;)
$ThemeSel = sommaire_get_theme($is_user); // récupère le thème du membre : évite une requête.
//$pathicon = "themes/$ThemeSel/images/sommaire";
$path_icon = "images/sommaire";
$imgnew="new.gif";
///////////// on récupère les infos pour savoir si le user a des messages privés non lus /////////////////
if ($is_user==1 && $detectPM==1) {
	global $uid;
	$uid=intval($uid); // on sécurise l'appel à la BDD
 	$newpms = $db->sql_fetchrow($db->sql_query("SELECT COUNT(*) FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='$uid' AND (privmsgs_type='5' OR privmsgs_type='1')")); //2 requetes SQL
}
// voilà, si $newpms[0]>0 --> il y a des PMs non lus //
//////// on va mettre la liste des modules dans la variable $modules /////////////////////
$sql = "SELECT * FROM ".$prefix."_modules WHERE active='1' AND inmenu='1' ORDER BY custom_title ASC";
	$modulesaffiche= $db->sql_query($sql);
	$compteur=0;
	while ($tempo = $db->sql_fetchrow($modulesaffiche)) {
		$module[$compteur]= $tempo['title'];
		$customtitle[$compteur] = $tempo['custom_title'];
		$view[$compteur] = $tempo['view'];
		$active[$row['title']] = $tempo['active'];
		$mod_group[$compteur] = ($gestiongroupe==1 && isset($tempo['mod_group'])) ? $tempo['mod_group'] : "";
		$nsngroups[$compteur]=(isset($tempo['groups'])) ? $tempo['groups'] : "" ; // NSN Groups
		$gt_url[$compteur]=(isset($tempo['url'])) ? $tempo['url'] : "" ; //GoogleTap-NextGen
		$compteur++;
		if ($tempo['view']==3) { $gestionsubscription="yes";}
	}
/////// ok, on a les infos de la table modules //////////////
///// on récupère la table des groupes si on gère les groupes, et l'état de souscription ////
if ($is_user==1) {
	if ($gestiongroupe==1 && $gestionsubscription=="yes") {
		$sql="SELECT group.id, group.points, sub.userid, sub.subscription_expire FROM ".$prefix."_groups as group, ".$prefix."_subscriptions as sub WHERE sub.userid=".$uid."";
		$result=$db->sql_query($sql);
		while ($row = $db->sql_fetchrow($sql)) {
			$pointsneeded[$row['id']]=$row['points'];
		echo "$row[subscription_expire]<br />";
		}
	}
	elseif ($gestiongroupe==1) {
		$sql="SELECT id, points FROM ".$prefix."_groups";
		$result=$db->sql_query($sql);
		while ($row = $db->sql_fetchrow($sql)) {
			$pointsneeded[$row['id']]=$row['points'];
			echo "$row[subscription_expire]<br />";
		}
	}
	elseif ($gestionsubscription=="yes") {
		$sql="SELECT id, points FROM ".$prefix."_groups";
		$result=$db->sql_query($sql);
		while ($row = $db->sql_fetchrow($sql)) {
			$pointsneeded[$row['id']]=$row['points'];
			echo "$row[subscription_expire]<br />";
		}
	}
}
///// ok, on connait le nb de points nécessaires pour faire partie de chaque groupe /////
//// on va récupérer le module par défaut dans le thème (s'il existe)
if (file_exists("themes/$ThemeSel/module.php")) {
	include_once("themes/$ThemeSel/module.php");
	$is_active = ($active[$default_module]!=0) ? 1 : 0 ; // permet de savoir si le Default Module est actif.
	if ($is_active==1 AND file_exists("modules/$default_module/index.php")) {
		$main_module = $default_module;
	}
}
$ferme_sublevels="";
$total_actions="";
$flagmenu = 0;  // flag qui est mis automatiquement à "1" quand il y a un module dans la rubrique 99
				// --> permet d'afficher 1 seule fois la barre horizontale.
	// on va mettre les données de la table nuke_sommaire_categories dans les variables adéquates.
	$sql2= "SELECT groupmenu, module, url, url_text, image, new, new_days, class, bold, sublevel, date_debut, date_fin, days FROM ".$prefix."_sommaire_categories ORDER BY id ASC";
	$result2= $db->sql_query($sql2);
	$compteur=0;
	$totalcompteur=0;
	$premier=0;
	$hidden=0;
	$hidden_sublevel=0;
	$now=time(); //attention, variable utile + bas (détection NEW)
	//	echo "{$moduleinthisgroup[$categorie][$compteur]}<br />{$linkinthisgroup[$categorie][$compteur]}<br />{$linktextinthisgroup[$categorie][$compteur]}<br />{$imageinthisgroup[$categorie][$compteur]}<br />";
	while ($row2 = $db->sql_fetchrow($result2)) {
		// on n'affiche rien si cette ligne est 'Hidden' ou Scheduled et hors de la plage de visualisation
		if (strpos($row2['days'],'8')!==false || $now<$row2['date_debut'] || ($row2['date_fin']>0 && $now>$row2['date_fin'])) {
			if ($compteur2!=$row2['groupmenu']) {//on a changé de catégorie, il faut remettre cette variable à 0.
				$hidden_sublevel=0;
			}
				$hidden=1;
				if ($hidden_sublevel==0) {
					$hidden_sublevel=$row2['sublevel'];
				}
				else {
					$hidden_sublevel=($row2['sublevel']<$hidden_sublevel) ? $row2['sublevel'] : $hidden_sublevel;
				}
			continue;
		}
		//lien externe (pas un lien pointant vers un module du site web) ou texte sans url -> on affiche.
		if($row2['module']=="SOMMAIRETEXTONLY" || ($row2['module']=="Lien externe" && !preg_match("#^modules.php\?name=#", $row2['url']) && !preg_match("#^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=#",$row2['url']))) {
			$affiche_module=1;
		}
		else { // module ou lien externe pointant vers un module du site web -> on check si le module est activé et visible pour l'utilisateur.
			$affiche_module=0;
			$restricted_reason="";
			foreach ($module as $key => $zemodule) {
				if ($row2['module']=="Lien externe") {//lien externe pointant vers un module du site web -> on récupère le nom du module
					$temponomdumodule=preg_split("/&/", $row2['url']);
					if (preg_match("#^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=#",$row2['url'])) { // v2.1.2beta5 : les liens externes target blank qui pointent vers le serveur sont traités comme des modules.
						$nomdumodule = substr(strstr($temponomdumodule[0],'modules.php'),17);
						$targetblank="target=\"_blank\"";
					}
					elseif (preg_match("#^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=#",$row2['url'])) { // v2.1.2beta6 : les liens externes target blank qui pointent vers le serveur sont traités comme des modules.
						$nomdumodule = substr(strstr($temponomdumodule[0],'modules.php'),17);
						$targetblank="";
					}
					else {
						$nomdumodule = preg_replace("#modules.php\?name=#","",$temponomdumodule[0]);
						$targetblank="";
					}
					$customtitle2 =$row2['url_text'];
					$urldumodule =$row2['url'];
				}
				else {//module normal
					$temponomdumodule=array();//beta8 : on vide cette variable car il n'y a aucun paramètre dans l'url.
					$targetblank="";
					$nomdumodule =$row2['module'];
					$customtitle2 = ($customtitle[$key] != "") ? $customtitle[$key] : preg_replace("#_#", " ", $zemodule);
					$urldumodule = ($gt_url[$key]!="") ? $gt_url[$key] : "modules.php?name=".$nomdumodule ; //GT-NextGen
				}
				if (!($zemodule==$main_module && $row2['module']!="Lien externe")) {//on n'affiche pas le module en homepage, sauf s'il est appelé par un lien externe
					if (($is_admin===1 AND $view[$key] == 2) OR $view[$key] != 2) { //si on n'est pas admin et que le module est réservé aux admins, il n'apparaît pas
						if ($nomdumodule==$zemodule) { //le module de la boucle FOR correspond au module en cours, on va checker les droits de visualisation des groupes
							//gestion des groupes phpnuke
							$isin=0;
							if ($is_user==1 && ($type_invisible==5 || $type_invisible==4) && $view[$key]==1){
								$isin = ($mod_group[$key]==0 || ($userpoints>0 && $userpoints>=$pointsneeded[$mod_group[$key]])) ? 1 : 0 ;
							}
							if($is_user==1 && $view[$key]==1 && $type_invisible==4 && $isin==0) {// c'est un membre, qui n'est pas dans le groupe pouvant visualiser ce module
								$affiche_module=2;
								$restricted_reason=""._SOMRESTRICTEDGROUP."";
								break;
							}
							elseif ($is_user==0 && $view[$key]==1 && ($type_invisible==2 || $type_invisible==4)) {//visiteur non membre, ne peut pas visualiser un module réservé aux membres.
								$affiche_module=2;
								$restricted_reason=""._SOMRESTRICTEDMEMBERS."";
								break;
							}
							elseif ($view[$key]==3 && !paid()) {
								$affiche_module=2;
								$restricted_reason=""._SOMRESTRICTEDPAID."";
								break;
							}
							elseif ($view[$key]>3 && ($type_invisible==2 || $type_invisible==4) && !in_groups($nsngroups[$key])) {//nsn groups
								$affiche_module=2;
								$restricted_reason=""._SOMRESTRICTEDGROUP."";
								break;
							}
							if ($is_user==1 && $view[$key]==1 && $type_invisible==5 && $isin==0 && $is_admin==0) { //c'est un membre, mais pas dans le bon groupe pour voir le module.
								if ($compteur2!=$row2['groupmenu']) {//on a changé de catégorie, il faut remettre cette variable à 0.
									$hidden_sublevel=0;
								}
								$hidden=1;
								if ($hidden_sublevel==0) {
									$hidden_sublevel=$row2['sublevel'];
								}
								else {
									$hidden_sublevel=($row2['sublevel']<$hidden_sublevel) ? $row2['sublevel'] : $hidden_sublevel;
								}
							}
							elseif($is_user==0 && $view[$key]==1 && ($type_invisible==5 || $type_invisible==3) && $is_admin==0) { //c'est un visiteur, il doit être membre et faire partie d'un groupe pour voir le module si gestion des groupes.
								if ($compteur2!=$row2['groupmenu']) {//on a changé de catégorie, il faut remettre cette variable à 0.
									$hidden_sublevel=0;
								}
								$hidden=1;
								if ($hidden_sublevel==0) {
									$hidden_sublevel=$row2['sublevel'];
								}
								else {
									$hidden_sublevel=($row2['sublevel']<$hidden_sublevel) ? $row2['sublevel'] : $hidden_sublevel;
								}
							}
							elseif ($view[$key]==3 && !paid()) {
								if ($compteur2!=$row2['groupmenu']) {//on a changé de catégorie, il faut remettre cette variable à 0.
									$hidden_sublevel=0;
								}
								$hidden=1;
								if ($hidden_sublevel==0) {
									$hidden_sublevel=$row2['sublevel'];
								}
								else {
									$hidden_sublevel=($row2['sublevel']<$hidden_sublevel) ? $row2['sublevel'] : $hidden_sublevel;
								}
							}
							elseif ($view[$key]>3 && ($type_invisible==3 || $type_invisible==5) && !in_groups($nsngroups[$key])) {//nsn groups
								if ($compteur2!=$row2['groupmenu']) {//on a changé de catégorie, il faut remettre cette variable à 0.
									$hidden_sublevel=0;
								}
								$hidden=1;
								if ($hidden_sublevel==0) {
									$hidden_sublevel=$row2['sublevel'];
								}
								else {
									$hidden_sublevel=($row2['sublevel']<$hidden_sublevel) ? $row2['sublevel'] : $hidden_sublevel;
								}
							}
							else {
								$affiche_module=1;
							}
							break;
						}
					}
				}
			}
		}
		if ($affiche_module>0) {//si $affiche_module est =0, le visiteur ne peut pas voir le module, donc on ne remplit pas le tableau.
			$categorie=$row2['groupmenu'];
			$totalcategorymodules[$totalcompteur]=$row2['module'];
			$totalcompteur++;
			if ($premier==0) {
				$premier++;
				$total_actions="sommaire_showhide('sommaire-".$row2['groupmenu']."','nok','sommaireupdown-".$row2['groupmenu']."');";
			}
			elseif ($compteur2==$categorie) { //permet de savoir si on a changé de catégorie (groupmenu différent) : dans ce cas on remet le 2ème compteur à 0.
			$compteur++;
			}
			else {
				$total_actions=$total_actions."sommaire_showhide('sommaire-".$row2['groupmenu']."','nok','sommaireupdown-".$row2['groupmenu']."');";
				$compteur=0;
				$hidden_sublevel=0;
				$hidden=0;
			}
			if ($compteur==0 && $row2['sublevel']>0) { //premier module de la catégorie, on met le sublevel à 0.
				$hidden=1;
				$hidden_sublevel=0;
				$row2['sublevel']=0;
			}
			elseif ($row2['sublevel']>$hidden_sublevel && $hidden==1) {
				$row2['sublevel']=$row2['sublevel']-$hidden_sublevel;
				if ($hidden_sublevel==0) {
					$row2['sublevel']--;
				}
			}
			else {
				$hidden_sublevel=0;
				$hidden=0;
			}
			$moduleinthisgroup[$categorie][$compteur]=$row2['module'];
			$linkinthisgroup[$categorie][$compteur]=$row2['url'];
			$linktextinthisgroup[$categorie][$compteur]=$row2['url_text'];
			$imageinthisgroup[$categorie][$compteur]=$row2['image'];
			$newinthisgroup[$categorie][$compteur]=$row2['new'];
			$newdaysinthisgroup[$categorie][$compteur]=$row2['new_days'];
			$classinthisgroup[$categorie][$compteur]=$row2['class'];
			$grasinthisgroup[$categorie][$compteur]=$row2['bold'];
			$sublevelinthisgroup[$categorie][$compteur]=$row2['sublevel'];
			$date_debutinthisgroup[$categorie][$compteur]=$row2['date_debut'];
			$date_fininthisgroup[$categorie][$compteur]=$row2['date_fin'];
			$daysinthisgroup[$categorie][$compteur]=$row2['days'];
			//v2.5
			$nomdumoduleinthisgroup[$categorie][$compteur]=$nomdumodule;
			$targetblankinthisgroup[$categorie][$compteur]=$targetblank;
			$customtitle2inthisgroup[$categorie][$compteur]=$customtitle2;
			$urldumoduleinthisgroup[$categorie][$compteur]=$urldumodule;
			$affiche_moduleinthisgroup[$categorie][$compteur]=$affiche_module;
			$whyrestricted[$categorie][$compteur]=$restricted_reason;
			$restricted_reason="";
			$compteur2=$categorie;
			//	echo "{$moduleinthisgroup[$categorie][$compteur]}<br />{$linkinthisgroup[$categorie][$compteur]}<br />{$linktextinthisgroup[$categorie][$compteur]}<br />{$imageinthisgroup[$categorie][$compteur]}<br />";
		}
	}
// --> OK, les variables ont pris la valeur adéquate de la table nuke_sommaire_categories
$content ="
<!-- Sommaire realise grace au module Sommaire Parametrable v.3.0 b1 - ©marcoledingue - marcoledingue .-:@at@:-. free.fr -->";
?>
<script type="text/javascript" language="JavaScript">
function sommaire_envoielistbox(page) {
	var reg= new RegExp('(_sommaire_targetblank)$','g');
	if (reg.test(page)) {
		page=page.replace(reg,"");
		window.open(page,'','menubar=yes,status=yes, location=yes, scrollbars=yes, resizable=yes');
	}else if (page!="select") {
			top.location.href=page;
	}
}				
function sommaire_ouvre_popup(page,nom,option) {
	window.open(page,nom,option);
}
</script>
<style type="text/css">
.sommairenowrap {white-space: nowrap;}
</style>
<?php
	$dynamictest=0;
	// Ensuite, on charge la table nuke_sommaire //
    $sql = "SELECT groupmenu, name, image, lien, hr, center, bgcolor, invisible, class, bold, new, listbox, dynamic, date_debut, date_fin, days FROM ".$prefix."_sommaire ORDER BY groupmenu ASC";
    $result = $db->sql_query($sql);
	$content.="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	$content.="<tr><td width=\"100%\"></td><td id=\"sommaire_block\"></td></tr>";
	if ($horizontal==1) {
		$content.="<tr>";
	}
	$classpointeur=0;
    while ($row = $db->sql_fetchrow($result)) {  // on va afficher chaque catégorie, puis les modules correspondants//
		$som_groupmenu = $row['groupmenu'];
		$som_name = preg_replace("#&amp;nbsp;#","&nbsp;",$row['name']);
		$som_image = $row['image'];
		$som_lien = $row['lien'];
		$som_hr = $row['hr'];
		$som_center = $row['center'];
		$som_bgcolor = $row['bgcolor'];
		$invisible[$classpointeur] = $row['invisible'];
		$categoryclass[$classpointeur] = $row['class'];
		$som_bold = $row['bold'];
		$som_new = $row['new'];
		$som_listbox = $row['listbox'];
		$som_dynamic = ($general_dynamic==0) ? '' : $row['dynamic']; //si on a désactivé le menu dynamique, aucune catégorie ne doit être dynamique.
		$som_date_debut=$row['date_debut'];
		$som_date_fin=$row['date_fin'];
		$som_days=$row['days'];
		$keysommaire=$row['groupmenu'];
		if (strpos($som_days,'8')!==false || $now<$som_date_debut || ($som_date_fin>0 && $now>$som_date_fin)) {//la catégorie n'est pas affichée car elle est 'hidden' ou hors de la durée de visualisation
			//echo $som_groupmenu;
			$aenlever="sommaire_showhide\('sommaire-".$som_groupmenu."','nok','sommaireupdown-".$som_groupmenu."'\);";
			$total_actions = preg_replace("#$aenlever#", "" , $total_actions);
			continue;
		}
		if ($som_dynamic!='on') {//si la catégorie est toujours ouverte, il faut enlever sa référence dans $total_actions.
			$aenlever="sommaire_showhide\('sommaire-".$som_groupmenu."','nok','sommaireupdown-".$som_groupmenu."'\);";
			$total_actions = preg_replace("#$aenlever#", "" , $total_actions);
		}
		if ($general_dynamic==1 && $dynamictest!=1 && $detectMozilla!=1) {
			//$dynamic=1;
			?>
			<script type="text/javascript" language="JavaScript">
			var keysommaire;
			function sommaire_showhide(tableau, trigger, somimagename) {
				if (document.getElementById(tableau) && document.images[somimagename] && document.getElementById(tableau).style.display == "none" && trigger!="nok") {
					var sommaire_block=document.getElementById('sommaire_block');
					document.getElementById(tableau).style.display = "<?php if ($div==1) {echo "";} ?>";
					document.images[somimagename].src="<?php echo $path_icon;?>/admin/up.gif";
				}
				else if(document.getElementById(tableau) && document.images[somimagename]) {
					var reg= new RegExp("<?php echo $path_icon;?>/admin/up.gif$","gi");
					if (reg.test(document.images[somimagename].src)) {
						document.images[somimagename].src="<?php echo $path_icon;?>/admin/down.gif";
					}
					document.getElementById(tableau).style.display = "none";
				}
			}
			</script>
			<?php
		}
		$dynamictest=1;
		if ($som_hr == "on" && $horizontal!=1) {
			$content.="<tr><td><hr width=\"100%\"></td></tr>"; //15 mars 2005 : ajout de width=100%
		}
		if ($som_groupmenu <> 99) {
			if ($som_dynamic=='on' && $detectMozilla!=1 && isset($moduleinthisgroup[$som_groupmenu]['0']) && $som_listbox!="on") { // si on a des liens/modules dans cette catégorie (catégorie non vide), et que ce n'est pas une listbox
				$reenrouletout=preg_replace("#sommaire_showhide\(\'sommaire-$som_groupmenu\',\'nok\',\'sommaireupdown-$som_groupmenu\'\);#","",$total_actions);
				$action_somgroupmenu="onclick=\"keysommaire=".$keysommaire.";".$reenrouletout." sommaire_showhide('sommaire-$som_groupmenu','ok','sommaireupdown-$som_groupmenu')\" style=\"cursor:pointer\""; // menu dynamique
			}
			else {
			$action_somgroupmenu="";
			}
			if ($horizontal==1) {
				$content.="<td bgcolor=\"$som_bgcolor\" width=\"4\"></td>
				<td bgcolor=\"$som_bgcolor\" class=\"sommairenowrap\" valign=\"top\"><table class=\"sommairenowrap\"><tr><td $action_somgroupmenu>";	
			}
			else {
				$positioningtd = ($div==1) ? "" : "" ;
			$content.="
						<tr bgcolor=\"$som_bgcolor\"><td height=\"4\" width=\"100%\"></td><td id=\"sommaire_divsublevel$keysommaire\"></td></tr>
						<tr><td bgcolor=\"$som_bgcolor\" class=\"sommairenowrap\" width=\"100%\" $action_somgroupmenu>";
			}
			if ($som_center=="on") {
				$content.="<div align=\"center\">";
			}
			if ($som_lien<>"") {
				if (strpos($som_lien,"LANG:_")===0) { // gestion multilingue
					$som_lien = str_replace("LANG:","",$som_lien);
					eval( "\$som_lien = $som_lien;");
				}//fin gestion multilingue
				$testepopup=strpos($som_lien,"javascript:window.open(");
				if ($testepopup===0) {
					$som_lien = str_replace("window.open","sommaire_ouvre_popup",$som_lien);
					$content.="<a href=\"$som_lien\"";
				}
				else {
				$content.="<a href=\"$som_lien\"";
				$testehttp=strpos($som_lien,"http://");
				$testehttps=strpos($som_lien,"https://");
				$testeftp=strpos($som_lien,"ftp://");
				if ($testehttp===0 || $testeftp===0 || $testehttps===0) {
					$content.=" target=\"_blank\"";
				}
				$content.=">";
				}
			}
			if ($som_image<> "noimg") {
/************************************************************************************/
/*                 Modifications par MAC06  17/07/2003                              */
/*                  http://visiondesign.free.fr                                     */
/*                     magetmac06@hotmail.com                                       */
/*  Les modifs permettent d'inserer soit un swf (Flash), soit une image normale.    */
/*  Les images et les swf doivent etre placés dans "images/sommaire/".              */
/************************************************************************************/
				if (preg_match("#.swf#",$som_image)) { //////////////////// support des fichiers FLASH - par MAC06 //////////////////////////
					$content .= "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\"179\" height=\"20\" id=\"$som_groupmenu\"><PARAM NAME=movie VALUE=\"$path_icon/$som_image\"><param name=quality value=high><embed src=\"$path_icon/$som_image\" quality=high width=\"160\" height=\"20\" type=\"application/x-shockwave-flash\" wmode=\"transparent\"></embed></object><br />";
        		}
				else {
				$fermebalise= ($som_lien!="") ? "</a>" : "" ;
					$content.="<img src=\"$path_icon/$som_image\" border=\"0\" alt=\"$som_image\">".$fermebalise."&nbsp;";
				}
			}
			 // gestion multilingue : si le nom de catégorie commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
			if (strpos($som_name,"LANG:_")===0) {
				$som_name = str_replace("LANG:","",$som_name);
				eval( "\$som_name = $som_name;");
			}//fin gestion multilingue
			if (preg_match("#.swf#",$som_image) || $som_name=="" || $som_name==" " ||$som_name=="&nbsp;" ||$som_name=="&amp;nbsp;") { //////////////////// support des fichiers FLASH - par MAC06 -+- marcoledingue : ajout du second check, qui permet d'avoir des catégories avec un nom vide. //////////////////////////
				$no_category_text[$som_groupmenu]=1;
			}
			else {
				if ($som_lien<>"") {
				 // gestion multilingue : si l'url de catégorie commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
					if (strpos($som_lien,"LANG:_")===0) {
						$som_lien = str_replace("LANG:","",$som_lien);
						eval( "\$som_lien = $som_lien;");
					}//fin gestion multilingue
					$testepopup=strpos($som_lien,"javascript:window.open(");
					if ($testepopup===0) {
						$som_lien = str_replace("window.open","sommaire_ouvre_popup",$som_lien);
						$content.="<a href=\"$som_lien\"";
					}
					else {
						$content.="<a href=\"$som_lien\"";
						$testehttp=strpos($som_lien,"http://");
						$testeftp=strpos($som_lien,"ftp://");
						$testehttps=strpos($som_lien,"https://");
						if ($testehttp===0 || $testeftp===0 ||$testehttps===0) {
							$content.=" target=\"_blank\"";
						}
					}
				$content.=" class=\"$categoryclass[$classpointeur]\">";
				}
				$content.="<span class=\"$categoryclass[$classpointeur]\">";
				$bold1 = ($som_bold=="on") ? "<strong>" : "" ;
				$bold2 = ($som_bold=="on") ? "</strong>" : "" ;
				$new = ($som_new=="on") ? "<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\" alt=\""._SOMNEWCONTENT."\">" : "" ;
				$content.="".$bold1."$som_name".$bold2."".$new."";
			}
			$content.="</span>";
			if ($som_lien<>"") {
				$content.="</a>";
			}
			if ($som_dynamic=='on' && $detectMozilla!=1 && isset($moduleinthisgroup[$som_groupmenu]['0'])) {
				$zeimage = ($som_listbox=="on") ? "null.gif" :"down.gif" ;
				$content.="<img align=\"bottom\" id=\"sommaireupdown-$som_groupmenu\" src=\"$path_icon/admin/$zeimage\" border=0 alt=\"Show/Hide content\">";
			}
			if ($som_center=="on") {
				$content.="</div>";
			}
			if ($div==1) {
				$content.="</td><td style=\"vertical-align: top;\">";
			}
			elseif ($horizontal==1) {
				$content.="</td></tr>\n";
			}
			else {
				$content.="</td></tr>\n";
			}
		}
		$keyinthisgroup=0;
		if ($som_groupmenu!=99 && !isset($moduleinthisgroup[$som_groupmenu]['0'])) { // 15 mars 2005 : si la catégorie ne contient pas de module/lien, on doit afficher quand même le décalage de 4px !
			//$content.="<tr><td bgcolor=\"$som_bgcolor\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td></td></tr></table></td></tr>";
			if ($horizontal==1) {
				$content.="</table></td><td width=\"4\" bgcolor=\"$som_bgcolor\"></td>";
			}
			else {
				$content.="<tr bgcolor=\"$som_bgcolor\"><td height=\"4\"></td></tr>";
			}
		}
		elseif ($som_groupmenu!=99 && isset($moduleinthisgroup[$som_groupmenu]['0'])) {
		if ($som_listbox=="on") {// on désactive le réenroulage automatique si le menu est dynamique.
			$content.="<tr><td bgcolor=\"$som_bgcolor\"><span id=\"sommaire-$som_groupmenu\"></span>";
			$aenlever="sommaire_showhide\('sommaire-".$som_groupmenu."','nok','sommaireupdown-".$som_groupmenu."'\);";
			$total_actions = preg_replace("#$aenlever#", "" , $total_actions);
			$content.="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"sommairenowrap\"><tr><td width=\"100%\">";
			$content.="<form action=\"modules.php\" method=\"get\" name=\"sommaireformlistbox\">"
					."<select name=\"somlistbox$keysommaire\" onchange=\"sommaire_envoielistbox(this.options[this.selectedIndex].value)\">"
					."<option value=\"select\">"._SOMSELECTALINK."";
		}
		else {
			if($div==1) {
				if (!$som_bgcolor) {
					$divbgcolor=(!$bgcolor1) ? "#ffffff" : $bgcolor1;
				}
				else {
					$divbgcolor=$som_bgcolor;
				}
				//$content.="<tr><td></td><td>";
				$content.="<table id=\"sommaire-$som_groupmenu\" style=\"position: absolute; z-index: 2; background-color:".$divbgcolor."; border: 1px solid ".$bgcolor2.";\"><tr><td>";
			}
			else {
				$content.="<tr id=\"sommaire-$som_groupmenu\"><td bgcolor=\"$som_bgcolor\" width=\"100\">";
			}
			$content.="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"sommairenowrap\">";
		}
		if ($som_image<>"noimg" && !preg_match("#.swf#",$som_image) && $som_center<>"on") { ///////////////////////////support des fichiers FLASH - par MAC06 /////////////////////////
			$catimagesize = getimagesize("$path_icon/$som_image");//là on va récupérer la largeur de l'image de la catégorie, pour aligner les modules avec le titre de la catégorie.
		}
		else {
			$catimagesize[0]=1; //2.1.2beta5 : corrige un problème d'affichage avec les middot pour un menu sans image
		}
		while ($moduleinthisgroup[$som_groupmenu][$keyinthisgroup]) { //on va checker si chaque module indiqué dans la catégorie en cours est installé et activé/visible //
			// on n'affiche rien si cette ligne est 'Hidden' ou Scheduled et hors de la plage de visualisation
			if (strpos($daysinthisgroup[$som_groupmenu][$keyinthisgroup],'8')!==false || $now<$date_debutinthisgroup[$som_groupmenu][$keyinthisgroup] || ($date_fininthisgroup[$som_groupmenu][$keyinthisgroup]>0 && $now>$date_fininthisgroup[$som_groupmenu][$keyinthisgroup])) {
				$keyinthisgroup++;
				continue;
			}
			if ($grasinthisgroup[$som_groupmenu][$keyinthisgroup]=="on") { // va mettre le lien en gras si indiqué.
				$gras1="<strong>";
				$gras2="</strong>";
			}
			else {
				$gras1 = $gras2 = "";
			}
			if ($som_listbox=="on") { // gestion des listbox
				if ($moduleinthisgroup[$som_groupmenu][$keyinthisgroup]=="Lien externe") {
					 // gestion multilingue : si le lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
					if (strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"LANG:_")===0) {
						$zelink_lang = str_replace("LANG:","",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
						eval( "\$zelink_lang = $zelink_lang;");
						$linkinthisgroup[$som_groupmenu][$keyinthisgroup] = $zelink_lang;
					}//fin gestion multilingue
					$testehttp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"http://");
					$testeftp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"ftp://");
					$testehttps=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"https://");
					$testepopup=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"javascript:window.open(");
					if ($testehttp===0 || $testeftp===0 || $testehttps===0) {
						$zelink= "_sommaire_targetblank";
					}
					elseif ($testepopup===0) {
						$zelink=" target=\"popup_sommaire\"";
					}
					else {
						$zelink="";
					}
					// gestion multilingue : si le texte du lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
					$linklang=$linktextinthisgroup[$som_groupmenu][$keyinthisgroup];
					if (strpos($linklang,"LANG:_")===0) {
						$linklang = str_replace("LANG:","",$linklang);
						eval( "\$linklang = $linklang;");
						if ($linklang=="") {$keyinthisgroup++;continue;} //2.1.2beta4 : permet de ne pas afficher la ligne si le texte du lien n'a pas été défini pour cette langue.
						$linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=$linklang;
					}//fin gestion multilingue
					$content.= "<option value=\"".$linkinthisgroup[$som_groupmenu][$keyinthisgroup]."".$zelink."\">".$linktextinthisgroup[$som_groupmenu][$keyinthisgroup]."";
				}
				elseif($moduleinthisgroup[$som_groupmenu][$keyinthisgroup]!="SOMMAIRE_HR" && $moduleinthisgroup[$som_groupmenu][$keyinthisgroup]!="SOMMAIRETEXTONLY" ) {// on n'affiche pas les textes qui n'ont pas de lien, et les modules invisibles
					// si affiche_moduleinthisgroup=2, c'est que invisible=4 (module affiché avec icone 'interdit') : le module est resté dans la liste (si il doit être affiché dans une catégorie 'normale'). mais dans la listbox, il ne faut pas l'afficher
					if ($affiche_moduleinthisgroup[$som_groupmenu][$keyinthisgroup]!=2 || $is_admin==1) {
						$content.="<option value=\"".$urldumoduleinthisgroup[$som_groupmenu][$keyinthisgroup]."\">".$customtitle2inthisgroup[$som_groupmenu][$keyinthisgroup]."";
					}
				}
			}
			elseif($moduleinthisgroup[$som_groupmenu][$keyinthisgroup]=="SOMMAIRETEXTONLY" || ($moduleinthisgroup[$som_groupmenu][$keyinthisgroup]=="Lien externe" && !preg_match("#^modules.php\?name=#", $linkinthisgroup[$som_groupmenu][$keyinthisgroup]) && !preg_match("#^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=#",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]))) { // gestion des liens externes - v2.1.2beta5 : ajout d'un check supplémentaire pour gérer les liens externes (target blank mais sur le serveur)
					 // gestion multilingue : si le lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
				if (strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"LANG:_")===0) {
					$zelink_lang = str_replace("LANG:","",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
					eval( "\$zelink_lang = $zelink_lang;");
					$linkinthisgroup[$som_groupmenu][$keyinthisgroup] = $zelink_lang;
				}//fin gestion multilingue
				$testepopup=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"javascript:window.open(");
				if ($testepopup===0) {
							$linkinthisgroup[$som_groupmenu][$keyinthisgroup] = str_replace("window.open","sommaire_ouvre_popup",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
							$zelink="";
							}
				else {
					$testehttp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"http://");
					$testeftp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"ftp://");
					$testehttps=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"https://");
					if ($testehttp===0 || $testeftp===0 || $testehttps===0) {
						$zelink= " target=\"_blank\"";
					}
					else {
						$zelink="";
					}
				}
			// gestion multilingue : si le texte du lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
			$linklang=$linktextinthisgroup[$som_groupmenu][$keyinthisgroup];
			if (strpos($linklang,"LANG:_")===0) {
				$linklang = str_replace("LANG:","",$linklang);
				eval( "\$linklang = $linklang;");
				if ($linklang=="") {$keyinthisgroup++;continue;} //2.1.2beta4 : permet de ne pas afficher la ligne si le texte du lien n'a pas été défini pour cette langue.
				$linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=$linklang;
			}//fin gestion multilingue
							//sublevels - ouvre
				if ($keyinthisgroup==0) {
					$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]=0;
					$current_sublevel=0;
				}
				if ($sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]>$current_sublevel) {
					if ($imageinthisgroup[$som_groupmenu][$keyinthisgroup-1]=='tree-T.gif') {
						$zebar="background: url($path_icon/categories/bar.gif) right top repeat-y;";
					}
					else {
						$zebar="";
					}
					$catimagesize[0]=0;
					if ($div==1) {
						$sublevelzindex=$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]+2;
						$content.="<td style=\"vertical-align: top;\"><table id=\"".$id_sublevel."\" cellpadding=0 cellspacing=0 border=0 class=\"sommairenowrap\" style=\"position: absolute; z-index: ".$sublevelzindex."; border: 1px solid ".$bgcolor2."; background-color: ".$bgcolor1.";\">";
					}
					else {
					$content.="<tr id=\"".$id_sublevel."\"><td style=\"align: right;".$zebar."\"></td><td><table cellpadding=0 cellspacing=0 border=0 class=\"sommairenowrap\">";
					}
					$id_sublevel="";
					$id_sublevel_img="";
					$current_sublevel++;
				}
				//sublevels - showhide
				if ($keyinthisgroup<count($moduleinthisgroup[$som_groupmenu])-1 && $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]) {
					$ligne=($som_dynamic=='on') ? "<tr style=\"cursor: pointer;\" onclick=\"sommaire_showhide('sommairesublevel-$som_groupmenu-".($keyinthisgroup+1)."','ok','sommaireupdown-sublevel-$som_groupmenu-".($keyinthisgroup+1)."');\">" : "<tr>"; // onclick=\"sommaire_showhide('sommairesublevel-$som_groupmenu-$keyinthisgroup','ok','sommaireupdown-sublevel-$som_groupmenu-$keyinthisgroup');\"
					$id_sublevel="sommairesublevel-$som_groupmenu-".($keyinthisgroup+1);
					$id_sublevel_img="sommaireupdown-sublevel-$som_groupmenu-".($keyinthisgroup+1);
					$ferme_sublevels.= ($som_dynamic=='on') ? "sommaire_showhide('$id_sublevel','nok','$id_sublevel_img');" :  "" ;
					$sublevel_updownimg=($som_dynamic=='on') ? "<img id=\"".$id_sublevel_img."\" src=\"$path_icon/admin/up.gif\" alt=\"Show/Hide content\" border=0>" : "";
				}
				else {
					$ligne="<tr>";
					$sublevel_updownimg="";
				}
			$new = ($newinthisgroup[$som_groupmenu][$keyinthisgroup]=="on") ? "<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\" alt=\""._SOMNEWCONTENT."\">" : "" ;
			$imagedulien="<img src=\"$path_icon/categories/".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\" border=0 alt=\"".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\">";
			if ($linkinthisgroup[$som_groupmenu][$keyinthisgroup]) { // v212b4 : n'affiche aucun lien si la case LIEN est vide.
				$lelien="<a href=\"".$linkinthisgroup[$som_groupmenu][$keyinthisgroup]."\"".$zelink." class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\">";
				$close_lelien="</a>";
			}
			else {
				$lelien="";
				$close_lelien="";
			}
			$letexte="<span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\">".$linktextinthisgroup[$som_groupmenu][$keyinthisgroup]."</span>";
				if ($imageinthisgroup[$som_groupmenu][$keyinthisgroup]<>"middot.gif" && ($linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=="" || $linktextinthisgroup[$som_groupmenu][$keyinthisgroup]==" " || $linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=="&nbsp;" || $linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=="&amp;nbsp;")) { //si le texte du lien est vide l'image va être clickable
					$content.=$ligne."<td colspan=2 width=\"100%\">".$lelien.$imagedulien.$close_lelien.$new.""; //v2.1.2b4 : ajout de la variable $close_lelien
					$content.=$sublevel_updownimg."</td></tr>\n";
				}
				elseif ($imageinthisgroup[$som_groupmenu][$keyinthisgroup]<>"middot.gif") { //si le texte n'est pas vide
					if ($no_category_text[$som_groupmenu]===1) {	//V2.1.2beta3
						$content.=$ligne."<td colspan=2 align=\"left\" width=\"100%\">".$imagedulien."&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; //v2.1.2beta4 : ajout de $close_lelien
					}
					else {
						$content.=$ligne."<td width=\"$catimagesize[0]\" align=\"right\">".$imagedulien."</td><td>&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; //v2.1.2beta4 : ajout de $close_lelien
					}
					$content.=$sublevel_updownimg."</td></tr>\n";
				}
				else { // si l'image utilisée est le middot
					if ($no_category_text[$som_groupmenu]===1) {	//V2.1.2beta3
					// v2.1.2beta7 : ajout de la classe pour le middot
						$content.=$ligne."<td colspan=2 align=\"left\" width=\"100%\"><span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\"><strong><big>&middot;</big></strong></span>&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; //v2.1.2beta4 : ajout de $close_lelien
					}
					else {
						$content.=$ligne."<td width=\"$catimagesize[0]\" align=\"right\"><span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\"><strong><big>&middot;</big></strong></span></td><td>&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; //v2.1.2beta4 : ajout de $close_lelien
					}
					$content.=$sublevel_updownimg."</td></tr>\n";
				}
				//sublevels - ferme
				if ($keyinthisgroup==count($moduleinthisgroup[$som_groupmenu])-1) {//on referme tous les sublevels, car on est au dernier lien de la catégorie
					for($sub=0;$sub<$current_sublevel;$sub++) {
						$content.="</table></td></tr>";
					}
				}
				elseif ($current_sublevel>$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]) {
					for($sub=0;$sub<($current_sublevel-$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]);$sub++) {
						$content.="</table></td></tr>";
					}
					$current_sublevel=$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1];
				}
			}
			elseif ($moduleinthisgroup[$som_groupmenu][$keyinthisgroup]=="SOMMAIRE_HR") {
				$content.="<tr><td colspan=2>";
				$content.="<hr>";
				$content.="</td></tr>\n";
			}
			else {// un module normal, ou bien un lien interne (lien externe vers une page spécifique d'un module du site)
				if ($moduleinthisgroup[$som_groupmenu][$keyinthisgroup]=="Lien externe") { //si c'est un lien externe, il commence par 'modules.php?name=' ==>c'est un lien vers un module du site
					$temponomdumodule=preg_split("/&/", $linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
					//v2.5
					$nomdumodule=$nomdumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];
					$targetblank=$targetblankinthisgroup[$som_groupmenu][$keyinthisgroup];
					$customtitle2=$customtitle2inthisgroup[$som_groupmenu][$keyinthisgroup];
					$urldumodule=$urldumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];
					// gestion multilingue : si le lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
					if (strpos($urldumodule,"LANG:_")===0) {
						$zelink_lang = str_replace("LANG:","",$urldumodule);
						eval( "\$zelink_lang = $zelink_lang;");
						$urldumodule = $zelink_lang;
					}//fin gestion multilingue
					// gestion multilingue : si le texte du lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
					$linklang=$customtitle2;
					if (strpos($linklang,"LANG:_")===0) {
						$linklang = str_replace("LANG:","",$linklang);
						eval( "\$linklang = $linklang;");
						if ($linklang=="") {$keyinthisgroup++;continue;} //2.1.2beta7 : permet de ne pas afficher la ligne si le texte du lien n'a pas été défini pour cette langue.
						$customtitle2=$linklang;
					}//fin gestion multilingue
				}
				else {
					$temponomdumodule=array(); //beta8 : on vide cette variable car il n'y a aucun paramètre dans l'url.
					//v2.5
					$nomdumodule=$nomdumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];
					$targetblank=$targetblankinthisgroup[$som_groupmenu][$keyinthisgroup];
					$customtitle2=$customtitle2inthisgroup[$som_groupmenu][$keyinthisgroup];
					$urldumodule=$urldumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];
				}
				//v2.5
				if ($som_dynamic=='on' && $detectMozilla!=1) {
					//détection améliorée de la catégorie à ouvrir
					$temprequesturi=preg_split('/&/',$_SERVER['REQUEST_URI']);
					$tempurldumodule=preg_split('/&/',$urldumodule);
					$nbparam=count($tempurldumodule);
					$nbrequest=count($temprequesturi);
					$requesturi=$temprequesturi[0];
					if ($nbparam<=$nbrequest) {
						for ($i=1;$i<$nbparam;$i++) {
							$requesturi.="&".$temprequesturi[$i];
						}
					}
					if (preg_match(addcslashes("#$urldumodule$#", '?&'), $requesturi)) { // si la page visualisée est le module[$z], alors on récupère son groupmenu pour ne pas enrouler la catégorie par défaut.
						$categorieouverte=$som_groupmenu;
						$keyouvert=$keyinthisgroup;
					}
				}
				if ($imageinthisgroup[$som_groupmenu][$keyinthisgroup]!="middot.gif") {
					$limage="<img src=\"$path_icon/categories/".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\" border=\"0\" alt=\"".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\">";
				}
				else {
					$limage="<strong><big>&middot;</big></strong>";
				}
				//v2.5
				if ($affiche_moduleinthisgroup[$som_groupmenu][$keyinthisgroup]==2) {
					$limage="<img src=\"$path_icon/admin/interdit.gif\" title=\"".$whyrestricted[$som_groupmenu][$keyinthisgroup]."\" alt=\"".$whyrestricted[$som_groupmenu][$keyinthisgroup]."\">";
				}
				if (($newpms[0]) AND ($nomdumodule =="Private_Messages")) {
					$disp_pmicon="<img src=\"images/blocks/email-y.gif\" height=\"10\" width=\"14\" alt=\""._SOMNEWPM."\" title=\""._SOMNEWPM."\">";
				}
				else {
					$disp_pmicon="";
				}
				////// ajout support NEW! automatique pour les modules de base.
				$new = ($newinthisgroup[$som_groupmenu][$keyinthisgroup]=="on") ? "<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\" alt=\""._SOMNEWCONTENT."\">" : "" ;
				if ($nomdumodule=="Downloads" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
					$where = (preg_match("#^cid=[0-9]*$#",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
					$sqlimgnew="SELECT date FROM ".$prefix."_downloads_downloads".$where." order by date desc limit 1";
					$resultimgnew=$db->sql_query($sqlimgnew);
					$rowimgnew = $db->sql_fetchrow($resultimgnew);
					if ($rowimgnew['date']) {
						preg_match("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $rowimgnew['date'], $datetime);
						$zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
						//$now=time();
						if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
							$new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\" alt=\""._SOMNEWCONTENT."\">";
						}
					}
				}
				elseif ($nomdumodule=="Web_Links" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
					$where = (preg_match("#^cid=[0-9]*$#",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
					$sqlimgnew="SELECT date FROM ".$prefix."_links_links".$where." order by date desc limit 1";
					$resultimgnew=$db->sql_query($sqlimgnew);
					$rowimgnew = $db->sql_fetchrow($resultimgnew);
					if ($rowimgnew['date']) {
						preg_match("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $rowimgnew['date'], $datetime);
						$zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
						//$now=time();
						if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
							$new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\" alt=\""._SOMNEWCONTENT."\">";
						}
					}
				}
				elseif ($nomdumodule=="Content" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
					$where = (preg_match("#^cid=[0-9]*$#",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
					$sqlimgnew="SELECT date FROM ".$prefix."_pages".$where." order by date desc limit 1";
					$resultimgnew=$db->sql_query($sqlimgnew);
					$rowimgnew = $db->sql_fetchrow($resultimgnew);
					if ($rowimgnew['date']) {
						preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $rowimgnew['date'], $datetime);
						$zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
						//$now=time();
						if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
							$new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\" alt=\""._SOMNEWCONTENT."\">";
						}
					}
				}
				elseif ($nomdumodule=="Reviews" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
					$where = "";
					$sqlimgnew="SELECT date FROM ".$prefix."_reviews".$where." order by date desc limit 1";
					$resultimgnew=$db->sql_query($sqlimgnew);
					$rowimgnew = $db->sql_fetchrow($resultimgnew);
					if ($rowimgnew['date']) {
						preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})#", $rowimgnew['date'], $datetime);
						$zedate = mktime(0,0,0,$datetime[2],$datetime[3],$datetime[1]);
						//$now=time();
						if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
							$new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\" alt=\""._SOMNEWCONTENT."\">";
						}
					}
				}
				elseif ($nomdumodule=="Journal" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
					$where = "";
					$sqlimgnew="SELECT mdate FROM ".$prefix."_journal".$where." order by mdate desc limit 1";
					$resultimgnew=$db->sql_query($sqlimgnew);
					$rowimgnew = $db->sql_fetchrow($resultimgnew);
					if ($rowimgnew['mdate']) {
						preg_match ("#([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})#", $rowimgnew['mdate'], $datetime);
						$zedate = mktime(0,0,0,$datetime[1],$datetime[2],$datetime[3]);
						//$now=time();
						if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
							$new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\" alt=\""._SOMNEWCONTENT."\">";
						}
					}
				}
				elseif ($nomdumodule=="News" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
					$where = (preg_match("#^new_topic=[0-9]*$#",$temponomdumodule[1])) ? " WHERE ".preg_replace("#new_#","",$temponomdumodule[1])."" : "";
					$sqlimgnew="SELECT time FROM ".$prefix."_stories".$where." order by time desc limit 1";
					$resultimgnew=$db->sql_query($sqlimgnew);
					$rowimgnew = $db->sql_fetchrow($resultimgnew);
					if ($rowimgnew['time']) {
						preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $rowimgnew['time'], $datetime);
						$zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
						//$now=time();
						if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
							$new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\" alt=\""._SOMNEWCONTENT."\">";
						}
					}
				}
				//sublevels - ouvre
				if ($keyinthisgroup==0) {
					$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]=0;
					$current_sublevel=0;
				}
				if ($sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]>$current_sublevel) {
					if ($imageinthisgroup[$som_groupmenu][$keyinthisgroup-1]=='tree-T.gif') {
						$zebar="background: url($path_icon/categories/bar.gif) right top repeat-y;";
					}
					else {
						$zebar="";
					}
					$catimagesize[0]=0;
					if ($div==1) {
						$sublevelzindex=$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]+2;
						$content.="<td style=\"vertical-align: top;\"><table id=\"".$id_sublevel."\" cellpadding=0 cellspacing=0 border=0 class=\"sommairenowrap\" style=\"position: absolute; z-index: ".$sublevelzindex."; border: 1px solid ".$bgcolor2."; background-color: ".$bgcolor1.";\">";
					}
					else {
					$content.="<tr id=\"".$id_sublevel."\"><td style=\"align: right;".$zebar."\"></td><td><table cellpadding=0 cellspacing=0 border=0 class=\"sommairenowrap\">";
					}
					$id_sublevel="";
					$id_sublevel_img="";
					$current_sublevel++;
				}
				//sublevels - showhide
				if ($keyinthisgroup<count($moduleinthisgroup[$som_groupmenu])-1 && $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]) {
					$ligne=($som_dynamic=='on') ? "<tr style=\"cursor: pointer;\" onclick=\"sommaire_showhide('sommairesublevel-$som_groupmenu-".($keyinthisgroup+1)."','ok','sommaireupdown-sublevel-$som_groupmenu-".($keyinthisgroup+1)."');\">" : "<tr>"; // onclick=\"sommaire_showhide('sommairesublevel-$som_groupmenu-$keyinthisgroup','ok','sommaireupdown-sublevel-$som_groupmenu-$keyinthisgroup');\"
					$id_sublevel="sommairesublevel-$som_groupmenu-".($keyinthisgroup+1);
					$id_sublevel_img="sommaireupdown-sublevel-$som_groupmenu-".($keyinthisgroup+1);
					$ferme_sublevels.= ($som_dynamic=='on') ? "sommaire_showhide('$id_sublevel','nok','$id_sublevel_img');" : "" ;
					$sublevel_updownimg=($som_dynamic=='on') ? "<img id=\"".$id_sublevel_img."\" src=\"$path_icon/admin/up.gif\" alt=\"Show/Hide content\" border=0>" : "";
				}
				else {
					$ligne="<tr>";
					$sublevel_updownimg="";
				}
				if ($limage!="middot.gif" && ($customtitle2=="" || $customtitle2==" " || $customtitle2=="&nbsp;" || $customtitle2=="&amp;nbsp;")) { //si le texte du lien est vide l'image va être clickable
					if ($no_category_text[$som_groupmenu]===1) {	//V2.1.2beta3
						$content.=$ligne."<td colspan=2 align=\"left\" width=\"100%\">&nbsp;<a href=\"".$urldumodule."\" ".$targetblank.">".$limage."</a>".$new."";
					}
					else {
						$content.=$ligne."<td width=\"$catimagesize[0]\" align=\"right\"></td><td>&nbsp;<a href=\"".$urldumodule."\" ".$targetblank.">".$limage."</a>".$new."";
					}
					$content.=$sublevel_updownimg."</td>";
					if (($div==1) && ($keyinthisgroup<count($moduleinthisgroup[$som_groupmenu])-1 && $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1])) {
						//si ce lien est le parent d'un sublevel, et qu'on utilise les layers il ne faut pas fermer la ligne.
					}
					else {
						$content.="</tr>\n";
					}
				}
				else {
					$width=" width=\"$catimagesize[0]\"";
					if ($no_category_text[$som_groupmenu]===1) {	//V2.1.2beta3
						$content.=$ligne."<td colspan=2 align=\"left\" width=\"100%\">".$limage."".$disp_pmicon."";
					}
					else {
						$content.=$ligne."<td".$width." align=\"right\">".$limage.""."</td><td>".$disp_pmicon."";
					}
					$content.="&nbsp;<a href=\"".$urldumodule."\" class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\" ".$targetblank."><span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\">".$gras1."$customtitle2".$gras2."</span></a>".$new."";
					$content.=$sublevel_updownimg."</td>";
					if (($div==1) && ($keyinthisgroup<count($moduleinthisgroup[$som_groupmenu])-1 && $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1])) {
						//si ce lien est le parent d'un sublevel, et qu'on utilise les layers il ne faut pas fermer la ligne.
					}
					else {
					$content.="</tr>\n";
					}
				}
				//sublevels - ferme
				if ($keyinthisgroup==count($moduleinthisgroup[$som_groupmenu])-1) {//on referme tous les sublevels, car on est au dernier lien de la catégorie
					for($sub=0;$sub<$current_sublevel;$sub++) {
						$content.="</table></td></tr>";
					}
				}
				elseif ($current_sublevel>$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]) {
					for($sub=0;$sub<($current_sublevel-$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]);$sub++) {
						$content.="</table></td></tr>";
					}
					$current_sublevel=$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1];
				}
	   		}// end else (pas lien externe et pas listbox)
			$keyinthisgroup++;
		}// end while
		if ($som_listbox=="on") {
			$content.="</select></form></td></tr>";
		}
		$content.="</table>";
		if($div==1) {
			$content.="</td></tr></table>";
			$content.="</td></tr>";
		}
		else {
			$content.="</td></tr>";
		}
		if ($horizontal==1) {
			$content.="</table></td><td width=\"4\" bgcolor=\"$som_bgcolor\"></td>";
		}
		else {
			$content.="<tr bgcolor=\"$som_bgcolor\"><td height=\"4\"></td></tr>";
		}
		}//end if somgroupmenu<>99
		if ($som_groupmenu == 99 && $is_admin==1 && $horizontal!=1) { // si on est à la catégorie 99, on affiche aux admins tous les modules installés/activés/visibles qui n'ont pas été affichés dans les catégories.
			if ($som_name!="sommairenoadmindisplay") {
				$showadmin=1;
				$content.="<tr><td>";
				for ($z=0;$z<count($module);$z++) {
					$customtitle2 = preg_replace ("#_#"," ", $module[$z]);
					if ($customtitle[$z] != "") {
						$customtitle2 = $customtitle[$z];
					}
					if ($module[$z] != $main_module) {
						if (($is_admin===1 AND $view[$z] == 2) OR $view[$z] != 2) {
							$incategories=0;
							for ($i=0;$i<count($totalcategorymodules);$i++) {
								if ($module[$z]==$totalcategorymodules[$i]) {
									$incategories=1;
								}
							}
							if ($incategories==0) {
								$flagmenu = $flagmenu+1;
								if ($flagmenu==1) {
									$content .="<hr><div align=\"center\">"._SOMMAIREADMINVIEWALLMODULES."</div><br />";   // si il y a des modules affichés en rubrique 99, on affiche avant une ligne horizontale
								}
								$urldumodule99 = ($gt_url[$z]!="") ? $gt_url[$z] : "modules.php?name=".$module[$z] ; // GT-NextGen
								if (($newpms[0]) AND ($module[$z]=="Private_Messages")) { // si PMs non lus, on affiche le logo mail
									$content .= "<strong><big>&middot;</big></strong><img src=\"images/blocks/email-y.gif\" height=\"10\" width=\"14\" alt=\""._SOMNEWPM."\" title=\""._SOMNEWPM."\"><a href=\"".$urldumodule99."\">$customtitle2</a><br />\n";
								}
								else {
									$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$urldumodule99."\">$customtitle2</a><br />\n";
								}
							}
						}
					}
				}//end for groupmenu=99
				$content.="</td></tr>";
			}
			else {
				$showadmin=0;
			}
		}//end if groupmenu=99
	}
	$content.="</table>";
	if ($general_dynamic==1 && $detectMozilla!=1) { // on va réenrouler toutes les catégories, sauf celle contenant le module affiché sur la page
		if (isset($categorieouverte)) {
			$aenlever="sommaire_showhide\('sommaire-".$categorieouverte."','nok','sommaireupdown-".$categorieouverte."'\);";
			$total_actions = preg_replace("#$aenlever#", "" , $total_actions);
		}
		if (isset($keyouvert)) { // on ne réenroule pas les sublevels qui vont jusqu'au module affiché sur la page (on laisse l'arborescence du sublevel).
								 // note : normalement tous les cas d'arborescence sont prévus avec le code ci-dessous. donc normalement pas de bug ici
								 //        mais si c'est le cas, il faudra prévoir qq tasses de café, et un code BEAUCOUP plus long :-/
			$aenlever_sublevels="sommaire_showhide\('sommairesublevel-".$categorieouverte."-".$keyouvert."','nok','sommaireupdown-sublevel-".$categorieouverte."-".$keyouvert."'\);";
			$ferme_sublevels = preg_replace("#$aenlever_sublevels#", "" , $ferme_sublevels);
			$j=$keyouvert;
			for ($i=$keyouvert-1;$i>=0;$i--) {
				if ($sublevelinthisgroup[$categorieouverte][$i]<=$sublevelinthisgroup[$categorieouverte][$j] && $sublevelinthisgroup[$categorieouverte][$i]<=$sublevelinthisgroup[$categorieouverte][$keyouvert]) {
					$aenlever_sublevels="sommaire_showhide\('sommairesublevel-".$categorieouverte."-".$i."','nok','sommaireupdown-sublevel-".$categorieouverte."-".$i."'\);";
					$ferme_sublevels = preg_replace("#$aenlever_sublevels#", "" , $ferme_sublevels);
					$j--;
				}
			}
		}
		$content.="<script type=\"text/javascript\" language=\"JavaScript\">$total_actions;\n";
		$content.=$ferme_sublevels;
		$content.="</script>";
		// Note: j'utilise le jscript pour fermer les catégories (et sublevels) au départ, au lieu de mettre "display: none" pour leur contenu.
		// C'est peut-être moins "élégant", mais le but est de faire fonctionner le sommaire sur des navigateurs SANS jscript (ou désactivé).
		// (ça serait relativement gênant de ne pas pouvoir naviguer dans le menu d'un site web si on n'a pas de jscript !) ;-)
	}
    /* If you're Admin you and only you can see Inactive modules and test it */
    /* If you copied a new module is the /modules/ directory, it will be added to the database */
if ( $showadmin==1 && $is_admin===1 && $horizontal!=1) {
	$key=count($module); // $key va permettre de se positionner dans $module[] pour rajouter des modules à la fin
	$content .= "<br /><center><strong>"._INVISIBLEMODULES."</strong><br />";
	$content .= "<font class=\"tiny\">"._ACTIVEBUTNOTSEE."</font></center>";
	$content.="<form action=\"modules.php\" method=\"get\" name=\"sommaireformlistboxinvisibles\">"
	."<select name=\"somlistboxinvisibles\" onchange=\"sommaire_envoielistbox(this.options[this.selectedIndex].value)\">"
	."<option value=\"select\">"._SOMSELECTALINK."";
	$sql = "SELECT * FROM ".$prefix."_modules WHERE active='1' AND inmenu='0' ORDER BY title ASC";
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$module[$key]=$row['title'];
		$mn_title = $row['title'];
		$custom_title = $row['custom_title'];
		$mn_title2 = (!$custom_title) ? preg_replace("#_#", " ", $mn_title) : $custom_title;
		$urldumodule_admin = (isset($row['url'])) ? $row['url'] : "modules.php?name=".$mn_title ; // GT-NextGen
		$content .= "<option value=\"".$urldumodule_admin."\">".$mn_title2."";
		$key++;
	}
	$content.= "</select></form>\n";
	$content .= "<br /><center><strong>"._NOACTIVEMODULES."</strong><br />";
	$content .= "<font class=\"tiny\">"._FORADMINTESTS."</font></center>";
	$content.="<form action=\"modules.php\" method=\"get\" name=\"sommaireformlistboxinactifs\">"
				."<select name=\"somlistboxinactifs\" onchange=\"sommaire_envoielistbox(this.options[this.selectedIndex].value)\">"
				."<option value=\"select\">"._SOMSELECTALINK."";
	$sql = "SELECT title, custom_title FROM ".$prefix."_modules WHERE active='0' ORDER BY title ASC";
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$module[$key]=$row['title'];
		$key++;
		$mn_title = $row['title'];
		$custom_title = $row['custom_title'];
		$mn_title2 = (!$custom_title) ? preg_replace("#_#", " ", $mn_title) : $custom_title;
		if ($custom_title != "") {
			$mn_title2 = $custom_title;
		}
		$urldumodule_admin = (isset($row['url'])) ? $row['url'] : "modules.php?name=".$mn_title ; // GT-NextGen
		$content .= "<option value=\"".$urldumodule_admin."\">".$mn_title2."";
		$dummy = 1;
	}
	$content.= "</select></form>\n";
	$handle=opendir('modules');
	while ($file = readdir($handle)) {
	    if ( (!preg_match("#[.]#",$file)) ) {
						// ajout d'un check pour diminuer le nombre de requets SQL : on ne checke QUE les modules qui ne sont pas 
			$trouve=0;  //dans  $module c'est à dire les modules qui ne sont pas "actifs" ET "visibles" (==> modules inactifs
			for ($i=0;$i<count($module);$i++) {
				if ($module[$i]==$file) {
				$trouve=1;
				}
	    	}
			if ($trouve<>1) {
				$modlist .= "$file ";
			}
		}
	}
	closedir($handle);
	$modlist = explode(" ", $modlist);
	sort($modlist);
	for ($i=0; $i < sizeof($modlist); $i++) {
	    if($modlist[$i] != "") {
			$sql = "SELECT mid FROM ".$prefix."_modules WHERE title='$modlist[$i]'";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$mid = $row['mid'];
			if ($mid == "") {
			    $db->sql_query("INSERT INTO ".$prefix."_modules (mid, title, custom_title, active, view, inmenu) VALUES (NULL, '$modlist[$i]', '$modlist[$i]', '0', '0', '1')");
			}
	    }
	}
}//end if admin
// permet de déterminer si le visiteur est un membre, et récupère ses points si on gère les groupes (nuke>7)
function sommaire_is_user($user, $gestiongroupe) {
    global $prefix, $db, $user_prefix, $uid, $userpoints;
    if(!is_array($user)) {
		$user = addslashes($user); //v2.1.2
        $user = base64_decode($user);
		$user = addslashes($user); //v2.1.2
        $user = explode(":", $user);
        $uid = "$user[0]";
        $pwd = "$user[2]";
    } else {
        $uid = "$user[0]";
        $pwd = "$user[2]";
    }
	$uid = addslashes($uid); //v2.1.2
	$uid=intval($uid); //v2.1.2
    if ($uid != "" AND $pwd != "") {
		if ($gestiongroupe==0) {
        	$sql = "SELECT user_password FROM ".$user_prefix."_users WHERE user_id='$uid'";
		}
		else if ($gestiongroupe==1) {
			$sql = "SELECT user_password, points FROM ".$user_prefix."_users WHERE user_id='$uid'";
		}
		else {
		die("Problème!!");
		}
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $pass = $row['user_password'];
        if($pass == $pwd && $pass != "") {
			$userpoints = ($gestiongroupe==1) ? $row['points'] : "";
            return 1;
        }
    }
    return 0;
}
//cette fonction a été reprise de mainfile.php : permet d'éviter un appel à la DB car on sait déjà si is_user!
function sommaire_get_theme($is_user) {
    global $user, $cookie, $Default_Theme;
    if($is_user==1) {
        $user2 = base64_decode($user);
        $t_cookie = explode(":", $user2);
        if($t_cookie[9]=="") $t_cookie[9]=$Default_Theme;
        if(isset($theme)) $t_cookie[9]=$theme;
        if(!$tfile=@opendir("themes/$t_cookie[9]")) {
            $ThemeSel = $Default_Theme;
        } else {
            $ThemeSel = $t_cookie[9];
        }
    } else {
        $ThemeSel = $Default_Theme;
    }
    return($ThemeSel);
}
?>

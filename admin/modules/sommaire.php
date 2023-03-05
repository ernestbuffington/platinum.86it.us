<?php
global $admin, $keysommaire, $deletecat, $db, $prefix, $sql, $upgrade_test, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolorhide, $zetheme;
global $admin_file;
if (!isset($admin_file)) {$admin_file="admin";}
if (!preg_match("/".$admin_file.".php/", $_SERVER['PHP_SELF'])) {
	die ("You can't access this file directly...");
}
$aid = trim($aid);
$result = $db->sql_query("select name, radminsuper from ".$prefix."_authors where aid='$aid'");
$row = $db->sql_fetchrow($result);
if ($row['radminsuper']!=1) {
	die ("Acc&egrave;s refus&eacute;");
}
$zetheme=get_theme();
$urlofimages="images/sommaire";
//$urlofimages="themes/$zetheme/images/sommaire";
$bgcolorhide='#c0c0c0';
$bgcolorhidefallback='#909090';
function sommaire_js_code() { //this php function will send all js functions.
	global $urlofimages, $zetheme, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolorhide, $bgcolorhidefallback, $admin_file;
?>
<script type="text/javascript" language="Javascript">
function sommaireadminshowhide(zenom, numero) {
	if (numero==1) {
		document.getElementById(zenom).style.display='';
	}
	else if (numero==0) {
		document.getElementById(zenom).style.display='none';
	}
}
function sommairechangecatimgnew(zeimage, keysommaire, z) {
	var reg= new RegExp("<?php echo "$urlofimages";?>/admin/new.gif","gi");
	<?php // Modifications v2.5 => le clic sur l'image change la valeur dans le formulaire ?>
	if (z=="") {
		var thiselement="sommaireformnew["+keysommaire+"]";
	}
	else {
		var thiselement="sommaireformmodulenew["+keysommaire+"]["+z+"]";
	}
	if (reg.test(zeimage.src)) {
		zeimage.src="<?php echo "$urlofimages";?>/admin/new_gray.gif";
		document.forms.form_sommaire.elements[thiselement].value="";
	}
	else {
		zeimage.src="<?php echo "$urlofimages";?>/admin/new.gif";
		document.forms.form_sommaire.elements[thiselement].value="on";
	}
}
<?php //cette fonction permet de masquer les input box de l'url externe et du texte de l'url.?>
function disab (cetobjet,valeur,formlink,formlinktext,linkvaleur,linktextvaleur) {
	if (valeur=='SEP') {
		cetobjet.selectedIndex=0;
	}
	if (valeur=='Lien externe') {
		if (linkvaleur=='') {
			formlink.value="http://";
			formlinktext.value="";
		}
		else {
			formlink.value=linkvaleur;
			formlinktext.value=linktextvaleur;
		}
		formlink.disabled=false;
		formlinktext.disabled=false;
		formlink.style.visibility='visible';
		formlinktext.style.visibility='visible';
	}
	else if(valeur=='SOMMAIRETEXTONLY') {
		formlink.value="";
		formlink.disabled=true;
		formlinktext.disabled=false;
		formlink.style.visibility='hidden';
		formlinktext.style.visibility='visible';
	}
	else {
		formlink.value="";
		formlink.style.visibility='hidden';
		formlink.disabled=true;
		formlinktext.value="";
		formlinktext.style.visibility='hidden';
		formlinktext.disabled=true;
	}
}
<?php // permet d'afficher ou non l'image correspondant au 'target_blank' pour le lien considéré?>
function targetblank(keysommaire,valeur) {
	testehttp = valeur.slice(0,7 );
	testehttps = valeur.slice(0,8 );
	testeftp = valeur.slice(0,6);
	http='http://';
	https='https://';
	ftp='ftp://';
	if (valeur=="") {
		document.images["targetblank"+keysommaire].style.display="none";
		document.images["targetnone"+keysommaire].style.display="none";
	}
	else if(testehttp == http || testeftp == ftp || testehttps==https) {
		document.images["targetblank"+keysommaire].style.display="inline";
		document.images["targetnone"+keysommaire].style.display="none";
	}
	else {
		document.images["targetblank"+keysommaire].style.display="none";
		document.images["targetnone"+keysommaire].style.display="inline";
	}
}
<?php // on va vérifier que la valeur de poids est correcte (fonction appelée quand on change la valeur du poids)?>
function check_numeric (my_element, old_value) {
	var text_value = my_element.value;
	if (text_value.length >0) {
		if (isNaN(text_value)) {
			alert ("<?php echo ""._SOMMSGNOTNUM."";?>");
			my_element.value = old_value;
		}
	}
	else {
		alert ("<?php echo ""._SOMMSGVOID.""?>");
		my_element.value = old_value;
	}
}
<?php // Fonction permettant d'afficher le popup pour les options supplémentaires?>
function envoiedit(keysommaire, z, type) {
	var reg= new RegExp("[&]","gi");
	var seg= new RegExp("[\?]","gi");
	if (z!='imacategory') {
		var modulename = document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+z+"]"].value;
		var lienname = document.forms.form_sommaire.elements["sommaireformmodulelinktext["+keysommaire+"]["+z+"]"].value;
		lienname = lienname.replace(reg,"[SOMSYMBOLEet]");
		lienname = lienname.replace(seg,"[SOMSYMBOLEinterro]");
		var image = document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+z+"]"].value;
		var lienclass = document.forms.form_sommaire.elements["sommaireformmoduleclass["+keysommaire+"]["+z+"]"].value;
		var new_days = document.forms.form_sommaire.elements["sommaireformmodulenew_days["+keysommaire+"]["+z+"]"].value;
		// pour schedule
		var date_debut = document.forms.form_sommaire.elements["sommaire_schedule_date_debut["+keysommaire+"]["+z+"]"].value;
		var date_fin = document.forms.form_sommaire.elements["sommaire_schedule_date_fin["+keysommaire+"]["+z+"]"].value;
		var days = document.forms.form_sommaire.elements["sommaire_schedule_days["+keysommaire+"]["+z+"]"].value;
	}
	else {
		var date_debut = document.forms.form_sommaire.elements["sommaire_schedule_date_debut_cat["+keysommaire+"]"].value;
		var date_fin = document.forms.form_sommaire.elements["sommaire_schedule_date_fin_cat["+keysommaire+"]"].value;
		var days = document.forms.form_sommaire.elements["sommaire_schedule_days_cat["+keysommaire+"]"].value;
	}
	var catname = document.forms.form_sommaire.elements["sommaireformname["+keysommaire+"]"].value;
	catname = catname.replace(reg,"[SOMSYMBOLEet]");
	catname = catname.replace(seg,"[SOMSYMBOLEinterro]");
	var catimage = document.forms.form_sommaire.elements["sommaireformimage["+keysommaire+"]"].value;
	var categoryclass = document.forms.form_sommaire.elements["sommaireformeachcategoryclass["+keysommaire+"]"].value;
	var dynamic = document.forms.form_sommaire.elements["sommaireformdynamic["+keysommaire+"]"].value;
	var zeurl="<?php echo $admin_file;?>"+".php?op=sommaire&go="+type+"&modulename="+modulename+"&lienname="+lienname+"&image="+image+"&catname="+catname+"&catimage="+catimage+"&categoryclass="+categoryclass+"&lienclass="+lienclass+"&new_days="+new_days+"&keysommaire="+keysommaire+"&z="+z+"&date_debut="+date_debut+"&date_fin="+date_fin+"&days="+days+"&dynamic="+dynamic;
	window.open(zeurl,'sommaire_'+type+'link','location=no, width=600, height=250, menubar=no, status=no, scrollbars=auto, menubar=no');
	//alert(zeurl);
}
<?php // fonctions jscript permettant de changer l'image affichée (en fonction de la valeur indiquée dans la listbox 'image dans cette catégorie' et 'image pour le lien') ?>
function changeimage(zeimage,valeur) {
	var url="<?php echo $urlofimages; ?>/";
	if (valeur=="noimg") {
		valeur="admin/noimg.gif";
	}
	document.images[zeimage].src=url+valeur;
}
function changeimage_cat(zeimage,valeur) {
	var url="<?php echo $urlofimages; ?>/";
	if (valeur=="middot.gif") {
		valeur="admin/middot.gif";
	}
	else {
		valeur="categories/"+valeur;
	}
	document.images[zeimage].src=url+valeur;
}
<?php //fonction permettant de modifier les sublevels ?>
function sommaire_manage_sublevels(keysommaire, z, sens) {
	var url="<?php echo $urlofimages; ?>";
	if (sens=='left') {
		if (document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value!=0) {
			document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value=parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value)-1;
			document.images["sublevelspacer1["+keysommaire+"]["+z+"]"].width=document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value*15;
		}
		if (document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value==0) {
			document.images["imageleft["+keysommaire+"]["+z+"]"].style.display="none";
		}
		document.images["imageright["+keysommaire+"]["+z+"]"].style.display="inline";
		var nextz=parseInt(z)+1;
		if (parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value)+1<parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+nextz+"]"].value)) {
			sommaire_manage_sublevels(keysommaire,nextz,'left');
			document.images["imageright["+keysommaire+"]["+nextz+"]"].style.display="none";
		}
		else if (parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value)==parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+nextz+"]"].value)) {
			document.images["imageright["+keysommaire+"]["+nextz+"]"].style.display="inline";
		}
		else if (parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value)<parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+nextz+"]"].value)) {
			document.images["imageright["+keysommaire+"]["+nextz+"]"].style.display="none";
		}
	}
	else {
		var previousz=parseInt(z)-1;
		// Si le sublevel est déjà supérieur au sublevel d'au-dessus, on ne fait rien !
		if (parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value)<=parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+previousz+"]"].value)) {
			document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value=parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value)+1;
			document.images["sublevelspacer1["+keysommaire+"]["+z+"]"].width=document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value*15;
			if (document.images["imageleft["+keysommaire+"]["+z+"]"].style.display=="none") {
				document.images["imageleft["+keysommaire+"]["+z+"]"].style.display="inline"
			}
			if (parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value)>parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+previousz+"]"].value)) {
				document.images["imageright["+keysommaire+"]["+z+"]"].style.display="none"
			}
			var nextz=parseInt(z)+1;
			if (parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value)>=parseInt(document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+nextz+"]"].value)) {
				document.images["imageright["+keysommaire+"]["+nextz+"]"].style.display="inline"
			}
		}
	}
}
<?php //fonction permettant de permuter les liens vers le haut et vers le bas ?>
var oldschool;
function sommaire_move_updown(keysommaire,z,lastz,sens) {
	if ((z==0 && sens=='up') || (z==lastz && sens=='down')) {
		alert("You shouldn't see this. no action taken.");
	}
	else {
		if (sens=='up') {
			var otherz=parseInt(z)-1;
		}
		else {
			var otherz=parseInt(z)+1;
		}
		var old_sommaireformingroup = document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+z+"]"].selectedIndex;//select
		// on ne modifie pas le sublevel
		//var old_sublevel = document.forms.form_sommaire.elements["sublevel["+keysommaire+"]["+z+"]"].value;
		var old_sommaireformmodulelink = document.forms.form_sommaire.elements["sommaireformmodulelink["+keysommaire+"]["+z+"]"].value;//input
		var old_sommaireformmodulelinktext = document.forms.form_sommaire.elements["sommaireformmodulelinktext["+keysommaire+"]["+z+"]"].value;//input
		if (oldschool==1) {
			var old_sommaireformmoduleimage = document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+z+"]"].selectedIndex;//select
		}
		else {
			var old_sommaireformmoduleimage = document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+z+"]"].value;//hidden
		}
		var old_sommaireformmodulegras = document.forms.form_sommaire.elements["sommaireformmodulegras["+keysommaire+"]["+z+"]"].checked;//checkbox
		var old_sommaireformmodulenew = document.forms.form_sommaire.elements["sommaireformmodulenew["+keysommaire+"]["+z+"]"].value;//hidden
		var old_sommaireformmoduleclass = document.forms.form_sommaire.elements["sommaireformmoduleclass["+keysommaire+"]["+z+"]"].value;//hidden
		var old_sommaireformmodulenew_days = document.forms.form_sommaire.elements["sommaireformmodulenew_days["+keysommaire+"]["+z+"]"].value;//hidden
		var old_sommaire_schedule_date_debut = document.forms.form_sommaire.elements["sommaire_schedule_date_debut["+keysommaire+"]["+z+"]"].value; //hidden
		var old_sommaire_schedule_date_fin = document.forms.form_sommaire.elements["sommaire_schedule_date_fin["+keysommaire+"]["+z+"]"].value; //hidden
		var old_sommaire_schedule_days = document.forms.form_sommaire.elements["sommaire_schedule_days["+keysommaire+"]["+z+"]"].value; //hidden
		// on remplace la ligne qui doit être montée/descendue par les valeurs d'au-dessus
		document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+z+"]"].focus(); //on met le focus sur la selectbox avant de modifier sa valeur. Cela évite des pbs de rafraîchissement de la selectbox sur plusieurs navigateurs.
		document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+z+"]"].selectedIndex=document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+otherz+"]"].selectedIndex;
		document.forms.form_sommaire.elements["sommaireformmodulelink["+keysommaire+"]["+z+"]"].value=document.forms.form_sommaire.elements["sommaireformmodulelink["+keysommaire+"]["+otherz+"]"].value;
		document.forms.form_sommaire.elements["sommaireformmodulelinktext["+keysommaire+"]["+z+"]"].value=document.forms.form_sommaire.elements["sommaireformmodulelinktext["+keysommaire+"]["+otherz+"]"].value;
		if (oldschool==1) {
			document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+z+"]"].focus();
			document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+z+"]"].selectedIndex=document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+otherz+"]"].selectedIndex;
		}
		else {
			document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+z+"]"].value=document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+otherz+"]"].value;
		}
		document.forms.form_sommaire.elements["sommaireformmodulegras["+keysommaire+"]["+z+"]"].checked=document.forms.form_sommaire.elements["sommaireformmodulegras["+keysommaire+"]["+otherz+"]"].checked;
		document.forms.form_sommaire.elements["sommaireformmodulenew["+keysommaire+"]["+z+"]"].value=document.forms.form_sommaire.elements["sommaireformmodulenew["+keysommaire+"]["+otherz+"]"].value;
		document.forms.form_sommaire.elements["sommaireformmoduleclass["+keysommaire+"]["+z+"]"].value=document.forms.form_sommaire.elements["sommaireformmoduleclass["+keysommaire+"]["+otherz+"]"].value;
		document.forms.form_sommaire.elements["sommaireformmodulenew_days["+keysommaire+"]["+z+"]"].value=document.forms.form_sommaire.elements["sommaireformmodulenew_days["+keysommaire+"]["+otherz+"]"].value;
		document.forms.form_sommaire.elements["sommaire_schedule_date_debut["+keysommaire+"]["+z+"]"].value=document.forms.form_sommaire.elements["sommaire_schedule_date_debut["+keysommaire+"]["+otherz+"]"].value;
		document.forms.form_sommaire.elements["sommaire_schedule_date_fin["+keysommaire+"]["+z+"]"].value=document.forms.form_sommaire.elements["sommaire_schedule_date_fin["+keysommaire+"]["+otherz+"]"].value;
		document.forms.form_sommaire.elements["sommaire_schedule_days["+keysommaire+"]["+z+"]"].value=document.forms.form_sommaire.elements["sommaire_schedule_days["+keysommaire+"]["+otherz+"]"].value;
		// ...et on remplace la ligne du dessus/dessous par les valeurs de la ligne montée.
		// !!! ATTENTION : il FAUT laisser ces lignes SOUS les lignes précédentes !
		document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+otherz+"]"].focus();
		document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+otherz+"]"].selectedIndex=old_sommaireformingroup;
		document.forms.form_sommaire.elements["sommaireformmodulelink["+keysommaire+"]["+otherz+"]"].value=old_sommaireformmodulelink;
		document.forms.form_sommaire.elements["sommaireformmodulelinktext["+keysommaire+"]["+otherz+"]"].value=old_sommaireformmodulelinktext;
		if (oldschool==1) {
			document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+otherz+"]"].focus();
			document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+otherz+"]"].selectedIndex=old_sommaireformmoduleimage;
			document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+otherz+"]"].blur();// on enlève le focus de la selectbox, qui n'a plus de raison d'être sélectionnée. (cf. +haut avec focus)
		}
		else {
			document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+otherz+"]"].value=old_sommaireformmoduleimage;
			document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+otherz+"]"].blur();// on enlève le focus de la selectbox, qui n'a plus de raison d'être sélectionnée. (cf. +haut avec focus)
		}
		document.forms.form_sommaire.elements["sommaireformmodulegras["+keysommaire+"]["+otherz+"]"].checked=old_sommaireformmodulegras;
		document.forms.form_sommaire.elements["sommaireformmodulenew["+keysommaire+"]["+otherz+"]"].value=old_sommaireformmodulenew;
		document.forms.form_sommaire.elements["sommaireformmoduleclass["+keysommaire+"]["+otherz+"]"].value=old_sommaireformmoduleclass;
		document.forms.form_sommaire.elements["sommaire_schedule_date_debut["+keysommaire+"]["+otherz+"]"].value=old_sommaire_schedule_date_debut;
		document.forms.form_sommaire.elements["sommaire_schedule_date_fin["+keysommaire+"]["+otherz+"]"].value=old_sommaire_schedule_date_fin;
		document.forms.form_sommaire.elements["sommaire_schedule_days["+keysommaire+"]["+otherz+"]"].value=old_sommaire_schedule_days;
		// affiche / masque les textbox des URL des liens permutés
		if (document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+otherz+"]"].selectedIndex==2 || document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+z+"]"].selectedIndex==2) {
			disab(document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+otherz+"]"],document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+otherz+"]"].value,document.forms.form_sommaire.elements["sommaireformmodulelink["+keysommaire+"]["+otherz+"]"],document.forms.form_sommaire.elements["sommaireformmodulelinktext["+keysommaire+"]["+otherz+"]"],document.forms.form_sommaire.elements["sommaireformmodulelink["+keysommaire+"]["+otherz+"]"].value,document.forms.form_sommaire.elements["sommaireformmodulelinktext["+keysommaire+"]["+otherz+"]"].value);
			disab(document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+z+"]"],document.forms.form_sommaire.elements["sommaireformingroup["+keysommaire+"]["+z+"]"].value,document.forms.form_sommaire.elements["sommaireformmodulelink["+keysommaire+"]["+z+"]"],document.forms.form_sommaire.elements["sommaireformmodulelinktext["+keysommaire+"]["+z+"]"],document.forms.form_sommaire.elements["sommaireformmodulelink["+keysommaire+"]["+z+"]"].value,document.forms.form_sommaire.elements["sommaireformmodulelinktext["+keysommaire+"]["+z+"]"].value);
			targetblank(keysommaire+'_'+z,document.forms.form_sommaire.elements["sommaireformmodulelink["+keysommaire+"]["+z+"]"].value);
			targetblank(keysommaire+'_'+otherz,document.forms.form_sommaire.elements["sommaireformmodulelink["+keysommaire+"]["+otherz+"]"].value);
		}
		// modifie l'image à gauche du lien
		changeimage_cat('image'+keysommaire+'_'+z,document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+z+"]"].value);
		changeimage_cat('image'+keysommaire+'_'+otherz,document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire+"]["+otherz+"]"].value);
		// modifie l'image "NEW" des 2 lignes permutées (si besoin)
		if (document.forms.form_sommaire.elements["sommaireformmodulenew["+keysommaire+"]["+otherz+"]"].value=="on") {
			document.images['somnew'+keysommaire+'_'+otherz].src="<?php echo "$urlofimages";?>/admin/new.gif";
		}
		else {
			document.images['somnew'+keysommaire+'_'+otherz].src="<?php echo "$urlofimages";?>/admin/new_gray.gif";
		}
		if (document.forms.form_sommaire.elements["sommaireformmodulenew["+keysommaire+"]["+z+"]"].value=="on") {
			document.images['somnew'+keysommaire+'_'+z].src="<?php echo "$urlofimages";?>/admin/new.gif";
		}
		else {
			document.images['somnew'+keysommaire+'_'+z].src="<?php echo "$urlofimages";?>/admin/new_gray.gif";
		}
		// permute la classe CSS des 2 lignes (utile pour permuter le "grisage" de la ligne si celle-ci est HIDDEN ou SCHEDULE (et hors de la plage d'affichage)
		if (document.getElementById('spana'+keysommaire+'_'+z).className!=document.getElementById('spana'+keysommaire+'_'+otherz).className) {//pas de modif si les classes CSS sont identiques.
			if (document.getElementById('spana'+keysommaire+'_'+z).className=='sommaire_hidden') {
				sommaire_hidelink(keysommaire,z,'show',this.document);
				sommaire_hidelink(keysommaire,otherz,'hide',this.document);
			}
			else if (document.getElementById('spana'+keysommaire+'_'+otherz).className=='sommaire_hidden') {
				sommaire_hidelink(keysommaire,z,'hide',this.document);
				sommaire_hidelink(keysommaire,otherz,'show',this.document);
			}
		}
	}
}
/* thank you quirksmode.org and opera.com */
function findPosX(obj)
{
	var curleft = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			//if( obj.offsetParent.tagName == "BODY" ) break;
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
	curleft += obj.x;
	return curleft;
}
function findPosY(obj)
{
	var curtop = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
	curtop += obj.y;
	return curtop;
}
var keysommaire_image;//jscript variable utile pour les 3 fonctions en dessous
var zimage;//jscript variable utile pour les 3 fonctions en dessous
function sommaire_displayimagelist(zeimage,zediv_id) {
	var obj=document.getElementById(zediv_id);
	//alert(obj.style.display);
	var div_padding=parseInt(obj.style.padding);
	obj.style.top=(findPosY( zeimage ) - div_padding + zeimage.height + 1) + 'px';
	obj.style.left=(findPosX( zeimage ) - div_padding + zeimage.width + 1) + 'px';
	// div_padding: le padding du DIV entourant la liste des images (invisible, permettant de détecter le onmouseout sur la liste)
	// zeimage.width et zeimage.height : dimensions de l'icone actuelle
	// +1 pour déplacer un peu à droite et en bas, à cause du padding de la table (cela aligne le DIV sous la petite icone dn.gif)
	obj.style.display='block';
	fSwapSelect(zediv_id); // for IE select bug
}
function sommaire_changeimageform(image_name) {
	var url="<?php echo $urlofimages; ?>";
	document.forms.form_sommaire.elements["sommaireformimage["+keysommaire_image+"]"].value=image_name;
	if (image_name=='noimg') {
		image_name='admin/noimg.gif';
	}
	document.images["catimage"+keysommaire_image].src=url+'/'+image_name;
	keysommaire_image=0;
}
function sommaire_changeimageform_cat(image_name) {
	var url="<?php echo $urlofimages; ?>/categories/";
	document.forms.form_sommaire.elements["sommaireformmoduleimage["+keysommaire_image+"]["+zimage+"]"].value=image_name;
	if (image_name=='middot.gif') {
		image_name="<?php echo $urlofimages; ?>/admin/middot.gif";
	}
	else {
		image_name=url+'/'+image_name;
	}
	document.images["image"+keysommaire_image+"_"+zimage].src=image_name;
	keysommaire_image=0;
	zimage=0;
}
// fix for IE : hide the <select> box under the image list because it overlaps the <div>  grrrrr... >_< 
// (sidenote at 4.00 am : yes, Internet Explorer IS evil. definetely. I'm so sick of finding workarounds for this crap.)
// Thanks ASP-PHP.net !! great script !
function fSwapSelect( sId ) {
	oObj = document.getElementById(sId); 
	var agt=navigator.userAgent.toLowerCase();
	//real browsers. they don't need this hack, so we don't need to use CPU more than necessary ;-)
	if (agt.indexOf('opera')!=-1 || agt.indexOf('firefox')!=-1 || agt.indexOf('konqueror')!=-1) { 
		//on vire le titre de la table contenant les images, qui avertit les utilisateurs d'IE que c'est NORMAL que les selectbox disparaissent...
		document.getElementById(sId+'_table').title="";
		return;
	}
	Top_Element  = findPosY(oObj);
	Left_Element  = findPosX(oObj);
	Largeur_Element  = oObj.offsetWidth;
	Hauteur_Element  = oObj.offsetHeight;
	oSelects = document.getElementsByTagName('SELECT');
	if (oSelects.length > 0) {
		for (i = 0; i < oSelects.length; i++) {
			oSlt = oSelects[i];
			Top_Select = findPosY(oSlt);
			Left_Select = findPosX(oSlt);
			Largeur_Select = oSlt.offsetWidth;
			Hauteur_Select = oSlt.offsetHeight;
			isLeft = false;
			if ((Left_Element > (Left_Select - Largeur_Element)) && (Left_Element < (Left_Select + Largeur_Select))) {
				isLeft = true;
			}
			isTop = false;
			if ((Top_Element > (Top_Select - Hauteur_Element)) && (Top_Element < (Top_Select + Hauteur_Select))) {
				isTop = true;
			}
			if (isLeft && isTop) {
				sVis = (oObj.style.visibility == 'hidden') ? 'visible' : 'hidden';
				if (oSlt.style.visibility != sVis) {oSlt.style.visibility = sVis;}
			} else {
				if (oSlt.style.visibility != 'visible') {oSlt.style.visibility = 'visible';}
			}
		}
	}
}
var clicked=0;
var s=0;
<?php //fonction permettant de masquer le DIV (liste des images) quand on clique ?>
function hideallimagelists() {
	if(!s) return;
	if(clicked==1) {
	document.getElementById('sommaire_imagelist').style.display='none';
	fSwapSelect('sommaire_imagelist');
	document.getElementById('sommaire_imagelist_cat').style.display='none';
	fSwapSelect('sommaire_imagelist_cat');
	clicked=0;
	s=0;
	}
	else {
	clicked++;	
	}
}
<?php //quand on clique n'importe où sur le document, hideallimagelists est appellée. ?>
document.onclick=hideallimagelists;
<?php //fonctions permettant de masquer le DIV (liste des images) quand la souris n'est plus dessus ?>
window.onload=sommaire_onload;
function sommaire_onload() {
	zediv=document.getElementById('imagelist_wrapper');
	zediv2=document.getElementById('imagelist_wrapper_cat');
	if (window.addEventListener) { // decent browsers
		zediv.addEventListener('mouseout',hidediv,false);
		zediv2.addEventListener('mouseout',hidediv,false);
	}
	else if (window.attachEvent) { // IE proprietary functions
		zediv.attachEvent('onmouseout', hidediv_ie);// la fonction appellée ne peut pas prendre d'argument.
		zediv2.attachEvent('onmouseout', hidediv2_ie);
	}
	else {
		alert('Your browser does not support DOM addEventListener or IE\'s proprietary attachEvent.\nImpossible to detect onmouseout for the DIV element.\nPlease let me know if this happens : marcoledingue at.a@t.at free.fr');
	}
}
function hidediv_ie(event) {
	if ( event.toElement == zediv.parentNode ) {
		document.getElementById('sommaire_imagelist').style.display='none';
		fSwapSelect('sommaire_imagelist');
		document.getElementById('sommaire_imagelist_cat').style.display='none';
		fSwapSelect('sommaire_imagelist_cat');
	}
	else {
		event.returnValue=false;
	}
}
function hidediv2_ie(event) {
	if ( event.toElement == zediv2.parentNode ) {
		document.getElementById('sommaire_imagelist').style.display='none';
		fSwapSelect('sommaire_imagelist');
		document.getElementById('sommaire_imagelist_cat').style.display='none';
		fSwapSelect('sommaire_imagelist_cat');
	}
	else {
		event.returnValue=false;
	}
}
function hidediv(e) {
	//eventPhase = 2 => AT_TARGET : l'event est sur un élément.
	if ( e.eventPhase == 2 && (e.relatedTarget == e.currentTarget.parentNode || e.relatedTarget == document.body || e.relatedTarget == document.documentElement) ) {
		document.getElementById('sommaire_imagelist').style.display='none';
		fSwapSelect('sommaire_imagelist'); //au cas où un navigateur soit détecté comme MSIE (mais supporte les eventListener), il faut ré-afficher les select box !
		document.getElementById('sommaire_imagelist_cat').style.display='none';
		fSwapSelect('sommaire_imagelist_cat');
	}
	else {
		e.preventDefault();
	}
}
<?php //fonction qui change l'affichage des catégories masquées ?>
function sommaire_hidecategory(keysommaire,sens,zedoc) {
	if (sens=='hide') {
		zedoc.getElementById('showhide_weight_'+keysommaire).className='sommaire_hidden';
		zedoc.getElementById('showhide_cat_'+keysommaire).className='sommaire_hidden';
		zedoc.getElementById('showhide_suppr_'+keysommaire).className='sommaire_hidden';
		zedoc.getElementById('showhide_content_'+keysommaire).style.display='none';
	}
	else {
		zedoc.getElementById('showhide_weight_'+keysommaire).className='sommaire_showed';
		zedoc.getElementById('showhide_cat_'+keysommaire).className='sommaire_showed';
		zedoc.getElementById('showhide_suppr_'+keysommaire).className='sommaire_showed';
		zedoc.getElementById('showhide_content_'+keysommaire).style.display='';
	}
}
<?php //fonction qui change l'affichage des modules/liens masqués ?>
function sommaire_hidelink(keysommaire,z,sens,zedoc) {
	if (sens=='hide') {
		zedoc.getElementById('spana'+keysommaire+'_'+z).className='sommaire_hidden';
		zedoc.getElementById('spanb'+keysommaire+'_'+z).className='sommaire_hidden';
		zedoc.getElementById('spanc'+keysommaire+'_'+z).className='sommaire_hidden';
		zedoc.getElementById('spand'+keysommaire+'_'+z).className='sommaire_hidden';
		zedoc.getElementById('spane'+keysommaire+'_'+z).className='sommaire_hidden';
		zedoc.getElementById('spanf'+keysommaire+'_'+z).className='sommaire_hidden';
		zedoc.getElementById('spang'+keysommaire+'_'+z).className='sommaire_hidden';
		zedoc.getElementById('spanh'+keysommaire+'_'+z).className='sommaire_hidden';
		zedoc.getElementById('spani'+keysommaire+'_'+z).className='sommaire_hidden';
		zedoc.getElementById('spanj'+keysommaire+'_'+z).className='sommaire_hidden';		
	}
	else {
		zedoc.getElementById('spana'+keysommaire+'_'+z).className='sommaire_showed';
		zedoc.getElementById('spanb'+keysommaire+'_'+z).className='sommaire_showed';
		zedoc.getElementById('spanc'+keysommaire+'_'+z).className='sommaire_showed';
		zedoc.getElementById('spand'+keysommaire+'_'+z).className='sommaire_showed';
		zedoc.getElementById('spane'+keysommaire+'_'+z).className='sommaire_showed';
		zedoc.getElementById('spanf'+keysommaire+'_'+z).className='sommaire_showed';
		zedoc.getElementById('spang'+keysommaire+'_'+z).className='sommaire_showed';
		zedoc.getElementById('spanh'+keysommaire+'_'+z).className='sommaire_showed';
		zedoc.getElementById('spani'+keysommaire+'_'+z).className='sommaire_showed';
		zedoc.getElementById('spanj'+keysommaire+'_'+z).className='sommaire_showed';
	}
}
</script>
<?php
} //end of js code.
$zetheme=get_theme();
function index() {
	global $db, $sql, $prefix, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolorhide, $bgcolorhidefallback, $textcolor1, $keysommaire, $deletecat, $upgrade_test, $urlofimages;
	global $admin_file;
	if (!isset($admin_file)) {$admin_file="admin";}
	include_once("header.php");
	if ($bgcolor2=='silver' || $bgcolor2=='#c0c0c0' ||$bgcolor3=='silver' || $bgcolor3=='#c0c0c0') {
		$bgcolorhide=$bgcolorhidefallback;
	}	
	sommaire_js_code();
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=sommaire'>Navigation Menu Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
//	OpenTable();
	//on va regarder tous les fichiers dans /images/sommaire pour en faire la liste
	$handle=@opendir("$urlofimages");
	$compteur=0;
	$old_school_imagedropdown=0;
	while ($tempo = @readdir($handle)) {
		$file[$compteur]= $tempo;
		if (preg_match("/\.swf$/",$file[$compteur])) {
			$old_school_imagedropdown=1;
		}
		$compteur++;
	}
	@closedir($handle);
	// --> OK, la liste des fichiers est dans $file (utile plus bas pour faire la liste déroulante des images).
	if ($old_school_imagedropdown==0) {
		// v2.5 : nouvelle méthode pour sélectionner les images. désactivée si il y a des fichiers flash.
		//on va créer un DIV contenant toutes les images, pour pouvoir les sélectionner.
		echo "<div id=\"sommaire_imagelist\" style=\"display: none; z-index:2; position: absolute; padding: 15px;\">";// onclick=\"document.getElementById('sommaire_imagelist').style.display='none';fSwapSelect('sommaire_imagelist');\"
		echo "<div id=\"imagelist_wrapper\" style=\"z-index:3; background-color: ".$bgcolor3."; border: 1px solid black;\">";
//onmouseover=\"this.style.display: none;fSwapSelect('sommaire_imagelist');\"		
		echo "<table cellpadding=2 title=\""._SOMJSFIXFORIE1."\" style=\"background-color: ".$bgcolor3.";\" id=\"sommaire_imagelist_table\">";//display: none; z-index:2; position: absolute;
		$imgcounter=1;
		echo "<tr><td><a href=\"javascript:sommaire_changeimageform('noimg');\"><img src=\"".$urlofimages."/admin/noimg.gif\" onmouseover=\"this.style.outline='1px outset ".$bgcolor2."'\" onmouseout=\"this.style.outline='none'\"></a></td>";
		for ($i=0;$i<count($file);$i++) {//on crée une entrée dans la listbox pour chaque image présente dans le répertoire /images/sommaire
			if ($file[$i] != "." && $file[$i] != ".." && $file[$i] != "categories" && $file[$i] != "admin") {
				if ($imgcounter>=4) {
					$imgcounter=0;
					echo "</tr><tr>";
				}
				echo "<td><a href=\"javascript:sommaire_changeimageform('".$file[$i]."');\"><img src=\"".$urlofimages."/".$file[$i]."\" onmouseover=\"this.style.outline='1px outset ".$bgcolor2."'\" onmouseout=\"this.style.outline='none'\"></a></td>";
				$imgcounter++;
			}
		}
		echo "</tr></table>";
		echo "</div>";
		echo "</div>";
	}
	//on va regarder tous les fichiers dans /images/sommaire/categories pour en faire la liste
	$handle=@opendir("$urlofimages/categories");
	$compteur=0;
	$old_school_imagedropdown_cat=0;
	while ($tempo = @readdir($handle)) {
		$file2[$compteur]= $tempo;
		if (preg_match("/\.swf$/",$file2[$compteur])) {
			$old_school_imagedropdown_cat=1;
		}
		$compteur++;
	}
	@closedir($handle);
	// --> OK, la liste des fichiers est dans $file2 (utile plus bas pour faire la liste déroulante des images des modules).
	sort($file2,SORT_STRING);
	if ($old_school_imagedropdown_cat==0) {
		// v2.5 : nouvelle méthode pour sélectionner les images. désactivée si il y a des fichiers flash.
		//on va créer un DIV contenant toutes les images, pour pouvoir les sélectionner.
		echo "<script type=\"text/javascript\">oldschool=0;</script>"; //nécessaire car le formulaire pour l'image est soit un <SELECT> soit un HIDDEN
		echo "<div id=\"sommaire_imagelist_cat\" style=\"display: none; z-index:2; position: absolute; padding: 15px;\">";
		echo "<div id=\"imagelist_wrapper_cat\" style=\"z-index:3; background-color: ".$bgcolor3."; border: 1px solid black;\">";
		//echo "<div id=\"sommaire_imagelist_cat\" style=\"display: none;z-index:2; position: absolute;\">";//  onmouseout=\"this.style.display='none';fSwapSelect('sommaire_imagelist_cat');\"
		echo "<table cellpadding=2 style=\"background-color: ".$bgcolor3.";\" title=\""._SOMJSFIXFORIE1."\" id=\"sommaire_imagelist_cat_table\">";//display: none; z-index:2; position: absolute;
		$imgcounter=1;
		echo "<tr><td><a href=\"javascript:sommaire_changeimageform_cat('middot.gif');\"><img src=\"".$urlofimages."/admin/middot.gif\" onmouseover=\"this.style.outline='1px outset ".$bgcolor2."'\" onmouseout=\"this.style.outline='none'\"></a></td>";
		for ($i=0;$i<count($file2);$i++) {//on crée une entrée dans la listbox pour chaque image présente dans le répertoire /images/sommaire
			if ($file2[$i] != "." && $file2[$i] != "..") {
				if ($imgcounter>=4) {
					$imgcounter=0;
					echo "</tr><tr>";
				}
				echo "<td><a href=\"javascript:sommaire_changeimageform_cat('".$file2[$i]."');\"><img src=\"".$urlofimages."/categories/".$file2[$i]."\" onmouseover=\"this.style.outline='1px outset ".$bgcolor2."'\" onmouseout=\"this.style.outline='none'\"></a></td>";
				$imgcounter++;
			}
		}
		echo "</tr></table>";
		echo "</div>";
		echo "</div>";
	}
	else {
		echo "<script type=\"text/javascript\">oldschool=1;</script>";
	}
	// on va mettre la liste des modules dans la variable $modules
	$sql = "SELECT title FROM ".$prefix."_modules ORDER BY title ASC";
	$modulesaffiche= $db->sql_query($sql);
	$compteur=0;
	while ($tempo = $db->sql_fetchrow($modulesaffiche)) {
		$modules[$compteur]= $tempo['title'];
		$compteur++;
	}
	// on va mettre les données de la table nuke_sommaire_categories dans les variables adéquates.
	$sql2= "SELECT id, groupmenu, module, url, url_text, image, new, new_days, class, bold, sublevel, date_debut, date_fin, days FROM ".$prefix."_sommaire_categories ORDER BY id ASC";
	$result2= $db->sql_query($sql2);
	$compteur=0;
	$row2=$db->sql_fetchrow($result2); //on récupère la première ligne de la table, et on affecte aux variables.
	$categorie=$row2['groupmenu'];
	$moduleinthisgroup[$categorie][$compteur]=str_replace("\"","&quot;",$row2['module']);
	$linkinthisgroup[$categorie][$compteur]=str_replace("\"","&quot;",$row2['url']);
	$linktextinthisgroup[$categorie][$compteur]=str_replace("\"","&quot;",$row2['url_text']);
	$imageinthisgroup[$categorie][$compteur]=$row2['image'];
	$newinthisgroup[$categorie][$compteur]=$row2['new'];
	$new_days=$new_daysinthisgroup[$categorie][$compteur]=$row2['new_days'];
	$firstclass=$classofthismodule[$categorie][$compteur]=$row2['class'];
	$grasofthismodule[$categorie][$compteur]=$row2['bold'];
	$sublevel[$categorie][$compteur]=$row2['sublevel'];
	$idofthismodule[$categorie][$compteur]=$row2['id'];
	$date_debut_link[$categorie][$compteur]=$row2['date_debut'];
	$date_fin_link[$categorie][$compteur]=$row2['date_fin'];
	$days_link[$categorie][$compteur]=$row2['days'];
	//$invisible[$categorie][$compteur]=$row2['invisible'];
	//$global_invisible=$row2['invisible'];
	$compteur2=$categorie;
	//		echo "{$moduleinthisgroup[$categorie][$compteur]}<br />{$linkinthisgroup[$categorie][$compteur]}<br />{$linktextinthisgroup[$categorie][$compteur]}<br />{$imageinthisgroup[$categorie][$compteur]}<br />";
	while ($row2 = $db->sql_fetchrow($result2)) { //ensuite on fait la même chose pour toutes les autres lignes.
	$categorie=$row2['groupmenu'];
	if ($compteur2==$categorie) { //permet de savoir si on a changé de catégorie (groupmenu différent) : dans ce cas on remet le 2ème compteur à 0.
	$compteur++;
	}
	else {
		$compteur=0;
	}
	$moduleinthisgroup[$categorie][$compteur]=str_replace("\"","&quot;",$row2['module']);
	$linkinthisgroup[$categorie][$compteur]=str_replace("\"","&quot;",$row2['url']);
	$linktextinthisgroup[$categorie][$compteur]=str_replace("\"","&quot;",$row2['url_text']);
	$imageinthisgroup[$categorie][$compteur]=$row2['image'];
	$newinthisgroup[$categorie][$compteur]=$row2['new'];
	$new_daysinthisgroup[$categorie][$compteur]=$row2['new_days'];
	$classofthismodule[$categorie][$compteur]=$row2['class'];
	$grasofthismodule[$categorie][$compteur]=$row2['bold'];
	$sublevel[$categorie][$compteur]=$row2['sublevel'];
	$idofthismodule[$categorie][$compteur]=$row2['id'];
	$date_debut_link[$categorie][$compteur]=$row2['date_debut'];
	$date_fin_link[$categorie][$compteur]=$row2['date_fin'];
	$days_link[$categorie][$compteur]=$row2['days'];
	//$invisible[$categorie][$compteur]=$row2['invisible'];
	$compteur2=$categorie;
	//		echo "{$moduleinthisgroup[$categorie][$compteur]}<br />{$linkinthisgroup[$categorie][$compteur]}<br />{$linktextinthisgroup[$categorie][$compteur]}<br />{$imageinthisgroup[$categorie][$compteur]}<br />";
	}
	// --> OK, les variables ont pris la valeur adéquate de la table nuke_sommaire_categories
//	echo "<div align=\"center\" class=\"title\">"._SOMADMINTITLE."</div>";
//	CloseTable();
	echo"<br />";
	OpenTable();
	echo "<style type=\"text/css\">"
	.".texte 	{ COLOR: $textcolor1; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica}"
	.".red {COLOR: #FF0000; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; FONT-WEIGHT: bold}"
	."INPUT 		{BORDER-TOP-COLOR: #000000; BORDER-LEFT-COLOR: #000000; BORDER-RIGHT-COLOR: #000000; BORDER-BOTTOM-COLOR: #000000; BORDER-TOP-WIDTH: 1px; BORDER-LEFT-WIDTH: 1px; FONT-SIZE: 10px; BORDER-BOTTOM-WIDTH: 1px; FONT-FAMILY: Verdana,Helvetica; BORDER-RIGHT-WIDTH: 1px}"
	.".disabled { background-color: $bgcolor1; border-style: none}"
	."IMG {border: 0;}"
	.".sommaire_hidden {background-image: url(".$urlofimages."/admin/hidden_background.gif); background-repeat: repeat;}"
	.".sommaire_showed {background-image: '';}"
	."</style>";
	// on récupère la table nuke_sommaire
	$sql = "SELECT groupmenu, name, image, lien, hr, center, bgcolor, invisible, class, new, bold, listbox, dynamic, date_debut, date_fin, days FROM ".$prefix."_sommaire ORDER BY groupmenu ASC";
	$result = $db->sql_query($sql);
	if (!$result) {die("<div class=\"red\" align=\"center\" style=\"font-size:16px\"><strong><br />"._SOMNOTABLEPB."<br /></strong></div>");}
	echo""
	."<br /><div class=\"red\" align=\"center\"><br />"._SOMATTNSUPPRCAT."<br /></div>";
        echo "<strong><br /><center><a href='".$admin_file.".php?op=modules'>Go To Modules Administration</a></center></strong>";
	echo ""
	."<form action=\"".$admin_file.".php?op=sommaire&amp;go=send\" method=\"post\" name=\"form_sommaire\">"
	."<table align=\"center\"><tr><td colspan=\"2\">"
	."<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=$bgcolor1><tr><td bgcolor=\"#000000\">"
	."<table align=\"center\" cellspacing=\"1\" cellpadding=\"4\"  bordercolor=\"$bgcolor1\">"
	."<tr align=\"center\"><td bgcolor=\"$bgcolor2\"><strong>"._SOMWEIGHT."</strong></td><td bgcolor=\"$bgcolor2\" ><strong>"._SOMCATEGORIES."</strong></td><td bgcolor=\"$bgcolor2\" ><strong>"._SOMACTION."</strong></td></tr>";
	$now=time();
	// on va afficher le tableau d'administration : une ligne pour chaque catégorie rentrée dans la table, + une dernière ligne pour ajouter une catégorie.
	$keysommaire=0;
	if (!$result) {echo "<tr><td colspan=4>"._SOMNOTABLEPB."</td></tr>";}
	while ($row = $db->sql_fetchrow($result)) {  // on écrit une ligne du formulaire avec les données de nuke_sommaire pour chaque ligne de nuke_sommaire
	$groupmenu[$keysommaire] = $row['groupmenu'];
	$catname[$keysommaire] = $row['name'];
	$image[$keysommaire] = $row['image'];
	$lien[$keysommaire] = $row['lien'];
	$hr[$keysommaire] = $row['hr'];
	$center[$keysommaire] = $row['center'];
	$categoriebgcolor[$keysommaire] = $row['bgcolor'];
	$invisible[$keysommaire] = $row['invisible'];
	$categoryclass[$keysommaire] = $row['class'];
	$new[$keysommaire]= $row['new'];
	$bold[$keysommaire]= $row['bold'];
	$listbox[$keysommaire] = $row['listbox'];
	$dynamic[$keysommaire] = $row['dynamic'];
	$date_debut_cat[$keysommaire] = $row['date_debut'];
	$date_fin_cat[$keysommaire] = $row['date_fin'];
	$days_cat[$keysommaire] = $row['days'];	
	if ($groupmenu[$keysommaire]==99) { //quand on est à la dernière catégorie de la table (99 - catégorie vide), on affiche une nouvelle ligne du tableau
	echo "<tr align=\"center\"><td bgcolor=\"$bgcolor1\" colspan=3><strong><br />"._SOMNEWCATEGORY."<br /><br /></strong></td></tr>";
	$checkshowadmin=($catname[$keysommaire]=='sommairenoadmindisplay') ? "" : "checked" ; // v2.5 utile + bas
	$catname[$keysommaire]=$row['name']=""; // on reset le nom, qui ne doit pas apparaître !
	$key99=$groupmenu[$keysommaire];
	$keysommaire99=$keysommaire;
	$keyadd = $groupmenu[$keysommaire-1]; // pour incrémenter : $groupmenu[$keysommaire] n'existe pas, puisque on a affiché toutes les lignes de nuke_sommaire!
	$keyadd = $keyadd+1;
	$groupmenu[$keysommaire]=$keyadd;
	}
	if (strpos($days_cat[$keysommaire],'8')!==false || $now<$date_debut_cat[$keysommaire] || ($date_fin_cat[$keysommaire]>0 && $now>$date_fin_cat[$keysommaire])) {
		//il faut !== car si 8 est en première position, strpos retourne 0 (qui est différent de false, mais != ne fait pas la différence)
		$catclass=" class=\"sommaire_hidden\"";
		$display_cat=" style=\"display: none;\"";
	}
	else {
		$catclass="";
		$display_cat="";
	}
	echo""
	."<tr align=\"center\">"
	."<td bgcolor=\"$bgcolor2\"".$catclass." rowspan=\"2\" id=\"showhide_weight_$keysommaire\">"
	."<input type=\"text\" name=\"sommaireformgroupmenu[$keysommaire]\" size=\"2\" maxlength=2 value=\"$groupmenu[$keysommaire]\" onchange='check_numeric(this,$groupmenu[$keysommaire])'><br />";
	echo "<input type=\"hidden\" name=\"sommaire_schedule_date_debut_cat[".$keysommaire."]\" value=\"".$date_debut_cat[$keysommaire]."\">";
	echo "<input type=\"hidden\" name=\"sommaire_schedule_date_fin_cat[".$keysommaire."]\" value=\"".$date_fin_cat[$keysommaire]."\">";
	echo "<input type=\"hidden\" name=\"sommaire_schedule_days_cat[".$keysommaire."]\" value=\"".$days_cat[$keysommaire]."\">";
	echo "<a href=\"javascript:envoiedit('".$keysommaire."', 'imacategory', 'schedule');\" title=\""._SOMSCHEDULE."\"><img src=\"$urlofimages/admin/clock-small.gif\" style=\"margin-top:3px;\"></a>";
	echo "</td>"
	."<td bgcolor=\"$bgcolor3\"".$catclass." id=\"showhide_cat_$keysommaire\"><table align=\"left\" cellspacing=\"0\" cellpadding=\"0\" border=0>";
	$newcolor = ( $new[$keysommaire]=="on" ) ? "new.gif" : "new_gray.gif" ;
	echo "<tr height=8><td></td></tr><tr align=\"center\"><td><strong>"._SOMCATNAME."</strong></td>";
	if ($old_school_imagedropdown==1) { // v2.5 : si il y a un fichier flash, on affiche le titre pour le dropdown. sinon, on n'affiche pas.
		echo "<td><strong>"._SOMIMGNAME."</strong></td>";
	}
	echo "<td align=\"center\" width=\"100%\"><strong>"._SOMCATLINK."</strong></td><td>&nbsp;<strong><LABEL FOR=\"sommaireformcenter[$keysommaire]\">"._SOMCENTER25."</LABEL></strong></td><td>&nbsp;<strong>"._SOMBOLD."</strong></td><td></td><td></td></tr><tr height=\"8\"><td></td></tr><tr align=\"center\">";
	echo "<td align =\"left\">";
	echo "<input type=\"Hidden\" name=\"sommaireformkeysommaire\" value=\"$keysommaire\">" //utile pour la fonction send : on sait à quelle ligne on fait référence
	."<input type=\"Hidden\" name=\"sommaireformgroupmenu[99]\" value=\"99\">";//utile car la requête sql efface toutes les données et n'écrit dans nuke_sommaire que les données entrées dans le formulaire.
	// si l'image de catégorie indiquée dans la DB est "noimg" (--> pas d'image!), on affiche l'image 'noimg.gif'.
	$zeimgname = ($image[$keysommaire]=="noimg" || $image[$keysommaire]=='') ? "admin/noimg.gif" : $image[$keysommaire];
	if ($old_school_imagedropdown==0) {
		echo "<table cellpadding=0 cellspacing=0 border=0><tr><td style=\"padding-right: 3px;\"><table title=\""._SOMADMINIMGDROPDOWN."\" cellpadding=1 cellspacing=0 style=\"cursor: pointer; margin: 0px; border: 1px solid black;\" onclick=\"clicked=0;s=1;keysommaire_image='".$keysommaire."';sommaire_displayimagelist(document.images['catimage".$keysommaire."'],'sommaire_imagelist');\"><tr><td><img src=\"".$urlofimages."/".$zeimgname."\" name=\"catimage".$keysommaire."\" title=\""._SOMADMINIMGDROPDOWN."\"></td><td style=\"vertical-align: bottom; background-color: ".$bgcolor2."; padding: 0px;\"><img src=\"".$urlofimages."/admin/dn.gif\" title=\""._SOMADMINIMGDROPDOWN."\"></td></tr></table></td>";
	}
	else {
		echo "<table cellpadding=0 cellspacing=0 border=0><tr><td style=\"padding-right: 3px;\"><img src=\"".$urlofimages."/".$zeimgname."\" name=\"catimage".$keysommaire."\"></td>";
	}
	if ($image[$keysommaire]=="") {
		$image[$keysommaire]="noimg";
	}
	echo "<td><input type=\"text\" name=\"sommaireformname[$keysommaire]\" size=\"20\" maxlength=150 value=\"$catname[$keysommaire]\"></td></tr></table>";
	//v2.5 : on vire la listbox, remplacée par le DIV affichant toutes les images.
	if ($old_school_imagedropdown==0) {
		echo "<input type=\"hidden\" name=\"sommaireformimage[$keysommaire]\" value=\"".$image[$keysommaire]."\"></td>";
	}
	else { // méthode old school ;-) (nécessaire s'il y a des fichiers flash)
		echo "</td><td><select name=\"sommaireformimage[$keysommaire]\" onchange=\"changeimage('catimage".$keysommaire."',this.value)\">";
		$selected = ($image[$keysommaire]=="noimg") ? "selected" : "" ;
		echo "<option value=\"noimg\" $selected>"._SOMNOIMG."</option>";
		for ($i=0;$i<count($file);$i++) { //on crée une entrée dans la listbox pour chaque image présente dans le répertoire /images/sommaire
		if ($file[$i] != "." && $file[$i] != ".." && $file[$i] != "categories" && $file[$i] != "admin") {
			if ($file[$i]==$image[$keysommaire]) {
				echo "<option value =\"$file[$i]\" selected>$file[$i]</option>";
			}
			else {
				echo "<option value =\"$file[$i]\" >$file[$i]</option>";
			}
		}
		}
		echo "</select></td>";
	}
	echo ""
	."<td align=\"center\">";
	$testehttp=strpos($lien[$keysommaire],"http://");
	$testeftp=strpos($lien[$keysommaire],"ftp://");
	$testehttps=strpos($lien[$keysommaire],"https://");
	//$affichetblank = ($testehttp===0 || $testeftp===0 || $testehttps===0) ? "targetblank" : "none"; //permet d'afficher l'image "ouvrir dans une nouvelle fenêtre" si le lien commence par http:// ou ftp://
	//$alttblank = ($testehttp===0 || $testeftp===0 || $testehttps===0) ? ""._SOMTARGETBLANK."" : ""._SOMTARGETNONE.""; //permet d'afficher l'image "ouvrir dans une nouvelle fenêtre" si le lien commence par http:// ou ftp://
	if ($testehttp===0 || $testeftp===0 || $testehttps===0) {
		$displaytargetblank="inline";
		$displaytargetnone="none";
	}
	elseif ($lien[$keysommaire]!="") {
		$displaytargetblank="none";
		$displaytargetnone="inline";
	}
	else {
		$displaytargetblank="none";
		$displaytargetnone="none";
	}
	echo "<img style=\"display: ".$displaytargetblank."; width: 15px; margin-right: 5px;\" src=\"".$urlofimages."/admin/targetblank.gif\" name=\"targetblank$keysommaire\" alt=\""._SOMTARGETBLANK."\" title=\""._SOMTARGETBLANK."\">";
	echo "<img style=\"display: ".$displaytargetnone."; width: 15px; margin-right: 5px;\" src=\"".$urlofimages."/admin/targetnone.gif\" name=\"targetnone$keysommaire\" alt=\""._SOMTARGETNONE."\" title=\""._SOMTARGETNONE."\">";
	echo "<input type=\"text\" name=\"sommaireformlien[$keysommaire]\" size=\"20\" value=\"$lien[$keysommaire]\" onchange='targetblank(\"".$keysommaire."\",this.value)'></td>";
	$checked = ($center[$keysommaire]=="on") ? "checked" : "" ;
	echo "<td align=\"center\"><input type=\"checkbox\" name=\"sommaireformcenter[$keysommaire]\" id=\"sommaireformcenter[$keysommaire]\" $checked></td>";
	$checked = ( $bold[$keysommaire]<>"" ) ? "checked" : "" ;//on coche la case par défaut si c'est indiqué dans la DB
	echo "<td align=\"center\"><input type=\"checkbox\" name=\"sommaireformbold[$keysommaire]\" $checked></td>";
	$checked = ( $new[$keysommaire]<>"" ) ? "on" : "" ;
	$colornew = ($checked=="on") ? "new" : "new_gray";
	echo "<td><input type=\"hidden\" name=\"sommaireformnew[$keysommaire]\" value=\"$checked\"><img name=\"somcatnew$keysommaire\" src=\"".$urlofimages."/admin/$colornew.gif\" style=\"cursor: pointer;\" alt=\""._SOMIMGNEWTITLE."\" title=\""._SOMIMGNEWTITLE."\" onclick=\"sommairechangecatimgnew(document.images['somcatnew$keysommaire'],'$keysommaire','');\">&nbsp;</td>";
	echo "<td><input type=\"hidden\" name=\"sommaireformdynamic[".$keysommaire."]\" value=\"".$dynamic[$keysommaire]."\">
	[<a href='javascript:envoiedit(".$keysommaire.", \"imacategory\",\"edit\")' title=\""._SOMMOREOPTIONS."\">+</a>]
	</td>"
	."</tr>"
	."<tr height=8><td></td></tr><tr><td align=\"left\" colspan=10 style=\"white-space: nowrap\"><strong>"._SOMMISEENPAGE."</strong>&nbsp;:&nbsp;"; //v2.1 colspan was 6
	$checked = ($hr[$keysommaire]=="on") ? "checked" : "" ;
	echo "<input type=\"checkbox\" name=\"sommaireformhr[$keysommaire]\" id=\"sommaireformhr[$keysommaire]\" $checked>&nbsp;<LABEL FOR=\"sommaireformhr[$keysommaire]\">"._SOMHR."</LABEL>&nbsp;&nbsp;&nbsp;";
	$checked = ($listbox[$keysommaire]=="on") ? "checked" : "" ;
	echo "<input type=\"checkbox\" name=\"sommaireformlistbox[$keysommaire]\" id=\"sommaireformlistbox[$keysommaire]\" $checked>&nbsp;<LABEL FOR=\"sommaireformlistbox[$keysommaire]\">"._SOMLISTBOX."</LABEL>&nbsp;&nbsp;&nbsp;";
	echo "<input type=\"text\" name=\"sommaireformbgcolor[$keysommaire]\" size=8 value=\"$categoriebgcolor[$keysommaire]\">&nbsp;"._SOMBGCOLOR."&nbsp;&nbsp;&nbsp;</td>"
	."</tr><tr height=8><td></td></tr></table></td>"
	."<td bgcolor=\"$bgcolor2\"".$catclass." rowspan=2 id=\"showhide_suppr_$keysommaire\">";
	if ($key99<>99){
		echo "<div class=\"red\"><a href=\"".$admin_file.".php?op=sommaire&amp;go=deletecat&amp;deletecat=$groupmenu[$keysommaire]&amp;catname=$catname[$keysommaire]\" title=\""._SOMSUPPR."\" onclick=\"if (confirm('"._SOMJSSAVEBEFORE."')) {document.forms.form_sommaire.submit();};\"><img src=\"".$urlofimages."/admin/trash.gif\" border=0></a></div>";
	}
	echo "</td>"
	."</tr><tr><td bgcolor=\"$bgcolor1\" id=\"showhide_content_$keysommaire\"".$display_cat.">";
	// maintentant, on va afficher les modules inscrits dans la catégorie actuelle
	// combien y a-t-il de modules dans cette catégorie ?
	$nbmodules = $nombremodules = count($moduleinthisgroup[$groupmenu[$keysommaire]]);
	$nombremodules=$nombremodules+4; // on en ajoute 4, qui vont être vides
	echo "<table align=\"center\" border=0 cellspacing=0 cellpadding=2 width=\"100%\"><tr><td></td><td align =\"center\">"._SOMCATCONTENT."</td><td align=\"center\">"._SOMLINKURL."</td><td align=\"center\">"._SOMLINKTEXT."</td><td width=\"3\"></td>";
	if ($old_school_imagedropdown_cat==1) {
		echo "<td align=\"center\">"._SOMIMAGE."</td>";
	}
	else {
		//echo "<td align=\"center\"></td>";
	}
	echo "<td align=\"center\">"._SOMBOLD."</td><td></td><td></td></tr>";
	echo "<tr><td colspan=11 height=4></td></tr>";
	for ($z=0;$z<$nombremodules;$z++) {
		$formpointeur=$keysommaire."_".$z."";
		// permet d'afficher le middot pour les champs vides ajoutés (quand nombremodules a été augmenté de 1 ou 2)
		if ($imageinthisgroup[$groupmenu[$keysommaire]][$z]=='' || $imageinthisgroup[$groupmenu[$keysommaire]][$z]=='middot.gif') {
			$afficheimageinthiscategorie="admin/middot.gif";
		}
		else {
			$afficheimageinthiscategorie="categories/".$imageinthisgroup[$groupmenu[$keysommaire]][$z];
		}
		if ($sublevel[$groupmenu[$keysommaire]][$z]>0) {
			$sublevelwidth=15*$sublevel[$groupmenu[$keysommaire]][$z];
			$inputadresswidth=20;
			$inputlinktextwidth=15;
			$sublevelimage1="<img src=\"$urlofimages/admin/null.gif\" name=\"sublevelspacer1[$keysommaire][$z]\" height=\"1px\" width=\"".$sublevelwidth."px\">";
			$sublevelbgcolor="";
		}
		else {
			$sublevelwidth=1;
			$sublevelimage1="<img src=\"$urlofimages/admin/null.gif\" name=\"sublevelspacer1[$keysommaire][$z]\" height=\"1px\" width=\"1px\">";
			$inputadresswidth=20;
			$inputlinktextwidth=15;
			$sublevelbgcolor="";
		}
		$now=time();
		if (strpos($days_link[$groupmenu[$keysommaire]][$z],'8')!==false || $now<$date_debut_link[$groupmenu[$keysommaire]][$z] || ($date_fin_link[$groupmenu[$keysommaire]][$z]>0 && $now>$date_fin_link[$groupmenu[$keysommaire]][$z])) {
			//il faut !== car si 8 est en première position, strpos retourne 0 (qui est différent de false, mais != ne fait pas la différence)
		$linkclass=" class=\"sommaire_hidden\"";
		}
		else {
			$linkclass="";
		}
		echo "<tr id=\"span$formpointeur\"><td id=\"spana$formpointeur\"".$linkclass." style=\"text-align:left; vertical-align: middle;\">";//  onclick=\"sommaire_hidelink($keysommaire,$z,'hide',this.document);\"
		$flechehaut=($z==0) ? "" : "<a href=\"javascript:sommaire_move_updown('".$keysommaire."','".$z."','".$nombremodules."','up');\"><img src=\"$urlofimages/admin/up.gif\" alt=\"move up\" title=\""._SOMMOVEUP."\"></a><br /><img src=\"$urlofimages/admin/null.gif\" height=\"2px\" width=\"1px\"><br />";
		$flechebas=($z==$nombremodules-1) ? "" : "<a href=\"javascript:sommaire_move_updown('".$keysommaire."','".$z."','".$nombremodules."','down');\"><img src=\"$urlofimages/admin/down.gif\" alt=\"move down\" title=\""._SOMMOVEDOWN."\"></a>";
		echo "".$flechehaut.$flechebas."</td><td id=\"spanb$formpointeur\"".$linkclass." style=\"text-align:left; vertical-align: middle;\">";
		//v2.5
		//$old_school_imagedropdown_cat=1;
		if ($old_school_imagedropdown_cat==0) {
			echo "<table cellspacing=0 cellpadding=0 border=0 style=\"vertical-align: middle;\"><tr><td style=\"padding-right: 3px;\"><table cellspacing=0 cellpadding=0 border=0><tr><td>".$sublevelimage1."</td><td><table title=\""._SOMADMINIMGDROPDOWNCAT."\" cellpadding=0 cellspacing=0 style=\"cursor: pointer; margin: 0px; border: 1px solid black;\" onclick=\"clicked=0;s=1;keysommaire_image='".$keysommaire."';zimage='".$z."';sommaire_displayimagelist(document.images['image".$formpointeur."'],'sommaire_imagelist_cat');\"><tr><td style=\"padding: 1px;\"><img src=\"".$urlofimages."/".$afficheimageinthiscategorie."\" name=\"image".$formpointeur."\" title=\""._SOMADMINIMGDROPDOWN."\"></td><td style=\"padding: 0px; margin: 0px; vertical-align: bottom; background-color: ".$bgcolor2.";\"><img src=\"".$urlofimages."/admin/dn.gif\" title=\""._SOMADMINIMGDROPDOWN."\"></td></tr></table></td></tr></table>";
		}
		else {
			echo "<table cellspacing=0 cellpadding=0 border=0 style=\"vertical-align: middle;\"><tr><td style=\"padding-right: 3px;\">".$sublevelimage1."<img src=\"".$urlofimages."/".$zeimgname."\" name=\"image".$formpointeur."\">";
		}
	echo "</td>";
		//echo "</td><td align=\"left\" valign=\"center\">";
		// ces 2 variables vont servir à envoyer à la fonction jscript 'disab' la valeur de l'url et de son texte.
		$linkvalue=$linkinthisgroup[$groupmenu[$keysommaire]][$z];
		$linktextvalue=$linktextinthisgroup[$groupmenu[$keysommaire]][$z];
		//echo "{$moduleinthisgroup[$groupmenu[$keysommaire]][$z]}<br />";
		$zz=$z+1;
		if ($z==$nombremodules-1) { // si on est à la dernière listbox, on affiche le message demandant d'envoyer les modifs.
			$hideok =  1;
			$sommairezenom = "sommairespan$keysommaire";
		}
		else {
			$hideok =  1;
			$sommairezenom = "span".$keysommaire."_".$zz."";
		}
		// si on sélectionne 'Lien externe' dans la liste des modules, cela va afficher les inputbox.
echo "<td id=\"spanc$formpointeur\"".$linkclass." style=\"vertical-align: middle;\">";
		// firefox bugfix: il faut utiliser la balise <pre> pour éviter le retour à la ligne du <select> ou de l'image.
		// ie bugfix : on doit remplacer le <pre> par une autre table imbriquée, sinon IE affiche la listbox en vertical-align: up.
		// c'est super le cross-browser design :-/
		echo "<table cellpadding=0 cellspacing=0 border=0 height=\"1px\" style=\"vertical-align: bottom\"><tr><td>";
		echo "<select name=\"sommaireformingroup[$keysommaire][$z]\" onchange='disab(this,this.value,this.form.elements[\"sommaireformmodulelink[$keysommaire][$z]\"],this.form.elements[\"sommaireformmodulelinktext[$keysommaire][$z]\"],\"$linkvalue\",\"$linktextvalue\"); sommaireadminshowhide(\"$sommairezenom\",$hideok)'>";
		echo "<option value=\"Aucun\">";
		$selected = ($moduleinthisgroup[$groupmenu[$keysommaire]][$z]=="SOMMAIRE_HR") ? "selected" : "" ;
		echo "<option value=\"SOMMAIRE_HR\" $selected>*"._SOMMAIREHR."*";
		$selected = ($moduleinthisgroup[$groupmenu[$keysommaire]][$z]=="Lien externe") ? "selected" : "" ;
		echo "<option value=\"Lien externe\" $selected>*"._SOMEXTLINK."*";
		$selected = ($moduleinthisgroup[$groupmenu[$keysommaire]][$z]=="SOMMAIRETEXTONLY") ? "selected" : "" ;
		echo "<option value=\"SOMMAIRETEXTONLY\" $selected>*"._SOMTEXTONLY."*";
		echo "<option value=\"SEP\">¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯";
		for ($i=0;$i<count($modules);$i++) {
			$selected = ($modules[$i]==$moduleinthisgroup[$groupmenu[$keysommaire]][$z]) ? "selected" : "" ;
			echo "<option value=\"$modules[$i]\" $selected>$modules[$i]";
			//echo"{$moduleinthisgroup[$groupmenu[$keysommaire]][$z]}<br />";
		}
		echo "</select>";
		echo "</td><td>"; // table comprenant le SELECT + les images sublevel+ et sublevel-
		$sublevel[$groupmenu[$keysommaire]][$z] = ($sublevel[$groupmenu[$keysommaire]][$z]) ? $sublevel[$groupmenu[$keysommaire]][$z] : 0;
		echo "<input type=\"hidden\" name=\"sublevel[$keysommaire][$z]\" value=\"".$sublevel[$groupmenu[$keysommaire]][$z]."\">";
		if ($z==0) {
			$flechegauche="";
			$flechedroite="";
		}
		else {
			if ($sublevel[$groupmenu[$keysommaire]][$z]==0) {
				$display_fleche_gauche=" style=\"display: none;\"";
			}
			else {
				$display_fleche_gauche="";
			}
			if ($sublevel[$groupmenu[$keysommaire]][$z]>$sublevel[$groupmenu[$keysommaire]][$z-1]) {
				$display_fleche_droite=" style=\"display: none;\"";
			}
			else {
				$display_fleche_droite="";
			}
			$flechegauche="<a href=\"javascript:sommaire_manage_sublevels('$keysommaire','$z','left')\"><img src=\"$urlofimages/admin/left.gif\" name=\"imageleft[$keysommaire][$z]\" alt=\"delete sublevel\" title=\""._SOMREMOVESUBLEVEL."\"".$display_fleche_gauche."></a><img src=\"$urlofimages/admin/null.gif\" height=\"1px\" width=\"2px\">";
			$flechedroite="<a href=\"javascript:sommaire_manage_sublevels('$keysommaire','$z','right')\"><img src=\"$urlofimages/admin/right.gif\" name=\"imageright[$keysommaire][$z]\" alt=\"make sublevel\" title=\""._SOMADDSUBLEVEL."\"".$display_fleche_droite."></a>";
		}
		echo $flechegauche.$flechedroite;
		echo "</td></tr></table>";// table comprenant le SELECT + les images sublevel+ et sublevel-
		echo "</td>";
echo "</td></tr></table>";
		//echo "<td></td>";
		$testehttp=strpos($linkinthisgroup[$groupmenu[$keysommaire]][$z],"http://");
		$testeftp=strpos($linkinthisgroup[$groupmenu[$keysommaire]][$z],"ftp://");
		$testehttps=strpos($linkinthisgroup[$groupmenu[$keysommaire]][$z],"https://");
		if ($testehttp===0 || $testeftp===0 || $testehttps===0) {
			$displaytargetblank="inline";
			$displaytargetnone="none";
		}
		elseif ($linkinthisgroup[$groupmenu[$keysommaire]][$z]!="") {
			$displaytargetblank="none";
			$displaytargetnone="inline";
		}
		else {
			$displaytargetblank="none";
			$displaytargetnone="none";
		}
		echo "<td align=\"center\" id=\"spand$formpointeur\"".$linkclass.">";
		echo "<img style=\"display: ".$displaytargetblank."; width: 15px; margin-right: 5px;\" src=\"".$urlofimages."/admin/targetblank.gif\" name=\"targetblank$formpointeur\" alt=\""._SOMTARGETBLANK."\" title=\""._SOMTARGETBLANK."\">";
		echo "<img style=\"display: ".$displaytargetnone."; width: 15px; margin-right: 5px;\" src=\"".$urlofimages."/admin/targetnone.gif\" name=\"targetnone$formpointeur\" alt=\""._SOMTARGETNONE."\" title=\""._SOMTARGETNONE."\">";
		if ($moduleinthisgroup[$groupmenu[$keysommaire]][$z]=="Lien externe") { // si 'Lien externe' est indiqué dans la DB, on affiche les inputbox, sinon on les masque par défaut
			$visibility_link="";
			$visibility_link_text="";
		}
		elseif ($moduleinthisgroup[$groupmenu[$keysommaire]][$z]=="SOMMAIRETEXTONLY") { // si l'entrée est du texte sans url (ajouté pour les sublevels)
			$visibility_link="style=\"visibility:hidden;\" disabled";// class=\"disabled\"
			$visibility_link_text="";
		}
		else { // si "Lien externe" n'est pas sélectionné par défaut
			$visibility_link="style=\"visibility:hidden;\" disabled";// class=\"disabled\"
			$visibility_link_text="style=\"visibility:hidden;\" disabled";// class=\"disabled\"
		}
		echo""
		."<input type=\"text\"".$visibility_link." name=\"sommaireformmodulelink[$keysommaire][$z]\" value=\"".$linkinthisgroup[$groupmenu[$keysommaire]][$z]."\" size=".$inputadresswidth." onChange='targetblank(\"".$formpointeur."\",this.value)' >"
		."</td><td id=\"spane$formpointeur\"".$linkclass.">"
		."<input type=\"text\"".$visibility_link_text." name=\"sommaireformmodulelinktext[$keysommaire][$z]\" size=".$inputlinktextwidth." value=\"".$linktextinthisgroup[$groupmenu[$keysommaire]][$z]."\">";
		echo "</td>";
		//echo"{$linkinthisgroup[$groupmenu[$keysommaire]][$z]}<br />{$linktextinthisgroup[$groupmenu[$keysommaire]][$z]}<br />";
			//v2.5 : on vire la listbox, remplacée par le DIV affichant toutes les images.
	if ($old_school_imagedropdown_cat==0) {
		$imagenewschool=($imageinthisgroup[$groupmenu[$keysommaire]][$z]=='') ? 'middot.gif': $imageinthisgroup[$groupmenu[$keysommaire]][$z] ;
		echo "<td id=\"spanf$formpointeur\"".$linkclass."><input type=\"hidden\" name=\"sommaireformmoduleimage[".$keysommaire."][".$z."]\" value=\"".$imagenewschool."\"></td>";
	}
	else { // méthode old school ;-) (nécessaire s'il y a des fichiers flash)
		//echo "<td id=\"spanf$formpointeur\"></td>";
		echo "<td id=\"spanf$formpointeur\"".$linkclass." align=\"center\"><select name=\"sommaireformmoduleimage[$keysommaire][$z]\" onChange=\"changeimage_cat('image".$formpointeur."',this.value)\">";
		echo "<option value='middot.gif' >"._SOMNOIMG." ( <strong>&middot;</strong> )</option>";
		for ($i=0;$i<count($file2);$i++) {
			if ($file2[$i] != "." && $file2[$i] != "..") {
				if ($file2[$i]==$imageinthisgroup[$groupmenu[$keysommaire]][$z]) {
					echo "<option value =\"$file2[$i]\" selected>$file2[$i]</option>";
				}
				else {
					echo "<option value =\"$file2[$i]\" >$file2[$i]</option>";
				}
			}
		}
		echo "</select></td>";
	}
		//echo "{$imageinthisgroup[$groupmenu[$keysommaire]][$z]}<br />";
		$checked = ( $grasofthismodule[$groupmenu[$keysommaire]][$z]<>"" ) ? "checked" : "" ;
		echo "<td id=\"spang$formpointeur\"".$linkclass." align=\"center\"><input type=\"checkbox\" name=\"sommaireformmodulegras[$keysommaire][$z]\" $checked></td>";
		$checked = ( $newinthisgroup[$groupmenu[$keysommaire]][$z]<>"" ) ? "on" : "" ;
		$colornew = ($checked=="on") ? "new" : "new_gray";
		//echo "<td align=\"center\"><input type=\"checkbox\" name=\"sommaireformmodulenew[$keysommaire][$z]\" $checked onchange=\"sommairechangecatimgnew(document.images['somnew$formpointeur'])\"><img name=\"somnew$formpointeur\" src=\"".$urlofimages."/admin/$colornew.gif\"></td>";
		echo "<td id=\"spanh$formpointeur\"".$linkclass." align=\"center\"><input type=\"hidden\" name=\"sommaireformmodulenew[$keysommaire][$z]\" id=\"sommaireformmodulenew[$keysommaire][$z]\" value=\"".$checked."\"><img name=\"somnew$formpointeur\" src=\"".$urlofimages."/admin/$colornew.gif\" style=\"cursor: pointer;\" alt=\""._SOMIMGNEWTITLE."\" title=\""._SOMIMGNEWTITLE."\" onclick=\"sommairechangecatimgnew(document.images['somnew$formpointeur'],'$keysommaire','$z');\"></td>";
		echo "<td id=\"spani$formpointeur\"".$linkclass." style=\"text-align:left; vertical-align: middle;\"><a href=\"javascript:envoiedit($keysommaire,$z,'schedule');\" title=\""._SOMSCHEDULE."\"><img src=\"$urlofimages/admin/clock-small.gif\"></a></td>"; 
		echo "<td id=\"spanj$formpointeur\"".$linkclass.">";
		//if ($z<$nbmodules) {
			echo "[<a href='javascript:envoiedit(".$keysommaire.", ".$z.",\"edit\")' title=\""._SOMMOREOPTIONS."\">+</a>]";
		//}
		echo "</td>";
		echo "</tr>";
		if ($z>$nbmodules) { // pour n'afficher qu'une seule liste déroulante vide, on cache les autres.
		echo "<script type=\"text/javascript\" language=\"JavaScript\">"
		."sommaireadminshowhide(\"span$formpointeur\",0);"
		." </script>";
		}
		$inputmoduleclass = ($classofthismodule[$groupmenu[$keysommaire]][$z]=="") ? $firstclass : $classofthismodule[$groupmenu[$keysommaire]][$z];
		echo "<input type=\"hidden\" name=\"sommaireformmoduleclass[$keysommaire][$z]\" value=\"".$inputmoduleclass."\">";
		$inputnewdays= ($new_daysinthisgroup[$groupmenu[$keysommaire]][$z]=="") ? $new_days : $new_daysinthisgroup[$groupmenu[$keysommaire]][$z];
		echo "<input type=\"hidden\" name=\"sommaireformmodulenew_days[$keysommaire][$z]\" value=\"".$inputnewdays."\">";
		echo "<input type=\"hidden\" name=\"sommaire_schedule_date_debut[$keysommaire][$z]\" value=\"".$date_debut_link[$groupmenu[$keysommaire]][$z]."\">";
		echo "<input type=\"hidden\" name=\"sommaire_schedule_date_fin[$keysommaire][$z]\" value=\"".$date_fin_link[$groupmenu[$keysommaire]][$z]."\">";
		echo "<input type=\"hidden\" name=\"sommaire_schedule_days[$keysommaire][$z]\" value=\"".$days_link[$groupmenu[$keysommaire]][$z]."\">";
		//echo "<br />{$new_daysinthisgroup[$groupmenu[$keysommaire]][$z]}<br />";
	} //end for : on a affiché tous les modules/liens de cette catégorie
	echo "<tr id=\"sommairespan$keysommaire\" style=\"display:none;\"><td></td><td colspan=8>"._SOMSENDTOHAVEMORE."</td></tr>";//affiche le message demandant d'envoyer les modifs.
	echo "</table>";
	echo"</td></tr>";
	echo "<input type=\"hidden\" name=\"sommaireformeachcategoryclass[$keysommaire]\" value=\"$categoryclass[$keysommaire]\">";
	$keysommaire++;
	} //end while : on a affiché toutes les catégories.
	$radio1=($invisible[$keysommaire99]==1) ? "checked" : "";
	$radio2=($invisible[$keysommaire99]==2 || $invisible[$keysommaire99]==4) ? "checked" : ""; //gestion des groupes : si 4==>icone 'interdit' avec gestion groupes
	$radio3=($invisible[$keysommaire99]==3 || $invisible[$keysommaire99]==5) ? "checked" : "";//gestion des groupes : si 5==>modules invisibles avec gestion groupes
	$radionew=($new_days==-1) ? "" : "checked";
	$disablenewdays=($new_days==-1) ? "disabled" : "";
	$new_days_value = ($new_days==-1) ? "" : $new_days;
	$checkdynamic = ($dynamic[$keysommaire99]=="on") ? "checked" : "" ;
	echo "</table></td></tr></table>"
	."<br /></td></tr>"
	."<tr><td colspan=\"2\"><br /><div  align=\"center\"><strong>"._SOMGENERALOPTIONS." :</strong></div><br /><br />"
	."<table cellpadding=\"0\" cellspacing=\"0\" align=\"center\"><tr><td><strong>"._SOMDISPLAYMEMBERSONLYMODULES." :</strong></td><td width=\"50\"></td><td><strong>"._SOMDISPLAYCLASSES."</strong></td></tr>"
	."<tr><td><input type=\"radio\" name=\"sommaireformradio\" id=\"sommaireformradio1\" value=\"1\" $radio1><LABEL for=\"sommaireformradio1\">"._SOMDISPLAYMODULENORMAL."</LABEL></td>"
	."<td></td><td><input type=\"text\" name=\"sommaireformclass\" size=\"15\" value=\"$categoryclass[0]\">&nbsp;"._SOMCATEGORIESCLASS."</td></tr>"
	."<tr><td><input type=\"radio\" name=\"sommaireformradio\" id=\"sommaireformradio2\" value=\"2\" $radio2><LABEL for=\"sommaireformradio2\">"._SOMDISPLAYMODULEWITHICON." <img src=\"".$urlofimages."/admin/interdit.gif\"> "._SOMDISPLAYMODULEWITHICONFORVISTORS."</LABEL></td>"
	."<td></td><td><input type=\"text\" name=\"sommaireformclassformodules\" size=\"15\" value=\"".$firstclass."\">&nbsp;"._SOMMODULESCLASS."</td></tr>"
	."<tr><td><input type=\"radio\" name=\"sommaireformradio\" id=\"sommaireformradio3\" value=\"3\" $radio3><LABEL for=\"sommaireformradio3\">"._SOMDISPLAYMODULEINVISIBLE."</LABEL></td></tr>"
	."<tr><td colspan=3><input type=\"checkbox\" name=\"sommaireformnew_type\" id=\"sommaireformnew_type\" $radionew onchange='if (this.form.elements[\"sommaireformnew_days\"].disabled==true){this.form.elements[\"sommaireformnew_days\"].disabled=false;}else{this.form.elements[\"sommaireformnew_days\"].disabled=true;}'><LABEL for=\"sommaireformnew_type\"><strong>"._SOMAUTODETECTNEW."</strong></LABEL>&nbsp;("._SOMSINCE." <input type=\"text\" name=\"sommaireformnew_days\" value=\"".$new_days_value."\" size=2 $disablenewdays> "._SOMNBDAYS.")"
	."<input type=\"hidden\" name=\"sommaireformfirstnew_days\" value=\"".$new_days."\"><input type=\"hidden\" name=\"sommaireformfirstclass\" value=\"".$firstclass."\"></td></tr>"
	."<tr><td colspan=3><input type=\"checkbox\" name=\"sommaireformdynamic_general\" id=\"sommaireformdynamic_general\" $checkdynamic><LABEL for=\"sommaireformdynamic_general\"><strong>"._SOMDYNAMICMENU."</strong></LABEL><br /><br /></td></tr>
	<tr><td colspan=3><input type=\"checkbox\" name=\"sommaireshowadmin\" id=\"sommaireshowadmin\" $checkshowadmin><LABEL for=\"sommaireshowadmin\"><strong>"._SOMSHOWADMIN."</strong></LABEL></td></tr>
	</table></td></tr>"
	."<tr><td width=\"50%\" align=\"center\"><input type='reset' value=\""._SOMCANCEL."\"></td><td width=\"50%\" align=\"center\"><input type=\"submit\" value=\""._SOMPOST."\"></td></tr>"
	."</table>"
	."</form>";
	echo""
	."<br /><br />"._SOMREMARKS.""._SOMMAIREREMARKSTWO.""
	."<br /><div align=\"center\"><a href=\"http://marcoledingue.free.fr/modules.php?name=Content&amp;pa=list_pages_categories&amp;cid=1\" style=\"FONT-SIZE:16px\" target=\"_blank\"><strong>FAQ</strong></a><br /><br />Platinum Version - &copy; <a href=\"mailto:marcoledingue@free.fr?body=Read the FAQ before asking me questions!!\">marcoledingue</a></div>";
	CloseTable();
	//include_once("footer.php");
}
function send() { // fonction appelée quand on clique 'OK' sur le formulaire
global $sommaireformkeysommaire, $sommaireformgroupmenu, $sommaireformname, $sommaireformimage, $sommaireformlien, $sommaireformingroup, $sommaireformmoduleimage, $sommaireformmodulelink, $sommaireformmodulelinktext, $sommaireformcenter, $sommaireformhr, $sommaireformbgcolor,$sommaireformradio, $sommaireformclass, $sommaireformbold, $sommaireformnew , $sommaireformlistbox, $sommaireformeachcategoryclass, $sommaireformmodulegras, $sommaireformmodulenew, $sommaireformnew_type, $sommaireformnew_days, $sommaireformmodulenew_days, $sommaireformfirstnew_days, $sommaireformmoduleclass, $sommaireformclassformodules, $sommaireformfirstclass, $sommaireformdynamic, $sublevel, $db, $prefix, $sql;
global $admin_file;
global $sommaire_schedule_date_debut, $sommaire_schedule_date_fin, $sommaire_schedule_days, $sommaire_schedule_date_debut_cat, $sommaire_schedule_date_fin_cat, $sommaire_schedule_days_cat, $sommaireshowadmin, $sommaireformdynamic_general;
if (!isset($admin_file)) {$admin_file="admin";}
//	global $sommaireformmoduleimage0_0, $sommaireformmoduleimage0_1, $sommaireformmoduleimage0_2, $sommaireformmoduleimage1_0, $sommaireformmoduleimage1_1, $sommaireformmoduleimage1_2;
$sommaireformnew_days=($sommaireformnew_type=="on") ? $sommaireformnew_days : "-1" ;
//si les valeurs de 'groupmenu' (Poids) entrées dans le formulaire ne sont pas des nombres de 0 à 98, --> die
for ($i=0; $i<=$sommaireformkeysommaire; $i++) {
	if ((!preg_match("/([0-9]{1,2})/",$sommaireformgroupmenu[$i])) OR ($sommaireformgroupmenu[$i]==99)) {
		include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=sommaire'>Navigation Menu Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
		OpenTable();
		echo"<div align=\"center\">";
		echo ""._SOMINVALIDWEIGHT."&nbsp;'$sommaireformname[$i]'&nbsp;($sommaireformgroupmenu[$i])";
		echo "<br />"._SOMMUSTBENUM."";
		echo "</div>";
		CloseTable();
		include_once("footer.php");
		return;
	}
	// si 2 catégories ont le même groupmenu (poids) --> die
	for($j=0; $j<=$sommaireformkeysommaire; $j++) {
		if ($i<>$j) {
			if ($sommaireformgroupmenu[$i]==$sommaireformgroupmenu[$j]) {
				include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=sommaire'>Navigation Menu Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
				OpenTable();
				echo"<div align=\"center\">";
				echo ""._SOMCATS."&nbsp;'$sommaireformname[$i]'&nbsp;"._SOMAND."&nbsp;'$sommaireformname[$j]'&nbsp;"._SOMSAMEWEIGHT."&nbsp;($sommaireformgroupmenu[$i])";
				echo "<br />"._SOMMODIFWEIGHT."";
				echo "<br />NB :&nbsp;"._SOMMUSTBENUM."";
				echo "</div>";
				CloseTable();
				include_once("footer.php");
				return;
			}
		}
	}
}
// sinon, on insère les données dans les tables nuke_sommaire et nuke_sommaire_categories.
// d'abord, on va effacer les données de ces 2 tables !
$db->sql_query("DELETE FROM ".$prefix."_sommaire");
$db->sql_query("DELETE FROM ".$prefix."_sommaire_categories");
//détection de nuke v.7 : y a-t-il une gestion des groupes?
global $user_prefix;
$sql="SELECT * FROM ".$prefix."_modules LIMIT 1";
$result=$db->sql_query($sql);
$row=$db->sql_fetchrow($result);
echo Mysql_error();
if(isset($row['mod_group'])){
	$sql2="SELECT * FROM ".$user_prefix."_users LIMIT 1";
	$result2=$db->sql_query($sql2);
	$row2=$db->sql_fetchrow($result2);
	echo Mysql_error();
	$gestiongroupe=(isset($row2['points'])) ? 1 : 0 ;
}
else {
	$gestiongroupe=0;
}
// à chaque ligne du formulaire, on fait une requête pour insérer les données.
for ($i=0; $i<=$sommaireformkeysommaire; $i++) {
	for ($j=0; $j<count($sommaireformingroup[$i]); $j++) {
		$zeclass = ($sommaireformfirstclass != $sommaireformclassformodules) ? $sommaireformclassformodules : $sommaireformmoduleclass[$i][$j] ;
		$zeclass = ($zeclass=="") ? $sommaireformclassformodules : $zeclass ; //si la classe est vide, alors on remplit avec la classe par défaut.
		$zenew_days = ($sommaireformfirstnew_days != $sommaireformnew_days) ? $sommaireformnew_days : $sommaireformmodulenew_days[$i][$j] ;//si on n'a pas changé le nb jours dans l'admin, on recopie les valeurs précédentes.
		$zenew_days = ($zenew_days=="") ? $sommaireformnew_days : $zenew_days ; //si le nb de jour est vide, alors on remplit avec le nb de jours par défaut.
		if ($gestiongroupe==1 && $sommaireformradio==2) {
			$invisible=4;
		}
		elseif ($gestiongroupe==1 && $sommaireformradio==3) {
			$invisible=5;
		}
		else {
			$invisible=$sommaireformradio;
		}
		if ($sommaireformingroup[$i][$j] !="Aucun") {
			if ($sommaireformingroup[$i][$j] =="SOMMAIRE_HR") {
				$sommaireformmodulelink[$i][$j]="";
				$sommaireformmodulelinktext[$i][$j]="";
				$sommaireformmoduleimage[$i][$j]="";
			}
			elseif ($sommaireformingroup[$i][$j] =="SOMMAIRETEXTONLY") {
				$sommaireformmodulelink[$i][$j]="";
			}
			elseif ($sommaireformingroup[$i][$j]=="Lien externe") {//lien externe
			}
			else { //sinon, (si il y a un module) on insère le nom du module, et pas de lien.
				$sommaireformmodulelink[$i][$j]="";
				$sommaireformmodulelinktext[$i][$j]="";
			}
			$sql="INSERT INTO ".$prefix."_sommaire_categories (groupmenu, module, url, url_text, image, new, new_days, class, bold, sublevel, date_debut, date_fin, days) VALUES ('".$sommaireformgroupmenu[$i]."', '".addslashes(stripslashes($sommaireformingroup[$i][$j]))."', '".addslashes(stripslashes($sommaireformmodulelink[$i][$j]))."', '".addslashes(stripslashes($sommaireformmodulelinktext[$i][$j]))."', '".$sommaireformmoduleimage[$i][$j]."', '".$sommaireformmodulenew[$i][$j]."', '".$zenew_days."', '".$zeclass."', '".$sommaireformmodulegras[$i][$j]."','".$sublevel[$i][$j]."','".$sommaire_schedule_date_debut[$i][$j]."', '".$sommaire_schedule_date_fin[$i][$j]."', '".$sommaire_schedule_days[$i][$j]."')";
			$db->sql_query($sql);
			echo (MySql_error());
		}
		// --> si 'Aucun' est sélectionné dans les modules, on n'insère aucune donnée !
	}
	// si la catégorie ne contient aucune donnée (complètement vide), alors on ne l'insère pas dans la DB.
	if ($sommaireformname[$i]=='' && $sommaireformimage[$i]=="noimg" && $sommaireformlien[$i]=='' && $sommaireformhr[$i]=='' && $sommaireformcenter[$i]=='' && $sommaireformbgcolor[$i]=='') {
	}
	else {
		$zeclass = ($sommaireformeachcategoryclass[0]!=$sommaireformclass) ? $sommaireformclass : $sommaireformeachcategoryclass[$i] ;// si la class a été changée via l'admin, on indique cette classe pour toutes les catégories, sinon on recopie le nom de la classe utilisée auparavant.
		$zeclass = ($zeclass=="") ? $sommaireformclass : $zeclass ; //si la classe est vide, alors on remplit avec la classe par défaut.
		$sql="INSERT INTO ".$prefix."_sommaire (groupmenu, name, image, lien, hr, center, bgcolor, invisible, class, bold, new, listbox, dynamic, date_debut, date_fin, days) VALUES ('$sommaireformgroupmenu[$i]', '".addslashes(stripslashes($sommaireformname[$i]))."', '$sommaireformimage[$i]', '".addslashes(stripslashes($sommaireformlien[$i]))."', '$sommaireformhr[$i]', '$sommaireformcenter[$i]', '$sommaireformbgcolor[$i]', '".$invisible."', '$zeclass', '$sommaireformbold[$i]', '$sommaireformnew[$i]', '$sommaireformlistbox[$i]', '$sommaireformdynamic[$i]', '$sommaire_schedule_date_debut_cat[$i]', '$sommaire_schedule_date_fin_cat[$i]', '$sommaire_schedule_days_cat[$i]')";
		$db->sql_query($sql);
		echo (MySql_error());
	} //end for 2
}// end for 1 : toutes les catégories et leur contenu sont rentrées dans la DB
// ensuite, on insère la catégorie 99.
$nom = ($sommaireshowadmin=='on') ? "" : "sommairenoadmindisplay" ;
$sql="INSERT INTO ".$prefix."_sommaire (groupmenu, name, image, lien, hr, center, bgcolor, invisible, class, bold, new, listbox, dynamic, date_debut, date_fin, days) VALUES (99, '".$nom."', NULL, NULL, NULL, NULL, NULL, '".$invisible."', NULL, NULL, NULL, NULL,'".$sommaireformdynamic_general."', 0, 0, NULL)";
$db->sql_query($sql);
//	echo "<br />$sommaireformgroupmenu[99]&nbsp;";
include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=sommaire'>Navigation Menu Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
OpenTable();
echo (MySql_error());
echo "<div align=\"center\">"._SOMSUCCESS."</div>";
echo "<br /><br /><br /><div align=\"center\">[<a href=\"".$admin_file.".php?op=sommaire\">"._SOMBACKADMIN."</a>]</div>";
CloseTable();
include_once("footer.php");
}
function edit() {
	global $keysommaire, $z, $modulename, $lienname, $lienlien, $image, $new_days, $categoryclass, $lienclass, $catname, $catimage, $bgcolor1, $bgcolor3, $bgcolor2, $bgcolor4, $zetheme, $sommaireeditposted, $somcategoryclass, $somlienclass, $somnew_days, $db, $prefix, $urlofimages, $dynamic;
	global $admin_file;
	if (!isset($admin_file)) {$admin_file="admin";}
	if ($sommaireeditposted!="ok") {
		if ($catimage<>"noimg" && !preg_match("/.swf/",$catimage)) {
			if ($z!='imacategory') {
				$catimagesize = getimagesize("".$urlofimages."/$catimage");//là on va récupérer la largeur de l'image de la catégorie, pour aligner les modules avec le titre de la catégorie.
				if ($image<>"middot.gif") {
					$moduleimagesize = getimagesize("".$urlofimages."/categories/$image");
				}
				else {
					$moduleimagesize[0]=5;
				}
				$imagesize =$catimagesize[0]-$moduleimagesize[0];
				if ($imagesize<0) {
					$imagesize=0;
				}
			}
		}
		else {
			$imagesize=0;
			$catimage="admin/noimg.gif";
		}
		$catname = preg_replace("/\[SOMSYMBOLEet\]/","&",$catname);
		$lienname = preg_replace("/\[SOMSYMBOLEet\]/","&",$lienname);
		$catname = preg_replace("/\[SOMSYMBOLEinterro\]/","?",$catname);
		$lienname = preg_replace("/\[SOMSYMBOLEinterro\]/","?",$lienname);
		include_once("themes/$zetheme/theme.php");
		echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
		<html><head><title>"._SOMEDITLINKTITLE."</title>
		<LINK REL=\"StyleSheet\" HREF=\"themes/$zetheme/style/style.css\" TYPE=\"text/css\"></head>
		<body>
		<form action=\"".$admin_file.".php?op=sommaire&amp;go=edit\" method=\"post\">
		<input type=\"hidden\" name=\"sommaireeditposted\" value=\"ok\">
		<table cellspacing=2 cellpadding=3 align=\"center\">
		<tr class=\"title\"><td colspan=3 align=\"center\" bgcolor=\"$bgcolor2\" >"._SOMMOREOPTIONS."</td></tr>
		<tr height=6><td></td></tr><tr>
		<td align=\"left\" bgcolor=\"$bgcolor3\"><img src=\"".$urlofimages."/$catimage\">&nbsp;$catname</td>
		<td align=\"left\" bgcolor=\"$bgcolor3\">"._SOMCLASS." : <input type=\"text\" name=\"somcategoryclass\" value=\"$categoryclass\" size=10>
		<input type=\"hidden\" name=\"z\" value=\"$z\"><input type=\"hidden\" name=\"keysommaire\" value=\"$keysommaire\">
		</td>";
		$dynvalue = ($dynamic=='on') ? "" : "checked";
		echo "<td><input type=\"checkbox\" name=\"alwaysopen\" id=\"alwaysopen\" $dynvalue><LABEL for=\"alwaysopen\">"._SOMNOTDYNAMICCAT."</LABEL></td>
		</tr><tr height=3><td></td></tr>";
		if ($z!="imacategory") {
			echo "<tr bgcolor=\"$bgcolor1\">";
			$displayimage= ($image=="middot.gif") ? "<strong>&middot;</strong>" : "<img src=\"".$urlofimages."/categories/$image\">";
			if ($modulename=="Lien externe" || $modulename=="SOMMAIRETEXTONLY") {
				echo "<td bgcolor=\"$bgcolor1\"><img src=\"".$urlofimages."/admin/none.gif\" width=\"$imagesize\" height=\"1\">".$displayimage."&nbsp;$lienname</td>";
			}
			elseif ($modulename=="SOMMAIRE_HR") {
				echo "<td bgcolor=\"$bgcolor1\"><img src=\"".$urlofimages."/admin/none.gif\" width=\"$imagesize\" height=\"1\"><hr></td>";
			}
			else {
				echo "<td bgcolor=\"$bgcolor1\"><img src=\"".$urlofimages."/admin/none.gif\" width=\"$imagesize\" height=\"1\">".$displayimage."&nbsp;$modulename</td>";
			}
			$disabled=($modulename=="SOMMAIRE_HR") ? "disabled" : "" ;
			echo "<td bgcolor=\"$bgcolor1\">"._SOMCLASS." : <input type=\"text\" name=\"somlienclass\" value=\"$lienclass\" size=10></td>
		<td>"._SOMSINCE." <input type=\"text\" name=\"somnew_days\" value=\"$new_days\" $disabled size=2> "._SOMNBDAYS."
		";
			echo "</td></tr>";
		}
		echo "<tr><td height=10></td></tr><tr><td align=\"center\" colspan=3><input type=\"submit\"></td></tr><tr><td height=15></td></tr>
		<tr><td colspan=3>"._SOMATTENTIONMOREOPTIONS."</td></tr></table></form>
		</body>
		</html>";
	}
	else{
		$dynamic = ($_POST['alwaysopen']=='on') ? '' : 'on' ;
	?>
	<script type="text/javascript" language="Javascript">
	<?php if ($z!="imacategory") { ?>
	opener.document.forms.form_sommaire.elements["sommaireformmoduleclass[<?php echo $keysommaire;?>][<?php echo $z;?>]"].value="<?php echo $somlienclass;?>";
	opener.document.forms.form_sommaire.elements["sommaireformmodulenew_days[<?php echo $keysommaire;?>][<?php echo $z;?>]"].value="<?php echo $somnew_days;?>";
	<?php } ?>
	opener.document.forms.form_sommaire.elements["sommaireformeachcategoryclass[<?php echo $keysommaire;?>]"].value="<?php echo $somcategoryclass;?>";
	opener.document.forms.form_sommaire.elements["sommaireformdynamic[<?php echo $keysommaire;?>]"].value="<?php echo $dynamic;?>";
	</script>
	<?php
	echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
		<html><head><title>"._SOMEDITLINKTITLE."</title>
		<LINK REL=\"StyleSheet\" HREF=\"themes/$zetheme/style/style.css\" TYPE=\"text/css\"></head>
		<body>";
	//echo "key:$keysommaire - z:$z - $somlienclass - $somnew_days - $somlienid - $somcategoryclass<br />";
	echo "<br /><br /><div align=\"center\"><span  class=\"title\">"._SOMMOREOPTIONSUCCESS."</span><br />"._SOMSENDTOVALIDATE."<br /><br /><br /><br /><br /><br /><div align=\"center\" class=\"title\">[<a href=\"javascript:window.close()\">"._SOMCLOSE."</a>]</div>";
	echo"</body></html>";
	}
}
function sommaire_schedule() {
	global $keysommaire, $z, $modulename, $lienname, $lienlien, $image, $new_days, $categoryclass, $lienclass, $catname, $catimage, $bgcolor1, $bgcolor3, $bgcolor2, $bgcolor4, $zetheme, $sommaireeditposted, $somcategoryclass, $somlienclass, $somnew_days, $db, $prefix, $urlofimages;
	global $admin_file;
	if (!isset($admin_file)) {$admin_file="admin";}
	if ($_POST['sommaire_schedule_post']!='ok') {
		if ($_GET['z']=='imacategory') {
			$zeimage=($_GET['catimage']=='noimg') ? "admin/".$_GET['catimage'].".gif" : $_GET['catimage'];
			$zelien=$_GET['catname'];
		}
		else {
			$zeimage=($_GET['image']=='middot.gif') ? "admin/".$_GET['image'] : "categories/".$_GET['image'];
			$zelien=$_GET['modulename'];
		}
		include_once("themes/$zetheme/theme.php");
		echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
		<html><head><title>"._SOMSCHEDULETITLE."...</title>
		<LINK REL=\"StyleSheet\" HREF=\"themes/$zetheme/style/style.css\" TYPE=\"text/css\">";
		?>
		<script type="text/javascript" language="javascript">
		function display_schedule(zeinput) {
			if(zeinput.checked==true) {
				document.getElementById('hide').checked=false;
				document.getElementById('schedule_table').style.display='block';
			}
			else {
				document.getElementById('schedule_table').style.display='none';
			}
		}
		</script>
		<?php
		echo "
		</head>
		<body>";
		echo "<form name=\"schedule_sommaire\" action=\"".$admin_file.".php?op=sommaire&amp;go=schedule\" method=\"POST\">
				<input type=\"hidden\" name=\"sommaire_schedule_post\" value=\"ok\">
				<input type=\"hidden\" name=\"keysommaire\" value=\"".$_GET['keysommaire']."\">
				<input type=\"hidden\" name=\"z\" value=\"".$_GET['z']."\">";
		echo "
			<table width=\"100%\" align=\"center\">
				<tr><td colspan=3 class=\"title\" style=\"background-color: ".$bgcolor2.";text-align: center;\">"._SOMSCHEDULETITLE."</td></tr>
				<tr><td height=8></td></tr>
				<tr><td>
					<table cellpadding=4 cellspacing=0 style=\"border: 1px solid black\">";
		//echo "
		//				<tr><td style=\"background-color: ".$bgcolor3.";\"><img src=\"".$urlofimages."/".$zecatimage."\"></td>
		//					<td style=\"background-color: ".$bgcolor3.";\">".$_GET['catname']."</td>
		//				</tr>";
		echo "
						<tr><td style=\"background-color: ".$bgcolor1.";\"><img src=\"".$urlofimages."/".$zeimage."\"></td>
						<td style=\"background-color: ".$bgcolor1.";\">".$zelien."</td>
						</tr>
					</table>";
		$option_annee_debut=$option_annee_fin=$option_jour_debut=$option_jour_fin=$option_mois_debut=$option_mois_fin="";
		$option_heure_debut=$option_heure_fin=$option_ms_debut=$option_ms_fin="";
		for ($i=1;$i<32;$i++) {
			$zeoption=($i<10) ? "0".$i : $i;
			$selected_debut=(($_GET['date_debut']==0 && $zeoption==date("d")) || date("d",$_GET['date_debut'])==$zeoption ) ? " selected" : "";
			$selected_fin=(($_GET['date_fin']==0 && $zeoption==date("d")) || date("d",$_GET['date_fin'])==$zeoption ) ? " selected" : "";
			$option_jour_debut.="<option value=\"".$zeoption."\"".$selected_debut.">".$zeoption."</option>";
			$option_jour_fin.="<option value=\"".$zeoption."\"".$selected_fin.">".$zeoption."</option>";
		}
		for ($i=1;$i<13;$i++) {
			$zeoption=($i<10) ? "0".$i : $i;
			$selected_debut=(($_GET['date_debut']==0 && $zeoption==date("m")) || date("m",$_GET['date_debut'])==$zeoption ) ? " selected" : "";
			$selected_fin=(($_GET['date_fin']==0 && $zeoption==date("m")) || date("m",$_GET['date_fin'])==$zeoption ) ? " selected" : "";
			$option_mois_debut.="<option value=\"".$zeoption."\"".$selected_debut.">".$zeoption."</option>";
			$option_mois_fin.="<option value=\"".$zeoption."\"".$selected_fin.">".$zeoption."</option>";
		}
		$date_mini=($_GET['date_debut']!=0 && date("Y",$_GET['date_debut'])<date("Y")) ? date("Y",$_GET['date_debut']) : date("Y") ;
		$date_max=(date("Y",$_GET['date_fin'])>$date_mini+10) ? date("Y",$_GET['date_fin'])+10 : $date_mini+10 ;
		for ($i=$date_mini;$i<$date_max+1;$i++) {
			$selected_debut=(($_GET['date_debut']==0 && $i==date("Y")) || date("Y",$_GET['date_debut'])==$i ) ? " selected" : "";
			$selected_fin=(($_GET['date_fin']==0 && $i==date("Y")) || date("Y",$_GET['date_fin'])==$i ) ? " selected" : "";
			$option_annee_debut.="<option value=\"".$i."\"".$selected_debut.">".$i."</option>";
			$option_annee_fin.="<option value=\"".$i."\"".$selected_fin.">".$i."</option>";
		}
		for ($i=0;$i<24;$i++) {
			$zeoption=($i<10) ? "0".$i : $i;
			$selected_debut=(($_GET['date_debut']==0 && $zeoption==date("H")) || date("H",$_GET['date_debut'])==$zeoption ) ? " selected" : "";
			$selected_fin=(($_GET['date_fin']==0 && $zeoption==date("H")) || date("H",$_GET['date_fin'])==$zeoption ) ? " selected" : "";
			$option_heure_debut.="<option value=\"".$zeoption."\"".$selected_debut.">".$zeoption."</option>";
			$option_heure_fin.="<option value=\"".$zeoption."\"".$selected_fin.">".$zeoption."</option>";
		}
		for ($i=0;$i<60;$i++) {
			$zeoption=($i<10) ? "0".$i : $i;
			$selected_debut=(($_GET['date_debut']==0 && $zeoption==date("i")) || date("i",$_GET['date_debut'])==$zeoption ) ? " selected" : "";
			$selected_fin=(($_GET['date_fin']==0 && $zeoption==date("i")) || date("i",$_GET['date_fin'])==$zeoption ) ? " selected" : "";
			$option_ms_debut.="<option value=\"".$zeoption."\"".$selected_debut.">".$zeoption."</option>";
			$option_ms_fin.="<option value=\"".$zeoption."\"".$selected_fin.">".$zeoption."</option>";
		}
		$hidecheck=(strpos($_GET['days'],'8')!==false) ? "checked " : ""; // le !== (2=) est nécessaire
		$schedulecheck=($_GET['date_debut']!=0 && $_GET['date_fin']!=0) ? "checked " : "";
		$scheduledisplay=($_GET['date_debut']!=0 && $_GET['date_fin']!=0) ? 'block' : 'none';
		$monday_check=(strpos($_GET['days'],'1')!==false) ? "checked " : ""; // le !== (2=) est nécessaire
		$tuesday_check=(strpos($_GET['days'],'2')!==false) ? "checked " : ""; // le !== (2=) est nécessaire
		$wednesday_check=(strpos($_GET['days'],'3')!==false) ? "checked " : ""; // le !== (2=) est nécessaire
		$thursday_check=(strpos($_GET['days'],'4')!==false) ? "checked " : ""; // le !== (2=) est nécessaire
		$friday_check=(strpos($_GET['days'],'5')!==false) ? "checked " : ""; // le !== (2=) est nécessaire
		$saturday_check=(strpos($_GET['days'],'6')!==false) ? "checked " : ""; // le !== (2=) est nécessaire
		$sunday_check=(strpos($_GET['days'],'7')!==false) ? "checked " : ""; // le !== (2=) est nécessaire
		echo "</td>
		<td><input type=\"checkbox\" ".$hidecheck."name=\"sommaire_schedule_hide\" id=\"hide\" OnClick=\"if(this.checked==true) {document.getElementById('schedule').checked=false;document.getElementById('schedule_table').style.display='none'}\"><LABEL for=\"hide\">"._SOMHIDE."</LABEL>
			<br />
			<input type=\"checkbox\" ".$schedulecheck."name=\"sommaire_schedule_schedule\" id=\"schedule\" OnClick=\"display_schedule(this);\"><LABEL for=\"schedule\">"._SOMSCHEDULEIT."</LABEL></td>
		<td style=\"border-left: 1px solid black;padding-left: 5px;\">
			<table style=\"text-align: center; display: ".$scheduledisplay.";\" id=\"schedule_table\">
				<tr><td>"._SOMDISPLAYFROM."</td></tr>
				<tr><td><select name=\"sommaire_schedule_jour_debut\">".$option_jour_debut."</select>
				&nbsp;/&nbsp;<select name=\"sommaire_schedule_mois_debut\">".$option_mois_debut."</select>
				&nbsp;/&nbsp;<select name=\"sommaire_schedule_an_debut\">".$option_annee_debut."</select>
				&nbsp;&nbsp;<select name=\"sommaire_schedule_heure_debut\">".$option_heure_debut."</select>
				&nbsp;:&nbsp;<select name=\"sommaire_schedule_minute_debut\">".$option_ms_debut."</select>
				</td></tr>
				<tr><td>"._SOMDISPLAYTO."</td></tr>
				<tr>
				<td><select name=\"sommaire_schedule_jour_fin\">".$option_jour_fin."</select>
				&nbsp;/&nbsp;<select name=\"sommaire_schedule_mois_fin\">".$option_mois_fin."</select>
				&nbsp;/&nbsp;<select name=\"sommaire_schedule_an_fin\">".$option_annee_fin."</select>
				&nbsp;&nbsp;<select name=\"sommaire_schedule_heure_fin\">".$option_heure_fin."</select>
				&nbsp;:&nbsp;<select name=\"sommaire_schedule_minute_fin\">".$option_ms_fin."</select>
				</td></tr>
				<tr><td style=\"padding-top: 5px;\">"._SOMDISPLAYONLYTHESEDAYS."</td></tr>
				<tr><td>
				<table><tr>
				<td><input type=\"checkbox\" name=\"sommaire_schedule_monday\" id=\"sommaire_schedule_monday\"".$monday_check."><LABEL for=\"sommaire_schedule_monday\">"._SOMMONDAY."</LABEL></td>
				<td><input type=\"checkbox\" name=\"sommaire_schedule_tuesday\" id=\"sommaire_schedule_tuesday\"".$tuesday_check."><LABEL for=\"sommaire_schedule_tuesday\">"._SOMTUESDAY."</LABEL></td>
				<td><input type=\"checkbox\" name=\"sommaire_schedule_wednesday\" id=\"sommaire_schedule_wednesday\"".$wednesday_check."><LABEL for=\"sommaire_schedule_wednesday\">"._SOMWEDNESDAY."</LABEL></td>
				<td><input type=\"checkbox\" name=\"sommaire_schedule_thursday\" id=\"sommaire_schedule_thursday\"".$thursday_check."><LABEL for=\"sommaire_schedule_thursday\">"._SOMTHURSDAY."</LABEL></td></tr><tr>
				<td><input type=\"checkbox\" name=\"sommaire_schedule_friday\" id=\"sommaire_schedule_friday\"".$friday_check."><LABEL for=\"sommaire_schedule_friday\">"._SOMFRIDAY."</LABEL></td>
				<td><input type=\"checkbox\" name=\"sommaire_schedule_saturday\" id=\"sommaire_schedule_saturday\"".$saturday_check."><LABEL for=\"sommaire_schedule_saturday\">"._SOMSATURDAY."</LABEL></td>
				<td><input type=\"checkbox\" name=\"sommaire_schedule_sunday\" id=\"sommaire_schedule_sunday\"".$sunday_check."><LABEL for=\"sommaire_schedule_sunday\">"._SOMSUNDAY."</LABEL></td></tr>
</table></tr></td>
			</table>
		</td></tr>
	</table>";
		echo "<table border=0 align=\"center\" style=\"margin-top: 10px;\"><tr><td align=\"center\" colspan=2><input type=\"submit\" value=\""._SOMPOST."\"></td></tr></table>";
		echo "</form>";
		echo"</body></html>";
	}
	else {
		//envoyer les données dans le formulaire principal.
		$keysommaire=$_POST['keysommaire'];
		$z=$_POST['z'];
		$days="";
		if ($_POST['sommaire_schedule_monday']=='on') {
			$days.='1';
		}
		if ($_POST['sommaire_schedule_tuesday']=='on') {
			$days.='2';
		}
		if ($_POST['sommaire_schedule_wednesday']=='on') {
			$days.='3';
		}
		if ($_POST['sommaire_schedule_thursday']=='on') {
			$days.='4';
		}
		if ($_POST['sommaire_schedule_friday']=='on') {
			$days.='5';
		}
		if ($_POST['sommaire_schedule_saturday']=='on') {
			$days.='6';
		}
		if ($_POST['sommaire_schedule_sunday']=='on') {
			$days.='7';
		}
		if ($_POST['sommaire_schedule_hide']=='on') {
			$days.='8';
		}
		$hd=$_POST['sommaire_schedule_heure_debut'];
		$hf=$_POST['sommaire_schedule_heure_fin'];
		$mid=$_POST['sommaire_schedule_minute_debut'];
		$mif=$_POST['sommaire_schedule_minute_fin'];
		$mod=$_POST['sommaire_schedule_mois_debut'];
		$mof=$_POST['sommaire_schedule_mois_fin'];
		$jd=$_POST['sommaire_schedule_jour_debut'];
		$jf=$_POST['sommaire_schedule_jour_fin'];
		$ad=$_POST['sommaire_schedule_an_debut'];
		$af=$_POST['sommaire_schedule_an_fin'];
		//echo "$hd $mid $mod $jd $ad <br />";
		if ($_POST['sommaire_schedule_schedule']=='on') {
			$date_debut=mktime($hd, $mid, '00', $mod, $jd, $ad);
			$date_fin=mktime($hf, $mif, '00', $mof, $jf, $af);
		}
		else {
			$date_debut="";
			$date_fin="";
		}
		if ($z!="imacategory") {
			$elmt_days="sommaire_schedule_days[".$keysommaire."][".$z."]";
			$elmt_date_debut="sommaire_schedule_date_debut[".$keysommaire."][".$z."]";
			$elmt_date_fin="sommaire_schedule_date_fin[".$keysommaire."][".$z."]";
		}
		else {
			$elmt_days="sommaire_schedule_days_cat[".$keysommaire."]";
			$elmt_date_debut="sommaire_schedule_date_debut_cat[".$keysommaire."]";
			$elmt_date_fin="sommaire_schedule_date_fin_cat[".$keysommaire."]";
		}
		sommaire_js_code();
		?>
		<script language="Javascript" type="text/javascript">
		opener.document.forms.form_sommaire.elements["<?php echo $elmt_days;?>"].value="<?php echo $days;?>";
		opener.document.forms.form_sommaire.elements["<?php echo $elmt_date_debut;?>"].value="<?php echo $date_debut;?>";
		opener.document.forms.form_sommaire.elements["<?php echo $elmt_date_fin;?>"].value="<?php echo $date_fin;?>";
		</script>
		<?php
			$now=time();
			$sens=(strpos($days,'8')!==false || $now<$date_debut || ($date_fin>0 && $now>$date_fin)) ? 'hide' :'show' ;
		if ($z=='imacategory') {
			echo "<script type=\"text/javascript\" language=\"javascript\">sommaire_hidecategory('".$keysommaire."','".$sens."',opener.document);</script>";	
		}
		else {
			echo "<script type=\"text/javascript\" language=\"javascript\">sommaire_hidelink($keysommaire,$z,'".$sens."',opener.document);</script>";
		}
		echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
			<html><head><title>".__SOMSCHEDULETITLE."</title>
			<LINK REL=\"StyleSheet\" HREF=\"themes/$zetheme/style/style.css\" TYPE=\"text/css\"></head>
			<body>";
		//echo "key:$keysommaire - z:$z - $somlienclass - $somnew_days - $somlienid - $somcategoryclass<br />";
		echo "<br /><br /><div align=\"center\"><span  class=\"title\">"._SOMMOREOPTIONSUCCESS."</span><br />"._SOMSENDTOVALIDATE."<br /><br /><br /><br /><br /><br /><div align=\"center\" class=\"title\">[<a href=\"javascript:window.close()\">"._SOMCLOSE."</a>]</div>";
		echo"</body></html>";
	}
}
//
//
function deletecat() {//pour supprimer une catégorie (fonction appelée par le clic sur "supprimer" dans une ligne du formulaire)
	global $admin_file;
	if (!isset($admin_file)) {$admin_file="admin";}
	global $deletecat, $keysommaire, $confirm, $catname, $db, $prefix;
	if ($confirm<>"YES") {
		include_once ("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=sommaire'>Navigation Menu Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
		echo"<br />";
		OpenTable();
		$catname=htmlspecialchars($catname);
		echo"<div align=\"center\">"._SOMWARNINGDELETECAT." <i>$catname</i> ?<br /><br />";
		echo"[ <a href=\"".$admin_file.".php?op=sommaire\">"._SOMNO."</a> | <a href=\"".$admin_file.".php?op=sommaire&amp;go=deletecat&amp;deletecat=$deletecat&amp;confirm=YES\">"._SOMYES."</a> ]"
		."</div>";
		CloseTable();
		include_once("footer.php");
	}
	else {
		$confirm="NO";
		$db->sql_query("DELETE FROM ".$prefix."_sommaire WHERE groupmenu='$deletecat'");
		$db->sql_query("DELETE FROM ".$prefix."_sommaire_categories WHERE groupmenu='$deletecat'");
		echo (MySql_error());
		index();
	}
}
switch($go) {
	default:
	index();
	break;
	case "send":
	send();
	break;
	case "deletecat":
	deletecat();
	break;
	case "edit":
	edit();
	break;
	case "schedule":
	sommaire_schedule();
	break;
}
?>

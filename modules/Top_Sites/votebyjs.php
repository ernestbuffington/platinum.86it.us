	<SCRIPT LANGUAGE="JavaScript">
    // Script créé par et pour Tout JavaScript.com http://www.toutjavascript.com
     // Utilisation gratuite à condition de laisser les commentaires d'origine
    // CreerCurseur(nom,min,max,pas,largeur,hauteur,gifon,gifoff,gifmoins,gifplus,delai)
    var note=new CreerCurseur("note",0,10,1,10,18,"modules/Top_Sites/images/votejs/curson.gif","modules/Top_Sites/images/votejs/cursoff.gif","modules/Top_Sites/images/votejs/moins.gif","modules/Top_Sites/images/votejs/plus.gif",200);
	
    function CreerCurseur(nom,min,max,pas,largeur,hauteur,gifon,gifoff,gifmoins,gifplus,delai) {
	this.nom=nom; this.valeur=Math.round((max-min)/2+2); this.action=0; this.delai=delai;
	this.min=min; this.max=max; this.pas=pas;
	this.largeur=largeur; this.hauteur=hauteur;
	this.gifon=gifon; this.gifoff=gifoff; this.gifmoins=gifmoins; this.gifplus=gifplus;
    this.Plus=PlusCurseur; this.Moins=MoinsCurseur; this.Affecte=AffecteCurseur;
	this.Affiche=AffCurseur;
	this.Update=UpdateCurseur;
}

       // Cette fonction est appelée par le bouton OK pour valider la note
       function NoteScript() {
		document.forms["notation"].elements["rating"].value=note.valeur;
		// faire le submit si vous voulez envoyer la note au serveur
		document.forms["notation"].submit();
       }

      function AffCurseur() {
	 var Z="<A  onmouseover='javascript:eval(\""+this.nom+".action=-1\");eval(\""+this.nom+".Moins()\")' onmouseout='javascript:eval(\""+this.nom+".action=0\")'><IMG src='"+this.gifmoins+"' border=0 height="+this.hauteur+" alt='MOINS  !'></A>&nbsp;";
	 for (var i=this.min;i<this.max;i++) {
      if (i<this.valeur) {gif=this.gifon;} else {gif=this.gifoff;}
	  Z+="<A  onmouseover='javascript:eval(\""+this.nom+".Affecte("+((i+1)*this.pas)+")\")'>"; 
	  Z+="<IMG name="+this.nom+i+" src='"+gif+"' width="+this.largeur+" height="+this.hauteur+" border=0 alt='"+this.nom+" : "+(this.pas*(i+1))+"'>";
	  Z+="</A>";
	}
	Z+="&nbsp;<A  onmouseover='javascript:eval(\""+this.nom+".action=1\");eval(\""+this.nom+".Plus()\")' onmouseout='javascript:eval(\""+this.nom+".action=0\")'><IMG src='"+this.gifplus+"' border=0 height="+this.hauteur+" alt='PLUS !'></A>";
	document.write(Z);
    }
    function PlusCurseur() {
	this.valeur+=this.pas;
	if (this.valeur>this.max) {this.valeur=this.max}
	this.Update();
	if (this.action==1) {setTimeout(this.nom+".Plus()",this.delai);}
    }
    function MoinsCurseur() {
	this.valeur-=this.pas;
	if (this.valeur<this.min) {this.valeur=this.min}
	this.Update();
	if (this.action==-1) {setTimeout(this.nom+".Moins()",this.delai);}
    }
    function AffecteCurseur(val) {
	this.valeur=val;
	this.Update();
    }
    function UpdateCurseur() {
	for (var i=this.min;i<this.max;i++) {
      if (i<this.valeur) {gif=this.gifon;} else {gif=this.gifoff;}
	  document.images[this.nom+i+""].src=gif;
	}
	Update("imgnote",this.valeur,this.max);
    }
    function Update(img,val,max) {
	if (val<=max) {src='modules/Top_Sites/images/votejs/note4.gif'}
	if (val<Math.floor(max*0.8)) {src='modules/Top_Sites/images/votejs/note3.gif'}
	if (val<Math.floor(max*0.6)) {src='modules/Top_Sites/images/votejs/note2.gif'}
	if (val<Math.floor(max*0.3)) {src='modules/Top_Sites/images/votejs/note1.gif'}
	document.images[img].src=src;
    }

    function load() {
	if (document.images) {
		this.length=load.arguments.length;
		for (var i=0;i<this.length;i++) {
			this[i+1]=new Image();
			this[i+1].src=load.arguments[i];
		}
	}
}
    function preload() {
	var temp=new load("modules/Top_Sites/images/votejs/note1.gif","modules/Top_Sites/images/votejs/note2.gif","modules/Top_Sites/images/votejs/note3.gif","modules/Top_Sites/images/votejs/note4.gif","modules/Top_Sites/images/votejs/btnokon.gif");
  }
</SCRIPT>
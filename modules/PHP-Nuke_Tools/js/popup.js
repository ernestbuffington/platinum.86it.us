<SCRIPT>
var look=''
function generate_look(){
var tempform=document.winlook
look='width=400,height=338,'
for (i=0;i<tempform.looks.length;i++){
if (tempform.looks[i].checked)
look=look+tempform.looks[i].value+","
}
}

function previewit(){
generate_look()
window.open("http://www.disipal.net/modules/PHP-Nuke_Tools/images/disipal.htm","",look)
}

function generateit(){
generate_look()
var sourcetext=''
var sourcetext='<script>\n\n\//Popup Creator\n//By Disipal Site (http://www.disipal.net)\n//PHP-Nuke Tools\n\n'
sourcetext+='function openpopup(){\nvar popurl="disipal.htm"\nwinpops=window.open(popurl,"","'
sourcetext+=look+'")\n}\n\n'

if (document.winsession.winsession1.selectedIndex==0){ //if "Automatic" selected

}

sourcetext+='<\/script>\n\n'

if (document.winsession.winsession1.selectedIndex==1) //if "Text link" selected
sourcetext+='<a href="javascript:openpopup()">Click here to open window<\/a>'

document.source.source2.value=sourcetext

}


</SCRIPT>
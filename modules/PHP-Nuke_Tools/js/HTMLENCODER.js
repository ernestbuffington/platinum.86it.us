
<SCRIPT language=javascript><!--
function encode(code){
if(document.form1.text1.value.length>0){
new_text = KeyCode(code);
document.form1.encoded_txt.value = new_text;
}else alert('There is nothing to be encoded at this time!')}
function KeyCode(mystring){
newstring = '';
for (i=0; i<mystring.length; i++){
if ((mystring.charCodeAt(i) == 13) && (mystring.charCodeAt(i + 1) == 10)){if(document.form1.mgsbrd.checked ==false)newstring = newstring +"<br>";}
else if (mystring.charCodeAt(i) == 9){newstring = newstring +"&#9;";}
else if (mystring.charCodeAt(i) == 34){newstring = newstring +"&quot;";}
else if (mystring.charCodeAt(i) == 37){newstring = newstring +"&#37;";}
else if (mystring.charCodeAt(i) == 38){newstring = newstring +"&amp;";}
else if (mystring.charCodeAt(i) == 39){newstring = newstring +"&#39;";}
else if (mystring.charCodeAt(i) == 47){newstring = newstring +"&#47;";}
else if (mystring.charCodeAt(i) == 58){newstring = newstring +"&#58;";}
else if (mystring.charCodeAt(i) == 59){newstring = newstring +"&#59;";}
else if (mystring.charCodeAt(i) == 60){newstring = newstring +"&lt;";}
else if (mystring.charCodeAt(i) == 62){newstring = newstring +"&gt;";}
else if (mystring.charCodeAt(i) == 64){newstring = newstring +"&#64;";}
else {newstring = newstring + mystring.charAt(i)}
}return newstring;}
function selectCode(pad){if(pad.value.length>0){pad.focus();pad.select();}else alert('There is nothing to be selected at this time!')}
function Cleartxt(pad){pad.value='';pad.focus();}
function preview(){
if(document.form1.encoded_txt.value.length>0){
pr=window.open("","Preview","scrollbars=1,menubar=1,status=1,width=700,height=320,left=50,top=110");
pr.document.write("<html><title>Preview</title><body>\n\n" + document.form1.encoded_txt.value + "\n\n</body></html>");
pr.document.close();
}else alert('There is nothing to be previewed at this time!')}
//--></SCRIPT>

<SCRIPT language=JavaScript><!--
function rot13(text){
var rotText='';
var alphabet='abcdefghijklmnopqrstuvwxyzabcdefghijklmABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLM';
var char1 = '';
var index1 = 0;
var i = 0;
for (i = 0; i <= text.length-1; i++){
char1 = text.substring(i, i+1);
index1 = alphabet.indexOf(char1, 0);
if(index1 != -1){rotText += alphabet.substring(index1+13, index1+14);}
else{rotText += char1;}
}
return rotText;
}
//--></SCRIPT>

<SCRIPT>

function htmlphp(){
	var input = document.htphp.input.value;
	output = "	STRING \"";
	for (var c = 0; c < input.length; c++){
		if ((input.charAt(c) == "\n" || input.charAt(c) == "\r")){
			output += "\"";
			if (c != input.length - 1) output +="\n  	STRING \"";
			c++;
			}
		else {
			if (input.charAt(c) == "\"") {
				output += "\\\"";
				}
			else {
				if (input.charAt(c) == "\\"){
					output += "\\\\";
					}
				else {
					output += input.charAt(c);
					if (c == input.length -1) output += "\"";	
					}
				}
			}
		
		}

info="\n" + 
"%Generated %by %HTML %to %SWS %Generator %By %Disipal %Site %(www.disipal.net) \n" +

"\n\n"




info2="\n \	STRING \"\"\n" +

"\n";

	document.htphp.output.value =info+output+info2;
}

</SCRIPT>
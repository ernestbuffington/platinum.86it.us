<SCRIPT language=JavaScript>

<!-- Hide code from older browsers

function encodeEmail() {

var regEmail = document.ENCODER.regEmail.value.toLowerCase()
var codeEmail = ""

if (regEmail == "") {
        alert("Please enter your regular e-mail address.")
}
else {
        var regLength = regEmail.length
        for (i = 0; i < regLength; i++) {
                var charNum = "000"
                var curChar = regEmail.charAt(i)
                if (curChar == "a") {
                        charNum = "097"
                }
                if (curChar == "b") {
                        charNum = "098"
                }
                if (curChar == "c") {
                        charNum = "099"
                }
                if (curChar == "d") {
                        charNum = "100"
                }
                if (curChar == "e") {
                        charNum = "101"
                }
                if (curChar == "f") {
                        charNum = "102"
                }
                if (curChar == "g") {
                        charNum = "103"
                }
                if (curChar == "h") {
                        charNum = "104"
                }
                if (curChar == "i") {
                        charNum = "105"
                }
                if (curChar == "j") {
                        charNum = "106"
                }
                if (curChar == "k") {
                        charNum = "107"
                }
                if (curChar == "l") {
                        charNum = "108"
                }
                if (curChar == "m") {
                        charNum = "109"
                }
                if (curChar == "n") {
                        charNum = "110"
                }
                if (curChar == "o") {
                        charNum = "111"
                }
                if (curChar == "p") {
                        charNum = "112"
                }
                if (curChar == "q") {
                        charNum = "113"
                }
                if (curChar == "r") {
                        charNum = "114"
                }
                if (curChar == "s") {
                        charNum = "115"
                }
                if (curChar == "t") {
                        charNum = "116"
                }
                if (curChar == "u") {
                        charNum = "117"
                }
                if (curChar == "v") {
                        charNum = "118"
                }
                if (curChar == "w") {
                        charNum = "119"
                }
                if (curChar == "x") {
                        charNum = "120"
                }
                if (curChar == "y") {
                        charNum = "121"
                }
                if (curChar == "z") {
                        charNum = "122"
                }
                if (curChar == "0") {
                        charNum = "048"
                }
                if (curChar == "1") {
                        charNum = "049"
                }
                if (curChar == "2") {
                        charNum = "050"
                }
                if (curChar == "3") {
                        charNum = "051"
                }
                if (curChar == "4") {
                        charNum = "052"
                }
                if (curChar == "5") {
                        charNum = "053"
                }
                if (curChar == "6") {
                        charNum = "054"
                }
                if (curChar == "7") {
                        charNum = "055"
                }
                if (curChar == "8") {
                        charNum = "056"
                }
                if (curChar == "9") {
                        charNum = "057"
                }
                if (curChar == "&") {
                        charNum = "038"
                }
                if (curChar == " ") {
                        charNum = "032"
                }
                if (curChar == "_") {
                        charNum = "095"
                }
                if (curChar == "-") {
                        charNum = "045"
                }
                if (curChar == "@") {
                        charNum = "064"
                }
                if (curChar == ".") {
                        charNum = "046"
                }
                if (charNum == "000") {
                        codeEmail += curChar
                }
                else {
                        codeEmail += "&#" + charNum + ";"               
                }
        }
        document.ENCODER.codeEmail.value = codeEmail
}

}

// End hiding-->

</SCRIPT>
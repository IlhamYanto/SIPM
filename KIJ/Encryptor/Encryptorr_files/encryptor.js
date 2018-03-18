
"use strict";
function doCrypt(isDecrypt) {
	var shiftText = document.getElementById("shift").value;
	if (!/^-?\d+$/.test(shiftText)) {
		alert("Shift is not an integer");
		return;
	}
	var shift = parseInt(shiftText, 10);
	if (shift < 0 || shift >= 26) {
		alert("Shift is out of range");
		return;
	}
	if (isDecrypt)
		shift = (26 - shift) % 26;
	var textElem = document.getElementById("text");
	textElem.value = caesarShift(textElem.value, shift);
}

function caesarShift(text, shift) {
	var result = "";
	for (var i = 0; i < text.length; i++) {
		var c = text.charCodeAt(i);
		if      (65 <= c && c <=  90) result += String.fromCharCode((c - 65 + shift) % 26 + 65);  // Uppercase
		else if (97 <= c && c <= 122) result += String.fromCharCode((c - 97 + shift) % 26 + 97);  // Lowercase
		else                          result += text.charAt(i);  // Copy
	}
	return result;
}
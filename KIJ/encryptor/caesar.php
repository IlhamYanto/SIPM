<!DOCTYPE html>
<html>
<style type="text/css">
	body{
		background-color: #009999;
		margin: auto;
	    width: 50%;
	}
	#shift{
		margin: auto;
	    width: 50%;
	    padding: 10px;
	}
	#enkrip{
		float: left;
	}
	#dekrip{
		float: right;
	}
</style>
<head>
	<title>Caesar Encryptor</title>
</head>
<body>
	<div align="center"><h2><b>Caesar Cipher</b></h2></div>
	<form action="#" method="get" onsubmit="return false;">
	<table class="noborder">
		<tbody>
			<tr>
				<td><label for="plain">Text:</label></td>
				<td><textarea id="plain" cols="50" rows="10" style="width:40em; height:15em">Belajar Teknik-Teknik Enkripsi</textarea></td>
			</tr>
			<tr>
				<td ><label for="key">Shift:</label></td>
				<td><input type="text" id="key" value=5 style="width:4em;"/></td>
			</tr>
			<tr>
				<td></td>
				<td>

					<button id="enkrip" type="submit" value="Encrypt" onclick="doCrypt(false);">Encrypt</button>
					<button id="dekrip" type="submit" value="Decrypt" onclick="doCrypt(true);">Decrypt</button>
				</td>
			</tr>
		</tbody>
	</table>
	</form>

	<script type="text/javascript">
		function AssignPlain()
		{
		  var plain=document.getElementById("plain").value;
		  return plain;
		}

		function AssignKey()
		{
		  var key=document.getElementById("key").value;
		  return key;
		}
		// CAESAR
		//--------------------------------------------------------------------------------
		function doCrypt(isDecrypt) {
			var shiftText = AssignKey();
			if (!/^-?\d+$/.test(shiftText)) {
				alert("Shift is not an integer");
				return;
			}
			shift = parseInt(shiftText, 10);
			if (shift<0)	shift = (26 + shift) % 26;
			if (isDecrypt)
				shift = (26 - shift) % 26;
			textElem = AssignPlain();
			textElem = caesarShift(textElem, shift);
			console.log(textElem);
			document.getElementById("plain").value = textElem;
		}

		function caesarShift(text, shift) {
			 result = "";
			for (var i = 0; i < text.length; i++) {
				var c = text.charCodeAt(i);

				if      (65 <= c && c <=  90) result += String.fromCharCode((c - 65 + shift) % 26 + 65);  // Uppercase
				else if (97 <= c && c <= 122) result += String.fromCharCode((c - 97 + shift) % 26 + 97);  // Lowercase
				else                          result += text.charAt(i);  // Copy

				// if 		(result.charAt(i) < 65) result.charAt(i) -= shift;
				// else if (result.charAt(i) < 97) result.charAt(i) -= shift;
			}
			return result;
		}
	</script>
</body>
</html>
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
	<title>PolyAlphabetic</title>
	<!-- <script src="Encryptorr_files/encryptor.js"></script> -->
</head>
<body>
	<div align="center"><h2><b>PolyAlphabetic</b></h2></div>
	<form action="#" method="get" onsubmit="return false;">
	<table class="noborder">
		<tbody>
			<tr>
				<td><label for="plain">Text:</label></td>
				<td><textarea id="plain" cols="50" rows="10" style="width:40em; height:15em">inienkripsi</textarea></td>
			</tr>
			<tr>
				<td ><label for="key">Key:</label></td>
				<td><input type="text" id="key" value="inikuncinyabro" style="width:15em;"/></td>
			</tr>
			<tr>
				<td></td>
				<td>

					<input id="enkrip" type="button" value="Encrypt" onclick="doPolyCrypt(false);"/>
					<input id="dekrip" type="button" value="Decrypt" onclick="doPolyCrypt(true);"/>
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

		function doPolyCrypt(isDecrypt) {
		  var vkey = AssignKey();

		  var vtext= AssignPlain();
		   // document.write(vtext);

		  var key = filterKey(vkey);
		  if (key.length == 0) {
		    alert("Key has no letters");
		    return;
		  }
		  if (isDecrypt) {
		    for (var i = 0; i < key.length; i++)
		      key[i] = (26 - key[i]) % 26;
		  }
		  var textElem = vtext;
		  document.getElementById("plain").value = crypt(textElem, key);
		}


		/* 
		 * Returns the result the Vigenère encryption on the given text with the given key.
		 */
		function crypt(input, key) {
		  var output = "";
		  for (var i = 0, j = 0; i < input.length; i++) {
		    var c = input.charCodeAt(i);
		    if (isUppercase(c)) {
		      output += String.fromCharCode((c - 65 + key[j % key.length]) % 26 + 65);
		      j++;
		    } else if (isLowercase(c)) {
		      output += String.fromCharCode((c - 97 + key[j % key.length]) % 26 + 97);
		      j++;
		    } else {
		      output += input.charAt(i);
		    }
		  }
		  return output;
		}


		/* 
		 * Returns an array of numbers, each in the range [0, 26), representing the given key.
		 * The key is case-insensitive, and non-letters are ignored.
		 * Examples:
		 * - filterKey("AAA") = [0, 0, 0].
		 * - filterKey("abc") = [0, 1, 2].
		 * - filterKey("the $123# EHT") = [19, 7, 4, 4, 7, 19].
		 */
		function filterKey(key) {
		  var result = [];
		  for (var i = 0; i < key.length; i++) {
		    var c = key.charCodeAt(i);
		    if (isLetter(c))
		      result.push((c - 65) % 32);
		  }
		  return result;
		}


		// Tests whether the specified character code is a letter.
		function isLetter(c) {
		  return isUppercase(c) || isLowercase(c);
		}

		// Tests whether the specified character code is an uppercase letter.
		function isUppercase(c) {
		  return 65 <= c && c <= 90;  // 65 is character code for 'A'. 90 is 'Z'.
		}

		// Tests whether the specified character code is a lowercase letter.
		function isLowercase(c) {
		  return 97 <= c && c <= 122;  // 97 is character code for 'a'. 122 is 'z'.
		}
	</script>
</body>
</html>
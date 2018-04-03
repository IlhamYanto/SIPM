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
	<title>DES</title>
	<script src="des.js"></script>
	<script src="ecb.js"></script>
</head>
<body>
	<div align="center"><h2><b>DES Cipher</b></h2></div>
	<form action="#" method="get" onsubmit="return false;">
	<table class="noborder">
		<tbody>
			<tr>
				<td><label for="plain">Text:</label></td>
				<td><textarea id="plain" cols="50" rows="10" style="width:40em; height:15em">inienkripsi</textarea></td>
			</tr>
			<tr>
				<td ><label for="key">Key:</label></td>
				<td><input type="text" id="key" value="inikunci" style="width:20em;"/></td>
			</tr>
			<tr>
				<td></td>
				<td>

				<input id="enkrip" type="button" value="Encrypt" onclick="encryptByDES();"/>
				<input id="dekrip" type="button" value="Decrypt" onclick="decryptByDES();"/>
				</td>
			</tr>
		</tbody>
	</table>
	</form>
	<script type="text/javascript">
		function AssignPlain() {
			var plain = document.getElementById('plain').value;
			return plain;
		}

		function AssignKey() {
			var key = document.getElementById('key').value;
			return key;
		}

		function encryptByDES() {
			message = AssignPlain();
			key = AssignKey();
			var keyHex = CryptoJS.enc.Utf8.parse(key);

			var encrypted = CryptoJS.DES.encrypt(message, keyHex, {
				mode: CryptoJS.mode.ECB,
				padding: CryptoJS.pad.Pkcs7,
			});
			document.getElementById('plain').value = encrypted.toString();
			return encrypted.toString();
		}

		function decryptByDES() {
			message = AssignPlain();
			key = AssignKey();
			var keyHex = CryptoJS.enc.Utf8.parse(key);

			var decrypted = CryptoJS.DES.decrypt(
				{
					ciphertext: CryptoJS.enc.Base64.parse(message),
				},
				keyHex,
				{
					mode: CryptoJS.mode.ECB,
					padding: CryptoJS.pad.Pkcs7,
				}
			);
			document.getElementById('plain').value = decrypted.toString(
				CryptoJS.enc.Utf8
			);
			return decrypted.toString(CryptoJS.enc.Utf8);
		}
		
	</script>
</body>
</html>
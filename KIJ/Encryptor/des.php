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
	<div align="center"><h2><b>DES</b></h2></div>
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

		/**
				 * Encrypt message by DES in ECB mode and Pkcs7 padding scheme
				 *
				 * NOTE: DES is weak, please use 3DES(Triple DES) or AES
				 * 
				 * @param  {String} message
				 * @param  {String} key
				 * @return {String} ciphertext(base64 string)
				 * 
				 * @author Sun
				 * @version 2013-5-15
				 *
				 * @see <a href="https://groups.google.com/d/msg/crypto-js/I378fq3esK8/HZ2P2Xtuzk8J">des encrypion: js encrypted value does not match the java encrypted value</a>
				 * In cryptoJS you have to convert the key to hex
				 * and useit as word just like above (otherwise it will be considered as passphrase)
				 * 
				 * @see <a href="http://stackoverflow.com/questions/12894722/c-sharp-and-java-des-encryption-value-are-not-identical">C# and Java DES Encryption value are not identical</a>
				 * SunJCE provider uses ECB as the default mode,
				 * and PKCS5Padding as the default padding scheme for DES.(JCA Doc)
				 * This means that in the case of the SunJCE provider,
				 *     Cipher c1 = Cipher.getInstance("DES/ECB/PKCS5Padding");
				 * and
				 *     Cipher c1 = Cipher.getInstance("DES");
				 * are equivalent statements.
				 *
				 * @see <a href="http://stackoverflow.com/questions/10193567/java-security-nosuchalgorithmexception-cannot-find-any-provider-supporting-aes">java.security.NoSuchAlgorithmException: Cannot find any provider supporting AES/ECB/PKCS7PADDING</a>
				 * I will point out that PKCS#5 and PKCS#7 actually specify exactly
				 * the same type of padding (they are the same!),
				 * but it's called #5 when used in this context. :)
				 */

		function encryptByDES() {
			message = AssignPlain();
			key = AssignKey();
			// For the key, when you pass a string,
			// it's treated as a passphrase and used to derive an actual key and IV.
			// Or you can pass a WordArray that represents the actual key.
			// If you pass the actual key, you must also pass the actual IV.
			var keyHex = CryptoJS.enc.Utf8.parse(key);
			// console.log(CryptoJS.enc.Utf8.stringify(keyHex), CryptoJS.enc.Hex.stringify(keyHex));
			// console.log(CryptoJS.enc.Hex.parse(CryptoJS.enc.Utf8.parse(key).toString(CryptoJS.enc.Hex)));

			// CryptoJS use CBC as the default mode, and Pkcs7 as the default padding scheme
			var encrypted = CryptoJS.DES.encrypt(message, keyHex, {
				mode: CryptoJS.mode.ECB,
				padding: CryptoJS.pad.Pkcs7,
			});
			// decrypt encrypt result
			// var decrypted = CryptoJS.DES.decrypt(encrypted, keyHex, {
			//     mode: CryptoJS.mode.ECB,
			//     padding: CryptoJS.pad.Pkcs7
			// });
			// console.log(decrypted.toString(CryptoJS.enc.Utf8));

			// when mode is CryptoJS.mode.CBC (default mode), you must set iv param
			// var iv = 'inputvec';
			// var ivHex = CryptoJS.enc.Hex.parse(CryptoJS.enc.Utf8.parse(iv).toString(CryptoJS.enc.Hex));
			// var encrypted = CryptoJS.DES.encrypt(message, keyHex, { iv: ivHex, mode: CryptoJS.mode.CBC });
			// var decrypted = CryptoJS.DES.decrypt(encrypted, keyHex, { iv: ivHex, mode: CryptoJS.mode.CBC });

			// console.log('encrypted.toString()  -> base64(ciphertext)  :', encrypted.toString());
			// console.log('base64(ciphertext)    <- encrypted.toString():', encrypted.ciphertext.toString(CryptoJS.enc.Base64));
			// console.log('ciphertext.toString() -> ciphertext hex      :', encrypted.ciphertext.toString());
			document.getElementById('plain').value = encrypted.toString();
			return encrypted.toString();
		}

		/**
				 * Decrypt ciphertext by DES in ECB mode and Pkcs7 padding scheme
				 * 
				 * @param  {String} ciphertext(base64 string)
				 * @param  {String} key
				 * @return {String} plaintext
				 *
				 * @author Sun
				 * @version 2013-5-15
				 */
		function decryptByDES() {
			message = AssignPlain();
			key = AssignKey();
			var keyHex = CryptoJS.enc.Utf8.parse(key);

			// direct decrypt ciphertext
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
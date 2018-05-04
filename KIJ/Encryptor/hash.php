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
	<title>Hash</title>
	<script src=vendor/hash/md5.js></script>
	<script src=vendor/hash/sha1.js></script>
	<script src=vendor/hash/sha256.js></script>
	<script src=vendor/hash/sha512.js></script>
	<script src=vendor/hash/sha3.js></script>
</head>
<body>
	<div align="center"><h2><b>Hash Function</b></h2></div>
	<form action="#" method="get" onsubmit="return false;">
	<table class="noborder">
		<tbody>
			<tr>
				<td><label for="plain">Text:</label></td>
				<td><textarea id="plain" cols="50" rows="10" style="width:40em; height:15em">inienkripsi</textarea></td>
			</tr>
			<tr>
				<td ><label for="length">Length:</label></td>
				<td><input type="text" id="length" value="256" style="width:20em;"/></td>
			</tr>
			<tr>
				<td></td>
				<td>
				<input id="md5" type="button" value="MD5" onclick="Hmd5();"/>
				<input id="sha1" type="button" value="SHA1" onclick="Hsha1();"/>
				<input id="sha2" type="button" value="SHA2" onclick="Hsha2();"/>
				<input id="sha3" type="button" value="SHA3" onclick="Hsha3();"/>
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

		function AssignLength() {
			var length = document.getElementById('length').value;
			return length;
		}

		function Hmd5() {
			message = AssignPlain();
			md5 = CryptoJS.MD5(message)
			document.getElementById('plain').value = md5;
			return md5;
			
		}

		function Hsha1() {
			message = AssignPlain();
			sha1 = CryptoJS.SHA1(message);
			document.getElementById('plain').value = sha1;
			return sha1;
		}

		function Hsha2() {
			message = AssignPlain();
			length = AssignLength();
			if(length == 512)
				sha2 = CryptoJS.SHA512(message)
			else
				sha2 = CryptoJS.SHA256(message)
			document.getElementById('plain').value = sha2;
			return sha2;
		}
		function Hsha3() {
			message = AssignPlain();
			sha3 = CryptoJS.SHA256(message)
			document.getElementById('plain').value = sha3;
			return sha3;
		}		
	</script>
</body>
</html>
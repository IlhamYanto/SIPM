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
	<title>RSA</title>
	<script src="http://kjur.github.io/jsrsasign/jsrsasign-latest-all-min.js"></script>
	<script src=vendor/hash/md5.js></script>
	<script src=vendor/hash/sha1.js></script>
	<script src=vendor/hash/sha256.js></script>
	<script src=vendor/hash/sha512.js></script>
	<script src=vendor/hash/sha3.js></script>
	<script src="vendor/jsrsasign-8.0.12/src/asn1-1.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/asn1cades-1.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/asn1cms-1.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/asn1csr-1.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/asn1hex-1.1.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/asn1ocsp-1.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/asn1tsp-1.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/asn1x509-1.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/base64x-1.1.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/dsa-2.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/ecdsa-modified-1.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/ecparam-1.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/jws-3.3.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/jwsjs-2.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/keyutil-1.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/nodeutil-1.0.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/rsapem-1.1.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/rsasign-1.2.js"></script>
	<script src="vendor/jsrsasign-8.0.12/src/x509-1.1.js"></script>
</head>
<body>
	<div align="center"><h2><b>Digital Signature RSA</b></h2></div>
	<form action="#" method="get" onsubmit="return false;">
	<table class="noborder">
		<tbody>
			<tr>
				<td><label for="plain">Text:</label></td>
				<td><textarea id="plain" cols="50" rows="10" style="width:40em; height:15em">inienkripsi</textarea></td>
			</tr>
			<tr>
				<td ><label for="prkey">Private Key:</label></td>
				<td><input type="text" id="prkey" value="inikunciprivate" style="width:15em;"/></td>
			</tr>
			<tr>
				<td ><label for="pukey">Publik Key:</label></td>
				<td><input type="text" id="pukey" value="inikuncipublik" style="width:15em;"/></td>
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
		var rsa = new RSAKey();
rsa.readPrivateKeyFromPEMString(_PEM_PRIVATE_KEY_STRING_);
var hSig = rsa.signString("aaa", "sha1"); // sign a string "aaa" with key
	</script>
</body>
</html>
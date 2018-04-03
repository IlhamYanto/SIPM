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
	<title>MonoAlphabetic Encryptor</title>
	<!-- <script src="Encryptorr_files/encryptor.js"></script> -->
</head>
<body>
	<div align="center"><h2><b>MonoAlphabetic Cipher</b></h2></div>
	<form action="#" method="get" onsubmit="return false;">
	<table class="noborder">
		<tbody>
			<tr>
				<td><label for="plain">Text:</label></td>
				<td><textarea id="plain" cols="50" rows="10" style="width:40em; height:15em">inienkripsi</textarea></td>
			</tr>
			<tr>
				<td ><label for="key">Key:</label></td>
				<td><input type="text" id="key" value="bmiyngocdvhaeukxzjtwlsqfrp" style="width:20em;"/></td>
			</tr>
			<tr>
				<td></td>
				<td>

					<input id="enkrip" type="button" value="Encrypt" onclick="monoCrypt();"/>
					<input id="dekrip" type="button" value="Decrypt" onclick="demonoCrypt();"/>
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

		function monoCrypt() { 
		  var text=AssignPlain();
		  var key = AssignKey();
		  var plaintext = text.toLowerCase();  
		  var ekey = key.toLowerCase().replace(/[^a-z]/g,""); 
		  if(plaintext.length < 1){ alert("please enter some plaintext (letters and numbers only)"); return; }    
		  if(ekey.length != 26){ alert("key must be 26 characters in length"); return; }
		  var ciphertext = ""; var re = /[a-z]/; 
		  for(var i=0; i<plaintext.length; i++){ 
		      if(re.test(plaintext.charAt(i))) ciphertext += ekey.charAt(plaintext.charCodeAt(i)-97); 
		      else  ciphertext += plaintext.charAt(i); 
		  }
		  document.getElementById("plain").value = ciphertext.toUpperCase(); 
		}

		function demonoCrypt() {
		  var text=AssignPlain();
		  var key = AssignKey(); 
		  var ciphertext = text.toLowerCase();  
		  var ekey = key.toLowerCase().replace(/[^a-z]/g, ""); 
		  if(ciphertext.length < 1){ alert("please enter some ciphertext (letters only)"); return; }    
		  if(ekey.length != 26){ alert("key must be 26 characters in length"); return; }
		  var plaintext = ""; var re = /[a-z]/; 
		  for(var i=0; i<ciphertext.length; i++){ 
		      if(re.test(ciphertext.charAt(i))) plaintext += String.fromCharCode(ekey.indexOf(ciphertext.charAt(i))+97); 
		      else  plaintext += ciphertext.charAt(i); 
		  } 
		 document.getElementById("plain").value = plaintext.toUpperCase();
		}
	</script>
</body>
</html>
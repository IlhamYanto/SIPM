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
	<title>Reilfence</title>
	<!-- <script src="Encryptorr_files/encryptor.js"></script> -->
</head>
<body>
	<div align="center"><h2><b>Reilfence</b></h2></div>
	<form action="#" method="get" onsubmit="return false;">
	<table class="noborder">
		<tbody>
			<tr>
				<td><label for="plain">Text:</label></td>
				<td><textarea id="plain" cols="50" rows="10" style="width:40em; height:15em">inienkripsi</textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>

					<input id="enkrip" type="button" value="Encrypt" onclick="reilencode();"/>
					<input id="dekrip" type="button" value="Decrypt" onclick="reildecode();"/>
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

		function reilencode(){
  var message = AssignPlain();
  var rail1=[];
  var rail2=[];
  var rail3=[];
  message = message.toUpperCase().split(' ').join('');
  for( var i = 0; i < message.length; i++ ){
    if(i % 4 === 0 ){
      rail1.push( message[i] );
    }
    else if ( i % 2 === 1  ){
      rail2.push( message[i] );
    }
    else{
      rail3.push( message[i] );
    }
  }
  rail = rail1.join('') + rail2.join('') + rail3.join('');
  document.getElementById("plain").value = rail;
}

function reildecode(){
  var message = AssignPlain();
  var ctr4 = 0;
  var ctr3 = 0;
  var ctr2 = 0;
  var ctr1 = 0;
  var rail4 = [];
  var rail3 = [];
  var rail2 = [];
  var rail1 = [];
  var rail = [];
  var xmessage = message.toUpperCase().split(' ').join('');
  for(i = 0; i < message.length; i++){
    if(i % 4 === 0 )          ctr4++;
    else if ( i % 4 === 3  )  ctr3++;
    else if ( i % 4 === 2  )  ctr2++;
    else                      ctr1++;
  }
  while(ctr4--)
  {
    rail4.push(xmessage[0]);
    xmessage=xmessage.substring(1);
  }
  rail4=rail4.join('');
  ctr0 = ctr1+ctr3;
  for(i=0; i<ctr0; i++){
    if(i%2==1)
    {
      rail3.push(xmessage[0]);
      xmessage=xmessage.substring(1);
    }
    else
    {
      rail1.push(xmessage[0]);
      xmessage=xmessage.substring(1);    
    }
  }
  rail1=rail1.join('');
  rail3=rail3.join('');
  while(ctr2--)
  {
    rail2.push(xmessage[0]);
    xmessage=xmessage.substring(1);
  }
  rail2=rail2.join('');
  for(i = 0; i < message.length; i++){
    if(i % 4 === 0 ){
      rail.push(rail4[0]);
      rail4=rail4.substring(1);
    }    
    else if ( i % 4 === 1  ){
      rail.push(rail1[0]);
      rail1=rail1.substring(1);
    }    
    else if ( i % 4 === 3  ){
      rail.push(rail3[0]);
      rail3=rail3.substring(1);
    }      
    else{
      rail.push(rail2[0]);
      rail2=rail2.substring(1);
    }    
  }
  var result ="";
  for(i=0;i<rail.length;i++)
  {
    result = result.concat(rail[i]);
  }
  document.getElementById("plain").value = result;
}
	</script>
</body>
</html>
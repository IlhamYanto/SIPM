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
        <td ><label for="key">Depth:</label></td>
        <td><input type="text" id="key" value=3 style="width:4em;"/></td>
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

  function reilencode()
  {
    ptext = AssignPlain();
    key = AssignKey();

    if (key == 1 || key > (0.5 * ptext.length))
    {
      alert("key tidak boleh sama dengan satu atau melebihi setengah panjang plain text");
      return 1;
    }

    mainArray = Array(key);
    for (i = 0; i < key; i++) {
      mainArray[i] = Array(ptext.length);
      for (s = 0; s < ptext.length; s++) {
        mainArray[i][s] = '';
      }
    }
    j = 0;
    r = 0;
    for (i = 0; i < ptext.length; i++) {
      p = ptext.substr(i, 1);
      mainArray[j][i] = p;
      
      if (r == 0)       j = j + 1;
      else if (r == 1)  j = j - 1;

      if (j == key - 1) r = 1;
      else if (j == 0)  r = 0;
    }
    for (i = 0; i < mainArray.length; i++) {
      mainArray[i] = mainArray[i].join('');
    }

    ctext = mainArray.join('');
    document.getElementById("plain").value = ctext;
  }

  function reildecode()
  {
    ctext = AssignPlain();
    key = AssignKey();

    if (key == 1 || key > (0.5 * ctext.length))
    {
      alert("key tidak boleh sama dengan satu atau melebihi setengah panjang plain text");
      return 1;
    }

    mainArray = Array(key);
    for(i=0; i<key; i++)
    {
      mainArray[i] = Array(ctext.length);
      for (s=0; s<ctext.length; s++)
      {
        mainArray[i][s] = "";
      }
    }
    
    q = 0;
    for (t=0; t<mainArray.length; t++)
    {
      j = 0;
      r = 0;
      for (i=0; i<ctext.length; i++)
      {
        if (j == t)
        {
          c = ctext.substr(q,1);
          mainArray[j][i] = c;
          q = q + 1;
        }
        if (r == 0)       j = j + 1;
        else if (r == 1)  j = j - 1;
        
        if (j == key - 1) r = 1;
        else if (j == 0)  r = 0;
      }
    }
    
    j = 0;
    r = 0;
    ptext = "";
    for (i=0; i<ctext.length; i++)
    {
      ptext = ptext + mainArray[j][i];
      
        if (r == 0)       j = j + 1;
        else if (r == 1)  j = j - 1;
        
        if (j == key - 1) r = 1;
        else if (j == 0)  r = 0;
    }
    document.getElementById("plain").value = ptext;
  }
	</script>
</body>
</html>
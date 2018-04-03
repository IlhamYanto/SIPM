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
	<title>PlayFair</title>
	<!-- <script src="Encryptorr_files/encryptor.js"></script> -->
</head>
<body>
	<div align="center"><h2><b>PlayFair Cipher</b></h2></div>
	<form action="#" method="get" onsubmit="return false;">
	<table class="noborder">
		<tbody>
			<tr>
				<td><label for="plain">Text:</label></td>
				<td><textarea id="plain" cols="50" rows="10" style="width:40em; height:15em">inienkripsi</textarea></td>
			</tr>
			<tr>
				<td ><label for="key">Key:</label></td>
				<td><input type="text" id="key" value="ini kuncinya bro" style="width:20em;"/></td>
			</tr>
			<tr>
				<td></td>
				<td>

				<input id="enkrip" type="button" value="Encrypt" onclick="doPlayfair(true);"/>
				<input id="dekrip" type="button" value="Decrypt" onclick="doPlayfair(false);"/>
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

		function setKey(key) {
		  if (key) {
		    // create grid from key
		    var alphabet = ['abcdefghiklmnopqrstuvwxyz'];
		    var sanitizedKey = key.toLowerCase().replace(/j/g, 'i').replace(/[^a-z]/g, '');
		    var keyGrid = [...new Set(`${sanitizedKey}${alphabet}`)];
		    grid = [];
		    for (let i = 0; i < keyGrid.length; i += 5) {
		      grid.push(keyGrid.slice(i, i + 5));
		    }
		  } 
		  return grid;
		}

		function preProcess(input, decrypt) 
		{
		  // split into duples, fixing double-letters (hello => he lx lo) and padding
		  text = input.toLowerCase().replace(/[^a-z]/g, '').replace(/j/g, 'i').split('').filter(x => x !== ' ');
		  duples = [];
		  for (let i = 0; i < text.length; i += 2) {
		    currentDuple = text.slice(i, i + 2);
		    if (!decrypt && currentDuple.length !== 2) {
		      currentDuple.push('x');
		      duples.push(currentDuple);
		    }else if (!decrypt && currentDuple[0] === currentDuple[1]) {
		      text.splice(i + 1, 0, 'x');
		      duples.push(text.slice(i, i + 2));
		    }else {
		      duples.push(currentDuple);
		    }
		    // console.log(currentDuple)
		  }

		  // find row and column for each letter in duple
		   coordinates = [];
		  duples.forEach((duple) => {
		    coordinates.push(duple.map((letter) => {
		      let col;
		       row = grid.findIndex(row => {

		         rowIdx = row.findIndex(x => x === letter);
		        if (rowIdx >= 0) {
		          col = rowIdx;
		          return true;
		        }
		        return false;
		      });
		      return [row, col];
		    }));
		  });

		  return coordinates;
		}

		function doPlayfair(decrypt) {
		  var input = AssignPlain();
		  var grid = setKey(AssignKey());
		  // console.log(grid);
		  if (!grid) return 'First set the key!';
		  if (input && decrypt && input.length % 2 !== 0) input += 'x';
		  const coordinates = preProcess(input, decrypt);

		  // set modifiers to respond appropriately based on decrypt switch
		  // set modifiers to respond appropriately based on decrypt switch
		  const modifier = decrypt ? -1 : 1;
		  const wall = decrypt ? 0 : 4;
		  const phase = decrypt ? 4 : -4;

		  const processedLocs = [];
		  coordinates.forEach((loc) => {
		    // loc: [ [ firstLetterR, firstLetterC ], [ secondLetterR, secondLetterC ] ]
		    // modified: [ [ newFirstLetterR, newFirstLetterC ], [ newSecondLetterR, newSecondLetter R ] ]

		    let modifiedLoc = [];

		    // handle letters on the same row
		    if (loc[0][0] === loc[1][0]) {
		      // increment/decrement the column
		      modifiedLoc[0] = loc[0][1] === wall ? [loc[0][0], wall + phase] : [loc[0][0], loc[0][1] + modifier];
		      modifiedLoc[1] = loc[1][1] === wall ? [loc[1][0], wall + phase] : [loc[1][0], loc[1][1] + modifier];
		      return processedLocs.push(modifiedLoc);
		    }

		    // handle letters in the same column
		    if (loc[0][1] === loc[1][1]) {
		      // increment/decrement the row
		      modifiedLoc[0] = loc[0][0] === wall ? [wall + phase, loc[0][1]] : [loc[0][0] + modifier, loc[0][1]];
		      modifiedLoc[1] = loc[1][0] === wall ? [wall + phase, loc[1][1]] : [loc[1][0] + modifier, loc[1][1]];
		      return processedLocs.push(modifiedLoc);
		    }

		    // handle different rows, different columns
		    modifiedLoc[0] = [loc[0][0], loc[1][1]];
		    modifiedLoc[1] = [loc[1][0], loc[0][1]];
		    processedLocs.push(modifiedLoc);
		  });

		  // translate coordinates into ciphertext
		  const processedText = processedLocs
		    .map((loc) => [grid[loc[0][0]][loc[0][1]], grid[loc[1][0]][loc[1][1]]].join(''))
		    .join('');

		  document.getElementById("plain").value = processedText.toUpperCase();
		}
	</script>
</body>
</html>
// "use strict";

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
	var shift = parseInt(shiftText, 10);
	if (shift < 0 || shift >= 26) {
		alert("Shift is out of range");
		return;
	}
	if (isDecrypt)
		shift = (26 - shift) % 26;
	var textElem = AssignPlain();
	textElem = caesarShift(textElem, shift);
	document.getElementById("plain").innerHTML =textElem;

}

function caesarShift(text, shift) {
	var result = "";
	for (var i = 0; i < text.length; i++) {
		var c = text.charCodeAt(i);
		if      (65 <= c && c <=  90) result += String.fromCharCode((c - 65 + shift) % 26 + 65);  // Uppercase
		else if (97 <= c && c <= 122) result += String.fromCharCode((c - 97 + shift) % 26 + 97);  // Lowercase
		else                          result += text.charAt(i);  // Copy
	}
	return result;
}
//MonoAlphabetic
//--------------------------------------------------------------------------------
function monoCrypt() 
{ var text=AssignPlain();
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
  document.getElementById("plain").innerHTML = ciphertext.toUpperCase(); 
}

function demonoCrypt(){
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
 document.getElementById("plain").innerHTML = plaintext.toUpperCase();
}
//PlayFair
//-------------------------------------------------------------------------------------------------

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
          console.log(row, col)
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

  document.getElementById("plain").innerHTML = processedText.toUpperCase();
}

//--------------------------PolyAlphabetic---------------------------------------------//

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
  document.getElementById("plain").innerHTML = crypt(textElem, key);
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


// Reil Fence //

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
  document.getElementById("plain").innerHTML = rail;
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
  document.getElementById("plain").innerHTML = result;
}
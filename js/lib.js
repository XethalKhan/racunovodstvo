
function newRow(){
	var table = document.getElementById("GK");
	var row = table.insertRow(-1);
	var cell0 = row.insertCell(0);
	var cell1 = row.insertCell(1);
	var cell2 = row.insertCell(2);
	var cell3 = row.insertCell(3);
	var cell4 = row.insertCell(4);
	cell0.innerHTML = '<input type = "text" class="Dk data" name = "Dk[]"/>';
	cell1.innerHTML = '<input type = "text" class="Pk data" name = "Pk[]"/>';
	cell2.innerHTML = '<input type = "text" class="O data" name = "O[]"/>';
	cell3.innerHTML = '<input type = "text" class="Di data" name = "Di[]"/>';
	cell4.innerHTML = '<input type = "text" class="Pi data" name = "Pi[]"/>';
};


function XOR(a,b) {
	return ( a || b ) && !( a && b );
};

function checkDesc(o, i){
	if(o.indexOf(";") > -1 || o.indexOf("/") > -1 || o.indexOf("\\") > -1){
		return "Greska: zabranjeno je unositi tacke-zareze i kose crte u opise. Ispraviti red " + i + " !";
	}
	else{
		return "OK";
	}
}

function checkRow(dk, pk, o, di, pi, i, o_test){
	/*
		return "Empty" = prazan red
		return err = greska
		return "OK" = red je ok
	*/
	var err;
	var patt_int = /^[0-9]{3}$/;
	var patt_dec = /(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/;
	i+=1;
	if(dk == "" && pk == "" && di == "" && pi == ""){//PRAZAN RED
		return "Empty";
	}
	if(dk == "" && pk == "" && XOR(di != "", pi != "")){//KONTO JE PRAZAN
		err = "Greska: nije definisana klasa za red " + i + "!";
		return err;
	}
	if(di == "" && pi == "" && XOR(dk != "", pk != "")){//IZNOS JE PRAZAN
		err = "Greska: nije definisan iznos za red " + i + "!";
		return err;
	}
	if((dk != "" && pi != "") || (di != "" && pk != "")){
		err = "Greska: konto ili iznos je unet na pogresnom mestu u redu " + i;
		return err;
	}
	if(o_test == true){
		err = checkDesc(o, i);
		if(err != "OK"){
			return err;
		}
	}
	if(dk != "" && di != ""){
		if(!patt_int.test(dk)){//POGRESAN FORMAT ZA DUGOVNI KONTO
			err = "Greska: uneli ste konto na dugovnoj strani u pogresnom formatu u redu " + i + ". Morate uneti 3 cifre!";
			return err;
		}
		if(!patt_dec.test(di)){//POGRESAN FORMAT ZA DUGOVNI IZNOS
			err = "Greska: uneli ste iznos na dugovnoj strani u pogresnom formatu u redu " + i + ". Iznos mozete uneti u formi 1234.5 ili 1234 ili .456!";
			return err;
		}
	}
	else{
		if(!patt_int.test(pk)){//POGRESAN FORMAT ZA POTRAZNI KONTO
			err = "Greska: uneli ste konto na potraznoj strani u pogresnom formatu u redu " + i + ". Morate uneti 3 cifre!";
			return err;
		}
		if(!patt_dec.test(pi)){//POGRESAN FORMAT ZA POTRAZNI IZNOS
			err = "Greska: uneli ste iznos na potraznoj strani u pogresnom formatu u redu " + i + ". Iznos mozete uneti u formi 1234.5 ili 1234 ili .456!";
			return err;
		}
	}
	return "OK";
};

//<OBRADA ZA PRAVLJENJE ZADATAKA>

function check(o_test){
	var dk = document.getElementsByClassName("Dk");
	var di = document.getElementsByClassName("Di");
	var pk = document.getElementsByClassName("Pk");
	var pi = document.getElementsByClassName("Pi");
	var o = document.getElementsByClassName("O");
	var sz = dk.length;
	var msg;
	var i;
	document.getElementById("ids").value = "";
	document.getElementById("emp").value = "";
	document.getElementById("err").value = "";
	document.getElementById("acc").value = "";
	for (i = 0; i < sz; i++){
		if(o_test == true){
			msg = checkRow(dk[i].value.trim(), pk[i].value.trim(), o[i].value.trim(), di[i].value.trim(), pi[i].value.trim(), i, o_test);
		}
		else{
			msg = checkRow(dk[i].value.trim(), pk[i].value.trim(), "", di[i].value.trim(), pi[i].value.trim(), i, o_test);
		}
		
		if(msg == "OK"){
			document.getElementById("ids").value = document.getElementById("ids").value + i + ";"
		}
		else if(msg == "Empty"){
			document.getElementById("emp").value = document.getElementById("emp").value + i + ";"
		}
		else{
			document.getElementById("err").value = document.getElementById("err").value + msg + ";"
		}
	}
	
	if(document.getElementById("err").value != ""){
		var errmsg = document.getElementById("err").value.substr(0, document.getElementById("err").value.length - 1);
		errmsg = errmsg.replace(/;/g, "\n");
		alert(errmsg);
		return false;
	}
	
	if(document.getElementById("emp").value != "" && document.getElementById("ids").value == ""){
		alert("Svi redovi su prazni!");
		return false;
	}
	
	if(document.getElementById("zadatak").value == "" || document.getElementById("zadatak").value.length < 30){
		alert("Obavezno je uneti tekst zadatka, minimun 30 karaktera, maksimalno 3000 karaktera");
		return false;
	}
	else{
		document.getElementById("zadatak").value = document.getElementById("zadatak").value.substr(0, 3000).trim();
	}
	
	var dug_iznos = 0;
	var pot_iznos = 0;
	var ix = document.getElementById("ids").value.substr(0, document.getElementById("ids").value.length - 1);
	var ix = ix.split(";");
	sz = ix.length;
	for(i=0; i < sz; i++){
		if(dk[parseInt(ix[i])].value != ""){
			document.getElementById("acc").value = document.getElementById("acc").value + "D;";
			dug_iznos += parseFloat(di[parseInt(ix[i])].value);
		}
		else{
			document.getElementById("acc").value = document.getElementById("acc").value + "P;";
			pot_iznos += parseFloat(pi[parseInt(ix[i])].value);
		}
	}
	
	if(dug_iznos != pot_iznos){
		alert("Greska: suma iznosa na dugovnoj i potraznoj strani nije jednaka!" );
		return false;
	}
	
	document.getElementById("form").submit();
	return true;
	
};

function newtask(){
	var valueToSend = document.getElementById("data").value;
	
	var request = false;
	if (window.XMLHttpRequest) {
		request = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		request = new ActiveXObject('Microsoft.XMLHTTP');
	}
	
    if (request) {
        request.open('POST', 'utl/test.php', true);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                console.log(request.responseText);
				if(request.responseText=="OK"){
					window.open("home.php", "_self");
				}
            }
        }
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("data="+valueToSend+"&txt="+document.getElementById("txt").value);
    }
}

//</OBRADA ZA PRAVLJENJE ZADATAKA>

//<OBRADA ZA SLANJE ZADATKA>
function sendtask(){
	var dk = document.getElementsByClassName("Dk");
	var di = document.getElementsByClassName("Di");
	var pk = document.getElementsByClassName("Pk");
	var pi = document.getElementsByClassName("Pi");
	var o = document.getElementsByClassName("O");
	var sz = dk.length;
	var msg;
	var emp = 0;
	var i;
	for (i = 0; i < sz; i++){
		msg = checkRow(dk[i].value.trim(), pk[i].value.trim(), "", di[i].value.trim(), pi[i].value.trim(), i, false);
		if(msg == "Empty"){
			emp++;
		}
		if(msg != "OK" && msg != "Empty"){
			alert(msg);
			return false;
		}
	}
	if(sz == emp){
		alert("Svi redovi su prazni");
		return false;
	}
	var test = confirm("Da li ste sigurni? Posle ovoga nema nazad.");
	if(test){
		document.getElementById("form").submit();
	}
	else{
		return false;
	}
}
//</OBRADA ZA SLANJE ZADATKA>

//<OBRADA ZA OCENJIVANJE>
function gradeIt(){
	var grade = document.getElementById("grade").value.trim();
	if(!(/^(0[1-9]|[1-9]|10)$/.test(grade))){  
		alert("Morate uneti cifru od 1 do 10");
		return false;
	}
	grade = parseInt(grade);
	if(grade < 1 || grade > 10){
		alert("Morate uneti cifru od 1 do 10");
		return false;
	}
	document.getElementById("grade").value = grade;
	document.getElementById("form").submit();
	return true;
}
//</OBRADA ZA OCENJIVANJE>
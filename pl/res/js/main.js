function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function checkFeedbackPL() {
	var wiadomosc = document.mailus.wiadomosc.value;
	var imie = document.mailus.imie.value;
	var email = document.mailus.email.value;
	var telefon = document.mailus.telefon.value;
	var ifValid = true;
	
	if(wiadomosc == '') {
		alert('Aby wys³aæ informacje wymagane jest wype³nienie pola wiadomo¶æ!');
		ifValid = false;
	}
	
	return ifValid;	
}


function checkFeedbackEN() {
	var wiadomosc = document.mailus.wiadomosc.value;
	var imie = document.mailus.imie.value;
	var email = document.mailus.email.value;
	var telefon = document.mailus.telefon.value;
	var ifValid = true;
	
	if(wiadomosc == '') {
		alert('To send information is required to fill out the maddage field!');
		ifValid = false;
	}
	
	return ifValid;	
}

function checkEletter() {
	var regula = /^[a-zA-Z0-9±æê³ñó¶¿¼¡ÆÊ£ÑÓ¦¯¬]{1,30}@[a-zA-Z0-9±æê³ñó¶¿¼¡ÆÊ£ÑÓ¦¯¬]+(\.[a-zA-Z0-9±æê³ñó¶¿¼¡ÆÊ£ÑÓ¦¯¬]+)+$/;
	var imie = document.formularz.imie.value;
	var nazwisko = document.formularz.nazwisko.value;
	var email = document.formularz.email.value;
	var tel = document.formularz.tel.value;
	var ifValid = true;

	if((imie == '')&&(nazwisko == '')&&(email == '')&&(tel == '')) {
		alert('Przed wysy³k± uzupe³nij pola formularza!');
		ifValid = false;
	}
	else if(imie == '') {
		document.formularz.imie.focus();
		alert('Wprowad¼ swoje imiê!');
		ifValid = false;
	}
	else if(nazwisko == '') {
		document.formularz.nazwisko.focus();
		alert('Wprowad¼ swoje nazwisko!');
		ifValid = false;
	}
	else if(tel == '') {
		document.formularz.tel.focus();
		alert('Wpisz numer telefonu!');
		ifValid = false;
	}
	else if(email == '') {
		document.formularz.email.focus();
		alert('Wpisz adres e-mail!');
		ifValid = false;
	}
	else if(!emailCheck(email,'')) {
		ifValid = false;
	} 
	/*
	else if (document.formularz.email.value.indexOf("@")<3){
		alert("Adres email jest niepoprawny. Proszê,"
		+" sprawd¼ prefiks przed znakiem '@'.");
		ifValid = false;
	}
	
	else {
		alert "tu jestem";
		if ((document.formularz.email.value.indexOf(".com")<5)&&(document.formularz.email.value.indexOf(".org")<5)
		&&(document.formularz.email.value.indexOf(".gov")<5)&&(document.formularz.email.value.indexOf(".net")<5)
		&&(document.formularz.email.value.indexOf(".mil")<5)&&(document.formularz.email.value.indexOf(".edu")<5)&&(document.formularz.email.value.indexOf(".pl")<5)){
		alert("Adres e-mail jest niepoprawny.\nProszê,"
		+" sprawd¼ sufiks. (powinien zawieraæ "
		+".com, .edu, .net, .org, .gov, .mil lub .pl)");
		ifValid = false;
	   }	
	}
	
	else if(document.formularz.email.value.match(regula) == null){
		alert "Niepoprawny adres e-amil!";
		ifValid = false;
	}
	*/
	return ifValid;
}
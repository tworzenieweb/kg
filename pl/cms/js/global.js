
function windowhelp() {
	window.open('http://www.sadkosoft.com.pl','EasyCMSHelp','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
}

function openwindow(url) {
	window.open(url,'Podgl±d','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=800,height=768,directories=no,location=no');
}

function openwindow_x(url,x,y) {
	window.open(url,'Podgl±d','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width='+x+',height='+y+',directories=no,location=no');
}


function submitbutton(pressbutton) {	
	submitform(pressbutton);
}

function submitform(pressbutton){		
	document.adminForm.action.value=pressbutton;	
	try {
		document.adminForm.onsubmit();
		}
	catch(e){}	
	document.adminForm.submit();
}


function columnsort(columnname){
	if (document.adminForm.table_sort_column.value != columnname) {
		document.adminForm.table_sort_column.value = columnname;
		document.adminForm.table_sort_type.value = 'ASC';
	} else {
		if (document.adminForm.table_sort_type.value == 'ASC') {
			document.adminForm.table_sort_type.value = 'DESC';			
		} else {
			document.adminForm.table_sort_type.value='ASC';
		}
	}
	try {
		document.adminForm.onsubmit();
		}
	catch(e){}
	document.adminForm.submit();
}

function keyInfo(evnt) {
 if (document.layers) 
  Key = evnt.which;
 if (document.all) 
  Key = event.keyCode;
  if (Key==13) {
	  document.adminForm.action.value = document.adminForm.default_action.value;
	  document.adminForm.submit();
  }
}

function checkAll( n, fldName ) {
  if (!fldName) {
     fldName = 'cb';
  }
	var f = document.adminForm;
	var c = f.toggle.checked;
	var n2 = 0;
	for (i=0; i < n; i++) {
		cb = eval( 'f.' + fldName + '' + i );
		if (cb) {
			cb.checked = c;
			n2++;
		}
	}
	if (c) {
		document.adminForm.boxchecked.value = n2;
	} else {
		document.adminForm.boxchecked.value = 0;
	}
}

function listItemTask( id, task ) {	
    var f = document.adminForm;
    cb = eval( 'f.' + id );
    if (cb) {
        for (i = 0; true; i++) {
            cbx = eval('f.cb'+i);
            if (!cbx) break;
            cbx.checked = false;
        } // for
		
        cb.checked = true;		
        f.boxchecked.value = 1;		
        submitbutton(task);
    }
    return false;
}

function isChecked(isitchecked){
	if (isitchecked == true){
		document.adminForm.boxchecked.value++;
	}
	else {
		document.adminForm.boxchecked.value--;
	}
}

function inputFocus(inputname) {
	if (inputname != '') { document.adminForm.elements[inputname].focus(); }	
}

document.onkeydown = keyInfo
if (document.layers) document.captureEvents(Event.KeyDown)
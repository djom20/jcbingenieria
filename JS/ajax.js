// JavaScript Document

function Buscador(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (E) {
					xmlhttp = false;
				}
		}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
		}

	return xmlhttp;
}
	
function Buscar() {
	Textbusca = document.getElementById('valor').value;
	Con = document.getElementById('resultados');
	ajax = Buscador();
	ajax.open("GET","Funtion.php?Textbusca="+Textbusca);
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4) {
			Con.innerHTML = ajax.responseText;
		}
	}
	ajax.send(null)
}
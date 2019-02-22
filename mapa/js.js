// Crea un objeto Ajax para trabajar con él
function objetoAjax(){
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

// Precarga las imágenes del mapa
var lista_imagenes = new Array();
function cargarmapas(num){
	for(i=0;i<=num;i++){
		lista_imagenes[i] = new Image();
		lista_imagenes[i].src = "mapa"+i+".gif";
	}
}

// Cambia la imagen del mapa
function cambiar(img,id){
	document.getElementById(img).src="mapa"+id+".gif";
}

// Realiza una consulta a un archivo php 'datos' y lo devuelve en divResultado
function MostrarConsulta(datos){
	divResultado = document.getElementById('mapas');
	ajax=objetoAjax();
	ajax.open("GET", datos);
	divResultado.innerHTML = '<center><img src="loading.gif"></center>';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}

// Muestra los resultados de la provincia
function cargaMapa(provincia){
	provincia=evalua(provincia);
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", "mapa.php?provincia="+provincia);
	divResultado.innerHTML = '<center><img src="loading.gif" width="20" height="20"></center>';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}

// Muestra los resultados del paisa
function cargaMapaPais(pais){
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", "mapa_i.php?pais="+pais);
	divResultado.innerHTML = '<center><img src="loading.gif" width="20" height="20"></center>';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}

// Evalúa la provincia seleccionada y asigna su id
function evalua(provincia){
	switch(provincia){
		case "ALAVA":
			id=1;
			break;
			
		case "ALBACETE":
			id=2;
			break;
			
		case "ALICANTE":
			id=3;
			break;
		
		case "ALMERIA":
			id=4;
			break;
		
		case "ASTURIAS":
			id=5;
			break;
			
		case "AVILA":
			id=6;
			break;
			
		case "BADAJOZ":
			id=7;
			break;
		
		case "BALEARES":
			id=8;
			break;
			
		case "BARCELONA":
			id=54;
			break;
			
		case "BURGOS":
			id=10;
			break;
			
		case "CACERES":
			id=11;
			break;
			
		case "CADIZ":
			id=12;
			break;
			
		case "CANTABRIA":
			id=13;
			break;
			
		case "CASTELLON":
			id=14;
			break;
			
		case "CIUDAD REAL":
			id=15;
			break;
		
		case "CORDOBA":
			id=16;
			break;
			
		case "CUENCA":
			id=17;
			break;
			
		case "GERONA":
			id=18;
			break;
			
		case "GRANADA":
			id=19;
			break;
			
		case "GUADALAJARA":
			id=20;
			break;
			
		case "GUIPUZCOA":
			id=21;
			break;
			
		case "HUELVA":
			id=22;
			break;
			
		case "HUESCA":
			id=23;
			break;
			
		case "JAEN":
			id=24;
			break;
			
		case "A CORUNA":
			id=53;
			break;
			
		case "LA RIOJA":
			id=26;
			break;
			
		case "LAS PALMAS":
			id=27;
			break;
			
		case "LEON":
			id=28;
			break;
			
		case "LERIDA":
			id=29;
			break;
			
		case "LUGO":
			id=30;
			break;
			
		case "MADRID":
			id=31;
			break;
			
		case "MALAGA":
			id=32;
			break;
			
		case "MURCIA":
			id=33;
			break;
			
		case "NAVARRA":
			id=34;
			break;
			
		case "ORENSE":
			id=35;
			break;
			
		case "PALENCIA":
			id=36;
			break;
			
		case "PONTEVEDRA":
			id=37;
			break;
			
		case "SALAMANCA":
			id=38;
			break;
			
		case "SEGOVIA":
			id=39;
			break;
			
		case "SEVILLA":
			id=40;
			break;
			
		case "SORIA":
			id=41;
			break;
			
		case "STA.CRUZ DE TENERIFE":
			id=42;
			break;
			
		case "TARRAGONA":
			id=43;
			break;
			
		case "TERUEL":
			id=44;
			break;
			
		case "TOLEDO":
			id=45;
			break;
			
		case "VALENCIA":
			id=46;
			break;
			
		case "VALLADOLID":
			id=47;
			break;
			
		case "VIZCAYA":
			id=48;
			break;
			
		case "ZAMORA":
			id=49;
			break;
			
		case "ZARAGOZA":
			id=50;
			break;
		case "MELILLA":
			id=51;
			break;
	}
	return id;
}

// Inserta un club en la base de datos
function InsertaClub(){
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", "insert_club.php?idclub="+clubes.idclub.value+"&provincia_idprovincia="+clubes.provincia_idprovincia.value+"&nombreclub="+clubes.nombreclub.value+"&localidad="+clubes.localidad.value);
	divResultado.innerHTML = '<center><img src="loading.gif" width="20" height="20"></center>';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}

// Inserta un maestro en la base de datos
function InsertaMaestro(){
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", "insert_maestro.php?idmaestro="+maestros.idmaestro.value+"&nombremaestro="+maestros.nombremaestro.value);
	divResultado.innerHTML = '<center><img src="loading.gif" width="20" height="20"></center>';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}

// Inserta un grado en la base de datos
function InsertaGrado(){
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", "insert_grado.php?idgrado="+grados.idgrado.value+"&descripcion="+grados.descripcion.value);
	divResultado.innerHTML = '<center><img src="loading.gif" width="20" height="20"></center>';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}

// Inserta un la relación de un maestro que IMPARTE clases en un club en la base de datos
function InsertaRelacion1(){
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", "insert_imparte.php?idmaestro="+imparte.idmaestroi.value+"&idclub="+imparte.idclubi.value);
	divResultado.innerHTML = '<center><img src="loading.gif" width="20" height="20"></center>';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}

// Inserta la relación de un maestro que POSEE ciertos grados en la base de datos
function InsertaRelacion2(){
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", "insert_posee.php?idmaestro="+posee.idmaestrop.value+"&idgrado="+posee.idgradop.value);
	divResultado.innerHTML = '<center><img src="loading.gif" width="20" height="20"></center>';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}

// Busca en la base de datos el club introducido
function BuscaClub(){
	cadena=document.busqueda.cadena.value;	
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", "buscar.php?cadena="+cadena);
	divResultado.innerHTML = '<center><img src="loading.gif" width="20" height="20"></center>';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}

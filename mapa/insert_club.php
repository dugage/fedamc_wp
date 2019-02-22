<?php
require("login.php");
if($logincorrecto){
	$link=conectar();
	
	$idclub=$_GET['idclub'];
	$idprovincia=$_GET['provincia_idprovincia'];
	$nombre=$_GET['nombreclub'];
	$localidad=$_GET['localidad'];
	
	if($sql=mysql_query("INSERT INTO club (idclub, provincia_idprovincia, nombre, localidad) VALUES ('".$idclub."', '".$idprovincia."', '".$nombre."', '".$localidad."')")){
		echo "<font color=\"green\"><strong>Club introducido correctamente en la base de datos:</strong></font><br>
			  idclub: ".$idclub."<br>
			  provincia_idprovincia: ".$idprovincia."<br>
			  Nombre: ".$nombre."<br>
			  Localidad: ".$localidad;
	}else{
		echo "<font color=\"red\"><strong>Ha habido un error al introducir el club</strong></font>";
	}

	mysql_close();
}else{
	echo "<font color='red'><strong>¡ERROR!</strong> No se ha identificado correctamente.</font>";
}
?>
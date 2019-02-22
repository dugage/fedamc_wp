<?php
require("login.php");
if($logincorrecto){
	$link=conectar();
	
	$idmaestro=$_GET['idmaestro'];
	$nombremaestro=$_GET['nombremaestro'];
	
	if($sql=mysql_query("INSERT INTO maestro (idmaestro, nombre) VALUES ('".$idmaestro."', '".$nombremaestro."')")){
		echo "<font color=\"green\"><strong>Maestro introducido correctamente en la base de datos:</strong></font><br>
			  idmaestro: ".$idmaestro."<br>
			  Nombre: ".$nombremaestro."<br>";
	}else{
		echo "<font color=\"red\"><strong>Ha habido un error al introducir el maestro</strong></font>";
	}

	mysql_close();
}else{
	echo "<font color='red'><strong>¡ERROR!</strong> No se ha identificado correctamente.</font>";
}
?>
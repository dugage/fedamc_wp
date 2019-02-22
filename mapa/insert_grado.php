<?php
require("login.php");
if($logincorrecto){
	$link=conectar();
	
	$idgrado=$_GET['idgrado'];
	$descripcion=$_GET['descripcion'];
	
	if($sql=mysql_query("INSERT INTO grado (idgrado, descripcion) VALUES ('".$idgrado."', '".$descripcion."')")){
		echo "<font color=\"green\"><strong>Grado introducido correctamente en la base de datos:</strong></font><br>
			  idgrado: ".$idgrado."<br>
			  Descripcion: ".$descripcion."<br>";
	}else{
		echo "<font color=\"red\"><strong>Ha habido un error al introducir el grado</strong></font>";
	}

	mysql_close();
}else{
	echo "<font color='red'><strong>¡ERROR!</strong> No se ha identificado correctamente.</font>";
}
?>
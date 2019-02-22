<?php
require("login.php");
if($logincorrecto){
	$link=conectar();
	
	$idmaestro=$_GET['idmaestro'];
	$idgrado=$_GET['idgrado'];
	
	if($sql=mysql_query("INSERT INTO posee (maestro_idmaestro, grado_idgrado) VALUES ('".$idmaestro."', '".$idgrado."')")){
		echo "<font color=\"green\"><strong>Relacion POSEE introducida correctamente en la base de datos:</strong></font><br>
			  idmaestro: ".$idmaestro."<br>
			  idgrado: ".$idgrado."<br>";
	}else{
		echo "<font color=\"red\"><strong>Ha habido un error al introducir la relacion.</strong></font>";
	}

	mysql_close();
}else{
	echo "<font color='red'><strong>¡ERROR!</strong> No se ha identificado correctamente.</font>";
}
?>
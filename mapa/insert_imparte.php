<?php
require("login.php");
if($logincorrecto){
	$link=conectar();
	
	$idmaestro=$_GET['idmaestro'];
	$idclub=$_GET['idclub'];
	
	if($sql=mysql_query("INSERT INTO imparte (maestro_idmaestro, club_idclub) VALUES ('".$idmaestro."', '".$idclub."')")){
		echo "<font color=\"green\"><strong>Relacion IMPARTE introducida correctamente en la base de datos:</strong></font><br>
			  idmaestro: ".$idmaestro."<br>
			  idclub: ".$idclub."<br>";
	}else{
		echo "<font color=\"red\"><strong>Ha habido un error al introducir la relacion.</strong></font>";
	}

	mysql_close();
}else{
	echo "<font color='red'><strong>¡ERROR!</strong> No se ha identificado correctamente.</font>";
}
?>
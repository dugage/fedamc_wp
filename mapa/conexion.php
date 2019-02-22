<?php
function conectar(){
	
	$mysqli = new mysqli("localhost", "myfedamc", "06xbckqe", "mapa", 3306);
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

}
?>
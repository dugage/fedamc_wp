<?php 
require("conexion.php");
$logincorrecto=false;

// Si las cookies existen
if(isset($HTTP_COOKIE_VARS["cNick"]) && isset($HTTP_COOKIE_VARS["cPass"])){
	$link=conectar();
	// Se hace un select de toda la información del usuario
	$result = mysql_query("SELECT * FROM usuario WHERE nick='".$HTTP_COOKIE_VARS["cNick"]."' AND pass='".$HTTP_COOKIE_VARS["cPass"]."'");
	    // Si hay datos para ese usuario se extrae su información
		if($row = mysql_fetch_array($result)){
			$logincorrecto = true;
			$id = $row["id"];
			$nick = $row["nick"];
		}else{
			// Sino se destruyen las cookies
			setcookie("cNick","x",time()-3600);
			setcookie("cPass","x",time()-3600);
		}
	mysql_free_result($result);
	mysql_close();
}
?>
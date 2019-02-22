<?php
require("conexion.php");
require("funciones.php");

$link=conectar();

$usuario=filtra($_POST['usuario']);
$password=filtra($_POST['password']);
$password=md5($password);

// Se comprueba si el usuario o password están vacíos
if($usuario!="" && $password!=""){
	$result = mysql_query("SELECT pass FROM usuario WHERE nick='$usuario'");
	// Si el usuario existe en la base de datos y la contraseña es correcta
	if($row = mysql_fetch_array($result)){
		if($row['pass']==$password){
			// Se crean las cookies que durarán un mes
			setcookie("cNick",$usuario,time()+2419200);
			setcookie("cPass",$password,time()+2419200);
			mysql_free_result($result);
			mysql_close();
			echo '
			<b>Va a ser redireccionado, si no se redirecciona automáticamente pulse <a href="insertar.php">	aquí</a>.</b>
			<script language="javascript">
				location.href = "insertar.php";
			</script>';
        }else{
			error("Password incorrecto.", "logear.php");
		}
	}else{
		error("El usuario que ha introducido no existe.", "logear.php");
	}
	mysql_free_result($result);
	mysql_close();
}else{
	error("El usuario o la contraseña están vacíos. Rellene los campos.","logear.php");
}
?>
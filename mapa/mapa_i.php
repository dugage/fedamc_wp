<?php
require("conexion.php");
require("funciones.php");
$link=conectar();

$pais=filtra($_GET['pais']);

$result=mysql_query("SELECT nombre FROM pais WHERE idpais=".$pais);
$cell=mysql_fetch_array($result);
echo "<table border='0' cellpadding='2' cellspacing='0' width='95%'>
		<tr>
			<td bgcolor='#333333'>
				<b><font color='white'><big>".$cell['nombre']."</big></font></b>
			</td>
		</tr>
	  </table><br>";
$sql=mysql_query("SELECT nombre, localidad, contacto FROM club_i WHERE pais_idpais=".$pais);
$num=mysql_num_rows($sql);
if($num>0){
	while($row=mysql_fetch_array($sql)){
		$color1="#CCCCCC";
		$color2="#999999";
		$color3="#DDDDDD";

		// Se presenta la tabla con la información
		echo "<table border='0' width='95%' cellpadding='5' cellspacing='1'>
		  <tr>
			  <td bgcolor='".$color2."' align='center' colspan='3'><b>".$row['nombre']."</b></td>
		  </tr>";
		echo "<tr>
				<td bgcolor='".$color2."' align='center'><b>Localidad:</b></td>
				<td bgcolor='".$color1."' align='center' colspan='2'>".$row['localidad']."</td>
			  </tr>
			  <tr>
				<td bgcolor='".$color2."' align='center'><b>Contacto</b></td>
				<td bgcolor='".$color1."' align='center' colspan='2'>".$row['contacto']."</td>
			  </tr>";

	
	$sql2=mysql_query("SELECT maestro_i.nombre FROM maestro_i JOIN imparte_i ON maestro_i_idmaestro_i=idmaestro_i JOIN club_i ON club_i_idclub_i=idclub_i WHERE pais_idpais=".$pais." AND club_i_idclub_i=(SELECT idclub_i FROM club_i WHERE nombre='".$row['nombre']."')");	
	$num=mysql_num_rows($sql2);	 
	echo" <tr>
				<td bgcolor='".$color2."' align='center' rowspan='".$num."'><b>Delegado:</b></td>";
	while($row2=mysql_fetch_array($sql2)){		 
		echo "		<td bgcolor='".$color3."' align='center' valign='center'>".$row2['nombre']."</td>";
					$sql3=mysql_query("SELECT descripcion FROM grado JOIN posee_i ON grado_idgrado=idgrado JOIN maestro_i ON maestro_i_idmaestro_i=idmaestro_i WHERE idmaestro_i=(SELECT idmaestro_i FROM maestro_i WHERE nombre='".$row2['nombre']."') ORDER BY descripcion DESC");
					echo "<td bgcolor='".$color1."' align='left'>";
					while($row3=mysql_fetch_array($sql3)){		 
						echo $row3['descripcion']."<br>";
					}
					echo "</td>";
					echo "</tr>";
	}
	echo "</table><br><br>";
}
}else{
	echo "<strong>No existen clubes asociados en este país</strong>";
}
?>

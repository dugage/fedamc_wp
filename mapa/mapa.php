<?php
require("conexion.php");
require("funciones.php");
$link=conectar();

$provincia=filtra($_GET['provincia']);

$result= $mysqli->query("SELECT * FROM provincia WHERE idprovincia=$provincia");
$cell=mysqli_fetch_array($result);
echo "<table border='0' cellpadding='2' cellspacing='0' width='80%'>
		<tr>
			<td bgcolor='#333333'>
				<b><font color='white'><big>".$cell['nombre']."</big></font></b>
			</td>
		</tr>
	  </table><br>";
	  if($cell['nombre']=="BARCELONA" or $cell['nombre']=="LERIDA" or $cell['nombre']=="GERONA" or $cell['nombre']=="TARRAGONA"){
	  	echo "<center><h3><a href=\"http://www.famc.cat\" target=\"_blank\">http://www.famc.cat</a></h3>
	          <img src=\"../imagenes/logofamc.jpg\"></center><br><br>";
	  }
$sql=$mysqli->query("SELECT * FROM club WHERE provincia_idprovincia=".$provincia);
$num=mysqli_num_rows($sql);
if($num>0){
	while($row=mysqli_fetch_array($sql)){
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
			  </tr>";
			  if($row['contacto']!=""){
				echo  "<tr>
						<td bgcolor='".$color2."' align='center'><b>Contacto:</b></td>
						<td bgcolor='".$color1."' align='center' colspan='2'>".$row['contacto']."</td>
					   </tr>";
			  }
	
	$sql2=mysqli_query("SELECT maestro.nombre FROM maestro JOIN imparte ON maestro_idmaestro=idmaestro JOIN club ON club_idclub=idclub WHERE provincia_idprovincia=".$provincia." AND club_idclub=(SELECT idclub FROM club WHERE nombre='".$row['nombre']."')");	
	$num=mysqli_num_rows($sql2);	 
	echo" <tr>
				<td bgcolor='".$color2."' align='center' rowspan='".$num."'><b>Maestros:</b></td>";
	while($row2=mysqli_fetch_array($sql2)){		 
		echo "		<td bgcolor='".$color3."' align='center' valign='center'>".$row2['nombre']."</td>";
					$sql3=mysqli_query("SELECT descripcion FROM grado JOIN posee ON grado_idgrado=idgrado JOIN maestro ON maestro_idmaestro=idmaestro WHERE idmaestro=(SELECT idmaestro FROM maestro WHERE nombre='".$row2['nombre']."') ORDER BY descripcion desc");
					echo "<td bgcolor='".$color1."' align='left'>";
					while($row3=mysqli_fetch_array($sql3)){		 
						echo $row3['descripcion']."<br>";
					}
					echo "</td>";
					echo "</tr>";
	}
	echo "</table>";
	if($row['web']!=""){
		echo "<span style='font-size: 14px; font-weight:bold;'><a href='".$row['web']."' target='_blank'>".$row['web']."</a></span>";
	}	
	echo "<br><br>";
}
}else{
	if($cell['nombre']=="BARCELONA" or $cell['nombre']=="LERIDA" or $cell['nombre']=="GERONA" or $cell['nombre']=="TARRAGONA"){
	  	echo "<center>Alianza con F.A.M.C.<br></center><br><br>";
	}else{
		echo "<strong>No existen clubes asociados en esta provincia</strong>";
	}
}
?>
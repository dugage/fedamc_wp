<?php
	require("conexion.php");
	require("funciones.php");
	$link=conectar();
	
	$cadena=filtra($_GET['cadena']);
	
	$sql=mysql_query("SELECT * FROM club WHERE nombre LIKE '%".$cadena."%'");
	$num=mysql_num_rows($sql);
	echo "<br><br>";
	if($num>0){
		while($row=mysql_fetch_array($sql)){
			$color1="#FFE0A8";
			$color2="#FFB66C";

			// Se presenta la tabla con la información
			echo "<table border='0' width='95%' cellpadding='5' cellspacing='1'>
			  <tr>
				  <td bgcolor='".$color2."' align='center' colspan='3'><b>".$row['nombre']."</b></td>
			  </tr>";
			echo "<tr>
				<td bgcolor='".$color2."' align='center'><b>Provincia:</b></td>";
				$provincia=mysql_query("SELECT nombre FROM provincia WHERE idprovincia=".$row['provincia_idprovincia']);
				$cell=mysql_fetch_array($provincia);
				echo "<td bgcolor='".$color1."' align='center' colspan='2'>".$cell['nombre']."</td>
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
		
		
		$sql2=mysql_query("SELECT maestro.nombre FROM maestro JOIN imparte ON maestro_idmaestro=idmaestro JOIN club ON club_idclub=idclub WHERE club_idclub=(SELECT idclub FROM club WHERE nombre='".$row['nombre']."')");	
		$num=mysql_num_rows($sql2);	 
		echo" <tr>
					<td bgcolor='".$color2."' align='center' rowspan='".$num."'><b>Maestros:</b></td>";
		while($row2=mysql_fetch_array($sql2)){		 
			echo "		<td bgcolor='".$color1."' align='center' valign='center'>".$row2['nombre']."</td>";
						$sql3=mysql_query("SELECT descripcion FROM grado JOIN posee ON grado_idgrado=idgrado JOIN maestro ON maestro_idmaestro=idmaestro WHERE idmaestro=(SELECT idmaestro FROM maestro WHERE nombre='".$row2['nombre']."') ORDER BY descripcion desc");
						echo "<td bgcolor='".$color1."' align='left'>";
						while($row3=mysql_fetch_array($sql3)){		 
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
		echo "<b>No se encontraron resultados para los datos introducidos</b>";
	}
?>
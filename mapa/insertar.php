<?php
require("login.php");
if($logincorrecto){
	$link=conectar();
	$sql=mysql_query("SELECT * FROM club");
	$num_club=mysql_num_rows($sql);
	$sql=mysql_query("SELECT * FROM maestro");
	$num_maestro=mysql_num_rows($sql);
	echo "<center>En este momento hay <b>$num_club clubes</b> y <b>$num_maestro maestros</b></center>\n";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<style type="text/css">
<!--
input, textarea, select {
  border:1px solid #aaaaaa;
  background:#ffffff url(textbg.gif) top left no-repeat;
  margin-top:2px;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="js.js"></script>
</head>
<body>
<script type="text/javascript" src="wz_tooltip.js"></script>
<div align="center">
  <table width="867" height="376" border="0" cellpadding="0" cellspacing="2">
    <tr>
      <td colspan="2" align="center" bgcolor="#D2262B"><p><strong>CLUB</strong></p>    </td>
      <td colspan="2" align="center" bgcolor="#D2262B"><strong>MAESTRO </strong></td>
      <td colspan="2" align="center" bgcolor="#D2262B"><strong>GRADO    </strong></td>
    </tr>
    <tr>
      <td width="87" height="199" align="right" valign="top"><strong><br>
        idclub:<br>
        <br>
        idprovincia:<br>
        <br>
        nombre:<br>
        <br>
      localidad:</strong></td>
      <td width="248" valign="top"><br>
      <form id="clubes" action="" onSubmit="InsertaClub(); return false">
        <input name="idclub" type="text" id="idclub" onBlur="idclubi.value=this.value" size="3">
        <br>
        <br>
        <input name="provincia_idprovincia" type="text" id="provincia_idprovincia" size="3">
        <select name="provincias" id="provincias" onChange="provincia_idprovincia.value=evalua(this.value)">
              <option value="" selected="selected">Seleccione una provincia</option>
              <option value="ALAVA">ALAVA</option>
              <option value="ALBACETE">ALBACETE</option>
              <option value="ALICANTE">ALICANTE</option>
              <option value="ALMERIA">ALMERIA</option>
              <option value="ASTURIAS">ASTURIAS</option>
              <option value="AVILA">AVILA</option>
              <option value="BADAJOZ">BADAJOZ</option>
              <option value="BALEARES">BALEARES</option>
              <option value="BARCELONA">BARCELONA</option>
              <option value="BURGOS">BURGOS</option>
              <option value="CACERES">CACERES</option>
              <option value="CADIZ">CADIZ</option>
              <option value="CANTABRIA">CANTABRIA</option>
              <option value="CASTELLON">CASTELLON</option>
              <option value="CIUDAD REAL">CIUDAD REAL</option>
              <option value="CORDOBA">CORDOBA</option>
              <option value="CUENCA">CUENCA</option>
              <option value="GERONA">GERONA</option>
              <option value="GRANADA">GRANADA</option>
              <option value="GUADALAJARA">GUADALAJARA</option>
              <option value="GUIPUZCOA">GUIPUZCOA</option>
              <option value="HUELVA">HUELVA</option>
              <option value="HUESCA">HUESCA</option>
              <option value="JAEN">JAEN</option>
              <option value="A CORUNA">A CORU&Ntilde;A</option>
              <option value="LA RIOJA">LA RIOJA</option>
              <option value="LAS PALMAS">LAS PALMAS</option>
              <option value="LEON">LEON</option>
              <option value="LERIDA">LERIDA</option>
              <option value="LUGO">LUGO</option>
              <option value="MADRID">MADRID</option>
              <option value="MALAGA">MALAGA</option>
              <option value="MURCIA">MURCIA</option>
              <option value="NAVARRA">NAVARRA</option>
              <option value="ORENSE">ORENSE</option>
              <option value="PALENCIA">PALENCIA</option>
              <option value="PONTEVEDRA">PONTEVEDRA</option>
              <option value="SALAMANCA">SALAMANCA</option>
              <option value="SEGOVIA">SEGOVIA</option>
              <option value="SEVILLA">SEVILLA</option>
              <option value="SORIA">SORIA</option>
              <option value="STA.CRUZ DE TENERIFE">STA.CRUZ DE TENERIFE</option>
              <option value="TARRAGONA">TARRAGONA</option>
              <option value="TERUEL">TERUEL</option>
              <option value="TOLEDO">TOLEDO</option>
              <option value="VALENCIA">VALENCIA</option>
              <option value="VALLADOLID">VALLADOLID</option>
              <option value="VIZCAYA">VIZCAYA</option>
              <option value="ZAMORA">ZAMORA</option>
              <option value="ZARAGOZA">ZARAGOZA</option>
        </select>
        <br>
        <br>
        <input type="text" name="nombreclub" id="nombreclub">
        <br>
        <br>
        <input type="text" name="localidad" id="localidad">
        <br>
        <br>
        <input type="submit" value="Enviar">
        </form>
          <br>
          </td>
      <td width="86" align="right" valign="top"><strong><br>
        idmaestro:<br>
        <br>
        nombre: </strong></td>
      <td width="167" valign="top"><br>
      <form id="maestros" action="" onSubmit="InsertaMaestro(); return false">
        <input type="text" name="idmaestro" id="idmaestro" onBlur="idmaestroi.value=this.value; idmaestrop.value=this.value">
          <br>
          <br>
          <input type="text" name="nombremaestro" id="nombremaestro"> 
          <br>
          <br>
          <input type="submit" value="Enviar">   
       </form>   
      </td>
      <td width="104" align="right" valign="top"><strong><br>
        idgrado:<br>
        <br>
        descripcion: </strong></td>
      <td width="161" valign="top">
      <form id="grados" action="" onSubmit="InsertaGrado(); return false">
        <br>
        <input type="text" name="idgrado" id="idgrado" onBlur="idgradop.value=this.value">
        <br>
        <br>
        <input type="text" name="descripcion" id="descripcion"> 
        <input type="submit" value="Enviar">
        </form>
    </td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#D2262B"><div align="center"><strong>IMPARTE</strong></div></td>
      <td colspan="2" bgcolor="#D2262B"><div align="center"><strong>POSEE</strong></div></td>
      <td colspan="2"><div align="center"></div></td>
    </tr>
    <tr>
      <td height="103" align="right" valign="top"><p><strong><br>
        idmaestro:<br> 
        <br>
      idclub: </strong></p>      </td>
      <td valign="top">
        <form id="imparte" action="" onSubmit="InsertaRelacion1(); return false">
        <br>
        <input type="text" name="idmaestroi" id="idmaestroi">
        <br>
        <br>
        <input type="text" name="idclubi" id="idclubi">
        <br>
        <input type="submit" value="Enviar">
        </form>
      </td>
      <td align="right" valign="top"><strong><br>
        idmaestro:<br>
        <br>
        idgrado: </strong></td>
      <td valign="top">
      <form id="posee" action="" onSubmit="InsertaRelacion2(); return false">
        <br>
        <input type="text" name="idmaestrop" id="idmaestrop">
        <br>
        <br>
        <input type="text" name="idgradop" id="idgradop">
        <br>
        <input type="submit" value="Enviar">
        </form>
      </td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</div>
<div id="resultado"></div>
</body>
</html>
<?php
}else{
	echo "<font color='red'><strong>¡ERROR!</strong> No se ha identificado correctamente.</font>";
}
?>
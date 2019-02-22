<?php
/* Funciones php */

// Elimina caracteres especiales de una cadena, sólo permite alfanuméricos
function alfanumeric($string){
	$string = preg_replace("[^A-Za-z0-9 ,.()-]", "", $string);
	return $string;
}

// Da el mensaje de error $string y redirecciona a $url
function error($string, $url){
	echo "<font color=\"red\"><b>".$string."</b></font>";
	echo "<script type=\"text/javascript\">
		 	function redireccionar(){ 
				window.location=\"".$url."\"; 
			}  
			setTimeout (\"redireccionar()\", 3000);
	     </script>";
}

// Comprueba que un e-mail es válido
function comprobar_email($email){
    $mail_correcto = 0;
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
          if (substr_count($email,".")>= 1){

             $term_dom = substr(strrchr ($email, '.'),1);
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    }
    if ($mail_correcto)
       return 1;
    else
       return 0;
} 

//Se quitan espacios en blanco con trim
//Se eliminan sentencias html, javascript, SQL, PHP... con strip_tags
//Se pasa todo a minúsculas con strtolower
//Se eliminan caracteres especiales con alfanumeric
function filtra($var){
	$var=alfanumeric(strtolower(strip_tags(trim($var))));
	return $var;
}
?>
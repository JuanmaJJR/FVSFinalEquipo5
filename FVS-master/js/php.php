<?php
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
$servername = "localhost";
$user = "root";
$password = "";
$dbname = "vidasostenible";
$conn = new mysqli($servername, $user,$password,$dbname);
$conn->set_charset("utf8");
//ARRAYS
$ArrayPadre = array();
$DatosPreguntas = array();
$DatosRespuestas=array();

	//ArraysPreguntas
	$dependiente=array();
	$idpregunta=array();
	$categoria=array();
	$respuestamultiple=array();
	$textopregunta=array();

	//ArraysRespuesta
	$dependencia=array();
    $idrespuesta=array();
	$textorespuesta=array();


//QUERYS Faltan
$sql = "SELECT pregunta.id,pregunta.pregunta,pregunta.disponibilidad,pregunta.orden,tipo.tipo , GROUP_CONCAT(dependencia.id) as dependiente,categoria.nombre from pregunta inner join tipo on tipo.id=pregunta.tipo LEFT JOIN dependencia on dependencia.idPregunta=pregunta.id JOIN pertenece on pertenece.idPregunta=pregunta.id INNER JOIN categoria on categoria.id=pertenece.idCategoria GROUP BY pregunta.id order by pregunta.id limit 0,1000";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {

	$dependiente=$row["dependiente"];
	$idpregunta=$row["id"];
	$categoria=$row["nombre"];
	$respuestamultiple=$row["tipo"];
	$textopregunta=$row["pregunta"];

	$DatosPreguntas["dependiente"]=$dependiente;
	$DatosPreguntas["idpregunta"]=$idpregunta;
	$DatosPreguntas["categoria"]=$categoria;
	$DatosPreguntas["respuestamultiple"]=$respuestamultiple;
	$DatosPreguntas["textopregunta"]=$textopregunta;

	//Declaracion de array de respuestay
	$Respuesta=array();


	//SELECT DE DATOS Respuesta
$sql2="select pregunta.id,depende.id as id2,respuesta.respuesta from respuesta INNER JOIN depende on depende.idRespuesta=respuesta.id INNER JOIN pregunta on pregunta.id=depende.idPregunta ";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
	while($row2 = $result2->fetch_assoc()) {

	$dependencia=$row2["id"];
    $idrespuesta=$row2["id2"];
	$textorespuesta=$row2["respuesta"];

	$DatosRespuestas["dependencia"]=$dependencia;
	$DatosRespuestas["idrespuesta"]=$idrespuesta;
	$DatosRespuestas["textorespuesta"]=$textorespuesta;
	if($DatosRespuestas["dependencia"] == $DatosPreguntas["idpregunta"]) {
		$Respuesta[]=$DatosRespuestas;
	}
}

 
$DatosPreguntas["respuesta"]=$Respuesta;
$ArrayPadre["formulario"][]=$DatosPreguntas;
	}else{
		echo "0 results";
}

}
} else {
echo "0 results";
}

$Respuesta=array();
$DatosRespuestas =array();
$sql3 = "SELECT * FROM dependencia";
$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
	while($row3 = $result3->fetch_assoc()) {

	$dependencia=$row3["id"];
    $idrespuesta=$row3["idDepende"];
	$textorespuesta=$row3["idPregunta"];
	$preg = $row3["idPreguntaDepende"];

	$DatosRespuestas["id"]=$dependencia;
	$DatosRespuestas["idDepende"]=$idrespuesta;
	$DatosRespuestas["idPregunta"]=$textorespuesta;
	$DatosRespuestas["idPreguntaDepende"]=$preg;
	$Respuesta[]=$DatosRespuestas;
}
$ArrayPadre["dependencias"]=$Respuesta;
	}else{
		echo "0 results";
}
$jsonString = json_encode($ArrayPadre, JSON_PRETTY_PRINT);

//echo "<pre>";
echo $jsonString;
//echo "</pre>";




$conn->close(); // cierre de conexión con la BBDD



?>


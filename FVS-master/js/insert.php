<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vidasostenible";
session_start(); 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$pais = $_POST['selectpaises'];
$ccaa= $_POST['selectccaa'];
$edad= $_POST['selectedad'];
$tipoCasa= $_POST['selecttipoCasa'];
$espacioCasa= $_POST['selectespacioCasas'];
$numPersonas= $_POST['selectnumPersonas'];
$ingresos = $_POST['selectingresos'];
$conocimiento = $_POST['selectconocimientos'];
$estudios = $_POST['selectestudios'];




    echo "New record created successfully";
	
    if($pais==73){
        $sql = "INSERT INTO `persona` (`id`, `pais`, `ccaa`, `edad`, `tipoCasa`, `m2Casa`, `numPersonas`, `ingresos`, `conocimiento`, `estudios`, `sexo`) VALUES     (NULL, '".$pais."', '".$ccaa."', '".$edad."', '".$tipoCasa."', '".$espacioCasa."', '".$numPersonas."', '".$ingresos."', '".$conocimiento."', '".$estudios."', 'feminino')";
    }
	else{
        $sql = "INSERT INTO `persona` (`id`, `pais`, `ccaa`, `edad`, `tipoCasa`, `m2Casa`, `numPersonas`, `ingresos`, `conocimiento`, `estudios`, `sexo`) VALUES     (NULL, '".$pais."', NULL, '".$edad."', '".$tipoCasa."', '".$espacioCasa."', '".$numPersonas."', '".$ingresos."', '".$conocimiento."', '".$estudios."', 'feminino')";
    }

    if ($conn->query($sql) === TRUE) {
    $lastId = $conn->insert_id;


	       foreach($_POST as $Name => $respuesta){
	         if (is_numeric($Name)) {
				$sql = "INSERT INTO `responde` (`idPersona`, `idRespuesta`) VALUES ('".$lastId."', '".$respuesta."')";
                if ($conn->query($sql) === TRUE) {

	       echo "<br>Guay<br/> ";
	
	
           } else {
                echo "<br/>Error: " . $sql . "<br>" . $conn->error."<br/>";
        }

	       }
	      
    }
    }
//echo "<a href='final.php?lastId=".$lastId."'>Ver</a>"; 
header("Location: final.php?lastId=".$lastId);
$conn->close();

?>

